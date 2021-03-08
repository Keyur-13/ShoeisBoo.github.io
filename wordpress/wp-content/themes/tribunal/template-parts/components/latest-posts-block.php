<?php
/**
 * Latest Posts
 *
 * @package Tribunal
 */
if (!function_exists('tribunal_latest_blocks')):
    
    function tribunal_latest_blocks($tribunal_home_section, $repeat_times)
    {   
        global $post;
        $tribunal_default = tribunal_get_default_theme_options();
        $sidebar = esc_attr( get_theme_mod( 'global_sidebar_layout', $tribunal_default['global_sidebar_layout'] ) );
        $tribunal_post_sidebar = esc_attr( get_post_meta( $post->ID, 'tribunal_post_sidebar_option', true ) );

        if( $tribunal_post_sidebar == 'global-sidebar' || empty( $tribunal_post_sidebar ) ){

             if( is_page_template('templates/template-cover.php') ){

                $tribunal_post_sidebar = esc_attr( get_post_meta( $post->ID, 'tribunal_post_sidebar_option', true ) );

                if( $tribunal_post_sidebar == 'global-sidebar' || empty( $tribunal_post_sidebar ) ){

                    $template_cover_sidebar_layout = esc_attr( get_theme_mod( 'template_cover_sidebar_layout',$tribunal_default['template_cover_sidebar_layout'] ) );
                    $sidebar = $template_cover_sidebar_layout;

                }else{

                    $sidebar = $tribunal_post_sidebar;

                }

            }elseif( is_page_template('templates/template-cover-full-width.php') ){

                $tribunal_post_sidebar = esc_attr( get_post_meta( $post->ID, 'tribunal_post_sidebar_option', true ) );

                if( $tribunal_post_sidebar == 'global-sidebar' || empty( $tribunal_post_sidebar ) ){

                    $template_cover_full_width_sidebar_layout = esc_attr( get_theme_mod( 'template_cover_full_width_sidebar_layout',$tribunal_default['template_cover_full_width_sidebar_layout'] ) );
                    $sidebar = $template_cover_full_width_sidebar_layout;

                }else{

                    $sidebar = $tribunal_post_sidebar;

                }

            }elseif( is_page_template('templates/template-carousel.php') ){

                $tribunal_post_sidebar = esc_attr( get_post_meta( $post->ID, 'tribunal_post_sidebar_option', true ) );

                if( $tribunal_post_sidebar == 'global-sidebar' || empty( $tribunal_post_sidebar ) ){

                    $template_carousel_sidebar_settings = esc_attr( get_theme_mod( 'template_carousel_sidebar_settings',$tribunal_default['template_carousel_sidebar_settings'] ) );
                    $sidebar = $template_carousel_sidebar_settings;

                }else{

                    $sidebar = $tribunal_post_sidebar;

                }

            }elseif( is_page_template('templates/template-slider.php') ){

                $tribunal_post_sidebar = esc_attr( get_post_meta( $post->ID, 'tribunal_post_sidebar_option', true ) );

                if( $tribunal_post_sidebar == 'global-sidebar' || empty( $tribunal_post_sidebar ) ){

                    $template_slider_sidebar_settings = esc_attr( get_theme_mod( 'template_slider_sidebar_settings',$tribunal_default['template_slider_sidebar_settings'] ) );
                    $sidebar = $template_slider_sidebar_settings;

                }else{

                    $sidebar = $tribunal_post_sidebar;

                }

            }elseif( is_page_template('templates/template-read-later-posts.php') ){

                $tribunal_post_sidebar = esc_attr( get_post_meta( $post->ID, 'tribunal_post_sidebar_option', true ) );

                if( $tribunal_post_sidebar == 'global-sidebar' || empty( $tribunal_post_sidebar ) ){

                    $sidebar = $global_sidebar_layout;

                }else{

                    $sidebar = $tribunal_post_sidebar;

                }

            }else{

                $sidebar = $sidebar;

            }
            

        }else{

            $sidebar = $tribunal_post_sidebar;

        }

        $tribunal_archive_layout = esc_attr( get_theme_mod( 'tribunal_archive_layout', $tribunal_default['tribunal_archive_layout'] ) ); ?>

        <div class="theme-block theme-block-archive">
            <div class="wrapper">
                <div class="column-row">

                    <div id="primary" class="content-area">
                        <main id="main" class="site-main" role="main">
                            
                            <?php
                            if( !is_front_page() && !is_page_template( 'templates/template-cover-full-width.php' ) && !is_page_template( 'templates/template-cover.php' ) && !is_page_template( 'templates/template-slider.php' ) && !is_page_template( 'templates/template-carousel.php' ) ) {
                                tribunal_breadcrumb();
                            }

                            if( have_posts() ): ?>

                                <div class="article-wraper archive-layout <?php echo 'archive-layout-' . esc_attr( $tribunal_archive_layout ); ?>">
                                    <?php while (have_posts()) :
                                        the_post();

                                        if( !is_page() ){
                                            get_template_part( 'template-parts/content', get_post_format() );
                                        }else{
                                            get_template_part('template-parts/content', 'single');
                                        }


                                    endwhile; ?>
                                </div>

                                <?php if( !is_page() ): do_action('tribunal_archive_pagination'); endif;

                            else :

                                get_template_part('template-parts/content', 'none');

                            endif; ?>
                        </main><!-- #main -->
                    </div>

                    <?php if( $sidebar != 'no-sidebar' ){

                        get_sidebar();
                        
                    } ?>

                </div>
            </div>
        </div>

    <?php
    }
endif;
