<?php
/**
 * Plugin Name:     BuddyPress Profile Field Duplicator
 * Plugin URI:      bhargavb.wordpress.com
 * Description:     Make a duplicate of BuddyPress profile fields.
 * Author:          Bunty
 * Author URI:      bhargavb.wordpress.com/about-me
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

/**
 * Display admin notice if BuddyPress is not activated.
 */
function bppfc_admin_notice__error() {

	if ( function_exists( 'bp_is_active' ) ) {
		return;
	}

	// Notice class.
	$class = 'notice notice-error';

	// Get plugin name.
	$plugin_data = get_plugin_data( __FILE__ );
	$plugin_name = $plugin_data['Name'];

	// Display error if BuddyPress is not active.
	$message = sprintf(
		__( '%s works with BuddyPress only. Please activate BuddyPress or de-activate %s.', 'bp-profile-field-duplicator' ),
		esc_html( $plugin_name ),
		esc_html( $plugin_name )
	);

	printf(
		'<div class="%1$s"><p>%2$s</p></div>',
		esc_attr( $class ),
		esc_html( $message )
	);

}

add_action( 'admin_notices', 'bppfc_admin_notice__error' );

// Include admin functions file.
require BPPFC_PATH . 'app/admin/class-bp-profile-field-duplicator-admin.php';
