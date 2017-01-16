<?php
<?php
/**
 * Copy this into your hooks.php file and replace '__tm' prefix with your theme prefix
 */

/**
 * Remap thumbanil ID's and menu terms
 */
add_action( 'cherry_data_import_remap_posts', 'monstroid2_remap_buddypress' );
function monstroid2_remap_buddypress( $posts ) {

	$pages = get_option( 'bp-pages' );

	var_dump( $pages );

	if ( empty( $pages ) || ! is_array( $pages ) ) {
		return;
	}

	$new_pages = array();

	foreach ( $pages as $page => $id ) {
		if ( empty( $posts[ $id ] ) ) {
			$new_pages[ $page ] = $posts[ $id ];
		}
	}

	if ( ! empty( $new_pages ) ) {
		update_option( 'bp-pages', $new_pages );
	}

}

add_action( 'cherry_data_import_remap_posts', 'monstroid2_remap_woo' );
function monstroid2_remap_woo( $posts ) {

	$options = array(
		'woocommerce_shop_page_id',
		'shop_catalog_image_size',
		'shop_single_image_size',
		'shop_thumbnail_image_size',
		'woocommerce_cart_page_id',
		'woocommerce_checkout_page_id',
		'woocommerce_terms_page_id',
		'tm_woowishlist_page',
		'tm_woocompare_page',
	);

	foreach ( $options as $option ) {
		$id =  get_option($option );
		if ( empty( $posts[ $id ] ) ) {
			update_option( $option, $posts[ $id ] );
		}
	}

}
