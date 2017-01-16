<?php

namespace MPHB\Admin\Fields;

class DynamicSelectField extends SelectField {

	const TYPE = 'dynamic-select';

	protected $dependencyInput;
	protected $ajaxAction;
	protected $listCallback;

	public function __construct( $name, $details, $value = '' ){
		parent::__construct( $name, $details, $value );
		$this->dependencyInput	 = $details['dependency_input'];
		$this->ajaxAction		 = $details['ajax_action'];
		$this->listCallback		 = $details['list_callback'];
	}

	protected function renderInput(){

		$result = '<select name="' . esc_attr( $this->getName() ) . '" id="' . MPHB()->addPrefix( $this->getName() ) . '" ' . $this->generateAttrs() . '>';

		foreach ( $this->list as $key => $label ) {
			$result .= '<option value="' . esc_attr( $key ) . '"' . selected( $this->getValue(), $key, false ) . '>' . esc_html( $label ) . '</option>';
		}

		$result .= '</select>';
		$result .= '<span class="mphb-preloader mphb-hide"></span>';
		$result .= '<div class="mphb-errors-wrapper mphb-hide"></div>';
		return $result;
	}

	protected function generateAttrs(){
		$attrs = parent::generateAttrs();
		$attrs .= ( isset( $this->dependencyInput ) ) ? ' data-dependency="' . $this->dependencyInput . '"' : '';
		$attrs .= ' data-ajax-action="' . $this->ajaxAction . '"';
		$attrs .= ' data-ajax-nonce="' . wp_create_nonce( $this->ajaxAction ) . '"';
		return $attrs;
	}

	public function getDependencyInput(){
		return $this->dependencyInput;
	}

	public function sanitize( $value ){
		return sanitize_text_field( $value );
	}

	public function updateList( $dependencyValue ){
		$list		 = call_user_func( $this->listCallback, $dependencyValue );
		$this->list	 = array( '' => __( '— Select —', 'motopress-hotel-booking' ) ) + $list;
	}

}
