# README #

WP Private Site is a plugin that allows you to block your website from any user that is not whitelisted.
It protects from access to any part of the site and forces any non whitelisted user to see a landing page.

### FEATURES ###

* Username whitelist: Only registered users on the whitelist can see the website
* Login supervision: If a non whitelisted user was logged in before private site activation, or tries to log in to the dashboard while the block is active, the user gets kicked out
* User redirect: The only visible page for non registered users is the wp private site landing page
* Customizable template: Easily setup a landing page for users creating a wp-private-site-landing.php file in your theme root folder
* Warning display on wp-login: Lets users know the user is currently in private mode/

Version 1.0

### How do I get set up? ###

Set Up

To install this plugin just download the zip folder with the 'Clone or download' button in the upper right area, and upload it through the wordpress dashboard in the add new plugin screen. 

Alternative:
You can also clone the repository in your computer, then zip the folder and upload it through the wordpress dashboard in the add new plugin screen.

After the plugin is installed, activate it, and go to Settings -> Wordpress Private Site to setup.


Configuration

To grant a user access, just type the username in the input box and press the button 'Grant Access'. Once a user appears on the list, the site will display for him/her.

You need to mark the 'enabled' checkbox to make your site private. Be sure to whitelist at least one user to avoid being completely blocked from your website. 

The plugin currently turns itself off if you try to save an empty whitelist and activate the private site, but if this does happen to you and you get completely blocked from your website, get access to your plugins folder through FTP or CPanel, and rename the wp-private-site folder to something else, that will turn it off.


Dependencies

The following libraries are required for the dashboard interface to work properly:

* jQuery
* jQueryUI Core
* jQueryUI Widget
* jQueryUI Autocomplete
* jQueryUI Tooltip
* jQueryUI Button

The plugin is rigged to work with the precompiled version of those libraries, that are included with wordpress, and are enqueued in the plugin files as indicated in https://developer.wordpress.org/reference/functions/wp_enqueue_script/#default-scripts-included-and-registered-by-wordpress.

### Who do I talk to? ###

wpdev@lobodeguerra.net
