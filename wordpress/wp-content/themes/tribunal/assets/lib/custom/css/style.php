<?php
/**
 * Tribunal Dynamic Styles
 *
 * @package Tribunal
 */

function tribunal_dynamic_css()
{

    $tribunal_default = tribunal_get_default_theme_options();
    
    $tribunal_color_schema = get_theme_mod('tribunal_color_schema', $tribunal_default['tribunal_color_schema']);

    if( $tribunal_color_schema == 'fancy' ){

        $tribunal_primary_color = $tribunal_default['fancy_primary_color'];
        $tribunal_secondary_color = $tribunal_default['fancy_secondary_color'];
        $tribunal_tertiary_color = $tribunal_default['fancy_tertiary_color'];
        $tribunal_link_color = $tribunal_default['fancy_link_color'];
        $tribunal_link_hover_color = $tribunal_default['fancy_link_hover_color'];
        $tribunal_text_color = $tribunal_default['fancy_text_color'];

    }elseif( $tribunal_color_schema == 'dark' ){

        $tribunal_primary_color = $tribunal_default['dark_primary_color'];
        $tribunal_secondary_color = $tribunal_default['dark_secondary_color'];
        $tribunal_tertiary_color = $tribunal_default['dark_tertiary_color'];
        $tribunal_link_color = $tribunal_default['dark_link_color'];
        $tribunal_link_hover_color = $tribunal_default['dark_link_hover_color'];
        $tribunal_text_color = $tribunal_default['dark_text_color'];

    }elseif( $tribunal_color_schema == 'shady' ){

        $tribunal_primary_color = $tribunal_default['shady_primary_color'];
        $tribunal_secondary_color = $tribunal_default['shady_secondary_color'];
        $tribunal_tertiary_color = $tribunal_default['shady_tertiary_color'];
        $tribunal_link_color = $tribunal_default['shady_link_color'];
        $tribunal_link_hover_color = $tribunal_default['shady_link_hover_color'];
        $tribunal_text_color = $tribunal_default['shady_text_color'];

    }else{

        $tribunal_primary_color = $tribunal_default['default_primary_color'];
        $tribunal_secondary_color = $tribunal_default['default_secondary_color'];
        $tribunal_tertiary_color = $tribunal_default['default_tertiary_color'];
        $tribunal_link_color = $tribunal_default['default_link_color'];
        $tribunal_link_hover_color = $tribunal_default['default_link_hover_color'];
        $tribunal_text_color = $tribunal_default['default_text_color'];
        

    }

    $background_color ='#' . get_theme_mod('background_color', 'f7f8f9');
    $tribunal_category_colors = get_theme_mod('tribunal_category_colors', json_encode($tribunal_default['tribunal_category_colors']));

    echo "<style type='text/css' media='all'>"; ?>

    <?php

    if ($tribunal_category_colors) {
        $tribunal_category_colors = json_decode($tribunal_category_colors);
        foreach ($tribunal_category_colors as $tribunal_category_color) {
            if (isset($tribunal_category_color->category) && $tribunal_category_color->category && isset($tribunal_category_color->category_color) && $tribunal_category_color->category_color) { ?>

                .tribunal-cat-color-<?php echo esc_attr($tribunal_category_color->category); ?>{
                background-color: <?php echo esc_attr($tribunal_category_color->category_color); ?> !important;
                }
                .tribunal-cat-color-<?php echo esc_attr($tribunal_category_color->category); ?>:after{
                border-left-color: <?php echo esc_attr($tribunal_category_color->category_color); ?> !important;
                }
                <?php
            }
        }
    }
    ?>

    body .header-searchbar-inner,
    body .offcanvas-wraper,
    body .header-navbar,
    body .theme-tags-area,
    body .theme-block .column-bg,
    body .widget-area .widget,
    body .floating-nav-arrow,
    body .content-main-bg,
    body .news-article-bg,
    body .post-navigation,
    body .posts-navigation,
    body .be-author-content,
    body .be-author-content .be-author-wrapper,
    body .site-content .booster-reactions-block,
    body .site-content .booster-ratings-block,
    body .site-content .post-content-share .share-media-nocount,
    .twp-icon-holder .twp-social-count,
    #comments .comment-form input[type="text"],
    #comments .comment-form input[type="email"],
    #comments .comment-form input[type="url"],
    #comments .comment-form textarea{
    background-color: <?php echo esc_attr($tribunal_primary_color); ?>;
    }

    body .post-thumbnail-effects::after {
    border-bottom-color: <?php echo esc_attr($tribunal_primary_color); ?>;
    }

    .post-content-share .share-media-nocount:after,
    .post-content-share .twp-icon-holder .twp-social-count:after {
    border-top-color: <?php echo esc_attr($tribunal_primary_color); ?>;
    }

    body .column-lr-border {
    border-color: <?php echo esc_attr($tribunal_primary_color); ?>;
    }

    button,
    .button,
    .wp-block-button__link,
    .wp-block-file .wp-block-file__button,
    input[type="button"],
    input[type="reset"],
    input[type="submit"],
    .block-title-wrapper:before,
    .comment-reply-title:before,
    .entry-meta .cat-links > a{
    background-color: <?php echo esc_attr($tribunal_secondary_color); ?>;
    }

    .entry-meta .cat-links > a:after{
    border-left-color: <?php echo esc_attr($tribunal_secondary_color); ?>;
    }

    .ticker-title,
    .main-navigation div.menu > ul > li.brand-home{
    background-color: <?php echo esc_attr($tribunal_tertiary_color); ?>;
    }

    .theme-block .column-bg {
    border-color: <?php echo esc_attr($tribunal_tertiary_color); ?>;
    }

    a{
    color: <?php echo esc_attr($tribunal_link_color); ?>;
    }

    a:hover,
    a:focus {
    color: <?php echo esc_attr($tribunal_link_hover_color); ?>;
    }

    .site-content .thumb-overlay-darker::before {
    background: -webkit-linear-gradient(transparent, <?php echo esc_attr(tribunal_hex2rgb($background_color, 1.6)); ?>);
    background: -o-linear-gradient(transparent, <?php echo esc_attr(tribunal_hex2rgb($background_color, 1.6)); ?>);
    background: -ms-linear-gradient(transparent, <?php echo esc_attr(tribunal_hex2rgb($background_color, 1.6)); ?>);
    background: -moz-linear-gradient(transparent, <?php echo esc_attr(tribunal_hex2rgb($background_color, 1.6)); ?>);
    background: linear-gradient(transparent, <?php echo esc_attr(tribunal_hex2rgb($background_color, 1.6)); ?>);
    background: linear-gradient(to bottom, <?php echo esc_attr(tribunal_hex2rgb($background_color, 0)); ?>, <?php echo esc_attr($background_color); ?>);
    }

    body,
    input,
    select,
    optgroup,
    textarea {
    color: <?php echo esc_attr($tribunal_text_color); ?>;
    }

    .offcanvas-main-navigation li,
    .offcanvas-main-navigation .sub-menu,
    .offcanvas-main-navigation .submenu-wrapper .submenu-toggle,
    .block-title-wrapper,
    .comment-reply-title,
    .entry-content:before,
    .content-list-border,
    .widget.widget_recent_entries ul li,
    .widget.widget_categories ul li,
    .widget.widget_pages ul li,
    .widget.widget_archive ul li,
    .widget.widget_meta ul li {
    border-color: <?php echo esc_attr(tribunal_hex2rgb($tribunal_text_color, 0.12)); ?>
    }

    .tags-area .tags-content .tags-title-label,
    .affix-panel-content,
    .booster-block .be-author-details .be-author-wrapper{
    background-color: <?php echo esc_attr($background_color); ?>;
    }

    @media (min-width: 992px) {
    .header-layout-3.site-header-fixed .header-navigation-wrapper,
    .header-layout-2.site-header-fixed .header-navbar{
    background-color: <?php echo esc_attr($background_color); ?>;
    }
    }

    <?php echo "</style>";
}

add_action('wp_head', 'tribunal_dynamic_css', 100);

/**
 * Sanitizing Hex color function.
 */
function tribunal_sanitize_hex_color($color)
{

    if ('' === $color)
        return '';
    if (preg_match('|^#([A-Fa-f0-9]{3}){1,2}$|', $color))
        return $color;

}