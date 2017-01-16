<?php

namespace MPHB\Settings;

class DateTimeSettings {

	private $dateFormat				 = 'm/d/Y';
	private $dateTimeFormat			 = 'm/d/Y H:i:s';

	/**
	 * Retrieve plugin's frontend date format. Uses for datepickers.
	 *
	 * @return string
	 */
	public function getDateFormat(){
		return $this->dateFormat;
	}

	/**
	 * Retrieve WP date format
	 *
	 * @return string
	 */
	public function getDateFormatWP(){
		return get_option( 'date_format' );
	}

	/**
	 * Retrieve WP date time format
	 *
	 * @param string $glue Glue string for concatenate date and time format
	 * @return string
	 */
	public function getDateTimeFormatWP( $glue = ' ' ){
		return get_option( 'date_format' ) . $glue . get_option( 'time_format' );
	}

	/**
	 *
	 * @return string
	 */
	public function getDateTimeFormat(){
		return $this->dateTimeFormat;
	}


	/**
	 * Retrieve first day of the week.
	 *
	 * @return int
	 */
	public function getFirstDay(){
		$wpFirstDay = (int) get_option( 'start_of_week', 0 );
		return $wpFirstDay;
	}

	/**
	 *
	 * @return string|array time in format "H:i:s" or array
	 */
	public function getCheckInTime( $asArray = false ){
		$separator	 = ':';
		$seconds	 = '00';
		$timeHM		 = get_option( 'mphb_check_in_time', '11:00' );
		$time		 = explode( $separator, $timeHM );
		$time[]		 = $seconds;
		return $asArray ? $time : implode( $separator, $time );
	}

	/**
	 * Retrieve check-in time in WordPress time format
	 */
	public function getCheckInTimeWPFormatted(){
		$time	 = $this->getCheckInTime();
		$timeObj = \DateTime::createFromFormat( 'H:i:s', $time );

		return \MPHB\Utils\DateUtils::formatTimeWPFront( $timeObj );
	}

	/**
	 *
	 * @return string time in format "H:i:s"
	 */
	public function getCheckOutTime( $asArray = false ){
		$separator	 = ':';
		$seconds	 = '00';
		$timeHM		 = get_option( 'mphb_check_out_time', '10:00' );
		$time		 = explode( $separator, $timeHM );
		$time[]		 = $seconds;
		return $asArray ? $time : implode( $separator, $time );
	}

	/**
	 * Retrieve check-out time in WordPress time format
	 */
	public function getCheckOutTimeWPFormatted(){
		$time	 = $this->getCheckOutTime();
		$timeObj = \DateTime::createFromFormat( 'H:i:s', $time );

		return \MPHB\Utils\DateUtils::formatTimeWPFront( $timeObj );
	}
}
