<?php

use PushmixWebNotifications\PushmixClass;
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://github.com/pushmix/web-notification
 * @since      1.0.0
 *
 * @package    Pushmix_Web_Notifications
 * @subpackage Pushmix_Web_Notifications/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Pushmix_Web_Notifications
 * @subpackage Pushmix_Web_Notifications/admin
 * @author     Pushmix <support@pushmix.co.uk>
 */
class Pushmix_Web_Notifications_Admin {

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
	 * Pushmix Instance
	 */
	private $pm;

	/**
	 * Settings URL
	 */
	private $url_settings;

	/**
	 * Web Push Notification URL
	 */
	private $url_push;
        
        /**
         * Notice CSS classes
         */
        private $notice_css = [
            'success'   => 'notice-success',
            'error'     => 'notice-error',
            'warning'   => 'notice-warning',
            'info'      => 'notice-info'
        ];
        
	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		$this->pm = new PushmixClass();

		$this->url_settings = network_admin_url('admin.php?page=pushmix_settings');
		$this->url_push     = network_admin_url('admin.php?page=pushmix_web_notifications');
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles($hook) {

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
            #dd($hook);

            if( strpos($hook, 'pushmix') !== false ){

                wp_enqueue_style( 
                        'pm-css', 
                        plugin_dir_url( __FILE__ ) . 'css/pushmix-web-notifications-admin.css', 
                        array(), 
                        $this->version, 
                        'all' 
                );

                wp_enqueue_style( 
                        "dual-listbox-css", 
                        plugin_dir_url( __FILE__ ) . 'css/dual-listbox.css', 
                        array(), 
                        $this->version, 
                        'all' 
                );	

                            #dd($hook);			
            }


		

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts($hook) {

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
            #dd($hook);
            if( strpos($hook, 'pushmix') !== false ){


                wp_enqueue_script( "dual-listbox-js", plugin_dir_url( __FILE__ ) . 'js/dual-listbox.min.js', array( ), $this->version, false );

                wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/pushmix-web-notifications-admin.js', array( 'jquery' ), $this->version, false );			


                    #dd($hook);
            }		

	}
	/***/

	/**
	 * Initialize Settings
	 */
	public function pushmix_settings_init(){


 		$section_group = 'pushmix_settings';
 		$section_name = 'pushmix_post_types';
	    $args = array(
	            'type' => 'string', 
	            'sanitize_callback' => 'sanitize_text_field',
	            'default' => NULL,
	            );
	    register_setting( $section_group, $section_name, $args );	   

	}
	/***/




    /**
     * Add Plugin Menu
     */
    public function add_menu() {

		#dd('asdsd');

    	// Push Notification Page
        add_menu_page(
        	"Pushmix - Web Push Notification", 
        	'Pushmix', 
        	'manage_options', 
            'pushmix_web_notifications',
            [$this,'pushmix_push'], 
            'dashicons-megaphone',
            null
        );

        // Settings Page
		add_submenu_page( 
			'pushmix_web_notifications', 
			'Pushmix - Settigs', 
			'Settings',
    		'manage_options', 
    		'pushmix_settings',
    		[$this,'pushmix_settings']
    	);        

    }
    /***/	

    /**
     * Display Settings Page
     * Update setting on POST request
     */
    public function pushmix_settings(){
        
        // Notice array
        $msg = [];
        
        // Is environment Localhost
        if( $this->isLocalhost() ){
            
            array_push($msg, [
                'class'     => $this->notice_css['info'],
                'message'   => 'Local Environment detected - Opt in prompt will only be displayed under localhost domain name. <a href="#">More info</a>',
            ]);
            
        }
        
        // Is this POST request
        $is_post = isset($_POST['post_name']) || isset($_POST['subscription_id']);
        #dd($_POST['post_name']);
        
        // Is this POST request
        if( empty($is_post) === false ){
            
            // update settings
            $this->updateSettings();

            array_push($msg,[
                'class'     => $this->notice_css['success'],
                'message'   => 'Settings have been successfully updated.'
            ]);

        }
        // Get All Posts and Pages with publish status
        $all_pages = $this->getPages();
        #dd($all_pages);

        $url 			= $this->url_settings;
        $url_push		= $this->url_push;
        $subscription_id 	= get_option('__pm_subscription_id');
        $allowed 		= get_option('__pm_allowed_pages');

        #dd($subscription_id);
        require 'partials/pushmix-web-notifications-admin-settings.php';

    }
   /***/   

  /**
   * Diaplay Admin Page
   * @return [type] [description]
   */
    public function pushmix_push(){
        
       	$url        = $this->url_settings;
        $url_push   = $this->url_push;
        
        $subscription_id = get_option('__pm_subscription_id');
        
        /**
         * Has Subscription ID 
         */
        if( empty($subscription_id) === true){

            $all_pages = $this->getPages();
            $allowed   = get_option('__pm_allowed_pages');
            
            // no subscription ID - display settings interface
            require 'partials/pushmix-web-notifications-admin-settings.php';

        }else{
            // display push interface
            require 'partials/pushmix-web-notifications-admin-push.php';
        }

   }
   /***/  
   
   
    /**
     * Check if Wp is running on localhost or not
     * @return boolean - true if running on localhost
     */
    private function isLocalhost(){
        #return false;

        return in_array($_SERVER['REMOTE_ADDR'], ['127.0.0.1', '::1']);
    }
    /***/   

   /**
    * Update Settings
    */
   private function updateSettings(){
       
       #dd($_POST);
       
       $is_updated      = true;
       $allowed_pages   = isset($_POST['post_name']) ? $_POST['post_name'] : [];
       $subscription_id = isset($_POST['subscription_id']) ? $_POST['subscription_id'] : '';
       
        // Update Allowed pages
        update_option('__pm_allowed_pages', $allowed_pages);


        // Update Subscription ID
        update_option('__pm_subscription_id', $subscription_id);
              
        unset($is_updated,$allowed_pages,$subscription_id);
       
   }
   /***/

   /**
    * Get list of available pages / posts
    * @global type $wpdb
    * @return type
    */
   private function getPages(){
       
        global $wpdb;

        // Get All Posts and Pages with publish status
        return $wpdb->get_results( "SELECT ID, post_title,post_name,post_type 
                FROM $wpdb->posts
                WHERE post_status LIKE 'publish' 
                AND post_type IN ('page','post')
                ORDER BY  post_title ASC" );       
   }
   /***/
}
