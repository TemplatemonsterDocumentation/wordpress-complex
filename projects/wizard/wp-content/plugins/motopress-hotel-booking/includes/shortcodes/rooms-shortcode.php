<?php

namespace MPHB\Shortcodes;

class RoomsShortcode extends AbstractShortcode {

	protected $name = 'mphb_rooms';
	protected $isShowTitle;
	protected $isShowFeaturedImage;
	protected $isShowGallery;
	protected $isShowExcerpt;
	protected $isShowDetails;
	protected $isShowPrice;
	protected $isShowViewButton;
	protected $isShowBookButton;

	public function addActions(){
		parent::addActions();
		add_action( 'mphb_sc_rooms_render_image', array( '\MPHB\Views\LoopRoomTypeView', 'renderGalleryOrFeaturedImage' ) );
		add_action( 'mphb_sc_rooms_render_title', array( '\MPHB\Views\LoopRoomTypeView', 'renderTitle' ) );
		add_action( 'mphb_sc_rooms_render_excerpt', array( '\MPHB\Views\LoopRoomTypeView', 'renderExcerpt' ) );
		add_action( 'mphb_sc_rooms_render_details', array( '\MPHB\Views\LoopRoomTypeView', 'renderAttributes' ) );
		add_action( 'mphb_sc_rooms_render_price', array( '\MPHB\Views\LoopRoomTypeView', 'renderPrice' ) );
		add_action( 'mphb_sc_rooms_render_view_button', array( '\MPHB\Views\LoopRoomTypeView', 'renderViewDetailsButton' ) );
		add_action( 'mphb_sc_rooms_render_book_button', array( '\MPHB\Views\LoopRoomTypeView', 'renderBookButton' ) );

		add_action( 'mphb_sc_rooms_after_loop', array( '\MPHB\Views\GlobalView', 'renderPagination' ) );
	}

	/**
	 *
	 * @param array $atts
	 * @param string $content
	 * @param string $shortcodeName
	 * @return string
	 */
	public function render( $atts, $content = null, $shortcodeName ){
		$defaultAtts = array(
			'title'			 => 'true',
			'featured_image' => 'true',
			'gallery'		 => 'true',
			'excerpt'		 => 'true',
			'details'		 => 'true',
			'price'			 => 'true',
			'view_button'	 => 'true',
			'book_button'	 => 'true',
			'class'			 => ''
		);

		$atts = shortcode_atts( $defaultAtts, $atts, $shortcodeName );

		$this->isShowTitle			 = $this->convertParameterToBoolean( $atts['title'] );
		$this->isShowFeaturedImage	 = $this->convertParameterToBoolean( $atts['featured_image'] );
		$this->isShowGallery		 = $this->convertParameterToBoolean( $atts['gallery'] );
		$this->isShowExcerpt		 = $this->convertParameterToBoolean( $atts['excerpt'] );
		$this->isShowDetails		 = $this->convertParameterToBoolean( $atts['details'] );
		$this->isShowPrice			 = $this->convertParameterToBoolean( $atts['price'] );
		$this->isShowViewButton		 = $this->convertParameterToBoolean( $atts['view_button'] );
		$this->isShowBookButton		 = $this->convertParameterToBoolean( $atts['book_button'] );

		ob_start();
		$this->mainLoop();
		$content = ob_get_clean();

		$wrapperClass = apply_filters( 'mphb_sc_rooms_wrapper_class', 'mphb_sc_rooms-wrapper mphb-room-types' );
		$wrapperClass .= empty( $wrapperClass ) ? $atts['class'] : ' ' . $atts['class'];
		return '<div class="' . esc_attr( $wrapperClass ) . '">' . $content . '</div>';
	}

	public function mainLoop(){

		$roomTypesQuery = $this->getRoomTypesQuery();

		if ( $roomTypesQuery->have_posts() ) {

			do_action( 'mphb_sc_rooms_before_loop', $roomTypesQuery );

			while ( $roomTypesQuery->have_posts() ) : $roomTypesQuery->the_post();

				do_action( 'mphb_sc_rooms_before_item' );

				$this->renderRoomType();

				do_action( 'mphb_sc_rooms_after_item' );

			endwhile;

			wp_reset_postdata();

			do_action( 'mphb_sc_rooms_after_loop', $roomTypesQuery );
		} else {
			$this->showNotFoundMessage();
		}
	}

	public function getRoomTypesQuery(){
		$queryAtts = array(
			'post_type'				 => MPHB()->postTypes()->roomType()->getPostType(),
			'post_status'			 => 'publish',
			'paged'					 => mphb_get_paged_query_var(),
			'ignore_sticky_posts'	 => true,
		);
		return new \WP_Query( $queryAtts );
	}

	private function renderRoomType(){
		$templateAtts = array(
			'isShowImage'		 => $this->isShowFeaturedImage,
			'isShowTitle'		 => $this->isShowTitle,
			'isShowExcerpt'		 => $this->isShowExcerpt,
			'isShowDetails'		 => $this->isShowDetails,
			'isShowPrice'		 => $this->isShowPrice,
			'isShowViewButton'	 => $this->isShowViewButton,
			'isShowBookButton'	 => $this->isShowBookButton
		);
		mphb_get_template_part( 'shortcodes/rooms/room-content', $templateAtts );
	}

	public function showNotFoundMessage(){
		mphb_get_template_part( 'shortcodes/rooms/not-found' );
	}

}
