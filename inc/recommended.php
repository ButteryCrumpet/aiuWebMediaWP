<?php
 
$args = array(
    // Arguments for your query.
);
 
// Custom query.
$query = new WP_Query( $args );
 
// Check that we have query results.
if ( $query->have_posts() ) {
 
    // Start looping over the query results.
    while ( $query->have_posts() ) {
 
        $query->the_post();
 
        ?>
        <div class="awm-recommended">
            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                <?php post_thumbnail( 'thumbnail' );?>
            </a>
            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                <?php the_title(); ?>
            </a>
        </div>
        <?php
 
    }
 
}
 
// Restore original post data.
wp_reset_postdata();
 
?>