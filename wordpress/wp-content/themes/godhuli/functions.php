<?php
/**
 * Godhuli functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Godhuli
 */

if ( ! function_exists( 'godhuli_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function godhuli_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Godhuli, use a find and replace
		 * to change 'godhuli' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'godhuli', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// enable custom image size
		add_image_size( 'godhuli_post_thumb', 1200, 576, true );

		// enable custom image size for slider
		add_image_size( 'godhuli_post_slide', 1920, 600, true );

		// content width support.
		if ( ! isset( $content_width ) ) {
			$content_width = 1140;
		}

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'primary' => esc_html__( 'Primary Menu', 'godhuli' ),
			)
		);

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
			)
		);

		// Set up the WordPress core custom background feature.
		$defaults = array(
			'default-color'      => 'ffffff',
			'default-image'      => '',
			'default-repeat'     => 'no-repeat',
			'default-position-x' => 'center',
			'default-position-y' => 'center',
			'default-size'       => 'cover',
			'wp-head-callback'   => '_custom_background_cb',

		);
		add_theme_support( 'custom-background', $defaults );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 50,
				'width'       => 250,
				'flex-width'  => false,
				'flex-height' => false,
			)
		);

		// Adding support for core block visual styles.
		add_theme_support( 'wp-block-styles' );

		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );

		// add editor style
		add_editor_style( array( 'css/editor-style.css', godhuli_fonts_url() ) );

		// Load regular editor styles into the new block-based editor.
		add_theme_support( 'editor-styles' );

		// Add support for custom color scheme.
		add_theme_support(
			'editor-color-palette',
			array(
				array(
					'name'  => __( 'Strong Blue', 'godhuli' ),
					'slug'  => 'strong-blue',
					'color' => '#0073aa',
				),
				array(
					'name'  => __( 'Lighter Blue', 'godhuli' ),
					'slug'  => 'lighter-blue',
					'color' => '#229fd8',
				),
				array(
					'name'  => __( 'Very Light Gray', 'godhuli' ),
					'slug'  => 'very-light-gray',
					'color' => '#eee',
				),
				array(
					'name'  => __( 'Very Dark Gray', 'godhuli' ),
					'slug'  => 'very-dark-gray',
					'color' => '#444',
				),
			)
		);

		// Add support for responsive embeds.
		add_theme_support( 'responsive-embeds' );

		// Add theme starter support
		add_theme_support( 'starter-content' );

	}
endif;
add_action( 'after_setup_theme', 'godhuli_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function godhuli_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['godhuli_content_width'] = apply_filters( 'godhuli_content_width', 1140 );
}
add_action( 'after_setup_theme', 'godhuli_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function godhuli_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Right Sidebar', 'godhuli' ),
			'id'            => 'godhuli-default-sidebar',
			'description'   => esc_html__( 'Add widgets here.', 'godhuli' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<div class="widget-title">',
			'after_title'   => '</div>',
		)
	);
}
add_action( 'widgets_init', 'godhuli_widgets_init' );


/**
 * Register Google Fonts
 */
function godhuli_fonts_url() {
	$fonts_url = '';

	/*
	 * Translators: If there are characters in your language that are not
	 * supported by Noto Serif, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$notoserif = esc_html_x( 'on', 'Noto Serif font: on or off', 'godhuli' );

	if ( 'off' !== $notoserif ) {
		$font_families   = array();
		$font_families[] = 'Poppins:300,400,400i,500,600,700,800';

		$query_args = array(
			'family' => rawurlencode( implode( '|', $font_families ) ),
			'subset' => rawurlencode( 'latin,latin-ext' ),
		);

		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return $fonts_url;
}


/**
 * Handles JavaScript detection.
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 */

function godhuli_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'godhuli_javascript_detection', 0 );


/**
 * Enqueue scripts and styles.
 */

function godhuli_scripts() {

	wp_enqueue_style( 'godhuli-style', get_stylesheet_uri() );

	wp_enqueue_style( 'owl-carousel', get_template_directory_uri() . '/css/owl-carousel.css', array(), '1.0.0', 'all' );

	wp_enqueue_style( 'material-designicons', get_template_directory_uri() . '/css/materialdesignicons.min.css', array(), '1.0.0', 'all' );

	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '1.0.0', 'all' );

	wp_enqueue_style( 'godhuli-block', get_template_directory_uri() . '/css/blocks.css', array(), '1.0.0', 'all' );

	wp_enqueue_style( 'colorbox', get_template_directory_uri() . '/css/colorbox.css', array(), '1.0.0', 'all' );

	wp_enqueue_style( 'Lora', 'https://fonts.googleapis.com/css?family=Lora:400,400i,500,500i,600,700&display=swap', array(), '1.0.0', 'all' );

	wp_enqueue_style( 'select2', get_template_directory_uri() . '/css/select2.min.css', array(), '1.0.0', 'all' );

	wp_enqueue_style( 'godhuli-main-styles', get_template_directory_uri() . '/css/main.css', array( 'bootstrap' ), '1.0.0', 'all' );

	// Load the Internet Explorer 8 specific stylesheet.
	wp_enqueue_style( 'godhuli-ie8', get_template_directory_uri() . '/css/ie8.css', array(), '1.0', 'all' );
	wp_style_add_data( 'godhuli-ie8', 'conditional', 'lt IE 9' );

	// Load the Internet Explorer 9 specific stylesheet, to fix display issues in the Customizer.
	if ( is_customize_preview() ) {
		wp_enqueue_style( 'godhuli-ie9', get_template_directory_uri() . '/css/ie9.css', array(), '1.0', 'all' );
		wp_style_add_data( 'godhuli-ie9', 'conditional', 'IE 9' );
	}

	wp_add_inline_style( 'godhuli-main-styles', godhuli_theme_dynamic_style() );

	wp_enqueue_script( 'popper', get_template_directory_uri() . '/js/umd/popper.min.js', array( 'jquery' ), '1.0.0', true );

	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array( 'jquery' ), '1.0.0', true );

	wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/js/owl.carousel.min.js', array( 'jquery' ), '1.0.0', true );

	wp_enqueue_script( 'colorbox', get_template_directory_uri() . '/js/jquery.colorbox.min.js', array( 'jquery' ), '1.6.4', true );

	wp_enqueue_script( 'godhuli-app-js', get_template_directory_uri() . '/js/jquery.app.js', array( 'jquery' ), '1.0.0', true );

	wp_enqueue_script( 'responsive-nav', get_template_directory_uri() . '/js/responsive-nav.js', array( 'jquery' ), '20151215', true );

	wp_enqueue_script( 'godhuli-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array( 'jquery' ), '20151215', true );

	wp_enqueue_script( 'select2', get_template_directory_uri() . '/js/select2.min.js', array( 'jquery' ), '20151215', false );

	// Load the html5 shiv.
	wp_enqueue_script( 'html5', get_template_directory_uri() . '/js/html5.js', array(), '3.7.3', true );
	wp_script_add_data( 'html5', 'conditional', 'lt IE 9' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'godhuli_scripts' );


/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * customizer functions
 */
require get_template_directory() . '/inc/customizer-functions.php';

/**
 * bootstrap navwalker
 */
require get_template_directory() . '/inc/class-godhuli-bootstrap-navwalker.php';

/**
 * Additional functions
 */
require get_template_directory() . '/inc/godhuli-additional-functions.php';

/**
 * Include Author Widgets
 */
require get_template_directory() . '/inc/widgets/class-godhuli-aboutme-widget.php';

/**
 * Include Recent Post with thumbnail Widgets
 */
require get_template_directory() . '/inc/widgets/class-godhuli-recentpost-widget.php';

/**
 * Comment Walker
 */
require get_template_directory() . '/inc/class-godhuli-comment.php';

/**
 * Dynamic style
 */
require get_template_directory() . '/inc/dynamic-style.php';


