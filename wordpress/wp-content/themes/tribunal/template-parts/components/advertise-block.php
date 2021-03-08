<?php
/**
 * Advertise
 *
 * @package Tribunal
 */

function tribunal_advertise_block( $tribunal_home_section,$repeat_times ){ 

	$advertise_image = esc_html( isset($tribunal_home_section->advertise_image) ? $tribunal_home_section->advertise_image : '');
	$advertise_link = esc_html( isset($tribunal_home_section->advertise_link) ? $tribunal_home_section->advertise_link : '');
	if( $advertise_image ){
	?>

	<div class="theme-block theme-block-nospace theme-block-ava">
	    <div class="wrapper">
	        <div class="column-row">
	            <div class="column column-12">
	                <a href="<?php echo esc_url( $advertise_link ); ?>" target="_blank" class="home-lead-link">
	                    <img src="<?php echo esc_url( $advertise_image ); ?>" alt="<?php esc_attr_e('Advertise Image','tribunal'); ?>">
	                </a>
	            </div>
	        </div>
	    </div>
	</div>

	<?php
	}
	
} ?>