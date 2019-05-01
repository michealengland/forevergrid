<?php
/**
 * Footer template.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage forevergrid
 * @since 0.0.1
 */

$copy_right_year = date( 'Y' );
?>

			<footer role="contentinfo">

				<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
					<div class="widget-area">
						<?php dynamic_sidebar( 'footer-1' ); ?>
					</div>
				<?php endif; ?>

				<?php forevergrid_social_menu( $theme_location = 'social-footer' ); ?>

				<div class="credits">
					<p class="copyright">&copy;<?php echo esc_html( $copy_right_year ); ?> Forever Grid</p>
					<?php wp_footer(); ?>
				</div>

			</footer>
		</div>
	</body>
</html>
