<?php
/**
 * The template for displaying single posts and pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Tribunal
 * @since 1.0.0
 */
get_header();

$current_id = '';
if( have_posts() ):
    while (have_posts()) :
    the_post();
        $current_id  = get_the_ID();
    endwhile;
    wp_reset_postdata();
endif;
    
    $tribunal_default = tribunal_get_default_theme_options();
    $sidebar = esc_attr( get_theme_mod( 'global_sidebar_layout', $tribunal_default['global_sidebar_layout'] ) );
    $tribunal_post_sidebar = esc_attr( get_post_meta( $current_id, 'tribunal_post_sidebar_option', true ) );
    $twp_navigation_type = esc_attr( get_post_meta( $current_id, 'twp_disable_ajax_load_next_post', true ) );
    $tribunal_header_trending_page = get_theme_mod( 'tribunal_header_trending_page' );
    $tribunal_header_popular_page = get_theme_mod( 'tribunal_header_popular_page' );
    $tribunal_archive_layout = esc_attr( get_theme_mod( 'tribunal_archive_layout', $tribunal_default['tribunal_archive_layout'] ) );
    $article_wrap_class = '';
    $single_layout_class = ' single-layout-default';

    if( $twp_navigation_type == '' || $twp_navigation_type == 'global-layout' ){
        $twp_navigation_type = get_theme_mod('twp_navigation_type', $tribunal_default['twp_navigation_type']);
    }

    if( $tribunal_post_sidebar == 'global-sidebar' || empty( $tribunal_post_sidebar ) ){
        $sidebar = $sidebar;
    }else{
        $sidebar = $tribunal_post_sidebar;
    }
    $tribunal_post_layout = esc_attr( get_post_meta( $current_id, 'tribunal_post_layout', true ) );
    if( $tribunal_post_layout == '' || $tribunal_post_layout == 'global-layout' ){
        
        $tribunal_post_layout = get_theme_mod( 'tribunal_single_post_layout',$tribunal_default['tribunal_archive_layout'] );
    }
    if( $tribunal_post_layout == 'layout-2' ){
        $single_layout_class = ' single-layout-banner';
    }
    if( $tribunal_header_trending_page == $current_id || $tribunal_header_popular_page == $current_id ){
        $article_wrap_class = 'archive-layout-' . esc_attr($tribunal_archive_layout);
        $single_layout_class = '';
    }
    $tribunal_header_trending_page = get_theme_mod( 'tribunal_header_trending_page' );
    $tribunal_header_popular_page = get_theme_mod( 'tribunal_header_popular_page' );
    if( $tribunal_header_trending_page == get_the_ID() || $tribunal_header_popular_page == get_the_ID() ){

        $breadcrumb = true;

    }
    $tribunal_ed_post_rating = esc_html( get_post_meta( $post->ID, 'tribunal_ed_post_rating', true ) ); ?>

    <div class="singular-main-block">
        <div class="wrapper">
            <div class="column-row">

                <div id="primary" class="content-area">
                    <main id="main" class="site-main <?php if( $tribunal_ed_post_rating ){ echo 'tribunal-no-comment'; } ?>" role="main">

                        <?php
                        if( isset( $breadcrumb ) || ( $tribunal_post_layout != 'layout-2' && !is_page_template( 'templates/template-cover-full-width.php' ) && !is_page_template( 'templates/template-cover.php' ) && !is_page_template( 'templates/template-slider.php' ) && !is_page_template( 'templates/template-carousel.php' ) ) ) {
                            tribunal_breadcrumb();
                        }

                        if( have_posts() ): ?>

                            <div class="article-wraper single-layout <?php echo esc_attr($article_wrap_class.$single_layout_class); ?>">

                                <?php while (have_posts()) :
                                    the_post();

                                    get_template_part('template-parts/content', 'single');

                                    /**
                                     *  Output comments wrapper if it's a post, or if comments are open,
                                     * or if there's a comment number – and check for password.
                                    **/
                                    if ( $tribunal_header_trending_page != $current_id && $tribunal_header_popular_page != $current_id ) {

                                        if ( ( is_single() || is_page() ) && ( comments_open() || get_comments_number() ) && !post_password_required() ) { ?>

                                            <div class="comments-wrapper">
                                                <?php comments_template(); ?>
                                            </div>

                                        <?php
                                        }
                                    }

                                endwhile; ?>

                            </div>

                        <?php
                        else :

                            get_template_part('template-parts/content', 'none');

                        endif;

                        /**
                         * Navigation
                         * 
                         * @hooked tribunal_post_floating_nav - 10
                         * @hooked tribunal_related_posts - 20  
                         * @hooked tribunal_single_post_navigation - 30  
                        */

                        do_action('tribunal_navigation_action'); ?>

                    </main><!-- #main -->
                </div>

                <?php
                if( class_exists('WooCommerce') && ( is_cart() || is_checkout() ) ){
                    $sidebar_status = false;
                }else{
                    $sidebar_status = true;
                }
                if ( $sidebar != 'no-sidebar' && $sidebar_status ) {
                    get_sidebar();
                } ?>

            </div>
        </div>
    </div>

<?php
get_footer();
