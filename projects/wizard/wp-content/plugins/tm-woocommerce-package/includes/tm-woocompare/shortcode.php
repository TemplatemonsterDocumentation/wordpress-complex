<?php

// add action hooks
add_action( 'wp_enqueue_scripts', 'tm_woocompare_enqueue_shortcode_scripts' );
// add shortcode hooks
add_shortcode( 'products-compare', 'tm_woocompare_compare_shortcode' );

/**
 * Enqueues scripts and styles for shortcode.
 *
 * @since 1.1.0
 * @action wp_enqueue_scripts
 */
function tm_woocompare_enqueue_shortcode_scripts() {
	if ( is_single() || is_page() ) {
		$post = get_queried_object();
		if ( is_a( $post, 'WP_Post' ) && preg_match( '/\[products-compare.*?\]/is', $post->post_content ) || ( is_page() && get_option( 'tm_woocompare_compare_page' ) == get_the_ID() ) ) {
			wp_enqueue_style( 'tablesaw' );
			wp_enqueue_script( 'tablesaw-init' );
		}
	}
}

/**
 * Renders compare list shortcode.
 *
 * @since 1.1.0
 * @shortcode products-compare
 *
 * @param array $atts The array of shortcode attributes.
 * @param string $content The shortcode content.
 */
function tm_woocompare_compare_shortcode( $atts, $content = '' ) {
	$atts = shortcode_atts( array( 'ids' => '', 'atts' => '' ), $atts, 'tm-products-compare' );

	$list = wp_parse_id_list( $atts['ids'] );
	if ( !empty( $list ) ) {
		$attributes = array_filter( array_map( 'trim', explode( ',', $atts['atts'] ) ) );
		return tm_woocompare_compare_list_render( $list, $attributes );
	}

	return $content;
}