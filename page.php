<?php
/**
 * Template for displaying page content.
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
	<?php
	if ( have_posts() ) {
		while ( have_posts() ) {
		the_post();

		the_content();

		}
	}
	?>
</main><!-- #primary -->

<?php forevergrid_social_menu( $theme_location = 'social-sidebar' ); ?>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
