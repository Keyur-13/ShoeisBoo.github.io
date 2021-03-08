<?php
/**
 * A custom WordPress comment walker class to implement the Bootstrap Media object in WordPress comment list.
 *
 * @package Godhuli
 */

class Godhuli_Comment extends Walker_Comment {

	/**
	 * Output a comment in the HTML5 format.
	 *
	 * @since 1.0.0
	 *
	 * @see wp_list_comments()
	 *
	 * @param object $comment the comments list.
	 * @param int    $depth   Depth of comments.
	 * @param array  $args    An array of arguments.
	 */
	protected function html5_comment( $comment, $depth, $args ) {
		$tag = ( 'div' === $args['style'] ) ? 'div' : 'li';
		?>
		<<?php echo wp_kses_post( $tag ); ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( $this->has_children ? 'has-children medias' : ' medias' ); ?>>


	<div class="media-body mt-3 " id="div-comment-<?php comment_ID(); ?>">
		<div class="hoverable">
			<div class="flex-center">

				<?php edit_comment_link( __( 'Edit', 'godhuli' ), '<li class="edit-link list-inline-item btn btn-secondary chip">', '</li>' ); ?>
				<?php
				comment_reply_link(
					array_merge(
						$args,
						array(
							'add_below' => 'div-comment',
							'depth'     => $depth,
							'max_depth' => $args['max_depth'],
						)
					)
				);
				?>

				<?php if ( 0 !== $args['avatar_size'] ) : ?>
					<a href="<?php echo esc_url( get_comment_author_url() ); ?>" class="media-object float-left">
						<?php echo wp_kses_post( get_avatar( $comment, $args['avatar_size'], 'mm', '', array( 'class' => 'comment_avatar rounded-circle' ) ) ); ?>
					</a>
				<?php endif; ?>

				<h4 class="media-heading">
					<?php
					$arr = array(
						'a' => array(
							'href'  => array(),
							'rel'   => array(),
							'class' => array(),
						),
					);
					echo wp_kses( get_comment_author_link(), $arr );
					?>
				</h4>

			</div>

			<div class="comment-metadata flex-center">

				<a class="hidden-xs-down" href="<?php echo esc_url( get_comment_link( $comment->comment_ID, $args ) ); ?>">
					<time class="small chip" datetime="<?php comment_time( 'c' ); ?>">
						<?php comment_date(); ?>,
						<?php comment_time(); ?>
					</time>
				</a>

				<div class="card-block warning-color">
					<?php if ( '0' === $comment->comment_approved ) : ?>
						<p class="card-text comment-awaiting-moderation label label-info text-muted small"><?php esc_html_e( 'Your comment is awaiting moderation.', 'godhuli' ); ?></p>
					<?php endif; ?>

					<div class="comment-content card-text">
						<?php comment_text(); ?>
					</div><!-- .comment-content -->

				</div><!-- .comment-metadata -->

		<?php
	}

}
