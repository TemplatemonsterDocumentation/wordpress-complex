<?php

namespace MPHB\Entities;

class SeasonPrice {

	/**
	 *
	 * @var int
	 */
	private $id;

	/**
	 *
	 * @var int
	 */
	private $seasonId;

	/**
	 *
	 * @var float
	 */
	private $price;

	/**
	 *
	 * @param array $args
	 * @param int $args['id']
	 * @param int $args['season_id']
	 * @param float $args['price']
	 */
	protected function __construct( $args = array() ){
		$this->id		 = $args['id'];
		$this->seasonId	 = $args['season_id'];
		$this->price	 = $args['price'];
	}

	/**
	 *
	 * @return int
	 */
	function getId(){
		return $this->id;
	}

	/**
	 *
	 * @return int
	 */
	function getSeasonId(){
		return $this->seasonId;
	}

	/**
	 *
	 * @return \MPHB\Entities\Season|null
	 */
	function getSeason(){
		return MPHB()->getSeasonRepository()->findById( $this->seasonId );
	}

	/**
	 *
	 * @return float
	 */
	function getPrice(){
		return $this->price;
	}

	/**
	 *
	 * @return array
	 */
	function getDatePrices(){
		$datePrices = array();

		$season = $this->getSeason();
		if ( !$season ) {
			return $datePrices;
		}

		$dates	 = $season->getDates();
		$dates	 = array_map( array( '\MPHB\Utils\DateUtils', 'formatDateDB' ), $dates );

		$datePrices = array_fill_keys( $dates, $this->price );
		return $datePrices;
	}

	/**
	 *
	 * @param array $atts
	 * @param int $atts['id']
	 * @param int $atts['season_id']
	 * @param float $atts['price']
	 * @return SeasonPrice|false
	 */
	public static function create( $atts ){

		if ( !isset( $atts['id'], $atts['price'], $atts['season_id'] ) ) {
			return false;
		}

		$atts['id']			 = (int) $atts['id'];
		$atts['season_id']	 = (int) $atts['season_id'];
		$atts['price']		 = (float) $atts['price'];

		if ( $atts['id'] < 0 ) {
			return false;
		}

		if ( $atts['price'] < 0 ) {
			return false;
		}

		if ( !MPHB()->getSeasonRepository()->findById( $atts['season_id'] ) ) {
			return false;
		}

		return new self( $atts );
	}

}
