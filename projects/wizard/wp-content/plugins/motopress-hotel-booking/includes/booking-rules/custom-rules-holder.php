<?php

namespace MPHB\BookingRules;

class CustomRulesHolder implements RuleVerifiable {

	/**
	 *
	 * @var CustomRule[]
	 */
	protected $rules = array();

	/**
	 *
	 * @param \MPHB\BookingRules\CustomRule $rule
	 */
	public function addRule( CustomRule $rule ){
		$this->rules[] = $rule;
	}

	public function getDatesWithRules(){
		$dateDetails = array();
		foreach ( $this->rules as $rule ) {
			foreach ( $rule->getDates() as $date ) {
				$dateFormatted = $date->format( 'Y-m-d' );
				if ( !isset( $dateDetails[$dateFormatted] ) ) {
					$dateDetails[$dateFormatted] = $rule->getRuleParts();
				} else {
					$ruleParts = $rule->getRuleParts();
					foreach ( $ruleParts as $rulePartName => $rulePartValue ) {
						$dateDetails[$dateFormatted][$rulePartName] = $dateDetails[$dateFormatted][$rulePartName] || $rulePartValue;
					}
				}
			}
		}
		ksort( $dateDetails );
		return $dateDetails;
	}

	/**
	 *
	 * @param \DateTime $checkInDate
	 * @param \DateTime $checkOutDate
	 * @return boolean
	 */
	public function verify( \DateTime $checkInDate, \DateTime $checkOutDate ){
		$verified = true;

		foreach ( $this->rules as $rule ) {
			if ( !$rule->verify( $checkInDate, $checkOutDate ) ) {
				$verified = false;
				break;
			}
		}
		return $verified;
	}

}
