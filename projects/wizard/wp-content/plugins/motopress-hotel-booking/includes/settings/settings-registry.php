<?php

namespace MPHB\Settings;

class SettingsRegistry {

	private $main;
	private $currency;
	private $units;
	private $emails;
	private $pages;
	private $dateTime;
	private $bookingRules;

	public function __construct(){
		$this->main			 = new MainSettings();
		$this->currency		 = new CurrencySettings();
		$this->units		 = new UnitsSettings();
		$this->emails		 = new EmailSettings();
		$this->pages		 = new PageSettings();
		$this->dateTime		 = new DateTimeSettings();
		$this->bookingRules	 = new BookingRulesSettings();
		$this->license		 = new LicenseSettings();
	}

	/**
	 *
	 * @return MainSettings
	 */
	public function main(){
		return $this->main;
	}

	/**
	 *
	 * @return CurrencySettings
	 */
	public function currency(){
		return $this->currency;
	}

	/**
	 *
	 * @return UnitsSettings
	 */
	public function units(){
		return $this->units;
	}

	/**
	 *
	 * @return EmailSettings
	 */
	public function emails(){
		return $this->emails;
	}

	/**
	 *
	 * @return PageSettings
	 */
	public function pages(){
		return $this->pages;
	}

	/**
	 *
	 * @return DateTimeSettings
	 */
	public function dateTime(){
		return $this->dateTime;
	}

	/**
	 *
	 * @return BookingRulesSettings
	 */
	public function bookingRules(){
		return $this->bookingRules;
	}

	/**
	 *
	 * @return LicenseSettings
	 */
	public function license(){
		return $this->license;
	}

}
