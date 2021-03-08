<?php
/**
 * Banner Blocks Two
 *
 * @package Tribunal
 */

if (!function_exists('tribunal_banner_block_2_section')):

    function tribunal_banner_block_2_section($tribunal_home_section, $repeat_times){

		$section_category_1 = esc_html( isset($tribunal_home_section->section_category_1) ? $tribunal_home_section->section_category_1 : '');
		$section_category_2 = esc_html( isset($tribunal_home_section->section_category_2) ? $tribunal_home_section->section_category_2 : '');
		$section_category_3 = esc_html( isset($tribunal_home_section->section_category_3) ? $tribunal_home_section->section_category_3 : '');
		
        $cat_title_1 = esc_html( isset($tribunal_home_section->cat_title_1) ? $tribunal_home_section->cat_title_1 : '');
        $cat_title_2 = esc_html( isset($tribunal_home_section->cat_title_2) ? $tribunal_home_section->cat_title_2 : '');
        $cat_title_3 = esc_html( isset($tribunal_home_section->cat_title_3) ? $tribunal_home_section->cat_title_3 : '');

		$ed_ribbon_bg = esc_html(isset($tribunal_home_section->ed_ribbon_bg) ? $tribunal_home_section->ed_ribbon_bg : '');
        $ribbon_bg_size = esc_html( isset($tribunal_home_section->ribbon_bg_size ) ? $tribunal_home_section->ribbon_bg_size : 'medium');
        $ribbon_bg_color_schema = esc_html(isset($tribunal_home_section->ribbon_bg_color_schema) ? $tribunal_home_section->ribbon_bg_color_schema : '2');

        if( empty( $ed_ribbon_bg ) ){ $ed_ribbon_bg = 'no'; };
        if( empty( $ribbon_bg_size ) ){ $ribbon_bg_size = 'medium'; };
        if( empty( $ribbon_bg_color_schema ) ){ $ribbon_bg_color_schema = 1; };
        
		$cat_3_info = '';
		if( $section_category_3 ){
			$cat_3_info = get_category_by_slug( $section_category_3 );
            $cat_3_link = get_category_link( $cat_3_info->term_id );
		}

		$banner_query_1 = new WP_Query( array('post_type' => 'post', 'posts_per_page' => 9,'post__not_in' => get_option("sticky_posts"), 'category_name' => esc_html( $section_category_1 ) ) );
		$banner_query_2 = new WP_Query( array('post_type' => 'post', 'posts_per_page' => 6,'post__not_in' => get_option("sticky_posts"), 'category_name' => esc_html( $section_category_2 ) ) );
		$banner_query_3 = new WP_Query( array('post_type' => 'post', 'posts_per_page' => 6,'post__not_in' => get_option("sticky_posts"), 'category_name' => esc_html( $section_category_3 ) ) );

		$mid_post_1 = array();
		$mid_post_2 = array();
		if( $banner_query_2->have_posts() ):
			
			$count = 1;
			while( $banner_query_2->have_posts() ):
				$banner_query_2->the_post();

				if( $count == 1 || $count == 2 ){
					$mid_post_1[] = get_the_ID();
				}else{
					$mid_post_2[] = get_the_ID();
				}

				$count++;
			endwhile;
            wp_reset_postdata();
		endif;
		?>

        <div class="theme-block theme-block-elements <?php if( $ed_ribbon_bg == 'yes' ){ ?>theme-block-bg theme-block-bg-<?php echo esc_attr( $ribbon_bg_color_schema ); ?> theme-block-bg-<?php echo esc_attr( $ribbon_bg_size ); } ?> theme-block-elements-2">
		    <div class="wrapper">
		        <div class="column-row">

		        	<?php if( $banner_query_1->have_posts() ): ?>

			            <div class="column column-3 column-sm-6 column-xs-12 column-order-1">

                            <?php if( $cat_title_1 ){ ?>
                                <header class="block-title-wrapper">
                                    <h2 class="block-title block-title-large">
                                        <?php echo esc_html( $cat_title_1 ); ?>
                                    </h2>
                                </header>
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

				                <?php endwhile; ?>

			                </div>
			            </div>

			        <?php wp_reset_postdata();
                    endif;

                    if( $banner_query_2->have_posts() ): ?>

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

                            <div class="column-row">
                                <div class="column column-6 column-xs-12">
                                    <div class="content-main">

                                        <?php
                                        if ($mid_post_1) {

                                            $mid_post_query_1 = new WP_Query(array('post_type' => 'post', 'posts_per_page' => 2, 'post__not_in' => get_option("sticky_posts"), 'post__in' => $mid_post_1)); ?>

                                            <?php while ($mid_post_query_1->have_posts()) {
                                                $mid_post_query_1->the_post();
                                                $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium_large'); ?>
                                                <div class="content-list">
                                                    <article id="theme-post-<?php the_ID(); ?>" <?php post_class('news-article news-article-bg news-article-lead'); ?>>

                                                        <?php if ($featured_image[0]) { ?>

                                                            <div class="img-hover-scale mb-15">

                                                                <?php
                                                                $format = get_post_format(get_the_ID()) ?: 'standard';
                                                                $icon = tribunal_post_format_icon($format);
                                                                if (!empty($icon)) { ?>
                                                                    <span class="top-right-icon">
                                                                        <i class="ion <?php echo esc_attr($icon); ?>"></i>
                                                                    </span>
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
                                                                <a href="<?php the_permalink(); ?>" tabindex="0" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
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

                                        <?php } ?>

                                    </div>
                                </div>

                                <?php
                                if( $mid_post_2 ){

                                    $mid_post_query_2 = new WP_Query( array('post_type' => 'post', 'posts_per_page' => 4,'post__not_in' => get_option("sticky_posts"), 'post__in' =>  $mid_post_2 ) ); ?>

                                    <div class="column column-6 column-xs-12">
                                        <div class="content-main">
                                            <?php while ($mid_post_query_2->have_posts()) {
                                                $mid_post_query_2->the_post(); ?>
                                                <div class="content-list">
                                                    <article id="theme-post-<?php the_ID(); ?>" <?php post_class( 'news-article news-article-bg' ); ?>>
                                                        <div class="entry-meta">
                                                            <?php tribunal_entry_footer($cats = true, $tags = false, $edits = false, $text = false, $icon = false); ?>
                                                        </div>

                                                        <h3 class="entry-title entry-title-small">
                                                            <a href="<?php the_permalink(); ?>" tabindex="0" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
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

                                                                echo esc_html(wp_trim_words(get_the_content(), 20, '...'));

                                                            } ?>
                                                        </div>

                                                    </article>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <?php
                                } ?>

                            </div>
                        </div>

                        <?php 
                        wp_reset_postdata();
                    endif; ?>

		            <?php if( $banner_query_3->have_posts() ): ?>

			            <div class="column column-3 column-sm-6 column-xs-12 column-order-3">
                            
                            <?php if( $cat_title_3 ){ ?>
                                <header class="block-title-wrapper">
                                    <h2 class="block-title block-title-large">
                                        <?php echo esc_html( $cat_title_3 ); ?>
                                    </h2>
                                </header>
                            <?php } ?>

			                <div class="content-main content-main-bg">

			                	<?php while( $banner_query_3->have_posts() ):

			                		$banner_query_3->the_post();
			                		$featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'thumbnail'); ?>

				                    <div class="content-list content-list-border">
                                        <article id="theme-post-<?php the_ID(); ?>" <?php post_class( 'news-article' ); ?>>

                                            <div class="entry-meta">
                                                <?php
                                                if( isset( $cat_3_info->name ) ){ ?>
                                                    <span class="cat-links cat-links-current">
                                                        <a href="<?php echo esc_url( $cat_3_link ); ?>"><?php echo esc_html( $cat_3_info->name ); ?></a>
                                                    </span>
                                                <?php } ?>
                                            </div>

                                            <h3 class="entry-title entry-title-xsmall">
                                                <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                                            </h3>

				                            <div class="content-image">
                                                <div class="content-image-item content-image-left">
                                                    <div class="entry-meta">
                                                        <?php tribunal_posted_by(); ?>
                                                    </div>
                                                </div>
					                            <?php if( $featured_image[0] ){ ?>
                                                    <div class="content-image-item content-image-right">
                                                        <div class="img-hover-scale img-border img-border-small">
                                                            <a href="<?php the_permalink(); ?>" tabindex="0">
                                                                <img title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" src="<?php echo esc_url($featured_image[0]); ?>">
                                                            </a>
                                                        </div>
                                                    </div>
							                    <?php } ?>
					                        </div>

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