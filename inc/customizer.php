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
