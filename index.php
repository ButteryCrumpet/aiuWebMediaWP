<?php
get_header();
?>
<div class="container">
    <div class="row">
        <div class="col-md-9 order-md-2">
        <?php if ('study_abroad' === get_query_var('post_type')) {
            render_location_select(get_post());
        } ?>
            <?php if (have_posts()) :
        while ( have_posts() ) : the_post();
    ?> 
            <section class="awm-block article-list-item">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-md-4">
                            <a href="<?php echo get_the_permalink(); ?>">
                                <img alt="image" class="" src="<?php echo get_the_post_thumbnail_url(); ?>">
                            </a>
                            </div>
                            <div class="col-12 col-md-8 ml-auto pt-5 pt-md-0">
                                <h3>
                                <a href="<?php echo get_the_permalink(); ?>"><?php echo trim_length(get_the_title()); ?></a>
                                </h3>
                                <p class="mt-4">
                                    <?php render_terms_list(get_the_ID()); ?>
                                </p>
                                <p class="text-h3">
                                    <?php the_excerpt(); ?>
                                </p>
                            </div>
                        </div>
                    </div>
            </section>
            <?php endwhile; endif; ?>
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