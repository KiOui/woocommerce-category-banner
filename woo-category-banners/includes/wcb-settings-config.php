<?php
/**
 * Settings configuration
 *
 * @package woo-category-banners
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

include_once WCB_ABSPATH . 'includes/settings/conditions/class-fieldssetsettingscondition.php';

if ( ! function_exists( 'wcb_get_settings_config' ) ) {
	/**
	 * Get the settings config.
	 *
	 * @return array The settings config.
	 */
	function wcb_get_settings_config(): array {
		return array(
			'group_name' => 'woo_category_banners_settings',
			'name' => 'woo_category_banners_settings',
			'settings' => array(),
		);
	}
}

if ( ! function_exists( 'wcb_get_settings_screen_config' ) ) {
	/**
	 * Get the settings screen config.
	 *
	 * @return array The settings screen config.
	 */
	function wcb_get_settings_screen_config(): array {
		return array(
			'page_title'        => esc_html__( 'Woo Category Banners', 'woo-category-banners' ),
			'menu_title'        => esc_html__( 'Woo Category Banners', 'woo-category-banners' ),
			'capability_needed' => 'edit_plugins',
			'menu_slug'         => 'wcb_admin_menu',
			'icon'              => 'dashicons-editor-ul',
			'position'          => 56,
			'settings_pages' => array(
				array(
					'page_title'        => esc_html__( 'Woo Category Banners Dashboard', 'woo-category-banners' ),
					'menu_title'        => esc_html__( 'Dashboard', 'woo-category-banners' ),
					'capability_needed' => 'edit_plugins',
					'menu_slug'         => 'wcb_admin_menu',
					'renderer'          => function () {
						include_once WCB_ABSPATH . 'views/woo-category-banners-dashboard-view.php';
					},
					'settings_sections' => array(),
				),
			),
		);
	}
}
