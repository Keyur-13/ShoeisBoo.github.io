<?php
/**
* Color Settings.
*
* @package Tribunal
*/

$tribunal_default = tribunal_get_default_theme_options();

$wp_customize->add_section( 'color_schema',
    array(
    'title'      => esc_html__( 'Color Schema', 'tribunal' ),
    'priority'   => 60,
    'capability' => 'edit_theme_options',
     'panel'      => 'theme_colors_panel',
    )
);

// Color Schema.
$wp_customize->add_setting(
    'tribunal_color_schema',
    array(
        'default' 			=> $tribunal_default['tribunal_color_schema'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'tribunal_sanitize_select'
    )
);
$wp_customize->add_control(
    new Tribunal_Custom_Radio_Color_Schema( 
        $wp_customize,
        'tribunal_color_schema',
        array(
            'settings'      => 'tribunal_color_schema',
            'section'       => 'color_schema',
            'label'         => esc_html__( 'Color Schema', 'tribunal' ),
            'choices'       => array(
                'default'  => array(
                	'color' => array(
                            $tribunal_default['default_bg_color'],
                            $tribunal_default['default_primary_color'],
                            $tribunal_default['default_secondary_color'],
                            $tribunal_default['default_tertiary_color'],
                        ),
                	'title' => esc_html__('Default','tribunal'),
                ),
                'fancy'  => array(
                	'color' => array(
                            $tribunal_default['fancy_bg_color'],
                            $tribunal_default['fancy_primary_color'],
                            $tribunal_default['fancy_secondary_color'],
                            $tribunal_default['fancy_tertiary_color'],
                        ),
                	'title' => esc_html__('Fancy','tribunal'),
                ),
                'dark'  => array(
                	'color' => array(
                            $tribunal_default['dark_bg_color'],
                            $tribunal_default['dark_primary_color'],
                            $tribunal_default['dark_secondary_color'],
                            $tribunal_default['dark_tertiary_color'],
                        ),
                	'title' => esc_html__('Dark','tribunal'),
                ),
                'shady'  => array(
                    'color' => array(
                            $tribunal_default['shady_bg_color'],
                            $tribunal_default['shady_primary_color'],
                            $tribunal_default['shady_secondary_color'],
                            $tribunal_default['shady_tertiary_color'],
                        ),
                    'title' => esc_html__('Shady','tribunal'),
                ),
            )
        )
    )
);

$wp_customize->add_setting(
    'tribunal_premium_notiece_color_schema',
    array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field'
    )
);
$wp_customize->add_control(
    new Tribunal_Premium_Notiece_Control( 
        $wp_customize,
        'tribunal_premium_notiece_color_schema',
        array(
            'label'      => esc_html__( 'Color Schemes', 'tribunal' ),
            'settings' => 'tribunal_premium_notiece_color_schema',
            'section'       => 'color_schema',
        )
    )
);


$wp_customize->add_setting(
    'tribunal_premium_notiece_color',
    array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field'
    )
);
$wp_customize->add_control(
    new Tribunal_Premium_Notiece_Control( 
        $wp_customize,
        'tribunal_premium_notiece_color',
        array(
            'label'      => esc_html__( 'Color Options', 'tribunal' ),
            'settings' => 'tribunal_premium_notiece_color',
            'section'       => 'colors',
        )
    )
);