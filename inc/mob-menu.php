<ul class="list-group">
<?php 
$cats = get_categories(array(
    'orderby' => 'name',
    'parent' => 0
));
$prefix = 'mob';
foreach ($cats as $cat) {
    $childs = get_categories(array(
        'orderby' => 'name',
        'parent' => $cat->term_id,
    ));
    $link = get_category_link( $cat->term_id );
    ?>
    <li class="container list-group-item list-group-item-action" >
        <div class="row align-items-center">
            <div class="col-10">
            <a href="<?php echo $link; ?>"><?php echo $cat->name; ?></a>
            </div>
            <span style="cursor: pointer;" data-toggle="collapse" href="#<?php echo $prefix . '-collapse-' . $cat->term_id; ?>" class="collapsed fa fa-angle-double-down  fa-lg menu-icon"></span>
        </div>
    </li>
    <li class='collapse' id="<?php echo $prefix . '-collapse-' . $cat->term_id; ?>">
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
        <a href="/?post_type=study_abroad" >Study Abroad</a>
    </p>
    <?php 
    $otherID = (get_current_blog_id() === 2) ? 3 : 2; 
    $otherlang = ($otherID == 3) ? 'Japanese Site' : '英語のサイト'; 
    ?>
    <p class="list-group-item list-group-item-action">
        <i class="fa fa-globe" ></i>
        <a href="<?php echo get_site_url($otherID)?>" ><?php echo $otherlang ?></a>
    </p>
</ul>