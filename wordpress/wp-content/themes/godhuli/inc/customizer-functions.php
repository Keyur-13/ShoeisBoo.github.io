<?php
/*
 * All the function related to customizer
 *
 * @package Godhuli
 */


/**
 * Text logo if no image logo is selected
 */
if ( ! function_exists( 'godhuli_text_logo_display' ) ) :

	function godhuli_text_logo_display() {

		$markup  = '<a class="navbar-logo" href="' . esc_url( home_url( '/' ) ) . '">';
		$markup .= '<h1>' . get_bloginfo( 'name', 'display' ) . '</h1>';
		$markup .= '</a>';
		if ( ( get_theme_mod( 'header_text' ) !== 0 ) && ( get_bloginfo( 'description' ) !== '' ) ) {
			$markup .= '<p class="site-description">' . get_bloginfo( 'description', 'display' ) . '</p>';
		}

		return $markup;
	}

endif;

/*
 * Get the custom image logo
 */

if ( ! function_exists( 'godhuli_custom_logo' ) ) :

	function godhuli_custom_logo() {

		if ( ! get_theme_mod( 'custom_logo' ) ) {

			return false;
		}
		$custom_logo_id  = get_theme_mod( 'custom_logo' );
		$custom_logo_url = wp_get_attachment_image_url( $custom_logo_id, 'full' );

		if ( $custom_logo_url ) {
			return '<a class="navbar-logo" href="' . esc_url( home_url( '/' ) ) . '"><img src="' . esc_url( $custom_logo_url ) . '" alt="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" data-light="' . esc_url( $custom_logo_url ) . '" ></a>';
		} else {
			return false;
		}
	}

endif;
