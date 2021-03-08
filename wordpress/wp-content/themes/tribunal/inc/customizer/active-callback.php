<?php
/**
 * Tribunal Customizer Active Callback Functions
 *
 * @package Tribunal
 */

function tribunal_header_archive_layout_ac( $control ){

    $tribunal_archive_layout = $control->manager->get_setting( 'tribunal_archive_layout' )->value();
    if( $tribunal_archive_layout == 'default' ){

        return true;
        
    }
    
    return false;
}

function tribunal_overlay_layout_ac( $control ){

    $tribunal_single_post_layout = $control->manager->get_setting( 'tribunal_single_post_layout' )->value();
    if( $tribunal_single_post_layout == 'layout-2' ){

        return true;
        
    }
    
    return false;
}

function tribunal_header_ad_ac( $control ){

    $ed_header_ad = $control->manager->get_setting( 'ed_header_ad' )->value();
    if( $ed_header_ad ){

        return true;
        
    }
    
    return false;
}