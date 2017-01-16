<?php
/**
 * Skin2 functions, hooks and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Monstroid2
 */

// Change comment template.
add_filter( 'monstroid2_comment_template_part_slug', 'monstroid2_skin2_comment_template_part_slug' );

// Change carousel-widget template.
add_filter( 'monstroid2_carousel_widget_view_dir', 'monstroid2_skin2_carousel_widget_view_slug' );

/**
 * Change comment template.
 *
 * @return string
 */
function monstroid2_skin2_comment_template_part_slug() {

	return 'skins/skin2/template-parts/comment';
}

/**
 * Change carousel-widget template.
 *
 * @return string
 */
function monstroid2_skin2_carousel_widget_view_slug() {

	return 'skins/skin2/inc/widgets/carousel/views/carousel-view.php';
}
