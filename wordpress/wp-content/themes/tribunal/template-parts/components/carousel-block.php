<?php
/**
* Carousel Posts Function.
*
* @package Tribunal
*/

if ( !function_exists( 'tribunal_carousel_posts' ) ):

    // Header Carousel Post.
    function tribunal_carousel_posts( $tribunal_home_section,$repeat_times ){
        
        $section_category = esc_html( isset($tribunal_home_section->section_category) ? $tribunal_home_section->section_category : '');
        $slider_arrows = esc_html( isset($tribunal_home_section->ed_arrows_carousel) ? $tribunal_home_section->ed_arrows_carousel : '');
        $slider_dots = esc_html( isset($tribunal_home_section->ed_dots_carousel) ? $tribunal_home_section->ed_dots_carousel : '');
        $slider_autoplay = esc_html( isset($tribunal_home_section->ed_autoplay_carousel) ? $tribunal_home_section->ed_autoplay_carousel : '');
        $home_section_title = esc_html( isset($tribunal_home_section->home_section_title) ? $tribunal_home_section->home_section_title : '');

        $carousel_post_query = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => 12,'post__not_in' => get_option("sticky_posts"), 'category_name' => esc_html( $section_category ) ) );

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

            <div class="theme-block theme-block-carousel">
			    <div class="wrapper">

				        <div class="column-row">
				            <div class="column">
				                <header class="block-title-wrapper">

                                    <?php if( $home_section_title ){ ?>
                                        <h2 class="block-title block-title-large">
                                            <?php echo esc_html( $home_section_title ); ?>
                                        </h2>
                                    <?php } ?>

                                    <?php if( $slider_arrows != 'no' ){ ?>
				                    
                                        <div class="title-controls title-controls-bg">
    				                        <button type="button" class="twp-slide-prev slide-icon-1 slide-prev-1 slick-arrow">
    				                            <i class="ion-ios-arrow-back slick-arrow"></i>
    				                        </button>
    				                        <button type="button" class="twp-slide-next slide-icon-1 slide-next-1 slick-arrow">
    				                            <i class="ion-ios-arrow-forward slick-arrow"></i>
    				                        </button>
    				                    </div>
                                    
                                    <?php } ?>

				                </header>
				            </div>
				        </div>

		                <div class="theme-carousel-slider theme-carousel-space" data-slick='{"autoplay": <?php echo esc_attr( $autoplay ); ?>, "dots": <?php echo esc_attr( $dots ); ?>, "rtl": <?php echo esc_attr( $rtl ); ?>}'>

			                <?php while( $carousel_post_query->have_posts() ){ 
			                	$carousel_post_query->the_post();
			                	$featured_image = wp_get_attachment_image_src( get_post_thumbnail_id(),'medium_large' ); ?>

			                    <div class="theme-carousel-item">
			                        <article id="theme-post-<?php the_ID(); ?>" <?php post_class( 'news-article post-thumb post-thumb-slides' ); ?>>
                                        <div class="data-bg data-bg-big thumb-overlay img-hover-slide img-hover-border" data-background="<?php echo esc_url( $featured_image[0] ); ?>">
                                            <?php
                                            $format = get_post_format( get_the_ID() ) ? : 'standard';
                                            $icon = tribunal_post_format_icon( $format );
                                            if( !empty( $icon ) ){ ?>
                                                <span class="top-right-icon">
                                                    <i class="ion <?php echo esc_attr( $icon ); ?>"></i>
                                                </span>
                                            <?php } ?>
                                            <a class="img-link" href="<?php the_permalink(); ?>" tabindex="0"></a>
                                            <div class="article-content article-content-overlay">
                                                <div class="entry-meta">
                                                    <?php tribunal_entry_footer( $cats = true, $tags = false, $edits = false, $text = false, $icon = false ); ?>
                                                </div>
                                                <h3 class="entry-title entry-title-medium">
                                                    <a href="<?php the_permalink(); ?>" tabindex="0" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                                                </h3>
                                                <div class="entry-meta">
                                                    <?php tribunal_posted_on(); ?>
                                                    <?php tribunal_post_view_count(); ?>
                                                </div>
                                            </div>
                                        </div>
			                        </article>
			                    </div>

			                <?php } ?>

		                </div>


			    </div>
			</div>

        <?php
        wp_reset_postdata();
        endif;

    }

endif;