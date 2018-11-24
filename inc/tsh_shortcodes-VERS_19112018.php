<?php
if (!defined('ABSPATH')) {
    exit;
}
/*
 * Shortcodes
 */
function tsh_favorited_scholarship_callback( $atts ){
        $html = '<h2>Your favorited scholarship:</h2>';
        if (!empty($atts['ids'])) {
            $args = array(
                'post_type' => 'job_listing',
                'post__in' => array_map('intval', explode(',', $atts['ids']))
            );        
            $the_query = new WP_Query( $args );
            if ( $the_query->have_posts() ) {
                    // The Loop
                    while ( $the_query->have_posts() ) { 
                            $the_query->the_post();
                            $html .= '<p><a href="'. get_permalink() .'">' . get_the_title() . '</a></p>';
                    }
                    wp_reset_postdata();
            }
        }        
        return $html;
}
add_shortcode('tsh_favorited_scholarship', 'tsh_favorited_scholarship_callback');

function tsh_extra_funding_box(){
    if( !is_user_logged_in() ){
        ob_start();
        ?>
            <div class="extra_funding_box_wrapper">
                <div class="extra_funding_box_content">
                    <div class="row">
                        <div class="col-md-9">
                            <h2 class="extra_funding_box_title">Are you looking for extra funding for your degree?</h2>
                            <p class="extra_funding_box_text">Find scholarships, grants, bursaries for university and more by searching our website. Millions of pounds worth of free money available. Don’t miss out!</p>
                        </div> 
                        <div class="col-md-3">
                            <p class="extra_funding_box_link"><a href="<?php echo site_url('/register/');?>">Sign Up Now</a></p>
                            <p class="extra_funding_box_update_text"><span class="alternative-font">We'll keep you updated</span></p>
                        </div>         
                    </div> 
                </div>                
            </div>
        <?php
        $html = ob_get_clean();
    }
    else{
        $html='';
    }
    return $html;
}   
add_shortcode('extra_funding_box', 'tsh_extra_funding_box');

function tsh_scholarship_email_options_callback(){
    $html = '';
    $args = array(
            'taxonomy' => 'tsh_tax_subject',
            'hide_empty' => false,
    );
    $terms = get_terms( $args );
    
    $args2 = array(
            'taxonomy' => 'tsh_tax_institution',
            'hide_empty' => false,
    );
    $terms_institution = get_terms( $args2 );    
    
    $curr_user = wp_get_current_user();
    $arr_ids = array();
 
    if (!empty($_POST) && check_admin_referer('tsh_action','tsh__nonce_field')) {        
            $arr_tax_subject_ids = !empty($_POST['tsh_tax_subject']) ? $_POST['tsh_tax_subject'] : array();
            $arr_tax_institution_ids = !empty($_POST['tsh_tax_institution']) ? $_POST['tsh_tax_institution'] : array();
            $arr_ids['tax_subject'] = $arr_tax_subject_ids;
            $arr_ids['tax_institution'] = $arr_tax_institution_ids;
            update_user_meta($curr_user->ID, '_scholarship_email_options', $arr_ids);

            //Add email alert to table        
            global $wpdb;
            $_table = $wpdb->prefix .'psn_rules';
            $alert_name = 'New scholarship for User_id '.$curr_user->ID;

            if (!empty($arr_tax_subject_ids))
            {        
                    $alert_post_type = 'job_listing';
                    $alert_status_before = 'anything';
                    $alert_status_after = 'publish';
                    $notification_subject = 'Published scholarship on [blog_name]';
                    $notification_body = 'Hi, [current_user_display_name]

A scholarship has just been published with name [post_title]. You can view the full article here:

[post_permalink]';
                    $recipient = array('admin');
                    $arr_total = array_merge($arr_tax_subject_ids, $arr_tax_institution_ids);
                    $cats = array('include' => array_map('intval', $arr_total));

                    //Is this record exists?
                    $res = $wpdb->get_var("SELECT COUNT(id) FROM {$_table} WHERE name = '{$alert_name}'");
                    if ($res)
                    {
                            //Yes - Update                                
                             $wpdb->update( $_table,
                                     array( 'categories' => serialize($cats) ),
                                     array( 'name' => $alert_name )
                             );
                    }
                    else
                    {
                            $wpdb->insert( $_table,
                                    array( 'name' => $alert_name, 'posttype' => $alert_post_type, 'status_before' => $alert_status_before, 'status_after' => $alert_status_after,
                                        'notification_subject' => $notification_subject, 'notification_body' => $notification_body, 'recipient' => serialize($recipient), 'categories' => serialize($cats),
                                        'service_email' => 1, 'cc_select' => '', 'bcc_select'=>'', 'bcc'=>'',
                                        'editor_restriction' => '', 'cc' => $curr_user->user_email),
                                    array( '%s','%s','%s','%s', '%s','%s','%s','%s', '%d','%s','%s','%s', '%s','%s' )
                            );
                    }
            }
            else
            {
                    //Is exist these lines? No - Nothing
                    $res = $wpdb->get_var("SELECT COUNT(id) FROM {$_table} WHERE name = '{$alert_name}'");
                    if ($res)
                    {
                       //Yes - Delete                                
                        $wpdb->delete( $_table, array( 'name' => $alert_name ) );
                    }
            }        
    }
    $arr_ids = get_user_meta($curr_user->ID, '_scholarship_email_options', true);
    //Maybe these options will be not last
    $arr_tax_subject_ids = isset($arr_ids['tax_subject']) ? $arr_ids['tax_subject'] : array();
    $arr_tax_institution_ids = isset($arr_ids['tax_institution']) ? $arr_ids['tax_institution'] : array();
    
    ob_start();
    ?>
<form action="" class="email_options" method="post">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Options for specific types of scholarships</h2>
            </div>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12 label_tsh_tax" data-tax="subject"><h3>Courses:</h3></div>
                    <div class="col-md-12" id="subject">
                        <?php                        
                        $parent_terms = get_terms( 'tsh_tax_subject', array( 'parent' => 0, 'orderby' => 'slug', 'hide_empty' => false ) );   
                        if( !empty($parent_terms) ){
                            foreach ( $parent_terms as $pterm ) {
                                //Get the Parent terms
                                ?>
                                <input type="checkbox" name="tsh_tax_subject[]" value="<?php echo $pterm->term_id; ?>" <?php echo in_array($pterm->term_id, $arr_tax_subject_ids) ? 'checked' : '';?>/>
                                <label><?php echo $pterm->name; ?></label><br/>
                                <?php
                                $terms = get_terms( 'tsh_tax_subject', array( 'parent' => $pterm->term_id, 'orderby' => 'slug', 'hide_empty' => false ) );
                                //Get the Child terms
                                foreach ( $terms as $term ) {
                                    ?>
                                    <input type="checkbox" name="tsh_tax_subject[]" value="<?php echo $term->term_id; ?>" <?php echo in_array($term->term_id, $arr_tax_subject_ids) ? 'checked' : '';?>/>
                                    <label><?php echo '-- ' . $term->name; ?></label><br/>
                                    <?php
                                }
                            }
                        }
                        /*if( !empty($terms) ){
                            foreach ($terms as $term) { ?>
                                <input type="checkbox" name="tsh_tax_subject[]" value="<?php echo $term->term_id; ?>" <?php echo in_array($term->term_id, $arr_tax_subject_ids) ? 'checked' : '';?>/>
                                <?php echo ($term->parent !== 0) ? '--' : ''; ?><label><?php echo $term->name; ?></label><br/>
                            <?php }
                        }*/
                        ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 label_tsh_tax" data-tax="institution"><h3>Institutions:</h3></div>
                    <div class="col-md-12" id="institution">
                        <?php                       
                        $parent_terms_institution = get_terms( 'tsh_tax_institution', array( 'parent' => 0, 'orderby' => 'slug', 'hide_empty' => false ) );   
                        if( !empty($parent_terms_institution) ){
                            foreach ( $parent_terms_institution as $pterm ) {
                                //Get the Parent terms
                                ?>
                                <input type="checkbox" name="tsh_tax_institution[]" value="<?php echo $pterm->term_id; ?>" <?php echo in_array($pterm->term_id, $arr_tax_institution_ids) ? 'checked' : '';?>/>
                                <label><?php echo $pterm->name; ?></label><br/>
                                <?php
                                $terms_institution = get_terms( 'tsh_tax_institution', array( 'parent' => $pterm->term_id, 'orderby' => 'slug', 'hide_empty' => false ) );
                                //Get the Child terms
                                foreach ( $terms_institution as $term ) {
                                    ?>
                                    <input type="checkbox" name="tsh_tax_institution[]" value="<?php echo $term->term_id; ?>" <?php echo in_array($term->term_id, $arr_tax_institution_ids) ? 'checked' : '';?>/>
                                    <label><?php echo '-- ' . $term->name; ?></label><br/>
                                    <?php
                                }
                            }
                        }
                        /*if( !empty($terms_institution) ){
                            foreach ($terms_institution as $term) { ?>
                                <input type="checkbox" name="tsh_tax_institution[]" value="<?php echo $term->term_id; ?>" <?php echo in_array($term->term_id, $arr_tax_institution_ids) ? 'checked' : '';?>/>
                                <?php echo ($term->parent !== 0) ? '--' : ''; ?><label><?php echo $term->name; ?></label><br/>
                            <?php }
                        }*/
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <?php wp_nonce_field('tsh_action','tsh__nonce_field'); ?>
                <input type="submit" class="btn btn-primary" value="Submit"/>
            </div>
        </div>
    </div>
</form>
<?php
    $html = ob_get_clean();
    return $html;
}
add_shortcode('tsh_scholarship_email_options', 'tsh_scholarship_email_options_callback');

function tsh_member_benefits_callback($atts){
        $is_access_level = !empty($atts['is_access_level']) ? boolval($atts['is_access_level']) : false;

        $html = '<h1>Member Benefits</h1>';        
        $html .= '<ul>';
        $html .= '<li>Download your members guide to finding scholarships <a href="/wp-content/uploads/2018/10/members_guide_to_find_funding.pdf">here</a></li>';
        $html .= '<li>Find out how set up your personalised subscriptions <a href="/setting-up-your-personalised-subscriptions/">here</a></li>';
        $html .= '<li>Find out about your premium features on the scholarships database <a href="/understanding-your-premium-membership-features/">here</a></li>';
        if($is_access_level){
            $html .= '<li><a href="/search-the-database-of-educational-grants/">Search the Database of Educational Grants</a></li>';
        }
        $html .= '</ul>';
        return $html;
}
add_shortcode('tsh_member_benefits', 'tsh_member_benefits_callback');

