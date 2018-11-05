# ![Pushmix](https://www.pushmix.co.uk/media/favicons/favicon-32x32.png) Pushmix web push notifications plugin for WordPress

Effectively re-engage your visitors with web push notifications, all major mobile and desktop browsers supported.

## About

This plugin provides integration with Pushmix service allowing effectively re-engaging website visitors with customized web notifications. You can activate opt in promt on selected pages to acquire subscribers audience. Once you have build subscribers audience you can start dispatching web push notifications directly from WordPress Dashboard. 

You will need Subscription ID to use it. The Subscription ID is free and can be obtained from [pushmix.co.uk](https://www.pushmix.co.uk).

## Features
* push web notifications from WordPress Dashboard
* choose pages and posts to display opt in prompt
* audience segmentation via topic subscription 
* customized opt in prompt
* real time user interactions in Google Analytics
* custom notification icon and badge
* action buttons with icons
* notification logs
* large image support


## Requirements
* Website must be served via `HTTPS://` or `localhost` to display opt in prompt
* Free Pushmix Subscription ID - [obtain yours now](https://dash.pushmix.co.uk/register)

View all available [features](https://www.pushmix.co.uk/features) or see [documentation](https://www.pushmix.co.uk/docs) for more details.


## Installation

1. Upload the Pushmix Web Notifications plugin to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Go to Pushmix Settings and enter Subscription ID and select pages where you wish to display opt in prompt

That's it!

![alt text](https://raw.githubusercontent.com/pushmix/wordpress-web-notifications/master/screens/screenshot-1.png "Pushmix plugin settings")

Build your subcsibers audience by encuraging your visitors to opt in for your web push notifications. To push web notification click Pushmix from WordPress menu.


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

![alt text](https://github.com/pushmix/wordpress-web-notifications/screens/screenshot-2.png "Notification Audience an Content")

## Optional Parameters
You can define up to two action buttons to be displayed with a notification as well as large image URL. All fields bellow are optional, however if you choose to specify Action Title than Action URL is required.

![alt text](https://github.com/pushmix/wordpress-web-notifications/screens/screenshot-3.png "Optional Parameters")