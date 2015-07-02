<?php
/**
The header for our theme. Displays all of the <head> section and everything up
til <div id="content">.
@package Zorkish
*/
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<? echo get_theme_mod('favicon_links'); ?>
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
  <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'zorkish' ); ?></a>

  <header id="masthead" class="site-header" role="banner" style="background-color: <?php echo get_theme_mod( 'header_color', '#232323' ); ?>;">
    <div class="site-branding">

      <?
      if( get_theme_mod( 'zorkish_inner_logo' ) && !is_home() ) : ?>
        <div class='site-logo'>
          <a href='<? echo esc_url( home_url( '/' ) ); ?>' title='<? echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>' rel='home'>
            <img src='<? echo esc_url( get_theme_mod( 'zorkish_inner_logo' ) ); ?>' alt='<? echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>'>
          </a>
        </div>
      <? elseif ( function_exists( 'jetpack_the_site_logo' ) && jetpack_has_site_logo() ) :
        jetpack_the_site_logo();
      elseif (get_theme_mod( 'zorkish_logo' ) ) : ?>
        <div class='site-logo'>
          <a href='<? echo esc_url( home_url( '/' ) ); ?>' title='<? echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>' rel='home'>
            <img src='<? echo esc_url( get_theme_mod( 'zorkish_logo' ) ); ?>' alt='<? echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>'>
          </a>
        </div>
      <? endif; ?>

      <h1 class="site-title"><a href="<? echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
      <h2 class="site-description" style="color: <? echo get_theme_mod( 'header_byline_color', '#DDAE4F' ) ?>"><?php bloginfo( 'description' ); ?></h2>

      <?php if ( get_header_image() ) : ?>
        <img src="<?php header_image(); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="">
      <?php endif; ?>
    </div><!-- .site-branding -->
    <nav id="site-navigation" class="main-navigation" role="navigation">
      <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'zorkish' ); ?></button>
      <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
    </nav><!-- #site-navigation -->
  </header><!-- #masthead -->

  <div id="content" class="site-content">
