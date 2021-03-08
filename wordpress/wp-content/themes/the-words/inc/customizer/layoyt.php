<?php
/**
 * The Words Layouts Optionl
 *
 * @package The_Words
 */

$wp_customize->add_section( 'layout_section',
    array(
    'title'      => esc_html__( 'Layout Setting', 'the-words' ),
    'capability' => 'edit_theme_options',
    'panel'      => 'theme_option_panel',
    )
);

$wp_customize->add_setting('global_post_sidebar_layout',
    array(
        'default' => 'right-sidebar',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'the_words_sanitize_sidebar',
    )
);
$wp_customize->add_control('global_post_sidebar_layout',
    array(
        'label' => esc_html__('Global Posts Sidebar Layout', 'the-words'),
        'section' => 'layout_section',
        'type' => 'select',
        'choices' => array(
            'right-sidebar' => esc_html__('Right Sidebar', 'the-words'),
            'left-sidebar' => esc_html__('Left Sidebar', 'the-words'),
            'no-sidebar' => esc_html__('No Sidebar', 'the-words'),
        )
    )
);

$wp_customize->add_setting('global_page_sidebar_layout',
    array(
        'default' => 'right-sidebar',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'the_words_sanitize_sidebar',
    )
);
$wp_customize->add_control('global_page_sidebar_layout',
    array(
        'label' => esc_html__('Global Pages Sidebar Layout', 'the-words'),
        'section' => 'layout_section',
        'type' => 'select',
        'choices' => array(
            'right-sidebar' => esc_html__('Right Sidebar', 'the-words'),
            'left-sidebar' => esc_html__('Left Sidebar', 'the-words'),
            'no-sidebar' => esc_html__('No Sidebar', 'the-words'),
        )
    )
);

$wp_customize->add_setting('global_sidebar_layout',
    array(
        'default' => 'right-sidebar',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'the_words_sanitize_sidebar',
    )
);
$wp_customize->add_control('global_sidebar_layout',
    array(
        'label' => esc_html__('Global Sidebar Layout', 'the-words'),
        'section' => 'layout_section',
        'type' => 'select',
        'choices' => array(
            'right-sidebar' => esc_html__('Right Sidebar', 'the-words'),
            'left-sidebar' => esc_html__('Left Sidebar', 'the-words'),
            'no-sidebar' => esc_html__('No Sidebar', 'the-words'),
        )
    )
);

$wp_customize->add_setting('ta_archive_layout',
    array(
        'default' => 'simple',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'the_words_sanitize_archive_layout',
    )
);
$wp_customize->add_control('ta_archive_layout',
    array(
        'label' => esc_html__('Archive Page Layout', 'the-words'),
        'section' => 'layout_section',
        'type' => 'select',
        'choices' => array(
            'grid' => esc_html__('Simple Grid Layout', 'the-words'),
            'simple' => esc_html__('Full Width Layout', 'the-words'),
            'masonry' => esc_html__('Masonry Layout', 'the-words'),
        )
    )
);