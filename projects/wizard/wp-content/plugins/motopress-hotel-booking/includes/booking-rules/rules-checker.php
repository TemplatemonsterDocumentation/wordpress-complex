<?php

namespace MPHB\BookingRules;

class RulesChecker implements RuleVerifiable {

	/**
	 *
	 * @var RuleVerifiable[]
	 */
	protected $rules = array();
	protected $globalRules;
	protected $customRules;

	public function __construct( GlobalRules $globalRules, CustomRulesHolder $customRules ){
		$this->globalRules	 = $globalRules;
		$this->customRules	 = $customRules;
	}

	public function verify( \DateTime $checkInDate, \DateTime $checkOutDate ){
		return $this->globalRules->verify( $checkInDate, $checkOutDate ) &&
			$this->customRules->verify( $checkInDate, $checkOutDate );
	}

	public function getData(){
		return array(
			'global' => $this->globalRules->getData(),
			'dates'	 => $this->customRules->getDatesWithRules()
		);
	}

}
