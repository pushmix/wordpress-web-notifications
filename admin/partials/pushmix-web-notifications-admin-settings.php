<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://github.com/pushmix/wordpress-web-notifications
 * @since      1.0.0
 *
 * @package    Pushmix_Web_Notifications
 * @subpackage Pushmix_Web_Notifications/admin/partials
 */

?>

<div class="wrap">

    
<!-- Title    -->
<h1><img src="<?php echo plugins_url('../img/apple-touch-icon-57x57.png',__FILE__);?>" style="margin-right: 1em;">Pushmix - Settings</h1>
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

 
<form method="post" action="<?php echo $url;?>"> 
<?php settings_fields( 'pushmix_settings' );?>
    

<!--    Container-->
<div class="my-3 p-3 bg-white rounded shadow-sm">
    
<!--    First Row-->            
    <h6 class="border-bottom border-gray pb-2 mb-0">Subscription ID</h6>
    <div class="text-muted pt-3">

        <div class="row">

            <div class="col-lg-4">
                <p class="text-muted">
                    Subscription ID is required in order to identify and retrieve your subscription details. This ID can be found in <a href="https://dash.pushmix.co.uk/login">Pushmix Dashboard</a> under Code subscription menu.
                </p>
               
            </div>

            <div class="col-lg-8 col-xl-8">
                <div class="form-group">

                    <input type="text" class="form-control form-control-alt" id="subscription_id" name="subscription_id" value="<?php echo $subscription_id; ?>" placeholder="Enter your Subscription ID ...">
                </div>
            </div>

        </div>                        

    </div>
<!--    END First Row-->        
        
<!--    Second Row-->        
    <h6 class="border-bottom border-gray pb-2 mb-0">Subscription Prompt</h6>        
    <div class="text-muted pt-3">

        <div class="row">

            <div class="col-lg-4">
                <p class="text-muted">
                    Select at leat one page to display your subscription prompt. 
                </p>
            </div>

            <div class="col-lg-8 col-xl-8">

                <div class="form-group">

                    <select name="post_name[]" class="dual_list" multiple>
                        <?php
                        foreach ($all_pages as $p) {
                            $op = '<option value="' . $p->post_name . '"';
                            if (in_array($p->post_name, $allowed)) {
                                $op.= " selected ";
                            }
                            $op.= '>';
                            $op.= $p->post_title;
                            $op.= '</option>';
                            echo $op;
                            unset($op);
                        }
                        ?>

                    </select> 

                </div>

            </div>

        </div>                           

    </div>
<!--    END Second Row-->

        <small class="d-block text-right mt-3">
          <?php submit_button('Save Settings', 'primary', 'submit', false)?>
        </small>
        
    
</div>    
<!-- END   Container-->
    
</form>    



</div>

