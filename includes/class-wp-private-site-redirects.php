<?php
/**
 * Handling of the redirects for the plugin
 *
 * @since      1.0.0
 *
 * @package    WP_Private_Site
 * @subpackage WP_Private_Site/includes
 */
class WP_Private_Site_Redirects {
	public static function redirects() {
		$active = get_option('wp_private_site_active');
		if ($active) {
			if(is_user_logged_in())
			{
				$allowed_users = get_option('wp_private_site_allowed_users');
				if ($allowed_users) {
					$current_user = wp_get_current_user();
					if ($current_user->ID != 0) {
						$allowed = false;
						foreach ($allowed_users as $allowed_user) {
							if ($current_user->user_login === $allowed_user) {
								$allowed = true;
							}
						}
						if (!$allowed) {
							if (!is_front_page()) {
								wp_redirect(site_url());
								exit();
							}
						}
					}
				}
			}
			else {
				if (!is_front_page()) {
					wp_redirect(site_url());
					exit();
				}
			}
		}
	}
}
?>