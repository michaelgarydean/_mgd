<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package michael-gary-dean
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php /* mgd_post_thumbnail();*/ ?>

	<?php 
		/*
		 * Show either the "featured video" or the post's featured image if none is set.
		 */
		_mgd_featured_video_or_image( $post->ID );
	?>

	<header class="entry-header">
		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) :
			?>
			<div class="entry-meta">
			</div><!-- .entry-meta -->

		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
		the_content( sprintf(
			wp_kses(
				/* translators: %s: Name of current post. Only visible to screen readers */
				__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', '_mgd' ),
				array(
					'span' => array(
						'class' => array(),
					),
				)
			),
			get_the_title()
		) );

		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', '_mgd' ),
			'after'  => '</div>',
		) );
		?>
	</div><!-- .entry-content -->

	<!-- no entry footer please
	<footer class="entry-footer">
		<?php //_mgd_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
