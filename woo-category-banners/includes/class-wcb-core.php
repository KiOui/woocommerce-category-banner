<?php
/**
 * Woo Category Banners Core
 *
 * @package woo-category-banners
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'WcbCore' ) ) {
	/**
	 * Woo Category Banners core class.
	 *
	 * @class WcbCore
	 */
	class WcbCore {


		/**
		 * Plugin version
		 *
		 * @var string
		 */
		public string $version = '1.0.0';

		/**
		 * The single instance of the class
		 *
		 * @var WcbCore|null
		 */
		private static ?WcbCore $instance = null;

		/**
		 * Woo Category Banners Core
		 *
		 * Uses the Singleton pattern to load 1 instance of this class at maximum
		 *
		 * @static
		 * @return WcbCore
		 */
		public static function instance(): WcbCore {
			if ( is_null( self::$instance ) ) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		/**
		 * Constructor.
		 */
		private function __construct() {
			$this->define_constants();
			$this->actions_and_filters();
		}

		/**
		 * Define constants of the plugin.
		 */
		private function define_constants(): void {
			$this->define( 'WCB_ABSPATH', dirname( WCB_PLUGIN_FILE ) . '/' );
			$this->define( 'WCB_FULLNAME', 'woo-category-banners' );
		}

		/**
		 * Define if not already set.
		 *
		 * @param string $name  the name.
		 * @param string $value the value.
		 */
		private static function define( string $name, string $value ): void {
			if ( ! defined( $name ) ) {
				define( $name, $value );
			}
		}

		/**
		 * Initialise Presence Forms Core.
		 */
		public function init(): void {
			$this->initialise_localisation();
			do_action( 'woo_category_banners_init' );
		}

		/**
		 * Initialise the localisation of the plugin.
		 */
		private function initialise_localisation(): void {
			load_plugin_textdomain( 'woo-category-banners', false, plugin_basename( dirname( WCB_PLUGIN_FILE ) ) . '/languages/' );
		}

		/**
		 * Add pluggable support to functions.
		 */
		public function pluggable(): void {
			include_once WCB_ABSPATH . 'includes/wcb-functions.php';
		}

		/**
		 * Add actions and filters.
		 */
		private function actions_and_filters(): void {
			include_once WCB_ABSPATH . '/includes/class-wcb-settings.php';

			WcbSettings::instance();

			add_action( 'after_setup_theme', array( $this, 'pluggable' ) );
			add_action( 'init', array( $this, 'init' ) );
		}
	}
}
