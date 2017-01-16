<?php

namespace MPHB\Admin\Groups;

use \MPHB\Admin\Fields;

abstract class InputGroup {

	/**
	 *
	 * @var \MPHB\Admin\Fields\InputField[]
	 */
	protected $fields = array();
	protected $name;
	protected $label;

	public function __construct( $name, $label ){
		$this->name	 = $name;
		$this->label = $label;
	}

	/**
	 *
	 * @param \MPHB\Admin\Fields\InputField $field
	 */
	public function addField( Fields\InputField $field ){
		$this->fields[] = $field;
	}

	/**
	 *
	 * @param \MPHB\Admin\Fields\InputField[] $fields
	 */
	public function addFields( $fields ){
		foreach ( $fields as $field ) {
			$this->addField( $field );
		}
	}

	public function getName(){
		return $this->name;
	}

	public function getLabel(){
		return $this->label;
	}

	public function setName( $name ){
		$this->name = $name;
	}

	/**
	 *
	 * @return \MPHB\Admin\Fields\InputField[]
	 */
	public function getFields(){
		return $this->fields;
	}

	abstract public function render();

	abstract public function save();

	public function getAttsFromRequest( $request = null ){

		if ( is_null( $request ) ) {
			$request = $_REQUEST;
		}

		$atts = array();

		foreach ( $this->fields as $field ) {
			$fieldName = $field->getName();

			if ( isset( $request[$fieldName] ) ) {

				$value = $request[$fieldName];

				$atts[$fieldName] = $field->sanitize( $value );
			}
		}

		return $atts;
	}

}
