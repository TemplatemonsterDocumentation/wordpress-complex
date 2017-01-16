<?php

namespace MPHB\Settings;

class BookingRulesSettings {

	private $defaultGlobalMinDays		 = 1;
	private $defaultGlobalMaxDays		 = 15;
	private $defaultGlobalCheckInDays	 = array( '0', '1', '2', '3', '4', '5', '6' );
	private $defaultGlobalCheckOutDays	 = array( '0', '1', '2', '3', '4', '5', '6' );

	public function getDefaultGlobalMinDays(){
		return $this->defaultGlobalMinDays;
	}

	public function getDefaultGlobalMaxDays(){
		return $this->defaultGlobalMaxDays;
	}

	public function getDefaultGlobalCheckOutDays(){
		return $this->defaultGlobalCheckOutDays;
	}

	public function getDefaultGlobalCheckInDays(){
		return $this->defaultGlobalCheckInDays;
	}

	/**
	 *
	 * @return int
	 */
	public function getGlobalMinDays(){
		return (int) get_option( 'mphb_global_min_days', $this->getDefaultGlobalMinDays() );
	}

	/**
	 *
	 * @return int
	 */
	public function getGlobalMaxDays(){
		return (int) get_option( 'mphb_global_max_days', $this->getDefaultGlobalMaxDays() );
	}

	/**
	 *
	 * @return array
	 */
	public function getGlobalCheckInDays(){
		return get_option( 'mphb_global_check_in_days', $this->getDefaultGlobalCheckInDays() );
	}

	/**
	 *
	 * @return array
	 */
	public function getGlobalCheckOutDays(){
		return get_option( 'mphb_global_check_out_days', $this->getDefaultGlobalCheckOutDays() );
	}

	/**
	 *
	 * @return array
	 */
	public function getCustomRules(){
		$rules = get_option( 'mphb_custom_booking_rules', array() );
		return isset( $rules['items'] ) ? $rules['items'] : array();
	}

}
