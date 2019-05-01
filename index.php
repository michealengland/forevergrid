<?php
/**
 * Index template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Forever_Grid
 * @since 0.1
 * @version 0.1
 */

get_header();

if ( have_posts() ) :

	/* Start the Loop */
	while ( have_posts() ) :
	the_post();

	/*
	* Include the Post-Format-specific template for the content.
	* If you want to override this in a child theme, then include a file
	* called content-___.php (where ___ is the Post Format name) and that will be used instead.
	*/
	if ( is_front_page() ) {

		the_content();

	} elseif ( is_home() && ! is_front_page() ) {

		get_template_part( 'templates/post/post', 'content' );

	} elseif ( is_archive() ) {

		echo '<h1>ARCHIVE PAGE</h1>';

	} elseif ( is_tax() ) {

		echo '<h1>TAXONOMY PAGE</h1>';

	} elseif ( is_single() ) {

		echo '<h1>SINGLE POST</h1>';

	} elseif ( is_search() ) {

		echo '<h1>SEARCH POST</h1>';

	}

endwhile;

the_posts_pagination( array(
	'prev_text'          => '<span class="screen-reader-text">' . __( 'Previous page', 'forevergrid' ) . '</span>',
	'next_text'          => '<span class="screen-reader-text">' . __( 'Next page', 'forevergrid' ) . '</span>',
	'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'forevergrid' ) . ' </span>',
) );

else :

	get_template_part( 'template-parts/post/content', 'none' );

endif;

get_sidebar();

get_footer();
