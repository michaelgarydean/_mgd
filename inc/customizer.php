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


/*
 * Add a category setting and control to be used in the Customizer in the Colors section
 *
 */
function _mgd_add_homepage_controls( $wp_customize ) {

$wp_customize->add_setting(
      '_mgd_category_dropdown_setting', //give it an ID
      array(
          'default' => '#333333', // Give it a default
      )
  );
  $wp_customize->add_control(
     new Category_Dropdown_Custom_Control (
         $wp_customize, '_mgd_category_dropdown_setting', array(
            'label'   => 'Show Posts From Category',
            'section' => 'static_front_page',
            'settings'   => '_mgd_category_dropdown_setting',
            'priority' => 3
        ) ) );

}

add_action('customize_register','_mgd_add_homepage_controls');

/**
 * @description 	A class to create a dropdown for all categories in your wordpress site
 * @see 			https://github.com/paulund/wordpress-theme-customizer-custom-controls
 */

if ( ! class_exists( 'WP_Customize_Control' ) )
    return NULL;


 class Category_Dropdown_Custom_Control extends WP_Customize_Control
 {
    private $cats = false;

    public function __construct($manager, $id, $args = array(), $options = array())
    {
        $this->cats = get_categories($options);

        parent::__construct( $manager, $id, $args );
    }

    /**
     * Render the content of the category dropdown
     *
     * @return HTML
     */
    public function render_content()
       {
            if(!empty($this->cats))
            {
                ?>
                    <label>
                      <span class="customize-category-select-control"><?php echo esc_html( $this->label ); ?></span>
                      <select <?php $this->link(); ?>>
                           <?php
                                foreach ( $this->cats as $cat )
                                {
                                    printf('<option value="%s" %s>%s</option>', $cat->term_id, selected($this->value(), $cat->term_id, false), $cat->name);
                                }
                           ?>
                      </select>
                    </label>
                <?php
            }
       }
 }
