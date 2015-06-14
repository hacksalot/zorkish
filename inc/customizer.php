<?php
/**
Zorkish Theme Customizer
@package Zorkish
*/

/**
Configure custom theme options.
@param WP_Customize_Manager $wp_customize Theme Customizer object.
*/
function zorkish_customize_register( $wp_customize ) {

  // Improve display of title, description, and header text color during preview
  // https://developer.wordpress.org/themes/advanced-topics/customizer-api/#using-postmessage-for-improved-setting-previewing
  $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
  $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
  $wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

  // Add a custom Customizer section
  $wp_customize->add_section( 'custom_favicon', array(
    'title' => __( 'Favicon' ),
    'description' => __( 'Set up your site\'s favicon.' ),
    'panel' => '', // Not typically needed.
    'priority' => 160,
    'capability' => 'edit_theme_options',
    'theme_supports' => '', // Rarely needed.
  ));

  // Create a setting + control for the site favicons setup
  $wp_customize->add_setting( 'favicon_links', array(
      'default' => ''
  ) );
  $wp_customize->add_control( 'favicon_links', array(
      'type' => 'textarea',
      'priority' => 10, // Within the section.
      'section' => 'custom_favicon', // Required, core or custom.
      'label' => __( 'Favicon Links' ),
      'description' => __( 'Add your favicon links here.' ),
      'input_attrs' => array(
          'class' => 'my-custom-class-for-js',
          'style' => 'border: 1px solid #900',
          'placeholder' => __( 'Add your favicon links here.' ),
      ),
      //'active_callback' => 'is_front_page',
  ) );

  // Create a setting + control for the site byline color
  $wp_customize->add_setting( 'header_byline_color', array(
      'default' => '#DDAE4F',
      'sanitize_callback' => 'sanitize_hex_color',
      'transport' => 'postMessage',
  ) );
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_byline_color', array(
      'label' => __( 'Byline Color', 'theme_textdomain' ),
      'section' => 'colors',
  ) ) );
}
add_action( 'customize_register', 'zorkish_customize_register' );

/**
Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
*/
function zorkish_customize_preview_js() {
  wp_enqueue_script( 'zorkish_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'zorkish_customize_preview_js' );
