<?php
/**
 * mp-restaurant-menu hooks.
 *
 * @package Monstroid2
 */
// Hooks shortcode menu-item grid layout
remove_action( 'mprm_shortcode_menu_item_grid', 'mprm_menu_item_grid_image', 20 );
remove_action( 'mprm_shortcode_menu_item_grid', 'mprm_menu_item_grid_title', 30 );
remove_action( 'mprm_shortcode_menu_item_grid', 'mprm_menu_item_grid_ingredients', 40 );
remove_action( 'mprm_shortcode_menu_item_grid', 'mprm_menu_item_grid_attributes', 50 );
remove_action( 'mprm_shortcode_menu_item_grid', 'mprm_menu_item_grid_excerpt', 60 );
remove_action( 'mprm_shortcode_menu_item_grid', 'mprm_menu_item_grid_tags', 70 );
remove_action( 'mprm_shortcode_menu_item_grid', 'mprm_menu_item_grid_price', 75 );

add_action( 'mprm_shortcode_menu_item_grid', 'monstroid2_mprm_menu_item_image_before', 20 );
add_action( 'mprm_shortcode_menu_item_grid', 'mprm_menu_item_grid_image', 25 );
add_action( 'mprm_shortcode_menu_item_grid', 'mprm_menu_item_grid_tags', 30 );
add_action( 'mprm_shortcode_menu_item_grid', 'monstroid2_mprm_menu_item_image_after', 35 );
add_action( 'mprm_shortcode_menu_item_grid', 'monstroid2_mprm_menu_item_entry_header_before', 40 );
add_action( 'mprm_shortcode_menu_item_grid', 'mprm_menu_item_grid_title', 43 );
add_action( 'mprm_shortcode_menu_item_grid', 'mprm_menu_item_grid_price', 45 );
add_action( 'mprm_shortcode_menu_item_grid', 'monstroid2_mprm_menu_item_entry_header_after', 50 );
add_action( 'mprm_shortcode_menu_item_grid', 'monstroid2_mprm_menu_item_main_content_before', 55 );
add_action( 'mprm_shortcode_menu_item_grid', 'mprm_menu_item_grid_excerpt', 60 );
add_action( 'mprm_shortcode_menu_item_grid', 'mprm_menu_item_grid_attributes', 65 );
add_action( 'mprm_shortcode_menu_item_grid', 'monstroid2_mprm_menu_item_main_content_after', 70 );
add_action( 'mprm_shortcode_menu_item_grid', 'mprm_menu_item_grid_ingredients', 75 );

// Hooks shortcode menu-item simple-list layout
remove_action( 'mprm_shortcode_menu_item_simple-list', 'mprm_menu_item_list_attributes', 30 );
remove_action( 'mprm_shortcode_menu_item_simple-list', 'mprm_menu_item_list_excerpt', 35 );

add_action( 'mprm_shortcode_menu_item_simple-list', 'monstroid2_mprm_menu_item_main_content_before', 28 );
add_action( 'mprm_shortcode_menu_item_simple-list', 'mprm_menu_item_list_excerpt', 30 );
add_action( 'mprm_shortcode_menu_item_simple-list', 'mprm_menu_item_list_attributes', 35 );
add_action( 'mprm_shortcode_menu_item_simple-list', 'monstroid2_mprm_menu_item_main_content_after', 35 );

// Hooks shortcode menu-item list layout
remove_action( 'mprm_shortcode_menu_item_list', 'mprm_menu_item_list_ingredients', 30) ;
remove_action( 'mprm_shortcode_menu_item_list', 'mprm_menu_item_list_attributes', 35 );
remove_action( 'mprm_shortcode_menu_item_list', 'mprm_menu_item_list_excerpt', 40 );
remove_action( 'mprm_shortcode_menu_item_list', 'mprm_menu_item_list_tags', 45 );
remove_action( 'mprm_shortcode_menu_item_list', 'mprm_menu_item_list_price', 50 );

add_action( 'mprm_shortcode_menu_item_list', 'monstroid2_mprm_menu_item_entry_header_before', 23 );
add_action( 'mprm_shortcode_menu_item_list', 'mprm_menu_item_list_price', 28 );
add_action( 'mprm_shortcode_menu_item_list', 'monstroid2_mprm_menu_item_entry_header_after', 30 );
add_action( 'mprm_shortcode_menu_item_list', 'monstroid2_mprm_menu_item_main_content_before', 33 );
add_action( 'mprm_shortcode_menu_item_list', 'mprm_menu_item_list_excerpt', 35 );
add_action( 'mprm_shortcode_menu_item_list', 'mprm_menu_item_list_attributes', 40 );
add_action( 'mprm_shortcode_menu_item_list', 'monstroid2_mprm_menu_item_main_content_after', 43 );
add_action( 'mprm_shortcode_menu_item_list', 'mprm_menu_item_list_ingredients', 45 );
add_action( 'mprm_shortcode_menu_item_list', 'mprm_menu_item_list_tags', 50 );

// Single post hooks
remove_action( 'mprm_before_menu_item_header', 'mprm_before_menu_item_header', 10 );
remove_action( 'mprm_menu_item_header', 'mprm_menu_item_header', 5 );
remove_action( 'mprm_after_menu_item_header', 'mprm_after_menu_item_header', 10 );

remove_action( 'mprm_menu_item_content', 'mprm_menu_item_content_comments', 30 );

add_action( 'mprm_menu_item_content_before', 'monstroid2_mprm_menu_item_single_title', 10 );
add_action( 'mprm_menu_item_content_before', 'monstroid2_mprm_menu_item_single_image', 20 );

add_action( 'mprm_menu_item_content_after', 'monstroid2_mprm_menu_item_share_btns', 10 );
add_action( 'mprm_menu_item_content_after', 'mprm_menu_item_content_comments', 20 );

// Remove actions single theme view
remove_action( 'mprm_menu_item_single_theme_view', 'get_gallery_theme_view', 5 );
remove_action( 'mprm_menu_item_single_theme_view', 'get_price_theme_view', 10 );
remove_action( 'mprm_menu_item_single_theme_view', 'mprm_get_purchase_template', 15 );
remove_action( 'mprm_menu_item_single_theme_view', 'get_ingredients_theme_view', 20 );
remove_action( 'mprm_menu_item_single_theme_view', 'get_attributes_theme_view', 25 );
remove_action( 'mprm_menu_item_single_theme_view', 'get_nutritional_theme_view', 30 );
remove_action( 'mprm_menu_item_single_theme_view', 'get_related_items_theme_view', 35 );

// Taxonomy page hooks
remove_action( 'mprm_taxonomy_grid', 'mprm_single_category_grid_header', 10 );
remove_action( 'mprm_taxonomy_grid', 'mprm_single_category_grid_image', 25 );
remove_action( 'mprm_taxonomy_grid', 'mprm_single_category_grid_ingredients', 45 );
remove_action( 'mprm_taxonomy_grid', 'mprm_single_category_grid_tags', 50 );
remove_action( 'mprm_taxonomy_grid', 'mprm_single_category_grid_price', 55 );

add_action( 'mprm_taxonomy_grid', 'monstroid2_mprm_single_category_grid_header', 10 );
add_action( 'mprm_taxonomy_grid', 'monstroid2_mprm_menu_item_entry_header_before', 38 );
add_action( 'mprm_taxonomy_grid', 'mprm_single_category_grid_price', 43 );
add_action( 'mprm_taxonomy_grid', 'monstroid2_mprm_menu_item_entry_header_after', 45 );
add_action( 'mprm_taxonomy_grid', 'monstroid2_mprm_menu_item_main_content_before', 47 );
add_action( 'mprm_taxonomy_grid', 'monstroid2_mprm_single_taxonomy_excerpt', 50 );
add_action( 'mprm_taxonomy_grid', 'monstroid2_mprm_single_taxonomy_attributes', 53 );
add_action( 'mprm_taxonomy_grid', 'monstroid2_mprm_menu_item_main_content_after', 55 );

/**
 * Mprm menu-item image html-wrapper before.
 */
function monstroid2_mprm_menu_item_image_before() {
	echo '<figure class="mprm-image-wrap">';
}

/**
 * Mprm menu-item image html-wrapper after.
 */
function monstroid2_mprm_menu_item_image_after() {
	echo '</figure>';
}

/**
 * Mprm menu-item header html-wrapper before.
 */
function monstroid2_mprm_menu_item_entry_header_before() {
	echo '<header class="mprm-header-wrap">';
}

/**
 * Mprm menu-item header html-wrapper after.
 */
function monstroid2_mprm_menu_item_entry_header_after() {
	echo '</header>';
}

/**
 * Mprm menu-item content html-wrapper before.
 */
function monstroid2_mprm_menu_item_main_content_before() {
	echo '<div class="mprm-main-cnt-wrap">';
}

/**
 * Mprm menu-item content html-wrapper after.
 */
function monstroid2_mprm_menu_item_main_content_after() {
	echo '</div>';
}

/**
 * Mprm menu-item single title html
 */
function monstroid2_mprm_menu_item_single_title() {
	monstroid2_utility()->utility->attributes->get_title( array(
		'class' => 'mprm-title',
		'html'  => '<h3 %1$s>%4$s</h3>',
		'echo'  => true,
	) );
}

/**
 * Mprm menu-item single feature image html
 */
function monstroid2_mprm_menu_item_single_image() {
	monstroid2_utility()->utility->media->get_image( array(
		'size'        => 'monstroid2-thumb-l',
		'mobile_size' => 'monstroid2-thumb-l',
		'html'        => '<figure class="mprm-image-wrap"><img class="mprm-image" src="%3$s" alt="%4$s"></figure>',
		'placeholder' => false,
		'echo'        => true,
	) );
}

/**
 * Print share buttons.
 */
function monstroid2_mprm_menu_item_share_btns() {
	monstroid2_share_buttons( 'single' );
}

/**
 * Taxonomy header before.
 */
function monstroid2_mprm_single_category_grid_header() { ?>
	<div <?php post_class( 'mprm-remove-hentry mprm-col col-xs-12 col-md-6' ) ?>>
	<?php
}

/**
 * Taxonomy excerpt.
 */
function monstroid2_mprm_single_taxonomy_excerpt() {
	monstroid2_utility()->utility->attributes->get_content( array (
		'length'       => -1,
		'content_type' => 'post_excerpt',
		'class'        => 'mprm-excerpt mprm-content-container',
		'echo'         => true,
	) );
}

/**
 * Taxonomy attributes.
 */
function monstroid2_mprm_single_taxonomy_attributes() {
	mprm_get_template( 'common/attributes' );
}
