<?php
/**
 * Plugin Name:     BuddyPress Profile Field Duplicator
 * Plugin URI:      bhargavb.wordpress.com
 * Description:     Make a duplicate of BuddyPress profile fields.
 * Author:          Bunty
 * Text Domain:     bp-profile-field-duplicator
 * Domain Path:     /languages
 * Version:         1.0.0
 *
 * @package         Bp_Profile_Field_Duplicator
 */

/**
 * Main file, contains the plugin metadata and activation processes
 *
 * @package    Bp_Profile_Field_Duplicator
 */
if ( ! defined( 'BPPFC_VERSION' ) ) {
	/**
	 * The version of the plugin.
	 */
	define( 'BPPFC_VERSION', '1.0.0' );
}
if ( ! defined( 'BPPFC_PATH' ) ) {
	/**
	 *  The server file system path to the plugin directory.
	 */
	define( 'BPPFC_PATH', plugin_dir_path( __FILE__ ) );
}
if ( ! defined( 'BPPFC_URL' ) ) {
	/**
	 * The url to the plugin directory.
	 */
	define( 'BPPFC_URL', plugin_dir_url( __FILE__ ) );
}
if ( ! defined( 'BPPFC_BASE_NAME' ) ) {
	/**
	 * The url to the plugin directory.
	 */
	define( 'BPPFC_BASE_NAME', plugin_basename( __FILE__ ) );
}

// Include admin functions file.
require BPPFC_PATH . 'app/admin/class-bp-profile-field-duplicator-admin.php';
