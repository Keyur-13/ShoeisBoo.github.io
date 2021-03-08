<?php
/**
 * Template Name: Template Cover Full Width
 * Template Post Type: post, page
 **/
get_header();

    $tribunal_default = tribunal_get_default_theme_options();
    $sidebar = esc_attr(get_theme_mod('template_cover_full_width_sidebar_layout', $tribunal_default['template_cover_full_width_sidebar_layout']));
    $tribunal_post_sidebar = esc_attr(get_post_meta($post->ID, 'tribunal_post_sidebar_option', true));
    if ($tribunal_post_sidebar == 'global-sidebar' || empty($tribunal_post_sidebar)) {
        $sidebar = $sidebar;
    } else {
        $sidebar = $tribunal_post_sidebar;
    } ?>
    
    <div class="singular-main-block singular-template-block">
        <div class="wrapper">
            <div class="column-row">

                <div id="primary" class="content-area">
                    <main id="main" class="site-main" role="main">

                        <?php
                        if( have_posts() ): ?>

                            <div class="article-wraper">

                                <?php while( have_posts() ):
                                    the_post(); ?>

                                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>> 

                                        <div class="entry-content">

                                            <?php
                                            the_content( sprintf(
                                                /* translators: %s: Name of current post. */
                                                wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'tribunal' ), array( 'span' => array( 'class' => array() ) ) ),
                                                the_title( '<span class="screen-reader-text">"', '"</span>', false )
                                            ) ); ?>

                                        </div>

                                    </article>
                                
                                <?php endwhile; ?>

                            </div>
                        
                        <?php
                        else :

                            get_template_part('template-parts/content', 'none');
                            
                        endif; ?>
                    
                    </main><!-- #main -->
                </div>

                <?php if ($sidebar != 'no-sidebar') {
                    get_sidebar();
                } ?>

            </div>
        </div>
    </div>

<?php
get_footer();