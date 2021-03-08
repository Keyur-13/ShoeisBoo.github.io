<?php
/**
* Layouts Settings.
*
* @package Tribunal
*/

$tribunal_default = tribunal_get_default_theme_options();
$tribunal_post_category = tribunal_post_category_list();

// Layout Section.
$wp_customize->add_section( 'template_cover_sidebar_setting',
	array(
	'title'      => esc_html__( 'Template Cover Setting', 'tribunal' ),
	'priority'   => 60,
	'capability' => 'edit_theme_options',
	'panel'      => 'theme_template_pannel',
	)
);

// Global Sidebar Layout.
$wp_customize->add_setting( 'template_cover_sidebar_layout',
	array(
	'default'           => $tribunal_default['template_cover_sidebar_layout'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'tribunal_sanitize_sidebar_option',
	)
);
$wp_customize->add_control( 'template_cover_sidebar_layout',
	array(
	'label'       => esc_html__( 'Template Cover Sidebar Layout', 'tribunal' ),
	'section'     => 'template_cover_sidebar_setting',
	'type'        => 'select',
	'choices'     => array(
		'right-sidebar' => esc_html__( 'Right Sidebar', 'tribunal' ),
		'left-sidebar'  => esc_html__( 'Left Sidebar', 'tribunal' ),
		'no-sidebar'    => esc_html__( 'No Sidebar', 'tribunal' ),
	    ),
	)
);

$wp_customize->add_setting('ed_template_header_overlay',
    array(
        'default' => $tribunal_default['ed_template_header_overlay'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'tribunal_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_template_header_overlay',
    array(
        'label' => esc_html__('Enable Header Overlay', 'tribunal'),
        'section' => 'template_cover_sidebar_setting',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('ed_template_cover_banner',
    array(
        'default' => $tribunal_default['ed_template_cover_banner'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'tribunal_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_template_cover_banner',
    array(
        'label' => esc_html__('Enable Banner', 'tribunal'),
        'section' => 'template_cover_sidebar_setting',
        'type' => 'checkbox',
    )
);

// Layout Section.
$wp_customize->add_section( 'template_cover_full_width_sidebar_setting',
	array(
	'title'      => esc_html__( 'Template Cover Full Width Setting', 'tribunal' ),
	'priority'   => 60,
	'capability' => 'edit_theme_options',
	'panel'      => 'theme_template_pannel',
	)
);

// Global Sidebar Layout.
$wp_customize->add_setting( 'template_cover_full_width_sidebar_layout',
	array(
	'default'           => $tribunal_default['template_cover_full_width_sidebar_layout'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'tribunal_sanitize_sidebar_option',
	)
);
$wp_customize->add_control( 'template_cover_full_width_sidebar_layout',
	array(
	'label'       => esc_html__( 'Template Cover Full Width Sidebar Layout', 'tribunal' ),
	'section'     => 'template_cover_full_width_sidebar_setting',
	'type'        => 'select',
	'choices'     => array(
		'right-sidebar' => esc_html__( 'Right Sidebar', 'tribunal' ),
		'left-sidebar'  => esc_html__( 'Left Sidebar', 'tribunal' ),
		'no-sidebar'    => esc_html__( 'No Sidebar', 'tribunal' ),
	    ),
	)
);

$wp_customize->add_setting('ed_template_full_header_overlay',
    array(
        'default' => $tribunal_default['ed_template_full_header_overlay'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'tribunal_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_template_full_header_overlay',
    array(
        'label' => esc_html__('Enable Header Overlay', 'tribunal'),
        'section' => 'template_cover_full_width_sidebar_setting',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('ed_template_full_cover_banner',
    array(
        'default' => $tribunal_default['ed_template_full_cover_banner'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'tribunal_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_template_full_cover_banner',
    array(
        'label' => esc_html__('Enable Banner', 'tribunal'),
        'section' => 'template_cover_full_width_sidebar_setting',
        'type' => 'checkbox',
    )
);

// Layout Section.
$wp_customize->add_section( 'template_carousel_settings',
	array(
	'title'      => esc_html__( 'Template Carousel Setting', 'tribunal' ),
	'priority'   => 60,
	'capability' => 'edit_theme_options',
	'panel'      => 'theme_template_pannel',
	)
);

// Global Sidebar Layout.
$wp_customize->add_setting( 'template_carousel_sidebar_settings',
	array(
	'default'           => $tribunal_default['template_carousel_sidebar_settings'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'tribunal_sanitize_sidebar_option',
	)
);
$wp_customize->add_control( 'template_carousel_sidebar_settings',
	array(
	'label'       => esc_html__( 'Template Carousel Sidebar Layout', 'tribunal' ),
	'section'     => 'template_carousel_settings',
	'type'        => 'select',
	'choices'     => array(
		'right-sidebar' => esc_html__( 'Right Sidebar', 'tribunal' ),
		'left-sidebar'  => esc_html__( 'Left Sidebar', 'tribunal' ),
		'no-sidebar'    => esc_html__( 'No Sidebar', 'tribunal' ),
	    ),
	)
);

$wp_customize->add_setting( 'template_carousel_slider_category',
	array(
	'default'           => '',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'tribunal_sanitize_select',
	)
);
$wp_customize->add_control( 'template_carousel_slider_category',
	array(
	'label'       => esc_html__( 'Template Slider Category', 'tribunal' ),
	'section'     => 'template_carousel_settings',
	'type'        => 'select',
	'choices'     => $tribunal_post_category
	)
);

$wp_customize->add_setting('ed_template_carousel_banner',
    array(
        'default' => $tribunal_default['ed_template_carousel_banner'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'tribunal_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_template_carousel_banner',
    array(
        'label' => esc_html__('Enable Banner', 'tribunal'),
        'section' => 'template_carousel_settings',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('ed_template_carousel_arrow',
    array(
        'default' => $tribunal_default['ed_template_carousel_arrow'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'tribunal_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_template_carousel_arrow',
    array(
        'label' => esc_html__('Enable Arrows', 'tribunal'),
        'section' => 'template_carousel_settings',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('ed_template_carousel_dots',
    array(
        'default' => $tribunal_default['ed_template_carousel_dots'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'tribunal_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_template_carousel_dots',
    array(
        'label' => esc_html__('Enable Dots', 'tribunal'),
        'section' => 'template_carousel_settings',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('ed_template_carousel_autoplay',
    array(
        'default' => $tribunal_default['ed_template_carousel_autoplay'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'tribunal_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_template_carousel_autoplay',
    array(
        'label' => esc_html__('Enable Autoplay', 'tribunal'),
        'section' => 'template_carousel_settings',
        'type' => 'checkbox',
    )
);

// Layout Section.
$wp_customize->add_section( 'template_slider_settings',
	array(
	'title'      => esc_html__( 'Template Slider Setting', 'tribunal' ),
	'priority'   => 60,
	'capability' => 'edit_theme_options',
	'panel'      => 'theme_template_pannel',
	)
);

// Global Sidebar Layout.
$wp_customize->add_setting( 'template_slider_sidebar_settings',
	array(
	'default'           => $tribunal_default['template_slider_sidebar_settings'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'tribunal_sanitize_sidebar_option',
	)
);
$wp_customize->add_control( 'template_slider_sidebar_settings',
	array(
	'label'       => esc_html__( 'Template Slider Sidebar Layout', 'tribunal' ),
	'section'     => 'template_slider_settings',
	'type'        => 'select',
	'choices'     => array(
		'right-sidebar' => esc_html__( 'Right Sidebar', 'tribunal' ),
		'left-sidebar'  => esc_html__( 'Left Sidebar', 'tribunal' ),
		'no-sidebar'    => esc_html__( 'No Sidebar', 'tribunal' ),
	    ),
	)
);

$wp_customize->add_setting( 'template_slider_category',
	array(
	'default'           => '',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'tribunal_sanitize_select',
	)
);
$wp_customize->add_control( 'template_slider_category',
	array(
	'label'       => esc_html__( 'Template Slider Category', 'tribunal' ),
	'section'     => 'template_slider_settings',
	'type'        => 'select',
	'choices'     => $tribunal_post_category
	)
);


$wp_customize->add_setting('ed_template_slider_banner',
    array(
        'default' => $tribunal_default['ed_template_slider_banner'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'tribunal_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_template_slider_banner',
    array(
        'label' => esc_html__('Enable Banner', 'tribunal'),
        'section' => 'template_slider_settings',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('ed_template_slider_arrows',
    array(
        'default' => $tribunal_default['ed_template_slider_arrows'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'tribunal_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_template_slider_arrows',
    array(
        'label' => esc_html__('Enable Arrows', 'tribunal'),
        'section' => 'template_slider_settings',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('ed_template_slider_dots',
    array(
        'default' => $tribunal_default['ed_template_slider_dots'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'tribunal_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_template_slider_dots',
    array(
        'label' => esc_html__('Enable Dots', 'tribunal'),
        'section' => 'template_slider_settings',
        'type' => 'checkbox',
    )
);


$wp_customize->add_setting('ed_template_slider_autoplay',
    array(
        'default' => $tribunal_default['ed_template_slider_autoplay'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'tribunal_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_template_slider_autoplay',
    array(
        'label' => esc_html__('Enable Autoplay', 'tribunal'),
        'section' => 'template_slider_settings',
        'type' => 'checkbox',
    )
);