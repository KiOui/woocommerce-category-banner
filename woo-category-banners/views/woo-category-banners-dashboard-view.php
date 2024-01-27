<?php
/**
 * Print admin dashboard
 *
 * @package woo-category-banners
 */

?>
<div class="wrap">
	<h1 class="wp-heading-inline"><?php esc_html_e( 'Woo Category Banners Dashboard', 'woo-category-banners' ); ?></h1>
	<hr class="wp-header-end">
	<p><?php esc_html_e( 'Woo Category Banners settings', 'woo-category-banners' ); ?></p>
	<form action='/wp-admin/admin.php?page=wcb_admin_menu' method='post'>
		<?php
		settings_fields( 'woo_category_banners_settings' );
		do_settings_sections( 'wcb_admin_menu' );
		submit_button();
		?>
	</form>
</div>
