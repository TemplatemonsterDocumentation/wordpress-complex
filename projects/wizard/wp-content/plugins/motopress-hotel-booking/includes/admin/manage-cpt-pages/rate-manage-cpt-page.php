<?php

namespace MPHB\Admin\ManageCPTPages;

use \MPHB\Entities;

class RateManageCPTPage extends AbstractManageCPTPage {

	public function __construct( $postType, $args = array() ){
		parent::__construct( $postType, $args );
		add_action( 'parse_query', array( $this, 'parseQuery' ) );
		add_filter( 'request', array( $this, 'filterCustomOrderBy' ) );
	}

	public function filterColumns( $columns ){
		$customColumns	 = array(
			'room_type'	 => __( 'Room Type', 'motopress-hotel-booking' ),
			'prices'	 => __( 'Season &#8212; Price', 'motopress-hotel-booking' ),
		);
		$offset			 = array_search( 'date', array_keys( $columns ) ); // Set custom columns position before "DATE" column
		$columns		 = array_slice( $columns, 0, $offset, true ) + $customColumns + array_slice( $columns, $offset, count( $columns ) - 1, true );

		unset( $columns['date'] );

		return $columns;
	}

	public function filterSortableColumns( $columns ){
		$columns['room_type'] = 'mphb_room_type_id';

		return $columns;
	}

	public function renderColumns( $column, $postId ){
		$rate = MPHB()->getRateRepository()->findById( $postId );
		switch ( $column ) {
			case 'room_type' :
				$roomType		 = MPHB()->getRoomTypeRepository()->findById( $rate->getRoomTypeId() );
				echo (!empty( $roomType ) ) ? sprintf( '<a href="%s">%s</a>', esc_url( add_query_arg( 'mphb_room_type', $roomType->getid() ) ), $roomType->getTitle() ) : '<span aria-hidden="true">&#8212;</span>';
				break;
			case 'prices' :
				$seasonPrices	 = $rate->getSeasonPrices();
				if ( !$seasonPrices ) {
					echo '<span aria-hidden="true">&#8212;</span>';
				} else {
					$seasonPriceItems = array_map( function( Entities\SeasonPrice $seasonPrice ) {

						$season = $seasonPrice->getSeason();

						$seasonLabel = $season ? esc_html( $season->getTitle() ) : '';

						$price = mphb_format_price( $seasonPrice->getPrice() );

						return sprintf( '%s &#8212; %s', $seasonLabel, $price );
					}, $seasonPrices );
					$seasonPriceItems = join( '</li><li>', $seasonPriceItems );
					echo '<ul style="margin:0;"><li>' . $seasonPriceItems . '</li></ul>';
				}
				break;
		}
	}

	public function parseQuery( $query ){
		if ( $this->isCurrentPage() ) {
			if ( isset( $_GET['mphb_room_type'] ) && $_GET['mphb_room_type'] != '' ) {
				$query->query_vars['meta_key']		 = 'mphb_room_type_id';
				$query->query_vars['meta_value']	 = sanitize_text_field( $_GET['mphb_room_type'] );
				$query->query_vars['meta_compare']	 = 'LIKE';
			}
		}
	}

	public function filterCustomOrderBy( $vars ){
		if ( $this->isCurrentPage() ) {
			if ( isset( $vars['orderby'] ) ) {
				switch ( $vars['orderby'] ) {
					case 'mphb_room_type_id':
						$vars	 = array_merge( $vars, array(
							'meta_key'	 => 'mphb_room_type_id',
							'orderby'	 => 'meta_value_num'
							) );
						break;
				}
			}
		}
		return $vars;
	}

}
