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
                        <button class="jumpButton" >
                            Get started today
                        </button>
                    </div>
                </div>
                <img src="<?php echo THEME_DIR_URI; ?>/assets/img/slider1_slide1.jpg" alt="slider">
            </div>
            <div class="item">
                <div class="slider-text">
                    <h2 class="slider-text_mod tagline_1">Find UK Scholarship Today</h2>
                    <p class="slider-text_mod tagline_2">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    <div class="slider-text_mod">
                        <button class="jumpButton" >
                            Get started today
                        </button>
                    </div>
                </div>
                <img src="<?php echo THEME_DIR_URI; ?>/assets/img/slider1_slide2.jpg" alt="slider">
            </div>
            <div class="item">
                <div class="slider-text">
                    <h2 class="slider-text_mod tagline_1">Find UK Scholarship Today</h2>
                    <p class="slider-text_mod tagline_2">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    <div class="slider-text_mod">
                        <button class="jumpButton" >
                            Get started today
                        </button>
                    </div>
                </div>
                <img src="<?php echo THEME_DIR_URI; ?>/assets/img/slider1_slide3.jpg" alt="slider">
            </div>

        </div> <!-- owl-carousel -->

    </div> <!-- /slider_1 -->
	<main id="main" class="site-main" role="main">

		<?php // Show the selected frontpage content.
		if ( have_posts() ) :
			while ( have_posts() ) : the_post();
				get_template_part( 'template-parts/page/content', 'front-page' );
			endwhile;
		else :
			get_template_part( 'template-parts/post/content', 'none' );
		endif; ?>		

	</main><!-- #main -->
</div><!-- #primary -->
<?php dynamic_sidebar( 'sidebar_home' ); ?>
<?php get_footer();
