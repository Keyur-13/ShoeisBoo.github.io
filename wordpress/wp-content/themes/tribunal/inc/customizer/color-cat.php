<?php
/**
* Category Color
*
* @package Tribunal
*/

$tribunal_defaults = tribunal_get_default_theme_options();
$tribunal_post_category_list = tribunal_post_category_list();

// Slider Section.
$wp_customize->add_section( 'tribunal_category_color_section',
	array(
	'title'      => esc_html__( 'Category Color', 'tribunal' ),
	'capability' => 'edit_theme_options',
    'panel'      => 'theme_colors_panel',
	)
);


// Recommended Posts Enable Disable.
$wp_customize->add_setting( 'tribunal_category_colors', array(
    'sanitize_callback' => 'tribunal_sanitize_repeater',
    'default' => json_encode( $tribunal_defaults['tribunal_category_colors'] ),
));

$wp_customize->add_control(  new Tribunal_Repeater_Controler( $wp_customize, 'tribunal_category_colors', 
    array(
        'section' => 'tribunal_category_color_section',
        'settings' => 'tribunal_category_colors',
        'tribunal_box_label' => esc_html__('New Category','tribunal'),
        'tribunal_box_add_control' => esc_html__('Add New Category Color','tribunal'),
        'tribunal_box_add_button' => true,
    ),
        array(
            'category' => array(
                'type'        => 'select',
                'label'       => esc_html__( 'Select Category', 'tribunal' ),
                'options'     => $tribunal_post_category_list,
                'class'       => 'tribunal-custom-cat-color'
            ),
            'category_color' => array(
                'type'        => 'colorpicker',
                'label'       => esc_html__( 'Category Color', 'tribunal' ),
                'class'       => ''
            ),
            
    )
));
