<?php

namespace MPHB\Entities;

class Booking {

	/**
	 *
	 * @var int
	 */
	private $id;

	/**
	 *
	 * @var Room
	 */
	private $room;

	/**
	 *
	 * @var Rate
	 */
	private $roomRate;

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
	 * @var int
	 */
	private $adults = 1;

	/**
	 *
	 * @var int
	 */
	private $children = 0;

	/**
	 *
	 * @var Customer
	 */
	private $customer;

	/**
	 *
	 * @var Service[]
	 */
	private $services = array();

	/**
	 *
	 * @var string
	 */
	private $note;

	/**
	 *
	 * @var float
	 */
	private $totalPrice = 0.0;

	/**
	 *
	 * @var string
	 */
	private $status;

	/**
	 *
	 * @var string
	 */
	private $paymentStatus;

	/**
	 *
	 * @param array $parameters
	 */
	public function __construct( $parameters ){
		$this->setupParameters( $parameters );
	}

	public static function create( $parameters ){
		return new self( $parameters );
	}

	/**
	 *
	 * @param array	$parameters
	 * @param int $parameters['id']
	 * @param Room $parameters['room']
	 * @param RoomRate $parameters['room_rate']
	 * @param int $parameters['adults']
	 * @param int $parameters['children']
	 * @param \DateTime $parameters['check_in_date']
	 * @param \DateTime $parameters['check_out_date']
	 * @param Service[] $parameters['services']
	 * @param Customer $parameters['customer']
	 * @param float $parameters['total_price']
	 * @param string $parameters['note']
	 *
	 */
	protected function setupParameters( $parameters = array() ){

		if ( isset( $parameters['id'] ) ) {
			$this->id = $parameters['id'];
		}

		if ( isset( $parameters['room'] ) && is_a( $parameters['room'], 'MPHB\Entities\Room' ) ) {
			$this->room = $parameters['room'];
		}

		if ( isset( $parameters['room_rate'] ) && is_a( $parameters['room_rate'], 'MPHB\Entities\Rate' ) ) {
			$this->roomRate = $parameters['room_rate'];
		}

		if ( isset( $parameters['check_in_date'] ) && isset( $parameters['check_out_date'] ) && is_a( $parameters['check_in_date'], '\DateTime' ) && is_a( $parameters['check_out_date'], '\DateTime' ) ) {
			$this->setDates( $parameters['check_in_date'], $parameters['check_out_date'] );
		}

		if ( isset( $parameters['adults'] ) ) {
			$children = isset( $parameters['children'] ) ? $parameters['children'] : 0;
			$this->setGuests( $parameters['adults'], $children );
		}

		if ( isset( $parameters['services'] ) && !empty( $parameters['services'] ) ) {
			$this->services = $parameters['services'];
		}

		if ( isset( $parameters['customer'] ) ) {
			$this->customer = $parameters['customer'];
		}

		$this->paymentStatus = isset( $parameters['payment_status'] ) ? $parameters['payment_status'] : \MPHB\PostTypes\BookingCPT\PaymentStatuses::PAYMENT_STATUS_UNPAID;

		$this->status = isset( $parameters['status'] ) ? $parameters['status'] : \MPHB\PostTypes\BookingCPT\Statuses::STATUS_AUTO_DRAFT;

		if ( isset( $parameters['note'] ) ) {
			$this->note = $parameters['note'];
		}

		if ( isset( $parameters['total_price'] ) ) {
			$this->totalPrice = $parameters['total_price'];
		} else {
			$this->updateTotal();
		}
	}

	/**
	 *
	 * @param \DateTime $checkInDate
	 * @param \DateTime $checkOutDate
	 */
	public function setDates( \DateTime $checkInDate, \DateTime $checkOutDate ){
		$this->checkInDate	 = $checkInDate;
		$this->checkOutDate	 = $checkOutDate;
	}

	/**
	 *
	 * @param int $adults
	 * @param int $children Optional. Default 0.
	 */
	public function setGuests( $adults, $children = 0 ){
		$this->adults	 = $adults;
		$this->children	 = $children;
	}

	/**
	 *
	 * @param string $paymentStatus
	 */
	public function setPaymentStatus( $paymentStatus ){
		$this->paymentStatus = $paymentStatus;
	}

	/**
	 *
	 * @param string $status
	 */
	public function setStatus( $status ){
		$this->status = $status;
	}

	public function generateKey(){
		$key = uniqid( "booking_{$this->id}_", true );
		update_post_meta( $this->id, 'mphb_key', $key );
		return $key;
	}

	public function updateTotal(){
		$this->totalPrice = $this->calcPrice();
	}

	/**
	 * Verifies that all required fields are set and correct
	 *
	 * @return bool
	 */
	public function isValid(){
		$errors = $this->getErrors()->get_error_codes();
		return empty( $errors );
	}

	/**
	 *
	 * @return WP_Error
	 */
	public function getErrors(){
		$errors = new \WP_Error();

		if ( empty( $this->room ) ) {
			$errors->add( 'room_not_set', __( 'Room is not set.', 'motopress-hotel-booking' ) );
		}

		if ( empty( $this->roomRate ) ) {
			$errors->add( 'room_rate_not_set', __( 'Room Rate is not set.', 'motopress-hotel-booking' ) );
		}

		if ( empty( $this->checkInDate ) || empty( $this->checkOutDate ) ) {
			$errors->add( 'dates_not_set', __( 'Dates are not set.', 'motopress-hotel-booking' ) );
		} else if ( \MPHB\Utils\DateUtils::calcNights( $this->checkInDate, $this->checkOutDate ) < 1 ) {
			$errors->add( 'less_than_min_nights', __( 'Nights count is less than minimum.', 'motopress-hotel-booking' ) );
		}

		if ( empty( $this->customer ) ) {
			$errors->add( 'customer_not_set', __( 'Customer is not set.', 'motopress-hotel-booking' ) );
		} else if ( !$this->customer->isValid() ) {
			$errors->add( 'customer_not_valid', $this->customer->getErrors()->get_error_messages() );
		}

		if ( empty( $this->paymentStatus ) ) {
			$errors->add( 'payment_status_not_set', __( 'Payment status is not set.', 'motopress-hotel-booking' ) );
		}

		if ( empty( $this->status ) ) {
			$errors->add( 'status_not_set', __( 'Status is not set.', 'motopress-hotel-booking' ) );
		}

		return $errors;
	}

	/**
	 *
	 * @return array
	 */
	public function getPriceBreakdown(){

		$roomPriceBreakdown	 = $this->roomRate->getPriceBreakdown( $this->checkInDate, $this->checkOutDate );
		$roomTotal			 = $this->roomRate->calcPrice( $this->checkInDate, $this->checkOutDate );

		$servicesBreakdown = array(
			'list'	 => array(),
			'total'	 => 0.0
		);
		foreach ( $this->services as $service ) {
			$serviceTotal = $service->calcPrice( $this->checkInDate, $this->checkOutDate );

			$servicesBreakdown['list'][] = array(
				'title'		 => $service->getTitle(),
				'details'	 => $service->generatePriceDetailsString( $this->checkInDate, $this->checkOutDate ),
				'total'		 => $serviceTotal,
			);
			$servicesBreakdown['total'] += $serviceTotal;
		}

		return array(
			'room'		 => array(
				'title'	 => $this->roomRate->getTitle(),
				'list'	 => $roomPriceBreakdown,
				'total'	 => $roomTotal
			),
			'services'	 => $servicesBreakdown,
			'total'		 => $this->calcPrice()
		);
	}

	/**
	 *
	 * @return float
	 */
	public function calcPrice(){

		$price = 0.0;

		if ( is_null( $this->checkInDate ) || is_null( $this->checkOutDate ) ) {
			return $price;
		}

		if ( !is_null( $this->roomRate ) ) {
			$price += $this->roomRate->calcPrice( $this->checkInDate, $this->checkOutDate );
		}

		if ( !is_null( $this->services ) && !empty( $this->services ) ) {
			foreach ( $this->services as $service ) {
				$price += $service->calcPrice( $this->checkInDate, $this->checkOutDate );
			}
		}

		$price = apply_filters( 'mphb_booking_calculate_total_price', $price, $this );

		return $price;
	}

	/**
	 *
	 * @param string $message
	 * @param int $author
	 */
	public function addLog( $message, $author = null ){
		$author = !is_null( $author ) ? $author : ( is_admin() ? get_current_user_id() : 0);

		$commentdata = array(
			'comment_post_ID'		 => $this->getId(),
			'comment_content'		 => $message,
			'user_id'				 => $author,
			'comment_date'			 => mphb_current_time( 'mysql' ),
			'comment_date_gmt'		 => mphb_current_time( 'mysql', get_option( 'gmt_offset' ) ),
			'comment_approved'		 => 1,
			'comment_parent'		 => 0,
			'comment_author'		 => '',
			'comment_author_IP'		 => '',
			'comment_author_url'	 => '',
			'comment_author_email'	 => '',
			'comment_type'			 => 'mphb_booking_log'
		);

		wp_insert_comment( $commentdata );
	}

	public function getRoomLink(){
		return $this->room->getLink();
	}

	public function getLogs(){

		do_action( 'mphb_booking_before_get_logs' );

		$logs = get_comments( array(
			'post_id'	 => $this->getId(),
			'order'		 => 'ASC'
			) );

		do_action( 'mphb_booking_after_get_logs' );

		return $logs;
	}

	public function getEditLink(){
		$link = '';

		$post_type_object = get_post_type_object( MPHB()->postTypes()->booking()->getPostType() );

		if ( $post_type_object && $post_type_object->_edit_link ) {
			$action	 = '&action=edit';
			$link	 = admin_url( sprintf( $post_type_object->_edit_link . $action, $this->id ) );
		}

		return $link;
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
	public function getKey(){
		return get_post_meta( $this->id, 'mphb_key', true );
	}

	/**
	 *
	 * @return Room
	 */
	public function getRoom(){
		return $this->room;
	}

	/**
	 *
	 * @return RoomRate
	 */
	public function getRoomRate(){
		return $this->roomRate;
	}

	/**
	 *
	 * @return \DateTime
	 */
	public function getCheckInDate(){
		return $this->checkInDate;
	}

	/**
	 *
	 * @return \DateTime
	 */
	public function getCheckOutDate(){
		return $this->checkOutDate;
	}

	/**
	 *
	 * @return int
	 */
	public function getAdults(){
		return $this->adults;
	}

	/**
	 *
	 * @return int
	 */
	public function getChildren(){
		return $this->children;
	}

	/**
	 *
	 * @return Customer
	 */
	public function getCustomer(){
		return $this->customer;
	}

	/**
	 *
	 * @return Service[]
	 */
	public function getServices(){
		return $this->services;
	}

	/**
	 *
	 * @return string
	 */
	public function getNote(){
		return $this->note;
	}

	/**
	 *
	 * @return float
	 */
	public function getTotalPrice(){
		return $this->totalPrice;
	}

	/**
	 *
	 * @return string
	 */
	public function getStatus(){
		return $this->status;
	}

	/**
	 *
	 * @return string
	 */
	public function getPaymentStatus(){
		return $this->paymentStatus;
	}

	/**
	 * Retrieve label of payment status.
	 *
	 * @return string
	 */
	public function getPaymentStatusLabel(){
		$statuses = MPHB()->postTypes()->booking()->paymentStatuses()->getList();
		return isset( $statuses[$this->status] ) ? $statuses[$this->status] : '';
	}

	/**
	 *
	 * @return array of dates where key is date in 'Y-m-d' format and value is date in frontend date format
	 */
	public function getDates( $fromToday = false ){

		$fromDate	 = $this->checkInDate->format( 'Y-m-d' );
		$toDate		 = $this->checkOutDate->format( 'Y-m-d' );

		if ( $fromToday ) {
			$today		 = mphb_current_time( 'Y-m-d' );
			$fromDate	 = $fromDate >= $today ? $fromDate : $today;
		}
		return \MPHB\Utils\DateUtils::createDateRangeArray( $fromDate, $toDate );
	}

	/**
	 * Set expiration time of pending user confirmation for booking
	 *
	 */
	public function updateExpiration(){
		$expirationTime = current_time( 'timestamp', true ) + MPHB()->settings()->main()->getUserApprovalTime();
		update_post_meta( $this->id, 'mphb_pending_user_expired', $expirationTime );
	}

	/**
	 * Retrieve expiration time of pending user confirmation for booking in UTC
	 *
	 * @return int
	 */
	public function retrieveExpiration(){
		return intval( get_post_meta( $this->id, 'mphb_pending_user_expired', true ) );
	}

	/**
	 * Delete expiration time of pending user confirmation for booking
	 *
	 */
	public function deleteExpiration(){
		delete_post_meta( $this->id, 'mphb_pending_user_expired' );
	}

}
