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
	<div class="single-article">
		<div class="article-left-part">
			<div class="article-image"><?php thescholarshiphub_post_thumbnail(); ?></div>
		    <div class="autor-tags">
                    <?php
                    $author_id=$post->post_author; 
                    echo '<span class="autor-article">&#9733; ' . get_the_author_meta( 'user_nicename' , $author_id ) . '</span>'; 

                    echo '<span class="tags-article">&#9998; ' .get_the_tag_list(' ',',',''). '</span>';                       
                    ?>
            </div><!-- .entry-meta -->
		</div>
		<div class="article-right-part">
			<header class="entry-header">
		            
				<?php the_title( '<h2 class="single-article-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
		            		                
		                <?php // thescholarshiphub_advanced(); ?>
		                
			</header><!-- .entry-header -->

			<div class="entry-content">
				<?php
		                echo wp_trim_words(get_the_content(), 40);

				?>
			</div><!-- .entry-content -->
		        
			<div class="read-more-link"><a href="<?php echo get_permalink();?>">Read more</a></div>
			
		</div>
	</div>
</article><!-- #post -->
