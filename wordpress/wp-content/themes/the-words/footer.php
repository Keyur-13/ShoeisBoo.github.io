<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package The_Words
 */

    /**
     * the_words_single_related_post - 10
     * the_words_subescribe - 20
     * the_words_instagram - 30
    **/
    do_action('the_words_footer_content','the_words_subescribe');
    ?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" itemscope itemtype="http://schema.org/WPFooter">

        <?php
        $ed_footer_social_icon = get_theme_mod('ed_footer_social_icon',1);
        $footer_background_image = get_theme_mod('footer_background_image');
        if( 
        	is_active_sidebar('the-words-footer-1') || 
            is_active_sidebar('the-words-footer-2') || 
            is_active_sidebar('the-words-footer-3') || 
        	$ed_footer_social_icon){
            echo '<div class="top-footer" style="background-image:url('.esc_url( $footer_background_image ).')">';
            echo '<div class="ta-container clearfix">';

            if( has_nav_menu('the-words-footer-menu') ):

            	echo '<div class="ta-footer-menu">';
	            wp_nav_menu( array(
					'theme_location' => 'the-words-footer-menu',
					'menu_id'        => 'footer-menu',
					'depth'			 => 1,
				) );
				echo '</div>';

	        endif;

			if( $ed_footer_social_icon ){
				echo '<div class="ta-footer-social-icon">';
				do_action('the_words_social_icon_action');
				echo '</div>';
			}

            if( is_active_sidebar('the-words-footer-1') || is_active_sidebar('the-words-footer-2') || is_active_sidebar('the-words-footer-3') ){

    			echo '<div class="footer-widget-area">';
                for ($x = 0; $x <= 3; $x++) {
                    if( is_active_sidebar('the-words-footer-'.$x) ){

                        echo '<div id="ta-footer-widget-'.$x.'" class="ta-footer-widget">';
                            dynamic_sidebar('the-words-footer-'.$x);
                        echo '</div>';

                    }
                }
            }
            echo '</div>';
            echo '</div>';
            echo '</div>';

        } ?>

        <div class="bottom-footer">
            <div class="ta-container">
        		<div class="site-info">

        			<?php
        			$footer_copyright_text = get_theme_mod( 'footer_copyright_text',esc_html__( 'Copyright All rights reserved', 'the-words' ) );
        			?>
        			<div class="footer-copyright">
                        <span class="copyright-text"><?php echo esc_html( $footer_copyright_text ); ?></span>
            			<span class="sep"> | </span>
            			<?php printf( esc_html__( 'The Words - By %1$s.', 'the-words' ), '<a target="_blank" href="'.esc_url( 'https://themesarray.com' ).'" rel="designer">'.esc_html__('Themesarray', 'the-words').'</a>' ); ?>
    	           </div><!-- .site-info -->

        		</div><!-- .site-info -->
            </div>
        </div>

	</footer><!-- #colophon -->

</div><!-- #page -->

<?php $ed_footer_go_top_button = get_theme_mod('ed_footer_go_top_button',1);
    if( $ed_footer_go_top_button ){ ?>

    <span id="ta-go-top" class="ta-off"><i class="fa fa-angle-up" aria-hidden="true"></i></span>

<?php } ?>

<div id="dynamic-css"></div>

<?php wp_footer(); ?>

</body>
</html>
