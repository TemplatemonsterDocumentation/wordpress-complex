/* global customMenuWidgetAdmin */

( function( $ ) {
	'use strict';

	var tmCustomMenuWidgetAdmin = {

		init: function ( event, widget ) {

			var addMedia       = widget.find( '.tm_custom_menu_widget_add_media' ),
				thumbContainer = widget.find( '.tm_custom_menu_widget_img' ),
				removeBtn      = thumbContainer.find( '.banner_remove' ),
				id             = widget.find( '.tm_custom_menu_widget_id' );

			addMedia.on( 'click', function( event ) {

				if ( mediaFrame ) {
					mediaFrame.open();
					return;
				}

				var mediaFrame = wp.media.frames.downloadable_file = wp.media( {
					title:    customMenuWidgetAdmin.mediaFrameTitle,
					multiple: false
				} );

				mediaFrame.on( 'select', function() {

					var attachment = mediaFrame.state().get( 'selection' ).first().toJSON();

					thumbContainer.show().find( ' > div' ).attr( {
						style: 'background-image: url(' + attachment.sizes.thumbnail.url + ');'
					} );
					addMedia.hide();
					id.val( attachment.id ).trigger( 'change' );
				} );

				mediaFrame.open();
			} );

			removeBtn.on( 'click', function() {

				thumbContainer.removeAttr( 'style' ).hide();
				addMedia.show();
				id.val( '' ).trigger( 'change' );

			} );
		}
	};

	$( '#widgets-right' ).find( 'div.widget[id*=tm_custom_menu_widget]' ).each( function () {

		tmCustomMenuWidgetAdmin.init( 'init', $( this ) );
	} );

	$( document ).on( 'widget-updated widget-added', function( event, widget ) {

		if ( widget.is( '[id*=tm_custom_menu_widget]' ) ) {

			tmCustomMenuWidgetAdmin.init( event, widget );
		}
	} );

} )( jQuery );