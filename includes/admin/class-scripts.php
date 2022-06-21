<?php
/**
 * Handle frontend scripts
 *
 * @package Assets/Classes
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
/**
 * Frontend scripts class.
 */
class BGMWM_Frontend_Scripts {
    /**
     * Contains an array of script handles registered by BGMWM.
     *
     * @var array
     */
    private static $scripts = array();

    /**
     * Contains an array of script handles registered by BGMWM.
     *
     * @var array
     */
    private static $styles = array();

    /**
     * Contains an array of script handles localized by BGMWM.
     *
     * @var array
     */
    private static $wp_localize_scripts = array();
    /**
     * Hook in methods.
     */
    public static function init() {
        add_action( 'admin_enqueue_scripts', array( __CLASS__, 'load_scripts' ),9999 );
        add_action( 'admin_print_styles', array( __CLASS__, 'load_scripts' ),9999 );
    }

    
    /*
    * Register sample data export plugins scripts
    */
    private static function register_scripts() {
        $register_scripts = array(
            'custom' => array(
                'src'     => self::get_asset_url( 'assets/js/brisk-google-map.js'),
                'deps'    => array( 'jquery' ),
                'version' => '1.0',
            ),
        );
        foreach ( $register_scripts as $name => $props ) {
            self::register_script( $name, $props['src'], $props['deps'], $props['version'] );
        }
    }

    private static function register_script( $handle, $path, $deps = array( 'jquery' ), $version = BGMWM_VERSION, $in_footer = true ) {
        self::$scripts[] = $handle;
        wp_register_script( $handle, $path, $deps, $version, $in_footer );
        wp_enqueue_script($handle);
    }

    /**
     * Register all DM styles.
     */
    private static function register_styles() {
        $version = '';

        $register_styles = array(
            'style'    => array(
                'src'     => self::get_asset_url( 'assets/css/style.css' ),
                'deps'    => array(),
                'version' => $version,
                'has_rtl' => false,
            ),
        );
        foreach ( $register_styles as $name => $props ) {
            self::register_style( $name, $props['src'], $props['deps'], $props['version'], 'all', $props['has_rtl'] );
        }
    }

    private static function get_asset_url( $path ) {
        return apply_filters( 'get_asset_url', plugins_url( $path, BGMWM_PLUGIN_FILE ), $path );
    }
    
    private static function register_style( $handle, $path, $deps = array(), $version = BGMWM_VERSION, $media = 'all', $has_rtl = false ) {
        self::$styles[] = $handle;
        wp_register_style( $handle, $path, $deps, $version, $media );
        wp_enqueue_style($handle);
    }

    /*
     * Load all the script functions
     */
    public static function load_scripts() {
        global $post;
        self::register_scripts();
        self::register_styles();
        // CSS Styles.
    }

}
BGMWM_Frontend_Scripts::init();