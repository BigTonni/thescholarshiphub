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
                            $html .= '<p>' . get_the_title() . '</p>';
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
    
    $curr_user = wp_get_current_user();
    $arr_ids = array();
 
    if (!empty($_POST) && check_admin_referer('tsh_action','tsh__nonce_field')) {        
            $arr_tax_subject_ids = !empty($_POST['tsh_tax_subject']) ? $_POST['tsh_tax_subject'] : array();
            $arr_ids['tax_subject'] = $arr_tax_subject_ids;
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
                    $cats = array('include' => array_map('intval', $arr_tax_subject_ids));

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
                    <div class="col-md-3">Courses:</div>
                    <div class="col-md-9">
                        <select class="form-control" name="tsh_tax_subject[]" multiple size="8">
                        <?php
                        
                        if( !empty($terms) ){
                            foreach ($terms as $term) { ?>
                                <option value="<?php echo $term->term_id; ?>" <?php echo in_array($term->term_id, $arr_tax_subject_ids) ? 'selected' : '';?>><?php echo $term->name; ?></option>
                            <?php }
                        }
                        ?>
                    </select>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="row">
                    <?php wp_nonce_field('tsh_action','tsh__nonce_field'); ?>
                    <input type="submit" class="btn btn-primary" value="Submit"/>
                </div>
            </div>
        </div>
    </div>
</form>
<?php
    $html = ob_get_clean();
    return $html;
}
add_shortcode('tsh_scholarship_email_options', 'tsh_scholarship_email_options_callback');