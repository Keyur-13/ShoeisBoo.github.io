<?php
/**
 * This file contains functions and hooks for styling Hootkit plugin
 *   Hootkit is a free plugin released under GPL license and hosted on wordpress.org.
 *   It is recommended to the user via wp-admin using TGMPA class
 *
 * This file is loaded at 'after_setup_theme' action @priority 10 ONLY IF hootkit plugin is active
 *
 * @package    Unos Minima Shop
 * @subpackage HootKit
 */

// Register HootKit
// Parent added @priority 5
add_filter( 'hootkit_register', 'unosmshop_register_hootkit', 7 );

// Add theme's hootkit styles.
// Changing priority to >11 has added benefit of loading child theme's stylesheet before hootkit style.
// This is preferred in case of pre-built child themes where we want child stylesheet to come before
// dynamic css (not after like in the case of user blank child themes purely used for customizations)
add_action( 'wp_enqueue_scripts', 'unosmshop_enqueue_hootkit', 15 );

// Set dynamic css handle to child theme's hootkit
// if HK active : earlier set to hootkit@parent @priority 5; set to child stylesheet @priority 7
// Dynamic is hooked to child stylesheet in main functions file. We modify it here for when HootKit is
// active to load dynamic after hootkit stylesheet (which is loaded after child stylesheet - see above)
add_filter( 'hoot_style_builder_inline_style_handle', 'unosmshop_dynamic_css_hootkit_handle', 8 );

// Add dynamic CSS for hootkit
// Priority@12: 10-> base hootkit lite/prim
add_action( 'hoot_dynamic_cssrules', 'unosmshop_hootkit_dynamic_cssrules', 12 );

/**
 * Register Hootkit
 * Parent added @priority 5
 *
 * @since 1.0
 * @param array $config
 * @return string
 */
if ( !function_exists( 'unosmshop_register_hootkit' ) ) :
function unosmshop_register_hootkit( $config ) {

	// Add support for woocommerce product widgets
	if ( version_compare( hootkit()->version, '1.2.0', '>' ) ) {
		$addsupport = array( 'product-list', 'products-ticker', 'products-search', 'products-carticon' );
		if ( !empty( $config['modules'] ) )
			$config['modules']['woocommerce'] = ( empty( $config['modules']['woocommerce'] ) ) ? $addsupport : array_merge( $config['modules']['woocommerce'], $addsupport );
	}

	// Array of configuration settings.
	if ( isset( $config['supports'] ) && is_array( $config['supports'] ) )
		$config['supports'][] = 'widget-subtitle';
	return $config;

}
endif;

/**
 * Enqueue Scripts and Styles
 *
 * @since 1.0
 * @access public
 * @return void
 */
if ( !function_exists( 'unosmshop_enqueue_hootkit' ) ) :
function unosmshop_enqueue_hootkit() {

	/* 'unos-hootkit' is loaded using 'hoot_locate_style' which loads child theme location. Hence deregister it and load files again */
	wp_deregister_style( 'unos-hootkit' );
	/* Load Hootkit Style - Add dependency so that hotkit is loaded after */
	if ( file_exists( hoot_data()->template_dir . 'hootkit/hootkit.css' ) )
	wp_enqueue_style( 'unos-hootkit', hoot_data()->template_uri . 'hootkit/hootkit.css', array( 'hoot-style' ), hoot_data()->template_version );
	if ( file_exists( hoot_data()->child_dir . 'hootkit/hootkit.css' ) )
	wp_enqueue_style( 'unosmshop-hootkit', hoot_data()->child_uri . 'hootkit/hootkit.css', array( 'hoot-style', 'unos-hootkit' ), hoot_data()->childtheme_version );

}
endif;

/**
 * Set dynamic css handle to hootkit
 *
 * @since 1.0
 * @access public
 * @return void
 */
if ( !function_exists( 'unosmshop_dynamic_css_hootkit_handle' ) ) :
function unosmshop_dynamic_css_hootkit_handle( $handle ) {
	return 'unosmshop-hootkit';
}
endif;

/**
 * Custom CSS built from user theme options for hootkit features
 *
 * @since 1.0
 * @access public
 */
if ( !function_exists( 'unosmshop_hootkit_dynamic_cssrules' ) ) :
function unosmshop_hootkit_dynamic_cssrules() {

	global $hoot_style_builder;

	// Get user based style values
	$styles = unos_user_style(); // echo '<!-- '; print_r($styles); echo ' -->';
	extract( $styles );

	$hoot_style_builder->remove( array(
		'.social-icons-icon',
		'#topbar .social-icons-icon, #page-wrapper .social-icons-icon',
	) );

	/*** Add Dynamic CSS ***/

	hoot_add_css_rule( array(
						'selector'  => '.wordpress .button-widget.preset-accent',
						'property'  => array(
							'border-color' => array( $accent_color, 'accent_color' ),
							'background'   => array( 'none' ),
							'color'        => array( $accent_color, 'accent_color' ),
							),
					) );
	hoot_add_css_rule( array(
						'selector'  => '.wordpress .button-widget.preset-accent:hover',
						'property'  => array(
							'background'   => array( $accent_color, 'accent_color' ),
							'color'        => array( $accent_font, 'accent_font' ),
							),
					) );

	hoot_add_css_rule( array(
						'selector'  => '.content-block:hover .content-block-icon',
						'property'  => 'background',
						'value'     => $accent_color,
						'idtag'     => 'accent_color'
					) );
	hoot_add_css_rule( array(
						'selector'  => '.content-block:hover .content-block-icon i',
						'property'  => 'color',
						'value'     => $accent_font,
						'idtag'     => 'accent_font'
					) );

}
endif;

/**
 * Button Style For cover image and content grid
 *
 * @since 1.0
 * @param array $buttonattr
 * @return array
 */
function unosmshop_coverimg_button( $buttonattr, $box ) {
	$b = ( !empty( $buttonattr['data-button'] ) ) ? intval( $buttonattr['data-button'] ) : '';
	if ( empty( $b ) ) return $buttonattr;
	if ( apply_filters( 'hootkit_display_widget_extract_overwrite', false, 'cover-image' ) ) extract( $box, EXTR_OVERWRITE ); else extract( $box, EXTR_SKIP );
	$invertbutton = apply_filters( 'hootkit_coverimage_inverthoverbuttons', false );

				if ( !empty( ${"buttoncolor{$b}"} ) || !empty( ${"buttonfont{$b}"} ) ) {
					$buttonattr['style'] = '';
					if ( $invertbutton ) $buttonattr['onMouseOver'] = $buttonattr['onMouseOut'] = '';
					if ( !empty( ${"buttoncolor{$b}"} ) ) {
						$buttonattr['style'] .= 'color:' . sanitize_hex_color( ${"buttoncolor{$b}"} ) . ';';
						$buttonattr['style'] .= 'border-color:' . sanitize_hex_color( ${"buttoncolor{$b}"} ) . ';';
						if ( $invertbutton ) $buttonattr['onMouseOver'] .= "this.style.background='" . sanitize_hex_color( ${"buttoncolor{$b}"} ) . "';";
						if ( $invertbutton ) $buttonattr['onMouseOut'] .= "this.style.color='" . sanitize_hex_color( ${"buttoncolor{$b}"} ) . "';";
						if ( $invertbutton ) $buttonattr['onMouseOut'] .= "this.style.background='none';";
					}
					if ( !empty( ${"buttonfont{$b}"} ) ) {
						if ( $invertbutton ) $buttonattr['onMouseOver'] .= "this.style.color='" . sanitize_hex_color( ${"buttonfont{$b}"} ) . "';";
					}
				}

	return $buttonattr;
}
add_filter( 'hoot_attr_coverimage-button', 'unosmshop_coverimg_button', 7, 2 );
add_filter( 'hoot_attr_content-grid-button', 'unosmshop_coverimg_button', 7, 2 );

function unosmshop_coverimg_button_option( $settings ) {
	if ( isset( $settings['form_options']['buttonfont1']['name'] ) )
		$settings['form_options']['buttonfont1']['name'] = sprintf( __( 'Button %1$s Color (hover)', 'unos-minima-shop' ), '1' );
	if ( isset( $settings['form_options']['buttonfont2']['name'] ) )
		$settings['form_options']['buttonfont2']['name'] = sprintf( __( 'Button %1$s Color (hover)', 'unos-minima-shop' ), '2' );
	if ( isset( $settings['form_options']['boxes']['fields']['buttonfont1']['name'] ) )
		$settings['form_options']['boxes']['fields']['buttonfont1']['name'] = sprintf( __( 'Button %1$s Color (hover)', 'unos-minima-shop' ), '1' );
	if ( isset( $settings['form_options']['boxes']['fields']['buttonfont2']['name'] ) )
		$settings['form_options']['boxes']['fields']['buttonfont2']['name'] = sprintf( __( 'Button %1$s Color (hover)', 'unos-minima-shop' ), '2' );
	return $settings;
}
add_filter( 'hootkit_cover_image_widget_settings', 'unosmshop_coverimg_button_option', 5 );
add_filter( 'hootkit_content_grid_widget_settings', 'unosmshop_coverimg_button_option', 5 );

/**
 * Modify Customizer Settings defaults
 *
 * @since 1.0
 * @param array $options
 * @return array
 */
function unosmshop_hootkit_customizer_options( $options ) {
	if ( isset( $options['settings']['hktb_content_bg']['default'] ) )
		$options['settings']['hktb_content_bg']['default'] = 'dark';
	return $options;
}
add_filter( 'hootkit_customizer_options', 'unosmshop_hootkit_customizer_options', 12 );

/**
 * Modify Ticker default style
 *
 * @since 1.0
 * @param array $settings
 * @return string
 */
function unosmshop_ticker_widget_settings( $settings ) {
	if ( isset( $settings['form_options']['background'] ) )
		$settings['form_options']['background']['std'] = '#f1f1f1';
	if ( isset( $settings['form_options']['fontcolor'] ) )
		$settings['form_options']['fontcolor']['std'] = '#666666';
	return $settings;
}
function unosmshop_ticker_products_widget_settings( $settings ) {
	if ( isset( $settings['form_options']['background'] ) )
		$settings['form_options']['background']['std'] = '#f1f1f1';
	if ( isset( $settings['form_options']['fontcolor'] ) )
		$settings['form_options']['fontcolor']['std'] = '#333333';
	return $settings;
}
add_filter( 'hootkit_ticker_widget_settings', 'unosmshop_ticker_widget_settings', 5 );
add_filter( 'hootkit_ticker_posts_widget_settings', 'unosmshop_ticker_widget_settings', 5 );
add_filter( 'hootkit_products_ticker_widget_settings', 'unosmshop_ticker_products_widget_settings', 5 );

/**
 * Filter Ticker and Ticker Posts display Title markup
 *
 * @since 1.0
 * @param array $settings
 * @return string
 */
function unosmshop_hootkit_widget_title( $display, $title, $context, $icon = '' ) {
	$display = '<div class="ticker-title accent-typo">' . $icon . $title . '</div>';
	return $display;
}
add_filter( 'hootkit_widget_ticker_title', 'unosmshop_hootkit_widget_title', 5, 4 );