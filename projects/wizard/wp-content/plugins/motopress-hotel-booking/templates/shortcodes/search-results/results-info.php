<?php
/**
 * Available variables
 * - int $roomTypesCount count of found rooms
 * - int $adults
 * - int $children
 * - string $checkInDate date in human readable format
 * - string $checkOutDate date in human readable format
 */
if ( !defined( 'ABSPATH' ) ) {
	exit;
}
?>
<p class="mphb_sc_search_results-info">
	<?php
	if ( $roomTypesCount > 0 ) {
		printf( _n( '%s room found', '%s rooms found', $roomTypesCount, 'motopress-hotel-booking' ), $roomTypesCount );
	} else {
		_e( 'No rooms found', 'motopress-hotel-booking' );
	}

	printf( __( ' for adults: %d, children: %d', 'motopress-hotel-booking' ), $adults, $children );
	printf( __( ' from %s - till %s', 'motopress-hotel-booking' ), $checkInDate, $checkOutDate );
	?>
</p>
