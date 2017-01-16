<?php

if ( ! function_exists( 'tm_wc_ajax_filters_after_subcategory' ) ) {

	function tm_wc_ajax_filters_after_subcategory( $category, $atts = '' ) {

		if ( 'list' === $atts ) {

			echo apply_filters( 'tm_woo_grid_list_cat_desc_on_list', '<div class="product-category__description">' . $category->category_description . '</div>', $category );
		}
	}
}

if ( ! function_exists( 'tm_wc_ajax_filters_shop_loop_subcategory_title' ) ) {

	function tm_wc_ajax_filters_shop_loop_subcategory_title( $category, $atts = '' ) {

		if ( 'list' === $atts ) { ?>
		<h3>
			<?php
				echo $category->name;
			?>
		</h3>
		<?php if ( $category->count > 0 ) {

			global $wp_query;

			if ( 1 == $category->count ) {

				$name = isset( $wp_query->queried_object->labels->singular_name ) ? $wp_query->queried_object->labels->singular_name : __( 'Product', 'tm-woocommerce-package' );
			} else {

				$name = isset( $wp_query->queried_object->labels->name ) ? $wp_query->queried_object->labels->name : __( 'Products', 'tm-woocommerce-package' );
			}

			echo apply_filters( 'woocommerce_subcategory_count_html_list', ' <div class="count"><span>' . $category->count . '</span> ' . $name . '</div>', $category );
			}
		} else {

			woocommerce_template_loop_category_title( $category );
		}
	}
}

if ( ! function_exists( 'tm_wc_ajax_is_shop' ) ) {

	/**
	 * Check if we processing AJAX request from shop page
	 *
	 * @return bool
	 */
	function tm_wc_ajax_is_shop() {

		$ref = ( ! empty( $_REQUEST['pageRef'] ) ) ? (int) $_REQUEST['pageRef'] : false;

		if ( ! $ref ) {
			return false;
		}

		if ( ! function_exists( 'wc_get_page_id' ) ) {
			return false;
		}

		return ( $ref == wc_get_page_id( 'shop' ) );

	}

}