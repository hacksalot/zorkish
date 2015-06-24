<?php
/**
The sidebar containing the main widget area.
@package Zorkish
*/

if ( ! is_active_sidebar( 'wa-sidebar' ) ) {
  return;
}
?>

<div id="secondary" class="widget-area" role="complementary">
  <?php dynamic_sidebar( 'wa-sidebar' ); ?>
</div><!-- #secondary -->
