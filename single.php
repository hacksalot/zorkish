<?php
/**
The template for displaying all single posts.
@package Zorkish
*/

get_header(); ?>
  <div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
    <?php
    while ( have_posts() ) : the_post();
      get_template_part( 'template-parts/content', 'single' );
      the_post_navigation();
      if ( comments_open() || get_comments_number() ) :
        comments_template();
      endif;
    endwhile;
    ?>
    </main><!-- #main -->
  </div><!-- #primary -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>
