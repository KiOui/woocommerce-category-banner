<?php
/**
 * Settings Configuration Exception.
 *
 * @package woo-category-banners
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'SettingsConfigurationException' ) ) {
	/**
	 * Settings Configuration Exception.
	 *
	 * @class SettingsConfigurationException
	 */
	class SettingsConfigurationException extends Exception {

	}
}
