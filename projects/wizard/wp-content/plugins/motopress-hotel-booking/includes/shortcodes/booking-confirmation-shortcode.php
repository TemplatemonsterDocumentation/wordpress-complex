<?php

namespace MPHB\Shortcodes;

use \MPHB\UserActions;

class BookingConfirmationShortcode extends AbstractShortcode {

	protected $name = 'mphb_booking_confirmation';

	/**
	 *
	 * @param array $atts
	 * @param null $content
	 * @param string $shortcodeName
	 * @return string
	 */
	public function render( $atts, $content = null, $shortcodeName ){

		$defaultAtts = array(
			'class' => ''
		);

		$atts = shortcode_atts( $defaultAtts, $atts, $shortcodeName );

		$status = $this->detectStatus();

		ob_start();

		if ( $status ) {

			do_action( 'mphb_sc_booking_confirmation_before' );

			switch ( $status ) {
				case UserActions\BookingConfirmationAction::STATUS_INVALID_REQUEST:
					mphb_get_template_part( 'shortcodes/booking-confirmation/invalid-request' );
					break;
				case UserActions\BookingConfirmationAction::STATUS_CONFIRMED:
					mphb_get_template_part( 'shortcodes/booking-confirmation/confirmed' );
					break;
				case UserActions\BookingConfirmationAction::STATUS_EXPIRED:
					mphb_get_template_part( 'shortcodes/booking-confirmation/expired' );
					break;
				case UserActions\BookingConfirmationAction::STATUS_CONFIRMATION_NOT_POSSIBLE:
					mphb_get_template_part( 'shortcodes/booking-confirmation/not-possible' );
					break;
				case UserActions\BookingConfirmationAction::STATUS_ALREADY_CONFIRMED:
					mphb_get_template_part( 'shortcodes/booking-confirmation/already-confirmed' );
					break;
			}

			do_action( 'mphb_sc_booking_confirmation_after' );
		}

		$content = ob_get_clean();

		$wrapperClass = apply_filters( 'mphb_sc_booking_confirmation_wrapper_class', 'mphb_sc_booking_confirmation-wrapper' );
		$wrapperClass .= empty( $wrapperClass ) ? $atts['class'] : ' ' . $atts['class'];
		return '<div class="' . esc_attr( $wrapperClass ) . '">' . $content . '</div>';
	}

	/**
	 *
	 * @return string|false
	 */
	private function detectStatus(){

		if ( !isset( $_GET['mphb_confirmation_status'] ) ) {
			return false;
		}

		$status = $_GET['mphb_confirmation_status'];

		$allowedStatuses = array(
			UserActions\BookingConfirmationAction::STATUS_ALREADY_CONFIRMED,
			UserActions\BookingConfirmationAction::STATUS_CONFIRMATION_NOT_POSSIBLE,
			UserActions\BookingConfirmationAction::STATUS_CONFIRMED,
			UserActions\BookingConfirmationAction::STATUS_EXPIRED,
			UserActions\BookingConfirmationAction::STATUS_INVALID_REQUEST
		);

		if ( !in_array( $status, $allowedStatuses ) ) {
			return false;
		}

		return $status;
	}

}
