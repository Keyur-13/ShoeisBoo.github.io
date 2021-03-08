<?php
/**
 * Define fields for Widgets.
 * 
 * @package The_Words
 */

function the_words_widgets_show_widget_field( $instance = '', $widget_field = '', $athm_field_value = '' ) {
	$the_words_pagelist[0] = array(
        'value' => 0,
        'label' => esc_html__('--choose--','the-words')
    );
    $the_words_pages = get_pages();
    foreach($the_words_pages as $the_words_page) :
        $the_words_pagelist[$the_words_page->ID] = array(
            'value' => $the_words_page->ID,
            'label' => $the_words_page->post_title
        );
    endforeach;
    
	extract( $widget_field );
	
	switch( $the_words_widgets_field_type ) {
	
		// Standard text field
		case 'text' : ?>
			<p>
				<label for="<?php echo esc_attr($instance->get_field_id( $the_words_widgets_name )); ?>"><?php echo esc_html($the_words_widgets_title); ?>:</label>
				<input class="widefat" id="<?php echo esc_attr($instance->get_field_id( $the_words_widgets_name )); ?>" name="<?php echo esc_attr($instance->get_field_name( $the_words_widgets_name )); ?>" type="text" value="<?php echo esc_attr($athm_field_value); ?>" />
				
				<?php if( isset( $the_words_widgets_description ) ) { ?>
				<br />
				<small><?php echo esc_html($the_words_widgets_description); ?></small>
				<?php } ?>
			</p>
			<?php
			break;

		// Textarea field
		case 'textarea' : ?>
			<p>
				<label for="<?php echo esc_attr($instance->get_field_id( $the_words_widgets_name )); ?>"><?php echo esc_html($the_words_widgets_title); ?>:</label>
				<textarea class="widefat" rows="6" id="<?php echo esc_attr($instance->get_field_id( $the_words_widgets_name )); ?>" name="<?php echo esc_attr($instance->get_field_name( $the_words_widgets_name )); ?>"><?php echo esc_html($athm_field_value); ?></textarea>
			</p>
			<?php
			break;
            
		//Multi checkboxes
        case 'checkbox' :
            
            if( isset( $the_words_widgets_title ) ) { ?>
                <label><?php echo esc_html( $the_words_widgets_title ); ?>:</label>
            <?php }
            
            echo '<div class="the-words-multiple-checkbox">'; ?>
                    
                <p>
                    <input id="<?php echo esc_attr( $instance->get_field_id( $the_words_widgets_name ) ); ?>" name="<?php echo esc_attr($instance->get_field_name( $the_words_widgets_name )); ?>" type="checkbox" value="1" <?php checked('1', esc_attr($athm_field_value) ); ?>/>
                    <label for="<?php echo esc_attr($instance->get_field_id( $the_words_widgets_name )); ?>"><?php echo esc_html($the_words_widgets_title); ?>:</label>
                </p>
                <?php
            echo '</div>';
            
            if (isset($the_words_widgets_description)) { ?>
                    <small><em><?php echo esc_html($the_words_widgets_description); ?></em></small>
            <?php }
            
        break;
                        
		// Radio fields
		case 'radio' : ?>
			<p>
				<?php
				echo esc_attr($the_words_widgets_title); 
				echo '<br />';
				foreach( $the_words_widgets_field_options as $athm_option_name => $athm_option_title ) { ?>
					<input id="<?php echo esc_attr($instance->get_field_id( $athm_option_name )); ?>" name="<?php echo esc_attr($instance->get_field_name( $the_words_widgets_name )); ?>" type="radio" value="<?php echo esc_attr($athm_option_name); ?>" <?php checked( $athm_option_name, $athm_field_value ); ?> />
					<label for="<?php echo esc_attr($instance->get_field_id( $athm_option_name )); ?>"><?php echo esc_html($athm_option_title); ?></label>
					<br />
				<?php } ?>
				
				<?php if( isset( $the_words_widgets_description ) ) { ?>
				<small><?php echo esc_html($the_words_widgets_description); ?></small>
				<?php } ?>
			</p>
			<?php
			break;
			
		// Select field
		case 'select' : ?>
			<p>
				<label for="<?php echo esc_attr($instance->get_field_id( $the_words_widgets_name )); ?>"><?php echo esc_html($the_words_widgets_title); ?>:</label>
				<select name="<?php echo esc_attr($instance->get_field_name( $the_words_widgets_name )); ?>" id="<?php echo esc_attr($instance->get_field_id( $the_words_widgets_name )); ?>" class="widefat">
					<?php
					foreach ( $the_words_widgets_field_options as $athm_option_name => $athm_option_title ) { ?>
						<option value="<?php echo esc_attr($athm_option_name); ?>" id="<?php echo esc_attr($instance->get_field_id( $athm_option_name )); ?>" <?php selected( $athm_option_name, $athm_field_value ); ?>><?php echo esc_html($athm_option_title); ?></option>
					<?php } ?>
				</select>

				<?php if( isset( $the_words_widgets_description ) ) { ?>
				<br />
				<small><?php echo esc_html($the_words_widgets_description); ?></small>
				<?php } ?>
			</p>
			<?php
			break;

		case 'number' : ?>
			<p>
				<label for="<?php echo esc_attr($instance->get_field_id( $the_words_widgets_name )); ?>"><?php echo esc_html($the_words_widgets_title); ?>:</label><br />
				<input name="<?php echo esc_attr($instance->get_field_name( $the_words_widgets_name )); ?>" type="number" step="1" min="1" id="<?php echo esc_attr($instance->get_field_id( $the_words_widgets_name )); ?>" value="<?php echo esc_attr($athm_field_value); ?>" class="small-text" />
				
				<?php if( isset( $the_words_widgets_description ) ) { ?>
				<br />
				<small><?php echo esc_html($the_words_widgets_description); ?></small>
				<?php } ?>
			</p>
			<?php
			break;

		case 'upload' :

            $output = '';
            $id = esc_attr($instance->get_field_id($the_words_widgets_name));
            $class = '';
            $int = '';
            $value = esc_html($athm_field_value);
            $name = esc_attr($instance->get_field_name($the_words_widgets_name));


            if ($value) {
                $class = ' has-file';
            }
            $output .= '<div style="padding: 20px 5px; border: solid 1px #dcdcdc; margin-top:10px;" class="sub-option widget-upload">';
            $output .= '<label for="' . esc_attr($instance->get_field_id($the_words_widgets_name)) . '">' . esc_attr($the_words_widgets_title) . '</label><br/>';
            if( isset( $the_words_widgets_description ) ) {
				$output .= '<br />';
				$output .=  '<small>'. esc_html($the_words_widgets_description).'</small>';
            }
            $output .= '<input id="' . $id . '" class="upload' . $class . '" type="text" name="' . $name . '" value="' . $value . '" placeholder="' . esc_html__('No file chosen', 'the-words') . '" />' . "\n";
            if (function_exists('wp_enqueue_media')) {
                
				$output .= '<input id="upload-' . $id . '" class="upload-button button" type="button" value="' . esc_html__('Upload', 'the-words') . '" />' . "\n";

            } else {
                $output .= '<p><i>' . esc_html__('Upgrade your version of WordPress for full media support.', 'the-words') . '</i></p>';
            }

            $output .= '<div class="screenshot team-thumb" id="' . $id . '-image">' . "\n";

            if ($value != '') {
                $remove = '<a class="remove-image remove-screenshot">'.esc_html__('Remove','the-words').'</a>';
                $attachment_id = attachment_url_to_postid($value);

                $image_array = wp_get_attachment_image_src($attachment_id, 'medium');
                $image = preg_match('/(^.*\.jpg|jpeg|png|gif|ico*)/i', $value);
                if ( isset( $image_array[0] ) && $image_array[0] ) {
                    $output .= '<img src="' . esc_url($image_array[0]) . '" alt="" />' . $remove;
                } else {
                    $parts = explode("/", $value);
                    for ($i = 0; $i < sizeof($parts); ++$i) {
                        $title = $parts[$i];
                    }

                    // No output preview if it's not an image.
                    $output .= '';

                    // Standard generic output if it's not an image.
                    $title = esc_html__('View File', 'the-words');
                    $output .= '<div class="no-image"><span class="file_link"><a href="' . $value . '" target="_blank" rel="external">' . $title . '</a></span></div>';
                }
            }
            $output .= '</div></div>' . "\n";
            echo $output;
            break;
        
	}
	
}

function the_words_widgets_updated_field_value( $widget_field, $new_field_value ) {
    
	extract( $widget_field );
	
	// Allow only integers in number fields
	if( $the_words_widgets_field_type == 'number' ) {
		return absint( $new_field_value );
	}
    elseif ($the_words_widgets_field_type == 'multicheckboxes') {
         return wp_kses_post($new_field_value);
    } 
    elseif ($the_words_widgets_field_type == 'text') {
         return sanitize_text_field($new_field_value);
    } 
    elseif( $the_words_widgets_field_type == 'textarea' ) {

		return sanitize_textarea_field( $new_field_value );
		
	}
    else {
		return strip_tags( $new_field_value );
	}

}