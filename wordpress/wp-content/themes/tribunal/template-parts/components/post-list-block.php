<?php
/**
 * Banner Blocks Four
 *
 * @package Tribunal
 */

if (!function_exists('tribunal_post_list_block_section')):

    function tribunal_post_list_block_section($tribunal_home_section, $repeat_times){

        $section_category = esc_html(isset($tribunal_home_section->section_category) ? $tribunal_home_section->section_category : '');
        $ed_ribbon_bg = esc_html(isset($tribunal_home_section->ed_ribbon_bg) ? $tribunal_home_section->ed_ribbon_bg : '');
        $ribbon_bg_size = esc_html( isset($tribunal_home_section->ribbon_bg_size ) ? $tribunal_home_section->ribbon_bg_size : 'medium');
        $ribbon_bg_color_schema = esc_html(isset($tribunal_home_section->ribbon_bg_color_schema) ? $tribunal_home_section->ribbon_bg_color_schema : '3');
        $home_section_title = esc_html(isset($tribunal_home_section->home_section_title) ? $tribunal_home_section->home_section_title : '3');
        if( empty( $ed_ribbon_bg ) ){ $ed_ribbon_bg = 'no'; };
        if( empty( $ribbon_bg_size ) ){ $ribbon_bg_size = 'medium'; };
        if( empty( $ribbon_bg_color_schema ) ){ $ribbon_bg_color_schema = 1; };
        
        $section_query = new WP_Query( array('post_type' => 'post', 'posts_per_page' => 9,'post__not_in' => get_option("sticky_posts"), 'category_name' => esc_html( $section_category ) ) );

        if( $section_query->have_posts() ): ?>

            <div class="theme-block theme-block-elements <?php if( $ed_ribbon_bg == 'yes' ){ ?>theme-block-bg theme-block-bg-<?php echo esc_attr( $ribbon_bg_color_schema ); ?> theme-block-bg-<?php echo esc_attr( $ribbon_bg_size ); } ?> theme-post-list-block">
                
                <div class="wrapper">
                    <div class="column-row">
                        <div class="column column-12">

                            <?php if( $home_section_title ){ ?>

                                <header class="block-title-wrapper">
                                    <h2 class="block-title block-title-large">
                                        <?php echo esc_html( $home_section_title ); ?>
                                    </h2>
                                </header>

                            <?php } ?>

                            <div class="column-row">
                                <?php
                                while( $section_query->have_posts() ):
                                    $section_query->the_post();

                                    $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium'); ?>

                                    <div class="column column-4 column-sm-6 column-xs-12">
                                        <article id="theme-post-<?php the_ID(); ?>" <?php post_class( 'news-article  news-article-spacing news-article-bg' ); ?>>
                                            <div class="column-row">
                                                <?php if( $featured_image[0] ){ ?>
                                                <div class="column column-4">
                                                    <div class="post-thumbnail">
                                                        <div class="img-hover-scale">
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
                                                </div>
                                                <?php } ?>

                                                <div class="column column-<?php if(  $featured_image[0] ){ ?>8<?php }else{ ?>12<?php } ?>">
                                                    <div class="article-content">
                                                        <h3 class="entry-title entry-title-xsmall">
                                                            <a href="<?php the_permalink(); ?>" tabindex="0" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                                                        </h3>
                                                        <div class="entry-meta">
                                                            <div class="entry-meta-item entry-meta-date">
                                                                <div class="entry-meta-wrapper">
                                                                    <?php tribunal_posted_on(); ?>
                                                                    <?php tribunal_post_view_count(); ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </article>
                                    </div>
                                <?php endwhile;
                                wp_reset_postdata(); ?>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        <?php
        endif;

    }
endif;