<?php
/**
 * Banner Blocks One
 *
 * @package Tribunal
 */
if (!function_exists('tribunal_banner_block_1_section')):
    
    function tribunal_banner_block_1_section($tribunal_home_section, $repeat_times)
    {
        $section_post_slide_cat = esc_html(isset($tribunal_home_section->section_post_slide_cat) ? $tribunal_home_section->section_post_slide_cat : '');
        
        $section_category_1 = esc_html(isset($tribunal_home_section->section_category_1) ? $tribunal_home_section->section_category_1 : '');
        $section_category_2 = esc_html(isset($tribunal_home_section->section_category_2) ? $tribunal_home_section->section_category_2 : '');
        $section_category_3 = esc_html(isset($tribunal_home_section->section_category_3) ? $tribunal_home_section->section_category_3 : '');
        $section_category_4 = esc_html(isset($tribunal_home_section->section_category_4) ? $tribunal_home_section->section_category_4 : '');
        $ed_ribbon_bg = esc_html(isset($tribunal_home_section->ed_ribbon_bg) ? $tribunal_home_section->ed_ribbon_bg : 'no');
        $ribbon_bg_size = esc_html( isset($tribunal_home_section->ribbon_bg_size ) ? $tribunal_home_section->ribbon_bg_size : 'medium');

        $ribbon_bg_color_schema = esc_html(isset($tribunal_home_section->ribbon_bg_color_schema) ? $tribunal_home_section->ribbon_bg_color_schema : '1');

        if( empty( $ed_ribbon_bg ) ){ $ed_ribbon_bg = 'no'; };
        if( empty( $ribbon_bg_size ) ){ $ribbon_bg_size = 'medium'; };
        if( empty( $ribbon_bg_color_schema ) ){ $ribbon_bg_color_schema = 1; };

        $ed_tab = esc_html(isset($tribunal_home_section->ed_tab) ? $tribunal_home_section->ed_tab : '');
        $ed_flip_column = esc_html(isset($tribunal_home_section->ed_flip_column) ? $tribunal_home_section->ed_flip_column : '');
        $home_section_title_1 = esc_html(isset($tribunal_home_section->home_section_title_1) ? $tribunal_home_section->home_section_title_1 : '');
        $home_section_title_2 = esc_html(isset($tribunal_home_section->home_section_title_2) ? $tribunal_home_section->home_section_title_2 : '');
        $banner_post_slide_query = new WP_Query(array('post_type' => 'post', 'posts_per_page' => 5, 'post__not_in' => get_option("sticky_posts"), 'category_name' => esc_html($section_post_slide_cat)));
        
        $slider_arrows = esc_html( isset($tribunal_home_section->ed_arrows_carousel) ? $tribunal_home_section->ed_arrows_carousel : '');
        $slider_dots = esc_html( isset($tribunal_home_section->ed_dots_carousel) ? $tribunal_home_section->ed_dots_carousel : '');
        $slider_autoplay = esc_html( isset($tribunal_home_section->ed_autoplay_carousel) ? $tribunal_home_section->ed_autoplay_carousel : '');

        if ( $slider_arrows == 'yes' || $slider_arrows == '' ) {
            $arrow = 'true';
        }else{
            $arrow = 'false';
        }
        if ( $slider_autoplay == 'yes' || $slider_autoplay == '' ) {
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
        
        if( $ed_tab == 'yes' && ( $section_category_1 || $section_category_2 || $section_category_3 || $section_category_4 ) ){
            $cat_array = array();
            if( $section_category_1 ){ $cat_array[] = $section_category_1; }
            if( $section_category_2 ){ $cat_array[] = $section_category_2; }
            if( $section_category_3 ){ $cat_array[] = $section_category_3; }
            if( $section_category_4 ){ $cat_array[] = $section_category_4; }
            $banner_query_all = new WP_Query(
                $args = array(
                    'post_type' => 'post',
                    'posts_per_page' => 6,
                    'post__not_in' => get_option("sticky_posts"),
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'category',
                            'field'    => 'slug',
                            'terms'    => $cat_array,
                        ),
                    ),
                )
            );
        }else{
            $banner_query_all = new WP_Query(
                $args = array(
                    'post_type' => 'post',
                    'posts_per_page' => 6,
                    'post__not_in' => get_option("sticky_posts"),
                    'category_name' => esc_html( $section_category_1 )
                )
            );
            
        }
        ?>
        <div repeat-time="<?php echo esc_attr( 'repeat-time-'.$repeat_times ); ?>" id="block-<?php echo esc_attr( $repeat_times ); ?>" class="theme-block theme-block-elements <?php if( $ed_ribbon_bg == 'yes' ){ ?>theme-block-bg theme-block-bg-<?php echo esc_attr( $ribbon_bg_color_schema ); ?> theme-block-bg-<?php echo esc_attr( $ribbon_bg_size ); } ?> theme-block-elements-1 <?php echo esc_attr( 'repeat-time-'.$repeat_times ); if( empty( $home_section_title_1 ) ){ echo ' no-title-slide'; } if( empty( $home_section_title_2 ) ){ echo ' no-title-tab'; } ?>">
            <div class="wrapper">
                <div class="column-row">
                    <?php if( $banner_post_slide_query->have_posts() ): ?>
                        <div class="column column-5 column-sm-12 column-xs-12 <?php if ($ed_flip_column != 'yes') { ?>column-order-1<?php } else { ?>column-order-2<?php } ?>">

                            <?php if( $home_section_title_1 ){ ?>
                                <header class="block-title-wrapper">
                                    <h2 class="block-title block-title-large">
                                        <?php echo esc_html( $home_section_title_1 ); ?>
                                    </h2>
                                </header>
                            <?php } ?>

                            <div class="theme-slider-block" data-slick='{"arrows": <?php echo esc_attr( $arrow ); ?>,"autoplay": <?php echo esc_attr( $autoplay ); ?>, "dots": <?php echo esc_attr( $dots ); ?>, "rtl": <?php echo esc_attr( $rtl ); ?>}'>
                                <?php
                                while ($banner_post_slide_query->have_posts()) {
                                    $banner_post_slide_query->the_post();
                                    $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large'); ?>
                                    <div class="theme-slider-item">
                                        <article id="theme-post-<?php the_ID(); ?>" <?php post_class('news-article news-article-bg post-thumb'); ?>>
                                            <div class="data-bg data-bg-alt-large thumb-overlay thumb-overlay-darker img-hover-slide" data-background="<?php echo esc_url($featured_image[0]); ?>">
                                                <a class="img-link" href="<?php the_permalink(); ?>" tabindex="0"></a>
                                                <div class="article-content article-content-overlay">
                                                    <div class="entry-meta">
                                                        <?php tribunal_entry_footer($cats = true, $tags = false, $edits = false, $text = false, $icon = false); ?>
                                                    </div>
                                                    <h2 class="entry-title entry-title-big">
                                                        <a href="<?php the_permalink(); ?>" tabindex="0" rel="bookmark" title="<?php the_title_attribute(); ?>">
                                                            <?php the_title(); ?>
                                                        </a>
                                                    </h2>
                                                    <div class="entry-meta">
                                                        <?php tribunal_posted_on(); ?>
                                                        <?php tribunal_post_view_count(); ?>
                                                        <?php tribunal_posted_by(); ?>
                                                    </div>
                                                    <div class="entry-content hidden-xs-element text-white entry-content-small">
                                                        <?php
                                                        if (has_excerpt()) {
                                                            the_excerpt();
                                                        } else {
                                                            echo esc_html(wp_trim_words(get_the_content(), 25, '...'));
                                                        } ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </article>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <?php
                        wp_reset_postdata();
                    endif; ?>
                    <div class="column column-7 column-sm-12 column-xs-12 <?php if ($ed_flip_column != 'yes') { ?>column-order-2<?php } else { ?>column-order-1<?php } ?>">

                        <?php if( $home_section_title_2 || ( $ed_tab == 'yes' && ( $section_category_1 || $section_category_2 || $section_category_3 || $section_category_4 ) ) ){ ?>

                            <header class="block-title-wrapper">
                                
                                <?php if( $home_section_title_2 ){ ?>
                                    <h2 class="block-title block-title-large">
                                        <?php echo esc_html( $home_section_title_2 ); ?>
                                    </h2>
                                <?php }

                                if( $ed_tab == 'yes' && ( $section_category_1 || $section_category_2 || $section_category_3 || $section_category_4 ) ){ ?>

                                    <div class="tab-posts hide-no-js">
                                        
                                        <a cat-data="all" class="active-tab" href="javascript:void(0)"><?php esc_html_e('All','tribunal'); ?></a>
                                        
                                        <?php
                                        if( $section_category_1 && $ed_tab == 'yes' ){
                                            $catObj = get_category_by_slug( $section_category_1 );
                                            if( isset(  $catObj->name ) &&  $catObj->name ){ ?>
                                                <a cat-data="<?php echo esc_attr( $section_category_1 ); ?>" href="javascript:void(0)"><?php echo esc_html(  $catObj->name ); ?></a>
                                            <?php }
                                        } ?>
                                        <?php
                                        if( $section_category_2 && $ed_tab == 'yes' ){
                                            $catObj = get_category_by_slug( $section_category_2 );
                                            if( isset(  $catObj->name ) &&  $catObj->name ){ ?>
                                                <a cat-data="<?php echo esc_attr( $section_category_2 ); ?>" href="javascript:void(0)"><?php echo esc_html(  $catObj->name ); ?></a>
                                            <?php }
                                        } ?>
                                        <?php
                                        if( $section_category_3 && $ed_tab == 'yes' ){
                                            $catObj = get_category_by_slug( $section_category_3 );
                                            if( isset(  $catObj->name ) &&  $catObj->name ){ ?>
                                                <a cat-data="<?php echo esc_attr( $section_category_3 ); ?>" href="javascript:void(0)"><?php echo esc_html(  $catObj->name ); ?></a>
                                            <?php }
                                        } ?>
                                        <?php
                                        if( $section_category_4 && $ed_tab == 'yes' ){
                                            $catObj = get_category_by_slug( $section_category_4 );
                                            if( isset(  $catObj->name ) &&  $catObj->name ){ ?>
                                                <a cat-data="<?php echo esc_attr( $section_category_4 ); ?>" href="javascript:void(0)"><?php echo esc_html(  $catObj->name ); ?></a>
                                            <?php }
                                        } ?>
                                    </div>

                                <?php } ?>

                            </header>

                        <?php }

                        if( $banner_query_all->have_posts() ): ?>
                            <div class="tab-contents tab-content-all content-loaded content-active">
                                <div class="column-row">
                                    <div class="column column-5 column-xs-12">
                                        <?php
                                        while ($banner_query_all->have_posts()) {
                                        $banner_query_all->the_post();
                                            $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium_large'); ?>
                                            <article id="theme-post-<?php the_ID(); ?>" <?php post_class( 'news-article news-article-bg' ); ?>>
                                                
                                                <?php if ($featured_image[0]) { ?>
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
                                                <?php } ?>
                                                
                                                <div class="article-content">
                                                    <div class="entry-meta">
                                                        <?php tribunal_entry_footer($cats = true, $tags = false, $edits = false, $text = false, $icon = false); ?>
                                                    </div>
                                                    <h3 class="entry-title entry-title-medium">
                                                        <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
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
                                            <?php
                                            break;
                                        } ?>
                                    </div>
                                    <div class="column column-7 column-xs-12">
                                        <div class="content-main">
                                            <?php
                                            while ($banner_query_all->have_posts()) {
                                                $banner_query_all->the_post();
                                                    $featured_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'medium' ); ?>
                                                    <div class="content-list">
                                                        <article id="theme-post-<?php the_ID(); ?>" <?php post_class( 'news-article news-article-bg' ); ?>>
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
                                                                    <div class="post-content">
                                                                        <h3 class="entry-title entry-title-small">
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
                                            } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                            wp_reset_postdata();
                        endif; ?>
                        <?php if( $ed_tab == 'yes' && $section_category_1 ){ ?>
                            <div data-cat="<?php echo esc_attr( $section_category_1 ); ?>" class="tab-contents tab-content-<?php echo esc_attr( $section_category_1 ); ?>">
                                <?php tribunal_content_loading(); ?>
                            </div>
                        <?php } ?>
                        <?php if( $ed_tab == 'yes' && $section_category_2 ){ ?>
                            <div data-cat="<?php echo esc_attr( $section_category_2 ); ?>" class="tab-contents tab-content-<?php echo esc_attr( $section_category_2 ); ?>">
                                <?php tribunal_content_loading(); ?>
                            </div>
                        <?php } ?>
                        <?php if( $ed_tab == 'yes' && $section_category_3 ){ ?>
                            <div data-cat="<?php echo esc_attr( $section_category_3 ); ?>" class="tab-contents tab-content-<?php echo esc_attr( $section_category_3 ); ?>">
                                <?php tribunal_content_loading(); ?>
                            </div>
                        <?php } ?>
                        <?php if( $ed_tab == 'yes' && $section_category_4 ){ ?>
                            <div data-cat="<?php echo esc_attr( $section_category_4 ); ?>" class="tab-contents tab-content-<?php echo esc_attr( $section_category_4 ); ?>">
                                <?php tribunal_content_loading(); ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
endif;
