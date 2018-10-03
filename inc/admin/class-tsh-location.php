<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 *TSH_Location class.
 */
class TSH_Location {
    /**
	 * Constructor.
	 */
	public function __construct() {                
                add_action( 'init', array( $this, 'register_post_types' ) );

//                add_action( 'manage_posts_custom_column', array( $this, 'location_column' ), 10, 2 );
//                add_filter( 'manage_edit-location_columns', array( $this, 'location_columns' ), 5 );
        }
        
        public function register_post_types(){
            $labels = array(
			'name'              => __( 'Locations', THEME_DOMAIN ),
			'singular_name'     => __( 'Location', THEME_DOMAIN ),
			'add_new'           => __( 'Add New', THEME_DOMAIN ),
			'add_new_item'      => __( 'Add New Location', THEME_DOMAIN ),
			'edit_item'         => __( 'Edit Location', THEME_DOMAIN ),
			'new_item'          => __( 'New Location', THEME_DOMAIN ),
			'view_item'         => __( 'View Location', THEME_DOMAIN ),
			'search_items'      => __( 'Search Location', THEME_DOMAIN ),
			'not_found'         =>  __( 'No Location found', THEME_DOMAIN ),
			'not_found_in_trash'=> __( 'No Location found in the trash', THEME_DOMAIN ),
			'parent_item_colon' => '',
                        'menu_name'         => __( 'Locations', THEME_DOMAIN )
		);

		// Register the post type
		register_post_type( 'tsh_location',
			array(
                                'labels'            => $labels,
                                'singular_label'    => __( 'Location', THEME_DOMAIN ),
                                'public'            => true,
                                'show_ui'           => true,
                                '_builtin'          => false,
                                'show_in_menu'      => true,
                                'hierarchical'      => false,
                                'show_in_nav_menus' => false,
                                'query_var'         => false,
                                'supports'          => array( 'title' ),
                                'has_archive'       => false,
			)
		);
        }       
        
//        public function location_column ( $column, $post_id ) {
//	}
        
//        public function location_columns ( $columns ) {
//		return $columns;
//	}        
}
new TSH_Location();
