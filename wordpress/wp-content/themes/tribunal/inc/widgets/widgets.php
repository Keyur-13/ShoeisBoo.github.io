<?php
/**
* Widget FUnctions.
*
* @package Tribunal
*/

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */

function tribunal_widgets_init(){
    
    register_sidebar( array(
        'name' => esc_html__('Sidebar', 'tribunal'),
        'id' => 'sidebar-1',
        'description' => esc_html__('Add widgets here.', 'tribunal'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title font-size-big">',
        'after_title' => '</h2>',
    ));

    $tribunal_default = tribunal_get_default_theme_options();
    $footer_column_layout = absint( get_theme_mod( 'footer_column_layout',$tribunal_default['footer_column_layout'] ) );

    for( $i = 0; $i < $footer_column_layout; $i++ ){
    	
    	if( $i == 0 ){ $count = esc_html__('One','tribunal'); }
    	if( $i == 1 ){ $count = esc_html__('Two','tribunal'); }
    	if( $i == 2 ){ $count = esc_html__('Three','tribunal'); }

	    register_sidebar( array(
	        'name' => esc_html__('Footer Widget ', 'tribunal').$count,
	        'id' => 'tribunal-footer-widget-'.$i,
	        'description' => esc_html__('Add widgets here.', 'tribunal'),
	        'before_widget' => '<div id="%1$s" class="widget %2$s">',
	        'after_widget' => '</div>',
	        'before_title' => '<h2 class="widget-title font-size-big">',
	        'after_title' => '</h2>',
	    ));
	}

}

add_action('widgets_init', 'tribunal_widgets_init');