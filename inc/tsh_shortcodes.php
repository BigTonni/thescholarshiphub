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

            $is_active_email_plugin = defined( 'ELP_URL' ) ? true : false;

            if ($is_active_email_plugin) {
                
                global $wpdb;
                
                $_table = $wpdb->prefix .'elp_sendsetting';
                //Add new subscriber
                $user_firstname = ($curr_user->user_firstname == "") ? $curr_user->user_login : $curr_user->user_firstname;
                $user_mail = $curr_user->user_email;
                $group = 'group_'.$curr_user->ID;
                $inputdata = array($user_firstname, $user_mail, 'Confirmed', $group);
                $res_new_subscriber = elp_cls_dbquery::elp_view_subscriber_ins($inputdata);
                
                if (!empty($arr_tax_subject_ids) || !empty($arr_tax_institution_ids)) {
                    $arr_total = array_merge($arr_tax_subject_ids, $arr_tax_institution_ids);
                    //Is this record exists?
                    $elp_set_id = $wpdb->get_var("SELECT elp_set_id FROM {$_table} WHERE elp_set_emaillistgroup = '{$group}'");
                    $form = array(
                                'elp_set_name' => 'Send last scholarships',
                                'elp_set_templid' => '10',
                                'elp_set_totalsent' => 200,
                                'elp_set_unsubscribelink' => 'YES',
                                'elp_set_viewstatus' => 'YES',
                                //Why 110? Because the mailing list can go after midnight and the mailing list will be after midnight.
                                'elp_set_postcount' => 110,
                                'elp_set_postcategory' => (count($arr_total) > 1) ? implode(",", $arr_total) : $arr_total[0],
                                'elp_set_postorderby' => 'ID',
                                'elp_set_postorder' => 'DESC',
                                'elp_set_scheduleday' => '#0# -- #1# -- #2# -- #3# -- #4# -- #5# -- #6#',
                                'elp_set_scheduletime' => '23:55:00',
                                'elp_set_scheduletype' => 'Cron',
                                'elp_set_status' => 'On',
                                'elp_set_emaillistgroup' => $group,
                                'elp_set_posttype' => 'job_listing',
                                'elp_set_posttaxonomy' => 'tsh_tax_institution,tsh_tax_subject'
                    );
                    if ($elp_set_id != false) {
                        //Yes - Update
                        $inputdata = array($elp_set_id, $form['elp_set_name'], $form['elp_set_templid'], $form['elp_set_totalsent'], $form['elp_set_unsubscribelink'], 
						 	$form['elp_set_viewstatus'],$form['elp_set_postcount'], $form['elp_set_postcategory'],$form['elp_set_postorderby'], $form['elp_set_postorder']
							, $form['elp_set_scheduleday'], $form['elp_set_scheduletime'], $form['elp_set_scheduletype'], $form['elp_set_status'], $form['elp_set_emaillistgroup']
                                                        , $form['elp_set_posttype'], $form['elp_set_posttaxonomy'] );
                        
                        elp_cls_dbquery::elp_configuration_ins("update", $inputdata);
                    }else{
                        $inputdata = array($form['elp_set_name'], $form['elp_set_templid'], $form['elp_set_totalsent'], $form['elp_set_unsubscribelink'], 
						 	$form['elp_set_viewstatus'],$form['elp_set_postcount'], $form['elp_set_postcategory'],$form['elp_set_postorderby'], $form['elp_set_postorder']
							, $form['elp_set_scheduleday'], $form['elp_set_scheduletime'], $form['elp_set_scheduletype'], $form['elp_set_status'], $form['elp_set_emaillistgroup']
                                                        , $form['elp_set_posttype'], $form['elp_set_posttaxonomy'] );
                        
                        elp_cls_dbquery::elp_configuration_ins("insert", $inputdata);
                    }                    
       
                } else {
                        //Is exist these lines? No - Nothing
                        $res = $wpdb->get_var("SELECT COUNT(elp_set_id) FROM {$_table} WHERE elp_set_emaillistgroup = '{$group}'");
                        if ($res)
                        {
                           //Yes - Delete                                
                            $wpdb->delete( $_table, array( 'elp_set_emaillistgroup' => $group ) );
                        }
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
                                <input type="checkbox" name="tsh_tax_subject[]" value="<?php echo $pterm->term_id; ?>" <?php echo in_array($pterm->term_id, $arr_tax_subject_ids) ? 'checked' : '';?> class="parent_terms"/>
                                <label><?php echo $pterm->name; ?></label><br/>
                                <?php
                                $terms = get_terms( 'tsh_tax_subject', array( 'parent' => $pterm->term_id, 'orderby' => 'slug', 'hide_empty' => false ) );
                                //Get the Child terms
                                foreach ( $terms as $term ) {
                                    ?>
                                    <input type="checkbox" name="tsh_tax_subject[]" value="<?php echo $term->term_id; ?>" <?php echo in_array($term->term_id, $arr_tax_subject_ids) ? 'checked' : '';?> data-id="<?php echo $pterm->term_id; ?>"/>
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
