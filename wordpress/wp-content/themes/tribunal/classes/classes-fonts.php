<?php
/**
* Fonts Classes.
*
* @package Tribunal
*/

if ( ! class_exists( 'Tribunal_Fonts' ) ) :
	class Tribunal_Fonts {

		/**
		 * Font Lists Wigh Property
		 */
		public static function tribunal_get_fonts_property( $font ) {

			$fonts = array(

					
					'Merriweather' => array(
						'weight' => array(
							'300'  => esc_html__( 'Light 300', 'tribunal' ),
							'300i' => esc_html__( 'Light 300 Italic', 'tribunal' ),
							'400'  => esc_html__( 'Regular 400', 'tribunal' ),
							'400i' => esc_html__( 'Regular 400 Italic', 'tribunal' ),
							'700'  => esc_html__( 'Bold 700', 'tribunal' ),
							'700i' => esc_html__( 'Bold 700 Italic', 'tribunal' ),
							'900'  => esc_html__( 'Black 900', 'tribunal' ),
							'900i' => esc_html__( 'Black 900 Italic', 'tribunal' ),
					   	),
					   	'languages' => array(
							'cyrillic' => 'Cyrillic',
							'cyrillic-ext' => 'Cyrillic Extended',
							'latin' => 'Latin',
							'latin-ext' => 'Latin Extended',
							'vietnamese' => 'Vietnamese',
						),
					),
					'Roboto Mono' => array(
						'weight' => array(
							'100'  => esc_html__( 'Thin 100', 'tribunal' ),
							'100i' => esc_html__( 'Thin 100 Italic ', 'tribunal' ),
							'200'  => esc_html__( 'Extra Light 200', 'tribunal' ),
							'200i' => esc_html__( 'Extra Light 200 Italic', 'tribunal' ),
							'300'  => esc_html__( 'Light 300', 'tribunal' ),
							'300i' => esc_html__( 'Light 300 Italic', 'tribunal' ),
							'400'  => esc_html__( 'Regular 400', 'tribunal' ),
							'400i' => esc_html__( 'Regular 400 Italic', 'tribunal' ),
							'500'  => esc_html__( 'Medium 500', 'tribunal' ),
							'500i' => esc_html__( 'Medium 500 Italic', 'tribunal' ),
							'600'  => esc_html__( 'Semi Bold 600', 'tribunal' ),
							'600i' => esc_html__( 'Semi Bold 600 Italic', 'tribunal' ),
							'700'  => esc_html__( 'Bold 700', 'tribunal' ),
							'700i' => esc_html__( 'Bold 700 Italic', 'tribunal' ),
							'800'  => esc_html__( 'Extra Bold 800', 'tribunal' ),
							'800i' => esc_html__( 'Extra Bold 800 Italic', 'tribunal' ),
							'900'  => esc_html__( 'Black 900', 'tribunal' ),
							'900i' => esc_html__( 'Black 900 Italic', 'tribunal' ),
					   	),
					   	'languages' => array(
							'cyrillic' => 'Cyrillic',
							'cyrillic-ext' => 'Cyrillic Extended',
							'greek' => 'Greek',
							'greek-ext' => 'Greek Extended',
							'latin' => 'Latin',
							'latin-ext' => 'Latin Extended',
							'vietnamese' => 'Vietnamese',
						),
					),
					'Roboto' => array(
						'weight' => array(
							'100'  => esc_html__( 'Thin 100', 'tribunal' ),
							'100i' => esc_html__( 'Thin 100 Italic ', 'tribunal' ),
							'300'  => esc_html__( 'Light 300', 'tribunal' ),
							'300i' => esc_html__( 'Light 300 Italic', 'tribunal' ),
							'400'  => esc_html__( 'Regular 400', 'tribunal' ),
							'400i' => esc_html__( 'Regular 400 Italic', 'tribunal' ),
							'500'  => esc_html__( 'Medium 500', 'tribunal' ),
							'500i' => esc_html__( 'Medium 500 Italic', 'tribunal' ),
							'700'  => esc_html__( 'Bold 700', 'tribunal' ),
							'700i' => esc_html__( 'Bold 700 Italic', 'tribunal' ),
							'900'  => esc_html__( 'Black 900', 'tribunal' ),
							'900i' => esc_html__( 'Black 900 Italic', 'tribunal' ),
						),
						'languages' => array(
							'cyrillic' => 'Cyrillic',
							'cyrillic-ext' => 'Cyrillic Extended',
							'greek' => 'Greek',
							'greek-ext' => 'Greek Extended',
							'latin' => 'Latin',
							'latin-ext' => 'Latin Extended',
							'vietnamese' => 'Vietnamese',
						),
					),
			);

			return $fonts[$font];

		}

		/**
		 * Font URL Return
		 */
		public static function tribunal_get_fonts_url( $font_type = false ){

			$tribunal_default = tribunal_get_default_theme_options();
			$tribunal_body_font = $tribunal_default['tribunal_body_font'];
			$tribunal_heading_font = $tribunal_default['tribunal_heading_font'];
			$tribunal_tertiary_font = $tribunal_default['tribunal_tertiary_font'];

			// List All font in array
			$fonts_lists = array( $tribunal_body_font,$tribunal_tertiary_font,$tribunal_heading_font );

			// Remove if font repeat
			$fonts_lists = array_unique($fonts_lists);


			// Remove Default Fonts
			$remove_font_1 = array_search('Georgia', $fonts_lists);
			if( in_array('Georgia',$fonts_lists) ){ unset($fonts_lists[$remove_font_1]); }

			$remove_font_2 = array_search('Helvetica', $fonts_lists);
			if( in_array('Helvetica',$fonts_lists) ){ unset($fonts_lists[$remove_font_2]); }

			$remove_font_3 = array_search('Arial', $fonts_lists);
			if( in_array('Arial',$fonts_lists) ){ unset($fonts_lists[$remove_font_3]); }

			$tribunal_fonts = array();

			$font_count = count($fonts_lists);

			$j = 1;
			foreach( $fonts_lists as $font ){
				
				// Get Font Property
				$fonts_property = Tribunal_Fonts::tribunal_get_fonts_property( $font );
				$fonts_property_list = '';
				foreach( $fonts_property['weight'] as $key => $weight ){

					$fonts_property_list .= $key.',';

				}

				if( $fonts_property_list ){

					$fonts_property_list = rtrim( $fonts_property_list,',' );
					if( $font_count == $j ){
						$tribunal_fonts[] = $font.':'.$fonts_property_list.'&display=swap';
					}else{
						$tribunal_fonts[] = $font.':'.$fonts_property_list;
					}
				}else{

					if( $font_count == $j ){
						$tribunal_fonts[] = $font.'&display=swap';
					}else{
						$tribunal_fonts[] = $font;
					}
					
				}

				$j++;
			}

			if( $tribunal_fonts ){

		        $i = 0;
		        for ( $i = 0; $i < count( $tribunal_fonts ); $i++ ) {

		            if ( 'off' !== sprintf( _x( 'on', '%s font: on or off', 'tribunal' ), $tribunal_fonts[$i] ) ) {
		                $fonts[] = $tribunal_fonts[$i];
		            }

		        }

		        if ( $fonts ) {
		            $fonts_url = add_query_arg( array(
		                'family' => urldecode( implode( '|', $fonts ) ),
		            ), 'https://fonts.googleapis.com/css' );
		        }

		        return esc_url_raw($fonts_url);

		    }

		}

	}
endif;