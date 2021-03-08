<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package The_Words
 */
$ed_post_excerpt = get_theme_mod('ed_post_excerpt',1);
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('ta-match-height'); ?>>
	<div class="ta-artical-posts">

	<?php the_words_post_thumbnail('the-words-grid'); ?>

	<div class="ta-content-wraper">

		<?php the_title( '<h2 class="entry-title ta-large-font ta-secondary-font"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>

		<div class="entry-content">
			<?php
			if( $ed_post_excerpt ){

				if( has_excerpt() ){
					the_excerpt();
				}else{
					echo esc_html( wp_trim_words( get_the_content(),30,'...' ) );
				}

			} ?>
		</div><!-- .entry-content -->

	</div>

	</div>
</article><!-- #post-<?php the_ID(); ?> -->
