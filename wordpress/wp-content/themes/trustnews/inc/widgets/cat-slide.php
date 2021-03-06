<?php
 /**
 * Register widget area.
 *
 * @link https://codex.wordpress.org/Function_Reference/register_widget
 * @package trustnews
 */

 class TrustNews_category_slide extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */

	function __construct() {
		$widget_ops = array( 'classname' => 'widget_slide_category_post', 'description' => esc_html__( 'Display  Slider in home page', 'trustnews') );
		$control_ops = array('width' => 200, 'height' => 250);
		parent::__construct( false, $name=esc_html__('T-Spiral: Slide Category post','trustnews'), $widget_ops, $control_ops );
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 */
	public function form( $instance ) {
		$no_of_slides = ! empty( $instance['no_of_slides'] ) ? absint( $instance['no_of_slides'] ) : 5;
		$posts_title = ! empty( $instance['posts_title'] ) ? esc_attr( $instance['posts_title'] ) : '';
		$multiple_slide = ! empty( $instance['multiple_slide'] ) ? esc_attr( $instance['multiple_slide'] ) : 'multiple_slide';
		$latest_posts = ! empty( $instance['latest_posts'] ) ? esc_attr( $instance['latest_posts'] ) : 'latest';
		$category = ! empty( $instance['category'] ) ? esc_attr( $instance['category'] ) : 'category';
	?>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'no_of_slides' )); ?>"><?php esc_html_e( 'Number of Slider:', 'trustnews' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'no_of_slides' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'no_of_slides' )); ?>" type="text" value="<?php echo absint( $no_of_slides ); ?>">
		</p>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'posts_title' )); ?>"><?php esc_html_e( 'Title:', 'trustnews' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'posts_title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'posts_title' )); ?>" type="text" value="<?php echo esc_attr( $posts_title ); ?>">
		</p>
		<p><input type="radio" <?php checked(esc_attr($multiple_slide), 'multiple_slide'); ?> id="<?php echo $this->get_field_id( 'multiple_slide' ); ?>" name="<?php echo esc_attr($this->get_field_name( 'multiple_slide' )); ?>" value="multiple_slide"/><?php esc_html_e( 'Multiple Slide', 'trustnews' );?>
			<br>
		 <input type="radio" <?php checked(esc_attr($multiple_slide), 'single'); ?> id="<?php echo esc_attr($this->get_field_id( 'multiple_slide' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'multiple_slide' )); ?>" value="single"/><?php esc_html_e( 'Single Slide', 'trustnews' );?>
		</p>
		<p><input type="radio" <?php checked(esc_attr($latest_posts), 'latest'); ?> id="<?php echo $this->get_field_id( 'latest_posts' ); ?>" name="<?php echo esc_attr($this->get_field_name( 'latest_posts' )); ?>" value="latest"/><?php esc_html_e( 'Latest Posts', 'trustnews' );?>
			<br>
		 <input type="radio" <?php checked(esc_attr($latest_posts), 'category'); ?> id="<?php echo esc_attr($this->get_field_id( 'latest_posts' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'latest_posts' )); ?>" value="category"/><?php esc_html_e( 'Show Category posts', 'trustnews' );?>
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'category' )); ?>"><?php esc_html_e( 'Select category', 'trustnews' ); ?>:</label>
			<?php wp_dropdown_categories( array( 'show_option_none' =>esc_html__('-- Select -- ','trustnews'),'name' => esc_attr($this->get_field_name( 'category' )), 'selected' => esc_attr($category) ) ); ?>
		</p>
		
		<?php 
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['no_of_slides'] = ( ! empty( $new_instance['no_of_slides'] ) ) ? absint( $new_instance['no_of_slides'] ) : '';
		$instance[ 'posts_title' ] = sanitize_text_field($new_instance[ 'posts_title' ]);
		$instance[ 'posts_title' ] = sanitize_text_field($new_instance[ 'posts_title' ]);
		$instance[ 'multiple_slide' ] = sanitize_text_field($new_instance[ 'multiple_slide' ]);
		$instance[ 'latest_posts' ] = sanitize_text_field($new_instance[ 'latest_posts' ]);
		$instance[ 'category' ] = sanitize_text_field($new_instance[ 'category' ]);

		return $instance;
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 */
	public function widget( $args, $instance ) {
		extract($args);
		$no_of_slides = ( ! empty( $instance['no_of_slides'] ) ) ? absint( $instance['no_of_slides'] ) : 4;
		$posts_title = ! empty( $instance['posts_title'] ) ? esc_attr( $instance['posts_title'] ) : '';
		$multiple_slide = ! empty( $instance['multiple_slide'] ) ? esc_attr( $instance['multiple_slide'] ) : 'multiple_slide';
		$latest_posts = ! empty( $instance['latest_posts'] ) ? esc_attr( $instance['latest_posts'] ) : 'latest';
		$category = ! empty( $instance['category'] ) ? esc_attr( $instance['category'] ) : 'category';

		echo $before_widget;
		if(!empty($posts_title) ){ ?>
			<h2 class="widget-title"><?php echo esc_html($posts_title); ?></h2>
		<?php } ?>
		<div class="slide-category-post-wrap<?php if ( $multiple_slide =='single'){ echo '-single'; } ?>">
			<div class="slide-category-post<?php if ( $multiple_slide =='single'){ echo '-single'; } ?>">
		
			<?php
			if( $latest_posts == 'latest' ) {
				$get_posts = new WP_Query( array(
					'posts_per_page' 			=> absint($no_of_slides),
					'post_type'					=> 'post',
					'ignore_sticky_posts' 	=> true
				) );
			}
			else {
				$get_posts = new WP_Query( array(
					'posts_per_page' 			=> absint($no_of_slides),
					'post_type'					=> 'post',
					'category__in'				=> absint($category)
				) );
			}

			while( $get_posts-> have_posts() ) : $get_posts->the_post(); ?>
			<div class="slide-category-post-outer">
				<div class="slide-category-post-inner">
					<?php if ( has_post_thumbnail() ) { ?>
						<div class="slide-category-post-thumbnail">
							<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail(); ?></a>
						 </div><!-- .slide-category-post-thumbnail -->
					<?php } ?>
					<div class="slide-category-post-inner-content">
						<div class="slide-category-post-meta">
							<?php trustnews_cat_lists (); ?>
						</div><!-- .slide-category-post-meta -->
						<h2 class="slide-category-post-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
						<div class="slide-category-post-meta">
							<?php

								trustnews_posted_by();

								trustnews_posted_on();

							?>
						</div><!-- .slide-category-post-meta -->
					</div><!-- .slide-category-post-inner-content -->
				</div><!-- .slide-category-post-inner -->
			</div><!-- .slide-category-post-outer -->
			<?php
			endwhile;
			wp_reset_postdata();
			?>
			</div><!-- .slide-category-post -->
		</div><!-- .slide-category-post-wrap -->
		<?php echo $after_widget. '<!-- .widget_slide_category_post -->';
	}

}