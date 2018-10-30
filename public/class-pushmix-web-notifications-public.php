<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://github.com/pushmix/web-notification
 * @since      1.0.0
 *
 * @package    Pushmix_Web_Notifications
 * @subpackage Pushmix_Web_Notifications/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Pushmix_Web_Notifications
 * @subpackage Pushmix_Web_Notifications/public
 * @author     Pushmix <support@pushmix.co.uk>
 */
class Pushmix_Web_Notifications_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Pushmix_Web_Notifications_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Pushmix_Web_Notifications_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		// wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/pushmix-web-notifications-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Pushmix_Web_Notifications_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Pushmix_Web_Notifications_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		$allowed = get_option('__pm_allowed_pages');
		if(empty($allowed) === true){
			$allowed = [];
		}else{
			$pageIds = array_map('intval', json_decode($allowed));
		}
		#dd($pageIds);
		#dd(is_page('sample-page'));

		if( is_page( $pageIds ) ){

			$subscriber_id = get_option('__pm_subscription_id');
			#var_dump($subscriber_id);
			#dd($subscriber_id);

			wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/pushmix-web-notifications-public.js', array( 'jquery' ), $this->version, false );

			wp_localize_script( $this->plugin_name, '_pm', array(
			     "subscriber_id" => $subscriber_id,
			     "sw" => plugin_dir_url( __FILE__ ) . "js/pm_service_worker.js",
			     "api" => "https://www.pushmix.co.uk/api/",
			     "debug"	=> true	    
			) );	

		}	
	

	}

}
