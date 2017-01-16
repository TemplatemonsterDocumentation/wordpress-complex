<?php

namespace MPHB\Emails;

use \MPHB\Views;

class EmailTemplater {

	private $tags = array();

	/**
	 *
	 * @var \MPHB\Entities\Booking
	 */
	private $booking;

	/**
	 *
	 * @param array $tagGroups
	 * @param bool $tagGroups['global'] Global site tags. Default TRUE.
	 * @param bool $tagGroups['booking'] Booking tags. Default FALSE.
	 * @param bool $tagGroups['user_confirmation'] User confirmation tags. Default FALSE.
	 */
	public function __construct( $tagGroups = array() ){

		$defaultTagGroups = array(
			'global'			 => true,
			'booking'			 => false,
			'user_confirmation'	 => false,
			'user_cancellation'	 => false
		);

		$tagGroups = array_merge( $defaultTagGroups, $tagGroups );

		$this->setupTags( $tagGroups );
	}

	/**
	 *
	 * @param array $tagGroups
	 */
	private function setupTags( $tagGroups = array() ){

		$tags = array();

		if ( $tagGroups['global'] ) {
			$this->_fillGlobalTags( $tags );
		}

		if ( $tagGroups['booking'] ) {
			$this->_fillBookingTags( $tags );
		}

		if ( $tagGroups['user_confirmation'] ) {
			$this->_fillUserConfirmationTags( $tags );
		}

		if ( $tagGroups['user_cancellation'] && MPHB()->settings()->main()->canUserCancelBooking() ) {
			$this->_fillUserCancellationTags( $tags );
		}

		$tags = apply_filters( 'mphb_email_tags', $tags );

		foreach ( $tags as $tag ) {
			$this->addTag( $tag['name'], $tag['description'] );
		}
	}

	private function _fillGlobalTags( &$tags ){
		$globalTags = array(
			array(
				'name'			 => 'site_title',
				'description'	 => __( 'Site title (set in Settings > General)', 'motopress-hotel-booking' ),
			)
		);

		$tags = array_merge( $tags, $globalTags );
	}

	private function _fillBookingTags( &$tags ){
		$bookingTags = array(
			// Booking
			array(
				'name'			 => 'booking_id',
				'description'	 => __( 'Booking ID', 'motopress-hotel-booking' ),
			),
			array(
				'name'			 => 'booking_edit_link',
				'description'	 => __( 'Booking Edit Link', 'motopress-hotel-booking' ),
			),
			array(
				'name'			 => 'booking_total_price',
				'description'	 => __( 'Booking Total Price', 'motopress-hotel-booking' ),
			),
			array(
				'name'			 => 'check_in_date',
				'description'	 => __( 'Check-in Date', 'motopress-hotel-booking' ),
			),
			array(
				'name'			 => 'check_out_date',
				'description'	 => __( 'Check-out Date', 'motopress-hotel-booking' ),
			),
			array(
				'name'			 => 'check_in_time',
				'description'	 => __( 'Check-in Time', 'motopress-hotel-booking' ),
			),
			array(
				'name'			 => 'check_out_time',
				'description'	 => __( 'Check-out Time', 'motopress-hotel-booking' ),
			),
			array(
				'name'			 => 'adults',
				'description'	 => __( 'Adults', 'motopress-hotel-booking' ),
			),
			array(
				'name'			 => 'children',
				'description'	 => __( 'Children', 'motopress-hotel-booking' ),
			),
			array(
				'name'			 => 'services',
				'description'	 => __( 'Services', 'motopress-hotel-booking' ),
			),
			// Customer
			array(
				'name'			 => 'customer_first_name',
				'description'	 => __( 'Customer First Name', 'motopress-hotel-booking' ),
			),
			array(
				'name'			 => 'customer_last_name',
				'description'	 => __( 'Customer Last Name', 'motopress-hotel-booking' ),
			),
			array(
				'name'			 => 'customer_email',
				'description'	 => __( 'Customer Email', 'motopress-hotel-booking' ),
			),
			array(
				'name'			 => 'customer_phone',
				'description'	 => __( 'Customer Phone', 'motopress-hotel-booking' ),
			),
			array(
				'name'			 => 'customer_note',
				'description'	 => __( 'Customer Note', 'motopress-hotel-booking' ),
			),
			// Room Type
			array(
				'name'			 => 'room_type_id',
				'description'	 => __( 'Room Type ID', 'motopress-hotel-booking' ),
			),
			array(
				'name'			 => 'room_type_link',
				'description'	 => __( 'Room Type Link', 'motopress-hotel-booking' ),
			),
			array(
				'name'			 => 'room_type_title',
				'description'	 => __( 'Room Type Title', 'motopress-hotel-booking' ),
			),
			array(
				'name'			 => 'room_type_categories',
				'description'	 => __( 'Room Type Categories', 'motopress-hotel-booking' ),
			),
			array(
				'name'			 => 'room_type_bed_type',
				'description'	 => __( 'Room Type Bed', 'motopress-hotel-booking' ),
			),
			array(
				'name'			 => 'room_rate_title',
				'description'	 => __( 'Room Rate Title', 'motopress-hotel-booking' )
			),
			array(
				'name'			 => 'room_rate_description',
				'description'	 => __( 'Room Rate Description', 'motopress-hotel-booking' )
			)
		);

		$tags = array_merge( $tags, $bookingTags );
	}

	private function _fillUserConfirmationTags( &$tags ){
		$userConfirmationTags	 = array(
			array(
				'name'			 => 'user_confirm_link',
				'description'	 => __( 'Confirmation Link', 'motopress-hotel-booking' )
			),
			array(
				'name'			 => 'user_confirm_link_expire',
				'description'	 => __( 'Confirmation Link Expiration Time ( UTC )', 'motopress-hotel-booking' )
			)
		);
		$tags					 = array_merge( $tags, $userConfirmationTags );
	}

	private function _fillUserCancellationTags( &$tags ){
		$userCancellationTags	 = array(
			array(
				'name'			 => 'user_cancel_link',
				'description'	 => __( 'User Cancellation Link', 'motopress-hotel-booking' )
			)
		);
		$tags					 = array_merge( $tags, $userCancellationTags );
	}

	/**
	 *
	 * @param string $name
	 * @param string $description
	 */
	public function addTag( $name, $description ){
		if ( !empty( $name ) ) {
			$this->tags[$name] = array(
				'name'			 => $name,
				'description'	 => $description,
			);
		}
	}

	/**
	 *
	 * @param string $content
	 * @param \MPHB\Entities\Booking $booking
	 * @return string
	 */
	public function replaceTags( $content, $booking ){

		if ( !empty( $this->tags ) ) {
			$this->booking = $booking;

			$content = preg_replace_callback( $this->_generateTagsFindString(), array( $this,
				'replaceTag' ), $content );
		}

		return $content;
	}

	/**
	 *
	 * @return string
	 */
	private function _generateTagsFindString(){

		$tagNames = array();
		foreach ( $this->tags as $tag ) {
			$tagNames[] = $tag['name'];
		}

		$find = '/%' . join( '%|%', $tagNames ) . '%/s';
		return $find;
	}

	/**
	 *
	 * @param array $match
	 * @param string $match[0] Tag
	 *
	 * @return string
	 */
	public function replaceTag( $match ){

		$tag = str_replace( '%', '', $match[0] );

		switch ( $tag ) {

			// Global
			case 'site_title':
				$replaceText = get_bloginfo( 'name' );
				break;
			case 'check_in_time':
				$replaceText = MPHB()->settings()->dateTime()->getCheckInTimeWPFormatted();
				break;
			case 'check_out_time':
				$replaceText = MPHB()->settings()->dateTime()->getCheckOutTimeWPFormatted();
				break;

			// Booking
			case 'booking_id':
				$replaceText = $this->booking->getId();
				break;
			case 'booking_edit_link':
				$replaceText = $this->booking->getEditLink();
				break;
			case 'booking_total_price':
				ob_start();
				Views\BookingView::renderTotalPriceHTML( $this->booking );
				$replaceText = ob_get_clean();
				break;
			case 'check_in_date':
				ob_start();
				Views\BookingView::renderCheckInDateWPFormatted( $this->booking );
				$replaceText = ob_get_clean();
				break;
			case 'check_out_date':
				ob_start();
				Views\BookingView::renderCheckOutDateWPFormatted( $this->booking );
				$replaceText = ob_get_clean();
				break;
			case 'adults':
				$replaceText = $this->booking->getAdults();
				break;
			case 'children':
				$replaceText = $this->booking->getChildren();
				break;
			case 'services':
				ob_start();
				Views\BookingView::renderServicesList( $this->booking );
				$replaceText = ob_get_clean();
				break;

			// Customer
			case 'customer_first_name':
				$replaceText = $this->booking->getCustomer()->getFirstName();
				break;
			case 'customer_last_name':
				$replaceText = $this->booking->getCustomer()->getLastName();
				break;
			case 'customer_email':
				$replaceText = $this->booking->getCustomer()->getEmail();
				break;
			case 'customer_phone';
				$replaceText = $this->booking->getCustomer()->getPhone();
				break;
			case 'customer_note':
				$replaceText = $this->booking->getNote();
				break;
			case 'user_confirm_link':
				$replaceText = MPHB()->userActions()->getBookingConfirmationAction()->generateLink( $this->booking );
				break;
			case 'user_confirm_link_expire':
				$expireTime	 = $this->booking->retrieveExpiration();
				$replaceText = date_i18n( MPHB()->settings()->dateTime()->getDateTimeFormatWP(), $expireTime );
				break;
			case 'user_cancel_link':
				$replaceText = MPHB()->userActions()->getBookingCancellationAction()->generateLink( $this->booking );
				break;

			// Room Type
			case 'room_type_id':
				$roomType	 = MPHB()->getRoomTypeRepository()->findById( $this->booking->getRoom()->getRoomTypeId() );
				$replaceText = ($roomType ) ? $roomType->getId() : '';
				break;
			case 'room_type_link':
				$roomType	 = MPHB()->getRoomTypeRepository()->findById( $this->booking->getRoom()->getRoomTypeId() );
				$replaceText = ($roomType ) ? $roomType->getLink() : '';
				break;
			case 'room_type_title':
				$roomType	 = MPHB()->getRoomTypeRepository()->findById( $this->booking->getRoom()->getRoomTypeId() );
				$replaceText = ($roomType ) ? $roomType->getTitle() : '';
				break;
			case 'room_type_categories':
				$roomType	 = MPHB()->getRoomTypeRepository()->findById( $this->booking->getRoom()->getRoomTypeId() );
				$replaceText = ($roomType ) ? $roomType->getCategories() : '';
				break;
			case 'room_type_bed_type':
				$roomType	 = MPHB()->getRoomTypeRepository()->findById( $this->booking->getRoom()->getRoomTypeId() );
				$replaceText = ($roomType ) ? $roomType->getBedType() : '';
				break;
			case 'room_rate_title':
				$replaceText = $this->booking->getRoomRate()->getTitle();
				break;
			case 'room_rate_description':
				$replaceText = $this->booking->getRoomRate()->getDescription();
				break;
			default:
				$replaceText = '';
				break;
		}

		$replaceText = apply_filters( 'mphb_email_replace_tag', $replaceText, $tag );

		return $replaceText;
	}

	/**
	 *
	 * @return string
	 */
	public function getTagsDescription(){
		$description = __( 'Possible tags:', 'motopress-hotel-booking' );
		$description .= '<br/>';
		if ( !empty( $this->tags ) ) {
			foreach ( $this->tags as $tagDetails ) {
				$description .= sprintf( '<em>%%%s%%</em> - %s<br/>', $tagDetails['name'], $tagDetails['description'] );
			}
		} else {
			$description .= '<em>' . __( 'none', 'motopress-hotel-booking' ) . '</em>';
		}

		return $description;
	}

}
