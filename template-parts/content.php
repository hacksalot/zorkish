<?php
/**
Template part for displaying posts.
@package Zorkish
*/
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <header class="entry-header">
    <?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>

    <?php if ( 'post' == get_post_type() && is_single() ) : ?>
    <div class="entry-meta">
      <?php zorkish_posted_on(); ?>
    </div><!-- .entry-meta -->
    <?php endif; ?>
  </header><!-- .entry-header -->

  <div class="entry-content">
  
    <? 
    if (!is_single()) {
      the_excerpt();
    }
    else {
      // translators: %s: Name of current post
      the_content( sprintf(
        wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'zorkish' ), array( 'span' => array( 'class' => array() ) ) ),
        the_title( '<span class="screen-reader-text">"', '"</span>', false )
      ) );
    }
    ?>

    <?php
      if(is_single()) {
        wp_link_pages( array(
          'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'zorkish' ),
          'after'  => '</div>',
        ) );
      }
    ?>
  </div><!-- .entry-content -->

  <footer class="entry-footer">
    <?php if(is_single()) zorkish_entry_footer(); ?>
  </footer><!-- .entry-footer -->
</article><!-- #post-## -->
