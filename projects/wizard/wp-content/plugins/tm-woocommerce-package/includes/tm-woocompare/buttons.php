<?php

// register action hooks
if ( 'yes' === get_option( 'tm_woocompare_show_in_catalog' ) ) {
	add_action( 'woocommerce_after_shop_loop_item', 'tm_woocompare_add_button', 12 );
}
if ( 'yes' === get_option( 'tm_woocompare_show_in_single' ) ) {
	add_action( 'woocommerce_single_product_summary', 'tm_woocompare_add_button', 35 );
}
add_action( 'wp_enqueue_scripts', 'tm_woocompare_enqueue_compare_scripts' );



/**
 * Renders appropriate button for a product.
 *
 * @since 1.0.0
 * @action woocommerce_after_shop_loop_item
 */
function tm_woocompare_add_button() {
	$product_id = get_the_ID();
	$classes = array( 'button', 'tm-woocompare-button', 'btn', 'btn-default' );
	$nonce = wp_create_nonce( 'tm_woocompare' . $product_id );

	if ( in_array( $product_id, tm_woocompare_get_compare_list() ) ) {
		$text = get_option( 'tm_woocompare_remove_text', __( 'Remove from Compare', 'tm-woocommerce-package' ) );
		$classes[] = ' in_compare';
	} else {
		$text = get_option( 'tm_woocompare_compare_text', __( 'Add to Compare', 'tm-woocommerce-package' ) );
	}

	$text = '<span class="tm_woocompare_product_actions_tip"><span class="text">' . esc_html( $text ) . '</span></span>';

	$preloader = apply_filters( 'tm_woocompare_preloader', '' );

	echo '<button type="button" class="' . implode( ' ', $classes ) . '" data-id="'.  $product_id . '" data-nonce="' . $nonce . '">' . $text . $preloader . '</button>';

	if ( in_array( $product_id, tm_woocompare_get_compare_list() ) && is_single() ) {
		echo tm_woocompare_page_button();
	}
}

function tm_woocompare_page_button() {
	return '<a href="' . tm_woocompare_get_compare_page_link( tm_woocompare_get_compare_list() ) . '" class="button btn btn-primary alt tm-woocompare-page-button">'. __( 'View compare', 'tm-woocommerce-package' ) . '</a>';
}

/**
 * Enqueues scripts and styles for compare page.
 *
 * @since 1.0.0
 * @action wp_enqueue_scripts
 */
function tm_woocompare_enqueue_compare_scripts() {
	wp_enqueue_style( 'tm-woocompare' );
	wp_enqueue_script( 'tm-woocompare' );
}