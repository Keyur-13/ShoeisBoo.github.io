<?php
/**
 * Header file for the Tribunal WordPress theme.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Tribunal
 * @since 1.0.0
 */
?><!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php
if( function_exists('wp_body_open') ){
    wp_body_open();
} ?>

<?php
$tribunal_default = tribunal_get_default_theme_options();

$ed_preloader = get_theme_mod('ed_preloader',$tribunal_default['ed_preloader'] );
if( $ed_preloader ){ ?>

    <div class="preloader hide-no-js">
        <div class="preloader-wrapper">
            <span class="dot"></span>
            <div class="dots">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </div>

<?php } ?>

<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e('Skip to the content', 'tribunal'); ?></a>

<?php
$tribunal_header_layout = get_theme_mod( 'tribunal_header_layout', $tribunal_default['tribunal_header_layout'] );
get_template_part( 'template-parts/header/header', $tribunal_header_layout ); ?>

<?php tribunal_header_banner(); ?>

<div id="content" class="site-content">

<?php tribunal_template_header(); ?>