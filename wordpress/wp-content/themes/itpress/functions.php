<?php
function itpress_css() {
	$parent_style = 'spintech-parent-style';
	wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'itpress-style', get_stylesheet_uri(), array( $parent_style ));
	
	wp_enqueue_style('itpress-responsive',get_stylesheet_directory_uri().'/assets/css/responsive.css');
	wp_dequeue_style('spintech-responsive');

}
add_action( 'wp_enqueue_scripts', 'itpress_css',999);
   	

/**
 * Import Options From Parent Theme
 *
 */
function itpress_parent_theme_options() {
	$spintech_mods = get_option( 'theme_mods_spintech' );
	if ( ! empty( $spintech_mods ) ) {
		foreach ( $spintech_mods as $spintech_mod_k => $spintech_mod_v ) {
			set_theme_mod( $spintech_mod_k, $spintech_mod_v );
		}
	}
}
add_action( 'after_switch_theme', 'itpress_parent_theme_options' );


require( get_stylesheet_directory() . '/inc/customizer/customizer-pro/class-customize.php');
