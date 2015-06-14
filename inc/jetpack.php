<?php
/**
Jetpack Compatibility File
See: https://jetpack.me/
@package Zorkish
*/

/**
Add theme support for Site Logo and Infinite Scroll.
http://jetpack.me/support/site-logo/
http://jetpack.me/support/infinite-scroll/
*/
function zorkish_jetpack_setup()
{
  add_theme_support( 'site-logo' );
  add_theme_support( 'infinite-scroll', array(
    'container' => 'main',
    'render'    => 'zorkish_infinite_scroll_render',
    'footer'    => 'page',
  ) );
}
add_action( 'after_setup_theme', 'zorkish_jetpack_setup' );

/**
Custom render function for Infinite Scroll.
*/
function zorkish_infinite_scroll_render() {
  while ( have_posts() ) {
    the_post();
    get_template_part( 'template-parts/content', get_post_format() );
  }
} // end function zorkish_infinite_scroll_render
