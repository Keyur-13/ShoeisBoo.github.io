<?php
/**
* Sections Repeater Options.
*
* @package Tribunal
*/

$tribunal_post_category_list = tribunal_post_category_list();
$tribunal_defaults = tribunal_get_default_theme_options();
$home_sections = array(
        
        'lead-blocks' => esc_html__('Leader Block','tribunal'),
        'banner-blocks-1' => esc_html__('Banner Block Layout One','tribunal'),
        'latest-posts-blocks' => esc_html__('Latest Posts Block','tribunal'),
        'banner-blocks-2' => esc_html__('Banner Block Layout Two','tribunal'),
        'banner-blocks-3' => esc_html__('Banner Block Layout Three','tribunal'),
        'banner-blocks-4' => esc_html__('Banner Block Layout Four','tribunal'),
        'slider-blocks' => esc_html__('Slider Block','tribunal'),
        'tiles-blocks' => esc_html__('Tiles Block','tribunal'),
        'masonry-blocks' => esc_html__('Masonry Block','tribunal'),
        'post-list-block' => esc_html__('Post List Block','tribunal'),
        'advertise-blocks' => esc_html__('Advertise Block','tribunal'),
        'carousel-blocks' => esc_html__('Carousel Block','tribunal'),

    );


// Slider Section.
$wp_customize->add_section( 'home_sections_repeater',
	array(
	'title'      => esc_html__( 'Homepage Content', 'tribunal' ),
	'priority'   => 150,
	'capability' => 'edit_theme_options',
	)
);


// Recommended Posts Enable Disable.
$wp_customize->add_setting( 'twp_tribunal_home_sections_1', array(
    'sanitize_callback' => 'tribunal_sanitize_repeater',
    'default' => json_encode( $tribunal_defaults['twp_tribunal_home_sections_1'] ),
));

$wp_customize->add_control(  new Tribunal_Repeater_Controler( $wp_customize, 'twp_tribunal_home_sections_1', 
    array(
        'section' => 'home_sections_repeater',
        'settings' => 'twp_tribunal_home_sections_1',
        'tribunal_box_label' => esc_html__('New Section','tribunal'),
        'tribunal_box_add_control' => esc_html__('Add New Section','tribunal'),
        'tribunal_box_add_button' => false,
    ),
        array(
            'section_ed' => array(
                'type'        => 'checkbox',
                'label'       => esc_html__( 'Enable Section', 'tribunal' ),
                'class'       => 'home-section-ed'
            ),
            'home_section_type' => array(
                'type'        => 'select',
                'label'       => esc_html__( 'Section Type', 'tribunal' ),
                'options'     => $home_sections,
                'class'       => 'home-section-type'
            ),
            'home_section_title' => array(
                'type'        => 'text',
                'label'       => esc_html__( 'Section Title', 'tribunal' ),
                'class'       => 'home-repeater-fields-hs post-list-block-fields carousel-blocks-fields'
            ),
            'section_category' => array(
                'type'        => 'select',
                'label'       => esc_html__( 'Post Category', 'tribunal' ),
                'options'     => $tribunal_post_category_list,
                'class'       => 'home-repeater-fields-hs tiles-blocks-fields carousel-blocks-fields slider-blocks-fields lead-blocks-fields masonry-blocks-fields post-list-block-fields'
            ),
             'tiles_post_per_page' => array(
                'type'        => 'select',
                'label'       => esc_html__( 'Posts Per Page', 'tribunal' ),
                'options'     => array( 
                    '5' => 5,
                    '10' => 10,
                ),
                'class'       => 'home-repeater-fields-hs tiles-blocks-fields'
            ),
             'home_section_title_1' => array(
                'type'        => 'text',
                'label'       => esc_html__( 'Slider Area Title', 'tribunal' ),
                'class'       => 'home-repeater-fields-hs banner-blocks-1-fields'
            ),
            'section_post_slide_cat' => array(
                'type'        => 'select',
                'label'       => esc_html__( 'Post Slide Category', 'tribunal' ),
                'options'     => $tribunal_post_category_list,
                'class'       => 'home-repeater-fields-hs banner-blocks-1-fields'
            ),
            'home_section_title_2' => array(
                'type'        => 'text',
                'label'       => esc_html__( 'Tab Area Title', 'tribunal' ),
                'class'       => 'home-repeater-fields-hs banner-blocks-1-fields'
            ),
            'ed_tab' => array(
                'type'        => 'checkbox',
                'label'       => esc_html__( 'Enable Tab', 'tribunal' ),
                'class'       => 'home-repeater-fields-hs ed-tabs-ac banner-blocks-1-fields'
            ),
            'cat_title_1' => array(
                'type'        => 'text',
                'label'       => esc_html__( 'Section Title One', 'tribunal' ),
                'class'       => 'home-repeater-fields-hs banner-blocks-2-fields  banner-blocks-3-fields'
            ),
            'section_category_1' => array(
                'type'        => 'select',
                'label'       => esc_html__( 'Post Category One', 'tribunal' ),
                'options'     => $tribunal_post_category_list,
                'class'       => 'home-repeater-fields-hs banner-blocks-1-fields banner-blocks-2-fields banner-blocks-3-fields banner-blocks-4-fields'
            ),
            'cat_title_2' => array(
                'type'        => 'text',
                'label'       => esc_html__( 'Section Title Two', 'tribunal' ),
                'class'       => 'home-repeater-fields-hs banner-blocks-2-fields  banner-blocks-3-fields'
            ),
            'section_category_2' => array(
                'type'        => 'select',
                'label'       => esc_html__( 'Post Category Two', 'tribunal' ),
                'options'     => $tribunal_post_category_list,
                'class'       => 'home-repeater-fields-hs banner-block-1-tab-ac banner-blocks-1-fields banner-blocks-2-fields banner-blocks-3-fields banner-blocks-4-fields'
            ),
            'cat_title_3' => array(
                'type'        => 'text',
                'label'       => esc_html__( 'Section Title Three', 'tribunal' ),
                'class'       => 'home-repeater-fields-hs banner-blocks-2-fields  banner-blocks-3-fields'
            ),
            'section_category_3' => array(
                'type'        => 'select',
                'label'       => esc_html__( 'Post Category Three', 'tribunal' ),
                'options'     => $tribunal_post_category_list,
                'class'       => 'home-repeater-fields-hs banner-block-1-tab-ac banner-blocks-1-fields banner-blocks-2-fields banner-blocks-3-fields banner-blocks-4-fields'
            ),
            'section_category_4' => array(
                'type'        => 'select',
                'label'       => esc_html__( 'Post Category Four', 'tribunal' ),
                'options'     => $tribunal_post_category_list,
                'class'       => 'home-repeater-fields-hs banner-block-1-tab-ac banner-blocks-1-fields'
            ),
            'advertise_image' => array(
                'type'        => 'upload',
                'label'       => esc_html__( 'Advertise Image', 'tribunal' ),
                'description' => esc_html__( 'Recommended Image Size is 970x250 PX.', 'tribunal' ),
                'class'       => 'home-repeater-fields-hs advertise-blocks-fields'
            ),
            'advertise_link' => array(
                'type'        => 'link',
                'label'       => esc_html__( 'Advertise Image Link', 'tribunal' ),
                'class'       => 'home-repeater-fields-hs advertise-blocks-fields'
            ),
            'ed_arrows_carousel' => array(
                'type'        => 'checkbox',
                'label'       => esc_html__( 'Enable Arrows', 'tribunal' ),
                'class'       => 'home-repeater-fields-hs carousel-blocks-fields banner-blocks-1-fields'
            ),
            'ed_dots_carousel' => array(
                'type'        => 'checkbox',
                'label'       => esc_html__( 'Enable Dot', 'tribunal' ),
                'class'       => 'home-repeater-fields-hs carousel-blocks-fields slider-blocks-fields banner-blocks-1-fields'
            ),
            'ed_autoplay_carousel' => array(
                'type'        => 'checkbox',
                'label'       => esc_html__( 'Enable Autoplay', 'tribunal' ),
                'class'       => 'home-repeater-fields-hs carousel-blocks-fields slider-blocks-fields banner-blocks-1-fields'
            ),
            'ed_flip_column' => array(
                'type'        => 'checkbox',
                'label'       => esc_html__( 'Flip Column Right to Left', 'tribunal' ),
                'class'       => 'home-repeater-fields-hs banner-blocks-1-fields lead-blocks-fields'
            ),
            'ed_ribbon_bg' => array(
                'type'        => 'checkbox',
                'label'       => esc_html__( 'Enable Ribbon Background', 'tribunal' ),
                'class'       => 'home-repeater-fields-hs banner-blocks-1-fields banner-blocks-2-fields banner-blocks-3-fields banner-blocks-4-fields lead-blocks-fields post-list-block-fields ribbon-bg-ac'
            ),
            'ribbon_bg_size' => array(
                'type'        => 'select',
                'label'       => esc_html__( 'Background Size', 'tribunal' ),
                'options'     => array( 
                    'small' => esc_html('Small','tribunal'),
                    'medium' => esc_html('Medium','tribunal'),
                    'large' => esc_html('Large','tribunal'),
                ),
                'class'       => 'home-repeater-fields-hs banner-blocks-1-fields banner-blocks-2-fields banner-blocks-3-fields banner-blocks-4-fields lead-blocks-fields post-list-block-fields ribbon-bg-option-ac'
            ),
            'ribbon_bg_color_schema' => array(
                'type'        => 'selector_color',
                'label'       => esc_html__( 'Background Schema', 'tribunal' ),
                'options'     => array( 
                    '1' =>  array(
                                    'title' =>  esc_html__( 'Blue', 'tribunal' ),
                                    'color' =>  '#3061ff',
                                ),
                    '2' =>  array(
                                    'title' =>  esc_html__( 'Orange', 'tribunal' ),
                                    'color' =>  '#fa9000',
                                ),
                    '3' =>  array(
                                    'title' =>  esc_html__( 'Royal Blue', 'tribunal' ),
                                    'color' =>  '#00167a',
                                ),
                    '4' =>  array(
                                    'title' =>  esc_html__( 'Pink', 'tribunal' ),
                                    'color' =>  '#ff2d55',
                                ),
                ),
                'class'       => 'home-repeater-fields-hs banner-blocks-1-fields banner-blocks-2-fields banner-blocks-3-fields banner-blocks-4-fields lead-blocks-fields post-list-block-fields ribbon-bg-option-ac'
            ),
            
    )
));

// Info.
$wp_customize->add_setting(
    'tribunal_notiece_info',
    array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field'
    )
);
$wp_customize->add_control(
    new Tribunal_Info_Notiece_Control( 
        $wp_customize,
        'tribunal_notiece_info',
        array(
            'settings' => 'tribunal_notiece_info',
            'section'       => 'home_sections_repeater',
            'label'         => esc_html__( 'Info', 'tribunal' ),
        )
    )
);

$wp_customize->add_setting(
    'tribunal_premium_notiece',
    array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field'
    )
);
$wp_customize->add_control(
    new Tribunal_Premium_Notiece_Control( 
        $wp_customize,
        'tribunal_premium_notiece',
        array(
            'label'      => esc_html__( 'Home Page Blocks', 'tribunal' ),
            'settings' => 'tribunal_premium_notiece',
            'section'       => 'home_sections_repeater',
        )
    )
);