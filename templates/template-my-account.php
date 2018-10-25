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
            
                    <div class="container">
                            <div class="col-md-12">
                                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                        <div class="entry-content">
                                                <div class="col-md-12 tabs_container">
                                                        <?php
                                                        $user = wp_get_current_user();
                                                        $arr_scholarship_ids = array();
                                                        $is_email_premium_tab = false;
                                                        if ($user != false && defined( 'RCP_PLUGIN_DIR' ) && rcp_get_subscription_id() >= 2) {
                                                            $arr_scholarship_ids = get_user_meta($user->ID, '_scholarship_selected', true);
                                                            $arr_scholarship_ids = $arr_scholarship_ids != false ? $arr_scholarship_ids : array();
                                                            $is_email_premium_tab = rcp_get_subscription_id() == 3 ? true : false;
                                                        }
                                                        ?>
                                                        <ul class="nav nav-tabs">
                                                                <li role="presentation" class="active tab1" ><a data-tab="1" href="#">Your profile</a></li>
                                                                <li role="presentation" class="tab2" ><a data-tab="2" href="#">Your subscription</a></li>
                                                                <li role="presentation" class="tab3" ><a data-tab="3" href="#">Billing</a></li>
                                                                <?php
                                                                if (!empty($arr_scholarship_ids)) { ?>
                                                                    <li role="presentation" class="tab4" ><a data-tab="4" href="#">Favorited scholarship</a></li>
                                                                <?php }
                                                                if ($is_email_premium_tab || current_user_can('administrator')) { ?>
                                                                    <li role="presentation" class="tab5" ><a data-tab="5" href="#">Email alerts</a></li>                                                                    
                                                                <?php } ?>
                                                        </ul>
                                                        <div class="tab tab1 active"><?php echo do_shortcode('[rcp_profile_editor]');?></div>
                                                        <div class="tab tab2"><?php echo do_shortcode('[subscription_details]');?></div>
                                                        <div class="tab tab3"><?php echo do_shortcode('[rcp_update_card]');?></div>
                                                        <?php
                                                        if (!empty($arr_scholarship_ids)) { ?>
                                                            <div class="tab tab4"><?php echo do_shortcode('[tsh_favorited_scholarship ids="'. implode(',', $arr_scholarship_ids) .'"]');?></div>
                                                        <?php }
                                                        if ($is_email_premium_tab || current_user_can('administrator')) { ?>
                                                            <div class="tab tab5"><?php echo do_shortcode('[tsh_scholarship_email_options]');?></div>
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
get_footer();
