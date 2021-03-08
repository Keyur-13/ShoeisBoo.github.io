<?php
/**
 * Banner Blocks Three
 *
 * @package Tribunal
 */
if (!function_exists('tribunal_banner_block_3_section')):
    function tribunal_banner_block_3_section($tribunal_home_section, $repeat_times){
        $section_category_1 = esc_html( isset($tribunal_home_section->section_category_1) ? $tribunal_home_section->section_category_1 : '');
        $section_category_2 = esc_html( isset($tribunal_home_section->section_category_2) ? $tribunal_home_section->section_category_2 : '');
        $section_category_3 = esc_html( isset($tribunal_home_section->section_category_3) ? $tribunal_home_section->section_category_3 : '');
        $ed_ribbon_bg = esc_html(isset($tribunal_home_section->ed_ribbon_bg) ? $tribunal_home_section->ed_ribbon_bg : '');
        $ribbon_bg_size = esc_html( isset($tribunal_home_section->ribbon_bg_size ) ? $tribunal_home_section->ribbon_bg_size : 'medium');

        $cat_title_1 = esc_html( isset($tribunal_home_section->cat_title_1) ? $tribunal_home_section->cat_title_1 : '');
        $cat_title_2 = esc_html( isset($tribunal_home_section->cat_title_2) ? $tribunal_home_section->cat_title_2 : '');
        $cat_title_3 = esc_html( isset($tribunal_home_section->cat_title_3) ? $tribunal_home_section->cat_title_3 : '');

        if( empty( $ed_ribbon_bg ) ){ $ed_ribbon_bg = 'no'; };
        if( empty( $ribbon_bg_size ) ){ $ribbon_bg_size = 'medium'; };
        if( empty( $ribbon_bg_color_schema ) ){ $ribbon_bg_color_schema = 1; };
        
        $ribbon_bg_color_schema = esc_html(isset($tribunal_home_section->ribbon_bg_color_schema) ? $tribunal_home_section->ribbon_bg_color_schema : '3');
        $banner_query_1 = new WP_Query( array('post_type' => 'post', 'posts_per_page' => 10,'post__not_in' => get_option("sticky_posts"), 'category_name' => esc_html( $section_category_1 ) ) );
        $banner_query_2 = new WP_Query( array('post_type' => 'post', 'posts_per_page' => 4,'post__not_in' => get_option("sticky_posts"), 'category_name' => esc_html( $section_category_2 ) ) );
        $banner_query_3 = new WP_Query( array('post_type' => 'post', 'posts_per_page' => 9,'post__not_in' => get_option("sticky_posts"), 'category_name' => esc_html( $section_category_3 ) ) );

        $mid_post_1 = array();
        $mid_post_2 = array();

        if( $banner_query_2->have_posts() ):
            
            $count = 1;
            while( $banner_query_2->have_posts() ):
                $banner_query_2->the_post();

                if( $count == 1 ){
                    $mid_post_1[] = get_the_ID();
                }else{
                    $mid_post_2[] = get_the_ID();
                }

                $count++;
            endwhile;

            wp_reset_postdata();

        endif;

        ?>
        <div class="theme-block theme-block-elements <?php if( $ed_ribbon_bg == 'yes' ){ ?>theme-block-bg theme-block-bg-<?php echo esc_attr( $ribbon_bg_color_schema ); ?> theme-block-bg-<?php echo esc_attr( $ribbon_bg_size ); } ?> theme-block-elements-3">
            <div class="wrapper">
                <div class="column-row">

                    <?php
                    if( $banner_query_2->have_posts() ): ?>


                        <div class="column column-3 column-sm-6 column-xxs-12 column-order-1">

                            <?php if( $cat_title_1 ){ ?>

                                <div class="column-row">
                                    <div class="column column-12">
                                        
                                        <header class="block-title-wrapper">
                                            <h2 class="block-title block-title-large">
                                                <?php echo esc_html( $cat_title_1 ); ?>
                                            </h2>
                                        </header>

                                    </div>
                                </div>

                            <?php } ?>

                            <div class="content-main content-main-bg">

                                <?php while( $banner_query_1->have_posts() ):
                                    $banner_query_1->the_post(); ?>

                                    <div class="content-list content-list-border">
                                        <article id="theme-post-<?php the_ID(); ?>" <?php post_class( 'news-article' ); ?>>
                                            
                                            <div class="entry-meta">
                                                <?php tribunal_entry_footer( $cats = true, $tags = false, $edits = false, $text = false, $icon = false ); ?>
                                            </div>

                                            <h3 class="entry-title entry-title-xsmall">
                                                <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                                            </h3>

                                            <div class="entry-meta">
                                                <?php tribunal_posted_on(); ?>
                                                <?php tribunal_post_view_count(); ?>
                                            </div>

                                        </article>
                                    </div>

                                <?php endwhile;
                                wp_reset_postdata(); ?>

                            </div>
                        </div>
                    <?php endif;
                    
                    if( $banner_query_1->have_posts() ): ?>
                        <div class="column column-6 column-sm-12 column-order-2">

                            <?php if( $cat_title_2 ){ ?>

                                <div class="column-row">
                                    <div class="column column-12">
                                        
                                        <header class="block-title-wrapper">
                                            <h2 class="block-title block-title-large">
                                                <?php echo esc_html( $cat_title_2 ); ?>
                                            </h2>
                                        </header>
                                        
                                    </div>
                                </div>

                            <?php } ?>

                            <?php
                            if( $mid_post_1 ){
                                $mid_post_query_1 = new WP_Query( array('post_type' => 'post', 'posts_per_page' => 1,'post__not_in' => get_option("sticky_posts"), 'post__in' =>  $mid_post_1 ) );

                                while( $mid_post_query_1->have_posts() ){
                                    $mid_post_query_1->the_post();
                                    $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium_large'); ?>

                                    <article id="theme-post-<?php the_ID(); ?>" <?php post_class( 'news-article news-article-bg news-article-lead' ); ?>>
                                        <div class="column-row">

                                            <?php if( $featured_image[0] ){ ?>
                                                <div class="column column-6 column-order-2 column-sm-12">
                                                    <div class="img-hover-scale">

                                                        <?php
                                                        $format = get_post_format( get_the_ID() ) ? : 'standard';
                                                        $icon = tribunal_post_format_icon( $format );
                                                        if( !empty( $icon ) ){ ?>
                                                            <span class="top-right-icon"><i class="ion <?php echo esc_attr( $icon ); ?>"></i></span>
                                                        <?php } ?>

                                                        <a href="<?php the_permalink(); ?>" tabindex="0">
                                                            <img title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" src="<?php echo esc_url( $featured_image[0] ); ?>">
                                                        </a>

                                                    </div>
                                                </div>
                                            <?php } ?>

                                            <div class="column column-<?php if(  $featured_image[0] ){ ?>6<?php }else{ ?>12<?php } ?> column-order-1 column-sm-12">
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
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="column column-12 column-order-3">
                                                <div class="entry-content entry-content-muted entry-content-small">
                                                    <?php
                                                    if( has_excerpt() ){
                                                        the_excerpt();
                                                    }else{
                                                        echo esc_html( wp_trim_words( get_the_content(),40,'...' ) );
                                                    } ?>
                                                </div>
                                            </div>

                                        </div>
                                    </article>

                                <?php
                                }

                                wp_reset_postdata();
                            }

                            if( $mid_post_2 ){
                                $mid_post_query_2 = new WP_Query( array('post_type' => 'post', 'posts_per_page' => 3,'post__not_in' => get_option("sticky_posts"), 'post__in' =>  $mid_post_2 ) ); ?>

                                <div class="content-main-below">
                                    <div class="content-main">

                                        <?php while ($mid_post_query_2->have_posts()) {
                                            $mid_post_query_2->the_post();
                                            $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium'); ?>

                                            <div class="content-list">
                                                <article id="theme-post-<?php the_ID(); ?>" <?php post_class( 'news-article news-article-bg' ); ?>>
                                                    <div class="column-row">

                                                        <?php if( $featured_image[0] ){ ?>
                                                            <div class="column column-4">
                                                                <div class="post-thumbnail">
                                                                    <div class="img-hover-scale">
                                                                        <?php
                                                                        $format = get_post_format( get_the_ID() ) ? : 'standard';
                                                                        $icon = tribunal_post_format_icon( $format );
                                                                        if( !empty( $icon ) ){ ?>
                                                                            <span class="top-right-icon">
                                                                                <i class="ion <?php echo esc_attr( $icon ); ?>"></i>
                                                                            </span>
                                                                        <?php } ?>
                                                                        <a href="<?php the_permalink(); ?>" tabindex="0">
                                                                            <img title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" src="<?php echo esc_url( $featured_image[0] ); ?>">
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        
                                                        <?php } ?>

                                                        <div class="column column-<?php if(  $featured_image[0] ){ ?>8<?php }else{ ?>12<?php } ?>">
                                                            <div class="post-content">

                                                                <div class="entry-meta">
                                                                    <?php tribunal_entry_footer($cats = true, $tags = false, $edits = false, $text = false, $icon = false); ?>
                                                                </div>

                                                                <h3 class="entry-title entry-title-small">
                                                                    <a href="<?php the_permalink(); ?>" tabindex="0" rel="bookmark" title="<?php the_title_attribute(); ?>">
                                                                        <?php the_title(); ?>
                                                                    </a>
                                                                </h3>

                                                                <div class="entry-meta">
                                                                    <?php tribunal_posted_on(); ?>
                                                                    <?php tribunal_post_view_count(); ?>
                                                                    <?php tribunal_posted_by(); ?>
                                                                </div>

                                                            </div>
                                                        </div>

                                                        <div class="column column-12">
                                                            <div class="entry-content entry-content-muted entry-content-small">
                                                                <?php
                                                                if (has_excerpt()) {
                                                                    the_excerpt();
                                                                } else {
                                                                    echo esc_html(wp_trim_words(get_the_content(), 35, '...'));
                                                                } ?>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </article>
                                            </div>

                                        <?php } ?>

                                    </div>
                                </div>

                            <?php }
                            wp_reset_postdata(); ?>

                        </div>

                    <?php endif;

                    if( $banner_query_3->have_posts() ): ?>

                        <div class="column column-3 column-sm-6 column-xxs-12 column-order-3">

                            <?php if( $cat_title_3 ){ ?>

                                <div class="column-row">
                                    <div class="column column-12">
                                        
                                        <header class="block-title-wrapper">
                                            <h2 class="block-title block-title-large">
                                                <?php echo esc_html( $cat_title_3 ); ?>
                                            </h2>
                                        </header>
                                        
                                    </div>
                                </div>

                            <?php } ?>

                            <div class="content-main content-main-bg">

                                <?php while( $banner_query_3->have_posts() ):
                                    $banner_query_3->the_post(); ?>

                                    <div class="content-list content-list-border">
                                        <article id="theme-post-<?php the_ID(); ?>" <?php post_class( 'news-article' ); ?>>

                                            <div class="entry-meta">
                                                <?php tribunal_entry_footer( $cats = true, $tags = false, $edits = false, $text = false, $icon = false ); ?>
                                            </div>

                                            <h3 class="entry-title entry-title-xsmall">
                                                <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                                            </h3>

                                            <div class="entry-meta">
                                                <?php tribunal_posted_on(); ?>
                                                <?php tribunal_post_view_count(); ?>
                                            </div>

                                        </article>
                                    </div>

                                <?php endwhile; ?>

                            </div>
                        </div>

                    <?php wp_reset_postdata();
                    endif; ?>

                </div>
            </div>
        </div>
    <?php
    }
endif;