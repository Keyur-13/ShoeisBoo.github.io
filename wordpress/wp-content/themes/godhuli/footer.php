<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Godhuli
 */

?>


<footer>

<!-- copy-wrapper -->
	<div class="copy-wrapper">
		<div class="container center">



			<?php

			if ( get_theme_mod( 'godhuli_footer_copyright' ) ) :

				printf( '<p class="copyright">%s</p>', wp_kses_post( get_theme_mod( 'godhuli_footer_copyright' ) ) );

			else :

				?>

			<p class="copyright">

				<?php $blog_info = get_bloginfo( 'name' ); ?>

				<?php if ( ! empty( $blog_info ) ) : ?>
					<a class="site-name" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name', 'display' ); ?></a>,
				<?php endif; ?>

				<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'godhuli' ) ); ?>" class="imprint">
					<?php
					/* translators: %s: WordPress. */
					printf( esc_attr__( 'Proudly powered by %s.', 'godhuli' ), 'WordPress' );
					?>
				</a>

			</p><!-- .site-info -->

				<?php

			endif;

			?>



		</div>
	</div>
	<!-- end copy-wrapper -->
</footer>



<?php wp_footer(); ?>

</body>

</html>
