<?php
/**
 * Tribunal Theme Customizer
 *
 * @package Tribunal
 */

/** Sanitize Functions. **/
	require get_template_directory() . '/inc/customizer/default.php';

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
if (!function_exists('tribunal_customize_register')) :

function tribunal_customize_register( $wp_customize ) {

	/** Active Callback Functions. **/
	require get_template_directory() . '/inc/customizer/active-callback.php';

	/** Custom Controls. **/
	require get_template_directory() . '/inc/customizer/custom-classes.php';

	/** Sanitize Functions. **/
	require get_template_directory() . '/inc/customizer/sanitize.php';

	/** Sidebar Options. **/
	require get_template_directory() . '/inc/customizer/layout.php';

	require get_template_directory() . '/inc/customizer/preloader.php';
	
	/** Header Options. **/
	require get_template_directory() . '/inc/customizer/header.php';

	/** Home Content **/
	require get_template_directory() . '/inc/customizer/repeater.php';

	/** Template Cover Options. **/
	require get_template_directory() . '/inc/customizer/template-settings.php';

	/** Pagination **/
	require get_template_directory() . '/inc/customizer/pagination.php';

	/** Posts Options. **/
	require get_template_directory() . '/inc/customizer/post.php';
	
	/** Single Page Options. **/
	require get_template_directory() . '/inc/customizer/single.php';

	/** Footer Options. **/
	require get_template_directory() . '/inc/customizer/footer.php';

	/** Color Schema. **/
	require get_template_directory() . '/inc/customizer/color-schema.php';

	/** Category Color **/
	require get_template_directory() . '/inc/customizer/color-cat.php';

	$wp_customize->get_section( 'colors' )->panel = 'theme_colors_panel';
	$wp_customize->get_section( 'colors' )->title = esc_html__('Color Options','tribunal');
	$wp_customize->get_section( 'title_tagline' )->panel = 'theme_general_settings';
	$wp_customize->get_section( 'header_image' )->panel = 'theme_general_settings';
	$wp_customize->get_section( 'background_image' )->panel = 'theme_general_settings';
    

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'tribunal_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'tribunal_customize_partial_blogdescription',
		) );
	}

	// Theme Options Panel.
	$wp_customize->add_panel( 'theme_option_panel',
		array(
			'title'      => esc_html__( 'Theme Options', 'tribunal' ),
			'priority'   => 150,
			'capability' => 'edit_theme_options',
		)
	);

	$wp_customize->add_panel( 'theme_general_settings',
		array(
			'title'      => esc_html__( 'General Settings', 'tribunal' ),
			'priority'   => 10,
			'capability' => 'edit_theme_options',
		)
	);

	$wp_customize->add_panel( 'theme_colors_panel',
		array(
			'title'      => esc_html__( 'Color Settings', 'tribunal' ),
			'priority'   => 15,
			'capability' => 'edit_theme_options',
		)
	);

	// Template Options
	$wp_customize->add_panel( 'theme_template_pannel',
		array(
			'title'      => esc_html__( 'Template Settings', 'tribunal' ),
			'priority'   => 150,
			'capability' => 'edit_theme_options',
		)
	);

	// Register custom section types.
	$wp_customize->register_section_type( 'Tribunal_Customize_Section_Upsell' );

	// Register sections.
	$wp_customize->add_section(
		new Tribunal_Customize_Section_Upsell(
			$wp_customize,
			'theme_upsell',
			array(
				'title'    => esc_html__( 'Tribunal Pro', 'tribunal' ),
				'pro_text' => esc_html__( 'Upgrade To Pro', 'tribunal' ),
				'pro_url'  => esc_url('https://www.themeinwp.com/theme/tribunal-pro/'),
				'priority'  => 1,
			)
		)
	);

}

endif;
add_action( 'customize_register', 'tribunal_customize_register' );

/**
 * Customizer Enqueue scripts and styles.
 */

if (!function_exists('tribunal_customizer_scripts')) :

    function tribunal_customizer_scripts(){   
    	
    	wp_enqueue_script('jquery-ui-button');
    	wp_enqueue_style('tribunal-customizer', get_template_directory_uri() . '/assets/lib/custom/css/customizer.css');
        wp_enqueue_script('tribunal-customizer', get_template_directory_uri() . '/assets/lib/custom/js/customizer.js', array('jquery','customize-controls'), '', 1);

        $ajax_nonce = wp_create_nonce('tribunal_customizer_ajax_nonce');
        wp_localize_script( 
		    'tribunal-customizer', 
		    'tribunal_customizer',
		    array(
		        'ajax_url'   => esc_url( admin_url( 'admin-ajax.php' ) ),
		        'ajax_nonce' => $ajax_nonce,
		     )
		);
    }

endif;

add_action('customize_controls_enqueue_scripts', 'tribunal_customizer_scripts');
add_action('customize_controls_init', 'tribunal_customizer_scripts');

/**
 * Customizer Enqueue scripts and styles.
 */
function tribunal_customizer_repearer(){   
	
	wp_enqueue_style('tribunal-repeater', get_template_directory_uri() . '/assets/lib/custom/css/repeater.css');
    wp_enqueue_script('tribunal-repeater', get_template_directory_uri() . '/assets/lib/custom/js/repeater.js', array('jquery','customize-controls'), '', 1);

    $tribunal_post_category_list = tribunal_post_category_list();

    $cat_option = '';

    if( $tribunal_post_category_list ){
	    foreach( $tribunal_post_category_list as $key => $cats ){
	    	$cat_option .= "<option value='". esc_attr( $key )."'>". esc_html( $cats )."</option>";
	    }
	}

    wp_localize_script( 
        'tribunal-repeater', 
        'tribunal_repeater',
        array(
            'optionns'   => "
            				<option value='lead-blocks'>". esc_html__('Leader Block','tribunal')."</option>
            				<option value='banner-blocks-1'>". esc_html__('Banner Block Layout One','tribunal')."</option>
            				<option value='latest-posts-blocks'>". esc_html__('Latest Posts Block','tribunal')."</option>
            				<option value='banner-blocks-2'>". esc_html__('Banner Block Layout Two','tribunal')."</option>
            				<option value='banner-blocks-3'>". esc_html__('Banner Block Layout Three','tribunal')."</option>
            				<option value='banner-blocks-4'>". esc_html__('Banner Block Layout Four','tribunal')."</option>
            				<option selected='selected' value='slider-blocks'>". esc_html__('Slider Block','tribunal')."</option>
        					<option value='tiles-blocks'>". esc_html__('Tiles Block','tribunal')."</option>
        					<option value='masonry-blocks'>". esc_html__('Masonry Block','tribunal')."</option>
            				<option value='post-list-block'>". esc_html__('Post List Block','tribunal')."</option>
            				<option value='carousel-blocks'>". esc_html__('Carousel Block','tribunal')."</option>
            				<option value='advertise-blocks'>". esc_html__('Advertise Block','tribunal')."</option>",
           	'categories'   => $cat_option,
            'new_section'   =>  esc_html__('New Section','tribunal'),
            'upload_image'   =>  esc_html__('Choose Image','tribunal'),
            'use_imahe'   =>  esc_html__('Select','tribunal'),
         )
    );

    wp_localize_script( 
        'tribunal-customizer', 
        'tribunal_customizer',
        array(
            'ajax_url'   => esc_url( admin_url( 'admin-ajax.php' ) ),
         )
    );
}

add_action('customize_controls_enqueue_scripts', 'tribunal_customizer_repearer');

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */

if (!function_exists('tribunal_customize_partial_blogname')) :

	function tribunal_customize_partial_blogname() {
		bloginfo( 'name' );
	}
endif;

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */

if (!function_exists('tribunal_customize_partial_blogdescription')) :

	function tribunal_customize_partial_blogdescription() {
		bloginfo( 'description' );
	}

endif;


add_action('wp_ajax_tribunal_customizer_font_weight', 'tribunal_customizer_font_weight_callback');
add_action('wp_ajax_nopriv_tribunal_customizer_font_weight', 'tribunal_customizer_font_weight_callback');

// Recommendec Post Ajax Call Function.
function tribunal_customizer_font_weight_callback() {

    if ( isset( $_POST['_wpnonce'] ) && wp_verify_nonce( sanitize_hex_color( wp_unslash( $_POST['_wpnonce'] ) ), 'tribunal_ajax_nonce' ) && isset( $_POST['currentfont'] ) && sanitize_hex_color( wp_unslash( $_POST['currentfont'] ) ) ){

       $currentfont = sanitize_hex_color( wp_unslash( $_POST['currentfont'] ) );
       $headings_fonts_property = Tribunal_Fonts::tribunal_get_fonts_property( $currentfont );

       foreach( $headings_fonts_property['weight'] as $key => $value ){
       		echo '<option value="'.esc_attr( $key ).'">'.esc_html( $value ).'</option>';
       }
    }
    wp_die();
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function tribunal_customize_preview_js() {
	wp_enqueue_script( 'tribunal-customizer-preview', get_template_directory_uri() . '/assets/lib/custom/js/customizer-preview.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'tribunal_customize_preview_js' );