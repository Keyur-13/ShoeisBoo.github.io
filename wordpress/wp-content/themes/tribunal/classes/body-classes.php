<?php
/**
* Body Classes.
*
* @package Tribunal
*/
 
 if (!function_exists('tribunal_body_classes')) :

    function tribunal_body_classes($classes) {

        $tribunal_default = tribunal_get_default_theme_options();
        global $post;

        // Adds a class of hfeed to non-singular pages.
        if ( !is_singular() ) {
            $classes[] = 'hfeed';
        }

        // Adds a class of no-sidebar when there is no sidebar present.
        if ( !is_active_sidebar( 'sidebar-1' ) ) {
            $classes[] = 'no-sidebar';
        }

        if( is_page_template('templates/template-cover.php') ){
            $ed_template_header_overlay = esc_html( get_theme_mod( 'ed_template_header_overlay',$tribunal_default['ed_template_header_overlay'] ) );
            if( $ed_template_header_overlay ){
                $classes[] = 'tribunal-template-header-overlay';
            }
        }

        if( is_page_template('templates/template-cover-full-width.php') ){
            $ed_template_full_header_overlay = esc_html( get_theme_mod( 'ed_template_full_header_overlay',$tribunal_default['ed_template_full_header_overlay'] ) );
            if( $ed_template_full_header_overlay ){
                $classes[] = 'tribunal-template-header-overlay';
            }
        }
        if ( is_active_sidebar( 'sidebar-1' ) ) {

            $global_sidebar_layout = esc_html( get_theme_mod( 'global_sidebar_layout',$tribunal_default['global_sidebar_layout'] ) );
            
            if( is_page_template('templates/template-cover.php') ){

                $tribunal_post_sidebar = esc_html( get_post_meta( $post->ID, 'tribunal_post_sidebar_option', true ) );

                if( $tribunal_post_sidebar == 'global-sidebar' || empty( $tribunal_post_sidebar ) ){

                    $template_cover_sidebar_layout = esc_html( get_theme_mod( 'template_cover_sidebar_layout',$tribunal_default['template_cover_sidebar_layout'] ) );
                    $classes[] = esc_attr( $template_cover_sidebar_layout );

                }else{

                    $classes[] = esc_attr( $tribunal_post_sidebar );

                }

            }elseif( is_page_template('templates/template-cover-full-width.php') ){

                $tribunal_post_sidebar = esc_html( get_post_meta( $post->ID, 'tribunal_post_sidebar_option', true ) );

                if( $tribunal_post_sidebar == 'global-sidebar' || empty( $tribunal_post_sidebar ) ){

                    $template_cover_full_width_sidebar_layout = esc_html( get_theme_mod( 'template_cover_full_width_sidebar_layout',$tribunal_default['template_cover_full_width_sidebar_layout'] ) );
                    $classes[] = esc_attr( $template_cover_full_width_sidebar_layout );

                }else{

                    $classes[] = esc_attr( $tribunal_post_sidebar );

                }

            }elseif( is_page_template('templates/template-carousel.php') ){

                $tribunal_post_sidebar = esc_html( get_post_meta( $post->ID, 'tribunal_post_sidebar_option', true ) );

                if( $tribunal_post_sidebar == 'global-sidebar' || empty( $tribunal_post_sidebar ) ){

                    $template_carousel_sidebar_settings = esc_html( get_theme_mod( 'template_carousel_sidebar_settings',$tribunal_default['template_carousel_sidebar_settings'] ) );
                    $classes[] = esc_attr( $template_carousel_sidebar_settings );

                }else{

                    $classes[] = esc_attr( $tribunal_post_sidebar );

                }

            }elseif( is_page_template('templates/template-slider.php') ){

                $tribunal_post_sidebar = esc_html( get_post_meta( $post->ID, 'tribunal_post_sidebar_option', true ) );

                if( $tribunal_post_sidebar == 'global-sidebar' || empty( $tribunal_post_sidebar ) ){

                    $template_slider_sidebar_settings = esc_html( get_theme_mod( 'template_slider_sidebar_settings',$tribunal_default['template_slider_sidebar_settings'] ) );
                    $classes[] = esc_attr( $template_slider_sidebar_settings );

                }else{

                    $classes[] = esc_attr( $tribunal_post_sidebar );

                }

            }elseif( is_page_template('templates/template-read-later-posts.php') ){

                $tribunal_post_sidebar = esc_html( get_post_meta( $post->ID, 'tribunal_post_sidebar_option', true ) );

                if( $tribunal_post_sidebar == 'global-sidebar' || empty( $tribunal_post_sidebar ) ){

                    $classes[] = esc_attr( $global_sidebar_layout );

                }else{

                    $classes[] = esc_attr( $tribunal_post_sidebar );

                }

            }else{

                if( is_single() || is_page() ){

                    $tribunal_post_sidebar = esc_html( get_post_meta( $post->ID, 'tribunal_post_sidebar_option', true ) );

                    if( $tribunal_post_sidebar == 'global-sidebar' || empty( $tribunal_post_sidebar ) ){

                        if( class_exists('WooCommerce') && ( is_cart() || is_checkout() ) ){
                            
                            $classes[] = 'no-sidebar';

                        }else{

                            $classes[] = esc_attr( $global_sidebar_layout );

                        }

                    }else{

                        if( class_exists('WooCommerce') && ( is_cart() || is_checkout() ) ){
                            
                            $classes[] = 'no-sidebar';

                        }else{

                            $classes[] = esc_attr( $tribunal_post_sidebar );

                        }
                    }
                    
                }elseif( is_404() ){

                    $classes[] = 'no-sidebar';

                }else{
                    
                    $classes[] = esc_attr( $global_sidebar_layout );
                }

            }

        }

        if( is_page() ){

            $tribunal_header_trending_page = get_theme_mod( 'tribunal_header_trending_page' );
            $tribunal_header_popular_page = get_theme_mod( 'tribunal_header_popular_page' );

            if( $tribunal_header_trending_page == $post->ID || $tribunal_header_popular_page == $post->ID ){

                $tribunal_archive_layout = get_theme_mod( 'tribunal_archive_layout',$tribunal_default['tribunal_archive_layout'] );
                $ed_image_content_inverse = get_theme_mod( 'ed_image_content_inverse',$tribunal_default['ed_image_content_inverse'] );
                if( $tribunal_archive_layout == 'default' && $ed_image_content_inverse ){

                    $classes[] = 'twp-archive-alternative';

                }

                $classes[] = 'twp-archive-'.esc_attr( $tribunal_archive_layout );
                
            }

        }

        if( is_singular('post') ){

            $tribunal_post_layout = esc_html( get_post_meta( $post->ID, 'tribunal_post_layout', true ) );

            if( $tribunal_post_layout == '' || $tribunal_post_layout == 'global-layout' ){
                
                $tribunal_post_layout = get_theme_mod( 'tribunal_single_post_layout',$tribunal_default['tribunal_archive_layout'] );

            }

            $classes[] = 'twp-single-'.esc_attr( $tribunal_post_layout );

            if( $tribunal_post_layout == 'layout-2' ){
                
                $tribunal_header_overlay = esc_html( get_post_meta( $post->ID, 'tribunal_header_overlay', true ) );

                if( $tribunal_header_overlay == '' || $tribunal_header_overlay == 'global-layout' ){

                    $tribunal_post_layout2 = get_theme_mod( 'tribunal_single_post_layout',$tribunal_default['tribunal_archive_layout'] );

                    if( $tribunal_post_layout2 == 'layout-2' ){

                        $ed_header_overlay = true;

                    }else{

                        $ed_header_overlay = false;

                    }

                }else{

                    $ed_header_overlay = true;

                }
                if( $ed_header_overlay ){

                    $classes[] = 'twp-single-header-overlay';

                }

            }

        }

        if( is_singular('page') ){

            $tribunal_page_layout = get_post_meta( $post->ID, 'tribunal_page_layout', true );

            if( $tribunal_page_layout == ''  ){
                
                $tribunal_page_layout = 'layout-1';

            }

            $classes[] = 'theme-single-'.esc_attr( $tribunal_page_layout );

            if( $tribunal_page_layout == 'layout-2' ){
                
                $tribunal_ed_header_overlay = get_post_meta( $post->ID, 'tribunal_ed_header_overlay', true );
                if( $tribunal_ed_header_overlay ){
                    $classes[] = 'theme-single-header-overlay';
                }

            }

        }

        if( is_archive() || is_home() || is_search() ){

            $tribunal_archive_layout = get_theme_mod( 'tribunal_archive_layout',$tribunal_default['tribunal_archive_layout'] );
            $ed_image_content_inverse = get_theme_mod( 'ed_image_content_inverse',$tribunal_default['ed_image_content_inverse'] );
            if( $tribunal_archive_layout == 'default' && $ed_image_content_inverse ){

                $classes[] = 'twp-archive-alternative';

            }

            $classes[] = 'twp-archive-'.esc_attr( $tribunal_archive_layout );
            
        }

        if( is_singular('post') ){

            $tribunal_ed_post_reaction = esc_html( get_post_meta( $post->ID, 'tribunal_ed_post_reaction', true ) );
            if( $tribunal_ed_post_reaction ){
                $classes[] = 'hide-comment-rating';
            }

        }
        
        $tribunal_color_schema = get_theme_mod( 'tribunal_color_schema',$tribunal_default['tribunal_color_schema'] );
        $classes[] = 'theme-scheme-'.esc_attr( $tribunal_color_schema );

        $ed_fullwidth_layout = get_theme_mod( 'ed_fullwidth_layout',$tribunal_default['ed_fullwidth_layout'] );
        if( $ed_fullwidth_layout ){
            $classes[] = 'fullwidth-layout';
        }

        return $classes;
    }

endif;

add_filter('body_class', 'tribunal_body_classes');