<?php
/**
 * The Words Front Page Optionl
 *
 * @package The_Words
 */

$the_words_cat_list = the_words_category_list();

$wp_customize->add_section( 'header_banner_section',
    array(
    'title'      => esc_html__( 'Header Banner', 'the-words' ),
    'capability' => 'edit_theme_options',
    'panel'      => 'the_words_home_panel',
    )
);

$wp_customize->add_setting('ed_header_banner',
    array(
        'default' => 1,
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'the_words_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_header_banner',
    array(
        'label' => esc_html__('Enable Banner Section', 'the-words'),
        'section' => 'header_banner_section',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('ta_header_banner_category',
    array(
        'default' => '0',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'the_words_sanitize_category',
    )
);
$wp_customize->add_control('ta_header_banner_category',
    array(
        'label' => esc_html__('Header Banner Category', 'the-words'),
        'section' => 'header_banner_section',
        'type' => 'select',
        'choices' => $the_words_cat_list,
    )
);

$wp_customize->add_setting('ta_header_banner_layout',
    array(
        'default' => '1',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    )
);
$wp_customize->add_control('ta_header_banner_layout',
    array(
        'label' => esc_html__('Header Banner Layout', 'the-words'),
        'section' => 'header_banner_section',
        'type' => 'select',
        'choices' => array(
            '1' => esc_html__('Layout One', 'the-words'),
            '2' => esc_html__('Layout Two', 'the-words'),
            '3' => esc_html__('Layout Three', 'the-words'),
        )
    )
);

$wp_customize->add_section( 'featured_category_section',
    array(
    'title'      => esc_html__( 'Featured Category Section', 'the-words' ),
    'capability' => 'edit_theme_options',
    'panel'      => 'the_words_home_panel',
    )
);

$wp_customize->add_setting('ed_featured_category_section',
    array(
        'default' => 0,
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'the_words_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_featured_category_section',
    array(
        'label' => esc_html__('Enable Featured Category Section', 'the-words'),
        'section' => 'featured_category_section',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('ta_featured_categoey_1',
    array(
        'default' => '0',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'the_words_sanitize_category',
    )
);
$wp_customize->add_control('ta_featured_categoey_1',
    array(
        'label' => esc_html__('Featured Category One', 'the-words'),
        'section' => 'featured_category_section',
        'type' => 'select',
        'choices' => $the_words_cat_list,
    )
);

$wp_customize->add_setting('ta_featured_categoey_2',
    array(
        'default' => '0',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'the_words_sanitize_category',
    )
);
$wp_customize->add_control('ta_featured_categoey_2',
    array(
        'label' => esc_html__('Featured Category Two', 'the-words'),
        'section' => 'featured_category_section',
        'type' => 'select',
        'choices' => $the_words_cat_list,
    )
);

$wp_customize->add_setting('ta_featured_categoey_3',
    array(
        'default' => '0',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'the_words_sanitize_category',
    )
);
$wp_customize->add_control('ta_featured_categoey_3',
    array(
        'label' => esc_html__('Featured Category Three', 'the-words'),
        'section' => 'featured_category_section',
        'type' => 'select',
        'choices' => $the_words_cat_list,
    )
);