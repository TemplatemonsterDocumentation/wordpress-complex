<?php

namespace MPHB\Admin\ManageCPTPages;

use \MPHB\Entities;

class RoomTypeManageCPTPage extends AbstractManageCPTPage {

	public function __construct( $postType, $args = array() ){
		parent::__construct( $postType, $args );
		add_action( 'parse_query', array( $this, 'parseQuery' ) );
		add_filter( 'request', array( $this, 'filterCustomOrderBy' ) );
	}

	public function filterColumns( $columns ){
		$idColumn		 = array( 'id' => __( 'ID', 'motopress-hotel-booking' ) );
		$customColumns	 = array(
			'capacity'	 => __( 'Capacity', 'motopress-hotel-booking' ),
			'bed'		 => __( 'Bed Type', 'motopress-hotel-booking' ),
			'rooms'		 => __( 'Rooms', 'motopress-hotel-booking' )
		);

		$cbOffset	 = array_search( 'cb', array_keys( $columns ) ) + 1;
		// set id column after checkboxes column
		$columns	 = array_slice( $columns, 0, $cbOffset, true ) + $idColumn + array_slice( $columns, $cbOffset, count( $columns ) - 1, true );

		// Set custom columns position before "DATE" column
		$offset	 = array_search( 'date', array_keys( $columns ) );
		$columns = array_slice( $columns, 0, $offset, true ) + $customColumns + array_slice( $columns, $offset, count( $columns ) - 1, true );

		return $columns;
	}

	public function filterSortableColumns( $columns ){
		$columns['bed']	 = 'mphb_bed';
		$columns['id']	 = 'id';

		return $columns;
	}

	public function renderColumns( $column, $postId ){
		$roomType = MPHB()->getRoomTypeRepository()->findById( $postId );
		switch ( $column ) {
			case 'id':
				echo $roomType->getId();
				break;
			case 'capacity' :
				?>
				<p><?php _e( 'Adults:', 'motopress-hotel-booking' ); ?>&nbsp;<?php echo $roomType->getAdultsCapacity(); ?><br/>
				<?php _e( 'Children:', 'motopress-hotel-booking' ); ?>&nbsp;<?php echo $roomType->getChildrenCapacity(); ?><br/>
				<?php _e( 'Size:', 'motopress-hotel-booking' ); ?>&nbsp;<?php echo $roomType->getSize( true ) ? $roomType->getSize( true ) : '&#8212;'; ?></p>
				<?php
				break;
			case 'bed' :
				$bedType			 = $roomType->getBedType();
				echo!empty( $bedType ) ? sprintf( '<a href="%s">%s</a>', esc_url( add_query_arg( 'mphb_bed', $bedType ) ), $bedType ) : '<span aria-hidden="true">&#8212;</span>';
				break;
			case 'rooms':
				$totalRoomsCount	 = MPHB()->getRoomPersistence()->getCount(
					array(
						'room_type'		 => $roomType->getId(),
						'post_status'	 => 'all'
					)
				);
				$activeRoomsCount	 = MPHB()->getRoomPersistence()->getCount(
					array(
						'room_type'		 => $roomType->getId(),
						'post_status'	 => 'publish'
					)
				);

				$totalRoomsLink	 = MPHB()->postTypes()->room()->getManagePostsLink(
					array(
						'mphb_room_type_id' => $roomType->getId()
					)
				);
				$activeRoomsLink = MPHB()->postTypes()->room()->getManagePostsLink(
					array(
						'mphb_room_type_id'	 => $roomType->getId(),
						'post_status'		 => 'publish'
					)
				);
				?>
				<p>
					<?php _e( 'Total:', 'motopress-hotel-booking' ); ?>
					<a href="<?php echo $totalRoomsLink; ?>">
						<?php echo $totalRoomsCount; ?>
					</a><br/>
					<?php _e( 'Active:', 'motopress-hotel-booking' ); ?>
					<a href="<?php echo $activeRoomsLink; ?>">
						<?php echo $activeRoomsCount; ?>
					</a>
				</p>
				<?php
				break;
		}
	}

	public function parseQuery( $query ){
		if ( $this->isCurrentPage() ) {
			if ( isset( $_GET['mphb_bed'] ) && $_GET['mphb_bed'] != '' ) {
				$query->query_vars['meta_key']		 = 'mphb_bed';
				$query->query_vars['meta_value']	 = sanitize_text_field( $_GET['mphb_bed'] );
				$query->query_vars['meta_compare']	 = 'LIKE';
			}
		}
	}

	public function filterCustomOrderBy( $vars ){
		if ( $this->isCurrentPage() ) {
			if ( isset( $vars['orderby'] ) ) {
				switch ( $vars['orderby'] ) {
					case 'mphb_bed':
						$vars = array_merge( $vars, array(
							'meta_key'	 => 'mphb_bed',
							'orderby'	 => 'meta_value'
							) );
						break;
				}
			}
		}
		return $vars;
	}

}
