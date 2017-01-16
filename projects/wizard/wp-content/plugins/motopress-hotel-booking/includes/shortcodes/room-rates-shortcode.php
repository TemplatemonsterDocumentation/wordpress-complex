<?php

namespace MPHB\Shortcodes;

use \MPHB\Entities;

class RoomRatesShortcode extends AbstractShortcode {

	protected $name = 'mphb_rates';
	private $roomTypeId;

	public function addActions(){
		parent::addActions();
		add_action( 'mphb_sc_room_rate_before_loop', array( '\MPHB\Shortcodes\RoomRateShortcode', 'renderBeforeLoop' ) );
		add_action( 'mphb_sc_room_rate_after_loop', array( '\MPHB\Shortcodes\RoomRateShortcode', 'renderAfterLoop' ) );
		add_action( 'mphb_sc_room_rate_before_item', array( '\MPHB\Shortcodes\RoomRateShortcode', 'renderBeforeItem' ) );
		add_action( 'mphb_sc_room_rate_after_item', array( '\MPHB\Shortcodes\RoomRateShortcode', 'renderAfterItem' ) );
	}

	/**
	 *
	 * @param array $atts
	 * @param string $content Optional.
	 * @param string $shortcodeName
	 * @return string
	 */
	public function render( $atts, $content = null, $shortcodeName ){

		$defaultAtts = array(
			'id'	 => get_the_ID(),
			'class'	 => ''
		);

		$atts = shortcode_atts( $defaultAtts, $atts, $shortcodeName );

		$this->roomTypeId = absint( $atts['id'] );

		ob_start();
		$this->mainLoop();
		$content = ob_get_clean();

		$wrapperClass = apply_filters( 'mphb_sc_room_rates_wrapper_class', 'mphb_sc_room_rates-wrapper' );
		$wrapperClass .= empty( $wrapperClass ) ? $atts['class'] : ' ' . $atts['class'];
		return '<div class="' . esc_attr( $wrapperClass ) . '">' . $content . '</div>';
	}

	private function mainLoop(){
		$rates = MPHB()->getRateRepository()->findAllActiveByRoomType( $this->roomTypeId );
		if ( !empty( $rates ) ) {

			/**
			 * @hook \MPHB\Shortcodes\RoomRateShortcode::renderBeforeLoop - 10
			 */
			do_action( 'mphb_sc_room_rates_before_loop' );

			foreach ( $rates as $rate ) {
				/**
				 * @hooked \MPHB\Shortcodes\RoomRatesShortcode::renderBeforeItem
				 */
				do_action( 'mphb_sc_room_rates_before_item' );

				$this->renderRate( $rate );

				/**
				 * @hooked \MPHB\Shortcodes\RoomRatesShortcode::renderAfterItem
				 */
				do_action( 'mphb_sc_room_rates_after_item' );
			}

			/**
			 * @hook \MPHB\Shortcodes\RoomRateShortcode::renderAfterLoop - 10
			 */
			do_action( 'mphb_sc_room_rates_after_loop' );
		} else {
			$this->showNotFoundMessage();
		}
	}

	private function renderRate( Entities\Rate $rate ){
		$templateAtts = array(
			'title'			 => $rate->getTitle(),
			'minPrice'		 => mphb_format_price( $rate->getMinPrice() ),
			'description'	 => $rate->getDescription()
		);
		mphb_get_template_part( 'shortcodes/room-rates/rate-content', $templateAtts );
	}

	private function showNotFoundMessage(){
		mphb_get_template_part( 'shortcodes/room-rates/not-found' );
	}

	public static function renderBeforeLoop(){
		echo '<ul class="mphb-room-rates-list">';
	}

	public static function renderAfterLoop(){
		echo '</ul>';
	}

	public static function renderBeforeItem(){
		echo '<li>';
	}

	public static function renderAfterItem(){
		echo '</li>';
	}

}
