<?php

namespace MPHB\PostTypes;

use \MPHB\Admin\Fields;
use \MPHB\Admin\Groups;
use \MPHB\Admin\ManageCPTPages;
use \MPHB\Entities;

class ServiceCPT extends AbstractCPT {

	protected $postType = 'mphb_room_service';
	protected $managePage;

	protected function addActions(){
		parent::addActions();
		add_action( 'after_setup_theme', array( $this, 'addFeaturedImageSupport' ), 11 );

		add_filter( 'post_class', array( $this, 'filterPostClass' ), 20, 3 );
		add_action( 'loop_start', array( $this, 'setupPseudoTemplate' ) );
	}

	protected function createManagePage(){
		return new ManageCPTPages\ServiceManageCPTPage( $this->postType );
	}

	public function setupPseudoTemplate( $query ){
		if ( $query->is_main_query() ) {
			add_filter( 'the_content', array( $this, 'appendMetas' ) );
			remove_action( 'loop_start', array( $this, 'setupPseudoTemplate' ) );
		}
	}

	public function appendMetas( $content ){
		// only run once
		remove_filter( 'the_content', array( __CLASS__, 'appendMetas' ) );

		global $post;

		if ( $post->post_type === $this->postType ) {
			ob_start();
			\MPHB\Views\SingleServiceView::_renderMetas();
			$content .= ob_get_clean();
		}

		return $content;
	}

	public function register(){
		register_post_type( $this->postType, array(
			'labels'				 => array(
				'name'					 => __( 'Services', 'motopress-hotel-booking' ),
				'singular_name'			 => __( 'Service', 'motopress-hotel-booking' ),
				'add_new'				 => _x( 'Add New', 'Add New Service', 'motopress-hotel-booking' ),
				'add_new_item'			 => __( 'Add New Service', 'motopress-hotel-booking' ),
				'edit_item'				 => __( 'Edit Service', 'motopress-hotel-booking' ),
				'new_item'				 => __( 'New Service', 'motopress-hotel-booking' ),
				'view_item'				 => __( 'View Service', 'motopress-hotel-booking' ),
				'search_items'			 => __( 'Search Service', 'motopress-hotel-booking' ),
				'not_found'				 => __( 'No services found', 'motopress-hotel-booking' ),
				'not_found_in_trash'	 => __( 'No services found in Trash', 'motopress-hotel-booking' ),
				'all_items'				 => __( 'Services', 'motopress-hotel-booking' ),
				'insert_into_item'		 => __( 'Insert into service description', 'motopress-hotel-booking' ),
				'uploaded_to_this_item'	 => __( 'Uploaded to this service', 'motopress-hotel-booking' )
			),
			'description'			 => __( 'This is where you can add new service to your hotel.', 'motopress-hotel-booking' ),
			'public'				 => true,
			'publicly_queryable'	 => true,
			'show_ui'				 => true,
			'query_var'				 => true,
			'capability_type'		 => 'post',
			'has_archive'			 => true,
			'hierarchical'			 => false,
			'show_in_menu'			 => MPHB()->postTypes()->roomType()->getMenuSlug(),
			'query_var'				 => false,
			'supports'				 => array( 'title', 'editor', 'page-attributes', 'thumbnail' ),
			'register_meta_box_cb'	 => array( $this->editPage, 'registerMetaBoxes' ),
			'rewrite'				 => array(
				'slug'		 => 'service',
				'with_front' => false,
				'feeds'		 => true
			),
			'query_var'				 => _x( 'service', 'slug', 'motopress-hotel-booking' )
		) );
	}

	public function getFieldGroups(){
		$priceGroup			 = new Groups\MetaBoxGroup( 'mphb_price', __( 'Price', 'motopress-hotel-booking' ), $this->postType );
		$regularPriceField	 = Fields\FieldFactory::create(
				'mphb_price', array(
				'type'			 => 'number',
				'label'			 => __( 'Price', 'motopress-hotel-booking' ),
				'default'		 => 0,
				'step'			 => 0.01,
				'min'			 => 0,
				'size'			 => 'price',
				'description'	 => MPHB()->settings()->currency()->getCurrencySymbol()
				)
		);
		$priceGroup->addField( $regularPriceField );

		$pricePeriodicityField = Fields\FieldFactory::create(
				'mphb_price_periodicity', array(
				'type'		 => 'select',
				'label'		 => __( 'Periodicity', 'motopress-hotel-booking' ),
				'list'		 => array(
					'once'		 => __( 'Once', 'motopress-hotel-booking' ),
					'per_night'	 => __( 'Per Night', 'motopress-hotel-booking' )
				),
				'description'	 => __( 'How many times the customer will be charged.', 'motopress-hotel-booking' ),
				'default'	 => 'once',
				)
		);
		$priceGroup->addField( $pricePeriodicityField );

		$priceQuantityField = Fields\FieldFactory::create(
				'mphb_price_quantity', array(
				'type'		 => 'select',
				'label'		 => __( 'Charge', 'motopress-hotel-booking' ),
				'list'		 => array(
					'once'		 => __( 'Per Room', 'motopress-hotel-booking' ),
					'per_adult'	 => __( 'Per Adult', 'motopress-hotel-booking' )
				),
				'default'	 => 'once',
				)
		);

		$priceGroup->addField( $priceQuantityField );

		return array( $priceGroup );
	}

	public function getAddNewLink(){
		return admin_url( 'post-new.php?post_type=' . $this->getPostType() );
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

	public function filterPostClass( $classes, $class = '', $postId = '' ){

		if ( $postId !== '' && get_post_type( $postId ) === $this->getPostType() ) {

			$service = MPHB()->getServiceRepository()->findById( $postId );

			if ( !$service ) {
				return $classes;
			}

			if ( $service->isFree() ) {
				$classes[] = 'mphb-service-free';
			}

			if ( $service->isPayPerAdult() ) {
				$classes[] = 'mphb-service-pay-per-adult';
			}

			if ( $service->isPayPerNight() ) {
				$classes[] = 'mphb-service-pay-per-night';
			}

			if ( !is_single() && !is_search() && false !== ( $key = array_search( 'hentry', $classes ) ) ) {
				unset( $classes[$key] );
			}
		}

		return $classes;
	}

}
