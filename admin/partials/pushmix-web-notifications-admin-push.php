<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://github.com/pushmix/web-notification
 * @since      1.0.0
 *
 * @package    Pushmix_Web_Notifications
 * @subpackage Pushmix_Web_Notifications/admin/partials
 */

?>

<!-- Wrap -->
<div class="wrap">

<!-- Title    -->
<h1>Pushmix - Web Push Notifications</h1>
<!-- END Title    -->

<!-- Settings Errors    -->
<?php settings_errors(); ?>
<!-- END Settings Errors    -->    

<!-- Notice    -->

<?php foreach( $msg as $m) {?>
<div class="notice is-dismissible <?php echo $m['class'];?>"> 
	<p><strong><?php echo $m['message'];?></strong></p>
	<button type="button" class="notice-dismiss">
		<span class="screen-reader-text">Dismiss this notice.</span>
	</button>
</div>
<?php }?>	
<!-- END Notice    -->


<form method="post" action="<?php echo $url_push;?>"> 
<?php settings_fields( 'pushmix_push' );?>
    


    
<!--  Row  -->    
<div class="row"> 
    
<!--  Audience and Delivery Settings  -->    
    <div class='col-md-6 col-sm-12'>
    
<!--         Card                         -->
        <div class="card mb-4 shadow-sm">

<!--          Card Header-->                                
          <div class="card-header">
            <h6 class="my-0 text-center">Audience and Delivery Settings</h6>
          </div>
<!--              END Card Header-->                

<!--           Card Body-->                
          <div class="card-body">

        <!--        Audience-->
            <div class="form-group">
                <p class="h6">Audience <span class='text-danger'>*</span></p>
                <label for="topic"><small class='text-muted'>Select subscribers audience</small></label>
                <select class="form-control" id="topic" name='topic'>
                    <option value="all">All Audience</option>
                  <?php foreach( $topics as $t) {?>
                    <option value="<?php echo $t->id;?>"><?php echo $t->topic_name;?></option>
                  <?php }?>
                </select>
              </div>
        <!--      END  Audience-->

        <!--      Priority-->        
            <div class="form-group">
                <p class="h6">Priority <span class='text-danger'>*</span></p>
                <label for="priority"><small class='text-muted'>High priority messages attempted to be delivered immediately. Normal priority messages won't open network connections on a sleeping device, and their delivery may be delayed to conserve battery</small></label>
                <select class="form-control" id="topic" name='priority'>
                    <option value="high" selected="selected">High</option>
                    <option value="normal">Normal</option>
                </select>
              </div>  
        <!--      END  Priority-->


        <!--      Priority-->        
            <div class="form-group">
                <p class="h6">Notification Lifespan <span class='text-danger'>*</span></p>
                <label for="time_to_live"><small class='text-muted'>Maximum notification lifespan</small></label>
                <select class="form-control" id="topic" name='time_to_live'>
                    <option value="3600" selected="selected">1 Hour</option>
                    <option value="14400">4 Hours</option>
                    <option value="28800">8 Hours</option>
                    <option value="57600">16 Hours</option>
                    <option value="86400">24 Hours</option>
                    <option value="172800">2 Days</option>
                    <option value="604800">7 Days</option>
                    <option value="1209600">2 Weeks</option>
                    <option value="1814400">3 Weeks</option>
                    <option value="2419200">4 Weeks</option>
                </select>
              </div>  
        <!--      END  Priority-->


          </div>
<!--              END Card Body-->
        </div>
<!--     END  Card                         -->              
        
    </div> 
<!-- END Audience and Delivery Settings  -->




<!--  Notification Content  -->    
    <div class='col-md-6 col-sm-12'>
    
<!--         Card                         -->
        <div class="card mb-4 shadow-sm">

<!--          Card Header-->                                
          <div class="card-header">
            <h6 class="my-0 text-center">Content</h6>
          </div>
<!--              END Card Header-->                

<!--           Card Body-->                
          <div class="card-body">

        <!--        Notification Title-->
            <div class="form-group">
                <p class="h6">Notification Title <span class='text-danger'>*</span></p>
                <label for="title"><small class='text-muted'>Keep it short - up to 30 characters</small></label>
                <input type="text" class="form-control <?php echo (isset($old['title']['error']) ? 'is-invalid' : ''); ?>" id="title" name="title" value="<?php echo (isset($old['title']['value']) ? $old['title']['value'] : ''); ?>" placeholder="Chelsea vs Man United"  tabindex="3">
              </div>
        <!--      END  Notification Title-->

        <!--      Notification Body-->        
            <div class="form-group">
                <p class="h6">Notification Body <span class='text-danger'>*</span></p>
                <label for="body"><small class='text-muted'>Keep it short</small></label>

                <textarea class="form-control <?php echo (isset($old['body']['error']) ? 'is-invalid' : ''); ?>" id="body" name="body" value="" placeholder="Five reasons why Chelsea win Champions League" tabindex="4" rows="3"><?php echo (isset($old['body']['value']) ? $old['body']['value'] : ''); ?></textarea>                
              </div>  
        <!--      END  Notification Body-->


        <!--      URL -->        
            <div class="form-group">
                <p class="h6">URL  <span class='text-danger'>*</span></p>
                <label for="default_url"><small class='text-muted'>Valid URL, used when notification clicked</small></label>
                <input type="text" class="form-control <?php echo (isset($old['default_url']['error']) ? 'is-invalid' : ''); ?>" id="default_url" name="default_url" value="<?php echo (isset($old['default_url']['value']) ? $old['default_url']['value'] : ''); ?>" placeholder="<?php echo get_site_url();?>" tabindex="5">
              </div>  
        <!--      END  URL -->


          </div>
<!--              END Card Body-->
        </div>
<!--     END  Card                         -->              
        
    </div> 
<!-- END Notification Content  -->


<!-- Submit Form -->
<div class='col-sm-12'>
        <small class="d-block text-right mt-3">
          <?php submit_button('Push Notification', 'primary', 'submit', false)?>
        </small>
</div>
<!-- END Submit Form -->




<!-- Optional Buttons Header-->
<div class='col-sm-12'>
    <h6>Optional Action Buttons</h6>
    <hr>
    <p>You can define up to two action buttons to be displayed with a notification. All fields bellow are optional, however if you choose to specify Action Title than Action URL is required.</p>
</div>
<!-- END Optional Buttons Header-->

<!--  Action Button 1  -->    
    <div class='col-md-6 col-sm-12'>
    
<!--         Card                         -->
        <div class="card mb-4 shadow-sm">

<!--          Card Header-->                                
          <div class="card-header">
            <h6 class="my-0 text-center">Action Button 1</h6>
          </div>
<!--              END Card Header-->                

<!--           Card Body-->                
          <div class="card-body">

        <!--        Action Title-->
            <div class="form-group">
                <p class="h6">Action Title</p>
                <label for="action_title_one"><small class='text-muted'>Short action title. Example: <mark>Read More</mark></small></label>
                <input type="text" class="form-control" id="action_title_one" name="action_title_one" value="" placeholder="Read More" tabindex="7">
              </div>
        <!--      END  Action Title-->

        <!--      Action URL-->        
            <div class="form-group">
                <p class="h6">Action URL</p>
                <label for="action_url_one"><small class='text-muted'>Action destination URL.</small></label>
                <input type="text" class="form-control" id="action_url_one" name="action_url_one" value="" placeholder="<?php echo get_site_url();?>/read-more" tabindex="8">               
              </div>  
        <!--      END  Action URL-->

          </div>
<!--              END Card Body-->
        </div>
<!--     END  Card                         -->              
        
    </div> 
<!-- END Action Button 1  -->


<!--  Action Button 2  -->    
    <div class='col-md-6 col-sm-12'>
    
<!--         Card                         -->
        <div class="card mb-4 shadow-sm">

<!--          Card Header-->                                
          <div class="card-header">
            <h6 class="my-0 text-center">Action Button 2</h6>
          </div>
<!--              END Card Header-->                

<!--           Card Body-->                
          <div class="card-body">

        <!--        Action Title-->
            <div class="form-group">
                <p class="h6">Action Title</p>
                <label for="action_title_two"><small class='text-muted'>Short action title. Example: <mark>View Offer</mark></small></label>
                <input type="text" class="form-control" id="action_title_two" name="action_title_two" value="" placeholder="View Offer" tabindex="7">
              </div>
        <!--      END  Action Title-->

        <!--      Action URL-->        
            <div class="form-group">
                <p class="h6">Action URL</p>
                <label for="action_url_two"><small class='text-muted'>Action destination URL.</small></label>
                <input type="text" class="form-control" id="action_url_one" name="action_url_two" value="" placeholder="<?php echo get_site_url();?>/view-offer" tabindex="8">               
              </div>  
        <!--      END  Action URL-->

          </div>
<!--              END Card Body-->
        </div>
<!--     END  Card                         -->              
        
    </div> 
<!-- END Action Button 2  -->


<!-- Submit Form -->
<div class='col-sm-12'>
        <small class="d-block text-right mt-3">
          <?php submit_button('Push Notification', 'primary', 'submit', false)?>
        </small>
</div>
<!-- END Submit Form -->


<!-- Optional Large Image-->
<div class='col-sm-12'>
    <h6>Optional Large Image</h6>
    <hr>
    <p>Large image can be included in notification body, recommended width of 1350px or more would be a good bet. Simply enter valid image URL.</p>
</div>
<!-- END Large Image-->

<!--  Large Image  -->    
    <div class='col-md-6 col-sm-12'>
    
<!--         Card                         -->
        <div class="card mb-4 shadow-sm">

<!--          Card Header-->                                
          <div class="card-header">
            <h6 class="my-0 text-center">Large Image</h6>
          </div>
<!--              END Card Header-->                

<!--           Card Body-->                
          <div class="card-body">

        <!--        Large Image  -->
            <div class="form-group">
                <p class="h6">Image URL</p>
                <label for="action_title_one"><small class='text-muted'>Large Image URL</small></label>
                <input type="text" class="form-control" id="image" name="image" value="" placeholder="<?php echo get_site_url();?>/large-image.png"  tabindex="13">
              </div>
        <!--      END Large Image-->


          </div>
<!--              END Card Body-->
        </div>
<!--     END  Card                         -->              
        
    </div> 
<!-- END Large Image  -->



<!-- Submit Form -->
<div class='col-sm-12'>
        <small class="d-block text-right mt-3">
          <?php submit_button('Push Notification', 'primary', 'submit', false)?>
        </small>
</div>
<!-- END Submit Form -->




</div>    
<!--  END Row  -->    

    
</form>    
<!--END Form-->

</div>
<!-- END Wrap -->
