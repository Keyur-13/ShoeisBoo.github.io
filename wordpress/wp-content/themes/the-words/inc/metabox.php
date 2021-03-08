<?php
/**
 * Create a metabox to added some custom filed in posts.
 *
 * @package The Words
 */

 add_action( 'add_meta_boxes', 'the_words_post_meta_options' );
 
 if( ! function_exists( 'the_words_post_meta_options' ) ):
 function  the_words_post_meta_options() {
    add_meta_box(
                'the_words_post_meta',
                esc_html__( 'Sidebar Layouts', 'the-words' ),
                'the_words_post_meta_callback',
                'post', 
                'normal', 
                'high'
            );
            add_meta_box(
                'the_words_page_meta',
                esc_html__( 'Sidebar', 'the-words' ),
                'the_words_post_meta_callback',
                'page',
                'normal', 
                'high'
            ); 
 }
 endif;

 $the_words_post_sidebar_options = array(
        'global' => array(
                        'label'     => esc_html__( 'Global sidebar', 'the-words' ),
                        'thumbnail' => get_template_directory_uri() . '/assets/images/both-sidebar.png'
                    ), 
        'left-sidebar' => array(
                        'label'     => esc_html__( 'Left sidebar', 'the-words' ),
                        'thumbnail' => get_template_directory_uri() . '/assets/images/left-sidebar.png'
                    ), 
        'right-sidebar' => array(
                        'label' => esc_html__( 'Right sidebar', 'the-words' ),
                        'thumbnail' => get_template_directory_uri() . '/assets/images/right-sidebar.png'
                    ),
        'no-sidebar' => array(
                        'label'     => esc_html__( 'No sidebar', 'the-words' ),
                        'thumbnail' => get_template_directory_uri() . '/assets/images/no-sidebar.png'
                    ),
    );

/**
 * Callback function for post option
 */
if( ! function_exists( 'the_words_post_meta_callback' ) ):

    function the_words_post_meta_callback() {

        global $post, $the_words_post_sidebar_options;

        wp_nonce_field( basename( __FILE__ ), 'the_words_post_meta_nonce' );
        ?>

        <table class="form-table">
            <tr>
                <td colspan="4"><em class="f13"><?php esc_html_e('Choose Sidebar Template','the-words'); ?></em></td>
            </tr>

            <tr>
                <td>
                    <?php
                    $the_words_post_sidebar = get_post_meta( $post->ID, 'the_words_post_sidebar_layout', true );
                    if( empty( $the_words_post_sidebar ) ){ $the_words_post_sidebar = 'global'; }
                    foreach ($the_words_post_sidebar_options as $key => $the_words_post_sidebar_option) { ?>

                    <div class="radio-image-wrapper" style="float:left; margin-right:30px;">

                        <label class="description">

                            <span><img src="<?php echo esc_url( $the_words_post_sidebar_option['thumbnail'] ); ?>" alt="" /></span></br>

                            <input type="radio" name="the_words_post_sidebar_layout" value="<?php echo esc_attr( $key ); ?>" <?php checked( $key, $the_words_post_sidebar ); ?>/>&nbsp;<?php echo esc_html( $the_words_post_sidebar_option['label'] ); ?>

                        </label>

                    </div>

                    <?php } // end foreach ?>

                    <div class="clear"></div>

                </td>
            </tr>

        </table>
        <?php       
    }
endif;

/*--------------------------------------------------------------------------------------------------------------*/
/**
 * Function for save value of meta opitons
 *
 * @since 1.0.0
 */
add_action( 'save_post', 'the_words_save_post_meta' );

if( ! function_exists( 'the_words_save_post_meta' ) ):

function the_words_save_post_meta( $post_id ) {

    global $post, $the_words_post_sidebar_options;

    // Verify the nonce before proceeding.
    if ( !isset( $_POST[ 'the_words_post_meta_nonce' ] ) || !wp_verify_nonce( wp_unslash($_POST['the_words_post_meta_nonce'] ), basename( __FILE__ ) ) )
        return;

    // Stop WP from clearing custom fields on autosave
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
        return;
        
    if ('page' == $_POST['post_type']) {  
        if (!current_user_can( 'edit_page', $post_id ) )
            return $post_id;  
    } elseif (!current_user_can( 'edit_post', $post_id ) ) {
            return $post_id;  
    }

    /*Page sidebar*/

    $old = the_words_meta_sidebar( get_post_meta( $post_id, 'the_words_post_sidebar_layout', true ) ); 
    $new = the_words_meta_sidebar( wp_unslash( $_POST['the_words_post_sidebar_layout'] ));

    if ( $new && $new != $old ) {

        update_post_meta ( $post_id, 'the_words_post_sidebar_layout', $new );

    } elseif ( '' == $new && $old ) {

        delete_post_meta( $post_id,'the_words_post_sidebar_layout', $old );

    }
}
endif;  