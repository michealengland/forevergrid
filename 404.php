<?php
/**
 * 404 template.
 *
 * @package WordPress
 * @subpackage Forever_Grid
 * @since 0.1
 * @version 0.1
 */

?>

<?php get_header(); ?>

<h1>404, Content not found.</h1>

<?php
if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<?php if ( is_page() ) : ?>

	<aside id="secondary" class="widget-area" role="complementary">
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</aside><!-- #secondary -->

<?php elseif ( is_single() ) : ?>

	<aside id="secondary" class="widget-area" role="complementary">
		<?php dynamic_sidebar( 'sidebar-2' ); ?>
	</aside><!-- #secondary -->

<?php endif; ?>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
