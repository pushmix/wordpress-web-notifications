=== Plugin Name ===
Contributors: pushmix
Donate link: https://github.com/pushmix/wordpress-web-notifications
Tags: web push notifications, push notifications, notification icon, notification actions, pushmix
Requires at least: 3.0.1
Tested up to: 4.9.8
Stable tag: 4.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Effectively re-engage your visitors with web push notifications, all major mobile and desktop browsers supported.

== Description ==

This plugin provides integration with Pushmix service allowing effectively re-engaging website visitors with customized web notifications. You can activate opt in promt on selected pages to acquire subscribers audience. Once you have build subscribers audience you can start dispatching web push notifications directly from WordPress Dashboard. 

You will need Subscription ID to use it. The Subscription ID is free and can be obtained from (Pushmix)[https://www.pushmix.co.uk].

## Features
* push web notifications from WordPress Dashboard
* choose pages and posts to display opt in prompt
* audience segmentation via topic subscription 
* customised opt in prompt
* real time user interactions in Google Analytics
* custom notification icon and badge
* action buttons with icons
* notification logs
* large image support


## Requirements
* Website must be served via `HTTPS://` or `localhost` to display opt in prompt
* Free Pushmix Subscription ID - (obtain yours now)[https://dash.pushmix.co.uk/register]

View all available [features](https://www.pushmix.co.uk/features) or see [documentation](https://www.pushmix.co.uk/docs) for more details.



## Sending Notifications
From WordPress Dashboard menu click Pushmix to view web push notification interface.

### Audience and Delivery Settings
This section allows you to segment your target audience and set notification delivery priority and lifespan.

By default `All Audience` option is selected, using this selection will dispatch web notification to all users opted in for notification using opt in prompt (users who have licked `Notifications - Allow`).

During subscription creation if you have created additional topics, they will be displayed in the drop down. To target specific audience group (i.e. Special Offers) select topic from drop down.

Priority option by deault set to `High`, other option available is `Normal`.
`High` priority messages attempted to be delivered immediately. `Normal` priority messages won't open network connections on a sleeping device, and their delivery may be delayed to conserve battery.

Notification lifespan allows to specify for how long web notification delivery will be attempted. Default option is `1 Hour`.

### Content Section
Content section included three fields, `Notification Title`, `Notification Body` and `Notificatuin URL`, all these fields are described themselves and must be filled with content before you can push web notification.

## Optional Parameters
You can define up to two action buttons to be displayed with a notification as well as large image URL. All fields bellow are optional, however if you choose to specify Action Title than Action URL is required.



== Installation ==

1. Upload the Pushmix Web Notifications plugin to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Go to Pushmix Settings and enter Subscription ID and select pages where you wish to display opt in prompt

That's it!

Build your subcsibers audience by encuraging your visitors to opt in for your web push notifications. To push web notification click Pushmix from WordPress menu.


== Screenshots ==

1. This screen shot description corresponds to screenshot-1.(png|jpg|jpeg|gif). Note that the screenshot is taken from
the /assets directory or the directory that contains the stable readme.txt (tags or trunk). Screenshots in the /assets
directory take precedence. For example, `/assets/screenshot-1.png` would win over `/tags/4.3/screenshot-1.png`
(or jpg, jpeg, gif).
2. This is the second screen shot

## Sending Notifications
From WordPress Dashboard menu click Pushmix to view web push notification interface.

### Audience and Delivery Settings
This section allows you to segment your target audience and set notification delivery priority and lifespan.

By default `All Audience` option is selected, using this selection will dispatch web notification to all users opted in for notification using opt in prompt (users who have licked `Notifications - Allow`).

During subscription creation if you have created additional topics, they will be displayed in the drop down. To target specific audience group (i.e. Special Offers) select topic from drop down.

Priority option by deault set to `High`, other option available is `Normal`.
`High` priority messages attempted to be delivered immediately. `Normal` priority messages won't open network connections on a sleeping device, and their delivery may be delayed to conserve battery.

Notification lifespan allows to specify for how long web notification delivery will be attempted. Default option is `1 Hour`.

### Content Section
Content section included three fields, `Notification Title`, `Notification Body` and `Notificatuin URL`, all these fields are described themselves and must be filled with content before you can push web notification.

## Optional Parameters
You can define up to two action buttons to be displayed with a notification as well as large image URL. All fields bellow are optional, however if you choose to specify Action Title than Action URL is required.

== Changelog ==

= 1.0.0 =
* Release Date - 5th November 2018


= 0.5 =
* List versions from most recent at top to oldest at bottom.

== Upgrade Notice ==

= 1.0 =
Upgrade notices describe the reason a user should upgrade.  No more than 300 characters.

= 0.5 =
This version fixes a security related bug.  Upgrade immediately.

== Arbitrary section ==

You may provide arbitrary sections, in the same format as the ones above.  This may be of use for extremely complicated
plugins where more information needs to be conveyed that doesn't fit into the categories of "description" or
"installation."  Arbitrary sections will be shown below the built-in sections outlined above.
