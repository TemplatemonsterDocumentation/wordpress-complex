( function( $ ) {

	'use strict';

	$( document ).ready( function() {

		var tmWooLoadingClass = 'loading',
			tmWooAddedClass   = 'added in_compare',
			btnSelector       = 'button.tm-woocompare-button';

		function productButtonsInit() {

			$( btnSelector ).each( function() {

				var button = $( this );

				button.on( 'click', function ( event ) {

					event.preventDefault();

					var url  = tmWoocompare.ajaxurl,
						data = {
							action: 'tm_woocompare_add_to_list',
							pid:    button.data( 'id' ),
							nonce:  button.data( 'nonce' ),
							single: button.hasClass( 'tm-woocompare-button-single' )
						};

					button
						.removeClass( tmWooAddedClass )
						.addClass( tmWooLoadingClass );

					$.post(
						url,
						data,
						function( response ) {

							button.removeClass( tmWooLoadingClass );

							if( response.success ) {

								switch ( response.data.action ) {

									case 'add':

										$( btnSelector + '[data-id=' + data.pid + ']' )
											.addClass( tmWooAddedClass )
											.find( '.text' )
											.text( tmWoocompare.removeText );

										if( response.data.comparePageBtn ) {

											button.after( response.data.comparePageBtn );
										}
										break;

									case 'remove':

										$( btnSelector + '[data-id=' + data.pid + ']' )
											.removeClass( tmWooAddedClass )
											.find( '.text' )
											.text( tmWoocompare.compareText );

										$( '.tm-woocompare-page-button' ).remove();

										break;

									default:

										break;
								}
								data = {
									action: 'tm_woocompare_update'
								};
								tmWoocompareAjax( null, data );
							}
						}
					);
				} );
			} );
		}

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
			compareList.addClass( tmWooLoadingClass );
			widgetWrapper.addClass( tmWooLoadingClass );

			$.post(
				url,
				data,
				function( response ) {

					compareList.removeClass( tmWooLoadingClass );
					widgetWrapper.removeClass( tmWooLoadingClass );

					if( response.success ) {

						if( data.isComparePage ) {

							$( 'div.tm-woocompare-wrapper' ).html( response.data.compareList );
							$( document ).trigger( 'enhance.tablesaw' );
						}
						if( data.isWidget ) {

							widgetWrapper.html( response.data.widget );
						}
						if ( 'tm_woocompare_empty' === data.action ) {

							$( btnSelector )
								.removeClass( tmWooAddedClass )
								.find( '.text' )
								.text( tmWoocompare.compareText );

							$( '.tm-woocompare-page-button' ).remove();
						}
						if ( 'tm_woocompare_remove' === data.action ) {

							$( btnSelector + '[data-id=' + data.pid + ']' )
								.removeClass( tmWooAddedClass )
								.find( '.text' )
								.text( tmWoocompare.compareText );

							$( '.tm-woocompare-page-button' ).remove();
						}
					}
					widgetButtonsInit();
				}
			);
		}

		function tmWoocompareRemove( event ) {

			var button = $( event.currentTarget ),
				data   = {
					action: 'tm_woocompare_remove',
					pid:    button.data( 'id' ),
					nonce:  button.data( 'nonce' )
				};

			tmWoocompareAjax( event, data );
		}

		function tmWoocompareEmpty( event ) {

			var data = {
				action: 'tm_woocompare_empty'
			};

			tmWoocompareAjax( event, data );
		}

		function widgetButtonsInit() {

			$( '.tm-woocompare-remove' )
				.off( 'click' )
				.on( 'click', function ( event ) {
					tmWoocompareRemove( event );
				} );

			$( '.tm-woocompare-empty' )
				.off( 'click' )
				.on( 'click', function( event ) {
					tmWoocompareEmpty( event );
				} );
		}
		widgetButtonsInit();
		productButtonsInit();

		$( document ).on( 'tm_wc_products_changed', function() {
			widgetButtonsInit();
			productButtonsInit();
		} );
	} );
}( jQuery) );