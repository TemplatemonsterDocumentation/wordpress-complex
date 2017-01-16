<?php

namespace MPHB\PostTypes\BookingCPT;

class Statuses {

	const STATUS_CONFIRMED	 = 'confirmed';
	const STATUS_PENDING		 = 'pending';
	const STATUS_PENDING_USER	 = 'pending-user';
	const STATUS_CANCELLED	 = 'cancelled';
	const STATUS_ABANDONED	 = 'abandoned';
	const STATUS_AUTO_DRAFT	 = 'auto-draft';

	protected $postType;
	private $statuses = array();

	public function __construct( $postType ){
		$this->postType = $postType;
		$this->initStatuses();
		add_action( 'init', array( $this, 'registerStatuses' ), 5 );
		add_action( 'transition_post_status', array( $this, 'transitionBookingStatus' ), 10, 3 );
	}

	private function initStatuses(){

		$this->statuses[self::STATUS_PENDING_USER] = array(
			'args'		 => array(
				'label'						 => _x( 'Pending User Confirmation', 'Booking status', 'motopress-hotel-booking' ),
				'public'					 => true,
				'exclude_from_search'		 => false,
				'show_in_admin_all_list'	 => true,
				'show_in_admin_status_list'	 => true,
				'label_count'				 => _n_noop( 'Pending User Confirmation <span class="count">(%s)</span>', 'Pending User Confirmation <span class="count">(%s)</span>', 'motopress-hotel-booking' )
			),
			'lock_room'	 => true
		);

		$this->statuses[self::STATUS_PENDING] = array(
			'args'		 => array(
				'label'						 => _x( 'Pending Admin', 'Booking status', 'motopress-hotel-booking' ),
				'public'					 => true,
				'exclude_from_search'		 => false,
				'show_in_admin_all_list'	 => true,
				'show_in_admin_status_list'	 => true,
				'label_count'				 => _n_noop( 'Pending Admin <span class="count">(%s)</span>', 'Pending Admin <span class="count">(%s)</span>', 'motopress-hotel-booking' )
			),
			'lock_room'	 => true
		);

		$this->statuses[self::STATUS_ABANDONED] = array(
			'args'		 => array(
				'label'						 => _x( 'Abandoned', 'Booking status', 'motopress-hotel-booking' ),
				'public'					 => true,
				'exclude_from_search'		 => false,
				'show_in_admin_all_list'	 => true,
				'show_in_admin_status_list'	 => true,
				'label_count'				 => _n_noop( 'Abandoned <span class="count">(%s)</span>', 'Abandoned <span class="count">(%s)</span>', 'motopress-hotel-booking' )
			),
			'lock_room'	 => false
		);

		$this->statuses[self::STATUS_CONFIRMED] = array(
			'args'		 => array(
				'label'						 => _x( 'Confirmed', 'Booking status', 'motopress-hotel-booking' ),
				'public'					 => true,
				'exclude_from_search'		 => false,
				'show_in_admin_all_list'	 => true,
				'show_in_admin_status_list'	 => true,
				'label_count'				 => _n_noop( 'Confirmed <span class="count">(%s)</span>', 'Confirmed <span class="count">(%s)</span>', 'motopress-hotel-booking' )
			),
			'lock_room'	 => true
		);

		$this->statuses[self::STATUS_CANCELLED] = array(
			'args'		 => array(
				'label'						 => _x( 'Cancelled', 'Booking status', 'motopress-hotel-booking' ),
				'public'					 => true,
				'exclude_from_search'		 => false,
				'show_in_admin_all_list'	 => true,
				'show_in_admin_status_list'	 => true,
				'label_count'				 => _n_noop( 'Cancelled <span class="count">(%s)</span>', 'Cancelled <span class="count">(%s)</span>', 'motopress-hotel-booking' )
			),
			'lock_room'	 => false
		);
	}

	public function transitionBookingStatus( $newStatus, $oldStatus, $post ){
		if ( $post->post_type === $this->postType && $newStatus !== $oldStatus ) {

			// Prevent logging status change while importing
			if ( MPHB()->getImporter()->isImportProcess() ) {
				return;
			}

			$booking = MPHB()->getBookingRepository()->findById( $post->ID );

			if ( $oldStatus == 'new' ) {
				$key = $booking->generateKey();
			}

			if ( $newStatus === self::STATUS_PENDING_USER ) {

				$booking->updateExpiration( $post->ID );

				MPHB()->getBookingAbandonCron()->shedule();
			}

			if ( $oldStatus === self::STATUS_PENDING_USER ) {
				$booking->deleteExpiration();
			}

			$booking->addLog( sprintf( __( 'Status changed from %s to %s.', 'motopress-hotel-booking' ), mphb_get_status_label( $oldStatus ), mphb_get_status_label( $newStatus ) ) );

			do_action( 'mphb_booking_status_changed', $booking, $oldStatus );
		}
	}

	/**
	 *
	 * @return array
	 */
	public function getStatuses(){
		return $this->statuses;
	}

	public function registerStatuses(){
		foreach ( $this->statuses as $statusName => $details ) {
			register_post_status( $statusName, $details['args'] );
		}
	}

	/**
	 *
	 * @return array
	 */
	public function getLockedRoomStatuses(){
		return array_keys( array_filter( $this->statuses, function( $status ) {
				return isset( $status['lock_room'] ) && $status['lock_room'];
			} ) );
	}

	/**
	 *
	 * @return array
	 */
	public function getBookedRoomStatuses(){
		return (array) self::STATUS_CONFIRMED;
	}

	/**
	 *
	 * @return array
	 */
	public function getPendingRoomStatuses(){
		return array(
			self::STATUS_PENDING,
			self::STATUS_PENDING_USER
		);
	}

	/**
	 *
	 * @return array
	 */
	public function getAvailableRoomStatuses(){
		return array_merge( 'trash', array_diff( array_keys( $this->statuses ), $this->getLockedRoomStatuses() ) );
	}

	/**
	 *
	 * @return string
	 */
	public function getDefaultNewBookingStatus(){
		return MPHB()->settings()->main()->isAutoConfirmationMode() ? self::STATUS_PENDING_USER : self::STATUS_PENDING;
	}

}
