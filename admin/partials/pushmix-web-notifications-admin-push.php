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





<h2 class="nav-tab-wrapper">
    <div class="nav-tab nav-tab-active">Push Notification</div>
</h2>

<form method="post" action="<?php echo $url_push;?>"> 
<?php settings_fields( 'pushmix_web_notifications' ); ?>

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

<?php submit_button(); ?>
</form>
</div>