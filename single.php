<?php
get_header();
?>
<div class="container">
  <div class="row">
    <div class="article-single col-md-9 order-md-2">
      <?php if (have_posts()) :
            while ( have_posts() ) : the_post();
        ?>
      <div class="awm-article">
        <div class="a-list-content">
          <h3 class="article-title">
            <?php echo get_the_title(); ?>
          </h3>
          <div class="awm-flex">
          <div class="cat-wrapper">
            <?php render_terms_list(get_the_ID()); ?>
          </div>
          <div class="awm-social-buttons">
            <div class="fb-share-button" data-size="large" data-href="<?php echo get_the_permalink(); ?>" data-layout="button_count" data-size="small"
              data-mobile-iframe="true">
              <a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse">Share</a>
            </div>
            <a class="twitter-share-button" data-size="large" href="https://twitter.com/intent/tweet">Tweet</a>
          </div>
          </div>
          <div class="detail-wrapper awm-flex">
            <div>
            <p>Author:
              <?php echo get_field('author'); ?>
            </p>
            <p>Photographer:
              <?php echo get_field('author'); ?>
            </p>
            </div>
            <p>
              <?php echo get_the_date(); ?>
            </p>
          </div>
          <p>
            <?php the_content(); ?>
          </p>
          <?php render_tags_list(get_the_ID()); ?>
        </div>
        <div class="fb-comments" data-href="<?php echo get_the_permalink(); ?>" data-numposts="5"></div>
      </div>
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