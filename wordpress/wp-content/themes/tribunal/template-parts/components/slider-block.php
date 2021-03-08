<?php
/**
* Slider Posts Function.
*
* @package Tribunal
*/

if ( !function_exists( 'tribunal_slider_blocks' ) ):

    function tribunal_slider_blocks( $tribunal_home_section,$repeat_times ){
        
        $section_category = esc_html( isset($tribunal_home_section->section_category) ? $tribunal_home_section->section_category : '');
        $slider_arrows = esc_html( isset($tribunal_home_section->ed_arrows_carousel) ? $tribunal_home_section->ed_arrows_carousel : '');
        $slider_dots = esc_html( isset($tribunal_home_section->ed_dots_carousel) ? $tribunal_home_section->ed_dots_carousel : '');
        $slider_autoplay = esc_html( isset($tribunal_home_section->ed_autoplay_carousel) ? $tribunal_home_section->ed_autoplay_carousel : '');

        $carousel_post_query = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => 5,'post__not_in' => get_option("sticky_posts"), 'category_name' => esc_html( $section_category ) ) );

        if ( $slider_autoplay == 'yes' ) {
            $autoplay = 'true';
        }else{
            $autoplay = 'false';
        }
        if( $slider_dots == 'yes' ) {
            $dots = 'true';
        }else {
            $dots = 'false';
        }
        if( is_rtl() ) {
            $rtl = 'true';
        }else{
            $rtl = 'false';
        }

        if ( $carousel_post_query->have_posts() ): ?>

            <div class="theme-block theme-block-nospace theme-block-slider">
			    <div class="wrapper-fluid">


	                <div class="theme-slider-main" data-slick='{"autoplay": <?php echo esc_attr( $autoplay ); ?>, "dots": <?php echo esc_attr( $dots ); ?>, "rtl": <?php echo esc_attr( $rtl ); ?>}'>

		                <?php while( $carousel_post_query->have_posts() ){ 
		                	$carousel_post_query->the_post();
		                	$featured_image = wp_get_attachment_image_src( get_post_thumbnail_id(),'full' ); ?>

		                    <div class="theme-slider-item">
                                <article id="theme-post-<?php the_ID(); ?>" <?php post_class('post-thumb post-thumb-slides'); ?>>
                                    <div class="data-bg data-bg-xl-large thumb-overlay thumb-overlay-darker img-hover-slide" data-background="<?php echo esc_url($featured_image[0]); ?>">
                                        <a class="img-link" href="<?php the_permalink(); ?>" tabindex="0"></a>
                                        <div class="article-content article-content-overlay">
                                            <div class="wrapper">
                                                <div class="column-row">
                                                    <div class="column column-8 column-sm-12">
                                                        <div class="entry-meta">
                                                            <?php tribunal_entry_footer($cats = true, $tags = false, $edits = false, $text = false, $icon = false); ?>
                                                        </div>
                                                        <h2 class="entry-title entry-title-large">
                                                            <a href="<?php the_permalink(); ?>" tabindex="0" rel="bookmark" title="<?php the_title_attribute(); ?>">
                                                                <?php the_title(); ?>
                                                            </a>
                                                        </h2>
                                                        <div class="entry-meta">
                                                            <?php tribunal_posted_on(); ?>
                                                            <?php tribunal_post_view_count(); ?>
                                                            <?php tribunal_posted_by(); ?>
                                                        </div>
                                                        <div class="entry-content text-white entry-content-small hidden-xs-element">

                                                            <?php
                                                            if( has_excerpt() ){

                                                                the_excerpt();

                                                            }else{

                                                                echo esc_html( wp_trim_words( get_the_content(),60,'...' ) );

                                                            } ?>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </article>
		                    </div>

		                <?php } ?>

	                </div>

                    <div class="slider-navigator">
                        <div class="wrapper">
                            <div class="theme-slider-navigator theme-carousel-space" data-slick='{"autoplay": <?php echo esc_attr( $autoplay ); ?>, "dots": <?php echo esc_attr( $dots ); ?>, "rtl": <?php echo esc_attr( $rtl ); ?>}'>

                                <?php while( $carousel_post_query->have_posts() ){
                                    $carousel_post_query->the_post(); ?>

                                    <div class="theme-slider-item">
                                        <article id="theme-post-<?php the_ID(); ?>" <?php post_class( 'post-thumb post-thumb-slides' ); ?>>
                                            <div class="entry-meta">
                                                <?php tribunal_entry_footer( $cats = true, $tags = false, $edits = false, $text = false, $icon = false ); ?>
                                            </div>
                                            <h3 class="entry-title entry-title-medium">
                                                <?php the_title(); ?>
                                            </h3>
                                            <div class="entry-meta">
                                                <?php tribunal_posted_on(); ?>
                                                <?php tribunal_post_view_count(); ?>
                                            </div>
                                        </article>
                                    </div>

                                <?php } ?>

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