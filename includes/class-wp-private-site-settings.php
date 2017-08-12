<?php
/**
 * Fired during plugin settings registration
 *
 * @since      1.0.0
 *
 * @package    WP_Private_Site
 * @subpackage WP_Private_Site/includes
 */
class WP_Private_Site_Settings {
	private function wp_private_site_canActivate($input) {
		$active = get_option('wp_private_site_active');
		$allowed_users = get_option('wp_private_site_allowed_users');
		if (!$allowed_users && $active) {
			add_settings_error('wp_private_site_allowed_users','wp_private_site_allowed_users_error',__('We could not start the private site because no users are whitelisted','wp-private-site'),'error');
			delete_option('wp_private_site_active');
		}
		return $input;
	}

	public static function settings() {
		register_setting('wp_private_site_menu', 'wp_private_site_active', 'wp_private_site_canActivate');
		register_setting('wp_private_site_menu', 'wp_private_site_allowed_users');
		
		add_settings_section("wp_private_site_active_section1",
		 __("Enable / Disable", "wp-private-site"),
		 "wp_private_site_active_section1",
		 "wp_private_site_menu");
		
		add_settings_field("wp_private_site_active_section1_field1",
		__("Active", "wp-private-site"),
		"wp_private_site_active_section1_field1",
		"wp_private_site_menu",
		"wp_private_site_active_section1");
		
		add_settings_field("wp_private_site_active_section1_field2",
		__("Users", "wp-private-site"),
		"wp_private_site_active_section1_field2",
		"wp_private_site_menu",
		"wp_private_site_active_section1");
		
		add_settings_field("wp_private_site_active_section1_field3",
		__("Granted access", "wp-private-site"),
		"wp_private_site_active_section1_field3",
		"wp_private_site_menu",
		"wp_private_site_active_section1");
	
		function wp_private_site_active_section1($args) {
			?>
			<p id="<?php echo esc_attr( $args['id'] ); ?>"><?php esc_html_e( 'Toggle between private & public.', 'wp-private-site' ); ?></p>
			<?php
		}
		function wp_private_site_active_section1_field1() {
			?>
			<input type="checkbox" name="wp_private_site_active" value="1" <?php checked(1, get_option('wp_private_site_active'), true); ?>>
			<?php
		}
		
		function wp_private_site_active_section1_field2() {
			?>
			<div class="wp_private_site_users">
				<div class="ui-widget">
					<select id="combobox">
						<?php
						$users = get_users();
						foreach ($users as $user) {
						?>
						<option value="<?php echo $user->user_login; ?>"><?php echo $user->user_login; ?></option>
						<?php
						}
						?>
					</select>
					<?php submit_button(__('Grant access', 'wp-private-site'), 'secondary'); ?>
					<?php
					if (get_option('wp_private_site_allowed_users')) { 
						$allowed_users = get_option('wp_private_site_allowed_users');
						foreach ($allowed_users as $allowed_user) {
							echo '<input type="hidden" value="' . $allowed_user . '" name="wp_private_site_allowed_users[' . $allowed_user . ']" />';
						}
					}
					?>
				</div>
			</div>
			<?php
		}
		
		function wp_private_site_active_section1_field3() {
			?>
			<ul class="allowed-users">
			<?php
			if (get_option('wp_private_site_allowed_users')) { 
			?>
				<?php 
				$allowed_users = get_option('wp_private_site_allowed_users');
				foreach ($allowed_users as $allowed_user) {
					?>
					<li class="allowed-user" id="<?php echo $allowed_user; ?>"><?php echo $allowed_user; ?> <span class="dashicons dashicons-dismiss remove"></span></li>
					<?php
				}
				?>
			<?php
			} else {
				?>
				<li class="no-users-whitelisted">No user has been whitelisted.</li>
				<?php
			}
			?>
			</ul>
			<?php
		}
	}
}
?>