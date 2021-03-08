<?php
/**
 * Lead Blocks
 *
 * @package Tribunal
 */
if (!function_exists('tribunal_masonry_block_section')):
    function tribunal_masonry_block_section($tribunal_home_section, $repeat_times){

        $section_category = esc_html( isset($tribunal_home_section->section_category) ? $tribunal_home_section->section_category : '');
        $masonry_post_query = new WP_Query( array( 'post_type' => 'post','posts_per_page' => 8,'post__not_in' => get_option("sticky_posts"), 'category_name' => esc_html( $section_category ) ) );

        if( $masonry_post_query ->have_posts() ): ?>

            <div repeat-time="<?php echo esc_attr( 'repeat-time-'.$repeat_times ); ?>" class="theme-block theme-block-masonry <?php echo esc_attr( 'repeat-time-'.$repeat_times ); ?>">
                <div class="wrapper">
                    <div class="column-row all-item-content">

                        <?php
                        while( $masonry_post_query ->have_posts() ){
                            $masonry_post_query ->the_post();

                            $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium_large');  ?>

                            <div class="column column-3 column-sm-6 column-xs-12 twp-masonary-item">

                                        <article id="theme-post-<?php the_ID(); ?>" <?php post_class( 'news-article news-article-spacing news-article-bg' ); ?>>

                                            <?php if( $featured_image[0] ){ ?>
                                                    <div class="post-thumbnail">
                                                        <div class="img-hover-scale mb-15">

                                                            <?php
                                                            $format = get_post_format(get_the_ID()) ?: 'standard';
                                                            $icon = tribunal_post_format_icon($format);
                                                            if (!empty($icon)) { ?>
                                                                <span class="top-right-icon"><i class="ion <?php echo esc_attr($icon); ?>"></i></span>
                                                            <?php } ?>

                                                            <a href="<?php the_permalink(); ?>" tabindex="0">
                                                                <img title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" src="<?php echo esc_url($featured_image[0]); ?>">
                                                            </a>

                                                        </div>
                                                    </div>
                                            <?php } ?>

                                            <div class="article-content">
                                                <div class="entry-meta">
                                                    <?php tribunal_entry_footer($cats = true, $tags = false, $edits = false, $text = false, $icon = false); ?>
                                                </div>


                                                <h3 class="entry-title entry-title-small">
                                                    <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
                                                </h3>

                                                <div class="entry-meta">
                                                    <?php tribunal_posted_on(); ?>
                                                    <?php tribunal_post_view_count(); ?>
                                                </div>

                                                <div class="entry-content entry-content-muted entry-content-small">

                                                    <?php
                                                    if (has_excerpt()) {

                                                        the_excerpt();

                                                    } else {

                                                        echo esc_html(wp_trim_words(get_the_content(), 25, '...'));

                                                    } ?>

                                                </div>
                                            </div>
                                        </article>

                            </div>

                        <?php } ?>

                    </div>

                    <div class="loadmore-area hide-no-js">
                        <button type="button" paged_current="2" section_category="<?php echo esc_attr( $section_category ); ?>" class="btn-loadmore">
                            <span class="loadmore"><?php echo esc_html('Load More Posts','tribunal'); ?></span>
                        </button>
                    </div>

                </div>
            </div>

        <?php
        wp_reset_postdata();
        endif;

    }
endif;