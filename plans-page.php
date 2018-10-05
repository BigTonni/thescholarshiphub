<?php
/**
 * Template Name: Plans Page
 * 
 * @package thescholarshiphub
 */
get_header(); ?>

<?php
global $rcp_options, $rcp_levels_db, $rcp_register_form_atts;
?>

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
                                        <header class="entry-header">                                                        


                                        </header><!-- .entry-header -->

                                        <?php // thescholarshiphub_post_thumbnail(); ?>

                                        <div class="entry-content">
                                                <?php
                                                //the_content();
                                                ?>

                                                <!-- show rcp levels -->
                                                <?php
                                                    $levels = rcp_get_subscription_levels( 'active' );
                                                    if( $levels ) : ?>
                                                        <div id="rcp_subscription_levels_plans">
                                                            <?php foreach( $levels as $key => $level ) : ?>
                                                                <div class="single_plan">
                                                                    <div class="single_plan_header">
                                                                        <div class="single_plan_title">
                                                                            <?php echo rcp_get_subscription_name( $level->id ); ?>
                                                                        </div>
                                                                        <div class="single_plan_price">
                                                                            <span class="rcp_price"><?php echo $level->price > 0 ? rcp_currency_filter( $level->price ) : __( 'FREE', 'rcp' ); ?></span>
                                                                            <span class="rcp_level_duration"><?php echo $level->duration > 0 ? 'per ' . $level->duration_unit : ''; ?></span>
                                                                        </div>
                                                                        <div class="register-button">
                                                                            <a href="<?php echo site_url('/register/');?>">Register Now</a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="single_plan_content">
                                                                        <div class="single_plan_description">
                                                                            <?php echo rcp_get_subscription_description( $level->id ); ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            <?php endforeach; ?>
                                                        </div>
                                                    <?php else : ?>
                                                        <p><strong><?php _e( 'You have not created any subscription levels yet', 'rcp' ); ?></strong></p>
                                                    <?php endif; ?>

                                                <!-- show testimonials -->    
                                                <div class="testimonials-section">
                                                    <h3>Testimonials</h3>
                                                    <?php echo do_shortcode("[testimonial_view id='1']");?>
                                                </div>
                                                <?php

                                                wp_link_pages( array(
                                                        'before' => '<div class="page-links">' . esc_html__( 'Pages:', THEME_DOMAIN ),
                                                        'after'  => '</div>',
                                                ) );
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
