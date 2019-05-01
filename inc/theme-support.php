<?php
/**
 * Theme supports.
 *
 * @package WordPress
 * @subpackage forevergrid
 * @since 0.0.1
 */

?>

<?php
/**
 * Setup theme.
 *
 * @author Mike England <mike.england@webdevstudios.com>
 */
function forevergrid_theme_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/forevergrid
	 * If you're building a theme based on Forever Grid, use a find and replace
	 * to change 'forevergrid' to the name of your theme in all the template files.
	 */

	load_theme_textdomain( 'forevergrid' );

	/*
	* Let WordPress manage the document title.
	* By adding theme support, we declare that this theme does not use a
	* hard-coded <title> tag in the document head, and expect WordPress to
	* provide it for us.
	*/

	add_theme_support( 'title-tag' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

/*
 * Enable support for Post Thumbnails on posts and pages.
 *
 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
 */

	add_theme_support( 'post-thumbnails' );
	add_image_size( 'forevergrid-featured-image', 1800, 1200, true );
	add_image_size( 'forevergrid-thumbnail-avatar', 80, 80, true );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'top'            => __( 'Top Menu', 'forevergrid' ),
		'social-header'  => __( 'Header Social Menu', 'forevergrid' ),
		'social-sidebar' => __( 'Sidbar Social Menu', 'forevergrid' ),
		'social-footer'  => __( 'Footer Social Menu', 'forevergrid' ),
	) );

	/*
	* Switch default core markup for search form, comment form, and comments
	* to output valid HTML5.
	*/
	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	* Enable support for Post Formats.
	*
	* See: https://codex.wordpress.org/Post_Formats
	*/
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
		'gallery',
		'audio',
	) );

	/**
	 * Add Theme Support for Custom Logo to Customizer
	*/
	add_theme_support( 'custom-logo', array(
		'height'      => 100,
		'width'       => 100,
		'flex-height' => true,
		'flex-width'  => true,
		'header-text' => array( 'site-title', 'site-description' ),
	) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

}

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... and
 * a 'Continue reading' link.
 *
 * @since Forever Grid 0.1
 *
 * @parameter string $link Link to single post/page.
 * @return string 'Continue reading' link prepended with an ellipsis.
 * @author Mike England
 */
function forevergrid_excerpt_more( $link ) {
	if ( is_admin() ) {
		return $link;
	}

	$link = sprintf(
		'<p class="link-more"><a href="%1$s" class="more-link">%2$s</a></p>',
		esc_url( get_permalink( get_the_ID() ) ),
		/* translators: %s: Name of current post */
		sprintf( __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'forevergrid' ), get_the_title( get_the_ID() ) )
	);
	return ' &hellip; ' . $link;
}
add_filter( 'excerpt_more', 'forevergrid_excerpt_more' );


/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since Forever Grid 0.1
 * @author Mike England
 */
function forevergrid_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}

add_action( 'wp_head', 'forevergrid_javascript_detection', 0 );


/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 *
 * @author Mike England
 */
function forevergrid_pingback_header() {

	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">' . "\n", esc_html( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'forevergrid_pingback_header' );

/**
 * Enque A11y Mobile Toggle JS.
 *
 * @version Forever Grid 0.0.1
 * @author Mike England
 */
function my_custom_script_load() {

	wp_enqueue_script( 'menu-toggle-js', get_theme_file_uri( '/js/menu-toggle.js' ), array(), false, true );

}

add_action( 'wp_enqueue_scripts', 'my_custom_script_load' );



/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for content images.
 *
 * @since Forever Grid 0.1
 *
 * @param string $sizes A source size value for use in a 'sizes' attribute.
 * @param array  $size  Image size. Accepts an array of width and height
 * values in pixels (in that order).
 * @return string A source size value for use in a content image 'sizes' attribute.
 * @author Mike England
 */
function forevergrid_content_image_sizes_attr( $sizes, $size ) {

	$width = $size[0];

	if ( 740 <= $width ) {
		$sizes = '(max-width: 706px) 89vw, (max-width: 767px) 82vw, 740px';
	}

	if ( is_active_sidebar( 'sidebar-1' ) || is_archive() || is_search() || is_home() || is_page() ) {
		if ( ! ( is_page() && 'one-column' === get_theme_mod( 'page_options' ) ) && 767 <= $width ) {
			$sizes = '(max-width: 767px) 89vw, (max-width: 1000px) 54vw, (max-width: 1071px) 543px, 580px';
		}
	}

	return $sizes;
}
add_filter( 'wp_calculate_image_sizes', 'forevergrid_content_image_sizes_attr', 10, 2 );

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for post thumbnails.
 *
 * @since Forever Grid 0.1
 *
 * @param array $attr       Attributes for the image markup.
 * @param int   $attachment Image attachment ID.
 * @param array $size       Registered image size or flat array of height and width dimensions.
 * @return array The filtered attributes for the image markup.
 * @author Mike England
 */
function forevergrid_post_thumbnail_sizes_attr( $attr, $attachment, $size ) {

	if ( is_archive() || is_search() || is_home() ) {
		$attr['sizes'] = '(max-width: 767px) 89vw, (max-width: 1000px) 54vw, (max-width: 1071px) 543px, 580px';
	} else {
		$attr['sizes'] = '100vw';
	}

	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'forevergrid_post_thumbnail_sizes_attr', 10, 3 );

