<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package michael-gary-dean
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'post-previews' ); ?>>

	<?php _mgd_post_thumbnail(); ?>

	<div class="post-preview-container">
	<header class="entry-header">
		<?php _mgd_post_preview_header(); ?>
	</header><!-- .entry-header -->

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php
			edit_post_link(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Edit <span class="screen-reader-text">%s</span>', '_mgd' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				),
				'<span class="edit-link">',
				'</span>'
			);
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>

	</div><!--post-preview-container-->
</article><!-- #post-<?php the_ID(); ?> -->
