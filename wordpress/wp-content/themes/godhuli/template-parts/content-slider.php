<?php
/**
 * Template part for displaying slider
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Godhuli
 */

?>


<?php
/**
 * Setup query to show the ‘post’ post type with given number of posts.
 * Output is title without excerpt.
 */


$args = array(
	'post_type'           => 'post',
	'post_status'         => 'publish',
	'posts_per_page'      => get_theme_mod( 'post_slide_number' ),
	'orderby'             => get_theme_mod( 'post_slider_orderby' ),
	'order'               => get_theme_mod( 'post_slider_order' ),
	'post__not_in'        => get_option( 'sticky_posts' ),
	'category_name'       => get_theme_mod( 'post_slider_category' ),
	'ignore_sticky_posts' => true,
);
$loop = new WP_Query( $args );

?>


<section>
	<div class="main-slider basic-slider <?php echo esc_attr( get_theme_mod( 'post_slider_category' ) ); ?>">

		<?php

		while ( $loop->have_posts() ) :
			$loop->the_post();

			$slider_image = get_the_post_thumbnail_url( '', 'godhuli_post_slide' );
			if ( empty( $slider_image ) ) {
				$slider_image = get_template_directory_uri() . '/images/placeholder.jpg';
			}

			?>

			<div class="main-slide">

				<?php
				printf( '<img src="%1$s" alt="%2$s" />', esc_url( $slider_image ), esc_attr( get_the_title() ) );
				?>

				<div class="slide-title">
					<?php

					godhuli_slider_category();

					printf( '<h2><a href="%1$s" title="%2$s">%3$s</a></h2>', esc_url( get_the_permalink() ), esc_attr( get_the_title() ), esc_html( get_the_title() ) );

					godhuli_slider_post_date();

					?>
				</div>

			</div><!-- Slide -->



			<?php

		endwhile;

		wp_reset_postdata();
		?>

	</div><!-- Slider -->
</section>










