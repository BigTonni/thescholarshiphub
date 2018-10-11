<?php
/**
 * Template Name: My Account
 * 
 * @package thescholarshiphub
 */

get_header();
$options = get_option('TheScholarshipHub');
?>
<div id="primary" class="content-area">
        <main id="main" class="site-main">
            <?php
                while ( have_posts() ) :
                        the_post(); ?>
                    <section class="single_banner" style="background: #f6f6f6;">                        
                        <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
                    </section>
                    <div class="container">
                            <div class="col-md-12">
                                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                        <div class="entry-content">
											<div class="col-md-12 tabs_container">
												<ul class="nav nav-tabs">
													<li role="presentation" class="active tab1" ><a data-tab="1" href="#">Your profile</a></li>
													<li role="presentation" class="tab2" ><a data-tab="2" href="#">Your subscription</a></li>
													<li role="presentation" class="tab3" ><a data-tab="3" href="#">Billing</a></li>
												</ul>
												<div class="tab tab1 active"><?php echo do_shortcode('[rcp_profile_editor]');?></div>
												<div class="tab tab2"><?php echo do_shortcode('[subscription_details]');?></div>
												<div class="tab tab3"><?php echo do_shortcode('[rcp_update_card]');?></div>
											</div>
                                        </div><!-- .entry-content -->
                                </article><!-- #post-->
                            </div>
                    </div>
            <?php
            endwhile; // End of the loop.
            ?>
        </main><!-- #main -->
</div><!-- #primary -->
<?php
get_footer('without-edf');//edf = extra degree funding