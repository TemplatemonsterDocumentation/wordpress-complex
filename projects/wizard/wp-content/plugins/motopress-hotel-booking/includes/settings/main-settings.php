<?php

namespace MPHB\Settings;

class MainSettings {

	private $defaultUserApprovalTime = 20;
	private $defaultConfirmationMode = 'auto';

	function getDefaultUserApprovalTime(){
		return $this->defaultUserApprovalTime;
	}

	function getDefaultConfirmationMode(){
		return $this->defaultConfirmationMode;
	}

	public function getUserApprovalTime(){
		$minutes = get_option( 'mphb_user_approval_time', $this->defaultUserApprovalTime );
		return $minutes * MINUTE_IN_SECONDS;
	}

	/**
	 *
	 * @return array
	 */
	public function getBedTypesList(){
		$bedsList	 = array();
		$beds		 = get_option( 'mphb_bed_types', array() );
		foreach ( $beds as $bed ) {
			if ( !empty( $bed['type'] ) ) {
				$bedsList[$bed['type']] = $bed['type'];
			}
		}
		return $bedsList;
	}

	/**
	 * Retrieve confirmation mode. Possible values 'manual', 'auto'.
	 *
	 * @return string
	 */
	public function getConfirmationMode(){
		$mode = get_option( 'mphb_confirmation_mode', $this->defaultConfirmationMode );
		return $mode;
	}

	/**
	 *
	 * @return bool
	 */
	public function isAutoConfirmationMode(){
		return $this->getConfirmationMode() === 'auto';
	}

	/**
	 *
	 * @return int
	 */
	public function getMinAdults(){
		return 1;
	}

	/**
	 *
	 * @return int
	 */
	public function getMinChildren(){
		return 0;
	}

	/**
	 *
	 * @return int
	 */
	public function getMaxAdults(){
		return (int) apply_filters( 'mphb_settings_max_adults', 10 );
	}

	/**
	 *
	 * @return int
	 */
	public function getMaxChildren(){
		return (int) apply_filters( 'mphb_settings_max_children', 10 );
	}

	/**
	 *
	 * @return array
	 */
	public function getAdultsList(){
		$values = array_map( 'strval', range( $this->getMinAdults(), $this->getMaxAdults() ) );
		return array_combine( $values, $values );
	}

	/**
	 *
	 * @return array
	 */
	public function getChildrenList(){
		$values = array_map( 'strval', range( 0, $this->getMaxChildren() ) );
		return array_combine( $values, $values );
	}

	/**
	 *
	 * @return array
	 */
	public function getAdultsListForSearch(){
		$values = array_map( 'strval', range( $this->getMinAdults(), $this->getSearchMaxAdults() ) );
		return array_combine( $values, $values );
	}

	/**
	 *
	 * @return array
	 */
	public function getChildrenListForSearch(){
		$values = array_map( 'strval', range( 0, $this->getSearchMaxChildren() ) );
		return array_combine( $values, $values );
	}

	/**
	 *
	 * @return int
	 */
	public function getSearchMaxAdults(){
		$maxAdults = get_option( 'mphb_search_max_adults', $this->getMaxAdults() );
		return intval( $maxAdults );
	}

	/**
	 *
	 * @return int
	 */
	public function getSearchMaxChildren(){
		$maxChildren = get_option( 'mphb_search_max_children', $this->getMaxChildren() );
		return intval( $maxChildren );
	}

	/**
	 * Check whether to use templates from plugin
	 *
	 * @return bool
	 */
	public function isPluginTemplateMode(){
		return $this->getTemplateMode() === 'plugin';
	}

	/**
	 * Retrieve template mode. Possible values: plugin, theme.
	 *
	 * @return string
	 */
	public function getTemplateMode(){
		return current_theme_supports( 'motopress-hotel-booking' ) ? 'plugin' : get_option( 'mphb_template_mode', 'theme' );
	}

	/**
	 *
	 * @return bool
	 */
	public function isBookingDisabled(){
		$disabled = get_option( 'mphb_booking_disabled', false );
		return (bool) $disabled;
	}

	/**
	 *
	 * @return string
	 */
	public function getDisabledBookingText(){
		return get_option( 'mphb_disabled_booking_text', '' );
	}

	/**
	 *
	 * @return bool
	 */
	public function canUserCancelBooking(){
		$canUserCancel = get_option( 'mphb_user_can_cancel_booking', false );
		return (bool) $canUserCancel;
	}

	/**
	 *
	 * @return string containing html
	 */
	public function getCheckoutText(){
		return get_option( 'mphb_checkout_text', '' );
	}

}
