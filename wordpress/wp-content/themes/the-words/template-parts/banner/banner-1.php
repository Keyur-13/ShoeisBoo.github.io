<?php
/**
 * The Words Front Page Optionl
 *
 * @package The_Words
**/

$ed_header_banner = get_theme_mod('ed_header_banner',1);
$ta_header_banner_category = get_theme_mod('ta_header_banner_category');

if( $ed_header_banner ){

	$banner_post_args = array(
		'poat_type' => 'post',
		'order' => 'DESC',
		'posts_per_page' => 10,
		'post_status' => 'publish',
		'category_name' => $ta_header_banner_category
	); 
	$banner_post_query = new WP_Query( $banner_post_args );

	if( $banner_post_query->have_posts() ): ?>

		<div class="ta-banner-main">
			<div class="ta-container clearfix">
				<div class="ta-banner-1-action">

					<?php
					while( $banner_post_query->have_posts() ){
						$banner_post_query->the_post();

						$banner_post_image = wp_get_attachment_image_src( get_post_thumbnail_id(),'full' );
						$banner_post_image = isset( $banner_post_image[0] ) ? $banner_post_image[0] : ''; ?>

						<div class="ta-banner-iteam">
							<div class="ta-iteam-secondary">
								
								<div class="ta-banner-content ta-bg-height-1" <?php if( $banner_post_image ){ ?> style="background-image: url(<?php echo esc_url( $banner_post_image ); ?> );" <?php } ?> ></div>

								<div class="ta-content-absolute-2">

									<header class="entry-header">
									  	<?php the_words_entry_footer( $cats = true, $tags = false, $edcomments = false, $edit = false, $layout = 2 ); ?>
									</header><!-- .entry-header -->

									<div class="title-banner-post">
										<h4 class="entry-title ta-extra-large-font ta-secondary-font"><a href="<?php the_permalink(); ?>"><?php echo esc_html( wp_trim_words( get_the_title(),10,'...' ) ); ?></a></h4>
									</div>

								</div>

							</div>	
						</div>

					<?php }
					wp_reset_postdata(); ?>

				</div>
			</div>
		</div>

	<?php endif;

}