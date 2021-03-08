<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Godhuli
 */

get_header();
?>

	<section class="section">
		<div id="content" class="container">
			<div class="row">

				<!-- Content-->
				<div class="<?php echo ( get_theme_mod( 'single_post_layout' ) === 'right' ? 'col-sm-8' : ' col-sm-12' ); ?>">

				<?php
				if ( have_posts() ) :
					/* Start the Loop */
					while ( have_posts() ) :
						the_post();

						get_template_part( 'template-parts/content', get_post_type() );

						endwhile;


					godhuli_entry_footer();
					godhuli_author_box();
					godhuli_related_post();

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
						endif;

					endif;
				?>


				</div>
				<!-- Content end-->
				<?php

				if ( 'right' === get_theme_mod( 'post_layout' ) ) :
					get_sidebar();
				endif;

				?>

			</div>
		</div> <!-- end container -->
	</section>

<?php
get_footer();
