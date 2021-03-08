<?php
/**
 * Customizer Sanitize Functions
 *
 * @package The_Words
**/


if( !function_exists('the_words_sanitize_checkbox') ):

	/**
	* Customizer Checkbox Sanitize
	**/

	function the_words_sanitize_checkbox($input){

	    if($input == 1){
	        return 1;
	    }else{
	        return '';
	    }

	}

endif;

if( !function_exists('the_words_sanitize_sidebar') ):

	/**
	* Customizer Sidebar Sanitize
	**/

	function the_words_sanitize_sidebar( $input ) {

	    $valid_keys = array('right-sidebar','left-sidebar','no-sidebar');

	    if ( in_array( $input, $valid_keys ) ) {

	        return $input;

	    } else {

	        return '';

	    }

	}

endif;

if( !function_exists('the_words_sanitize_archive_layout') ):

	/**
	* Customizer Archive Layout Sanitize
	**/

	function the_words_sanitize_archive_layout( $input ) {

	    $valid_keys = array('grid','simple','masonry');

	    if ( in_array( $input, $valid_keys ) ) {

	        return $input;

	    } else {

	        return '';

	    }

	}

endif;

if( !function_exists('the_words_sanitize_category') ):

	/**
	* Customizer Category Sanitize
	**/

	function the_words_sanitize_category($input){

	    $the_words_Category_list = the_words_category_list();

	    if(array_key_exists($input,$the_words_Category_list)){
	        return $input;
	    }
	    else{
	        return '';
	    }
	}

endif;