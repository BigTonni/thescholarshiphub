<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package thescholarshiphub
 */
if( !is_user_logged_in() ){
    echo wp_redirect(site_url('/log-in/'));
}
else{
    get_header();
    ?>

    	<div id="primary" class="content-area">
    		<main id="main" class="site-main">
                        
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <?php
                                    while ( have_posts() ) :
                                            the_post();

                                            get_template_part( 'template-parts/content', get_post_type() );

                                    endwhile; // End of the loop.
                                    ?>
                                </div>
                            </div>
                        </div>
    		</main><!-- #main -->
    	</div><!-- #primary -->

    <?php
    get_footer('without-edf');
}
