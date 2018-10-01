<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package thescholarshiphub
 */

if ( ! function_exists( 'thescholarshiphub_posted_on' ) ) {
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function thescholarshiphub_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date('d/m/Y') ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( 'Published %s', 'post date', THEME_DOMAIN ),
			$time_string
		);

		echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.

	}
}

if ( ! function_exists( 'thescholarshiphub_posted_by' ) ) {
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function thescholarshiphub_posted_by() {
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( 'by %s', 'post author', THEME_DOMAIN ),
			'<span class="author vcard">' . esc_html( get_the_author() ) . '</span>'
		);

		echo '<span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

	}
}

if ( ! function_exists( 'thescholarshiphub_entry_footer' ) ) {
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function thescholarshiphub_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', THEME_DOMAIN ) );
			if ( $categories_list ) {
				/* translators: 1: list of categories. */
				printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', THEME_DOMAIN ) . '</span>', $categories_list ); // WPCS: XSS OK.
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', THEME_DOMAIN ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', THEME_DOMAIN ) . '</span>', $tags_list ); // WPCS: XSS OK.
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', THEME_DOMAIN ),
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
					__( 'Edit <span class="screen-reader-text">%s</span>', THEME_DOMAIN ),
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
}

if ( ! function_exists( 'thescholarshiphub_post_thumbnail' ) ) {
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function thescholarshiphub_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) {
			?>

			<div class="post-thumbnail">
				<?php the_post_thumbnail(); ?>
			</div><!-- .post-thumbnail -->

                <?php } else { ?>

		<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
			<?php
			the_post_thumbnail( 'post-thumbnail', array(
				'alt' => the_title_attribute( array(
					'echo' => false,
				) ),
			) );
			?>
		</a>

		<?php
                } // End is_singular().
	}
}

if ( ! function_exists( 'thescholarshiphub_comments' ) ) {
	/**
	 * Displays comments.
	 */
	function thescholarshiphub_comments() {
		$num_comments = get_comments_number();

                $icon = '<i class="fa fa-comment"></i>';
                if ( comments_open() ) {
                        if ( $num_comments == 0 ) {
                                $comments = __('No Comments', THEME_DOMAIN);
                        } elseif ( $num_comments > 1 ) {
                                $comments =  $num_comments . '<br/>' . __(' view comments', THEME_DOMAIN);
                        } else {
                                $comments = '1<br/>' . __('Comment', THEME_DOMAIN);
                        }
                        $write_comments = $icon .' <a class="view_comments" href="' . get_comments_link() .'">'. $comments.'</a>';
                } else {
                        $write_comments =  __('Comments are off for this post.', THEME_DOMAIN);
                }
                echo $write_comments;
	}
}

if ( ! function_exists( 'thescholarshiphub_advanced' ) ) {
    function thescholarshiphub_advanced(){
        ?>
            <div class="entry-advanced">
                <div class="row">
                    <!--<div class="col-md-1">Share</div>-->
                    <div class="col-md-9">
                        <?php // echo do_shortcode('[addthis tool="addthis_inline_share_toolbox_hsbh"]'); ?>
                        <?php echo do_shortcode('[ssba-buttons]'); ?>
                    </div>
                    <div class="col-md-3" style="padding-left: 0px;padding-right: 0px;">
                        <?php thescholarshiphub_comments(); ?>
                    </div>                        
                </div>
            </div>
        <?php
    }
}
