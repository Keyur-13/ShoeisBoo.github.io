<?php
/**
 * Banner Blocks Four
 *
 * @package Tribunal
 */

if (!function_exists('tribunal_banner_block_4_section')):

    function tribunal_banner_block_4_section($tribunal_home_section, $repeat_times){

        $ed_ribbon_bg = esc_html(isset($tribunal_home_section->ed_ribbon_bg) ? $tribunal_home_section->ed_ribbon_bg : '');
        $ribbon_bg_size = esc_html( isset($tribunal_home_section->ribbon_bg_size ) ? $tribunal_home_section->ribbon_bg_size : 'medium');
        $ribbon_bg_color_schema = esc_html(isset($tribunal_home_section->ribbon_bg_color_schema) ? $tribunal_home_section->ribbon_bg_color_schema : '3');
        if( empty( $ed_ribbon_bg ) ){ $ed_ribbon_bg = 'no'; };
        if( empty( $ribbon_bg_size ) ){ $ribbon_bg_size = 'medium'; };
        if( empty( $ribbon_bg_color_schema ) ){ $ribbon_bg_color_schema = 1; };
        ?>

        <div class="theme-block theme-block-elements <?php if( $ed_ribbon_bg == 'yes' ){ ?>theme-block-bg theme-block-bg-<?php echo esc_attr( $ribbon_bg_color_schema ); ?> theme-block-bg-<?php echo esc_attr( $ribbon_bg_size ); } ?> theme-block-elements-4">
            
            <div class="wrapper">
                <div class="column-row">

                    <?php
                    for ($x = 1; $x <= 3; $x++) {

                        if( $x == 3 ){
                            $section_category = esc_html( isset($tribunal_home_section->section_category_3) ? $tribunal_home_section->section_category_3 : '');
                        }elseif( $x == 2 ){
                            $section_category = esc_html( isset($tribunal_home_section->section_category_2) ? $tribunal_home_section->section_category_2 : '');
                        }else{
                            $section_category = esc_html( isset($tribunal_home_section->section_category_1) ? $tribunal_home_section->section_category_1 : '');
                        }

                        $banner_query = new WP_Query( array('post_type' => 'post', 'posts_per_page' => 6,'post__not_in' => get_option("sticky_posts"), 'category_name' => esc_html( $section_category ) ) );

                        if( $banner_query->have_posts() ): ?>
                            <div class="column column-4 column-sm-6 column-xs-12">

                                <?php if( $section_category ){

                                    $catObj = get_category_by_slug( $section_category );
                                    if( isset(  $catObj->name ) &&  $catObj->name ){ ?>
                                    <header class="block-title-wrapper">
                                        <h2 class="block-title block-title-large">
                                            <?php echo esc_html(  $catObj->name ); ?>
                                        </h2>
                                    </header>

                                <?php }
                                } ?>

                                <div class="content-main content-main-bg">
                                    
                                    <?php
                                    $count = 1;
                                    while( $banner_query->have_posts() ):
                                        $banner_query->the_post();

                                        if( $count == 1 ){
                                            $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium_large');
                                        }else{
                                            $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium');
                                        }
                                        ?>

                                        <div class="content-list <?php if( $count == 1 ){ echo 'content-list-primary'; } ?>">
                                            <article id="theme-post-<?php the_ID(); ?>" <?php post_class( 'news-article' ); ?>>
                                                <div class="column-row">
                                                    <?php if( $featured_image[0] ){ ?>
                                                        <div class="column column-<?php if(  $count == 1 ){ ?>12<?php }else{ ?>4<?php } ?>">
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
                                                        </div>
                                                    <?php } ?>
                                                    <div class="column column-<?php if( $count == 1 ){ ?>12<?php }else{ if(  $featured_image[0] ){ ?>8<?php }else{ ?>12<?php } } ?>">
                                                        <div class="article-content">

                                                            <?php if( $count == 1 ){ ?>
                                                                <div class="entry-meta">
                                                                    <?php tribunal_entry_footer( $cats = true, $tags = false, $edits = false, $text = false, $icon = false ); ?>
                                                                </div>
                                                            <?php } ?>
                                                        
                                                            <h3 class="entry-title entry-title-xsmall">
                                                                <a href="<?php the_permalink(); ?>" tabindex="0" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                                                            </h3>
                                                            <div class="entry-meta">
                                                                <?php tribunal_posted_on(); ?>
                                                                <?php tribunal_post_view_count(); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </article>
                                        </div>

                                        <?php
                                        $count++;

                                    endwhile;
                                    wp_reset_postdata(); ?>

                                </div>
                            </div>

                        <?php 
                        endif;
                    } ?>

                </div>
            </div>

        </div>

    <?php
    }
endif;