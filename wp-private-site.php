<?php
/**
 * @package wp_private_site
 * @version 1.0
 */
/*
Plugin Name: Wordpress Private Site
Plugin URI: 
Description: This plugin will let you make your website private. Allow access only to whitelisted users. Blocks access to wp-admin to non whitelisted users. Display a landing page template for non allowed users. Make site content unreachable for non whitelisted users. Log out non whitelisted users that are logged at the moment of activation.
Author: Isaac L. Félix
Version: 1.0
Author URI: 
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: wp-private-site
Domain Path: /languages
*/
// Plugin activation
function wp_private_site_activatation() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-private-site-activator.php';
	WP_Private_Site_Activator::activate();
}
register_activation_hook( __FILE__, 'wp_private_site_activatation');

// Plugin deactivation
function wp_private_site_deactivatation() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-private-site-deactivator.php';
	WP_Private_Site_Deactivator::deactivate();
}
register_deactivation_hook( __FILE__, 'wp_private_site_deactivatation');

// Plugin uninstalling
function wp_private_site_uninstalling() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-private-site-uninstaller.php';
	WP_Private_Site_Uninstaller::uninstall();
}
register_uninstall_hook(__FILE__, 'wp_private_site_uninstalling');

// Plugin admin menu settings
function wp_private_site_settings_init() {
	require_once plugin_dir_path(__FILE__) . 'includes/class-wp-private-site-settings.php';
	WP_Private_Site_Settings::settings();
}
add_action('admin_init', 'wp_private_site_settings_init');

// Plugin admin menu
function wp_private_site_menu() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-private-site-menu.php';
	WP_Private_Site_Menu::menu();
}
add_action('admin_menu', 'wp_private_site_menu');

// Template redirects for website browsing protection
function wp_private_site_redirect() {
	require_once plugin_dir_path(__FILE__) . 'includes/class-wp-private-site-redirects.php';
	WP_Private_Site_Redirects::redirects();
}
add_action('template_redirect', 'wp_private_site_redirect');

// Log out any user that is logged in by any reason and not authorized (for example, editors that were working on the backend at the moment you enable the private site
function wp_private_site_login_supervision() {
	require_once plugin_dir_path(__FILE__) . 'includes/class-wp-private-site-login-supervision.php';
	WP_Private_Site_Login_Supervision::login_supervision();
}
add_action('init', 'wp_private_site_login_supervision');

// Message in the login page
function wp_private_site_login_message() {
	require_once plugin_dir_path(__FILE__) . 'includes/class-wp-private-site-login-message.php';
	WP_Private_Site_Login_Message::login_message();
}
add_action('login_head','wp_private_site_login_message');

// Private Site Page Template
function wp_private_site_page_template($template) {
	require_once plugin_dir_path(__FILE__) . 'includes/class-wp-private-site-page-template.php';
	$template = WP_Private_Site_Page_Template::page_template($template);
	return $template;
}
add_filter("template_include", "wp_private_site_page_template");

// Plugin scripts and styles
function wp_private_site_styles_and_scripts($hook_suffix) {
	// Admin page scripts and styles
	if ($hook_suffix === 'settings_page_wp_private_site_menu') {
		wp_enqueue_script('wp_private_site_script', plugins_url('admin/js/wp_private_site.js', __FILE__), array("jquery", 'jquery-ui-core', 'jquery-ui-widget', 'jquery-ui-autocomplete', 'jquery-ui-tooltip', 'jquery-ui-button'));
		wp_localize_script('wp_private_site_script', 'ajax', array(
			'ajax_url' => admin_url('admin-ajax.php'),
			'users' => json_encode(get_users())
		));
		wp_enqueue_style('wp_private_site_style', plugins_url('admin/css/wp_private_site.css', __FILE__));
	}
}
add_action('admin_enqueue_scripts', 'wp_private_site_styles_and_scripts');

// Load text domain
function my_plugin_load_plugin_textdomain() {
    load_plugin_textdomain('wp-private-site', FALSE, basename(dirname(__FILE__)) . '/languages/');
}
add_action( 'plugins_loaded', 'my_plugin_load_plugin_textdomain' );
?>