<?php

namespace MPHB\Entities;

class Rate {

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
	 * @var int
	 */
	private $roomTypeId;

	/**
	 *
	 * @var SeasonPrice[]
	 */
	private $seasonPrices;

	/**
	 *
	 * @var array
	 */
	private $datePrices = array();

	/**
	 *
	 * @var bool
	 */
	private $active = false;

	/**
	 *
	 * @param array			$args Array of args
	 * @param int			$args['id'] Id of rate
	 * @param string		$args['title'] Title of rate
	 * @param string		$args['description'] Description of rate
	 * @param int			$args['room_type_id'] Room Type ID
	 * @param SeasonPrice[] $args['season_prices'] Array of Season Prices.
	 * @param bool			$args['active'] Is rate available for user choosing.
	 *
	 */
	function __construct( $args ){
		$this->id			 = $args['id'];
		$this->title		 = $args['title'];
		$this->description	 = $args['description'];
		$this->roomTypeId	 = $args['room_type_id'];
		$this->seasonPrices	 = array_reverse( $args['season_prices'] );
		$this->active		 = $args['active'];

		$this->setupDatePrices();
	}

	private function setupDatePrices(){
		$datePrices = array();
		foreach ( $this->seasonPrices as $seasonPrice ) {
			$datePrices = array_merge( $datePrices, $seasonPrice->getDatePrices() );
		}
		$this->datePrices = $datePrices;
	}

	/**
	 *
	 * @return int Id of rate
	 */
	public function getId(){
		return $this->id;
	}

	/**
	 *
	 * @return string Title
	 */
	public function getTitle(){
		return $this->title;
	}

	/**
	 *
	 * @return string Description
	 */
	public function getDescription(){
		return $this->description;
	}

	/**
	 *
	 * @return SeasonPrice[] Array of season prices.
	 */
	public function getSeasonPrices(){
		return $this->seasonPrices;
	}

	/**
	 *
	 * @return int
	 */
	public function getRoomTypeId(){
		return $this->roomTypeId;
	}

	/**
	 *
	 * @param \DateTime $dateFrom
	 * @param \DateTime $dateTo
	 * @return bool
	 */
	public function isAvailableForDates( \DateTime $dateFrom, \DateTime $dateTo, $includeLastDate = false ){

		$requestedPeriod = \MPHB\Utils\DateUtils::createDatePeriod( $dateFrom, $dateTo, $includeLastDate );

		$requestedDates		 = array_map( array( '\MPHB\Utils\DateUtils', 'formatDateDB' ), iterator_to_array( $requestedPeriod ) );
		$availableDates		 = array_keys( $this->datePrices );
		$unavailableDates	 = array_diff( $requestedDates, $availableDates );

		return empty( $unavailableDates );
	}

	/**
	 *
	 * @return array
	 */
	public function getDatePrices(){
		return $this->datePrices;
	}

	/**
	 *
	 * @return bool
	 */
	public function isActive(){
		return $this->active;
	}

	/**
	 *
	 * @return Season[]
	 */
	public function getSeasons(){
		$seasons = array_map( function( SeasonPrice $seasonPrice ) {
			return $seasonPrice->getSeason();
		}, $this->seasonPrices );
		return array_filter( $seasons );
	}

	/**
	 *
	 * @return float
	 */
	public function getMinPrice(){
		return !empty( $this->datePrices ) ? min( $this->datePrices ) : 0.0;
	}

	/**
	 *
	 * @param \DateTime $checkInDate
	 * @param \DateTime $checkOutDate
	 * @return float
	 */
	public function getMinPriceForDates( \DateTime $checkInDate, \DateTime $checkOutDate ){
		// not use array_filter by key cause support php 5.3
		$datePrices				 = array();
		$checkInDateFormatted	 = $checkInDate->format( 'Y-m-d' );
		$checkOutDateFormatted	 = $checkOutDate->format( 'Y-m-d' );

		foreach ( $this->datePrices as $date => $price ) {
			if ( $date < $checkOutDateFormatted && $date >= $checkInDateFormatted ) {
				$datePrices[$date] = $price;
			}
		}

		return !empty( $datePrices ) ? min( $datePrices ) : 0.0;
	}

	/**
	 *
	 * @return float
	 */
	public function getMaxPrice(){
		return !empty( $this->datePrices ) ? max( $this->datePrices ) : 0.0;
	}

	/**
	 *
	 * @param \DateTime $checkInDate
	 * @param \DateTime $checkOutDate
	 * @return float
	 */
	public function calcPrice( \DateTime $checkInDate, \DateTime $checkOutDate ){
		return (float) array_sum( $this->getPriceBreakdown( $checkInDate, $checkOutDate ) );
	}

	/**
	 *
	 * @param string $checkInDate datein format 'Y-m-d'
	 * @param string $checkOutDate date in formta 'Y-m-d'
	 *
	 * @return array Array where keys are dates and values are prices
	 */
	public function getPriceBreakdown( $checkInDate, $checkOutDate ){

		$prices = array();

		foreach ( \MPHB\Utils\DateUtils::createDatePeriod( $checkInDate, $checkOutDate ) as $date ) {
			$dateDB = $date->format( 'Y-m-d' );
			if ( array_key_exists( $dateDB, $this->datePrices ) ) {
				$prices[$dateDB] = $this->datePrices[$dateDB];
			}
		}

		return $prices;
	}

}
