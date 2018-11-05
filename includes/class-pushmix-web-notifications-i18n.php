<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://github.com/pushmix/wordpress-web-notifications
 * @since      1.0.0
 *
 * @package    Pushmix_Web_Notifications
 * @subpackage Pushmix_Web_Notifications/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Pushmix_Web_Notifications
 * @subpackage Pushmix_Web_Notifications/includes
 * @author     Pushmix <support@pushmix.co.uk>
 */
class Pushmix_Web_Notifications_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'pushmix-web-notifications',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
