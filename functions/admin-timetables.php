<?php

function add_timetable_metaboxes() {
    add_meta_box('timetable-div', 'Timetable', 'render_timetable_metabox', 'timetable', 'normal');
}
add_action('add_meta_boxes', 'add_timetable_metaboxes');

function render_timetable_metabox( $post ) {

    $vals = get_post_meta($post->ID, 'ttable-times-meta');
    $vals = $vals[0];

    $inputs = '<table id="ttable-times">';
    $inputs .= '<tr><th>Time</th><th>Normal Schedule</th><th>Long Holiday</th><th>Weekend</th></tr>';
    foreach ($vals as $index =>$time){
        $normal = ($time['normal']) ? 'checked' : '';
        $lhol = ($time['longholiday']) ? 'checked' : '';
        $weekend = ($time['weekend']) ? 'checked' : '';
        $inputs .= '<tr class="ttable-input" data-index=' . $index . ' >
        <td><input name="ttable-times-meta[' . $index . '][time]" type="text" placeholder="HH:MM" value="'. $time['time'] . '"></td>
        <td><input type="checkbox" name="ttable-times-meta[' . $index . '][normal]" '. $normal .'></td>
        <td><input type="checkbox" name="ttable-times-meta[' . $index . '][longholiday]" '. $lhol .'></td>
        <td><input type="checkbox" name="ttable-times-meta[' . $index . '][weekend]" '. $weekend .'></td>
        </tr>';
    }
    $inputs .= '</table>';
    $inputs .= '<a style="cursor: pointer;" id="ttable-addtime" > + Add Time</a>';
    $inputs .= '<a style="cursor: pointer;" id="ttable-removetime" > - Remove Time</a>';

    echo $inputs;
}

function save_timetable_meta( $post_id, $post ) {

    if ( ! isset( $_POST['ttable-times-meta'])) {
        return $post_id;
    }

    $meta_key = 'ttable-times-meta';
    $meta_value = get_post_meta( $post_id, $meta_key, true );
    $new_meta_value = validate_timetable($_POST['ttable-times-meta']);

    if ( $new_meta_value && array() == $meta_value )
        add_post_meta( $post_id, $meta_key, $new_meta_value, true );

    // If the new meta value does not match the old value, update it.
    elseif ( $new_meta_value && $new_meta_value != $meta_value )
        update_post_meta( $post_id, $meta_key, $new_meta_value );

    // If there is no new meta value but an old value exists, delete it.
     elseif ( array() == $new_meta_value && $meta_value )
        delete_post_meta( $post_id, $meta_key, $meta_value );
}

function validate_timetable ($data) {
    
    $validated = array();

    foreach($data as $key => $time) {
        $validated[$key]['time'] = validate_time($time['time']);
        $validated[$key]['normal'] = ($time['normal']) ? true : false;
        $validated[$key]['longholiday'] = ($time['longholiday']) ? true : false;
        $validated[$key]['weekend'] = ($time['weekend']) ? true : false;
    }

    return $validated;
}

function validate_time($time) {
    $valid = preg_match('/^([0-9]|0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/', $time);
    if ( ! $valid ) {
        return 'invalid';
    } else {
        return $time;
    }
}

add_action('save_post', 'save_timetable_meta', 10, 2);
