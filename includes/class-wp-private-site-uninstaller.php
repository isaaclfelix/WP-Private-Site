<?php
/**
 * Fired during plugin uninstall process
 *
 * @since      1.0.0
 *
 * @package    WP_Private_Site
 * @subpackage WP_Private_Site/includes
 */
class WP_Private_Site_Uninstaller {
	public static function uninstall() {
		if (get_option('wp_private_site_active')) {
			delete_option('wp_private_site_active');
		}
		if (get_option('wp_private_site_allowed_users')) {
			delete_option('wp_private_site_allowed_users');
		}
	}
}
?>