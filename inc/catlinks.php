<ul class="list-group">
    <p class="list-group-item list-group-item-action">
        <i class="fa fa-home" aria-hidden="true"></i>
        <a href="<?php echo get_home_url(); ?>" ><?php echo awm_tr('Home'); ?></a>
    </p>
<?php 
$cats = get_categories(array(
    'orderby' => 'name',
    'parent' => 0
));
$prefix = 'cat';
foreach ($cats as $cat) {
    $childs = get_categories(array(
        'orderby' => 'name',
        'parent' => $cat->term_id,
    ));
    $link = get_category_link( $cat->term_id );
    ?>
    <li style="border-color: <?php //echo get_field('color', $cat); ?>;" class="container list-group-item list-group-item-action ribbon-left" >
        <div class="row align-items-center">
            <div class="col-10">
            <a href="<?php echo $link; ?>"><?php echo $cat->name; ?></a>
            </div>
            <span style="cursor: pointer;" data-toggle="collapse" href="#<?php echo $prefix . '-collapse-' . $cat->term_id; ?>" class="collapsed fa fa-angle-double-down fa-lg menu-icon"></span>
        </div>
    </li>
    <li class='collapse' id="<?php echo $prefix . '-collapse-' . $cat->term_id; ?>">
    <?php foreach ($childs as $child) { 
        $child_link = get_category_link( $child->term_id );
        ?>
        <p style="border-color: <?php //echo get_field('color', $chid); ?>;" class="ribbon-left list-group-item"><a href="<?php echo $child_link; ?>">- <?php echo $child->name ?></a></p>
    <?php } ?>
    </li>
    <?php
    }  
    ?>
    <p class="list-group-item list-group-item-action">
        <a href="<?php echo get_post_type_archive_link('study_abroad'); ?>" >
            <?php echo awm_tr('Study Abroad'); ?>
        </a>
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