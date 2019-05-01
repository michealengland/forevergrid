<?php
/**
 * Forever Grid functions and definitions
 *
 * @package WordPress
 * @subpackage forevergrid
 * @since 0.0.1
 */

/**
 * Forever Grid only works in WordPress 4.7 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.7-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
	return;
}

/**
 * Get Theme Customization
 */
// Detect if Template Files Exists.
$located = locate_template( '/inc/theme-customizer.php' );
if ( ! empty( $located ) ) {
	get_template_part( '/inc/theme', 'customizer' );
}

/**
 * Get Theme Supports
 */
// Detect if Template Files Exists.
$located = locate_template( '/inc/theme-support.php' );
if ( ! empty( $located ) ) {
	get_template_part( '/inc/theme', 'support' );

	// Run Forever Grid theme setup.
	if ( function_exists( 'forevergrid_theme_setup' ) ) {
		forevergrid_theme_setup();
	}
}

/**
 * Enqueue styles.
 *
 * @author Mike England
 */
function forevergrid_enqueue_style() {

	// load parent stylesheet first if this is a child theme.
	if ( is_child_theme() ) {
		wp_enqueue_style( 'parent-stylesheet', trailingslashit( get_template_directory_uri() ) . 'style.css', false );
	}

	wp_enqueue_style( 'forevergrid-style', get_stylesheet_uri(), array(), null, 'all' );
}

add_action( 'wp_enqueue_scripts', 'forevergrid_enqueue_style' );

/**
 * SVG icons functions and filters.
 */
require get_parent_theme_file_path( '/inc/icon-functions.php' );

/**
 * Get Theme Editor Settings
 */
$located = locate_template( '/inc/theme-editor-settings.php' );

if ( ! empty( $located ) ) {
	get_template_part( '/inc/theme-editor-settings' );
}

/**
 * Register Theme Sidebars
 *
 * @author Mike England
 */
function forevergrid_widgets_init() {

	register_sidebar( array(
		'name'          => __( 'Main Sidebar', 'forevergrid' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Widgets in this area will be shown on all pages.', 'forevergrid' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Blog Sidebar', 'forevergrid' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Widgets in this area will be shown on all posts.', 'forevergrid' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Widget Area', 'forevergrid' ),
		'id'            => 'footer-1',
		'description'   => __( 'Widgets in this area will be shown into the content area of the 404 page.', 'forevergrid' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( '404 Content Widget Area', 'forevergrid' ),
		'id'            => 'fg_404',
		'description'   => __( 'Widgets in this area will be shown into the content area of the 404 page.', 'forevergrid' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'forevergrid_widgets_init' );

/**
 * Enqueue Google Fonts
 */
function google_fonts() {

	wp_register_style( 'google_fonts', 'https://fonts.googleapis.com/css?family=Muli:400,400i,600,600i,700,700i', array(), null );

}
add_action( 'wp_enqueue_scripts', 'google_fonts' );

/**
 * Logo, Site Title, and Tagline.
 */
function forevergrid_custom_logo() {
	?>
	<div class="site-branding">

	<?php
	if ( function_exists( 'the_custom_logo' ) ) :
		the_custom_logo();
	endif;
	?>

	<?php if ( display_header_text() === true ) : ?>
		<h1><?php echo esc_html( get_bloginfo( 'name' ) ); ?></h1>
		<p><?php echo esc_html( get_bloginfo( 'description' ) ); ?></p>
	<?php endif; ?>

	</div>
<?php
}

/**
 * Add custom social menu with icon support.
 *
 * @since Forever Grid 0.1
 *
 * @param string $theme_location Accepts a string that contains the id for a menu.
 * @author Mike England
 */
function forevergrid_social_menu( $theme_location ) {

	if ( has_nav_menu( $theme_location ) ) :

		if ( get_theme_mod( 'fg_sidebar_social_position' ) && 'social-sidebar' === $theme_location ) {
			$position_class = ' ' . get_theme_mod( 'fg_sidebar_social_position' );
		} else {
			$position_class = '';
		}
	?>

		<nav class="social-navigation <?php echo esc_html( $theme_location . $position_class ); ?>" role="navigation" aria-label="<?php esc_attr_e( 'Social Links Menu', 'forevergrid' ); ?>">
			<?php
				wp_nav_menu(
					array(
						'theme_location' => $theme_location,
						'menu_class'     => 'social-links-menu',
						'container'      => 'false',
						'depth'          => 1,
						'link_before'    => '<span class="screen-reader-text">',
						'link_after'     => '</span>' . forevergrid_get_svg( array( 'icon' => 'chain' ) ),
					)
				);
			?>
		</nav><!-- .social-navigation -->

	<?php
	endif;
}
