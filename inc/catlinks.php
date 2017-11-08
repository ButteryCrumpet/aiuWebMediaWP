<ul class="list-group">
<?php 
$cats = get_categories(array(
    'orderby' => 'name',
    'parent' => 0
));
foreach ($cats as $cat) {
    $childs = get_categories(array(
        'orderby' => 'name',
        'parent' => $cat->term_id,
    ));
    $link = get_category_link( $cat->term_id );
    ?>
    <li class="container list-group-item list-group-item-action" >
        <div class="row">
            <div class="col-10">
            <a href="<?php echo $link; ?>"><?php echo $cat->name; ?></a>
            </div>
            <span style="cursor: pointer;" data-toggle="collapse" href="#collapse-<?php echo $cat->term_id; ?>" class="collapsed oi oi-menu menu-icon"></span>
        </div>
    </li>
    <li class='collapse' id="collapse-<?php echo $cat->term_id; ?>">
    <?php foreach ($childs as $child) { 
        $child_link = get_category_link( $child->term_id );
        ?>
        <p class="list-group-item"><a href="<?php echo $child_link; ?>">- <?php echo $child->name ?></a></p>
    <?php } ?>
    </li>
    <?php
    }  
    ?>
    <p class="list-group-item list-group-item-action">
        <a href="/?post_type=study_abroad" >Link to SA</a>
    </p>
</ul>