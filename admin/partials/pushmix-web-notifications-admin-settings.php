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

<div class="wrap">


<h1>Pushmix - Web Push Notifications</h1>
<?php settings_errors(); ?>


<?php if( isset($msg_updated) ) {?>
	<div class="updated notice">
    <p>Settings have been successfully updated. <a href="<?php echo $url_push;?>">Push Notification</a></p>
</div>
<?php }?>	



<h2 class="nav-tab-wrapper">
    <div class="nav-tab nav-tab-active">Settings</div>
</h2>

<form method="post" action="<?php echo $url;?>"> 
<?php settings_fields( 'pushmix_settings' );?>
<table class="form-table">
<tr>
    <th scope="row">
        <label for="my-text-field">Pushmix Subscription ID</label>
    </th>
 
    <td>
    	<input type="text" class="subscription_id" name="subscription_id" id="subscription_id" value="<?php echo $subscription_id;?>">
        <br>
        <span class="description">Subscription ID <a href="https://www.pushmix.co.uk/docs#subscription_id" target="_new">documentation</a>.</span>
    </td>
</tr>
</table>


<h3>Opt In Prompt</h3>

<p>Select pages you would like to display Opt In Prompt on.</p>

<select name="post_name[]" class="dual_list" multiple>
    <?php foreach($all_pages as $p) {
        $op = '<option value="'.$p->post_name.'"';
        if( in_array($p->post_name, $allowed) ){
            $op.= " selected ";
        }
        $op.= '>';
        $op.= $p->post_title;
        $op.= '</option>';
        echo $op;
        unset($op);
    }?>
  
</select>



<?php submit_button(); ?>
</form>
</div>

