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

		$this->plugin_name  = $plugin_name;
		$this->version      = $version;
        $this->msg          = [];

		$this->pm = new PushmixClass();

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
                        'bootstrap-css', 
                        plugin_dir_url( __FILE__ ) . 'css/bootstrap.min.css', 
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

                wp_enqueue_style( 
                        'pm-wp-css', 
                        plugin_dir_url( __FILE__ ) . 'css/pushmix-web-notifications-admin.css', 
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


                #wp_enqueue_script( "pushmix-code-js", plugin_dir_url( __FILE__ ) . 'js/pushmix.core.min.js', array( ), $this->version, false );
                wp_enqueue_script( "dual-listbox-js", plugin_dir_url( __FILE__ ) . 'js/dual-listbox.min.js', array( ), $this->version, false );

                wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/pushmix-web-notifications-admin.js', array( 'jquery' ), $this->version, false );			


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
        
        // Add notice if environment is localhost 
        $this->pm->isLocalhost();
        
        // Is this POST request
      	if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
      	
            // update settings
            $this->pm->updateSettings();
      	}      

        // Get All Posts and Pages with publish status
        $all_pages = $this->pm->getPages();
        #dd($all_pages);

        $url 				= $this->pm->getSettingsUrl();
        $url_push			= $this->pm->getPushUrl();
        $subscription_id 	= get_option('__pm_subscription_id');
        $allowed 			= get_option('__pm_allowed_pages');
        $msg                = $this->pm->getMsg();

        #dd($subscription_id);
        require 'partials/pushmix-web-notifications-admin-settings.php';

    }
   /***/   

  /**
   * Diaplay Admin Page
   * Accept and process POST request for Push Notification
   * @return [type] [description]
   */
    public function pushmix_push(){
        
       	$url                    = $this->pm->getSettingsUrl();
        $url_push               = $this->pm->getPushUrl();
        $subscription_id        = get_option('__pm_subscription_id');
        $msg                    = $this->pm->getMsg();
        $notification_priority  = $this->pm->getNotificationPriorities();
        $notification_lifespan  = $this->pm->getNotificationLifespan();
        #dd($subscription_id);
        
        /**
         * No Subscription ID found
         * display settings interface
         */
        if( empty($subscription_id) === true){

            $all_pages = $this->pm->getPages();
            $allowed   = get_option('__pm_allowed_pages');
            $msg       = $this->pm->getMsg();
            
            // no subscription ID - display settings interface
            require 'partials/pushmix-web-notifications-admin-settings.php';
            return;

        } 

        // get subscription topics
        $topics     = $this->pm->getTopics($subscription_id); 

		/**
		 * POST Request
		 * Validate input - in case of errors retain input values and sisplay errors
		 * Push Notification - push notification via API, display success message
		 */
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            
            if( $this->pm->validateInput() === true ){

            	$old = $this->pm->getOldInput();
                require 'partials/pushmix-web-notifications-admin-push.php';
                return;

            }else{

                $this->pm->push($subscription_id);
                $msg       = $this->pm->getMsg();
                
                require 'partials/pushmix-web-notifications-admin-push.php';
                return;
            }	
        }
        
        
        
        #dd($topics);
        $msg                = $this->pm->getMsg();
        // display push interface
        require 'partials/pushmix-web-notifications-admin-push.php';
        return;
        

   }
   /***/  
   


     


    
    



}
