<?php
if (!defined('ABSPATH')) {
    exit;
}
/*
 * Shortcodes
 */
function tsh_favorited_scholarship( $atts ){
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
add_shortcode('tsh_favorited_scholarship', 'tsh_favorited_scholarship');