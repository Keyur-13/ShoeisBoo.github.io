<?php
/**
* Header Options.
*
* @package Tribunal
*/

$tribunal_default = tribunal_get_default_theme_options();
$tribunal_page_lists = tribunal_page_lists();
$tribunal_post_category_list = tribunal_post_category_list();

// Header Advertise Area Section.
$wp_customize->add_section( 'main_header_setting',
	array(
	'title'      => esc_html__( 'Header Settings', 'tribunal' ),
	'priority'   => 10,
	'capability' => 'edit_theme_options',
    'panel'      => 'theme_option_panel',
	)
);

// Enable Disable Search.
$wp_customize->add_setting('ed_header_search',
    array(
        'default' => $tribunal_default['ed_header_search'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'tribunal_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_header_search',
    array(
        'label' => esc_html__('Enable Search', 'tribunal'),
        'section' => 'main_header_setting',
        'type' => 'checkbox',
    )
);

// Enable Disable Search.
$wp_customize->add_setting('ed_header_responsive_menu',
    array(
        'default' => $tribunal_default['ed_header_responsive_menu'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'tribunal_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_header_responsive_menu',
    array(
        'label' => esc_html__('Enable Responsive Menu', 'tribunal'),
        'section' => 'main_header_setting',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('ed_header_ticker_posts',
    array(
        'default' => $tribunal_default['ed_header_ticker_posts'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'tribunal_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_header_ticker_posts',
    array(
        'label' => esc_html__('Enable Ticker Posts', 'tribunal'),
        'section' => 'main_header_setting',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting( 'ed_header_ticker_posts_title',
    array(
    'default'           => $tribunal_default['ed_header_ticker_posts_title'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'ed_header_ticker_posts_title',
    array(
    'label'       => esc_html__( 'Ticker Section Title', 'tribunal' ),
    'section'     => 'main_header_setting',
    'type'        => 'text',
    )
);


$wp_customize->add_setting( 'tribunal_header_ticker_cat',
    array(
    'default'           => '',
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'tribunal_sanitize_select',
    )
);
$wp_customize->add_control( 'tribunal_header_ticker_cat',
    array(
    'label'       => esc_html__( 'Ticker Posts Category', 'tribunal' ),
    'section'     => 'main_header_setting',
    'type'        => 'select',
    'choices'     => $tribunal_post_category_list,
    )
);

$wp_customize->add_setting('ed_ticker_slider_autoplay',
    array(
        'default' => $tribunal_default['ed_ticker_slider_autoplay'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'tribunal_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_ticker_slider_autoplay',
    array(
        'label' => esc_html__('Enable Ticker Posts Autoplay', 'tribunal'),
        'section' => 'main_header_setting',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('ed_header_tags',
    array(
        'default' => $tribunal_default['ed_header_tags'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'tribunal_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_header_tags',
    array(
        'label' => esc_html__('Enable Tags', 'tribunal'),
        'section' => 'main_header_setting',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('ed_header_tags_title',
    array(
        'default' => $tribunal_default['ed_header_tags_title'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control('ed_header_tags_title',
    array(
        'label' => esc_html__('Tags Title', 'tribunal'),
        'section' => 'main_header_setting',
        'type' => 'text',
    )
);

$wp_customize->add_setting('ed_header_tags_count',
    array(
        'default' => $tribunal_default['ed_header_tags_count'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    )
);
$wp_customize->add_control('ed_header_tags_count',
    array(
        'label' => esc_html__('Tags To Show', 'tribunal'),
        'section' => 'main_header_setting',
        'type' => 'number',
    )
);

// Archive Layout.
$wp_customize->add_setting(
    'tribunal_header_layout',
    array(
        'default'           => $tribunal_default['tribunal_header_layout'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'tribunal_sanitize_header_layout'
    )
);
$wp_customize->add_control(
    new Tribunal_Custom_Radio_Image_Control( 
        $wp_customize,
        'tribunal_header_layout',
        array(
            'settings'      => 'tribunal_header_layout',
            'section'       => 'main_header_setting',
            'label'         => esc_html__( 'Header Layout', 'tribunal' ),
            'choices'       => array(
                'layout-1'  => get_template_directory_uri() . '/assets/images/header-layout-1.png',
                'layout-2'  => get_template_directory_uri() . '/assets/images/header-layout-2.png',
                'layout-3'  => get_template_directory_uri() . '/assets/images/header-layout-3.png',
            )
        )
    )
);

$wp_customize->add_setting('ed_header_ad',
    array(
        'default' => $tribunal_default['ed_header_ad'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'tribunal_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_header_ad',
    array(
        'label' => esc_html__('Enable Advertisement Area', 'tribunal'),
        'section' => 'main_header_setting',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('header_ad_image',
    array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    )
);
$wp_customize->add_control( new WP_Customize_Image_Control(
    $wp_customize,
    'header_ad_image',
        array(
            'label'      => esc_html__( 'Header AD Image', 'tribunal' ),
            'section'    => 'main_header_setting',
            'active_callback' => 'tribunal_header_ad_ac',
        )
    )
);

$wp_customize->add_setting('ed_header_link',
    array(
        'default' => '',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'esc_url_raw',
    )
);
$wp_customize->add_control('ed_header_link',
    array(
        'label' => esc_html__('AD Image Link', 'tribunal'),
        'section' => 'main_header_setting',
        'type' => 'text',
        'active_callback' => 'tribunal_header_ad_ac',
    )
);

// Archive Layout.
$wp_customize->add_setting(
    'tribunal_header_bg_size',
    array(
        'default'           => $tribunal_default['tribunal_header_bg_size'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'absint'
    )
);
$wp_customize->add_control('tribunal_header_bg_size',
        array(
            'type'       => 'select',
            'section'       => 'header_image',
            'label'         => esc_html__( 'Header BG Size', 'tribunal' ),
            'choices'       => array(
                '1'  => esc_html__( 'Small', 'tribunal' ),
                '2'  => esc_html__( 'Medium', 'tribunal' ),
                '3'  => esc_html__( 'Large', 'tribunal' ),
            )
        )
);

$wp_customize->add_setting('ed_header_bg_fixed',
    array(
        'default' => $tribunal_default['ed_header_bg_fixed'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'tribunal_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_header_bg_fixed',
    array(
        'label' => esc_html__('Enable Fixed BG', 'tribunal'),
        'section' => 'header_image',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('ed_header_bg_overlay',
    array(
        'default' => $tribunal_default['ed_header_bg_overlay'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'tribunal_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_header_bg_overlay',
    array(
        'label' => esc_html__('Enable BG Overlay', 'tribunal'),
        'section' => 'header_image',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('ed_header_search_recent_posts',
    array(
        'default' => $tribunal_default['ed_header_search_recent_posts'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'tribunal_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_header_search_recent_posts',
    array(
        'label' => esc_html__('Enable Recent Posts on Search Area', 'tribunal'),
        'section' => 'main_header_setting',
        'type' => 'checkbox',
    )
);
$wp_customize->add_setting( 'recent_post_title_search',
    array(
    'default'           => $tribunal_default['recent_post_title_search'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'recent_post_title_search',
    array(
    'label'    => esc_html__( 'Related Posts Section Title', 'tribunal' ),
    'section'  => 'main_header_setting',
    'type'     => 'text',
    )
);
$wp_customize->add_setting('ed_header_search_top_category',
    array(
        'default' => $tribunal_default['ed_header_search_top_category'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'tribunal_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_header_search_top_category',
    array(
        'label' => esc_html__('Enable Top Category on Search Area', 'tribunal'),
        'section' => 'main_header_setting',
        'type' => 'checkbox',
    )
);
$wp_customize->add_setting( 'top_category_title_search',
    array(
    'default'           => $tribunal_default['top_category_title_search'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'top_category_title_search',
    array(
    'label'    => esc_html__( 'Top Category Section Title', 'tribunal' ),
    'section'  => 'main_header_setting',
    'type'     => 'text',
    )
);