<?php
/**
 * Fired during plugin activation
 *
 * @since      1.0.0
 *
 * @package    WP_Private_Site
 * @subpackage WP_Private_Site/includes
 */
class WP_Private_Site_Deactivator {
	public static function deactivate() {
		if (get_option('wp_private_site_active')) {
			delete_option('wp_private_site_active');
		}
	}
}
?>