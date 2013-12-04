Urban Push Wordpress Plugin
===========================
A plugin that uses the Urban Airship API to send a push notification from the post creation page.

Available from: http://wordpress.org/plugins/urban-push/

=== Plugin Name ===
Contributors: sonnyjitsu
Donate link: http://sonnyparlin.com/2012/05/introducing-urban-push/
Tags: urban airship, push notifications, push
Requires at least: 2.0.2
Tested up to: 3.4.1
License: GPLv2
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A plugin that uses the Urban Airship API to send a push notification from the post creation page.

== Description ==

Urban Push is a WordPress plugin that utilizes the Urban Airship API to send a push directly from the WordPress “new post” page. **You MUST have an account with Urban Airship to use this plugin.** You can send a single push to up to 4 Urban Airship applications. After a push attempt, you will see one new custom field entry for each configured Urban Airship application. It will say **push sent for** followed by the name you chose for your Urban Airship application. The value of the custom field will contain the response returned from Urban Airship. For a successful push, the response is usually “(null).”

More features are coming like:

1. The ability to set your aps options (badge, sound, etc..)
2. The ability to choose which app to send a push to (or all).

== Installation ==

1. Download the plugin
2. Unzip and upload to your plugins directory
3. Configure via the settings page
3a. Set your Urban Airship application key and master secret as well as a safety password to avoid accidental pushes.
4. Push away. Simply add your push text, enter your password and click the update or publish button on your post.

== Frequently Asked Questions ==

= What is Urban Airship? =
Urban Airship is the engine behind thousands of the world’s most successful mobile apps, providing a full suite of messaging and content delivery tools, including Push Notifications, Rich Media Messaging, In-App Purchase and Subscriptions. 

= What is a push notification? =
Push Notifications allow you to send messages directly to the people who have installed your app, even when your app is closed.

= Why is there a limit of only 4 Urban Airship applications? =
It seemed like a good number. If you need more, the plugin is easy enough to modify. Just add more form fields to the settings.php file and add another send_push method with the correct parameters in urbanairship.php. If you need help, contact me.

== Screenshots ==

1. Settings Screen
2. Push interface

== Changelog ==

= 1.0.3 =
* Fixed bug that was causing a double push

= 1.0.2 =
* You will now only get one custom field entry per push

= 1.0.1 =
* Added the ability to send a single push to multiple Urban Airship applications (up to 4)

== Upgrade Notice ==

= 1.0.3 =
Fixed a bug that was causing a double push to be sent

= 1.0.1 =
Added the ability to send a single push to multiple Urban Airship applications (up to 4)
