<?php

function remove_metaboxes() {
	remove_meta_box('locationdiv', 'study_abroad', 'normal');
}

function add_metaboxes() {
    add_meta_box('location-div', 'Locations', 'render_location_select', 'study_abroad', 'side', 'high');
    add_meta_box('timetable-div', 'Timetable', 'render_timetable_metabox', 'timetable', 'normal');
}

//refactor jesus fucking christ
function render_location_select( $post ) {
    $taxonomy = 'location';
    
    $tax = get_taxonomy($taxonomy);
    $terms = get_terms($taxonomy,array('hide_empty' => 0));
    $postterms = get_the_terms( $post->ID,$taxonomy );
    $current = [];
    foreach ($postterms as $term) {
        $current[] = $term->term_id;
    }

    //move to build cat hierarchy function build proper heirarchy, super useful
    $topLevel = [];
    $start;
    $parentChildren = [];
    foreach ($terms as $term) {
        if ( ! $term->parent ) {
            $topLevel[] = $term;
            if ( in_array($term->term_id, $current) ) {
                $start = $term->term_id;
            }
        } else {
            $parentChildren[$term->parent][] = $term;
        }
    }
    $initLevel2 = $parentChildren[$start];
    $start2;
    foreach ($initLevel2 as $term) {
        if ( in_array($term->term_id, $current)) {
            $start2 = $term->term_id;
        }
    }
    $initLevel3 = $parentChildren[$start2];
    $jsonLevels = json_encode($parentChildren);
 
	//Name of the form
	$name = 'tax_input[' . $taxonomy . '][]';
 
	?>
    <script>
    var uni_select_data = <?php echo $jsonLevels; ?>;
    </script>
    <div id="taxonomy-<?php echo $taxonomy; ?>" class="categorydiv">
        <div id="<?php echo $taxonomy; ?>-all" class="tabs-panel">
			<label>Region:
            <select id="regionSelect" name="<?php echo $name; ?>">
            <?php render_cat_option($taxonomy, $topLevel, $current); ?>
            </select>
            </label>
            <br>
            <label>Country:
            <select id="countrySelect" name="<?php echo $name; ?>">
            <?php render_cat_option($taxonomy, $initLevel2, $current); ?>
            </select>
            </label>
            <br>
            <label>University:
            <select id="uniSelect" name="<?php echo $name; ?>">
            <?php render_cat_option($taxonomy, $initLevel3, $current); ?>
            </select>
            </label>
		</div>
    </div>
	
	<?php
}

function render_cat_option($tax, $terms, $current) {
    foreach($terms as $term) {
        $id = $tax.'-'.$term->term_id;
        if (in_array($term->term_id, $current)) {
            $is_current = 'selected';
        }
        else {
            $is_current = '';
        }
        echo "<option id='in-$id' value='$term->term_id' " . $is_current .  " >" . $term->name . "</option>";
    }
}

//add holiday timetables?
function render_timetable_metabox( $post ) {

    $vals = get_post_meta($post->ID, 'ttable-times-meta');
    $vals = $vals[0];
    print_r($vals);

    $inputs = '<div id="ttable-times">';
    $inputs .= '<h4>Times:</h4>';
    $class = 'first-ttable-input';
    foreach ($vals as $time){
        $inputs .= '<div class="' . $class . '"><input name="ttable-times-meta[]" type="text" placeholder="HH:MM" value='. $time . '><br></div>';
        $class = 'ttable-input';
    }
    $inputs .= '</div>';
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
    $new_meta_value = ( isset( $_POST['ttable-times-meta'] ) ? sanitize_html_class( $_POST['ttable-times-meta'] ) : '' );

    //check if time format($new_meta_value);

    if ( $new_meta_value && array() == $meta_value )
        add_post_meta( $post_id, $meta_key, $new_meta_value, true );

    // If the new meta value does not match the old value, update it.
    elseif ( $new_meta_value && $new_meta_value != $meta_value )
        update_post_meta( $post_id, $meta_key, $new_meta_value );

    // If there is no new meta value but an old value exists, delete it.
     elseif ( array() == $new_meta_value && $meta_value )
        delete_post_meta( $post_id, $meta_key, $meta_value );
}

add_action('admin_menu', 'remove_metaboxes');
add_action('add_meta_boxes', 'add_metaboxes');
add_action('save_post', 'save_timetable_meta', 10, 2);
