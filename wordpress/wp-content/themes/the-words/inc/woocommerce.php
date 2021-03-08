<?php
/**
 * Woocommerce Functions
 *
 * @package The_Words
**/

remove_action( 'woocommerce_before_main_content','woocommerce_breadcrumb',20 );
remove_action( 'woocommerce_sidebar','woocommerce_get_sidebar',10 );

if( !function_exists('the_words_wc_before_main_content') ):

    function the_words_wc_before_main_content(){

        echo '<div class="ta-container clearfix">';

    }

endif;

add_action('woocommerce_before_main_content', 'the_words_wc_before_main_content', 5);
add_action('woocommerce_after_main_content', 'the_words_wc_after_main_content', 15);

if( !function_exists('the_words_wc_after_main_content') ):


    function the_words_wc_after_main_content(){

        $global_sidebar_layout = get_theme_mod('global_sidebar_layout','right-sidebar');
        $ta_archive_layout = get_theme_mod('ta_archive_layout','simple');
        if( $global_sidebar_layout != 'no-sidebar' ){ get_sidebar(); }
        echo '</div>';

    }

endif;