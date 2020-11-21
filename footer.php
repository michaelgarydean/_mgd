<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package michael-gary-dean
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		<div class="footer-top-spacer">
		</div>

		<!--Site title and tagline-->
		<div class="site-info">
			<div id="footer-site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></div>
			<div id="footer-description"><?php bloginfo( 'description' ); ?></div>
		</div><!-- .site-info -->

		<!--main widget area-->
		<div class="top-widget-area">
			<?php if ( is_active_sidebar( 'top-footer-widget-1' ) ) : ?>
				<div class="widget top-footer-widget-1">
					<?php dynamic_sidebar( 'top-footer-widget-1' ); ?>
				</div><!-- .widget-area -->
			<?php endif; ?>

			<?php if ( is_active_sidebar( 'top-footer-widget-2' ) ) : ?>
				<div class="widget top-footer-widget-2">
					<?php dynamic_sidebar( 'top-footer-widget-2' ); ?>
				</div><!-- .widget-area -->
			<?php endif; ?>
		</div><!-- .footer-widgets-wrapper -->

		<!--horizontal line-->
		<div class="horizontal-line">
			<hr/>
		</div>

		<!--bottom widget-->
		<div class="bottom-widget-area">
			<?php if ( is_active_sidebar( 'bottom-footer-widget' ) ) : ?>
				<div class="widget bottom-footer-widget">
					<?php dynamic_sidebar( 'bottom-footer-widget' ); ?>
				</div><!-- .widget-area -->
			<?php endif; ?>
		</div>

		<div class="footer-bottom-spacer">
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
