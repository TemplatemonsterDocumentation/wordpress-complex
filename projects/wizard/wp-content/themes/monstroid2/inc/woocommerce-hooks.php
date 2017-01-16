<?php


if ( defined( 'WC_VERSION' ) && version_compare( WC_VERSION, '2.3', '>=' ) ) {
	add_filter( 'woocommerce_add_to_cart_fragments', 'monstroid2_cart_link_fragment' );
} else {
	add_filter( 'add_to_cart_fragments', 'monstroid2_cart_link_fragment' );
}


/**
 * Monstroid2 WooCommerce Theme hooks.
 *
 * @package Monstroid2
 */

add_action( 'after_setup_theme', 'monstroid2_woocommerce_support' );

add_action( 'wp_enqueue_scripts', 'monstroid2_enqueue_assets' );

remove_action( 'woocommerce_after_shop_loop_item_title', 'tm_products_carousel_widget_sale_end_date', 11 );

add_action( 'woocommerce_before_shop_loop_item_title', 'monstroid2_products_sale_end_date', 11 );

add_filter( 'woocommerce_get_price_html_from_to', 'monstroid2_woocommerce_get_price_html_from_to', 10, 3 );

add_action( 'woocommerce_before_shop_loop_item_title', 'monstroid2_woocommerce_show_flash' );

add_action( 'woocommerce_single_product_summary', 'monstroid2_woocommerce_show_flash', 4 );

remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );

add_filter( 'woocommerce_product_thumbnails_columns', 'monstroid2_thumb_cols' );

add_filter( 'tm_products_carousel_widget_wrapper_open', 'monstroid2_tm_products_carousel_widget_wrapper_open' );

add_filter( 'tm_products_carousel_widget_wrapper_close', 'monstroid2_tm_products_carousel_widget_wrapper_close' );


//Change layout loop product elements

remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );

add_action( 'woocommerce_before_shop_loop_item', 'monstroid2_product_image_wrap_open', 2 ); // open block_product_thumbnail

add_action( 'woocommerce_before_shop_loop_item', 'monstroid2_compare_wishlist_wrap_open', 3 ); // open wishlist_compare_button_block

remove_action( 'woocommerce_after_shop_loop_item', 'tm_woowishlist_add_button_loop', 12 );
remove_action( 'woocommerce_after_shop_loop_item', 'tm_woocompare_add_button_loop', 12 );

add_action( 'woocommerce_before_shop_loop_item', 'monstroid2_woowishlist_add_button_loop', 4 );
add_action( 'woocommerce_before_shop_loop_item', 'monstroid2_woocompare_add_button_loop', 4 );

add_action( 'woocommerce_before_shop_loop_item', 'monstroid2_compare_wishlist_wrap_close', 5 ); // close wishlist_compare_button_block

add_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 6 ); //open link

add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 10 ); //close link

add_action( 'woocommerce_before_shop_loop_item_title', 'monstroid2_product_image_wrap_close', 11 ); // close block_product_thumbnail

add_action( 'woocommerce_before_shop_loop_item_title', 'monstroid2_product_content_wrap_open', 11 ); // open block_product_content


remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
add_action( 'woocommerce_shop_loop_item_title', 'monstroid2_template_loop_product_title', 10 ); // Title

remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_price', 5 ); // Price


remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
add_action( 'woocommerce_after_shop_loop_item', 'monstroid2_woocommerce_template_loop_rating', 10 ); // rating
add_action( 'woocommerce_after_shop_loop_item', 'monstroid2_woocommerce_template_loop_rating_list', 6 ); // rating

add_action( 'woocommerce_after_shop_loop_item', 'monstroid2_product_content_wrap_close', 12 ); // close block_product_content

add_action( 'woocommerce_after_shop_loop_item', 'monstroid2_woowishlist_add_button_loop_list', 11 );
add_action( 'woocommerce_after_shop_loop_item', 'monstroid2_woocompare_add_button_loop_list', 11 );

add_action( 'woocommerce_after_shop_loop_item', 'monstroid2_woocommerce_display_short_excerpt', 7 );


//Add list categories for widget-carousel products

remove_action( 'woocommerce_before_subcategory_title', 'woocommerce_subcategory_thumbnail', 10 );
add_action( 'woocommerce_before_subcategory_title', 'woocommerce_subcategory_thumbnail', 10, 2 );

remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
add_action( 'woocommerce_before_shop_loop_item_title', 'monstroid2_get_product_thumbnail_size', 9 );

//Change layout loop list product elements

add_action( 'woocommerce_after_shop_loop_item', 'monstroid2_compare_wishlist_wrap_list_open', 10 );
add_action( 'woocommerce_after_shop_loop_item', 'monstroid2_compare_wishlist_wrap_list_close', 12 );

//Change layout loop category-list product elements

remove_action( 'woocommerce_shop_loop_subcategory_title', 'woocommerce_template_loop_category_title', 10 );
remove_action( 'woocommerce_shop_loop_subcategory_title', 'tm_wc_ajax_filters_shop_loop_subcategory_title', 10 );

add_action( 'woocommerce_after_subcategory', 'woocommerce_template_loop_category_title', 10 );

//Change layout single  product elements

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 12 );

add_action( 'woocommerce_single_product_summary', 'monstroid2_compare_wishlist_wrap_open', 34 );
add_action( 'woocommerce_single_product_summary', 'monstroid2_compare_wishlist_wrap_close', 36 );

remove_action( 'woocommerce_single_product_summary', 'toastie_wc_smsb_form_code', 31 );
add_action( 'woocommerce_single_product_summary', 'toastie_wc_smsb_form_code', 45 );

add_filter( 'tm_categories_carousel_widget_arrows_pos', 'monstroid2_tm_categories_carousel_widget_arrows_pos' );
add_filter( 'tm_products_carousel_widget_arrows_pos', 'monstroid2_tm_categories_carousel_widget_arrows_pos' );
//Wrap single product page content

add_action( 'woocommerce_before_single_product_summary', 'monstroid2_single_product_open_wrapper', 9 );
add_action( 'woocommerce_after_single_product_summary', 'monstroid2_single_product_close_wrapper', 9 );


//Hooks for single-product images
add_filter( 'woocommerce_product_gallery_attachment_ids', 'monstroid2_woocommerce_product_gallery_attachment_ids' );
add_filter( 'woocommerce_single_product_image_thumbnail_html', 'monstroid2_woocommerce_single_product_image_thumbnail_html', 10, 4 );
add_filter( 'woocommerce_single_product_image_html', 'monstroid2_woocommerce_single_product_image_html', 10, 2 );
// Countdown

remove_action( 'tm_smart_box_woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
add_action( 'tm_smart_box_woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail_custom_size', 10 );
add_filter( 'tm_products_smart_box_widget__cat_img_size', 'monstroid2_products_smart_box_widget__cat_img_size' );

add_filter( 'woocommerce_pagination_args', 'monstroid2_woocommerce_pagination_args', 10 );

add_action( 'woocommerce_before_shop_loop_item_title', 'monstroid2_woocommerce_list_categories', 14 );

add_filter( 'tm_products_sale_end_date_format', 'monstroid2_products_format_sale_end_date' );

add_filter( 'woocommerce_cart_item_name', 'monstroid2_woocommerce_cart_item_name', 10, 3 );

remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
add_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display', 12 );

