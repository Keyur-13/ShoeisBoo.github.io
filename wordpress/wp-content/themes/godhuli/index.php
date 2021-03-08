<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Godhuli
 */

get_header();
?>

<?php
/*
 * Post slider
 */
if ( 1 === get_theme_mod( 'godhuli_disable_slide' ) ) :

	get_template_part( 'template-parts/content', 'slider' );

endif;
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
