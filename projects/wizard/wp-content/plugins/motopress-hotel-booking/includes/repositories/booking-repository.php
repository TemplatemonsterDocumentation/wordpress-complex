<?php

namespace MPHB\Repositories;

use \MPHB\Entities;
use \MPHB\Persistences;

class BookingRepository extends AbstractPostRepository {

	/**
	 *
	 * @param int $id
	 * @return Entities\Booking
	 */
	public function findById( $id ){
		return parent::findById( $id );
	}

	public function mapPostToEntity( $post ){

		$id = ( is_a( $post, '\WP_Post' ) ) ? $post->ID : $post;

		$bookingAtts = $this->retrieveBookingAtts( $id );
		return Entities\Booking::create( $bookingAtts );
	}

	private function retrieveBookingAtts( $postId ){

		if ( empty( $postId ) ) {
			return false;
		}

		$bookingAtts = array(
			'id' => $postId
		);

		$checkInDate = get_post_meta( $postId, 'mphb_check_in_date', true );
		if ( $checkInDate ) {
			$bookingAtts['check_in_date'] = \DateTime::createFromFormat( 'Y-m-d', $checkInDate );
		}
		$checkOutDate = get_post_meta( $postId, 'mphb_check_out_date', true );
		if ( $checkOutDate ) {
			$bookingAtts['check_out_date'] = \DateTime::createFromFormat( 'Y-m-d', $checkOutDate );
		}

		$bookingAtts['adults']	 = absint( get_post_meta( $postId, 'mphb_adults', true ) );
		$bookingAtts['children'] = absint( get_post_meta( $postId, 'mphb_children', true ) );

		$bookingAtts['note'] = get_post_meta( $postId, 'mphb_note', true );

		$roomId	 = get_post_meta( $postId, 'mphb_room_id', true );
		$rateId	 = get_post_meta( $postId, 'mphb_room_rate_id', true );

		$room = MPHB()->getRoomRepository()->findById( $roomId );
		if ( !is_null( $room ) ) {
			$bookingAtts['room'] = $room;
		}

		$roomRate = MPHB()->getRateRepository()->findById( $rateId );
		if ( !is_null( $roomRate ) ) {
			$bookingAtts['room_rate'] = $roomRate;
		}

		$servicesArr = get_post_Meta( $postId, 'mphb_services', true );
		if ( $servicesArr === '' ) {
			$servicesArr = array();
		}

		$services = array();
		foreach ( $servicesArr as $key => $serviceDetails ) {

			$service = MPHB()->getServiceRepository()->findById( $serviceDetails['id'] );

			$service->setAdults( $serviceDetails['count'] );
			$services[] = $service;
		}
		$bookingAtts['services'] = $services;

		$customerDetails = array(
			'email'		 => get_post_meta( $postId, 'mphb_email', true ),
			'first_name' => get_post_meta( $postId, 'mphb_first_name', true ),
			'last_name'	 => get_post_meta( $postId, 'mphb_last_name', true ),
			'phone'		 => get_post_meta( $postId, 'mphb_phone', true )
		);

		$bookingAtts['customer'] = new Entities\Customer( $customerDetails );

		$bookingAtts['payment_status'] = get_post_meta( $postId, 'mphb_payment_status', true );

		$bookingAtts['status'] = get_post_status( $postId );

		$bookingAtts['total_price'] = abs( floatval( get_post_meta( $postId, 'mphb_total_price', true ) ) );

		return $bookingAtts;
	}

	public function mapEntityToPostData( $entity ){

		$postAtts = array(
			'ID'			 => $entity->getId(),
			'post_metas'	 => array(),
			'post_status'	 => $entity->getStatus(),
			'post_type'		 => MPHB()->postTypes()->booking()->getPostType(),
		);

		$services = array();
		foreach ( $entity->getServices() as $service ) {
			$services[] = array(
				'id'	 => $service->getId(),
				'count'	 => $service->getAdults()
			);
		}

		$postAtts['post_metas'] = array(
			'mphb_room_id'			 => $entity->getRoom()->getId(),
			'mphb_room_rate_id'		 => $entity->getRoomRate()->getId(),
			'mphb_check_in_date'	 => $entity->getCheckInDate()->format( 'Y-m-d' ),
			'mphb_check_out_date'	 => $entity->getCheckOutDate()->format( 'Y-m-d' ),
			'mphb_adults'			 => $entity->getAdults(),
			'mphb_children'			 => $entity->getChildren(),
			'mphb_note'				 => $entity->getNote(),
			'mphb_email'			 => $entity->getCustomer()->getEmail(),
			'mphb_first_name'		 => $entity->getCustomer()->getFirstName(),
			'mphb_last_name'		 => $entity->getCustomer()->getLastName(),
			'mphb_phone'			 => $entity->getCustomer()->getPhone(),
			'mphb_payment_status'	 => $entity->getPaymentStatus(),
			'mphb_services'			 => $services,
			'mphb_total_price'		 => $entity->getTotalPrice()
		);

		return new Entities\WPPostData( $postAtts );
	}

}
