<?php
/**
 * Handles the default template for the private site and the template overriding.
 *
 * @since      1.0.0
 *
 * @package    WP_Private_Site
 * @subpackage WP_Private_Site/includes
 */
class WP_Private_Site_Page_Template {
	public static function page_template($template) {
		$active = get_option('wp_private_site_active');
		if ($active) {
			$current_user = wp_get_current_user()->user_login; // Get current user
			$allowed_users = get_option('wp_private_site_allowed_users');
			$allowed = false;
			foreach ($allowed_users as $allowed_user) {
				if ($current_user === $allowed_user) {
					$allowed = true;
				}
			}
			if (!$allowed) {
				$located = locate_template('wp-private-site-landing.php');
				if (!empty($located)) {
					$template = get_template_directory() . '/wp-private-site-landing.php';
				}
				else {
					$template = plugin_dir_path( __FILE__ ) . 'public/wp-private-site-landing.php';
				}
				
			}
		}
		return $template;
	}
}
?>