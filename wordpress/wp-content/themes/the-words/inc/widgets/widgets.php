<?php
/**
 * The Words Widgets
 *
 * @package The_Words
 */

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function the_words_widgets_init() {
	
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'the-words' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'the-words' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer One', 'the-words' ),
		'id'            => 'the-words-footer-1',
		'description'   => esc_html__( 'Add widgets here.', 'the-words' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Two', 'the-words' ),
		'id'            => 'the-words-footer-2',
		'description'   => esc_html__( 'Add widgets here.', 'the-words' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Three', 'the-words' ),
		'id'            => 'the-words-footer-3',
		'description'   => esc_html__( 'Add widgets here.', 'the-words' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

}
add_action( 'widgets_init', 'the_words_widgets_init' );


/**
 * Widget Fields.
 */
require get_template_directory() . '/inc/widgets/widget-fields.php';
require get_template_directory() . '/inc/widgets/author.php';
require get_template_directory() . '/inc/widgets/recent-news.php';
require get_template_directory() . '/inc/widgets/category.php';