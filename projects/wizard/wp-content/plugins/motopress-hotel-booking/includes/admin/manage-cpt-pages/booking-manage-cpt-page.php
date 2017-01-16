<?php

namespace MPHB\Admin\ManageCPTPages;

use \MPHB\PostTypes\BookingCPT;
use \MPHB\Views;
use \MPHB\Entities;

class BookingManageCPTPage extends AbstractManageCPTPage {

	protected function addActionsAndFilters(){
		parent::addActionsAndFilters();

		add_filter( 'request', array( $this, 'filterCustomOrderBy' ) );

		add_filter( 'post_row_actions', array( $this, 'filterRowActions' ) );
		add_action( 'restrict_manage_posts', array( $this, 'editPostsFilters' ) );

		if ( is_admin() ) {
			add_action( 'parse_query', array( $this, 'setQueryVarsSearchEmail' ) );
			add_filter( 'posts_join', array( $this, 'extendSearchPostsJoin' ), 10, 2 );
			add_filter( 'posts_search', array( $this, 'extendPostsSearch' ), 10, 2 );
			add_filter( 'posts_search_orderby', array( $this, 'extendPostsSearchOrderBy' ), 10, 2 );
		}

		// Bulk actions
		add_filter( 'bulk_actions-edit-' . $this->postType, array( $this, 'filterBulkActions' ) );
		add_action( 'admin_notices', array( $this, 'bulkAdminNotices' ) );
		add_action( 'admin_footer', array( $this, 'bulkAdminScript' ), 10 );
		add_action( 'load-edit.php', array( $this, 'bulkAction' ) );
	}

	public function filterColumns( $columns ){

		if ( isset( $columns['title'] ) ) {
			unset( $columns['title'] );
		}

		$customColumns = array(
			'id'				 => __( 'ID', 'motopress-hotel-booking' ),
			'status'			 => __( 'Status', 'motopress-hotel-booking' ),
			'room'				 => __( 'Room', 'motopress-hotel-booking' ),
			'rate'				 => __( 'Rate', 'motopress-hotel-booking' ),
			'check_in_out_date'	 => __( 'Check-in / Check-out', 'motopress-hotel-booking' ),
			'guests'			 => __( 'Guests', 'motopress-hotel-booking' ),
			'services'			 => __( 'Services', ',motopress-hotel-booking' ),
			'customer_info'		 => __( 'Customer Info', 'motopress-hotel-booking' ),
			'price'				 => __( 'Price', 'motopress-hotel-booking' ),
			'mphb_date'			 => __( 'Date', 'motopress-hotel-booking' )
		);

		$offset	 = array_search( 'date', array_keys( $columns ) ); // Set custom columns position before "DATE" column
		$columns = array_slice( $columns, 0, $offset, true ) + $customColumns + array_slice( $columns, $offset, count( $columns ) - 1, true );

		unset( $columns['date'] );
		return $columns;
	}

	public function filterSortableColumns( $columns ){

		$columns['id']				 = 'ID';
		$columns['room']			 = 'mphb_room_id';
		$columns['check_in_date']	 = 'mphb_check_in_date';
		$columns['check_out_date']	 = 'mphb_check_out_date';

		return $columns;
	}

	public function renderColumns( $column, $postId ){
		$booking = MPHB()->getBookingRepository()->findById( $postId );
		switch ( $column ) {
			case 'id':
				printf( '<a href="%s"><strong>#%s</strong></a>', get_edit_post_link( $postId ), $postId );
				break;
			case 'status':
				?><span class="column-status-<?php echo $booking->getStatus(); ?>"><?php echo mphb_get_status_label( $booking->getStatus() ); ?></span><?php
				if ( $booking->getStatus() === BookingCPT\Statuses::STATUS_PENDING_USER ) {
					$expireTime = $booking->retrieveExpiration();
					if ( $expireTime ) {
						$currentTime = current_time( 'timestamp', true );
						echo '<br/>';
						echo '<small>';
						if ( $expireTime > $currentTime ) {
							printf( __( 'Expire %s', 'motopress-hotel-booking' ), human_time_diff( $currentTime, $expireTime ) );
						} else {
							_e( 'Expired', 'motopress-hotel-booking' );
						}
						echo '</small>';
					}
				}
				break;
			case 'room' :
				$room	 = $booking->getRoom();
				echo (!is_null( $room )) ? '<a href="' . $room->getEditLink() . '">' . $room->getTitle() . '</a>' : '<span aria-hidden="true">&#8212;</span>';
				break;
			case 'rate':
				$rate	 = $booking->getRoomRate();
				echo (!is_null( $rate )) ? '<span title="' . esc_attr( $rate->getDescription() ) . '">' . $rate->getTitle() . '</span>' : '<span aria-hidden="true">&#8212;</span>';
				break;
			case 'check_in_out_date' :

				$checkInDate	 = $booking->getCheckInDate();
				$checkOutDate	 = $booking->getCheckOutDate();

				echo (!is_null( $checkInDate )) ? '<time title="' . \MPHB\Utils\DateUtils::formatDateWPFront( $checkInDate ) . '">' . date_i18n( 'M j', $checkInDate->format( 'U' ) ) . '</time>' : '<span aria-hidden="true">&#8212;</span>';
				echo ' - ';
				echo (!is_null( $checkOutDate )) ? '<time title="' . \MPHB\Utils\DateUtils::formatDateWPFront( $checkOutDate ) . '">' . date_i18n( 'M j', $checkOutDate->format( 'U' ) ) . '</time>' : '<span aria-hidden="true">&#8212;</span>';
				echo '<br/>';

				if ( !is_null( $checkInDate ) && !is_null( $checkOutDate ) ) {
					$nights = \MPHB\Utils\DateUtils::calcNights( $checkInDate, $checkOutDate );
					?><em><?php printf( _n( '%s night', '%s nights', $nights, 'motopress-hotel-booking' ), $nights ); ?></em><?php
				}

				break;
			case 'guests':
				_e( 'Adults: ', 'motopress-hotel-booking' );
				echo $booking->getAdults() . '<br/>';
				_e( 'Children: ', 'motopress-hotel-booking' );
				echo $booking->getChildren();
				break;
			case 'services':
				Views\BookingView::renderServicesList( $booking );
				break;
			case 'customer_info':
				$customer = $booking->getCustomer();
				?>
				<p>
					<?php if ( $customer ) : ?>
						<?php echo esc_html( $customer->getFirstName() . ' ' . $customer->getLastName() ); ?>
						<br>
						<a href="mailto:<?php echo esc_html( $customer->getEmail() ); ?>">
							<?php echo esc_html( $customer->getEmail() ); ?>
						</a>
						<br>
						<a href="tel:<?php echo esc_html( $customer->getPhone() ); ?>">
							<?php echo esc_html( $customer->getPhone() ); ?>
						</a>
					<?php else: ?>
						<span aria-hidden="true">&#8212;</span>
					<?php endif; ?>
					<?php if ( $booking->getNote() && 1 == 2 ) { ?>
						<br>
						<span><?php _e( 'Note: ', 'motopress-hotel-booking' ); ?></span><strong><?php echo esc_html( $booking->getNote() ); ?></strong>
					<?php } ?>
				</p>
				<?php
				break;
			case 'price':
				echo Views\BookingView::renderTotalPriceHTML( $booking );
				echo '<br/>';
				echo $booking->getPaymentStatusLabel();
				break;
			case 'mphb_date':
				?>
				<abbr title="<? echo get_the_date( MPHB()->settings()->dateTime()->getDateTimeFormatWP(), $postId ); ?>">
					<?php echo get_the_date( 'Y/m/d', $postId ); ?>
				</abbr>
				<?php
				break;
		}
	}

	public function filterRowActions( $actions ){
		// Prevent Quick Edit
		if ( $this->isCurrentPage() ) {
			if ( isset( $actions['inline hide-if-no-js'] ) ) {
				unset( $actions['inline hide-if-no-js'] );
			}
		}

		return $actions;
	}

	public function editPostsFilters(){
		global $typenow;
		if ( $typenow === $this->postType ) {
			$email = isset( $_GET['mphb_email'] ) ? $_GET['mphb_email'] : '';
			echo '<input type="text" name="mphb_email" placeholder="' . esc_attr__( 'Email', 'motopress-hotel-booking' ) . '" value="' . esc_attr( $email ) . '" />';
		}
	}

	public function filterBulkActions( $bulkActions ){
		if ( isset( $bulkActions['edit'] ) ) {
			unset( $bulkActions['edit'] );
		}
		return $bulkActions;
	}

	/**
	 * Add extra bulk action options to change booking status.
	 *
	 * Using Javascript until WordPress core fixes: http://core.trac.wordpress.org/ticket/16031.
	 */
	public function bulkAdminScript(){
		if ( $this->isCurrentPage() ) {
			$optionText = __( 'Set to %s', 'motopress-hotel-booking' );
			?>
			<script type="text/javascript">
				(function( $ ) {
					$( function() {
						var options = [
							$( '<option />', {
								value: 'set-status-<?php echo BookingCPT\Statuses::STATUS_PENDING; ?>',
								text: '<?php printf( $optionText, mphb_get_status_label( BookingCPT\Statuses::STATUS_PENDING ) ); ?>'
							} ),
							$( '<option />', {
								value: 'set-status-<?php echo BookingCPT\Statuses::STATUS_PENDING_USER; ?>',
								text: '<?php printf( $optionText, mphb_get_status_label( BookingCPT\Statuses::STATUS_PENDING_USER ) ); ?>'
							} ),
							$( '<option />', {
								value: 'set-status-<?php echo BookingCPT\Statuses::STATUS_ABANDONED; ?>',
								text: '<?php printf( $optionText, mphb_get_status_label( BookingCPT\Statuses::STATUS_ABANDONED ) ); ?>'
							} ),
							$( '<option />', {
								value: 'set-status-<?php echo BookingCPT\Statuses::STATUS_CONFIRMED; ?>',
								text: '<?php printf( $optionText, mphb_get_status_label( BookingCPT\Statuses::STATUS_CONFIRMED ) ); ?>'
							} ),
							$( '<option />', {
								value: 'set-status-<?php echo BookingCPT\Statuses::STATUS_CANCELLED; ?>',
								text: '<?php printf( $optionText, mphb_get_status_label( BookingCPT\Statuses::STATUS_CANCELLED ) ); ?>'
							} )
						];

						var topBulkSelect = $( 'select[name="action"]' );
						var bottomBulkSelect = $( 'select[name="action2"]' );

						$.each( options, function( index, option ) {
							topBulkSelect.append( option.clone() );
							bottomBulkSelect.append( option.clone() );
						} );

					} );
				})( jQuery )
			</script>
			<?php
		}
	}

	/**
	 * Process the new bulk actions for changing booking status.
	 */
	public function bulkAction(){
		$wp_list_table	 = _get_list_table( 'WP_Posts_List_Table' );
		$action			 = $wp_list_table->current_action();

		if ( strpos( $action, 'set-status-' ) === false ) {
			return;
		}

		$allowedStatuses = MPHB()->postTypes()->booking()->statuses()->getStatuses();

		$newStatus		 = substr( $action, 11 );
		$reportAction	 = 'setted-status-' . $newStatus;

		if ( !isset( $allowedStatuses[$newStatus] ) ) {
			return;
		}

		check_admin_referer( 'bulk-posts' );

		$postIds = isset( $_REQUEST['post'] ) ? array_map( 'absint', (array) $_REQUEST['post'] ) : array();

		if ( empty( $postIds ) ) {
			return;
		}

		$changed = 0;
		foreach ( $postIds as $postId ) {

			$booking = MPHB()->getBookingRepository()->findById( $postId );
			$booking->setStatus( $newStatus );

			if ( $booking->isValid() && MPHB()->getBookingRepository()->save( $booking ) ) {
				$changed++;
			}
		}

		$queryArgs	 = array(
			'post_type'		 => $this->postType,
			$reportAction	 => true,
			'changed'		 => $changed,
			'ids'			 => join( ',', $postIds ),
			'paged'			 => $wp_list_table->get_pagenum()
		);
		$sendback	 = add_query_arg( $queryArgs, admin_url( 'edit.php' ) );

		if ( isset( $_GET['post_status'] ) ) {
			$sendback = add_query_arg( 'post_status', sanitize_text_field( $_GET['post_status'] ), $sendback );
		}

		wp_redirect( esc_url_raw( $sendback ) );
		exit();
	}

	/**
	 * Show message that booking status changed for number of bookings.
	 */
	public function bulkAdminNotices(){
		if ( $this->isCurrentPage() ) {
			// Check if any status changes happened
			foreach ( MPHB()->postTypes()->booking()->statuses()->getStatuses() as $slug => $details ) {

				if ( isset( $_REQUEST['setted-status-' . $slug] ) ) {

					$number	 = isset( $_REQUEST['changed'] ) ? absint( $_REQUEST['changed'] ) : 0;
					$message = sprintf( _n( 'Booking status changed.', '%s booking statuses changed.', $number, 'motopress-hotel-booking' ), number_format_i18n( $number ) );
					echo '<div class="updated"><p>' . $message . '</p></div>';

					break;
				}
			}
		}
	}

	public function setQueryVarsSearchEmail( $query ){
		if ( $this->isCurrentPage() ) {
			if ( isset( $_GET['mphb_email'] ) && $_GET['mphb_email'] != '' ) {
				$query->query_vars['meta_key']		 = 'mphb_email';
				$query->query_vars['meta_value']	 = sanitize_text_field( $_GET['mphb_email'] );
				$query->query_vars['meta_compare']	 = 'LIKE';
			}
		}
	}

	public function extendSearchPostsJoin( $join, $wp_query ){
		global $wpdb;
		if ( $this->isCurrentPage() && !empty( $wp_query->query['s'] ) ) {
			for ( $i = 0; $i < $wp_query->query_vars['search_terms_count']; $i++ ) {
				$join .= " LEFT JOIN $wpdb->postmeta AS mphb_postmeta_{$i} ON $wpdb->posts.ID = mphb_postmeta_{$i}.post_id ";
			}
		}
		return $join;
	}

	public function extendPostsSearch( $where, $wp_query ){
		global $wpdb;

		if ( $this->isCurrentPage() && !empty( $wp_query->query['s'] ) ) {

			preg_match( '/Booking #(?<id>[\d]*)/', trim( $wp_query->query['s'] ), $booking );

			if ( isset( $booking['id'] ) && is_numeric( $booking['id'] ) ) {
				$where = $wpdb->prepare( " AND ($wpdb->posts.ID = %d)", absint( $booking['id'] ) );
				unset( $wp_query->query['s'] );
			} else {
				$searchFields = array(
					'mphb_email',
					'mphb_phone',
					'mphb_first_name',
					'mphb_last_name'
				);

				$extendedSearchStr	 = '';
				$n					 = !empty( $q['exact'] ) ? '' : '%';
				$searchand			 = '';
				foreach ( $wp_query->query_vars['search_terms'] as $index => $term ) {
					// Terms prefixed with '-' should be excluded.
					$include = '-' !== substr( $term, 0, 1 );
					if ( $include ) {
						$like_op	 = 'LIKE';
						$andor_op	 = 'OR';
					} else {
						$like_op	 = 'NOT LIKE';
						$andor_op	 = 'AND';
						$term		 = substr( $term, 1 );
					}

					$like			 = $n . $wpdb->esc_like( $term ) . $n;
					$fieldSearches	 = array();
					foreach ( $searchFields as $field ) {
						$fieldSearches[] = $wpdb->prepare( "( mphb_postmeta_{$index}.meta_key = %s AND CAST( mphb_postmeta_{$index}.meta_value as CHAR ) {$like_op} %s )", $field, $like );
					}

					$fieldSearchesStr	 = join( ' ' . $andor_op . ' ', $fieldSearches );
					$extendedSearchStr .= "{$searchand} ( {$fieldSearchesStr} )";
					$searchand			 = ' AND ';
				}

				if ( !empty( $extendedSearchStr ) ) {
					$extendedSearchStr = " AND ({$extendedSearchStr}) ";
				}

				$where = $extendedSearchStr;
			}
		}

		return $where;
	}

	public function extendPostsSearchOrderBy( $orderBy, $wp_query ){
		// Prevent OrderBy Search terms
		return '';
	}

	public function filterCustomOrderBy( $vars ){
		if ( $this->isCurrentPage() && isset( $vars['orderby'] ) ) {
			switch ( $vars['orderby'] ) {
				case 'mphb_check_in_date':
					$vars	 = array_merge( $vars, array(
						'meta_key'	 => 'mphb_check_in_date',
						'orderby'	 => 'meta_value',
						'meta_type'	 => 'DATE'
						) );
					break;
				case 'mphb_check_out_date':
					$vars	 = array_merge( $vars, array(
						'meta_key'	 => 'mphb_check_out_date',
						'orderby'	 => 'meta_value',
						'meta_type'	 => 'DATE'
						) );
					break;
				case 'mphb_room_id':
					$vars	 = array_merge( $vars, array(
						'meta_key'	 => '',
						'orderby'	 => 'mphb_room_id'
						) );
					break;
			}
		}
		return $vars;
	}

}
