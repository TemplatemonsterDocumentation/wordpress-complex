/* global jssor_options */

jQuery(function ($) {

	$.fn.productImgPreload = function() {
		this.each(function(){
			$('<img/>')[0].src = this;
		});
	};

	var $easyzoom = $( '.single_product_wrapper .images .easyzoom' ).easyZoom(),
		easyZoomApi = $easyzoom.data('easyZoom'),
		items = [],
		index,
		thumb = $( '.single_product_wrapper .images .thumbnails .thumbnail' ),
		enlarge = $( '.single_product_wrapper .images .enlarge' ),
		zoom_enabled = true;
	if( thumb.length ) {
		thumb.eq(0).addClass( 'selected' );
		var preloadHref = [];
		preloadHref[0] = thumb.eq(0).data( 'href' );
		if( thumb.eq(1) ){
			preloadHref[1] = thumb.eq(1).data( 'thumb');
			preloadHref[2] = thumb.eq(1).data( 'href');
		}
		$( preloadHref ).productImgPreload();
		thumb.each( function() {
			items.push( {
				src: $( this ).data( 'href' )
			} );
			$( this ).on( 'click', function() {
				thumb.removeClass( 'selected' );
				$this = $( this );
				$this.addClass( 'selected' );
				if( easyZoomApi ) {
					easyZoomApi.teardown();
				}
				zoom_enabled = false;
				$( '.woocommerce-main-image' ).attr( {
					href: $this.data( 'href' )
				} ).find( 'img' ).attr( {
					src: $this.data( 'thumb' ),
					srcset: $this.find( 'img' ).attr( 'srcset' ),
					title: $this.find( 'img' ).attr( 'title' ),
					alt: $this.find( 'img' ).attr( 'alt' )
				} );
				zoom();
				index = $this.index();
				open_popup( index );
				preloadHref = [];
				preloadHref[0] = $this.data( 'href' );
				if( $this.next().length ){
					preloadHref[1] = $this.next().data( 'thumb');
					preloadHref[2] = $this.next().data( 'href');
				}
				 else if( $this.prev().length ){
					preloadHref[1] = $this.prev().data( 'thumb');
					preloadHref[2] = $this.prev().data( 'href');
				}
				$( preloadHref ).productImgPreload();
			} );
		} );
	}

	function open_popup( index ) {
		enlarge.on( 'click', function() {
			$this = $( this );
			$.magnificPopup.open( {
				items: items,
				gallery: {
					enabled: true,
					preload: [1,1]
				},
				type: 'image'
			}, index );
		} );
	}

	open_popup( 0 );

	function zoom() {

		if ( 768 > Math.min( $( window ).width(), screen.width ) ) {
			if( true === zoom_enabled && easyZoomApi ) {
				easyZoomApi.teardown();
				zoom_enabled = false;
			}
		} else {
			if( false === zoom_enabled && easyZoomApi ) {
				easyZoomApi._init();
				zoom_enabled = true;
			}
		}
	}

	zoom();
	$( window ).on( "resize orientationchange", zoom );

} );