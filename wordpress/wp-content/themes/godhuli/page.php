<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Godhuli
 */

get_header();
?>


<section class="section">
	<div id="content" class="container">
		<div class="row">

				<!-- Content-->
				<div class="col-sm-8">

					<?php
					if ( have_posts() ) :

						/* Start the Loop */
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


				<?php

				get_sidebar();

				?>


		</div>
	</div> <!-- end container -->
</section>

<?php
get_footer();

