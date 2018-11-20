# ![Pushmix](https://www.pushmix.co.uk/media/favicons/favicon-32x32.png) Web Push Notifications for WordPress

Effectively re-engage your visitors with customized web push notifications, all major mobile and desktop browsers supported.

## About

This plugin provides integration with [Pushmix](https://www.pushmix.co.uk) service. Activate opt-in prompt on selected pages to acquire subscribers audience. Once you have a build up subscribers audience you can start sending web push notifications directly from WordPress Dashboard.


## Features
* Send web push notifications from WordPress Dashboard
* Select pages and posts to display opt-in prompt
* Audience segmentation via topic subscription


## Requirements
* Website must be served via `HTTPS://` or `localhost` to display opt-in prompt
* Pushmix Subscription ID 

You will need a Subscription ID to use it. The Subscription ID is FREE and can be obtained from [pushmix.co.uk](https://www.pushmix.co.uk).



## Installation

1. Go to Plugins > Add New.
2. Search for "pushmix web notifications".
3. Click "Install Now".

OR 

1. [Download](https://downloads.wordpress.org/plugin/pushmix-web-notifications.zip)  zip file
2. Upload the zip file via Plugins > Add New > Upload
3. Activate the plugin through the 'Plugins' menu in WordPress

Go to Pushmix Settings, enter Subscription ID and select pages where you wish to display opt-in prompt.

That's it!

### Pushmix Settings

![alt text](https://raw.githubusercontent.com/pushmix/wordpress-web-notifications/master/assets/screenshot-1.png "Pushmix plugin settings")


### Opt-In Prompt

Build your subscribers audience by encouraging your visitors to opt-in for web push notifications.

![alt text](https://raw.githubusercontent.com/pushmix/wordpress-web-notifications/master/assets/screenshot-4.png "Pushmix opt-in prompt")

## Sending Notifications
From WordPress Dashboard menu click Pushmix to view web push notification interface.

### Audience and Delivery Settings
This section allows you to segment your target audience and set notification delivery priority and lifespan.

By default `All Audience` option is selected, using this selection will send the message to all users opted in for web push notifications using opt-in prompt (users who have clicked `Notifications - Allow`).

During subscription creation, if you have created additional topics, they will be displayed in the drop down. To target specific audience group (i.e. Special Offers) select topic from drop down.

Priority option by default set to `High`, another available option is `Normal`.
`High` priority messages attempted to be delivered immediately. `Normal` priority messages won't open network connections on a sleeping device, and their delivery may be delayed to conserve battery.

Notification lifespan allows specifying for how long web notification delivery will be attempted. The default option is `1 Hour`.

### Content Section
The content section included three fields, `Notification Title`, `Notification Body` and `Notification URL`, all these fields are described themselves and must be filled with content before you can send web push notification.

![alt text](https://raw.githubusercontent.com/pushmix/wordpress-web-notifications/master/assets/screenshot-2.png "Notification Audience an Content")

## Optional Parameters
You can define up to two action buttons to be displayed with a notification as well as large image URL. All fields below are optional, however, if you choose to specify Action Title than Action URL is required.

![alt text](https://raw.githubusercontent.com/pushmix/wordpress-web-notifications/master/assets/screenshot-3.png "Optional Parameters")

## Issues
If you come across any issues please report them [here](https://github.com/pushmix/wordpress-web-notifications/issues).

## Security Vulnerabilities
If you discover a security vulnerability please send an e-mail to support@pushmix.co.uk. 

## License
The Pushmix WordPress Web Notifications plugin is licensed under the GNU General Public License v2.0