<?php
/**
 * Plugin Name:     Profile Field Duplicator for BuddyPress
 * Plugin URI:      https://bhargavb.com/buddypress-profile-field-duplicator-wordpress-plugin/
 * Description:     Make a duplicate of BuddyPress profile fields.
 * Author:          Bunty
 * Author URI:      https://bhargavb.com/
 * Text Domain:     bp-profile-field-duplicator
 * Domain Path:     /languages
 * Version:         1.2.0
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
	define( 'BPPFC_VERSION', '1.2.0' );
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
 * Display an admin notice when BuddyPress is not active.
 *
 * @return void
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
		/* translators: %1$s: Plugin name. */
		__( '%1$s works with BuddyPress only. Please activate BuddyPress or deactivate %1$s.', 'bp-profile-field-duplicator' ),
		$plugin_name
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
