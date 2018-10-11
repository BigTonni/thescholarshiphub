<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package thescholarshiphub
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
                    <section class="single_banner">                        
                        <img src="https://via.placeholder.com/1000x200" alt="banner" />
                    </section>
                    
                    <div class="container">
                        <div class="row">
                            <div class="col-md-8">
                                <?php
                                while ( have_posts() ) :
                                        the_post();

                                        get_template_part( 'template-parts/content', 'blog-post' );

//                                        the_post_navigation();

                                        // If comments are open or we have at least one comment, load up the comment template.
                                        if ( comments_open() || get_comments_number() ) :
                                                comments_template();
                                        endif;

                                endwhile; // End of the loop.
                                ?>
                            </div>
                            
                            <div class="col-md-4 single_sidebar_wrap">
                                <?php get_sidebar('sidebar_single'); ?>
                            </div>
                        </div>
                    </div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
