<?php
/*
* Brisk Google Map with Marker
*/
defined( 'ABSPATH' ) || exit;
if ( class_exists( 'BGMWM_Admin_Menus', false ) ) {
	return new BGMWM_Admin_Menus();
}

class BGMWM_Admin_Menus {
	public function __construct() {
		// Add menus.
		add_action( 'admin_menu', array( $this, 'admin_menu' ), 50 );
		
	}

	public function BriskGoogleMap(){
		include( BGMWM_ADMIN_ABSPATH. 'views/google-map.php' );
	}
	
	/**
	 * Add menu items.
	 */
	public function admin_menu() {
		add_menu_page( __( 'Brisk Google Map', 'Brisk Google Map' ), __( 'Brisk Google Map', 'Brisk Google Map' ), 'edit_pages', 'brisk-google-map', array( $this, 'BriskGoogleMap' ), null, '55.5' );
	}

	


}
return new BGMWM_Admin_Menus();
?>