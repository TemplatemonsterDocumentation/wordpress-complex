<?php

namespace MPHB\BookingRules;

interface RuleVerifiable {

	/**
	 *
	 * @param \DateTime $checkInDate
	 * @param \DateTime $checkOutDate
	 * @return bool
	 */
	public function verify( \DateTime $checkInDate, \DateTime $checkOutDate );

}
