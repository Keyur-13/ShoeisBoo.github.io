<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package The_Words
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function the_words_body_classes( $classes ) {

	global $post;
	
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.	

	$global_sidebar_layout = get_theme_mod('global_sidebar_layout','right-sidebar');

	if( is_search() ){

		$classes[] = 'no-sidebar';

	}elseif( ( is_singular() && 'post' === get_post_type() ) || is_page() ){


		$the_words_post_sidebar = get_post_meta( $post->ID, 'the_words_post_sidebar_layout', true );
		if( $the_words_post_sidebar == 'global' || $the_words_post_sidebar == '' ){

			if( is_page() ){

				$global_page_sidebar_layout = get_theme_mod('global_page_sidebar_layout','right-sidebar');
				$classes[] = esc_attr( $global_page_sidebar_layout );

			}else{

				$global_post_sidebar_layout = get_theme_mod('global_post_sidebar_layout','right-sidebar');
				$classes[] = esc_attr( $global_post_sidebar_layout );

			}
			

		}else{
			$classes[] = esc_attr( $the_words_post_sidebar );
		}

	}else{

		$classes[] = esc_attr( $global_sidebar_layout );

	}

	return $classes;
}
add_filter( 'body_class', 'the_words_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function the_words_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'the_words_pingback_header' );

if( !function_exists('the_words_meta_sidebar') ):

	/**
	* Metabox sidebar sanitize
	**/

	function the_words_meta_sidebar( $input ) {

	    $valid_keys = array('global','left-sidebar','right-sidebar','no-sidebar');

	    if ( in_array( $input, $valid_keys ) ) {

	        return $input;

	    } else {

	        return '';

	    }

	}

endif;