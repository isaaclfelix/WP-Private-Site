<?php
/**
 * Fired during plugin admin menu creation process
 *
 * @since      1.0.0
 *
 * @package    WP_Private_Site
 * @subpackage WP_Private_Site/includes
 */
class WP_Private_Site_Menu {
	public static function menu() {
		function wp_private_site_page_settings_html() {
			if (!current_user_can('manage_options'))  {
				wp_die(escape_html__('You do not have sufficient permissions to access this page.', "wp-private-site"));
			}
			?>
			<div class="wrap">
				<h1><?php echo esc_html(get_admin_page_title()); ?></h1>
				<form action="options.php" method="post">
					<?php
					settings_fields('wp_private_site_menu');
					do_settings_sections('wp_private_site_menu');
					submit_button(__('Save Settings', 'wp-private-site'));
					?>
				</form>
			</div>
			<?php
		}
		add_options_page( 'Wordpress Private Site Options', 'Wordpress Private Site', 'manage_options', 'wp_private_site_menu', 'wp_private_site_page_settings_html' );
	}
}
?>