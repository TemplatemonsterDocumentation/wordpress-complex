<?php

namespace MPHB\Crons;

use \MPHB\Entities;

class BookingAbandonCron {

	const ACTION_ABANDON	 = 'mphb_abandon_bookings';
	const INTERVAL_ABANDON = 'mphb_booking_abandon';

	public function __construct(){
		add_filter( 'cron_schedules', array( $this, 'createCronInterval' ) );
		add_action( self::ACTION_ABANDON, array( $this, 'abandonBookings' ) );
	}

	public function createCronInterval( $schedules ){

		$schedules[self::INTERVAL_ABANDON] = array(
			'interval'	 => MPHB()->settings()->main()->getUserApprovalTime(),
			'display'	 => __( 'User Approval Time setted in Hotel Booking Settings', 'motopress-hotel-booking' )
		);

		return $schedules;
	}

	public function abandonBookings(){

		$limit = 10;

		// get abandon-ready bookings LIMITED
		$bookingAtts = array(
			'abandon_ready'	 => true,
			'posts_per_page' => $limit,
			'paged'			 => 1
		);

		// change booking status to abandoned
		$bookings = MPHB()->getBookingRepository()->findAll( $bookingAtts );

		foreach ( $bookings as $booking ) {
			$booking->setStatus( \MPHB\PostTypes\BookingCPT\Statuses::STATUS_ABANDONED );
			MPHB()->getBookingRepository()->save( $booking );
		}

		// remove cron task if the abandon-ready bookings are finished
		if ( count( $bookings ) < $limit ) {

			$penddingBookingAtts = array(
				'post_status'	 => \MPHB\PostTypes\BookingCPT\Statuses::STATUS_PENDING_USER,
				'posts_per_page' => 1
			);

			$pendingBookings = MPHB()->getBookingPersistence()->getPosts( $penddingBookingAtts );

			if ( !count( $pendingBookings ) ) {
				$this->unshedule();
			}
		}
	}

	public function shedule(){
		if ( !wp_next_scheduled( self::ACTION_ABANDON ) ) {
			wp_schedule_event( current_time( 'timestamp', true ), self::INTERVAL_ABANDON, self::ACTION_ABANDON );
		}
	}

	public function unshedule(){
		wp_clear_scheduled_hook( self::ACTION_ABANDON );
	}

}
