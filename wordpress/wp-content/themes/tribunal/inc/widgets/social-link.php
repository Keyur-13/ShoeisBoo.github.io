<?php
/**
 * Social Link Widgets.
 *
 * @package Tribunal
 */

if ( !function_exists('tribunal_social_link_widget') ) :
    /**
     * Load widgets.
     *
     * @since 1.0.0
     */
    function tribunal_social_link_widget(){

        // Social Link Widget.
        register_widget('Tribunal_Social_Link_widget');

    }
endif;
add_action('widgets_init', 'tribunal_social_link_widget');


/*Social widget*/
if ( !class_exists( 'Tribunal_Social_Link_widget' ))  :

    /**
     * Social widget Class.
     *
     * @since 1.0.0
     */
    class Tribunal_Social_Link_widget extends Tribunal_Widget_Base
    {

        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $opts = array(
                'classname' => 'tribunal_social_widget',
                'description' => esc_html__('Displays Social share.', 'tribunal'),
                'customize_selective_refresh' => true,
            );
            $fields = array(
                'title' => array(
                    'label' => esc_html__('Title:', 'tribunal'),
                    'type' => 'text',
                    'class' => 'widefat',
                ),
                'url-fb' => array(
                   'label' => esc_html__('Facebook URL:', 'tribunal'),
                   'type' => 'url',
                   'class' => 'widefat',
                    ),
                'url-tw' => array(
                   'label' => esc_html__('Twitter URL:', 'tribunal'),
                   'type' => 'url',
                   'class' => 'widefat',
                    ),
                'url-lt' => array(
                   'label' => esc_html__('Linkedin URL:', 'tribunal'),
                   'type' => 'url',
                   'class' => 'widefat',
                    ),
                'url-ig' => array(
                   'label' => esc_html__('Instagram URL:', 'tribunal'),
                   'type' => 'url',
                   'class' => 'widefat',
                    ),
                'url-pt' => array(
                   'label' => esc_html__('Pinterest URL:', 'tribunal'),
                   'type' => 'url',
                   'class' => 'widefat',
                    ),
                'url-rt' => array(
                   'label' => esc_html__('Reddit URL:', 'tribunal'),
                   'type' => 'url',
                   'class' => 'widefat',
                    ),
                'url-sk' => array(
                   'label' => esc_html__('Skype URL:', 'tribunal'),
                   'type' => 'url',
                   'class' => 'widefat',
                    ),
                'url-sc' => array(
                   'label' => esc_html__('Snapchat URL:', 'tribunal'),
                   'type' => 'url',
                   'class' => 'widefat',
                    ),
                'url-tr' => array(
                   'label' => esc_html__('Tumblr URL:', 'tribunal'),
                   'type' => 'url',
                   'class' => 'widefat',
                    ),
                'url-th' => array(
                   'label' => esc_html__('Twitch URL:', 'tribunal'),
                   'type' => 'url',
                   'class' => 'widefat',
                    ),
                'url-yt' => array(
                   'label' => esc_html__('Youtube URL:', 'tribunal'),
                   'type' => 'url',
                   'class' => 'widefat',
                    ),
                'url-vo' => array(
                   'label' => esc_html__('Vimeo URL:', 'tribunal'),
                   'type' => 'url',
                   'class' => 'widefat',
                    ),
                'url-wa' => array(
                   'label' => esc_html__('Whatsapp URL:', 'tribunal'),
                   'type' => 'url',
                   'class' => 'widefat',
                    ),
                'url-wp' => array(
                   'label' => esc_html__('WordPress URL:', 'tribunal'),
                   'type' => 'url',
                   'class' => 'widefat',
                    ),
                'url-gh' => array(
                   'label' => esc_html__('Github URL:', 'tribunal'),
                   'type' => 'url',
                   'class' => 'widefat',
                    ),
                'url-fs' => array(
                   'label' => esc_html__('FourSquare URL:', 'tribunal'),
                   'type' => 'url',
                   'class' => 'widefat',
                    ),
                'url-db' => array(
                   'label' => esc_html__('Dribbble URL:', 'tribunal'),
                   'type' => 'url',
                   'class' => 'widefat',
                    ),
                'url-vk' => array(
                   'label' => esc_html__('VK URL:', 'tribunal'),
                   'type' => 'url',
                   'class' => 'widefat',
                    ),
            );

            parent::__construct( 'tribunal-social-layout', esc_html__('Tribunal: Social Widget', 'tribunal'), $opts, array(), $fields );
        }

        /**
         * Outputs the content for the current widget instance.
         *
         * @since 1.0.0
         *
         * @param array $args Display arguments.
         * @param array $instance Settings for the current widget instance.
         */
        function widget( $args, $instance )
        {

            $params = $this->get_params( $instance );

            echo $args['before_widget'];

            if ( ! empty( $params['title'] ) ) {
              echo $args['before_title'] . esc_html( $params['title'] ) . $args['after_title'];
            } ?>

            <div class="theme-social-widget">
                <ul class="social-widget-list">

                    <?php if ( !empty( $params['url-fb'] ) ) { ?>
                        <li>
                            <a href="<?php echo esc_url($params['url-fb']); ?>" target="_blank"><i class="ion ion-logo-facebook"></i></a>
                        </li>
                    <?php } ?>

                    <?php if ( !empty( $params['url-tw'] ) ) { ?>
                        <li>
                            <a href="<?php echo esc_url($params['url-tw']); ?>" target="_blank"><i class="ion ion-logo-twitter"></i></a>
                        </li>
                    <?php } ?>

                    <?php if ( !empty( $params['url-lt'] ) ) { ?>
                        <li>
                            <a href="<?php echo esc_url($params['url-lt']); ?>" target="_blank"><i class="ion ion-logo-linkedin"></i></a>
                        </li>
                    <?php } ?>

                    <?php if ( !empty( $params['url-ig'] ) ) { ?>
                        <li>
                            <a href="<?php echo esc_url($params['url-ig']); ?>" target="_blank"><i class="ion ion-logo-instagram"></i></a>
                        </li>
                    <?php } ?>

                    <?php if ( !empty( $params['url-pt'] ) ) { ?>
                        <li>
                            <a href="<?php echo esc_url($params['url-pt']); ?>" target="_blank"><i class="ion ion-logo-pinterest"></i></a>
                        </li>
                    <?php } ?>

                    <?php if ( !empty( $params['url-rt'] ) ) { ?>
                        <li>
                            <a href="<?php echo esc_url($params['url-rt']); ?>" target="_blank"><i class="ion ion-logo-reddit"></i></a>
                        </li>
                    <?php } ?>

                    <?php if ( !empty( $params['url-sk'] ) ) { ?>
                        <li>
                            <a href="<?php echo esc_url($params['url-sk']); ?>" target="_blank"><i class="ion ion-logo-skype"></i></a>
                        </li>
                    <?php } ?>

                    <?php if ( !empty( $params['url-sc'] ) ) { ?>
                        <li>
                            <a href="<?php echo esc_url($params['url-sc']); ?>" target="_blank"><i class="ion ion-logo-snapchat"></i></a>
                        </li>
                    <?php } ?>

                    <?php if ( !empty( $params['url-tr'] ) ) { ?>
                        <li>
                            <a href="<?php echo esc_url($params['url-tr']); ?>" target="_blank"><i class="ion ion-logo-tumblr"></i></a>
                        </li>
                    <?php } ?>

                    <?php if ( !empty( $params['url-th'] ) ) { ?>
                        <li>
                            <a href="<?php echo esc_url($params['url-th']); ?>" target="_blank"><i class="ion ion-logo-twitch"></i></a>
                        </li>
                    <?php } ?>

                    <?php if ( !empty( $params['url-yt'] ) ) { ?>
                        <li>
                            <a href="<?php echo esc_url($params['url-yt']); ?>" target="_blank"><i class="ion ion-logo-youtube"></i></a>
                        </li>
                    <?php } ?>

                    <?php if ( !empty( $params['url-vo'] ) ) { ?>
                        <li>
                            <a href="<?php echo esc_url($params['url-vo']); ?>" target="_blank"><i class="ion ion-logo-vimeo"></i></a>
                        </li>
                    <?php } ?>

                    <?php if ( !empty( $params['url-wa'] ) ) { ?>
                        <li>
                            <a href="<?php echo esc_url($params['url-wa']); ?>" target="_blank"><i class="ion ion-logo-whatsapp"></i></a>
                        </li>
                    <?php } ?>

                    <?php if ( !empty( $params['url-wp'] ) ) { ?>
                        <li>
                            <a href="<?php echo esc_url($params['url-wp']); ?>" target="_blank"><i class="ion ion-logo-wordpress"></i></a>
                        </li>
                    <?php } ?>

                    <?php if ( !empty( $params['url-gh'] ) ) { ?>
                        <li>
                            <a href="<?php echo esc_url($params['url-gh']); ?>" target="_blank"><i class="ion ion-logo-github"></i></a>
                        </li>
                    <?php } ?>

                    <?php if ( !empty( $params['url-fs'] ) ) { ?>
                        <li>
                            <a href="<?php echo esc_url($params['url-fs']); ?>" target="_blank"><i class="ion ion-logo-foursquare"></i></a>
                        </li>
                    <?php } ?>

                    <?php if ( !empty( $params['url-db'] ) ) { ?>
                        <li>
                            <a href="<?php echo esc_url($params['url-db']); ?>" target="_blank"><i class="ion ion-logo-dribbble"></i></a>
                        </li>
                    <?php } ?>

                    <?php if ( !empty( $params['url-vk'] ) ) { ?>
                        <li>
                            <a href="<?php echo esc_url($params['url-vk']); ?>" target="_blank"><i class="ion ion-logo-vk"></i></a>
                        </li>
                    <?php } ?>

                </ul>
            </div>
            <?php echo $args['after_widget'];
        }
    }
endif;
