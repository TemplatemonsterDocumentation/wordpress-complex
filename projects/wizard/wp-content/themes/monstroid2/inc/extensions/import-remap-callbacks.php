<?php
/**
 * Remap thumbanil ID's and menu terms
 */
add_action( 'cherry_data_import_remap_posts', 'monstroid2_remap_mprm_tax' );
function monstroid2_remap_mprm_tax( $posts ) {

	global $wpdb;

	$query = "
		SELECT *
		FROM $wpdb->termmeta
		WHERE meta_key LIKE 'mprm_taxonomy_%'
	";

	$taxmeta = $wpdb->get_results( $query );

	if ( empty( $taxmeta ) ) {
		return;
	}

	foreach ( $taxmeta as $tax ) {

		$value = unserialize( $tax->meta_value );
		if ( is_string( $value ) ) {
			$value = unserialize( $value );
		}

		if ( isset( $value['thumbnail_id'] ) && isset( $posts[ $value['thumbnail_id'] ] ) ) {
			$value['thumbnail_id'] = $posts[ $value['thumbnail_id'] ];
		}

		$wpdb->update(
			$wpdb->termmeta,
			array(
				'meta_id'    => $tax->meta_id,
				'term_id'    => $tax->term_id,
				'meta_key'   => 'mprm_taxonomy_' . $tax->term_id,
				'meta_value' => serialize( $value ),
			),
			array(
				'term_id' => $tax->term_id,
			),
			$format = array(
				'meta_id'    => '%d',
				'term_id'    => '%d',
				'meta_key'   => '%s',
				'meta_value' => '%s',
			),
			$where_format = array(
				'term_id' => '%d',
			)
		);
	}
}

/**
 * Remap thumbanil ID's and menu terms
 */
add_action( 'cherry_data_import_remap_posts', 'monstroid2_remap_buddypress' );
function monstroid2_remap_buddypress( $posts ) {

	$pages = get_option( 'bp-pages' );

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