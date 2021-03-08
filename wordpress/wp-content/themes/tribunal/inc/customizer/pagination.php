<?php
/**
 * Pagination Settings
 *
 * @package Tribunal
 */

$tribunal_default = tribunal_get_default_theme_options();

// Pagination Section.
$wp_customize->add_section( 'tribunal_pagination_section',
	array(
	'title'      => esc_html__( 'Pagination Settings', 'tribunal' ),
	'priority'   => 20,
	'capability' => 'edit_theme_options',
	'panel'		 => 'theme_option_panel',
	)
);

// Pagination Layout Settings
$wp_customize->add_setting( 'tribunal_pagination_layout',
	array(
	'default'           => $tribunal_default['tribunal_pagination_layout'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( 'tribunal_pagination_layout',
	array(
	'label'       => esc_html__( 'Pagination Method', 'tribunal' ),
	'section'     => 'tribunal_pagination_section',
	'type'        => 'select',
	'choices'     => array(
		'next-prev' => esc_html__('Next/Previous Method','tribunal'),
		'numeric' => esc_html__('Numeric Method','tribunal'),
		'load-more' => esc_html__('Ajax Load More Button','tribunal'),
		'auto-load' => esc_html__('Ajax Auto Load','tribunal'),
	),
	)
);