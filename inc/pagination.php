<?php
global $wp_query;
global $wp;
$page = get_query_var( 'paged', '1' ) == 0 ? 1 : get_query_var( 'paged', '1' );
$num_pages = $wp_query->max_num_pages;
$iters = $num_pages > 5 ? 5 : $num_pages;
$active_class = 'class="active-page"';
$url = get_next_posts_page_link();
$url = rtrim($url,"/");
$url = explode( '/', $url );
array_pop( $url );
$url = implode( '/', $url );
?>

<?php if ( $num_pages > 1 ) : ?>
<ul class="awm-pagin">
	<p>
		<?php if ( $page > 5 || $page === $num_pages ) : ?>
			<a href="<?php echo esc_html( $url.'/0' ); ?>" >最初</a>
			<span>...</span>
		<?php endif; ?>
		<?php
		for ( $i = 0; $i < $iters; $i++ ) {
			if ( $num_pages < 1 || $page < 4 ) {
				$page_num = $i + 1;
			} else {
				$page_num = $i + $page - 2;
			}

			if ( $page_num > $num_pages ) {
				break;
			}

			$class = $page === $page_num ? $active_class : '';
			$link = $url . '/' . ( $page_num );

			echo '<a href="' . esc_html( $link ) . '" ' . $class . ' >' . esc_html( $page_num ) . '</a>';
		}
		?>
		<?php if ( $num_pages > 5 ) : ?>
			<span>...</span>
			<a href="<?php echo esc_html( $url ) . '/' . esc_html( $num_pages ); ?>">最後</a>
		<?php endif; ?>
	</p>
</ul>
<?php endif; ?>
