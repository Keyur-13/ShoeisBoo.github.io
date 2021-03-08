<?php

/*-----------------------------------------------------------------------------------*/
/* Enqueu scripts */
/*-----------------------------------------------------------------------------------*/   

if (!function_exists('attimo_enqueue_scripts')) {

	function attimo_enqueue_scripts() {

		wp_deregister_style( 'avventura-lite-style' );
		wp_deregister_style( 'avventura-lite-' . esc_attr(get_theme_mod('avventura_lite_skin', 'orange')) );

		wp_deregister_style('slick');
		wp_deregister_script('slick');

		wp_enqueue_style( 'avventura-lite-parent-style' , get_template_directory_uri() . '/style.css' ); 

		wp_enqueue_style(
			'attimo-' . esc_attr(get_theme_mod('avventura_lite_skin', 'orange')),
			get_stylesheet_directory_uri() . '/assets/skins/' . esc_attr(get_theme_mod('avventura_lite_skin', 'orange')) . '.css',
			array( 'attimo-style' ),
			'1.0.0'
		); 

		wp_enqueue_style( 'attimo-style' , get_stylesheet_directory_uri() . '/style.css' ); 

		$googleFontsArgs = array(
			'family' =>	str_replace('|', '%7C','Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i'),
			'subset' =>	'latin,latin-ext'
		);
		
		wp_deregister_style('google-fonts');
		wp_enqueue_style('google-fonts', add_query_arg ( $googleFontsArgs, "https://fonts.googleapis.com/css" ), array(), '1.0.0' );

	}
	
	add_action( 'wp_enqueue_scripts', 'attimo_enqueue_scripts', 999);

}

/*-----------------------------------------------------------------------------------*/
/* Replace hooks */
/*-----------------------------------------------------------------------------------*/ 

if (!function_exists('attimo_replace_hooks')) {

	function attimo_replace_hooks() {
		remove_action('avventura_lite_slick_slider', 'avventura_lite_slick_slider_function');
		remove_action('avventura_lite_top_sidebar', 'avventura_lite_top_sidebar_function');
		remove_action('avventura_lite_thumbnail', 'avventura_lite_thumbnail_function');
		remove_action('avventura_lite_before_content', 'avventura_lite_before_content_function' );
	}
	
	add_action('init','attimo_replace_hooks');

}

/*-----------------------------------------------------------------------------------*/
/* Exclude sticky posts on home */
/*-----------------------------------------------------------------------------------*/ 

if (!function_exists('attimo_exclude_sticky_posts_on_home')) {

	function attimo_exclude_sticky_posts_on_home($query) {
		if ( 
			$query->is_home() && 
			$query->is_main_query() && 
			(!avventura_lite_setting('attimo_sticky_posts') || strstr(avventura_lite_setting('attimo_sticky_posts'), 'layout' ))) {
			$query->set('post__not_in', get_option( 'sticky_posts' ));
		}
	}
	
	add_action('pre_get_posts', 'attimo_exclude_sticky_posts_on_home');

}

/*-----------------------------------------------------------------------------------*/
/* Sticky post grid */
/*-----------------------------------------------------------------------------------*/ 

if (!function_exists('attimo_sticky_posts_function')) {

	function attimo_sticky_posts_function() {

		$isHome = ( !avventura_lite_setting('attimo_sticky_posts') || strstr(avventura_lite_setting('attimo_sticky_posts'), 'layout' )) ? TRUE : FALSE;
		$isSlideshow = ( $isHome == TRUE && ( is_home() || is_front_page()) ) ? TRUE : FALSE;
		
		if ( $isSlideshow ): 

	?>
		
        <section class="sticky-posts-main-wrapper">
        
    	<div id="sticky-posts-container" class="container">
        	
        	<div class="row">
            	
            	<div class="col-md-12">
    				
    				<div class="sticky-posts-wrapper <?php echo esc_attr(avventura_lite_setting('attimo_sticky_posts','layout-1'));?>">
        
        			<?php

						$args = array(
			                'post_type' => 'post',
			                'posts_per_page' => 4,
			                'post__in'  => get_option( 'sticky_posts' ),
			                'ignore_sticky_posts' => 1,
						    'meta_query' => 
						    array(
						    	array(
						    		'key' => '_thumbnail_id',
						    		'compare' => 'EXISTS'
						    	)
						    )
            			);

						$query = new WP_Query($args); 
            
						if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); 
        
							global $post;
	        				$thumb = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large');

        			?>

				            <div class="sticky-post sticky-post-<?php echo $query->current_post?>" style="background-image: url(<?php echo esc_url($thumb[0]); ?>);" >
				            
					            <a title="<?php echo esc_attr(get_the_title());?>" class="sticky-post-permalink" href="<?php echo esc_url(get_permalink($post->ID)); ?>" ></a>
	                
	                			<h2 class="title"><?php echo esc_html(get_the_title()); ?></h2>
				                
				                <?php 
									
									$categories = get_the_category();
									
									if ( !empty( $categories ) ) {
									    
									    echo '<div class="sticky-post-categories">';

										foreach ( $categories as $category ) {
									    	echo '<div class="sticky-post-category">' . esc_html($category->name) . '</div>';
										}
									    
									    echo '</div>';

									}

				                ?>
            
				            </div>
            
						<?php

							endwhile; 
							endif;
							wp_reset_postdata();

						?>


    				<div class="clear"></div>

    				</div>        

    			</div>        

    		</div>    

    	</div>        
				
    	</section>
        
	<?php 
	
		endif;
		
	}

	add_action( 'attimo_sticky_posts', 'attimo_sticky_posts_function' );

}

/*-----------------------------------------------------------------------------------*/
/* Top sidebar */
/*-----------------------------------------------------------------------------------*/ 

if (!function_exists('attimo_top_sidebar_function')) {

	function attimo_top_sidebar_function() {

		$isWidget = is_active_sidebar('avventura-lite-top-widget-area') ? TRUE : FALSE;

		if ( $isWidget ) : 
	
	?>
			
			<div id="top_sidebar" class="sidebar-area">
			
				<?php 
							
					if ( $isWidget == TRUE )
						dynamic_sidebar('avventura-lite-top-widget-area');
                    	
				?>
                			
			</div>
				
	<?php 
	
		endif;
		
	}

	add_action( 'avventura_lite_top_sidebar', 'attimo_top_sidebar_function' );

}


/*-----------------------------------------------------------------------------------*/
/* Customize register */
/*-----------------------------------------------------------------------------------*/   

if (!function_exists('attimo_customize_register')) {

	function attimo_customize_register( $wp_customize ) {

		$wp_customize->remove_control( 'avventura_lite_header_layout');
		$wp_customize->remove_section( 'slideshow_section');

		$wp_customize->add_setting( 'attimo_sticky_posts', array(
			'default' => 'layout-1',
			'sanitize_callback' => 'attimo_select_sanitize',

		));

		$wp_customize->add_control( 'attimo_sticky_posts' , array(
			'type' => 'select',
			'priority' => '09',
			'section' => 'settings_section',
			'label' => esc_html__('Sticky post grid','attimo'),
			'description' => esc_html__('Do you want to enable the sticky post grid on homepage?.','attimo'),
			'choices'  => array (
			   'disable' => esc_html__( 'Disable','attimo'),
			   'layout-1' => esc_html__( 'Layout 1','attimo'),
			   'layout-2' => esc_html__( 'Layout 2','attimo'),
			   'layout-3' => esc_html__( 'Layout 3','attimo'),
			   'layout-4' => esc_html__( 'Layout 4','attimo'),
			),
		));
		
		function attimo_select_sanitize ($value, $setting) {
		
			global $wp_customize;
					
			$control = $wp_customize->get_control( $setting->id );
				 
			if ( array_key_exists( $value, $control->choices ) ) {
					
				return $value;
					
			} else {
					
				return $setting->default;
					
			}
			
		}
		
	}
	
	add_action( 'customize_register', 'attimo_customize_register', 11 );

}

/*-----------------------------------------------------------------------------------*/
/* Theme setup */
/*-----------------------------------------------------------------------------------*/ 

if (!function_exists('attimo_theme_setup')) {

	function attimo_theme_setup() {

		load_child_theme_textdomain( 'attimo', get_stylesheet_directory() . '/languages' );
		require_once( trailingslashit( get_stylesheet_directory() ) . 'core/functions/function-style.php' );

		remove_theme_support( 'custom-logo');

		$defaults = array( 'header-text' => array( 'site-title', 'site-description' ));
		add_theme_support( 'custom-logo', $defaults );

	}

	add_action( 'after_setup_theme', 'attimo_theme_setup', 999);

}

/*-----------------------------------------------------------------------------------*/
/* Widgets init */
/*-----------------------------------------------------------------------------------*/ 

if (!function_exists('attimo_widgets_init')) {

	function attimo_widgets_init() {

		register_sidebar(array(
		
			'name' => esc_html__('Banner widget area','attimo'),
			'id'   => 'attimo-banner-widget-area',
			'description'   => esc_html__('This widget area will be shown near the logo (Recommended for the image widget).', 'attimo'),
			'before_widget' => '<div id="%1$s" class="post-container %2$s"><article class="no-padding">',
			'after_widget'  => '</article></div>',
			'before_title'  => '<h4 class="title">',
			'after_title'   => '</h4>'
		
		));

	}

	add_action( 'widgets_init', 'attimo_widgets_init' );

}

if (!function_exists('attimo_thumbnail_function')) {

	function attimo_thumbnail_function($id, $icon = 'on') {

		global $post;
		
		$class = ( $icon == "on" ) ? '' : 'no-overlay';
		
		if ( '' != get_the_post_thumbnail() ) { 
			
	?>
			
			<div class="pin-container">
					
				<?php 
						
					the_post_thumbnail($id);
					
					$categories = get_the_category();
									
					if ( !empty( $categories ) ) {
									    
						echo '<div class="new-post-categories">';
						
						if ( $icon == "on" ):
							
							echo avventura_lite_posticon();	
							
						endif;
						
						foreach ( $categories as $category ) {
							echo '<div class="new-post-category">' . esc_html($category->name) . '</div>';
						}
									    
						echo '</div>';

					}

				?>
                    
			</div>
			
	<?php
	
		}
	
	}

	add_action( 'avventura_lite_thumbnail', 'attimo_thumbnail_function', 10, 2 );

}


if (!function_exists('attimo_before_content_function')) {

	function attimo_before_content_function( $type = "post" ) {
		
		if ( ! avventura_lite_is_single() ) {

			do_action('avventura_lite_get_title', 'blog' ); 

		} else {

			if ( !avventura_lite_is_woocommerce_active('is_cart') ) :
	
				if ( avventura_lite_is_single() && !is_page_template() ) :
							 
					do_action('avventura_lite_get_title', 'single');
							
				else :
					
					do_action('avventura_lite_get_title', 'blog'); 
							 
				endif;
	
			endif;

		}

		if ( $type == "post" ) :
		
			echo '<span class="entry-date"><strong>' . get_the_author_posts_link() . '</strong> - ' . esc_html(get_the_date()) . '</span>';

		endif;

	} 
	
	add_action( 'avventura_lite_before_content', 'attimo_before_content_function' );

}


?>