<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Godhuli
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


	<div class="text-center post-header">
		<?php

		the_title( '<h2 class="post-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );

		?>
	</div><!-- .entry-header -->

	<?php godhuli_post_thumbnail(); ?>

	<div class="entry-content <?php echo ( is_singular() ? 'blog-detail-description' : 'post-content' ); ?>">
		<?php
		the_excerpt();
		?>
	</div><!-- .entry-content -->


</article><!-- #post-<?php the_ID(); ?> -->
