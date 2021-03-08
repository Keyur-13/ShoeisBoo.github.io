<?php
/**
* Posts Settings.
*
* @package Tribunal
*/

$tribunal_default = tribunal_get_default_theme_options();

// Single Post Section.
$wp_customize->add_section( 'posts_settings',
	array(
	'title'      => esc_html__( 'Meta Settings', 'tribunal' ),
	'priority'   => 35,
	'capability' => 'edit_theme_options',
	'panel'      => 'theme_option_panel',
	)
);

$wp_customize->add_setting('ed_post_date',
    array(
        'default' => $tribunal_default['ed_post_date'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'tribunal_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_post_date',
    array(
        'label' => esc_html__('Enable Posts Date', 'tribunal'),
        'section' => 'posts_settings',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('ed_post_category',
    array(
        'default' => $tribunal_default['ed_post_category'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'tribunal_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_post_category',
    array(
        'label' => esc_html__('Enable Posts Category', 'tribunal'),
        'section' => 'posts_settings',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('ed_post_tags',
    array(
        'default' => $tribunal_default['ed_post_tags'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'tribunal_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_post_tags',
    array(
        'label' => esc_html__('Enable Posts Tags', 'tribunal'),
        'section' => 'posts_settings',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('ed_post_views',
    array(
        'default' => $tribunal_default['ed_post_views'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'tribunal_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_post_views',
    array(
        'label' => esc_html__('Enable Posts Views', 'tribunal'),
        'section' => 'posts_settings',
        'type' => 'checkbox',
    )
);


// Enable Disable Post.
$wp_customize->add_setting('post_date_format',
    array(
        'default' => $tribunal_default['post_date_format'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'tribunal_sanitize_select',
    )
);
$wp_customize->add_control('post_date_format',
    array(
        'label' => esc_html__('Posted Date Format', 'tribunal'),
        'section' => 'posts_settings',
        'type' => 'select',
        'choices'               => array(
            'default' => esc_html__( 'Apply Default Format', 'tribunal' ),
            'time-ago' => esc_html__( 'Apply Time Age Format', 'tribunal' ),
            ),
        )
);