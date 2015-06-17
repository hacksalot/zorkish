/**
Theme Customizer enhancements. Preview changes asynchronously during Customize.
https://developer.wordpress.org/themes/advanced-topics/customizer-api/
@module customizer.js
*/

( function( $ ) {

  // Site title
  wp.customize( 'blogname', function( value ) {
    value.bind( function( to ) {
      $( '.site-title a' ).text( to );
    } );
  } );

  // Site description
  wp.customize( 'blogdescription', function( value ) {
    value.bind( function( to ) {
      $( '.site-description' ).text( to );
    } );
  } );

  // Helper for wp.customize
  function customizeColor( name, selector, prop ) {
    prop = prop || 'background-color';
    wp.customize( name, function( value ) {
      value.bind( function( to ) {
        if ( 'blank' === to ) {
          $( selector ).css( {
            'clip': 'rect(1px, 1px, 1px, 1px)',
            'position': 'absolute'
          } );
        } else {
          $( selector ).css( {
            'clip': 'auto',
            'position': 'relative'
          } )
          .css( prop, to );
        }
      });
    });
  }

  // Chassis element colors
  customizeColor('header_textcolor', '.site-title, .site-description', 'color');
  customizeColor('header_byline_color', '.site-description', 'color');
  customizeColor('header_color', '#masthead');
  customizeColor('footer_color', '#colophon');

} )( jQuery );
