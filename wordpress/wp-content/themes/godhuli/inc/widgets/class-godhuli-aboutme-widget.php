<?php
/**
 * Create author about me widget
 *
 * @package godhuli
 */


// Adds widget: godhuli About Me
class Godhuli_Aboutme_Widget extends WP_Widget {

	function __construct() {
		parent::__construct(
			'godhuli_aboutme_widget',
			esc_html__( 'Godhuli About Me', 'godhuli' ),
			array( 'description' => esc_html__( 'Add about me section', 'godhuli' ) ) // Args
		);
		add_action( 'admin_footer', array( $this, 'media_fields' ) );
		add_action( 'customize_controls_print_footer_scripts', array( $this, 'media_fields' ) );
	}

	private $widget_fields = array(
		array(
			'id'   => 'imageupload_media',
			'type' => 'media',
		),
		array(
			'id'   => 'description_textarea',
			'type' => 'textarea',
		),
		array(
			'id'   => 'readmoretext_text',
			'type' => 'text',
		),
		array(
			'id'   => 'link_url',
			'type' => 'url',
		),
	);

	public function widget( $args, $instance ) {

		echo wp_kses_post( $args['before_widget'] );

		if ( ! empty( $instance['title'] ) ) {
			echo wp_kses_post( $args['before_title'] . apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base ) . $args['after_title'] );
		}

		$author_image = wp_get_attachment_image_src( isset( $instance['imageupload_media'] ) ? $instance['imageupload_media'] : null, 'thumbnail' );
		// Output generated fields
		echo '<div class="about-widget">';
		if ( $author_image[0] ) {
			echo '<img src="' . esc_url( $author_image[0] ) . '" alt="' . esc_attr__( 'About Me', 'godhuli' ) . '" class="rounded-circle">';
		}
		echo '<p>' . esc_html( isset( $instance['description_textarea'] ) ? $instance['description_textarea'] : null ) . '</p>';
		if ( ! empty( $instance['readmoretext_text'] ) ) {
			echo '<a href="' . esc_url( $instance['link_url'] ) . '" class="btn-read-more mt-2">' . esc_html( $instance['readmoretext_text'] ) . ' <i class="mdi mdi-arrow-right"></i></a>';
		}
		echo '</div>';

		echo wp_kses_post( $args['after_widget'] );
	}

	public function media_fields() {
		?><script>
			jQuery(document).ready(function($){
				if ( typeof wp.media !== 'undefined' ) {
					var _custom_media = true,
						_orig_send_attachment = wp.media.editor.send.attachment;
					$(document).on('click','.custommedia',function(e) {
						var send_attachment_bkp = wp.media.editor.send.attachment;
						var button = $(this);
						var id = button.attr('id');
						_custom_media = true;
						wp.media.editor.send.attachment = function(props, attachment){
							if ( _custom_media ) {
								$('input#'+id).val(attachment.id);
								$('span#preview'+id).css('background-image', 'url('+attachment.url+')');
								$('input#'+id).trigger('change');
							} else {
								return _orig_send_attachment.apply( this, [props, attachment] );
							};
						}
						wp.media.editor.open(button);
						return false;
					});
					$('.add_media').on('click', function(){
						_custom_media = false;
					});
					$(document).on('click', '.remove-media', function() {
						var parent = $(this).parents('p');
						parent.find('input[type="media"]').val('').trigger('change');
						parent.find('span').css('background-image', 'url()');
					});
				}
			});
		</script>
		<?php
	}

	public function field_generator( $instance ) {
		$output = '';
		foreach ( $this->widget_fields as $widget_field ) {
			$default = '';
			if ( isset( $widget_field['default'] ) ) {
				$default = $widget_field['default'];
			}
			$widget_value = ! empty( $instance[ $widget_field['id'] ] ) ? $instance[ $widget_field['id'] ] : $default;
			switch ( $widget_field['type'] ) {
				case 'media':
					$media_url = '';
					if ( $widget_value ) {
						$media_url = wp_get_attachment_url( $widget_value );
					}
					$output .= '<p>';
					$output .= '<label for="' . esc_attr( $this->get_field_id( $widget_field['id'] ) ) . '">' . esc_html__( 'Image Upload', 'godhuli' ) . ':</label> ';
					$output .= '<input style="display:none;" class="widefat" id="' . esc_attr( $this->get_field_id( $widget_field['id'] ) ) . '" name="' . esc_attr( $this->get_field_name( $widget_field['id'] ) ) . '" type="' . esc_attr( $widget_field['type'] ) . '" value="' . esc_attr( $widget_value ) . '">';
					$output .= '<span id="preview' . esc_attr( $this->get_field_id( $widget_field['id'] ) ) . '" style="margin-right:10px;border:2px solid #eee;display:block;width: 100px;height:100px;background-image:url(' . esc_url( $media_url ) . ');background-size:contain;background-repeat:no-repeat;"></span>';
					$output .= '<button id="' . esc_attr( $this->get_field_id( $widget_field['id'] ) ) . '" class="button select-media custommedia">' . esc_html__( 'Add Media', 'godhuli' ) . '</button>';
					$output .= '<input style="width: 19%;" class="button remove-media" id="buttonremove" name="buttonremove" type="button" value="' . esc_attr__( 'Clear', 'godhuli' ) . '" />';
					$output .= '</p>';
					break;
				case 'textarea':
					$output .= '<p>';
					$output .= '<label for="' . esc_attr( $this->get_field_id( $widget_field['id'] ) ) . '">' . esc_html__( 'Description', 'godhuli' ) . ':</label> ';
					$output .= '<textarea class="widefat" id="' . esc_attr( $this->get_field_id( $widget_field['id'] ) ) . '" name="' . esc_attr( $this->get_field_name( $widget_field['id'] ) ) . '" rows="6" cols="6" value="' . esc_attr( $widget_value ) . '">' . esc_html( $widget_value ) . '</textarea>';
					$output .= '</p>';
					break;
				case 'text':
					$output .= '<p>';
					$output .= '<label for="' . esc_attr( $this->get_field_id( $widget_field['id'] ) ) . '">' . esc_html__( 'Read More Text', 'godhuli' ) . ':</label> ';
					$output .= '<input class="widefat" id="' . esc_attr( $this->get_field_id( $widget_field['id'] ) ) . '" name="' . esc_attr( $this->get_field_name( $widget_field['id'] ) ) . '" type="' . esc_attr( $widget_field['type'] ) . '" value="' . esc_attr( $widget_value ) . '">';
					$output .= '</p>';
					break;
				case 'url':
					$output .= '<p>';
					$output .= '<label for="' . esc_attr( $this->get_field_id( $widget_field['id'] ) ) . '">' . esc_html__( 'Read More Link', 'godhuli' ) . ':</label> ';
					$output .= '<input class="widefat" id="' . esc_attr( $this->get_field_id( $widget_field['id'] ) ) . '" name="' . esc_attr( $this->get_field_name( $widget_field['id'] ) ) . '" type="' . esc_attr( $widget_field['type'] ) . '" value="' . esc_attr( $widget_value ) . '">';
					$output .= '</p>';
					break;
				default:
					$output .= '<p>';
					$output .= '<label for="' . esc_attr( $this->get_field_id( $widget_field['id'] ) ) . '">' . esc_html( $widget_field['label'] ) . ':</label> ';
					$output .= '<input class="widefat" id="' . esc_attr( $this->get_field_id( $widget_field['id'] ) ) . '" name="' . esc_attr( $this->get_field_name( $widget_field['id'] ) ) . '" type="' . esc_attr( $widget_field['type'] ) . '" value="' . esc_attr( $widget_value ) . '">';
					$output .= '</p>';
			}
		}

		echo $output;

	}

	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'About Me', 'godhuli' );
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'godhuli' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>

		<?php
		$this->field_generator( $instance );
	}

	public function update( $new_instance, $old_instance ) {
		$instance          = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';
		foreach ( $this->widget_fields as $widget_field ) {

			switch ( $widget_field['type'] ) {

				case $widget_field['media']:
					$instance[ $widget_field['media'] ] = ( ! empty( $new_instance[ $widget_field['media'] ] ) ) ? esc_url_raw( $new_instance[ $widget_field['media'] ] ) : '';
					break;

				case $widget_field['textarea']:
					$instance[ $widget_field['textarea'] ] = ( ! empty( $new_instance[ $widget_field['textarea'] ] ) ) ? sanitize_textarea_field( $new_instance[ $widget_field['textarea'] ] ) : '';
					break;

				case $widget_field['text']:
					$instance[ $widget_field['text'] ] = ( ! empty( $new_instance[ $widget_field['text'] ] ) ) ? sanitize_text_field( $new_instance[ $widget_field['text'] ] ) : '';
					break;

				case $widget_field['url']:
					$instance[ $widget_field['url'] ] = ( ! empty( $new_instance[ $widget_field['url'] ] ) ) ? esc_url_raw( $new_instance[ $widget_field['url'] ] ) : '';
					break;

				default:
					$instance[ $widget_field['id'] ] = ( ! empty( $new_instance[ $widget_field['id'] ] ) ) ? wp_kses_post( $new_instance[ $widget_field['id'] ] ) : '';
			}
		}
		return $instance;
	}
}

function godhuli_aboutme_widget_register() {
	register_widget( 'Godhuli_Aboutme_Widget' );
}
add_action( 'widgets_init', 'godhuli_aboutme_widget_register' );
