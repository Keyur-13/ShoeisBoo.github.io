<?php
/**
 * Sample implementation of the Custom functions
 *
 * @package godhuli
 */

/**
 * Modify default read more link
 */
function godhuli_modify_read_more_link() {

	$posted_on = sprintf(
		'<div class="text-center"><a href="%s" rel="bookmark" class="btn btn-outline-custom" >' . __( 'Continue Reading', 'godhuli' ) . ' <i class="mdi mdi-arrow-right"></i></a></div> ',
		esc_url( get_permalink() )
	);
	return $posted_on;

}
add_filter( 'the_content_more_link', 'godhuli_modify_read_more_link' );



/*
 * *
 * WordPress number pagination
 * * */
if ( ! function_exists( 'godhuli_number_paging_nav' ) ) :

	function godhuli_number_paging_nav() {

		$pagination_args = array(
			'prev_text'          => '<i class="mdi mdi-chevron-left"></i>',
			'next_text'          => '<i class="mdi mdi-chevron-right"></i>',
			'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'godhuli' ) . ' </span>',
		);

		the_posts_pagination( $pagination_args );

	}

endif;




/*
 * *
 * Modify WordPress comment box textarea
 * * */

function godhuli_move_comment_field_to_bottom( $fields ) {
	$comment_field = $fields['comment'];
	unset( $fields['comment'] );
	$fields['comment'] = $comment_field;

	return $fields;
}
add_filter( 'comment_form_fields', 'godhuli_move_comment_field_to_bottom' );




/*
 * Get comment depth
 */
function godhuli_get_comment_depth( $my_comment_id ) {
	$depth_level = 0;
	while ( $my_comment_id > 0 ) { // if you have ideas how we can do it without a loop, please, share it with us in comments
		$my_comment    = get_comment( $my_comment_id );
		$my_comment_id = $my_comment->comment_parent;
		$depth_level++;
	}
	return $depth_level;
}




/*
 * *
 * Fatch all category
 * * */
if ( ! function_exists( 'godhuli_fatch_all_cats' ) ) :

	function godhuli_fatch_all_cats() {

		$get_all_cats  = get_categories();
		$cats_to_fatch = array();
		foreach ( $get_all_cats as $cats ) {

			$cats_to_fatch[ $cats->slug ] = $cats->name;

		}
		return $cats_to_fatch;

	}


endif;



/**
 * Callback for WordPress 'prepend_attachment' filter.
 * Change the attachment page image size to 'large'
 */

add_filter( 'prepend_attachment', 'godhuli_prepend_attachment' );

function godhuli_prepend_attachment( $attachment_content ) {

	// set the attachment image size to 'large'
	$attachment_content = sprintf( '<p>%s</p>', wp_get_attachment_link( 0, 'large', false ) );

	// return the attachment content
	return $attachment_content;

}


/*
 * Add class to comment reply
 */

add_filter( 'comment_reply_link', 'godhuli_replace_reply_link_class' );

function godhuli_replace_reply_link_class( $class ) {
	$class = str_replace( "class='comment-reply-link", "class='comment-reply-link text-custom reply-btn", $class );
	return $class;
}



/**
 * Include a skip to content link at the top of the page so that users can bypass the menu.
 */
function godhuli_skip_link() {
	echo ' <a class="skip-link screen-reader-text" href="#content">' . esc_html__( 'Skip to the content', 'godhuli' ) . '</a>';
}

add_action( 'wp_body_open', 'godhuli_skip_link', 5 );
