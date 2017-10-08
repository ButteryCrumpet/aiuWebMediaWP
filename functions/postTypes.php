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
