<?php
// Wrap TM about store widget
add_filter( 'tm_about_store_widget_args', 'monstroid2_skin3_about_store_widget_args', 10, 5 );

// Add custom size product thumbnail loop
remove_action( 'tm_smart_box_woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
remove_action( 'tm_smart_box_woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail_custom_size', 10 );
add_action( 'tm_smart_box_woocommerce_before_shop_loop_item_title', 'monstroid2_skin3_template_loop_product_thumbnail_custom_size', 10 );

/**
 * Wrap TM about store widget
 *
 * @return array
 */
function monstroid2_skin3_about_store_widget_args( $args, $instance, $widget, $before_widget, $after_widget ) {
	$args[ 'before_widget' ] .= '<div>';
	$after_widget[ 'after_widget' ] = '</div>' . $after_widget[ 'after_widget' ];
	$args[ 'after_widget' ]         = implode( "\n", $after_widget );

	return $args;
}

/**
 * Add custom size product thumbnail loop
 *
 * @return string
 */
function monstroid2_skin3_template_loop_product_thumbnail_custom_size() {
	echo woocommerce_get_product_thumbnail( 'shop_catalog' );
}