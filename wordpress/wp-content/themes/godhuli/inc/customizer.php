<?php
/**
 * Godhuli Theme Customizer
 *
 * @package Godhuli
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */


function godhuli_theme_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'godhuli_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'godhuli_customize_partial_blogdescription',
			)
		);
	}

	$wp_customize->add_panel(
		'godhuli_panel',
		array(
			'priority'       => 40,
			'capability'     => 'edit_theme_options',
			'theme_supports' => '',
			'title'          => esc_html__( 'Godhuli Options', 'godhuli' ),
		)
	);

	/* Theme color options start */

	$wp_customize->add_section(
		'godhuli_color_setting',
		array(
			'capability' => 'edit_theme_options',
			'title'      => esc_html__( 'Colors', 'godhuli' ),
			'panel'      => 'godhuli_panel',
		)
	);

	$wp_customize->add_setting(
		'godhuli_theme_color',
		array(
			'default'           => '#79be49',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability'        => 'edit_theme_options',
			'transport'         => 'refresh',

		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'godhuli_theme_color_section',
			array(
				'label'    => __( 'Theme Color', 'godhuli' ),
				'section'  => 'godhuli_color_setting',
				'settings' => 'godhuli_theme_color',
			)
		)
	);

	/* Theme color options end */

	/* Post Slider Options */
	$wp_customize->add_section(
		'godhuli_slide_setting',
		array(
			'capability' => 'edit_theme_options',
			'title'      => esc_html__( 'Post carousel', 'godhuli' ),
			'panel'      => 'godhuli_panel',
		)
	);

	$wp_customize->add_setting(
		'godhuli_disable_slide',
		array(
			'capability'        => 'edit_theme_options',
			'transport'         => 'refresh',
			'sanitize_callback' => 'godhuli_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		'godhuli_disable_slide',
		array(
			'settings' => 'godhuli_disable_slide',
			'label'    => esc_html__( 'Enable Post carousel', 'godhuli' ),
			'section'  => 'godhuli_slide_setting',
			'type'     => 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'post_slide_number',
		array(
			'capability'        => 'edit_theme_options',
			'default'           => 2,
			'transport'         => 'refresh',
			'sanitize_callback' => 'absint',
		)
	);
	$wp_customize->add_control(
		'post_slide_number',
		array(
			'label'       => __( 'Number of posts', 'godhuli' ),
			'section'     => 'godhuli_slide_setting',
			'type'        => 'number',
			'description' => esc_html__( 'Put minimum value 2', 'godhuli' ),
		)
	);

	$wp_customize->add_setting(
		'post_slider_category',
		array(
			'capability'        => 'edit_theme_options',
			'default'           => 'uncategorized',
			'transport'         => 'refresh',
			'sanitize_callback' => 'godhuli_sanitize_select',
		)
	);
	$wp_customize->add_control(
		'post_slider_category',
		array(
			'label'       => __( 'Select Category', 'godhuli' ),
			'description' => __( 'Please select the category for the carousel', 'godhuli' ),
			'section'     => 'godhuli_slide_setting',
			'type'        => 'select',
			'choices'     => godhuli_fatch_all_cats(),
		)
	);

	$wp_customize->add_setting(
		'post_slider_order',
		array(
			'capability'        => 'edit_theme_options',
			'default'           => 'DESC',
			'transport'         => 'refresh',
			'sanitize_callback' => 'godhuli_sanitize_order',
		)
	);

	$wp_customize->add_control(
		'post_slider_order',
		array(
			'label'       => __( 'Order', 'godhuli' ),
			'description' => __( 'ASC - ascending order from lowest to highest values (1, 2, 3; a, b, c) & DESC - descending order from highest to lowest values (3, 2, 1; c, b, a).', 'godhuli' ),
			'section'     => 'godhuli_slide_setting',
			'settings'    => 'post_slider_order',
			'type'        => 'select',
			'choices'     => array(
				'ASC'  => 'ASC',
				'DESC' => 'DESC',
			),
		)
	);

	$wp_customize->add_setting(
		'post_slider_orderby',
		array(
			'capability'        => 'edit_theme_options',
			'default'           => 'date',
			'transport'         => 'refresh',
			'sanitize_callback' => 'godhuli_sanitize_orderby',
		)
	);
	$wp_customize->add_control(
		'post_slider_orderby',
		array(
			'label'       => __( 'Order By', 'godhuli' ),
			'description' => __( 'Sort retrieved posts by parameter. Defaults to "date".', 'godhuli' ),
			'section'     => 'godhuli_slide_setting',
			'settings'    => 'post_slider_orderby',
			'type'        => 'select',
			'choices'     => array(
				'ID'         => 'ID',
				'author'     => 'author',
				'title'      => 'title',
				'name'       => 'name',
				'date'       => 'date',
				'rand'       => 'rand',
				'menu_order' => 'menu_order',
			),
		)
	);

	/* Post Slider Options end */

	/* Post options */
	$wp_customize->add_section(
		'godhuli_post_setting',
		array(
			'capability' => 'edit_theme_options',
			'title'      => esc_html__( 'Post', 'godhuli' ),
			'panel'      => 'godhuli_panel',
		)
	);

	$wp_customize->add_setting(
		'post_layout',
		array(
			'default'           => 'fullwidth',
			'capability'        => 'edit_theme_options',
			'transport'         => 'refresh',
			'sanitize_callback' => 'godhuli_sanitize_select',
		)
	);
	$wp_customize->add_control(
		'post_layout',
		array(
			'settings' => 'post_layout',
			'label'    => esc_html__( 'Post Layout', 'godhuli' ),
			'section'  => 'godhuli_post_setting',
			'type'     => 'select',
			'choices'  => array(
				'fullwidth' => esc_html__( 'Full Width', 'godhuli' ),
				'right'     => esc_html__( 'Sidebar Right', 'godhuli' ),
			),
		)
	);

	$wp_customize->add_setting(
		'single_post_layout',
		array(
			'default'           => 'fullwidth',
			'capability'        => 'edit_theme_options',
			'transport'         => 'refresh',
			'sanitize_callback' => 'godhuli_sanitize_select',
		)
	);
	$wp_customize->add_control(
		'single_post_layout',
		array(
			'settings' => 'single_post_layout',
			'label'    => esc_html__( 'Single Post Layout', 'godhuli' ),
			'section'  => 'godhuli_post_setting',
			'type'     => 'select',
			'choices'  => array(
				'fullwidth' => esc_html__( 'Full Width', 'godhuli' ),
				'right'     => esc_html__( 'Sidebar Right', 'godhuli' ),
			),
		)
	);

	$wp_customize->add_setting(
		'remove_date',
		array(
			'capability'        => 'edit_theme_options',
			'transport'         => 'refresh',
			'sanitize_callback' => 'godhuli_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'remove_date',
		array(
			'settings' => 'remove_date',
			'label'    => esc_html__( 'Remove Date', 'godhuli' ),
			'section'  => 'godhuli_post_setting',
			'type'     => 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'godhuli_remove_top_cat',
		array(
			'capability'        => 'edit_theme_options',
			'transport'         => 'refresh',
			'sanitize_callback' => 'godhuli_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'godhuli_remove_top_cat',
		array(
			'settings' => 'godhuli_remove_top_cat',
			'label'    => esc_html__( 'Remove category before title', 'godhuli' ),
			'section'  => 'godhuli_post_setting',
			'type'     => 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'godhuli_remove_author_name',
		array(
			'capability'        => 'edit_theme_options',
			'transport'         => 'refresh',
			'sanitize_callback' => 'godhuli_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'godhuli_remove_author_name',
		array(
			'settings' => 'godhuli_remove_author_name',
			'label'    => esc_html__( 'Remove author name (Bottom of post title)', 'godhuli' ),
			'section'  => 'godhuli_post_setting',
			'type'     => 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'godhuli_remove_comment_text',
		array(
			'capability'        => 'edit_theme_options',
			'transport'         => 'refresh',
			'sanitize_callback' => 'godhuli_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'godhuli_remove_comment_text',
		array(
			'settings' => 'godhuli_remove_comment_text',
			'label'    => esc_html__( 'Remove comment text (Below post title)', 'godhuli' ),
			'section'  => 'godhuli_post_setting',
			'type'     => 'checkbox',
		)
	);

	/*
	 * Post Archive setting
	 */

	$wp_customize->add_section(
		'godhuli_post_archive',
		array(
			'capability' => 'edit_theme_options',
			'title'      => esc_html__( 'Single Post', 'godhuli' ),
			'panel'      => 'godhuli_panel',
		)
	);

	$wp_customize->add_setting(
		'godhuli_remove_single_cats',
		array(
			'capability'        => 'edit_theme_options',
			'transport'         => 'refresh',
			'sanitize_callback' => 'godhuli_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'godhuli_remove_single_cats',
		array(
			'settings' => 'godhuli_remove_single_cats',
			'label'    => esc_html__( 'Remove category list (Bottom of posts)', 'godhuli' ),
			'section'  => 'godhuli_post_archive',
			'type'     => 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'godhuli_remove_single_tags',
		array(
			'capability'        => 'edit_theme_options',
			'transport'         => 'refresh',
			'sanitize_callback' => 'godhuli_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'godhuli_remove_single_tags',
		array(
			'settings' => 'godhuli_remove_single_tags',
			'label'    => esc_html__( 'Remove tag list (Bottom of posts)', 'godhuli' ),
			'section'  => 'godhuli_post_archive',
			'type'     => 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'godhuli_remove_related_posts',
		array(
			'capability'        => 'edit_theme_options',
			'transport'         => 'refresh',
			'sanitize_callback' => 'godhuli_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'godhuli_remove_related_posts',
		array(
			'settings' => 'godhuli_remove_related_posts',
			'label'    => esc_html__( 'Remove related post', 'godhuli' ),
			'section'  => 'godhuli_post_archive',
			'type'     => 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'godhuli_remove_author_box',
		array(
			'capability'        => 'edit_theme_options',
			'transport'         => 'refresh',
			'sanitize_callback' => 'godhuli_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'godhuli_remove_author_box',
		array(
			'settings' => 'godhuli_remove_author_box',
			'label'    => esc_html__( 'Remove author box', 'godhuli' ),
			'section'  => 'godhuli_post_archive',
			'type'     => 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'godhuli_related_post_count',
		array(
			'capability'        => 'edit_theme_options',
			'default'           => 3,
			'transport'         => 'refresh',
			'sanitize_callback' => 'absint',

		)
	);

	$wp_customize->add_control(
		'godhuli_related_post_count',
		array(
			'settings' => 'godhuli_related_post_count',
			'label'    => esc_html__( 'Number Related Post', 'godhuli' ),
			'section'  => 'godhuli_post_archive',
			'type'     => 'number',
		)
	);

	/* Post options end */

	/* Footer Options */
	$wp_customize->add_section(
		'godhuli_footer_setting',
		array(
			'capability' => 'edit_theme_options',
			'title'      => esc_html__( 'Footer', 'godhuli' ),
			'panel'      => 'godhuli_panel',
		)
	);

	$wp_customize->add_setting(
		'godhuli_footer_copyright',
		array(
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'wp_filter_nohtml_kses',
		)
	);
	$wp_customize->add_control(
		'footer_copyright',
		array(
			'settings' => 'godhuli_footer_copyright',
			'label'    => esc_html__( 'Footer Copyright', 'godhuli' ),
			'section'  => 'godhuli_footer_setting',
			'type'     => 'textarea',

		)
	);
	/* Footer Options end */

}

add_action( 'customize_register', 'godhuli_theme_customize_register' );





/**
 * Godhuli sanitization function
 */

function godhuli_sanitize_checkbox( $input ) {
	return ( 1 === absint( $input ) ) ? 1 : 0;
}

function godhuli_sanitize_select( $input, $setting ) {
	// input must be a slug: lowercase alphanumeric characters, dashes and underscores are allowed only
	$input = sanitize_key( $input );
	// get the list of possible select options
	$choices = $setting->manager->get_control( $setting->id )->choices;
	// return input if valid or return default option
	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}

function godhuli_sanitize_order( $value ) {
	if ( ! in_array( $value, array( 'ASC', 'DESC' ), true ) ) {
		$value = 'DESC';
	}

	return $value;
}

function godhuli_sanitize_orderby( $value ) {
	if ( ! in_array( $value, array( 'ID', 'author', 'title', 'name', 'date', 'rand', 'menu_order' ), true ) ) {
		$value = 'date';
	}

	return $value;
}


/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function godhuli_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function godhuli_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function godhuli_customize_preview_js() {
	wp_enqueue_script( 'godhuli-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'godhuli_customize_preview_js' );












