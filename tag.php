<?php
/**
 * The template for displaying post tag
 *
 * @package thescholarshiphub
 */

get_header();
global $wp_query;
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
?>

	<div id="primary" class="content-area post-listing">
		<main id="main" class="site-main">
                    <section class="single_banner">                        
                        <img src="https://via.placeholder.com/1000x200" alt="banner" />
                    </section>
                    
                    <div class="container">
                        <div class="row">
                            <div class="col-md-8">
                                <?php if ( have_posts() ) : ?>
                                    <header class="page-header">
                                            <?php 
                                            the_archive_title( '<h1 class="page-title">', '</h1>' );
                                            the_archive_description( '<div class="archive-description">', '</div>' );
                                            ?>
                                        </header><!-- .page-header -->
                                    <?php
                                    while ( have_posts() ) :
                                            the_post();

                                            get_template_part( 'template-parts/content', 'blog-post' );

                                    endwhile; // End of the loop.
                                    ?>
                                    <div class="blog-list-pagination">
                                        <span class="nav-previous"><?php previous_posts_link( '<<' ); ?></span>
                                        page <?php echo $paged; ?> of <?php echo $wp_query->max_num_pages; ?>
                                        <span class="nav-next"><?php next_posts_link( '>>', $wp_query->max_num_pages ); ?></span>
                                    </div>
                                <?php endif; ?>
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
