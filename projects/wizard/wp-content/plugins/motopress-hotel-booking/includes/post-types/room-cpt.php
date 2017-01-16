<?php

namespace MPHB\PostTypes;

use \MPHB\Admin\Fields;
use \MPHB\Admin\Groups;
use \MPHB\Entities;
use \MPHB\Admin\ManageCPTPages;

class RoomCPT extends AbstractCPT {

	protected $postType = 'mphb_room';

	protected function createManagePage(){
		return new \MPHB\Admin\ManageCPTPages\RoomManageCPTPage( $this->postType );
	}

	public function register(){
		register_post_type( $this->postType, array(
			'labels'				 => array(
				'name'					 => __( 'Rooms', 'motopress-hotel-booking' ),
				'singular_name'			 => __( 'Room', 'motopress-hotel-booking' ),
				'add_new'				 => _x( 'Add New', 'Add New Room', 'motopress-hotel-booking' ),
				'add_new_item'			 => __( 'Add New Room', 'motopress-hotel-booking' ),
				'edit_item'				 => __( 'Edit Room', 'motopress-hotel-booking' ),
				'new_item'				 => __( 'New Room', 'motopress-hotel-booking' ),
				'view_item'				 => __( 'View Room', 'motopress-hotel-booking' ),
				'search_items'			 => __( 'Search Room', 'motopress-hotel-booking' ),
				'not_found'				 => __( 'No rooms found', 'motopress-hotel-booking' ),
				'not_found_in_trash'	 => __( 'No rooms found in Trash', 'motopress-hotel-booking' ),
				'all_items'				 => __( 'Rooms', 'motopress-hotel-booking' ),
				'insert_into_item'		 => __( 'Insert into room description', 'motopress-hotel-booking' ),
				'uploaded_to_this_item'	 => __( 'Uploaded to this room', 'motopress-hotel-booking' )
			),
			'description'			 => __( 'This is where you can add new rooms to your hotel.', 'motopress-hotel-booking' ),
			'public'				 => false,
			'publicly_queryable'	 => false,
			'show_ui'				 => true,
			'query_var'				 => false,
			'capability_type'		 => 'post',
			'has_archive'			 => false,
			'hierarchical'			 => false,
			'show_in_menu'			 => MPHB()->postTypes()->roomType()->getMenuSlug(),
			'supports'				 => array( 'title', 'excerpt', 'page-attributes' ),
			'hierarchical'			 => false,
			'register_meta_box_cb'	 => array( $this->editPage, 'registerMetaBoxes' ),
		) );
	}

	public function getFieldGroups(){
		global $pagenow;
		$generalGroup	 = new Groups\MetaBoxGroup( 'General', __( 'Room', 'motopress-hotel-booking' ), $this->postType );
		$roomTypeIdField = Fields\FieldFactory::create(
				'mphb_room_type_id', array(
				'type'		 => 'select',
				'list'		 => array( '' => __( '— Select —', 'motopress-hotel-booking' ) ) + MPHB()->getRoomTypeRepository()->getIdTitleList(),
				'label'		 => __( 'Room Type', 'motopress-hotel-booking' ),
				'disabled'	 => $pagenow !== 'post-new.php',
				'required'	 => true
				)
		);
		$generalGroup->addField( $roomTypeIdField );

		return array( $generalGroup );
	}

}
