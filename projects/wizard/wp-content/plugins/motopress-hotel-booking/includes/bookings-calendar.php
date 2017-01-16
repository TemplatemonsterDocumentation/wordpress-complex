<?php

namespace MPHB;

use \MPHB\Entities;

class BookingsCalendar {

	const ALL_ROOM_TYPES		 = '0';
	const PERIOD_TYPE_MONTH	 = 'month';
	const PERIOD_TYPE_QUARTER	 = 'quarter';
	const PERIOD_TYPE_YEAR	 = 'year';
	const PERIOD_TYPE_CUSTOM	 = 'custom';
	const ATTS_FIELD_NAME		 = 'mphb_bookings_calendar';

	/**
	 *
	 * @var string
	 */
	private $periodType;

	/**
	 *
	 * @var int
	 */
	private $periodPage;

	/**
	 *
	 * @var \DateTime
	 */
	private $customPeriodFrom;

	/**
	 *
	 * @var \DateTime
	 */
	private $customPeriodTo;

	/**
	 *
	 * @var \DatePeriod
	 */
	private $period;

	/**
	 *
	 * @var array
	 */
	private $periodArr;

	/**
	 *
	 * @var \DateTime
	 */
	private $periodStartDate;

	/**
	 *
	 * @var \DateTime
	 */
	private $periodEndDate;

	/**
	 *
	 * @var string
	 */
	private $roomTypeId;

	/**
	 *
	 * @var \WP_POST[]
	 */
	private $roomPosts = array();

	/**
	 *
	 * @var array
	 */
	private $data = array();

	/**
	 *
	 * @var string
	 */
	private $searchRoomAvailabilityStatus;

	/**
	 *
	 * @var \DateTime
	 */
	private $searchDateFrom;

	/**
	 *
	 * @var \DateTime
	 */
	private $searchDateTo;

	/**
	 *
	 * @var bool
	 */
	private $isUseSearch = false;

	/**
	 *
	 * @param array $atts
	 * @param int $atts['room_type_id'] Which room type show. 0 for all room types.
	 * @param string $atts['period_type'] Period to show. Possible values: month, quarter, year, custom.
	 * @param \DateTime $atts['custom_period_from'] First date of custom period. Need period_type set to custom.
	 * @param \DateTime $atts['custom_period_to'] Last date of custom period. Need period_type set to custom.
	 */
	public function __construct( $atts = array() ){
		$defaultAtts = array(
			'room_type_id'						 => self::ALL_ROOM_TYPES,
			'period_type'						 => self::PERIOD_TYPE_MONTH,
			'period_page'						 => 0,
			'custom_period_from'				 => new \DateTime(),
			'custom_period_to'					 => new \DateTime( '+1 month' ),
			'search_date_from'					 => null,
			'search_date_to'					 => null,
			'search_room_availability_status'	 => ''
		);

		$atts	 = array_merge( $defaultAtts, $atts );
		$atts	 = $this->parseFiltersAtts( $atts );

		$this->roomTypeId = absint( $atts['room_type_id'] );

		$this->periodType	 = $atts['period_type'];
		$this->periodPage	 = $atts['period_page'];
		if ( $this->periodType === self::PERIOD_TYPE_CUSTOM ) {
			$this->customPeriodFrom	 = $atts['custom_period_from'];
			$this->customPeriodTo	 = $atts['custom_period_to'];
		}

		$this->searchRoomAvailabilityStatus	 = $atts['search_room_availability_status'];
		$this->searchDateFrom				 = $atts['search_date_from'];
		$this->searchDateTo					 = $atts['search_date_to'];

		$this->isUseSearch = !empty( $this->searchRoomAvailabilityStatus ) &&
			!is_null( $this->searchDateFrom ) &&
			!is_null( $this->searchDateTo );

		$this->setupPeriod();
		$this->setupRooms();
		$this->setupData();
	}

	private function setupRooms(){

		$roomAtts = array(
			'fields'		 => 'all',
			'posts_per_page' => -1
		);

		if ( $this->isUseSearch ) {
			$searchAtts	 = array(
				'availability'	 => $this->searchRoomAvailabilityStatus,
				'from_date'		 => $this->searchDateFrom,
				'to_date'		 => $this->searchDateTo
			);
			$findedRooms = MPHB()->getRoomPersistence()->searchRooms( $searchAtts );

			if ( empty( $findedRooms ) ) {
				$this->roomPosts = array();
				return;
			}

			$roomAtts['post__in'] = $findedRooms;
		}

		if ( $this->roomTypeId != self::ALL_ROOM_TYPES ) {
			$roomAtts['room_type'] = $this->roomTypeId;
		} else {
			$roomAtts['room_type'] = MPHB()->getRoomTypePersistence()->getPosts();
		}

		$this->roomPosts = MPHB()->getRoomPersistence()->getPosts( $roomAtts );
	}

	private function setupData(){
		$data = array();

		$rooms = array_map( function( $roomPost ) {
			return $roomPost->ID;
		}, $this->roomPosts );

		$atts = array(
			'room_locked'	 => true,
			'date_from'		 => $this->periodStartDate->format( 'Y-m-d' ),
			'date_to'		 => $this->periodEndDate->format( 'Y-m-d' ),
			'rooms'			 => $rooms
		);

		$bookings = MPHB()->getBookingRepository()->findAll( $atts );

		foreach ( $bookings as $booking ) {

			$roomId = $booking->getRoom()->getId();
			if ( !array_key_exists( $roomId, $data ) ) {
				$data[$roomId] = array();
			}

			foreach ( $booking->getDates() as $ymdDate => $date ) {
				if ( !isset( $data[$roomId][$ymdDate] ) ) {
					$data[$roomId][$ymdDate] = array();
				}
				$roomDateDetails = array(
					'is_locked'			 => true,
					'is_check_in'		 => $ymdDate === $booking->getCheckInDate()->format( 'Y-m-d' ),
					'booking_status'	 => $booking->getStatus(),
					'booking_id'		 => $booking->getId(),
					'booking_edit_link'	 => $booking->getEditLink()
				);

				$data[$roomId][$ymdDate] = array_merge( $data[$roomId][$ymdDate], $roomDateDetails );
			}

			$checkOutDateYmd = $booking->getCheckOutDate()->format( 'Y-m-d' );
			if ( !isset( $data[$roomId][$checkOutDateYmd] ) ) {
				$data[$roomId][$checkOutDateYmd] = array();
			}

			$data[$roomId][$checkOutDateYmd] = array_merge( $data[$roomId][$checkOutDateYmd], array(
				'is_check_out'				 => true,
				'check_out_booking_id'		 => $booking->getId(),
				'check_out_booking_status'	 => $booking->getStatus()
				)
			);
		}

		$this->data = $data;
	}

	/**
	 *
	 * @param int $roomId
	 * @param \DateTime $date
	 * @return array
	 */
	private function getRoomDateDetails( $roomId, $date ){

		$details = array();

		$dateFormatted	 = $date->format( 'Y-m-d' );
		$details		 = array(
			'is_locked'		 => false,
			'is_check_out'	 => false,
			'is_check_in'	 => false
		);

		if ( isset( $this->data[$roomId] ) && isset( $this->data[$roomId][$dateFormatted] ) ) {
			$details = array_merge( $details, $this->data[$roomId][$dateFormatted] );
		}

		return $details;
	}

	private function setupPeriod(){
		switch ( $this->periodType ) {
			case self::PERIOD_TYPE_QUARTER:
				$this->period	 = Utils\DateUtils::createQuarterPeriod( $this->periodPage );
				break;
			case self::PERIOD_TYPE_YEAR:
				$curYear		 = date( 'Y', current_time( 'timestamp' ) );
				$year			 = $curYear + $this->periodPage;
				$firstDay		 = new \DateTime( 'first day of January ' . $year );
				$lastDay		 = new \DateTime( 'last day of December ' . $year );
				$this->period	 = Utils\DateUtils::createDatePeriod( $firstDay, $lastDay, true );
				break;
			case self::PERIOD_TYPE_CUSTOM:
				$firstDay		 = $this->customPeriodFrom;
				$lastDay		 = $this->customPeriodTo;
				$this->period	 = Utils\DateUtils::createDatePeriod( $firstDay, $lastDay, true );
				break;
			case self::PERIOD_TYPE_MONTH: // default period
			default:
				$baseFirstDay	 = new \DateTime( 'first day of this month' );
				$relationSign	 = $this->periodPage < 0 ? '-' : '+';
				$firstDay		 = clone $baseFirstDay;
				$firstDay->modify( $relationSign . absint( $this->periodPage ) . ' month' );
				$lastDay		 = clone $firstDay;
				$lastDay->modify( 'last day of this month' );
				$this->period	 = Utils\DateUtils::createDatePeriod( $firstDay, $lastDay, true );
				break;
		}

		$this->periodArr = iterator_to_array( $this->period );

		$this->periodEndDate	 = end( $this->periodArr );
		$this->periodStartDate	 = reset( $this->periodArr );
	}

	/**
	 *
	 * @param array $defaults
	 * @return array
	 */
	private function parseFiltersAtts( $defaults = array() ){

		$atts = $defaults;

		if ( isset( $_GET[self::ATTS_FIELD_NAME] ) ) {
			$filtersQuery = $_GET[self::ATTS_FIELD_NAME];

			if ( isset( $filtersQuery['room_type_id'] ) ) {
				$atts['room_type_id'] = absint( $filtersQuery['room_type_id'] );
			}

			if ( isset( $filtersQuery['period'] ) && array_key_exists( $filtersQuery['period'], $this->getPeriodsList() ) ) {
				$atts['period_type'] = $filtersQuery['period'];

				if ( $atts['period_type'] === self::PERIOD_TYPE_CUSTOM ) {
					if ( isset( $filtersQuery['custom_period'] ) && isset( $filtersQuery['custom_period']['date_from'] ) ) {
						$customPeriodFrom = \DateTime::createFromFormat( MPHB()->settings()->dateTime()->getDateFormat(), $filtersQuery['custom_period']['date_from'] );

						$atts['custom_period_from'] = $customPeriodFrom ? $customPeriodFrom : $atts['custom_period_from'];
					}
					if ( isset( $filtersQuery['custom_period'] ) && isset( $filtersQuery['custom_period']['date_to'] ) ) {

						$customPeriodTo = \DateTime::createFromFormat( MPHB()->settings()->dateTime()->getDateFormat(), $filtersQuery['custom_period']['date_to'] );

						$atts['custom_period_to'] = $customPeriodTo ? $customPeriodTo : $atts['custom_period_to'];
						if ( $atts['custom_period_from']->format( 'Y-m-d' ) > $atts['custom_period_to']->format( 'Y-m-d' ) ) {
							$atts['custom_period_to'] = $atts['custom_period_from'];
						}
					}
				} elseif ( isset( $filtersQuery['period_page_' . $atts['period_type']] ) ) {
					$atts['period_page'] = intval( $filtersQuery['period_page_' . $atts['period_type']] );
				}
			}

			// Period modificators
			if ( isset( $filtersQuery['action_period_next'] ) ) {
				$atts['period_page'] ++;
			}
			if ( isset( $filtersQuery['action_period_prev'] ) ) {
				$atts['period_page'] --;
			}

			if ( isset( $filtersQuery['action_search'] ) ) {
				$atts['search_date_from']	 = is_null( $atts['search_date_from'] ) ? new \DateTime( current_time( 'mysql' ) ) : $atts['search_date_from'];
				$atts['search_date_to']		 = is_null( $atts['search_date_to'] ) ? new \DateTime( current_time( 'mysql' ) ) : $atts['search_date_to'];
			}

			if ( isset( $filtersQuery['search_room_availability_status'] ) &&
				!empty( $filtersQuery['search_room_availability_status'] ) &&
				array_key_exists( $filtersQuery['search_room_availability_status'], $this->getSearchRoomAvailabilityStatuses() )
			) {
				$atts['search_room_availability_status'] = $filtersQuery['search_room_availability_status'];
			}

			if ( isset( $filtersQuery['search_date_from'] ) && !empty( $filtersQuery['search_date_from'] ) ) {
				$searchDateFrom				 = \DateTime::createFromFormat( MPHB()->settings()->dateTime()->getDateFormat(), $filtersQuery['search_date_from'] );
				$atts['search_date_from']	 = $searchDateFrom ? $searchDateFrom : $atts['search_date_from'];
			}

			if ( isset( $filtersQuery['search_date_to'] ) && !empty( $filtersQuery['search_date_to'] ) ) {
				$searchDateTo			 = \DateTime::createFromFormat( MPHB()->settings()->dateTime()->getDateFormat(), $filtersQuery['search_date_to'] );
				$atts['search_date_to']	 = $searchDateTo ? $searchDateTo : $atts['search_date_to'];

				// do not allow search "to" date be earlier than "from" date
				if ( !is_null( $atts['search_date_to'] ) &&
					!is_null( $atts['search_date_from'] ) &&
					$atts['search_date_to']->format( 'Ymd' ) < $atts['search_date_from']->format( 'Ymd' )
				) {
					$atts['search_date_to'] = $atts['search_date_from'];
				}
			}
		}

		return $atts;
	}

	private function getPeriodsList(){
		return array(
			self::PERIOD_TYPE_MONTH		 => __( 'Month', 'motopress-hotel-booking' ),
			self::PERIOD_TYPE_QUARTER	 => __( 'Quarter', 'motopress-hotel-booking' ),
			self::PERIOD_TYPE_YEAR		 => __( 'Year', 'motopress-hotel-booking' ),
			self::PERIOD_TYPE_CUSTOM	 => __( 'Custom', 'motopress-hotel-booking' )
		);
	}

	public function render(){
		MPHB()->getAdminScriptManager()->enqueue();
		?>
		<div class="mphb-bookings-calendar-wrapper">
			<?php $this->renderFilters(); ?>
			<div class="mphb-booking-calendar-tables-wrapper">
				<?php $this->renderRoomsTable(); ?>
				<div class="mphb-bookings-calendar-holder">
					<?php $this->renderDatesTable(); ?>
				</div>
			</div>
		</div>
		<?php
	}

	public function renderFilters(){
		?>
		<div class="mphb-bookings-calendar-filters-wrapper">
			<?php
			if ( $this->isUseSearch ) {
				$this->renderSearchResultsLabel();
			}
			?>
			<form id="mphb-bookings-calendar-filters" method="get" class="wp-filter">
				<?php
				$parameters = array();

				if ( isset( $_GET['page'] ) ) {
					$parameters['page'] = $_GET['page'];
				}
				?>
				<div class="mphb-bookings-calendar-date alignleft">
					<?php
					foreach ( $parameters as $paramName => $paramValue ) {
						printf( '<input type="hidden" name="%s" value="%s" />', esc_attr( $paramName ), esc_attr( $paramValue ) );
					}
					?>
					<?php $this->renderRoomTypeSelect(); ?>
					<?php $this->renderPeriodFilter(); ?>
					<?php submit_button( __( 'Show', 'motopress-hotel-booking' ), 'button', self::ATTS_FIELD_NAME . '[action_filter]', false ); ?>
				</div>
				<div class="mphb-bookings-calendar-search alignleft">
					<?php $this->renderRoomSearch() ?>
					<?php submit_button( __( 'Search', 'motopress-hotel-booking' ), 'button', self::ATTS_FIELD_NAME . '[action_search]', false ); ?>
				</div>
				<div class="mphb-bookings-calendar-legend alignright">
					<?php _e( 'Legend:', 'motopress-hotel-booking' ) ?>
					<legend class="legend-item booked"><?php _e( 'Booked', 'motopress-hotel-booking' ); ?></legend>
					<legend class="legend-item pending-user"><?php _e( 'Pending User', 'motopress-hotel-booking' ); ?></legend>
					<legend class="legend-item pending-admin"><?php _e( 'Pending Admin', 'motopress-hotel-booking' ); ?></legend>
				</div>
			</form>
		</div>
		<?php
	}

	private function renderSearchResultsLabel(){
		$availabilityStatuses = $this->getSearchRoomAvailabilityStatuses();

		$status		 = $availabilityStatuses[$this->searchRoomAvailabilityStatus];
		$dateFrom	 = \MPHB\Utils\DateUtils::formatDateWPFront( $this->searchDateFrom );
		$dateTo		 = \MPHB\Utils\DateUtils::formatDateWPFront( $this->searchDateTo );
		?>
		<h3>
			<?php
			printf( __( 'Search results for rooms that have bookings with status "%s" from %s until %s', 'motopress-hotel-booking' ), $status, $dateFrom, $dateTo );
			?>
		</h3>
		<?php
	}

	private function getSearchRoomAvailabilityStatuses(){
		return array(
			''			 => __( 'All', 'motopress-hotel-booking' ),
			'free'		 => __( 'Free', 'motopress-hotel-booking' ),
			'booked'	 => __( 'Booked', 'motopress-hotel-booking' ),
			'pending'	 => __( 'Pending', 'motopress-hotel-booking' ),
			'locked'	 => __( 'Locked', 'motopress-hotel-booking' )
		);
	}

	private function renderRoomSearch(){
		$roomAvailabilityStatuses	 = $this->getSearchRoomAvailabilityStatuses();
		$datesFromToClass			 = $this->searchRoomAvailabilityStatus === '' ? ' mphb-hide' : '';
		$dateFrom					 = !is_null( $this->searchDateFrom ) ? $this->searchDateFrom->format( MPHB()->settings()->dateTime()->getDateFormat() ) : '';
		$dateTo						 = !is_null( $this->searchDateTo ) ? $this->searchDateTo->format( MPHB()->settings()->dateTime()->getDateFormat() ) : '';
		?>
		<label for="mphb-booking-calendar-search-room-availability-status"><?php _e( 'Status:', 'motopress-hotel-booking' ); ?></label>
		<select name="<?php echo esc_attr( self::ATTS_FIELD_NAME ); ?>[search_room_availability_status]"
				id="mphb-booking-calendar-search-room-availability-status">

			<?php foreach ( $roomAvailabilityStatuses as $status => $statusLabel ) : ?>

				<option value="<?php echo esc_attr( $status ); ?>" <?php selected( $this->searchRoomAvailabilityStatus, $status ); ?>>
					<?php echo $statusLabel; ?>
				</option>

			<?php endforeach; ?>

		</select>
		<input type="text"
			   class="mphb-datepick mphb-search-date-from mphb-date-input-width<?php echo esc_attr( $datesFromToClass ); ?>"
			   name="<?php echo esc_attr( self::ATTS_FIELD_NAME ); ?>[search_date_from]"
			   placeholder="<?php esc_attr_e( 'From', 'motopress-hotel-booking' ); ?>"
			   value="<?php echo esc_attr( $dateFrom ); ?>" />
		<input type="text"
			   class="mphb-datepick mphb-search-date-to mphb-date-input-width<?php echo esc_attr( $datesFromToClass ); ?>"
			   name="<?php echo esc_attr( self::ATTS_FIELD_NAME ); ?>[search_date_to]"
			   placeholder="<?php esc_attr_e( 'Until', 'mtopress-hotel-booking' ); ?>"
			   value="<?php echo esc_attr( $dateTo ); ?>"/>

		<?php
	}

	private function renderRoomTypeSelect(){
		$roomTypes = MPHB()->getRoomTypePersistence()->getPosts(
			array(
				'fields' => 'all'
			)
		);
		?>
		<label for="mphb-bookings-calendar-filter-room-type"><?php _e( 'Room Type:', 'motopress-hotel-booking' ); ?></label>
		<select id="mphb-bookings-calendar-filter-room-type"
				name="<?php echo esc_attr( self::ATTS_FIELD_NAME ); ?>[room_type_id]">
			<option <?php selected( $this->roomTypeId, self::ALL_ROOM_TYPES ); ?> value="<?php echo self::ALL_ROOM_TYPES; ?>" >
				<?php _e( 'All', 'motopress-hotel-booking' ); ?>
			</option>

			<?php foreach ( $roomTypes as $roomType ) : ?>

				<option <?php selected( $this->roomTypeId, $roomType->ID ); ?> value="<?php echo esc_attr( $roomType->ID ); ?>">
					<?php echo $roomType->post_title; ?>
				</option>

			<?php endforeach; ?>

		</select>
		<?php
	}

	private function renderPeriodFilter(){
		$periods		 = $this->getPeriodsList();
		$prevNextClass	 = $this->periodType === 'custom' ? ' mphb-hide' : '';
		?>
		<?php
		foreach ( $periods as $period => $periodLabel ) :
			if ( $period === self::PERIOD_TYPE_CUSTOM ) {
				continue;
			}
			$periodPage = $this->periodType === $period ? $this->periodPage : 0;
			?>
			<input type="hidden" name="<?php echo esc_attr( self::ATTS_FIELD_NAME . '[period_page_' . $period . ']' ); ?>" value="<?php echo esc_attr( $periodPage ); ?>"  />
		<?php endforeach; ?>

		<label for="mphb-bookings-calendar-filter-period"><?php _e( 'Period:', 'motopress-hotel-booking' ); ?></label>
		<?php submit_button( __( '&lt; Prev', 'motopress-hotel-booking' ), 'button mphb-period-prev' . $prevNextClass, self::ATTS_FIELD_NAME . '[action_period_prev]', false ); ?>
		<select id="mphb-bookings-calendar-filter-period" name="<?php echo self::ATTS_FIELD_NAME; ?>[period]">
			<?php foreach ( $periods as $period => $periodLabel ) : ?>
				<option <?php selected( $this->periodType, $period ); ?> value="<?php echo $period; ?>">
					<?php echo $periodLabel; ?>
				</option>
			<?php endforeach; ?>
		</select>
		<?php
		submit_button( __( 'Next &gt;', 'motopress-hotel-booking' ), 'button mphb-period-next' . $prevNextClass, self::ATTS_FIELD_NAME . '[action_period_next]', false );
		$this->renderCustomPeriodFilter();
	}

	private function renderCustomPeriodFilter(){
		$customPeriodWrapperClass = $this->periodType !== 'custom' ? ' mphb-hide' : '';

		$dateFrom	 = !is_null( $this->customPeriodFrom ) ? $this->customPeriodFrom->format( MPHB()->settings()->dateTime()->getDateFormat() ) : '';
		$dateTo		 = !is_null( $this->customPeriodTo ) ? $this->customPeriodTo->format( MPHB()->settings()->dateTime()->getDateFormat() ) : '';
		?>
		<div class="mphb-custom-period-wrapper<?php echo $customPeriodWrapperClass; ?>">
			<input type="text" class="mphb-datepick mphb-custom-period-from mphb-date-input-width" name="<?php echo self::ATTS_FIELD_NAME; ?>[custom_period][date_from]" placeholder="<?php _e( 'From', 'motopress-hotel-booking' ); ?>" value="<?php echo $dateFrom; ?>"/>
			<input type="text" class="mphb-datepick mphb-custom-period-to mphb-date-input-width" name="<?php echo self::ATTS_FIELD_NAME; ?>[custom_period][date_to]" placeholder="<?php _e( 'Until', 'motopress-hotel-booking' ); ?>" value="<?php echo $dateTo; ?>"/>
		</div>
		<?php
	}

	public function renderRoomsTable(){
		?>
		<table class="mphb-bookings-calendar-rooms widefat">
			<thead>
				<tr>
					<th><?php _e( 'Room', 'motopress-hotel-booking' ); ?></th>
				</tr>
			</thead>
			<tbody>
				<?php if ( !empty( $this->roomPosts ) ) : ?>
					<?php foreach ( $this->roomPosts as $roomPost ) : ?>
						<tr>
							<td title="<?php echo $roomPost->post_title; ?>">
								<a href="<?php echo get_edit_post_link( $roomPost->ID ); ?>"><?php echo $roomPost->post_title; ?></a>
							</td>
						</tr>
					<?php endforeach; ?>
				<?php else : ?>
					<tr><td></td></tr>
				<?php endif; ?>
			</tbody>
			<tfoot>
				<tr>
					<th><?php _e( 'Room', 'motopress-hotel-booking' ); ?></th>
				</tr>
			</tfoot>
		</table>
		<?php
	}

	function renderDatesTable(){
		?>
		<table class="mphb-bookings-date-table widefat">
			<thead>
				<?php $this->renderDatesTableHeadingsRow(); ?>
			</thead>
			<tbody>
				<?php if ( !empty( $this->roomPosts ) ) : ?>
					<?php foreach ( $this->roomPosts as $roomPost ) : ?>
						<tr room-id="<?php echo $roomPost->ID; ?>">
							<?php
							foreach ( $this->periodArr as $date ) {
								$this->renderPseudoCell( $roomPost->ID, $date );
							}
							?>
						</tr>
					<?php endforeach; // rooms loop      ?>
				<?php else : ?>
					<tr>
						<td class="mphb-no-rooms-found" colspan="<?php echo \MPHB\Utils\DateUtils::calcNights( $this->periodStartDate, $this->periodEndDate ) * 2; ?>">
							<?php _e( 'No rooms found.', 'motopress-hotel-booking' ); ?>
						</td>
					</tr>
				<?php endif; ?>
			</tbody>
			<tfoot>
				<?php $this->renderDatesTableHeadingsRow(); ?>
			</tfoot>
		</table>
		<?php
	}

	public function renderDatesTableHeadingsRow(){
		?>
		<tr>
			<?php foreach ( $this->periodArr as $date ) : ?>
				<?php $isToday = $date->format( 'Y-m-d' ) === current_time( 'Y-m-d' ); ?>
				<?php $thClass = $isToday ? 'mphb-date-today' : ''; ?>
				<th colspan="2" class="<?php echo $thClass; ?>">
					<small><?php echo $date->format( 'D' ); ?></small>
					<br />
					<?php echo $date->format( 'j' ); ?>
					<br />
					<?php echo $date->format( 'M' ); ?>
				</th>
			<?php endforeach; ?>
		</tr>
		<?php
	}

	/**
	 *
	 * @param string $roomId
	 * @param \DateTime $date
	 */
	private function renderPseudoCell( $roomId, $date ){
		$firstPartClass		 = '';
		$secondPartClass	 = '';
		$firstPartContent	 = '';
		$secondPartContent	 = '';

		$dateDetails = $this->getRoomDateDetails( $roomId, $date );
		$isToday	 = $date->format( 'Y-m-d' ) === mphb_current_time( 'Y-m-d' );
		if ( $isToday ) {
			$firstPartClass .= ' mphb-date-today';
			$secondPartClass .= ' mphb-date-today';
		}

		if ( $dateDetails['is_check_in'] ) {
			$secondPartClass .= ' mphb-date-check-in';
			switch ( $dateDetails['booking_status'] ) {
				case \MPHB\PostTypes\BookingCPT\Statuses::STATUS_CONFIRMED:
					$secondPartClass .= ' mphb-date-check-in-booked';
					break;
				case \MPHB\PostTypes\BookingCPT\Statuses::STATUS_PENDING:
					$secondPartClass .= ' mphb-date-check-in-pending mphb-date-check-in-pending-admin';
					break;
				case \MPHB\PostTypes\BookingCPT\Statuses::STATUS_PENDING_USER:
					$secondPartClass .= ' mphb-date-check-in-pending mphb-date-check-in-pending-user';
					break;
			}
		}

		if ( $dateDetails['is_check_out'] ) {
			$firstPartClass .= ' mphb-date-check-out';
			switch ( $dateDetails['check_out_booking_status'] ) {
				case \MPHB\PostTypes\BookingCPT\Statuses::STATUS_CONFIRMED:
					$firstPartClass .= ' mphb-date-check-out-booked';
					break;
				case \MPHB\PostTypes\BookingCPT\Statuses::STATUS_PENDING:
					$firstPartClass .= ' mphb-date-check-out-pending mphb-date-check-out-pending-admin';
					break;
				case \MPHB\PostTypes\BookingCPT\Statuses::STATUS_PENDING_USER:
					$firstPartClass .= ' mphb-date-check-out-pending mphb-date-check-out-pending-user';
					break;
			}
		}

		if ( $dateDetails['is_locked'] ) {
			if ( !$dateDetails['is_check_in'] && !$dateDetails['is_check_out'] ) {
				$firstPartClass .= ' mphb-date-room-locked';
				switch ( $dateDetails['booking_status'] ) {
					case \MPHB\PostTypes\BookingCPT\Statuses::STATUS_CONFIRMED:
						$firstPartClass .= ' mphb-date-booked';
						break;
					case \MPHB\PostTypes\BookingCPT\Statuses::STATUS_PENDING:
						$firstPartClass .= ' mphb-date-pending mphb-date-pending-admin';
						break;
					case \MPHB\PostTypes\BookingCPT\Statuses::STATUS_PENDING_USER:
						$firstPartClass .= ' mphb-date-pending mphb-date-pending-user';
						break;
				}
			}

			if ( $dateDetails['is_check_in'] ) {
				$secondPartContent = '<a class="mphb-link-to-booking" href="' . $dateDetails['booking_edit_link'] . '">' . $dateDetails['booking_id'] . '</a>';
			} else {
				$firstPartContent	 = '<a class="mphb-silent-link-to-booking" href="' . $dateDetails['booking_edit_link'] . '"></a>';
				$secondPartContent	 = '<a class="mphb-silent-link-to-booking" href="' . $dateDetails['booking_edit_link'] . '"></a>';
			}
			$secondPartClass .= ' mphb-date-room-locked';
			switch ( $dateDetails['booking_status'] ) {
				case \MPHB\PostTypes\BookingCPT\Statuses::STATUS_CONFIRMED:
					$secondPartClass .= ' mphb-date-booked';
					break;
				case \MPHB\PostTypes\BookingCPT\Statuses::STATUS_PENDING:
					$secondPartClass .= ' mphb-date-pending mphb-date-pending-admin';
					break;
				case \MPHB\PostTypes\BookingCPT\Statuses::STATUS_PENDING_USER:
					$secondPartClass .= ' mphb-date-pending mphb-date-pending-user';
					break;
			}
		}

		if ( !$dateDetails['is_locked'] ) {
			if ( !$dateDetails['is_check_out'] ) {
				$firstPartClass .= ' mphb-date-free';
			}
			$secondPartClass .= ' mphb-date-free';
		}

		$title = $this->generateCellTitle( $date, $dateDetails );
		?>
		<td class="mphb-date-first-part <?php echo $firstPartClass; ?>" title="<?php echo $title; ?>"><?php echo $firstPartContent; ?></td>
		<td class="mphb-date-second-part <?php echo $secondPartClass; ?>" title="<?php echo $title; ?>"><?php echo $secondPartContent; ?></td>
		<?php
	}

	/**
	 *
	 * @param \DateTime $date
	 * @param array $dateDetails
	 * @return string
	 */
	private function generateCellTitle( $date, $dateDetails ){
		$titleDate			 = $date->format( 'D j, M Y:' );
		$titleAvailability	 = array();
		if ( $dateDetails['is_check_out'] ) {
			$titleAvailability[] = sprintf( __( 'Check-out #%d', 'motopress-hotel-booking' ), (int) $dateDetails['check_out_booking_id'] );
		}
		if ( $dateDetails['is_check_in'] ) {
			$titleAvailability[] = sprintf( __( 'Check-in #%d', 'motopress-hotel-booking' ), (int) $dateDetails['booking_id'] );
		} elseif ( $dateDetails['is_locked'] ) {
			$titleAvailability[] = sprintf( __( 'Booking #%d', 'motopress-hotel-booking' ), (int) $dateDetails['booking_id'] );
		} else {
			$titleAvailability[] = __( 'Free', 'motopress-hotel-booking' );
		}

		$title = $titleDate . ' ' . join( ', ', $titleAvailability );

		return $title;
	}

}
