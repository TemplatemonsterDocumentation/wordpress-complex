<?php

namespace MPHB\PostTypes;

use \MPHB\Admin\EditCPTPages;
use \MPHB\Admin\ManageCPTPages;

abstract class AbstractCPT {

	protected $postType;

	/**
	 *
	 * @var EditCPTPages\EditCPTPage
	 */
	protected $editPage;

	/**
	 *
	 * @var ManageCPTPages\ManageCPTPage
	 */
	protected $managePage;
	protected $capability = 'edit_post';

	/**
	 *
	 * @var \MPHB\Admin\Groups\MetaBoxGroup[]
	 */
	protected $fieldGroups = array();

	public function __construct(){
		$this->addActions();
	}

	protected function addActions(){
		add_action( 'init', array( $this, 'init' ), 5 );
		add_action( 'init', array( $this, 'register' ), 6 );
	}

	/**
	 *
	 * @return \MPHB\Admin\EditCPTPages\EditCPTPage
	 */
	protected function createEditPage(){
		return new EditCPTPages\EditCPTPage( $this->postType, $this->getFieldGroups() );
	}

	/**
	 *
	 * @return \MPHB\Admin\ManageCPTPages\AbstractManageCPTPage
	 */
	protected function createManagePage(){
		return new ManageCPTPages\ManageCPTPage( $this->postType );
	}

	public function init(){
		$this->editPage		 = $this->createEditPage();
		$this->managePage	 = $this->createManagePage();
	}

	abstract public function getFieldGroups();

	abstract public function register();

	public function getPostType(){
		return $this->postType;
	}

	public function getManagePostsLink( $additionalArgs = array() ){
		$editUrl	 = admin_url( 'edit.php' );
		$queryArgs	 = array_merge( array(
			'post_type' => $this->getPostType()
			), $additionalArgs );
		return add_query_arg( $queryArgs, $editUrl );
	}

	/**
	 *
	 * @return EditCPTPages\EditCPTPage
	 */
	public function getEditPage(){
		return $this->editPage;
	}

	/**
	 *
	 * @return ManageCPTPages\AbstractManageCPTPage
	 */
	public function getManagePage(){
		return $this->managePage;
	}

	public function getMenuSlug(){
		return 'edit.php?post_type=' . $this->getPostType();
	}

}
