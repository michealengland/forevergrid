<?php
/**
 * Template for displaying a post.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Forever_Grid
 * @since 0.1
 * @version 0.1
 */

?>

<?php get_header(); ?>

<main id="primary" class="site-main" role="main">

	<?php get_template_part( 'templates/modules/content', 'header' ); ?>

	<?php
	if ( have_posts() ) {
		while ( have_posts() ) {
			the_post();

			the_content();

		}
	}
	?>
</main><!-- #primary -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>
