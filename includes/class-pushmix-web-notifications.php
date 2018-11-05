<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://github.com/pushmix/wordpress-web-notifications
 * @since      1.0.0
 *
 * @package    Pushmix_Web_Notifications
 * @subpackage Pushmix_Web_Notifications/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Pushmix_Web_Notifications
 * @subpackage Pushmix_Web_Notifications/includes
 * @author     Pushmix <support@pushmix.co.uk>
 */
class Pushmix_Web_Notifications {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Pushmix_Web_Notifications_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'PUSHMIX_PLUGIN_NAME_VERSION' ) ) {
			$this->version = PUSHMIX_PLUGIN_NAME_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'pushmix-web-notifications';

		$this->autoload();
		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}
	/***/

	/**
	 * Autoload Pushmix Classes
	 * @return [type] [description]
	 */
	private function autoload(){

		spl_autoload_register(function ($class) {


		    // project-specific namespace prefix
		    $prefix = 'PushmixWebNotifications\\';

		    // base directory for the namespace prefix
		    $base_dir = PUSHMIX_PLUGIN_DIR_CLASSES .'/';

		    // does the class use the namespace prefix?
		    $len = strlen($prefix);
		    if (strncmp($prefix, $class, $len) !== 0) {
		        // no, move to the next registered autoloader
		        return;
		    }

		    // get the relative class name
		    $relative_class = substr($class, $len);

		    // replace the namespace prefix with the base directory, replace namespace
		    // separators with directory separators in the relative class name, append
		    // with .php
		    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

		    // if the file exists, require it
		    if (file_exists($file)) {
		        require $file;
		    }
		});

	}
	/***/	

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Pushmix_Web_Notifications_Loader. Orchestrates the hooks of the plugin.
	 * - Pushmix_Web_Notifications_i18n. Defines internationalization functionality.
	 * - Pushmix_Web_Notifications_Admin. Defines all hooks for the admin area.
	 * - Pushmix_Web_Notifications_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-pushmix-web-notifications-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-pushmix-web-notifications-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-pushmix-web-notifications-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-pushmix-web-notifications-public.php';

		$this->loader = new Pushmix_Web_Notifications_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Pushmix_Web_Notifications_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Pushmix_Web_Notifications_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Pushmix_Web_Notifications_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

		// Add Settings
		$this->loader->add_action( 'admin_init', $plugin_admin, 'pushmix_settings_init' );
		// Load Menu
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'pushmix_add_menu' );		

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Pushmix_Web_Notifications_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Pushmix_Web_Notifications_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
