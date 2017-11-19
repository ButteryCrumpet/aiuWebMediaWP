<?php

include 'functions/postTypes.php';
include 'functions/taxonomies.php';
include 'functions/admin-studyabroad.php';
include 'functions/admin-timetables.php';
include 'functions/admin-specialdates.php';
include 'functions/customize.php';

//styles
function akiWebMedia_style_scripts() {
	wp_enqueue_style( 'core', get_stylesheet_uri(), false );
	wp_enqueue_style( 'froala', get_template_directory_uri() . '/css/froala_blocks.css', false );
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', false );
	wp_enqueue_style( 'iconic', get_template_directory_uri() . '/css/open-iconic-bootstrap.css', false );
	wp_enqueue_style( 'fontawe', get_template_directory_uri() . '/fonts/font-awesome/css/font-awesome.min.css', false );
	
	wp_deregister_script('jquery');
	wp_enqueue_script('jquery', "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js");
	wp_enqueue_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js');
	wp_enqueue_script('adminJS', get_template_directory_uri() . '/js/admin.js');
}

function akiWebMedia_admin_style_scripts() {
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', false );
	wp_enqueue_script('adminJS', get_template_directory_uri() . '/js/admin.js');
	wp_enqueue_style( 'core', get_stylesheet_directory_uri() . '/awm-admin.css', false );
	wp_enqueue_script('vueMani', get_template_directory_uri() . '/js/awmv/manifest.f160a0c8475225e8a6d8.js', array(), null, true);
	wp_enqueue_script('vueVend', get_template_directory_uri() . '/js/awmv/vendor.c8b39cfc5e84eec96310.js', array(), null, true);
	wp_enqueue_script('vueApp', get_template_directory_uri() . '/js/awmv/app.1cab2e80af2b09f2e5cb.js', array(), null, true);
}

add_action( 'wp_enqueue_scripts', 'akiWebMedia_style_scripts' );
add_action( 'admin_enqueue_scripts', 'akiWebMedia_admin_style_scripts' );

add_theme_support( 'post-thumbnails' );
function register_theme_menus() {
	register_nav_menu('main-menu',__( 'Main Menu' ));
  }
add_action( 'init', 'register_theme_menus' );

function custom_excerpt_length( $length ) {
	return 10;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

function awm_get_excerpt($count){
	$excerpt = get_the_content();
	$excerpt = strip_tags($excerpt);
	$excerpt = mb_substr($excerpt, 0, $count);
	$excerpt .= '...';
	return $excerpt;
  }
 //add_filter( 'excerpt_length', 'awm_excerpt_length' );

function add_custom_post_type_to_query( $query ) {

	if (get_query_var('post_type')) {
		return;
	}

    if ( $query->is_main_query() && get_current_blog_id() === 3) {
		$query->set( 'post_type', array('post', 'study_abroad') );
	}
}
add_action( 'pre_get_posts', 'add_custom_post_type_to_query');


function timetable_order( $query ) {
	
	if( is_admin() ) {		
		return $query;		
	}

	if( isset($query->query_vars['post_type']) && $query->query_vars['post_type'] == 'timetable' ) {		
		$query->set('orderby', 'meta_value');	
		$query->set('meta_key', 'order');	 
		$query->set('order', 'ASC'); 		
	}
	
	return $query;
}

add_action('pre_get_posts', 'timetable_order');

function render_terms_list($post_id) {
	$cats = (get_the_category($post_id)) ? get_the_category($post_id) : array();
	$terms = (get_the_terms($post_id, 'location')) ? get_the_terms($post_id, 'location') : array();
	$all = $cats + $terms;
	$html = '';
	foreach($all as $term) {
		$html .= '<a style="background-color:' . get_field('color', $term) . ';" href="'. get_term_link($term->term_id) .'" class="badge terms-list" >' . $term->name .'</a>';
	}

	echo $html;
}

function render_tags_list($post_id) {
	$tags = (get_the_tags($post_id)) ? get_the_tags($post_id) : array();

	$html = '';
	foreach($tags as $tag) {
		$html .= '<a href="'. get_tag_link($tag->term_id) .'" class="badge badge-success" >' . $tag->name .'</a>';
	}

	echo $html;
}

function trim_length( $title, $max = 32 ) {
	if( mb_strlen( $title ) > $max ) {
		return mb_substr( $title, 0, $max ). " &hellip;";
	} else {
		return $title;
	}
}

function get_next_bus() {
	$query = new WP_Query( array( 
		'post_type' => array('timetable'),
		'meta_key' => 'order',
		'orderby' => 'meta_value',
		'order' => 'ASC'
	));
	$now = current_time('Hi');
	$best_times = array();
	$day_types = get_day_types();
	while ($query->have_posts()) {
		$query->the_post();
		$b_time = get_next_bus_from_ttable(get_the_ID(), $now, $day_types);
		$best_times[get_the_title()]['time'] = $b_time;
		$best_times[get_the_title()]['id'] = get_the_ID();
	}
	return $best_times;
}

function get_next_bus_from_ttable($id, $now, $day_types) {
	$best_time = null;
	$best_time_diff = 9999;
	$times = get_post_meta($id, 'formated_ttable', true);
	foreach ($times as $time) {
		if (check_available($time, $day_types)) {
			$hm_time = $time['departure'];
			if ($hm_time > $now) {
				$diff = $hm_time - $now;
				if($diff < $best_time_diff) {
					$best_time_diff = $diff;
					$best_time = $hm_time;
				}
			}
		}
	}
	if ($best_time == null) {
		$best_time = false;
	}
	return $best_time;
}

function check_available($time, $day_types) {
	if (empty($time['rules'])) {
		return true;
	}
	foreach ($time['rules'] as $rule) {
		if ($rule['rule'] == 'Not Available') {
			if (in_array($rule['name'], $day_types)) {
				return false;
			}
		} else if ($rule['rule'] == 'Strictly Available') {
			if (! in_array($rule['name'], $day_types)) {
				return false;
			}
		}
	}
	return true;
}

function get_day_types() {
	$query = new WP_Query( array( 'post_type' => array('special_dates') ));
	$today = current_time('md');
	$day = current_time('l');
	$day_types = array($day);
	$special_day = false;
	while ($query->have_posts()) {
		$query->the_post();
		$date_ranges = get_post_meta(get_the_ID(), 'formated_dates', true);
		foreach ($date_ranges as $range) {
			$start = $range['start']['month'] . $range['start']['day'];
			$end = $range['end']['month'] . $range['end']['day'];
			if ($today >= $start && $today <= $end) {
				if ( ! in_array(get_the_title(), $day_types)) {
					$day_types[] = get_the_title();
					$special_day = true;
				}
			}
		}
	}
	if (!$special_day) {
		$day_types[] = 'Standard';
	}
	return $day_types;
}

function printable_availablity($time) {
	$only_available = '';
	$not_available = '';

	foreach ($time['rules'] as $rule) {
		if ($rule['rule'] == 'Not Available') {
			$not_available .= $rule['name'] . ' ';
		} else if ($rule['rule'] == 'Strictly Available') {
			$only_available .= $rule['name'] . ' ';
		}
	}

	if ($only_available != '') {
		$only_available = '<div>Only Available: ' . $only_available . '</div>';
	}
	if ($not_available != '') {
		$not_available = '<div>Not Available: ' . $not_available . '</div>';
	}

	return $only_available . $not_available;
}


function convertToHoursMins($time) {
    if ($time < 1) {
        return;
    }
    $hours = floor($time / 60);
    $minutes = ($time % 60);
    return $hours . 'hrs ' . $minutes . 'mins';
}

function add_colon_time($time) {
	return substr_replace($time, ':', 2, 0);
}

function awm_tr($string) {
	$transMap = array(
		'Study Abroad' => '留学',
		'No Posts Found' => '記事がございません',
		'Home' => 'ホーム',
		'Timetables' => '時刻表',
		'About' => 'ご案内',
		'Departure' => '出発',
		'Arrival' => '到着',
		'Availablility' => '可用性',
		'Select Region' => '地域',
		'Recommended' => 'おすすめ記事',
		'First' => '最初',
		'Last' => '最後',
		'Next Busses' => '次のバス',
		'Read More' => '続きを読む',
	);
	if (get_current_blog_id() === 3 && array_key_exists($string, $transMap)) {
		return $transMap[$string];
	}
	else {
		return $string;
	}
}