<?php
/**
 * Template part for displaying post archives and search results
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Godhuli
 */


?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


	<div class="text-center post-header">

		<?php
		godhuli_entry_category();
		?>

		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="post-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) :
			?>
			<div class="entry-meta">
				<?php
				godhuli_posted_on();
				?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
	</div><!-- .entry-header -->

	<?php godhuli_post_thumbnail(); ?>

	<div class="entry-content <?php echo ( is_singular() ? 'blog-detail-description' : 'post-content' ); ?>">
		<?php

		the_excerpt();


		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'godhuli' ),
				'after'  => '</div>',
			)
		);

		?>
	</div><!-- .entry-content -->


</article><!-- #post-<?php the_ID(); ?> -->
