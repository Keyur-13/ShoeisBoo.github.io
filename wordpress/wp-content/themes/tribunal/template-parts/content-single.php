<?php
/**
 * The default template for displaying content
 *
 * Used for both singular and index.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Tribunal
 * @since 1.0.0
 */

$tribunal_default = tribunal_get_default_theme_options();
$tribunal_post_layout = esc_html( get_post_meta( get_the_ID(), 'tribunal_post_layout', true ) );
$tribunal_header_trending_page = get_theme_mod( 'tribunal_header_trending_page' );
$tribunal_header_popular_page = get_theme_mod( 'tribunal_header_popular_page' );
$tribunal_ed_feature_image = esc_html( get_post_meta( get_the_ID(), 'tribunal_ed_feature_image', true ) );

if( is_page() ){

	$tribunal_post_layout = get_post_meta(get_the_ID(), 'tribunal_page_layout', true);
	
}
if( $tribunal_post_layout == '' || $tribunal_post_layout == 'global-layout' ){
    
    $tribunal_post_layout = get_theme_mod( 'tribunal_single_post_layout',$tribunal_default['tribunal_single_post_layout'] );

}

if( $tribunal_header_trending_page != get_the_ID() && $tribunal_header_popular_page != get_the_ID() ){
	
	tribunal_disable_post_views();
	tribunal_disable_post_like_dislike();

	$tribunal_ed_post_views = esc_html( get_post_meta( get_the_ID(), 'tribunal_ed_post_views', true ) );
	$tribunal_ed_post_read_time = esc_html( get_post_meta( get_the_ID(), 'tribunal_ed_post_read_time', true ) );
	$tribunal_ed_post_author_box = esc_html( get_post_meta( get_the_ID(), 'tribunal_ed_post_author_box', true ) );
	$tribunal_ed_post_social_share = esc_html( get_post_meta( get_the_ID(), 'tribunal_ed_post_social_share', true ) );
	$tribunal_ed_post_reaction = esc_html( get_post_meta( get_the_ID(), 'tribunal_ed_post_reaction', true ) );
	
	if( $tribunal_ed_post_read_time ){ tribunal_disable_post_read_time(); }
	if( $tribunal_ed_post_author_box ){ tribunal_disable_post_author_box(); }
	if( $tribunal_ed_post_reaction ){ tribunal_disable_post_reaction(); }
	?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>> 

		<?php

		if( empty( $tribunal_ed_feature_image ) && $tribunal_post_layout != 'layout-2' && !is_page_template('templates/template-cover.php') && !is_page_template( 'templates/template-cover-full-width.php' ) ){
			?><div class="post-thumbnail"><?php
			tribunal_post_thumbnail();
			?></div><?php
		}

		if ( is_singular() && $tribunal_post_layout != 'layout-2' ) { ?>

			<header class="entry-header entry-header-1">

				<?php
				if ( 'post' === get_post_type() ) { ?>

					<div class="entry-meta">

						<?php tribunal_entry_footer( $cats = true, $tags = false, $edits = false, $text = false, $icon = false ); ?>

					</div>

				<?php  } ?>

				<h1 class="entry-title">

		            <?php the_title(); ?>

		        </h1>

			</header>

		<?php }

		if ( $tribunal_post_layout != 'layout-2' && is_single() && 'post' === get_post_type() ) { ?>

			<div class="entry-meta">

				<?php
				tribunal_posted_by();
				tribunal_posted_on();
				if( !$tribunal_ed_post_views ){ tribunal_post_view_count(); }
				?>

			</div>

		<?php  } ?>
		
		<div class="post-content-wrap">

			<?php if( is_singular() && empty( $tribunal_ed_post_social_share ) && class_exists( 'Booster_Extension_Class' ) && 'post' === get_post_type() ){ ?>

				<div class="post-content-share">
					<?php echo do_shortcode('[booster-extension-ss layout="layout-1" status="enable"]'); ?>
				</div>

			<?php } ?>

			<div class="post-content">

				<div class="entry-content">

					<?php

					the_content( sprintf(
						/* translators: %s: Name of current post. */
						wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'tribunal' ), array( 'span' => array( 'class' => array() ) ) ),
						the_title( '<span class="screen-reader-text">"', '"</span>', false )
					) );

					if( !class_exists('Booster_Extension_Class') || is_page() ):

	                    wp_link_pages(array(
	                        'before' => '<div class="page-links">' . esc_html__('Pages:', 'tribunal'),
	                        'after' => '</div>',
	                    ));

	                endif; ?>

				</div>

				<?php
				if ( is_singular() && 'post' === get_post_type() ) { ?>

					<div class="entry-footer">
                        <div class="entry-meta">
                             <?php tribunal_post_like_dislike(); ?>
                        </div>
                        <div class="entry-meta">
                            <?php
                            tribunal_entry_footer( $cats = false, $tags = true, $edits = true );
                            ?>
                        </div>
					</div>

				<?php } ?>

			</div>

		</div>

	</article>

<?php }else{

	tribunal_trending_popular_posts( get_the_ID() );

} ?>