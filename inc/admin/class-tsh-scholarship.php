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
                add_action( 'init', array( $this, 'create_taxonomy' ) );
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
                                'show_in_menu'      => true,
                                'hierarchical'      => false,
                                'show_in_nav_menus' => false,
                                'query_var'         => false,
                                'supports'          => array( 'title' ),
                                'has_archive'       => false,
			)
		);
        }        
         
        public function create_taxonomy() {
            //Institution
            register_taxonomy('tsh_tax_institution','tsh_scholarship',array(
  //            'hierarchical' => false,
                'labels' =>  array(
                            'name'              => 'Institutions',
                            'singular_name'     => 'Institution',
                            'search_items'      => 'Search Institutions',
                            'all_items'         => 'All Institutions',
                            'view_item '        => 'View Institution',
    //			'parent_item'       => 'Parent Institution',
    //			'parent_item_colon' => 'Parent Institution:',
                            'edit_item'         => 'Edit Institution',
                            'update_item'       => 'Update Institution',
                            'add_new_item'      => 'Add New Institution',
                            'new_item_name'     => 'New Institution Name',
                            'menu_name'         => 'Institution',
                    ),
                'show_ui' => true,
                'show_in_nav_menus' => false,
    //            'show_admin_column' => true,
    //            'update_count_callback' => '_update_post_term_count',
                'query_var' => true,
    //            'rewrite' => array( 'slug' => 'tsh_institution' ),
                'meta_box_cb' => 'post_categories_meta_box'
            ));
            
            //Subject
            register_taxonomy('tsh_tax_subject','tsh_scholarship',array(
                'labels' =>  array(
                            'name'              => 'Subjects',
                            'singular_name'     => 'Subject',
                            'search_items'      => 'Search Subjects',
                            'all_items'         => 'All Subjects',
                            'view_item '        => 'View Subject',
                            'edit_item'         => 'Edit Subject',
                            'update_item'       => 'Update Subject',
                            'add_new_item'      => 'Add New Subject',
                            'new_item_name'     => 'New Subject Name',
                            'menu_name'         => 'Subject',
                    ),
                'show_ui' => true,
                'show_in_nav_menus' => false,
                'show_tagcloud'	=> false,
                'query_var' => true,
                'meta_box_cb' => 'post_categories_meta_box',
                'rewrite' => array( 'slug' => 'tsh_tax_subject','with_front' => false, 'hierarchical' => false ),
                'public' => true
            ));
            //Basis for Selection
            register_taxonomy('tsh_tax_basic_selection','tsh_scholarship',array(
                'labels' =>  array(
                            'name'              => 'Basis for Selection',
                            'singular_name'     => 'Basis for Selection',
                            'search_items'      => 'Search Basis',
                            'all_items'         => 'All Basis',
                            'view_item '        => 'View Basis',
                            'edit_item'         => 'Edit Basis',
                            'update_item'       => 'Update Basis',
                            'add_new_item'      => 'Add New Basis',
                            'new_item_name'     => 'New Basis Name',
                            'menu_name'         => 'Basis for Selection',
                    ),
                'show_ui' => true,
                'show_in_nav_menus' => false,
                'show_tagcloud'	=> false,
                'query_var' => true,
                'meta_box_cb' => 'post_categories_meta_box',
                'rewrite' => array( 'slug' => 'tsh_tax_basic_selection','with_front' => false, 'hierarchical' => false ),
                'public' => true
            ));
            //Level of Study
            register_taxonomy('tsh_tax_study_level','tsh_scholarship',array(
                'labels' =>  array(
                            'name'              => 'Levels of Study',
                            'singular_name'     => 'Level of Study',
                            'search_items'      => 'Search Levels',
                            'all_items'         => 'All Levels',
                            'view_item '        => 'View Level',
                            'edit_item'         => 'Edit Level',
                            'update_item'       => 'Update Level',
                            'add_new_item'      => 'Add New Level',
                            'new_item_name'     => 'New Level Name',
                            'menu_name'         => 'Level of Study',
                    ),
                'show_ui' => true,
                'show_in_nav_menus' => false,
                'show_tagcloud'	=> false,
                'query_var' => true,
                'meta_box_cb' => 'post_categories_meta_box',
                'rewrite' => array( 'slug' => 'tsh_tax_study_level','with_front' => false, 'hierarchical' => false ),
                'public' => true
            ));
        }
}
new TSH_Scholarship();
