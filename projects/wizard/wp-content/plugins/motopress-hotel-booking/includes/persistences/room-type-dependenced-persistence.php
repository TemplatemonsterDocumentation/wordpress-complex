<?php

namespace MPHB\Persistences;

class RoomTypeDependencedPersistence extends CPTPersistence {

	protected function modifyQueryAtts( $atts ){
		$atts = parent::modifyQueryAtts( $atts );

		$atts = $this->_addRoomTypeCriteria( $atts );

		return $atts;
	}

	protected function _addRoomTypeCriteria( $atts ){

		if ( !isset( $atts['room_type'] ) ) {
			return $atts;
		}

		if ( is_array( $atts['room_type'] ) ) {
			$queryPart = array(
				'key'		 => 'mphb_room_type_id',
				'value'		 => $atts['room_type'],
				'compare'	 => 'IN'
			);
		} else {
			$queryPart = array(
				'key'		 => 'mphb_room_type_id',
				'value'		 => $atts['room_type'],
				'compare'	 => 'LIKE'
			);
		}

		$atts['meta_query'] = mphb_add_to_meta_query( $queryPart, isset( $atts['meta_query'] ) ? $atts['meta_query'] : null  );

		unset( $atts['room_type'] );

		return $atts;
	}

}
