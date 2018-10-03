<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 *TSH_Admin class.
 */
class TSH_Admin {
    /**
	 * Constructor.
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'includes' ) );
        }
        
        /**
	 * Include any classes we need within admin.
	 */
	public function includes() {
            include_once( 'class-tsh-admin-menus.php' );
        }
}
return new TSH_Admin();
