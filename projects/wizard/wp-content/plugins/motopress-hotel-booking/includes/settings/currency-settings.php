<?php

namespace MPHB\Settings;

class CurrencySettings {

	private $defaultCurrency = 'USD';
	private $defaultPosition = 'before';

	public function getDefaultCurrency(){
		return $this->defaultCurrency;
	}

	public function getDefaultPosition(){
		return $this->defaultPosition;
	}

	/**
	 *
	 * @var \MPHB\Bundles\CurrencyBundle
	 */
	private $bundle;

	public function __construct(){
		$this->bundle = new \MPHB\Bundles\CurrencyBundle;
	}

	public function getCurrencySymbol(){
		$currencyKey = get_option( 'mphb_currency_symbol', $this->defaultCurrency );
		return $this->bundle->getSymbol( $currencyKey );
	}

	/**
	 *  Return currency position.
	 *
	 * @return string
	 */
	public function getCurrencyPosition(){
		$currencyPosition = get_option( 'mphb_currency_position', $this->defaultPosition );
		return $currencyPosition;
	}

	/**
	 *
	 * @return string
	 */
	public function getPriceFormat(){
		$currencyPosition	 = $this->getCurrencyPosition();
		$currencySpan		 = '<span class="mphb-currency">' . $this->getCurrencySymbol() . '</span>';

		switch ( $currencyPosition ) {
			case 'after' :
				$format	 = '%s' . $currencySpan;
				break;
			case 'before_space' :
				$format	 = $currencySpan . '&nbsp;%s';
				break;
			case 'after_space' :
				$format	 = '%s&nbsp;' . $currencySpan;
				break;
			case 'before' :
				$format	 = $currencySpan . '%s';
				break;
		}

		return $format;
	}

	/**
	 *
	 * @return string
	 */
	public function getPriceDecimalsSeparator(){
		$separator = get_option( 'mphb_decimals_separator', '.' );
		return $separator;
	}

	/**
	 *
	 * @return string
	 */
	public function getPriceThousandSeparator(){
		$separator = get_option( 'mphb_thousand_separator', ',' );
		return $separator;
	}

	/**
	 *
	 * @return int
	 */
	public function getPriceDecimalsCount(){
		$count = get_option( 'mphb_decimal_count', 2 );
		return intval( $count );
	}

	/**
	 *
	 * @return \MPHB\Bundles\CurrencyBundle
	 */
	public function getBundle(){
		return $this->bundle;
	}

}
