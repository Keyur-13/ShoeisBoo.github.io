<?php
/**
 * Lead Blocks
 *
 * @package Tribunal
 */
if (!function_exists('tribunal_lead_block_section')):
    function tribunal_lead_block_section($tribunal_home_section, $repeat_times){

        $section_category = esc_html( isset($tribunal_home_section->section_category) ? $tribunal_home_section->section_category : '');
        $lead_post_query = new WP_Query( array('post_type' => 'post', 'posts_per_page' => 3,'post__not_in' => get_option("sticky_posts"), 'category_name' => esc_html( $section_category ) ) );
        $ed_flip_column = esc_html(isset($tribunal_home_section->ed_flip_column) ? $tribunal_home_section->ed_flip_column : '');

        $ed_ribbon_bg = esc_html(isset($tribunal_home_section->ed_ribbon_bg) ? $tribunal_home_section->ed_ribbon_bg : '');
        $ribbon_bg_size = esc_html( isset($tribunal_home_section->ribbon_bg_size ) ? $tribunal_home_section->ribbon_bg_size : 'medium');
        $ribbon_bg_color_schema = esc_html(isset($tribunal_home_section->ribbon_bg_color_schema) ? $tribunal_home_section->ribbon_bg_color_schema : '4');
        if( empty( $ed_ribbon_bg ) ){ $ed_ribbon_bg = 'no'; };
        if( empty( $ribbon_bg_size ) ){ $ribbon_bg_size = 'medium'; };
        if( empty( $ribbon_bg_color_schema ) ){ $ribbon_bg_color_schema = 1; };
        
        if( $lead_post_query ->have_posts() ): ?>

                <div class="theme-block theme-block-notop theme-block-lead <?php if( $ed_ribbon_bg == 'yes' ){ ?>theme-block-bg theme-block-bg-<?php echo esc_attr( $ribbon_bg_color_schema ); ?> theme-block-bg-<?php echo esc_attr( $ribbon_bg_size ); } ?>">
                    <div class="wrapper">
                        <div class="column-row column-row-collapse">
                            <div class="column-bg">
                                <?php
                                while( $lead_post_query ->have_posts() ){
                                    $lead_post_query ->the_post();

                                    $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
                                    ?>

                                    <div class="column column-6 column-sm-12 <?php if ($ed_flip_column != 'yes') { ?>column-order-1<?php } else { ?>column-order-2<?php } ?>">
                                        <article id="theme-post-<?php the_ID(); ?>" <?php post_class('post-thumb news-article'); ?>>
                                            <?php if( $featured_image[0] ){ ?>
                                            <div class="data-bg data-bg-medium thumb-overlay thumb-overlay-darker img-hover-slide" data-background="<?php echo esc_url($featured_image[0]); ?>">
                                                <?php
                                                $format = get_post_format( get_the_ID() ) ? : 'standard';
                                                $icon = tribunal_post_format_icon( $format );
                                                if( !empty( $icon ) ){ ?>
                                                    <span class="top-right-icon">
                                                        <i class="ion <?php echo esc_attr( $icon ); ?>"></i>
                                                    </span>
                                                <?php } ?>
                                                <a class="img-link" href="<?php the_permalink(); ?>" tabindex="0"></a>
                                            </div>

                                            <?php } ?>

                                            <div class="article-content">

                                                <div class="entry-meta">
                                                    <?php tribunal_entry_footer( $cats = true, $tags = false, $edits = false, $text = false, $icon = false ); ?>
                                                </div>

                                                <h3 class="entry-title entry-title-medium">
                                                    <a href="<?php the_permalink(); ?>" tabindex="0" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                                                </h3>

                                                <div class="entry-meta">
                                                    <?php tribunal_posted_on(); ?>
                                                    <?php tribunal_post_view_count(); ?>
                                                    <?php tribunal_posted_by(); ?>
                                                </div>

                                                <div class="entry-content entry-content-muted entry-content-small">

                                                    <?php
                                                    if( has_excerpt() ){

                                                        the_excerpt();

                                                    }else{

                                                        echo esc_html( wp_trim_words( get_the_content(),30,'...' ) );

                                                    } ?>

                                                </div>

                                            </div>
                                        </article>
                                    </div>

                                    <?php
                                    break;

                                } ?>

                                <div class="column column-6 column-sm-12 <?php if ($ed_flip_column != 'yes') { ?>column-order-2<?php } else { ?>column-order-1<?php } ?>">
                                    <div class="column-row column-row-collapse">
                                        <?php
                                        $i = 1;
                                        while( $lead_post_query ->have_posts() ){
                                            $lead_post_query ->the_post();

                                            $class = '';
                                            if( $i == 1 && $ed_flip_column != 'yes' ){
                                                $class = 'column-lr-border';
                                            }

                                            if( $i == 2 && $ed_flip_column == 'yes' ){
                                                $class = 'column-lr-border';
                                            }

                                            $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium_large');
                                            ?>
                                            <div class="column column-6 column-xs-12 <?php echo esc_attr( $class ); ?>">
                                                <div class="content-main">
                                                    <div class="content-list">
                                                        <article id="theme-post-<?php the_ID(); ?>" <?php post_class( 'news-article' ); ?>>

                                                            <?php if( $featured_image[0] ){ ?>
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
                                                            <?php } ?>

                                                            <div class="article-content">
                                                                <div class="entry-meta">
                                                                    <?php tribunal_entry_footer( $cats = true, $tags = false, $edits = false, $text = false, $icon = false ); ?>
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
                                                                    if( has_excerpt() ){

                                                                        the_excerpt();

                                                                    }else{

                                                                        echo esc_html( wp_trim_words( get_the_content(),20,'...' ) );

                                                                    } ?>

                                                                </div>
                                                            </div>

                                                        </article>
                                                    </div>
                                                </div>
                                            </div>

                                            <?php
                                            $i++;

                                        } ?>
                                        
                                    </div>
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