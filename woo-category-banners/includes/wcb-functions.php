<?php
/**
 * Woo Category Banners functions
 *
 * @package woo-category-banners
 */

if ( ! function_exists( 'wcb_output_category_banner' ) ) {
	/**
	 * Output the category banner.
	 *
	 * @return void
	 */
	function wcb_output_category_banner(): void {
		$archive = wcb_get_archive();
		if ( null === $archive || 'product_cat' !== $archive->taxonomy ) {
			return;
		}

		$banner_image_id = get_term_meta( $archive->term_id, 'wcb_banner_image', true );

		if ( ! $banner_image_id ) {
			return;
		}

		$banner_image = wp_get_attachment_image_src( $banner_image_id, 'full' );

		if ( false === $banner_image ) {
			return;
		}

		$banner_image_src = $banner_image[0];
		?>
			<div class="wcb-banner-image-wrapper" style="background-image: url('<?php echo esc_attr( $banner_image_src ); ?>');">
				<img src="<?php echo esc_attr( $banner_image_src ); ?>">
			</div>
		<?php
	}
}

if ( ! function_exists( 'wcb_get_archive_post_type' ) ) {
	/**
	 * Get the current archive post type name.
	 *
	 * @return WP_Term|null  The archive post type name or null if not in an archive page.
	 */
	function wcb_get_archive(): ?WP_Term {
		if ( ! is_archive() ) {
			return null;
		}

		$queried_object = get_queried_object();

		if ( 'object' === gettype( $queried_object ) && 'WP_Term' === get_class( $queried_object ) ) {
			return $queried_object;
		} else {
			return null;
		}
	}
}
