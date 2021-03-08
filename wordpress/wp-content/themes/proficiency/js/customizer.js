/**
 * customizer.js
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {
	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );
	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title a, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title a, .site-description' ).css( {
					'clip': 'auto',
					'position': 'relative'
				} );
				$( '.site-title a, .site-description' ).css( {
					'color': to
				} );
			}
		} );
	} );
} )( jQuery );



jQuery(document).ready(function() {
	
	/* Slider Section */
	wp.customize.section( 'sidebar-widgets-sidebar-slider' ).panel( 'slider_setting' );
	wp.customize.section( 'sidebar-widgets-sidebar-slider' ).priority( '3' );
	
	/* Service Section */
	wp.customize.section( 'sidebar-widgets-sidebar-service' ).panel( 'service_setting' );
	wp.customize.section( 'sidebar-widgets-sidebar-service' ).priority( '5' );
	
	/* Contact section*/
	wp.customize.section( 'sidebar-widgets-sidebar-contact' ).panel( 'contact_setting' );
	wp.customize.section( 'sidebar-widgets-sidebar-contact' ).priority( '5' );
	
	
	
	
	
	
	
});