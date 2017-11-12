<?php

function add_specialdates_metaboxes() {
    add_meta_box('dates-div', 'Dates', 'render_dates_metabox', 'special_dates', 'normal');
}

add_action('add_meta_boxes', 'add_specialdates_metaboxes');

function render_dates_metabox( $post ) {
    $vals = get_post_meta($post->ID, 'raw_dates', true);

    $vals = (!$vals) ? '[]' : $vals;
    ?>
    <div id="app">
      <spec-date :init-dates='<?php echo $vals ?>'></spec-date>
    </div>
    <?php
}

function save_specialdates_meta( $post_id, $post ) {

    if ( ! isset( $_POST['dateoutput'])) {
        update_post_meta( $post_id, 'formated_dates', 'what!' );
        return $post_id;
    }

    $new_meta_value = $_POST['dateoutput'];
    $formated_times = stripslashes($new_meta_value);
    $formated_dates = validate_dates($new_meta_value, true);

    update_post_meta( $post_id, 'raw_dates', $new_meta_value );
    update_post_meta( $post_id, 'formated_dates', $formated_dates );

}

function validate_dates($input) {
    $input = stripslashes($input);
    $decoded = json_decode($input, true);
    $current_month = date('n');
    $php_formated = array();
    foreach($decoded as $i => $daterange) {
        $range_pos = 'start';
        foreach ($daterange as $date) {
            $separated = explode('/', $date);
            $month = $separated[0];
            $day = $separated[1];
            $php_formated[$i][$range_pos]['month'] = $month;
            $php_formated[$i][$range_pos]['day'] = $day;
            $range_pos = 'end';
        }
    }

    return $php_formated;
    
};

add_action('save_post', 'save_specialdates_meta', 10, 2);