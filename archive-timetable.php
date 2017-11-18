<?php
get_header();
?>
<div class="container">
    <div class="row">
        <div class="col-md-9 order-md-2">
            <div class="awm-block">
                <h5 class="awm-title cat-title">Timetables</h5>
            </div>
            <?php 
        if (have_posts()) {
        while ( have_posts() ) {
            the_post();
            include "inc/ttable-list-item.php";
        }
        } ?>
            <div class="pagin-wrapper">
                <?php include 'inc/pagination.php'; ?>
            </div>
        </div>
        <div class="col-md-3 sidebar order-md-1">
            <?php include 'sidebar.php'; ?>
        </div>
    </div>
</div>
<div>
    <?php get_footer(); ?>
</div>