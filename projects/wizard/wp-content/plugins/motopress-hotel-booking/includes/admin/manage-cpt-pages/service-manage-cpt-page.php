<?php

namespace MPHB\Admin\ManageCPTPages;

use \MPHB\Entities;

class ServiceManageCPTPage extends AbstractManageCPTPage {

	public function filterColumns( $columns ){
		$customColumns	 = array(
			'price'				 => __( 'Price', 'motopress-hotel-booking' ),
			'price_periodicity'	 => __( 'Periodicity', 'motopress-hotel-booking' ),
			'price_quantity'	 => __( 'Charge', 'motopress-hotel-booking' ),
		);
		$offset			 = array_search( 'date', array_keys( $columns ) ); // Set custom columns position before "DATE" column
		$columns		 = array_slice( $columns, 0, $offset, true ) + $customColumns + array_slice( $columns, $offset, count( $columns ) - 1, true );

		return $columns;
	}

	public function filterSortableColumns( $columns ){
		$columns['price'] = 'mphb_price';

		return $columns;
	}

	public function renderColumns( $column, $postId ){
		$service = MPHB()->getServiceRepository()->findById( $postId );
		switch ( $column ) {
			case 'price' :
				echo $service->getPriceHTML();
				break;
			case 'price_periodicity' :
				echo $service->isPayPerNight() ? __( 'Per Night', 'motopress-hotel-booking' ) : __( 'Once', 'motopress-hotel-booking' );
				break;
			case 'price_quantity' :
				echo $service->isPayPerAdult() ? __( 'Per Adult', 'motopress-hotel-booking' ) : __( 'Per Room', 'motopress-hotel-booking' );
				break;
		}
	}

}
