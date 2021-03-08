<?php
/**
 * @package The Words
 */

add_action('widgets_init', 'the_words_category_register');

function the_words_category_register() {
    register_widget('The_Words_Category_Widget');
}

class The_Words_Category_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct(
                'The_Words_Category_Widget', esc_html__('TA : Sidebar Category', 'the-words'), array(
                'description' => esc_html__('This Widget show Categories', 'the-words')
                )
        );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {
        $the_words_cat_list = the_words_category_list();
        $fields = array(
            'recent_post_title' => array(
                'the_words_widgets_name' => 'recent_post_title',
                'the_words_widgets_title' => esc_html__('Title', 'the-words'),
                'the_words_widgets_field_type' => 'text',
            ),
            'recent_post_category_1' => array(
                'the_words_widgets_name' => 'recent_post_category_1',
                'the_words_widgets_title' => esc_html__('Category One', 'the-words'),
                'the_words_widgets_field_type' => 'select',
                'the_words_widgets_field_options' => $the_words_cat_list,
            ),
            'recent_post_category_2' => array(
                'the_words_widgets_name' => 'recent_post_category_2',
                'the_words_widgets_title' => esc_html__('Category Two', 'the-words'),
                'the_words_widgets_field_type' => 'select',
                'the_words_widgets_field_options' => $the_words_cat_list,
            ),
            'recent_post_category_3' => array(
                'the_words_widgets_name' => 'recent_post_category_3',
                'the_words_widgets_title' => esc_html__('Category Three', 'the-words'),
                'the_words_widgets_field_type' => 'select',
                'the_words_widgets_field_options' => $the_words_cat_list,
            ),
            'recent_post_category_4' => array(
                'the_words_widgets_name' => 'recent_post_category_4',
                'the_words_widgets_title' => esc_html__('Category Four', 'the-words'),
                'the_words_widgets_field_type' => 'select',
                'the_words_widgets_field_options' => $the_words_cat_list,
            ),
            'recent_post_category_5' => array(
                'the_words_widgets_name' => 'recent_post_category_5',
                'the_words_widgets_title' => esc_html__('Category Five', 'the-words'),
                'the_words_widgets_field_type' => 'select',
                'the_words_widgets_field_options' => $the_words_cat_list,
            ),
            'recent_post_category_6' => array(
                'the_words_widgets_name' => 'recent_post_category_6',
                'the_words_widgets_title' => esc_html__('Category Six', 'the-words'),
                'the_words_widgets_field_type' => 'select',
                'the_words_widgets_field_options' => $the_words_cat_list,
            ),
        );

        return $fields;
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget($args, $instance) {
        extract($args);
        
        $the_words_title_widget = apply_filters( 'widget_title', empty( $instance['recent_post_title'] ) ? '' : $instance['recent_post_title'], $instance, $this->id_base );

        echo $before_widget; ?>

        <div class="ta-widget-category-wrap">
            <div class="ta-widget-category-secondary">

                <?php
                if ( !empty( $the_words_title_widget ) ):
                    echo $args['before_title'] . esc_html( $the_words_title_widget ) . $args['after_title'];
                endif;

                for( $x = 1; $x <= 6; $x++ ){

                    $recent_post_category = isset( $instance['recent_post_category_'.$x] ) ? $instance['recent_post_category_'.$x] : '' ;

                    if( $recent_post_category ){

                        $category_post_count_1 = the_words_count_category_posts( $recent_post_category );
                        $cat_info = get_category_by_slug( $recent_post_category );
                        $cat_link = get_category_link(  $cat_info->term_id );
                        $image = '';
                        if( function_exists('z_taxonomy_image_url') ):
                            $image = z_taxonomy_image_url( $cat_info->term_id,'large' );
                        endif;
                        ?>
                        <a href="<?php echo esc_url( $cat_link ); ?>" class="sidebar-cat-item" <?php if( $image ){ ?> style="background-image: url('<?php echo esc_url( $image ); ?>')" <?php } ?>>
                            
                            <?php if( isset( $cat_info->name ) && $cat_info->name ){ ?>
                                <h3><?php echo esc_html( $cat_info->name ); ?></h3>
                            <?php } ?>

                            <span><?php echo absint( $category_post_count_1 ); ?></span>

                        </a>
                        <?php

                    }

                } ?>

            </div>
        </div>
        <?php
        echo $after_widget;
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param	array	$new_instance	Values just sent to be saved.
     * @param	array	$old_instance	Previously saved values from database.
     *
     * @uses	the_words_widgets_updated_field_value()		defined in widget-fields.php
     *
     * @return	array Updated safe values to be saved.
     */
    public function update($new_instance, $old_instance) {
        $instance = $old_instance;

        $widget_fields = $this->widget_fields();

        // Loop through fields
        foreach ($widget_fields as $widget_field) {

            extract($widget_field);

            // Use helper function to get updated field values
            $instance[$the_words_widgets_name] = the_words_widgets_updated_field_value($widget_field, $new_instance[$the_words_widgets_name]);
        }

        return $instance;
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param	array $instance Previously saved values from database.
     *
     * @uses	the_words_widgets_show_widget_field()		defined in widget-fields.php
     */
    public function form($instance) {
        $widget_fields = $this->widget_fields();

        // Loop through fields
        foreach ($widget_fields as $widget_field) {

            // Make array elements available as variables
            extract($widget_field);
            $the_words_widgets_field_value = !empty($instance[$the_words_widgets_name]) ? esc_attr($instance[$the_words_widgets_name]) : '';
            the_words_widgets_show_widget_field($this, $widget_field, $the_words_widgets_field_value);
        }
    }

}
