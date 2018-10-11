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
                                                        <?php
                                                        $user = wp_get_current_user();
                                                        $arr_scholarship_ids = array();
                                                        if ($user != false) {
                                                            $arr_scholarship_ids = get_user_meta($user->ID, '_scholarship_selected', true);
                                                            $arr_scholarship_ids = $arr_scholarship_ids != false ? $arr_scholarship_ids : array();
                                                        }
                                                        ?>
                                                        <ul class="nav nav-tabs">
                                                                <li role="presentation" class="active tab1" ><a data-tab="1" href="#">Your profile</a></li>
                                                                <li role="presentation" class="tab2" ><a data-tab="2" href="#">Your subscription</a></li>
                                                                <li role="presentation" class="tab3" ><a data-tab="3" href="#">Billing</a></li>
                                                                <?php
                                                                if (!empty($arr_scholarship_ids)) { ?>
                                                                    <li role="presentation" class="tab3" ><a data-tab="4" href="#">Favorited scholarship</a></li>
                                                                <?php } ?>
                                                        </ul>
                                                        <div class="tab tab1 active"><?php echo do_shortcode('[rcp_profile_editor]');?></div>
                                                        <div class="tab tab2"><?php echo do_shortcode('[subscription_details]');?></div>
                                                        <div class="tab tab3"><?php echo do_shortcode('[rcp_update_card]');?></div>
                                                        <?php
                                                        if (!empty($arr_scholarship_ids)) { ?>
                                                            <div class="tab tab4"><?php echo do_shortcode('[tsh_favorited_scholarship ids="'. implode(',', $arr_scholarship_ids) .'"]');?></div>
                                                        <?php } ?>
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