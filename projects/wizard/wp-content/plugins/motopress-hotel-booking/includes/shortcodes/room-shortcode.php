<?php

namespace MPHB\Shortcodes;

class RoomShortcode extends AbstractShortcode {

	protected $name = 'mphb_room';
	private $isShowTitle;
	private $isShowFeaturedImage;
	private $isShowExcerpt;
	private $isShowDetails;
	private $isShowPricePerNight;
	private $isShowBookButton;

	public function addActions(){
		parent::addActions();
		add_action( 'mphb_sc_room_render_image', array( '\MPHB\Views\LoopRoomTypeView', 'renderGalleryOrFeaturedImage' ) );
		add_action( 'mphb_sc_room_render_title', array( '\MPHB\Views\LoopRoomTypeView', 'renderTitle' ) );
		add_action( 'mphb_sc_room_render_excerpt', array( '\MPHB\Views\LoopRoomTypeView', 'renderExcerpt' ) );
		add_action( 'mphb_sc_room_render_details', array( '\MPHB\Views\LoopRoomTypeView', 'renderAttributes' ) );
		add_action( 'mphb_sc_room_render_price', array( '\MPHB\Views\LoopRoomTypeView', 'renderPrice' ) );
		add_action( 'mphb_sc_room_render_book_button', array( '\MPHB\Views\LoopRoomTypeView', 'renderBookButton' ) );
	}

	public function render( $atts, $content = '', $shortcodeName ){

		$defaultAtts = array(
			'id'				 => '',
			'title'				 => 'true',
			'featured_image'	 => 'true',
			'excerpt'			 => 'true',
			'details'			 => 'true',
			'price_per_night'	 => 'true',
			'book_button'		 => 'true',
			'class'				 => ''
		);

		$atts	 = shortcode_atts( $defaultAtts, $atts, $shortcodeName );
		$result	 = '';

		$this->id					 = intval( $atts['id'] );
		$this->isShowTitle			 = $this->convertParameterToBoolean( $atts['title'] );
		$this->isShowFeaturedImage	 = $this->convertParameterToBoolean( $atts['featured_image'] );
		$this->isShowExcerpt		 = $this->convertParameterToBoolean( $atts['excerpt'] );
		$this->isShowDetails		 = $this->convertParameterToBoolean( $atts['details'] );
		$this->isShowPricePerNight	 = $this->convertParameterToBoolean( $atts['price_per_night'] );
		$this->isShowBookButton		 = $this->convertParameterToBoolean( $atts['book_button'] );

		ob_start();
		$this->mainLoop();
		$content = ob_get_clean();

		$wrapperClass = apply_filters( 'mphb_sc_room_wrapper_class', 'mphb_sc_room-wrapper' );
		$wrapperClass .= empty( $wrapperClass ) ? $atts['class'] : ' ' . $atts['class'];
		return '<div class="' . esc_attr( $wrapperClass ) . '">' . $content . '</div>';
	}

	private function mainLoop(){

		$roomTypeQuery = $this->getRoomTypeQuery();

		if ( $roomTypeQuery->have_posts() ) {

			do_action( 'mphb_sc_room_before_loop' );

			while ( $roomTypeQuery->have_posts() ) : $roomTypeQuery->the_post();

				do_action( 'mphb_sc_room_before_item' );

				$this->renderRoom();

				do_action( 'mphb_sc_room_after_item' );

			endwhile;

			wp_reset_postdata();

			do_action( 'mphb_sc_room_after_loop' );
		} else {
			// no posts found
			$this->showNoFoundMessage();
		}
	}

	private function getRoomTypeQuery(){
		$queryAtts = array(
			'post_type'				 => MPHB()->postTypes()->roomType()->getPostType(),
			'post__in'				 => array( $this->id ),
			'ignore_sticky_posts'	 => true
		);
		return new \WP_Query( $queryAtts );
	}

	protected function renderRoom(){
		$templateAtts = array(
			'isShowImage'		 => $this->isShowFeaturedImage,
			'isShowTitle'		 => $this->isShowTitle,
			'isShowExcerpt'		 => $this->isShowExcerpt,
			'isShowDetails'		 => $this->isShowDetails,
			'isShowPrice'		 => $this->isShowPricePerNight,
			'isShowBookButton'	 => $this->isShowBookButton
		);
		mphb_get_template_part( 'shortcodes/room/room-content', $templateAtts );
	}

	protected function showNoFoundMessage(){
		mphb_get_template_part( 'shortcodes/room/not-found' );
	}

}
