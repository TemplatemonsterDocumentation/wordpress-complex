<?php
/**
 * Change default category image size
 *
 * @return string
 */
add_filter( 'mprm_category_image_size', 'monstroid2_skin5_mprm_category_image_size' );

function monstroid2_skin5_mprm_category_image_size( $size ) {
	return 'monstroid2-thumb-m-2';
}

/**
 * Price wrap open tag
 *
 * @return string
 */
add_filter( 'mprm_price_theme_view_before', 'monstroid2_skin5_mprm_price_theme_add_open_tag' );

function monstroid2_skin5_mprm_price_theme_add_open_tag() {
	echo '<div class="mprm-price">';
}

/**
 * Price wrap close tag
 *
 * @return string
 */
add_filter( 'mprm_price_theme_view_after', 'monstroid2_skin5_mprm_price_theme_add_close_tag' );

function monstroid2_skin5_mprm_price_theme_add_close_tag() {
	echo '</div>';
}
