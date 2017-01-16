<?php

namespace MPHB\Admin\ManageCPTPages;

use \MPHB\Entities;

class SeasonManageCPTPage extends AbstractManageCPTPage {

	public function filterColumns( $columns ){
		$customColumns	 = array(
			'start_date' => __( 'Start', 'motopress-hotel-booking' ),
			'end_date'	 => __( 'End', 'motopress-hotel-booking' ),
			'days'		 => __( 'Days', 'motopress-hotel-booking' )
		);
		$offset			 = array_search( 'date', array_keys( $columns ) ); // Set custom columns position before "DATE" column
		$columns		 = array_slice( $columns, 0, $offset, true ) + $customColumns + array_slice( $columns, $offset, count( $columns ) - 1, true );

		unset( $columns['date'] );

		return $columns;
	}

	public function filterSortableColumns( $columns ){
		return $columns;
	}

	public function renderColumns( $column, $postId ){
		$season = MPHB()->getSeasonRepository()->findById( $postId );
		switch ( $column ) {
			case 'start_date' :
				echo \MPHB\Utils\DateUtils::formatDateWPFront( $season->getStartDate() );
				break;
			case 'end_date' :
				echo \MPHB\Utils\DateUtils::formatDateWPFront( $season->getEndDate() );
				break;
			case 'days' :
				$days = $season->getDays();
				if ( empty( $days ) ) {
					echo __( 'None', 'motopress-hotel-booking' );
				} else if ( count( $days ) === 7 ) {
					echo __( 'All', 'motopress-hotel-booking' );
				} else {
					echo join( ',', array_map( array( '\MPHB\Utils\DateUtils', 'getDayByKey' ), $days ) );
				}
				break;
		}
	}

}
