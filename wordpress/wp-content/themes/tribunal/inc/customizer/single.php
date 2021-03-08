<?php
/**
* Single Post Options.
*
* @package Tribunal
*/

$tribunal_default = tribunal_get_default_theme_options();

$wp_customize->add_section( 'single_post_setting',
	array(
	'title'      => esc_html__( 'Single Post Settings', 'tribunal' ),
	'priority'   => 35,
	'capability' => 'edit_theme_options',
	'panel'      => 'theme_option_panel',
	)
);

$wp_customize->add_setting('ed_related_post',
    array(
        'default' => $tribunal_default['ed_related_post'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'tribunal_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_related_post',
    array(
        'label' => esc_html__('Enable Related Posts', 'tribunal'),
        'section' => 'single_post_setting',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting( 'related_post_title',
    array(
    'default'           => $tribunal_default['related_post_title'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'related_post_title',
    array(
    'label'    => esc_html__( 'Related Posts Section Title', 'tribunal' ),
    'section'  => 'single_post_setting',
    'type'     => 'text',
    )
);

$wp_customize->add_setting('twp_navigation_type',
    array(
        'default' => $tribunal_default['twp_navigation_type'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'tribunal_sanitize_single_pagination_layout',
    )
);
$wp_customize->add_control('twp_navigation_type',
    array(
        'label' => esc_html__('Single Post Navigation Type', 'tribunal'),
        'section' => 'single_post_setting',
        'type' => 'select',
        'choices' => array(
                'no-navigation' => esc_html__('Disable Navigation','tribunal' ),
                'norma-navigation' => esc_html__('Next Previous Navigation','tribunal' ),
                'ajax-next-post-load' => esc_html__('Ajax Load Next 3 Posts Contents','tribunal' )
            ),
    )
);

$wp_customize->add_setting('ed_floating_next_previous_nav',
    array(
        'default' => $tribunal_default['ed_floating_next_previous_nav'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'tribunal_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_floating_next_previous_nav',
    array(
        'label' => esc_html__('Enable Floating Next/Previous Post Nav', 'tribunal'),
        'section' => 'single_post_setting',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting(
    'tribunal_single_post_layout',
    array(
        'default'           => $tribunal_default['tribunal_single_post_layout'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'tribunal_sanitize_single_post_layout'
    )
);
$wp_customize->add_control(
    new Tribunal_Custom_Radio_Image_Control( 
        $wp_customize,
        'tribunal_single_post_layout',
        array(
            'settings'      => 'tribunal_single_post_layout',
            'section'       => 'single_post_setting',
            'label'         => esc_html__( 'Global Single Post Layout', 'tribunal' ),
            'choices'       => array(
                'layout-1'  => get_template_directory_uri() . '/assets/images/Layout-style-1.png',
                'layout-2'  => get_template_directory_uri() . '/assets/images/Layout-style-2.png',
            )
        )
    )
);

$wp_customize->add_setting('ed_header_overlay',
    array(
        'default' => $tribunal_default['ed_header_overlay'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'tribunal_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_header_overlay',
    array(
        'label' => esc_html__('Enable Header Overlay', 'tribunal'),
        'section' => 'single_post_setting',
        'type' => 'checkbox',
        'active_callback' => 'tribunal_overlay_layout_ac',
    )
);