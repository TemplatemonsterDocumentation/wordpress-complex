<?php

if ( is_admin() ) {
	require_once 'settings.php';
}
if ( 'yes' !== get_option( 'tm_woocompare_enable_compare', 'yes' ) ) {
	return;
}
require_once 'buttons.php';
if ( ! is_admin() ) {
	require_once 'shortcode.php';
	if ( intval( get_option( 'tm_woocompare_compare_page' ) ) > 0 ) {
		require_once 'compare-page.php';
	}
}
require_once 'widget.php';

if ( ! session_id() ) {
	session_start();
}

// register action hooks
add_action( 'wp_enqueue_scripts', 'tm_woocompare_setup_plugin' );

add_action( 'wp_ajax_tm_woocompare_add_to_list', 'tm_woocompare_process_button_action' );
add_action( 'wp_ajax_nopriv_tm_woocompare_add_to_list', 'tm_woocompare_process_button_action' );

add_action( 'wp_ajax_tm_woocompare_remove', 'tm_woocompare_process_remove_button_action' );
add_action( 'wp_ajax_nopriv_tm_woocompare_remove', 'tm_woocompare_process_remove_button_action' );

add_action( 'wp_ajax_tm_woocompare_empty', 'tm_woocompare_process_empty_button_action' );
add_action( 'wp_ajax_nopriv_tm_woocompare_empty', 'tm_woocompare_process_empty_button_action' );

add_action( 'wp_ajax_tm_woocompare_update', 'tm_woocompare_process_ajax' );
add_action( 'wp_ajax_nopriv_tm_woocompare_update', 'tm_woocompare_process_ajax' );

/**
 * Registers scripts, styles and page endpoint.
 *
 * @since 1.1.0
 * @action init
 */
function tm_woocompare_setup_plugin() {

	// register scripts and styles
	if ( ! is_admin() ) {

		wp_localize_script( 'tm-woocompare', 'tmWoocompare', array(
			'ajaxurl'      => admin_url( 'admin-ajax.php', is_ssl() ? 'https' : 'http' ),
			'compareText' => get_option( 'tm_woocompare_compare_text', __( 'Add to Compare', 'tm-woocommerce-package' ) ),
			'removeText'  => get_option( 'tm_woocompare_remove_text', __( 'Remove from Compare List', 'tm-woocommerce-package' ) ),
			'isSingle'    => is_single()
		) );
	}
}

/**
 * Returns compare list.
 *
 * @sicne 1.0.0
 *
 * @return array The array of product ids to compare.
 */
function tm_woocompare_get_compare_list() {

	$tm_woocompare_list = ! empty( $_SESSION['tm-compare-list'] ) ? $_SESSION['tm-compare-list'] : array();

	if ( ! empty( $tm_woocompare_list ) ) {

		$tm_woocompare_list = explode( ':', $tm_woocompare_list );
		$nonce              = array_pop( $tm_woocompare_list );
		if ( !wp_verify_nonce( $nonce, implode( $tm_woocompare_list ) ) ) {
			$tm_woocompare_list = array();
		}
	}
	return $tm_woocompare_list;
}

/**
 * Sets new list of products to compare.
 *
 * @since 1.0.0
 *
 * @param array $list The new array of products to compare.
 */
function tm_woocompare_set_compare_list( $list ) {

	$nonce = wp_create_nonce( implode( $list ) );
	$value = implode( ':', array_merge( $list, array( $nonce ) ) );

	$_SESSION['tm-compare-list'] = $value;
}

/**
 * Returns compare page link which contains products endpoint.
 *
 * @since 1.0.0
 *
 * @param array $items The array of product ids to compare.
 * @return string The compare pare link on success, otherwise FALSE.
 */
function tm_woocompare_get_compare_page_link() {

	$page_id = intval( get_option( 'tm_woocompare_compare_page', '' ) );

	if ( ! $page_id ) {
		return false;
	}
	$page_link = get_permalink( $page_id );

	if ( ! $page_link ) {
		return false;
	}
	return trailingslashit( $page_link );
}

/**
 * Processes buttons actions.
 *
 * @since 1.0.0
 * @action template_redirect
 */
function tm_woocompare_process_button_action() {

	$product_id = filter_input( INPUT_POST, 'pid' );

	if ( ! wp_verify_nonce( filter_input( INPUT_POST, 'nonce' ), 'tm_woocompare' . $product_id ) ) {

		wp_send_json_error();

		exit();
	}
	$list = tm_woocompare_get_compare_list();

	$key = array_search( $product_id, $list );

	$compare_page_button = '';

	if ( false !== $key ) {

		$action = 'remove-from-list';
		tm_woocompare_remove_product_from_compare_list( $product_id );

	} else {

		$action = 'add-to-list';
		$compare_page_button = tm_woocompare_page_button();
		tm_woocompare_add_product_to_compare_list( $product_id );
	}
	wp_send_json_success( array( 'action' => $action, 'comparePageBtn' => $compare_page_button ) );

	exit();
}

function tm_woocompare_empty_compare_message() {

	return '<p class="tm-woocompare-empty-compare">' . get_option( 'tm_woocompare_empty_text', 'No products found to compare.' ) . '</p>';
}

function tm_woocompare_get_loader() {

	$loader = '<svg width="60px" height="60px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid" class="uil-ring-alt"><rect x="0" y="0" width="100" height="100" fill="none" class="bk"></rect><circle cx="50" cy="50" r="40" stroke="#afafb7" fill="none" stroke-width="10" stroke-linecap="round"></circle><circle cx="50" cy="50" r="40" stroke="#5cffd6" fill="none" stroke-width="6" stroke-linecap="round"><animate attributeName="stroke-dashoffset" dur="2s" repeatCount="indefinite" from="0" to="502"></animate><animate attributeName="stroke-dasharray" dur="2s" repeatCount="indefinite" values="150.6 100.4;1 250;150.6 100.4"></animate></circle></svg>';

	return '<div class="tm-woocompare-loader">' . apply_filters( 'tm_woocompare_list_loader', $loader ) . '</div>';
}

function tm_woocompare_process_ajax() {

	$is_compare_page = json_decode( filter_input( INPUT_POST, 'isComparePage' ) );
	$is_widget       = json_decode( filter_input( INPUT_POST, 'isWidget' ) );
	$json            = array();
	$list            = tm_woocompare_get_compare_list();

	if ( $is_compare_page ) {

		if ( empty( $list ) ) {

			$json['compareList'] = tm_woocompare_empty_compare_message();

		} else {

			$json['compareList'] = tm_woocompare_compare_list_render_table( $list );
		}
	}
	if ( $is_widget ) {

		if ( empty( $list ) ) {

			$json['widget'] = tm_woocompare_empty_compare_message();

		} else {

			$json['widget'] = tm_woocompare_compare_list_render_widget( $list );
		}
	}
	wp_send_json_success( $json );

	exit();
}

function tm_woocompare_process_remove_button_action() {

	$product_id = filter_input( INPUT_POST, 'pid' );

	if ( ! wp_verify_nonce( filter_input( INPUT_POST, 'nonce' ), 'tm_woocompare' . $product_id ) ) {

		wp_send_json_error();

		exit();
	}
	tm_woocompare_remove_product_from_compare_list( $product_id );

	tm_woocompare_process_ajax();
}

function tm_woocompare_process_empty_button_action() {

	tm_woocompare_set_compare_list( array() );

	tm_woocompare_process_ajax();

}

/**
 * Adds product to compare list.
 *
 * @since 1.0.0
 *
 * @param int $product_id The product id to add to the compare list.
 */
function tm_woocompare_add_product_to_compare_list( $product_id ) {

	$list   = tm_woocompare_get_compare_list();
	$list[] = $product_id;

	tm_woocompare_set_compare_list( $list );
}

/**
 * Removes product from compare list.
 *
 * @since 1.0.0
 *
 * @param int $product_id The product id to remove from compare list.
 */
function tm_woocompare_remove_product_from_compare_list( $product_id ) {

	$list = tm_woocompare_get_compare_list();

	foreach ( wp_parse_id_list( $product_id ) as $product_id ) {

		$key = array_search( $product_id, $list );

		if ( false !== $key ) {
			unset( $list[$key] );
		}
	}
	tm_woocompare_set_compare_list( $list );
}

function get_compared_products( $list ) {

	$query_args = array(
		'post_type' => 'product',
		'post__in'  => $list,
		'orderby'  => 'post__in'
	);
	$products = new WP_Query( $query_args );

	return $products;
}

/**
 * Renders compare list table.
 *
 * @since 1.1.0
 *
 * @param array $list The array of compare products.
 * @param array $attributes The array of attributes to show in the table.
 * @return string Compare table HTML.
 */
function tm_woocompare_compare_list_render( $list, $attributes = array() ) {

	if ( empty( $list ) ) {
		return tm_woocompare_empty_compare_message();
	}
	$content   = array();
	$content[] = '<div class="woocommerce tm-woocompare-list">';
	$content[] = '<div class="woocommerce tm-woocompare-wrapper">';
	$content[] = tm_woocompare_compare_list_render_table( $list, $attributes );
	$content[] = '</div>';
	$content[] = tm_woocompare_get_loader();
	$content[] = '</div>';

	return implode( "\n", $content );
}

function tm_woocompare_compare_list_render_widget( $list ) {

	if ( empty( $list ) ) {
		return tm_woocompare_empty_compare_message();
	}
	$products = get_compared_products( $list );
	$template         = get_option( 'tm_woocompare_widget_template', 'widget.tmpl' );
	$template = tm_woocommerce_templater()->get_template_by_name( $template, 'tm-woocompare' );

	if( ! $template ) {
		$template = tm_woocommerce_templater()->get_template_by_name( 'widget.tmpl', 'tm-woocompare' );
	}

	$content  = array();

	if ( $products->have_posts() ) {

		$content[] = '<div class="tm-woocompare-widget-products">' . "\n";

		while ( $products->have_posts() ) {

			$products->the_post();

			global $product;

			if ( empty( $product ) ) {
				continue;
			}
			$nonce     = wp_create_nonce( 'tm_woocompare' . $product->id );
			$content[] = '<div class="tm-woocompare-widget-product">' . "\n";
			$content[] = '<span class="tm-woocompare-remove-from-list" data-id="' . $product->id . '" data-nonce="' . $nonce . '">&times;</span>';
			$content[] = tm_woocommerce_templater()->parse_template( $template );
			$content[] = '</div>';
		}
		$content[] = '</div>';
		$content[] = '<a href="' . tm_woocompare_get_compare_page_link() . '" class="button btn btn-default compare_link_btn">' . __( 'Compare products' , 'tm-woocommerce-package' ) . '</a>';
		$content[] = '<button type="button" class="button btn btn-primary btn-danger empty_compare_button">' . __( 'Empty compare' , 'tm-woocommerce-package' ) . '</button>';
		$content[] = tm_woocompare_get_loader();
	}
	wp_reset_query();

	return implode( "\n", $content );
}

/**
 * Renders compare table.
 *
 * @since 1.1.0
 *
 * @param array $products The compare items list.
 */
function tm_woocompare_compare_list_render_table( $list, $selected_attributes = array() ) {

	if ( empty( $list ) ) {
		return tm_woocompare_empty_compare_message();
	}
	$products         = get_compared_products( $list );
	$products_content = array();
	$template         = get_option( 'tm_woocompare_page_template', 'page.tmpl' );
	$template         = tm_woocommerce_templater()->get_template_by_name( $template, 'tm-woocompare' );

	if( ! $template ) {
		$template = tm_woocommerce_templater()->get_template_by_name( 'page.tmpl', 'tm-woocompare' );
	}

	$replace_data     = tm_woocommerce_templater()->get_replace_data();

	while ( $products->have_posts() ) {

		$products->the_post();

		global $product;

		if ( empty( $product ) ) {
			continue;
		}
		preg_match_all( tm_woocommerce_templater()->macros_regex(), $template, $matches );

		if( ! empty( $matches[1] ) ) {

			foreach ( $matches[1] as $match ) {

				$macros   = array_filter( explode( ' ', $match, 2 ) );
				$callback = strtolower( $macros[0] );
				$attr     = isset( $macros[1] ) ? shortcode_parse_atts( $macros[1] ) : array();

				if ( ! isset( $replace_data[ $callback ] ) ) {
					continue;
				}
				$callback_func = $replace_data[ $callback ];

				if ( ! is_callable( $callback_func ) ) {
					continue;
				}
				$content = call_user_func( $callback_func, $attr );

				if( 'attributes' == $callback ) {
					$products_content[$product->id][$callback] = $content;
				} else {
					$products_content[$product->id][] = $content;
				}
			}
		}
	}
	wp_reset_query();

	$parsed_products = tm_woocompare_compare_list_parse_products( $products_content );

	return tm_woocompare_compare_list_get_table( $parsed_products, $products );
}

function tm_woocompare_compare_list_get_table( $content, $products ) {

	$html = array();
	$i    = 0;
	foreach ( $content as $key => $row ) {

		$row = array_filter( $row );

		$i++;

		if( empty( $row ) ) {

			continue;
		}
		if ( 1 == $i ) {

			$html[] = '<table class="tm-woocompare-table tablesaw" data-tablesaw-mode="swipe">';
			$html[] = '<thead>';
		}
		if ( 2 == $i ) {

			$html[] = '<tbody>';
		}
		$html[] = '<tr class="tm-woocompare-row">';

		if ( 1 == $i ) {

			$tag    = 'th';
			$html[] = '<th class="tm-woocompare-heading-cell title" data-tablesaw-priority="persist">';

		} else {

			$tag    = 'td';
			$html[] = '<th class="tm-woocompare-heading-cell title">';
		}
		if ( 'string' === gettype( $key ) ) {

			$html[] = $key;
		}
		$html[] = '</th>';

		while ( $products->have_posts() ) {

			$products->the_post();

			global $product;

			$html[] = '<' . $tag . ' class="tm-woocompare-cell">';
			if ( 1 == $i ) {
				$nonce  = wp_create_nonce( 'tm_woocompare' . $product->id );
				$html[] = '<div class="tm-woocompare-remove-from-list" data-id="' . $product->id . '" data-nonce="' . $nonce . '">&times;</div>';
			}
			$html[] = $row[$product->id];
			$html[] = '</' . $tag . '>';
		}

		$html[] = '</tr>';

		if ( 1 == $i ) {

			$html[] = '</thead>';
		}
		if ( $i == count( $content ) ) {

			$html[] = '</tbody>';
			$html[] = '</table>';
		}
	}
	wp_reset_query();

	return implode( "\n", $html );
}

function tm_woocompare_compare_list_parse_products_attributes( $attributes ) {

	$rebuilded_attributes = array();

	foreach ( $attributes as $id => $attribute ) {

		foreach ( $attribute as $attr_name => $attribute_value ) {

			$rebuilded_attributes[$attr_name][$id] = $attribute_value;
		}
	}
	foreach ( $rebuilded_attributes as $attr_name => $attr_products ) {

		foreach ( $attributes as $id => $attribute ) {

			if ( ! array_key_exists( $id, $attr_products ) ) {

				$rebuilded_attributes[$attr_name][$id] = '&#8212;';
			}
		}
	}
	return $rebuilded_attributes;
}

function tm_woocompare_compare_list_parse_products( $products_content ) {

	$parsed_products = array();

	foreach ( $products_content as $product_id => $product_content_arr ) {

		foreach ( $product_content_arr as $key => $product_content ) {

			$parsed_products[$key][$product_id] = $product_content;
		}
	}
	if( array_key_exists( 'attributes', $parsed_products ) && ! empty( $parsed_products['attributes'] ) ) {

		$attributes      = tm_woocompare_compare_list_parse_products_attributes( $parsed_products['attributes'] );
		$key             = array_search( 'attributes', array_keys( $parsed_products ), true );
		$before          = array_slice( $parsed_products, 0, $key, true );
		$after           = array_slice( $parsed_products, ( $key + 1 ), null, true );
		$parsed_products = array_merge( $before, $attributes, $after );
	}
	return $parsed_products;
}