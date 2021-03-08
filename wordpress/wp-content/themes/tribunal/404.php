<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Tribunal
 */

get_header();
?>
    <div class="singular-main-block">
        <div class="theme-block error-block error-block-heading">
            <div class="wrapper">
                <header class="page-header">
                    <h1 class="page-title"><?php esc_html_e('Oops! That page can&rsquo;t be found.', 'tribunal'); ?></h1>
                </header><!-- .page-header -->
            </div>
        </div>
        <div class="theme-block error-block error-block-search">
            <div class="wrapper">
                <div class="column-row">
                    <div class="column column-8 column-sm-12">
                        <?php get_search_form(); ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="theme-block error-block error-block-top">
            <div class="wrapper">
                <div class="column-row">
                    <div class="column column-12">
                        <h2><?php esc_html_e('Maybe it’s out there, somewhere...', 'tribunal'); ?></h2>
                        <p><?php esc_html_e('You can always find insightful stories on our', 'tribunal'); ?>
                        <a href="<?php echo esc_url( home_url() ); ?>"><?php esc_html_e('Homepage','tribunal'); ?></a></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="theme-block error-block error-block-middle theme-block-nobottom">
            <div class="wrapper">
                <div class="column-row">
                    <div class="column column-12">
                        <h2><?php esc_html_e('Still feeling lost? You’re not alone.', 'tribunal'); ?></h2>
                        <p><?php esc_html_e('Enjoy these stories about getting lost, losing things, and finding what you never knew you were looking for.', 'tribunal'); ?></p>
                    </div>
                </div>
            </div>
        </div>

        <?php
        tribunal_404_posts();
        ?>


    </div>

<?php
get_footer();
