<?php

namespace MPHB\Shortcodes;

use \MPHB\Entities;

class CheckoutShortcode extends AbstractShortcode {

	protected $name = 'mphb_checkout';

	const STEP_CHECKOUT			 = 'checkout';
	const STEP_BOOKING			 = 'booking';
	const STEP_COMPLETE			 = 'complete';
	const NONCE_ACTION_CHECKOUT	 = 'mphb-checkout';
	const NONCE_ACTION_BOOKING	 = 'mphb-booking';
	const NONCE_NAME				 = 'mphb-checkout-nonce';

	/**
	 *
	 * @var Entities\RoomType
	 */
	private $roomType;

	/**
	 *
	 * @var Entities\Rate[]
	 */
	private $allowedRates;

	/**
	 *
	 * @var Entities\Rate
	 */
	private $roomRate;

	/**
	 *
	 * @var int
	 */
	private $step;

	/*
	 *  Booking info
	 */

	/**
	 *
	 * @var int
	 */
	private $children;

	/**
	 *
	 * @var int
	 */
	private $adults;

	/**
	 *
	 * @var \DateTime
	 */
	private $checkInDate;

	/**
	 *
	 * @var \DateTime
	 */
	private $checkOutDate;

	/**
	 *
	 * @var array
	 */
	private $services = array();

	/*
	 *  Booking info
	 */
	private $firstName;
	private $lastName;
	private $email;
	private $phone;
	private $note;
	private $isCorrectPage			 = false;
	private $isCorrectNonce			 = false;
	private $isCorrectBookingData	 = false;
	private $isCorrectCustomerData	 = false;

	/**
	 *
	 * @var array
	 */
	private $errors = array();

	public function __construct(){
		parent::__construct();

		// templates hooks
		add_action( 'mphb_sc_checkout_form', array( $this, 'renderBookingDetails' ), 10 );
		add_action( 'mphb_sc_checkout_form', array( $this, 'renderServices' ), 20 );
		add_action( 'mphb_sc_checkout_form', array( $this, 'renderPriceBreakdown' ), 30 );
		add_action( 'mphb_sc_checkout_form', array( $this, 'renderCheckoutText' ), 35 );
		add_action( 'mphb_sc_checkout_form', array( $this, 'renderCustomerDetails' ), 40 );
		add_action( 'mphb_sc_checkout_form', array( $this, 'renderTotalPrice' ), 50 );

		// Booking Details
		add_action( 'mphb_sc_checkout_form_booking_details', array( $this, 'renderRoomTypeTitle' ), 10 );
		//add_action('mphb_sc_checkout_form_booking_details', array($this, 'renderRoomTypeCategories'), 20);
		add_action( 'mphb_sc_checkout_form_booking_details', array( $this, 'renderRoomTypeGuests' ), 30 );
		add_action( 'mphb_sc_checkout_form_booking_details', array( $this, 'renderCheckInDate' ), 40 );
		add_action( 'mphb_sc_checkout_form_booking_details', array( $this, 'renderCheckOutDate' ), 50 );
		add_action( 'mphb_sc_checkout_form_booking_details', array( $this, 'renderRoomRates' ), 60 );
		//add_action( 'mphb_sc_checkout_form_booking_details', array( $this, 'renderServices' ), 70 );
		//add_action( 'mphb_sc_checkout_form_booking_details', array( $this, 'renderPriceBreakdown' ), 100 );


		add_action( 'mphb_sc_checkout_errors_content', array( $this, 'showErrorsContent' ) );
		add_filter( 'mphb_sc_checkout_error', array( $this, 'filterErrorOutput' ) );

		add_action( 'wp', array( $this, 'setup' ) );
	}

	public function render( $atts, $content = '', $shortcodeName ){

		$defaultAtts = array(
			'class' => ''
		);

		$atts = shortcode_atts( $defaultAtts, $atts, $shortcodeName );

		ob_start();

		if ( $this->isCorrectPage && $this->isCorrectNonce && !MPHB()->settings()->main()->isBookingDisabled() ) {
			if ( $this->step === self::STEP_CHECKOUT ) {
				$this->stepCheckout();
			} else if ( $this->step === self::STEP_BOOKING ) {
				$this->stepBooking();
			} else if ( $this->step === self::STEP_COMPLETE ) {
				$this->showSuccessMessage();
			}
		} else {
//			$result = __('Direct access is not allowed.', 'motopress-hotel-booking');
		}

		$content = ob_get_clean();

		$wrapperClass = apply_filters( 'mphb_sc_checkout_wrapper_classes', 'mphb_sc_checkout-wrapper' );
		$wrapperClass .= empty( $wrapperClass ) ? $atts['class'] : ' ' . $atts['class'];
		return '<div class="' . esc_attr( $wrapperClass ) . '">' . $content . '</div>';
	}

	private function detectStep(){
		$step = ( isset( $_REQUEST['mphb_checkout_step'] ) ? $_REQUEST['mphb_checkout_step'] : self::STEP_CHECKOUT );

		if ( $step === self::STEP_BOOKING && MPHB()->getSession()->get( 'mphb_checkout_step' ) === self::STEP_COMPLETE ) {
			$step = self::STEP_COMPLETE;
		}

		$this->step = $step;
	}

	public function stepBooking(){

		if ( $this->isCorrectBookingData && $this->isCorrectCustomerData ) {

			MPHB()->getSession()->set( 'mphb_checkout_step', self::STEP_BOOKING );

			$roomId = $this->roomType->getNextAvailableRoom( $this->checkInDate->format( 'Y-m-d' ), $this->checkOutDate->format( 'Y-m-d' ) );

			if ( !$roomId ) {
				$this->showAlreadyBookedMessage();
				return;
			}

			$customerAtts = array(
				'first_name' => $this->firstName,
				'last_name'	 => $this->lastName,
				'email'		 => $this->email,
				'phone'		 => $this->phone
			);

			$customer = new Entities\Customer( $customerAtts );

			$bookingAtts = array(
				'check_in_date'	 => $this->checkInDate,
				'check_out_date' => $this->checkOutDate,
				'adults'		 => $this->adults,
				'children'		 => $this->children,
				'services'		 => $this->services,
				'customer'		 => $customer,
				'note'			 => $this->note,
				'room'			 => MPHB()->getRoomRepository()->findById( $roomId ),
				'room_rate'		 => $this->roomRate,
				'status'		 => MPHB()->postTypes()->booking()->statuses()->getDefaultNewBookingStatus()
			);

			$booking	 = Entities\Booking::create( $bookingAtts );
			$bookingId	 = MPHB()->getBookingRepository()->save( $booking );

			if ( $bookingId ) {

				do_action( 'mphb_create_booking_by_user', $booking );

				MPHB()->getSession()->set( 'mphb_checkout_step', self::STEP_COMPLETE );

				$this->showSuccessMessage();
			} else {
				_e( 'Unable to create booking. Please try again.', 'motopress-hotel-booking' );
			}
		} else {
			$this->showErrorsMessage();
		}
	}

	public function setup(){
		if ( mphb_is_checkout_page() ) {
			$this->isCorrectPage = true;
			$this->detectStep();
			if ( $this->checkNonce() ) {
				if ( $this->step === self::STEP_CHECKOUT ) {
					$this->parseBookingData();
					if ( $this->isCorrectBookingData ) {
						MPHB()->searchParametersStorage()->save(
							array(
								'mphb_check_in_date'	 => $this->checkInDate->format( MPHB()->settings()->dateTime()->getDateFormat() ),
								'mphb_check_out_date'	 => $this->checkOutDate->format( MPHB()->settings()->dateTime()->getDateFormat() ),
								'mphb_adults'			 => $this->adults,
								'mphb_children'			 => $this->children
							)
						);
					}
				} else if ( $this->step === self::STEP_BOOKING ) {
					$this->parseBookingData();
					$this->parseServices();
					$this->parseCustomerData();
				}
			}
		}
	}

	private function checkNonce(){

		$nonceAction = ( $this->step === self::STEP_CHECKOUT ) ? self::NONCE_ACTION_CHECKOUT : self::NONCE_ACTION_BOOKING;

		$this->isCorrectNonce = isset( $_POST[self::NONCE_NAME] ) && wp_verify_nonce( $_POST[self::NONCE_NAME], $nonceAction );

		return $this->isCorrectNonce;
	}

	private function parseBookingData(){
		$isCorrectRoomType = $this->parseRoomType();
		// Other booking attributes are depend on correct room type
		if ( !$isCorrectRoomType ) {
			return false;
		}

		$isCorrectCheckInDate	 = $this->parseCheckInDate();
		$isCorrectCheckOutDate	 = $this->parseCheckOutDate();
		$isCorrectAdults		 = $this->parseAdults();
		$isCorrectChildren		 = $this->parseChildren();
		$hasAllowedRates		 = $this->setupAllowedRates();

		$this->isCorrectBookingData = $isCorrectCheckInDate &&
			$isCorrectCheckOutDate &&
			$isCorrectAdults &&
			$isCorrectChildren &&
			$hasAllowedRates &&
			$this->setupRoomRate();

		return $this->isCorrectBookingData;
	}

	private function setupRoomRate(){
		if ( $this->step === self::STEP_CHECKOUT ) {
			$this->roomRate = $this->allowedRates[0];
			return true;
		} else {
			return $this->parseRoomRate();
		}
	}

	private function setupAllowedRates(){

		$rateArgs = array(
			'check_in_date'	 => $this->checkInDate,
			'check_out_date' => $this->checkOutDate
		);

		$allowedRates = MPHB()->getRateRepository()->findAllActiveByRoomType( $this->roomType->getId(), $rateArgs );

		$this->allowedRates = $allowedRates;
		return count( $allowedRates ) > 0;
	}

	private function parseCustomerData(){
		$isCorrectFirstName	 = $this->parseFirstName();
		$isCorrectLastName	 = $this->parseLastName();
		$isCorrectEmail		 = $this->parseEmail();
		$isCorrectPhone		 = $this->parsePhone();
		$isCorrectNote		 = $this->parseNote();

		$this->isCorrectCustomerData = ( $isCorrectFirstName && $isCorrectLastName && $isCorrectEmail && $isCorrectPhone && $isCorrectNote );

		return $this->isCorrectCustomerData;
	}

	private function parseRoomType(){
		$roomTypeId = filter_input( INPUT_POST, 'mphb_room_type_id', FILTER_VALIDATE_INT, array(
			'options' => array(
				'min_range' => 1
			)
			) );

		if ( !$roomTypeId || get_post_status( $roomTypeId ) !== 'publish' ) {
			$this->errors[] = __( 'Room Type ID is incorrect.', 'motopress-hotel-booking' );
			return false;
		}

		$roomType = MPHB()->getRoomTypeRepository()->findById( $roomTypeId );
		if ( !$roomType ) {
			$this->errors[] = __( 'Room Type ID is incorrect.', 'motopress-hotel-booking' );
			return false;
		}

		$this->roomType = $roomType;

		return true;
	}

	private function parseRoomRate(){

		$roomRateId = filter_input( INPUT_POST, 'mphb_room_rate_id', FILTER_VALIDATE_INT );

		if ( !$roomRateId ) {
			$this->errors[] = __( 'Room Rate ID is incorrect.', 'motopress-hotel-booking' );
			return false;
		}

		$rate = null;
		foreach ( $this->allowedRates as $allowedRate ) {
			if ( $allowedRate->getId() === $roomRateId ) {
				$rate = $allowedRate;
			}
		}

//		$roomRate = MPHB()->getRateRepository()->findById( $roomRateId );

		if ( is_null( $rate ) ) {
			$this->errors[] = __( 'Room Rate ID is incorrect.', 'motopress-hotel-booking' );
			return false;
		}

		$this->roomRate = $rate;
		return true;
	}

	private function parseAdults(){
		$adults = filter_input( INPUT_POST, 'mphb_adults', FILTER_VALIDATE_INT, array(
			'options' => array(
				'min_range'	 => MPHB()->settings()->main()->getMinAdults(),
				'max_range'	 => $this->roomType->getAdultsCapacity()
			)
			) );

		if ( is_null( $adults ) || false === $adults ) {
			$this->errors[] = __( 'Adults number is incorrect.', 'motopress-hotel-booking' );
			return false;
		}

		$this->adults = $adults;
		return true;
	}

	private function parseChildren(){
		$children = filter_input( INPUT_POST, 'mphb_children', FILTER_VALIDATE_INT, array(
			'options' => array(
				'min_range'	 => 0,
				'max_range'	 => $this->roomType->getChildrenCapacity()
			)
			) );

		if ( is_null( $children ) || false === $children ) {
			$this->errors[] = __( 'Children number is incorrect.', 'motopress-hotel-booking' );
			return false;
		}

		$this->children = $children;
		return true;
	}

	private function parseCheckInDate(){
		$this->checkInDate	 = null;
		$date				 = filter_input( INPUT_POST, 'mphb_check_in_date' );
		$checkInDate		 = \DateTime::createFromFormat( MPHB()->settings()->dateTime()->getDateFormat(), $date );
		$todayDate			 = \DateTime::createFromFormat( 'Y-m-d', mphb_current_time( 'Y-m-d' ) );

		if ( !$checkInDate ) {
			$this->errors[] = __( 'Check-in date is incorrect.', 'motopress-hotel-booking' );
			return false;
		} else if ( \MPHB\Utils\DateUtils::calcNights( $todayDate, $checkInDate ) < 0 ) {
			$this->errors[] = __( 'Check-in date cannot be earlier than today.', 'motopress-hotel-booking' );
			return false;
		}

		$this->checkInDate = $checkInDate;
		return true;
	}

	private function parseCheckOutDate(){
		$this->checkOutDate	 = null;
		$date				 = filter_input( INPUT_POST, 'mphb_check_out_date' );
		$dateObj			 = \MPHB\Utils\DateUtils::createCheckOutDate( MPHB()->settings()->dateTime()->getDateFormat(), $date );

		if ( !$dateObj ) {
			$this->errors[] = __( 'Check-out date is incorrect.', 'motopress-hotel-booking' );
			return false;
		} else if ( isset( $this->checkInDate ) && !MPHB()->getRulesChecker()->verify( $this->checkInDate, $dateObj ) ) {
			$this->errors[] = __( 'Dates are not satisfy booking rules.', 'motopress-hotel-booking' );
			return false;
		}

		$this->checkOutDate = $dateObj;
		return true;
	}

	private function parseFirstName(){
		$this->firstName = null;
		if ( !isset( $_POST['mphb_first_name'] ) ) {
			$this->errors[] = __( 'First name is incorrect.', 'motopress-hotel-booking' );
			return false;
		}

		$this->firstName = sanitize_text_field( $_POST['mphb_first_name'] );
		return true;
	}

	private function parseLastName(){
		$this->lastName = isset( $_POST['mphb_last_name'] ) ? sanitize_text_field( $_POST['mphb_last_name'] ) : '';
		return true;
	}

	private function parseEmail(){
		$this->email = null;
		$email		 = isset( $_POST['mphb_email'] ) ? sanitize_email( $_POST['mphb_email'] ) : '';
		if ( !empty( $email ) ) {
			$this->email = $email;
			return true;
		} else {
			$this->errors[] = __( 'Email is incorrect.', 'motopress-hotel-booking' );
			return false;
		}
	}

	private function parsePhone(){
		$this->phone = null;
		if ( isset( $_POST['mphb_phone'] ) ) {
			$this->phone = sanitize_text_field( $_POST['mphb_phone'] );
			return true;
		} else {
			$this->errors[] = __( 'Phone is incorrect.', 'motopress-hotel-booking' );
			return false;
		}
	}

	private function parseNote(){
		$this->note = isset( $_POST['mphb_note'] ) ? sanitize_text_field( $_POST['mphb_note'] ) : '';
		return true;
	}

	private function parseServices(){
		$this->services = array();
		if ( isset( $_POST['mphb_services'] ) && is_array( $_POST['mphb_services'] ) ) {
			foreach ( $_POST['mphb_services'] as $serviceDetails ) {

				if ( !isset( $serviceDetails['id'] ) ) {
					// service checkbox is not checked
					continue;
				}

				$service = MPHB()->getServiceRepository()->findById( absint( $serviceDetails['id'] ) );

				if ( !$service ) {
					continue;
				}

				$count = absint( $serviceDetails['count'] );
				if ( $count < 1 ) {
					$count = 1;
				}

				$service->setAdults( $count );
				$this->services[] = $service;
			}
		}
		return true;
	}

	public function stepCheckout(){
		if ( !$this->isCorrectBookingData ) {
			$this->showErrorsMessage();
			return;
		}

		if ( !$this->roomType->hasAvailableRoom( $this->checkInDate->format( 'Y-m-d' ), $this->checkOutDate->format( 'Y-m-d' ) ) ) {
			$this->showAlreadyBookedMessage();
			return;
		}

		MPHB()->getSession()->set( 'mphb_checkout_step', self::STEP_CHECKOUT );

		$this->enqueueScriptsStyles();

		do_action( 'mphb_sc_checkout_before_form' );

		echo $this->renderCheckoutForm();

		do_action( 'mphb_sc_checkout_after_form' );
	}

	public function renderCheckoutForm(){
		?>
		<form class="mphb_sc_checkout-form" method="POST" action="<?php echo esc_url( add_query_arg( 'step', self::STEP_BOOKING, MPHB()->settings()->pages()->getCheckoutPageUrl() ) ); ?>">
			<?php wp_nonce_field( self::NONCE_ACTION_BOOKING, self::NONCE_NAME ); ?>
			<input type="hidden" name="mphb_room_type_id" value="<?php echo $this->roomType->getId(); ?>" />
			<input type="hidden" name="mphb_check_in_date" value="<?php echo $this->checkInDate->format( MPHB()->settings()->dateTime()->getDateFormat() ); ?>" />
			<input type="hidden" name="mphb_check_out_date" value="<?php echo $this->checkOutDate->format( MPHB()->settings()->dateTime()->getDateFormat() ); ?>" />
			<input type="hidden" name="mphb_adults" value="<?php echo $this->adults; ?>" />
			<input type="hidden" name="mphb_children" value="<?php echo $this->children; ?>" />
			<input type="hidden" name="mphb_checkout_step" value="<?php echo self::STEP_BOOKING; ?>" />

			<?php do_action( 'mphb_sc_checkout_form' ); ?>

			<p class="mphb_sc_checkout-submit-wrapper">
				<input type="submit" class="button" value="<?php _e( 'Book Room', 'motopress-hotel-booking' ); ?>"/>
			</p>
		</form>
		<?php
	}

	public function renderCustomerDetails(){
		$uniqueSuffix = uniqid();
		?>
		<section id="mphb-customer-details">
			<h3><?php _e( 'Customer Details', 'motopress-hotel-booking' ); ?></h3>
			<p class="mphb-required-fields-tip"><small><?php _e( 'Required fields are followed by <abbr title="required">*</abbr>', 'motopress-hotel-booking' ); ?></small></p>
			<?php do_action( 'mphb_sc_checkout_form_customer_details' ); ?>
			<p class="mphb-customer-name">
				<label for="mphb_first_name-<?php echo $uniqueSuffix; ?>">
					<?php _e( 'First Name', 'motopress-hotel-booking' ); ?>
					<abbr title="<?php _e( 'Required', 'motopress-hotel-booking' ); ?>">*</abbr>
				</label>
				<br />
				<input type="text" id="mphb_first_name-<?php echo $uniqueSuffix; ?>" name="mphb_first_name" required="required" />
			</p>
			<p class="mphb-customer-last-name">
				<label for="mphb_last_name-<?php echo $uniqueSuffix; ?>"><?php _e( 'Last Name', 'motopress-hotel-booking' ); ?></label><br />
				<input type="text" name="mphb_last_name" id="mphb_last_name-<?php echo $uniqueSuffix; ?>" />
			</p>
			<p class="mphb-customer-email">
				<label for="mphb_email-<?php echo $uniqueSuffix; ?>">
					<?php _e( 'Email', 'motopress-hotel-booking' ); ?>
					<abbr title="<?php _e( 'Required', 'motopress-hotel-booking' ); ?>">*</abbr>
				</label>
				<br />
				<input type="email" name="mphb_email" required="required" id="mphb_email-<?php echo $uniqueSuffix; ?>" />
			</p>
			<p class="mphb-customer-phone">
				<label for="mphb_phone-<?php echo $uniqueSuffix; ?>">
					<?php _e( 'Phone', 'motopress-hotel-booking' ); ?>
					<abbr title="<?php _e( 'Required', 'motopress-hotel-booking' ); ?>">*</abbr>
				</label>
				<br />
				<input type="text" name="mphb_phone" required="required" id="mphb_phone-<?php echo $uniqueSuffix; ?>" />
			</p>
			<p class="mphb-customer-note">
				<label for="mphb_note-<?php echo $uniqueSuffix; ?>"><?php _e( 'Notes', 'motopress-hotel-booking' ); ?></label><br />
				<textarea name="mphb_note" id="mphb_note-<?php echo $uniqueSuffix; ?>" rows="4"></textarea>
			</p>
		</section>
		<?php
	}

	public function renderBookingDetails(){
		?>
		<section class="mphb-booking-details">
			<h3><?php _e( 'Booking Details', 'motopress-hotel-booking' ); ?></h3>
			<?php do_action( 'mphb_sc_checkout_form_booking_details' ); ?>
		</section>
		<?php
	}

	public function renderRoomTypeTitle(){
		?>
		<p class="mphb-room-type-title">
			<span><?php _e( 'Room Type:', 'motopress-hotel-booking' ); ?></span>
			<strong><?php echo $this->roomType->getTitle(); ?></strong>
		</p>
		<?php
	}

	public function renderRoomTypeCategories(){
		if ( $this->roomType->getCategories() ) {
			?>
			<p class="mphb-room-type-categories">
				<span><?php _e( 'Categories:', 'motopress-hotel-booking' ); ?></span>
				<strong><?php echo $this->roomType->getCategories(); ?></strong>
			</p>
			<?php
		}
	}

	public function renderRoomTypeGuests(){
		?>
		<p class="mphb-guests-number">
			<span><?php _e( 'Guests:', 'motopress-hotel-booking' ); ?></span>
			<strong>
				<?php
				printf( _n( '%d Adult', '%d Adults', $this->adults, 'motopress-hotel-booking' ), $this->adults );
				if ( $this->children > 0 ) {
					printf( _n( ', %d Child', ', %d Children', $this->children, 'motopress-hotel-booking' ), $this->children );
				}
				?>
			</strong>
		</p>
		<?php
	}

	public function renderCheckInDate(){
		?>
		<p class="mphb-check-in-date">
			<span><?php _e( 'Check-in Date:', 'motopress-hotel-booking' ); ?></span>
			<time datetime="<?php echo $this->checkInDate->format( 'Y-m-d' ); ?>"><strong><?php echo \MPHB\Utils\DateUtils::formatDateWPFront( $this->checkInDate ); ?></strong></time>
		</p>
		<?php
	}

	public function renderCheckOutDate(){
		?>
		<p class="mphb-check-out-date">
			<span><?php _e( 'Check-out Date:', 'motopress-hotel-booking' ); ?></span>
			<time datetime="<?php echo $this->checkOutDate->format( 'Y-m-d' ); ?>"><strong><?php echo \MPHB\Utils\DateUtils::formatDateWPFront( $this->checkOutDate ); ?></strong></time>
		</p>
		<?php
	}

	public function renderRoomRates(){
		ob_start();
		if ( count( $this->allowedRates ) > 1 ) {
			echo '<h3>' . __( 'Choose Rate', 'motopress-hotel-booking' ) . '</h3>';
			$isFirst = true;
			foreach ( $this->allowedRates as $rate ) {
				?>
				<p class="mphb-room-rate-variant">
					<label>
						<input type="radio" name="mphb_room_rate_id" value="<?php echo $rate->getId(); ?>" <?php checked( $isFirst ) ?>/>
						<strong>
							<?php
							echo esc_html( $rate->getTitle() ) . ', ' . mphb_format_price( $rate->calcPrice( $this->checkInDate, $this->checkOutDate ) );
							?>
						</strong>
					</label>
					<br />
					<?php echo esc_html( $rate->getDescription() ); ?>
				</p>
				<?php
				$isFirst = false;
			}
		} else {
			echo '<input type="hidden" name="mphb_room_rate_id" value="' . $this->allowedRates[0]->getId() . '">';
		}

		echo ob_get_clean();
	}

	public function renderPriceBreakdown(){
		?>
		<section class="mphb-room-price-breakdown-wrapper">
			<h3>
				<?php _e( 'Price Breakdown', 'motopress-hotel-booking' ); ?>
			</h3>
			<?php
			$bookingAtts = array(
				'room_rate'		 => $this->roomRate,
				'adults'		 => $this->adults,
				'children'		 => $this->children,
				'check_in_date'	 => $this->checkInDate,
				'check_out_date' => $this->checkOutDate
			);

			$booking = Entities\Booking::create( $bookingAtts );

			\MPHB\Views\BookingView::renderPriceBreakdown( $booking );
			?>
		</section>
		<?php
	}

	public function renderCheckoutText(){
		?>
		<section class="mphb-checkout-text-wrapper">
			<?php echo MPHB()->settings()->main()->getCheckoutText(); ?>
		</section>
		<?php
	}

	public function renderServices(){
		if ( $this->roomType->hasServices() ) {

			$servicesAtts = array(
				'post__in' => $this->roomType->getServices()
			);

			$services = MPHB()->getServiceRepository()->findAll( $servicesAtts );
			?>
			<section id="mphb-services-details">
				<h3><?php _e( 'Choose Additional Services', 'motopress-hotel-booking' ); ?></h3>
				<ul class="mphb_sc_checkout-services-list">

					<?php foreach ( $services as $key => $service ) { ?>
						<li>
							<label for="mphb_service-id-<?php echo $service->getId(); ?>">
								<input type="checkbox"
									   id="mphb_service-id-<?php echo $service->getId(); ?>"
									   name="mphb_services[<?php echo $key; ?>][id]"
									   class="mphb_sc_checkout-service"
									   value="<?php echo $service->getId(); ?>"
									   />
									   <?php echo $service->getTitle(); ?>
								<em>(<?php echo $service->getPriceWithConditions( false ); ?>)</em>
							</label>
							<?php if ( $service->isPayPerAdult() && $this->adults > 1 ) { ?>
								<label>
									<?php _e( 'for ', 'motopress-hotel-booking' ); ?>
									<select name="mphb_services[<?php echo $key; ?>][count]">
										<?php for ( $i = 1; $i <= $this->adults; $i++ ) { ?>
											<option value="<?php echo $i; ?>" <?php selected( $this->adults, $i ); ?> ><?php echo $i; ?></option>
										<?php } ?>
									</select>
									<?php _e( ' adult(s)', 'motopress-hotel-booking' ); ?>
								</label>
							<?php } else { ?>
								<input type="hidden" name="mphb_services[<?php echo $key; ?>][count]" value="1" />
							<?php } ?>
						</li>
					<?php } ?>
				</ul>
			</section>
			<?php
		}
	}

	public function renderTotalPrice(){
		?>
		<p class="mphb-total-price">
			<output>
				<?php _e( 'Total Price:', 'motopress-hotel-booking' ); ?>
				<strong class="mphb-total-price-field">
					<?php
					$bookingAtts = array(
						'room_rate'		 => $this->roomRate,
						'adults'		 => $this->adults,
						'children'		 => $this->children,
						'check_in_date'	 => $this->checkInDate,
						'check_out_date' => $this->checkOutDate,
					);

					$booking = Entities\Booking::create( $bookingAtts );

					echo mphb_format_price( $booking->getTotalPrice() );
					?>
				</strong>
				<span class="mphb-preloader mphb-hide"></span>
			</output>
		</p>
		<p class="mphb-errors-wrapper mphb-hide"></p>
		<?php
	}

	public function showSuccessMessage(){
		ob_start();
		if ( MPHB()->settings()->main()->isAutoConfirmationMode() ) {
			?>
			<h4><?php _e( 'Reservation submitted', 'motopress-hotel-booking' ); ?></h4>
			<p class="mphb_sc_checkout-success-reservation-message"><?php _e( 'Details of your reservation have just been sent to you in a confirmation email. Please check your inbox to complete booking.', 'motopress-hotel-booking' ); ?></p>
			<?php
			echo apply_filters( 'mphb_sc_checkout_auto_mode_success_message', ob_get_clean() );
		} else {
			?>
			<h4><?php _e( 'Reservation submitted', 'motopress-hotel-booking' ); ?></h4>
			<p class="mphb_sc_checkout-success-reservation-message"><?php _e( 'We received your booking request. Once it is confirmed we will notify you via email.', 'motopress-hotel-booking' ); ?></p>
			<?php
			echo apply_filters( 'mphb_sc_checkout_manual_mode_success_message', ob_get_clean() );
		}
	}

	public function showErrorsMessage(){
		?>
		<p class="mphb-data-incorrect">
			<?php do_action( 'mphb_sc_checkout_errors_content', $this->errors ); ?>
		</p>
		<?php
	}

	/**
	 *
	 * @param array $errors
	 */
	public function showErrorsContent( $errors ){
		foreach ( $errors as $error ) {
			echo apply_filters( 'mphb_sc_checkout_error', $error );
		}
	}

	public function filterErrorOutput( $error ){
		return '<br/>' . $error;
	}

	public function showAlreadyBookedMessage(){
		$message = apply_filters( 'mphb_sc_checkout_already_booked_message', __( 'Accommodation is already booked.', 'motopress-hotel-booking' ) );
		echo $message;
	}

	private function enqueueScriptsStyles(){
		wp_enqueue_script( 'mphb-jquery-serialize-json' );
		MPHB()->getPublicScriptManager()->enqueue();
	}

}
