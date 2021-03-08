<?php
/**
* Layouts Settings.
*
* @package Tribunal
*/

$tribunal_default = tribunal_get_default_theme_options();

// Layout Section.
$wp_customize->add_section( 'layout_setting',
	array(
	'title'      => esc_html__( 'Layout Settings', 'tribunal' ),
	'priority'   => 60,
	'capability' => 'edit_theme_options',
	'panel'      => 'theme_option_panel',
	)
);


$wp_customize->add_setting('ed_fullwidth_layout',
    array(
        'default' => $tribunal_default['ed_fullwidth_layout'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'tribunal_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_fullwidth_layout',
    array(
        'label' => esc_html__('Enable Full Width', 'tribunal'),
        'section' => 'layout_setting',
        'type' => 'checkbox',
    )
);

// Global Sidebar Layout.
$wp_customize->add_setting( 'global_sidebar_layout',
	array(
	'default'           => $tribunal_default['global_sidebar_layout'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'tribunal_sanitize_sidebar_option',
	)
);
$wp_customize->add_control( 'global_sidebar_layout',
	array(
	'label'       => esc_html__( 'Global Sidebar Layout', 'tribunal' ),
	'section'     => 'layout_setting',
	'type'        => 'select',
	'choices'     => array(
		'right-sidebar' => esc_html__( 'Right Sidebar', 'tribunal' ),
		'left-sidebar'  => esc_html__( 'Left Sidebar', 'tribunal' ),
		'no-sidebar'    => esc_html__( 'No Sidebar', 'tribunal' ),
	    ),
	)
);

// Archive Layout.
$wp_customize->add_setting(
    'tribunal_archive_layout',
    array(
        'default' 			=> $tribunal_default['tribunal_archive_layout'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'tribunal_sanitize_archive_layout'
    )
);
$wp_customize->add_control(
    new Tribunal_Custom_Radio_Image_Control( 
        $wp_customize,
        'tribunal_archive_layout',
        array(
            'settings'      => 'tribunal_archive_layout',
            'section'       => 'layout_setting',
            'label'         => esc_html__( 'Archive Layout', 'tribunal' ),
            'choices'       => array(
            	'default'  => get_template_directory_uri() . '/assets/images/Layout-style-1.png',
                'full'  => get_template_directory_uri() . '/assets/images/Layout-style-2.png',
                'grid'  => get_template_directory_uri() . '/assets/images/Layout-style-3.png',
                'masonry'  => get_template_directory_uri() . '/assets/images/Layout-style-4.png',
            )
        )
    )
);


$wp_customize->add_setting('ed_image_content_inverse',
    array(
        'default' => $tribunal_default['ed_image_content_inverse'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'tribunal_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_image_content_inverse',
    array(
        'label' => esc_html__('Inverse Image with Content', 'tribunal'),
        'section' => 'layout_setting',
        'type' => 'checkbox',
        'active_callback' => 'tribunal_header_archive_layout_ac',
    )
);

