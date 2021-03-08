<?php
/**
 * The template for displaying the footer
 *
 * Contains the opening of the #site-footer div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Tribunal
 * @since 1.0.0
 */
?>

<?php
/**
 * Toogle Contents
 * @hooked tribunal_header_toggle_search - 10
 * @hooked tribunal_content_gallery - 20
 * @hooked tribunal_content_offcanvas - 30
 * @hooked tribunal_footer_affix_posts - 40
*/

do_action('tribunal_before_footer_content_action'); ?>

</div>
<footer id="site-footer" role="contentinfo">

    <?php
    /**
     * Footer Content
     * @hooked tribunal_footer_content_widget - 10
     * @hooked tribunal_footer_content_info - 20
     * @hooked tribunal_footer_go_to_top - 30
    */

    do_action('tribunal_footer_content_action'); ?>

    

</footer>
<?php wp_footer(); ?>
</body>
</html>
