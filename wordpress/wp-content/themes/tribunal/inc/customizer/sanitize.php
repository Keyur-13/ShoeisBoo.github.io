<?php
/**
* Custom Functions.
*
* @package Tribunal
*/

if( !function_exists( 'tribunal_sanitize_sidebar_option' ) ) :

    // Sidebar Option Sanitize.
    function tribunal_sanitize_sidebar_option( $tribunal_input ){

        $tribunal_metabox_options = array( 'global-sidebar','left-sidebar','right-sidebar','no-sidebar' );
        if( in_array( $tribunal_input,$tribunal_metabox_options ) ){

            return $tribunal_input;

        }

        return;

    }

endif;

if( !function_exists( 'tribunal_sanitize_single_pagination_layout' ) ) :

    // Sidebar Option Sanitize.
    function tribunal_sanitize_single_pagination_layout( $tribunal_input ){

        $tribunal_single_pagination = array( 'no-navigation','norma-navigation','ajax-next-post-load' );
        if( in_array( $tribunal_input,$tribunal_single_pagination ) ){

            return $tribunal_input;

        }

        return;

    }

endif;

if( !function_exists( 'tribunal_sanitize_archive_layout' ) ) :

    // Sidebar Option Sanitize.
    function tribunal_sanitize_archive_layout( $tribunal_input ){

        $tribunal_archive_option = array( 'default','full','grid','masonry' );
        if( in_array( $tribunal_input,$tribunal_archive_option ) ){

            return $tribunal_input;

        }

        return;

    }

endif;

if( !function_exists( 'tribunal_sanitize_header_layout' ) ) :

    // Sidebar Option Sanitize.
    function tribunal_sanitize_header_layout( $tribunal_input ){

        $tribunal_header_options = array( 'layout-1','layout-2','layout-3' );
        if( in_array( $tribunal_input,$tribunal_header_options ) ){

            return $tribunal_input;

        }

        return;

    }

endif;

if( !function_exists( 'tribunal_sanitize_single_post_layout' ) ) :

    // Single Layout Option Sanitize.
    function tribunal_sanitize_single_post_layout( $tribunal_input ){

        $tribunal_single_layout = array( 'layout-1','layout-2' );
        if( in_array( $tribunal_input,$tribunal_single_layout ) ){

            return $tribunal_input;

        }

        return;

    }

endif;

if ( ! function_exists( 'tribunal_sanitize_checkbox' ) ) :

	/**
	 * Sanitize checkbox.
	 */
	function tribunal_sanitize_checkbox( $tribunal_checked ) {

		return ( ( isset( $tribunal_checked ) && true === $tribunal_checked ) ? true : false );

	}

endif;


if ( ! function_exists( 'tribunal_sanitize_select' ) ) :

    /**
     * Sanitize select.
     */
    function tribunal_sanitize_select( $tribunal_input, $tribunal_setting ) {

        // Ensure input is a slug.
        $tribunal_input = sanitize_text_field( $tribunal_input );

        // Get list of choices from the control associated with the setting.
        $choices = $tribunal_setting->manager->get_control( $tribunal_setting->id )->choices;

        // If the input is a valid key, return it; otherwise, return the default.
        return ( array_key_exists( $tribunal_input, $choices ) ? $tribunal_input : $tribunal_setting->default );

    }

endif;

if ( ! function_exists( 'tribunal_sanitize_repeater' ) ) :
    
    /**
    * Sanitise Repeater Field
    */
    function tribunal_sanitize_repeater($input){
        $input_decoded = json_decode( $input, true );
        
        if(!empty($input_decoded)) {

            foreach ($input_decoded as $boxes => $box ){

                foreach ($box as $key => $value){

                    if( $key == 'section_ed' 
                        || $key == 'ed_tab' 
                        || $key == 'ed_arrows_carousel' 
                        || $key == 'ed_dots_carousel' 
                        || $key == 'ed_autoplay_carousel' 
                        || $key == 'ed_flip_column' 
                        || $key == 'ed_ribbon_bg'
                    ){

                        $input_decoded[$boxes][$key] = tribunal_sanitize_repeater_ed( $value );

                    }elseif( $key == 'home_section_type' ){

                        $input_decoded[$boxes][$key] = tribunal_sanitize_home_sections( $value );

                    }elseif( $key == 'ribbon_bg_color_schema' ){

                        $input_decoded[$boxes][$key] = tribunal_sanitize_ribbon_bg( $value );

                    }elseif( $key == 'category_color' ){

                        $input_decoded[$boxes][$key] = sanitize_hex_color( $value );

                    }elseif( $key == 'ribbon_bg_size' ){

                        $input_decoded[$boxes][$key] =  tribunal_sanitize_ribbon_bg_size( $value );

                    }elseif( $key == 'tiles_post_per_page' ){

                        $input_decoded[$boxes][$key] =  absint( $value );

                    }elseif( $key == 'advertise_image' || $key == 'advertise_link' ){

                         $input_decoded[$boxes][$key] = esc_url_raw( $value );

                    }elseif($key == 'section_category' || 
                            $key == 'section_post_slide_cat' || 
                            $key == 'section_category_1' || 
                            $key == 'section_category_2' || 
                            $key == 'section_category_3' || 
                            $key == 'section_category_4' || 
                            $key == 'category'
                        ){

                        $input_decoded[$boxes][$key] =  tribunal_sanitize_category( $value );

                    }else{

                        $input_decoded[$boxes][$key] = sanitize_text_field( $value );

                    }
                    
                }

            }
           
            return json_encode($input_decoded);

        }

        return $input;
    }
endif;

/** Sanitize Enable Disable Checkbox **/
function tribunal_sanitize_repeater_ed( $input ) {

    $valid_keys = array('yes','no');
    if ( in_array( $input , $valid_keys ) ) {
        return $input;
    }
    return '';

}

function tribunal_sanitize_home_sections( $input ) {

    $home_sections = array(
        'slider-blocks' => esc_html__('Slider Block','tribunal'),
        'latest-posts-blocks' => esc_html__('Latest Posts Block','tribunal'),
        'carousel-blocks' => esc_html__('Carousel Block','tribunal'),
        'tiles-blocks' => esc_html__('Tiles Block','tribunal'),
        'lead-blocks' => esc_html__('Leader Block','tribunal'),
        'masonry-blocks' => esc_html__('Masonry Block','tribunal'),
        'banner-blocks-1' => esc_html__('Banner Block Layout One','tribunal'),
        'banner-blocks-2' => esc_html__('Banner Block Layout Two','tribunal'),
        'banner-blocks-3' => esc_html__('Banner Block Layout Three','tribunal'),
        'banner-blocks-4' => esc_html__('Banner Block Layout Four','tribunal'),
        'post-list-block' => esc_html__('Post List Block','tribunal'),
        'advertise-blocks' => esc_html__('Advertise Block','tribunal'),

    );
    if ( array_key_exists( $input , $home_sections ) ) {
        return $input;
    }
    return '';

}

/** Sanitize Category **/
function tribunal_sanitize_category( $input ) {

   $tribunal_post_category_list = tribunal_post_category_list();
    if ( array_key_exists( $input , $tribunal_post_category_list ) ) {
        return $input;
    }
    return '';

}

function tribunal_sanitize_ribbon_bg_size( $input ) {

    $ribbon_bg_size = array( 
                    'small' => esc_html('Small','tribunal'),
                    'medium' => esc_html('Medium','tribunal'),
                    'large' => esc_html('Large','tribunal'),
                );

    if ( array_key_exists( $input , $ribbon_bg_size ) ) {
        return $input;
    }
    return '';

}

function tribunal_sanitize_ribbon_bg( $input ) {

    $ribbon_bg = array( 
                    '1' =>  array(
                                    'title' =>  esc_html__( 'Blue', 'tribunal' ),
                                    'color' =>  '#3061ff',
                                ),
                    '2' =>  array(
                                    'title' =>  esc_html__( 'Orange', 'tribunal' ),
                                    'color' =>  '#fa9000',
                                ),
                    '3' =>  array(
                                    'title' =>  esc_html__( 'Royal Blue', 'tribunal' ),
                                    'color' =>  '#00167a',
                                ),
                    '4' =>  array(
                                    'title' =>  esc_html__( 'Pink', 'tribunal' ),
                                    'color' =>  '#ff2d55',
                                ),
                );

    if ( array_key_exists( $input , $ribbon_bg ) ) {
        return $input;
    }
    return '';

}