<?php
/**
 * Template Name: Find Scholarship
 * 
 * @package thescholarshiphub
 */

get_header();
?>

<div id="primary" class="content-area">
        <main id="main" class="site-main">
            <?php
                while ( have_posts() ) :
                        the_post(); ?>
                    <section class="single_banner default_page_banner">                    
                        <img src="https://via.placeholder.com/1000x200" alt="banner" />
                    </section>

                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                        <header class="entry-header">                                                        
                                            <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
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

                                </article><!-- #post-->
                            </div>
                        </div>
                    </div>
            <?php
            endwhile; // End of the loop.
            ?>
        </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer('without-edf');
