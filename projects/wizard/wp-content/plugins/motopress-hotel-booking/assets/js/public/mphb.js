(function( $ ) {
	$( function() {
		MPHB.CheckoutForm = can.Control.extend( {
	myThis: null
}, {
	totalField: null,
	priceBreakdownTable: null,
	bookBtn: null,
	errorsWrapper: null,
	preloader: null,
	waitResponse: false,
	recalcTotalTimeout: null,
	init: function( el, args ) {
		MPHB.CheckoutForm.myThis = this;
		this.totalField = this.element.find( '.mphb-total-price-field' );
		this.bookBtn = this.element.find( 'input[type=submit]' );
		this.errorsWrapper = this.element.find( '.mphb-errors-wrapper' );
		this.preloader = this.element.find( '.mphb-preloader' );
		this.priceBreakdownTable = this.element.find( 'table.mphb-price-breakdown' );
	},
	setTotal: function( value ) {
		this.totalField.html( value );
	},
	setupPriceBreakdown: function( priceBreakdown ) {
		this.priceBreakdownTable = this.priceBreakdownTable.replaceWith( priceBreakdown );
		this.priceBreakdownTable = this.element.find( 'table.mphb-price-breakdown' );
	},
	setRate: function( rateId ) {
		this.recalculatePrices();
	},
	recalculatePrices: function() {
		var self = this;
		self.hideErrors();
		self.showPreloader();
		clearTimeout( this.recalcTotalTimeout );
		this.recalcTotalTimeout = setTimeout( function() {
			var data = self.parseFormToJSON();
			$.ajax( {
				url: MPHB._data.ajaxUrl,
				type: 'GET',
				dataType: 'json',
				data: {
					action: 'mphb_recalculate_checkout_prices',
					mphb_nonce: MPHB._data.nonces.mphb_recalculate_checkout_prices,
					formValues: data
				},
				success: function( response ) {
					if ( response.hasOwnProperty( 'success' ) ) {
						if ( response.success ) {
							self.setTotal( response.data.total );
							self.setupPriceBreakdown( response.data.priceBreakdown );
						} else {
							self.showError( response.data.message );
						}
					} else {
						self.showError( MPHB._data.translations.errorHasOccured );
					}
				},
				error: function( jqXHR ) {
					self.showError( MPHB._data.translations.errorHasOccured );
				},
				complete: function( jqXHR ) {
					self.hidePreloader();
				}
			} );
		}, 500 );
	},
	'[name="mphb_room_rate_id"] change': function( el, e ) {
		var rateId = el.val();
		this.setRate( rateId );
	},
	'.mphb_sc_checkout-services-list input, .mphb_sc_checkout-services-list select change': function( el, e ) {
		this.recalculatePrices();
	},
	hideErrors: function() {
		this.errorsWrapper.empty().addClass( 'mphb-hide' );
	},
	showError: function( message ) {
		this.errorsWrapper.html( message ).removeClass( 'mphb-hide' );
	},
	showPreloader: function() {
		this.waitResponse = true;
		this.bookBtn.attr( 'disabled', 'disabled' );
		this.preloader.removeClass( 'mphb-hide' );
	},
	hidePreloader: function() {
		this.waitResponse = false;
		this.bookBtn.removeAttr( 'disabled' );
		this.preloader.addClass( 'mphb-hide' );
	},
	parseFormToJSON: function() {
		return this.element.serializeJSON();
	},
	'submit': function( el, e ) {
		if ( this.waitResponse ) {
			return false;
		}
	}

} );
MPHB.DateRules = can.Construct.extend( {}, {
	dates: {},
	init: function( dates ) {
		this.dates = dates;
	},
	/**
	 *
	 * @param {Date} date
	 * @returns {Boolean}
	 */
	canCheckIn: function( date ) {
		var formattedDate = this.formatDate( date );
		if ( !this.dates.hasOwnProperty( formattedDate ) ) {
			return true;
		}
		return !this.dates[formattedDate].not_check_in && !this.dates[formattedDate].not_stay_in;
	},
	/**
	 *
	 * @param {Date} date
	 * @returns {Boolean}
	 */
	canCheckOut: function( date ) {
		var formattedDate = this.formatDate( date );
		if ( !this.dates.hasOwnProperty( formattedDate ) ) {
			return true;
		}
		return !this.dates[formattedDate].not_check_out;
	},
	/**
	 *
	 * @param {Date} date
	 * @returns {Boolean}
	 */
	canStayIn: function( date ) {
		var formattedDate = this.formatDate( date );
		if ( !this.dates.hasOwnProperty( formattedDate ) ) {
			return true;
		}
		return !this.dates[formattedDate].not_stay_in;
	},
	/**
	 *
	 * @param {Date} dateFrom
	 * @param {Date} stopDate
	 * @returns {Date}
	 */
	getNearestNotStayInDate: function( dateFrom, stopDate ) {
		var nearestDate = new Date( stopDate );
		var dateFromFormatted = $.datepick.formatDate( 'yyyy-mm-dd', dateFrom );
		var stopDateFormatted = $.datepick.formatDate( 'yyyy-mm-dd', stopDate );

		$.each( this.dates, function( ruleDate, rule ) {
			if ( ruleDate > stopDateFormatted ) {
				return false;
			}
			if ( dateFromFormatted > ruleDate ) {
				return true;
			}
			if ( rule.not_stay_in ) {
				nearestDate = new Date( ruleDate );
				return false;
			}
		} );
		return nearestDate;
	},
	/**
	 *
	 * @param {Date} date
	 * @returns {string}
	 */
	formatDate: function( date ) {
		return $.datepick.formatDate( 'yyyy-mm-dd', date );
	}
} );
MPHB.Datepicker = can.Control.extend( {}, {
	form: null,
	init: function( el, args ) {
		this.form = args.form;
	},
	/**
	 *
	 * @returns {Array}
	 */
	getRawDate: function() {
		// simulate getDate datepick method
		var dateStr = this.element.val();
		var dates = [ ];
		if ( dateStr !== '' ) {
			$.each( dateStr.split( ',' ), function( index, date ) {
				dates.push( new Date( date ) );
			} );
		}

		return dates;
	},
	/**
	 * @return {Date|null}
	 */
	getDate: function() {
		var dateStr = this.element.val();
		return dateStr !== '' ? new Date( dateStr ) : null;
	},
	/**
	 *
	 * @returns {String} Date in format 'yyyy-mm-dd' or empty string.
	 */
	getFormattedDate: function() {
		return this.element.val();
	},
	/**
	 * @param {Date} date
	 */
	setDate: function( date ) {
		this.element.datepick( 'setDate', date );
	},
	/**
	 * @param {string} option
	 */
	getOption: function( option ) {
		return this.element.datepick( 'option', option );
	},
	/**
	 * @param {string} option
	 * @param {mixed} value
	 */
	setOption: function( option, value ) {
		this.element.datepick( 'option', option, value );
	},
	/**
	 *
	 * @returns {Date|null}
	 */
	getMinDate: function() {
		var minDate = this.getOption( 'minDate' );
		return minDate !== null && minDate !== '' ? new Date( minDate ) : null;
	},
	/**
	 *
	 * @returns {Date|null}
	 */
	getMaxDate: function() {
		var maxDate = this.getOption( 'maxDate' );
		return maxDate !== null && maxDate !== '' ? new Date( maxDate ) : null;
	},
	/**
	 *
	 * @returns {undefined}
	 */
	clear: function() {
		this.element.datepick( 'clear' );
	},
	/**
	 * @param {Date} date
	 * @param {string} format Optional. Default 'yyyy-mm-dd'.
	 */
	formatDate: function( date, format ) {
		format = typeof (format) !== 'undefined' ? format : 'yyyy-mm-dd';
		return $.datepick.formatDate( format, date );
	},
	/**
	 *
	 * @returns {undefined}
	 */
	refresh: function() {
		$.datepick._update( this.element[0], true );
		$.datepick._updateInput( this.element[0], false );
	}

} );
MPHB.GlobalRules = can.Construct.extend( {}, {
	minDays: null,
	maxDays: null,
	checkInDays: null,
	checkOutDays: null,
	init: function( data ) {
		this.minDays = data.min_days;
		this.maxDays = data.max_days;
		this.checkInDays = data.check_in_days;
		this.checkOutDays = data.check_out_days;
	},
	/**
	 *
	 * @param {Date} date
	 * @returns {Boolean}
	 */
	isCheckOutSatisfy: function( date ) {
		var checkOutDay = date.getDay().toString();
		return $.inArray( checkOutDay, this.checkOutDays ) !== -1;
	},
	/**
	 *
	 * @param {Date} date
	 * @returns {Boolean}
	 */
	isCheckInSatisfy: function( date ) {
		var checkInDay = date.getDay().toString();
		return $.inArray( checkInDay, this.checkInDays ) !== -1;
	},
	/**
	 *
	 * @param {Date} checkInDate
	 * @param {Date} checkOutDate
	 * @returns {Boolean}
	 */
	isCorrect: function( checkInDate, checkOutDate ) {

		if ( typeof checkInDate === 'undefined' || typeof checkOutDate === 'undefined' ) {
			return true;
		}

		if ( !this.isCheckInSatisfy( checkInDate ) ) {
			return false;
		}

		if ( !this.isCheckOutSatisfy( checkOutDate ) ) {
			return false;
		}

		var minAllowedCheckOut = $.datepick.add( new Date( checkInDate.getTime() ), this.minDays );
		var maxAllowedCheckOut = $.datepick.add( new Date( checkInDate.getTime() ), this.maxDays );

		return checkOutDate >= minAllowedCheckOut && checkOutDate <= maxAllowedCheckOut;
	},
	/**
	 *
	 * @param {Date} checkInDate
	 * @returns {Date}
	 */
	getMinCheckOutDate: function( checkInDate ) {
		return $.datepick.add( new Date( checkInDate.getTime() ), this.minDays, 'd' );
	},
	/**
	 *
	 * @param {Date} checkInDate
	 * @returns {Date}
	 */
	getMaxCheckOutDate: function( checkInDate ) {
		return $.datepick.add( new Date( checkInDate.getTime() ), this.maxDays, 'd' );
	}
} );
MPHB.HotelDataManager = can.Construct.extend( {
	myThis: null,
	ROOM_STATUS_AVAILABLE: 'available',
	ROOM_STATUS_NOT_AVAILABLE: 'not-available',
	ROOM_STATUS_BOOKED: 'booked',
	ROOM_STATUS_PAST: 'past'
}, {
	today: null,
	roomTypesData: {},
	globalRules: null,
	dateRules: null,
	init: function( data ) {
		MPHB.HotelDataManager.myThis = this;
		this.initRoomTypesData( data.room_types_data );
		this.initRules( data.rules );
		this.setToday( new Date( data.today ) )
	},
	/**
	 *
	 * @returns {undefined}
	 */
	initRoomTypesData: function( roomTypesData ) {
		var self = this;
		$.each( roomTypesData, function( id, data ) {
			self.roomTypesData[id] = new MPHB.RoomTypeData( id, data );
		} );
	},
	initRules: function( rules ) {
		this.globalRules = new MPHB.GlobalRules( rules.global );
		this.dateRules = new MPHB.DateRules( rules.dates )
	},
	/**
	 *
	 * @param {Date} date
	 * @returns {undefined}
	 */
	setToday: function( date ) {
		this.today = date;
	},
	/**
	 *
	 * @param {int|string} id ID of roomType
	 * @returns {MPHB.RoomTypeData|false}
	 */
	getRoomTypeData: function( id ) {
		return this.roomTypesData.hasOwnProperty( id ) ? this.roomTypesData[id] : false;
	},
	/**
	 *
	 * @param {Object} dateData
	 * @param {Date} date
	 * @returns {Object}
	 */
	fillDateCellData: function( dateData, date ) {
		var rulesTitles = [ ];
		var rulesClasses = [ ];

		if ( !this.dateRules.canStayIn( date ) ) {
			rulesTitles.push( MPHB._data.translations.notStayIn );
			rulesClasses.push( 'mphb-not-stay-in-date' );
		}
		if ( !this.dateRules.canCheckIn( date ) || !this.globalRules.isCheckInSatisfy( date ) ) {
			rulesTitles.push( MPHB._data.translations.notCheckIn );
			rulesClasses.push( 'mphb-not-check-in-date' );
		}
		if ( !this.dateRules.canCheckOut( date ) || !this.globalRules.isCheckOutSatisfy( date ) ) {
			rulesTitles.push( MPHB._data.translations.notCheckOut );
			rulesClasses.push( 'mphb-not-check-out-date' );
		}

		if ( rulesTitles.length ) {
			dateData.title += ' ' + MPHB._data.translations.rules + ' ' + rulesTitles.join( ', ' );
		}

		if ( rulesClasses.length ) {
			dateData.dateClass += (dateData.dateClass.length ? ' ' : '') + rulesClasses.join( ' ' );
		}

		return dateData;
	},
} );
MPHB.Utils = can.Construct.extend( {
	/**
	 *
	 * @param {Date} date
	 * @returns {String}
	 */
	formatDateToCompare: function( date ) {
		return $.datepick.formatDate( 'yyyymmdd', date );
	}
}, {} );
MPHB.ReservationForm = can.Control.extend( {
	MODE_SUBMIT: 'submit',
	MODE_NORMAL: 'normal',
	MODE_WAITING: 'waiting'
}, {
	/**
	 * @var jQuery
	 */
	formEl: null,
	/**
	 * @var MPHB.RoomTypeCheckInDatepicker
	 */
	checkInDatepicker: null,
	/**
	 * @var MPHB.RoomTypeCheckOutDatepicker
	 */
	checkOutDatepicker: null,
	/**
	 * @var jQuery
	 */
	reserveBtn: null,
	/**
	 * @var jQuery
	 */
	reserveBtnPreloader: null,
	/**
	 * @var jQuery
	 */
	errorsWrapper: null,
	/**
	 * @var String
	 */
	mode: null,
	/**
	 * @var int
	 */
	roomTypeId: null,
	/**
	 * @var MPHB.RoomTypeData
	 */
	roomTypeData: null,
	setup: function( el, args ) {
		this._super( el, args );
		this.mode = MPHB.ReservationForm.MODE_NORMAL;
	},
	init: function( el, args ) {
		this.formEl = el;
		this.roomTypeId = parseInt( this.formEl.attr( 'id' ).replace( /^booking-form-/, '' ) );
		this.roomTypeData = MPHB.HotelDataManager.myThis.getRoomTypeData( this.roomTypeId );
		this.errorsWrapper = this.formEl.find( '.mphb-errors-wrapper' );
		this.initCheckInDatepicker();
		this.initCheckOutDatepicker();
		this.initReserveBtn();

		var self = this;
		$( window ).on( 'mphb-update-date-room-type-' + this.roomTypeId, function() {
			self.reservationForm.refreshDatepickers();
		} );
	},
	'submit': function( el, e ) {

		if ( this.mode !== MPHB.ReservationForm.MODE_SUBMIT ) {
			e.preventDefault();
			e.stopPropagation();
			this.setFormWaitingMode();
			var self = this;
			$.ajax( {
				url: MPHB._data.ajaxUrl,
				type: 'GET',
				dataType: 'json',
				data: {
					action: 'mphb_check_room_availability',
					mphb_nonce: MPHB._data.nonces.mphb_check_room_availability,
					roomTypeId: self.roomTypeId,
					checkInDate: this.checkInDatepicker.getFormattedDate(),
					checkOutDate: this.checkOutDatepicker.getFormattedDate()
				},
				success: function( response ) {
					if ( response.hasOwnProperty( 'success' ) ) {
						if ( response.success ) {
							self.proceedToCheckout();
						} else {
							self.showError( response.data.message );
							if ( response.data.hasOwnProperty( 'updatedData' ) ) {
								self.roomTypeData.update( response.data.updatedData );
							}
							self.clearDatepickers();
						}
					} else {
						self.showError( MPHB._data.translations.errorHasOccured );
					}
				},
				error: function( jqXHR ) {
					self.showError( MPHB._data.translations.errorHasOccured );
				},
				complete: function( jqXHR ) {
					self.setFormNormalMode();
				}
			} );
		}
	},
	proceedToCheckout: function() {
		this.mode = MPHB.ReservationForm.MODE_SUBMIT;
		this.unlock();
		this.formEl.submit();
	},
	showError: function( message ) {
		this.clearErrors();
		var errorMessage = $( '<p>', {
			'class': 'mphb-error',
			'html': message
		} );
		this.errorsWrapper.append( errorMessage ).removeClass( 'mphb-hide' );
	},
	clearErrors: function() {
		this.errorsWrapper.empty().addClass( 'mphb-hide' );
	},
	lock: function() {
		this.element.find( '[name]' ).attr( 'disabled', 'disabled' );
		this.reserveBtn.attr( 'disabled', 'disabled' ).addClass( 'mphb-disabled' );
		this.reserveBtnPreloader.removeClass( 'mphb-hide' );
	},
	unlock: function() {
		this.element.find( '[name]' ).removeAttr( 'disabled' );
		this.reserveBtn.removeAttr( 'disabled', 'disabled' ).removeClass( 'mphb-disabled' );
		this.reserveBtnPreloader.addClass( 'mphb-hide' );
	},
	setFormWaitingMode: function() {
		this.mode = MPHB.ReservationForm.MODE_WAITING;
		this.lock();
	},
	setFormNormalMode: function() {
		this.mode = MPHB.ReservationForm.MODE_NORMAL;
		this.unlock();
	},
	initCheckInDatepicker: function() {
		var checkInEl = this.formEl.find( 'input[name=mphb_check_in_date]' );
		this.checkInDatepicker = new MPHB.RoomTypeCheckInDatepicker( checkInEl, {'form': this} );
	},
	initCheckOutDatepicker: function() {
		var checkOutEl = this.formEl.find( 'input[name=mphb_check_out_date]' );
		this.checkOutDatepicker = new MPHB.RoomTypeCheckOutDatepicker( checkOutEl, {'form': this} );
	},
	initReserveBtn: function() {
		this.reserveBtn = this.formEl.find( '.mphb-reserve-btn' );
		this.reserveBtnPreloader = this.formEl.find( '.mphb-preloader' );

		this.setFormNormalMode();
	},
	/**
	 *
	 * @param {bool} setDate
	 * @returns {undefined}
	 */
	updateCheckOutLimitations: function( setDate ) {
		if ( typeof setDate === 'undefined' ) {
			setDate = true;
		}
		var limitations = this.retrieveCheckOutLimitations( this.checkInDatepicker.getDate(), this.checkOutDatepicker.getDate() );

		this.checkOutDatepicker.setOption( 'minDate', limitations.minDate );
		this.checkOutDatepicker.setOption( 'maxDate', limitations.maxDate );
		this.checkOutDatepicker.setDate( setDate ? limitations.date : null );
	},
	/**
	 *
	 * @param {type} checkInDate
	 * @param {type} checkOutDate
	 * @returns {Object} with keys
	 *	- {Date} minDate
	 *	- {Date} maxDate
	 *	- {Date|null} date
	 */
	retrieveCheckOutLimitations: function( checkInDate, checkOutDate ) {

		var minDate = MPHB.HotelDataManager.myThis.today;
		var maxDate = null;
		var recommendedDate = null;

		if ( checkInDate !== null ) {
			var minDate = MPHB.HotelDataManager.myThis.globalRules.getMinCheckOutDate( checkInDate );

			var maxDate = MPHB.HotelDataManager.myThis.globalRules.getMaxCheckOutDate( checkInDate );
			maxDate = this.roomTypeData.getNearestLockedDate( checkInDate, maxDate );
			maxDate = this.roomTypeData.getNearestHaveNotPriceDate( checkInDate, maxDate );
			maxDate = MPHB.HotelDataManager.myThis.dateRules.getNearestNotStayInDate( checkInDate, maxDate );

			if ( this.isCheckOutDateNotValid( checkOutDate, minDate, maxDate ) ) {
				recommendedDate = this.retrieveRecommendedCheckOutDate( minDate, maxDate );
			} else {
				recommendedDate = checkOutDate;
			}
		}

		return {
			minDate: minDate,
			maxDate: maxDate,
			date: recommendedDate
		};
	},
	/**
	 *
	 * @param {Date} minDate
	 * @param {Date} maxDate
	 * @returns {Date|null}
	 */
	retrieveRecommendedCheckOutDate: function( minDate, maxDate ) {
		var recommendedDate = null;
		var expectedDate = new Date( minDate );

		while ( MPHB.Utils.formatDateToCompare( expectedDate ) <= MPHB.Utils.formatDateToCompare( maxDate ) ) {

			var prevDayFormatted = $.datepick.formatDate( 'yyyy-mm-dd', $.datepick.add( new Date( expectedDate ), -1, 'd' ) );

			if (
				!this.isCheckOutDateNotValid( expectedDate, minDate, maxDate ) &&
				this.roomTypeData.hasPriceForDate( prevDayFormatted )
				) {
				recommendedDate = expectedDate;
				break;
			}
			expectedDate = $.datepick.add( expectedDate, 1, 'd' );
		}

		return recommendedDate;

	},
	/**
	 *
	 * @param {Date} checkOutDate
	 * @param {Date} minDate
	 * @param {Date} maxDate
	 * @returns {Boolean}
	 */
	isCheckOutDateNotValid: function( checkOutDate, minDate, maxDate ) {
		return checkOutDate === null
			|| MPHB.Utils.formatDateToCompare( checkOutDate ) < MPHB.Utils.formatDateToCompare( minDate )
			|| MPHB.Utils.formatDateToCompare( checkOutDate ) > MPHB.Utils.formatDateToCompare( maxDate )
			|| !MPHB.HotelDataManager.myThis.globalRules.isCheckOutSatisfy( checkOutDate )
			|| !MPHB.HotelDataManager.myThis.dateRules.canCheckOut( checkOutDate )
	},
	clearDatepickers: function() {
		this.checkInDatepicker.clear();
		this.checkOutDatepicker.clear();
	},
	refreshDatepickers: function() {
		this.checkInDatepicker.refresh();
		this.checkOutDatepicker.refresh();
	}

} );
MPHB.RoomTypeCalendar = can.Control.extend( {}, {
	roomTypeData: null,
	roomTypeId: null,
	init: function( el, args ) {
		this.roomTypeId = parseInt( el.attr( 'id' ).replace( /^mphb-calendar-/, '' ) );
		this.roomTypeData = MPHB.HotelDataManager.myThis.getRoomTypeData( this.roomTypeId );
		var self = this;
		el.hide().datepick( {
			onDate: function( date, current ) {
				var dateData = {
					selectable: false,
					dateClass: 'mphb-date-cell',
					title: '',
				};

				if ( current ) {
					dateData = self.roomTypeData.fillDateData( dateData, date );
				} else {
					dateData.dateClass += ' mphb-extra-date';
				}

				return dateData;
			},
			'minDate': MPHB.HotelDataManager.myThis.today,
			'monthsToShow': MPHB._data.settings.numberOfMonthCalendar,
			'firstDay': MPHB._data.settings.firstDay
		} ).show();

		$( window ).on( 'mphb-update-room-type-data-' + this.roomTypeId, function( e ) {
			self.refresh();
		} );

	},
	refresh: function() {
		this.element.hide();
		$.datepick._update( this.element[0], true );
		this.element.show();
	}

} );
/**
 *
 * @requires ./../datepicker.js
 */
MPHB.RoomTypeCheckInDatepicker = MPHB.Datepicker.extend( {}, {
	init: function( el, args ) {
		this._super( el, args );
		var self = this;
		this.element.datepick( {
			onDate: function( date, current ) {
				var dateData = {
					dateClass: 'mphb-date-cell',
					selectable: false,
					title: ''
				}

				if ( current ) {
					var status = self.form.roomTypeData.getDateStatus( date );
					dateData = self.form.roomTypeData.fillDateData( dateData, date );

					var canCheckIn = status === MPHB.HotelDataManager.ROOM_STATUS_AVAILABLE &&
						MPHB.HotelDataManager.myThis.globalRules.isCheckInSatisfy( date ) &&
						MPHB.HotelDataManager.myThis.dateRules.canCheckIn( date );

					if ( canCheckIn ) {
						dateData.selectable = true;
					}

				} else {
					dateData.dateClass += ' mphb-extra-date';
				}

				if ( dateData.selectable ) {
					dateData.dateClass += ' mphb-date-selectable';
				}

				return dateData;
			},
			onSelect: function( dates ) {
				self.form.updateCheckOutLimitations();
			},
			minDate: MPHB.HotelDataManager.myThis.today,
			monthsToShow: MPHB._data.settings.numberOfMonthDatepicker,
			pickerClass: 'mphb-datepick-popup mphb-check-in-datepick',
			firstDay: MPHB._data.settings.firstDay
		} );
	},
	/**
	 * @param {Date} date
	 */
	setDate: function( date ) {

		if ( date == null ) {
			return this._super( date );
		}

		if ( !MPHB.HotelDataManager.myThis.globalRules.isCheckInSatisfy( date ) ) {
			return this._super( null );
		}

		if ( !MPHB.HotelDataManager.myThis.dateRules.canCheckIn( date ) ) {
			return this._super( null );
		}

		return this._super( date );
	}

} );
/**
 *
 * @requires ./../datepicker.js
 */
MPHB.RoomTypeCheckOutDatepicker = MPHB.Datepicker.extend( {}, {
	init: function( el, args ) {
		this._super( el, args );
		var self = this;
		this.element.datepick( {
			onDate: function( date, current ) {
				var dateData = {
					dateClass: 'mphb-date-cell',
					selectable: false,
					title: ''
				};
				if ( current ) {
					var checkInDate = self.form.checkInDatepicker.getDate();
					var earlierThanMin = self.getMinDate() !== null && MPHB.Utils.formatDateToCompare( date ) < MPHB.Utils.formatDateToCompare( self.getMinDate() );
					var laterThanMax = self.getMaxDate() !== null && MPHB.Utils.formatDateToCompare( date ) > MPHB.Utils.formatDateToCompare( self.getMaxDate() );

					if ( checkInDate !== null && MPHB.Utils.formatDateToCompare( date ) === MPHB.Utils.formatDateToCompare( checkInDate ) ) {
						dateData.dateClass += ' mphb-check-in-date';
						dateData.title += MPHB._data.translations.checkInDate;
					}

					if ( earlierThanMin ) {
						var minStayDate = MPHB.HotelDataManager.myThis.globalRules.getMinCheckOutDate( checkInDate );
						if ( MPHB.Utils.formatDateToCompare( date ) < MPHB.Utils.formatDateToCompare( checkInDate ) ) {
							dateData.dateClass += ' mphb-earlier-min-date mphb-earlier-check-in-date';
						} else if ( MPHB.Utils.formatDateToCompare( date ) < MPHB.Utils.formatDateToCompare( minStayDate ) ) {
							dateData.dateClass += ' mphb-earlier-min-date';
							dateData.title += (dateData.title.length ? ' ' : '') + MPHB._data.translations.lessThanMinDaysStay;
						}
					}

					if ( laterThanMax ) {
						var maxStayDate = MPHB.HotelDataManager.myThis.globalRules.getMaxCheckOutDate( checkInDate );
						if ( MPHB.Utils.formatDateToCompare( date ) < MPHB.Utils.formatDateToCompare( maxStayDate ) ) {
							dateData.title += (dateData.title.length ? ' ' : '') + MPHB._data.translations.laterThanMaxDate;
						} else {
							dateData.title += (dateData.title.length ? ' ' : '') + MPHB._data.translations.moreThanMaxDaysStay;
						}
						dateData.dateClass += ' mphb-later-max-date';
					}

					dateData = self.form.roomTypeData.fillDateData( dateData, date );

					var canCheckOut = !earlierThanMin && !laterThanMax &&
						MPHB.HotelDataManager.myThis.globalRules.isCheckOutSatisfy( date ) &&
						MPHB.HotelDataManager.myThis.dateRules.canCheckOut( date );

					if ( canCheckOut ) {
						dateData.selectable = true;
					}
				} else {
					dateData.dateClass += ' mphb-extra-date';
				}

				if ( dateData.selectable ) {
					dateData.dateClass += ' mphb-selectable-date';
				} else {
					dateData.dateClass += ' mphb-unselectable-date';
				}

				return dateData;
			},
			minDate: MPHB.HotelDataManager.myThis.today,
			monthsToShow: MPHB._data.settings.numberOfMonthDatepicker,
			pickerClass: 'mphb-datepick-popup mphb-check-out-datepick',
			firstDay: MPHB._data.settings.firstDay
		} );
	},
	/**
	 * @param {Date} date
	 */
	setDate: function( date ) {

		if ( date == null ) {
			return this._super( date );
		}

		if ( !MPHB.HotelDataManager.myThis.globalRules.isCheckOutSatisfy( date ) ) {
			return this._super( null );
		}

		if ( !MPHB.HotelDataManager.myThis.dateRules.canCheckOut( date ) ) {
			return this._super( null );
		}

		return this._super( date );
	},
} );
MPHB.RoomTypeData = can.Construct.extend( {}, {
	id: null,
	bookedDates: {},
	havePriceDates: {},
	activeRoomsCount: 0,
	/**
	 *
	 * @param {Object}	data
	 * @param {Object}	data.bookedDates
	 * @param {Object}	data.havePriceDates
	 * @param {int}		data.activeRoomsCount
	 * @returns {undefined}
	 */
	init: function( id, data ) {
		this.id = id;
		this.setRoomsCount( data.activeRoomsCount );
		this.setDates( data.dates );
	},
	update: function( data ) {
		if ( data.hasOwnProperty( 'activeRoomsCount' ) ) {
			this.setRoomsCount( data.activeRoomsCount );
		}

		if ( data.hasOwnProperty( 'dates' ) ) {
			this.setDates( data.dates );
		}

		$( window ).trigger( 'mphb-update-room-type-data-' + this.id );
	},
	/**
	 *
	 * @param {int} count
	 * @returns {undefined}
	 */
	setRoomsCount: function( count ) {
		this.activeRoomsCount = count;
	},
	/**
	 *
	 * @param {Object} dates
	 * @param {Object} dates.bookedDates
	 * @param {Object} dates.havePriceDates
	 * @returns {undefined}
	 */
	setDates: function( dates ) {
		this.bookedDates = dates.hasOwnProperty( 'booked' ) ? dates.booked : {};
		this.havePriceDates = dates.hasOwnProperty( 'havePrice' ) ? dates.havePrice : {};
	},
	/**
	 * @param {String} dateFormatted Date in 'yyyy-mm-dd' format
	 */
	isAvailable: function( dateFormatted ) {
		var lockedDates = this.getLockedDates();
		return !lockedDates.hasOwnProperty( dateFormatted ) || lockedDates[dateFormatted] < this.activeRoomsCount;
	},
	/**
	 *
	 * @param {String} dateFormatted Date in 'yyyy-mm-dd' format
	 * @returns {Boolean}
	 */
	isBooked: function( dateFormatted ) {
		var lockedDates = this.getLockedDates();
		return !lockedDates.hasOwnProperty( dateFormatted ) || lockedDates[dateFormatted] < this.activeRoomsCount;
	},
	/**
	 *
	 * @param {Date} dateFrom
	 * @param {Date} stopDate
	 * @returns {Date|false} Nearest locked room date if exists or false otherwise.
	 */
	getNearestLockedDate: function( dateFrom, stopDate ) {
		var nearestDate = stopDate;
		var self = this;

		var dateFromFormatted = $.datepick.formatDate( 'yyyy-mm-dd', dateFrom );
		var stopDateFormatted = $.datepick.formatDate( 'yyyy-mm-dd', stopDate );

		$.each( self.getLockedDates(), function( bookedDateFormatted, bookedRoomsCount ) {

			if ( stopDateFormatted < bookedDateFormatted ) {
				return false;
			}

			if ( dateFromFormatted > bookedDateFormatted ) {
				return true;
			}

			if ( bookedRoomsCount >= self.activeRoomsCount ) {
				nearestDate = new Date( bookedDateFormatted );
				return false;
			}

		} );
		return nearestDate;
	},
	/**
	 *
	 * @param {Date} dateFrom
	 * @param {Date} stopDate
	 * @returns {Date}
	 */
	getNearestHaveNotPriceDate: function( dateFrom, stopDate ) {
		var nearestDate = new Date( stopDate );
		var expectedDate = new Date( dateFrom );

		while ( MPHB.Utils.formatDateToCompare( expectedDate ) <= MPHB.Utils.formatDateToCompare( stopDate ) ) {
			if ( !this.hasPriceForDate( $.datepick.formatDate( 'yyyy-mm-dd', expectedDate ) ) ) {
				nearestDate = expectedDate;
				break;
			}
			expectedDate = $.datepick.add( expectedDate, 1, 'd' );
		}

		return nearestDate;
	},
	/**
	 *
	 * @returns {Object}
	 */
	getLockedDates: function() {
		var dates = {};
		return $.extend( dates, this.bookedDates );
	},
	/**
	 *
	 * @returns {Object}
	 */
	getHavePriceDates: function() {
		var dates = {};
		return $.extend( dates, this.havePriceDates );
	},
	/**
	 *
	 * @param {Date}
	 * @returns {String}
	 */
	getDateStatus: function( date ) {
		var dateFormatted = $.datepick.formatDate( 'yyyy-mm-dd', date );
		var status = MPHB.HotelDataManager.ROOM_STATUS_AVAILABLE;

		if ( this.isEarlierThanToday( dateFormatted ) ) {
			status = MPHB.HotelDataManager.ROOM_STATUS_PAST;
		} else if ( this.bookedDates.hasOwnProperty( dateFormatted ) && this.bookedDates[dateFormatted] >= this.activeRoomsCount ) {
			status = MPHB.HotelDataManager.ROOM_STATUS_BOOKED;
		} else if ( !this.hasPriceForDate( dateFormatted ) ) {
			status = MPHB.HotelDataManager.ROOM_STATUS_NOT_AVAILABLE;
		}

		return status;
	},
	/**
	 *
	 * @param {string} dateFormatted
	 * @returns {Boolean}
	 */
	hasPriceForDate: function( dateFormatted ) {
		return $.inArray( dateFormatted, this.havePriceDates ) !== -1;
	},
	/**
	 *
	 * @param {Date} date
	 * @returns {int}
	 */
	getAvailableRoomsCount: function( date ) {
		var dateFormatted = $.datepick.formatDate( 'yyyy-mm-dd', date );
		var count = this.bookedDates.hasOwnProperty( dateFormatted ) ? this.activeRoomsCount - this.bookedDates[dateFormatted] : this.activeRoomsCount;
		if ( count < 0 ) {
			count = 0;
		}
		return count;
	},
	/**
	 *
	 * @param {Object} dateData
	 * @param {Date} date
	 * @returns {Object}
	 */
	fillDateData: function( dateData, date ) {
		var status = this.getDateStatus( date );
		var titles = [ ];
		var classes = [ ];

		switch ( status ) {
			case MPHB.HotelDataManager.ROOM_STATUS_PAST:
				classes.push( 'mphb-past-date' );
				titles.push( MPHB._data.translations.past );
				break;
			case MPHB.HotelDataManager.ROOM_STATUS_AVAILABLE:
				classes.push( 'mphb-available-date' );
				titles.push( MPHB._data.translations.available + '(' + this.getAvailableRoomsCount( date ) + ')' );
				break;
			case MPHB.HotelDataManager.ROOM_STATUS_NOT_AVAILABLE:
				classes.push( 'mphb-not-available-date' );
				titles.push( MPHB._data.translations.notAvailable );
				break;
			case MPHB.HotelDataManager.ROOM_STATUS_BOOKED:
				classes.push( 'mphb-booked-date' );
				titles.push( MPHB._data.translations.booked );
				break;
		}

		dateData.dateClass += (dateData.dateClass.length ? ' ' : '') + classes.join( ' ' );
		dateData.title += (dateData.title.length ? ', ' : '') + titles.join( ', ' );

		dateData = MPHB.HotelDataManager.myThis.fillDateCellData( dateData, date );

		return dateData;
	},
	appendRulesToTitle: function( date, title ) {
		var rulesTitles = [ ];

		if ( !MPHB.HotelDataManager.myThis.dateRules.canStayIn( date ) ) {
			rulesTitles.push( MPHB._data.translations.notStayIn );
		}
		if ( !MPHB.HotelDataManager.myThis.dateRules.canCheckIn( date ) ) {
			rulesTitles.push( MPHB._data.translations.notCheckIn );
		}
		if ( !MPHB.HotelDataManager.myThis.dateRules.canCheckOut( date ) ) {
			rulesTitles.push( MPHB._data.translations.notCheckOut );
		}

		if ( rulesTitles.length ) {
			title += ' ' + MPHB._data.translations.rules + ' ' + rulesTitles.join( ', ' );
		}

		return title;
	},
	/**
	 *
	 * @param {String} formattedDate dateFormatted Date in 'yyyy-mm-dd' format
	 * @returns {Boolean}
	 */
	isEarlierThanToday: function( dateFormatted ) {
		var dateObj = new Date( dateFormatted );
		return MPHB.Utils.formatDateToCompare( dateObj ) < MPHB.Utils.formatDateToCompare( MPHB.HotelDataManager.myThis.today );
	},
} );
/**
 *
 * @requires ./../datepicker.js
 */
MPHB.SearchCheckInDatepicker = MPHB.Datepicker.extend( {}, {
	init: function( el, args ) {
		this._super( el, args );
		var self = this;
		el.datepick( {
			onSelect: function( dates ) {
				self.form.updateCheckOutLimitations();
			},
			onDate: function( date, current ) {
				var dateData = {
					dateClass: 'mphb-date-cell',
					selectable: false,
					title: ''
				};

				if ( current ) {

					var canCheckIn = MPHB.HotelDataManager.myThis.globalRules.isCheckInSatisfy( date ) &&
						MPHB.HotelDataManager.myThis.dateRules.canCheckIn( date );

					if ( canCheckIn ) {
						dateData.selectable = true;
					}

					dateData = MPHB.HotelDataManager.myThis.fillDateCellData( dateData, date );

				} else {
					dateData.dateClass += ' mphb-extra-date';
				}

				if ( dateData.selectable ) {
					dateData.dateClass += ' mphb-selectable-date';
				} else {
					dateData.dateClass += ' mphb-unselectable-date';
				}

				return dateData;
			},
			minDate: MPHB.HotelDataManager.myThis.today,
			monthsToShow: MPHB._data.settings.numberOfMonthDatepicker,
			firstDay: MPHB._data.settings.firstDay,
			pickerClass: 'mphb-datepick-popup mphb-check-in-datepick',
		} );
	}
} );
/**
 *
 * @requires ./../datepicker.js
 */
MPHB.SearchCheckOutDatepicker = MPHB.Datepicker.extend( {}, {
	init: function( el, args ) {
		this._super( el, args );
		var self = this;
		el.datepick( {
			onDate: function( date, current ) {
				var dateData = {
					dateClass: 'mphb-date-cell',
					selectable: false,
					title: ''
				};

				if ( current ) {

					var checkInDate = self.form.checkInDatepicker.getDate();
					var earlierThanMin = self.getMinDate() !== null && MPHB.Utils.formatDateToCompare( date ) < MPHB.Utils.formatDateToCompare( self.getMinDate() );
					var laterThanMax = self.getMaxDate() !== null && MPHB.Utils.formatDateToCompare( date ) > MPHB.Utils.formatDateToCompare( self.getMaxDate() );

					if ( checkInDate !== null && MPHB.Utils.formatDateToCompare( date ) === MPHB.Utils.formatDateToCompare( checkInDate ) ) {
						dateData.dateClass += ' mphb-check-in-date';
						dateData.title += MPHB._data.translations.checkInDate;
					}

					if ( earlierThanMin ) {
						if ( MPHB.Utils.formatDateToCompare( date ) < MPHB.Utils.formatDateToCompare( checkInDate ) ) {
							dateData.dateClass += ' mphb-earlier-min-date mphb-earlier-check-in-date';
						} else {
							dateData.dateClass += ' mphb-earlier-min-date';
							dateData.title += (dateData.title.length ? ' ' : '') + MPHB._data.translations.lessThanMinDaysStay;
						}
					}

					if ( laterThanMax ) {
						var maxStayDate = MPHB.HotelDataManager.myThis.globalRules.getMaxCheckOutDate( checkInDate );
						if ( MPHB.Utils.formatDateToCompare( date ) < MPHB.Utils.formatDateToCompare( maxStayDate ) ) {
							dateData.title += (dateData.title.length ? ' ' : '') + MPHB._data.translations.laterThanMaxDate;
						} else {
							dateData.title += (dateData.title.length ? ' ' : '') + MPHB._data.translations.moreThanMaxDaysStay;
						}
						dateData.dateClass += ' mphb-later-max-date';
					}

					dateData = MPHB.HotelDataManager.myThis.fillDateCellData( dateData, date );

					var canCheckOut = !earlierThanMin && !laterThanMax &&
						MPHB.HotelDataManager.myThis.globalRules.isCheckOutSatisfy( date ) &&
						MPHB.HotelDataManager.myThis.dateRules.canCheckOut( date );

					if ( canCheckOut ) {
						dateData.selectable = true;
					}

				} else {
					dateData.dateClass += ' mphb-extra-date';
				}

				if ( dateData.selectable ) {
					dateData.dateClass += ' mphb-selectable-date';
				} else {
					dateData.dateClass += ' mphb-unselectable-date';
				}

				return dateData;
			},
			onSelect: function( dates ) {
			},
			minDate: MPHB.HotelDataManager.myThis.today,
			monthsToShow: MPHB._data.settings.numberOfMonthDatepicker,
			firstDay: MPHB._data.settings.firstDay,
			pickerClass: 'mphb-datepick-popup mphb-check-in-datepick',
		} );
	}
} );
MPHB.SearchForm = can.Control.extend( {}, {
	checkInDatepickerEl: null,
	checkOutDatepickerEl: null,
	checkInDatepicker: null,
	checkOutDatepicker: null,
	init: function( el, args ) {

		this.checkInDatepickerEl = this.element.find( '.mphb-datepick[name=mphb_check_in_date]' );
		this.checkOutDatepickerEl = this.element.find( '.mphb-datepick[name=mphb_check_out_date]' );

		this.checkInDatepicker = new MPHB.SearchCheckInDatepicker( this.checkInDatepickerEl, {'form': this} );
		this.checkOutDatepicker = new MPHB.SearchCheckOutDatepicker( this.checkOutDatepickerEl, {'form': this} );

	},
	/**
	 *
	 * @param {bool} isSetDate
	 * @returns {undefined}
	 */
	updateCheckOutLimitations: function( setDate ) {
		if ( typeof setDate === 'undefined' ) {
			setDate = true;
		}
		var limitations = this.retrieveCheckOutLimitations( this.checkInDatepicker.getDate(), this.checkOutDatepicker.getDate() );

		this.checkOutDatepicker.setOption( 'minDate', limitations.minDate );
		this.checkOutDatepicker.setOption( 'maxDate', limitations.maxDate );
		this.checkOutDatepicker.setDate( setDate ? limitations.date : null );
	},
	retrieveCheckOutLimitations: function( checkInDate, checkOutDate ) {

		var minDate = MPHB.HotelDataManager.myThis.today;
		var maxDate = null;
		var recommendedDate = null;

		if ( checkInDate !== null ) {
			var minDate = MPHB.HotelDataManager.myThis.globalRules.getMinCheckOutDate( checkInDate );

			var maxDate = MPHB.HotelDataManager.myThis.globalRules.getMaxCheckOutDate( checkInDate );
			maxDate = MPHB.HotelDataManager.myThis.dateRules.getNearestNotStayInDate( checkInDate, maxDate );

			if ( this.isCheckOutDateNotValid( checkOutDate, minDate, maxDate ) ) {
				recommendedDate = this.retrieveRecommendedCheckOutDate( minDate, maxDate );
			} else {
				recommendedDate = checkOutDate;
			}

		}

		return {
			minDate: minDate,
			maxDate: maxDate,
			date: recommendedDate
		};
	},
	retrieveRecommendedCheckOutDate: function( minDate, maxDate ) {
		var recommendedDate = null;
		var expectedDate = new Date( minDate );

		while ( MPHB.Utils.formatDateToCompare( expectedDate ) <= MPHB.Utils.formatDateToCompare( maxDate ) ) {
			if ( !this.isCheckOutDateNotValid( expectedDate, minDate, maxDate ) ) {
				recommendedDate = expectedDate;
				break;
			}
			expectedDate = $.datepick.add( expectedDate, 1, 'd' );
		}

		return recommendedDate;

	},
	isCheckOutDateNotValid: function( checkOutDate, minDate, maxDate ) {
		return checkOutDate === null
			|| MPHB.Utils.formatDateToCompare( checkOutDate ) < MPHB.Utils.formatDateToCompare( minDate )
			|| MPHB.Utils.formatDateToCompare( checkOutDate ) > MPHB.Utils.formatDateToCompare( maxDate )
			|| !MPHB.HotelDataManager.myThis.globalRules.isCheckOutSatisfy( checkOutDate )
			|| !MPHB.HotelDataManager.myThis.dateRules.canCheckOut( checkOutDate );
	}

} );
new MPHB.HotelDataManager( MPHB._data );

if ( MPHB._data.page.isCheckoutPage ) {
	new MPHB.CheckoutForm( $( '.mphb_sc_checkout-form' ) );
}

var calendars = $( '.mphb-calendar.mphb-datepick' );
$.each( calendars, function( index, calendarEl ) {
	new MPHB.RoomTypeCalendar( $( calendarEl ) );
} );

var reservationForms = $( '.mphb-booking-form' );
$.each( reservationForms, function( index, formEl ) {
	new MPHB.ReservationForm( $( formEl ) );
} );

var searchForms = $( 'form.mphb_sc_search-form,form.mphb_widget_search-form' );
$.each( searchForms, function( index, formEl ) {
	new MPHB.SearchForm( $( formEl ) );
} );

	} );
})( jQuery );