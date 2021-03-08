<?php
/**
 * Template Name: Full Width Template
 * Template Post Type: post, page
 *
 * @link https://codex.wordpress.org/Templates
 *
 * @package Godhuli
 */

get_header();

?>

	<section class="section">
		<div id="content" class="container">
			<div class="row">

				<!-- Content-->
				<div class="col-sm-12">
					<?php
					if ( have_posts() ) : /* Start the Loop */
						while ( have_posts() ) :
							the_post();

							get_template_part( 'template-parts/content', 'page' );
						endwhile;

						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;
					endif;
					?>

				</div>
				<!-- Content end-->


			</div>
		</div> <!-- end container -->
	</section>

<?php
get_footer();
