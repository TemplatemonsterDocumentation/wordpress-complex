<?php

namespace MPHB\PostTypes;

use \MPHB\Admin\Fields;
use \MPHB\Admin\Groups;
use \MPHB\Admin\ManageCPTPages;
use \MPHB\Admin\EditCPTPages;

class RateCPT extends AbstractCPT {

	protected $postType = 'mphb_rate';

	protected function createEditPage(){
		return new EditCPTPages\RateEditCPTPage( $this->postType, $this->getFieldGroups() );
	}

	protected function createManagePage(){
		return new ManageCPTPages\RateManageCPTPage( $this->postType );
	}

	public function getFieldGroups(){
		$generalGroup = new Groups\MetaBoxGroup( 'General', __( 'Rate Info', 'motopress-hotel-booking' ), $this->postType );

		$generalFields = array(
			Fields\FieldFactory::create( 'mphb_room_type_id', array(
				'type'		 => 'select',
				'label'		 => __( 'Room Type', 'motopress-hotel-booking' ),
				'list'		 => array( '' => __( '— Select —', 'motopress-hotel-booking' ) ) + MPHB()->getRoomTypeRepository()->getIdTitleList(),
				'required'	 => true
			) ),
			Fields\FieldFactory::create( 'mphb_season_prices', array(
				'type'			 => 'complex',
				'label'			 => __( 'Season Prices', 'motopress-hotel-booking' ),
				'fields'		 => array(
					Fields\FieldFactory::create( 'season', array(
						'type'		 => 'select',
						'label'		 => __( 'Season', 'motopress-hotel-booking' ),
						'list'		 => MPHB()->getSeasonPersistence()->convertToIdTitleList(
							MPHB()->getSeasonPersistence()->getPosts( array(
								'orderby'	 => 'ID',
								'order'		 => 'ASC'
							) )
						),
						'required'	 => true
					) ),
					Fields\FieldFactory::create( 'price', array(
						'type'			 => 'number',
						'label'			 => __( 'Price', 'motopress-hotel-booking' ),
						'default'		 => 0,
						'min'			 => 0,
						'step'			 => 0.01,
						'size'			 => 'price',
						'required'		 => true,
						'description'	 => MPHB()->settings()->currency()->getCurrencySymbol()
					) )
				),
				'sortable'		 => true,
				'description'	 => __( 'Move price to top to set higher priority.', 'motopress-hotel-booking' ),
				'add_label'		 => __( 'Add New Season Price', 'motopress-hotel-booking' ),
			) ),
						Fields\FieldFactory::create( 'mphb_description', array(
				'type'		 => 'textarea',
				'label'		 => __( 'Description', 'motopress-hotel-booking' ),
				'required'	 => false,
				'description'	 => __( 'Will be displayed on the checkout page', 'motopress-hotel-booking' ),
			) ),
		);

		$generalGroup->addFields( $generalFields );

		return array( $generalGroup );
	}

	public function register(){
		register_post_type( $this->postType, array(
			'labels'				 => array(
				'name'					 => __( 'Rates', 'motopress-hotel-booking' ),
				'singular_name'			 => __( 'Rate', 'motopress-hotel-booking' ),
				'add_new'				 => _x( 'Add New', 'Add New Rate', 'motopress-hotel-booking' ),
				'add_new_item'			 => __( 'Add New Rate', 'motopress-hotel-booking' ),
				'edit_item'				 => __( 'Edit Rate', 'motopress-hotel-booking' ),
				'new_item'				 => __( 'New Rate', 'motopress-hotel-booking' ),
				'view_item'				 => __( 'View Rate', 'motopress-hotel-booking' ),
				'search_items'			 => __( 'Search Rate', 'motopress-hotel-booking' ),
				'not_found'				 => __( 'No seasons found', 'motopress-hotel-booking' ),
				'not_found_in_trash'	 => __( 'No seasons found in Trash', 'motopress-hotel-booking' ),
				'all_items'				 => __( 'Rates', 'motopress-hotel-booking' ),
				'insert_into_item'		 => __( 'Insert into season description', 'motopress-hotel-booking' ),
				'uploaded_to_this_item'	 => __( 'Uploaded to this season', 'motopress-hotel-booking' )
			),
			'description'			 => __( 'This is where you can add new seasons.', 'motopress-hotel-booking' ),
			'public'				 => false,
			'publicly_queryable'	 => false,
			'show_ui'				 => true,
			'query_var'				 => false,
			'capability_type'		 => 'post',
			'has_archive'			 => false,
			'hierarchical'			 => false,
			'show_in_menu'			 => MPHB()->postTypes()->roomType()->getMenuSlug(),
			'supports'				 => array( 'page-attributes', 'title' ),
			'hierarchical'			 => false,
			'register_meta_box_cb'	 => array( $this->editPage, 'registerMetaBoxes' ),
		) );
	}

}
