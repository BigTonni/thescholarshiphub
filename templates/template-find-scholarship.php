<?php
/**
 * Template Name: Find Scholarship
 * 
 * @package thescholarshiphub
 */
if( !is_user_logged_in() ){
    echo wp_redirect(site_url('/log-in/'));
}
else{
get_header();
    ?>
<style>
    .level_free .sf-field-search, .level_free .scholarship-main-list>p{display: none;}
</style>

    <div id="primary" class="content-area">
            <main id="main" class="site-main">
                <?php
                    while ( have_posts() ) :
                            the_post(); ?>
                        <section class="single_banner default_page_banner">                    
                            <img src="https://via.placeholder.com/1200x200" alt="banner" />
                        </section>

                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                            <header class="entry-header">                                                        
                                                <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
                                            </header><!-- .entry-header -->
                                            <div class="list_scholarship" style="border-bottom: 2px solid #ccc;">
                                                <p>If this is the first time you have visited our site, we suggest you read our Guide to UK Scholarships before you start your
                                                    search.</p>
                                                <p>You can search for scholarships based on the course, the college or the reason for the award, or any combination of
                                                these. If you are looking for scholarships that are not specific to one particular university, select “no specific university”.
                                                Premium members can also search by keyword.</p>
                                                <p>The database was last updated on Monday 20th August, 2018.</p>
                                            </div>

                                    </article><!-- #post-->
                                </div>
                            </div>
                        </div>
                        <div class="scholarship-list-container">
                            <?php // thescholarshiphub_post_thumbnail(); ?>

                            <div class="entry-content <?php echo (defined( 'RCP_PLUGIN_DIR' ) && rcp_get_subscription_id() == 1) ? 'level_free' : ''; ?>">
                                <div class="scholarship-search-sidebar">
                                    <?php echo do_shortcode( '[searchandfilter id="727"]' ); ?>                                   
                                </div>
                                <div class="scholarship-main-list">
                                    <?php
                                    the_content();

                                    
                                    wp_link_pages( array(
                                            'before' => '<div class="page-links">' . esc_html__( 'Pages:', THEME_DOMAIN ),
                                            'after'  => '</div>',
                                    ) );
                                    ?>
                                    <div class="job_listings_custom">
                                        <?php echo do_shortcode('[searchandfilter id="727" show="results"]');?>
                                    </div>
                                </div>
                            </div><!-- .entry-content -->
                        </div>
                <?php
                endwhile; // End of the loop.
                ?>
            </main><!-- #main -->
    </div><!-- #primary -->

    <?php
    get_footer('without-edf');
}
