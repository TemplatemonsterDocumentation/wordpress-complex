<?php
/**
 * Content fullwidth view at moto booking pages
 *
 * @return array
 */

add_filter( 'monstroid2_content_classes', 'monstroid2_skin5_mphb_fullwidth_content_classes' );

function monstroid2_skin5_mphb_fullwidth_content_classes( $content_layout_classes ) {

	$whitelist_post_types = array(
		'mphb_room_type',
		'mphb_room_service',
		'mphb_booking',
		'mphb_room'
	);

	if ( in_array( get_post_type(), $whitelist_post_types ) ) {
			$content_layout_classes = array(
				'col-xs-12',
				'col-lg-12'
			);
	}

	return $content_layout_classes;
}

/**
 * Disable sidebar at moto booking pages
 *
 * @return string
 */
add_filter( 'theme_mod_sidebar_position', 'monstroid2_skin5_mphb_fullwidth_sidebar_position' );

function monstroid2_skin5_mphb_fullwidth_sidebar_position( $sidebar_position ) {

	$whitelist_post_types = array(
		'mphb_room_type',
		'mphb_room_service',
		'mphb_booking',
		'mphb_room'
	);

	if ( in_array( get_post_type(), $whitelist_post_types ) ) {
			$sidebar_position = 'fullwidth';
	}

	return $sidebar_position;
}

/**
 * Disable default cherry gallery parsing for moto booking galleries
 *
 * @return bool
 */
add_filter( 'cherry_pre_get_gallery_shortcode', 'monstroid2_skin5_disable_cherry_galleries_for_moto_booking', 12, 3 );

function monstroid2_skin5_disable_cherry_galleries_for_moto_booking( $bool, $attr, $gallery ) {

	if ( ( 'mphb_room_type' == get_post_type() ) || ( 'mphb_room_type' == get_post_type() && is_single() ) ) {
		return;
	}

	return $bool;
}

/**
 * Change moto booking templates structure & logic
 *
 * @return string
 */
add_filter( 'mphb_template_path', 'monstroid2_skin5_mphb_change_templates', 20 );

function monstroid2_skin5_mphb_change_templates() {
	return '/skins/skin5/motopress-booking/';
}

/**
 * Change moto booking templates structure / loop rooms type shortcode
 *
 * @return string
 */

remove_action( 'mphb_render_loop_room_type_before_attributes',          array( '\MPHB\Views\LoopRoomTypeView', '_renderAttributesTitle' ), 10 );

remove_action( 'mphb_render_loop_room_type_before_view_details_button', array( '\MPHB\Views\LoopRoomTypeView', '_renderViewDetailsButtonParagraphOpen' ), 10 );
remove_action( 'mphb_render_loop_room_type_after_view_details_button',  array( '\MPHB\Views\LoopRoomTypeView', '_renderViewDetailsButtonParagraphClose' ), 10 );

remove_action( 'mphb_render_loop_room_type_before_price',               array( '\MPHB\Views\LoopRoomTypeView', '_renderPriceParagraphOpen' ), 10 );
remove_action( 'mphb_render_loop_room_type_before_price',               array( '\MPHB\Views\LoopRoomTypeView', '_renderPriceTitle' ), 20 );
remove_action( 'mphb_render_loop_room_type_after_price',                array( '\MPHB\Views\LoopRoomTypeView', '_renderPriceParagraphClose' ), 10 );

remove_action( 'mphb_render_loop_room_type_before_book_button',         array( '\MPHB\Views\LoopRoomTypeView', '_renderBookButtonWrapperOpen' ), 10 );
remove_action( 'mphb_render_loop_room_type_after_book_button',          array( '\MPHB\Views\LoopRoomTypeView', '_renderBookButtonWrapperClose' ), 20 );

add_action( 'mphb_render_loop_room_type_before_price', 'monstroid2_skin5_mphb_loop_room_type_change_renderPriceTitle', 20 );
add_action( 'mphb_render_loop_room_type_before_price', 'monstroid2_skin5_mphb_price_block_add_open_tag', 21 );
add_action( 'mphb_render_loop_room_type_after_price',  'monstroid2_skin5_mphb_price_block_add_close_tag', 6 );
add_action( 'mphb_render_loop_room_type_after_price',  'monstroid2_skin5_mphb_loop_room_type_add_price_suffix', 5 );


function monstroid2_skin5_mphb_loop_room_type_change_renderPriceTitle() {
	echo '<h4 class="mphb-price-title">' . esc_html__( 'Prices start at', 'monstroid2' ) . '</h4>';
}

function monstroid2_skin5_mphb_loop_room_type_add_price_suffix() {
	echo '<span class="mphb-price-suffix h5-style">' . esc_html__( '/per night', 'monstroid2' ) . '</span>';
}

function monstroid2_skin5_mphb_price_block_add_open_tag() {
	echo '<div class="mphb-price-wrapper">';
}

function monstroid2_skin5_mphb_price_block_add_close_tag() {
	echo '</div>';
}

function monstroid2_skin5_mphb_tmpl_the_room_type_flexslider_gallery( $size, $thumb, $thumb_size = 'post-thumbnail' ) {
		$uniqid = uniqid();
		$sliderId = 'mphb-gallery-slider-' . $uniqid;
		$image_link = '';

		if ( $thumb ) {
			$thumbSliderId = 'mphb-gallery-thumbnail-slider-' . $uniqid;
		}

		if ( is_single() ) {
			$image_link = 'file';
		}
	?>

	<div id="<?php echo $sliderId; ?>" class="mphb-room-type-gallery">
		<?php mphb_tmpl_the_room_type_galery(array(
			'size'         => $size,
			'itemtag'      => 'li',
			'icontag'      => 'span',
			'link'         => $image_link,
			'mphb_wrap_ul' => true
		)); ?>
	</div>

	<?php if ( $thumb ) { ?>
		<div id="<?php echo $thumbSliderId; ?>" class="mphb-room-type-gallery-thumbs">
			<?php mphb_tmpl_the_room_type_galery(array(
				'size'         => $thumb_size,
				'itemtag'      => 'li',
				'icontag'      => 'span',
				'columns'      => '6',
				'mphb_wrap_ul' => true
			)); ?>
		</div>
	<?php }
}

/**
 * Change moto booking services shortcode thumbnail size
 *
 * @return string
 */

add_filter( 'mphb_loop_service_thumbnail_size', 'monstroid2_skin5_mphb_change_services_thumbnail' );

function monstroid2_skin5_mphb_change_services_thumbnail( $size ) {

	return 'monstroid2-thumb-m-2';
}

/**
 * Change moto booking templates structure / services shortcode
 *
 * @return string
 */

add_action( 'mphb_sc_services_service_details', 'monstroid2_skin5_mphb_services_add_content_open_tag', 11 );
add_action( 'mphb_sc_services_service_details', 'monstroid2_skin5_mphb_services_add_content_close_tag', 41 );

remove_action( 'mphb_render_loop_service_before_price', array( '\MPHB\Views\LoopServiceView', '_renderPriceTitle' ), 20);
remove_action( 'mphb_render_loop_service_before_price', array( '\MPHB\Views\LoopServiceView', '_renderPriceParagraphOpen' ), 10 );
remove_action( 'mphb_render_loop_service_after_price',  array( '\MPHB\Views\LoopServiceView', '_renderPriceParagraphClose' ), 10 );

add_action( 'mphb_render_loop_service_before_price', 'monstroid2_skin5_mphb_services_add_title_logic', 10);
add_action( 'mphb_render_loop_service_after_price',  'monstroid2_skin5_mphb_services_add_button', 15 );

add_action( 'mphb_render_loop_service_before_price', 'monstroid2_skin5_mphb_price_block_add_open_tag', 15 );
add_action( 'mphb_render_loop_service_after_price',  'monstroid2_skin5_mphb_price_block_add_close_tag', 10 );

add_action( 'mphb_render_loop_service_before_price', 'monstroid2_skin5_mphb_services_price_block_add_suffix_open_tag', 25 );
add_action( 'mphb_render_loop_service_after_price',  'monstroid2_skin5_mphb_services_price_block_add_suffix_close_tag', 5 );

remove_action( 'mphb_render_single_service_before_price', array( '\MPHB\Views\SingleServiceView', '_renderPriceTitle' ), 10 );
remove_action( 'mphb_render_single_service_before_price', array( '\MPHB\Views\SingleServiceView', '_renderPriceParagraphOpen' ), 20 );
remove_action( 'mphb_render_single_service_after_price', array( '\MPHB\Views\SingleServiceView', '_renderPriceParagraphClose' ), 10 );

add_action( 'mphb_render_single_service_before_price', 'monstroid2_skin5_mphb_services_add_title_logic', 10);
add_action( 'mphb_render_single_service_before_price', 'monstroid2_skin5_mphb_price_block_add_open_tag', 20 );
add_action( 'mphb_render_single_service_after_price', 'monstroid2_skin5_mphb_price_block_add_close_tag', 10 );

add_action( 'mphb_render_single_service_before_price', 'monstroid2_skin5_mphb_services_price_block_add_suffix_open_tag', 25 );
add_action( 'mphb_render_single_service_after_price',  'monstroid2_skin5_mphb_services_price_block_add_suffix_close_tag', 5 );

function monstroid2_skin5_mphb_services_add_content_open_tag() {
	echo '<div class="mphb-service__content">';
}

function monstroid2_skin5_mphb_services_add_content_close_tag() {
	echo '</div>';
}

function monstroid2_skin5_mphb_services_add_title_logic() {
	$price = get_post_meta( get_the_ID(), 'mphb_price', true );

	if ( '0' < $price ) {
		echo '<h4 class="mphb-service__price-title">' . esc_html__( 'Price', 'monstroid2' ) . '</h4>';
	}
}

function monstroid2_skin5_mphb_services_add_button() {
	echo '<a class="btn" href="' . get_permalink() . '">' . esc_html__( 'Read More', 'monstroid2' ) . '</a>';
}

function monstroid2_skin5_mphb_services_price_block_add_suffix_open_tag() {
	echo '<span class="mphb-price-suffix h5-style">';
}

function monstroid2_skin5_mphb_services_price_block_add_suffix_close_tag() {
	echo '</span>';
}

/**
 * Change moto booking templates structure / single room
 *
 * @return string
 */

remove_action( 'mphb_render_single_room_type_before_attributes',       array( '\MPHB\Views\SingleRoomTypeView', '_renderAttributesTitle' ), 10 );
remove_action( 'mphb_render_single_room_type_before_calendar',         array( '\MPHB\Views\SingleRoomTypeView', '_renderCalendarTitle' ), 10 );
remove_action( 'mphb_render_single_room_type_before_reservation_form', array( '\MPHB\Views\SingleRoomTypeView', '_renderReservationFormTitle' ), 10 );
remove_action( 'mphb_render_single_room_type_before_price',            array( '\MPHB\Views\SingleRoomTypeView', '_renderPriceTitle' ), 20 );
remove_action( 'mphb_render_single_room_type_before_price',            array( '\MPHB\Views\SingleRoomTypeView', '_renderPriceParagraphOpen' ), 10 );
remove_action( 'mphb_render_single_room_type_after_price',             array( '\MPHB\Views\SingleRoomTypeView', '_renderPriceParagraphClose' ), 10 );

add_action( 'mphb_render_single_room_type_before_attributes',       'monstroid2_skin5_mphb_single_add_description', 5 );
add_action( 'mphb_render_single_room_type_before_attributes',       'monstroid2_skin5_mphb_single_change_attributes_title', 10 );
add_action( 'mphb_render_single_room_type_before_calendar',         'monstroid2_skin5_mphb_single_change_calendar_title', 10 );
add_action( 'mphb_render_single_room_type_before_reservation_form', 'monstroid2_skin5_mphb_single_change_reservation_title', 10 );

add_action( 'mphb_render_single_room_type_before_price',            'monstroid2_skin5_mphb_loop_room_type_change_renderPriceTitle', 20 );
add_action( 'mphb_render_single_room_type_before_price',            'monstroid2_skin5_mphb_price_block_add_open_tag', 10 );
add_action( 'mphb_render_single_room_type_after_price',             'monstroid2_skin5_mphb_price_block_add_close_tag', 10 );
add_action( 'mphb_render_single_room_type_after_price',             'monstroid2_skin5_mphb_loop_room_type_add_price_suffix', 5 );

function monstroid2_skin5_mphb_single_add_description() {
	printf(
		'<h4 class="mphb-room-description-title">%s</h4><div class="mphb-room-description">%s</div>',
		esc_html__( 'Description', 'monstroid2' ),
		wpautop( get_the_content() )
	);
}

function monstroid2_skin5_mphb_single_change_attributes_title() {
	printf(
		'<h4 class="mphb-room-attributes-title">%s</h4>',
		esc_html__( 'Room Details', 'monstroid2' )
	);
}

function monstroid2_skin5_mphb_single_change_calendar_title() {
	printf(
		'<h4 class="mphb-room-calendar-title">%s</h4>',
		esc_html__( 'Room Availability', 'monstroid2' )
	);
}

function monstroid2_skin5_mphb_single_change_reservation_title() {
	printf(
		'<h4 class="mphb-room-reservation-title">%s</h4>',
		esc_html__( 'Reservation Form', 'monstroid2' )
	);
}

remove_action( 'mphb_render_single_room_type_after_gallery', array( 'MPHBSingleRoomTypeView', '_enqueueGalleryScripts' ), 10 );

add_action( 'mphb_render_single_room_type_after_gallery', 'monstroid2_skin5_enqueueGalleryScripts', 10 );

function monstroid2_skin5_enqueueGalleryScripts() {
	wp_enqueue_script( 'mphb-flexslider' );
	wp_enqueue_style( 'mphb-flexslider-css' );
}

/* Rooms shortcode */
remove_action( 'mphb_sc_rooms_render_image', array( '\MPHB\Views\LoopRoomTypeView', 'renderGalleryOrFeaturedImage' ) );

add_action( 'mphb_sc_rooms_render_image', 'monstroid2_skin5_mphb_loop_rooms_renderGalleryOrFeaturedImage' );
add_action( 'mphb_sc_rooms_room_type_details', 'monstroid2_skin5_enqueueGalleryScripts', 10 );

add_action( 'mphb_sc_rooms_room_type_details', 'monstroid2_skin5_mphb_loop_rooms_open_content_tag', 11 );
add_action( 'mphb_sc_rooms_room_type_details', 'monstroid2_skin5_mphb_loop_rooms_close_content_tag', 71 );

function monstroid2_skin5_mphb_loop_rooms_renderGalleryOrFeaturedImage() {
	$roomType = MPHB()->getCurrentRoomType();
	if ( $roomType->hasGallery() ) {
		monstroid2_skin5_mphb_tmpl_the_room_type_flexslider_gallery( 'monstroid2-thumb-m-2', false );
	} else {
		mphb_tmpl_the_room_type_featured_image();
	}
}

function monstroid2_skin5_mphb_loop_rooms_open_content_tag() {
	echo '<div class="mphb-room-type__content">';
}
function monstroid2_skin5_mphb_loop_rooms_close_content_tag() {
	echo '</div>';
}

/* Search results */
remove_action( 'mphb_sc_search_results_room_form', array( 'MPHBShortcodeSearchResult', 'renderGallery'), 10 );
add_action( 'mphb_sc_search_results_room_form', 'monstroid2_skin5_mphb_search_results_gallery', 10 );

function monstroid2_skin5_mphb_search_results_gallery() {
	monstroid2_skin5_mphb_tmpl_the_room_type_flexslider_gallery( 'monstroid2-thumb-m-2', false );
}

add_action( 'mphb_sc_search_results_room_form', 'monstroid2_skin5_mphb_loop_rooms_open_content_tag', 11 );
add_action( 'mphb_sc_search_results_room_form', 'monstroid2_skin5_mphb_loop_rooms_close_content_tag', 71 );

add_filter( 'widget_title', 'monstroid2_skin5_mphb_search_widget_empty_default_title', 12, 3 );

function monstroid2_skin5_mphb_search_widget_empty_default_title( $title, $instance, $id_base ) {

	if ( 'mphb_search_availability_widget' == $id_base ||
		 'mphb_rooms_widget' == $id_base ) {

		if ( '' == $instance['title'] ) {
			return $title = '';
		}
	}

	return $title;
}

/**
 * Get mphb taxonomies
 *
 * @return array
 */
function monstroid2_skin5_mphb_get_list_taxonomies( $type ) {

	$typeLink = get_term_link( $type );

	if ( is_wp_error( $typeLink ) ) {
		$typeLink = '#';
	}

	return sprintf( '<a href="%s">%s</a>', $typeLink, $type->name );
}
