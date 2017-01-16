<?php

namespace MPHB\Emails;

use \MPHB\PostTypes\BookingCPT;

class Emails {

	/**
	 *
	 * @var Mailer
	 */
	private $mailer;

	/**
	 *
	 * @var CustomerEmail
	 */
	private $customerPendingBooking;

	/**
	 *
	 * @var AdminEmail
	 */
	private $adminPendingBooking;

	/**
	 *
	 * @var CustomerEmail
	 */
	private $customerApprovedBooking;

	/**
	 *
	 * @var AdminEmail
	 */
	private $adminCustomerConfirmedBooking;

	/**
	 *
	 * @var CustomerEmail
	 */
	private $customerCancelledBooking;

	/**
	 *
	 * @var AdminEmail
	 */
	private $adminCustomerCancelledBooking;

	/**
	 *
	 * @var CustomerEmail
	 */
	private $customerConfirmationBooking;

	public function __construct(){

		$this->mailer = new Mailer();

		$this->initEmails();

		$this->addActions();
	}

	private function initEmails(){
		$templater = new EmailTemplater(
			array( 'booking' => true )
		);

		$this->adminPendingBooking = new AdminEmail( array(
			'id'					 => 'admin_pending_booking',
			'label'					 => __( 'Pending Booking Email', 'motopress-hotel-booking' ),
			'description'			 => __( 'Email that will be sent to administrator after booking is placed.', 'motopress-hotel-booking' ),
			'default_subject'		 => __( '%site_title% - New booking #%booking_id%', 'motopress-hotel-booking' ),
			'default_header_text'	 => __( 'Confirm new booking', 'motopress-hotel-booking' )
			), $templater
		);

		$templater = new EmailTemplater(
			array(
			'booking'			 => true,
			'user_cancellation'	 => true
			)
		);

		$this->customerPendingBooking = new CustomerEmail( array(
			'id'					 => 'customer_pending_booking',
			'label'					 => __( 'New Booking Email (Confirmation by Admin)', 'motopress-hotel-booking' ),
			'description'			 => __( 'Email that will be sent to customer after booking is placed. <strong>This email is sent when "Booking Confirmation Mode" is set to Admin confirmation.</strong>', 'motopress-hotel-booking' ),
			'default_subject'		 => __( '%site_title% - Booking #%booking_id% is placed', 'motopress-hotel-booking' ),
			'default_header_text'	 => __( 'Your booking is placed', 'motopress-hotel-booking' )
			), $templater
		);

		$templater = new EmailTemplater(
			array(
			'booking'			 => true,
			'user_confirmation'	 => true,
			'user_cancellation'	 => true
			)
		);

		$this->customerConfirmationBooking = new CustomerEmail( array(
			'id'					 => 'customer_confirmation_booking',
			'label'					 => __( 'New Booking Email (Confirmation by User)', 'motopress-hotel-booking' ),
			'description'			 => __( 'Email that will be sent to customer after booking is place. <strong>This email is sent when "Booking Confirmation Mode" is set to User confirmation.</strong>', 'motopress-hotel-booking' ),
			'default_subject'		 => __( '%site_title% - Confirm your booking #%booking_id%', 'motopress-hotel-booking' ),
			'default_header_text'	 => __( 'Confirm your booking', 'motopress-hotel-booking' )
			), $templater
		);

		$templater = new EmailTemplater(
			array(
			'booking'			 => true,
			'user_cancellation'	 => true
			)
		);

		$this->customerApprovedBooking = new CustomerEmail( array(
			'id'					 => 'customer_approved_booking',
			'label'					 => __( 'Approved Booking Email', 'motopress-hotel-booking' ),
			'description'			 => __( 'Email that will be sent to customer when booking is approved.', 'motopress-hotel-booking' ),
			'default_subject'		 => __( '%site_title% - Your booking #%booking_id% is approved', 'motopress-hotel-booking' ),
			'default_header_text'	 => __( 'Your booking is approved', 'motopress-hotel-booking' ),
			), $templater
		);

		$templater = new EmailTemplater(
			array(
			'booking'			 => true,
			'user_cancellation'	 => true
			)
		);

		$this->adminCustomerConfirmedBooking = new AdminEmail( array(
			'id'					 => 'admin_customer_confirmed_booking',
			'label'					 => __( 'Approved Booking Email', 'motopress-hotel-booking' ),
			'description'			 => __( 'Email that will be sent to Admin when customer confirms booking.', 'motopress-hotel-booking' ),
			'default_subject'		 => __( '%site_title% - Booking #%booking_id% Confirmed', 'motopress-hotel-booking' ),
			'default_header_text'	 => __( 'Booking Confirmed', 'motopress-hotel-booking' ),
			), $templater
		);

		$templater = new EmailTemplater(
			array( 'booking' => true )
		);

		$this->customerCancelledBooking = new CustomerEmail( array(
			'id'					 => 'customer_cancelled_booking',
			'label'					 => __( 'Cancelled Booking Email', 'motopress-hotel-booking' ),
			'description'			 => __( 'Email that will be sent to customer when booking is cancelled.', 'motopress-hotel-booking' ),
			'default_subject'		 => __( '%site_title% - Your booking #%booking_id% is cancelled', 'motopress-hotel-booking' ),
			'default_header_text'	 => __( 'Your booking is cancelled', 'motopress-hotel-booking' )
			), $templater
		);

		$templater = new EmailTemplater(
			array( 'booking' => true )
		);

		$this->adminCustomerCancelledBooking = new AdminEmail( array(
			'id'					 => 'admin_customer_cancelled_booking',
			'label'					 => __( 'Cancelled Booking Email', 'motopress-hotel-booking' ),
			'description'			 => __( 'Email that will be sent to Admin when customer cancels booking.', 'motopress-hotel-booking' ),
			'default_subject'		 => __( '%site_title% - Booking #%booking_id% Cancelled', 'motopress-hotel-booking' ),
			'default_header_text'	 => __( 'Booking Cancelled', 'motopress-hotel-booking' )
			), $templater
		);
	}

	private function addActions(){
		add_action( 'mphb_booking_status_changed', array( $this, 'sendBookingMails' ), 10, 2 );

		add_action( 'mphb_customer_confirmed_booking', array( $this->adminCustomerConfirmedBooking, 'trigger' ) );

		add_action( 'mphb_customer_cancelled_booking', array( $this->adminCustomerCancelledBooking, 'trigger' ) );
	}

	/**
	 *
	 * @param \MPHB\Entities\Booking $booking
	 */
	public function sendBookingMails( $booking, $oldStatus ){
		switch ( $booking->getStatus() ) {
			case BookingCPT\Statuses::STATUS_PENDING:
				$this->adminPendingBooking->trigger( $booking );
				$this->customerPendingBooking->trigger( $booking );
				break;
			case BookingCPT\Statuses::STATUS_PENDING_USER:
				$this->customerConfirmationBooking->trigger( $booking );
				break;
			case BookingCPT\Statuses::STATUS_CONFIRMED:
				$this->customerApprovedBooking->trigger( $booking );
				break;
			case BookingCPT\Statuses::STATUS_CANCELLED:
				$this->customerCancelledBooking->trigger( $booking );
				break;
		}
	}

	/**
	 *
	 * @return CustomerEmail
	 */
	public function getCustomerPendingBooking(){
		return $this->customerPendingBooking;
	}

	/**
	 *
	 * @return AdminEmail
	 */
	public function getAdminPendingBooking(){
		return $this->adminPendingBooking;
	}

	/**
	 *
	 * @return CustomerEmail
	 */
	public function getCustomerApprovedBooking(){
		return $this->customerApprovedBooking;
	}

	/**
	 *
	 * @return CustomerEmail
	 */
	public function getCustomerCancelledBooking(){
		return $this->customerCancelledBooking;
	}

	/**
	 *
	 * @return CustomerEmail
	 */
	public function getCustomerConfirmationBooking(){
		return $this->customerConfirmationBooking;
	}

	/**
	 *
	 * @return AdminEmail
	 */
	public function getAdminCustomerCancelledBooking(){
		return $this->adminCustomerCancelledBooking;
	}

	/**
	 *
	 * @return AdminEmail
	 */
	public function getAdminCustomerConfirmedBoooking(){
		return $this->adminCustomerConfirmedBooking;
	}

	public function getMailer(){
		return $this->mailer;
	}

}
