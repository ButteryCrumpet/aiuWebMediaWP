<?php
get_header();
?>
<div class="container">
    <div class="row">
        <div class="article-single col-md-9 order-md-2 awm-block">
            <?php if (have_posts()) :
            while ( have_posts() ) : the_post();
        ?>
            <p>
                <?php the_content(); ?>
            </p>
            <?php endwhile; endif; ?>
        </div>
        <div class="col-md-3 sidebar order-md-1">
            <?php include 'sidebar.php'; ?>
        </div>
    </div>
</div>
<div>
    <?php get_footer(); ?>
</div>