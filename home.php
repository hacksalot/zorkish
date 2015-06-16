<?php
/**
The template file for the home page.
See: https://developer.wordpress.org/themes/basics/template-hierarchy/#home-page-display
     https://codex.wordpress.org/Creating_a_Static_Front_Page
@package Zorkish
*/

get_header(); ?>

  <div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

    <?php
    if ( have_posts() ) :
      while ( have_posts() ) : the_post();
        // Include the Post-Format-specific template for the content.
        // If you want to override this in a child theme, then include a file
        // called content-___.php (where ___ is the Post Format name) and that will be used instead.
        get_template_part( 'template-parts/content', get_post_format() );
      endwhile;
    else :
      get_template_part( 'template-parts/content', 'none' );
    endif;
    ?>
    </main><!-- #main -->
  </div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
