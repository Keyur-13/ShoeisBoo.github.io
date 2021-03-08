<?php
/**
 * The template for displaying archive pages
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
				<div class="<?php echo ( get_theme_mod( 'single_post_layout' ) === 'right' ? 'col-sm-8' : ' col-sm-12' ); ?>">

				<?php

				if ( have_posts() ) :

					?>

					<header class="archive-page-header center">
					<?php

					the_archive_title( '<h2 class="page-title">', '</h2>' );

					the_archive_description( '<div class="archive-description">', '</div>' );

					?>
					</header><!-- .page-header -->

					<?php

					/* Start the Loop */
					while ( have_posts() ) :
						the_post();

						get_template_part( 'template-parts/content', get_post_type() );

						endwhile;

					godhuli_number_paging_nav();

					else :

						get_template_part( 'template-parts/content', 'none' );

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

