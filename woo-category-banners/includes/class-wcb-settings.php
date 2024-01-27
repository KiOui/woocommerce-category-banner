<?php
/**
 * Settings class
 *
 * @package woo-category-banners
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'WcbSettings' ) ) {
	/**
	 * Woo Category Banners Settings class
	 *
	 * @class WcbSettings
	 */
	class WcbSettings {


		/**
		 * The single instance of the class
		 *
		 * @var WcbSettings|null
		 */
		protected static ?WcbSettings $instance = null;

		/**
		 * The instance of the settings class.
		 *
		 * @var Settings
		 */
		private Settings $settings;

		/**
		 * The instance of the settings group class.
		 *
		 * @var SettingsGroup
		 */
		private SettingsGroup $settings_group;

		/**
		 * Woo Category Banners Settings instance
		 *
		 * Uses the Singleton pattern to load 1 instance of this class at maximum
		 *
		 * @static
		 * @return WcbSettings
		 */
		public static function instance(): WcbSettings {
			if ( is_null( self::$instance ) ) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		/**
		 * WcbSettings constructor.
		 */
		public function __construct() {
			include_once WCB_ABSPATH . 'includes/settings/settings-init.php';
			include_once WCB_ABSPATH . 'includes/wcb-settings-config.php';
			initialize_settings_fields();

			$this->settings = SettingsFactory::create_settings( wcb_get_settings_config() );
			$this->settings->initialize_settings();
			$this->settings_group = SettingsFactory::create_settings_group( wcb_get_settings_screen_config() );

			$this->actions_and_filters();
		}

		/**
		 * Register the settings group settings.
		 *
		 * @return void
		 */
		public function register_settings(): void {
			$this->settings_group->register( $this->settings );
		}

		/**
		 * Get the instance of the settings class.
		 *
		 * @return Settings The instance of the settings class.
		 */
		public function get_settings(): Settings {
			return $this->settings;
		}

		/**
		 * Add actions and filters.
		 */
		public function actions_and_filters(): void {
			add_action( 'admin_init', array( $this->settings, 'register' ) );
			add_action( 'admin_menu', array( $this, 'register_settings' ) );
			add_action( 'current_screen', array( $this, 'do_custom_actions' ), 99 );
		}

		/**
		 * Execute custom actions.
		 */
		public function do_custom_actions(): void {
			if ( get_current_screen()->id === 'toplevel_page_wcb_admin_menu' ) {
                // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized -- We are passing the nonce to nonce verification.
				if ( isset( $_POST['option_page'] ) && isset( $_POST['action'] ) && 'update' == $_POST['action'] && 'woo_category_banners_settings' === $_POST['option_page'] && isset( $_POST['_wpnonce'] ) && wp_verify_nonce( wp_unslash( $_POST['_wpnonce'] ), 'woo_category_banners_settings-options' ) ) {
					$this->settings->update_settings( $_POST );
					$this->settings->save_settings();
					wp_redirect( '/wp-admin/admin.php?page=wcb_admin_menu' );
					exit;
				}
			}
		}
	}
}
