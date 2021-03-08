<?php
/**
 * Dynamic style for theme
 *
 * @package Godhuli
 */
function godhuli_theme_dynamic_style() {

	$godhuli_style = '';

	/**********************/
	// Scheme Color
	/**********************/

	$godhuli_theme_color = sanitize_hex_color( get_theme_mod( 'godhuli_theme_color' ) );

	$godhuli_style .= ".entry-content a {
	    color: {$godhuli_theme_color};
	}
	.entry-content a:focus {
	    border: 1px dashed {$godhuli_theme_color};
	}
	a:hover,
	a:focus {
	    color: {$godhuli_theme_color};
	}
	.btn-outline-custom {
	    color: {$godhuli_theme_color};
	    border-color: {$godhuli_theme_color};
	}
	.btn-outline-custom.active,
	.btn-outline-custom:hover,
	.btn-outline-custom:active,
	.show>.btn-outline-custom.dropdown-toggle {
	    background-color: {$godhuli_theme_color};
	    border-color: {$godhuli_theme_color};
	}
	.btn-outline-custom.active,
	.btn-outline-custom:focus,
	.btn-outline-custom:active,
	.show>.btn-outline-custom.dropdown-toggle {
	    background-color: {$godhuli_theme_color};
	    border-color: {$godhuli_theme_color};
	}
	#topnav .has-submenu.active .submenu li.active > a {
	    color: {$godhuli_theme_color};
	}
	#topnav .has-submenu.active > a,
	#topnav .navigation-menu li.active > a {
	    color: {$godhuli_theme_color};
	}
	#topnav .has-submenu.active .menu-arrow {
	    border-color: {$godhuli_theme_color};
	}
	#topnav .navbar-toggle.open span:hover,
	#topnav .navbar-toggle.open span:focus {
	    background-color: {$godhuli_theme_color};
	}
	#topnav .navbar-toggle:hover,
	#topnav .navbar-toggle:focus,
	#topnav .navigation-menu > li > a:hover,
	#topnav .navigation-menu > li > a:focus {
	    color: {$godhuli_theme_color};
	}
	#topnav .navigation-menu > li > a:hover,
	#topnav .navigation-menu > li .submenu li a:hover,
	#topnav .navigation-menu > li.has-submenu.open > a,
	#topnav .menu-extras .menu-item .cart > a:hover,
	#topnav .menu-extras .menu-item .search > a:hover {
	    color: {$godhuli_theme_color};
	}
	#topnav .navigation-menu > li > a:focus,
	#topnav .navigation-menu > li .submenu li a:focus,
	#topnav .navigation-menu > li.has-submenu.open > a,
	#topnav .menu-extras .menu-item .cart > a:focus,
	#topnav .menu-extras .menu-item .search > a:focus {
	    color: {$godhuli_theme_color};
	}
	.badge-custom {
	    background-color: {$godhuli_theme_color};
	}
	.post-tags a:hover,
	.post-tags a:focus {
	    background: {$godhuli_theme_color};
	}
	.search-button:hover,
	.search-button:focus {
	    color: {$godhuli_theme_color};
	}
	.widget-title:after {
	    border-bottom: 1px solid {$godhuli_theme_color};
	}
	.widget {
	    border-color: {$godhuli_theme_color};
	    border: 4px double {$godhuli_theme_color};;
	}
	.widget ul li a:hover,
	.widget ol li a:hover {
	    color: {$godhuli_theme_color};
	}
	.widget ul li a:focus,
	.widget ol li a:focus {
	    color: {$godhuli_theme_color};
	}
	.widget select:focus {
	    border-color: {$godhuli_theme_color};
	}
	.tagcloud > a:hover,
	.tagcloud > a:focus {
	    background: {$godhuli_theme_color};
	}
	.searchform > .button:hover,
	.searchform > .button:focus {
	    background-color: {$godhuli_theme_color};
	}
	.media-heading a:hover,
	.media-heading a:focus {
	    color: {$godhuli_theme_color};
	}
	.blog_comments ul .trackback a,
	.blog_comments ul .pingback a {
	    color: {$godhuli_theme_color};
	}
	.comment-form input[type='submit']:hover,
	.comment-form input[type='submit']:focus {
	    background-color: {$godhuli_theme_color};
	    border-color: {$godhuli_theme_color};
	}
	.related-post .post-header a:hover,
	.related-post .post-header a:focus {
	    color: {$godhuli_theme_color};
	}
	.post-author-box .socials li a:focus {
	    background-color: {$godhuli_theme_color};
	    border-color: {$godhuli_theme_color};
	}
	.quote-post .blockquote {
	    border: 2px solid {$godhuli_theme_color};
	}
	.quote-post .blockquote:before {
	    color: {$godhuli_theme_color};
	}
	.link-post {
	    background-color: {$godhuli_theme_color};
	}
	th {
	    background: {$godhuli_theme_color};
	}
	.page-numbers > .active > a,
	.page-numbers > .active > span {
	    background-color: {$godhuli_theme_color};
	    border-color: {$godhuli_theme_color};
	}
	.page-numbers > li > a:hover,
	.page-numbers > li > a:focus,
	.page-numbers > li > span:hover,
	.page-numbers > li > span:focus {
	    background-color: {$godhuli_theme_color};
	    border-color: {$godhuli_theme_color};
	}
	.page-numbers > .active > a,
	.page-numbers > .active > a:focus,
	.page-numbers > .active > a:hover,
	.page-numbers > .active > span,
	.page-numbers > .active > span:focus,
	.pagination > .active > span:hover,
	.pagination .nav-links .page-numbers:hover
	 {
	    background-color: {$godhuli_theme_color};
	    border-color: {$godhuli_theme_color};
	}
	.page-numbers > li > span.current, .pagination .nav-links .page-numbers.current {
	    background-color: {$godhuli_theme_color};
	    border-color: {$godhuli_theme_color};
	}
	
	.socials li a:hover,
	.socials li a:focus {
	    background-color: {$godhuli_theme_color};
	}
	.flex-center a.reply-btn:hover,
	.flex-center a.reply-btn:focus {
	    color: {$godhuli_theme_color};
	}
	.wp-block-cover__video-background:focus,
	video:focus,
	iframe:focus,
	.wp-block-embed__wrapper:focus, .wp-block-audio audio:focus {
	    border: 2px solid {$godhuli_theme_color};
	}
	.blocks-gallery-item figure:focus,
	figure:focus {
	    border: 1px dashed {$godhuli_theme_color};
	}
	.screen-reader-text:focus {
	    background-color:{$godhuli_theme_color};
	}
	[type='reset'], [type='submit'], button, html [type='button'] {
	    background: {$godhuli_theme_color};
	    border: 1px solid {$godhuli_theme_color};
	}
	.js .nav-collapse .dropdown-toggle:hover, .js .nav-collapse .dropdown-toggle:focus, .js .nav-collapse .dropdown-toggle:active {
	    background-color: {$godhuli_theme_color};
	}
	.nav-collapse ul li.active > a {
	    color: {$godhuli_theme_color}
	}
	.wp-block-calendar table th {
	    background: {$godhuli_theme_color};
	}
	.wp-block-search .wp-block-search__input:focus,
	input:focus,
	textarea:focus {
	    border: 1px dashed {$godhuli_theme_color};
	}
	.wp-block-search .wp-block-search__button:focus,
	[type='submit']:focus {
	    border: 1px dashed {$godhuli_theme_color} !important;
	}
	button:not(.toggle),
	.button,
	.faux-button,
	.wp-block-button__link,
	.wp-block-file .wp-block-file__button,
	input[type='button'],
	input[type='reset'],
	input[type='submit'],
	.bg-accent,
	.bg-accent-hover:hover,
	.bg-accent-hover:focus,
	:root .has-accent-background-color {
	    background-color: {$godhuli_theme_color};
	}
	.is-style-outline .wp-block-button__link {
	    border: 2px solid {$godhuli_theme_color};
	}
	.badge-custom:focus {
	    background-color: transparent;
	    color: #333 !important;
	    border: 1px dashed {$godhuli_theme_color};
	}
	.wp-block-button__link:focus, .wp-block-file .wp-block-file__button:focus {
	    border: 2px solid {$godhuli_theme_color} !important;
	}
	.is-style-outline .wp-block-button__link:focus {
	    background: {$godhuli_theme_color} !important;
	}
	.wp-block-gallery .blocks-gallery-item figure a:focus {
        border: 2px solid {$godhuli_theme_color};
	}
	.mejs-container:focus {
	    border: 2px solid {$godhuli_theme_color};
	}
	.js .nav-collapse .dropdown-toggle:hover, .js .nav-collapse .dropdown-toggle:focus, .js .nav-collapse .dropdown-toggle:active {
	    background-color: {$godhuli_theme_color};
	    border: 1px solid {$godhuli_theme_color};
	}";

	return $godhuli_style;

}

