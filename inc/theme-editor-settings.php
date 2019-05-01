<?php
/**
 * Register colors and editor supports.
 *
 * @package WordPress
 * @subpackage forevergrid
 * @since 0.0.1
 */

?>

<?php
/**
 * Colors Located in sass-input/partials/variables.scss
 *
 * @link https://wordpress.org/gutenberg/handbook/extensibility/theme-support/
 * @author Mike England
 */
function forevergrid_setup_theme_support() {

	add_theme_support( 'editor-color-palette', array(
		array(
			'name'  => __( 'Color 1', 'forevergrid' ),
			'slug'  => 'color-1',
			'color' => '#020041',
		),
		array(
			'name'  => __( 'Color 2', 'forevergrid' ),
			'slug'  => 'color-2',
			'color' => '#170387',
		),
		array(
			'name'  => __( 'Color 3', 'forevergrid' ),
			'slug'  => 'color-3',
			'color' => '#6626C9',
		),
		array(
			'name'  => __( 'Color 4', 'forevergrid' ),
			'slug'  => 'color-4',
			'color' => '#964AE2',
		),
		array(
			'name'  => __( 'Color 5', 'forevergrid' ),
			'slug'  => 'color-5',
			'color' => '#C074F1',
		),
		array(
			'name'  => __( 'Color 6', 'forevergrid' ),
			'slug'  => 'color-6',
			'color' => '#E2A1F9',
		),
		array(
			'name'  => __( 'Dark Gray', 'forevergrid' ),
			'slug'  => '$dark-gray-1',
			'color' => '#333',
		),
		array(
			'name'  => __( 'White', 'forevergrid' ),
			'slug'  => 'white',
			'color' => '#ffffff',
		),
		array(
			'name'  => __( 'Black', 'forevergrid' ),
			'slug'  => 'black',
			'color' => '#000000',
		),
	) );

	add_theme_support( 'align-wide' );
}

add_action( 'after_setup_theme', 'forevergrid_setup_theme_support' );
