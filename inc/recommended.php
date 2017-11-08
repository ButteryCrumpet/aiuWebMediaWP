<?php
 
$args = array(
    'numberposts' => 3,
    'post_type' => array('post', 'study_abroad'),
    'meta_key' => 'recommended',
    'meta_value' => true,
);
 
// Custom query.
$query = new WP_Query( $args );
 ?>
<div class="container">
<div>Recommended</div>

<?php
// Check that we have query results.
if ( $query->have_posts() ) {
 
    // Start looping over the query results.
    while ( $query->have_posts() ) {
 
        $query->the_post();
        
        ?>
        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
            <div class="awm-recommended" style="background-image: linear-gradient(rgba(0, 0, 0, 0.4),rgba(0, 0, 0, 0.4)),url('<?php echo get_the_post_thumbnail_url(); ?>')">    
                <h5 title="<?php the_title_attribute(); ?>">
                    <?php the_title(); ?>
                </h5>
                <p>
                    <?php echo get_the_date('F j, Y'); ?>
                </p>
            </div>
        </a>
        <?php
 
    }
 
} 
// Restore original post data.
wp_reset_postdata();
 
?>
</div>
