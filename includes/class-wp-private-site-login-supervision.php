<?php
/**
 * Checks if unauthorized logged in users that were logged in prior to activation are still logged in and logs them out
 *
 * @since      1.0.0
 *
 * @package    WP_Private_Site
 * @subpackage WP_Private_Site/includes
 */
class WP_Private_Site_Login_Supervision {
	public static function login_supervision() {
		$active = get_option('wp_private_site_active');
		if ($active) {
			$current_user = wp_get_current_user()->user_login;
			$allowed_users = get_option('wp_private_site_allowed_users');
			$allowed = false;
			foreach ($allowed_users as $allowed_user) {
				if ($current_user === $allowed_user) {
					$allowed = true;
				}
			}
			if (!$allowed) {
				wp_logout();
			}
		}
	}
}
?>