;( function() {
	'use strict';

	var scrollTop = 0,
		$root = $( 'html, body' ),
		$window = $( window ),
		$document = $( document ),
		$mobilePanel,
		$mobilePanelMenu,
		outerHeight = 0,
		oldOuterHeight = 0,
		mobilePanelHeight = 56,
		baseURL = window.metaldocs.relativeURL.split( '#' )[0],
		originalHref,
		href,
		hash;

	$document.ready( function() {
		$( 'pre > code' ).each( function( i, block ) {
			hljs.highlightBlock( block );
		} );

		$mobilePanel = $( '.rd-mobilepanel' );
		$mobilePanelMenu = $( '.rd-mobilemenu_ul' );

		$mobilePanelMenu.find( 'a[href="' + window.metaldocs.relativeURL + '"]' ).addClass( 'opened' );

		$mobilePanelMenu.find( '.section_link, .article_link' ).on( 'click', function( $event ) {
			$mobilePanelMenu.find( '.section_link.opened, .article_link.opened' ).removeClass( 'opened' );
			$( this ).addClass( 'opened' );

			if ( $( this ).hasClass( 'rd-with-ul' ) ) {
				$event.preventDefault();

				$( this )
					.parents()
					.filter( 'li' )
					.find( '.rd-mobilemenu_submenu:first' )
					.stop()[ $( this ).hasClass( 'active' ) ? 'slideUp' : 'slideDown' ]( 200 );

				$( this ).toggleClass( 'active' );
			}
		} );

		$mobilePanelMenu.find( '.rd-with-ul + ul' ).css( 'display', 'none' );
		$mobilePanelMenu.find( '.rd-with-ul + ul .opened' ).parents().filter( 'ul' ).slideDown( 0 );

		$window.on( 'load resize scroll', function() {
			scrollTop = $document.scrollTop();
			outerHeight = $mobilePanel.outerHeight( true );

			if ( outerHeight !== mobilePanelHeight ) {
				oldOuterHeight = outerHeight;
			}

			if ( oldOuterHeight - mobilePanelHeight > scrollTop ) {
				$mobilePanel.removeClass( 'fixed' );
			} else {
				$mobilePanel.addClass( 'fixed' );
			}
		} );

		$( 'a[href*="#"]' ).on( 'click', function( $event ) {
			$event.preventDefault();

			originalHref = $( this ).attr( 'href' );
			href = originalHref.split( '#' );
			hash = href[1];

			if ( href[0] !== baseURL ) {
				window.location.href = originalHref;
				return;
			}

			if ( '' !== hash ) {
				$root.animate( {
					scrollTop: $( '[id="' + hash + '"]'  ).offset().top
				}, 500, function() {
					window.location.hash = hash;
				} );
			}
		} );
	} );

} () );
