<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 *TSH_Scholarship class.
 */
class TSH_Scholarship {
    /**
	 * Constructor.
	 */
	public function __construct() {                
                add_action( 'init', array( $this, 'register_post_types' ) );
        }
        
        public function register_post_types(){
            $labels = array(
			'name'              => __( 'Scholarships', THEME_DOMAIN ),
			'singular_name'     => __( 'Scholarship', THEME_DOMAIN ),
			'add_new'           => __( 'Add New', THEME_DOMAIN ),
			'add_new_item'      => __( 'Add New Scholarship', THEME_DOMAIN ),
			'edit_item'         => __( 'Edit Scholarship', THEME_DOMAIN ),
			'new_item'          => __( 'New Scholarship', THEME_DOMAIN ),
			'view_item'         => __( 'View Scholarship', THEME_DOMAIN ),
			'search_items'      => __( 'Search Scholarship', THEME_DOMAIN ),
			'not_found'         =>  __( 'No Scholarship found', THEME_DOMAIN ),
			'not_found_in_trash'=> __( 'No Scholarship found in the trash', THEME_DOMAIN ),
			'parent_item_colon' => '',
                        'menu_name'         => __( 'Scholarships', THEME_DOMAIN )
		);

		// Register the post type
		register_post_type( 'tsh_scholarship',
			array(
                                'labels'            => $labels,
                                'singular_label'    => __( 'Scholarship', THEME_DOMAIN ),
                                'public'            => true,
                                'show_ui'           => true,
                                '_builtin'          => false,
                                'show_in_menu'      => 'scholarshiphub',
                                'hierarchical'      => false,
                                'show_in_nav_menus' => false,
                                'query_var'         => false,
                                'supports'          => array( 'title' ),
                                'has_archive'       => false,
			)
		);
        }     
}
new TSH_Scholarship();
