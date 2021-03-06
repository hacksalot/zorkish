<?php
/**
Zorkish functions and definitions
@package Zorkish
*/

if ( ! function_exists( 'zorkish_setup' ) ) :

/**
Sets up theme defaults and registers support for various WordPress features.
Note that this function is hooked into the after_setup_theme hook, which
runs before the init hook. The init hook is too late for some features, such
as indicating support for post thumbnails.
*/
function zorkish_setup() {

  //Make theme available for translation.
  //Translations can be filed in the /languages/ directory.
  //If you're building a theme based on Zorkish, use a find and replace
  //to change 'zorkish' to the name of your theme in all the template files
  load_theme_textdomain( 'zorkish', get_template_directory() . '/languages' );

  // Add default posts and comments RSS feed links to head.
  add_theme_support( 'automatic-feed-links' );

  //Let WordPress manage the document title.
  //By adding theme support, we declare that this theme does not use a
  //hard-coded <title> tag in the document head, and expect WordPress to
  //provide it for us.
  add_theme_support( 'title-tag' );


  //Enable support for Post Thumbnails on posts and pages.
  //@link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
  add_theme_support( 'post-thumbnails' );

  // This theme uses wp_nav_menu() in one location.
  register_nav_menus( array(
    'primary' => esc_html__( 'Primary Menu', 'zorkish' ),
  ) );

  //Switch default core markup for search form, comment form, and comments
  //to output valid HTML5.
  add_theme_support( 'html5', array(
    'search-form',
    'comment-form',
    'comment-list',
    'gallery',
    'caption',
  ) );

  //Enable support for Post Formats.
  //See http://codex.wordpress.org/Post_Formats
  add_theme_support( 'post-formats', array(
    'aside',
    'image',
    'video',
    'quote',
    'link',
  ) );

  // Set up the WordPress core custom background feature.
  add_theme_support( 'custom-background', apply_filters( 'zorkish_custom_background_args', array(
    'default-color' => 'ffffff',
    'default-image' => '',
  ) ) );
}
endif; // zorkish_setup
add_action( 'after_setup_theme', 'zorkish_setup' );

/**
Set the content width in pixels, based on the theme's design and stylesheet.
Priority 0 to make it available to lower priority callbacks.
@global int $content_width
*/
function zorkish_content_width() {
  $GLOBALS['content_width'] = apply_filters( 'zorkish_content_width', 640 );
}
add_action( 'after_setup_theme', 'zorkish_content_width', 0 );

/**
Register widget areas.
@link http://codex.wordpress.org/Function_Reference/register_sidebar
*/
function zorkish_widgets_init() {
  register_sidebar( array(
    'name'          => esc_html__( 'Sidebar', 'zorkish' ),
    'id'            => 'wa-sidebar',
    'description'   => 'The primary site sidebar.',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget'  => '</aside>',
    'before_title'  => '<h1 class="widget-title">',
    'after_title'   => '</h1>',
  ));
  register_sidebar( array(
    'name'          => esc_html__( 'Footer (Home)', 'zorkish' ),
    'id'            => 'wa-footer-home',
    'description'   => 'The home page footer bar.',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget'  => '</aside>',
    'before_title'  => '<h1 class="widget-title">',
    'after_title'   => '</h1>',
  ));
  register_sidebar( array(
    'name'          => esc_html__( 'Footer (Inner)', 'zorkish' ),
    'id'            => 'wa-footer-inner',
    'description'   => 'The inner page footer bar.',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget'  => '</aside>',
    'before_title'  => '<h1 class="widget-title">',
    'after_title'   => '</h1>',
  ));  
}
add_action( 'widgets_init', 'zorkish_widgets_init' );

/**
Enqueue scripts and styles.
*/
function zorkish_scripts() {
  wp_enqueue_style( 'zorkish-style', get_stylesheet_uri() );

  wp_enqueue_script( 'zorkish-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

  wp_enqueue_script( 'zorkish-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

  if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
    wp_enqueue_script( 'comment-reply' );
  }
}
add_action( 'wp_enqueue_scripts', 'zorkish_scripts' );

/**
Remove WP version number.
*/
function zorkish_remove_version() {
  return '';
}
add_filter('the_generator', 'zorkish_remove_version');

/**
Set the length of auto-generated excerpts.
*/
function zorkish_excerpt_length( $length ) {
  return 25;
}
add_filter( 'excerpt_length', 'zorkish_excerpt_length', 999 );

/**
Enqueue stylesheet for Google Fonts
*/
function zorkish_add_google_fonts() {
  wp_register_style('zorkish-googleFonts', 'http://fonts.googleapis.com/css?family=Roboto+Condensed:400italic,700italic,400,700|Life+Savers:400,700');
  wp_enqueue_style( 'zorkish-googleFonts');
}
add_action('wp_print_styles', 'zorkish_add_google_fonts');

/**
Implement the Custom Header feature.
*/
require get_template_directory() . '/inc/custom-header.php';

/**
Custom template tags for this theme.
*/
require get_template_directory() . '/inc/template-tags.php';

/**
Custom functions that act independently of the theme templates.
*/
require get_template_directory() . '/inc/extras.php';

/**
Customizer additions.
*/
require get_template_directory() . '/inc/customizer.php';

/**
Load Jetpack compatibility file.
*/
require get_template_directory() . '/inc/jetpack.php';
