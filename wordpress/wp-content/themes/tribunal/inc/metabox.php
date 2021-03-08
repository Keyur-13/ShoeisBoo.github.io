<?php
/**
* Sidebar Metabox.
*
* @package Tribunal
*/
 
add_action( 'add_meta_boxes', 'tribunal_metabox' );

if( ! function_exists( 'tribunal_metabox' ) ):


    function  tribunal_metabox() {
        
        add_meta_box(
            'theme-custom-metabox',
            esc_html__( 'Layout Settings', 'tribunal' ),
            'tribunal_post_metafield_callback',
            'post', 
            'normal', 
            'high'
        );
        add_meta_box(
            'theme-custom-metabox',
            esc_html__( 'Layout Settings', 'tribunal' ),
            'tribunal_post_metafield_callback',
            'page',
            'normal', 
            'high'
        ); 
    }

endif;

$tribunal_page_layout_options = array(
    'layout-1' => esc_html__( 'Simple Layout', 'tribunal' ),
    'layout-2' => esc_html__( 'Banner Layout', 'tribunal' ),
);

$tribunal_post_sidebar_fields = array(
    'global-sidebar' => array(
                    'id'        => 'post-global-sidebar',
                    'value' => 'global-sidebar',
                    'label' => esc_html__( 'Global sidebar', 'tribunal' ),
                ),
    'right-sidebar' => array(
                    'id'        => 'post-left-sidebar',
                    'value' => 'right-sidebar',
                    'label' => esc_html__( 'Right sidebar', 'tribunal' ),
                ),
    'left-sidebar' => array(
                    'id'        => 'post-right-sidebar',
                    'value'     => 'left-sidebar',
                    'label'     => esc_html__( 'Left sidebar', 'tribunal' ),
                ),
    'no-sidebar' => array(
                    'id'        => 'post-no-sidebar',
                    'value'     => 'no-sidebar',
                    'label'     => esc_html__( 'No sidebar', 'tribunal' ),
                ),
);

$tribunal_post_layout_options = array(
    'global-layout' => esc_html__( 'Global Layout', 'tribunal' ),
    'layout-1' => esc_html__( 'Simple Layout', 'tribunal' ),
    'layout-2' => esc_html__( 'Banner Layout', 'tribunal' ),
);

$tribunal_header_overlay_options = array(
    'global-layout' => esc_html__( 'Global Layout', 'tribunal' ),
    'enable-overlay' => esc_html__( 'Enable Header Overlay', 'tribunal' ),
);


/**
 * Callback function for post option.
*/
if( ! function_exists( 'tribunal_post_metafield_callback' ) ):
    
    function tribunal_post_metafield_callback() {
        global $post, $tribunal_post_sidebar_fields, $tribunal_post_layout_options,  $tribunal_page_layout_options, $tribunal_header_overlay_options;
        $post_type = get_post_type($post->ID);
        wp_nonce_field( basename( __FILE__ ), 'tribunal_post_meta_nonce' ); ?>
        
        <div class="metabox-main-block">

            <div class="metabox-navbar">
                <ul>

                    <li>
                        <a id="metabox-navbar-general" class="metabox-navbar-active" href="javascript:void(0)">

                            <?php esc_html_e('General Settings', 'tribunal'); ?>

                        </a>
                    </li>

                    <li>
                        <a id="metabox-navbar-appearance" href="javascript:void(0)">

                            <?php esc_html_e('Appearance Settings', 'tribunal'); ?>

                        </a>
                    </li>

                    <?php if( $post_type == 'post' && class_exists('Booster_Extension_Class') ): ?>
                        <li>
                            <a id="twp-tab-booster" href="javascript:void(0)">

                                <?php esc_html_e('Booster Extension Settings', 'tribunal'); ?>

                            </a>
                        </li>
                    <?php endif; ?>

                </ul>
            </div>

            <div class="twp-tab-content">

                <div id="metabox-navbar-general-content" class="metabox-content-wrap metabox-content-wrap-active">

                    <div class="metabox-opt-panel">

                        <h3 class="meta-opt-title"><?php esc_html_e('Sidebar Layout','tribunal'); ?></h3>

                        <div class="metabox-opt-wrap metabox-opt-wrap-alt">

                            <?php
                            $tribunal_post_sidebar = esc_html( get_post_meta( $post->ID, 'tribunal_post_sidebar_option', true ) ); 
                            if( $tribunal_post_sidebar == '' ){ $tribunal_post_sidebar = 'global-sidebar'; }

                            foreach ( $tribunal_post_sidebar_fields as $tribunal_post_sidebar_field) { ?>

                                <label class="description">

                                    <input type="radio" name="tribunal_post_sidebar_option" value="<?php echo esc_attr( $tribunal_post_sidebar_field['value'] ); ?>" <?php if( $tribunal_post_sidebar_field['value'] == $tribunal_post_sidebar ){ echo "checked='checked'";} if( empty( $tribunal_post_sidebar ) && $tribunal_post_sidebar_field['value']=='right-sidebar' ){ echo "checked='checked'"; } ?>/>&nbsp;<?php echo esc_html( $tribunal_post_sidebar_field['label'] ); ?>

                                </label>

                            <?php } ?>

                        </div>

                    </div>

                </div>


                <div id="metabox-navbar-appearance-content" class="metabox-content-wrap">

                    <?php if( $post_type == 'page' ): ?>

                        <div class="metabox-opt-panel">

                            <h3 class="meta-opt-title"><?php esc_html_e('Appearance Layout','tribunal'); ?></h3>

                            <div class="metabox-opt-wrap metabox-opt-wrap-alt">

                                <?php
                                $tribunal_page_layout = esc_html( get_post_meta( $post->ID, 'tribunal_page_layout', true ) ); 
                                if( $tribunal_page_layout == '' ){ $tribunal_page_layout = 'layout-1'; }

                                foreach ( $tribunal_page_layout_options as $key => $tribunal_page_layout_option) { ?>

                                    <label class="description">
                                        <input type="radio" name="tribunal_page_layout" value="<?php echo esc_attr( $key ); ?>" <?php if( $key == $tribunal_page_layout ){ echo "checked='checked'";} ?>/>&nbsp;<?php echo esc_html( $tribunal_page_layout_option ); ?>
                                    </label>

                                <?php } ?>

                            </div>

                        </div>

                        <div class="metabox-opt-panel">

                            <h3 class="meta-opt-title"><?php esc_html_e('Header Overlay','tribunal'); ?></h3>

                            <div class="metabox-opt-wrap theme-checkbox-wrap">

                                <?php
                                $tribunal_ed_header_overlay = esc_attr( get_post_meta( $post->ID, 'tribunal_ed_header_overlay', true ) ); ?>

                                <input type="checkbox" id="tribunal-header-overlay" name="tribunal_ed_header_overlay" value="1" <?php if( $tribunal_ed_header_overlay ){ echo "checked='checked'";} ?>/>

                                <label for="tribunal-header-overlay"><?php esc_html_e( 'Enable Header Overlay','tribunal' ); ?></label>

                            </div>

                        </div>

                    <?php endif; ?>

                    <?php if( $post_type == 'post' ): ?>

                        <div class="metabox-opt-panel">

                            <h3 class="meta-opt-title"><?php esc_html_e('Appearance Layout','tribunal'); ?></h3>

                            <div class="metabox-opt-wrap metabox-opt-wrap-alt">

                                <?php
                                $tribunal_post_layout = esc_html( get_post_meta( $post->ID, 'tribunal_post_layout', true ) ); 
                                if( $tribunal_post_layout == '' ){ $tribunal_post_layout = 'global-layout'; }

                                foreach ( $tribunal_post_layout_options as $key => $tribunal_post_layout_option) { ?>

                                    <label class="description">
                                        <input type="radio" name="tribunal_post_layout" value="<?php echo esc_attr( $key ); ?>" <?php if( $key == $tribunal_post_layout ){ echo "checked='checked'";} ?>/>&nbsp;<?php echo esc_html( $tribunal_post_layout_option ); ?>
                                    </label>

                                <?php } ?>

                            </div>

                        </div>

                        <div class="metabox-opt-panel">

                            <h3 class="meta-opt-title"><?php esc_html_e('Header Overlay','tribunal'); ?></h3>

                            <div class="metabox-opt-wrap metabox-opt-wrap-alt">

                                <?php
                                $tribunal_header_overlay = esc_html( get_post_meta( $post->ID, 'tribunal_header_overlay', true ) ); 
                                if( $tribunal_header_overlay == '' ){ $tribunal_header_overlay = 'global-layout'; }

                                foreach ( $tribunal_header_overlay_options as $key => $tribunal_header_overlay_option) { ?>

                                    <label class="description">
                                        <input type="radio" name="tribunal_header_overlay" value="<?php echo esc_attr( $key ); ?>" <?php if( $key == $tribunal_header_overlay ){ echo "checked='checked'";} ?>/>&nbsp;<?php echo esc_html( $tribunal_header_overlay_option ); ?>
                                    </label>

                                <?php } ?>

                            </div>

                        </div>

                    <?php endif; ?>

                    <div class="metabox-opt-panel">

                        <h3 class="meta-opt-title"><?php esc_html_e('Feature Image Setting','tribunal'); ?></h3>

                        <div class="metabox-opt-wrap theme-checkbox-wrap">

                            <?php
                            $tribunal_ed_feature_image = esc_html( get_post_meta( $post->ID, 'tribunal_ed_feature_image', true ) ); ?>

                            <input type="checkbox" id="tribunal-ed-feature-image" name="tribunal_ed_feature_image" value="1" <?php if( $tribunal_ed_feature_image ){ echo "checked='checked'";} ?>/>

                            <label for="tribunal-ed-feature-image"><?php esc_html_e( 'Disable Feature Image','tribunal' ); ?></label>


                        </div>

                    </div>

                     <div class="metabox-opt-panel">

                        <h3 class="meta-opt-title"><?php esc_html_e('Navigation Setting','tribunal'); ?></h3>

                        <?php $twp_disable_ajax_load_next_post = esc_attr( get_post_meta($post->ID, 'twp_disable_ajax_load_next_post', true) ); ?>
                        <div class="metabox-opt-wrap metabox-opt-wrap-alt">

                            <label><b><?php esc_html_e( 'Navigation Type','tribunal' ); ?></b></label>

                            <select name="twp_disable_ajax_load_next_post">

                                <option <?php if( $twp_disable_ajax_load_next_post == '' || $twp_disable_ajax_load_next_post == 'global-layout' ){ echo 'selected'; } ?> value="global-layout"><?php esc_html_e('Global Layout','tribunal'); ?></option>
                                <option <?php if( $twp_disable_ajax_load_next_post == 'no-navigation' ){ echo 'selected'; } ?> value="no-navigation"><?php esc_html_e('Disable Navigation','tribunal'); ?></option>
                                <option <?php if( $twp_disable_ajax_load_next_post == 'norma-navigation' ){ echo 'selected'; } ?> value="norma-navigation"><?php esc_html_e('Next Previous Navigation','tribunal'); ?></option>
                                <option <?php if( $twp_disable_ajax_load_next_post == 'ajax-next-post-load' ){ echo 'selected'; } ?> value="ajax-next-post-load"><?php esc_html_e('Ajax Load Next 3 Posts Contents','tribunal'); ?></option>

                            </select>

                        </div>
                    </div>

                </div>

                <?php if( $post_type == 'post' && class_exists('Booster_Extension_Class') ):

                    
                    $tribunal_ed_post_views = esc_html( get_post_meta( $post->ID, 'tribunal_ed_post_views', true ) );
                    $tribunal_ed_post_read_time = esc_html( get_post_meta( $post->ID, 'tribunal_ed_post_read_time', true ) );
                    $tribunal_ed_post_like_dislike = esc_html( get_post_meta( $post->ID, 'tribunal_ed_post_like_dislike', true ) );
                    $tribunal_ed_post_author_box = esc_html( get_post_meta( $post->ID, 'tribunal_ed_post_author_box', true ) );
                    $tribunal_ed_post_social_share = esc_html( get_post_meta( $post->ID, 'tribunal_ed_post_social_share', true ) );
                    $tribunal_ed_post_reaction = esc_html( get_post_meta( $post->ID, 'tribunal_ed_post_reaction', true ) );
                    $tribunal_ed_post_rating = esc_html( get_post_meta( $post->ID, 'tribunal_ed_post_rating', true ) );
                    ?>

                    <div id="twp-tab-booster-content" class="metabox-content-wrap">

                        <div class="metabox-opt-panel">

                            <h3 class="meta-opt-title"><?php esc_html_e('Booster Extension Plugin Content','tribunal'); ?></h3>

                            <div class="metabox-opt-wrap theme-checkbox-wrap">

                                    <input type="checkbox" id="tribunal-ed-post-views" name="tribunal_ed_post_views" value="1" <?php if( $tribunal_ed_post_views ){ echo "checked='checked'";} ?>/>
                                    <label for="tribunal-ed-post-views"><?php esc_html_e( 'Disable Post Views','tribunal' ); ?></label>

                            </div>

                            <div class="metabox-opt-wrap theme-checkbox-wrap">

                                    <input type="checkbox" id="tribunal-ed-post-read-time" name="tribunal_ed_post_read_time" value="1" <?php if( $tribunal_ed_post_read_time ){ echo "checked='checked'";} ?>/>
                                    <label for="tribunal-ed-post-read-time"><?php esc_html_e( 'Disable Post Read Time','tribunal' ); ?></label>

                            </div>

                            <div class="metabox-opt-wrap theme-checkbox-wrap">

                                    <input type="checkbox" id="tribunal-ed-post-like-dislike" name="tribunal_ed_post_like_dislike" value="1" <?php if( $tribunal_ed_post_like_dislike ){ echo "checked='checked'";} ?>/>
                                    <label for="tribunal-ed-post-like-dislike"><?php esc_html_e( 'Disable Post Like Dislike','tribunal' ); ?></label>

                            </div>

                            <div class="metabox-opt-wrap theme-checkbox-wrap">

                                    <input type="checkbox" id="tribunal-ed-post-author-box" name="tribunal_ed_post_author_box" value="1" <?php if( $tribunal_ed_post_author_box ){ echo "checked='checked'";} ?>/>
                                    <label for="tribunal-ed-post-author-box"><?php esc_html_e( 'Disable Post Author Box','tribunal' ); ?></label>

                            </div>

                            <div class="metabox-opt-wrap theme-checkbox-wrap">

                                    <input type="checkbox" id="tribunal-ed-post-social-share" name="tribunal_ed_post_social_share" value="1" <?php if( $tribunal_ed_post_social_share ){ echo "checked='checked'";} ?>/>
                                    <label for="tribunal-ed-post-social-share"><?php esc_html_e( 'Disable Post Social Share','tribunal' ); ?></label>

                            </div>

                            <div class="metabox-opt-wrap theme-checkbox-wrap">

                                    <input type="checkbox" id="tribunal-ed-post-reaction" name="tribunal_ed_post_reaction" value="1" <?php if( $tribunal_ed_post_reaction ){ echo "checked='checked'";} ?>/>
                                    <label for="tribunal-ed-post-reaction"><?php esc_html_e( 'Disable Post Reaction','tribunal' ); ?></label>

                            </div>

                            <div class="metabox-opt-wrap theme-checkbox-wrap">

                                    <input type="checkbox" id="tribunal-ed-post-rating" name="tribunal_ed_post_rating" value="1" <?php if( $tribunal_ed_post_rating ){ echo "checked='checked'";} ?>/>
                                    <label for="tribunal-ed-post-rating"><?php esc_html_e( 'Disable Post Rating','tribunal' ); ?></label>

                            </div>

                        </div>

                    </div>

                <?php endif; ?>
                
            </div>

        </div>  
            
    <?php }
endif;

// Save metabox value.
add_action( 'save_post', 'tribunal_save_post_meta' );

if( ! function_exists( 'tribunal_save_post_meta' ) ):

    function tribunal_save_post_meta( $post_id ) {

        global $post, $tribunal_post_sidebar_fields, $tribunal_post_layout_options, $tribunal_header_overlay_options,  $tribunal_page_layout_options;

        if ( !isset( $_POST[ 'tribunal_post_meta_nonce' ] ) || !wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['tribunal_post_meta_nonce'] ) ), basename( __FILE__ ) ) ){

            return;

        }

        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ){

            return;

        }
            
        if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {  

            if ( !current_user_can( 'edit_page', $post_id ) ){  

                return $post_id;

            }

        }elseif( !current_user_can( 'edit_post', $post_id ) ) {

            return $post_id;

        }


        foreach ( $tribunal_post_sidebar_fields as $tribunal_post_sidebar_field ) {  
            

                $old = esc_html( get_post_meta( $post_id, 'tribunal_post_sidebar_option', true ) ); 
                $new = tribunal_sanitize_sidebar_option_meta( wp_unslash( $_POST['tribunal_post_sidebar_option'] ) );

                if ( $new && $new != $old ){

                    update_post_meta ( $post_id, 'tribunal_post_sidebar_option', $new );

                }elseif( '' == $new && $old ) {

                    delete_post_meta( $post_id,'tribunal_post_sidebar_option', $old );

                }

            
        }

            $twp_disable_ajax_load_next_post_old = esc_html( get_post_meta( $post_id, 'twp_disable_ajax_load_next_post', true ) ); 
            $twp_disable_ajax_load_next_post_new = tribunal_sanitize_meta_pagination( wp_unslash( $_POST['twp_disable_ajax_load_next_post'] ) );
            if( $twp_disable_ajax_load_next_post_new && $twp_disable_ajax_load_next_post_new != $twp_disable_ajax_load_next_post_old ){

                update_post_meta ( $post_id, 'twp_disable_ajax_load_next_post', $twp_disable_ajax_load_next_post_new );

            }elseif( '' == $twp_disable_ajax_load_next_post_new && $twp_disable_ajax_load_next_post_old ) {

                delete_post_meta( $post_id,'twp_disable_ajax_load_next_post', $twp_disable_ajax_load_next_post_old );

            }


            foreach ( $tribunal_post_layout_options as $tribunal_post_layout_option ) {  
                
                $tribunal_post_layout_old = esc_html( get_post_meta( $post_id, 'tribunal_post_layout', true ) ); 
                $tribunal_post_layout_new = tribunal_sanitize_post_layout_option_meta( wp_unslash( $_POST['tribunal_post_layout'] ) );

                if ( $tribunal_post_layout_new && $tribunal_post_layout_new != $tribunal_post_layout_old ){

                    update_post_meta ( $post_id, 'tribunal_post_layout', $tribunal_post_layout_new );

                }elseif( '' == $tribunal_post_layout_new && $tribunal_post_layout_old ) {

                    delete_post_meta( $post_id,'tribunal_post_layout', $tribunal_post_layout_old );

                }
                
            }



            foreach ( $tribunal_header_overlay_options as $tribunal_header_overlay_option ) {  
                
                $tribunal_header_overlay_old = esc_html( get_post_meta( $post_id, 'tribunal_header_overlay', true ) ); 
                $tribunal_header_overlay_new = tribunal_sanitize_header_overlay_option_meta( wp_unslash( $_POST['tribunal_header_overlay'] ) );

                if ( $tribunal_header_overlay_new && $tribunal_header_overlay_new != $tribunal_header_overlay_old ){

                    update_post_meta ( $post_id, 'tribunal_header_overlay', $tribunal_header_overlay_new );

                }elseif( '' == $tribunal_header_overlay_new && $tribunal_header_overlay_old ) {

                    delete_post_meta( $post_id,'tribunal_header_overlay', $tribunal_header_overlay_old );

                }
                
            }



            $tribunal_ed_feature_image_old = esc_html( get_post_meta( $post_id, 'tribunal_ed_feature_image', true ) ); 
            $tribunal_ed_feature_image_new = absint( wp_unslash( $_POST['tribunal_ed_feature_image'] ) );

            if ( $tribunal_ed_feature_image_new && $tribunal_ed_feature_image_new != $tribunal_ed_feature_image_old ){

                update_post_meta ( $post_id, 'tribunal_ed_feature_image', $tribunal_ed_feature_image_new );

            }elseif( '' == $tribunal_ed_feature_image_new && $tribunal_ed_feature_image_old ) {

                delete_post_meta( $post_id,'tribunal_ed_feature_image', $tribunal_ed_feature_image_old );

            }



            $tribunal_ed_post_views_old = esc_html( get_post_meta( $post_id, 'tribunal_ed_post_views', true ) ); 
            $tribunal_ed_post_views_new = absint( wp_unslash( $_POST['tribunal_ed_post_views'] ) );

            if ( $tribunal_ed_post_views_new && $tribunal_ed_post_views_new != $tribunal_ed_post_views_old ){

                update_post_meta ( $post_id, 'tribunal_ed_post_views', $tribunal_ed_post_views_new );

            }elseif( '' == $tribunal_ed_post_views_new && $tribunal_ed_post_views_old ) {

                delete_post_meta( $post_id,'tribunal_ed_post_views', $tribunal_ed_post_views_old );

            }



            $tribunal_ed_post_read_time_old = esc_html( get_post_meta( $post_id, 'tribunal_ed_post_read_time', true ) ); 
            $tribunal_ed_post_read_time_new = absint( wp_unslash( $_POST['tribunal_ed_post_read_time'] ) );

            if ( $tribunal_ed_post_read_time_new && $tribunal_ed_post_read_time_new != $tribunal_ed_post_read_time_old ){

                update_post_meta ( $post_id, 'tribunal_ed_post_read_time', $tribunal_ed_post_read_time_new );

            }elseif( '' == $tribunal_ed_post_read_time_new && $tribunal_ed_post_read_time_old ) {

                delete_post_meta( $post_id,'tribunal_ed_post_read_time', $tribunal_ed_post_read_time_old );

            }



            $tribunal_ed_post_like_dislike_old = esc_html( get_post_meta( $post_id, 'tribunal_ed_post_like_dislike', true ) ); 
            $tribunal_ed_post_like_dislike_new = absint( wp_unslash( $_POST['tribunal_ed_post_like_dislike'] ) );

            if ( $tribunal_ed_post_like_dislike_new && $tribunal_ed_post_like_dislike_new != $tribunal_ed_post_like_dislike_old ){

                update_post_meta ( $post_id, 'tribunal_ed_post_like_dislike', $tribunal_ed_post_like_dislike_new );

            }elseif( '' == $tribunal_ed_post_like_dislike_new && $tribunal_ed_post_like_dislike_old ) {

                delete_post_meta( $post_id,'tribunal_ed_post_like_dislike', $tribunal_ed_post_like_dislike_old );

            }



            $tribunal_ed_post_author_box_old = esc_html( get_post_meta( $post_id, 'tribunal_ed_post_author_box', true ) ); 
            $tribunal_ed_post_author_box_new = absint( wp_unslash( $_POST['tribunal_ed_post_author_box'] ) );

            if ( $tribunal_ed_post_author_box_new && $tribunal_ed_post_author_box_new != $tribunal_ed_post_author_box_old ){

                update_post_meta ( $post_id, 'tribunal_ed_post_author_box', $tribunal_ed_post_author_box_new );

            }elseif( '' == $tribunal_ed_post_author_box_new && $tribunal_ed_post_author_box_old ) {

                delete_post_meta( $post_id,'tribunal_ed_post_author_box', $tribunal_ed_post_author_box_old );

            }



            $tribunal_ed_post_social_share_old = esc_html( get_post_meta( $post_id, 'tribunal_ed_post_social_share', true ) ); 
            $tribunal_ed_post_social_share_new = absint( wp_unslash( $_POST['tribunal_ed_post_social_share'] ) );

            if ( $tribunal_ed_post_social_share_new && $tribunal_ed_post_social_share_new != $tribunal_ed_post_social_share_old ){

                update_post_meta ( $post_id, 'tribunal_ed_post_social_share', $tribunal_ed_post_social_share_new );

            }elseif( '' == $tribunal_ed_post_social_share_new && $tribunal_ed_post_social_share_old ) {

                delete_post_meta( $post_id,'tribunal_ed_post_social_share', $tribunal_ed_post_social_share_old );

            }



            $tribunal_ed_post_reaction_old = esc_html( get_post_meta( $post_id, 'tribunal_ed_post_reaction', true ) ); 
            $tribunal_ed_post_reaction_new = absint( wp_unslash( $_POST['tribunal_ed_post_reaction'] ) );

            if ( $tribunal_ed_post_reaction_new && $tribunal_ed_post_reaction_new != $tribunal_ed_post_reaction_old ){

                update_post_meta ( $post_id, 'tribunal_ed_post_reaction', $tribunal_ed_post_reaction_new );

            }elseif( '' == $tribunal_ed_post_reaction_new && $tribunal_ed_post_reaction_old ) {

                delete_post_meta( $post_id,'tribunal_ed_post_reaction', $tribunal_ed_post_reaction_old );

            }



            $tribunal_ed_post_rating_old = esc_html( get_post_meta( $post_id, 'tribunal_ed_post_rating', true ) ); 
            $tribunal_ed_post_rating_new = absint( wp_unslash( $_POST['tribunal_ed_post_rating'] ) );

            if ( $tribunal_ed_post_rating_new && $tribunal_ed_post_rating_new != $tribunal_ed_post_rating_old ){

                update_post_meta ( $post_id, 'tribunal_ed_post_rating', $tribunal_ed_post_rating_new );

            }elseif( '' == $tribunal_ed_post_rating_new && $tribunal_ed_post_rating_old ) {

                delete_post_meta( $post_id,'tribunal_ed_post_rating', $tribunal_ed_post_rating_old );

            }

            foreach ( $tribunal_page_layout_options as $tribunal_post_layout_option ) {  
            
                $tribunal_page_layout_old = sanitize_text_field( get_post_meta( $post_id, 'tribunal_page_layout', true ) ); 
                $tribunal_page_layout_new = tribunal_sanitize_post_layout_option_meta( wp_unslash( $_POST['tribunal_page_layout'] ) );

                if ( $tribunal_page_layout_new && $tribunal_page_layout_new != $tribunal_page_layout_old ){

                    update_post_meta ( $post_id, 'tribunal_page_layout', $tribunal_page_layout_new );

                }elseif( '' == $tribunal_page_layout_new && $tribunal_page_layout_old ) {

                    delete_post_meta( $post_id,'tribunal_page_layout', $tribunal_page_layout_old );

                }
                
            }

            $tribunal_ed_header_overlay_old = absint( get_post_meta( $post_id, 'tribunal_ed_header_overlay', true ) ); 
            $tribunal_ed_header_overlay_new = absint( wp_unslash( $_POST['tribunal_ed_header_overlay'] ) );

            if ( $tribunal_ed_header_overlay_new && $tribunal_ed_header_overlay_new != $tribunal_ed_header_overlay_old ){

                update_post_meta ( $post_id, 'tribunal_ed_header_overlay', $tribunal_ed_header_overlay_new );

            }elseif( '' == $tribunal_ed_header_overlay_new && $tribunal_ed_header_overlay_old ) {

                delete_post_meta( $post_id,'tribunal_ed_header_overlay', $tribunal_ed_header_overlay_old );

            }


    }

endif;   