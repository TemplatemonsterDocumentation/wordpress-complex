<?php

namespace MPHB\Shortcodes;

class SearchResultsShortcode extends AbstractShortcode {

	protected $name = 'mphb_search_results';

	const NONCE_NAME			 = 'mphb-search-available-room-nonce';
	const NONCE_ACTION		 = 'mphb-search-available-room';
	const SORTING_MODE_PRICE	 = 'price';
	const SORTING_MODE_ORDER	 = 'order';

	/**
	 *
	 * @var int
	 */
	private $adults;

	/**
	 *
	 * @var int
	 */
	private $children;

	/**
	 *
	 * @var \DateTime
	 */
	private $checkInDate;

	/**
	 *
	 * @var \DateTime
	 */
	private $checkOutDate;

	/**
	 *
	 * @var array
	 */
	private $errors = array();

	/**
	 *
	 * @var bool
	 */
	private $isCorrectInputData = false;

	/**
	 *
	 * @var bool
	 */
	private $isCorrectPage = false;

	/**
	 *
	 * @var array
	 */
	private $roomTypes;

	/**
	 *
	 * @var bool
	 */
	private $isShowTitle;

	/**
	 *
	 * @var bool
	 */
	private $isShowFeaturedImage;

	/**
	 *
	 * @var bool
	 */
	private $isShowGallery;

	/**
	 *
	 * @var bool
	 */
	private $isShowExcerpt;

	/**
	 *
	 * @var bool
	 */
	private $isShowDetails;

	/**
	 *
	 * @var string
	 */
	private $sortingMode;

	public function addActions(){
		parent::addActions();
		add_action( 'wp', array( $this, 'setup' ) );

		add_action( 'mphb_sc_search_results_error', array( '\MPHB\Views\GlobalView', 'prependBr' ) );
	}

	public function render( $atts, $content = '', $shortcodeName ){

		$defaultAtts = array(
			'title'				 => 'true',
			'featured_image'	 => 'false',
			'gallery'			 => 'true',
			'excerpt'			 => 'true',
			'details'			 => 'true',
			'default_sorting'	 => self::SORTING_MODE_ORDER,
			'class'				 => ''
		);

		$atts = shortcode_atts( $defaultAtts, $atts, $shortcodeName );

		$this->isShowTitle			 = $this->convertParameterToBoolean( $atts['title'] );
		$this->isShowFeaturedImage	 = $this->convertParameterToBoolean( $atts['featured_image'] );
		$this->isShowGallery		 = $this->convertParameterToBoolean( $atts['gallery'] );
		$this->isShowExcerpt		 = $this->convertParameterToBoolean( $atts['excerpt'] );
		$this->isShowDetails		 = $this->convertParameterToBoolean( $atts['details'] );
		$this->sortingMode			 = $atts['default_sorting'];

		ob_start();

		if ( $this->isCorrectPage && $this->isCorrectInputData ) {

			$this->setupMatchedRoomTypes();

			if ( !empty( $this->roomTypes ) ) {
				$this->mainLoop();
			} else {
				$this->renderResultsInfo( 0 );
			}
		} else {
			$this->showErrorsMessage();
		}

		$content = ob_get_clean();

		$wrapperClass = apply_filters( 'mphb_sc_search_results_wrapper_class', 'mphb_sc_search_results-wrapper' );
		$wrapperClass .= empty( $wrapperClass ) ? $atts['class'] : ' ' . $atts['class'];
		return '<div class="' . esc_attr( $wrapperClass ) . '">' . $content . '</div>';
	}

	private function mainLoop(){

		$roomTypesQuery = $this->getRoomTypesQuery();

		if ( $roomTypesQuery->have_posts() ) {

			$this->renderResultsInfo( $roomTypesQuery->post_count );

			do_action( 'mphb_sc_search_results_before_loop', $roomTypesQuery );

			while ( $roomTypesQuery->have_posts() ) : $roomTypesQuery->the_post();

				do_action( 'mphb_sc_search_results_before_room' );

				$this->renderRoomType();

				do_action( 'mphb_sc_search_results_after_room' );

			endwhile;

			do_action( 'mphb_sc_search_results_after_loop', $roomTypesQuery );

			wp_reset_postdata();
		} else {
			$this->renderResultsInfo( 0 );
		}
	}

	/**
	 *
	 * @return \WP_Query
	 */
	private function getRoomTypesQuery(){
		$queryAtts = array(
			'post_type'				 => MPHB()->postTypes()->roomType()->getPostType(),
			'post_status'			 => 'publish',
			'meta_query'			 => array(
				'relation' => 'AND',
				array(
					'key'		 => 'mphb_adults_capacity',
					'value'		 => $this->adults,
					'compare'	 => '>=',
					'type'		 => 'NUMERIC'
				),
				array(
					'key'		 => 'mphb_children_capacity',
					'value'		 => $this->children,
					'compare'	 => '>=',
					'type'		 => 'NUMERIC'
				)
			),
			'post__in'				 => $this->roomTypes,
			'posts_per_page'		 => -1,
			'ignore_sticky_posts'	 => true
		);

		switch ( $this->sortingMode ) {
			case self::SORTING_MODE_PRICE :
				$queryAtts['orderby']	 = 'post__in';
				$queryAtts['order']		 = 'ASC';
				break;
			case self::SORTING_MODE_ORDER:
				$queryAtts['orderby']	 = 'menu_order';
				$queryAtts['order']		 = 'ASC';
				break;
		}

		return new \WP_Query( $queryAtts );
	}

	/**
	 *
	 * @global \WPDB $wpdb
	 * @return array
	 */
	private function getAvailableRoomTypes(){
		global $wpdb;

		$checkInDate	 = $this->checkInDate->format( 'Y-m-d' );
		$checkOutDate	 = $this->checkOutDate->format( 'Y-m-d' );

		$checkInNextDayDate	 = date( 'Y-m-d', strToTime( $checkInDate . ' +1 day' ) );
		$checkOutPrevDayDate = date( 'Y-m-d', strtotime( $checkOutDate . ' -1 day' ) );

		$lockedRooms = join( ',', $this->getLockedRooms() );

		$query = "SELECT DISTINCT room_meta.meta_value "
			. "FROM $wpdb->posts as rooms "
			. "INNER JOIN $wpdb->postmeta as room_meta ON (rooms.id = room_meta.post_id) "
			. "WHERE 1=1 "
			. "AND room_meta.meta_key = 'mphb_room_type_id' "
			. "AND rooms.post_type = '" . MPHB()->postTypes()->room()->getPostType() . "' "
			. (!empty( $lockedRooms ) ? "AND rooms.ID NOT IN ( $lockedRooms ) " : "" )
			. "AND rooms.post_status = 'publish' "
			. "AND room_meta.meta_value IS NOT NULL "
			. "AND room_meta.meta_value <> '' "
			. "GROUP BY room_meta.meta_value "
			. "DESC";

		$roomTypes = $wpdb->get_col( $query );

		return $roomTypes;
	}

	/**
	 *
	 * @return array
	 */
	private function getLockedRooms(){

		$checkInDate	 = $this->checkInDate->format( 'Y-m-d' );
		$checkOutDate	 = $this->checkOutDate->format( 'Y-m-d' );

		$checkInNextDayDate	 = date( 'Y-m-d', strToTime( $checkInDate . ' +1 day' ) );
		$checkOutPrevDayDate = date( 'Y-m-d', strtotime( $checkOutDate . ' -1 day' ) );

		$bookingsAtts = array(
			'fields'		 => 'ids',
			'room_locked'	 => true,
			'date_from'		 => $this->checkInDate->format( 'Y-m-d' ),
			'date_to'		 => $this->checkOutDate->format( 'Y-m-d' )
		);

		$bookings = MPHB()->getBookingPersistence()->getPosts( $bookingsAtts );

		$rooms = array();
		foreach ( $bookings as $booking ) {
			$rooms[] = get_post_meta( $booking, 'mphb_room_id', true );
		}

		return array_unique( $rooms );
	}

	private function renderRoomType(){
		$templateAtts = array(
			'checkInDate'	 => $this->checkInDate,
			'checkOutDate'	 => $this->checkOutDate,
			'adults'		 => $this->adults,
			'children'		 => $this->children,
			'isShowGallery'	 => $this->isShowGallery,
			'isShowImage'	 => $this->isShowFeaturedImage,
			'isShowTitle'	 => $this->isShowTitle,
			'isShowExcerpt'	 => $this->isShowExcerpt,
			'isShowDetails'	 => $this->isShowDetails
		);
		mphb_get_template_part( 'shortcodes/search-results/room-content', $templateAtts );
	}

	/**
	 *
	 * @return false|\WP_Query
	 */
	private function setupMatchedRoomTypes(){

		$adults			 = $this->adults;
		$children		 = $this->children;
		$checkInDate	 = $this->checkInDate;
		$checkOutDate	 = $this->checkOutDate;

		$roomTypes = $this->getAvailableRoomTypes();

		$roomTypes = array_filter( $roomTypes, function( $roomTypeId ) use ( $adults, $children, $checkInDate, $checkOutDate ) {

			$roomType = MPHB()->getRoomTypeRepository()->mapPostToEntity( $roomTypeId );

			if ( !$roomType ) {
				return false;
			}

			if ( $roomType->getAdultsCapacity() < $adults ) {
				return false;
			}

			if ( $roomType->getChildrenCapacity() < $children ) {
				return false;
			}

			$rateAtts = array(
				'check_in_date'	 => $checkInDate,
				'check_out_date' => $checkOutDate
			);
			if ( !MPHB()->getRateRepository()->isExistsForRoomType( $roomTypeId, $rateAtts ) ) {
				return false;
			}

			return true;
		} );

		if ( $this->sortingMode === self::SORTING_MODE_PRICE ) {
			$rateAtts			 = array(
				'check_in_date'	 => $checkInDate,
				'check_out_date' => $checkOutDate
			);
			$roomTypeMinPrices	 = array_combine( $roomTypes, array_map( function( $roomType) use($checkInDate, $checkOutDate, $rateAtts) {

					$rates = MPHB()->getRateRepository()->findAllActiveByRoomType( $roomType, $rateAtts );

					$prices = array_map( function( $rate ) use ($checkInDate, $checkOutDate) {
						return $rate->getMinPriceForDates( $checkInDate, $checkOutDate );
					}, $rates );

					return min( $prices );
				}, $roomTypes )
			);

			usort( $roomTypes, function( $roomType1, $roomType2) use ($checkInDate, $checkOutDate, $roomTypeMinPrices) {
				return $roomTypeMinPrices[$roomType1] > $roomTypeMinPrices[$roomType2] ? 1 : -1;
			} );
		}

		$this->roomTypes = $roomTypes;
	}

	private function setupSearchData(){
		$this->adults				 = null;
		$this->children				 = null;
		$this->checkInDate			 = null;
		$this->checkOutDate			 = null;
		$this->isCorrectInputData	 = false;

		if ( isset( $_GET['mphb_adults'] ) && isset( $_GET['mphb_children'] ) && isset( $_GET['mphb_check_in_date'] ) && isset( $_GET['mphb_check_out_date'] ) ) {

			$input = $_GET;
			$this->parseInputData( $input );

			if ( $this->isCorrectInputData ) {
				MPHB()->searchParametersStorage()->save(
					array(
						'mphb_check_in_date'	 => $this->checkInDate->format( MPHB()->settings()->dateTime()->getDateFormat() ),
						'mphb_check_out_date'	 => $this->checkOutDate->format( MPHB()->settings()->dateTime()->getDateFormat() ),
						'mphb_adults'			 => $this->adults,
						'mphb_children'			 => $this->children
					)
				);
			}
		} else if ( MPHB()->searchParametersStorage()->hasStored() ) {
			$this->parseInputData( MPHB()->searchParametersStorage()->get() );
		}
	}

	/**
	 *
	 * @return bool
	 */
	private function parseInputData( $input ){
		$isCorrectAdults		 = $this->parseAdults( $input['mphb_adults'] );
		$isCorrectChildren		 = $this->parseChildren( $input['mphb_children'] );
		$isCorrectCheckInDate	 = $this->parseCheckInDate( $input['mphb_check_in_date'] );
		$isCorrectCheckOutDate	 = $this->parseCheckOutDate( $input['mphb_check_out_date'] );

		$this->isCorrectInputData = ( $isCorrectAdults && $isCorrectChildren && $isCorrectCheckInDate && $isCorrectCheckOutDate );

		return $this->isCorrectInputData;
	}

	public function setup(){
		if ( mphb_is_search_results_page() ) {
			$this->isCorrectPage = true;
			$this->setupSearchData();
		}
	}

	/**
	 *
	 * @param string|int $adults
	 * @return bool
	 */
	private function parseAdults( $adults ){
		$adults = intval( $adults );
		if ( $adults >= MPHB()->settings()->main()->getMinAdults() && $adults <= MPHB()->settings()->main()->getSearchMaxAdults() ) {
			$this->adults = $adults;
			return true;
		} else {
			$this->errors[] = __( 'Number of adults is incorrect.', 'motopress-hotel-booking' );
			return false;
		}
	}

	/**
	 *
	 * @param int|string $children
	 * @return boolean
	 */
	private function parseChildren( $children ){
		$children = intval( $children );
		if ( $children >= MPHB()->settings()->main()->getMinChildren() && $children <= MPHB()->settings()->main()->getSearchMaxChildren() ) {
			$this->children = $children;
			return true;
		} else {
			$this->errors[] = __( 'Number of children is incorrect.', 'motopress-hotel-booking' );
			return false;
		}
	}

	/**
	 *
	 * @param string $date Date in front date format
	 * @return boolean
	 */
	private function parseCheckInDate( $date ){
		$checkInDateObj	 = \DateTime::createFromFormat( MPHB()->settings()->dateTime()->getDateFormat(), $date );
		$todayDate		 = \DateTime::createFromFormat( 'Y-m-d', mphb_current_time( 'Y-m-d' ) );

		if ( !$checkInDateObj ) {
			$this->errors[] = __( 'Check-in date is incorrect.', 'motopress-hotel-booking' );
			return false;
		} else if ( \MPHB\Utils\DateUtils::calcNights( $todayDate, $checkInDateObj ) < 0 ) {
			$this->errors[] = __( 'Check-in date cannot be earlier than today.', 'motopress-hotel-booking' );
			return false;
		}

		$this->checkInDate = $checkInDateObj;
		return true;
	}

	/**
	 *
	 * @param string $date Date in front date format
	 * @return boolean
	 */
	private function parseCheckOutDate( $date ){

		$checkOutDateObj = \MPHB\Utils\DateUtils::createCheckOutDate( MPHB()->settings()->dateTime()->getDateFormat(), $date );

		if ( !$checkOutDateObj ) {
			$this->errors[] = __( 'Check-out date is incorrect.', 'motopress-hotel-booking' );
			return false;
		}

		if ( isset( $this->checkInDate ) &&
			!MPHB()->getRulesChecker()->verify( $this->checkInDate, $checkOutDateObj )
		) {
			$this->errors[] = __( 'Dates are not satisfy booking rules', 'motopress-hotel-booking' );
			return false;
		}

		$this->checkOutDate = $checkOutDateObj;
		return true;
	}

	public function showErrorsMessage(){
		$templateAtts = array(
			'errors' => $this->errors
		);
		mphb_get_template_part( 'shortcodes/search-results/errors', $templateAtts );
	}

	private function renderResultsInfo( $roomTypeCount ){
		$templateAtts = array(
			'roomTypesCount' => $roomTypeCount,
			'adults'		 => $this->adults,
			'children'		 => $this->children,
			'checkInDate'	 => \MPHB\Utils\DateUtils::formatDateWPFront( $this->checkInDate ),
			'checkOutDate'	 => \MPHB\Utils\DateUtils::formatDateWPFront( $this->checkOutDate )
		);
		mphb_get_template_part( 'shortcodes/search-results/results-info', $templateAtts );
	}

}
