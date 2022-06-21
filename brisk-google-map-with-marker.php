<?php
/**
* Plugin Name: Brisk Google Map With Marker
* Description: Create Google Maps in a minute with Brisk Google Map With Marker WordPress plugin add google map with shortcode
* Version: 1.0.0
* Requires PHP: 7.0
* Author: Briskstar Technologies LLP
* License: GPL v2 or later
**/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! defined( 'BGMWM_PLUGIN_FILE' ) ) {
    define( 'BGMWM_PLUGIN_FILE', __FILE__ );
}

// Enable error reporting in development
if(getenv('WPAE_DEV')) {
    error_reporting(E_ALL ^ E_DEPRECATED );
    ini_set('display_errors', 1);
    // xdebug_disable();
}

// Include the main BriskGoogleMapWithMarker class.
if ( ! class_exists( 'BriskGoogleMapWithMarker', false ) ) {
    include_once(dirname( BGMWM_PLUGIN_FILE ) . '/includes/class-google-map-with-marker.php');
}

// phpcs:ignore WordPress.NamingConventions.ValidFunctionName.FunctionNameInvalid
function BGMWM() { 
    return BriskGoogleMapWithMarker::instance();
}



$GLOBALS['BriskGoogleMapWithMarker'] = BGMWM();
?>