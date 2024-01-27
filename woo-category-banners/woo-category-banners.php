<?php
/**
 * Plugin Name: Woo Category Banners
 * Description: A plugin to display banners on WooCommerce product category pages.
 * Plugin URI: https://github.com/KiOui/woocommerce-category-banner
 * Version: 1.0.0
 * Author: Lars van Rhijn
 * Author URI: https://larsvanrhijn.nl/
 * Text Domain: woo-category-banners
 * Domain Path: /languages/
 *
 * @package woo-category-banners
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! defined( 'WCB_PLUGIN_FILE' ) ) {
	define( 'WCB_PLUGIN_FILE', __FILE__ );
}
if ( ! defined( 'WCB_PLUGIN_URI' ) ) {
	define( 'WCB_PLUGIN_URI', plugin_dir_url( __FILE__ ) );
}

require_once ABSPATH . 'wp-admin/includes/plugin.php';

if ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
	include_once __DIR__ . '/includes/class-wcb-core.php';
	$GLOBALS['WcbCore'] = WcbCore::instance();
} else {
	/**
	 * Display an admin notice when WooCommerce is inactive.
	 *
	 * @return void
	 */
	function wcb_admin_notice_woocommerce_inactive(): void {
		if ( is_admin() && current_user_can( 'edit_plugins' ) ) {
			echo '<div class="notice notice-error"><p>' . esc_html( __( 'Woo Category Banners requires WooCommerce to be active. Please activate WooCommerce to use Woo Category Banners.' ) ) . '</p></div>';
		}
	}
	add_action( 'admin_notices', 'wcb_admin_notice_woocommerce_inactive' );
}
