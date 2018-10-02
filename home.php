<?php
/**
 * The template for displaying blog posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
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
		
                                <?php if ( have_posts() ) : ?>

                                    <header class="page-header">
                                        <h1 class="page-title"><?php _e( 'Useful Articles', THEME_DOMAIN ); ?></h1>
                                            <?php
                                            the_archive_description( '<div class="archive-description">', '</div>' );
                                            ?>
                                    </header><!-- .page-header -->

                                    <?php
                                    /* Start the Loop */
                                    while ( have_posts() ) :
                                            the_post();

                                            /*
                                             * Include the Post-Type-specific template for the content.
                                             * If you want to override this in a child theme, then include a file
                                             * called content-___.php (where ___ is the Post Type name) and that will be used instead.
                                             */
                                            get_template_part( 'template-parts/content', 'blog-'.get_post_type() );

                                    endwhile;

                                    the_posts_navigation();

                                else :

                                        get_template_part( 'template-parts/content', 'none' );

                                endif;
                                ?>

                            </div>
                            
                            <div class="col-md-4 single_sidebar_wrap">
                                <?php get_sidebar('page'); ?>
                            </div>
                        </div>
                    </div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
