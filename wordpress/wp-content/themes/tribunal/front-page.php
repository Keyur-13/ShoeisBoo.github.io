<?php
/**
 *
 * Front Page
 *
 * @package Tribunal
 */

get_header();

	if( is_page_template( 'templates/template-cover-full-width.php' ) || is_page_template( 'templates/template-cover.php' ) || is_page_template( 'templates/template-slider.php' ) || is_page_template( 'templates/template-carousel.php' ) ) {

		$tribunal_default = tribunal_get_default_theme_options();

		if( is_page_template( 'templates/template-cover-full-width.php' ) ){

	    	$sidebar = esc_attr( get_theme_mod( 'template_cover_full_width_sidebar_layout', $tribunal_default['template_cover_full_width_sidebar_layout'] ) );
		}elseif( is_page_template( 'templates/template-cover.php' ) ){

			$sidebar = esc_attr( get_theme_mod( 'template_cover_sidebar_layout', $tribunal_default['template_cover_sidebar_layout'] ) );

		}elseif( is_page_template( 'templates/template-carousel.php' ) ){
			
			$sidebar = esc_attr( get_theme_mod( 'template_carousel_sidebar_settings', $tribunal_default['template_carousel_sidebar_settings'] ) );

		}elseif( is_page_template( 'templates/template-slider.php' ) ){

			$sidebar = esc_attr( get_theme_mod( 'template_slider_sidebar_settings', $tribunal_default['template_slider_sidebar_settings'] ) );

		}

	    $tribunal_post_sidebar = esc_attr( get_post_meta( $post->ID, 'tribunal_post_sidebar_option', true ) );
	    if( $tribunal_post_sidebar == 'global-sidebar' || empty($tribunal_post_sidebar ) ){
	        $sidebar = $sidebar;
	    } else {
	        $sidebar = $tribunal_post_sidebar;
	    }
    
        ?>
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
    }else{

		$tribunal_default = tribunal_get_default_theme_options();
		$twp_tribunal_home_sections_1 = get_theme_mod( 'twp_tribunal_home_sections_1', json_encode( $tribunal_default['twp_tribunal_home_sections_1'] ) );
		$paged_active = false;

		if ( !is_paged() ) {
		    $paged_active = true;
		}

		$twp_tribunal_home_sections_1 = json_decode( $twp_tribunal_home_sections_1 );
		$repeat_times = 1;

		foreach ( $twp_tribunal_home_sections_1 as $tribunal_home_section ) {

		    $home_section_type = isset( $tribunal_home_section->home_section_type ) ? $tribunal_home_section->home_section_type : '';

		    switch ($home_section_type) {

		    	case 'slider-blocks':

		            $ed_slider_blocks = isset( $tribunal_home_section->section_ed ) ? $tribunal_home_section->section_ed : '';
		            if ( $ed_slider_blocks == 'yes' && $paged_active ) {
		                tribunal_slider_blocks( $tribunal_home_section, $repeat_times );
		            }

		        break;

		        case 'latest-posts-blocks':

		            $ed_latest_posts_blocks = isset( $tribunal_home_section->section_ed ) ? $tribunal_home_section->section_ed : '';
		            if ( $ed_latest_posts_blocks == 'yes' ) {
		                tribunal_latest_blocks( $tribunal_home_section, $repeat_times );
		            }

		        break;

		    	case 'carousel-blocks':

		            $ed_carousel_blocks = isset( $tribunal_home_section->section_ed ) ? $tribunal_home_section->section_ed : '';
		            if ( $ed_carousel_blocks == 'yes' && $paged_active ) {
		                tribunal_carousel_posts( $tribunal_home_section, $repeat_times );
		            }

		        break;

		    	case 'tiles-blocks':

		            $ed_tiles_block = isset( $tribunal_home_section->section_ed ) ? $tribunal_home_section->section_ed : '';
		            if ( $ed_tiles_block == 'yes' && $paged_active ) {
		                tribunal_tiles_block_section( $tribunal_home_section, $repeat_times );
		            }

		        break;

		        case 'lead-blocks':

		            $ed_lead_block = isset( $tribunal_home_section->section_ed ) ? $tribunal_home_section->section_ed : '';
		            if ( $ed_lead_block == 'yes' && $paged_active ) {
		                tribunal_lead_block_section( $tribunal_home_section, $repeat_times );
		            }

		        break;

		        case 'masonry-blocks':

		            $ed_masnoty_block = isset( $tribunal_home_section->section_ed ) ? $tribunal_home_section->section_ed : '';
		            if ( $ed_masnoty_block == 'yes' && $paged_active ) {
		                tribunal_masonry_block_section( $tribunal_home_section, $repeat_times );
		            }

		        break;

		        case 'banner-blocks-1':

		            $ed_banner_blocks_1 = isset( $tribunal_home_section->section_ed ) ? $tribunal_home_section->section_ed : '';
		            if ( $ed_banner_blocks_1 == 'yes' && $paged_active ) {
		                tribunal_banner_block_1_section( $tribunal_home_section, $repeat_times );
		            }

		        break;

		        case 'banner-blocks-2':

		            $ed_banner_blocks_2 = isset( $tribunal_home_section->section_ed ) ? $tribunal_home_section->section_ed : '';
		            if ( $ed_banner_blocks_2 == 'yes' && $paged_active ) {
		                tribunal_banner_block_2_section( $tribunal_home_section, $repeat_times );
		            }

		        break;

		        case 'banner-blocks-3':

		            $ed_banner_blocks_3 = isset( $tribunal_home_section->section_ed ) ? $tribunal_home_section->section_ed : '';
		            if ( $ed_banner_blocks_3 == 'yes' && $paged_active ) {
		                tribunal_banner_block_3_section( $tribunal_home_section, $repeat_times );
		            }

		        break;

		        case 'banner-blocks-4':

		            $ed_banner_blocks_4 = isset( $tribunal_home_section->section_ed ) ? $tribunal_home_section->section_ed : '';
		            if ( $ed_banner_blocks_4 == 'yes' && $paged_active ) {
		                tribunal_banner_block_4_section( $tribunal_home_section, $repeat_times );
		            }

		        break;

		        case 'post-list-block':

		            $ed_post_list_block = isset( $tribunal_home_section->section_ed ) ? $tribunal_home_section->section_ed : '';
		            if ( $ed_post_list_block == 'yes' && $paged_active ) {
		                tribunal_post_list_block_section( $tribunal_home_section, $repeat_times );
		            }

		        break;

		        case 'advertise-blocks':

		            $ed_advertise_blocks = isset( $tribunal_home_section->section_ed ) ? $tribunal_home_section->section_ed : '';
		            if ( $ed_advertise_blocks == 'yes' && $paged_active ) {
		                tribunal_advertise_block( $tribunal_home_section, $repeat_times );
		            }
		            
		        break;

		        default:

		        break;

		    }

		    $repeat_times++;
		}

	}

get_footer();
