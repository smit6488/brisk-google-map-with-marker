<?php
/**
 * Brisk Google Map With Marker
 *
 * @package BriskGoogleMapWithMarker  1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Main BriskGoogleMapWithMarker Class.
 *
 * @class BriskGoogleMapWithMarker
 */
if (!class_exists('BriskGoogleMapWithMarker')) {

	final class BriskGoogleMapWithMarker {
		private static $instance;
		public $version 	= "1.0.0";
		public $wp_version  = "5.8.2";

		public static function instance() {
			if (!isset(self::$instance) && !(self::$instance instanceof BriskGoogleMapWithMarker)) {
				self::$instance = new BriskGoogleMapWithMarker;
			}
			return self::$instance;
		}

		public function __construct() {
			if (!$this->check_requirements()) {
				return;
			}

			$this->define_constants();
			$this->create_options();
			$this->includes();
			$this->init_hooks();
			//
			// Activation Hooks
			//
			
			register_deactivation_hook(__FILE__, array($this, 'deactivate'));
			register_uninstall_hook(__FILE__, 'BriskGoogleMapWithMarker::uninstall');
		}

		private function check_requirements() {
			global $wp_version;
			if (!version_compare($wp_version, $this->wp_version, '>=')) {
				return false;
			}
			return true;
		}


		public function init_hooks(){
			add_action('wp_enqueue_scripts', array($this, 'custom_scripts'));
			add_action('admin_enqueue_scripts', array($this, 'custom_scripts'));
		}

		/**
		 * Define BGMWM Constants.
		 */
		private function define_constants() {
			//$upload_dir = wp_upload_dir( null, false );

			$this->define( 'BGMWM_ABSPATH', dirname( BGMWM_PLUGIN_FILE ) . '/' );
			$this->define( 'BGMWM_ADMIN_ABSPATH', dirname( BGMWM_PLUGIN_FILE ) .'/includes/admin/');
			$this->define( 'BGMWM_PLUGIN_BASENAME', plugin_basename( BGMWM_PLUGIN_FILE ));
			$this->define( 'BGMWM_VERSION', $this->version );
			$this->define( 'BGMWM_DATE', date('Y-m-d H:i:s') );
			$this->define( 'BGMWM_NOTICE_MIN_PHP_VERSION', '7.2' );
			$this->define( 'BGMWM_NOTICE_MIN_WP_VERSION', '5.4' );
			$this->define( 'BGMWM_PLUGIN_URL', plugin_dir_url( __DIR__ ) );
		}


		private function define( $name, $value ) {
			if ( ! defined( $name ) ) {
				define( $name, $value );
			}
		}

		public function create_options(){
			if ( $this->is_request( 'admin' ) ) {
 				include_once(BGMWM_ADMIN_ABSPATH . 'class-admin.php');
  			}
		}

		public function includes() {
			/**
			 * Core classes.
			 */
			if ( $this->is_request( 'admin' ) ) {
				include_once( BGMWM_ADMIN_ABSPATH . 'class-admin.php' );
				include_once( BGMWM_ADMIN_ABSPATH . 'class-scripts.php' );
				//include_once( BGMWM_ADMIN_ABSPATH . 'class-ajax.php' );
			}else{
				include_once( BGMWM_ADMIN_ABSPATH . 'class-shortcode.php' );
			}
		}

		private function is_request( $type ) {
			if($type == 'admin') {
				return is_admin();
			}
		}

		public function custom_scripts(){ 
			?>
			<script type="text/javascript">
	    		var ajax_url = "<?php echo admin_url('admin-ajax.php'); ?>";
	    	</script>
			<?php 
		}
	}
}