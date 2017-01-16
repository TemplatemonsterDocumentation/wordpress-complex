<?php

namespace MPHB\Entities;

class Service {

	/**
	 *
	 * @var int
	 */
	private $id;

	/**
	 *
	 * @var string
	 */
	private $title;

	/**
	 *
	 * @var string
	 */
	private $description;

	/**
	 *
	 * @var float
	 */
	private $price;

	/**
	 *
	 * @var string
	 */
	private $periodicity;

	/**
	 *
	 * @var string
	 */
	private $quantity;

	/**
	 *
	 * @var int
	 */
	private $adults = 1;

	/**
	 *
	 * @param array $parameters
	 */
	public function __construct( $parameters ){
		$this->id			 = $parameters['id'];
		$this->title		 = $parameters['title'];
		$this->description	 = $parameters['description'];
		$this->periodicity	 = $parameters['periodicity'];
		$this->quantity		 = $parameters['quantity'];
		$this->price		 = $parameters['price'];
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
	public function getTitle(){
		return $this->title;
	}

	/**
	 *
	 * @return string
	 */
	public function getDescription(){
		return $this->description;
	}

	/**
	 *
	 * @return float
	 */
	public function getPrice(){
		return $this->price;
	}

	/**
	 *
	 * @return string
	 */
	public function getPeriodicity(){
		return $this->periodicity;
	}

	/**
	 *
	 * @return string
	 */
	public function getQuantity(){
		return $this->quantity;
	}

	/**
	 *
	 * @return bool
	 */
	public function isPayPerNight(){
		return $this->periodicity === 'per_night';
	}

	/**
	 *
	 * @return bool
	 */
	public function isPayPerAdult(){
		return $this->quantity === 'per_adult';
	}

	/**
	 *
	 * @param int $adults
	 */
	function setAdults( $adults ){
		$this->adults = (int) $adults;
	}

	/**
	 *
	 * @return int
	 */
	function getAdults(){
		return $this->adults;
	}

	/**
	 *
	 * @param \DateTime $checkInDate
	 * @param \DateTime $checkOutDate
	 * @param int $adults
	 * @return float
	 */
	public function calcPrice( $checkInDate, $checkOutDate ){
		$multiplier = 1;
		if ( $this->isPayPerNight() ) {
			$nights		 = \MPHB\Utils\DateUtils::calcNights( $checkInDate, $checkOutDate );
			$multiplier	 = $multiplier * $nights;
		}

		if ( $this->isPayPerAdult() ) {
			$multiplier = $multiplier * $this->adults;
		}
		// todo float calculations
		return $multiplier * $this->getPrice();
	}

	public function generatePriceDetailsString( $checkInDate, $checkOutDate ){

		$priceDetails = mphb_format_price( $this->getPrice() );

		if ( $this->isPayPerNight() ) {
			$nights = \MPHB\Utils\DateUtils::calcNights( $checkInDate, $checkOutDate );
			$priceDetails .= sprintf( _n( ' &#215; %d night', ' &#215; %d nights', $nights, 'motopress-hotel-booking' ), $nights );
		}

		if ( $this->isPayPerAdult() ) {
			$priceDetails .= sprintf( _n( ' &#215; %d adult', ' &#215; %d adults', $this->adults, 'motopress-hotel-booking' ), $this->adults );
		}

		return $priceDetails;
	}

	/**
	 *
	 * @return bool
	 */
	public function isFree(){
		return $this->price == 0;
	}

	/**
	 *
	 * @param bool $quantity Whether to show conditions of quantity. Default TRUE.*
	 * @param bool $periodicity Whether to show conditions of periodicity. Default TRUE.
	 * @param bool $literalFree Whether to replace 0 price to free label. Default TRUE.
	 *
	 * @return string
	 */
	public function getPriceWithConditions( $quantity = true, $periodicity = true, $literalFree = true ){

		$price = $this->getPriceHTML( $literalFree );

		if ( !$this->isFree() ) {
			if ( $periodicity ) {
				if ( $this->isPayPerNight() ) {
					$price .= __( ' Per Night', 'motopress-hotel-booking' );
				} else {
					$price .= __( ' Once', 'motopress-hotel-booking' );
				}
			}
			if ( $periodicity && $quantity ) {
				$price .= ' / ';
			}
			if ( $quantity ) {
				if ( $this->isPayPerAdult() ) {
					$price .= __( ' Per Adult', 'motopress-hotel-booking' );
				} else {
					$price .= __( ' Per Room', 'motopress-hotel-booking' );
				}
			}
		}

		return $price;
	}

	/**
	 *
	 * @param bool $literalFree
	 * @return string
	 */
	public function getPriceHTML( $literalFree = true ){
		return mphb_format_price( $this->getPrice(), array(
			'literal_free' => $literalFree
			) );
	}

}
