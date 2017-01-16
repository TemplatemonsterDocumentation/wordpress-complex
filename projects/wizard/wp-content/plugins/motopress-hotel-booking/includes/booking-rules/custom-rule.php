<?php

namespace MPHB\BookingRules;

class CustomRule implements RuleVerifiable {

	const COMPARE_DATE_FORMAT = 'Ymd';

	/**
	 *
	 * @var string
	 */
	protected $title;

	/**
	 *
	 * @var string
	 */
	protected $description;

	/**
	 *
	 * @var \DateTime
	 */
	protected $dateFrom;

	/**
	 *
	 * @var \DateTime
	 */
	protected $dateTo;

	/**
	 *
	 * @var \DateTime[]
	 */
	protected $dates;

	/**
	 *
	 * @var bool
	 */
	protected $notCheckIn = false;

	/**
	 *
	 * @var bool
	 */
	protected $notCheckOut = false;

	/**
	 *
	 * @var bool
	 */
	protected $notStayIn = false;

	/**
	 *
	 * @param array $atts
	 * @param string $atts['title']
	 * @param string $atts['description']
	 * @param DateTime $atts['date_from']
	 * @param DateTime $atts['date_to']
	 * @param bool $atts['not_check_in']
	 * @param bool $atts['not_check_out']
	 * @param bool $atts['not_stay_in']
	 */
	public function __construct( $atts ){
		$this->title		 = $atts['title'];
		$this->description	 = $atts['description'];
		$this->dateFrom		 = $atts['date_from'];
		$this->dateTo		 = $atts['date_to'];
		$this->notCheckIn	 = $atts['not_check_in'];
		$this->notCheckOut	 = $atts['not_check_out'];
		$this->notStayIn	 = $atts['not_stay_in'];
		$this->setupDates();
	}

	protected function setupDates(){
		$period		 = \MPHB\Utils\DateUtils::createDatePeriod( $this->dateFrom, $this->dateTo, true );
		$periodArr	 = iterator_to_array( $period );
		$this->dates = $periodArr;
	}

	/**
	 *
	 * @param \DateTime $checkInDate
	 * @param \DateTime $checkOutDate
	 * @return boolean
	 */
	public function verify( \DateTime $checkInDate, \DateTime $checkOutDate ){

		if ( $this->notCheckIn && $this->isDateInPeriod( $checkInDate ) ) {
			return false;
		}

		if ( $this->notCheckOut && $this->isDateInPeriod( $checkOutDate ) ) {
			return false;
		}

		if ( $this->notStayIn && $this->isPeriodOverlap( $checkInDate, $checkOutDate ) ) {
			return false;
		}

		return true;
	}

	protected function isDateInPeriod( \DateTime $date ){

		$isDateLaterPeriodStart	 = $this->dateFrom->format( self::COMPARE_DATE_FORMAT ) <= $date->format( self::COMPARE_DATE_FORMAT );
		$isDateEarlierPeriodEnd	 = $this->dateTo->format( self::COMPARE_DATE_FORMAT ) >= $date->format( self::COMPARE_DATE_FORMAT );

		return $isDateEarlierPeriodEnd && $isDateLaterPeriodStart;
	}

	protected function isPeriodOverlap( \DateTime $checkInDate, \DateTime $checkOutDate ){
		$beforeCheckOutDate = clone $checkOutDate;
		$beforeCheckOutDate->modify( '-1 day' );

		return $this->dateFrom->format( self::COMPARE_DATE_FORMAT ) <= $beforeCheckOutDate->format( self::COMPARE_DATE_FORMAT ) &&
			$this->dateTo->format( self::COMPARE_DATE_FORMAT ) >= $checkInDate->format( self::COMPARE_DATE_FORMAT );
	}

	/**
	 *
	 * @return \DateTime[]
	 */
	public function getDates(){
		return $this->dates;
	}

	/**
	 *
	 * @return array()
	 */
	public function getRuleParts(){
		return array(
			'not_check_in'	 => $this->notCheckIn,
			'not_check_out'	 => $this->notCheckOut,
			'not_stay_in'	 => $this->notStayIn,
		);
	}

	/**
	 *
	 * @param array $atts
	 * @param string $atts['title']
	 * @param string $atts['description']
	 * @param string $atts['date_from'] Date in format Y-m-d
	 * @param string $atts['date_to'] Date in format Y-m-d
	 * @param bool $atts['not_check_in']
	 * @param bool $atts['not_check_out']
	 * @param bool $atts['not_stay_in']
	 * @return CustomRule|null
	 */
	public static function create( $atts ){

		$atts['title']		 = (string) $atts['title'];
		$atts['description'] = (string) $atts['description'];
		$dateFrom			 = \DateTime::createFromFormat( 'Y-m-d', $atts['date_from'] );
		if ( !$dateFrom ) {
			return null;
		}
		$dateTo = \DateTime::createFromFormat( 'Y-m-d', $atts['date_to'] );
		if ( !$dateTo ) {
			return null;
		}
		if ( \MPHB\Utils\DateUtils::calcNights( $dateFrom, $dateTo ) < 0 ) {
			return null;
		}
		$atts['date_from']		 = $dateFrom;
		$atts['date_to']		 = $dateTo;
		$atts['not_check_in']	 = isset( $atts['not_check_in'] ) ? (bool) $atts['not_check_in'] : false;
		$atts['not_check_out']	 = isset( $atts['not_check_out'] ) ? (bool) $atts['not_check_out'] : false;
		$atts['not_stay_in']	 = isset( $atts['not_stay_in'] ) ? (bool) $atts['not_stay_in'] : false;
		return new self( $atts );
	}

}
