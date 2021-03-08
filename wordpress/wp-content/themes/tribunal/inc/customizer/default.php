<?php
/**
 * Default Values.
 *
 * @package Tribunal
 */

if (!function_exists('tribunal_get_default_theme_options')) :

    /**
     * Get default theme options
     *
     * @return array Default theme options.
     * @since 1.0.0
     *
     */
    function tribunal_get_default_theme_options()
    {

        $tribunal_defaults = array();

        $tribunal_defaults['tribunal_category_colors'] = array(
            array(
                'category' => '',
                'category_color' => '#d0021b',
            ),
        );

        $tribunal_defaults['twp_tribunal_home_sections_1'] = array(

            array(
                'home_section_type' => 'tiles-blocks',
                'section_ed' => 'no',
                'section_category' => '',
                'tiles_post_per_page' => 5,
            ),
            array(
                'home_section_type' => 'lead-blocks',
                'section_ed' => 'no',
                'section_category' => '',
                'ed_flip_column' => 'no',
                'ed_ribbon_bg'  => 'no',
                'ribbon_bg_size' => 'medium',
                'ribbon_bg_color_schema' => '1',
            ),
            array(
                'home_section_type' => 'banner-blocks-1',
                'section_ed' => 'no',
                'section_category_1' => '',
                'section_category_2' => '',
                'section_category_3' => '',
                'ed_flip_column' => 'no',
                'ed_tab' => 'no',
                'ed_ribbon_bg'  => 'no',
                'ribbon_bg_size' => 'medium',
                'ribbon_bg_color_schema' => '2',
                'ed_arrows_carousel' => 'yes',
                'ed_dots_carousel' => 'no',
                'ed_autoplay_carousel' => 'yes',
                'home_section_title_1' => esc_html__('Block Title One','tribunal'),
                'home_section_title_2' => esc_html__('Block Title Tab','tribunal'),
            ),
            array(
                'home_section_type' => 'latest-posts-blocks',
                'section_ed' => 'yes',
            ),
            array(
                'home_section_type' => 'banner-blocks-2',
                'section_ed' => 'no',
                'section_category_1' => '',
                'section_category_2' => '',
                'section_category_3' => '',
                'ed_ribbon_bg'  => 'no',
                'ribbon_bg_size' => 'medium',
                'ribbon_bg_color_schema' => '3',
                'cat_title_1' => esc_html__('Section Title 1','tribunal'),
                'cat_title_2' => esc_html__('Section Title 2','tribunal'),
                'cat_title_3' => esc_html__('Section Title 3','tribunal'),
            ),
            array(
                'home_section_type' => 'banner-blocks-3',
                'section_ed' => 'no',
                'section_category_1' => '',
                'section_category_2' => '',
                'section_category_3' => '',
                'ed_ribbon_bg'  => 'no',
                'ribbon_bg_size' => 'medium',
                'ribbon_bg_color_schema' => '4',
                'cat_title_1' => esc_html__('Section Title 1','tribunal'),
                'cat_title_2' => esc_html__('Section Title 2','tribunal'),
                'cat_title_3' => esc_html__('Section Title 3','tribunal'),
                
            ),
            array(
                'home_section_type' => 'banner-blocks-4',
                'section_ed' => 'no',
                'section_category_1' => '',
                'section_category_2' => '',
                'section_category_3' => '',
                'ed_ribbon_bg'  => 'no',
                'ribbon_bg_size' => 'medium',
                'ribbon_bg_color_schema' => '4',
                
            ),
            array(
                'home_section_type' => 'slider-blocks',
                'section_ed' => 'no',
                'ed_dots_carousel' => 'no',
                'ed_autoplay_carousel' => 'yes',
            ),
            
            array(
                'home_section_type' => 'masonry-blocks',
                'section_ed' => 'no',
                'section_category' => '',
            ),
            
            array(
                'home_section_type' => 'post-list-block',
                'section_ed' => 'no',
                'section_category' => '',
                'ed_ribbon_bg'  => 'no',
                'ribbon_bg_size' => 'medium',
                'ribbon_bg_color_schema' => '4',
                'home_section_title' => esc_html__('Block Title','tribunal'),
                
            ),
            array(
                'home_section_type' => 'advertise-blocks',
                'section_ed' => 'no',
                'advertise_image' => '',
                'advertise_link' => '',
            ),
            array(
                'home_section_type' => 'carousel-blocks',
                'section_ed' => 'no',
                'ed_arrows_carousel' => 'yes',
                'ed_dots_carousel' => 'no',
                'ed_autoplay_carousel' => 'yes',
                'home_section_title' => esc_html__('Block Title','tribunal'),
            ),
        );

        // Options.
        $tribunal_defaults['global_sidebar_layout'] = 'right-sidebar';
        $tribunal_defaults['template_cover_sidebar_layout'] = 'no-sidebar';
        $tribunal_defaults['template_cover_full_width_sidebar_layout'] = 'no-sidebar';
        $tribunal_defaults['template_carousel_sidebar_settings'] = 'no-sidebar';
        $tribunal_defaults['template_slider_sidebar_settings'] = 'no-sidebar';
        $tribunal_defaults['tribunal_archive_layout'] = 'default';
        $tribunal_defaults['tribunal_pagination_layout'] = 'numeric';
        $tribunal_defaults['footer_column_layout'] = 3;
        $tribunal_defaults['footer_copyright_text'] = esc_html__('All rights reserved.', 'tribunal');
        $tribunal_defaults['ed_header_search'] = 1;
        $tribunal_defaults['ed_ticker_slider_autoplay'] = 1;
        $tribunal_defaults['ed_header_ad'] = 0;
        $tribunal_defaults['ed_header_ticker_posts'] = 1;
        $tribunal_defaults['ed_header_ticker_posts_title'] = esc_html__('Breaking News', 'tribunal');
        $tribunal_defaults['ed_image_content_inverse'] = 0;
        $tribunal_defaults['ed_header_responsive_menu'] = 0;
        $tribunal_defaults['tribunal_body_font'] = 'Roboto';
        $tribunal_defaults['tribunal_heading_font'] = 'Merriweather';
        $tribunal_defaults['tribunal_tertiary_font']         = 'Roboto Mono';
        $tribunal_defaults['ed_related_post'] = 1;
        $tribunal_defaults['related_post_title'] = esc_html__('Related Post', 'tribunal');
        $tribunal_defaults['twp_navigation_type'] = 'norma-navigation';
        $tribunal_defaults['tribunal_single_post_layout'] = 'layout-1';
        $tribunal_defaults['ed_post_date'] = 1;
        $tribunal_defaults['ed_post_category'] = 1;
        $tribunal_defaults['ed_header_tags'] = 0;
        $tribunal_defaults['ed_post_tags'] = 1;
        $tribunal_defaults['ed_header_tags_title'] = esc_html__('#  Top Tags', 'tribunal');
        $tribunal_defaults['ed_header_tags_count'] = 10;
        $tribunal_defaults['ed_header_overlay'] = 0;
        $tribunal_defaults['ed_template_header_overlay'] = 0;
        $tribunal_defaults['ed_template_full_header_overlay'] = 0;
        $tribunal_defaults['ed_floating_next_previous_nav'] = 1;
        $tribunal_defaults['tribunal_header_layout'] = 'layout-1';        
        $tribunal_defaults['tribunal_header_bg_size'] = 1;
        $tribunal_defaults['ed_preloader'] = 1;
        $tribunal_defaults['ed_header_bg_fixed'] = 0;
        $tribunal_defaults['ed_header_bg_overlay'] = 1;
        $tribunal_defaults['post_date_format'] = 'default';
        $tribunal_defaults['ed_fullwidth_layout'] = 1;
        $tribunal_defaults['ed_template_carousel_banner'] = 1;
        $tribunal_defaults['ed_template_slider_banner'] = 1;
        $tribunal_defaults['ed_template_full_cover_banner'] = 1;
        $tribunal_defaults['ed_template_cover_banner'] = 1;
        $tribunal_defaults['ed_template_carousel_arrow'] = 1;
        $tribunal_defaults['ed_template_carousel_dots'] = 0;
        $tribunal_defaults['ed_template_carousel_autoplay'] = 1;
        $tribunal_defaults['ed_template_slider_arrows'] = 1;
        $tribunal_defaults['ed_template_slider_dots'] = 0;
        $tribunal_defaults['ed_template_slider_autoplay'] = 1;
        $tribunal_defaults['ed_affix_post'] = 0;
        $tribunal_defaults['ed_post_views'] = 0;
        $tribunal_defaults['ed_affix_post_arrow'] = 1;
        $tribunal_defaults['ed_affix_post_autoplay'] = 1;
        $tribunal_defaults['ed_scroll_top_button'] = 1;

        $tribunal_defaults['tribunal_primary_color'] = '#fff';
        $tribunal_defaults['tribunal_secondary_color'] = '#d0021b';
        $tribunal_defaults['tribunal_color_schema'] = 'default';
        
        $tribunal_defaults['default_bg_color'] = '#f7f8f9';
        $tribunal_defaults['default_primary_color'] = '#fff';
        $tribunal_defaults['default_secondary_color'] = '#d0021b';
        $tribunal_defaults['default_tertiary_color'] = '#ffca05';
        $tribunal_defaults['default_link_color'] = '#d0021b';
        $tribunal_defaults['default_link_hover_color'] = '#2568ef';
        $tribunal_defaults['default_text_color'] = '#1A1B1F';

        $tribunal_defaults['fancy_bg_color'] = '#3CA2C8';
        $tribunal_defaults['fancy_primary_color'] = '#10559A';
        $tribunal_defaults['fancy_secondary_color'] = '#DB4C77';
        $tribunal_defaults['fancy_tertiary_color'] = '#d0021b';
        $tribunal_defaults['fancy_link_color'] = '#1A1B1F';
        $tribunal_defaults['fancy_link_hover_color'] = '#1A1B1F';
        $tribunal_defaults['fancy_text_color'] = '#FFFFFF';

        $tribunal_defaults['dark_bg_color'] = '#181818';
        $tribunal_defaults['dark_primary_color'] = '#111111';
        $tribunal_defaults['dark_secondary_color'] = '#d0021b';
        $tribunal_defaults['dark_tertiary_color'] = '#ffca05';
        $tribunal_defaults['dark_link_color'] = '#FFFFFF';
        $tribunal_defaults['dark_link_hover_color'] = '#2568ef';
        $tribunal_defaults['dark_text_color'] = '#FFFFFF';

        $tribunal_defaults['shady_bg_color'] = '#1a1551';
        $tribunal_defaults['shady_primary_color'] = '#153151';
        $tribunal_defaults['shady_secondary_color'] = '#4b1551';
        $tribunal_defaults['shady_tertiary_color'] = '#155143';
        $tribunal_defaults['shady_link_color'] = '#d0021b';
        $tribunal_defaults['shady_link_hover_color'] = '#d0021b';
        $tribunal_defaults['shady_text_color'] = '#fff';
        $tribunal_defaults['ed_header_search_recent_posts']             = 1;
        $tribunal_defaults['ed_header_search_top_category']             = 1;
        $tribunal_defaults['recent_post_title_search']                 = esc_html__('Recent Post','tribunal');
        $tribunal_defaults['top_category_title_search']                 = esc_html__('Top Category','tribunal');

        // Pass through filter.
        $tribunal_defaults = apply_filters('tribunal_filter_default_theme_options', $tribunal_defaults);

        return $tribunal_defaults;

    }

endif;
