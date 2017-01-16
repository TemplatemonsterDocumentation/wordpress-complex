<?php

namespace MPHB\ScriptManagers;

class PublicScriptManager {

	private $roomTypeIds = array();

	public function enqueue(){

		if ( !wp_script_is( 'mphb' ) ) {
			add_action( 'wp_print_footer_scripts', array( $this, 'localize' ), 5 );
		}

		wp_enqueue_script( 'mphb' );

		// Styles
		wp_enqueue_style( 'mphb-kbwood-datepick-css' );
		wp_enqueue_style( 'mphb' );
	}

	public function addRoomTypeData( $roomTypeId ){
		if ( !in_array( $roomTypeId, $this->roomTypeIds ) ) {
			$this->roomTypeIds[] = $roomTypeId;
		}
	}

	public function localize(){
		wp_localize_script( 'mphb', 'MPHB', $this->getLocalizeData() );
	}

	public function getLocalizeData(){
		$data = array(
			'_data' => array(
				'settings'			 => array(
					'firstDay'					 => MPHB()->settings()->dateTime()->getFirstDay(),
					'numberOfMonthCalendar'		 => 2,
					'numberOfMonthDatepicker'	 => 2,
				),
				'today'				 => mphb_current_time( MPHB()->settings()->dateTime()->getDateFormat() ),
				'ajaxUrl'			 => MPHB()->getAjaxUrl(),
				'nonces'			 => MPHB()->getAjax()->getFrontNonces(),
				'room_types_data'	 => array(),
				'translations'		 => array(
					'errorHasOccured'		 => __( 'An error has occurred, please try again later.', 'motopress-hotel-booking' ),
					'booked'				 => __( 'Booked', 'motopress-hotel-booking' ),
					'pending'				 => __( 'Pending', 'motopress-hotel-booking' ),
					'available'				 => __( 'Available', 'motopress-hotel-booking' ),
					'notAvailable'			 => __( 'Not available', 'motopress-hotel-booking' ),
					'notStayIn'				 => __( 'Not stay-in', 'motopress-hotel-booking' ),
					'notCheckIn'			 => __( 'Not check-in', 'motopress-hotel-booking' ),
					'notCheckOut'			 => __( 'Not check-out', 'motopress-hotel-booking' ),
					'past'					 => __( 'Day in the past', 'motopress-hotel-booking' ),
					'checkInDate'			 => __( 'Check-in date', 'motopress-hotel-booking' ),
					'lessThanMinDaysStay'	 => sprintf( __( 'Less than min days (%s) stay', 'motopress-hotel-booking' ), MPHB()->settings()->bookingRules()->getGlobalMinDays() ),
					'moreThanMaxDaysStay'	 => sprintf( __( 'More than max days (%s) stay', 'motopress-hotel-booking' ), MPHB()->settings()->bookingRules()->getGlobalMaxDays() ),
					// for dates between "not stay-in" (rules, existsing bookings) date and "max days stay" date
					'laterThanMaxDate'		 => __( 'Later than max date for current check-in date', 'motopress-hotel-booking' ),
					'rules'					 => __( 'Rules:', 'motopress-hotel-booking' )
				),
				'page'				 => array(
					'isCheckoutPage'		 => mphb_is_checkout_page(),
					'isSingleRoomTypePage'	 => mphb_is_single_room_type_page(),
					'isSearchResultsPage'	 => mphb_is_search_results_page()
				),
				'rules'				 => MPHB()->getRulesChecker()->getData()
			)
		);

		if ( mphb_is_single_room_type_page() ) {
			$this->addRoomTypeData( get_the_ID() );
		}

		$roomTypesAtts = array(
			'post__in' => $this->roomTypeIds
		);

		$roomTypes = MPHB()->getRoomTypeRepository()->findAll( $roomTypesAtts );

		foreach ( $roomTypes as $roomType ) {
			$data['_data']['room_types_data'][$roomType->getId()] = array(
				'dates'				 => array(
					'booked'	 => $roomType->getBookingsCountByDay(),
					'havePrice'	 => $roomType->getDatesHavePrice()
				),
				'activeRoomsCount'	 => MPHB()->getRoomPersistence()->getCount(
					array(
						'room_type'		 => $roomType->getId(),
						'post_status'	 => 'publish'
					)
				)
			);
		}

		return $data;
	}

}
