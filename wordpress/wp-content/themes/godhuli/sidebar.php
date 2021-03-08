<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Godhuli
 */

if ( ! is_active_sidebar( 'godhuli-default-sidebar' ) ) {
	return;
}

?>



<!-- Sidebar-->
<div class="col-sm-4">
	<div class="sidebar">

		<?php if ( is_active_sidebar( 'godhuli-default-sidebar' ) ) : ?>

				<?php dynamic_sidebar( 'godhuli-default-sidebar' ); ?>

		<?php endif; ?>


	</div>
</div>
<!-- Sidebar end-->
