<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://github.com/pushmix/wordpress-web-notifications
 * @since             1.0.0
 * @package           Pushmix_Web_Notifications
 *
 * @wordpress-plugin
 * Plugin Name:       Pushmix Web Notifications
 * Plugin URI:        https://github.com/pushmix/wordpress-web-notifications
 * Description:       Effectively re-engage your visitors with web push notifications, all major mobile and desktop browsers supported. Activate opt in prompt on selected pages and posts, push web notifications from Wordpress Dashboard. To get started activate Pushmix plugin and then go to Pushmix Settings page to enter your Subscription ID. Obtain your Free Subscription ID at <a href="https://www.pushmix.co.uk">pushmix.co.uk</a>
 * Version:           1.0.0
 * Author:            Pushmix
 * Author URI:        https://www.pushmix.co.uk
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       pushmix-web-notifications
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}


define('PUSHMIX_PLUGIN_DIR', WP_PLUGIN_DIR . "/" . plugin_basename(dirname(__FILE__)));
define('PUSHMIX_PLUGIN_URL', plugins_url(plugin_basename(dirname(__FILE__))));
define('PUSHMIX_PLUGIN_DIR_INCLUDES', PUSHMIX_PLUGIN_DIR . '/includes');
define('PUSHMIX_PLUGIN_DIR_ADMIN', PUSHMIX_PLUGIN_DIR . '/admin');
define('PUSHMIX_PLUGIN_DIR_PUBLIC', PUSHMIX_PLUGIN_DIR . '/public');
define('PUSHMIX_PLUGIN_DIR_CLASSES', PUSHMIX_PLUGIN_DIR . '/classes');

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'PUSHMIX_PLUGIN_NAME_VERSION', '1.0.0' );
setlocale(LC_ALL, 'en_GB.UTF-8');

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-pushmix-web-notifications-activator.php
 */
function activate_pushmix_web_notifications() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-pushmix-web-notifications-activator.php';
	Pushmix_Web_Notifications_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-pushmix-web-notifications-deactivator.php
 */
function deactivate_pushmix_web_notifications() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-pushmix-web-notifications-deactivator.php';
	Pushmix_Web_Notifications_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_pushmix_web_notifications' );
register_deactivation_hook( __FILE__, 'deactivate_pushmix_web_notifications' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-pushmix-web-notifications.php';

/**
 * Dump and Die Dev Function
 * @param type $var
 */
if( !function_exists('dd')){
    function dd($var = ''){
        die(var_dump($var));
    }
}
/***/


/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_pushmix_web_notifications() {

	$plugin = new Pushmix_Web_Notifications();
	$plugin->run();

}
run_pushmix_web_notifications();
