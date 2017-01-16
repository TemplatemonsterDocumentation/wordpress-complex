<?php

/**
 * Get template part.
 *
 * @param mixed $slug
 * @param string $name Optional. Default ''.
 */
function mphb_get_template_part( $slug, $args = array() ){

	$template = '';

	// Look in %theme_dir%/%template_path%/slug.php
	$template = locate_template( MPHB()->getTemplatePath() . "{$slug}.php" );

	// Get default template from plugin
	if ( empty( $template ) && file_exists( MPHB()->getPluginPath( "templates/{$slug}.php" ) ) ) {
		$template = MPHB()->getPluginPath( "templates/{$slug}.php" );
	}

	// Allow 3rd party plugins to filter template file from their plugin.
	$template = apply_filters( 'mphb_get_template_part', $template, $slug, $args );

	if ( !empty( $template ) ) {
		mphb_load_template( $template, $args );
	}
}

function mphb_load_template( $template, $templateArgs = array() ){
	if ( $templateArgs && is_array( $templateArgs ) ) {
		extract( $templateArgs );
	}
	require $template;
}

/**
 *
 * @global string $wp_version
 * @param string $type
 * @param bool $gmt
 * @return string
 */
function mphb_current_time( $type, $gmt = 0 ){
	global $wp_version;
	if ( version_compare( $wp_version, '3.9', '<=' ) && !in_array( $type, array( 'timestmap',
			'mysql' ) ) ) {
		$timestamp = current_time( 'timestamp', $gmt );
		return date( $type, $timestamp );
	} else {
		return current_time( $type, $gmt );
	}
}

/**
 * Retrieve a post status label by name
 *
 * @param string $status
 * @return string
 */
function mphb_get_status_label( $status ){
	switch ( $status ) {
		case 'new':
			$label		 = _x( 'New', 'Post Status', 'motopress-hotel-booking' );
			break;
		case 'auto-draft':
			$label		 = _x( 'Auto Draft', 'Post Status', 'motopress-hotel-booking' );
			break;
		default:
			$statusObj	 = get_post_status_object( $status );
			$label		 = !is_null( $statusObj ) && property_exists( $statusObj, 'label' ) ? $statusObj->label : '';
			break;
	}

	return $label;
}

/**
 *
 * @param string $name
 * @param string $value
 * @param int $expire
 */
function mphb_set_cookie( $name, $value, $expire = 0 ){
	setcookie( $name, $value, $expire, COOKIEPATH, COOKIE_DOMAIN );
	if ( COOKIEPATH != SITECOOKIEPATH ) {
		setcookie( $name, $value, $expire, SITECOOKIEPATH, COOKIE_DOMAIN );
	}
}

/**
 *
 * @param string $name
 * @return mixed|null Cookie value or null if not exists.
 */
function mphb_get_cookie( $name ){
	return ( mphb_has_cookie( $name ) ) ? $_COOKIE[$name] : null;
}

/**
 *
 * @param string $name
 * @return bool
 */
function mphb_has_cookie( $name ){
	return isset( $_COOKIE[$name] );
}

function mphb_is_checkout_page(){
	$checkoutPageId = MPHB()->settings()->pages()->getCheckoutPageId();
	return $checkoutPageId && is_page( $checkoutPageId );
}

function mphb_is_search_results_page(){
	$searchResultsPageId = MPHB()->settings()->pages()->getSearchResultsPageId();
	return $searchResultsPageId && is_page( $searchResultsPageId );
}

function mphb_is_single_room_type_page(){
	return is_singular( MPHB()->postTypes()->roomType()->getPostType() );
}

function mphb_get_thumbnail_width(){
	$width = 150;

	$imageSizes = get_intermediate_image_sizes();
	if ( in_array( 'thumbnail', $imageSizes ) ) {
		$width = (int) get_option( "thumbnail_size_w", $width );
	}

	return $width;
}

/**
 *
 * @param float $price
 * @param array $atts
 * @return string
 */
function mphb_format_price( $price, $atts = array() ){

	$defaultAtts = array(
		'decimal_separator'	 => MPHB()->settings()->currency()->getPriceDecimalsSeparator(),
		'thousand_separator' => MPHB()->settings()->currency()->getPriceThousandSeparator(),
		'decimals'			 => MPHB()->settings()->currency()->getPriceDecimalsCount(),
		'price_format'		 => MPHB()->settings()->currency()->getPriceFormat(),
		'literal_free'		 => false,
		'trim_zeros'		 => true
	);

	$atts = wp_parse_args( $atts, $defaultAtts );

	$priceClasses = array( 'mphb-price' );

	if ( $atts['literal_free'] && $price == 0 ) {
		$formattedPrice	 = apply_filters( 'mphb_free_literal', __( 'Free', 'motopress-hotel-booking' ) );
		$priceClasses[]	 = 'mphb-price-free';
	} else {
		$negative	 = $price < 0;
		$price		 = number_format( $price, $atts['decimals'], $atts['decimal_separator'], $atts['thousand_separator'] );
		if ( $atts['trim_zeros'] ) {
			$price = mphb_trim_zeros( $price );
		}
		$formattedPrice = ( $negative ? '-' : '' ) . sprintf( $atts['price_format'], $price );
	}

	$priceClassesStr = join( ' ', $priceClasses );

	return sprintf( '<span class="%s">%s</span>', $priceClassesStr, $formattedPrice );
}

/**
 * Trim trailing zeros off prices.
 *
 * @param mixed $price
 * @return string
 */
function mphb_trim_zeros( $price ){
	return preg_replace( '/' . preg_quote( MPHB()->settings()->currency()->getPriceDecimalsSeparator(), '/' ) . '0++$/', '', $price );
}

/**
 * Get WP Query paged var
 *
 * @return int
 */
function mphb_get_paged_query_var(){
	if ( get_query_var( 'paged' ) ) {
		$paged = absint( get_query_var( 'paged' ) );
	} else if ( get_query_var( 'page' ) ) {
		$paged = absint( get_query_var( 'page' ) );
	} else {
		$paged = 1;
	}
	return $paged;
}

/**
 *
 * @param array $queryPart
 * @param array|null $metaQuery
 * @return array
 */
function mphb_add_to_meta_query( $queryPart, $metaQuery ){

	if ( is_null( $metaQuery ) ) {

		if ( mphb_meta_query_is_first_order_clause( $queryPart ) ) {
			$metaQuery = array( $queryPart );
		} else {
			$metaQuery = $queryPart;
		}

		return $metaQuery;
	}

	if ( !empty( $metaQuery ) && !isset( $metaQuery['relation'] ) ) {
		$metaQuery['relation'] = 'AND';
	}

	if ( isset( $metaQuery['relation'] ) && strtoupper( $metaQuery['relation'] ) === 'AND' ) {

		if ( mphb_meta_query_is_first_order_clause( $queryPart ) ||
			( isset( $queryPart['relation'] ) && strtoupper( $queryPart['relation'] ) === 'OR' )
		) {
			$metaQuery[] = $queryPart;
		} else {
			$metaQuery = array_merge( $metaQuery, $queryPart );
		}
	} else {
		$metaQuery = array(
			'relation' => 'AND',
			$queryPart,
			$metaQuery
		);
	}

	return $metaQuery;
}

/**
 *
 * @param array $query
 * @return bool
 */
function mphb_meta_query_is_first_order_clause( $query ){
	return isset( $query['key'] ) || isset( $query['value'] );
}
