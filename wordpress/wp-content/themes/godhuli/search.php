<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
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
						?>

						<header class="archive-page-header center">
						<?php
						printf( wp_kses_post( '<h2>Search Results for: %s</h2>', 'godhuli' ), '<span>' . get_search_query() . '</span>' );
						?>
						</header><!-- .page-header -->

						<?php

						/* Start the Loop */
						while ( have_posts() ) :
							the_post();

							get_template_part( 'template-parts/content', 'search' );

						endwhile;

						godhuli_number_paging_nav();

						else :

							get_template_part( 'template-parts/content', 'none' );

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

