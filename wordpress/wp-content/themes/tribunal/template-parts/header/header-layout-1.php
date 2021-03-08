<?php
/**
 * Header Layout 1
 *
 * @package Tribunal
 */

$tribunal_default = tribunal_get_default_theme_options();
$tribunal_header_bg_size = get_theme_mod( 'tribunal_header_bg_size', $tribunal_default['tribunal_header_bg_size'] );
$ed_header_bg_fixed = get_theme_mod( 'ed_header_bg_fixed', $tribunal_default['ed_header_bg_fixed'] );
$ed_header_bg_overlay = get_theme_mod( 'ed_header_bg_overlay', $tribunal_default['ed_header_bg_overlay'] ); ?>

<header id="site-header" class="site-header-layout header-layout-1 <?php if( $ed_header_bg_overlay ){ echo 'header-overlay-enabled'; } ?>" role="banner">
    <div class="header-extras header-extras-top">
        <?php
        // Header AD Area
        tribunal_header_ad();
        ?>
    </div>
    <div class="header-navbar <?php if( get_header_image() ){ if( $ed_header_bg_fixed ){ echo 'data-bg-fixed'; } ?> data-bg data-bg-<?php echo esc_attr( $tribunal_header_bg_size ); ?> <?php } ?> "  <?php if( get_header_image() ){ ?> data-background="<?php echo esc_url(get_header_image()); ?>" <?php } ?>>
        <div class="wrapper">

            <div class="navbar-item navbar-item-left">
                <div class="header-titles">
                    <?php
                    // Site title or logo.
                    tribunal_site_logo();
                    // Site description.
                    tribunal_site_description();
                    ?>
                </div><!-- .header-titles -->
            </div><!-- .navbar-item-left -->

            <div class="navbar-item navbar-item-right">

                <div class="navbar-controls hide-no-js">
                    <?php
                    $ed_header_search = get_theme_mod( 'ed_header_search', $tribunal_default['ed_header_search'] );
                    if( $ed_header_search ){ ?>
                        <button type="button" class="navbar-control button-style button-transparent navbar-control-search"><?php tribunal_the_theme_svg('search'); ?></button>
                    <?php } ?>

                    <button type="button" class="navbar-control button-style button-transparent navbar-control-offcanvas">
                        <span class="menu-label">
                            <?php esc_html_e('Menu', 'tribunal'); ?>
                        </span>
                        <span class="bars">
                            <span class="bar"></span>
                            <span class="bar"></span>
                            <span class="bar"></span>
                        </span>
                    </button>

                </div>

            </div><!-- .navbar-item-right -->

        </div><!-- .header-inner -->
    </div>
    <div class="header-extras header-extras-bottom">
        <?php
        // Header Ticker Posts
        tribunal_header_ticker_posts();
        // Top Tags
        tribunal_top_tages();
        ?>
    </div>
    <?php
    $ed_header_responsive_menu = get_theme_mod('ed_header_responsive_menu', $tribunal_default['ed_header_responsive_menu']);
    ?>

    <div class="header-navigation-wrapper <?php if( $ed_header_responsive_menu ) { echo 'na-responsive-menu'; } ?>">
        <div class="wrapper">
            <nav id="site-navigation" class="main-navigation">
                
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary-menu',
                    'menu_id' => 'primary-menu',
                    'container' => 'div',
                    'container_class' => 'menu'
                )); ?>

            </nav><!-- #site-navigation -->
        </div>
    </div><!-- .header-navigation-wrapper -->

</header><!-- #site-header -->