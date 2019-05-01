<?php
/**
 * Header template.
 *
 * @package WordPress
 * @subpackage Forever_Grid
 * @since 0.1
 * @version 0.1
 */

?>

<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=0.86, maximum-scale=3.0, minimum-scale=0.86">

	<?php
	// Check for comments.
	if ( is_singular() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	?>

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<!-- Skip to Main Content -->
	<a class="skip-link" href="#primary">Skip to main content</a>

	<header class="site-header <?php echo esc_html( get_theme_mod( 'fg_nav_position' ) ); ?>">

		<?php forevergrid_custom_logo(); ?>

		<?php if ( is_page() ) : ?>
			<nav role="navigation" class="main-menu" role="navigation" aria-label="<?php esc_attr_e( 'Main Menu', 'forevergrid' ); ?>">

				<button id="toggle" aria-expanded="false">Menu</button>

				<?php
				// Main wp_nav_menu.
				$args = array(
					'container'    => 'ul',
					'menu_id'      => 'menu',
					'container_id' => 'menu',
				);

				wp_nav_menu( $args );
				?>

			</nav>

		<?php endif; ?>

		<?php forevergrid_social_menu( $theme_location = 'social-header' ); ?>

	</header>

	<div class="content-container <?php echo esc_html( 'has-' . get_theme_mod( 'fg_nav_position' ) ); ?>">
