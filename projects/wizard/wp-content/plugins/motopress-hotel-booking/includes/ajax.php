<?php

namespace MPHB;

use \MPHB\Entities;
use \MPHB\Views;
use \MPHB\Repositories;

class Ajax {

	private $nonceName	 = 'mphb_nonce';
	private $ajaxEvents	 = array(
		'check_room_availability'		 => array(
			'method' => 'GET',
			'nopriv' => true
		),
		'recalculate_total'				 => array(
			'method' => 'GET',
			'nopriv' => false
		),
		'recalculate_checkout_prices'	 => array(
			'method' => 'GET',
			'nopriv' => true
		),
		'get_rates_for_room'			 => array(
			'method' => 'GET',
			'nopriv' => false
		),
		'dismiss_license_notice'		 => array(
			'method' => 'POST',
			'nopriv' => false
		)
	);

	public function __construct(){

		foreach ( $this->ajaxEvents as $action => $details ) {
			$noPriv = isset( $details['nopriv'] ) ? $details['nopriv'] : false;
			$this->addAjaxAction( $action, $noPriv );
		}
	}

	/**
	 *
	 * @param string $action
	 * @param bool $noPriv
	 */
	public function addAjaxAction( $action, $noPriv ){

		add_action( 'wp_ajax_mphb_' . $action, array( $this, $action ) );

		if ( $noPriv ) {
			add_action( 'wp_ajax_nopriv_mphb_' . $action, array( $this, $action ) );
		}
	}

	/**
	 *
	 * @param string $action
	 * @return bool
	 */
	public function checkNonce( $action ){

		if ( !isset( $this->ajaxEvents[$action] ) ) {
			return false;
		}

		$method = isset( $this->ajaxEvents[$action]['method'] ) ? $this->ajaxEvents[$action]['method'] : '';

		switch ( $method ) {
			case 'GET':
				$nonce	 = isset( $_GET[$this->nonceName] ) ? $_GET[$this->nonceName] : '';
				break;
			case 'POST':
				$nonce	 = isset( $_POST[$this->nonceName] ) ? $_POST[$this->nonceName] : '';
				break;
			default:
				$nonce	 = isset( $_REQUEST[$this->nonceName] ) ? $_REQUEST[$this->nonceName] : '';
		}

		return wp_verify_nonce( $nonce, 'mphb_' . $action );
	}

	/**
	 *
	 * @return array
	 */
	public function getAdminNonces(){
		$nonces = array();
		foreach ( $this->ajaxEvents as $evtName => $evtDetails ) {
			$nonces['mphb_' . $evtName] = wp_create_nonce( 'mphb_' . $evtName );
		}
		return $nonces;
	}

	/**
	 *
	 * @return arrray
	 */
	public function getFrontNonces(){
		$nonces = array();
		foreach ( $this->ajaxEvents as $evtName => $evtDetails ) {
			if ( isset( $evtDetails['nopriv'] ) && $evtDetails['nopriv'] ) {
				$nonces['mphb_' . $evtName] = wp_create_nonce( 'mphb_' . $evtName );
			}
		}
		return $nonces;
	}

	public function check_room_availability(){

		// Check Nonce
		if ( !$this->checkNonce( __FUNCTION__ ) ) {
			wp_send_json_error( array(
				'message' => __( 'Request does not pass security verification. Please refresh the page and try one more time.', 'motopress-hotel-booking' )
			) );
		}

		// Check is request parameters setted
		if ( !( isset( $_GET['roomTypeId'] ) && isset( $_GET['checkInDate'] ) && isset( $_GET['checkOutDate'] ) ) ) {
			wp_send_json_error( array(
				'message' => __( 'Please complete all required fields and try again.', 'motopress-hotel-booking' ),
			) );
		}

		$checkInDate = \DateTime::createFromFormat( MPHB()->settings()->dateTime()->getDateFormat(), $_GET['checkInDate'] );
		if ( !$checkInDate ) {
			wp_send_json_error( array(
				'message' => __( 'Check-in date is not valid.', 'motopress-hotel-booking' ),
			) );
		}
		$todayDate = \DateTime::createFromFormat( 'Y-m-d', mphb_current_time( 'Y-m-d' ) );
		if ( \MPHB\Utils\DateUtils::calcNights( $todayDate, $checkInDate ) < 0 ) {
			wp_send_json_error( array(
				'message' => __( 'Check-in date cannot be earlier than today.', 'motopress-hotel-booking' ),
			) );
		}

		$checkOutDate = \DateTime::createFromFormat( MPHB()->settings()->dateTime()->getDateFormat(), $_GET['checkOutDate'] );
		if ( !$checkOutDate ) {
			wp_send_json_error( array(
				'message' => __( 'Check-out date is not valid.', 'motopress-hotel-booking' ),
			) );
		}
		if ( !MPHB()->getRulesChecker()->verify( $checkInDate, $checkOutDate ) ) {
			wp_send_json_error( array(
				'message' => __( 'Dates are not satisfy booking rules.', 'motopress-hotel-booking' ),
			) );
		}

		$roomTypeId	 = absint( $_GET['roomTypeId'] );
		$roomType	 = MPHB()->getRoomTypeRepository()->findById( $roomTypeId );

		if ( !$roomType ) {
			wp_send_json_error( array(
				'message' => __( 'Room Type is not valid.', 'motopress-hotel-booking' ),
			) );
		}

		$ratesAtts = array(
			'check_in_date'	 => $checkInDate,
			'check_out_date' => $checkOutDate,
		);

		$rates = MPHB()->getRateRepository()->findAllActiveByRoomType( $roomTypeId, $ratesAtts );
		if ( empty( $rates ) ) {
			wp_send_json_error( array(
				'message' => __( 'There are not available rates for current room for requested period.', 'motopress-hotel-booking' ),
			) );
		}

		if ( !$roomType->hasAvailableRoom( $checkInDate, $checkOutDate ) ) {
			wp_send_json_error( array(
				'message'		 => __( 'Room is unavailable for requested dates.', 'motopress-hotel-booking' ),
				'updatedData'	 => array(
					'dates'				 => array(
						'booked'	 => $roomType->getBookingsCountByDay(),
						'havePrice'	 => $roomType->getDatesHavePrice()
					),
					'activeRoomsCount'	 => count( MPHB()->getRoomRepository()->findAllByRoomType( $roomTypeId ) )
				)
			) );
		}

		wp_send_json_success();
	}

	public function recalculate_total(){
		if ( !$this->checkNonce( __FUNCTION__ ) ) {
			wp_send_json_error( array(
				'message' => __( 'Request does not pass security verification. Please refresh the page and try one more time.', 'motopress-hotel-booking' )
			) );
		}

		if ( !( isset( $_GET['formValues'] ) && is_array( $_GET['formValues'] ) ) ) {
			wp_send_json_error( array(
				'message' => __( 'An error has occurred, please try again later.', 'motopress-hotel-booking' ),
			) );
		}

		$atts = MPHB()->postTypes()->booking()->getEditPage()->getAttsFromRequest( $_GET['formValues'] );

		// Check Required Fields
		if ( !isset( $atts['mphb_room_id'] ) || empty( $atts['mphb_room_id'] ) ||
			!isset( $atts['mphb_room_rate_id'] ) || $atts['mphb_room_rate_id'] === '' ||
			!isset( $atts['mphb_check_in_date'] ) || empty( $atts['mphb_check_in_date'] ) ||
			!isset( $atts['mphb_check_out_date'] ) || empty( $atts['mphb_check_out_date'] )
		) {
			wp_send_json_error( array(
				'message' => __( 'Please complete all required fields and try again.', 'motopress-hotel-booking' )
			) );
		}

		$room = MPHB()->getRoomRepository()->findById( $atts['mphb_room_id'] );
		if ( !$room ) {
			wp_send_json_error( array(
				'message' => __( 'Room is not valid.', 'motopress-hotel-booking' )
			) );
		}

		$atts['mphb_room_type_id'] = $room->getRoomTypeId();

		$roomType = MPHB()->getRoomTypeRepository()->findById( $atts['mphb_room_type_id'] );
		if ( !$roomType ) {
			wp_send_json_error( array(
				'message' => __( 'Room Type is not valid.', 'motopress-hotel-booking' )
			) );
		}
		$roomRate = MPHB()->getRateRepository()->findById( $atts['mphb_room_rate_id'] );

		if ( !$roomRate ) {
			wp_send_json_error( array(
				'message' => __( 'Rate is not valid.', 'motopress-hotel-booking' )
			) );
		}

		$adults			 = absint( $atts['mphb_adults'] );
		$children		 = absint( $atts['mphb_children'] );
		$checkInDate	 = \DateTime::createFromFormat( 'Y-m-d', $atts['mphb_check_in_date'] );
		$checkOutDate	 = \DateTime::createFromFormat( 'Y-m-d', $atts['mphb_check_out_date'] );

		$services = array();
		if ( isset( $atts['mphb_services'] ) && is_array( $atts['mphb_services'] ) ) {
			foreach ( $atts['mphb_services'] as $serviceDetails ) {
				$service	 = MPHB()->getServiceRepository()->findById( $serviceDetails['id'] );
				$service->setAdults( $serviceDetails['count'] );
				$services[]	 = $service;
			}
		}

		$bookingAtts = array(
			'room'			 => $room,
			'room_rate'		 => $roomRate,
			'adults'		 => $adults,
			'children'		 => $children,
			'check_in_date'	 => $checkInDate,
			'check_out_date' => $checkOutDate,
			'services'		 => $services
		);

		$booking = Entities\Booking::create( $bookingAtts );

		wp_send_json_success( array(
			'total' => $booking->calcPrice()
		) );
	}

	public function recalculate_checkout_prices(){
		if ( !$this->checkNonce( __FUNCTION__ ) ) {
			wp_send_json_error( array(
				'message' => __( 'Request does not pass security verification. Please refresh the page and try one more time.', 'motopress-hotel-booking' )
			) );
		}

		if ( !(
			isset( $_GET['formValues'] ) && is_array( $_GET['formValues'] ) && isset( $_GET['formValues']['mphb_room_type_id'] ) && $_GET['formValues']['mphb_room_type_id'] !== '' && isset( $_GET['formValues']['mphb_room_rate_id'] ) && $_GET['formValues']['mphb_room_rate_id'] !== '' && isset( $_GET['formValues']['mphb_check_in_date'] ) && $_GET['formValues']['mphb_check_in_date'] !== '' && isset( $_GET['formValues']['mphb_check_out_date'] ) && $_GET['formValues']['mphb_check_out_date'] !== ''
			) ) {
			wp_send_json_error( array(
				'message' => __( 'An error has occurred while recalculating the price, please try again later.', 'motopress-hotel-booking' ),
			) );
		}

		$atts = MPHB()->postTypes()->booking()->getEditPage()->getAttsFromRequest( $_GET['formValues'] );

		$atts['mphb_room_type_id']	 = absint( $_GET['formValues']['mphb_room_type_id'] );
		$atts['mphb_room_rate_id']	 = absint( $atts['mphb_room_rate_id'] );

		$services = array();
		if ( isset( $atts['mphb_services'] ) ) {
			foreach ( $atts['mphb_services'] as $key => $serviceDetails ) {
				if ( !isset( $serviceDetails['id'] ) || empty( $serviceDetails['id'] ) ) {
					unset( $atts['mphb_services'][$key] );
				} else {
					$service	 = MPHB()->getServiceRepository()->findById( $serviceDetails['id'] );
					$service->setAdults( absint( $serviceDetails['count'] ) );
					$services[]	 = $service;
				}
			}
		}

		$roomType		 = MPHB()->getRoomTypeRepository()->findById( $atts['mphb_room_type_id'] );
		$roomRate		 = MPHB()->getRateRepository()->findById( absint( $atts['mphb_room_rate_id'] ) );
		$checkInDate	 = \DateTime::createFromFormat( 'Y-m-d', $atts['mphb_check_in_date'] );
		$checkOutDate	 = \DateTime::createFromFormat( 'Y-m-d', $atts['mphb_check_out_date'] );
		$adults			 = absint( $atts['mphb_adults'] );
		$children		 = absint( $atts['mphb_children'] );

		$bookingAtts = array(
			'room_rate'		 => $roomRate,
			'adults'		 => $adults,
			'children'		 => $children,
			'check_in_date'	 => $checkInDate,
			'check_out_date' => $checkOutDate,
			'services'		 => $services
		);

		$booking = Entities\Booking::create( $bookingAtts );

		wp_send_json_success( array(
			'total'			 => mphb_format_price( $booking->calcPrice() ),
			'priceBreakdown' => Views\BookingView::generatePriceBreakdown( $booking )
		) );
	}

	public function get_rates_for_room(){
		if ( !$this->checkNonce( __FUNCTION__ ) ) {
			wp_send_json_error( array(
				'message' => __( 'Total price recalculation does not pass security verification. Please refresh the page and try one more time.', 'motopress-hotel-booking' )
			) );
		}

		$titlesList = array();

		if (
			isset( $_GET['formValues'] ) &&
			is_array( $_GET['formValues'] ) &&
			isset( $_GET['formValues']['mphb_room_id'] ) &&
			!empty( $_GET['formValues']['mphb_room_id'] )
		) {
			$roomId	 = absint( $_GET['formValues']['mphb_room_id'] );
			$room	 = MPHB()->getRoomRepository()->findById( $roomId );

			if ( !$room ) {
				wp_send_json_success( array(
					'options' => array()
				) );
			}

			foreach ( MPHB()->getRateRepository()->findAllActiveByRoomType( $room->getRoomTypeId() ) as $rate ) {
				$titlesList[$rate->getId()] = $rate->getTitle();
			}
		}

		wp_send_json_success( array(
			'options' => $titlesList
		) );
	}

	public function dismiss_license_notice(){
		if ( !$this->checkNonce( __FUNCTION__ ) ) {
			wp_send_json_error( array(
				'message' => __( 'Request does not pass security verification. Please refresh the page and try one more time.', 'motopress-hotel-booking' )
			) );
		}

		MPHB()->settings()->license()->setNeedHideNotice( true );

		wp_send_json_success();
	}

}
