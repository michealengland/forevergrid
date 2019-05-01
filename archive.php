<?php
/**
 * Archive template.
 *
 * @package WordPress
 * @subpackage Forever_Grid
 * @since 0.1
 * @version 0.1
 */

?>
<?php get_header(); ?>

	<?php get_template_part( 'templates/modules/content', 'header' ); ?>

	<main id="primary" class="site-main" role="main">

		<?php
		if ( have_posts() ) :

			while ( have_posts() ) :
			the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/post/content', get_post_format() );

			endwhile;

			the_posts_pagination( array(
				'prev_text'          => '<span class="screen-reader-text">' . __( 'Previous page', 'forevergrid' ) . '</span>',
				'next_text'          => '<span class="screen-reader-text">' . __( 'Next page', 'forevergrid' ) . '</span>',
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'forevergrid' ) . ' </span>',
			) );

		else :

			get_template_part( 'template-parts/post/content', 'none' );

		endif;
		?>

		</main><!-- #main -->
	<?php get_sidebar(); ?>
</div><!-- .wrap -->

<?php get_footer(); ?>
