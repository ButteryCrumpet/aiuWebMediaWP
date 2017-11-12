<?php

include 'functions/postTypes.php';
include 'functions/taxonomies.php';
include 'functions/admin-studyabroad.php';
include 'functions/admin-timetables.php';
include 'functions/admin-specialdates.php';

//styles
function akiWebMedia_style_scripts() {
	wp_enqueue_style( 'core', get_stylesheet_uri(), false );
	wp_enqueue_style( 'froala', get_template_directory_uri() . '/css/froala_blocks.css', false );
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', false );
	wp_enqueue_style( 'iconic', get_template_directory_uri() . '/css/open-iconic-bootstrap.css', false );
	wp_enqueue_style( 'fontawe', get_template_directory_uri() . '/fonts/font-awesome/css/font-awesome.min.css', false );
	
	wp_enqueue_script('jquery');
	wp_enqueue_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js');
	wp_enqueue_script('adminJS', get_template_directory_uri() . '/js/admin.js');
}

function akiWebMedia_admin_style_scripts() {
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', false );
	wp_enqueue_script('adminJS', get_template_directory_uri() . '/js/admin.js');
	wp_enqueue_style( 'core', get_stylesheet_directory_uri() . '/awm-admin.css', false );
	wp_enqueue_script('vueMani', get_template_directory_uri() . '/js/awmv/manifest.0fcd948f03cefb72adfc.js', array(), null, true);
	wp_enqueue_script('vueVend', get_template_directory_uri() . '/js/awmv/vendor.c8b39cfc5e84eec96310.js', array(), null, true);
	wp_enqueue_script('vueApp', get_template_directory_uri() . '/js/awmv/app.03a91c60a26793e0bda3.js', array(), null, true);
}

add_action( 'wp_enqueue_scripts', 'akiWebMedia_style_scripts' );
add_action( 'admin_enqueue_scripts', 'akiWebMedia_admin_style_scripts' );

add_theme_support( 'post-thumbnails' );
function register_theme_menus() {
	register_nav_menu('main-menu',__( 'Main Menu' ));
  }
add_action( 'init', 'register_theme_menus' );

function custom_excerpt_length( $length ) {
	return 30;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

function add_custom_post_type_to_query( $query ) {

	if (get_query_var('post_type')) {
		return;
	}

    if ( $query->is_main_query() ) {
		$query->set( 'post_type', array('post', 'study_abroad') );
	}
}
add_action( 'pre_get_posts', 'add_custom_post_type_to_query');

function render_terms_list($post_id) {
	$cats = (get_the_category($post_id)) ? get_the_category($post_id) : array();
	$terms = (get_the_terms($post_id, 'location')) ? get_the_terms($post_id, 'location') : array();
	$all = $cats + $terms;
	$html = '';
	foreach($all as $term) {
		$html .= '<a style="background-color:' . get_field('color', $term) . ';" href="'. get_category_link($term->term_id) .'" class="badge terms-list" >' . $term->name .'</a>';
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
	if( strlen( $title ) > $max ) {
		return substr( $title, 0, $max ). " [&hellip;]";
	} else {
		return $title;
	}
}

function get_next_bus() {
	$query = new WP_Query( array( 'post_type' => array('timetable') ));
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
			$hm_time = $time['time'];
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
	foreach ($day_types as $day_type) {
		if ( ! in_array($day_type, $time['availability'])) {
			return false;
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


function convertToHoursMins($time) {
    if ($time < 1) {
        return;
    }
    $hours = floor($time / 60);
    $minutes = ($time % 60);
    return $hours . 'hrs ' . $minutes . 'mins';
}