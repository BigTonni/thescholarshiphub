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

$options = get_option('TheScholarshipHub');
get_header(); ?>

<div id="primary" class="content-area">
        <div class="slider_1">

            <div class="owl-carousel owl-theme slide-one">

                <div class="item">
                    <div class="slider-text">
                        <h2 class="slider-text_mod tagline_1"><?php echo !empty($options['1']) ? $options['1'] : ''; ?></h2>
                        <p class="slider-text_mod tagline_2"><?php echo !empty($options['2']) ? $options['2'] : ''; ?></p>
                        <div class="slider-text_mod">
                            <a class="jumpButton" href="<?php echo !empty($options['14']) ? $options['14'] : ''; ?>"><?php echo !empty($options['3']) ? $options['3'] : ''; ?></a>
                        </div>
                    </div>
                    <img src="<?php echo !empty($options['4']) ? $options['4'] : ''; ?>" alt="<?php _e('Slider Image', THEME_DOMAIN); ?>">
                </div>
                <div class="item">
                    <div class="slider-text">
                        <h2 class="slider-text_mod tagline_1"><?php echo !empty($options['5']) ? $options['5'] : ''; ?></h2>
                        <p class="slider-text_mod tagline_2"><?php echo !empty($options['6']) ? $options['6'] : ''; ?></p>
                        <div class="slider-text_mod">
                            <a class="jumpButton" href="<?php echo !empty($options['15']) ? $options['15'] : ''; ?>"><?php echo !empty($options['7']) ? $options['7'] : ''; ?></a>
                        </div>
                    </div>
                    <img src="<?php echo !empty($options['8']) ? $options['8'] : ''; ?>" alt="<?php _e('Slider Image', THEME_DOMAIN); ?>">
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
                        <div class="user_status_image tsh_border">
                            <img src="<?php echo THEME_DIR_URI; ?>/assets/img/user_status.jpg">                            
                        </div>
                        <div class="user_status_text">
                            <a href="#">
                                <div>Students</div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="user_status_image tsh_border">
                            <img src="<?php echo THEME_DIR_URI; ?>/assets/img/user_status.jpg">                            
                        </div>
                        <div class="user_status_text">
                            <a href="#">
                                <div>Parents</div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="user_status_image tsh_border">
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
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-12">
                                <?php
                                $args = array(
                                    'posts_per_page' => 1,
                                    'meta_key' => '_tsh_featured',
                                    'meta_value' => 'yes'
                                );
                                $the_query = new WP_Query($args);
                                if ($the_query->have_posts()){
                                    while ($the_query->have_posts()){ $the_query->the_post();
                                        if (has_post_thumbnail()) { ?>
                                            <div class="featured_post_image tsh_border">
                                                <?php the_post_thumbnail('full'); ?>                          
                                            </div>
                                        <?php } ?>
                                        
                                        <div class="featured_post_text">
                                            <h3><?php the_title(); ?></h3>
                                            <div><?php the_excerpt(); ?></div>
                                            <div class="read_more">
                                                <a href="<?php the_permalink(); ?>"><?php echo !empty($options['16']) ? $options['16'] : ''; ?></a>                                                
                                            </div>
                                        </div>
                                
                                        <?php
                                    }    
                                }
                                ?>
                            </div>
                            
                            <div class="col-md-12" id="university_funding">
                                <h2 class="tsh_header"><?php echo !empty($options['9']) ? $options['9'] : ''; ?></h2>
                                <?php
                                $args = array(
                                    'posts_per_page' => 4,
                                    'meta_key' => '_tsh_university_funding',
                                    'meta_value' => 'yes'
                                );
                                $the_query = new WP_Query($args);
                                if ($the_query->have_posts()){
                                    ?>
                                    <div class="grid">
                                        <?php
                                        while ($the_query->have_posts()){ $the_query->the_post();
                                            ?>
                                            <div class="item">
                                                <div class="row">
                                                    
                                                    <div class="col-md-6 university_funding_thumb">
                                                    <?php
                                                        if (has_post_thumbnail()) { ?>
                                                                <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('post-thumbnail'); ?></a>                     

                                                        <?php } ?>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <h4 class="university_funding_title"><?php the_title(); ?></h4>
                                                        <div class="university_funding_text"><?php echo wp_trim_words(get_the_content(), 10 ); ?></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        } ?>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h2 class="tsh_header"><?php echo !empty($options['10']) ? $options['10'] : ''; ?></h2>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <h2 class="tsh_header" style="text-transform: inherit;"><?php echo !empty($options['11']) ? $options['11'] : ''; ?></h2>
                                    </div>
                                </div>                                
                            </div>
                            
                        </div>
                    </div>
                    
                    <div class="col-md-3 home_sidebar_wrap">
                        <?php dynamic_sidebar( 'sidebar_home' ); ?>
                    </div>
                    
                </div>
                
            </div>
        </section><!-- .home_content_wrap -->                
        
</div><!-- #primary -->
<?php get_footer();
