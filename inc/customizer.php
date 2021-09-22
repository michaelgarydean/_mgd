<?php
/**
 * michael-gary-dean Theme Customizer
 *
 * @package michael-gary-dean
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function _mgd_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => '_mgd_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => '_mgd_customize_partial_blogdescription',
		) );
	}
 
	/* 2021-09-21 - Custom link for the site title in the header */
	$wp_customize->add_setting( 
		'_mgd_site_title_link', 
		array(
			'default' 		=> get_home_url( '/' ),
			'type'       	=> 'option',
			'capability' 	=> 'edit_theme_options',
		)
	);

	$wp_customize->add_control( 
		'_mgd_site_title_link', 
		array(
	        'label'      => __( 'Site Title Link', 'textdomain' ),
	        'description' => __( 'Where your site title will link to.', 'textdomain' ),
			'section' => 'title_tagline',
			'type'    => 'text',
		)
	);

}
add_action( 'customize_register', '_mgd_customize_register' );
	

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function _mgd_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function _mgd_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function _mgd_customize_preview_js() {
	wp_enqueue_script( '_mgd-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', '_mgd_customize_preview_js' );



