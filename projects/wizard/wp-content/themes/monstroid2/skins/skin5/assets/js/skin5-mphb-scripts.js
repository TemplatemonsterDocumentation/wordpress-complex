(function( $ ) {
	"use strict";

	CherryJsCore.utilites.namespace( 'skin5_mphb_script' );
	CherryJsCore.skin5_mphb_script = {
		init: function() {
			// Document ready event check
			if ( CherryJsCore.status.is_ready ) {
				this.document_ready_render();
			} else {
				CherryJsCore.variable.$document.on( 'ready', this.document_ready_render.bind( this ) );
			}

			// Windows load event check
			if ( CherryJsCore.status.on_load ) {
				this.window_load_render();
			} else {
				CherryJsCore.variable.$window.on( 'load', this.window_load_render.bind( this ) );
			}
		},

		document_ready_render: function() {
			this.mphb_availability_script( this );
			this.mphb_gallery_script( this );
			this.mphb_gallery_magnific_script( this );
		},

		window_load_render: function() {},

		mphb_availability_script: function( self ) {

			$( '.mphb_sc_search-wrapper' ).each( function() { // Check this custom class, moto must fix it

				var $form            = $( '.mphb_sc_search-form', $(this) ),

					// Date picker inputs
					$checkDateBox    = $( '.mphb_sc_search-check-in-date, .mphb_sc_search-check-out-date', $form ),
					$checkInDateBox  = $( '.mphb_sc_search-check-in-date', $form ),
					$checkOutDateBox = $( '.mphb_sc_search-check-out-date', $form ),
					$checkInDate,
					$checkOutDate,

					// Selects
					$selectBox      = $( '.mphb_sc_search-adults, .mphb_sc_search-children', $form ),
					$adultSelectBox = $( '.mphb_sc_search-adults', $form ),
					$childSelectBox = $( '.mphb_sc_search-children', $form );

				formManipulations( 'date', $checkDateBox );
				formManipulations( 'select', $selectBox );

				function formManipulations( type, selector ) {
					selector.each( function() {

						if ( 'date' == type ) {

							var $checkDateInput   = $( 'input', $(this) ),
								$checkDateInputID = $checkDateInput.attr( 'id' ),
								$checkOnLoadLabel = $checkDateInput.attr( 'placeholder' ),
								$onLoadDate       = $checkDateInput.attr( 'value' ).split('/'),
								$checkDate,
								$onLoadDay        = '',
								$onLoadMonth      = '',
								$onLoadYear       = '';

							// Check if date is already set
							if ( $onLoadDate != '' ) {
								$onLoadDay        = $onLoadDate[1].replace( /^0+/, '' );
								$onLoadMonth      = '/' + monstroid2_skin5_mphb.months[$onLoadDate[0].replace( /^0+/, '' )];
								$onLoadYear       = '\'' + $onLoadDate[2].slice( 2 );
								$checkOnLoadLabel = '';
							}

							// DOM manipulation
							var $checkShowingForm = $( '.showing-form', $(this) );

							$( '.on-load-label', $checkShowingForm ).text( $checkOnLoadLabel );
							$( '.day', $checkShowingForm ).text( $onLoadDay );
							$( '.month', $checkShowingForm ).text( $onLoadMonth );
							$( '.year', $checkShowingForm ).text( $onLoadYear );

							// Show original form if new form clicked
							$checkShowingForm.on( 'click', function( event ) {
								$checkDateInput.focus();

								if ( ! $( this ).hasClass('active') ) { // Add active class
									$( this ).addClass('active');
								} else {
									$( this ).removeClass('active');
								}
							} );

						} else {

							// Selects logic
							var $checkShowingForm = $( '.showing-form', $(this) );

							$checkShowingForm.find( 'select' ).styler();

						}

						$form.removeClass( 'loading' );

					} );
				}

				$( 'body' ).on( 'click', '.datepick-popup .datepick-month a', function() {
					$checkInDate  = $( 'input.mphb_check_in_date' ).attr( 'value' ).split('/');
					$checkOutDate = $( 'input.mphb_check_out_date' ).attr( 'value' ).split('/');

					if ( $checkInDate != '' ) {
						$( '.on-load-label', $checkInDateBox ).empty();

						$( '.day', $checkInDateBox ).text( $checkInDate[1].replace(/^0+/, '') );
						$( '.month', $checkInDateBox ).text( '/' + monstroid2_skin5_mphb.months[$checkInDate[0].replace(/^0+/, '')] );
						$( '.year', $checkInDateBox ).text( '\'' + $checkInDate[2].slice( 2 ) );
					}

					if ( $checkOutDate != '' ) {
						$( '.on-load-label', $checkOutDateBox ).empty();

						$( '.day', $checkOutDateBox ).text( $checkOutDate[1].replace(/^0+/, '') );
						$( '.month', $checkOutDateBox ).text( '/' + monstroid2_skin5_mphb.months[$checkOutDate[0].replace(/^0+/, '')] );
						$( '.year', $checkOutDateBox ).text( '\'' + $checkOutDate[2].slice( 2 ) );
					}

					if ( $( '.showing-form' ).hasClass( 'active' ) ) { // After choose date, remove active class
						$( '.showing-form' ).removeClass( 'active' );
					}
				} );

				$( 'body' ).on( 'click', function( event ) {
					if ( $( '.showing-form' ).hasClass( 'active' ) ) { // Check if showing form is active

						if ( ! $(event.target).hasClass( 'showing-form' ) && ! $(event.target.offsetParent).hasClass( 'showing-form' ) ) { // Check for click outside showing form parts

							if ( ! $(event.target).parents('.datepick-popup').length > 0 ) { // Check for click outside date pickup parts

								$( '.showing-form' ).removeClass( 'active' ) // Remove active class
							}
						}
					}
				} );

			} );

		},

		mphb_gallery_script: function() {
			if ( $( '.mphb-room-type-gallery-thumbs' )[0] ) {
				var navSlider = $(' > div ', '.mphb-room-type-gallery-thumbs' );
			}

			var slider = $( '.mphb-room-type-gallery > div' );

			if ( $( '.mphb-room-type-gallery-thumbs' )[0] ) {
				var navSliderItemWidth = navSlider.find('ul > li img').width();

				navSlider.addClass('flexslider mphb-flexslider mphb-gallery-thumbnails-slider').flexslider({
					animation: "slide",
					controlNav: false,
					animationLoop: true,
					slideshow: false,
					itemWidth: navSliderItemWidth,
					itemMargin: 0,
					asNavFor: '.mphb-room-type-gallery > div',
				});
			}

			if ( $( '.mphb-room-type-gallery' )[0] ) {
				slider.addClass('flexslider mphb-flexslider mphb-gallery-slider').flexslider({
					animation: "slide",
					controlNav: false,
					animationLoop: true,
					smoothHeight: true,
					slideshow: false,
					sync: '.mphb-room-type-gallery-thumbs > div ',
				});
			}

		},

		mphb_gallery_magnific_script: function() {
			var galleryItems = $(".mphb-room-type-gallery .flex-viewport .gallery-item a");

				if ( galleryItems.length && $.magnificPopup ) {
					galleryItems.magnificPopup({
						type: 'image',
						gallery: {
							enabled:true
						}
					});
				}
		},

	};
	CherryJsCore.skin5_mphb_script.init();

}( jQuery ));
