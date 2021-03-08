<?php 
add_action( 'wp_enqueue_scripts', 'bloggers_magazinely_enqueue_styles' );
function bloggers_magazinely_enqueue_styles() {
	wp_enqueue_style( 'bloggers-magazinely-parent-style', get_template_directory_uri() . '/style.css' ); 
} 


function bloggers_magazinely_load_google_fonts() {
	wp_enqueue_style( 'bloggers-magazinely-google-fonts', 'https://fonts.googleapis.com/css?family=Lato:400,400i,700|Open+Sans:300,400,600,' ); 
}
add_action( 'wp_enqueue_scripts', 'bloggers_magazinely_load_google_fonts' );


function bloggers_magazinely_remove_parent_function() {
	remove_action( 'wp_enqueue_scripts', 'sp_magazinely_load_google_fonts' );
	wp_dequeue_style( 'magazinely-font' );
}
add_action( 'wp_loaded', 'bloggers_magazinely_remove_parent_function', 999 );



function bloggers_magazinely_customize_preview_js() {
	wp_enqueue_script( 'bloggers-magazinely-customizer', get_stylesheet_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '1', true );
}
add_action( 'customize_preview_init', 'bloggers_magazinely_customize_preview_js' );



function bloggers_magazinely_customize_register( $wp_customize ) {
	$wp_customize->add_section( 'readmore_color', array(
		'title'      => __('Read More Text Color','bloggers-magazinely'),
		'priority'   => 1,
		'description'       => __( 'This is a child theme only feature', 'bloggers-magazinely' ),
		'capability' => 'edit_theme_options',
	) );

	$wp_customize->add_setting( 'readmore_color_picker', array(
		'default'           => '#8c8c8c',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'readmore_color_picker', array(
		'label'       => __( 'Read More Text Color', 'bloggers-magazinely' ),
		'section'     => 'readmore_color',
		'priority'   => 1,
		'settings'    => 'readmore_color_picker',
	) ) );

	function bloggers_magazinely_sanitize_radio( $input, $setting ){
		$input = sanitize_key($input);
		$choices = $setting->manager->get_control( $setting->id )->choices;                              
		return ( array_key_exists( $input, $choices ) ? $input : $setting->default );                
	}
	
	$wp_customize->add_section( 'featured_posts_header', array(
		'title'      => __('Featured Posts Settings','bloggers-magazinely'),
		'description'      => __('To make the featured posts section show up on your blog feed, you will have to add Sticky Posts, they will automatically be shown.','bloggers-magazinely'),
		'priority'   => 20,
		'capability' => 'edit_theme_options',
	) );

	$wp_customize->add_setting('featured_posts_toggle', 
		array(
			'sanitize_callback' => 'bloggers_magazinely_sanitize_radio', 
			'default' => 'gridtwo'
		));
	$wp_customize->add_control( 'featured_posts_toggle', array(
		'section'               => 'featured_posts_header',
		'label'                 => __( 'Show Featured Posts On', 'bloggers-magazinely' ),
		'type'                  => 'radio',
		'priority'              => 2,
		'choices'               => array(
			'gridtwo'            => __('Grid 1 (5 Featured Posts)', 'bloggers-magazinely'),
			'gridone'           => __('Grid 2 (4 Featured Posts)', 'bloggers-magazinely'),
		),
	));


}
add_action( 'customize_register', 'bloggers_magazinely_customize_register', 999 );




if(! function_exists('bloggers_magazinely_customize_register_output' ) ):
	function bloggers_magazinely_customize_register_output(){
		?>

		<style type="text/css">
			.entry-content-readmore a,.entry-content-readmore a:hover{ color: <?php echo esc_attr(get_theme_mod( 'readmore_color_picker')); ?>; }

			/* Navigation */
			.main-navigation a, #site-navigation span.dashicons.dashicons-menu:before, .iot-menu-left-ul a { color: <?php echo esc_attr(get_theme_mod( 'navigation_link_color')); ?>; }
			.navigation-wrapper{ background: <?php echo esc_attr(get_theme_mod( 'navigation_background_color')); ?>; }
			.main-navigation ul ul, #iot-menu-left, .navigation-outer-wrapper { background: <?php echo esc_attr(get_theme_mod( 'bottom_navigation_background_color')); ?>; }
			<?php if ( get_theme_mod( 'hide_navigation' ) == '1' ) : ?>
				.navigation-outer-wrapper {display: none;}
			<?php endif; ?>
			<?php if ( get_theme_mod( 'display_navigation_tagline' ) == '1' ) : ?>
				.site-description {display:block;}
			<?php endif; ?>


			/* Featured Image Header */
			<?php if ( get_theme_mod( 'featured_posts_categories_hide' ) == '1' ) : ?>
				.categories-featured-posts {display:none;}
			<?php endif; ?>



			/* Global */
			.single .content-area a, .page .content-area a { color: <?php echo esc_attr(get_theme_mod( 'global_link')); ?>; }
			.page .content-area a.button, .single .page .content-area a.button {color:#fff;}
			a.button,a.button:hover,a.button:active,a.button:focus, button, input[type="button"], input[type="reset"], input[type="submit"] { background: <?php echo esc_attr(get_theme_mod( 'global_link')); ?>; }
			.tags-links a, .cat-links a{ border-color: <?php echo esc_attr(get_theme_mod( 'global_link')); ?>; }
			.single main article .entry-meta *, .single main article .entry-meta, .archive main article .entry-meta *, .comments-area .comment-metadata time{ color: <?php echo esc_attr(get_theme_mod( 'global_byline')); ?>; }
			.single .content-area h1, .single .content-area h2, .single .content-area h3, .single .content-area h4, .single .content-area h5, .single .content-area h6, .page .content-area h1, .page .content-area h2, .page .content-area h3, .page .content-area h4, .page .content-area h5, .page .content-area h6, .page .content-area th, .single .content-area th, .blog.related-posts main article h4 a, .single b.fn, .page b.fn, .error404 h1, .search-results h1.page-title, .search-no-results h1.page-title, .archive h1.page-title{ color: <?php echo esc_attr(get_theme_mod( 'global_headline')); ?>; }
			.comment-respond p.comment-notes, .comment-respond label, .page .site-content .entry-content cite, .comment-content *, .about-the-author, .page code, .page kbd, .page tt, .page var, .page .site-content .entry-content, .page .site-content .entry-content p, .page .site-content .entry-content li, .page .site-content .entry-content div, .comment-respond p.comment-notes, .comment-respond label, .single .site-content .entry-content cite, .comment-content *, .about-the-author, .single code, .single kbd, .single tt, .single var, .single .site-content .entry-content, .single .site-content .entry-content p, .single .site-content .entry-content li, .single .site-content .entry-content div, .error404 p, .search-no-results p { color: <?php echo esc_attr(get_theme_mod( 'global_content')); ?>; }
			.page .entry-content blockquote, .single .entry-content blockquote, .comment-content blockquote { border-color: <?php echo esc_attr(get_theme_mod( 'global_content')); ?>; }
			.error-404 input.search-field, .about-the-author, .comments-title, .related-posts h3, .comment-reply-title{ border-color: <?php echo esc_attr(get_theme_mod( 'global_borders')); ?>; }

			<?php if ( get_theme_mod( 'fullwidth_pages' ) == '1' ) : ?>
				.page #primary.content-area { width: 100%; max-width: 100%;}
				.page aside#secondary { display: none; }
			<?php endif; ?>

			<?php if ( get_theme_mod( 'fullwidth_posts' ) == '1' ) : ?>
				.single div#primary.content-area { width: 100%; max-width: 100%; }
				.single aside#secondary { display: none; }
			<?php endif; ?>


			<?php if ( get_theme_mod( 'hide_about_the_author_section' ) == '1' ) : ?>
				.about-the-author {
					display: none;
				}
			<?php endif; ?>




			/* Sidebar */
			#secondary h4, #secondary h1, #secondary h2, #secondary h3, #secondary h5, #secondary h6, #secondary h4 a{ color: <?php echo esc_attr(get_theme_mod( 'sidebar_headline')); ?>; }
			#secondary span.rpwwt-post-title{ color: <?php echo esc_attr(get_theme_mod( 'sidebar_headline')); ?> !important; }
			#secondary select, #secondary h4, .blog #secondary input.search-field, .blog #secondary input.search-field, .search-results #secondary input.search-field, .archive #secondary input.search-field { border-color: <?php echo esc_attr(get_theme_mod( 'sidebar_border')); ?>; }
			#secondary * { color: <?php echo esc_attr(get_theme_mod( 'sidebar_text')); ?>; }
			#secondary .rpwwt-post-date{ color: <?php echo esc_attr(get_theme_mod( 'sidebar_text')); ?> !important; }
			#secondary a { color: <?php echo esc_attr(get_theme_mod( 'sidebar_link')); ?>; }
			#secondary .search-form input.search-submit, .search-form input.search-submit, input.search-submit { background: <?php echo esc_attr(get_theme_mod( 'sidebar_link')); ?>; }

			/* Blog Feed */
			body.custom-background.blog, body.blog, body.custom-background.archive, body.archive, body.custom-background.search-results, body.search-results{ background-color: <?php echo esc_attr(get_theme_mod( 'blog_site_background')); ?>; }
			.blog main article, .search-results main article, .archive main article{ background-color: <?php echo esc_attr(get_theme_mod( 'blog_post_background')); ?>; }
			.blog main article h2 a, .search-results main article h2 a, .archive main article h2 a{ color: <?php echo esc_attr(get_theme_mod( 'blog_post_headline')); ?>; }
			.blog main article .entry-meta, .archive main article .entry-meta, .search-results main article .entry-meta{ color: <?php echo esc_attr(get_theme_mod( 'blog_post_byline')); ?>; }
			.blog main article p, .search-results main article p, .archive main article p { color: <?php echo esc_attr(get_theme_mod( 'blog_post_excerpt')); ?>; }
			.nav-links span, .nav-links a, .pagination .current, .nav-links span:hover, .nav-links a:hover, .pagination .current:hover { background: <?php echo esc_attr(get_theme_mod( 'blog_post_navigation_bg')); ?>; }
			.nav-links span, .nav-links a, .pagination .current, .nav-links span:hover, .nav-links a:hover, .pagination .current:hover{ color: <?php echo esc_attr(get_theme_mod( 'blog_post_navigation_link')); ?>; }

			<?php if ( get_theme_mod( 'blog_feed_fullwidth' ) == '1' ) : ?>
				.fp-blog-grid {
					width: 100% !important;
					max-width: 100% !important;
				}
				.blog #secondary,
				.archive #secondary,
				.search-results #secondary {
					display:none;
				}
				.blog main article, .search-results main article, .archive main article {
					flex: 0 0 32%;
					max-width: 32%;
				}
				.blog main, .search-results main, .archive main {
					display: flex;
					flex-wrap: wrap;
					justify-content: space-between;
				}
				@media screen and (max-width: 900px) {
					.blog main article, .search-results main article, .archive main article {
						flex: 0 0 48%;
						max-width: 48%;
					}
				}
				@media screen and (max-width: 700px) {
					.blog main article, .search-results main article, .archive main article {
						flex: 0 0 100%;
						max-width: 100%;
					}
					.blog main article, .search-results main article, .archive main article {
						display: inline-block;
						flex-wrap: none;
						float: left;
						width: 100%;
						justify-content: none;
					}
				}
			<?php endif; ?>


		</style>
	<?php }
	add_action( 'wp_head', 'bloggers_magazinely_customize_register_output' );
endif;



/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @see http://tgmpluginactivation.com/configuration/ for detailed documentation.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.6.1 for child theme Bloggers Magazinely for publication on WordPress.org
 * @author     Thomas Griffin, Gary Jones, Juliette Reinders Folmer
 * @copyright  Copyright (c) 2011, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/TGMPA/TGM-Plugin-Activation
 */

/**
 * Include the TGM_Plugin_Activation class.
 *
 * Depending on your implementation, you may want to change the include call:
 *
 * Parent Theme:
 * require_once get_template_directory() . '/tgm/class-tgm-plugin-activation.php';
 *
 * Child Theme:
 * require_once get_stylesheet_directory() . '/tgm/class-tgm-plugin-activation.php';
 *
 * Plugin:
 * require_once dirname( __FILE__ ) . '/tgm/class-tgm-plugin-activation.php';
 */
require_once get_stylesheet_directory() . '/tgm/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'bloggers_magazinely_register_required_plugins' );

/**
 * Register the required plugins for this theme.
 *
 * In this example, we register five plugins:
 * - one included with the TGMPA library
 * - two from an external source, one from an arbitrary source, one from a GitHub repository
 * - two from the .org repo, where one demonstrates the use of the `is_callable` argument
 *
 * The variables passed to the `tgmpa()` function should be:
 * - an array of plugin arrays;
 * - optionally a configuration array.
 * If you are not changing anything in the configuration array, you can remove the array and remove the
 * variable from the function call: `tgmpa( $plugins );`.
 * In that case, the TGMPA default settings will be used.
 *
 * This function is hooked into `tgmpa_register`, which is fired on the WP `init` action on priority 10.
 */
function bloggers_magazinely_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(
		array(
			'name'      => 'Social Share & Follow Buttons',
			'slug'      => 'superb-social-share-and-follow-buttons',
			'required'  => false,
		),
	);

	/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
	$config = array(
		'id'           => 'bloggers-magazinely',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );
}
