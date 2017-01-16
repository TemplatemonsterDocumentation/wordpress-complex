<?php

namespace MPHB\BookingRules;

use \MPHB\Utils;

class GlobalRules implements RuleVerifiable {

	protected $minDays;
	protected $maxDays;
	protected $checkInDays;
	protected $checkOutDays;

	/**
	 *
	 * @param array $atts
	 * @param int $atts['min_days']
	 * @param int $atts['max_days']
	 * @param array $atts['check_in_days']
	 * @param array $atts['check_out_days']
	 */
	public function __construct( $atts ){
		$this->minDays		 = $atts['min_days'];
		$this->maxDays		 = $atts['max_days'];
		$this->checkInDays	 = $atts['check_in_days'];
		$this->checkOutDays	 = $atts['check_out_days'];
	}

	public function verify( \DateTime $checkInDate, \DateTime $checkOutDate ){
		$nights		 = Utils\DateUtils::calcNights( $checkInDate, $checkOutDate );
		$checkInDay	 = $checkInDate->format( 'w' );
		$checkOutDay = $checkOutDate->format( 'w' );
		return $nights >= $this->minDays && $nights <= $this->maxDays &&
			in_array( $checkInDay, $this->checkInDays ) &&
			in_array( $checkOutDay, $this->checkOutDays );
	}

	public function getData(){
		return array(
			'min_days'		 => $this->minDays,
			'max_days'		 => $this->maxDays,
			'check_in_days'	 => $this->checkInDays,
			'check_out_days' => $this->checkOutDays
		);
	}

}
