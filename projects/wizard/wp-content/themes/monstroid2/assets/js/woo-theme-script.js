(function( $ ) {
	"use strict";

	$( document.body ).on( 'wc_fragments_refreshed wc_fragments_loaded added_to_cart', function( event ) {

		$( '.cart-contents' ).on( 'click', function() {
			$( '.site-header-cart__wrapper' ).toggleClass( 'open' );
		} );

		$( document ).on( 'click', function( e ) {
			var target = e.target;

			if ( !$( target ).is( '.site-header-cart__wrapper' ) && !$( target ).parents().is( '.site-header-cart__wrapper' ) ) {
				$( '.site-header-cart__wrapper' ).removeClass( 'open' );
			}
		} );

	} );

	$( '.tm-products-sale-end-date[data-countdown]' ).each( function() {
		var $this = $( this ), finalDate = $( this ).data( 'countdown' ), format = $( this ).data( 'format' );

		$this.countdown( finalDate, function( event ) {
			$this.html( event.strftime( format ) );
		} );
	} );


	function initQty() {
		var min = $input.attr( 'min' ),
			max = $input.attr( 'max' );

		if ( '' !== min ) {
			$input.removeAttr( 'readonly' );

			$( '.tm-qty-minus' ).on( 'click', function() {
				if ( $input.val() > min ) $input.val( $input.val() - 1 );
			} );

			$( '.tm-qty-plus' ).on( 'click', function() {
				if ( typeof max === typeof undefined || $input.val() < max || '' === max ) $input.val( parseInt( $input.val() ) + 1 );
			} );
		}
		else {
			$( '.tm-qty-minus, .tm-qty-plus' ).off( 'click' );
			$input.attr( 'readonly', 'readonly' );
		}
	}

	if ( $( 'input[type=number][name=quantity]' ).length ) {
		var $input = $( 'input[type=number][name=quantity]' );

		$input.after( '<span class="tm-qty-minus"></span><span class="tm-qty-plus"></span>' );

		$( '.variations_form ' ).find( '.single_variation' ).on( 'show_variation', function( event, variation ) {
			initQty();
		} );

		$( '.variations_form ' ).on( 'reset_data', function( event ) {
			$input.attr( 'min', '' ).val( '1' );
			initQty();
		} );

		initQty();
	}
})( jQuery );