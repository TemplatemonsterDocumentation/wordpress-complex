<?php
/**
 *
 * Avaialable variables
 * - DateTime $checkInDate
 * - DateTime $checkOutDate
 * - int $adults
 * - int $children
 * - bool $isShowGallery
 * - bool $isShowImage
 * - bool $isShowTitle
 * - bool $isShowExcerpt
 * - bool $isShowDetails
 *
 */
if ( !defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'mphb_sc_search_results_before_room' );

$wrapperClass = apply_filters( 'mphb_sc_search_results_room_type_class', join( ' ', mphb_tmpl_get_filtered_post_class( 'mphb-room-type' ) ) );
?>
<div class="<?php echo esc_attr( $wrapperClass ); ?>">

	<?php
	do_action( 'mphb_sc_search_results_room_top' );


	if ( $isShowGallery ) {
		\MPHB\Views\LoopRoomTypeView::renderGalleryOrFeaturedImage();
	}

	if ( $isShowImage ) {
		\MPHB\Views\LoopRoomTypeView::renderFeaturedImage();
	}

	if ( $isShowTitle ) {
		\MPHB\Views\LoopRoomTypeView::renderTitle();
	}

	if ( $isShowExcerpt ) {
		\MPHB\Views\LoopRoomTypeView::renderExcerpt();
	}

	if ( $isShowDetails ) {
		\MPHB\Views\LoopRoomTypeView::renderAttributes();
	}

	\MPHB\Views\LoopRoomTypeView::renderPriceForDates( $checkInDate, $checkOutDate );

	\MPHB\Views\LoopRoomTypeView::renderViewDetailsButton();

	\MPHB\Views\LoopRoomTypeView::renderBookButton();

	do_action( 'mphb_sc_search_results_room_bottom' );
	?>
</div>
<?php
do_action( 'mphb_sc_search_results_after_room' );
