<?php

/**
 * Display the room type default (minimal) price
 *
 * @return string
 */
function mphb_tmpl_the_room_type_default_price(){

	$rates = MPHB()->getRateRepository()->findAllActiveByRoomType( MPHB()->getCurrentRoomType()->getId() );

	if ( !empty( $rates ) ) {

		$prices = array_map( function($rate) {
			return $rate->getMinPrice();
		}, $rates );

		echo mphb_format_price( min( $prices ) );
	}
}

/**
 * Display the room type minimal price for dates
 *
 * @param \DateTime $checkInDate
 * @param \DateTime $checkOutDate
 * @return string
 */
function mphb_tmpl_the_room_type_price_for_dates( \DateTime $checkInDate, \DateTime $checkOutDate ){
	$rateAtts = array(
		'check_in_date'	 => $checkInDate,
		'check_out_date' => $checkOutDate
	);

	$rates = MPHB()->getRateRepository()->findAllActiveByRoomType( MPHB()->getCurrentRoomType()->getId(), $rateAtts );

	if ( !empty( $rates ) ) {

		$prices = array_map( function($rate) use( $checkInDate, $checkOutDate ) {
			return $rate->getMinPriceForDates( $checkInDate, $checkOutDate );
		}, $rates );

		echo mphb_format_price( min( $prices ) );
	}
}

/**
 * Retrieve dayname for key
 *
 * @param string|int $key number from 0 to 6
 * @return string
 */
function mphb_tmpl_get_day_by_key( $key ){
	return \MPHB\Utils\DateUtils::getDayByKey( $key );
}

/**
 * Retrieve the room type adults capacity
 *
 * @return int
 */
function mphb_tmpl_get_room_type_adults_capacity(){
	return MPHB()->getCurrentRoomType()->getAdultsCapacity();
}

/**
 * Retrieve the room type children capacity
 *
 * @return int
 */
function mphb_tmpl_get_room_type_children_capacity(){
	return MPHB()->getCurrentRoomType()->getChildrenCapacity();
}

/**
 * Retrieve the room type bed type
 *
 * @return string
 */
function mphb_tmpl_get_room_type_bed_type(){
	return MPHB()->getCurrentRoomType()->getBedType();
}

/**
 * Retrieve the room type comma-separated facilities
 *
 * @return string
 */
function mphb_tmpl_get_room_type_facilities(){
	return MPHB()->getCurrentRoomType()->getFacilities();
}

/**
 * Retrieve the room type size
 *
 * @return string
 */
function mphb_tmpl_get_room_type_size(){
	return MPHB()->getCurrentRoomType()->getSize( true );
}

/**
 * Retrieve the room type categories
 *
 * @return array
 */
function mphb_tmpl_get_room_type_categories(){
	return MPHB()->getCurrentRoomType()->getCategoriesArray();
}

/**
 * Retrieve the room type view
 *
 * @return string
 */
function mphb_tmpl_get_room_type_view(){
	return MPHB()->getCurrentRoomType()->getView();
}

/**
 * Check is current room type has gallery.
 *
 * @return bool
 */
function mphb_tmpl_has_room_type_gallery(){
	return MPHB()->getCurrentRoomType()->hasGallery();
}

/**
 *
 * @param bool $withFeaturedImage
 * @return array
 */
function mphb_tmpl_get_room_type_gallery_ids( $withFeaturedImage = false ){
	$roomType	 = MPHB()->getCurrentRoomType();
	$galleryIds	 = $roomType->getGalleryIds();

	if ( $withFeaturedImage && $roomType->hasFeaturedImage() ) {
		array_unshift( $galleryIds, $roomType->getFeaturedImageId() );
	}

	return $galleryIds;
}

/**
 *
 * @param array $atts @see gallery_shortcode . Additional parameters: mphb_wrap_ul - use for wrap gallery in ul, mphb_wrapper_class.
 */
function mphb_tmpl_the_room_type_galery( $atts = array() ){

	$defaultAtts = array(
		'ids' => join( ',', mphb_tmpl_get_room_type_gallery_ids() )
	);

	$atts = array_merge( $defaultAtts, $atts );

	if ( isset( $atts['link'] ) && $atts['link'] === 'post' ) {
		$forceLinkToPost = true;
		$atts['link']	 = '';
	} else {
		$forceLinkToPost = false;
	}

	$wrapperClass = 'mphb-room-type-gallery-wrapper';
	if ( isset( $atts['mphb_wrapper_class'] ) ) {
		$wrapperClass .= ' ' . $atts['mphb_wrapper_class'];
		unset( $atts['mphb_wrapper_class'] );
	}

	$galleryContent = gallery_shortcode( $atts );
	// Allow gallery in ul. Fix for flexslider
	if ( isset( $atts['mphb_wrap_ul'] ) && $atts['mphb_wrap_ul'] ) {
		$galleryContent = preg_replace( '/((?:<li.*>.*<\/li>)+)/s', '<ul class="slides">$1</ul>', $galleryContent );
	}

	if ( $forceLinkToPost ) {
		$linkToAttachmentRegExp = join( '|', array_map( function($id) {
				return preg_quote( get_the_permalink( $id ), '/' );
			}, explode( ',', $atts['ids'] ) ) );
		$linkToPost = get_the_permalink();

		if ( !empty( $linkToAttachmentRegExp ) ) {
			$galleryContent = preg_replace( '/href=["|\'](' . $linkToAttachmentRegExp . ')["|\']/', 'href="' . $linkToPost . '"', $galleryContent );
		}
	}

	$result = sprintf( '<div class="%s">', esc_attr( $wrapperClass ) );
	$result .= $galleryContent;
	$result .= '</div>';

	echo $result;
}

function mphb_tmpl_the_single_room_type_gallery(){

	$galleryAtts = array(
		'link'				 => apply_filters( 'mphb_single_room_type_gallery_image_link', 'file' ),
		'columns'			 => apply_filters( 'mphb_single_room_type_gallery_columns', '4' ),
		'size'				 => apply_filters( 'mphb_single_room_type_gallery_image_size', 'medium' ),
		'mphb_wrapper_class' => apply_filters( 'mphb_single_room_type_gallery_wrapper_class', 'mphb-single-room-type-gallery-wrapper' )
	);

	mphb_tmpl_the_room_type_galery( $galleryAtts );
}

function mphb_tmpl_the_room_type_flexslider_gallery(){

	$uniqid = uniqid();

	$sliderUniqueClass		 = 'mphb-gallery-main-slider-' . $uniqid;
	$navSliderUniqueClass	 = 'mphb-gallery-thumbnail-slider-' . $uniqid;

	$mainGalleryAtts = array(
		'link'				 => apply_filters( 'mphb_loop_room_type_gallery_main_slider_image_link', 'post' ),
		'columns'			 => apply_filters( 'mphb_loop_room_type_gallery_main_slider_columns', '1' ),
		'size'				 => apply_filters( 'mphb_loop_room_type_gallery_main_slider_image_size', 'large' ),
		'itemtag'			 => 'li',
		'icontag'			 => 'span',
		'mphb_wrap_ul'		 => true,
		'mphb_wrapper_class' => apply_filters( 'mphb_loop_room_type_gallery_main_slider_wrapper_class', 'mphb-gallery-main-slider ' . $sliderUniqueClass )
	);

	$mainGalleryFlexsliderOptions = array(
		'animation'		 => 'slide',
		'controlNav'	 => false,
		'animationLoop'	 => true,
		'smoothHeight'	 => true,
		'slideshow'		 => false
	);

	$mainGalleryFlexsliderOptions = apply_filters( 'mphb_loop_room_type_gallery_main_slider_flexslider_options', $mainGalleryFlexsliderOptions );

	mphb_tmpl_the_room_type_galery( $mainGalleryAtts );

	$isUseThumbnailsSlider = apply_filters( 'mphb_loop_room_type_gallery_use_nav_slider', true );

	if ( $isUseThumbnailsSlider ) {
		$navGalleryAtts = array(
			'link'				 => apply_filters( 'mphb_loop_room_type_gallery_nav_slider_image_size', 'large' ),
			'columns'			 => apply_filters( 'mphb_loop_room_type_gallery_nav_slider_columns', '4' ),
			'size'				 => apply_filters( 'mphb_loop_room_type_gallery_nav_slider_image_size', 'thumbnail' ),
			'itemtag'			 => 'li',
			'icontag'			 => 'span',
			'mphb_wrap_ul'		 => true,
			'mphb_wrapper_class' => apply_filters( 'mphb_loop_room_type_gallery_main_slider_wrapper_class', 'mphb-gallery-thumbnail-slider ' . $navSliderUniqueClass )
		);

		$navGalleryFlexsliderOptions = array(
			'animation'		 => 'slide',
			'controlNav'	 => false,
			'animationLoop'	 => true,
			'slideshow'		 => false,
			'itemMargin'	 => 5,
		);

		$navGalleryFlexsliderOptions = apply_filters( 'mphb_loop_room_type_gallery_nav_slider_flexslider_options', $navGalleryFlexsliderOptions );

		mphb_tmpl_the_room_type_galery( $navGalleryAtts );
	}
	?>
	<script type="text/javascript">
		document.addEventListener( "DOMContentLoaded", function( event ) {
			(function( $ ) {
				$( function() {

					var slider = $( '.<?php echo $sliderUniqueClass; ?>>.gallery' );

					var sliderAtts = <?php echo json_encode( $mainGalleryFlexsliderOptions ); ?>;

	<?php if ( $isUseThumbnailsSlider ) : ?>
						var navSlider = $( '.<?php echo $navSliderUniqueClass; ?>>.gallery' );

						var navSliderAtts = <?php echo json_encode( $navGalleryFlexsliderOptions ); ?>;

						navSliderAtts['asNavFor'] = '.<?php echo $sliderUniqueClass; ?>>.gallery';
						navSliderAtts['itemWidth'] = navSlider.find( 'ul > li img' ).width()

						sliderAtts['sync'] = ".<?php echo $navSliderUniqueClass; ?>>.gallery";

						navSlider
							.addClass( 'flexslider mphb-flexslider mphb-gallery-thumbnails-slider' )
							// The slider being synced must be initialized first
							.flexslider( navSliderAtts );
	<?php endif; ?>

					slider
						.addClass( 'flexslider mphb-flexslider mphb-gallery-slider' )
						.flexslider( sliderAtts );
				} );
			})( jQuery );
		} );
	</script>
	<?php
}

function mphb_tmpl_the_room_type_featured_image(){
	$imageExcerpt	 = get_post_field( 'post_excerpt', get_post_thumbnail_id() );
	$imageLink		 = wp_get_attachment_url( get_post_thumbnail_id() );
	$image			 = mphb_tmpl_get_room_type_image();

	printf( '<a href="%s" class="mphb-lightbox" title="%s" data-rel="magnific-popup[mphb-room-type-gallery]">%s</a>', esc_url( $imageLink ), esc_attr( $imageExcerpt ), $image );
}

/**
 * Retrieve single room type featured image
 *
 * @param int $id Optional. ID of post.
 * @param string $size Optional. Size of image.
 * @return string HTML img element or empty string on failure.
 */
function mphb_tmpl_get_room_type_image( $postID = null, $size = null ){
	if ( is_null( $postID ) ) {
		$postID = get_the_ID();
	}
	if ( is_null( $size ) ) {
		$size = apply_filters( 'mphb_single_room_type_image_size', 'large' );
	}
	$imageTitle = get_the_title( get_post_thumbnail_id( $postID ) );
	return get_the_post_thumbnail( $postID, $size, array(
		'title' => $imageTitle,
		) );
}

/**
 * Retrieve in-loop room type thumbnail
 *
 * @param string $size
 */
function mphb_tmpl_the_loop_room_type_thumbnail( $size = null ){
	if ( is_null( $size ) ) {
		$size = apply_filters( 'mphb_loop_room_type_thumbnail_size', 'post-thumbnail' );
	}
	the_post_thumbnail( $size );
}

/**
 *
 * @param string $buttonText
 */
function mphb_tmpl_the_loop_room_type_book_button( $buttonText = null ){
	if ( is_null( $buttonText ) ) {
		$buttonText = __( 'Book', 'motopress-hotel-booking' );
	}
	echo '<a class="button mphb-book-button" href="' . get_the_permalink() . '#booking-form-' . get_the_ID . '">' . $buttonText . '</a>';
}

/**
 *
 * @param string $buttonText
 */
function mphb_tmpl_the_loop_room_type_book_button_form( $buttonText = null ){
	if ( is_null( $buttonText ) ) {
		$buttonText = __( 'Book', 'motopress-hotel-booking' );
	}
	echo '<form action="' . get_the_permalink() . '#booking-form-' . get_the_ID() . '" method="get" >';
	echo '<button type="submit" class="button mphb-book-button" >' . $buttonText . '</button>';
	echo '</form>';
}

/**
 *
 * @param string $buttonText
 */
function mphb_tmpl_the_loop_room_type_view_details_button( $buttonText = null ){
	if ( is_null( $buttonText ) ) {
		$buttonText = __( 'View Details', 'motopress-hotel-booking' );
	}
	echo '<a class="button mphb-view-details-button" href="' . get_the_permalink() . '" >' . $buttonText . '</a>';
}

/**
 * Display room type calendar
 *
 * @param \MPHB\Entities\RoomType $roomType Optional. Use current room type by default.
 */
function mphb_tmpl_the_room_type_calendar( $roomType = null ){
	if ( is_null( $roomType ) ) {
		$roomType = MPHB()->getCurrentRoomType();
	}
	?>
	<div class="mphb-calendar mphb-datepick inlinePicker" id="mphb-calendar-<?php echo $roomType->getId(); ?>"></div>
	<?php
}

/**
 * Display room type reservation form
 *
 * @param \MPHB\Entities\RoomType $roomType Optional. Use current room type by default.
 */
function mphb_tmpl_the_room_reservation_form( $roomType = null ){
	if ( is_null( $roomType ) ) {
		$roomType = MPHB()->getCurrentRoomType();
	}

	$searchParameters = MPHB()->searchParametersStorage()->getForRoomType( $roomType );

	$uniqueSuffix = uniqid();
	?>
	<form method="POST" action="<?php echo MPHB()->settings()->pages()->getCheckoutPageUrl(); ?>" class="mphb-booking-form" id="booking-form-<?php echo $roomType->getId(); ?>">
		<p class="mphb-required-fields-tip"><small><?php _e( 'Required fields are followed by <abbr title="required">*</abbr>', 'motopress-hotel-booking' ); ?></small></p>
		<?php wp_nonce_field( \MPHB\Shortcodes\CheckoutShortcode::NONCE_ACTION_CHECKOUT, \MPHB\Shortcodes\CheckoutShortcode::NONCE_NAME ); ?>
		<input type="hidden" name="mphb_room_type_id" value="<?php echo $roomType->getId(); ?>" />
		<p class="mphb-check-in-date-wrapper">
			<label for="mphb_check_in_date-<?php echo $uniqueSuffix; ?>">
				<?php _e( 'Check-in Date', 'motopress-hotel-booking' ); ?>
				<abbr title="<?php printf( _x( 'Formated as %s', 'Date format tip', 'motopress-hotel-booking' ), 'mm/dd/yyyy' ); ?>">*</abbr>
			</label>
			<br />
			<input id="mphb_check_in_date-<?php echo $uniqueSuffix; ?>" type="text" class="mphb-datepick" name="mphb_check_in_date" value="<?php echo esc_attr( $searchParameters['mphb_check_in_date'] ); ?>" required="required" autocomplete="off"/>

		</p>
		<p class="mphb-check-out-date-wrapper">
			<label for="mphb_check_out_date-<?php echo $uniqueSuffix; ?>">
				<?php _e( 'Check-out Date', 'motopress-hotel-booking' ); ?>
				<abbr title="<?php printf( _x( 'Formated as %s', 'Date format tip', 'motopress-hotel-booking' ), 'mm/dd/yyyy' ); ?>">*</abbr>
			</label>
			<br />
			<input id="mphb_check_out_date-<?php echo $uniqueSuffix; ?>" type="text" class="mphb-datepick" name="mphb_check_out_date" value="<?php echo esc_attr( $searchParameters['mphb_check_out_date'] ); ?>" required="required" autocomplete="off"/>
		</p>
		<p class="mphb-adults-wrapper">
			<label for="mphb_adults-<?php echo $uniqueSuffix; ?>">
				<?php _e( 'Adults', 'motopress-hotel-booking' ); ?>
				<abbr title="<?php _e( 'Required', 'motopress-hotel-booking' ); ?>">*</abbr>
			</label>
			<br />
			<select id="mphb_adults-<?php echo $uniqueSuffix; ?>" name="mphb_adults" required="required">
				<?php foreach ( range( MPHB()->settings()->main()->getMinAdults(), $roomType->getAdultsCapacity() ) as $value ) { ?>
					<option value="<?php echo $value; ?>" <?php selected( (string) esc_attr( $searchParameters['mphb_adults'] ), (string) $value ); ?>><?php echo $value; ?></option>
				<?php } ?>
			</select>
		</p>
		<p class="mphb-check-children-date-wrapper">
			<label for="mphb_children-<?php echo $uniqueSuffix; ?>">
				<?php _e( 'Children', 'motopress-hotel-booking' ); ?>
				<abbr title="<?php _e( 'Required', 'motopress-hotel-booking' ); ?>">*</abbr>
			</label>
			<br />
			<select id="mphb_children-<?php echo $uniqueSuffix; ?>" name="mphb_children" required="required">
				<?php foreach ( range( 0, $roomType->getChildrenCapacity() ) as $value ) { ?>
					<option value="<?php echo $value; ?>" <?php selected( esc_attr( (string) $searchParameters['mphb_children'] ), (string) $value ); ?>><?php echo $value; ?></option>
				<?php } ?>
			</select>

		</p>
		<div class="mphb-errors-wrapper mphb-hide"></div>
		<p class="mphb-reserve-btn-wrapper">
			<input class="mphb-reserve-btn button" disabled="disabled" type="submit" value="<?php _e( 'Reserve Room', 'motopress-hotel-booking' ); ?>" />
			<span class="mphb-preloader mphb-hide"></span>
		</p>
	</form>
	<?php
}

/**
 * Retrieve in-loop service thumbnail
 *
 * @param string $size
 */
function mphb_tmpl_the_loop_service_thumbnail( $size = null ){
	if ( is_null( $size ) ) {
		$size = apply_filters( 'mphb_loop_service_thumbnail_size', 'post-thumbnail' );
	}
	the_post_thumbnail( $size );
}

function mphb_tmpl_the_service_price(){
	$service = MPHB()->getServiceRepository()->findById( get_the_ID() );
	echo $service ? $service->getPriceWithConditions() : '';
}

/**
 * Retrieve the classes for the post div as an array.
 *
 * @param string|array $class   One or more classes to add to the class list.
 * @param int|WP_Post  $post_id Optional. Post ID or post object.
 * @return array Array of classes.
 */
function mphb_tmpl_get_filtered_post_class( $class = '', $postId = null ){
	$classes = get_post_class( $class, $postId );
	if ( false !== ( $key	 = array_search( 'hentry', $classes ) ) ) {
		unset( $classes[$key] );
	}
	return $classes;
}
