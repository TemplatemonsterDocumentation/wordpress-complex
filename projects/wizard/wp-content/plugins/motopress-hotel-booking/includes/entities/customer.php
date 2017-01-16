<?php

namespace MPHB\Entities;

class Customer {

	/**
	 *
	 * @var string
	 */
	private $email;

	/**
	 *
	 * @var string
	 */
	private $firstName;

	/**
	 *
	 * @var string
	 */
	private $lastName;

	/**
	 *
	 * @var string
	 */
	private $phone;

	/**
	 *
	 * @param array $atts
	 * @param string $atts['email']
	 * @param string $atts['first_name']
	 * @param string $atts['last_name'] Optional.
	 * @param string $atts['phone']
	 */
	public function __construct( $atts = array() ){
		$defaultAtts = array(
			'email'		 => '',
			'last_name'	 => '',
			'first_name' => '',
			'phone'		 => ''
		);

		$atts = array_merge( $defaultAtts, $atts );

		$this->setEmail( $atts['email'] );
		$this->setFirstName( $atts['first_name'] );
		$this->setLastName( $atts['last_name'] );
		$this->setPhone( $atts['phone'] );
	}

	/**
	 *
	 * @return string
	 */
	public function getEmail(){
		return $this->email;
	}

	/**
	 *
	 * @return string
	 */
	public function getFirstName(){
		return $this->firstName;
	}

	/**
	 *
	 * @return string
	 */
	public function getLastName(){
		return $this->lastName;
	}

	/**
	 *
	 * @return string
	 */
	public function getPhone(){
		return $this->phone;
	}

	/**
	 *
	 * @param string $email
	 */
	public function setEmail( $email ){
		$this->email = $email;
	}

	/**
	 *
	 * @param string $firstName
	 */
	public function setFirstName( $firstName ){
		$this->firstName = $firstName;
	}

	/**
	 *
	 * @param string $lastName
	 */
	public function setLastName( $lastName ){
		$this->lastName = $lastName;
	}

	/**
	 *
	 * @param string $phone
	 */
	public function setPhone( $phone ){
		$this->phone = $phone;
	}

	/**
	 *
	 * @return bool
	 */
	public function isValid(){
		$errorCodes = $this->getErrors()->get_error_codes();
		return empty( $errorCodes );
	}

	/**
	 *
	 * @return \WP_Error
	 */
	public function getErrors(){

		$errors = new \WP_Error();

		if ( empty( $this->email ) ) {
			$errors->add( 'customer_email_not_set', __( 'Email is not set.', 'motopress-hotel-booking' ) );
		}

		if ( empty( $this->phone ) ) {
			$errors->add( 'customer_phone_not_set', __( 'Phone is not set.', 'motopress-hotel-booking' ) );
		}

		if ( empty( $this->firstName ) ) {
			$errors->add( 'customer_first_name_not_set', __( 'First name is not set.', 'motopress-hotel-booking' ) );
		}

		return $errors;
	}

}
