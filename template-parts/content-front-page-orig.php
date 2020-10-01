<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package michael-gary-dean
 */

?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<?php _mgd_post_thumbnail(); ?>

		<header class="entry-header">
			<a href="<?php the_permalink(); ?>"><?php the_title( '<h1 class="entry-title-preview">', '</h1>' ); ?></a>
		</header><!-- .entry-header -->

		<div class="archive-excerpt"><?php the_excerpt(); ?></div>

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
	</article><!-- #post-<?php the_ID(); ?> -->