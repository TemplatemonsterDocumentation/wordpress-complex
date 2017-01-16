(function( $ ) {
	"use strict";

	CherryJsCore.utilites.namespace( 'theme_script' );
	CherryJsCore.theme_script = {
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
			this.smart_slider_init( this );
			this.swiper_carousel_init( this );
			this.post_formats_custom_init( this );
			this.navbar_init( this );
			this.subscribe_init( this );
			this.main_menu( this, $( '.main-navigation' ) );
			this.mega_menu( this );
			this.to_top_init( this );
			this.playlist_slider_widget_init( this );
			this.news_smart_box_init( this );
			this.header_search( this );
			this.mobile_menu( this );
			this.vertical_menu_init( this );
			this.add_project_inline_style( this );
			this.anchor_navigation( this );
			this.anchor_scrolling_navigation( this );
		},

		window_load_render: function() {
			this.page_preloader_init( this );
		},

		anchor_navigation: function ( self ) {
			$( '.page-template-template-landing div:not(.woocommerce-tabs) a[href*=#]:not([href=#])' ).on( 'click', function() {

				if ( location.pathname.replace( /^\//, '' ) === this.pathname.replace( /^\//, '' ) || location.hostname === this.hostname ) {
					var target     = $( this.hash ),
						targetLink = this.hash,
						menuHeight = $( '#main-menu' ).outerHeight(true);

					target = target.length ? target : $( '[name=' + this.hash.slice( 1 ) + ']' );

					if ( target.length ) {
						$( 'html, body' ).animate( {
							scrollTop: target.offset().top - menuHeight
						}, 1000 );

						return false;
					}
				}
			});
		},

		anchor_scrolling_navigation: function ( self ) {

			var $document   = $( document ),
				top         = null,
				changed     = false,
				currentHash = null,
				sections    = null,
				timeout     = null,
				interval    = null,
				menuHeight  = $( '#main-menu' ).outerHeight(true),
				$sections   = $( '.tm_pb_anchor' );

			sections = getSections();


			$( window ).on( 'scroll.cherry_anchor_navigation', function () {
				var newTop  = $document.scrollTop();

				changed = newTop != top;

				if ( changed ) {
					top = newTop;
				}
			});

			$( window ).on( 'resize.cherry_anchor_navigation', function () {
				sections = getSections();
			});

			function getSections() {
				sections = $.map( $sections, function ( event ) {
					var $event = $( event ),
						position = $event.position();

					return {
						top: position.top - menuHeight,
						bottom: position.top + $event.outerHeight( true ) - menuHeight,
						hash: $event.attr( 'id' )
					};
				});

				return sections;

			}

			function iteration() {

				var sectionsLength = sections.length,
					section,
					scrollTop;

				while ( section = sections[--sectionsLength] ) {

					if ( section.top >= top || section.bottom <= top ) {
						continue;
					}

					if ( currentHash == section.hash ) {
						break;
					}

					currentHash = section.hash;
					history.pushState( null, null, '#' + section.hash );
				}
			}

			timeout = setTimeout( function (){
				interval = setInterval( iteration, 250 );
			}, 250 );
		},

		smart_slider_init: function( self ) {
			$( '.monstroid2-smartslider' ).each( function() {
				var slider = $( this ),
					sliderId = slider.data( 'id' ),
					sliderWidth = slider.data( 'width' ),
					sliderHeight = slider.data( 'height' ),
					sliderOrientation = slider.data( 'orientation' ),
					slideDistance = slider.data( 'slide-distance' ),
					slideDuration = slider.data( 'slide-duration' ),
					sliderFade = slider.data( 'slide-fade' ),
					sliderNavigation = slider.data( 'navigation' ),
					sliderFadeNavigation = slider.data( 'fade-navigation' ),
					sliderPagination = slider.data( 'pagination' ),
					sliderAutoplay = slider.data( 'autoplay' ),
					sliderFullScreen = slider.data( 'fullscreen' ),
					sliderShuffle = slider.data( 'shuffle' ),
					sliderLoop = slider.data( 'loop' ),
					sliderThumbnailsArrows = slider.data( 'thumbnails-arrows' ),
					sliderThumbnailsPosition = slider.data( 'thumbnails-position' ),
					sliderThumbnailsWidth = slider.data( 'thumbnails-width' ),
					sliderThumbnailsHeight = slider.data( 'thumbnails-height' );

				if ( $( '.smart-slider__items', '#' + sliderId ).length > 0 ) {
					$( '#' + sliderId ).sliderPro( {
						width: sliderWidth,
						height: sliderHeight,
						orientation: sliderOrientation,
						slideDistance: slideDistance,
						slideAnimationDuration: slideDuration,
						fade: sliderFade,
						arrows: sliderNavigation,
						fadeArrows: sliderFadeNavigation,
						buttons: sliderPagination,
						autoplay: sliderAutoplay,
						fullScreen: sliderFullScreen,
						shuffle: sliderShuffle,
						loop: sliderLoop,
						waitForLayers: false,
						thumbnailArrows: sliderThumbnailsArrows,
						thumbnailsPosition: sliderThumbnailsPosition,
						thumbnailWidth: sliderThumbnailsWidth,
						thumbnailHeight: sliderThumbnailsHeight,
						init: function() {
							$( this ).resize();
						},
						sliderResize: function( event ) {
							var thisSlider = $( '#' + sliderId ),
								slides = $( '.sp-slide', thisSlider );

							slides.each( function() {

								if ( $( '.sp-title a', this ).width() > $( this ).width() ) {
									$( this ).addClass( 'text-wrapped' );
								} else {
									$( this ).removeClass( 'text-wrapped' );
								}

							} );
						},
						breakpoints: {
							991: {
								height: parseFloat( sliderHeight ) * 0.75
							},
							767: {
								height: parseFloat( sliderHeight ) * 0.5,
								thumbnailsPosition: ( 'top' === this.thumbnailsPosition ) ? 'top' : 'bottom',
								thumbnailHeight: parseFloat( sliderThumbnailsHeight ) * 0.75,
								thumbnailWidth: parseFloat( sliderThumbnailsWidth ) * 0.75
							}
						}
					} );
				}
			} );//each end
		},

		swiper_carousel_init: function( self ) {

			// Enable swiper carousels
			jQuery( '.monstroid2-carousel' ).each( function() {
				var swiper = null,
					uniqId = jQuery( this ).data( 'uniq-id' ),
					slidesPerView = parseFloat( jQuery( this ).data( 'slides-per-view' ) ),
					slidesPerGroup = parseFloat( jQuery( this ).data( 'slides-per-group' ) ),
					slidesPerColumn = parseFloat( jQuery( this ).data( 'slides-per-column' ) ),
					spaceBetweenSlides = parseFloat( jQuery( this ).data( 'space-between-slides' ) ),
					durationSpeed = parseFloat( jQuery( this ).data( 'duration-speed' ) ),
					swiperLoop = jQuery( this ).data( 'swiper-loop' ),
					freeMode = jQuery( this ).data( 'free-mode' ),
					grabCursor = jQuery( this ).data( 'grab-cursor' ),
					mouseWheel = jQuery( this ).data( 'mouse-wheel' ),
					breakpointsSettings = {
						1199: {
							slidesPerView: Math.floor( slidesPerView * 0.75 ),
							spaceBetween: Math.floor( spaceBetweenSlides * 0.75 )
						},
						991: {
							slidesPerView: Math.floor( slidesPerView * 0.5 ),
							spaceBetween: Math.floor( spaceBetweenSlides * 0.5 )
						},
						767: {
							slidesPerView: ( 0 !== Math.floor( slidesPerView * 0.25 ) ) ? Math.floor( slidesPerView * 0.25 ) : 1
						}
					};

				if ( 1 == slidesPerView ) {
					breakpointsSettings = {}
				}

				var swiper = new Swiper( '#' + uniqId, {
						slidesPerView: slidesPerView,
						slidesPerGroup: slidesPerGroup,
						slidesPerColumn: slidesPerColumn,
						spaceBetween: spaceBetweenSlides,
						speed: durationSpeed,
						loop: swiperLoop,
						freeMode: freeMode,
						grabCursor: grabCursor,
						mousewheelControl: mouseWheel,
						paginationClickable: true,
						nextButton: '#' + uniqId + '-next',
						prevButton: '#' + uniqId + '-prev',
						pagination: '#' + uniqId + '-pagination',
						onInit: function() {
							$( '#' + uniqId + '-next' ).css( { 'display': 'block' } );
							$( '#' + uniqId + '-prev' ).css( { 'display': 'block' } );
						},
						breakpoints: breakpointsSettings
					}
				);
			} );
		},

		post_formats_custom_init: function( self ) {
			CherryJsCore.variable.$document.on( 'cherry-post-formats-custom-init', function( event ) {

				if ( 'slider' !== event.object ) {
					return;
				}

				var uniqId = '#' + event.item.attr( 'id' ),
					swiper = new Swiper( uniqId, {
						pagination: uniqId + ' .swiper-pagination',
						paginationClickable: true,
						nextButton: uniqId + ' .swiper-button-next',
						prevButton: uniqId + ' .swiper-button-prev',
						spaceBetween: 0,
						onInit: function() {
							$( uniqId + ' .swiper-button-next' ).css( { 'display': 'block' } );
							$( uniqId + ' .swiper-button-prev' ).css( { 'display': 'block' } );
						}
					} );

				event.item.data( 'initalized', true );
			} );

			var items = [];

			$( '.mini-gallery .post-thumbnail__link' ).on( 'click', function( event ) {
				event.preventDefault();

				$( this ).parents( '.mini-gallery' ).find( '.post-gallery__slides > a[href]' ).each( function() {
					items.push( {
						src: $( this ).attr( 'href' ),
						type: 'image'
					} );
				} );

				$.magnificPopup.open( {
					items: items,
					gallery: {
						enabled: true
					}
				} );
			} );
		},

		navbar_init: function( self ) {

			$( window ).load( function() {

				var $layout = window.monstroid2.labels.header_layout,
					$navbar = ( 'style-3' === $layout || 'style-7' === $layout  ) ? $( '.vertical-menu-toggle' ) : $( '#main-menu' );

				if ( !$.isFunction( jQuery.fn.stickUp ) || !$navbar.length ) {
					return !1;
				}

				$navbar.stickUp( {
					correctionSelector: '#wpadminbar',
					listenSelector: '.listenSelector',
					pseudo: true,
					active: true
				} );
				CherryJsCore.variable.$document.trigger( 'scroll.stickUp' );

			} );
		},

		subscribe_init: function( self ) {
			CherryJsCore.variable.$document.on( 'click', '.subscribe-block__submit', function( event ) {

				event.preventDefault();

				var $this = $( this ),
					form = $this.parents( 'form' ),
					nonce = form.find( 'input[name="nonce"]' ).val(),
					mail_input = form.find( 'input[name="subscribe-mail"]' ),
					mail = mail_input.val(),
					error = form.find( '.subscribe-block__error' ),
					success = form.find( '.subscribe-block__success' ),
					hidden = 'hidden';

				if ( '' === mail ) {
					mail_input.addClass( 'error' );
					return !1;
				}

				if ( $this.hasClass( 'processing' ) ) {
					return !1;
				}

				$this.addClass( 'processing' );
				error.empty();
				mail_input.removeClass( 'error' );

				if ( !error.hasClass( hidden ) ) {
					error.addClass( hidden );
				}

				if ( !success.hasClass( hidden ) ) {
					success.addClass( hidden );
				}

				$.ajax( {
					url: monstroid2.ajaxurl,
					type: 'post',
					dataType: 'json',
					data: {
						action: 'monstroid2_subscribe',
						mail: mail,
						nonce: nonce
					},
					error: function() {
						$this.removeClass( 'processing' );
					}
				} ).done( function( response ) {

					$this.removeClass( 'processing' );

					if ( true === response.success ) {
						success.removeClass( hidden );
						mail_input.val( '' );
						return 1;
					}

					error.removeClass( hidden ).html( response.data.message );
					mail_input.addClass( 'error' );
					return !1;

				} );

			} );
		},


		isMegaMenuEnabled: function() {

			if ( undefined === window.monstroid2.megaMenu ) {
				return false;
			}

			if ( true === window.monstroid2.megaMenu.isActive && 'main' == window.monstroid2.megaMenu.location ) {
				return true;
			}

			return false;
		},

		main_menu: function( self, $mainNavigation ) {

			if ( self.isMegaMenuEnabled() ) {
				//return;
			}

			var transitionend = 'transitionend oTransitionEnd webkitTransitionEnd',
				moreMenuContent = '&middot;&middot;&middot;',
				imgurl = '',
				srcset = '',
				hasimg = false,
				hasicon = false,
				hasprop = Object.prototype.hasOwnProperty,
				$menuToggle = $( '.main-menu-toggle[aria-controls="main-menu"]', $mainNavigation ),
				liWithChildren = 'li.menu-item-has-children, li.page_item_has_children',
				$body = $( 'body' ),
				$parentNode,
				menuItem,
				subMenu,
				index = -1,
				$layout = window.monstroid2.labels.header_layout;

			if ( hasprop.call( window, 'monstroid2' ) &&
				hasprop.call( window.monstroid2, 'more_button_options' ) &&
				hasprop.call( window.monstroid2.more_button_options, 'more_button_type' ) ) {
				switch ( window.monstroid2.more_button_options.more_button_type ) {
					case 'image':
						imgurl = window.monstroid2.more_button_options.more_button_image_url;
						if ( window.monstroid2.more_button_options.retina_more_button_image_url ) {
							srcset = ' srcset="' + window.monstroid2.more_button_options.retina_more_button_image_url + ' 2x"';
						}
						moreMenuContent = '<img src="' + imgurl + '"' + srcset + ' alt="' + moreMenuContent + '">';
						hasimg = true;
						break;
					case 'icon':
						moreMenuContent = '<i class="fa ' + window.monstroid2.more_button_options.more_button_icon + '"></i>';
						hasicon = true;
						break;
					case 'text':
					default:
						moreMenuContent = window.monstroid2.more_button_options.more_button_text || moreMenuContent;
						hasimg = false;
						hasicon = false;
						break;
				}
			}

			if ( 'style-3' !== $layout && 'style-7' !== $layout  ) {
				$mainNavigation.superGuacamole( {
					threshold: 768, // Minimal menu width, when this plugin activates
					minChildren: 3, // Minimal visible children count
					childrenFilter: '.menu-item', // Child elements selector
					menuTitle: moreMenuContent, // Menu title
					menuUrl: '#',
					templates: {
						menu: '<li id="%5$s" class="%1$s' + ( hasimg ? ' super-guacamole__menu-with-image' : '' ) +
						( hasicon ? ' super-guacamole__menu-with-icon' : '' ) + '"><a href="%2$s">%3$s</a><ul class="sub-menu">%4$s</ul></li>',
						child_wrap: '<ul class="%1$s">%2$s</ul>',
						child: '<li id="%5$s" class="%1$s"><a href="%2$s">%3$s</a><ul class="sub-menu">%4$s</ul></li>'
					}
				} );
			}

			function hideSubMenu( menuItem, $event ) {
				var subMenus = menuItem.find( '.sub-menu' ),
					subMenu = menuItem.children( '.sub-menu' ).first();

				menuItem
					.removeData( 'index' )
					.removeClass( 'menu-hover' );

				subMenu.addClass( 'in-transition' );

				subMenus
					.one( transitionend, function() {
						subMenus.removeClass( 'in-transition' );
					} );
			}

			function handleMenuItemHover( $event ) {
				if ( $( 'html' ).hasClass( 'mobile-menu-active' ) ) {
					return;
				}
				menuItem = $( $event.target ).parents( '.menu-item' );
				subMenu = menuItem.children( '.sub-menu' ).first();

				var subMenus = menuItem.find( '.sub-menu' );

				if ( !menuItem.hasClass( 'menu-item-has-children' ) ) {
					menuItem = $event.target.tagName === 'LI' ?
						$( $event.target ) :
						$( $event.target ).parents().filter( '.menu-item' );
				}

				switch ( $event.type ) {
					case 'mouseenter':
					case 'mouseover':
						if ( 0 < subMenu.length ) {
							var maxWidth = $body.outerWidth( true ),
								subMenuOffset = subMenu.offset().left + subMenu.outerWidth( true );
							menuItem.addClass( 'menu-hover' );
							subMenu.addClass( 'in-transition' );
							if ( maxWidth <= subMenuOffset ) {
								subMenu.addClass( 'left-side' );
								subMenu.find( '.sub-menu' ).addClass( 'left-side' );
							} else if ( 0 > subMenu.offset().left ) {
								subMenu.removeClass( 'left-side' );
								subMenu.find( '.sub-menu' ).removeClass( 'left-side' );
							}
							subMenus
								.one( transitionend, function() {
									subMenus.removeClass( 'in-transition' );
								} );
						}
						break;
					case 'mouseleave':
						hideSubMenu( menuItem, $event );
						break;
				}
			}

			CherryJsCore.variable.$window.on( 'orientationchange resize', function() {
				if ( $( 'html' ).hasClass( 'mobile-menu-active' ) ) {
					return;
				}
				$mainNavigation.find( '.menu-item' ).removeClass( 'menu-hover' );
				$mainNavigation.find( '.sub-menu.left-side' ).removeClass( 'left-side' );
			} );

			$( liWithChildren ).hoverIntent( {
				over: function() {
				},
				out: function() {
				},
				timeout: 300,
				selector: '.menu-item'
			} );

			$mainNavigation.on( 'mouseenter mouseover mouseleave', '.menu-item', handleMenuItemHover );

			function doubleClickMenu( $jqEvent ) {
				$parentNode = $( this );

				if ( $( 'html' ).hasClass( 'mobile-menu-active' ) ) {
					return true;
				}

				var menuIndex = $parentNode.index();

				if ( menuIndex !== parseInt( $parentNode.data( 'index' ), 10 ) ) {
					$jqEvent.preventDefault();
				}

				$parentNode.data( 'index', menuIndex );
			}

			// Check if touch events supported
			if ( 'ontouchend' in window ) {

				// Attach event listener for double click
				$( liWithChildren, $mainNavigation )
					.on( 'click', doubleClickMenu );

				// Reset index on touchend event
				CherryJsCore.variable.$document.on( 'touchend', function( $jqEvent ) {
					if ( !$( 'html' ).hasClass( 'mobile-menu-active' ) ) {
						$parentNode = $( $jqEvent.target ).parents().filter( '.menu-item:first' );

						if ( $parentNode.hasClass( 'menu-hover' ) === false ) {
							hideSubMenu( $parentNode, $jqEvent );

							index = $parentNode.data( 'index' );

							if ( index ) {
								$parentNode.data( 'index', parseInt( index, 10 ) - 1 );
							}
						}
					}
				} );
			}

			$menuToggle.on( 'click', function( $event ) {
				$event.preventDefault();
				$mainNavigation.toggleClass( 'toggled' );
			} );
		},

		mega_menu: function( self ) {

			/**
			 * Mega-menu mobile SubMenu Toggled.
			 */
			function megaMenuSubMenuToggled() {
				$( this ).toggleClass( 'active' );
			}

			// ADD to Mega-menu sub-menu toggle active class.
			$( '.mega-menu-mobile-arrow' ).on( 'click', megaMenuSubMenuToggled );
		},

		mobile_menu: function( self ) {

			var $mainNavigation = $( '.main-navigation' ),
				$menuToggle = $( '.main-menu-toggle[aria-controls="main-menu"]' );

			$mainNavigation
				.find( 'li.menu-item-has-children > a' )
				.append( '<span class="sub-menu-toggle"></span>' );

			/**
			 * Debounce the function call
			 *
			 * @param  {number}   threshold The delay.
			 * @param  {Function} callback  The function.
			 */
			function debounce( threshold, callback ) {
				var timeout;

				return function debounced( $event ) {
					function delayed() {
						callback.call( this, $event );
						timeout = null;
					}

					if ( timeout ) {
						clearTimeout( timeout );
					}

					timeout = setTimeout( delayed, threshold );
				};
			}

			/**
			 * Resize event handler.
			 *
			 * @param {jqEvent} jQuery event.
			 */
			function resizeHandler( $event ) {
				var $window = CherryJsCore.variable.$window,
					width = $window.outerWidth( true );

				if ( 768 <= width ) {
					$mainNavigation.removeClass( 'mobile-menu' );
				} else {
					$mainNavigation.addClass( 'mobile-menu' );
				}
			}

			/**
			 * Toggle sub-menus.
			 *
			 * @param  {jqEvent} $event jQuery event.
			 */
			function toggleSubMenuHandler( $event ) {

				$event.preventDefault();

				$( this ).toggleClass( 'active' );
				$( this ).parents().filter( 'li:first' ).toggleClass( 'sub-menu-open' );
			}

			/**
			 * Toggle menu.
			 *
			 * @param  {jqEvent} $event jQuery event.
			 */
			function toggleMenuHandler( $event ) {
				var $toggle = $( '.sub-menu-toggle' );

				if ( !$event.isDefaultPrevented() ) {
					$event.preventDefault();
				}

				setTimeout( function() {
					if ( !$mainNavigation.hasClass( 'animate' ) ) {
						$mainNavigation.addClass( 'animate' );
					}
					$mainNavigation.toggleClass( 'show' );
					$( 'html' ).toggleClass( 'mobile-menu-active' );
				}, 10 );

				$menuToggle.toggleClass( 'toggled' );
				$menuToggle.attr( 'aria-expanded', !$menuToggle.hasClass( 'toggled' ) );

				if ( $toggle.hasClass( 'active' ) ) {
					$toggle.removeClass( 'active' );
					$mainNavigation.find( '.sub-menu-open' ).removeClass( 'sub-menu-open' );
				}
			}

			resizeHandler();
			CherryJsCore.variable.$window.on( 'resize orientationchange', debounce( 500, resizeHandler ) );
			$( '.sub-menu-toggle', $mainNavigation ).on( 'click', toggleSubMenuHandler );
			$menuToggle.on( 'click', toggleMenuHandler );
		},

		page_preloader_init: function( self ) {

			if ( $( '.page-preloader-cover' )[0] ) {
				$( '.page-preloader-cover' ).delay( 500 ).fadeTo( 500, 0, function() {
					$( this ).remove();
				} );
			}
		},

		to_top_init: function( self ) {
			if ( $.isFunction( jQuery.fn.UItoTop ) ) {
				$().UItoTop( {
					text: monstroid2.labels.totop_button,
					scrollSpeed: 600
				} );
			}
		},


		playlist_slider_widget_init: function( self ) {
			$( '.widget-playlist-slider .playlist-slider' ).each( function() {
				var $this = $( this ),
					settings = $this.data( 'settings' ),
					breakpoints = JSON.parse( settings.breakpoints );

				$this.sliderPro( {
					autoplay: false,
					width: settings['width'],
					height: parseInt( settings['height'] ),
					orientation: 'vertical',
					waitForLayers: false,
					touchSwipe: false,
					updateHash: false,
					arrows: settings['arrows'],
					buttons: settings['buttons'],
					thumbnailArrows: settings['thumbnailArrows'],
					thumbnailsPosition: settings['thumbnailsPosition'],
					thumbnailPointer: true,
					thumbnailWidth: settings['thumbnailWidth'],
					thumbnailHeight: settings['thumbnailHeight'],
					breakpoints: breakpoints,
					init: function() {
						$this.resize().fadeTo( 0, 1 );
					},
					gotoSlideComplete: function( event ) {
						var prevSlide = $( '.sp-slide', $this ).eq( event.previousIndex ),
							iframe = prevSlide.find( 'iframe' ),
							html5Video = prevSlide.find( 'video' );

						if ( iframe[0] ) {
							var iframeSrc = iframe.attr( 'src' );

							iframe.attr( 'src', iframeSrc );
						} else if ( html5Video[0] ) {
							html5Video[0].stop();
						}
					}
				} );
			} );
		},
		news_smart_box_init: function( self ) {
			jQuery( '.news-smart-box__instance' ).each( function() {
				var uniqId = $( this ).data( 'uniq-id' ),
					instanceSettings = $( this ).data( 'instance-settings' ),
					instance = $( '#' + uniqId ),
					$termItem = $( '.news-smart-box__navigation-terms-list-item', instance ),
					$currentTerm = $( '.news-smart-box__navigation-title', instance ),
					$listContainer = $( '.news-smart-box__wrapper', instance ),
					$ajaxPreloader = $( '.nsb-spinner', instance ),
					$termsList = $( '.news-smart-box__navigation-terms-list', instance ),
					$menuToggle = $( '.menu-toggle', instance ),
					ajaxGetNewInstance = null,
					ajaxGetNewInstanceSuccess = true,
					showNewItems = null;

				$termItem.each( function() {
					var slug = $( this ).data( 'slug' );

					if ( 'category' === instanceSettings.terms_type ) {
						if ( slug === instanceSettings.current_category ) {
							$( this ).addClass( 'is-active' );
						}
					} else {
						if ( slug === instanceSettings.current_tag ) {
							$( this ).addClass( 'is-active' );
						}
					}
				} );

				$menuToggle.on( 'click', function( $jqEvent ) {
					$jqEvent.preventDefault();
					$menuToggle.toggleClass( 'news-smart-box__navigation-toggle--open' );
					$termsList.toggleClass( 'news-smart-box__navigation-terms-list--open' );
				} );

				$termItem.on( 'click', function() {
					var slug = $( this ).data( 'slug' ),
						data = {
							action: 'new_smart_box_instance',
							value_slug: slug,
							instance_settings: instanceSettings
						},
						currentTermName = $( this ).text(),
						counter = 0;

					if ( !$( this ).hasClass( 'is-active' ) ) {
						$termItem.removeClass( 'is-active' );
						$( this ).addClass( 'is-active' );
					}

					$currentTerm.html( currentTermName );

					if ( ajaxGetNewInstance !== null ) {
						ajaxGetNewInstance.abort();
					}
					ajaxGetNewInstance = $.ajax( {
						type: 'GET',
						url: monstroid2.ajaxurl,
						data: data,
						cache: false,
						beforeSend: function() {
							ajaxGetNewInstanceSuccess = false;
							$ajaxPreloader.css( { 'display': 'block' } ).fadeTo( 300, 1 );
						},
						success: function( response ) {
							ajaxGetNewInstanceSuccess = true;

							$ajaxPreloader.fadeTo( 300, 0, function() {
								$( this ).css( { 'display': 'none' } );
							} );

							$( '.news-smart-box__listing', $listContainer ).html( response );

							counter = 0;
							$( '.news-smart-box__item-inner', $listContainer ).addClass( 'animate-cycle-show' );
							$( '.news-smart-box__item', $listContainer ).each( function() {
								showItem( $( this ), 100 * parseInt( counter ) + 200 );
								counter++;
							} )

						}
					} );

				} );

				var showItem = function( itemList, delay ) {
					var timeOutInterval = setTimeout( function() {
						$( '.news-smart-box__item-inner', itemList ).removeClass( 'animate-cycle-show' );
					}, delay );
				}
			} );
		},
		header_search: function( self ) {
			var $header = $( '.site-header' ),
				$searchToggle = $( '.search-form__toggle, .search-form__close', $header ),
				$headerSearch = $( '.header-search', $header ),
				$searchInput = $( '.search-form__field', $headerSearch ),
				searchHandler = function( event ) {
					$header.toggleClass( 'search-active' );
					if ( $header.hasClass( 'search-active' ) ) {
						$searchInput.focus();
					}
				},
				removeActiveClass = function( event ) {
					if ( $( event.target ).closest( $searchToggle ).length || $( event.target ).closest( $headerSearch ).length ) {
						return;
					}

					if ( $header.hasClass( 'search-active' ) ) {
						$header.removeClass( 'search-active' );
					}

					event.stopPropagation();
				};

			$searchToggle.on( 'click', searchHandler );
			CherryJsCore.variable.$document.on( 'click', removeActiveClass );

		},
		vertical_menu_init: function( self ) {
			var $mainNavigation = $( '.main-navigation.vertical-menu' ),
				$mainMenu = $( '.menu', $mainNavigation ),
				$back = $( '.back', $mainNavigation ),
				$close = $( '.close', $mainNavigation ),
				currentTranslate = parseInt( $mainMenu.css( 'transform' ) ),
				isAnimate = false,
				offset = 300;

			resizeHandler();
			CherryJsCore.variable.$window.on( 'resize', resizeHandler );

			$( '.vertical-menu-toggle' ).on( 'click.open', openHandler );
			$( '.menu-item-has-children > a', $mainNavigation ).on( 'click.active', clickHandler );
			$back.on( 'click.back', backHandler );
			$close.on( 'click.close', closeHandler );
			$mainMenu.addClass( 'scroll' );

			$( '.menu-item-has-children', $mainNavigation ).each( function() {
				var $li = $( this ),
					$link = $( '>a', $li ),
					linkText = $link.html(),
					linkHref = $link[0].cloneNode( true ),
					$subMenu = $( '> .sub-menu', $li );
				$subMenu.prepend( '<li class="parent-title"><a href="' + linkHref + '">' + linkText + '</a></li>' );
			} );

			function resizeHandler( event ) {
				var $window = CherryJsCore.variable.$window,
					width = $window.outerWidth( true );

				if ( 768 > width ) {
					$mainNavigation.removeClass( 'vertical-menu' );
				} else {
					$mainNavigation.addClass( 'vertical-menu' );
				}
			}

			function openHandler( event ) {
				$( this ).toggleClass( 'toggled' );
				if ( $mainNavigation.hasClass( 'menu-open' ) ) {
					closeHandler();
					return false;
				}
				$mainNavigation.toggleClass( 'menu-open' );
			}

			function backHandler( event ) {
				var currentTranslate = parseInt( ($mainMenu.css( 'transform' ).replace( /,/g, "" )).split( " " )[4] ),
					translate = currentTranslate + offset,
					$active = $( '.active', $mainMenu ),
					$lastActive = $( $active[$active.length - 1] );

				if ( isAnimate ) {
					return false;
				}

				if ( currentTranslate < 0 ) {
					isAnimate = true;
					$mainMenu.css( 'transform', 'translateX(' + translate + 'px)' );

					if ( translate >= 0 ) {
						translate = 0;
						$( this ).addClass( 'hide' );
						$close.removeClass( 'hide' );
					}

					setTimeout( function() {
						$lastActive.removeClass( 'active' );
						$lastActive.siblings().toggleClass( 'hide' );
						$( '>a', $lastActive ).removeClass( 'hide' );
						$lastActive.parent().addClass( 'scroll' );
						isAnimate = false;
					}, 250 );

				}
				return false;
			}

			function closeHandler( event ) {
				if ( !isAnimate ) {
					$( '.active', $mainMenu ).removeClass( 'active' );
					$( '.hide', $mainMenu ).removeClass( 'hide' );
					$( '.close.hide', $mainNavigation ).removeClass( 'hide' );
					$back.addClass( 'hide' );
					$mainNavigation.removeClass( 'menu-open' );
					$mainMenu.css( 'transform', 'translateX(0)' );
				}

				$( '.vertical-menu-toggle' ).removeClass( 'toggled' );
				return false;
			}

			function clickHandler( event ) {
				var $_target = $( event.currentTarget ),
					$mainMenu = $_target.closest( '.menu' ),
					deep = $_target.parents( 'ul' ).length,
					translate = deep * offset;

				$mainMenu.css( 'transform', 'translateX(' + -translate + 'px)' );

				setTimeout( function() {
					$_target.parent().addClass( 'active' );
					$_target.parent().siblings().toggleClass( 'hide' );
					$_target.parents( '.active' ).find( '> a' ).addClass( 'hide' );
					$_target.siblings( 'ul' ).addClass( 'scroll' );
					$_target.parents( 'ul' ).removeClass( 'scroll' );
				}, 250 );

				$back.removeClass( 'hide' );
				$close.addClass( 'hide' );

				return false;
			}
		},

		add_project_inline_style: function( self ) {
			var $projectGridContainer = $( '.projects-container.grid-layout' ),
				$projectJustifiedContainer = $( '.projects-container.justified-layout' ),
				$projectGridTermsContainer = $( '.projects-terms-container.grid-layout' ),
				$projectContainer = $( '.projects-container' ),

				addInlineStyle = function() {
					var $this = $( this ),
						$projectsSettings = $this.data( 'settings' ),
						$projectItemIndent = Math.ceil( +$projectsSettings['item-margin'] );

					$this.css( {
						'margin-left': -$projectItemIndent / 2 + 'px',
						'margin-right': -$projectItemIndent / 2 + 'px'
					} );
				},

				addTemplateClass = function() {
					var $this = $( this ),
						$projectsSettings = $this.data( 'settings' ),
						$projectsTemplate = $projectsSettings['template'];

					if ( $projectsTemplate ) {
						$this.addClass( $projectsTemplate.replace( '.', '-' ) );
					}
				};

			$projectGridContainer.each( addInlineStyle );
			$projectJustifiedContainer.each( addInlineStyle );
			$projectGridTermsContainer.each( addInlineStyle );

			$projectContainer.each( addTemplateClass );
		}
	};
	CherryJsCore.theme_script.init();

}( jQuery ));
