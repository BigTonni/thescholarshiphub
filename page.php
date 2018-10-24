<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package thescholarshiphub
 */

get_header();
global $post;
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

                                        get_template_part( 'template-parts/content', 'page' );

                                        // If comments are open or we have at least one comment, load up the comment template.
                                        if ( comments_open() || get_comments_number() ) :
                                                comments_template();
                                        endif;

                                endwhile; // End of the loop.
                                ?>
                            </div>
                            
                            <div class="col-md-4 single_sidebar_wrap">
                                <?php 
                                    if(is_page('guide-to-uk-degree-apprenticeships') || $post->post_parent > 0){
                                        get_sidebar('page-guide-to-uk-degree');
                                    }
                                    else{
                                        get_sidebar('page');
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
echo tsh_edf_info();
get_footer();
