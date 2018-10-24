<?php
/**
 * Template Name: Compare
 * 
 * @package thescholarshiphub
 */

get_header(); ?>

<div id="primary" class="content-area">
        <main id="main" class="site-main">
            <?php
                while ( have_posts() ) :
                        the_post(); ?>

                    <section class="single_banner default_page_banner">                        
                        <?php
                        $title = get_post_meta( get_the_ID(), '_tsh_short_title', true );
                        if( $title != false ){
                            echo '<h1 class="entry-title">'. $title .'</h1>';
                        }else{
                            the_title( '<h1 class="entry-title">', '</h1>' ); 
                        }
                        ?>
                    </section>

                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                    
                                        <?php the_title( '<h1 class="entry-title">', '</h1>' );  ?>

                                        <div class="entry-content">
                                                <?php
                                                the_content();
                                                ?>
                                        </div><!-- .entry-content -->

                                </article><!-- #post-->
                                <?php
                                // If comments are open or we have at least one comment, load up the comment template.
                                if ( comments_open() || get_comments_number() ) :
                                        comments_template();
                                endif;
                                ?>
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
