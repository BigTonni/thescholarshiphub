<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package thescholarshiphub
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

                ?>
                <div class="entry-meta">
                        <?php
                        //thescholarshiphub_posted_on();
                        //thescholarshiphub_posted_by();                        
                        ?>
                </div><!-- .entry-meta -->
                
                <?php thescholarshiphub_advanced(); ?>
                
	</header><!-- .entry-header -->

	<?php // thescholarshiphub_post_thumbnail(); ?>

	<div class="entry-content">
		<?php
		the_content( sprintf(
			wp_kses(
				/* translators: %s: Name of current post. Only visible to screen readers */
				__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', THEME_DOMAIN ),
				array(
					'span' => array(
						'class' => array(),
					),
				)
			),
			get_the_title()
		) );

		?>
	</div><!-- .entry-content -->
        
        <?php thescholarshiphub_advanced_bottom(); ?>

	<footer class="entry-footer">
		<?php // thescholarshiphub_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post -->
