<?php

include 'functions/postTypes.php';
include 'functions/taxonomies.php';
include 'functions/admin-studyabroad.php';
include 'functions/admin-timetables.php';
include 'functions/admin-specialdates.php';

//styles
function akiWebMedia_style_scripts() {
	wp_enqueue_style( 'core', get_stylesheet_uri(), false );
	wp_enqueue_script('adminJS', get_template_directory_uri() . '/js/admin.js');
}

function akiWebMedia_admin_style_scripts() {
	wp_enqueue_script('adminJS', get_template_directory_uri() . '/js/admin.js');
	wp_enqueue_style( 'core', get_stylesheet_directory_uri() . '/awm-admin.css', false );
}

add_action( 'wp_enqueue_scripts', 'akiWebMedia_style_scripts' );
add_action( 'admin_enqueue_scripts', 'akiWebMedia_admin_style_scripts' );

add_theme_support( 'post-thumbnails' );

function add_custom_post_type_to_query( $query ) {
    if ( $query->is_home() && $query->is_main_query() ) {
        $query->set( 'post_type', array('post', 'study_abroad') );
    }
}
add_action( 'pre_get_posts', 'add_custom_post_type_to_query' );

function render_terms_list($post_id) {
	$cats = (get_the_category($post_id)) ? get_the_category($post_id) : array();
	$terms = (get_the_terms($post_id, 'location')) ? get_the_terms($post_id, 'location') : array();
	$all = $cats + $terms;

	$html = '<ul class="catlinks">';
	foreach($all as $term) {
		$html .= '<a href="'. get_category_link($term->term_id) .'"  ><li class="catlink" >' . $term->name .'</li></a>';
	}
	$html .= '</ul>';

	echo $html;
}