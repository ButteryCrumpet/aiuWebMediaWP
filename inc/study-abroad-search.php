<?php

function tax_cat_option($tax, $terms) {
    foreach($terms as $term) {
        $id = $tax.'-'.$term->term_id;
        echo "<option id='in-$id' value='$term->slug' >" . $term->name . "</option>";
    }
}

$taxonomy = 'location';

$tax = get_taxonomy($taxonomy);
$terms = get_terms($taxonomy,array('hide_empty' => 0));

//move to build cat hierarchy function build proper heirarchy, super useful
$topLevel = [];
$parentChildren = [];
foreach ($terms as $term) {
    if ( ! $term->parent ) {
        $topLevel[] = $term;
    } else {
        $parentTerm = get_term($term->parent);
        $parentChildren[$parentTerm->slug][] = $term;
    }
}

$jsonLevels = json_encode($parentChildren);

//Name of the form

?>
<script>
var uni_select_data = <?php echo $jsonLevels; ?>;
</script>
<div class="categorydiv">
    <div class="tabs-panel">
    <form class="input-group" method="GET" action="<?php echo get_home_url(); ?>">
        <select id="regionSelect" class="form-control" name="location">
        <option value="" disabled selected>Select Region</option>
        <?php tax_cat_option($taxonomy, $topLevel); ?>
        </select>
        <span class="input-group-btn">
            <button class="btn btn-secondary" type="submit">
            <i class="fa fa-search" aria-hidden="true"></i>
            </button>
        </span>
    </form>
    <form class="input-group" method="GET" action="<?php echo get_home_url(); ?>">
        <select id="countrySelect" class="form-control" name="location">
        <option  disabled selected>...</option>
        </select>
        <span class="input-group-btn">
            <button class="btn btn-secondary" type="submit">
            <i class="fa fa-search" aria-hidden="true"></i>
            </button>
        </span>
    </form>
    <form class="input-group" method="GET" action="<?php echo get_home_url(); ?>">
        <select id="uniSelect" class="form-control" name="location">
        <option disabled selected>...</option>
        </select>
        <span class="input-group-btn">
            <button class="btn btn-secondary" type="submit">
            <i class="fa fa-search" aria-hidden="true"></i>
            </button>
        </span>
    </form>
    </div>
</div>
