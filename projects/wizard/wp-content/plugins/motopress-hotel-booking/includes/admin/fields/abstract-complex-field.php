<?php

namespace MPHB\Admin\Fields;

abstract class AbstractComplexField extends InputField {

	const TYPE = 'complex';

	protected $default			 = array();
	protected $fields			 = array();
	protected $addLabel;
	protected $deleteLabel;
	protected $prototypeFields	 = array();
	protected $uniqid			 = '';

	public function __construct( $name, $details, $values = array() ){
		parent::__construct( $name, $details, $values );

		$this->addLabel		 = isset( $details['add_label'] ) ? $details['add_label'] : __( 'Add', 'motopress-hotel-booking' );
		$this->deleteLabel	 = isset( $details['delete_label'] ) ? $details['delete_label'] : __( 'Delete', 'motopress-hotel-booking' );
		$this->uniqid		 = uniqid();

		if ( is_array( $details['fields'] ) ) {
			foreach ( $details['fields'] as $field ) {
				if ( is_a( $field, '\MPHB\Admin\Fields\InputField' ) ) {
					$this->fields[] = $field;
				}
			}
		}
	}

	protected function renderAddItemButton( $attrs = '', $classes = '' ){
		return '<button type="button" class="button mphb-complex-add-item ' . $classes . '" data-id="' . $this->uniqid . '" ' . $attrs . '>' . $this->addLabel . '</button>';
	}

	protected function renderDeleteItemButton( $attrs = '', $classes = '' ){
		return '<button type="button" class="button mphb-complex-delete-item ' . $classes . '" data-id="' . $this->uniqid . '" ' . $attrs . '>' . $this->deleteLabel . '</button>';
	}

	abstract protected function generateItem( $key, $value, $prototype = false );
}
