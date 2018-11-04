<?php 
namespace PushmixWebNotifications;

/**
 * Pushmix Class
 * 
 * @copyright (c) 2018
 * @author Pushmix
 */
class PushmixClass{

        
/**
* Pushmix API Endpoints
* @var type 
*/
private $api = [
'get_topics'    => "http://localhost/api/get/topics",
];

/**
 * otification Priority Options
 *
 * @var        array
 */
private $priority = [

	'high' 		=> 'High',
	'normal' 	=> 'Normal'
];

/**
 * Notification Lifespan Options
 *
 * @var        array
 */
private $time_to_live = [

	'3600' 		=> '1 Hour',
	'14400' 	=> '4 Hours',
	'28800' 	=> '8 Hours',
	'57600' 	=> '16 Hours',
	'86400' 	=> '24 Hours',
	'172800' 	=> '2 Days',
	'604800' 	=> '7 Days',
	'1209600' 	=> '2 Weeks',
	'1814400' 	=> '3 Weeks',
	'2419200' 	=> '4 Weeks',
];

/**
 * Array opf accepted Notification rules
 * @var type 
 */
private $rules = [
    'topic'         => 'required',
    'priority'      => 'required',
    'time_to_live'  => 'required',
    'title'         => 'required',
    'body'          => 'required',
    'default_url'   => 'required|url',
    'action_title_one'  => '',
    'action_url_one'    => '',
    'action_title_two'  => '',
    'action_url_two'    => '',
    'image'    			=> '',        
];


/**
 * Validation messages
 *
 * @var        array
 */
private $validation_messages = [
	'topic'				=> "Invalid Audience selected",
	'priority'			=> "Invalid Priority value selected. Values must be normal or high",
	'time_to_live'		=> "Invalid Notification Lifespan value selected. Values must be integer.",
	'title'				=> "Please enter Notification Title",
	'body'				=> "Please enter Notification Body",
	'default_url'		=> "Please enter Notification URL",
	'default_url.url'	=> "Invalid Notification URL",
	'action_title_one'	=> "Action Button 1 Title required",
	'action_url_one'	=> "Please enter Action Button 1 URL",
	'action_url_one.url'=> "Invalid Action Button 1 URL",
	'action_title_two'	=> "Action Button 2 Title required",
	'action_url_two'	=> "Please enter Action Button 2 URL",
	'action_url_two.url'=> "Invalid Action Button 2 URL",
	'image.url'			=> "Invalid Large Image URL",
];

/**
 * Notification Messages
 * @var type 
 */
private $msg = [];
/**
* Settings URL
*/
private $url_settings;

/**
* Web Push Notification URL
*/
private $url_push;

/**
* Old Input
*/
private $old_input = [];

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
	 * Class cunstructor
	 */
	public function __construct(){

		$this->url_settings = network_admin_url('admin.php?page=pushmix_settings');
		$this->url_push     = network_admin_url('admin.php?page=pushmix_web_notifications');		
	}


	/**
	 * Gets the priority options.
	 *
	 * @return     <array>  The priority options.
	 */
	public function getNotificationPriorities(){
		return $this->priority;
	}
	/***/

	public function getNotificationLifespan(){
		return $this->time_to_live;
	}
	/***/

	/**
	 * Gets the settings url.
	 * 
	 * @return     <string>  The settings url.
	 */
	public function getSettingsUrl(){
		return $this->url_settings;
	}
	/***/

	/**
	 * Gets the push url.
	 *
	 * @return     <string>  The push url.
	 */
	public function getPushUrl(){
		return $this->url_push;
	}
	/***/	

	/**
	 * Gets the message.
	 *
	 * @return     <array>  The message.
	 */
	public function getMsg(){
		return $this->msg;
	}
	/***/

	public function getOldInput(){
		return $this->old_input;
	}
	/***/	

    /**
     * Check if Wp is running on localhost or not
     * @return boolean - true if running on localhost
     */
    public function isLocalhost(){
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
	* Update Pushmix Settings
	* 
	* store subscription ID and pages and posts to display
	* opt in prompt
	*/
	public function updateSettings(){
	   
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
	* @return array
	*/
	public function getPages(){
	   
	    global $wpdb;

	    // Get All Posts and Pages with publish status
	    return $wpdb->get_results( "SELECT ID, post_title,post_name,post_type 
	            FROM $wpdb->posts
	            WHERE post_status LIKE 'publish' 
	            AND post_type IN ('page','post')
	            ORDER BY  post_title ASC" );       
	}
	/***/   


	/**
	 * Gets the topics.
	 *
	 * @param      <string>  $subscription_id  The subscription identifier
	 *
	 * @return     array   The topics.
	 */
    public function getTopics($subscription_id){
        
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
            $error = isset($rsp->error) ? $rsp->error : 'Error obtaining API response';
            
            array_push($this->msg,[
                'class'     => $this->notice_css['error'],
                'message'   => $error.' -  Check plugin <a href="'.$this->url_settings.'">settings</a>.'
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
     * Validate Push Notification Input
     *
     * @return     boolean  true when errors detected
     */
   	public function validateInput(){

        $has_error = false;

        foreach( $_POST as $key => $p ){
            
            if(array_key_exists($key, $this->rules) ){

                $this->old_input[$key] = [ 'value' => $p ];
                
                if( empty($p) && strcmp($this->rules[$key], "required") === 0){
                    
                    $this->old_input[$key]['error'] = true;
                    add_settings_error('pushmix_settings', $key, $this->validation_messages[$key]);
                    $has_error = true;
                    #break;
                }

                // Validate URL
                if(strrpos($this->rules[$key], "url") !== false 
                	&& filter_var($p, FILTER_VALIDATE_URL) == false){

                    $this->old_input[$key]['error'] = true;
                    add_settings_error('pushmix_settings', $key, $this->validation_messages[$key.".url"]);
                    $has_error = true;
                    #break;					
				}


				/**
				 * Is Action Button One Title set 
				 * than verify Action Button 1 URL
				 */
				if( strcmp( $key, "action_title_one") === 0 
					&& empty( $_POST['action_title_one'] ) === false 
					&& empty( $_POST['action_url_one'] ) === true ){

                    $this->old_input['__action_url_one']['error'] = true;
                    add_settings_error('pushmix_settings', 'action_url_one', $this->validation_messages['action_url_one']);
                    $has_error = true;
                    #break;

				}else if(strcmp( $key, "action_title_one") === 0 
					&& empty( $_POST['action_title_one'] ) === false 
					&& filter_var($_POST['action_url_one'], FILTER_VALIDATE_URL) === false){

                    $this->old_input['__action_url_one']['error'] = true;
                    add_settings_error('pushmix_settings', 'action_url_one', $this->validation_messages["action_url_one.url"]);
                    $has_error = true;
                    #break;					
				}


				/**
				 * Is Action Button Two Title set 
				 * than verify Action Button 2 URL
				 */
				if( strcmp( $key, "action_title_two") === 0 
					&& empty( $_POST['action_title_two'] ) === false 
					&& empty( $_POST['action_url_two'] ) === true ){

                    $this->old_input['__action_url_two']['error'] = true;
                    add_settings_error('pushmix_settings', 'action_url_two', $this->validation_messages['action_url_two']);
                    $has_error = true;
                    #break;

				}else if(strcmp( $key, "action_title_two") === 0 
					&& empty( $_POST['action_title_two'] ) === false 
					&& filter_var($_POST['action_url_two'], FILTER_VALIDATE_URL) === false){

                    $this->old_input['__action_url_two']['error'] = true;
                    add_settings_error('pushmix_settings', 'action_url_two', $this->validation_messages["action_url_two.url"]);
                    $has_error = true;
                    #break;					
				}


				if( strcmp( $key, "image") === 0 
					&& empty( $_POST['image'] ) === false 
					&& filter_var($_POST['image'], FILTER_VALIDATE_URL) === false ){

                    $this->old_input['image']['error'] = true;
                    add_settings_error('pushmix_settings', 'image', $this->validation_messages["image.url"]);
                    $has_error = true;
				}
                
            }
        }
        
        #dd($this->old_input);

        return $has_error;   	
   }
   /***/    	


   public function validateUrl($url){

   }
   /***/

}
/***/