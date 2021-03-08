<?php
/**
 * Tiles Blocks
 *
 * @package Tribunal
 */
if (!function_exists('tribunal_tiles_block_section')):
    function tribunal_tiles_block_section($tribunal_home_section, $repeat_times){

        $section_category = esc_html( isset($tribunal_home_section->section_category) ? $tribunal_home_section->section_category : '');
        $tiles_post_per_page = esc_html( isset($tribunal_home_section->tiles_post_per_page) ? $tribunal_home_section->tiles_post_per_page : 5);
        $tiles_post_query = new WP_Query( array('post_type' => 'post', 'posts_per_page' => $tiles_post_per_page,'post__not_in' => get_option("sticky_posts"), 'category_name' => esc_html( $section_category ) ) );
        if( $tiles_post_query ->have_posts() ):

            $post_ids = array();
            while( $tiles_post_query ->have_posts() ){
                $tiles_post_query ->the_post();

                $post_ids[] = get_the_ID();

            }

            $posts_id = array();
            if( $post_ids && count( $post_ids ) > 5 ){

                $posts_id = array_chunk($post_ids,5);

            }else{

                $posts_id[] = $post_ids;

            } ?>

            <div class="theme-block theme-block-tiles">
                <div class="wrapper">
                    <div class="column-row column-row-small">


                        <?php
                        foreach( $posts_id as $post_id ){

                            $post_ids_1 = array();
                            $post_ids_2 = array();
                            if( isset( $post_id[ 0 ] ) && $post_id[ 0 ] ){

                                $post_ids_1[] = $post_id[ 0 ];

                            }
                            if( isset( $post_id[ 1 ] ) && $post_id[ 1 ] ){

                                $post_ids_2[] = $post_id[ 1 ];

                            }

                            if( isset( $post_id[ 2 ] ) && $post_id[ 2 ] ){

                                $post_ids_2[] = $post_id[ 2 ];

                            }

                            if( isset( $post_id[ 3 ] ) && $post_id[ 3 ] ){

                                $post_ids_2[] = $post_id[ 3 ];

                            }

                            if( isset( $post_id[ 4 ] ) && $post_id[ 4 ] ){

                                $post_ids_2[] = $post_id[ 4 ];

                            }

                            if( $post_ids_1 ){

                                $tiles_query_1 = new WP_Query( array('post_type' => 'post', 'posts_per_page' => 1,'post__not_in' => get_option("sticky_posts"), 'post__in' =>  $post_ids_1 ) );

                                if( $tiles_query_1 ->have_posts() ){

                                    while( $tiles_query_1 ->have_posts() ){
                                        $tiles_query_1 ->the_post();
                                        $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
                                        ?>
                                        <div class="column column-6 column-sm-12">

                                            <article id="theme-post-<?php the_ID(); ?>" <?php post_class( 'news-article post-thumb post-thumb-tiles post-thumb-tiles-left' ); ?>>
                                                <div class="data-bg data-bg-large thumb-overlay img-hover-slide" data-background="<?php echo esc_url( $featured_image[0] ); ?>">

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
                                                        <h3 class="entry-title entry-title-large">
                                                            <a href="<?php the_permalink(); ?>" tabindex="0" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                                                        </h3>
                                                        <div class="entry-meta">
                                                            <?php tribunal_posted_on(); ?>
                                                            <?php tribunal_posted_by(); ?>
                                                            <?php tribunal_post_view_count(); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </article>

                                        </div>

                                    <?php
                                    }
                                }
                            }

                            if( $post_ids_2 ){

                                $tiles_query_2 = new WP_Query( array('post_type' => 'post', 'posts_per_page' => 4,'post__not_in' => get_option("sticky_posts"), 'post__in' =>  $post_ids_2 ) );

                                if( $tiles_query_2 ->have_posts() ){ ?>

                                    <div class="column column-6 column-sm-12">

                                        <div class="column-row column-row-small">

                                            <?php
                                            while( $tiles_query_2 ->have_posts() ){
                                                $tiles_query_2 ->the_post();
                                                $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium_large');
                                                ?>
                                                <div class="column column-6 column-xxs-12">

                                                    <article id="theme-post-<?php the_ID(); ?>" <?php post_class( 'news-article post-thumb post-thumb-tiles post-thumb-tiles-right' ); ?>>
                                                        <div class="data-bg data-bg-medium thumb-overlay img-hover-slide" data-background="<?php echo esc_url( $featured_image[0] ); ?>">

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
                                                                <h3 class="entry-title entry-title-small">
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

                                <?php
                                }
                            }

                        } ?>

                    </div>
                </div>
            </div>

        <?php
        wp_reset_postdata();
        endif;

    }
endif;