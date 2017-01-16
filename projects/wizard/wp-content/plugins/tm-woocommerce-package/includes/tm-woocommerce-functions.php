<?php

if ( ! function_exists( 'tm_products_carousel_widget_sale_end_date' ) ) {

	function tm_products_carousel_widget_sale_end_date() {

		global $post, $product;

		$sale_end_date = get_post_meta( $product->id, '_sale_price_dates_to', true );

		$now = time();

		if( '' !== $sale_end_date && $now < $sale_end_date ) {

			$data_format   =  __( '%-D day%!D %H:%M:%S', 'tm-woocommerce-package' );

			if( 86400 > ( $sale_end_date - $now ) ) {

				$data_format   =  __( '%H:%M:%S', 'tm-woocommerce-package' );
			}

			$data_format   = apply_filters( 'tm_products_carousel_widget_sale_end_date_format', $data_format, $sale_end_date );
			$sale_end_date = '<div class="tm-products-carousel-widget-sale-end-date" data-countdown="' . date ( 'Y/m/d', $sale_end_date ) . '" data-format="' . $data_format . '"></div>';

			echo $sale_end_date;
		}
	}

}

if ( ! function_exists( 'tm_woocommerce_package_field_label' ) ) {

	function tm_woocommerce_package_field_label( $key, $value, $setting, $instance ) {

		$html[] = '<p>';
		$html[] = '<label><b>' . $setting["label"] . '</b></label>';
		$html[] = '</p>';

		echo implode ( "\n", $html );
	}

}

if ( ! function_exists( 'tm_products_carousel_widget_cat' ) ) {

	function tm_products_carousel_widget_cat() {

		global $product;

		echo $product->get_categories( '</li> <li>', '<ul class="product-widget-categories"><li>', '</li></ul>' );
	}
}

if ( ! function_exists( 'tm_products_carousel_widget_tag' ) ) {

	function tm_products_carousel_widget_tag() {

		global $product;

		echo $product->get_tags( '</li> <li>', '<ul class="product-widget-tags"><li>', '</li></ul>' );
	}

}

if ( ! function_exists( 'tm_products_carousel_widget_desc' ) ) {

	function tm_products_carousel_widget_desc() {

		$content = get_the_content();

		$tm_products_carousel_widget = new __TM_Products_Carousel_Widget;

		$content = $tm_products_carousel_widget->tm_products_carousel_widget_desc( $content );

		echo '<div class="tm_products_carousel_widget_product_desc">' . $content . '</div>';
	}
}

function tm_products_smart_box_widget_settings_sanitize_option( $instance, $new_instance, $key, $setting ) {

	if ( $setting['type'] === 'multiselect' ) {

		$instance =  esc_sql( $new_instance[ $key ] );
	}
	return $instance;

}

function tm_woocommerce_loop_shop_columns() {

	return 9999;
}

function tm_woocommerce_loop_shop_columns_reset() {

	return 4;
}

if ( ! function_exists( 'tm_categories_carousel_widget_post_class' ) ) {

	function tm_categories_carousel_widget_post_class( $classes ) {

		array_unique( $classes );

		if( false !== $key = array_search( 'first', $classes ) ) {

			unset( $classes[$key] );
		}
		if( false !== $key = array_search( 'last', $classes ) ) {

			unset( $classes[$key] );
		}

		$classes[] = 'swiper-slide';
		$classes[] = 'tm-categories-carousel-widget-slide';

		return $classes;
	}
}

if ( ! function_exists( 'tm_products_carousel_widget_post_class' ) ) {

	function tm_products_carousel_widget_post_class( $classes, $class = '', $post_id = '' ) {

		array_unique( $classes );

		if( false !== $key = array_search( 'first', $classes ) ) {

			unset( $classes[$key] );
		}
		if( false !== $key = array_search( 'last', $classes ) ) {

			unset( $classes[$key] );
		}

		$classes[] = 'swiper-slide';
		$classes[] = 'tm-products-carousel-widget-slide';

		return $classes;
	}
}

if ( ! function_exists( 'tm_woo_render_macros' ) ) {

	/**
	 * Try to render macros in string.
	 *
	 * @param  string $string Content to search macros in.
	 * @return string
	 */
	function tm_woo_render_macros( $string ) {

		$macros_list = apply_filters( 'tm_woo_macros_list', array(
			'%home_url%'  => esc_url( home_url( '/' ) ),
			'%theme_url%' => trailingslashit( get_template_directory_uri() ),
		) );

		return str_replace(
			array_keys( $macros_list ),
			array_values( $macros_list ),
			$string
		);
	}

}
