<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * TSH_Admin_Menus Class.
 */
class TSH_Admin_Menus {
    /**
	 * Hook in tabs.
	 */
	public function __construct(){
            // Add menus
            add_action( 'admin_menu', array( $this, 'admin_menu' ), 9 );
//            add_action( 'admin_menu', array( $this, 'settings_menu' ), 50 );
            add_action( 'admin_head', array( $this, 'menu_order_count' ) );
        }
        
        /**
	 * Add menu items.
	 */
	public function admin_menu() {
		global $menu;

		if ( current_user_can( 'administrator' ) ) {
			$menu[] = array( '', 'read', 'separator-scholarshiphub', '', 'wp-menu-separator scholarshiphub' );
		}

		add_menu_page( __( 'ScholarshipHub', THEME_DOMAIN ), __( 'ScholarshipHub', THEME_DOMAIN ), 'administrator', 'scholarshiphub', null, null, '40.5' );
	}
        
        /**
	 * Add menu item.
	 */
//	public function settings_menu() {
//		add_submenu_page( 'scholarshiphub', __( 'Admin settings', THEME_DOMAIN ),  __( 'Admin settings', THEME_DOMAIN ) , 'administrator', 'tsh-settings', array( $this, 'settings_page' ) );
//	}
        
        /**
	 * Init the settings page.
	 */
//	public function settings_page() {
//	}
        
        /**
	 * Adds the order processing count to the menu.
	 */
	public function menu_order_count() {
		global $submenu;

		if ( isset( $submenu['scholarshiphub'] ) ) {
			// Remove 'ScholarshipHub' sub menu item
			unset( $submenu['scholarshiphub'][0] );
		}
	}
}
return new TSH_Admin_Menus();
