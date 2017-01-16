<?php

namespace MPHB\Entities;

/**
 *
 * @param array $args
 * @param int $args['id'] Id of season
 * @param string $args['title'] Title of season
 * @param string $args['description'] Description of season
 * @param DateTime $args['start_date'] Start Date of season
 * @param DateTime $args['end_date'] End Date of season
 * @param array $args['days'] Days of season
 */
class Season {

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
	 * @var \DateTime
	 */
	private $startDate;

	/**
	 *
	 * @var \DateTime
	 */
	private $endDate;

	/**
	 *
	 * @var array
	 */
	private $days = array();

	/**
	 *
	 * @var \DateTime[]
	 */
	private $dates = array();

	public function __construct( $args ){
		$this->id			 = (int) $args['id'];
		$this->title		 = $args['title'];
		$this->description	 = $args['description'];
		$this->startDate	 = $args['start_date'];
		$this->endDate		 = $args['end_date'];
		$this->days			 = $args['days'];
		$this->setupDates();
	}

	private function setupDates(){

		$datePeriod	 = \MPHB\Utils\DateUtils::createDatePeriod( $this->startDate, $this->endDate, true );
		$dates		 = iterator_to_array( $datePeriod );

		// remove not allowed week days from period
		$dates = array_filter( $dates, array( $this, 'isAllowedWeekDay' ) );

		$this->dates = $dates;
	}

	/**
	 *
	 * @param \DateTime $date
	 */
	public function isAllowedWeekDay( $date ){
		$weekDay = $date->format( 'w' );
		return in_array( $weekDay, $this->days );
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
	 * @return string
	 */
	function getTitle(){
		return $this->title;
	}

	/**
	 *
	 * @return \DateTime
	 */
	function getDescription(){
		return $this->description;
	}

	/**
	 *
	 * @return \DateTime
	 */
	function getStartDate(){
		return $this->startDate;
	}

	/**
	 *
	 * @return \DateTime
	 */
	function getEndDate(){
		return $this->endDate;
	}

	/**
	 *
	 * @return array
	 */
	public function getDays(){
		return $this->days;
	}

	/**
	 *
	 * @return DateTime[]
	 */
	function getDates(){
		return $this->dates;
	}

}
