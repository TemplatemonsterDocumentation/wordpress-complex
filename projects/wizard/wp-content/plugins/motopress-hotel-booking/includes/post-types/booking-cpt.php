<?php

namespace MPHB\PostTypes;

use \MPHB\Admin\Fields;
use \MPHB\Admin\Groups;
use \MPHB\Admin\ManageCPTPages;
use \MPHB\Admin\EditCPTPages;
use \MPHB\Views;

class BookingCPT extends AbstractCPT {

	protected $postType = 'mphb_booking';
	protected $statuses;
	protected $paymentStatuses;
	protected $logs;

	public function __construct(){
		parent::__construct();
		$this->statuses			 = new BookingCPT\Statuses( $this->postType );
		$this->paymentStatuses	 = new BookingCPT\PaymentStatuses( $this->postType );
		$this->logs				 = new BookingCPT\Logs( $this->postType );
	}

	public function addActions(){
		parent::addActions();
		add_action( 'admin_menu', array( $this, 'addSubMenus' ), 11 );
	}

	protected function createEditPage(){
		return new EditCPTPages\BookingEditCPTPage( $this->postType, $this->getFieldGroups() );
	}

	protected function createManagePage(){
		return new ManageCPTPages\BookingManageCPTPage( $this->postType );
	}

	public function getFieldGroups(){
		$roomGroup = new Groups\MetaBoxGroup( 'mphb_room', __( 'Booking Information', 'motopress-hotel-booking' ), $this->postType );

		$roomGroupFields = array(
			Fields\FieldFactory::create( 'mphb_room_id', array(
				'type'		 => 'select',
				'label'		 => __( 'Room', 'motopress-hotel-booking' ),
				'list'		 => array( '' => __( '— Select —', 'motopress-hotel-booking' ) ) + MPHB()->getRoomPersistence()->convertToIdTitleList(
					MPHB()->getRoomPersistence()->getPosts( array( 'fields' => 'all' ) )
				),
				'default'	 => '',
				'required'	 => true
				)
			),
			Fields\FieldFactory::create( 'mphb_room_rate_id', array(
				'type'				 => 'dynamic-select',
				'label'				 => __( 'Booking Rate', 'motopress-hotel-booking' ),
				'dependency_input'	 => 'mphb_room_id',
				'ajax_action'		 => 'mphb_get_rates_for_room',
				'list_callback'		 => function( $roomId ) {
					$list = array();
					if ( !empty( $roomId ) ) {
						$room = MPHB()->getRoomRepository()->findById( $roomId );
						if ( $room ) {
							$rates = MPHB()->getRateRepository()->findAllActiveByRoomType( $room->getRoomTypeId() );
							foreach ( $rates as $rate ) {
								$list[$rate->getId()] = $rate->getTitle();
							}
						}
					}
					return $list;
				},
					'default'	 => '',
					'required'	 => true
					)
				),
				Fields\FieldFactory::create( 'mphb_check_in_date', array(
					'type'		 => 'datepicker',
					'label'		 => __( 'Check-in Date', 'motopress-hotel-booking' ),
					'required'	 => true,
					'readonly'	 => false
					)
				),
				Fields\FieldFactory::create( 'mphb_check_out_date', array(
					'type'		 => 'datepicker',
					'label'		 => __( 'Check-out Date', 'motopress-hotel-booking' ),
					'required'	 => true,
					'readonly'	 => false
					)
				),
				Fields\FieldFactory::create( 'mphb_adults', array(
					'type'		 => 'select',
					'label'		 => __( 'Adults', 'motopress-hotel-booking' ),
					'list'		 => MPHB()->settings()->main()->getAdultsList(),
					'required'	 => true
					)
				),
				Fields\FieldFactory::create( 'mphb_children', array(
					'type'	 => 'select',
					'label'	 => __( 'Children', 'motopress-hotel-booking' ),
					'list'	 => MPHB()->settings()->main()->getChildrenList()
					)
				),
				Fields\FieldFactory::create( 'mphb_services', array(
					'label'		 => __( 'Services', 'motopress-hotel-booking' ),
					'type'		 => 'complex',
					'fields'	 => array(
						Fields\FieldFactory::create( 'id', array(
							'type'		 => 'select',
							'label'		 => __( 'Service', 'motopress-hotel-booking' ),
							'list'		 => MPHB()->getServicePersistence()->convertToIdTitleList(
								MPHB()->getServicePersistence()->getPosts()
							),
							'required'	 => true
						) ),
						Fields\FieldFactory::create( 'count', array(
							'type'		 => 'number',
							'label'		 => __( 'Count', 'motopress-hotel-booking' ),
							'default'	 => 1,
							'min'		 => 1,
							'step'		 => 1,
							'size'		 => 'small',
							'required'	 => true
						) )
					),
					'add_label'	 => __( 'Add Service', 'motopress-hotel-booking' )
					)
				)
			);

			$roomGroup->addFields( $roomGroupFields );

			$customerGroup = new Groups\MetaBoxGroup( 'mphb_customer', __( 'Customer Information', 'motopress-hotel-booking' ), $this->postType );

			$customerGroupFields = array(
				Fields\FieldFactory::create( 'mphb_first_name', array(
					'type'		 => 'text',
					'label'		 => __( 'First Name', 'motopress-hotel-booking' ),
					'default'	 => '',
					'required'	 => true
					)
				),
				Fields\FieldFactory::create( 'mphb_last_name', array(
					'type'		 => 'text',
					'label'		 => __( 'Last Name', 'motopress-hotel-booking' ),
					'default'	 => ''
					)
				),
				Fields\FieldFactory::create( 'mphb_email', array(
					'type'		 => 'email',
					'label'		 => __( 'Email', 'motopress-hotel-booking' ),
					'default'	 => '',
					'required'	 => true
					)
				),
				Fields\FieldFactory::create( 'mphb_phone', array(
					'type'		 => 'text',
					'label'		 => __( 'Phone', 'motopress-hotel-booking' ),
					'default'	 => '',
					'required'	 => true
					)
				),
				Fields\FieldFactory::create( 'mphb_note', array(
					'type'	 => 'textarea',
					'rows'	 => 8,
					'label'	 => __( 'Customer Note', 'motopress-hotel-booking' ),
					)
				)
			);

			$customerGroup->addFields( $customerGroupFields );

			$miscGroup = new Groups\MetaBoxGroup( 'mphb_other', __( 'Additional Information', 'motopress-hotel-booking' ), $this->postType );

			$miscGroupFields = array(
				Fields\FieldFactory::create( 'mphb_total_price', array(
					'type'	 => 'total-price',
					'size'	 => 'long-price',
					'label'	 => __( 'Total Booking Price', 'motopress-hotel-booking' )
					)
				),
				Fields\FieldFactory::create( 'mphb_payment_status', array(
					'type'	 => 'select',
					'list'	 => $this->paymentStatuses->getList(),
					'label'	 => __( 'Payment Status', 'motopress-hotel-booking' )
					)
				)
			);

			$miscGroup->addFields( $miscGroupFields );

			return array(
				$roomGroup,
				$customerGroup,
				$miscGroup
			);
		}

		public function addSubMenus(){
			add_submenu_page( MPHB()->getMainMenuSlug(), get_post_type_object( $this->postType )->labels->add_new_item, get_post_type_object( $this->postType )->labels->add_new, 'edit_posts', 'post-new.php?post_type=' . $this->postType );
		}

		public function register(){
			register_post_type( $this->postType, array(
				'labels'				 => array(
					'name'					 => __( 'Bookings', 'motopress-hotel-booking' ),
					'singular_name'			 => __( 'Booking', 'motopress-hotel-booking' ),
					'add_new'				 => _x( 'Add New Booking', 'Add New Booking', 'motopress-hotel-booking' ),
					'add_new_item'			 => __( 'Add New Booking', 'motopress-hotel-booking' ),
					'edit_item'				 => __( 'Edit Booking', 'motopress-hotel-booking' ),
					'new_item'				 => __( 'New Booking', 'motopress-hotel-booking' ),
					'view_item'				 => __( 'View Booking', 'motopress-hotel-booking' ),
					'search_items'			 => __( 'Search Booking', 'motopress-hotel-booking' ),
					'not_found'				 => __( 'No bookings found', 'motopress-hotel-booking' ),
					'not_found_in_trash'	 => __( 'No bookings found in Trash', 'motopress-hotel-booking' ),
					'all_items'				 => __( 'All Bookings', 'motopress-hotel-booking' ),
					'insert_into_item'		 => __( 'Insert into booking description', 'motopress-hotel-booking' ),
					'uploaded_to_this_item'	 => __( 'Uploaded to this booking', 'motopress-hotel-booking' )
				),
				'map_meta_cap'			 => true,
				'public'				 => false,
				'exclude_from_search'	 => true,
				'publicly_queryable'	 => false,
				'show_ui'				 => true,
				'query_var'				 => false,
				'capability_type'		 => 'post',
				'has_archive'			 => false,
				'hierarchical'			 => false,
				'show_in_menu'			 => MPHB()->getMainMenuSlug(),
				'supports'				 => false,
				'register_meta_box_cb'	 => array( $this->editPage, 'registerMetaBoxes' ),
			) );
		}

		/**
		 *
		 * @return BookingCPT\PaymentStatuses
		 */
		public function paymentStatuses(){
			return $this->paymentStatuses;
		}

		/**
		 *
		 * @return BookingCPT\Statuses
		 */
		public function statuses(){
			return $this->statuses;
		}

		/**
		 *
		 * @return BookingCPT\Logs
		 */
		public function logs(){
			return $this->logs;
		}

	}
