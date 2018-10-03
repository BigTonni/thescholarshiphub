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
//            include_once( 'sf-admin-functions.php' );
            include_once( 'class-tsh-admin-menus.php' );
//            include_once( 'class-sf-admin-assets.php' );
//            include_once( 'class-sf-admin-account-details.php' );
//            include_once( 'class-sf-admin-class-types.php' );
//            include_once( 'class-sf-admin-coupon-codes.php' );
        }
}
return new TSH_Admin();
