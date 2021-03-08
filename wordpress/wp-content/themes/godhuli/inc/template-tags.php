<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Godhuli
 */



if ( ! function_exists( 'godhuli_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function godhuli_posted_on() {

		if ( 1 === get_theme_mod( 'remove_date' ) ) {
			return false;
		}

		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time> ';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = ' <time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		$arr = array(
			'time' => array(
				'class'    => array(),
				'datetime' => array(),
				'id'       => array(),
			),
		);

		echo '<span class="posted-on"><a class="post-date" href="' . esc_url( get_permalink() ) . '" rel="bookmark"> <i class="mdi mdi-calendar"></i>' . wp_kses( $time_string, $arr ) . '</a></span>';

	}

endif;




if ( ! function_exists( 'godhuli_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function godhuli_posted_by() {

		if ( 1 === get_theme_mod( 'godhuli_remove_author_name' ) ) {
			return false;
		}

		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( 'By %s', 'post author', 'godhuli' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="byline"> <i class="mdi mdi-account"></i>' . wp_kses_post( $byline ) . '</span>';

	}
endif;




if ( ! function_exists( 'godhuli_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function godhuli_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( ' ' );
			if ( $categories_list && 1 !== get_theme_mod( 'godhuli_remove_single_cats' ) ) {
				/* translators: 1: list of categories. */
				printf( '<span class="tagcloud single-entry-cat"> <h6> %1$s </h6>  %2$s </span>', esc_html__( 'Categories:', 'godhuli' ), wp_kses_post( $categories_list ) );
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list();
			if ( $tags_list && 1 !== get_theme_mod( 'godhuli_remove_single_tags' ) ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tagcloud"> <h6> %1$s </h6>  %2$s </span>', esc_html__( 'Tags:', 'godhuli' ), wp_kses_post( $tags_list ) );
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'godhuli' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				)
			);
			echo '</span>';
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'godhuli' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;




if ( ! function_exists( 'godhuli_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function godhuli_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
			?>

			<div class="post-thumbnail post-preview">
				<?php
				the_post_thumbnail(
					'godhuli_post_thumb',
					array(
						'alt'   => the_title_attribute(
							array(
								'echo' => false,
							)
						),
						'class' => 'img-fluid rounded',
					)
				);
				?>
			</div><!-- .post-thumbnail -->

		<?php else : ?>
		<div class="post-preview center">
			<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">

			<?php
			the_post_thumbnail(
				'godhuli_post_thumb',
				array(
					'alt'   => the_title_attribute(
						array(
							'echo' => false,
						)
					),
					'class' => 'img-fluid rounded',
				)
			);
			?>

				</a></div>

			<?php
		endif; // End is_singular().
	}
endif;




if ( ! function_exists( 'godhuli_entry_category' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function godhuli_entry_category() {

		if ( 1 === get_theme_mod( 'godhuli_remove_top_cat' ) ) {
			return false;
		}

		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$list_all_cats = get_the_category();
			if ( $list_all_cats ) {
				/* translators: 1: list of categories. */
				foreach ( $list_all_cats as $cats ) {

					printf( '<a class="badge badge-custom" href="%1$s">%2$s</a>', esc_url( get_category_link( $cats->term_id ) ), esc_html( $cats->name ) );

				}
			}
		}

	}
endif;





if ( ! function_exists( 'godhuli_slider_category' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function godhuli_slider_category() {

		if ( 1 === get_theme_mod( 'godhuli_remove_top_cat' ) ) {
			return false;
		}

		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			$categories_list = get_the_category_list( esc_html__( ', ', 'godhuli' ) );

			if ( $categories_list ) {
				/* translators: 1: list of categories. */
				print( '<span class="cat-text">' . wp_kses_post( $categories_list ) . '</span>' );
			}
		}

	}
endif;





if ( ! function_exists( 'godhuli_slider_post_date' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function godhuli_slider_post_date() {

		if ( 1 === get_theme_mod( 'remove_date' ) ) {
			return false;
		}

		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() )
		);

		printf(
			'%s',
			'<ul class="meta"><li><a href="' . esc_url( get_the_permalink() ) . '" rel="bookmark">' . wp_kses_post( $time_string ) . '</a></li></ul>'
		);

	}

endif;




if ( ! function_exists( 'godhuli_comment_meta' ) ) :

	/**
	 * Prints HTML with meta information for the comments.
	 */
	function godhuli_comment_meta() {

		if ( 1 === get_theme_mod( 'godhuli_remove_comment_text' ) ) {
			return false;
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="meta_comment"><i class="mdi mdi-chat"></i>';
			comments_popup_link(
				__( 'Leave a comment', 'godhuli' ),
				__( '1 Comment', 'godhuli' ),
				__( '% Comments', 'godhuli' )
			);
			echo '</span>';
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'godhuli' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<span class="edit-link">',
			'</span>'
		);
	}

endif;





/**
 * Author profile box display
 */

if ( ! function_exists( 'godhuli_author_box' ) ) :

	function godhuli_author_box() {

		if ( 1 === get_theme_mod( 'godhuli_remove_author_box' ) ) {
			return false;
		}

		if ( is_singular() ) :

			$html  = '<div class="media post-author-box">';
			$html .= '<img class="d-flex mr-3 rounded-circle" src="' . esc_url( get_avatar_url( get_the_author_meta( 'ID' ) ) ) . '" alt="Generic placeholder image">';
			$html .= '<div class="media-body">';
			$html .= '<h4 class="media-heading"><a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></h4>';
			$html .= '<p class="mb-0"> ' . esc_html( get_the_author_meta( 'description' ) ) . ' </p> ';
			$html .= '</div></div>';

			echo wp_kses_post( $html );

			endif;
	}



endif;




/**
 * Related Post display
 */

if ( ! function_exists( 'godhuli_related_post' ) ) :

	function godhuli_related_post() {

		if ( 1 === get_theme_mod( 'godhuli_remove_related_posts' ) ) {
			return false;
		}

		if ( is_singular() ) :

			printf( '<div class="mt-5 text-center"><h5 class="page-title-alt"><span>%1$s</span></h5></div>', esc_html__( 'You Might Also Like', 'godhuli' ) );

			$args    = array(
				'post_type'      => 'post',
				'post_status'    => 'publish',
				'posts_per_page' => get_theme_mod( 'godhuli_related_post_count' ),
				'category__in'   => wp_get_post_categories( get_the_ID() ),
				'post__not_in'   => array( get_the_ID() ),
			);
			$related = new WP_Query( $args );

			echo '<div class="row">';

			while ( $related->have_posts() ) :
				$related->the_post();

				$post_thumb = get_the_post_thumbnail_url( get_the_ID(), 'large' );

				$html  = '<div class="col-sm-4">';
				$html .= '<article class="related-post">';
				if ( $post_thumb ) {
					$html .= '<div class="post-preview">';
					$html .= '<a href="' . esc_url( get_the_permalink() ) . '"><img src="' . esc_url( $post_thumb ) . '" alt class="img-fluid rounded"></a>';
					$html .= '</div>';
				}
				$html .= '<div class="post-header">';
				$html .= '<h6><a href="' . esc_url( get_the_permalink() ) . '">' . esc_html( get_the_title() ) . '</a></h6>';
				$html .= ' <p class="post-date">' . esc_html( get_the_date() ) . '</p>';
				$html .= '</div>';
				$html .= '</article>';
				$html .= '</div>';

				echo wp_kses_post( $html );

			endwhile;
			wp_reset_postdata();

			echo '</div>';

		endif;
	}

endif;







