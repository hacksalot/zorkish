<?php
/**
The template for displaying the footer.
Contains the closing of the #content div and all content after.
@package Zorkish
*/

?>

  </div><!-- #content -->

  <footer id="colophon" class="site-footer" role="contentinfo">
    <div class="site-info">
      <span>Copyright &copy; <? echo date('Y'); ?> | <? echo get_bloginfo('name'); ?> | All Rights Reserved</span>
    </div><!-- .site-info -->
  </footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
