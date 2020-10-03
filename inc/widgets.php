<?php
/**
 * The template for adding Custom Sidebars and Widgets
 *
 * @package michael-gary-dean
 */

if ( ! function_exists( '_mgd_widgets_init' ) ) :

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function _mgd_widgets_init() {

	register_sidebar( array(
		'name'          => esc_html__( 'Top Footer Widget 1', '_mgd' ),
		'id'            => 'top-footer-widget-1',
		'description'   => esc_html__( 'Add widgets here.', '_mgd' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );	

	register_sidebar( array(
		'name'          => esc_html__( 'Top Footer Widget 2', '_mgd' ),
		'id'            => 'top-footer-widget-2',
		'description'   => esc_html__( 'Add widgets here.', '_mgd' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );	

	register_sidebar( array(
		'name'          => esc_html__( 'Bottom Footer Widget', '_mgd' ),
		'id'            => 'bottom-footer-widget',
		'description'   => esc_html__( 'Add widgets here.', '_mgd' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );	
}
endif;
add_action( 'widgets_init', '_mgd_widgets_init' );
