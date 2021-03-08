<?php
/**
 * Custom Functions.
 *
 * @package Tribunal
 */

if( !function_exists( 'tribunal_sanitize_sidebar_option_meta' ) ) :

    // Sidebar Option Sanitize.
    function tribunal_sanitize_sidebar_option_meta( $input ){

        $metabox_options = array( 'global-sidebar','left-sidebar','right-sidebar','no-sidebar' );
        if( in_array( $input,$metabox_options ) ){

            return $input;

        }else{

            return '';

        }
    }

endif;

if( !function_exists( 'tribunal_page_lists' ) ) :

    // Page List.
    function tribunal_page_lists(){

        $page_lists = array();
        $page_lists[''] = esc_html__( '-- Select Page --','tribunal' );
        $pages = get_pages(
            array (
                'parent'  => 0, // replaces 'depth' => 1,
            )
        );
        foreach( $pages as $page ){

            $page_lists[$page->ID] = $page->post_title;

        }
        return $page_lists;
    }

endif;

if( !function_exists( 'tribunal_sanitize_post_layout_option_meta' ) ) :

    // Sidebar Option Sanitize.
    function tribunal_sanitize_post_layout_option_meta( $input ){

        $metabox_options = array( 'global-layout','layout-1','layout-2' );
        if( in_array( $input,$metabox_options ) ){

            return $input;

        }else{

            return '';

        }

    }

endif;

if( !function_exists( 'tribunal_sanitize_header_overlay_option_meta' ) ) :

    // Sidebar Option Sanitize.
    function tribunal_sanitize_header_overlay_option_meta( $input ){

        $metabox_options = array( 'global-layout','enable-overlay' );
        if( in_array( $input,$metabox_options ) ){

            return $input;

        }else{

            return '';

        }

    }

endif;

/**
 * Tribunal SVG Icon helper functions
 *
 * @package WordPress
 * @subpackage Tribunal
 * @since 1.0.0
 */
if ( ! function_exists( 'tribunal_the_theme_svg' ) ):
    /**
     * Output and Get Theme SVG.
     * Output and get the SVG markup for an icon in the Tribunal_SVG_Icons class.
     *
     * @param string $svg_name The name of the icon.
     * @param string $group The group the icon belongs to.
     * @param string $color Color code.
     */
    function tribunal_the_theme_svg( $svg_name, $return = false ) {

        if( $return ){

            return tribunal_get_theme_svg( $svg_name ); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Escaped in tribunal_get_theme_svg();.

        }else{

            echo tribunal_get_theme_svg( $svg_name ); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Escaped in tribunal_get_theme_svg();.
            
        }
    }

endif;

if ( ! function_exists( 'tribunal_get_theme_svg' ) ):

    /**
     * Get information about the SVG icon.
     *
     * @param string $svg_name The name of the icon.
     * @param string $group The group the icon belongs to.
     * @param string $color Color code.
     */
    function tribunal_get_theme_svg( $svg_name ) {

        // Make sure that only our allowed tags and attributes are included.
        $svg = wp_kses(
            Tribunal_SVG_Icons::get_svg( $svg_name ),
            array(
                'svg'     => array(
                    'class'       => true,
                    'xmlns'       => true,
                    'width'       => true,
                    'height'      => true,
                    'viewbox'     => true,
                    'aria-hidden' => true,
                    'role'        => true,
                    'focusable'   => true,
                ),
                'path'    => array(
                    'fill'      => true,
                    'fill-rule' => true,
                    'd'         => true,
                    'transform' => true,
                ),
                'polygon' => array(
                    'fill'      => true,
                    'fill-rule' => true,
                    'points'    => true,
                    'transform' => true,
                    'focusable' => true,
                ),
            )
        );
        if ( ! $svg ) {
            return false;
        }
        return $svg;

    }

endif;

if( !function_exists('tribunal_post_format_icon') ):

    // Post Format Icon.
    function tribunal_post_format_icon( $format ){

        if( $format == 'video' ){
            $icon = 'ion-ios-videocam';
        }elseif( $format == 'audio' ){
            $icon = 'ion-ios-musical-notes';
        }elseif( $format == 'gallery' ){
            $icon = 'ion-md-images';
        }elseif( $format == 'quote' ){
            $icon = 'ion-md-quote';
        }elseif( $format == 'image' ){
            $icon = 'ion-ios-camera';
        }else{
            $icon = '';
        }

        return $icon;
    }

endif;

if ( ! function_exists( 'tribunal_sub_menu_toggle_button' ) ) :

    function tribunal_sub_menu_toggle_button( $args, $item, $depth ) {

        // Add sub menu toggles to the main menu with toggles
        if ( $args->theme_location == 'primary-menu' && isset( $args->show_toggles ) ) {
            // Wrap the menu item link contents in a div, used for positioning
            $args->before = '<div class="submenu-wrapper">';
            $args->after  = '';
            // Add a toggle to items with children
            if ( in_array( 'menu-item-has-children', $item->classes ) ) {
                $toggle_target_string = '.menu-item.menu-item-' . $item->ID . ' > .sub-menu';
                // Add the sub menu toggle
                $args->after .= '<button type="button" class="button-style button-transparent submenu-toggle" data-toggle-target="' . $toggle_target_string . '" data-toggle-type="slidetoggle" data-toggle-duration="250"><span class="screen-reader-text">' . __( 'Show sub menu', 'tribunal' ) . '</span>' . tribunal_get_theme_svg( 'chevron-down' ) . '</button>';
            }
            // Close the wrapper
            $args->after .= '</div><!-- .submenu-wrapper -->';
            // Add sub menu icons to the main menu without toggles (the fallback menu)
        } elseif ( $args->theme_location == 'primary-menu' ) {
            if ( in_array( 'menu-item-has-children', $item->classes ) ) {
                $args->before = '<div class="link-icon-wrapper">';
                $args->after  = tribunal_get_theme_svg( 'chevron-down' ) . '</div>';
            } else {
                $args->before = '';
                $args->after  = '';
            }
        }
        return $args;

    }

    add_filter( 'nav_menu_item_args', 'tribunal_sub_menu_toggle_button', 10, 3 );

endif;

if( !function_exists( 'tribunal_post_category_list' ) ) :

    // Post Category List.
    function tribunal_post_category_list( $select_cat = true ){

        $post_cat_lists = get_categories(
            array(
                'hide_empty' => '0',
                'exclude' => '1',
            )
        );

        $post_cat_cat_array = array();
        if( $select_cat ){

            $post_cat_cat_array[''] = esc_html__( '-- Select Category --','tribunal' );

        }

        foreach ( $post_cat_lists as $post_cat_list ) {

            $post_cat_cat_array[$post_cat_list->slug] = $post_cat_list->name;

        }

        return $post_cat_cat_array;
    }

endif;


if (!function_exists('tribunal_trending_popular_posts')) :

    // Trending posts list
    function tribunal_trending_popular_posts( $current_post_id ){

        $tribunal_header_trending_page = get_theme_mod( 'tribunal_header_trending_page' );
        $tribunal_header_popular_page = get_theme_mod( 'tribunal_header_popular_page' );

        if( $tribunal_header_trending_page == $current_post_id ){
            $posts_list = booster_extension_posts_visits(32);
        }else{
            $posts_list = booster_extension_rating_count_list();
        }
        
        arsort( $posts_list );
        if( $posts_list ){

            foreach( $posts_list as $post_id => $visit ) {

                $popular_trending_query = new WP_Query(
                    array( 
                        'post_type' => 'post',
                        'post__in' => array( $post_id ),
                        'ignore_sticky_posts' => 1
                    )
                );

                if ( $popular_trending_query->have_posts() ) :

                    /* Start the Loop */
                    while ( $popular_trending_query->have_posts() ) :
                        $popular_trending_query->the_post();

                        get_template_part( 'template-parts/content', get_post_format() );

                    endwhile;
                    wp_reset_postdata();
                endif;
            }

        }
    }

endif;

if( !function_exists('tribunal_sanitize_meta_pagination') ):

    /** Sanitize Enable Disable Checkbox **/
    function tribunal_sanitize_meta_pagination( $input ) {

        $valid_keys = array('global-layout','no-navigation','norma-navigation','ajax-next-post-load');
        if ( in_array( $input , $valid_keys ) ) {
            return $input;
        }
        return '';

    }

endif;

if( !function_exists('tribunal_disable_post_views') ):

    /** Disable Post Views **/
    function tribunal_disable_post_views() {

        add_filter('booster_extension_filter_views_ed', function ( ) {
            return false;
        });

    }

endif;

if( !function_exists('tribunal_disable_post_read_time') ):

    /** Disable Read Time **/
    function tribunal_disable_post_read_time() {

        add_filter('booster_extension_filter_readtime_ed', function ( ) {
            return false;
        });

    }

endif;

if( !function_exists('tribunal_disable_post_like_dislike') ):

    /** Disable Like Dislike **/
    function tribunal_disable_post_like_dislike() {

        add_filter('booster_extension_filter_like_ed', function ( ) {
            return false;
        });

    }

endif;

if( !function_exists('tribunal_disable_post_author_box') ):

    /** Disable Author Box **/
    function tribunal_disable_post_author_box() {

        add_filter('booster_extension_filter_ab_ed', function ( ) {
            return false;
        });

    }

endif;


add_filter('booster_extension_filter_ss_ed', function ( ) {
    return false;
});

if( !function_exists('tribunal_disable_post_reaction') ):

    /** Disable Reaction **/
    function tribunal_disable_post_reaction() {

        add_filter('booster_extension_filter_reaction_ed', function ( ) {
            return false;
        });

    }

endif;

if( !function_exists( 'tribunal_header_ad' ) ):

    function tribunal_header_ad(){

        $tribunal_default = tribunal_get_default_theme_options();
        $ed_header_ad = get_theme_mod( 'ed_header_ad',$tribunal_default['ed_header_ad'] );
        $header_ad_image = get_theme_mod( 'header_ad_image' );
        $ed_header_link = get_theme_mod( 'ed_header_link' );

        if( $ed_header_ad ){

            ?>
            <div class="header-ava-area">
                <div class="wrapper">
                    <?php if( $header_ad_image ){ ?>
                        <a target="_blank" href="<?php echo esc_url( $ed_header_link ); ?>">
                            <img src="<?php echo esc_url( $header_ad_image ); ?>" title="<?php esc_attr_e('Header AD Image','tribunal'); ?>" alt="<?php esc_attr_e('Header AD Image','tribunal'); ?>" />
                        </a>
                    <?php } ?>
                </div>
            </div>
            <?php

        }
    }

endif;

if( !function_exists('tribunal_post_floating_nav') ):

    function tribunal_post_floating_nav(){

        $tribunal_default = tribunal_get_default_theme_options();
        $ed_floating_next_previous_nav = get_theme_mod( 'ed_floating_next_previous_nav',$tribunal_default['ed_floating_next_previous_nav'] );

        if( 'post' === get_post_type() && $ed_floating_next_previous_nav ){

            $next_post = get_next_post();
            $prev_post = get_previous_post();

            if( isset( $prev_post->ID ) ){

                $prev_link = get_permalink( $prev_post->ID );?>

                <div class="floating-nav-arrow floating-nav-prev">
                    <div class="nav-arrow-area">
                        <?php tribunal_the_theme_svg('arrow-left' ); ?>
                    </div>
                    <article class="nav-arrow-content">

                        <?php if( get_the_post_thumbnail( $prev_post->ID,'thumbnail' ) ){ ?>
                            <div class="post-thumbnail">
                                <?php echo wp_kses_post( get_the_post_thumbnail( $prev_post->ID,'thumbnail' ) ); ?>
                            </div>
                        <?php } ?>

                        <header class="entry-header">
                            <h3 class="entry-title entry-title-small">
                                <a href="<?php echo esc_url( $prev_link ); ?>" rel="bookmark">
                                    <?php echo esc_html( get_the_title( $prev_post->ID ) ); ?>
                                </a>
                            </h3>
                        </header>
                    </article>
                </div>

            <?php }

            if( isset( $next_post->ID ) ){

                $next_link = get_permalink( $next_post->ID );?>

                <div class="floating-nav-arrow floating-nav-next">
                    <div class="nav-arrow-area">
                        <?php tribunal_the_theme_svg('arrow-right' ); ?>
                    </div>
                    <article class="nav-arrow-content">

                        <?php if( get_the_post_thumbnail( $next_post->ID,'thumbnail' ) ){ ?>
                        <div class="post-thumbnail">
                            <?php echo wp_kses_post( get_the_post_thumbnail( $next_post->ID,'thumbnail' ) ); ?>
                        </div>
                        <?php } ?>
                        
                        <header class="entry-header">
                            <h3 class="entry-title entry-title-small">
                                <a href="<?php echo esc_url( $next_link ); ?>" rel="bookmark">
                                    <?php echo esc_html( get_the_title( $next_post->ID ) ); ?>
                                </a>
                            </h3>
                        </header>

                    </article>

                </div>

            <?php
            }

        }

    }

endif;

add_action( 'tribunal_navigation_action','tribunal_post_floating_nav',10 );

if( !function_exists('tribunal_single_post_navigation') ):

    function tribunal_single_post_navigation(){

        $tribunal_default = tribunal_get_default_theme_options();
        $twp_navigation_type = esc_attr( get_post_meta( get_the_ID(), 'twp_disable_ajax_load_next_post', true ) );
        $tribunal_header_trending_page = get_theme_mod( 'tribunal_header_trending_page' );
        $tribunal_header_popular_page = get_theme_mod( 'tribunal_header_popular_page' );
        $tribunal_archive_layout = esc_attr( get_theme_mod( 'tribunal_archive_layout', $tribunal_default['tribunal_archive_layout'] ) );
        $current_id = '';
        $article_wrap_class = '';
        global $post;
        $current_id = $post->ID;
        if( $twp_navigation_type == '' || $twp_navigation_type == 'global-layout' ){
            $twp_navigation_type = get_theme_mod('twp_navigation_type', $tribunal_default['twp_navigation_type']);
        }

        if( $tribunal_header_trending_page != $current_id && $tribunal_header_popular_page != $current_id ){

            if( $twp_navigation_type != 'no-navigation' && 'post' === get_post_type() ){

                if( $twp_navigation_type == 'norma-navigation' ){ ?>

                    <div class="navigation-wrapper">
                        <?php
                        // Previous/next post navigation.
                        the_post_navigation(array(
                            'prev_text' => '<span class="arrow" aria-hidden="true">' . tribunal_the_theme_svg('arrow-left',$return = true ) . '</span><span class="screen-reader-text">' . __('Previous post:', 'tribunal') . '</span><span class="post-title">%title</span>',
                            'next_text' => '<span class="arrow" aria-hidden="true">' . tribunal_the_theme_svg('arrow-right',$return = true ) . '</span><span class="screen-reader-text">' . __('Next post:', 'tribunal') . '</span><span class="post-title">%title</span>',
                        )); ?>
                    </div>
                    <?php

                }else{

                    $next_post = get_next_post();
                    if( isset( $next_post->ID ) ){

                        $next_post_id = $next_post->ID;
                        echo '<div loop-count="1" next-post="' . absint( $next_post_id ) . '" class="twp-single-infinity"></div>';

                    }
                }

            }

        }

    }

endif;

add_action( 'tribunal_navigation_action','tribunal_single_post_navigation',30 );


if( !function_exists('tribunal_header_banner') ):

    function tribunal_header_banner(){

        if( have_posts() ):
            while (have_posts()) :
                the_post();

                global $post;
                
            endwhile;
        endif;
        global $post;
        $tribunal_post_layout = '';
        $tribunal_default = tribunal_get_default_theme_options();
        if( is_singular() ){

            $tribunal_post_layout = esc_html( get_post_meta( $post->ID, 'tribunal_post_layout', true ) );
            if( $tribunal_post_layout == '' || $tribunal_post_layout == 'global-layout' ){
                
                $tribunal_post_layout = get_theme_mod( 'tribunal_single_post_layout',$tribunal_default['tribunal_archive_layout'] );
            }

        }
        $tribunal_page_layout = esc_html( get_post_meta( $post->ID, 'tribunal_page_layout', true ) );
        $cover_banner = '';
        if( is_page_template( 'templates/template-cover-full-width.php' ) ){

            $cover_banner = esc_html( get_theme_mod( 'ed_template_full_cover_banner', $tribunal_default['ed_template_full_cover_banner'] ) );

        }elseif( is_page_template( 'templates/template-carousel.php' ) ){
            
            $cover_banner = esc_html( get_theme_mod( 'ed_template_carousel_banner', $tribunal_default['ed_template_carousel_banner'] ) );

        }elseif( is_page_template( 'templates/template-slider.php' ) ){

            $cover_banner = esc_html( get_theme_mod( 'ed_template_slider_banner', $tribunal_default['ed_template_slider_banner'] ) );

        }elseif( is_page_template( 'templates/template-cover.php' ) ){

            $cover_banner = esc_html( get_theme_mod( 'ed_template_cover_banner', $tribunal_default['ed_template_cover_banner'] ) );

        }

        if( $cover_banner ):

            if ( have_posts() ) :
                while ( have_posts() ) :
                    the_post();
                    
                    $featured_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' ); ?>

                    <?php if( is_page_template( 'templates/template-cover.php' ) ) { ?>

                        <div class="wrapper">
                            <div class="column-row">
                                <div class="column column-12">
                                    <div class="featured-cover-banner featured-default-banner">
                                        <div class="featured-banner-content">
                                            <header class="entry-header entry-header-1">
                                                <h1 class="entry-title"><?php the_title(); ?></h1>
                                            </header>
                                            <a class="scroll-content">
                                                <span class="mouse"><span></span></span>
                                            </a>
                                        </div>
                                        <div class="featured-banner-media">
                                            <div class="data-bg data-bg-fixed data-bg-banner" <?php if( $featured_image[0] ){ ?>data-background="<?php echo esc_url( $featured_image[0] ); ?>" <?php } ?> ></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php }else{ ?>

                        <div class="featured-cover-banner featured-full-banner">
                            <div class="featured-banner-content">
                                <div class="wrapper">
                                    <div class="column-row">
                                        <div class="column column-12">
                                            <header class="entry-header entry-header-1">
                                                <h1 class="entry-title entry-title-large"><?php the_title(); ?></h1>
                                            </header>
                                            <a class="scroll-content">
                                                <span class="mouse"><span></span></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="featured-banner-media">
                                <div class="data-bg data-bg-fixed data-bg-banner" <?php if( $featured_image[0] ){ ?>data-background="<?php echo esc_url( $featured_image[0] ); ?>" <?php } ?> ></div>
                            </div>
                        </div>

                    <?php
                    }

                endwhile;
                wp_reset_postdata();
            endif;

        endif;

        if( $tribunal_post_layout == 'layout-2' && !is_page_template( 'templates/template-cover-full-width.php' ) && !is_page_template( 'templates/template-cover.php' ) && !is_page_template( 'templates/template-slider.php' ) && !is_page_template( 'templates/template-carousel.php' ) && is_singular('post') ) {
            if ( have_posts() ) :
                while ( have_posts() ) :
                    the_post();

                    $featured_image = wp_get_attachment_image_src( get_post_thumbnail_id(),'full' );
                    $tribunal_ed_feature_image = esc_html( get_post_meta( get_the_ID(), 'tribunal_ed_feature_image', true ) );
                    ?>

                    <div class="single-featured-banner  <?php if( empty( $tribunal_ed_feature_image ) && $featured_image[0] ){ echo 'banner-has-image'; } ?>">

                        <div class="featured-banner-content">
                            <div class="wrapper">
                                <?php
                                if ( !is_404() && !is_home() && !is_front_page() ) {
                                    tribunal_breadcrumb();
                                } ?>

                                <div class="column-row">
                                    <div class="column column-12">
                                        <header class="entry-header entry-header-1">

                                            <div class="entry-meta">
                                                <?php
                                                tribunal_entry_footer($cats = true, $tags = false, $edits = false, $text = false, $icon = false);
                                                ?>
                                            </div>

                                            <h1 class="entry-title">
                                                <?php the_title(); ?>
                                            </h1>
                                        </header>
                                        <div class="entry-meta">
                                            <?php
                                            tribunal_posted_by();
                                            tribunal_posted_on();
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>

                        <?php if( empty( $tribunal_ed_feature_image ) && $featured_image[0] ){ ?>
                            <div class="featured-banner-media">
                                <div class="data-bg data-bg-fixed data-bg-banner" data-background="<?php echo esc_url( $featured_image[0] ); ?>"></div>
                            </div>
                        <?php } ?>

                    </div>

                <?php
                endwhile;
                wp_reset_postdata();
            endif;
               
        }

        if( $tribunal_page_layout == 'layout-2' && !is_page_template( 'templates/template-cover-full-width.php' ) && !is_page_template( 'templates/template-cover.php' ) && !is_page_template( 'templates/template-slider.php' ) && !is_page_template( 'templates/template-carousel.php' ) && is_singular('page') ) {
            if ( have_posts() ) :
                while ( have_posts() ) :
                    the_post();

                    $featured_image = wp_get_attachment_image_src( get_post_thumbnail_id(),'full' );
                    $tribunal_ed_feature_image = esc_html( get_post_meta( get_the_ID(), 'tribunal_ed_feature_image', true ) );
                    ?>

                    <div class="single-featured-banner  <?php if( empty( $tribunal_ed_feature_image ) && $featured_image[0] ){ echo 'banner-has-image'; } ?>">

                        <div class="featured-banner-content">
                            <div class="wrapper">
                                <?php
                                if ( !is_404() && !is_home() && !is_front_page() ) {
                                    tribunal_breadcrumb();
                                } ?>

                                <div class="column-row">
                                    <div class="column column-12">
                                        <header class="entry-header entry-header-1">

                                            <h1 class="entry-title">
                                                <?php the_title(); ?>
                                            </h1>
                                        </header>
                                    </div>
                                </div>
                                
                            </div>
                        </div>

                        <?php if( empty( $tribunal_ed_feature_image ) && $featured_image[0] ){ ?>
                            <div class="featured-banner-media">
                                <div class="data-bg data-bg-fixed data-bg-banner" data-background="<?php echo esc_url( $featured_image[0] ); ?>"></div>
                            </div>
                        <?php } ?>

                    </div>

                <?php
                endwhile;
                wp_reset_postdata();
            endif;
               
        }

    }

endif;

if( !function_exists('tribunal_template_header') ):

    /**
     * Header For Templates
    **/

    function tribunal_template_header(){

        $tribunal_default = tribunal_get_default_theme_options();
        $cover_banner = esc_html( get_theme_mod( 'ed_template_cover_banner', $tribunal_default['ed_template_cover_banner'] ) );

        if( is_page_template( 'templates/template-carousel.php' ) ) {
            $slider_cat = get_theme_mod('template_carousel_slider_category');
            if( $slider_cat ){
                
                $slider_arrows = esc_html( get_theme_mod( 'ed_template_carousel_arrow', $tribunal_default['ed_template_carousel_arrow'] ) );
                $slider_dots = esc_html( get_theme_mod( 'ed_template_carousel_dots', $tribunal_default['ed_template_carousel_dots'] ) );
                $slider_autoplay = esc_html( get_theme_mod( 'ed_template_carousel_autoplay', $tribunal_default['ed_template_carousel_autoplay'] ) );

                if ( $slider_autoplay ) {
                    $autoplay = 'true';
                }else{
                    $autoplay = 'false';
                }
                if( $slider_dots ) {
                    $dots = 'true';
                }else {
                    $dots = 'false';
                }
                if( $slider_arrows ) {
                    $arrows = 'true';
                }else {
                    $arrows = 'false';
                }
                if( is_rtl() ) {
                    $rtl = 'true';
                }else{
                    $rtl = 'false';
                }

                $slider_cat_query = new WP_Query( array('post_type' => 'post','posts_per_page' => 20,'post__not_in' => get_option("sticky_posts"), 'category_name' => esc_html( $slider_cat ) ) ); ?>

                <div class="template-carousel-main">
                    
                    <?php if( $slider_cat_query->have_posts() ): ?>

                        <div class="wrapper">
                            <div class="column-row">
                                <div class="carousel-wraper">
                                    <div class="template-carousel-slide theme-carousel-space" data-slick='{"autoplay": <?php echo esc_attr( $autoplay ); ?>, "dots": <?php echo esc_attr( $dots ); ?>, "arrows": <?php echo esc_attr( $arrows ); ?>, "rtl": <?php echo esc_attr( $rtl ); ?>}'>

                                        <?php
                                        while( $slider_cat_query->have_posts() ):
                                            $slider_cat_query->the_post();
                                            $featured_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' ); ?>
                                            <div class="theme-carousel-item">
                                                <article id="theme-post-<?php the_ID(); ?>" <?php post_class( 'news-article post-thumb post-thumb-slides' ); ?>>
                                                    <div class="data-bg data-bg-big thumb-overlay img-hover-slide img-hover-border" data-background="<?php echo esc_url( $featured_image[0] ); ?>">
                                                        <?php
                                                        $format = get_post_format( get_the_ID() ) ? : 'standard';
                                                        $icon = tribunal_post_format_icon( $format );
                                                        if( !empty( $icon ) ){ ?>
                                                            <span class="top-right-icon">
                                                                <i class="ion <?php echo esc_attr( $icon ); ?>"></i>
                                                            </span>
                                                        <?php } ?>
                                                        <a class="img-link" href="<?php the_permalink(); ?>" tabindex="0"></a>
                                                        <div class="article-content article-content-overlay">
                                                            <div class="entry-meta">
                                                                <?php tribunal_entry_footer( $cats = true, $tags = false, $edits = false, $text = false, $icon = false ); ?>
                                                            </div>
                                                            <h3 class="entry-title entry-title-medium">
                                                                <a href="<?php the_permalink(); ?>" tabindex="0" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                                                            </h3>
                                                            <div class="entry-meta">
                                                                <?php tribunal_posted_on(); ?>
                                                                <?php tribunal_post_view_count(); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </article>
                                            </div>
                                        <?php endwhile; ?>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php
                        wp_reset_postdata();

                    endif; ?>

                </div>

            <?php
            }
               
        }elseif( is_page_template( 'templates/template-slider.php' ) ) {
            $slider_cat = get_theme_mod('template_slider_category');
            if( $slider_cat ){
               
                $slider_arrows = esc_html( get_theme_mod( 'ed_template_slider_arrows', $tribunal_default['ed_template_slider_arrows'] ) );
                $slider_dots = esc_html( get_theme_mod( 'ed_template_slider_dots', $tribunal_default['ed_template_slider_dots'] ) );
                $slider_autoplay = esc_html( get_theme_mod( 'ed_template_slider_autoplay', $tribunal_default['ed_template_slider_autoplay'] ) );

                if ( $slider_autoplay ) {
                    $autoplay = 'true';
                }else{
                    $autoplay = 'false';
                }
                if( $slider_dots ) {
                    $dots = 'true';
                }else {
                    $dots = 'false';
                }
                if( $slider_arrows ) {
                    $arrows = 'true';
                }else {
                    $arrows = 'false';
                }
                if( is_rtl() ) {
                    $rtl = 'true';
                }else{
                    $rtl = 'false';
                }

                $slider_cat_query = new WP_Query( array('post_type' => 'post', 'post__not_in' => get_option("sticky_posts"), 'category_name' => esc_html( $slider_cat ) ) ); ?>
                <div class="template-slider-main">
                    
                    <?php if( $slider_cat_query->have_posts() ): ?>
                        <div class="wrapper">
                            <div class="column-row">
                                <div class="slick-slide-wrapper">
                                    <div class="template-slide" data-slick='{"autoplay": <?php echo esc_attr( $autoplay ); ?>, "dots": <?php echo esc_attr( $dots ); ?>, "arrows": <?php echo esc_attr( $arrows ); ?>, "rtl": <?php echo esc_attr( $rtl ); ?>}'>

                                        <?php
                                        while( $slider_cat_query->have_posts() ):
                                            $slider_cat_query->the_post();

                                            $featured_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' ); ?>
                                            <div class="content-carousel">
                                                <div class="carousel-inner-content">

                                                    <?php if( $featured_image[0] ){ ?>
                                                        <div class="entry-image entry-image-1">

                                                            <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
                                                                <img src="<?php echo esc_url( $featured_image[0] ); ?>" title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>">
                                                            </a>
                                                        </div>
                                                    <?php } ?>

                                                    <div class="entry-details">
                                                        <h3 class="entry-title entry-title-small">
                                                            <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                                                        </h3>
                                                    </div>

                                                </div>
                                            </div>

                                        <?php endwhile; ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        wp_reset_postdata();
                    endif; ?>
                </div>
            <?php
            }
               
        }

    }

endif;

if ( ! function_exists( 'tribunal_header_toggle_search' ) ):

    /**
     * Header Search
     **/
    function tribunal_header_toggle_search() {

        $tribunal_default = tribunal_get_default_theme_options();
        $ed_header_search = get_theme_mod('ed_header_search', $tribunal_default['ed_header_search']);
        $ed_header_search_top_category = get_theme_mod( 'ed_header_search_top_category', $tribunal_default['ed_header_search_top_category'] );
        $ed_header_search_recent_posts = absint( get_theme_mod( 'ed_header_search_recent_posts',$tribunal_default['ed_header_search_recent_posts'] ) );
        if( $ed_header_search ){ ?>

            <div class="header-searchbar">
                <div class="header-searchbar-inner">
                    <div class="wrapper">
                        <div class="header-searchbar-panel">
                            <div class="header-searchbar-area">

                                <a class="skip-link-search-top" href="javascript:void(0)"></a>

                                <?php get_search_form(); ?>

                            </div>

                            <?php if( $ed_header_search_recent_posts || $ed_header_search_top_category ){ ?>

                                <div class="search-content-area">

                                    <?php if( $ed_header_search_recent_posts ){ ?>

                                        <div class="search-recent-posts">
                                            <?php tribunal_recent_posts_search(); ?>
                                        </div>

                                    <?php } ?>

                                    <?php if( $ed_header_search_top_category ){ ?>

                                        <div class="search-popular-categories">
                                            <?php tribunal_header_search_top_cat_content(); ?>
                                        </div>

                                    <?php } ?>

                                </div>

                            <?php } ?>

                            <button type="button" id="search-closer" class="button-style button-transparent close-popup">
                                <?php tribunal_the_theme_svg('cross'); ?>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        <?php
        }

    }

endif;

add_action( 'tribunal_before_footer_content_action','tribunal_header_toggle_search',10 );

if( !function_exists('tribunal_recent_posts_search') ):

    // Single Posts Related Posts.
    function tribunal_recent_posts_search(){

        $tribunal_default = tribunal_get_default_theme_options();
        $related_posts_query = new WP_Query( array('post_type' => 'post', 'posts_per_page' => 5,'post__not_in' => get_option("sticky_posts") ) );

        if( $related_posts_query->have_posts() ): ?>

            <div class="theme-block related-search-posts">

                <div class="theme-block-heading">
                    <?php
                    $recent_post_title_search = esc_html( get_theme_mod( 'recent_post_title_search',$tribunal_default['recent_post_title_search'] ) );

                    if( $recent_post_title_search ){ ?>
                        <h2 class="theme-block-title">

                            <?php echo esc_html( $recent_post_title_search ); ?>

                        </h2>
                    <?php } ?>
                </div>

                <div class="theme-list-group recent-list-group">

                    <?php
                    while( $related_posts_query->have_posts() ):
                        $related_posts_query->the_post();

                        $featured_image = wp_get_attachment_image_src( get_post_thumbnail_id(),'medium' ); ?>

                        <article id="post-<?php the_ID(); ?>" <?php post_class('theme-list-article'); ?>>
                            <header class="entry-header">
                                <h3 class="entry-title">
                                    <a href="<?php the_permalink(); ?>" rel="bookmark">
                                        <?php the_title(); ?>
                                    </a>
                                </h3>
                            </header>
                        </article>

                    <?php 
                    endwhile; ?>

                </div>

            </div>

            <?php
            wp_reset_postdata();

        endif;

    }

endif;

if( !function_exists('tribunal_header_search_top_cat_content') ):

    function tribunal_header_search_top_cat_content(){

        $top_category = 4;

        $post_cat_lists = get_categories(
            array(
                'hide_empty' => '0',
                'exclude' => '1',
            )
        );

        $slug_counts = array();

        foreach( $post_cat_lists as $post_cat_list ){

            if( $post_cat_list->count >= 1 ){

                $slug_counts[] = array( 
                    'count'         => $post_cat_list->count,
                    'slug'          => $post_cat_list->slug,
                    'name'          => $post_cat_list->name,
                    'cat_ID'        => $post_cat_list->cat_ID,
                    'description'   => $post_cat_list->category_description, 
                );

            }

        }

        if( $slug_counts ){?>

            <div class="theme-block popular-search-categories">
                
                <div class="theme-block-heading">
                    <?php
                    $tribunal_default = tribunal_get_default_theme_options();
                    $top_category_title_search = esc_html( get_theme_mod( 'top_category_title_search',$tribunal_default['top_category_title_search'] ) );

                    if( $top_category_title_search ){ ?>
                        <h2 class="theme-block-title">

                            <?php echo esc_html( $top_category_title_search ); ?>

                        </h2>
                    <?php } ?>
                </div>

                <?php
                arsort( $slug_counts ); ?>

                <div class="theme-list-group categories-list-group">
                    <div class="column-row">

                        <?php
                        $i = 1;
                        foreach( $slug_counts as $key => $slug_count ){

                            if( $i > $top_category){ break; }
                            
                            $cat_link           = get_category_link( $slug_count['cat_ID'] );
                            $cat_name           = $slug_count['name'];
                            $cat_slug           = $slug_count['slug'];
                            $cat_count          = $slug_count['count'];
                            $twp_term_image = get_term_meta( $slug_count['cat_ID'], 'twp-term-featured-image', true ); ?>

                            <div class="column column-3 column-sm-6 column-xs-12">
                                <article id="post-<?php the_ID(); ?>" <?php post_class('theme-category-article'); ?>>
                                    <div class="article-area">
                                        <div class="article-panel">
                                            <div class="entry-thumbnail">
                                                <?php if ($twp_term_image) { ?>
                                                    <a href="<?php echo esc_url($cat_link); ?>" class="data-bg data-bg-medium" data-background="<?php echo esc_url($twp_term_image); ?>"></a>
                                                <?php } ?>
                                            </div>
                                            <div class="entry-details">
                                                <header class="entry-header">
                                                    <h3 class="entry-title">
                                                        <a href="<?php echo esc_url($cat_link); ?>">
                                                            <?php echo esc_html($cat_name); ?>
                                                        </a>
                                                    </h3>
                                                </header>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            </div>
                            <?php
                            $i++;

                        } ?>

                    </div>
                </div>

            </div>
        <?php
        }

    }

endif;

if( !function_exists('tribunal_content_gallery') ):

    // Gallery Contents
    function tribunal_content_gallery(){ ?>

        <div class="footer-gallery-wrap">
            <div class="wrapper">

            <?php
            if( is_singular('post') || is_singular('page') ){

                if ( !is_page_template('templates/template-home-page.php') && get_the_content() && function_exists('has_block') && has_block('gallery', get_the_content() ) ) {

                    echo '<div class="footer-galleries">';
                    $post_blocks = parse_blocks( get_the_content() );
                    if( $post_blocks ){
                        foreach( $post_blocks as $post_block ){

                            if( isset( $post_block['blockName'] ) && 
                                isset( $post_block['innerHTML'] ) && 
                                $post_block['blockName'] == 'core/gallery' ){

                                echo '<div class="footer-gallery-sec-wrap">';
                                echo wp_kses_post( $post_block['innerHTML'] );
                                echo '</div>';

                            }
                        }
                    }

                    echo '</div>';

                }
            }

            echo '<div class="widget-footer-galleries">';
            echo '</div>'; ?>

            </div>
        </div>
    <?php
    }

endif;

add_action( 'tribunal_before_footer_content_action','tribunal_content_gallery',20 );


if( !function_exists('tribunal_content_offcanvas') ):

    // Offcanvas Contents
    function tribunal_content_offcanvas(){ ?>

        <div id="offcanvas-menu">
            <div class="offcanvas-wraper">

                <div class="close-offcanvas-menu">
                    <a class="skip-link-off-canvas" href="javascript:void(0)"></a>
                    <div class="offcanvas-close">
                        <button type="button" class="button-style button-transparent button-offcanvas-close">
                            <span class="offcanvas-close-label">
                                <?php echo esc_html__('Close', 'tribunal'); ?>
                            </span>
                            <span class="bars">
                                    <span class="bar"></span>
                                    <span class="bar"></span>
                                    <span class="bar"></span>
                                </span>
                        </button>
                    </div>
                </div>

                <div id="primary-nav-offcanvas" class="offcanvas-item offcanvas-main-navigation">
                    <?php wp_nav_menu(array(
                        'theme_location' => 'primary-menu',
                        'container' => 'div',
                        'container_class' => 'offcanvas-navigation-area',
                        'show_toggles' => true,
                    )); ?>
                </div>

                <?php if (has_nav_menu('social-menu')) { ?>
                    <div id="social-nav-offcanvas" class="offcanvas-item offcanvas-social-navigation">
                        <?php wp_nav_menu(array(
                            'theme_location' => 'social-menu',
                            'link_before' => '<span class="screen-reader-text">',
                            'link_after' => '</span>',
                            'container' => 'div',
                            'container_class' => 'social-menu',
                            'depth' => 1,
                        )); ?>
                    </div>
                <?php } ?>

                <a class="skip-link-offcanvas screen-reader-text" href="javascript:void(0)"></a>
                
            </div>
        </div>

    <?php
    }

endif;

add_action( 'tribunal_before_footer_content_action','tribunal_content_offcanvas',30 );

if( !function_exists('tribunal_footer_affix_posts') ):

    // Footer Affix Posts
    function tribunal_footer_affix_posts(){

        $tribunal_default = tribunal_get_default_theme_options();
        $ed_affix_post = absint( get_theme_mod( 'ed_affix_post',$tribunal_default['ed_affix_post'] ) );
        $ed_affix_post_arrow = absint( get_theme_mod( 'ed_affix_post_arrow',$tribunal_default['ed_affix_post_arrow'] ) );
        $ed_affix_post_autoplay = absint( get_theme_mod( 'ed_affix_post_autoplay',$tribunal_default['ed_affix_post_autoplay'] ) );

        $footer_affix_posts = esc_html( get_theme_mod( 'footer_affix_posts' ) );
        if( $ed_affix_post ){

            $footer_affix_query = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => 8, 'category_name' => esc_html( $footer_affix_posts ) ) ); ?>

            <div class="drawer-handle">
                <div class="drawer-handle-open">
                    <i class="ion ion-ios-add"></i>
                </div>
            </div>

            <?php if( $footer_affix_query->have_posts() ){

                if ( $ed_affix_post_autoplay ) {
                    $autoplay = 'true';
                }else{
                    $autoplay = 'false';
                }
                if( $ed_affix_post_arrow ) {
                    $arrows = 'true';
                }else {
                    $arrows = 'false';
                }
                if( is_rtl() ) {
                    $rtl = 'true';
                }else{
                    $rtl = 'false';
                }
            ?>

                <div class="affix-panel-content">
                    <div class="affix-handle-close">
                        <i class="ion ion-ios-close"></i>
                    </div>
                    <div class="affix-panel-slider">
                        <div class="wrapper">
                            <div class="affix-carousel" data-slick='{"autoplay": <?php echo esc_attr( $autoplay ); ?>, "arrows": <?php echo esc_attr( $arrows ); ?>, "rtl": <?php echo esc_attr( $rtl ); ?>}'>
                                <?php
                                while( $footer_affix_query->have_posts() ){
                                    $footer_affix_query->the_post();
                                    $featured_image = wp_get_attachment_image_src( get_post_thumbnail_id(),'thumbnail' ); ?>

                                    <div class="slide-item">
                                        <article class="news-article">
                                            <div class="column-row">
                                                <?php if( $featured_image[0] ){ ?>
                                                    <div class="column column-3">
                                                        <div class="post-thumbnail">
                                                            <div class="img-hover-scale">
                                                                <a href="<?php the_permalink(); ?>" tabindex="0" >
                                                                    <img title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" src="<?php echo esc_url( $featured_image[0] ); ?>">
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php } ?>

                                                <div class="column column-<?php if(  $featured_image[0] ){ ?>9<?php }else{ ?>12<?php } ?>">
                                                    <h3 class="entry-title entry-title-xxsmall">
                                                        <a href="<?php the_permalink(); ?>" tabindex="0" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                                                    </h3>
                                                    <div class="entry-meta">
                                                        <?php tribunal_posted_on(); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </article>
                                    </div>

                                <?php } ?>

                            </div>
                        </div>
                    </div>
                </div>

            <?php
            wp_reset_postdata(); }
        }
    }

endif;

add_action( 'tribunal_before_footer_content_action','tribunal_footer_affix_posts',40 );

if( !function_exists('tribunal_footer_content_widget') ):

    function tribunal_footer_content_widget(){

        $tribunal_default = tribunal_get_default_theme_options();
        if (is_active_sidebar('tribunal-footer-widget-0') || 
            is_active_sidebar('tribunal-footer-widget-1') || 
            is_active_sidebar('tribunal-footer-widget-2')):
            $x = 1;
            $footer_sidebar = 0;
            do {
                if ($x == 3 && is_active_sidebar('tribunal-footer-widget-2')) {
                    $footer_sidebar++;
                }
                if ($x == 2 && is_active_sidebar('tribunal-footer-widget-1')) {
                    $footer_sidebar++;
                }
                if ($x == 1 && is_active_sidebar('tribunal-footer-widget-0')) {
                    $footer_sidebar++;
                }
                $x++;
            } while ($x <= 3);
            if ($footer_sidebar == 1) {
                $footer_sidebar_class = 12;
            } elseif ($footer_sidebar == 2) {
                $footer_sidebar_class = 6;
            } else {
                $footer_sidebar_class = 4;
            }
            $footer_column_layout = absint(get_theme_mod('footer_column_layout', $tribunal_default['footer_column_layout'])); ?>

            <div class="footer-widgetarea">
                <div class="wrapper">
                    <div class="column-row">
                        <?php if (is_active_sidebar('tribunal-footer-widget-0')): ?>
                            <div class="column <?php echo 'column-' . absint($footer_sidebar_class); ?> column-sm-12">
                                <?php dynamic_sidebar('tribunal-footer-widget-0'); ?>
                            </div>
                        <?php endif; ?>

                        <?php if (is_active_sidebar('tribunal-footer-widget-1')): ?>
                            <div class="column <?php echo 'column-' . absint($footer_sidebar_class); ?> column-sm-12">
                                <?php dynamic_sidebar('tribunal-footer-widget-1'); ?>
                            </div>
                        <?php endif; ?>

                        <?php if (is_active_sidebar('tribunal-footer-widget-2')): ?>
                            <div class="column <?php echo 'column-' . absint($footer_sidebar_class); ?> column-sm-12">
                                <?php dynamic_sidebar('tribunal-footer-widget-2'); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php
        endif;

    }

endif;

add_action( 'tribunal_footer_content_action','tribunal_footer_content_widget',10 );

if( !function_exists('tribunal_footer_content_info') ):

    /**
     * Footer Copyright Area
    **/
    function tribunal_footer_content_info(){

        $tribunal_default = tribunal_get_default_theme_options(); ?>
        <div class="footer-hr">
            <div class="wrapper">
                <div class="column-row">
                    <div class="column column-12">
                        <div class="footer-separator"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="site-info">
            <div class="wrapper">
                <div class="column-row">
                    <div class="column column-12">
                        <div class="footer-copyright">
                            <?php
                            $footer_copyright_text = wp_kses_post( get_theme_mod( 'footer_copyright_text', $tribunal_default['footer_copyright_text'] ) );
                            echo esc_html__('Copyright ', 'tribunal') . '&copy ' . absint(date('Y')) . ' <a href="' . esc_url(home_url('/')) . '" title="' . esc_attr(get_bloginfo('name', 'display')) . '" ><span>' . esc_html( get_bloginfo( 'name', 'display' ) ) . '. </span></a> ' . esc_html( $footer_copyright_text );

                            echo '<br>';
                            echo esc_html__('Theme: ', 'tribunal') . 'Tribunal ' . esc_html__('By ', 'tribunal') . '<a href="' . esc_url('https://www.themeinwp.com/theme/tribunal') . '"  title="' . esc_attr__('Themeinwp', 'tribunal') . '" target="_blank" rel="author"><span>' . esc_html__('Themeinwp. ', 'tribunal') . '</span></a>';
                            echo esc_html__('Powered by ', 'tribunal') . '<a href="' . esc_url('https://wordpress.org') . '" title="' . esc_attr__('WordPress', 'tribunal') . '" target="_blank"><span>' . esc_html__('WordPress.', 'tribunal') . '</span></a>';
                            
                            ?>
                        </div>

                        <?php if( has_nav_menu( 'footer-menu' ) ){ ?>
                            <div class="footer-nav">
                                <?php wp_nav_menu(array(
                                    'theme_location' => 'footer-menu',
                                    'container' => 'div',
                                    'container_class' => 'navigation-area'
                                )); ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>

    <?php
    }

endif;

add_action( 'tribunal_footer_content_action','tribunal_footer_content_info',20 );


if( !function_exists('tribunal_footer_go_to_top') ):

    // Scroll to Top render content
    function tribunal_footer_go_to_top(){

        $tribunal_default = tribunal_get_default_theme_options();
        $ed_scroll_top_button = get_theme_mod( 'ed_scroll_top_button', $tribunal_default['ed_scroll_top_button'] );

        if( $ed_scroll_top_button ){
            
            ?>
            <button type="button" class="scroll-up">
                <i class="ion ion-md-arrow-dropup"></i>
            </button>
            <?php

        }

    }

endif;

add_action( 'tribunal_footer_content_action','tribunal_footer_go_to_top',30 );


if( !function_exists('tribunal_color_schema_color') ):

    function tribunal_color_schema_color( $current_color ){

        $tribunal_default = tribunal_get_default_theme_options();
        
        $colors_schema = array(

            'default' => array(
                'background_color' => $tribunal_default['default_bg_color'],
            ),

            'fancy' => array(
                'background_color' =>  $tribunal_default['fancy_bg_color'],
            ),

            'dark' => array(
                'background_color' => $tribunal_default['dark_bg_color'],
            ),

            'shady' => array(
                'background_color' => $tribunal_default['shady_bg_color'],
            ),

        );

        if( isset( $colors_schema[$current_color] ) ){
            
            return $colors_schema[$current_color];

        }

        return;

    }

endif;

if ( ! function_exists( 'tribunal_color_schema_color_action' ) ) :
    function tribunal_color_schema_color_action() {

        $current_color = wp_unslash( $_POST['currentColor'] );

        $color_schemes = tribunal_color_schema_color( $current_color );

        if ( $color_schemes ) {
            echo json_encode( $color_schemes );
        }

        wp_die();

    }

endif;

add_action( 'wp_ajax_nopriv_tribunal_color_schema_color', 'tribunal_color_schema_color_action' );
add_action( 'wp_ajax_tribunal_color_schema_color', 'tribunal_color_schema_color_action' );

if( !function_exists( 'tribunal_post_view_count' ) ):

    function tribunal_post_view_count(){

        $tribunal_default = tribunal_get_default_theme_options();
        $ed_post_views = get_theme_mod( 'ed_post_views', $tribunal_default['ed_post_views'] );
        $twp_be_settings = get_option('twp_be_options_settings');
        $twp_be_enable_post_visit_tracking = isset( $twp_be_settings[ 'twp_be_enable_post_visit_tracking' ] ) ? esc_html( $twp_be_settings[ 'twp_be_enable_post_visit_tracking' ] ) : '';
        if( $twp_be_enable_post_visit_tracking && class_exists( 'Booster_Extension_Class' ) ): ?>

            <div class="entry-meta-item entry-meta-views">
                <div class="entry-meta-wrapper">
                    
                        <span class="entry-meta-icon views-icon">
                            <?php tribunal_the_theme_svg('viewer'); ?>
                        </span>
                        <a href="<?php the_permalink(); ?>">
                            <span class="post-view-count">
                               <?php
                               echo do_shortcode('[booster-extension-visit-count count_only="count" label="'.esc_html__('Views','tribunal').'"]');
                               ?>
                            </span>
                         </a>
                </div>
            </div>
        
        <?php
        endif;
    }
endif;

if( !function_exists( 'tribunal_post_like_dislike' ) ):

    function tribunal_post_like_dislike(){

        $tribunal_ed_post_like_dislike = esc_html( get_post_meta( get_the_ID(), 'tribunal_ed_post_like_dislike', true ) );
        if( class_exists( 'Booster_Extension_Class' ) && !$tribunal_ed_post_like_dislike ): ?>

            <div class="entry-meta-item entry-meta-like-dislike">
                <div class="entry-meta-wrapper">
                    <?php echo do_shortcode('[booster-extension-like-dislike]'); ?>
                </div>
            </div>
        
        <?php
        endif;
    }
endif;

add_action('wp_ajax_tribunal_masonry_posts', 'tribunal_masonry_posts_callback');
add_action('wp_ajax_nopriv_tribunal_masonry_posts', 'tribunal_masonry_posts_callback');

if( !function_exists( 'tribunal_masonry_posts_callback' ) ):
// Masonry Post Ajax Call Function.

    function tribunal_masonry_posts_callback() {

        if(  isset( $_POST[ '_wpnonce' ] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST[ '_wpnonce' ] ) ), 'tribunal_ajax_nonce' ) && isset( $_POST['paged_current'] ) && isset( $_POST['section_category'] ) ){

            $paged_current = absint( wp_unslash( $_POST['paged_current'] ) );
            $section_category = sanitize_text_field( wp_unslash( $_POST['section_category'] ) );

            $masonry_post_query = new WP_Query( array( 'post_type' => 'post','posts_per_page' => 8,'post__not_in' => get_option("sticky_posts"), 'category_name' => esc_html( $section_category ), 'paged'=>$paged_current ) );

            if( $masonry_post_query ->have_posts() ): ?>

                <?php
                while( $masonry_post_query ->have_posts() ){
                    $masonry_post_query ->the_post();

                    $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large'); 
                    ob_start(); ?>

                    <div class="column column-3 column-sm-6 column-xs-12 twp-masonary-item twp-masonary-item-new">

                            <article id="theme-post-<?php the_ID(); ?>" <?php post_class( 'news-article news-article-spacing news-article-bg' ); ?>>
                                    <?php if ($featured_image[0]) { ?>
                                        <div class="post-thumbnail">
                                            <div class="img-hover-scale mb-15">
                                                <?php
                                                $format = get_post_format(get_the_ID()) ?: 'standard';
                                                $icon = tribunal_post_format_icon($format);
                                                if (!empty($icon)) { ?>
                                                    <span class="top-right-icon"><i class="ion <?php echo esc_attr($icon); ?>"></i></span>
                                                <?php } ?>

                                                <a href="<?php the_permalink(); ?>" tabindex="0">
                                                    <img title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" src="<?php echo esc_url($featured_image[0]); ?>">
                                                </a>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <div class="article-content">
                                        <div class="entry-meta">
                                            <?php tribunal_entry_footer( $cats = true, $tags = false, $edits = false, $text = false, $icon = false ); ?>
                                        </div>

                                        <h3 class="entry-title entry-title-small">
                                            <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
                                        </h3>

                                        <div class="entry-meta">
                                            <?php tribunal_posted_on(); ?>
                                            <?php tribunal_post_view_count(); ?>
                                        </div>

                                        <div class="entry-content entry-content-muted entry-content-small">

                                            <?php
                                            if( has_excerpt() ){

                                                the_excerpt();

                                            }else{

                                                echo esc_html( wp_trim_words( get_the_content(),25,'...' ) );

                                            } ?>

                                        </div>
                                    </div>
                                </article>

                    </div>

                <?php $output['content'][] = ob_get_clean();
                }
                wp_send_json_success($output);
                wp_reset_postdata(); ?>

            <?php
            endif;
            
        }

        wp_die();
    }

endif;

add_action('wp_ajax_tribunal_tab_posts_callback', 'tribunal_tab_posts_callback');
add_action('wp_ajax_nopriv_tribunal_tab_posts_callback', 'tribunal_tab_posts_callback');

if( !function_exists( 'tribunal_tab_posts_callback' ) ):
// Masonry Post Ajax Call Function.

    function tribunal_tab_posts_callback() {

        if(  isset( $_POST[ '_wpnonce' ] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST[ '_wpnonce' ] ) ), 'tribunal_ajax_nonce' ) && isset( $_POST['category'] ) && isset( $_POST['currencBlock'] ) && isset( $_POST['currencBlock'] ) ){

            $category = sanitize_text_field( wp_unslash( $_POST['category'] ) );

            $tab_post_query = new WP_Query( array( 'post_type' => 'post','posts_per_page' => 6,'post__not_in' => get_option("sticky_posts"), 'category_name' => esc_html( $category ) ) );

            if( $tab_post_query ->have_posts() ): ?>

                    <div class="column-row">

                        <div class="column column-5">

                        <?php
                        while ($tab_post_query->have_posts()) {
                            $tab_post_query->the_post();

                                $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large'); ?>

                                <article class="news-article news-article-bg <?php echo esc_attr( wp_unslash( $_POST['currencBlock'] ) ); ?>-content-active">
                                    
                                    <?php if ($featured_image[0]) { ?>
                                        <div class="img-hover-scale mb-15">
                                            <?php
                                            $format = get_post_format(get_the_ID()) ?: 'standard';
                                            $icon = tribunal_post_format_icon($format);
                                            if (!empty($icon)) { ?>
                                                <span class="top-right-icon"><i class="ion <?php echo esc_attr($icon); ?>"></i></span>
                                            <?php } ?>
                                            <a href="<?php the_permalink(); ?>" tabindex="0">
                                                <img title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" src="<?php echo esc_url($featured_image[0]); ?>">
                                            </a>
                                        </div>
                                    <?php } ?>

                                    <div class="article-content">
                                        <div class="entry-meta">
                                            <?php tribunal_entry_footer($cats = true, $tags = false, $edits = false, $text = false, $icon = false); ?>
                                        </div>
                                        <h3 class="entry-title entry-title-medium">
                                            <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                                        </h3>
                                        <div class="entry-content entry-content-muted entry-content-small">
                                            <?php
                                            if (has_excerpt()) {
                                                the_excerpt();
                                            } else {
                                                echo esc_html(wp_trim_words(get_the_content(), 25, '...'));
                                            } ?>
                                        </div>
                                    </div>
                                </article>

                                <?php
                                break;

                            } ?>

                        </div>

                        <div class="column column-7">
                            <div class="content-main">

                                <?php
                                while ($tab_post_query->have_posts()) {
                                    $tab_post_query->the_post();

                                        $featured_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' ); ?>

                                        <div class="content-list">
                                            <article class="news-article news-article-bg <?php echo esc_attr( wp_unslash( $_POST['currencBlock'] ) ); ?>-content-active">
                                                <div class="column-row">

                                                    <?php if( $featured_image[0] ){ ?>

                                                        <div class="column column-4">
                                                            <div class="post-thumbnail">
                                                                <div class="img-hover-scale img-hover-border">

                                                                    <?php
                                                                    $format = get_post_format(get_the_ID()) ?: 'standard';
                                                                    $icon = tribunal_post_format_icon($format);
                                                                    if (!empty($icon)) { ?>
                                                                        <span class="top-right-icon"><i class="ion <?php echo esc_attr($icon); ?>"></i></span>
                                                                    <?php } ?>

                                                                    <a href="<?php the_permalink(); ?>" tabindex="0">
                                                                        <img title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" src="<?php echo esc_url($featured_image[0]); ?>">
                                                                    </a>

                                                                </div>
                                                            </div>
                                                        </div>

                                                    <?php } ?>

                                                    <div class="column column-<?php if(  $featured_image[0] ){ ?>8<?php }else{ ?>12<?php } ?>">
                                                        <div class="post-content">

                                                            <h3 class="entry-title entry-title-small">
                                                                <a href="<?php the_permalink(); ?>" tabindex="0" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                                                            </h3>

                                                            <div class="entry-meta">
                                                                <?php tribunal_posted_by(); ?>
                                                                <?php tribunal_post_view_count(); ?>
                                                            </div>

                                                        </div>
                                                    </div>

                                                </div>
                                            </article>
                                        </div>

                                    <?php
                                } ?>

                            </div>
                        </div>


                    </div>

                <?php
                wp_reset_postdata();

            endif;
        }

        wp_die();
    }

endif;

if( !function_exists( 'tribunal_header_ticker_posts' ) ):

    function tribunal_header_ticker_posts(){

        $tribunal_default = tribunal_get_default_theme_options();
        $ed_header_ticker_posts = get_theme_mod( 'ed_header_ticker_posts',$tribunal_default['ed_header_ticker_posts'] );
        $ed_header_ticker_posts_title = get_theme_mod( 'ed_header_ticker_posts_title',$tribunal_default['ed_header_ticker_posts_title'] );
        $tribunal_header_ticker_cat = get_theme_mod( 'tribunal_header_ticker_cat' );
        $slider_autoplay = get_theme_mod( 'ed_ticker_slider_autoplay',$tribunal_default['ed_ticker_slider_autoplay'] );

        if ( $slider_autoplay ) {
            $autoplay = 'true';
        }else{
            $autoplay = 'false';
        }
        
        if( is_rtl() ) {
            $rtl = 'true';
        }else{
            $rtl = 'false';
        }

        if( $ed_header_ticker_posts ){ ?>

            <div class="theme-ticker-area hide-no-js">
                <div class="wrapper">
                    <div class="ticker-area clear">

                        <?php if( $ed_header_ticker_posts_title ){ ?>
                            <div class="ticker-title">
                                <span class="ticker-title-flash"></span>
                                <span class="ticker-title-label"><?php echo esc_html( $ed_header_ticker_posts_title ); ?></span>
                            </div>
                        <?php } ?>

                        <?php
                        $ticker_posts_query = new WP_Query(array('post_type' => 'post', 'posts_per_page' => 10, 'post__not_in' => get_option("sticky_posts"), 'category_name' => esc_html($tribunal_header_ticker_cat)));

                        if( $ticker_posts_query->have_posts() ): ?>

                            <div class="ticker-content">
                                <div class="ticker-slides" data-slick='{"autoplay": <?php echo esc_attr( $autoplay ); ?>, "rtl": <?php echo esc_attr( $rtl ); ?>}'>

                                    <?php 
                                    while( $ticker_posts_query->have_posts() ):
                                        $ticker_posts_query->the_post();

                                        $featured_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'thumbnail' ); ?>

                                        <div class="ticker-item">
                                            <article id="theme-post-<?php the_ID(); ?>" <?php post_class( 'news-article' ); ?>>
                                            <?php if( $featured_image[0] ){ ?>
                                                    <div class="post-thumbnail">
                                                        <div class="img-hover-scale">
                                                            <a href="" tabindex="0">
                                                                <img title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" src="<?php echo esc_url( $featured_image[0] ); ?>">
                                                            </a>
                                                        </div>
                                                    </div>
                                                <?php } ?>

                                                <div class="article-content">
                                                    <h3 class="entry-title entry-title-xxsmall">
                                                        <a href="<?php the_permalink(); ?>" tabindex="0" rel="bookmark" title="<?php the_title_attribute(); ?>">
                                                            <?php the_title(); ?>
                                                        </a>
                                                    </h3>
                                                </div>
                                            </article>
                                        </div>

                                    <?php 
                                    endwhile; ?>

                                </div>

                                <div class="ticker-controls">
                                    <div class="title-controls title-controls-bg">
                                        <button type="button" class="twp-slide-prev slide-icon-1 slick-arrow slide-prev-ticker">
                                            <i class="ion-ios-arrow-back slick-arrow"></i>
                                        </button>
                                        <button type="button" class="twp-slide-next slide-icon-1 slick-arrow slide-next-ticker">
                                            <i class="ion-ios-arrow-forward slick-arrow"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <?php 
                            wp_reset_postdata();
                        endif; ?>

                    </div>
                </div>
            </div>

        <?php
        }

    }

endif;




if( !function_exists('tribunal_404_posts') ):

    function tribunal_404_posts(){

        $lead_post_query = new WP_Query( array('post_type' => 'post', 'posts_per_page' => 3,'post__not_in' => get_option("sticky_posts") ) );
        
        if( $lead_post_query ->have_posts() ): ?>
            <div class="theme-block theme-block-lead theme-block-notop theme-block-bg theme-block-bg-5 theme-block-bg-medium error-block error-block-bottom">
                <div class="wrapper">
                    <div class="column-row column-row-collapse">
                        <div class="column-bg">
                            <?php
                            while ($lead_post_query->have_posts()) {
                                $lead_post_query->the_post();

                                $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
                                ?>

                                <div class="column column-6 column-sm-12 column-order-1">
                                    <article id="theme-post-<?php the_ID(); ?>" <?php post_class('post-thumb news-article'); ?>>
                                        <?php if ($featured_image[0]) { ?>
                                            <div class="data-bg data-bg-medium thumb-overlay thumb-overlay-darker img-hover-slide"
                                                 data-background="<?php echo esc_url($featured_image[0]); ?>">
                                                <?php
                                                $format = get_post_format(get_the_ID()) ?: 'standard';
                                                $icon = tribunal_post_format_icon($format);
                                                if (!empty($icon)) { ?>
                                                    <span class="top-right-icon">
                                                            <i class="ion <?php echo esc_attr($icon); ?>"></i>
                                                        </span>
                                                <?php } ?>
                                                <a class="img-link" href="<?php the_permalink(); ?>" tabindex="0"></a>
                                            </div>

                                        <?php } ?>

                                        <div class="article-content">

                                            <div class="entry-meta">
                                                <?php tribunal_entry_footer($cats = true, $tags = false, $edits = false, $text = false, $icon = false); ?>
                                            </div>

                                            <h3 class="entry-title entry-title-medium">
                                                <a href="<?php the_permalink(); ?>" tabindex="0" rel="bookmark"
                                                   title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                                            </h3>

                                            <div class="entry-meta">
                                                <?php tribunal_posted_on(); ?>
                                                <?php tribunal_post_view_count(); ?>
                                                <?php tribunal_posted_by(); ?>
                                            </div>

                                            <div class="entry-content entry-content-muted entry-content-small">

                                                <?php
                                                if (has_excerpt()) {

                                                    the_excerpt();

                                                } else {

                                                    echo esc_html(wp_trim_words(get_the_content(), 30, '...'));

                                                } ?>

                                            </div>

                                        </div>
                                    </article>
                                </div>

                                <?php
                                break;

                            } ?>

                            <div class="column column-6 column-sm-12 column-order-2">
                                <div class="column-row column-row-collapse">
                                    <?php
                                    $i = 1;
                                    while ($lead_post_query->have_posts()) {
                                        $lead_post_query->the_post();

                                        $class = '';
                                        if ($i == 1) {
                                            $class = 'column-lr-border';
                                        }

                                        $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
                                        ?>
                                        <div class="column column-6 column-xs-12 <?php echo esc_attr($class); ?>">
                                            <div class="content-main">
                                                <div class="content-list">
                                                    <article
                                                            id="theme-post-<?php the_ID(); ?>" <?php post_class('news-article'); ?>>

                                                        <?php if ($featured_image[0]) { ?>
                                                            <div class="post-thumbnail">
                                                                <div class="img-hover-scale">

                                                                    <?php
                                                                    $format = get_post_format(get_the_ID()) ?: 'standard';
                                                                    $icon = tribunal_post_format_icon($format);
                                                                    if (!empty($icon)) { ?>
                                                                        <span class="top-right-icon"><i
                                                                                    class="ion <?php echo esc_attr($icon); ?>"></i></span>
                                                                    <?php } ?>

                                                                    <a href="<?php the_permalink(); ?>" tabindex="0">
                                                                        <img title="<?php the_title_attribute(); ?>"
                                                                             alt="<?php the_title_attribute(); ?>"
                                                                             src="<?php echo esc_url($featured_image[0]); ?>">
                                                                    </a>

                                                                </div>
                                                            </div>
                                                        <?php } ?>

                                                        <div class="article-content">
                                                            <div class="entry-meta">
                                                                <?php tribunal_entry_footer($cats = true, $tags = false, $edits = false, $text = false, $icon = false); ?>
                                                            </div>

                                                            <h3 class="entry-title entry-title-small">
                                                                <a href="<?php the_permalink(); ?>"
                                                                   rel="bookmark"><?php the_title(); ?></a>
                                                            </h3>

                                                            <div class="entry-meta">
                                                                <?php tribunal_posted_on(); ?>
                                                                <?php tribunal_post_view_count(); ?>
                                                            </div>

                                                            <div class="entry-content entry-content-muted entry-content-small">

                                                                <?php
                                                                if (has_excerpt()) {

                                                                    the_excerpt();

                                                                } else {

                                                                    echo esc_html(wp_trim_words(get_the_content(), 20, '...'));

                                                                } ?>

                                                            </div>
                                                        </div>

                                                    </article>
                                                </div>
                                            </div>
                                        </div>

                                        <?php
                                        $i++;

                                    } ?>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        <?php
        wp_reset_postdata();
        endif;

    }

endif;

if( class_exists('WooCommerce') ){

    remove_action('woocommerce_sidebar','woocommerce_get_sidebar');
    add_action('woocommerce_before_main_content','tribunal_woo_before_main_content',5);
    add_action('woocommerce_after_main_content','tribunal_woo_after_main_content',15);

}
if( !function_exists('tribunal_woo_before_main_content') ):

    function tribunal_woo_before_main_content(){

        echo '<div class="wrapper">';
        echo '<div class="column-row">';

    }

endif;

if( !function_exists('tribunal_woo_after_main_content') ):

    function tribunal_woo_after_main_content(){

        $tribunal_default = tribunal_get_default_theme_options();
        $sidebar = esc_attr( get_theme_mod( 'global_sidebar_layout', $tribunal_default['global_sidebar_layout'] ) );
        if( $sidebar != 'no-sidebar' ){

            get_sidebar();
            
        }

        echo '</div>';
        echo '</div>';

    }

endif;


if( !function_exists('tribunal_content_loading') ){

    function tribunal_content_loading(){ ?>

        <div class="content-loading-status">
            <div class="theme-ajax-loader"></div>
            <div class="screen-reader-text">
                <?php esc_html_e('Content Loading','tribunal'); ?>
            </div>
        </div>
    
    <?php
    }
}


function tribunal_hex2rgb( $colour,$opacity = 1 ) {

    if ( $colour[0] == '#' ) {
            $colour = substr( $colour, 1 );
    }
    if ( strlen( $colour ) == 6 ) {
            list( $r, $g, $b ) = array( $colour[0] . $colour[1], $colour[2] . $colour[3], $colour[4] . $colour[5] );
    } elseif ( strlen( $colour ) == 3 ) {
            list( $r, $g, $b ) = array( $colour[0] . $colour[0], $colour[1] . $colour[1], $colour[2] . $colour[2] );
    } else {
            return false;
    }
    $r = hexdec( $r );
    $g = hexdec( $g );
    $b = hexdec( $b );
    return 'rgba('.$r.','.$g.','.$b.','.$opacity.')';

}

if( !function_exists( 'tribunal_top_tages' ) ):

    function tribunal_top_tages() {

        $latest_post_query = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => 50, 'post__not_in' => get_option("sticky_posts") ) );
        $tag_lists = array();

        if( $latest_post_query->have_posts() ):

            while( $latest_post_query->have_posts() ):
                $latest_post_query->the_post();

                $tags = get_the_tags( get_the_ID() );

                if( $tags ){

                    foreach( $tags as $tag ){

                        if( !in_array($tag->term_id, $tag_lists) ){
                            
                            $tag_lists[ $tag->term_id ] = $tag->count;

                        }

                    }

                }

            endwhile;

        endif;

        arsort( $tag_lists);

        $tribunal_default = tribunal_get_default_theme_options();
        $ed_header_tags = get_theme_mod( 'ed_header_tags',$tribunal_default['ed_header_tags'] );

        if( $ed_header_tags ){

            $ed_header_tags_title = get_theme_mod( 'ed_header_tags_title',$tribunal_default['ed_header_tags_title'] );
            $ed_header_tags_count = get_theme_mod( 'ed_header_tags_count',$tribunal_default['ed_header_tags_count'] );
            ?>
            <div class="theme-tags-area">
                <div class="wrapper">
                    <div class="tags-area clear">
                        
                        <?php if( $ed_header_tags_title ){ ?>
                            <div class="tags-title">
                                <span><?php echo esc_html( $ed_header_tags_title ); ?></span>
                            </div>
                        <?php } ?>


                        <div class="tags-content">
                            <?php
                            if ($tag_lists) {
                                $count  = 1;
                                foreach( $tag_lists as $key => $value ){


                                    $tag = get_tag($key); // <-- your tag ID
                                    ?>
                                    <a href="<?php echo esc_url(get_tag_link($key)); ?>" class="tags-title-label"><?php echo esc_html($tag->name); ?></a>
                                    <?php

                                    if( $count == $ed_header_tags_count ){ break; }
                                    $count++;
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>

            <?php
        }

    }

endif;

if( class_exists( 'Booster_Extension_Class' ) ){

    add_filter('booster_extemsion_content_after_filter','tribunal_after_content_pagination');

}

if( !function_exists('tribunal_after_content_pagination') ):

    function tribunal_after_content_pagination($after_content){

        $pagination_single = wp_link_pages( array(
                    'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'tribunal' ),
                    'after'  => '</div>',
                    'echo' => false
                ) );

        $after_content =  $pagination_single.$after_content;

        return $after_content;

    }

endif;