<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package thescholarshiphub
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
            
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
		the_content();

		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', THEME_DOMAIN ),
			'after'  => '</div>',
		) );
		?>
	</div><!-- .entry-content -->
        
        <?php thescholarshiphub_advanced_bottom(); ?>
</article><!-- #post-->
