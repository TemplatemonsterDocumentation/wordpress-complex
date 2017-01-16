( function ( $ ) {
	$( '.tm-categories-carousel-widget-container' ).each( function() {
		var swiper             = null,
			uniqId             = $( this ).data( 'uniq-id' ),
			slidesPerView      = parseFloat( $( this ).data( 'slides-per-view' ) ),
			slidesPerGroup     = parseFloat( $( this ).data( 'slides-per-group' ) ),
			slidesPerColumn    = parseFloat( $( this ).data( 'slides-per-column' ) ),
			spaceBetweenSlides = parseFloat( $( this ).data( 'space-between-slides' ) ),
			durationSpeed      = parseFloat( $( this ).data( 'duration-speed' ) ),
			swiperLoop         = $( this ).data( 'swiper-loop' ),
			freeMode           = $( this ).data( 'free-mode' ),
			grabCursor         = $( this ).data( 'grab-cursor' ),
			mouseWheel         = $( this ).data( 'mouse-wheel' );

		swiper = new Swiper( '#' + uniqId, {
				slidesPerView:       slidesPerView,
				slidesPerGroup:      slidesPerGroup,
				slidesPerColumn:     slidesPerColumn,
				spaceBetween:        spaceBetweenSlides,
				speed:               durationSpeed,
				loop:                swiperLoop,
				freeMode:            freeMode,
				grabCursor:          grabCursor,
				mousewheelControl:   mouseWheel,
				paginationClickable: true,
				nextButton:          '#' + uniqId + '-next',
				prevButton:          '#' + uniqId + '-prev',
				pagination:          '#' + uniqId + '-pagination',
				threshold:           5,
				onInit:              function() {
					$( '#' + uniqId + '-next' ).css( {
						'display': 'block'
					} );
					$( '#' + uniqId + '-prev' ).css( {
						'display': 'block'
					} );
				},
				breakpoints:         {
					992: {
						slidesPerView: Math.ceil( slidesPerView * 0.75 ),
						spaceBetween:  Math.ceil( spaceBetweenSlides * 0.75 )
					},
					768: {
						slidesPerView: Math.ceil( slidesPerView * 0.5 ),
						spaceBetween:  Math.ceil( spaceBetweenSlides * 0.5 )
					},
					480: {
						slidesPerView: Math.ceil( slidesPerView * 0.25 ),
						spaceBetween:  Math.ceil( spaceBetweenSlides * 0.25 )
					}
				}
			}
		);
	} );
} )( jQuery );