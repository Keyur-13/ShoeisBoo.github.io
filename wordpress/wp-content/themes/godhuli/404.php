<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Godhuli
 */

get_header();
?>


<section class="section">
	<div id="content" class="container">
		<div class="row justify-content-center align-items-center min-height">

				<!-- Content-->
				<div class="col-sm-8">

					<header class="page-header center">
						<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'godhuli' ); ?></h1>
					</header><!-- .page-header -->

					<div class="page-content-nfound center">
						<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'godhuli' ); ?></p>

						<?php get_search_form(); ?>

						<div class="back">

							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="bookmark" class="btn btn-outline-custom">
								<?php esc_html_e( 'Back to home page', 'godhuli' ); ?>
							<i class="mdi mdi-arrow-right"></i>
							</a>

						</div>

					</div><!-- .page-content -->

				</div>
				<!-- Content end-->


		</div>
	</div> <!-- end container -->
</section>


<?php
get_footer();

