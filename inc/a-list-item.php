<section class="awm-block article-list-item">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-4 d-flex align-items-center justify-content-center">
                <a href="<?php echo get_the_permalink(); ?>">
                    <img alt="image" class="" src="<?php echo get_the_post_thumbnail_url(null, 'medium'); ?>">
                </a>
            </div>
            <div class="col-12 col-md-8 ml-auto">
                <h4 class="awm-title">
                    <a href="<?php echo get_the_permalink(); ?>">
                        <?php echo get_the_title(); ?>
                    </a>
                </h4>
                <p>
                    <?php render_terms_list(get_the_ID()); ?>
                </p>
                <p class="text-h3">
                    <?php echo trim_length(get_the_excerpt(), 100); ?>
                </p>
                <div class="awm-read-more">
                    <a href="<?php echo get_the_permalink(); ?>"><?php echo awm_tr('Read More'); ?> <span class="fa fa-angle-double-right" aria-hidden="true"></span></a>
                </div>
            </div>
        </div>
    </div>
</section>