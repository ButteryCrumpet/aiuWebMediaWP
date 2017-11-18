<section class="awm-block article-list-item">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-4">
                <a href="<?php echo get_the_permalink(); ?>">
                    <img alt="image" class="" src="<?php echo get_the_post_thumbnail_url(null, 'medium'); ?>">
                </a>
            </div>
            <div class="col-12 col-md-8 ml-auto">
                <h3 class="awm-title">
                    <a href="<?php echo get_the_permalink(); ?>">
                        <?php echo get_the_title(); ?>
                    </a>
                </h3>
                <p>
                    <?php render_terms_list(get_the_ID()); ?>
                </p>
                <p class="text-h3">
                    <?php echo awm_get_excerpt(200); ?>
                </p>
                <div class="awm-read-more">
                    <a href="<?php echo get_the_permalink(); ?>">Read More <span class="fa fa-angle-double-right" aria-hidden="true"></span></a>
                </div>
            </div>
        </div>
    </div>
</section>