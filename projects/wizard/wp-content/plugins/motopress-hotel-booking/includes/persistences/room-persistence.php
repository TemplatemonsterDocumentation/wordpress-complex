<?php

namespace MPHB\Persistences;

class RoomPersistence extends RoomTypeDependencedPersistence {

	/**
	 *
	 * @return array
	 */
	protected function getDefaultQueryAtts(){
		$defaultAtts = parent::getDefaultQueryAtts();

		$defaultAtts['orderby']	 = 'menu_order';
		$defaultAtts['order']	 = 'ASC';
		return $defaultAtts;
	}

	/**
	 *
	 * @param array $atts
	 */
	protected function modifyQueryAtts( $atts ){
		$atts = parent::modifyQueryAtts( $atts );
		if ( isset( $atts['post_status'] ) && $atts['post_status'] === 'all' ) {
			$atts['post_status'] = array(
				'publish',
				'pending',
				'draft',
				'future',
				'private'
			);
		}
		return $atts;
	}

	/**
	 *
	 * @global WPDB $wpdb
	 * @param array $atts
	 * @param string $atts['availability'] Optional. Accepts 'free', 'locked', 'booked', 'pending'. Default 'free'
	 *                                     free - has no bookings with status complete or pending for this days x room
	 *                                     locked - has bookings with status complete or pending for this days x room
	 *                                     booked - has bookings with status complete for this days x room
	 *                                     pending - has bookings with status pending for this days x rooms
	 * @param \DateTime $atts['from_date] Optional. Default today.
	 * @param \DateTime $atts['to_date'] Optional.Default today.
	 * @return array Array of Ids.
	 */
	public function searchRooms( $atts = array() ){
		global $wpdb;

		$defaultAtts = array(
			'availability'	 => 'free',
			'from_date'		 => new \DateTime( current_time( 'mysql' ) ),
			'to_date'		 => new \DateTime( current_time( 'mysql' ) )
		);

		$atts = array_merge( $defaultAtts, $atts );

		$fromDate	 = clone $atts['from_date'];
		$toDate		 = clone $atts['to_date'];

		$fromDateNextDay = clone $fromDate;
		$fromDateNextDay->modify( '+1 day' );
		$toDatePrevDay	 = clone $toDate;
		$toDatePrevDay->modify( '-1 day' );

		$whereDatesIntersect = "( ( ( $wpdb->postmeta.meta_key = 'mphb_check_in_date' AND CAST($wpdb->postmeta.meta_value AS DATE) BETWEEN '%s' AND '%s' ) OR ( $wpdb->postmeta.meta_key = 'mphb_check_out_date' AND CAST($wpdb->postmeta.meta_value AS DATE) BETWEEN '%s' AND '%s' ) OR ( ( mt1.meta_key = 'mphb_check_in_date' AND CAST(mt1.meta_value AS DATE) <= '%s' ) AND ( mt2.meta_key = 'mphb_check_out_date' AND CAST(mt2.meta_value AS DATE) >= '%s' ) ) ) )";

		switch ( $atts['availability'] ) {
			case 'free':
				$bookingStatuses = MPHB()->postTypes()->booking()->statuses()->getLockedRoomStatuses();
				break;
			case 'booked':
				$bookingStatuses = MPHB()->postTypes()->booking()->statuses()->getBookedRoomStatuses();
				break;
			case 'pending':
				$bookingStatuses = MPHB()->postTypes()->booking()->statuses()->getPendingRoomStatuses();
				break;
			case 'locked':
				$bookingStatuses = MPHB()->postTypes()->booking()->statuses()->getLockedRoomStatuses();
				break;
		}

		foreach ( $bookingStatuses as &$status ) {
			$status = "$wpdb->posts.post_status = '$status'";
		}
		$whereBookingStatusLockRoom = "(( " . implode( ' OR ', $bookingStatuses ) . " )) ";

		$query = "SELECT mt3.meta_value "
			. "FROM $wpdb->posts "
			. "INNER JOIN $wpdb->postmeta ON ( $wpdb->posts.ID = $wpdb->postmeta.post_id ) "
			. "INNER JOIN $wpdb->postmeta AS mt1 ON ( $wpdb->posts.ID = mt1.post_id ) "
			. "INNER JOIN $wpdb->postmeta AS mt2 ON ( $wpdb->posts.ID = mt2.post_id ) "
			. "INNER JOIN $wpdb->postmeta AS mt3 ON ( $wpdb->posts.ID = mt3.post_id ) "
			. "WHERE 1=1 "
			. "AND $wpdb->posts.post_type = '" . MPHB()->postTypes()->booking()->getPostType() . "' "
			. "AND $whereDatesIntersect AND $whereBookingStatusLockRoom"
			. "AND mt3.meta_key = 'mphb_room_id' "
			. "AND mt3.meta_value IS NOT NULL "
			. "AND mt3.meta_value <> ''"
			. "GROUP BY mt3.meta_value ";

		$query = sprintf( $query, $fromDate->format( 'Y-m-d' ), $toDatePrevDay->format( 'Y-m-d' ), $fromDateNextDay->format( 'Y-m-d' ), $toDate->format( 'Y-m-d' ), $fromDate->format( 'Y-m-d' ), $toDate->format( 'Y-m-d' ) );

		if ( $atts['availability'] === 'free' ) {
			$bookedRooms = $query;
			$query		 = "SELECT rooms.ID "
				. "FROM $wpdb->posts as rooms "
				. "WHERE 1=1 "
				. "AND rooms.post_type = '" . MPHB()->postTypes()->room()->getPostType() . "' "
				. "AND rooms.post_status = 'publish' "
				. "AND rooms.ID NOT IN ( $bookedRooms ) "
				. "ORDER BY rooms.ID "
				. "DESC";
		}

		return $wpdb->get_col( $query );
	}

}
