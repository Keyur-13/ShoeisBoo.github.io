<?php
/**
 * The Words functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package The_Words
 */

if ( ! function_exists( 'the_words_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function the_words_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on The Words, use a find and replace
		 * to change 'the-words' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'the-words', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		add_theme_support('woocommerce');
        add_theme_support('wc-product-gallery-zoom');
        add_theme_support('wc-product-gallery-lightbox');
        add_theme_support('wc-product-gallery-slider');

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		add_image_size('the-words-grid', 500, 350, true );
		add_image_size('the-words-full', 1300, 700, true );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'the-words-top-menu' => esc_html__( 'Top Menu', 'the-words' ),
			'the-words-primary-menu' => esc_html__( 'Primary Menu', 'the-words' ),
			'the-words-footer-menu' => esc_html__( 'Footer Menu', 'the-words' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'the_words_custom_background_args', array(
			'default-color' => 'fcfcfc',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );

		// Fost Formate
		add_theme_support( 'post-formats', array( 'image', 'gallery', 'link','video','quote','audio' ) );

	}
endif;
add_action( 'after_setup_theme', 'the_words_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function the_words_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'the_words_content_width', 890 );
}
add_action( 'after_setup_theme', 'the_words_content_width', 0 );

/**
 * Enqueue scripts and styles.
 */
function the_words_scripts() {

	$true_news_font_query_args = array('family' => 'DM+Sans:ital,wght@0,400;0,500;0,700;1,400;1,500;1,700|Lora:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&display=swap');
    wp_enqueue_style('the-words-google-fonts', add_query_arg($true_news_font_query_args, "//fonts.googleapis.com/css"));
    wp_enqueue_style( 'slick', get_template_directory_uri() . '/assets/lib/slick/slick.css' );
	wp_enqueue_style( 'the-words-style', get_stylesheet_uri() );
	
	wp_enqueue_script( 'masonry' );
	wp_enqueue_script( 'v4-shims', get_template_directory_uri() . '/assets/lib/font-awesome/v4-shims.min.js', array('jquery'), '20151215', true );
	wp_enqueue_script( 'the-words-all', get_template_directory_uri() . '/assets/lib/font-awesome/all.min.js', array('jquery'), '20151215', true );
	wp_enqueue_script( 'match-height', get_template_directory_uri() . '/assets/lib/match-height/jquery.matchHeight-min.js', array('jquery'), '20151215', true );
	wp_enqueue_script( 'theia-sticky-sidebar', get_template_directory_uri() . '/assets/lib/theia-sticky-sidebar/theia-sticky-sidebar.min.js', array('jquery'), '20151215', true );
	wp_enqueue_script( 'slick', get_template_directory_uri() . '/assets/lib/slick/slick.min.js', array('jquery'), '20151215', true );
	wp_enqueue_script( 'the-words-custom', get_template_directory_uri() . '/assets/js/custom.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

}
add_action( 'wp_enqueue_scripts', 'the_words_scripts' );

function the_words_admin_enqueue(){

    $currentscreen = get_current_screen();
    if( $currentscreen->id == 'widgets' ){
        wp_enqueue_media();
    	wp_enqueue_script( 'the-words-widget', get_template_directory_uri() . '/assets/js/widget.js', array( 'jquery'), '20160714', true );
    	 $array = array(
	        'remove'     => esc_html__('Remove','the-words'),
	        'uploadimage'     => esc_html__('Author Image','the-words'),
	    );
	    wp_localize_script( 'the-words-widget', 'the_words_widget_date', $array );
     }

}
add_action('admin_enqueue_scripts','the_words_admin_enqueue');

/**
 * Widgets.
 */
require get_template_directory() . '/inc/widgets/widgets.php';

/**
 * Breadcrumb Trail
**/
require get_template_directory() . '/assets/lib/breadcrumb-trail/breadcrumbs.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer/customizer.php';

/**
 * Custom Function.
 */
require get_template_directory() . '/inc/custom-function.php';

/**
 * Woocommerce Custom Function.
 */
if( class_exists('WooCommerce') ){
	require get_template_directory() . '/inc/woocommerce.php';
}

/**
 * Metabox
 */
require get_template_directory() . '/inc/metabox.php';
require get_template_directory() . '/inc/tgmpa/recommended-plugin.php';