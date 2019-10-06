<?php
/**
 * Plugin Name:     BuddyPress Profile Field Duplicator
 * Plugin URI:      bhargavb.wordpress.com
 * Description:     Make a duplicate of BuddyPress profile fields.
 * Author:          Bunty
 * Author URI:      bhargavb.wordpress.com/about-me
 * Text Domain:     bp-profile-field-duplicator
 * Domain Path:     /languages
 * Version:         1.1.0
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
	define( 'BPPFC_VERSION', '1.1.0' );
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
 * Apply transaltion file as per WP language.
 */
function bppfc_text_domain_loader() {

	// Get mo file as per current locale.
	$mofile = BPPFC_PATH . 'languages/' . get_locale() .'.mo';

	// If file does not exists, then applu default mo.
	if ( ! file_exists( $mofile ) ) {
		$mofile = BPPFC_PATH . 'languages/default.mo';
	}

	load_textdomain( 'bp-profile-field-duplicator', $mofile );
}

add_action( 'plugins_loaded', 'bppfc_text_domain_loader' );

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
