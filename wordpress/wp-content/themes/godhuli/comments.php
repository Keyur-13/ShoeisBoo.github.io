<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Godhuli
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comment_sec mt-50">

	<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) :
		?>

		<div class="mt-5">
			<h5 class="page-title-alt">

				<?php

				$godhuli_comment_count = get_comments_number();

				if ( 1 === $godhuli_comment_count ) {
					printf(
						/* translators: 1: title. */
						esc_html_e( 'One comment on &ldquo;%1$s&rdquo;', 'godhuli' ),
						'<span>' . wp_kses_post( get_the_title() ) . '</span>'
					);

				} else {

					printf(
						/* translators: 1: comment count number, 2: title. */
						esc_html( _nx( '%1$s comment on &ldquo;%2$s&rdquo;', '%1$s comments on &ldquo;%2$s&rdquo;', $godhuli_comment_count, 'comments title', 'godhuli' ) ),
						wp_kses_post( number_format_i18n( $godhuli_comment_count ) ),
						'<span>' . wp_kses_post( get_the_title() ) . '</span>'
					);
				}

				?>
			</h5><!-- .comments-title -->

		</div>


		<?php the_comments_navigation(); ?>


		<div class="blog_comments  mb-50">

			<ul class="media-list list-unstyled">
				<?php

				wp_list_comments(
					array(
						'walker'      => new Godhuli_Comment(),
						'style'       => 'ul',
						'short_ping'  => true,
						'avatar_size' => 75,
						'format'      => 'html5',
					)
				);

				?>

			</ul>
		</div><!-- .comment-list -->

		<?php

		the_comments_navigation();

		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() ) :
			?>
			<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'godhuli' ); ?></p>
			<?php
		endif;

	endif; // Check for have_comments().


	$godhuli_args = array(
		'format'               => 'html5',
		'title_reply'          => '<div class="mt-5"><h5 class="page-title-alt"><span>' . esc_html__( 'Leave A Reply', 'godhuli' ) . '</span></h5></div>',
		'comment_notes_before' => '',
		'comment_field'        => '<div class="row"><div class="col-sm-12">' . '<div class="form-group">' . '<textarea id="comment" name="comment" class="form-control" rows="5" placeholder="' . esc_attr__( 'Your Message', 'godhuli' ) . '" aria-required="true">' . '</textarea></div></div></div>',
		'class_submit'         => 'form-submit',
		'fields'               => apply_filters(
			'godhuli_form_default_fields',
			array(
				'author'  =>
					'<div class="row"> <div class="col-lg-6"><div class="form-group">' .
					'<input id="author" name="author" type="text" class="form-control" placeholder="' . esc_attr__( 'Name', 'godhuli' ) . '" value="' . esc_attr( $commenter['comment_author'] ) .
					'" size="30" /></div></div>',
				'email'   =>
					'<div class="col-lg-6"><div class="form-group">' .
					'<input id="email" name="email" type="text" class="form-control" placeholder="' . esc_attr__( 'Email', 'godhuli' ) . '" value="' . esc_attr( $commenter['comment_author_email'] ) .
					'" size="30" /></div></div> </div>',
				'url'     =>
					'<div class="row"><div class="col-sm-12"><div class="form-group">' .
					'<input id="url" name="url" class="form-control" placeholder="' . esc_attr__( 'Website', 'godhuli' ) . '" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
					'" size="30" /></div></div></div>
                    ',
				'cookies' => '',
			)
		),
	);

	comment_form( $godhuli_args );

	?>

</div><!-- #comments -->
