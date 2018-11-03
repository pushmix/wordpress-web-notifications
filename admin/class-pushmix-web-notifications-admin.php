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
         * Pushmix API Endpoints
         * @var type 
         */
        private $api = [
            'get_topics'    => "http://localhost/api/t",
        ];
        
        /**
         * Array opf accepted Notification Fields
         * @var type 
         */
        private $fields = [
            'topic'         => 'required',
            'priority'      => 'required',
            'time_to_live'  => 'required',
            'title'         => 'required',
            'body'          => 'required',
            'default_url'   => 'required',
            'action_title_one'  => '',
            'action_url_one'    => '',
            'action_title_two'  => '',
            'action_url_two'    => '',
            'image'            
        ];
        /***/

        /**
         * Notification Messages
         * @var type 
         */
        private $msg;
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

		#$this->pm = new PushmixClass();

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
        
        // Is environment Localhost -- add message notice
        $this->isLocalhost();
        
        // Is this POST request
        $is_post = isset($_POST['post_name']) || isset($_POST['subscription_id']);
        #dd($_POST['post_name']);
        
        // Is this POST request
        if( empty($is_post) === false ){
            
            // update settings
            $this->updateSettings();

        }
        // Get All Posts and Pages with publish status
        $all_pages = $this->getPages();
        #dd($all_pages);

        $url 			= $this->url_settings;
        $url_push		= $this->url_push;
        $subscription_id 	= get_option('__pm_subscription_id');
        $allowed 		= get_option('__pm_allowed_pages');
        $msg                    = $this->msg;

        #dd($subscription_id);
        require 'partials/pushmix-web-notifications-admin-settings.php';

    }
   /***/   

  /**
   * Diaplay Admin Page
   * @return [type] [description]
   */
    public function pushmix_push(){
        
       	$url                = $this->url_settings;
        $url_push           = $this->url_push;
        $subscription_id    = get_option('__pm_subscription_id');
        $msg                = $this->msg;
        #dd($subscription_id);
        
        /**
         * Has Subscription ID 
         */
        if( empty($subscription_id) === true){

            $all_pages = $this->getPages();
            $allowed   = get_option('__pm_allowed_pages');
            $msg       = $this->msg;
            
            // no subscription ID - display settings interface
            require 'partials/pushmix-web-notifications-admin-settings.php';
            return;

        }        
        
        // get subscription topics
        $topics     = $this->getTopics($subscription_id); 
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            #dd($_POST);
            $old = [];
            $has_error = false;
            foreach( $_POST as $key => $p ){
                
                if(array_key_exists($key, $this->fields) ){
                    $old[$key] = [ 'value' => $p ];
                    
                    if( empty($old[$key]['value']) && strcmp($this->fields[$key], "required") === 0){
                        
                        $old[$key]['error'] = true;
                        add_settings_error('pushmix_settings', $key, 'The '.$key.' is required');
                        $has_error = true;
                        break;
                    }
                }
            }
            #dd($old['title']['error']);
            
            if( $has_error === true ){
                require 'partials/pushmix-web-notifications-admin-push.php';
                return;
            }
        }
        
        
        
        #dd($topics);
        $msg        = $this->msg;
        // display push interface
        require 'partials/pushmix-web-notifications-admin-push.php';
        return;
        

   }
   /***/  
   
   
    /**
     * Check if Wp is running on localhost or not
     * @return boolean - true if running on localhost
     */
    private function isLocalhost(){
        #return false;

        $is_local = in_array($_SERVER['REMOTE_ADDR'], ['127.0.0.1', '::1']);
        
        if( $is_local )
            array_push($this->msg, [
                'class'     => $this->notice_css['info'],
                'message'   => 'Local Environment detected - Subscription prompt will only be displayed under localhost domain name. <a href="#">More info</a>',
            ]);        
        
        return $is_local;
    }
    /***/   

    /**
     * Retrieve Audience Topics
     */
    private function getTopics($subscription_id){
        
        $data = [
            'body' => [
                'subscription_id' => $subscription_id
                ]
        ];
        $topics = wp_remote_post($this->api['get_topics'], $data);
        
        #dd($topics);
        
        if( is_wp_error( $topics ) ) {
            
            array_push($this->msg,[
                'class'     => $this->notice_css['error'],
                'message'   => $topics->get_error_message()
            ]);
            
            return [];
        }
        
        if( empty($topics['response']) === false && $topics['response']['code'] !== 200){
            
            $rsp = json_decode($topics['body']);
            
            array_push($this->msg,[
                'class'     => $this->notice_css['error'],
                'message'   => $rsp->error.' -  Check plugin <a href="'.$this->url_settings.'">settings</a>.'
            ]);
            
             return [];
        }        
        
        if($topics['response']['code'] === 200){
            
            return json_decode( $topics['body']);
        }
        
        return [];
        
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
              
        
        array_push($this->msg,[
            'class'     => $this->notice_css['success'],
            'message'   => 'Settings have been successfully updated. <a href="'.$this->url_push.'">Push Notification</a>'
        ]);        
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
