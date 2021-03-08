<?php
/**
 * Tribunal functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Tribunal
 */


if ( ! function_exists( 'tribunal_after_theme_support' ) ) :

	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */

	function tribunal_after_theme_support() {

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// Custom background color.
		add_theme_support('custom-background', apply_filters('tribunal_custom_background_args', array(
            'default-color' => 'f7f8f9',
            'default-image' => '',
        )));

		// This variable is intended to be overruled from themes.
		// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
		// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
		$GLOBALS['content_width'] = apply_filters( 'tribunal_content_width', 1140 );
		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		add_theme_support(
			'custom-logo',
			array(
				'height'      => 120,
				'width'       => 90,
				'flex-height' => true,
				'flex-width'  => true,
			)
		);

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'script',
				'style',
			)
		);

		/*
		 * Posts Format.
		 *
		 * https://wordpress.org/support/article/post-formats/
		 */
		add_theme_support( 'post-formats', array(
		    'video',
		    'audio',
		    'gallery',
		    'quote',
		    'image'
		) );

		// Woocommerce Support
		add_theme_support( 'woocommerce' );
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );

		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Tribunal, use a find and replace
		 * to change 'tribunal' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'tribunal', get_template_directory() . '/languages' );

		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );

	}

endif;

add_action( 'after_setup_theme', 'tribunal_after_theme_support' );

/**
 * Register and Enqueue Styles.
 */
function tribunal_register_styles() {

	 $fonts_url = Tribunal_Fonts::tribunal_get_fonts_url();
    if (!empty($fonts_url)) {
        wp_enqueue_style('tribunal-google-fonts', $fonts_url, array(), null);
    }

	$theme_version = wp_get_theme()->get( 'Version' );

    wp_enqueue_style( 'tribunal-font-ionicons', get_template_directory_uri() . '/assets/lib/ionicons/css/ionicons.min.css');
    wp_enqueue_style( 'slick', get_template_directory_uri() . '/assets/lib/slick/css/slick.min.css');
	wp_enqueue_style( 'tribunal-style', get_stylesheet_uri(), array(), $theme_version );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}	

	wp_enqueue_script( 'imagesloaded' );
    wp_enqueue_script( 'masonry' );
	wp_enqueue_script( 'slick', get_template_directory_uri() . '/assets/lib/slick/js/slick.min.js', array('jquery'), '', 1);
	wp_enqueue_script( 'theiaStickySidebar', get_template_directory_uri() . '/assets/lib/theiaStickySidebar/theia-sticky-sidebar.js', array('jquery'), '', 1);
	wp_enqueue_script( 'tribunal-ajax', get_template_directory_uri() . '/assets/lib/custom/js/ajax.js', array('jquery'), '', true );
	wp_enqueue_script( 'tribunal-pagination', get_template_directory_uri() . '/assets/lib/custom/js/pagination.js', array('jquery'), '', 1 );
	wp_enqueue_script( 'tribunal-custom', get_template_directory_uri() . '/assets/lib/custom/js/custom.js', array('jquery'), '', 1);

    $ajax_nonce = wp_create_nonce('tribunal_ajax_nonce');

    wp_localize_script( 
        'tribunal-ajax', 
        'tribunal_ajax',
        array(
            'ajax_url'   => esc_url( admin_url( 'admin-ajax.php' ) ),
            'ajax_nonce' => $ajax_nonce,
         )
    );

    // Global Query
    if( is_front_page() ){

    	$posts_per_page = absint( get_option('posts_per_page') );
        $c_paged = ( get_query_var( 'page' ) ) ? absint( get_query_var( 'page' ) ) : 1;
        $posts_args = array(
            'posts_per_page'        => $posts_per_page,
            'paged'                 => $c_paged,
        );
        $posts_qry = new WP_Query( $posts_args );
        $max = $posts_qry->max_num_pages;

    }else{
        global $wp_query;
        $max = $wp_query->max_num_pages;
        $c_paged = ( get_query_var( 'paged' ) > 1 ) ? get_query_var( 'paged' ) : 1;
    }

    $tribunal_default = tribunal_get_default_theme_options();
    $tribunal_pagination_layout = get_theme_mod( 'tribunal_pagination_layout',$tribunal_default['tribunal_pagination_layout'] );

    // Pagination Data
    wp_localize_script( 
	    'tribunal-pagination', 
	    'tribunal_pagination',
	    array(
	        'paged'  => absint( $c_paged ),
	        'maxpage'   => absint( $max ),
	        'nextLink'   => next_posts( $max, false ),
	        'ajax_url'   => esc_url( admin_url( 'admin-ajax.php' ) ),
	        'loadmore'   => esc_html__( 'Load More Posts', 'tribunal' ),
	        'nomore'     => esc_html__( 'No More Posts', 'tribunal' ),
	        'loading'    => esc_html__( 'Loading...', 'tribunal' ),
	        'pagination_layout'   => esc_html( $tribunal_pagination_layout ),
	        'ajax_nonce' => $ajax_nonce,
	     )
	);

    global $post;
    $single_post = 0;
    $tribunal_ed_post_reaction = '';
    if( isset( $post->ID ) && isset( $post->post_type ) && $post->post_type == 'post' ){

    	$tribunal_ed_post_reaction = esc_html( get_post_meta( $post->ID, 'tribunal_ed_post_reaction', true ) );
    	$single_post = 1;

    }
	wp_localize_script(
	    'tribunal-custom', 
	    'tribunal_custom',
	    array(
	    	'single_post'						=> absint( $single_post ),
	        'tribunal_ed_post_reaction'  		=> esc_html( $tribunal_ed_post_reaction ),
	     )
	);

}

add_action( 'wp_enqueue_scripts', 'tribunal_register_styles' );

/**
 * Admin enqueue script
 */
function tribunal_admin_scripts($hook){

	wp_enqueue_media();
    wp_enqueue_style('tribunal-admin', get_template_directory_uri() . '/assets/lib/custom/css/admin.css');
    wp_enqueue_script('tribunal-admin', get_template_directory_uri() . '/assets/lib/custom/js/admin.js', array('jquery'), '', 1);

    $ajax_nonce = wp_create_nonce('tribunal_ajax_nonce');
			
	wp_localize_script( 
        'tribunal-admin', 
        'tribunal_admin_script_data',
        array(
            'ajax_url'   => esc_url( admin_url( 'admin-ajax.php' ) ),
            'ajax_nonce' => $ajax_nonce,
            'upload_image'   =>  esc_html__('Choose Image','tribunal'),
            'use_imahe'   =>  esc_html__('Select','tribunal'),
            'active' => esc_html__('Active','tribunal'),
	        'deactivate' => esc_html__('Deactivate','tribunal'),
         )
    );

    $current_screen = get_current_screen();
    if( $current_screen->id === "widgets" ) {

        // Enqueue Script Only On Widget Page.
        wp_enqueue_media();
    	wp_enqueue_script('tribunal-widget', get_template_directory_uri() . '/assets/lib/custom/js/widget.js', array('jquery'), '', 1);
	}
    
}

add_action('admin_enqueue_scripts', 'tribunal_admin_scripts');


if( !function_exists( 'tribunal_js_no_js_class' ) ) :

	// js no-js class toggle
	function tribunal_js_no_js_class() { ?>

		<script>document.documentElement.className = document.documentElement.className.replace( 'no-js', 'js' );</script>
	
	<?php
	}
	
endif;

add_action( 'wp_head', 'tribunal_js_no_js_class' );

/**
 * Register navigation menus uses wp_nav_menu in five places.
 */
function tribunal_menus() {

	$locations = array(
		'primary-menu'  => __( 'Primary Menu', 'tribunal' ),
		'footer-menu'  => __( 'Footer Menu', 'tribunal' ),
		'social-menu'  => __( 'Social Menu', 'tribunal' ),
	);

	register_nav_menus( $locations );
}

add_action( 'init', 'tribunal_menus' );

//* Add Description to Menu Items

add_filter( 'walker_nav_menu_start_el', 'tribunal_add_description', 10, 2 );
function tribunal_add_description( $item_output, $item ) {
    $description = $item->post_content;
    if (('' !== $description) && (' ' !== $description) ) {
        return preg_replace( '/(<a.*)</', '$1' . '<span class="menu-description">' . esc_html( $description ) . '</span><', $item_output) ;
    }
    else {
        return $item_output;
    };
}

//* Add Home Icon to Menu Items

add_filter('wp_nav_menu_items', 'tribunal_add_admin_link', 1, 2);
function tribunal_add_admin_link($items, $args){
    if( $args->theme_location == 'primary-menu' ){
        $item = '<li class="brand-home"><a title="'.esc_html__('Home','tribunal').'" href="'. esc_url( home_url() ) .'">' . "<span class='icon ion-ios-home'></span>" . '</a></li>';
        $items = $item . $items;
    }
    return $items;
}

/**
 * Recommended Plugins
 */
require get_template_directory() . '/assets/lib/tgmpa/recommended-plugins.php';
require get_template_directory() . '/classes/class-svg-icons.php';
require get_template_directory() . '/inc/customizer/customizer.php';
require get_template_directory() . '/inc/custom-header.php';
require get_template_directory() . '/inc/single-related-posts.php';
require get_template_directory() . '/inc/custom-functions.php';
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/classes/body-classes.php';
require get_template_directory() . '/classes/plugins-classes.php';
require get_template_directory() . '/classes/about-classes.php';
require get_template_directory() . '/classes/admin-notice.php';
require get_template_directory() . '/classes/classes-fonts.php';
require get_template_directory() . '/inc/widgets/widget-base.php';
require get_template_directory() . '/inc/widgets/widgets.php';
require get_template_directory() . '/inc/widgets/author.php';
require get_template_directory() . '/inc/widgets/category.php';
require get_template_directory() . '/inc/widgets/recent-post.php';
require get_template_directory() . '/inc/widgets/social-link.php';
require get_template_directory() . '/inc/widgets/tab-posts.php';
require get_template_directory() . '/inc/metabox.php';
require get_template_directory() . '/inc/term-meta.php';
require get_template_directory() . '/inc/pagination.php';
require get_template_directory() . '/assets/lib/breadcrumbs/breadcrumbs.php';
require get_template_directory() . '/template-parts/components/tiles-block.php';
require get_template_directory() . '/template-parts/components/lead-block.php';
require get_template_directory() . '/template-parts/components/banner-block-1.php';
require get_template_directory() . '/template-parts/components/banner-block-2.php';
require get_template_directory() . '/template-parts/components/banner-block-3.php';
require get_template_directory() . '/template-parts/components/banner-block-4.php';
require get_template_directory() . '/template-parts/components/advertise-block.php';
require get_template_directory() . '/template-parts/components/carousel-block.php';
require get_template_directory() . '/template-parts/components/masonry-block.php';
require get_template_directory() . '/template-parts/components/slider-block.php';
require get_template_directory() . '/template-parts/components/post-list-block.php';
require get_template_directory() . '/template-parts/components/latest-posts-block.php';
require get_template_directory() . '/assets/lib/custom/css/style.php';