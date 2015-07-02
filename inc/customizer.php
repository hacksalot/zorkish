<?php
/**
Zorkish Theme Customizer
@package Zorkish
*/

/**
Create a custom color setting for the theme.
*/
function create_color_setting( $wp_customize, $name, $label, $default ) {
  // Create a setting + control for the site byline color
  $wp_customize->add_setting( $name, array(
      'default' => $default,
      'sanitize_callback' => 'sanitize_hex_color',
      'transport' => 'postMessage',
  ));
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $name, array(
      'label' => __( $label, 'theme_textdomain' ),
      'section' => 'colors',
  )));
}

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

  create_color_setting( $wp_customize, 'header_color', 'Header Color', '#232323');
  create_color_setting( $wp_customize, 'footer_color', 'Footer Color', '#232323');
  create_color_setting( $wp_customize, 'header_byline_color', 'Byline Color', '#DDAE4F');

  // Remember whether Jetpack Site Logo is present
  $site_logo_active = function_exists('jetpack_the_site_logo');

  // Add a section for site logo customization. This is in additions
  // to whatever Jetpack might add (if installed).
  $wp_customize->add_section( 'zorkish_logo_section' , array(
      'title'       => __( ($site_logo_active ? 'Inner Logo' : 'Site Logo'), 'zorkish' ),
      'priority'    => 30,
      'description' => ($site_logo_active ? 'Specify a logo to use on inner pages' : 'Upload a logo to replace the default site name and description in the header'),
  ) );

  // If Jetpack isn't installed, display the custom logo uploader.
  // ALSO display it if we have a 'zorkish-logo' theme mod, to handle
  // the user adding a custom logo and later installing Jetpack.
  if ( !$site_logo_active || get_theme_mod('zorkish-logo')) {
    $wp_customize->add_setting( 'zorkish_logo' );
    $wp_customize->add_control(
      new WP_Customize_Image_Control( $wp_customize, 'zorkish_logo', array(
        'label'    => __( 'Logo', 'zorkish' ),
        'section'  => 'zorkish_logo_section',
        'settings' => 'zorkish_logo',
    )));
  }

  // Add a setting for the site's inner logo
  $wp_customize->add_setting( 'zorkish_inner_logo' );
  $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'zorkish_inner_logo', array(
    'label'    => __( 'Inner Logo', 'zorkish' ),
    'section'  => 'zorkish_logo_section',
    'settings' => 'zorkish_inner_logo',
  )));
}
add_action( 'customize_register', 'zorkish_customize_register' );

/**
Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
*/
function zorkish_customize_preview_js() {
  wp_enqueue_script( 'zorkish_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'zorkish_customize_preview_js' );
