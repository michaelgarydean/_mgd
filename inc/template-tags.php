<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package michael-gary-dean
 */

/**
 * Prints HTML with meta information for the current post-date/time.
 */
if ( ! function_exists( '_mgd_posted_on' ) ) :

	function _mgd_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( 'Posted on %s', 'post date', '_mgd' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.

	}
endif;


/**
 * Prints HTML with meta information for the current author.
 */
if ( ! function_exists( '_mgd_posted_by' ) ) :

	function _mgd_posted_by() {
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( 'by %s', 'post author', '_mgd' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

	}
endif;

/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
if ( ! function_exists( '_mgd_entry_footer' ) ) :

	function _mgd_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', '_mgd' ) );

			/*
			 * @TODO
			 * This should be a theme option.
			 */
			if ( $categories_list ) {
				/* translators: 1: list of categories. */
				printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', '_mgd' ) . '</span>', $categories_list ); // WPCS: XSS OK.
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', '_mgd' ) );


			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', '_mgd' ) . '</span>', $tags_list ); // WPCS: XSS OK.
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', '_mgd' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				)
			);
			echo '</span>';
		}

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
	}
endif;

/**
 * Displays an optional post thumbnail.
 *
 * Wraps the post thumbnail in an anchor element on index views, or a div
 * element when on single views.
 */
if ( ! function_exists( '_mgd_post_thumbnail' ) ) :

	function _mgd_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
			?>

			<div class="post-thumbnail">
				<?php the_post_thumbnail(); ?>
			</div><!-- .post-thumbnail -->

		<?php else : ?>

		<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
			<?php
			the_post_thumbnail( 'post-thumbnail', array(
				'alt' => the_title_attribute( array(
					'echo' => false,
				) ),
			) );
			?>
		</a>

		<?php
		endif; // End is_singular().
	}
endif;

/**
 * Displays an optional post thumbnail.
 *
 * Wraps the post thumbnail in an anchor element on index views, or a div
 * element when on single views.
 */
if ( ! function_exists( '_mgd_post_preview_header(' ) ) :

	function _mgd_post_preview_header() {
		the_title( '<h1 class="entry-title"><a href="' . get_the_permalink( ) . '">', '</a></h1>' );
		?>
		<div class="entry-taxonomies">
			<?php
			/*
			 * @TODO - Theme customizer options
			 * Is the option in the theme customizer set? If not, default to post excerpt.
			 * If it is, which option has been selection? Excerpt or category?
			 * If the category has been selected, whats the current category of this archive?
			 * From the archive that's currently being shown, get the terms and display them.
			 */

			/*
			 * For now, we'll just code it direct. Show the categories for the projects posts.
			 */

			//Only show terms on the front page.
			//if ( is_home() && is_front_page() ) :

				//Get term children of the 'projects' term in the 'category' taxonomy for current post
				$queried_object_term = get_queried_object( 'term' );
				$taxonomy_of_current_page = $queried_object_term->taxonomy;
				$term_id_of_current_page = $queried_object_term->term_id;
				$term_parent = $queried_object_term->term_id;

				/*
				 * Get all the terms of the current post
				 */
				$terms_of_current_post = get_the_terms( get_the_ID(), $taxonomy_of_current_page );

				if( !is_wp_error( $terms_of_current_post) ) :
					/*
					 * For each term, if the term's parent is the same term used by the queried object, then 
					 * print out the current term in the loop.
					 */
					$num_terms = count( $terms_of_current_post );
					$index = 0;

					echo( '<ul class="preview-post-terms-list">' );

					foreach( $terms_of_current_post as $term_of_current_post ) {

						if( $term_of_current_post->parent == $term_id_of_current_page ) :

							//Print out the child terms for the post
							echo( 
								'<li>' . get_term( $term_of_current_post, $taxonomy_of_current_page )->name . '</li>'
							);
							
						endif;

					}

					echo( '</ul>' );

				endif;

			// else:
			// 	the_excerpt();
			// endif;
			/*
			 */

			?>
		</div><!-- .entry-taxonomies -->
		<?php
	}
endif;

/**
 * Shim for sites older than 5.2.
 *
 * @link https://core.trac.wordpress.org/ticket/12563
 */
if ( ! function_exists( 'wp_body_open' ) ) :

	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
endif;

/*
 * Embed a full width video, if one has been saved using the Featured Video metabox in the post.
 */
if ( ! function_exists( '_mgd_featured_video_or_image' ) ) :

	function _mgd_featured_video_or_image( $post_id) {

			$featured_video_url = get_post_meta( $post_id, "mgd_featured_video_url", true );

			/*
			 * Show either the "feature video" or the post's featured image if none is set.
			 */
			if( ! empty( $featured_video_url ) ) :
				global $wp_embed;
				?>

				<div class="featured-video-wrapper">

				<?php
				echo $wp_embed->run_shortcode( '[embed]' . $featured_video_url . '[/embed]' );
				?>

				</div>

				<?php
			else:
				_mgd_post_thumbnail();
			endif;
	}

endif;
