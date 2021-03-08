<?php
/**
* Footer Settings.
*
* @package Tribunal
*/

$tribunal_default = tribunal_get_default_theme_options();
$tribunal_post_category_list = tribunal_post_category_list();

$wp_customize->add_section( 'footer_settings',
	array(
	'title'      => esc_html__( 'Footer Settings', 'tribunal' ),
	'capability' => 'edit_theme_options',
	'panel'      => 'theme_option_panel',
	'priority'  => 95,
	)
);


$wp_customize->add_setting( 'footer_column_layout',
	array(
	'default'           => $tribunal_default['footer_column_layout'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'absint',
	)
);
$wp_customize->add_control( 'footer_column_layout',
	array(
	'label'       => esc_html__( 'Top Footer Column Layout', 'tribunal' ),
	'section'     => 'footer_settings',
	'type'        => 'select',
	'choices'               => array(
		'1' => esc_html__( 'One Column', 'tribunal' ),
		'2' => esc_html__( 'Two Column', 'tribunal' ),
		'3' => esc_html__( 'Three Column', 'tribunal' ),
	    ),
	)
);

$wp_customize->add_setting( 'footer_copyright_text',
	array(
	'default'           => $tribunal_default['footer_copyright_text'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( 'footer_copyright_text',
	array(
	'label'    => esc_html__( 'Footer Copyright Text', 'tribunal' ),
	'section'  => 'footer_settings',
	'type'     => 'text',
	)
);

$wp_customize->add_setting('ed_affix_post',
    array(
        'default' => $tribunal_default['ed_affix_post'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'tribunal_sanitize_checkbox',
    )
);

$wp_customize->add_control('ed_affix_post',
    array(
        'label' => esc_html__('Enable Footer Affix Posts', 'tribunal'),
        'section' => 'footer_settings',
        'type' => 'checkbox',
    )
);


$wp_customize->add_setting( 'footer_affix_posts',
	array(
	'default'           => '',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'tribunal_sanitize_select',
	)
);
$wp_customize->add_control( 'footer_affix_posts',
	array(
		'label'       => esc_html__( 'Affix Posts Category', 'tribunal' ),
		'section'     => 'footer_settings',
		'type'        => 'select',
		'choices'     => $tribunal_post_category_list
	)
);

$wp_customize->add_setting('ed_affix_post_arrow',
    array(
        'default' => $tribunal_default['ed_affix_post_arrow'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'tribunal_sanitize_checkbox',
    )
);

$wp_customize->add_control('ed_affix_post_arrow',
    array(
        'label' => esc_html__('Enable Affix Posts Arrow', 'tribunal'),
        'section' => 'footer_settings',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('ed_affix_post_autoplay',
    array(
        'default' => $tribunal_default['ed_affix_post_autoplay'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'tribunal_sanitize_checkbox',
    )
);

$wp_customize->add_control('ed_affix_post_autoplay',
    array(
        'label' => esc_html__('Enable Affix Posts Autoplay', 'tribunal'),
        'section' => 'footer_settings',
        'type' => 'checkbox',
    )
);


$wp_customize->add_setting('ed_scroll_top_button',
    array(
        'default' => $tribunal_default['ed_scroll_top_button'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'tribunal_sanitize_checkbox',
    )
);

$wp_customize->add_control('ed_scroll_top_button',
    array(
        'label' => esc_html__('Enable Scroll to Top Button', 'tribunal'),
        'section' => 'footer_settings',
        'type' => 'checkbox',
    )
);