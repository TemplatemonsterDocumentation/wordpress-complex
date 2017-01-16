<?php

namespace MPHB\PostTypes\BookingCPT;

class PaymentStatuses {

	protected $postType;

	public function __construct( $postType ){
		$this->postType = $postType;
	}

	// Payment Statuses
	const PAYMENT_STATUS_PAID		 = 'paid';
	const PAYMENT_STATUS_UNPAID	 = 'unpaid';


	/**
	 *
	 * @return array
	 */
	public function getList(){
		return array(
			self::PAYMENT_STATUS_UNPAID	 => __( 'Unpaid', 'motopress-hotel-booking' ),
			self::PAYMENT_STATUS_PAID	 => __( 'Paid', 'motopress-hotel-booking' )
		);
	}

}
