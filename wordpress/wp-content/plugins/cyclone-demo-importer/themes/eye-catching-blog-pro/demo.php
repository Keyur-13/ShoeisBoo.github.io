<?php

add_filter( 'pt-ocdi/import_files', 'cdi_import_files' );
function cdi_import_files() {
    return array(
        array(
            'import_file_name'             => __( 'Eye Catching Blog PRO','cdi' ),
            'local_import_file'            => CDI_PLUGIN_DIR_PATH . '/themes/eye-catching-blog-pro/inc/content.xml',
            'local_import_customizer_file' => CDI_PLUGIN_DIR_PATH . '/themes/eye-catching-blog-pro/inc/options.dat',
            'local_import_widget_file'     => CDI_PLUGIN_DIR_PATH . '/themes/eye-catching-blog-pro/inc/widgets.wie',
        )
    );
}

if( !function_exists( 'ocdi_plugin_intro_text' ) ){
    function ocdi_plugin_intro_text( $default_text ) {
        return $default_text;
    }
}

add_action( 'pt-ocdi/after_import', 'cdi_after_import_setup' );
function cdi_after_import_setup( $selected_import ) {

    // Assign menus to their locations.
    $main_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );

    set_theme_mod( 'nav_menu_locations', array(
            'menu-1' => $main_menu->term_id,
        )
    );

    // Get Slider ID
    $slider_cat_ids   = array();
    $slider_cat_ids[] = cdi_get_term_id_by_name( 'Nepal' );
    $slider_cat_ids[] = cdi_get_term_id_by_name( 'Japan' );
    $slider_cat_ids[] = cdi_get_term_id_by_name( 'Sydney' );
    $slider_cat_ids[] = cdi_get_term_id_by_name( 'Brazil' );
    $slider_cat_ids[] = cdi_get_term_id_by_name( 'Hongkong' );

    set_theme_mod( 'eye_catching_blog_slider_category', $slider_cat_ids );

    // Featured Posts
    $featured_id = cdi_get_term_id_by_name( 'Featured' );
    set_theme_mod( 'featured_post_3_column_category', $featured_id );

    // Popular Posts
    $popular_posts_ids = cdi_get_term_id_by_name( 'Trending' );
    set_theme_mod( 'popular_section_category', array( $popular_posts_ids ) );

}