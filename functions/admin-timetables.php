<?php

function add_timetable_metaboxes() {
    add_meta_box('timetable-div', 'Timetable', 'render_timetable_metabox', 'timetable', 'normal');
}
add_action('add_meta_boxes', 'add_timetable_metaboxes');

function render_timetable_metabox( $post ) {
    $vals = get_post_meta($post->ID, 'raw_ttable', true);
    $spec_times = get_spec_times();
    $vals = (!$vals) ? '[]' : $vals;
    $spec_times = (!$spec_times) ? '[]' : $spec_times;
    ?>
    <div id="app">
        <timetable 
            :init-ttable='<?php echo $vals ?>' 
            :init-spec-times="<?php echo $spec_times; ?>" >
        </timetable>
    </div>
    <?php
}

function save_timetable_meta( $post_id, $post ) {

    if ( ! isset( $_POST['ttableoutput'])) {
        return $post_id;
    }

    $new_meta_value = $_POST['ttableoutput'];
    $stripped_times = stripslashes($new_meta_value);
    $formated_times = json_decode($stripped_times, true);
    $valid_json = $stripped_times;

    if ( ! add_post_meta( $post_id, 'raw_ttable', $valid_json, true )) {
        update_post_meta( $post_id, 'raw_ttable', $valid_json );
    }
    if ( ! add_post_meta( $post_id, 'formated_ttable', $formated_times, true )) {
        update_post_meta( $post_id, 'formated_ttable', $formated_times );
    }
}

function get_spec_times() {
    $spec_time_names = "['Standard','Saturday','Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', ";
    
    $args = array(
        'post_type' => array (
            'special_dates',
        ),
    );

    $query = new WP_Query($args);

    while ($query->have_posts()) {
        $query->the_post();
        $spec_time_names .= "'" . get_the_title() . "',";
    }

    $spec_time_names = rtrim($spec_time_names,',');
    $spec_time_names .= ']';

    return $spec_time_names;
}

add_action('save_post', 'save_timetable_meta', 10, 2);
