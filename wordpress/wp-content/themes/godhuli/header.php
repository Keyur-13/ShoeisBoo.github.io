<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Godhuli
 */

?>

<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">

<head>

	<meta charset="<?php bloginfo( 'charset', 'display' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php esc_url( bloginfo( 'pingback_url' ) ); ?>">
	<?php endif; ?>
	<?php wp_head(); ?>

</head>


<body <?php body_class(); ?>>

	<?php wp_body_open(); ?>


<div class="logo-box">

	<?php
	if ( godhuli_custom_logo() ) {

		echo wp_kses_post( godhuli_custom_logo() );

	} else {

		echo wp_kses_post( godhuli_text_logo_display() );

	}
	?>

</div>

<!-- Navigation Bar-->
<header id="topnav">

	<div class="container">

		<span class="logo-mobile">
		<?php

		if ( godhuli_custom_logo() ) {

			echo wp_kses_post( godhuli_custom_logo() );

		} else {

			echo wp_kses_post( godhuli_text_logo_display() );

		}

		?>
		</span>


			<!-- Navigation Menu-->
				<button id="nav-toggle" class="nav-toggle"><span class="mdi mdi-menu"></span></button>

				<nav class="nav-collapse">
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'primary',
							'menu_id'        => 'primary-menu',
							'depth'          => 5,
							'container'      => 'ul',
							'menu_class'     => 'menu-items',
							'fallback_cb'    => 'Godhuli_Bootstrap_Navwalker::fallback',
							'walker'         => new Godhuli_Bootstrap_Navwalker(),
						)
					);
					?>
				</nav>
			<!-- End navigation menu-->


	</div>
</header>
<!-- End Navigation Bar-->
