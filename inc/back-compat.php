<?php
/**
 * Forever Grid back compat functionality
 *
 * Prevents Forever Grid from running on WordPress versions prior to 4.7,
 * since this theme is not meant to be backward compatible beyond that and
 * relies on many newer functions and markup changes introduced in 4.7.
 *
 * @package WordPress
 * @subpackage Forever_Grid
 * @since Forever Grid 0.1
 */

/**
 * Prevent switching to Forever Grid on old versions of WordPress.
 *
 * Switches to the default theme.
 *
 * @since Forever Grid 0.1
 * @author Mike England
 */
function forevergrid_switch_theme() {
	switch_theme( WP_DEFAULT_THEME );
	unset( $_GET['activated'] );
	add_action( 'admin_notices', 'forevergrid_upgrade_notice' );
}
add_action( 'after_switch_theme', 'forevergrid_switch_theme' );

/**
 * Adds a message for unsuccessful theme switch.
 *
 * Prints an update nag after an unsuccessful attempt to switch to
 * Forever Grid on WordPress versions prior to 4.7.
 *
 * @since Forever Grid 0.1
 *
 * @global string $wp_version WordPress version.
 * @author Mike England
 */
function forevergrid_upgrade_notice() {
	$message = sprintf( __( 'Forever Grid requires at least WordPress version 4.7. You are running version %s. Please upgrade and try again.', 'forevergrid' ), $GLOBALS['wp_version'] );
	printf( '<div class="error"><p>%s</p></div>', $message );
}

/**
 * Prevents the Customizer from being loaded on WordPress versions prior to 4.7.
 *
 * @since Forever Grid 0.1
 *
 * @global string $wp_version WordPress version.
 * @author Mike England
 */
function forevergrid_customize() {
	wp_die(
		sprintf( __( 'Forever Grid requires at least WordPress version 4.7. You are running version %s. Please upgrade and try again.', 'forevergrid' ), $GLOBALS['wp_version'] ), '', array(
			'back_link' => true,
		)
	);
}
add_action( 'load-customize.php', 'forevergrid_customize' );

/**
 * Prevents the Theme Preview from being loaded on WordPress versions prior to 4.7.
 *
 * @since Forever Grid 0.1
 *
 * @global string $wp_version WordPress version.
 * @author Mike England
 */
function forevergrid_preview() {
	if ( isset( $_GET['preview'] ) ) {
		wp_die( sprintf( __( 'Forever Grid requires at least WordPress version 4.7. You are running version %s. Please upgrade and try again.', 'forevergrid' ), $GLOBALS['wp_version'] ) );
	}
}
add_action( 'template_redirect', 'forevergrid_preview' );
