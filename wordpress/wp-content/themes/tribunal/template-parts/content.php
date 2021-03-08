<?php
/**
 * The default template for displaying content
 *
 * Used for both singular and index.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Tribunal
 * @since 1.0.0
 */
$tribunal_default = tribunal_get_default_theme_options();
$tribunal_archive_layout = esc_attr( get_theme_mod( 'tribunal_archive_layout',$tribunal_default['tribunal_archive_layout'] ) );
$global_sidebar_layout = esc_attr( get_theme_mod( 'global_sidebar_layout',$tribunal_default['global_sidebar_layout'] ) );

if(  $tribunal_archive_layout == 'default' || $tribunal_archive_layout == 'grid' || $tribunal_archive_layout == 'masonry' ){
	
	$image_size = 'medium_large';
	
}else{

	if( $global_sidebar_layout == 'no-sidebar' ){
		$image_size = 'full';
	}else{
		$image_size = 'large';
	}
	
}

?>
<div class="twp-archive-items twp-article-loaded">
    <article id="post-<?php the_ID(); ?>" <?php post_class('news-article news-article-bg'); ?>>
        <?php if( has_post_thumbnail() ){ ?>
            <div class="post-thumbnail mb-15">
                <?php
                $format = get_post_format(get_the_ID()) ?: 'standard';
                $icon = tribunal_post_format_icon($format);
                if (!empty($icon)) { ?>
                    <span class="top-right-icon"><i class="ion <?php echo esc_attr($icon); ?>"></i></span>
                <?php } ?>
                <?php tribunal_post_thumbnail( $image_size ); ?>

            </div>

        <?php } ?>

        <div class="post-content">

            <header class="entry-header">

                <?php
                if ( 'post' === get_post_type() ) { ?>

                    <div class="entry-meta">

                        <?php tribunal_entry_footer( $cats = true, $tags = false, $edits = false, $text = false, $icon = false ); ?>

                    </div>

                <?php  } ?>
                <h2 class="entry-title">

                    <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>

                </h2>

            </header>

            <div class="entry-meta">

                <?php
                tribunal_posted_by();
                tribunal_posted_on();
                ?>

            </div>

            <div class="entry-content entry-content-muted entry-content-small">
                <?php
                if( has_excerpt() ){

                    the_excerpt();

                }else{

                    echo esc_html( wp_trim_words( get_the_content(),25,'...' ) );

                } ?>

            </div>

        </div>

    </article>
</div>