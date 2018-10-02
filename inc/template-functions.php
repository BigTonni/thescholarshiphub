<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package thescholarshiphub
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function tsh_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
//	if ( ! is_active_sidebar( 'sidebar_single' ) ) {
//		$classes[] = 'no-sidebar';
//	}

	return $classes;
}
add_filter( 'body_class', 'tsh_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function tsh_pingback_header() {
	if (is_singular() && pings_open()) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'tsh_pingback_header' );

/**
 * Change menu.
 *
 * @param string $items.
 * @param object $args.
 * @return string
 */
function tsh_change_menu($items, $args) {
    if ($args->theme_location != 'primary') {
        return $items;
    }

    if (is_user_logged_in()) {
        $items .= '<li><a href="' . wp_logout_url() . '">' . __('Log Out', THEME_DOMAIN) . '</a></li>';
    } else {
        $items .= '<li><a href="' . wp_login_url() . '">' . __('Login', THEME_DOMAIN) . '</a></li>';
        $items .= '<li><a href="' . wp_registration_url() . '">' . __('Register', THEME_DOMAIN) . '</a></li>';
    }

    return $items;
}
add_filter('wp_nav_menu_items', 'tsh_change_menu', 199, 2);

/**
 * Add custom metaboxes
 */
function tsh_metabox_add() {
    add_meta_box( 'tsh_metabox_post_short_title', __( 'Short title', THEME_DOMAIN ), 'tsh_meta_callback_short_title', 'post' );
    add_meta_box( 'tsh_metabox_post_fea', __( 'Featured Posts', THEME_DOMAIN ), 'tsh_meta_callback_fea', 'post' );
    add_meta_box( 'tsh_metabox_post_university_funding', __( 'University Funding', THEME_DOMAIN ), 'tsh_meta_callback_university_funding', 'post' );
}
add_action( 'add_meta_boxes', 'tsh_metabox_add' );

function tsh_meta_callback_short_title( $post ) {
    $text = get_post_meta( $post->ID, '_tsh_short_title', true );
    
    wp_nonce_field( plugin_basename(__FILE__), 'tsh_metabox_main_nonce' );
    ?>    
            <label for="meta-text">
                <input type="text" name="tsh_field_short_title" size="30" value="<?php echo $text != false ? $text : ''; ?>"/>
            </label>
    <?php
}
function tsh_meta_callback_fea( $post ) {
    $checked = get_post_meta( $post->ID, '_tsh_featured', true );
    
    wp_nonce_field( plugin_basename(__FILE__), 'tsh_metabox_main_nonce' );
    ?>    
            <label for="meta-checkbox">
                <input type="checkbox" name="tsh_field_featured" id="tsh_field_featured" value="yes" <?php if ( isset ( $checked ) ) checked( $checked, 'yes' ); ?> />
                <?php _e( 'Featured this post', THEME_DOMAIN )?>
            </label>
    <?php
}
function tsh_meta_callback_university_funding( $post ) {
    $checked = get_post_meta( $post->ID, '_tsh_university_funding', true );
    
    wp_nonce_field( plugin_basename(__FILE__), 'tsh_metabox_main_nonce' );
    ?>    
            <label for="meta-checkbox">
                <input type="checkbox" name="tsh_field_university_funding" id="tsh_field_university_funding" value="yes" <?php if ( isset ( $checked ) ) checked( $checked, 'yes' ); ?> />
                <?php _e( 'University Funding', THEME_DOMAIN )?>
            </label>       
    <?php
}

/**
 * Saves custom metabox
 */
function tsh_metabox_save( $post_id ) {    
	if ( isset($_POST['tsh_metabox_main_nonce']) && ! wp_verify_nonce( $_POST['tsh_metabox_main_nonce'], plugin_basename(__FILE__) ) ){
		return;
        }
	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ){
		return;
        }

	update_post_meta( $post_id, '_tsh_short_title', isset( $_POST[ 'tsh_field_short_title' ] ) ? trim($_POST[ 'tsh_field_short_title' ]) : '' );
	update_post_meta( $post_id, '_tsh_featured', isset( $_POST[ 'tsh_field_featured' ] ) ? 'yes' : '' );
	update_post_meta( $post_id, '_tsh_university_funding', isset( $_POST[ 'tsh_field_university_funding' ] ) ? 'yes' : '' );
 
}
add_action( 'save_post', 'tsh_metabox_save' );

//Remove <p>
remove_filter( 'the_excerpt', 'wpautop' );
