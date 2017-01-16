<?php

namespace MPHB\Settings;

class PageSettings {

	/**
	 * Retrieve checkout page id.
	 * The Checkout Page ID or false if checkout page not setted.
	 *
	 * @return string|bool
	 */
	public function getCheckoutPageId(){
		return $this->getNonEmptySetting( 'mphb_checkout_page' );
	}

	/**
	 * Retrieve checkout page url.
	 * Description:
	 * The permalink URL or false if post does not exist or checkout page not setted.
	 *
	 * @return string|bool
	 */
	public function getCheckoutPageUrl(){
		return $this->getUrl( $this->getCheckoutPageId() );
	}

	public function getBookingConfirmPageId(){
		$pageId = get_option( 'mphb_booking_confirmation_page' );
		return $pageId ? $pageId : false;
	}

	public function getBookingConfirmPageUrl(){
		$pageId = $this->getBookingConfirmPageId();
		return $pageId ? get_permalink( $pageId ) : false;
	}

	/**
	 *
	 * @return string|bool False if search results page was not setted.
	 */
	public function getSearchResultsPageId(){
		$pageId = get_option( 'mphb_search_results_page' );
		return $pageId ? $pageId : false;
	}

	/**
	 *
	 * @return string|bool False if search results page was not setted.
	 */
	public function getSearchResultsPageUrl(){
		$pageId = $this->getSearchResultsPageId();
		return $pageId ? get_permalink( $pageId ) : false;
	}

	/**
	 *
	 * @param string $id ID of page
	 * @return bool False if value was not updated and true if value was updated.
	 */
	public function setCheckoutPage( $id ){
		return update_option( 'mphb_checkout_page', $id );
	}

	/**
	 *
	 * @param string $id ID of page
	 * @return bool False if value was not updated and true if value was updated.
	 */
	public function setSearchResultsPage( $id ){
		return update_option( 'mphb_search_results_page', $id );
	}

	/**
	 *
	 * @return int|false
	 */
	public function getUserCancelRedirectPageId(){
		return $this->getNonEmptySetting( 'mphb_user_cancel_redirect' );
		$pageId = get_option();
		return $pageId ? $pageId : false;
	}

	/**
	 *
	 * @return string|false
	 */
	public function getUserCancelRedirectPageUrl(){
		$pageId = $this->getUserCancelRedirectPageId();
		return $pageId ? get_permalink( $pageId ) : false;
	}

	public function getUrl( $id ){
		return get_permalink( $id );
	}

	private function getNonEmptySetting( $name, $default = false ){
		$value = get_option( $name );
		return $value ? $value : $default;
	}

}
