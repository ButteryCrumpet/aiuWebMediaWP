<?php

function remove_studyabroad_metaboxes() {
	remove_meta_box('locationdiv', 'study_abroad', 'normal');
}

function add_studyabroad_metaboxes() {
    add_meta_box('location-div', 'Locations', 'render_location_select', 'study_abroad', 'side', 'high');
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

add_action('admin_menu', 'remove_studyabroad_metaboxes');
add_action('add_meta_boxes', 'add_studyabroad_metaboxes');
