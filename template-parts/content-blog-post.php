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
            
		<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
            
                <div class="entry-meta">
                        <?php
                        thescholarshiphub_posted_on();
                        thescholarshiphub_posted_by();                        
                        ?>
                </div><!-- .entry-meta -->
                
                <?php // thescholarshiphub_advanced(); ?>
                
	</header><!-- .entry-header -->

	<?php thescholarshiphub_post_thumbnail(); ?>

	<div class="entry-content">
		<?php
                echo wp_trim_words(get_the_content(), 40);

		?>
	</div><!-- .entry-content -->
        
        <?php // thescholarshiphub_advanced(); ?>

	<footer class="entry-footer"></footer><!-- .entry-footer -->
</article><!-- #post -->
