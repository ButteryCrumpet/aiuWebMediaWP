<?php
get_header();
?>
<div id="mainBody">
    <div id="sidebar"><?php include 'sidebar.php'; ?></div>
    <div id="main">
    <?php if (have_posts()) :
        while ( have_posts() ) : the_post();
        if ('study_abroad' === get_post_type(get_the_id())) {
            render_location_select(get_post());
        }
    ?>
    <div class="article-list-item">
            <div class="a-list-content">
            <h4><?php the_title(); ?></h4>
            <?php render_terms_list(get_the_ID()); ?>
            <p><?php the_content(); ?></p>
        </div>
    </div>
    <?php endwhile; endif; ?>
    </div>
<div><?php get_footer(); ?></div>