( function( $ ) {
	'use strict';

	$( document ).ready( function() {

		$( 'button.tm-woocompare-button' ).each( function() {

			var button = $( this );

			button.on( 'click', function ( event ) {

				event.preventDefault();

				var url = tmWoocompare.ajaxurl,
					data = {
						action: 'tm_woocompare_add_to_list',
						pid:    button.data( 'id' ),
						nonce:  button.data( 'nonce' )
					};

				button.removeClass( 'added in_compare' ).addClass( 'loading' );

				$.post(
					url,
					data,
					function( response ) {

						button.removeClass( 'loading' );

						if( response.success ) {

							switch ( response.data.action ) {

								case 'add-to-list':

									button.addClass( 'added in_compare' ).find( '.text' ).text( tmWoocompare.removeText );
									if( tmWoocompare.isSingle ) {
										button.after( response.data.comparePageBtn );
									}
									break;

								case 'remove-from-list':

									button.removeClass( 'added in_compare' ).find( '.text' ).text( tmWoocompare.compareText );
									$( '.tm-woocompare-page-button' ).remove();
									break;

								default:
									break;
							}
							var data = {
								action: 'tm_woocompare_update'
							};
							tmWoocompareAjax( null, data );
						}
					}
				);
			} );
		} );

		function tmWoocompareAjax( event, data ) {

			if( event ) {
				event.preventDefault();
			}

			var url           = tmWoocompare.ajaxurl,
				widgetWrapper = $( 'div.tm-woocompare-widget-wrapper' ),
				compareList   = $( 'div.tm-woocompare-list' );

			data.isComparePage = !!compareList.length;
			data.isWidget      = !!widgetWrapper.length;

			if ( 'tm_woocompare_update' === data.action && !data.isComparePage && !data.isWidget ) {
				return;
			}
			compareList.addClass( 'loading' );
			widgetWrapper.addClass( 'loading' );

			$.post(
				url,
				data,
				function( response ) {

					compareList.removeClass( 'loading' );
					widgetWrapper.removeClass( 'loading' );

					if( response.success ) {

						if( data.isComparePage ) {

							$( 'div.tm-woocompare-wrapper' ).html( response.data.compareList );
							$( document ).trigger( "enhance.tablesaw" );
						}
						if( data.isWidget ) {

							widgetWrapper.html( response.data.widget );
						}
						if ( 'tm_woocompare_empty' === data.action ) {

							$( 'button.tm-woocompare-button' ).removeClass( 'added in_compare' ).find( '.text' ).text( tmWoocompare.compareText );
							$( '.tm-woocompare-page-button' ).remove();
						}
						if ( 'tm_woocompare_remove' === data.action ) {

							$( 'button.tm-woocompare-button[data-id=' + data.pid + ']' ).removeClass( 'added in_compare' ).find( '.text' ).text( tmWoocompare.compareText );
							$( 'button.tm-woocompare-button[data-id=' + data.pid + ']' ).next( '.tm-woocompare-page-button' ).remove();
						}
					}
					widgetButtonsInit();
				}
			);
		}

		function tmWoocompareRemoveFromCompare( event ) {

			var button = $( event.target ),
				data = {
					action: 'tm_woocompare_remove',
					pid:    button.data( 'id' ),
					nonce:  button.data( 'nonce' )
				};

			tmWoocompareAjax( event, data );
		}

		function tmWoocompareEmptyCompare( event ) {

			var data = {
				action: 'tm_woocompare_empty'
			};

			tmWoocompareAjax( event, data );
		}

		function widgetButtonsInit() {

			$( '.tm-woocompare-remove-from-list' )
				.off( 'click' )
				.on( 'click', function ( event ) {
					tmWoocompareRemoveFromCompare( event );
				} );

			$( '.empty_compare_button' )
				.off( 'click' )
				.on( 'click', function( event ) {
					tmWoocompareEmptyCompare( event );
				} );
		}
		widgetButtonsInit();
	} );
}( jQuery) );