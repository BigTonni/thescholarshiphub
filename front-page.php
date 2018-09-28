<?php
/**
 * The front page template file
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

get_header(); ?>

<div id="primary" class="content-area">
        <div class="slider_1">

            <div class="owl-carousel owl-theme slide-one">

                <div class="item">
                    <div class="slider-text">
                        <h2 class="slider-text_mod tagline_1">Find UK Scholarship Today</h2>
                        <p class="slider-text_mod tagline_2">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                        <div class="slider-text_mod">
                            <a class="jumpButton" href="">Get started today</a>
                        </div>
                    </div>
                    <img src="<?php echo THEME_DIR_URI; ?>/assets/img/slider1_slide1.jpg" alt="slider">
                </div>
                <div class="item">
                    <div class="slider-text">
                        <h2 class="slider-text_mod tagline_1">Find UK Scholarship Today</h2>
                        <p class="slider-text_mod tagline_2">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                        <div class="slider-text_mod">
                            <button class="jumpButton" type="button">
                                Get started today
                            </button>
                        </div>
                    </div>
                    <img src="<?php echo THEME_DIR_URI; ?>/assets/img/slider1_slide1.jpg" alt="slider">
                </div>

            </div> <!-- owl-carousel -->

        </div> <!-- /slider_1 -->
	<main id="main" class="site-main" role="main">

		<?php // Show the selected frontpage content.
		if ( have_posts() ) :
			while ( have_posts() ) : the_post(); ?>
                            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                                    <?php thescholarshiphub_post_thumbnail(); ?>

                                    <div class="entry-content">
                                            <?php
                                            the_content();

                                            wp_link_pages( array(
                                                    'before' => '<div class="page-links">' . esc_html__( 'Pages:', THEME_DOMAIN ),
                                                    'after'  => '</div>',
                                            ) );
                                            ?>
                                    </div><!-- .entry-content -->
                            </article><!-- #post -->
                        <?php
			endwhile;
		endif; ?>		

	</main><!-- #main -->
        
        <!--Custom frontpage content-->
        <section class="user_status">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="user_status_image">
                            <img src="<?php echo THEME_DIR_URI; ?>/assets/img/user_status.jpg">                            
                        </div>
                        <div class="user_status_text">
                            <a href="#">
                                <div>Students</div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="user_status_image">
                            <img src="<?php echo THEME_DIR_URI; ?>/assets/img/user_status.jpg">                            
                        </div>
                        <div class="user_status_text">
                            <a href="#">
                                <div>Parents</div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="user_status_image">
                            <img src="<?php echo THEME_DIR_URI; ?>/assets/img/user_status.jpg">                            
                        </div>
                        <div class="user_status_text">
                            <a href="#">
                                <div>Teachers</div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- .user_status -->
        
        <section class="home_content_wrap">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-12">
                                <?php
                                $args = array(
                                    'posts_per_page' => 1,
                                    'meta_key' => '_tsh_featured',
                                    'meta_value' => 'yes'
                                );
                                $featured_post = new WP_Query($args);
                                if ($featured_post->have_posts()){
                                    while ($featured_post->have_posts()){ $featured_post->the_post();
                                        if (has_post_thumbnail()) { ?>
                                            <div class="featured_post_image">
                                                <?php the_post_thumbnail('full'); ?>                          
                                            </div>
                                        <?php } ?>
                                        
                                        <div class="featured_post_text">
                                            <h3><?php the_title(); ?></h3>
                                            <div><?php the_excerpt(); ?></div>
                                            <div class="read_more">
                                                <a href="<?php the_permalink(); ?>">Read more</a>                                                
                                            </div>
                                        </div>
                                
                                        <?php
                                    }    
                                }
                                ?>
                            </div>
                            
                            <div class="col-md-12" id="university_funding">
                                <h2>University Funding</h2>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h2>Degree Apprenticeships</h2>
                                    </div>                                    
                                    <div class="col-md-6">
                                        <h2>Fundraise your university costs</h2>
                                    </div>
                                </div>                                
                            </div>
                            
                        </div>
                    </div>
                    
                    <div class="col-md-4 home_sidebar_wrap">
                        <?php dynamic_sidebar( 'sidebar_home' ); ?>
                    </div>
                    
                </div>
                
            </div>
        </section><!-- .home_content_wrap -->                
        
</div><!-- #primary -->
<?php get_footer();
