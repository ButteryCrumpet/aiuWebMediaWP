<?php
get_header();
?>
<div class="container">
    <div class="row">
        <div class="col-md-9 order-md-2">
        <?php if (is_category()) {
            ?>
            <div class="awm-block">
                <h5 class="awm-title cat-title"><?php single_cat_title(); ?></h5>
            </div>
            <?php 
        }
        if ('study_abroad' === get_query_var('post_type')) {
            ?>
            <div class="awm-block">
                <h5 class="awm-title cat-title"><?php echo awm_tr('Study Abroad'); ?></h5>
            </div>
            <?php
            include "inc/study-abroad-search.php";
        }
        if (have_posts()) {
        while ( have_posts() ) {
            the_post();
            include "inc/a-list-item.php";
        }
        ?>
            <div class="pagin-wrapper">
                <?php include 'inc/pagination.php'; ?>
            </div>
        <?php } else {?>
            <p><?php echo awm_tr('No Posts Found'); ?></p>
        <?php } ?>
        </div>
        <div class="col-md-3 sidebar order-md-1">
            <?php include 'sidebar.php'; ?>
        </div>
    </div>
</div>
<div>
    <?php get_footer(); ?>
</div>