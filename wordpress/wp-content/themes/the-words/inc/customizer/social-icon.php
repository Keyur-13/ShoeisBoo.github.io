<?php
/**
 * The Words Social Icons
 *
 * @package The_Words
 */

$wp_customize->add_section( 'social_icon_section',
    array(
    'title'      => esc_html__( 'Social Icons', 'the-words' ),
    'capability' => 'edit_theme_options',
    'panel'      => 'theme_option_panel',
    )
);

$wp_customize->add_setting('ed_header_social_icon',
    array(
        'default' => 1,
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'the_words_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_header_social_icon',
    array(
        'label' => esc_html__('Enable Header Social Icon', 'the-words'),
        'section' => 'social_icon_section',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('ed_footer_social_icon',
    array(
        'default' => 1,
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'the_words_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_footer_social_icon',
    array(
        'label' => esc_html__('Enable Footer Social Icon', 'the-words'),
        'section' => 'social_icon_section',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting( 'social_link_facebook',
    array(
    'default'           => '',
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'esc_url_raw',
    )
);
$wp_customize->add_control( 'social_link_facebook',
    array(
    'label'    => esc_html__( 'Facebook', 'the-words' ),
    'section'  => 'social_icon_section',
    'type'     => 'text',
    )
);

$wp_customize->add_setting( 'social_link_twitter',
    array(
    'default'           => '',
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'esc_url_raw',
    )
);
$wp_customize->add_control( 'social_link_twitter',
    array(
    'label'    => esc_html__( 'Twitter', 'the-words' ),
    'section'  => 'social_icon_section',
    'type'     => 'text',
    )
);

$wp_customize->add_setting( 'social_link_instagram',
    array(
    'default'           => '',
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'esc_url_raw',
    )
);
$wp_customize->add_control( 'social_link_instagram',
    array(
    'label'    => esc_html__( 'Instagram', 'the-words' ),
    'section'  => 'social_icon_section',
    'type'     => 'text',
    )
);

$wp_customize->add_setting( 'social_link_youtube',
    array(
    'default'           => '',
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'esc_url_raw',
    )
);
$wp_customize->add_control( 'social_link_youtube',
    array(
    'label'    => esc_html__( 'Youtube', 'the-words' ),
    'section'  => 'social_icon_section',
    'type'     => 'text',
    )
);

$wp_customize->add_setting( 'social_link_linkedin',
    array(
    'default'           => '',
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'esc_url_raw',
    )
);
$wp_customize->add_control( 'social_link_linkedin',
    array(
    'label'    => esc_html__( 'LinkedIn', 'the-words' ),
    'section'  => 'social_icon_section',
    'type'     => 'text',
    )
);

$wp_customize->add_setting( 'social_link_pinterest',
    array(
    'default'           => '',
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'esc_url_raw',
    )
);
$wp_customize->add_control( 'social_link_pinterest',
    array(
    'label'    => esc_html__( 'Pinterest', 'the-words' ),
    'section'  => 'social_icon_section',
    'type'     => 'text',
    )
);

$wp_customize->add_setting( 'social_link_vk',
    array(
    'default'           => '',
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'esc_url_raw',
    )
);
$wp_customize->add_control( 'social_link_vk',
    array(
    'label'    => esc_html__( 'VK', 'the-words' ),
    'section'  => 'social_icon_section',
    'type'     => 'text',
    )
);

$wp_customize->add_setting( 'social_link_reddit',
    array(
    'default'           => '',
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'esc_url_raw',
    )
);
$wp_customize->add_control( 'social_link_reddit',
    array(
    'label'    => esc_html__( 'Reddit', 'the-words' ),
    'section'  => 'social_icon_section',
    'type'     => 'text',
    )
);

$wp_customize->add_setting( 'social_link_vimeo',
    array(
    'default'           => '',
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'esc_url_raw',
    )
);
$wp_customize->add_control( 'social_link_vimeo',
    array(
    'label'    => esc_html__( 'Vimeo ', 'the-words' ),
    'section'  => 'social_icon_section',
    'type'     => 'text',
    )
);

