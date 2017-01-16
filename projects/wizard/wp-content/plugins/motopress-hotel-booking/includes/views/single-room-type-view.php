<?php

namespace MPHB\Views;

class SingleRoomTypeView extends RoomTypeView {

	const TEMPLATE_CONTEXT = 'single-room-type';

	public static function renderDisabledBookingText(){
		$text = MPHB()->settings()->main()->getDisabledBookingText();
		if ( !empty( $text ) ) {
			echo wp_kses_post( $text );
		}
	}

	public static function renderReservationForm(){
		if ( !MPHB()->settings()->main()->isBookingDisabled() ) {
			if ( MPHB()->getRateRepository()->findAllActiveByRoomType( MPHB()->getCurrentRoomType()->getId() ) ) {
				mphb_get_template_part( static::TEMPLATE_CONTEXT . '/reservation-form' );
			}
		} else {
			self::renderDisabledBookingText();
		}
	}

	public static function renderCalendar(){
		mphb_get_template_part( static::TEMPLATE_CONTEXT . '/calendar' );
	}

	public static function renderGallery(){
		$roomType = MPHB()->getCurrentRoomType();
		do_action( 'mphb_render_single_room_type_gallery', $roomType );

		parent::renderGallery();
	}

	public static function _renderPageWrapperStart(){

		$template = get_option( 'template' );

		switch ( $template ) {
			case 'twentyeleven' :
				echo '<div id="primary"><div id="content" role="main" class="twentyeleven">';
				break;
			case 'twentytwelve' :
				echo '<div id="primary" class="site-content"><div id="content" role="main" class="twentytwelve">';
				break;
			case 'twentythirteen' :
				echo '<div id="primary" class="site-content"><div id="content" role="main" class="entry-content twentythirteen">';
				break;
			case 'twentyfourteen' :
				echo '<div id="primary" class="content-area"><div id="content" role="main" class="site-content twentyfourteen"><div class="tfwc">';
				break;
			case 'twentyfifteen' :
				echo '<div id="primary" role="main" class="content-area twentyfifteen"><div id="main" class="site-main t15wc">';
				break;
			case 'twentysixteen' :
				echo '<div id="primary" class="content-area twentysixteen"><main id="main" class="site-main" role="main">';
				break;
			default :
				echo '<div id="container"><div id="content" role="main">';
				break;
		}
	}

	public static function _renderPageWrapperEnd(){

		$template = get_option( 'template' );

		switch ( $template ) {
			case 'twentyeleven' :
				echo '</div></div>';
				break;
			case 'twentytwelve' :
				echo '</div></div>';
				break;
			case 'twentythirteen' :
				echo '</div></div>';
				break;
			case 'twentyfourteen' :
				echo '</div></div></div>';
				get_sidebar( 'content' );
				break;
			case 'twentyfifteen' :
				echo '</div></div>';
				break;
			case 'twentysixteen' :
				echo '</div></main>';
				break;
			default :
				echo '</div></div>';
				break;
		}
	}

	public static function _renderCalendarTitle(){
		echo '<h2>' . __( 'Room Availability', 'motopress-hotel-booking' ) . '</h2>';
	}

	public static function _renderAttributesTitle(){
		echo '<h2>' . __( 'Room Details', 'motopress-hotel-booking' ) . '</h2>';
	}

	public static function _renderAttributesListOpen(){
		echo '<ul class="mphb-single-room-type-attributes">';
	}

	public static function _renderAttributesListClose(){
		echo '</ul>';
	}

	public static function _renderCategoriesListItemOpen(){
		echo '<li class="mphb-room-type-categories">';
	}

	public static function _renderCategoriesTitle(){
		echo '<span>' . __( 'Categories:', 'motopress-hotel-booking' ) . '</span>';
	}

	public static function _renderCategoriesListItemClose(){
		echo '</li>';
	}

	public static function _renderFacilitiesListItemOpen(){
		echo '<li class="mphb-room-type-facilities">';
	}

	public static function _renderFacilitiesTitle(){
		echo '<span>' . __( 'Facilites:', 'motopress-hotel-booking' ) . '</span>';
	}

	public static function _renderFacilitiesListItemClose(){
		echo '</li>';
	}

	public static function _renderAdultsListItemOpen(){
		echo '<li class="mphb-room-type-adults-capacity">';
	}

	public static function _renderAdultsTitle(){
		echo '<span>' . __( 'Adults:', 'motopress-hotel-booking' ) . '</span>';
	}

	public static function _renderAdultsListItemClose(){
		echo '</li>';
	}

	public static function _renderChildrenListItemOpen(){
		echo '<li class="mphb-room-type-children-capacity">';
	}

	public static function _renderChildrenTitle(){
		echo '<span>' . __( 'Children:', 'motopress-hotel-booking' ) . '</span>';
	}

	public static function _renderChildrenListItemClose(){
		echo '</li>';
	}

	public static function _renderBedTypeListItemOpen(){
		echo '<li class="mphb-room-type-bed-type">';
	}

	public static function _renderBedTypeTitle(){
		echo '<span>' . __( 'Bed Type:', 'motopress-hotel-booking' ) . '</span>';
	}

	public static function _renderBedTypeListItemClose(){
		echo '</li>';
	}

	public static function _renderSizeListItemOpen(){
		echo '<li class="mphb-room-type-size">';
	}

	public static function _renderSizeTitle(){
		echo '<span>' . __( 'Size:', 'motopress-hotel-booking' ) . '</span>';
	}

	public static function _renderSizeListItemClose(){
		echo '</li>';
	}

	public static function _renderViewListItemOpen(){
		echo '<li class="mphb-room-type-view">';
	}

	public static function _renderViewTitle(){
		echo '<span>' . __( 'View:', 'motopress-hotel-booking' ) . '</span>';
	}

	public static function _renderViewListItemClose(){
		echo '</li>';
	}

	public static function _renderFeaturedImageParagraphOpen(){
		echo '<p class="post-thumbnail mphb-single-room-type-post-thumbnail">';
	}

	public static function _renderFeaturedImageParagraphClose(){
		echo '</p>';
	}

	public static function _renderPriceParagraphOpen(){
		echo '<p class="mphb-regular-price">';
	}

	public static function _renderPriceTitle(){
		echo '<strong>' . __( 'Price From:', 'motopress-hotel-booking' ) . '</strong>';
	}

	public static function _renderPriceParagraphClose(){
		echo '</p>';
	}

	public static function _renderTitleHeadingOpen(){
		echo '<h1 itemprop="name" class="mphb-room-type-title entry-title">';
	}

	public static function _renderTitleHeadingClose(){
		echo '</h1>';
	}

	public static function _renderReservationFormTitle(){
		echo '<h2>' . __( 'Reservation Form', 'motopress-hotel-booking' ) . '</h2>';
	}

	public static function _renderMetas(){
		self::renderGallery();
		self::renderAttributes();
		self::renderPrice();
		self::renderCalendar();
		self::renderReservationForm();
	}

	public static function _enqueueGalleryScripts(){

		if ( apply_filters( 'mphb_single_room_type_gallery_use_magnific', true ) ) {
			wp_enqueue_script( 'mphb-magnific-popup' );
			wp_enqueue_style( 'mphb-magnific-popup-css' );
			?>
			<script type="text/javascript">
				document.addEventListener( "DOMContentLoaded", function( event ) {
					(function( $ ) {
						$( function() {
							var galleryItems = $( ".mphb-single-room-type-gallery-wrapper .gallery-icon>a" );
							if ( galleryItems.length && $.magnificPopup ) {
								galleryItems.magnificPopup( {
									type: 'image',
									gallery: {
										enabled: true
									}
								} );
							}
						} );
					})( jQuery );
				} );
			</script>
			<?php
		}
	}

}
