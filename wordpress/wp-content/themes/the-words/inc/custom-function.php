<?php
/**
 * Custom Functions
 *
 * @package The_Words
**/

if( !function_exists('the_words_site_identity') ):

	function the_words_site_identity() {
		?>
		<div class="site-branding">
					<?php
					the_custom_logo();

					$enable_site_title = get_theme_mod('enable_site_title',1);

					if( $enable_site_title ){

						if ( is_front_page() && is_home() ) : ?>
							<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
						<?php
						else : ?>
							<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
						<?php
						endif;
						
						$the_words_description = get_bloginfo( 'description', 'display' );
						if ( $the_words_description || is_customize_preview() ) : ?>
							<p class="site-description"><?php echo esc_html( $the_words_description ); /* WPCS: xss ok. */ ?></p>
						<?php endif;
					} ?>

				</div><!-- .site-branding -->
				<?php
	}

endif;

if ( ! function_exists( 'the_words_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function the_words_posted_on() {

		$ed_post_date = get_theme_mod('ed_post_date',1);
		if( $ed_post_date ){

			$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
			if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
				$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
			}

			$time_string = sprintf( $time_string,
				esc_attr( get_the_date( DATE_W3C ) ),
				esc_html( get_the_date() ),
				esc_attr( get_the_modified_date( DATE_W3C ) ),
				esc_html( get_the_modified_date() )
			);
			$archive_year  = get_the_time( 'Y' ); 
			$archive_month = get_the_time( 'm' ); 
			$archive_day   = get_the_time( 'd' );

			$posted_on = '<i class="far fa-clock"></i> <a href="' . esc_url( get_day_link( $archive_year, $archive_month, $archive_day ) ) . '" rel="bookmark">' . $time_string . '</a>';

			echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.

		}

	}
endif;

if ( ! function_exists( 'the_words_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function the_words_posted_by() {

		$ed_post_author = get_theme_mod('ed_post_author',1);
		if( $ed_post_author ){

			$avatar = get_avatar( get_the_author_meta( 'ID' ),'50','',esc_html__('Author Image','the-words') );
			echo '<span class="byline ta-author-image">';

			echo '<a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . wp_kses_post( $avatar ). '</a>';

			echo '<span class="author vcard">';
			echo '<a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a>';
			echo '</span>';

			echo '</span>'; // WPCS: XSS OK.

		}

	}
endif;

if ( ! function_exists( 'the_words_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function the_words_entry_footer( $cats = true, $tags = false, $edcomments = false, $edit = false, $layout = 1 ) {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {

			$ed_post_category = get_theme_mod('ed_post_category',1);
			if( $cats && $ed_post_category ){

				if( $layout == 2 ){

					/* translators: used between list items, there is a space after the comma */
					$categories = get_the_category();
	                if( $categories ){

	                    echo '<div class="entry-header-1">';

	                        foreach( $categories as $category ){

	                            $category_name = $category->name;
	                            $category_slug = $category->slug;
	                            $category_url = get_category_link( $category->term_id ); ?>

	                            <a href="<?php echo esc_url( $category_url ); ?>" rel="category tag"><?php echo esc_html( $category_name ); ?></a>

	                        <?php
	                    	}

	                    echo '</div>';

	                }

				}else{

					/* translators: used between list items, there is a space after the comma */
					$categories_list = get_the_category_list(',');
					if ( $categories_list ) {
						/* translators: 1: list of categories. */
						printf( '<span class="cat-links ta-cat-lists">%1$s</span>', $categories_list ); // WPCS: XSS OK.
					}

				}

			}

			if( $tags ){
				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'the-words' ) );
				if ( $tags_list ) {
					/* translators: 1: list of tags. */
					printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'the-words' ) . '</span>', $tags_list ); // WPCS: XSS OK.
				}
			}
		}

		if( $edcomments ){
			if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
				echo '<span class="comments-link">';
				comments_popup_link(
					sprintf(
						wp_kses(
							/* translators: %s: post title */
							__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'the-words' ),
							array(
								'span' => array(
									'class' => array(),
								),
							)
						),
						esc_html( get_the_title() )
					)
				);
				echo '</span>';
			}

		}

		if( $edit ){
			edit_post_link(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Edit <span class="screen-reader-text">%s</span>', 'the-words' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					esc_html( get_the_title() )
				),
				'<span class="edit-link">',
				'</span>'
			);
		}

	}
endif;

if ( ! function_exists( 'the_words_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function the_words_post_thumbnail($size = 'full') {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
			?>

			<div class="post-thumbnail">
				<?php the_post_thumbnail(); ?>
			</div><!-- .post-thumbnail -->

		<?php else : ?>

		<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
			<?php
			the_post_thumbnail( $size, array(
				'alt' => the_title_attribute( array(
					'echo' => false,
				) ),
			) );
			?>
		</a>

		<?php
		endif; // End is_singular().
	}
endif;

if( !function_exists('the_words_social_icon') ):

	function the_words_social_icon(){

		$social_link_facebook = get_theme_mod('social_link_facebook');
		$social_link_twitter = get_theme_mod('social_link_twitter');
		$social_link_instagram = get_theme_mod('social_link_instagram');
		$social_link_youtube = get_theme_mod('social_link_youtube');
		$social_link_linkedin = get_theme_mod('social_link_linkedin');
		$social_link_pinterest = get_theme_mod('social_link_pinterest');
		$social_link_vk = get_theme_mod('social_link_vk');
		$social_link_reddit = get_theme_mod('social_link_reddit');
		$social_link_vimeo = get_theme_mod('social_link_vimeo');

		if( $social_link_facebook || 
			$social_link_twitter || 
			$social_link_instagram || 
			$social_link_youtube || 
			$social_link_linkedin || 
			$social_link_pinterest || 
			$social_link_vk || 
			$social_link_reddit || 
			$social_link_vimeo ){ ?>

			<div class="ta-social-icon">

				<?php if( $social_link_facebook ){ ?>
					<a target="_blank" href="<?php echo esc_url( $social_link_facebook ); ?>"><i class="fab fa-facebook-f"></i></a>
				<?php } ?>

				<?php if( $social_link_twitter ){ ?>
					<a target="_blank" href="<?php echo esc_url( $social_link_twitter ); ?>"><i class="fab fa-twitter"></i></a>
				<?php } ?>

				<?php if( $social_link_instagram ){ ?>
					<a target="_blank" href="<?php echo esc_url( $social_link_instagram ); ?>"><i class="fab fa-instagram"></i></a>
				<?php } ?>

				<?php if( $social_link_linkedin ){ ?>
					<a target="_blank" href="<?php echo esc_url( $social_link_linkedin ); ?>"><i class="fab fa-linkedin-in"></i></a>
				<?php } ?>

				<?php if( $social_link_youtube ){ ?>
					<a target="_blank" href="<?php echo esc_url( $social_link_youtube ); ?>"><i class="fab fa-youtube"></i></a>
				<?php } ?>

				<?php if( $social_link_pinterest ){ ?>
					<a target="_blank" href="<?php echo esc_url( $social_link_pinterest ); ?>"><i class="fab fa-pinterest-p"></i></a>
				<?php } ?>

				<?php if( $social_link_vk ){ ?>
					<a target="_blank" href="<?php echo esc_url( $social_link_vk ); ?>"><i class="fab fa-vk"></i></i></a>
				<?php } ?>

				<?php if( $social_link_reddit ){ ?>
					<a target="_blank" href="<?php echo esc_url( $social_link_reddit ); ?>"><i class="fab fa-reddit-alien"></i></a>
				<?php } ?>

				<?php if( $social_link_vimeo ){ ?>
					<a target="_blank" href="<?php echo esc_url( $social_link_vimeo ); ?>"><i class="fab fa-vimeo-v"></i></a>
				<?php } ?>

			</div>

		<?php }

	}

endif;

add_action( 'the_words_social_icon_action','the_words_social_icon' );

if( !function_exists('the_words_category_list') ):

	/** Post Category List **/
	function the_words_category_list(){
	    $cat_lists = get_categories(
	        array(
	            'hide_empty' => '0',
	            'exclude' => '1',
	        )
	    );
	    $cat_array = array();
	    $cat_array[] = esc_html__('--Choose Category--','the-words');
	    foreach( $cat_lists as $cat_list ){
	        $cat_array[$cat_list->slug] = $cat_list->name;
	    }
	    return $cat_array;
	}

endif;


if( !function_exists('the_words_count_category_posts') ):

	function the_words_count_category_posts( $category ) {
		
		if( is_string( $category ) ){

		    $catID = get_cat_ID( $category );

		}elseif( is_numeric( $category ) ) {

		    $catID = $category;

		}else{

		    return 0;

		}

		$cat = get_category( $catID );
		if( isset( $cat->count ) ){

			return $cat->count;

		}else{

			return false;

		}

	}

endif;

if( !function_exists('the_words_post_formate') ):

	function the_words_post_formate(){

	    $post_formate = esc_html( get_post_format( get_the_ID() ) );

	    if( $post_formate == 'gallery' ){
	        $icon_class = '<svg viewBox="0 0 512 512" class="svg-inline--fa"><path fill="currentColor" d="M528 32H112c-26.51 0-48 21.49-48 48v16H48c-26.51 0-48 21.49-48 48v288c0 26.51 21.49 48 48 48h416c26.51 0 48-21.49 48-48v-16h16c26.51 0 48-21.49 48-48V80c0-26.51-21.49-48-48-48zm-48 400c0 8.822-7.178 16-16 16H48c-8.822 0-16-7.178-16-16V144c0-8.822 7.178-16 16-16h16v240c0 26.51 21.49 48 48 48h368v16zm64-64c0 8.822-7.178 16-16 16H112c-8.822 0-16-7.178-16-16V80c0-8.822 7.178-16 16-16h416c8.822 0 16 7.178 16 16v288zM176 200c30.928 0 56-25.072 56-56s-25.072-56-56-56-56 25.072-56 56 25.072 56 56 56zm0-80c13.234 0 24 10.766 24 24s-10.766 24-24 24-24-10.766-24-24 10.766-24 24-24zm240.971 23.029c-9.373-9.373-24.568-9.373-33.941 0L288 238.059l-31.029-31.03c-9.373-9.373-24.569-9.373-33.941 0l-88 88A24.002 24.002 0 0 0 128 312v28c0 6.627 5.373 12 12 12h360c6.627 0 12-5.373 12-12v-92c0-6.365-2.529-12.47-7.029-16.971l-88-88zM480 320H160v-4.686l80-80 48 48 112-112 80 80V320z" ></path></svg>';
	    }elseif( $post_formate == 'link' ){
	        $icon_class = '<svg viewBox="0 0 512 512" class="svg-inline--fa"><path fill="currentColor" d="M301.148 394.702l-79.2 79.19c-50.778 50.799-133.037 50.824-183.84 0-50.799-50.778-50.824-133.037 0-183.84l79.19-79.2a132.833 132.833 0 0 1 3.532-3.403c7.55-7.005 19.795-2.004 20.208 8.286.193 4.807.598 9.607 1.216 14.384.481 3.717-.746 7.447-3.397 10.096-16.48 16.469-75.142 75.128-75.3 75.286-36.738 36.759-36.731 96.188 0 132.94 36.759 36.738 96.188 36.731 132.94 0l79.2-79.2.36-.36c36.301-36.672 36.14-96.07-.37-132.58-8.214-8.214-17.577-14.58-27.585-19.109-4.566-2.066-7.426-6.667-7.134-11.67a62.197 62.197 0 0 1 2.826-15.259c2.103-6.601 9.531-9.961 15.919-7.28 15.073 6.324 29.187 15.62 41.435 27.868 50.688 50.689 50.679 133.17 0 183.851zm-90.296-93.554c12.248 12.248 26.362 21.544 41.435 27.868 6.388 2.68 13.816-.68 15.919-7.28a62.197 62.197 0 0 0 2.826-15.259c.292-5.003-2.569-9.604-7.134-11.67-10.008-4.528-19.371-10.894-27.585-19.109-36.51-36.51-36.671-95.908-.37-132.58l.36-.36 79.2-79.2c36.752-36.731 96.181-36.738 132.94 0 36.731 36.752 36.738 96.181 0 132.94-.157.157-58.819 58.817-75.3 75.286-2.651 2.65-3.878 6.379-3.397 10.096a163.156 163.156 0 0 1 1.216 14.384c.413 10.291 12.659 15.291 20.208 8.286a131.324 131.324 0 0 0 3.532-3.403l79.19-79.2c50.824-50.803 50.799-133.062 0-183.84-50.802-50.824-133.062-50.799-183.84 0l-79.2 79.19c-50.679 50.682-50.688 133.163 0 183.851z" ></path></svg>';
	    }elseif( $post_formate == 'image' ){
	        $icon_class = '<svg viewBox="0 0 512 512" class="svg-inline--fa"><path fill="currentColor" d="M32 58V38c0-3.3 2.7-6 6-6h116c3.3 0 6 2.7 6 6v20c0 3.3-2.7 6-6 6H38c-3.3 0-6-2.7-6-6zm344 230c0-66.2-53.8-120-120-120s-120 53.8-120 120 53.8 120 120 120 120-53.8 120-120zm-32 0c0 48.5-39.5 88-88 88s-88-39.5-88-88 39.5-88 88-88 88 39.5 88 88zm-120 0c0-17.6 14.4-32 32-32 8.8 0 16-7.2 16-16s-7.2-16-16-16c-35.3 0-64 28.7-64 64 0 8.8 7.2 16 16 16s16-7.2 16-16zM512 80v352c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V144c0-26.5 21.5-48 48-48h136l33.6-44.8C226.7 39.1 240.9 32 256 32h208c26.5 0 48 21.5 48 48zM224 96h240c5.6 0 11 1 16 2.7V80c0-8.8-7.2-16-16-16H256c-5 0-9.8 2.4-12.8 6.4L224 96zm256 48c0-8.8-7.2-16-16-16H48c-8.8 0-16 7.2-16 16v288c0 8.8 7.2 16 16 16h416c8.8 0 16-7.2 16-16V144z" ></path></svg>';
	    }elseif( $post_formate == 'video' ){
	        $icon_class = '<svg viewBox="0 0 512 512" class="svg-inline--fa"><path fill="currentColor" d="M256 504c137 0 248-111 248-248S393 8 256 8 8 119 8 256s111 248 248 248zM40 256c0-118.7 96.1-216 216-216 118.7 0 216 96.1 216 216 0 118.7-96.1 216-216 216-118.7 0-216-96.1-216-216zm331.7-18l-176-107c-15.8-8.8-35.7 2.5-35.7 21v208c0 18.4 19.8 29.8 35.7 21l176-101c16.4-9.1 16.4-32.8 0-42zM192 335.8V176.9c0-4.7 5.1-7.6 9.1-5.1l134.5 81.7c3.9 2.4 3.8 8.1-.1 10.3L201 341c-4 2.3-9-.6-9-5.2z" ></path></svg>';
	    }elseif( $post_formate == 'quote' ){
	        $icon_class = '<svg viewBox="0 0 512 512" class="svg-inline--fa"><path fill="currentColor" d="M176 32H64C28.7 32 0 60.7 0 96v128c0 35.3 28.7 64 64 64h64v24c0 30.9-25.1 56-56 56H56c-22.1 0-40 17.9-40 40v32c0 22.1 17.9 40 40 40h16c92.6 0 168-75.4 168-168V96c0-35.3-28.7-64-64-64zm32 280c0 75.1-60.9 136-136 136H56c-4.4 0-8-3.6-8-8v-32c0-4.4 3.6-8 8-8h16c48.6 0 88-39.4 88-88v-56H64c-17.7 0-32-14.3-32-32V96c0-17.7 14.3-32 32-32h112c17.7 0 32 14.3 32 32v216zM448 32H336c-35.3 0-64 28.7-64 64v128c0 35.3 28.7 64 64 64h64v24c0 30.9-25.1 56-56 56h-16c-22.1 0-40 17.9-40 40v32c0 22.1 17.9 40 40 40h16c92.6 0 168-75.4 168-168V96c0-35.3-28.7-64-64-64zm32 280c0 75.1-60.9 136-136 136h-16c-4.4 0-8-3.6-8-8v-32c0-4.4 3.6-8 8-8h16c48.6 0 88-39.4 88-88v-56h-96c-17.7 0-32-14.3-32-32V96c0-17.7 14.3-32 32-32h112c17.7 0 32 14.3 32 32v216z" ></path></svg>';
	    }elseif( $post_formate == 'audio' ){
	        $icon_class = '<svg viewBox="0 0 512 512" class="svg-inline--fa"><path fill="currentColor" d="M342.91 193.57c-7.81-3.8-17.5-.48-21.34 7.5-3.81 7.97-.44 17.53 7.53 21.34C343.22 229.2 352 242.06 352 256s-8.78 26.8-22.9 33.58c-7.97 3.81-11.34 13.38-7.53 21.34 3.86 8.05 13.54 11.29 21.34 7.5C368.25 306.28 384 282.36 384 256s-15.75-50.29-41.09-62.43zM231.81 64c-5.91 0-11.92 2.18-16.78 7.05L126.06 160H24c-13.26 0-24 10.74-24 24v144c0 13.25 10.74 24 24 24h102.06l88.97 88.95c4.87 4.87 10.88 7.05 16.78 7.05 12.33 0 24.19-9.52 24.19-24.02V88.02C256 73.51 244.13 64 231.81 64zM224 404.67L139.31 320H32V192h107.31L224 107.33v297.34zM421.51 1.83c-7.89-4.08-17.53-1.12-21.66 6.7-4.13 7.81-1.13 17.5 6.7 21.61 84.76 44.55 137.4 131.1 137.4 225.85s-52.64 181.3-137.4 225.85c-7.82 4.11-10.83 13.8-6.7 21.61 4.1 7.75 13.68 10.84 21.66 6.7C516.78 460.06 576 362.67 576 255.99c0-106.67-59.22-204.06-154.49-254.16zM480 255.99c0-66.12-34.02-126.62-88.81-157.87-7.69-4.38-17.59-1.78-22.04 5.89-4.45 7.66-1.77 17.44 5.96 21.86 44.77 25.55 72.61 75.4 72.61 130.12s-27.84 104.58-72.61 130.12c-7.72 4.42-10.4 14.2-5.96 21.86 4.3 7.38 14.06 10.44 22.04 5.89C445.98 382.62 480 322.12 480 255.99z" ></path></svg>';
	    }else{
	        $icon_class = '';
	    }
	    if( $icon_class ){
	    ?>
	        <div class="post-formate-icon">

	            	<?php echo $icon_class; ?>

	        </div>
	    <?php
	    }

	}

endif;

if( !function_exists('the_words_featured_category') ):

	function the_words_featured_category(){
		
		$ed_featured_category_section = get_theme_mod('ed_featured_category_section',0);

		$ta_featured_categoey_1 = get_theme_mod('ta_featured_categoey_1');
		$ta_featured_categoey_2 = get_theme_mod('ta_featured_categoey_2');
		$ta_featured_categoey_3 = get_theme_mod('ta_featured_categoey_3');

		if( $ed_featured_category_section && ( $ta_featured_categoey_1  || 
			$ta_featured_categoey_1 || 
			$ta_featured_categoey_1 ) ){ ?>

			<div class="tw-featured-category">
				<div class="ta-container clearfix">
					<div class="tw-featured-category-secondary">

						<?php
						for( $x = 1; $x <= 6; $x++ ){

							$recent_post_category = get_theme_mod('ta_featured_categoey_'.$x);

					        if( $recent_post_category ){

					            $cat_info = get_category_by_slug( $recent_post_category );
					            $cat_link = get_category_link(  $cat_info->term_id );
					            $image = '';

					            if( function_exists('z_taxonomy_image_url') ):
					                $image = z_taxonomy_image_url( $cat_info->term_id,'large' );
					            endif;
					            ?>
					            <div class="featured-cat-item" >

					            	<a href="<?php echo esc_url( $cat_link ); ?>" class="featured-cat-item-main" <?php if( $image ){ ?> style="background-image: url('<?php echo esc_url( $image ); ?>')" <?php } ?> >

						            	<div class="featured-cat-item-secondary">

								            <div class="featured-item-cat ta-secondary-font" >

								                <?php if( isset( $cat_info->name ) && $cat_info->name ){ ?>

								                    <?php echo esc_html( $cat_info->name ); ?>

								                <?php } ?>

								            </div>

							            </div>

						            </a>

						        </div>
					            <?php

					        }
				        } ?>

				    </div>
			    </div>
			</div>

		<?php
		}

	}

endif;

if( ! function_exists( 'the_words_single_related_post' ) ) :

    /** Get Related Posts **/
    function the_words_single_related_post(){

    	$ed_related_posts = get_theme_mod('ed_related_posts',1);
    	if( !is_singular('post') || !$ed_related_posts ){
			return;
		}

        global $post;
        $cats = get_the_category( $post->ID );

        if( $cats ){

            $list_cats = array();
            foreach( $cats as $cat ){
                $list_cats[] = $cat->term_id; 
            }

        }

        $related_posts_query = new WP_Query( array( 'post_type' => 'post','posts_per_page' => 4,'post__not_in' => array( $post->ID, 'category__in' => $list_cats ) ) );

        if( $related_posts_query->have_posts() ): 
            
            $ed_related_post_title = get_theme_mod('ed_related_post_title',esc_html__( 'Related Posts','the-words' ) ); ?>

            <div class="single-related-posts clearfix">
                <div class="ta-container">

                    <?php if( $ed_related_post_title ){ ?>

                        <div class="related-sec-title">
                            <h2><?php echo esc_html( $ed_related_post_title ); ?></h2>
                        </div>

                    <?php } ?>

                    <div class="wrapr-related-posts">

                        <?php while( $related_posts_query->have_posts() ){
                            $related_posts_query->the_post();

                            $the_words_related_image = wp_get_attachment_image_src( get_post_thumbnail_id(),'the-words-grid' ); ?>

                            <div class="loop-related-conents ta-match-height">
                                <div class="related-img-contents">

                                	<?php if( isset( $the_words_related_image[0] ) && $the_words_related_image[0] ){ ?>
                                    <div class="related-image">
                                        <a href="<?php the_permalink(); ?>">

                                             <img src="<?php echo  esc_url( $the_words_related_image[0]); ?>" alt="<?php the_title_attribute(); ?>" title="<?php the_title_attribute(); ?>"/>
                                            
                                        </a>
                                    </div>
                                    <?php } ?>
                                    <div class="related-title-cat-date">

                                        <?php
                                        the_title( '<h2 class="entry-title ta-large-font ta-secondary-font"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
                                        ?>

                                        <footer class="entry-footer">

											<div class="entry-meta">
												<?php
												the_words_posted_by();
												the_words_posted_on();
												?>
											</div><!-- .entry-meta -->
												
										</footer><!-- .entry-footer -->

                                    </div>

                                </div>
                            </div>

                        <?php }
                        wp_reset_postdata(); ?>

                    </div>

                </div>
            </div>
        <?php endif;
    }

endif;

add_action('the_words_footer_content','the_words_single_related_post',10);

if( !function_exists('the_words_subescribe') ):

	function the_words_subescribe(){

		if( !is_front_page() ){
			return;
		}

		$ed_subscribe_section = get_theme_mod('ed_subscribe_section',0);
		$subscribe_form_title = get_theme_mod('subscribe_form_title',esc_html__('Subscribe Us For Latest News', 'the-words'));
		$subscribe_form_description = get_theme_mod('subscribe_form_description',esc_html__('It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.', 'the-words'));
		$subscribe_form_shortcode = get_theme_mod('subscribe_form_shortcode');
		if( $ed_subscribe_section && $subscribe_form_shortcode ){ ?>

		    <div class="ta-subescribe-section">
		        <div class="ta-container">
		                
		                <?php if( $subscribe_form_title || $subscribe_form_description ){ ?>

			                <div class="subescribe-section-title">

			                	<?php if( $subscribe_form_title ){ ?>

			                		<div class="subescribe-title-wrap">

			                			<span class="subescribe-title-icon">
						                	<svg viewBox="0 0 256 512" class="svg-inline--fa fa-chevron-right fa-w-8 fa-3x"><path fill="currentColor" d="M464 64H48C21.5 64 0 85.5 0 112v288c0 26.5 21.5 48 48 48h416c26.5 0 48-21.5 48-48V112c0-26.5-21.5-48-48-48zM48 96h416c8.8 0 16 7.2 16 16v41.4c-21.9 18.5-53.2 44-150.6 121.3-16.9 13.4-50.2 45.7-73.4 45.3-23.2.4-56.6-31.9-73.4-45.3C85.2 197.4 53.9 171.9 32 153.4V112c0-8.8 7.2-16 16-16zm416 320H48c-8.8 0-16-7.2-16-16V195c22.8 18.7 58.8 47.6 130.7 104.7 20.5 16.4 56.7 52.5 93.3 52.3 36.4.3 72.3-35.5 93.3-52.3 71.9-57.1 107.9-86 130.7-104.7v205c0 8.8-7.2 16-16 16z" class=""></path></svg>
						                </span>
						                
					                	<h2><?php echo esc_html( $subscribe_form_title ); ?></h2>
					                	
				                	</div>
				                <?php } ?>

				                <?php if( $subscribe_form_description ){ ?>
				                	<p><?php echo esc_html( $subscribe_form_description ); ?></p>
				                <?php } ?>

			                </div>

			            <?php } ?>

		                <div class="ta-mailchimp-form">
		                    <?php echo do_shortcode($subscribe_form_shortcode); ?>
		                </div>

		        </div>
		    </div>

		<?php }

	}

endif;

$ed_subscribe_section = get_theme_mod('ed_subscribe_section',1);
$ed_subscribe_section_at_top = get_theme_mod('ed_subscribe_section_at_top');

if( !$ed_subscribe_section_at_top ){
	add_action('the_words_footer_content','the_words_subescribe',20);
}

if( $ed_subscribe_section_at_top ){
	add_action('the_words_header_content','the_words_subescribe',20);
}

if( !function_exists('the_words_instagram') ):

	function the_words_instagram(){

		$ed_instagram_section = get_theme_mod('ed_instagram_section');
		$instagram_shortcode = get_theme_mod('instagram_shortcode');
		$ed_show_on_home_only = get_theme_mod('ed_show_on_home_only');

		if( $ed_show_on_home_only && !is_front_page() ){
			return;
		}

		if( $ed_instagram_section && $instagram_shortcode ){ ?>

		    <div class="ta-instafeed-section">
		    	<?php echo do_shortcode( $instagram_shortcode ); ?>
		    </div>

		<?php }

	}

endif;

add_action('the_words_footer_content','the_words_instagram',30);
