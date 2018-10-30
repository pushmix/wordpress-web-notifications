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
    <p>Subscription ID has been successfully updated. <a href="<?php echo $url_push;?>">Push Notification</a></p>
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
        <span class="description">Can't find Subscription ID - <a href="https://www.pushmix.co.uk/docs#subscription_id">read this</a>.</span>
    </td>
</tr>
</table>


<h3>Opt In Prompt</h3>

<p>Select pages you would like to display Opt In Prompt on.</p>

<ul>
    <?php
    $args = array(
    'depth'                 => 0,
    'child_of'              => 0,
    'sort_order'            => 'ASC',
    'sort_column'           => 'post_title',    
    'selected'              => 0,
    'echo'                  => 1,
    'name'                  => 'page_id[]',
    'id'                    => null, // string
    'class'                 => 'dual_list', // string
    'show_option_none'      => null, // string
    'show_option_no_change' => null, // string
    'option_none_value'     => null, // string
     'post_type'            => 'page'
); 
wp_dropdown_pages($args);
    ?>
</ul>


<?php submit_button(); ?>
</form>
</div>

