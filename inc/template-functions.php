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
        
        if( is_admin_bar_showing() ){
            $classes[] = 'tsh_show_adminbar';
        }

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
        $items .= '<li><a href="' . wp_logout_url(home_url()) . '">' . __('Log Out', THEME_DOMAIN) . '</a></li>';
    } else {
        $items .= '<li><a href="' . site_url('/log-in/') . '">' . __('Login', THEME_DOMAIN) . '</a></li>';
        $items .= '<li><a href="' . site_url('/register/') . '">' . __('Register', THEME_DOMAIN) . '</a></li>';
    }

    return $items;
}
add_filter('wp_nav_menu_items', 'tsh_change_menu', 199, 2);

/**
 * Add custom metaboxes
 */
function tsh_metabox_add() {
    add_meta_box( 'tsh_metabox_post_short_title', __( 'Short title', THEME_DOMAIN ), 'tsh_meta_callback_short_title', array('post', 'page') );
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

//Add the fields for Post Category
if( taxonomy_exists('category') ){
    add_action('category_add_form_fields', 'tsh_category_fields_add', 10);
    add_action('category_edit_form_fields', 'tsh_category_fields_edit', 10, 2);
    add_action( 'admin_enqueue_scripts', 'tsh_admin_scripts' );
    add_action('edited_category', 'tsh_category_fields_save', 10, 2);
    add_action('create_category', 'tsh_category_fields_save', 10, 2);    
    add_filter('manage_edit-category_columns', 'tsh_category_columns');
    add_filter('manage_category_custom_column', 'tsh_category_column', 10, 3 );

}

function tsh_category_fields_add(){
    $image = tsh_placeholder_cat_img_src();
    ?>
    <div class="form-field">
            <label><?php _e( 'Thumbnail', THEME_DOMAIN ); ?></label>
            <div id="cat_thumbnail" style="float:left;margin-right:10px;"><img src="<?php echo $image; ?>" width="60px" height="60px" /></div>
            <div style="line-height:60px;">
                    <input type="hidden" id="cat_thumbnail_id" name="cat_thumbnail_id" />
                    <button type="button" class="upload_image_button button"><?php _e( 'Upload/Add image', THEME_DOMAIN ); ?></button>
                    <button type="button" class="remove_image_button button"><?php _e( 'Remove image', THEME_DOMAIN ); ?></button>
            </div>
            <script type="text/javascript">
                     // Only show the "remove image" button when needed
                     if ( ! jQuery('#cat_thumbnail_id').val() )
                             jQuery('.remove_image_button').hide();

                    // Uploading files
                    var file_frame;

                    jQuery(document).on( 'click', '.upload_image_button', function( event ){


                            event.preventDefault();

                            // If the media frame already exists, reopen it.
                            if ( file_frame ) {
                                    file_frame.open();
                                    return;
                            }

                            // Create the media frame.
                            file_frame = wp.media.frames.downloadable_file = wp.media({
                                    title: '<?php _e( 'Choose an image', THEME_DOMAIN ); ?>',
                                    button: {
                                            text: '<?php _e( 'Use image', THEME_DOMAIN ); ?>',
                                    },
                                    multiple: false
                            });

                            // When an image is selected, run a callback.
                            file_frame.on( 'select', function() {
                                    attachment = file_frame.state().get('selection').first().toJSON();

                                    jQuery('#cat_thumbnail_id').val( attachment.id );
                                    jQuery('#cat_thumbnail img').attr('src', attachment.url );
                                    jQuery('.remove_image_button').show();
                            });

                            // Finally, open the modal.
                            file_frame.open();
                    });

                    jQuery(document).on( 'click', '.remove_image_button', function( event ){
                            jQuery('#cat_thumbnail img').attr('src', '<?php echo tsh_placeholder_cat_img_src(); ?>');
                            jQuery('#cat_thumbnail_id').val('');
                            jQuery('.remove_image_button').hide();
                            return false;
                    });

            </script>
            <div class="clear"></div>
    </div>
    <?php
}

function tsh_category_fields_edit($term, $taxonomy){
    $image 		= '';
    $thumbnail_id = get_term_meta($term->term_id, '_thumbnail_id', true);
    if ( $thumbnail_id )
            $image = wp_get_attachment_thumb_url( $thumbnail_id );
    else
    {
            $image = tsh_placeholder_cat_img_src();	
    }
    ?>              
    <tr class="form-field">
            <th scope="row" valign="top"><label><?php _e( 'Thumbnail', THEME_DOMAIN ); ?></label></th>
            <td>
                    <div id="cat_thumbnail" style="float:left;margin-right:10px;"><img src="<?php echo $image; ?>" width="60px" height="60px" /></div>
                    <div style="line-height:60px;">
                            <input type="hidden" id="cat_thumbnail_id" name="cat_thumbnail_id" value="<?php echo $thumbnail_id; ?>" />
                            <button type="submit" class="upload_image_button button"><?php _e( 'Upload/Add image', THEME_DOMAIN ); ?></button>
                            <button type="submit" class="remove_image_button button"><?php _e( 'Remove image', THEME_DOMAIN ); ?></button>
                    </div>
                    <script type="text/javascript">
                            // Uploading files
                            var file_frame;

                            jQuery(document).on( 'click', '.upload_image_button', function( event ){

                                    event.preventDefault();

                                    // If the media frame already exists, reopen it.
                                    if ( file_frame ) {
                                            file_frame.open();
                                            return;
                                    }

                                    // Create the media frame.
                                    file_frame = wp.media.frames.downloadable_file = wp.media({
                                            title: '<?php _e( 'Choose an image', THEME_DOMAIN ); ?>',
                                            button: {
                                                    text: '<?php _e( 'Use image', THEME_DOMAIN ); ?>',
                                            },
                                            multiple: false
                                    });

                                    // When an image is selected, run a callback.
                                    file_frame.on( 'select', function() {
                                            attachment = file_frame.state().get('selection').first().toJSON();

                                            jQuery('#cat_thumbnail_id').val( attachment.id );
                                            jQuery('#cat_thumbnail img').attr('src', attachment.url );
                                            jQuery('.remove_image_button').show();
                                    });

                                    // Finally, open the modal.
                                    file_frame.open();
                            });

                            jQuery(document).on( 'click', '.remove_image_button', function( event ){
                                    jQuery('#cat_thumbnail img').attr('src', '<?php echo tsh_placeholder_cat_img_src(); ?>');
                                    jQuery('#cat_thumbnail_id').val('');
                                    jQuery('.remove_image_button').hide();
                                    return false;
                            });

                    </script>
                    <div class="clear"></div>
            </td>
    </tr>
    <?php
}

function tsh_admin_scripts() { wp_enqueue_media(); }

function tsh_category_fields_save($term_id){
    if (!isset($_POST['cat_thumbnail_id'])) {
        return;
    }
    update_term_meta( $term_id, '_thumbnail_id', absint( $_POST['cat_thumbnail_id'] ) );
}

function tsh_category_columns( $columns ){
    $columns['thumb'] = __( 'Image', THEME_DOMAIN );
    return $columns;
}
function tsh_category_column($columns, $column, $id){
    if ( $column == 'thumb' ) {
        $image 			= '';
        $thumbnail_id 	= get_term_meta($id, '_thumbnail_id', true);

        if ($thumbnail_id){
                $image = wp_get_attachment_thumb_url( $thumbnail_id );
        }else{
                $image = tsh_placeholder_cat_img_src();
        }
        $image = str_replace( ' ', '%20', $image );

        $columns .= '<img src="' . esc_url( $image ) . '" alt="Thumbnail" class="wp-post-image" height="48" width="48" />';
    }

    return $columns;
}
