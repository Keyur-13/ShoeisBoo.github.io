<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package The_Words
 */

get_header();

global $post;
$global_sidebar_layout = get_theme_mod('global_post_sidebar_layout','right-sidebar');
$the_words_post_sidebar = get_post_meta( $post->ID, 'the_words_post_sidebar_layout', true );

if( $the_words_post_sidebar == 'global' || $the_words_post_sidebar == '' ){

	$sidebar = $global_sidebar_layout;

}else{

	$sidebar = $the_words_post_sidebar;
	
}

?>
<div class="ta-container clearfix">
	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', get_post_type() );

			$ed_author_box = get_theme_mod('ed_author_box',1);
			if( $ed_author_box && 'post' === get_post_type() ){ ?>

				<div class="author-bio clearfix">
					
					<div class="auther-avatar">
						<?php $avatar_image = get_avatar_url( get_the_author_meta( 'ID' ), array( 'size' => 100 ) ); ?>
						<img title="<?php esc_attr_e('Author Image','the-words'); ?>" alt="<?php esc_attr_e('Author Image','the-words'); ?>" src="<?php echo esc_url($avatar_image); ?>" >
					</div>
					
					<?php $author_desc = get_the_author_meta('description',get_the_author_meta( 'ID' )); ?>

					<div class="author-name-desc">
						<span><?php the_author(); ?></span>
						<?php if( $author_desc ){ ?><p><?php echo esc_html($author_desc); ?></p><?php } ?>
					</div>

				</div>

			<?php } ?>

			<?php if( 'post' === get_post_type() ){ ?>

			<div class="ta-single-nav clearfix">
		        <?php
		        previous_post_link( '<div class="ta-prev-post"><h4 class="ta-nav-title">' . esc_html__( 'Previous Post', 'the-words' ) . '</h4><span><i class="fas fa-chevron-left"></i>%link</span></div>' );
		        
		        next_post_link( '<div class="ta-next-post"><h4 class="ta-nav-title">' . esc_html__( 'Next Post', 'the-words' ) . '</h4><span>%link<i class="fas fa-chevron-right"></i></span></div>' );
		        ?>
		    </div>

		    <?php
			}

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

	<?php if( $sidebar != 'no-sidebar' ){ get_sidebar(); } ?>

</div>
<?php
get_footer();