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

    if ( ! isset( $_POST['datoutput'])) {
        return $post_id;
    }

    $meta_key = 'dateoutput';
    $meta_value = get_post_meta( $post_id, $meta_key, true );
    $new_meta_value = $_POST[$meta_key];
    $formated_dates = validate_dates($new_meta_value);

    if (array() == $meta_value) {
        add_post_meta( $post_id, 'raw_dates', $new_meta_value, true );
    } else {
        update_post_meta( $post_id, 'raw_dates', $new_meta_value );
        update_post_meta( $post_id, 'formated_dates', $formated_dates );
    }
}

function validate_dates($input) {
    $input = stripslashes($input);
    $decoded = json_decode($input, true);
    var_dump($decoded);
    $current_month = date('n');
    $php_formated = array();
    foreach($decoded as $daterange) {
        foreach ($daterange as $date) {
            $separated = explode('/', $date);
            $month = $separated[0];
            $day = $separated[1];
            $year = ($month < $current_month) ? date('y') + 1 : date('y'); 
            $php_formated[]['month'] = $month;
            $php_formated[]['day'] = $day;
            $php_formated[]['year'] = $year;
        }
    }

    return $php_formated;
    
};

function generateDTPeriod($start, $end) {
    $month = date('n');
    
}

add_action('save_post', 'save_specialdates_meta', 10, 2);