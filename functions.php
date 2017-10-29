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
