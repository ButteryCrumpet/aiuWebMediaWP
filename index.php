<?php
get_header();
?>
<div id="mainBody">
    <div id="sidebar"><?php include 'sidebar.php'; ?></div>
    <div id="main">
    <?php if (have_posts()) :
        while ( have_posts() ) : the_post();
    ?>
    <div class="article-list-item">
        <a href="<?php echo the_permalink(); ?>" >
            <div class='a-list-thumb' ><?php the_post_thumbnail('medium'); ?></div>
            <div class="a-list-content">
            <h4><?php the_title(); ?></h4>
            <?php render_terms_list(get_the_ID()); ?>
            <p><?php the_excerpt(); ?></p>
        </a>
        </div>
    </div>
    <?php endwhile; endif; ?>
    </div>
</div>
<div><?php get_footer(); ?></div>