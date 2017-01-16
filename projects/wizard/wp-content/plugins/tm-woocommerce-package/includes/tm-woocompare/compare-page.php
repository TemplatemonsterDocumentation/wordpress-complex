<?php

// register filter hooks
add_filter( 'the_content', 'tm_woocompare_render_compare_page', 9 );

/**
 * Renders compare page.
 *
 * @since 1.0.0
 * @filter the_content
 *
 * @param string $content The initial page content.
 * @return string The updated page content.
 */
function tm_woocompare_render_compare_page( $content ) {

	if ( !is_page() || get_option( 'tm_woocompare_compare_page' ) != get_the_ID() ) {
		return $content;
	}

	$list = tm_woocompare_get_compare_list();
	if ( empty( $list ) ) {
		return $content . '<p class="tm-woocompare-empty-compare">' . get_option( 'tm_woocompare_empty_text', 'No products found to compare.' ) . '</p>';
	}

	return $content . tm_woocompare_compare_list_render( $list );
}