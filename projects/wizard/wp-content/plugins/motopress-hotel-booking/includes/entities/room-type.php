<?php

namespace MPHB\Entities;

use \MPHB\Utils;

/**
 *
 * @param int|\WP_Post $id
 */
class RoomType {

	private $id;
	private $post;

	/**
	 *
	 * @param int|\WP_Post $id
	 */
	public function __construct( $post ){
		if ( is_a( $post, '\WP_Post' ) ) {
			$this->post	 = $post;
			$this->id	 = $post->ID;
		} else {
			$this->id	 = absint( $post );
			$this->post	 = get_post( $this->id );
		}
	}

	/**
	 *
	 * @return bool
	 */
	public function isCorrect(){
		if ( is_null( $this->post ) ||
			$this->post->post_type !== MPHB()->postTypes()->roomType()->getPostType()
		) {
			return false;
		}

		$rates = MPHB()->getRateRepository()->findAllActiveByRoomType( $this->id );
		return count( $rates ) > 0;
	}

	/**
	 *
	 * @return int
	 */
	public function getId(){
		return $this->id;
	}

	/**
	 *
	 * @return string
	 */
	public function getTitle(){
		return get_the_title( $this->id );
	}

	/**
	 * Check is room type has gallery
	 *
	 * @return bool
	 */
	public function hasGallery(){
		$idsString = get_post_meta( $this->id, 'mphb_gallery', true );
		return !empty( $idsString );
	}

	/**
	 * Retrieve ids of gallery's attachments
	 *
	 * @return array
	 */
	public function getGalleryIds(){
		$idsString = get_post_meta( $this->id, 'mphb_gallery', true );
		return explode( ',', $idsString );
	}

	/**
	 * Check is room type has featured image
	 *
	 * @return bool
	 */
	public function hasFeaturedImage(){
		return has_post_thumbnail( $this->id );
	}

	/**
	 * Retrieve room type featured image id.
	 *
	 * @return string | int Room type featured image ID or empty string.
	 */
	public function getFeaturedImageId(){
		return get_post_thumbnail_id( $this->id );
	}

	/**
	 * Retrieve room type categories
	 *
	 * @return string
	 */
	public function getCategories(){
		$atts = array(
			'fields' => 'name'
		);

		$categories = $this->getCategoriesArray( $atts );

		return implode( ', ', $categories );
	}

	/**
	 *
	 * @return array
	 */

	/**
	 *
	 * @param array $atts @see wp_get_post_terms
	 * @return array
	 */
	public function getCategoriesArray( $atts = array() ){
		$defaultAtts = array(
			'fields' => 'all'
		);

		$atts = array_merge( $defaultAtts, $atts );

		return wp_get_post_terms( $this->id, MPHB()->postTypes()->roomType()->getCategoryTaxName(), $atts );
	}

	/**
	 *
	 * @return string
	 */
	public function getFacilities(){
		$atts = array(
			'fields' => 'name'
		);

		$facilities = $this->getFacilitiesArray( $atts );
		return implode( ', ', $facilities );
	}

	/**
	 *
	 * @return array
	 */
	public function getFacilitiesArray( $atts = array() ){
		$defaultAtts = array(
			'fields' => 'all'
		);

		$atts = array_merge( $defaultAtts, $atts );
		return wp_get_post_terms( $this->id, MPHB()->postTypes()->roomType()->getFacilityTaxName(), $atts );
	}

	/**
	 *
	 * @return string
	 */
	public function getView(){
		return get_post_meta( $this->id, 'mphb_view', true );
	}

	/**
	 *
	 * @param bool $withUnits Optional. Whether to append units to size. Default FALSE.
	 * @return string
	 */
	public function getSize( $withUnits = false ){
		$size = get_post_meta( $this->id, 'mphb_size', true );
		return !empty( $size ) ? ( $withUnits ? $size . MPHB()->settings()->units()->getSquareUnit() : $size ) : '';
	}

	/**
	 *
	 * @return string
	 */
	public function getBedType(){
		return get_post_meta( $this->id, 'mphb_bed', true );
	}

	/**
	 *
	 * @return int
	 */
	public function getAdultsCapacity(){
		$capacity = get_post_meta( $this->id, 'mphb_adults_capacity', true );
		return (int) (!empty( $capacity ) ? $capacity : MPHB()->settings()->main()->getMinAdults() );
	}

	/**
	 *
	 * @return int
	 */
	public function getChildrenCapacity(){
		$capacity = get_post_meta( $this->id, 'mphb_children_capacity', true );
		return (int) (!empty( $capacity ) ? $capacity : 0 );
	}

	public function getLink(){
		return get_permalink( $this->id );
	}

	/**
	 *
	 * @return bool
	 */
	public function hasServices(){
		$services = $this->getServices();
		return !empty( $services );
	}

	/**
	 * Retrieve services available for this room type
	 *
	 * @return array
	 */
	public function getServices(){
		$services = get_post_meta( $this->id, 'mphb_services', true );
		return $services !== '' ? $services : array();
	}

	/**
	 *
	 * @return array
	 */
	public function getServicesPriceList(){
		$prices		 = array();
		$services	 = $this->getServices();
		foreach ( $services as $serviceId ) {
			$service = MPHB()->getServiceRepository()->findById( $serviceId );
			if ( $service ) {
				$prices[$service->getId()] = $service->getPrice();
			}
		}
		return $prices;
	}

	/**
	 *
	 * @param bool $fromToday
	 * @param bool|string status of bookings
	 * @return array dates in format Y-m-d
	 */
	public function getBookingsCountByDay( $fromToday = true, $status = false ){
		$dates		 = array();
		$postStatus	 = $status ? $status : MPHB()->postTypes()->booking()->statuses()->getLockedRoomStatuses();

		$roomsIds = MPHB()->getRoomPersistence()->getPosts(
			array(
				'room_type'		 => $this->id,
				'post_status'	 => 'publish'
			)
		);

		if ( $fromToday ) {
			$metaQuery = array(
				'relation' => 'AND',
				array(
					array(
						'key'		 => 'mphb_room_id',
						'value'		 => $roomsIds,
						'compare'	 => 'IN'
					),
					// prevent retrieving bookings that have already finished
					array(
						'key'		 => 'mphb_check_out_date',
						'value'		 => mphb_current_time( 'Y-m-d' ),
						'compare'	 => '>=',
						'type'		 => 'DATE'
					)
				)
			);
		} else {
			$metaQuery = array(
				array(
					'key'		 => 'mphb_room_id',
					'value'		 => $roomsIds,
					'compare'	 => 'IN'
				)
			);
		}

		$bookingAtts = array(
			'post_status'	 => $postStatus,
			'meta_query'	 => $metaQuery
		);

		$bookings = MPHB()->getBookingRepository()->findAll( $bookingAtts );

		$dates = array();
		foreach ( $bookings as $booking ) {
			foreach ( $booking->getDates( $fromToday ) as $dateYmd => $date ) {
				if ( isset( $dates[$dateYmd] ) ) {
					$dates[$dateYmd] ++;
				} else {
					$dates[$dateYmd] = 1;
				}
			}
		}
		ksort( $dates );
		return $dates;
	}

	/**
	 *
	 * @return array
	 */
	public function getDatesHavePrice(){
		$rates = MPHB()->getRateRepository()->findAllActiveByRoomType( $this->id );

		$dates = array();
		foreach ( $rates as $rate ) {
			$dates = array_merge( $dates, array_keys( $rate->getDatePrices() ) );
		}

		return $dates;
	}

	/**
	 *
	 * @global WPDB $wpdb
	 * @param string|\DateTime $checkInDate date in format 'Y-m-d'
	 * @param string|\DateTime $checkOutDate date in format 'Y-m-d
	 * @param bool|int $excludeBooking
	 * @return array
	 */
	public function getAvailableRooms( $checkInDate, $checkOutDate, $excludeBooking = false ){
		global $wpdb;
		if ( is_a( $checkInDate, '\DateTime' ) ) {
			$checkInDate = $checkInDate->format( 'Y-m-d' );
		}
		if ( is_a( $checkOutDate, '\DateTime' ) ) {
			$checkOutDate = $checkOutDate->format( 'Y-m-d' );
		}
		$checkOutPrevDayDate = date( 'Y-m-d', strtotime( $checkOutDate . ' -1 day' ) );
		$checkInNextDayDate	 = date( 'Y-m-d', strToTime( $checkInDate . ' +1 day' ) );

		$whereThisRoom = "( mt0.meta_key = 'mphb_room_id' AND CAST(mt0.meta_value AS CHAR) LIKE $wpdb->posts.ID )";

		$whereDatesIntersect = "( "
			. "( mt1.meta_key = 'mphb_check_in_date' AND CAST(mt1.meta_value AS DATE) BETWEEN '%s' AND '%s' ) "
			. "OR ( mt1.meta_key = 'mphb_check_out_date' AND CAST(mt1.meta_value AS DATE) BETWEEN '%s' AND '%s' ) "
			. "OR ( "
			. "( mt2.meta_key = 'mphb_check_in_date' AND CAST(mt2.meta_value AS DATE) <= '%s' ) "
			. "AND ( mt3.meta_key = 'mphb_check_out_date' AND CAST(mt3.meta_value AS DATE) >= '%s' ) "
			. ") "
			. ")";

		$lockRoomStatuses			 = MPHB()->postTypes()->booking()->statuses()->getLockedRoomStatuses();
		$whereBookingStatusLockRoom	 = "p0.post_type = 'mphb_booking' AND ";
		foreach ( $lockRoomStatuses as &$status ) {
			$status = "p0.post_status = '$status'";
		}
		$whereBookingStatusLockRoom .= "((" . implode( ' OR ', $lockRoomStatuses ) . "))";

		$bookingsRequest = "SELECT p0.ID "
			. "FROM $wpdb->posts AS p0"
			. " INNER JOIN $wpdb->postmeta AS mt0 ON ( p0.ID = mt0.post_id )"
			. " INNER JOIN $wpdb->postmeta AS mt1 ON ( p0.ID = mt1.post_id )"
			. " INNER JOIN $wpdb->postmeta AS mt2 ON ( p0.ID = mt2.post_id )"
			. " INNER JOIN $wpdb->postmeta AS mt3 ON ( p0.ID = mt3.post_id )"
			. " WHERE 1=1 AND ( $whereThisRoom AND $whereDatesIntersect ) AND $whereBookingStatusLockRoom"
			. ( ($excludeBooking) ? " AND $wpdb->posts.ID != " . $excludeBooking : "" )
			. " GROUP BY $wpdb->posts.ID ORDER BY $wpdb->posts.post_date DESC LIMIT 0, 1";

		$request = "SELECT wp_posts.ID
					FROM wp_posts
					INNER JOIN wp_postmeta ON (wp_posts.ID = wp_postmeta.post_id )
					WHERE 1=1 AND wp_postmeta.meta_key = 'mphb_room_type_id' AND CAST( wp_postmeta.meta_value AS CHAR ) LIKE '" . $this->getId() . "'
						AND wp_posts.post_type = '" . MPHB()->postTypes()->room()->getPostType() . "'
						AND wp_posts.post_status = 'publish'
						AND NOT EXISTS ( $bookingsRequest )
					GROUP BY wp_posts.ID
					ORDER BY wp_posts.post_date
					DESC
		";

		$request = $wpdb->prepare( $request, $checkInDate, $checkOutPrevDayDate, $checkInNextDayDate, $checkOutDate, $checkInDate, $checkOutDate );
		return $wpdb->get_col( $request );
	}

	/**
	 *
	 * @param string $checkInDate date in Y-m-d format
	 * @param string $checkOutDate date in Y-m-d format
	 * @return bool
	 */
	public function hasAvailableRoom( $checkInDate, $checkOutDate ){
		// @todo make separate db request
		$availableRooms = $this->getAvailableRooms( $checkInDate, $checkOutDate );
		return !empty( $availableRooms );
	}

	public function getNextAvailableRoom( $checkInDate, $checkOutDate ){
		// @todo make separate db request
		$availableRooms = $this->getAvailableRooms( $checkInDate, $checkOutDate );
		return (int) array_shift( $availableRooms );
	}

}
