<?php
/**
 * The Words Footer Optionl
 *
 * @package The_Words
 */

$wp_customize->add_section( 'single_post_section',
    array(
    'title'      => esc_html__( 'Post Setting', 'the-words' ),
    'capability' => 'edit_theme_options',
    'panel'      => 'theme_option_panel',
    )
);

$wp_customize->add_setting('ed_author_box',
    array(
        'default' => 1,
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'the_words_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_author_box',
    array(
        'label' => esc_html__('Enable Author Box', 'the-words'),
        'description' => esc_html__('This option will work for single posts author box.', 'the-words'),
        'section' => 'single_post_section',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('ed_related_posts',
    array(
        'default' => 1,
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'the_words_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_related_posts',
    array(
        'label' => esc_html__('Enable Related Posts', 'the-words'),
        'description' => esc_html__('This option will work for single post related post.', 'the-words'),
        'section' => 'single_post_section',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('ed_related_post_title',
    array(
        'default' => esc_html__('Related Posts', 'the-words'),
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control('ed_related_post_title',
    array(
        'label' => esc_html__('Related Posts Section Title', 'the-words'),
        'section' => 'single_post_section',
        'type' => 'text',
    )
);

$wp_customize->add_setting('ed_post_category',
    array(
        'default' => 1,
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'the_words_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_post_category',
    array(
        'label' => esc_html__('Enable Category', 'the-words'),
        'description' => esc_html__('This option will work for all posts.', 'the-words'),
        'section' => 'single_post_section',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('ed_post_author',
    array(
        'default' => 1,
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'the_words_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_post_author',
    array(
        'label' => esc_html__('Enable Author', 'the-words'),
        'description' => esc_html__('This option will work for all posts.', 'the-words'),
        'section' => 'single_post_section',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('ed_post_date',
    array(
        'default' => 1,
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'the_words_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_post_date',
    array(
        'label' => esc_html__('Enable Posted Date', 'the-words'),
        'description' => esc_html__('This option will work for all posts.', 'the-words'),
        'section' => 'single_post_section',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('ed_post_excerpt',
    array(
        'default' => 1,
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'the_words_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_post_excerpt',
    array(
        'label' => esc_html__('Enable Post Excerpt', 'the-words'),
        'description' => esc_html__('This option will work for all posts.', 'the-words'),
        'section' => 'single_post_section',
        'type' => 'checkbox',
    )
);