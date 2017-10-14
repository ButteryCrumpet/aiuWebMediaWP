<?php

function study_abroad_init() {
    $args = array(
      'label' => 'Study Abroad',
        'public' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'rewrite' => array('slug' => 'study_abroad'),
        'query_var' => true,
        'menu_icon' => 'dashicons-location-alt',
        'menu_position' => 5,
        'taxonomies' => array(
            'post_tag',
        ),
        'supports' => array(
            'title',
            'editor',
            'thumbnail',
        )
    );
    register_post_type( 'study_abroad', $args );
}
add_action( 'init', 'study_abroad_init' );

function timetables_init() {
    $args = array(
      'label' => 'Timetables',
        'public' => true,
        'exlude_from_search' => true,
        'publicly_queryable' => false,
        'show_in_nav_menus' => false,
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'rewrite' => array('slug' => 'timetable'),
        'query_var' => true,
        'menu_icon' => 'dashicons-list-view',
        'menu_position' => 5,
        'taxonomies' => array(
            
        ),
        'supports' => array(
            'title',
            'thumbnail',
        )
    );
    register_post_type( 'timetable', $args );
}
add_action( 'init', 'timetables_init' );

function special_dates_init() {
    $args = array(
        'label' => 'Special Dates',
        'public' => false,
        'show_ui' => true,
        'show_in_menu' => 'edit.php?post_type=timetable',
        'capability_type' => 'post',
        'heirarchical' => false,
        'menu_position' => 9,
        'supports' => array( 'title' )
    );

    register_post_type( 'special_dates', $args );
}

add_action( 'init', 'special_dates_init' );
