<?php

function locations_init() {
	// create a new taxonomy
	register_taxonomy(
		'location',
		'study_abroad',
		array(
			'label' => __( 'Locations' ),
			'rewrite' => array( 'slug' => 'location' ),
            'hierarchical' => true,
		)
	);
}
add_action( 'init', 'locations_init' );