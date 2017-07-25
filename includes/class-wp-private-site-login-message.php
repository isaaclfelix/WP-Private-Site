<?php
/**
 * Displays a message in the login page to let the users know the site is private.
 *
 * @since      1.0.0
 *
 * @package    WP_Private_Site
 * @subpackage WP_Private_Site/includes
 */
class WP_Private_Site_Login_Message {	
	public static function login_message() {
		$active = get_option('wp_private_site_active');
		if ($active) {
			global $error;
			$error  = esc_html__('This site is private.','wp-private-site');
		}
	}
}
?>