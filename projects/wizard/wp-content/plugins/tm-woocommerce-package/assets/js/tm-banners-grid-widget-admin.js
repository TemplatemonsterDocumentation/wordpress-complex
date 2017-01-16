/* global bannerGridWidgetAdmin */

(function($){
	"use strict";

	var tmBannerGridWidgetAdmin = {

		init: function ( event, widget ) {

			var addMedia             = widget.find( '.tm_banners_grid_widget_add_media' ),
				thumbsContainer      = widget.find( '.tm_banners_grid_widget_banners_thumbs' ),
				thumbsContainerInner = thumbsContainer.find( '.tm_banners_grid_widget_banners_thumbs_inner' ),
				cols                 = thumbsContainerInner.find( '.tm_banners_grid_widget_img_col' ),
				removeBtns           = cols.find( '.banner_remove' ),
				bannerLinks          = cols.find( '.banner_link' ),
				grids_container      = widget.find( '.tm_banners_grid_widget_banners_grids' ),
				grid                 = grids_container.find( '.tm_banners_grid_widget_banners_grid' ),
				bannersInput         = widget.find( '.tm_banners_grid_widget_banners' ),
				linksInput           = widget.find( '.tm_banners_grid_widget_banners_links' ),
				targetsInput         = widget.find( '.tm_banners_grid_widget_banners_links_targets' ),
				titlesInput          = widget.find( '.tm_banners_grid_widget_banners_titles' ),
				textsInput           = widget.find( '.tm_banners_grid_widget_banners_texts' ),
				wrapper              = widget.find( '.banner_link_wrapper' ),
				linkInput            = widget.find( '.tm_banners_grid_widget_banner_link' ),
				targetInput          = widget.find( '.tm_banners_grid_widget_banner_link_target' ),
				titleInput           = widget.find( '.tm_banners_grid_widget_banner_title' ),
				textInput            = widget.find( '.tm_banners_grid_widget_banner_text' ),
				sortItemIndex,
				sortItemNewIndex,
				item,
				arrBefore,
				arrAfter;

			$.validator.methods.url = function( value, element ) {
				//return this.optional( element ) || /^(?:(?:(?:https?|ftp):)?\/\/)(?:\S+(?::\S*)?@)?(?:(?!(?:10|127)(?:\.\d{1,3}){3})(?!(?:169\.254)(?:\.\d{1,3}){2})(?!172\.(?:1[6-9]|2\d|3[0-1])(?:\.\d{1,3}){2})(?:[1-9]\d?|1\d\d|2[01]\d|22[0-3])(?:\.(?:1?\d{1,2}|2[0-4]\d|25[0-5])){2}(?:\.(?:[1-9]\d?|1\d\d|2[0-4]\d|25[0-4]))|(?:(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)(?:\.(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)*(?:\.(?:[a-z\u00a1-\uffff]{2,})).?)(?::\d{2,5})?(?:[/?#]\S*)?$/.test( value );

				return this.optional( element ) || /(\/?[\w-]+)(\/[\w-]+)*\/?|(#)|(((http|ftp|https):\/\/)?[\w-]+(\.[\w-]+)+([\w.,@?^=%&amp;:\/~+#-]*[\w@?^=%&amp;\/~+#-])?)/gi.test( value );
			};

			// show 'add banners' button
			if ( cols.length < bannerGridWidgetAdmin.maxBanners ) {
				addMedia.show();
			}

			if ( 0 < cols.length ) {
				grid.eq( cols.length - 1 ).show();
			}

			addMedia.on( 'click', function( event ) {

				if ( mediaFrame ) {
					mediaFrame.open();
					return;
				}

				// add banners popup init
				var mediaFrame = wp.media.frames.downloadable_file = wp.media({
					title    : bannerGridWidgetAdmin.mediaFrameTitle,
					multiple : true
				});

				mediaFrame.on( 'select', function() {

					var attachmentIds = [],
						oldVal        = bannersInput.val() ? bannersInput.val().split( ',' ) : [],
						newVal,
						maxBanners    = bannerGridWidgetAdmin.maxBanners - oldVal.length,
						attachment    = mediaFrame.state().get( 'selection' ).toJSON().slice( 0, maxBanners );

					for ( var i = 0; i < attachment.length; i++ ) {
						attachmentIds[i] = attachment[i].id;
						thumbsContainerInner.append( bannerGridWidgetAdmin.col.replace(/%s/g, attachment[i].sizes.thumbnail.url ) );
					}

					newVal = oldVal.concat(attachmentIds);

					if( 6 == newVal.length ) {
						addMedia.hide();
					}

					grid
						.hide()
						.find( 'input' )
						.removeAttr( 'checked' );

					grid
						.eq( newVal.length - 1 )
						.show()
						.find( 'input' )
						.eq( 0 )
						.prop( 'checked', true );

					mediaFrame.detach();

					action_btns_init();

					bannersInput
						.val( newVal.join() )
						.trigger( 'change' );
				});
				mediaFrame.open();

			} );

			wrapper
				.wrapInner( '<form/>' )
				.dialog( {
					'dialogClass'   : 'wp-dialog',
					'modal'         : true,
					'autoOpen'      : false,
					'closeOnEscape' : true,
					'buttons'       : {
						"Add"       : addLink,
						Cancel      : function() {
							wrapper.dialog( 'close' );
						}
					}
				} );

			function addLink() {

				var form      = linkInput.closest( 'form' ),
					validator = form.validate({
						onsubmit: false
					});

				if( validator.element( linkInput ) ){
					var index   = wrapper.find( '.tm_banners_grid_widget_banner_id' ).val(),
						links   = linksInput.val()   ? linksInput.val().split( ',' )   : [],
						targets = targetsInput.val() ? targetsInput.val().split( ',' ) : [],
						titles  = titlesInput.val()  ? titlesInput.val().split( ',' )  : [],
						texts   = textsInput.val()   ? textsInput.val().split( ',' )   : [];

					links[index]   = window.btoa( linkInput.val() );
					targets[index] = targetInput.val();
					titles[index]  = window.btoa( titleInput.val() );
					texts[index]   = window.btoa( textInput.val() );
					linksInput.val( links.join() );
					targetsInput.val( targets.join() );
					titlesInput.val( titles.join() );
					textsInput.val( texts.join() );
					wrapper.dialog( 'close' );
					linksInput.trigger( 'change' );
				}
			}

			function action_btns_init () {

				cols        = thumbsContainerInner.find( '.tm_banners_grid_widget_img_col' );
				removeBtns  = cols.find( '.banner_remove' );
				bannerLinks = cols.find( '.banner_link' );

				// remove banners
				removeBtns.on( 'click', function() {

					var index   = $(this).closest( '.tm_banners_grid_widget_img_col' ).index(),
						banners = bannersInput.val().split( ',' ),
						links   = linksInput.val()   ? linksInput.val().split( ',' )   : [],
						targets = targetsInput.val() ? targetsInput.val().split( ',' ) : [],
						titles  = titlesInput.val()  ? titlesInput.val().split( ',' )  : [],
						texts   = textsInput.val()   ? textsInput.val().split( ',' )   : [];

					banners.splice( index, 1 );
					links.splice( index, 1 );
					targets.splice( index, 1 );
					titles.splice( index, 1 );
					texts.splice( index, 1 );
					bannersInput.val( banners.join() );
					linksInput.val( links.join() );
					targetsInput.val( targets.join() );
					titlesInput.val( titles.join() );
					textsInput.val( texts.join() );

					$( this )
						.closest( '.tm_banners_grid_widget_img_col' )
						.remove();

					grid
						.hide()
						.find( 'input' )
						.removeAttr( 'checked' );

					if( 0 < banners.length ){
						grid
							.eq( banners.length - 1 )
							.show()
							.find( 'input' )
							.eq( 0 )
							.prop( 'checked', true );
					}
					if ( banners.length < bannerGridWidgetAdmin.maxBanners ) {
						addMedia.show();
					}
					bannersInput.trigger( 'change' );
				});

				// banners links
				bannerLinks.on( 'click', function () {

					var index   = $(this).closest( '.tm_banners_grid_widget_img_col' ).index(),
						links   = linksInput.val()   ? linksInput.val().split( ',' )   : [],
						targets = targetsInput.val() ? targetsInput.val().split( ',' ) : [],
						titles  = titlesInput.val()  ? titlesInput.val().split( ',' )  : [],
						texts   = textsInput.val()   ? textsInput.val().split( ',' )   : [];

					$( '.tm_banners_grid_widget_banner_id' ).val( index );
					wrapper.dialog( 'open' );
					linkInput.val( links[index] ? window.atob( links[index] ) : '' );
					targetInput
						.find( 'option' )
						.filter( function() {
							return undefined !== targets[index] && $(this).val() == targets[index];
						} )
						.prop( 'selected', true );
					titleInput.val( titles[index] ? window.atob( titles[index] ) : '' );
					textInput.val( texts[index] ? window.atob( texts[index] ) : '' );

				});
			}

			action_btns_init();

			// sortable
			thumbsContainerInner.sortable( {
				distance : 2,
				zIndex   : 100,
				disabled : false,
				start: function ( event, ui ) {

					sortItemIndex = ui.item.index();
				},
				update: function ( event, ui ) {

					var banners = bannersInput.val().split( ',' ),
						links   = linksInput.val()   ? linksInput.val().split( ',' )   : [],
						targets = targetsInput.val() ? targetsInput.val().split( ',' ) : [],
						titles  = titlesInput.val()  ? titlesInput.val().split( ',' )  : [],
						texts   = textsInput.val()   ? textsInput.val().split( ',' )   : [];

					sortItemNewIndex = ui.item.index();

					bannersInput.val( updateAfterSort( banners, sortItemIndex, sortItemNewIndex ) );

					if( 0 < links.length ) {
						if( links.length < banners.length ) {
							links[banners.length] = '';
						}
						linksInput.val( updateAfterSort( links, sortItemIndex, sortItemNewIndex ) );
					}

					if( 0 < targets.length ) {
						if( targets.length < banners.length ) {
							targets[banners.length] = '';
						}
						targetsInput.val( updateAfterSort( targets, sortItemIndex, sortItemNewIndex ) );
					}

					if( 0 < titles.length ) {
						if( titles.length < banners.length ) {
							titles[banners.length] = '';
						}
						titlesInput.val( updateAfterSort( titles, sortItemIndex, sortItemNewIndex ) );
					}

					if( 0 < texts.length ) {
						if( texts.length < banners.length ) {
							texts[banners.length] = '';
						}
						textsInput.val( updateAfterSort( texts, sortItemIndex, sortItemNewIndex ) );
					}

					bannersInput.trigger( 'change' );
				}
			});

			function updateAfterSort ( arr, oldIndex, newIndex ) {
				item      = arr.splice( oldIndex, 1 );
				arrBefore = arr.slice( 0, newIndex );
				arrAfter  = arr.slice( newIndex );
				arr       = arrBefore.concat( item ).concat( arrAfter );
				return arr.join();
			}
		}
	};
	$( '#widgets-right' ).find( 'div.widget[id*=tm_banners_grid_widget]' ).each( function () {

		tmBannerGridWidgetAdmin.init( 'init', $( this ) );
	} );

	$( document ).on( 'widget-updated widget-added', function( event, widget ){

		if ( widget.is( '[id*=tm_banners_grid_widget]' ) ) {

			tmBannerGridWidgetAdmin.init( event, widget );
		}
	} );

} )( jQuery );