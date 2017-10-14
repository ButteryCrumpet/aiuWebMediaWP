<?php

function add_specialdates_metaboxes() {
    add_meta_box('dates-div', 'Dates', 'render_dates_metabox', 'special_dates', 'normal');
}

add_action('add_meta_boxes', 'add_specialdates_metaboxes');

function render_dates_metabox( $post ) {

    $vals = get_post_meta($post->ID, 'sdates-meta');
    $vals = $vals[0];
    print_r($vals);

    $inputs = '<div id="sd-dates" >';
    foreach ($vals as $key => $val) {
        $inputs .= '<div class="sd-input" data-index="'. $key .'" >';
        $inputs .= '<input type="date" name="sdates-meta['. $key .'][from]" value="'.$val['from'].'" > -> ';
        $inputs .= '<input type="date" name="sdates-meta['. $key .'][to]" value="' . $val['to'] .'" >';
        $inputs .= '</div>';
    }
    $inputs .= '</div>';
    $inputs .= '<a style="cursor: pointer;" id="sd-adddates" > + Add Dates</a>';
    $inputs .= '<a style="cursor: pointer;" id="sd-removedates" > - Remove Dates</a>';
    echo $inputs;
}

function save_specialdates_meta( $post_id, $post ) {
    
    if ( ! isset( $_POST['sdates-meta'])) {
        return $post_id;
    }

    $meta_key = 'sdates-meta';
    $meta_value = get_post_meta( $post_id, $meta_key, true );
    $new_meta_value = $_POST['sdates-meta'];

    if ( $new_meta_value && array() == $meta_value )
        add_post_meta( $post_id, $meta_key, $new_meta_value, true );

    // If the new meta value does not match the old value, update it.
    elseif ( $new_meta_value && $new_meta_value != $meta_value )
        update_post_meta( $post_id, $meta_key, $new_meta_value );

    // If there is no new meta value but an old value exists, delete it.
     elseif ( array() == $new_meta_value && $meta_value )
        delete_post_meta( $post_id, $meta_key, $meta_value );
}

function validate_dates($data) {

    $validated = array();

    foreach($data as $key => $dates) {

        $validated[$key]['to'] = validate_date($dates['to']);
        $validated[$key]['from'] = validate_date($dates['from']);
    }

    return $validated;

}

function validate_date($date) {

    $seperate = explode('-', $date);
    if (wp_checkdate($seperate[1], $seperate[2], $seperate[0])) {
        return $date;
    }


    return 'invalid';

}

add_action('save_post', 'save_specialdates_meta', 10, 2);