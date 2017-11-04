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

function custom_excerpt_length( $length ) {
	return 30;
	}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

function max_title_length( $title ) {
	$max = 32;
	if( strlen( $title ) > $max ) {
		return substr( $title, 0, $max ). " &hellip;";
	} else {
		return $title;
	}
}
add_filter( 'the_title', 'max_title_length');

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

	foreach($all as $term) {
		$html .= '<a href="'. get_category_link($term->term_id) .'" class="badge badge-primary" >' . $term->name .'</a>';
	}

	echo $html;
}

function render_tags_list($post_id) {
	$tags = (get_the_tags($post_id)) ? get_the_tags($post_id) : array();

	foreach($tags as $tag) {
		$html .= '<a href="'. get_tag_link($tag->term_id) .'" class="badge badge-success" >' . $tag->name .'</a>';
	}

	echo $html;
}

function get_next_bus() {
	$query = new WP_Query( array( 'post_type' => array('timetable') ));
	$now = current_time('Hi');
	$best_times = array();
	while ($query->have_posts()) {
		$query->the_post();
		$b_time = get_next_bus_from_ttable(get_the_ID(), $now);
		$best_times[get_the_title()]['time'] = $b_time;
		$best_times[get_the_title()]['id'] = get_the_ID();
	}
	
	return $best_times;
}

function get_next_bus_from_ttable($id, $now) {
	$best_time = null;
	$best_time_diff = 9999;
	$times = get_post_meta($id, 'formated_times');
	$times = $times[0];
	foreach ($times as $time) {
		if (check_available($time)) {
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
		$best_time = $times[0]['time'];
	}

	return $best_time;
}

function get_day_type() {
	//today - day name and timestamp
	//foreach special date - foreach date range
	//timestamp range - date >= start || date <= end -> is day type
	//Sunday Saturday === dayname -> day type
	//return list of daytypes
}

function check_available($date, $day_type = 'Standard') {
	
	return true;
}

function convertToHoursMins($time) {
    if ($time < 1) {
        return;
    }
    $hours = floor($time / 60);
    $minutes = ($time % 60);
    return $hours . 'hrs ' . $minutes . 'mins';
}