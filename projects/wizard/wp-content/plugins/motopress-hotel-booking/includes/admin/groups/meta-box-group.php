<?php

namespace MPHB\Admin\Groups;

use \MPHB\Entities;

class MetaBoxGroup extends InputGroup {

	protected $postType;
	protected $context;
	protected $priority;
	protected $postId;

	/**
	 *
	 * @param string $name
	 * @param string $label
	 * @param string $postType
	 * @param string $context Optional. The context within the screen where the boxes should display ('normal', 'side', and 'advanced'). Default: 'advanced'
	 * @param string $priority Optional. The priority within the context where the boxes should show ('high', 'default', 'low'). Default: 'default'
	 */
	public function __construct( $name, $label = '', $postType, $context = 'advanced', $priority = 'default' ){
		parent::__construct( $name, $label );
		$this->postType	 = $postType;
		$this->context	 = $context;
		$this->priority	 = $priority;
	}

	public function getPostId(){
		return $this->postId;
	}

	public function setPostId( $postId ){
		$this->postId = $postId;
	}

	public function render(){
		global $post;
		foreach ( $this->fields as $field ) {
			if ( $field->getType() === 'dynamic-select' ) {
				$field->updateList( get_post_meta( $post->ID, $field->getDependencyInput(), true ) );
			}
			$field->setValue( get_post_meta( $post->ID, $field->getName(), true ) );
		}

		wp_nonce_field( 'save_' . $this->getName(), '_nonce_' . $this->getName() );
		switch ( $this->context ) {
			case 'advanced':
				$this->renderRegularMetaBox();
				break;
			case 'side':
				$this->renderSideMetaBox();
				break;
			default:
				$this->renderRegularMetaBox();
				break;
		}
	}

	private function renderRegularMetaBox(){
		$result = '<table class="form-table">'
			. '<tbody>';
		foreach ( $this->fields as $field ) {
			$result .= '<tr>';
			if ( $field->hasLabel() ) {
				$result .= '<th>';
				$result .= $field->getLabelTag();
				$result .= '</th>';
			}
			$result .= '<td colspan="' . ( $field->hasLabel() ? 1 : 2 ) . '">';
			$result .= $field->render();
			$result .= '</td>'
				. '</tr>';
		}
		$result .= '</tbody>'
			. '</table>';
		echo $result;
	}

	private function renderSideMetaBox(){
		$result = '<div class="mphb-side-meta-box">';
		foreach ( $this->fields as $field ) {
			$result .= '<div class="mphb-meta-field">';
			$result .= '<div>' . $field->getLabelTag() . '</div>';
			$result .= $field->render();
			$result .= '</div>';
		}
		$result .= '</div>';
		echo $result;
	}

	public function register(){
		add_meta_box( $this->name, $this->label, array( $this, 'render' ), $this->postType, $this->context, $this->priority );
	}

	/**
	 *
	 * @return bool
	 */
	public function isValidRequest(){
		return isset( $_REQUEST["_nonce_{$this->name}"] ) && wp_verify_nonce( $_REQUEST["_nonce_{$this->name}"], "save_{$this->name}" );
	}

	/**
	 *
	 * @return bool
	 */
	public function save(){

		if ( !$this->isValidRequest() ) {
			return false;
		}

		$metaValues = $this->getAttsFromRequest( $_POST );
		foreach ( $metaValues as $name => $value ) {

			update_post_meta( $this->postId, $name, $value );

		}
	}

	/**
	 *
	 * @return array
	 */
	public function getValues(){
		return $this->isValidRequest() ? $this->getAttsFromRequest( $_POST ) : array();
	}

}
