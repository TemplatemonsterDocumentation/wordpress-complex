<?php

namespace MPHB\Admin\ManageCPTPages;

use \MPHB\PostTypes\BookingCPT;
use \MPHB\Views;
use \MPHB\Entities;

class RoomManageCPTPage extends AbstractManageCPTPage {

	protected function addActionsAndFilters(){
		parent::addActionsAndFilters();
		add_action( 'restrict_manage_posts', array( $this, 'editPostsFilters' ) );

		add_action( 'parse_query', array( $this, 'parseQuery' ) );
		add_filter( 'request', array( $this, 'filterCustomOrderBy' ) );
		add_action( 'admin_footer', array( $this, 'outputScript' ) );
	}

	public function filterColumns( $columns ){
		$customColumns	 = array(
			'room_type' => __( 'Room Type', 'motopress-hotel-booking' )
		);
		$offset			 = array_search( 'date', array_keys( $columns ) ); // Set custom columns position before "DATE" column
		$columns		 = array_slice( $columns, 0, $offset, true ) + $customColumns + array_slice( $columns, $offset, count( $columns ) - 1, true );

		return $columns;
	}

	public function filterSortableColumns( $columns ){
		$columns['room_type'] = 'mphb_room_type_id';

		return $columns;
	}

	public function renderColumns( $column, $postId ){
		$room = MPHB()->getRoomRepository()->findById( $postId );
		switch ( $column ) {
			case 'room_type' :
				$roomTypeId = $room->getRoomTypeId();
				if ( empty( $roomTypeId ) ) {
					echo '<span aria-hidden="true">&#8212;</span>';
				} else {
					$roomType = MPHB()->getRoomTypeRepository()->findById( $roomTypeId );
					printf( '<a href="%s">%s</a>', add_query_arg( 'mphb_room_type_id', $roomTypeId ), $roomType->getTitle() );
				}
				break;
		}
	}

	public function editPostsFilters(){
		global $typenow;
		if ( $typenow === $this->postType ) {
			$selectedId	 = isset( $_GET['mphb_room_type_id'] ) ? $_GET['mphb_room_type_id'] : '';
			$roomTypes	 = MPHB()->getRoomTypeRepository()->getIdTitleList();
			echo '<select name="mphb_room_type_id">';
			echo '<option value="">' . __( 'All Room Types', 'motopress-hotel-booking' ) . '</option>';
			foreach ( $roomTypes as $id => $title ) {
				echo '<option value="' . $id . '" ' . selected( $selectedId, $id, false ) . '>' . $title . '</option>';
			}
			echo '</select>';
		}
	}

	public function parseQuery( $query ){
		if ( $this->isCurrentPage() ) {
			if ( isset( $_GET['mphb_room_type_id'] ) && $_GET['mphb_room_type_id'] != '' ) {
				$query->query_vars['meta_key']		 = 'mphb_room_type_id';
				$query->query_vars['meta_value']	 = sanitize_text_field( $_GET['mphb_room_type_id'] );
				$query->query_vars['meta_compare']	 = 'LIKE';
			}
			remove_action( 'parse_query', array( $this, 'parseQuery' ) );
		}
	}

	public function filterCustomOrderBy( $vars ){
		if ( $this->isCurrentPage() ) {
			if ( isset( $vars['orderby'] ) ) {
				switch ( $vars['orderby'] ) {
					case 'mphb_room_type_id':
						$vars = array_merge( $vars, array(
							'meta_key'	 => 'mphb_room_type_id',
							'orderby'	 => 'meta_value_num'
							) );
						break;
				}
			}
		}
		return $vars;
	}

	public function outputScript(){
		if ( $this->isCurrentPage() ) {
			?>
			<script type="text/javascript">
				(function( $ ) {
					$( function() {
						var generateRoomsButtons = $( '<a />', {
							'class': 'page-title-action',
							'text': '<?php _e( 'Generate Rooms', 'motopress-hotel-booking' ); ?>',
							'href': '<?php echo MPHB()->getRoomsGeneratorMenuPage()->getUrl(); ?>'
						} );
						$( '.page-title-action' ).after( generateRoomsButtons.clone() );
					} );
				})( jQuery );
			</script>
			<?php
		}
	}

}
