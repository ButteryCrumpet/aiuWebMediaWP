<?php

include 'functions/postTypes.php';
include 'functions/taxonomies.php';
include 'functions/admin.php';

//styles
function akiWebMedia_style() {
	wp_enqueue_style( 'core', 'style.css', false );
}

function akiWebMedia_scripts() {
	wp_enqueue_script('adminJS', get_template_directory_uri() . '/js/admin.js');
}

add_action( 'wp_enqueue_scripts', 'akiWebMedia_style' );
add_action( 'admin_enqueue_scripts', 'akiWebMedia_scripts' );