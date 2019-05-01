<?php
/**
 * Theme customizer settings.
 *
 * @package WordPress
 * @subpackage forevergrid
 * @since 0.0.1
 */

?>

<?php
/**
 * Register theme customizer settings.
 *
 * @author Mike England
 * @parameter $wp_customize = array();
 */
function forevergrid_customize_register( $wp_customize ) {

	/**
	 * Enqueue Options Panel
	 */
	$wp_customize->add_section( 'fg_enqueue_section', array(
		'title'       => __( 'Enqueue Options' ),
		'description' => '',
		'priority'    => 20,
		'capability'  => 'edit_theme_options',
	) );

	// Disable WordPress emojis.
	$wp_customize->add_setting( 'fg_emoji_disable', array(
		'default'           => '',
		'sanitize_callback' => '',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'fg_emoji_disable', array(
		'type'        => 'checkbox',
		'section'     => 'fg_enqueue_section', // Required, core or custom.
		'label'       => __( 'Disable WP Emojis' ),
		'description' => __( 'Enabling this remove emoji support and slightly provide a slight speed increase.' ),
		'input_attrs' => array(
			'class'       => 'my-custom-class-for-js',
			'style'       => 'border: 1px solid #900',
			'placeholder' => '',
		),
	) );

	/**
	 * Styling Options Panel
	 */
	$wp_customize->add_section( 'fg_styling_section', array(
		'title'       => __( 'Appearance' ),
		'description' => __( 'Customize the appearance of this.' ),
		'capability'  => 'edit_theme_options',
	) );

	// Display site description.
	$wp_customize->add_setting( 'fg_nav_position', array(
		'default'           => 'fixed',
		'sanitize_callback' => '',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'fg_nav_position', array(
		'type'        => 'radio',
		'section'     => 'fg_styling_section', // Add a default or your own section.
		'label'       => __( 'Nav Position' ),
		'description' => __( 'Choose how the nav works.' ),
		'choices'     => array(
			'fixed'  => __( 'Fixed Position' ),
			'normal' => __( 'Relative' ),
		),
	) );

	// Sidebar social media position.
	$wp_customize->add_setting( 'fg_sidebar_social_position', array(
		'default'           => 'left',
		'sanitize_callback' => '',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'fg_sidebar_social_position', array(
		'type'        => 'radio',
		'section'     => 'fg_styling_section', // Add a default or your own section.
		'label'       => __( 'Social Sidebar Position' ),
		'description' => __( 'Choose social sidebar position.' ),
		'choices'     => array(
			'left'  => __( 'Left' ),
			'right' => __( 'Right' ),
		),
	) );

	/**
	 * Footer Options Panel
	 */
	$wp_customize->add_section( 'fg_footer_section', array(
		'title'       => __( 'Footer' ),
		'description' => __( 'Configure options for the footer area.' ),
		'capability'  => 'edit_theme_options',
	) );
}

add_action( 'customize_register', 'forevergrid_customize_register' );

/**
 * Disable the emoji's - Functionality Provided by
 */
if ( get_theme_mod( 'fg_emoji_disable' ) === true ) {

	add_action( 'init', 'disable_emojis' );

	/**
	 * Disable WordPress emojis.
	 *
	 * @author Mike England
	 */
	function disable_emojis() {
		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
		remove_action( 'wp_print_styles', 'print_emoji_styles' );
		remove_action( 'admin_print_styles', 'print_emoji_styles' );
	}
}
