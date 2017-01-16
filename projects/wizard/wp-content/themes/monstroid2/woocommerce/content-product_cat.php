<?php
/**
 * The template for displaying product category thumbnails within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product_cat.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see     http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.6.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $woocommerce_loop;

// Store loop count we're currently on.
if ( empty( $woocommerce_loop['loop'] ) ) {
	$woocommerce_loop['loop'] = 0;
}

// Store column count for displaying the grid.
if ( empty( $woocommerce_loop['columns'] ) ) {
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );
}

// Increase loop count.
$woocommerce_loop['loop']++;

$classes = array();
if ( 0 === ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 === $woocommerce_loop['columns'] ) {
	$classes[] = 'first';
}
if ( 0 === $woocommerce_loop['loop'] % $woocommerce_loop['columns'] ) {
	$classes[] = 'last';
}
if( is_product() || ( isset( $no_grid ) && $no_grid ) ) {
	$classes[] = 'swiper-slide';
}
else if ( is_shop() || is_product_category() || is_product_tag() ) {
	$sidebar_position = get_theme_mod( 'sidebar_position' );

	if ( 'one-left-sidebar' === $sidebar_position || 'one-right-sidebar' === $sidebar_position ) {
		$classes[] = 'col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4';
	} else{
		$classes[] = 'col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-3';
	}
} else {
	$col = ( 12 / $woocommerce_loop['columns'] );
	$classes[] = 'col-xs-12 col-sm-6 col-md-6 col-lg-' . $col . ' col-xl-' . $col;
}


if ( isset( $no_grid ) && $no_grid ) { ?>
<li <?php wc_product_cat_class( $classes, $category ); ?>>
<?php } else {
$col = ( 12 / $woocommerce_loop['columns'] ); ?>
<div <?php wc_product_cat_class( $classes, $category ); ?>>
<?php
}
	/**
	 * woocommerce_before_subcategory hook.
	 *
	 * @hooked woocommerce_template_loop_category_link_open - 10
	 */
	do_action( 'woocommerce_before_subcategory', $category );

	/**
	 * woocommerce_before_subcategory_title hook.
	 *
	 * @hooked woocommerce_subcategory_thumbnail - 10
	 */
	do_action( 'woocommerce_before_subcategory_title', $category );

	/**
	 * woocommerce_shop_loop_subcategory_title hook.
	 *
	 * @hooked woocommerce_template_loop_category_title - 10
	 */
	do_action( 'woocommerce_shop_loop_subcategory_title', $category );

	/**
	 * woocommerce_after_subcategory_title hook.
	 */
	do_action( 'woocommerce_after_subcategory_title', $category );

	/**
	 * woocommerce_after_subcategory hook.
	 *
	 * @hooked woocommerce_template_loop_category_link_close - 10
	 */
	do_action( 'woocommerce_after_subcategory', $category );

if ( isset( $no_grid ) && $no_grid ) { ?>
</li>
<?php } else { ?>
</div>
<?php } ?>
