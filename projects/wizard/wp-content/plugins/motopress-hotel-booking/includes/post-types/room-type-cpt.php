<?php

namespace MPHB\PostTypes;

use \MPHB\Admin\Fields;
use \MPHB\Admin\Groups;
use \MPHB\Admin\EditCPTPages;
use \MPHB\Entities;
use \MPHB\Admin\ManageCPTPages;

class RoomTypeCPT extends AbstractCPT {

	protected $postType		 = 'mphb_room_type';
	private $facilityTaxName = 'mphb_room_type_facility';
	private $categoryTaxName = 'mphb_room_type_category';

	protected function addActions(){
		parent::addActions();
		add_action( 'after_setup_theme', array( $this, 'addFeaturedImageSupport' ), 11 );

		add_filter( 'single_template', array( $this, 'filterSingleTemplate' ) );

		add_filter( 'post_class', array( $this, 'filterPostClass' ), 20, 3 );
	}

	protected function createManagePage(){
		return new \MPHB\Admin\ManageCPTPages\RoomTypeManageCPTPage( $this->postType );
	}

	protected function createEditPage(){
		return new EditCPTPages\RoomTypeEditCPTPage( $this->postType, $this->getFieldGroups() );
	}

	public function register(){
		register_post_type( $this->postType, array(
			'labels'				 => array(
				'name'					 => __( 'Room Types', 'motopress-hotel-booking' ),
				'singular_name'			 => __( 'Room Type', 'motopress-hotel-booking' ),
				'add_new'				 => _x( 'Add Room Type', 'Add New Room Type', 'motopress-hotel-booking' ),
				'add_new_item'			 => __( 'Add New Room Type', 'motopress-hotel-booking' ),
				'edit_item'				 => __( 'Edit Room Type', 'motopress-hotel-booking' ),
				'new_item'				 => __( 'New Room Type', 'motopress-hotel-booking' ),
				'view_item'				 => __( 'View Room Type', 'motopress-hotel-booking' ),
				'menu_name'				 => __( 'Accommodation', 'motopress-hotel-booking' ),
				'search_items'			 => __( 'Search Room Type', 'motopress-hotel-booking' ),
				'not_found'				 => __( 'No room types found', 'motopress-hotel-booking' ),
				'not_found_in_trash'	 => __( 'No room types found in Trash', 'motopress-hotel-booking' ),
				'all_items'				 => __( 'Room Types', 'motopress-hotel-booking' ),
				'insert_into_item'		 => __( 'Insert into room type description', 'motopress-hotel-booking' ),
				'uploaded_to_this_item'	 => __( 'Uploaded to this room type', 'motopress-hotel-booking' )
			),
			'description'			 => __( 'This is where you can add new room types to your hotel.', 'motopress-hotel-booking' ),
			'public'				 => true,
			'publicly_queryable'	 => true,
			'show_ui'				 => true,
			'query_var'				 => true,
			'capability_type'		 => 'post',
			'has_archive'			 => true,
			'show_in_menu'			 => true,
			'supports'				 => array( 'title', 'editor', 'thumbnail', 'excerpt', 'page-attributes' ),
			'hierarchical'			 => false,
			'register_meta_box_cb'	 => array( $this->editPage, 'registerMetaBoxes' ),
			'rewrite'				 => array(
				'slug'		 => 'room-types',
				'with_front' => false,
				'feeds'		 => true
			),
			'query_var'				 => _x( 'room-type', 'slug', 'motopress-hotel-booking' ),
		) );

		register_taxonomy( $this->categoryTaxName, $this->postType, array(
			'label'				 => __( 'Type', 'motopress-hotel-booking' ),
			'labels'			 => array(
				'name'						 => __( 'Room Category', 'motopress-hotel-booking' ),
				'singular_name'				 => __( 'Room Category', 'motopress-hotel-booking' ),
				'search_items'				 => __( 'Search Room Categories', 'motopress-hotel-booking' ),
				'popular_items'				 => __( 'Popular Room Categories', 'motopress-hotel-booking' ),
				'all_items'					 => __( 'All Room Categories', 'motopress-hotel-booking' ),
				'parent_item'				 => __( 'Parent Room Category', 'motopress-hotel-booking' ),
				'parent_item_colon'			 => __( 'Parent Room Category:', 'motopress-hotel-booking' ),
				'edit_item'					 => __( 'Edit Room Category', 'motopress-hotel-booking' ),
				'update_item'				 => __( 'Update Room Category', 'motopress-hotel-booking' ),
				'add_new_item'				 => __( 'Add New Room Category', 'motopress-hotel-booking' ),
				'new_item_name'				 => __( 'New Room Category Name', 'motopress-hotel-booking' ),
				'separate_items_with_commas' => __( 'Separate categories with commas', 'motopress-hotel-booking' ),
				'add_or_remove_items'		 => __( 'Add or remove categories', 'motopress-hotel-booking' ),
				'choose_from_most_used'		 => __( 'Choose from the most used categories', 'motopress-hotel-booking' ),
				'not_found'					 => __( 'No categories found.', 'motopress-hotel-booking' ),
				'menu_name'					 => __( 'Categories', 'motopress-hotel-booking' )
			),
			'public'			 => true,
			'show_ui'			 => true,
			'show_in_menu'		 => MPHB()->getMainMenuSlug(),
			'show_tagcloud'		 => true,
			'show_admin_column'	 => true,
			'hierarchical'		 => true,
			'rewrite'			 => array(
				'slug'			 => 'room-type-category',
				'with_front'	 => false,
				'hierarchical'	 => true
			),
			'query_var'			 => _x( 'room-type-category', 'slug', 'motopress-hotel-booking' )
		) );
		register_taxonomy_for_object_type( $this->categoryTaxName, $this->postType );

		register_taxonomy( $this->facilityTaxName, $this->postType, array(
			'label'				 => __( 'Facility', 'motopress-hotel-booking' ),
			'labels'			 => array(
				'name'						 => __( 'Facilities', 'motopress-hotel-booking' ),
				'singular_name'				 => __( 'Facility', 'motopress-hotel-booking' ),
				'search_items'				 => __( 'Search Facilities', 'motopress-hotel-booking' ),
				'popular_items'				 => __( 'Popular Facilities', 'motopress-hotel-booking' ),
				'all_items'					 => __( 'All Facilities', 'motopress-hotel-booking' ),
				'parent_item'				 => __( 'Parent Facility', 'motopress-hotel-booking' ),
				'parent_item_colon'			 => __( 'Parent Facility:', 'motopress-hotel-booking' ),
				'edit_item'					 => __( 'Edit Facility', 'motopress-hotel-booking' ),
				'update_item'				 => __( 'Update Facility', 'motopress-hotel-booking' ),
				'add_new_item'				 => __( 'Add New Facility', 'motopress-hotel-booking' ),
				'new_item_name'				 => __( 'New Facility Name', 'motopress-hotel-booking' ),
				'separate_items_with_commas' => __( 'Separate facilities with commas', 'motopress-hotel-booking' ),
				'add_or_remove_items'		 => __( 'Add or remove facilities', 'motopress-hotel-booking' ),
				'choose_from_most_used'		 => __( 'Choose from the most used facilities', 'motopress-hotel-booking' ),
				'not_found'					 => __( 'No facilities found.', 'motopress-hotel-booking' ),
				'menu_name'					 => __( 'Facilities', 'motopress-hotel-booking' )
			),
			'public'			 => true,
			'hierarchical'		 => true,
			'show_ui'			 => true,
			'show_in_menu'		 => MPHB()->getMainMenuSlug(),
			'show_tagcloud'		 => true,
			'show_admin_column'	 => true,
			'rewrite'			 => array(
				'slug'			 => 'room-type-facility',
				'with_front'	 => false,
				'hierarchical'	 => true
			),
			'query_var'			 => _x( 'room-type-facility', 'slug', 'motopress-hotel-booking' ),
		) );

		register_taxonomy_for_object_type( $this->facilityTaxName, $this->postType );
	}

	public function getFieldGroups(){

		$capacityGroup			 = new Groups\MetaBoxGroup( 'mphb_capacity', __( 'Capacity', 'motopress-hotel-booking' ), $this->postType );
		$adultsCapacityField	 = Fields\FieldFactory::create(
				'mphb_adults_capacity', array(
				'type'		 => 'select',
				'label'		 => __( 'Adults', 'motopress-hotel-booking' ),
				'default'	 => (string) MPHB()->settings()->main()->getMinAdults(),
				'list'		 => MPHB()->settings()->main()->getAdultsList()
				)
		);
		$capacityGroup->addField( $adultsCapacityField );
		$childrenCapacityField	 = Fields\FieldFactory::create(
				'mphb_children_capacity', array(
				'type'		 => 'select',
				'label'		 => __( 'Children', 'motopress-hotel-booking' ),
				'default'	 => '0',
				'list'		 => MPHB()->settings()->main()->getChildrenList()
				)
		);
		$capacityGroup->addField( $childrenCapacityField );
		$sizeField				 = Fields\FieldFactory::create(
				'mphb_size', array(
				'type'			 => 'number',
				'label'			 => __( 'Size', 'motopress-hotel-booking' ),
				'default'		 => 0,
				'min'			 => 0,
				'step'			 => 0.1,
				'size'			 => 'small',
				'description'	 => MPHB()->settings()->units()->getSquareUnit(),
				)
		);
		$capacityGroup->addField( $sizeField );

		$otherGroup	 = new Groups\MetaBoxGroup( 'mphb_other', __( 'Other', 'motopress-hotel-booking' ), $this->postType );
		$viewField	 = Fields\FieldFactory::create(
				'mphb_view', array(
				'type'			 => 'text',
				'label'			 => __( 'View', 'motopress-hotel-booking' ),
				'description'	 => __( 'City view, seaside, swimming pool etc.', 'motopress-hotel-booking' ),
				'size'			 => 'large'
				)
		);
		$otherGroup->addField( $viewField );

		$bedField = Fields\FieldFactory::create(
				'mphb_bed', array(
				'type'			 => 'select',
				'label'			 => __( 'Bed type', 'motopress-hotel-booking' ),
				'list'			 => array_merge( array( '' => __( 'None', 'motopress-hotel-booking' ) ), MPHB()->settings()->main()->getBedTypesList() ),
				'description'	 => strtr( __( 'Set bed types list in <a href="%link%" target="_blank">settings</a>.' ), array(
					'%link%' => MPHB()->getSettingsPageUrl() ) ),
				)
		);
		$otherGroup->addField( $bedField );

		$galleryGroup	 = new Groups\MetaBoxGroup( 'mphb_gallery', __( 'Photo Gallery', 'motopress-hotel-booking' ), $this->postType, 'side' );
		$galleryField	 = Fields\FieldFactory::create(
				'mphb_gallery', array(
				'type' => 'gallery'
				)
		);
		$galleryGroup->addField( $galleryField );

		$servicesGroup	 = new Groups\MetaBoxGroup( 'mphb_services', __( 'Available Services', 'motopress-hotel-booking' ), $this->postType );
		$servicesField	 = Fields\FieldFactory::create(
				'mphb_services', array(
				'type'			 => 'service-chooser',
				'label'			 => __( 'Available Services', 'motopress-hotel-booking' ),
				'show_prices'	 => true,
				'show_add_new'	 => true
				)
		);
		$servicesGroup->addField( $servicesField );

		return array(
			$capacityGroup,
			$otherGroup,
			$galleryGroup,
			$servicesGroup
		);
	}

	public function addFeaturedImageSupport(){
		$supportedTypes = get_theme_support( 'post-thumbnails' );
		if ( $supportedTypes === false ) {
			add_theme_support( 'post-thumbnails', array( $this->postType ) );
		} elseif ( is_array( $supportedTypes ) ) {
			$supportedTypes[0][] = $this->postType;
			add_theme_support( 'post-thumbnails', $supportedTypes[0] );
		}
	}

	public function filterSingleTemplate( $template ){
		global $post;

		if ( $post->post_type === $this->postType ) {
			if ( MPHB()->settings()->main()->isPluginTemplateMode() ) {
				$template = locate_template( MPHB()->getTemplatePath() . 'single-room-type.php' );
				if ( !$template ) {
					$template = MPHB()->getPluginPath( 'templates/single-room-type.php' );
				}
			} else {
				add_action( 'loop_start', array( $this, 'setupPseudoTemplate' ) );
			}
		}
		return $template;
	}

	public function setupPseudoTemplate( $query ){
		if ( $query->is_main_query() ) {
			add_filter( 'the_content', array( $this, 'appendRoomMetas' ) );
			remove_action( 'loop_start', array( $this, 'setupPseudoTemplate' ) );
		}
	}

	public function appendRoomMetas( $content ){
		// only run once
		remove_filter( 'the_content', array( __CLASS__, 'appendRoomMetas' ) );

		global $post;

		if ( $post->post_type === $this->postType ) {
			ob_start();
			\MPHB\Views\SingleRoomTypeView::_renderMetas();
			$content .= ob_get_clean();
		}

		return $content;
	}

	/**
	 *
	 * @param array $classes
	 * @param array $class
	 * @param int $postId
	 * @return string
	 */
	public function filterPostClass( $classes, $class = '', $postId = '' ){

		if ( !$postId || get_post_type( $postId ) !== $this->getPostType() ) {
			return $classes;
		}

		$roomType = MPHB()->getRoomTypeRepository()->findById( $postId );
		if ( !$roomType ) {
			return $classes;
		}

		$classes[]	 = 'mphb-room-type-adults-' . $roomType->getAdultsCapacity();
		$classes[]	 = 'mphb-room-type-children-' . $roomType->getChildrenCapacity();

//			if ( false !== ( $key = array_search( 'hentry', $classes ) ) ) {
//			if ( false !== ( $key = array_search( 'hentry', $classes ) ) && MPHB()->settings()->main()->isPluginTemplateMode() ) {
//				unset( $classes[ $key ] );
//			}

		return $classes;
	}

	public function getFacilityTaxName(){
		return $this->facilityTaxName;
	}

	public function getCategoryTaxName(){
		return $this->categoryTaxName;
	}

}
