<?php

namespace MPHB\Settings;

class EmailSettings {

	private $defaultBaseColor		 = '#557da1';
	private $defaultBgColor			 = '#f5f5f5';
	private $defaultBodyBgColor		 = '#fdfdfd';
	private $defaultBodyTextColor	 = '#505050';

	/**
	 *
	 * @return string
	 */
	public function getAdminEmail(){
		$wpAdminEmail	 = get_bloginfo( 'admin_email' );
		$mphbAdminEmail	 = get_option( 'mphb_admin_email', '' );
		return empty( $mphbAdminEmail ) ? $wpAdminEmail : $mphbAdminEmail;
	}

	/**
	 *
	 * @return string
	 */
	public function getAdminName(){
		$wpAdminName	 = get_bloginfo( 'name' );
		$mphbAdminName	 = get_option( 'mphb_admin_name', '' );
		return empty( $mphbAdminName ) ? $wpAdminName : $mphbAdminName;
	}

	/**
	 *
	 * @return string
	 */
	public function getFooterText(){
		$text = get_option( 'mphb_email_footer_text', '' );
		if ( empty( $text ) ) {
			$text = $this->getDefaultFooterText();
		}
		return $text;
	}

	/**
	 *
	 * @return string
	 */
	public function getDefaultFooterText(){
		return apply_filters( 'mphb_email_footer_text_default', '<a href="' . esc_url( home_url() ) . '">' . get_bloginfo( 'name' ) . '</a>' );
	}

	/**
	 *
	 * @return string
	 */
	public function getLogoUrl(){
		$logoUrl = get_option( 'mphb_email_logo', '' );
		if ( empty( $logoUrl ) ) {
			$logoUrl = $this->getDefaultLogoUrl();
		}
		return $logoUrl;
	}

	/**
	 *
	 * @return string
	 */
	public function getDefaultLogoUrl(){
		return apply_filters( 'mphb_email_logo_default', '' );
	}

	/**
	 *
	 * @return bool
	 */
	public function hasLogo(){
		return $this->getLogoUrl() !== '';
	}

	/**
	 *
	 * @return string
	 */
	public function getBaseColor(){
		$color = get_option( 'mphb_email_base_color', '' );
		if ( empty( $color ) ) {
			$color = $this->getDefaultBaseColor();
		}
		return $color;
	}

	/**
	 *
	 * @return string
	 */
	public function getDefaultBaseColor(){
		return apply_filters( 'mphb_email_base_color_default', $this->defaultBaseColor );
	}

	/**
	 *
	 * @return string
	 */
	public function getBGColor(){
		$color = get_option( 'mphb_email_bg_color', '' );
		if ( empty( $color ) ) {
			$color = $this->getDefaultBGColor();
		}
		return $color;
	}

	/**
	 *
	 * @return string
	 */
	public function getDefaultBGColor(){
		return apply_filters( 'mphb_email_bg_color_default', $this->defaultBgColor );
	}

	/**
	 *
	 * @return string
	 */
	public function getBodyBGColor(){
		$color = get_option( 'mphb_email_body_bg_color', '' );
		if ( empty( $color ) ) {
			$color = $this->getDefaultBodyBGColor();
		}
		return $color;
	}

	/**
	 *
	 * @return string
	 */
	public function getDefaultBodyBGColor(){
		return apply_filters( 'mphb_email_body_bg_color_default', $this->defaultBodyBgColor );
	}

	/**
	 *
	 * @return string
	 */
	public function getBodyTextColor(){
		$color = get_option( 'mphb_email_body_text_color', '' );
		if ( empty( $color ) ) {
			$color = $this->getDefaultBodyTextColor();
		}
		return $color;
	}

	/**
	 *
	 * @return string
	 */
	public function getDefaultBodyTextColor(){
		return apply_filters( 'mphb_email_body_text_color_default', $this->defaultBodyTextColor );
	}

	public function getFromName(){
		$fromName = get_option( 'mphb_email_from_name', '' );
		if ( empty( $fromName ) ) {
			$fromName = $this->getDefaultFromName();
		}
		return $fromName;
	}

	public function getDefaultFromName(){
		return get_bloginfo( 'name' );
	}

	public function getFromEmail(){
		$fromAddress = get_option( 'mphb_email_from_email', '' );
		if ( empty( $fromAddress ) ) {
			$fromAddress = $this->getDefaultFromEmail();
		}
		return $fromAddress;
	}

	public function getDefaultFromEmail(){
		return get_bloginfo( 'admin_email' );
	}

}
