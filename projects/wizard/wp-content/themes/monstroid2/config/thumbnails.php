<?php
/**
 * Thumbnails configuration.
 *
 * @package Monstroid2
 */

add_action( 'after_setup_theme', 'monstroid2_register_image_sizes', 5 );
/**
 * Register image sizes.
 */
function monstroid2_register_image_sizes() {
	set_post_thumbnail_size( 418, 315, true );

	// Registers a new image sizes.
	add_image_size( 'monstroid2-thumb-s', 150, 150, true );
	add_image_size( 'monstroid2-slider-thumb', 158, 88, true );
	add_image_size( 'monstroid2-thumb-m', 400, 400, true );
	add_image_size( 'monstroid2-thumb-m-2', 650, 490, true );
	add_image_size( 'monstroid2-thumb-masonry', 418, 9999 );
	add_image_size( 'monstroid2-thumb-l', 886, 668, true );
	add_image_size( 'monstroid2-thumb-l-2', 886, 315, true );
	add_image_size( 'monstroid2-thumb-xl', 1920, 1080, true );
	add_image_size( 'monstroid2-author-avatar', 512, 512, true );

	add_image_size( 'monstroid2-woo-cart-product-thumb', 141, 188, true );
	add_image_size( 'monstroid2-thumb-listing-line-product', 418, 560, true );

	add_image_size( 'monstroid2-thumb-301-226', 301, 226, true );
	add_image_size( 'monstroid2-thumb-480-362', 480, 362, true );
	add_image_size( 'monstroid2-thumb-1355-1020', 1355, 1020, true );
}
