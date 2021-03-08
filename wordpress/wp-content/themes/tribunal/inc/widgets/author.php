<?php
/**
 * Author Widgets.
 *
 * @package Tribunal
 */
if ( !function_exists('tribunal_author_widgets') ) :
    /**
     * Load widgets.
     *
     * @since 1.0.0
     */
    function tribunal_author_widgets(){
        // Auther widget.
        register_widget('Tribunal_Author_widget');
    }
endif;
add_action('widgets_init', 'tribunal_author_widgets');
/*Video widget*/
if ( !class_exists('Tribunal_Author_widget') ) :
    /**
     * Author widget Class.
     *
     * @since 1.0.0
     */
    class Tribunal_Author_widget extends Tribunal_Widget_Base
    {
        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $opts = array(
                'classname' => 'tribunal_author_widget',
                'description' => esc_html__('Displays authors details in post.', 'tribunal'),
                'customize_selective_refresh' => true,
            );
            $fields = array(
                'title' => array(
                    'label' => esc_html__('Title:', 'tribunal'),
                    'type' => 'text',
                    'class' => 'widefat',
                ),
                'image_bg_url' => array(
                    'label' => esc_html__('Widget Background Image:', 'tribunal'),
                    'type'  => 'image',
                ),
                'author-name' => array(
                    'label' => esc_html__('Name:', 'tribunal'),
                    'type' => 'text',
                    'class' => 'widefat',
                ),
                'description' => array(
                    'label' => esc_html__('Description:', 'tribunal'),
                    'type'  => 'textarea',
                    'class' => 'widget-content widefat'
                ),
                'image_url' => array(
                    'label' => esc_html__('Author Image:', 'tribunal'),
                    'type'  => 'image',
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
                   'type' => 'esc_html__',
                   'class' => 'widefat',
                    ),
            );
            parent::__construct( 'tribunal-author-layout', esc_html__('Tribunal: Author Widget', 'tribunal'), $opts, array(), $fields );
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
            $params = $this->get_params($instance);
            echo $args['before_widget'];
            if ( ! empty( $params['title'] ) ) {
                echo $args['before_title'] . esc_html( $params['title'] ) . $args['after_title'];
            } ?>
            <div class="author-widget-details <?php if( $params['image_bg_url'] ){ echo "data-bg-enable"; } ?>">
                <?php if ( ! empty( $params['image_bg_url'] ) ) { ?>
                    <div class="author-data-bg data-bg" data-background="<?php echo esc_url( $params['image_bg_url'] ); ?>">
                    </div>
                <?php } ?>
                <div class="theme-author-avatar">
                    <?php if ( ! empty( $params['image_url'] ) ) { ?>
                        <div class="profile-data-bg data-bg" data-background="<?php echo esc_url( $params['image_url'] ); ?>">
                        </div>
                    <?php } ?>
                </div>
                <div class="author-content">
                    <?php if ( ! empty( $params['author-name'] ) ) { ?>
                        <h3 class="entry-title entry-title-small"><?php echo esc_html( $params['author-name'] );?></h3>
                    <?php } ?>
                    <?php if ( ! empty( $params['description'] ) ) { ?>
                        <div class="author-bio"><?php echo wp_kses_post( $params['description']); ?></div>
                    <?php } ?>
                </div>
                <div class="author-social-profiles">
                    <?php if ( ! empty( $params['url-fb'] ) ) { ?>
                        <a href="<?php echo esc_url( $params['url-fb'] ); ?>" target="_blank" class="author-social-icon author-social-facebook"><i class="ion ion-logo-facebook"></i></a>
                    <?php } ?>
                    <?php if ( ! empty( $params['url-tw'] ) ) { ?>
                        <a href="<?php echo esc_url( $params['url-tw'] ); ?>" target="_blank" class="author-social-icon author-social-twitter"><i class="ion ion-logo-twitter"></i></a>
                    <?php } ?>
                    <?php if ( ! empty( $params['url-lt'] ) ) { ?>
                        <a href="<?php echo esc_url( $params['url-lt'] ); ?>" target="_blank" class="author-social-icon author-social-linkedin"><i class="ion ion-logo-linkedin"></i></a>
                    <?php } ?>
                    <?php if ( ! empty( $params['url-ig'] ) ) { ?>
                        <a href="<?php echo esc_url( $params['url-ig'] ); ?>" target="_blank" class="author-social-icon author-social-instagram"><i class="ion ion-logo-instagram"></i></a>
                    <?php } ?>
                </div>
            </div>
            <?php echo $args['after_widget'];
        }
    }
endif;