<?php

if (!class_exists('WP_Customize_Image_Control')) {
    return null;
}

class Multi_Image_Custom_Control extends WP_Customize_Control
{
    public function enqueue()
    {
      wp_enqueue_style('multi-image-style', get_template_directory_uri().'/layouts/multi-image.css');
      wp_enqueue_script('multi-image-script', get_template_directory_uri().'/js/multi-image.js', array( 'jquery' ), rand(), true);
    }

    public function render_content()
    { ?>
          <label>
            <span class='customize-control-title'>Image</span>
          </label>
          <div>
            <ul class='images'></ul>
          </div>
          <div class='actions'>
            <a class="button-secondary upload">Add</a>
          </div>

          <input class="wp-editor-area" id="images-input" type="hidden" <?php $this->link(); ?>>
      <?php
    }
}
?>

<?php
/**
 * adamant Theme Customizer
 *
 * @package adamant
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */

function adamant_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'adamant_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'adamant_customize_partial_blogdescription',
		) );
	}

    $wp_customize->remove_control('header_textcolor');
    $wp_customize->remove_control('background_color');

    $wp_customize->add_setting(
          'adamant_site_color', //give it an ID
          array(
              'default' => '#657F6F', // Give it a default
              'transport' => 'refresh',
          )
    );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'site_color', array(
    	'label'      => __( 'Barva stránky', 'adamant' ),
    	'section'    => 'colors',
    	'settings'   => 'adamant_site_color',
    ) ) );

    $wp_customize->add_setting(
          'adamant_primary_font_color', //give it an ID
          array(
              'default' => '#F6EBD8', // Give it a default
          )
    );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'primary_font_color', array(
    	'label'      => __( 'Primární barva fontu', 'adamant' ),
    	'section'    => 'colors',
    	'settings'   => 'adamant_primary_font_color',
    ) ) );

    $wp_customize->add_setting(
          'adamant_secondary_font_color', //give it an ID
          array(
              'default' => '#ECDCAF', // Give it a default
          )
    );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'secondary_font_color', array(
    	'label'      => __( 'Sekundární barva fontu', 'adamant' ),
    	'section'    => 'colors',
    	'settings'   => 'adamant_secondary_font_color',
    ) ) );

    $wp_customize->add_setting(
          'adamant_link_color', //give it an ID
          array(
              'default' => '#ECDCAF', // Give it a default
          )
    );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link_color', array(
    	'label'      => __( 'Barva odkazů', 'adamant' ),
    	'section'    => 'colors',
    	'settings'   => 'adamant_link_color',
    ) ) );

    $wp_customize->add_setting(
          'adamant_slideshow_images', //give it an ID
          array(
              'transport' => 'refresh', // Give it a default
          )
    );

    $wp_customize->add_section( 'adamant_slideshow' , array(
        'title'      => __( 'Obrázky v prezentaci', 'adamant' ),
        'priority'   => 30,
    ) );

    $wp_customize->add_control( new Multi_Image_Custom_Control( $wp_customize, 'slideshow_image', array(
    	'label'      => __( 'Obrázky v prezentaci', 'adamant' ),
    	'section'    => 'adamant_slideshow',
    	'settings'   => 'adamant_slideshow_images',
    ) ) );

}
add_action( 'customize_register', 'adamant_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function adamant_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function adamant_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function adamant_customize_preview_js() {
	wp_enqueue_script( 'adamant-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'adamant_customize_preview_js' );
