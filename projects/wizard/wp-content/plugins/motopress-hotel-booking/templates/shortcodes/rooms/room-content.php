<?php
/**
 *
 * Avaialable variables
 * - bool $isShowImage
 * - bool $isShowTitle
 * - bool $isShowExcerpt
 * - bool $isShowDetails
 * - bool $isShowPrice
 * - bool $isShowViewButton
 * - bool $isShowBookButton
 *
 */
if ( !defined( 'ABSPATH' ) ) {
	exit;
}
$wrapperClass = apply_filters( 'mphb_sc_rooms_item_wrapper_class', join( ' ', mphb_tmpl_get_filtered_post_class( 'mphb-room-type' ) ) );
?>

<div class="<?php echo esc_attr( $wrapperClass ); ?>">

	<?php
	do_action( 'mphb_sc_rooms_item_top' );

	if ( $isShowImage ) {
		/**
		 * @hooked \MPHB\Views\LoopRoomTypeView::renderGalleryOrFeaturedImage - 10
		 */
		do_action( 'mphb_sc_rooms_render_image' );
	}
	if ( $isShowTitle ) {
		/**
		 * @hooked \MPHB\Views\LoopRoomTypeView::renderTitle - 10
		 */
		do_action( 'mphb_sc_rooms_render_title' );
	}
	if ( $isShowExcerpt ) {
		/**
		 * @hooked \MPHB\Views\LoopRoomTypeView::renderExcerpt - 10
		 */
		do_action( 'mphb_sc_rooms_render_excerpt' );
	}
	if ( $isShowDetails ) {
		/**
		 * @hooked \MPHB\Views\LoopRoomTypeView::renderAttributes - 10
		 */
		do_action( 'mphb_sc_rooms_render_details' );
	}
	if ( $isShowPrice ) {
		/**
		 * @hooked \MPHB\Views\LoopRoomTypeView::renderPrice - 10
		 */
		do_action( 'mphb_sc_rooms_render_price' );
	}

	if ( $isShowViewButton ) {
		/**
		 * @hooked \MPHB\Views\LoopRoomTypeView::renderVViewDetailsButton - 10
		 */
		do_action( 'mphb_sc_room_render_view_button' );
	}

	if ( $isShowBookButton ) {
		/**
		 * @hooked \MPHB\Views\LoopRoomTypeView::renderBookButton - 10
		 */
		do_action( 'mphb_sc_rooms_render_book_button' );
	}

	do_action( 'mphb_sc_rooms_item_bottom' );
	?>
</div>

