<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package michael-gary-dean
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php
		/*
		 * Get posts from a category selected in the customizer.
		 */
		$front_page_categories = get_theme_mod('_mgd_category_for_posts_on_front_page');

		//If a category has been set, then filter the posts. Otherwise ust get everything.
		if(isset($front_page_categories)) {
			query_posts( array ( 'category_name' => $front_page_categories, 'posts_per_page' => -1 ) );
		}

		//The loop
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'front-page' );

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
