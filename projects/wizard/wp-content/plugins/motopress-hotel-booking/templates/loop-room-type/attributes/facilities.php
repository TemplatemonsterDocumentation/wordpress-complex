<?php
/**
 * Available variables
 * - WP_Term[] $facilities
 */

if ( !defined( 'ABSPATH' ) ) {
	exit;
}
?>

<?php if ( !empty( $facilities ) ) : ?>

	<?php

	/**
	 * @hooked \MPHB\Views\LoopRoomTypeView::_renderFacilitiesListItemOpen	- 10
	 * @hooked \MPHB\Views\LoopRoomTypeView::_renderFacilitiesTitle			- 20
	 */
	do_action( 'mphb_render_loop_room_type_before_facilities' );

	$facilities = array_map( function( $facility ) {

		$facilityLink = get_term_link( $facility );

		if ( is_wp_error( $facilityLink ) ) {
			$facilityLink = '#';
		}

		return sprintf( '<a href="%s">%s</a>', $facilityLink, $facility->name );
	}, $facilities );

	echo ' ' . join( ', ', $facilities );

	/**
	 * @hooked \MPHB\Views\LoopRoomTypeView::_renderFacilitiesListItemClose	- 10
	 */
	do_action( 'mphb_render_loop_room_type_after_facilities' );
	?>

<?php endif; ?>