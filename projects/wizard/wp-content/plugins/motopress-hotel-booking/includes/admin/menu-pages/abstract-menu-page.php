<?php

namespace MPHB\Admin\MenuPages;

abstract class AbstractMenuPage {

	protected $order;
	protected $name;
	protected $hookSuffix;
	protected $parentMenu;
	protected $pageTitle;
	protected $menuTitle;
	protected $capability;
	protected $menuSlug;

	public function __construct( $name, $atts = array() ){

		$this->name = $name;

		$defaults = array(
			'order'			 => 30,
			'page_title'	 => $this->name,
			'menu_title'	 => $this->name,
			'capability'	 => 'manage_options',
			'parent_menu'	 => MPHB()->getMainMenuSlug(),
		);

		$atts = array_merge( $defaults, $atts );

		$this->order		 = $atts['order'];
		$this->parentMenu	 = $atts['parent_menu'];
		$this->pageTitle	 = $atts['page_title'];
		$this->menuTitle	 = $atts['menu_title'];
		$this->capability	 = $atts['capability'];

		$this->addActions();
	}

	public function addActions(){
		add_action( 'admin_menu', array( $this, 'createMenu' ), $this->order );
	}

	public function createMenu(){
		if ( $this->parentMenu ) {
			$hook = add_submenu_page( $this->parentMenu, $this->pageTitle, $this->menuTitle, $this->capability, $this->name, array( $this, 'render' ) );
		} else {
			$hook = add_menu_page( $this->pageTitle, $this->menuTitle, $this->capability, $this->name, array( $this, 'render' ), null, $this->order );
		}
		$this->hookSuffix = $hook;
		add_action( 'load-' . $this->hookSuffix, array( $this, 'onLoad' ) );
	}

	abstract public function onLoad();

	abstract public function render();

	public function getName(){
		return $this->name;
	}

	public function getUrl( $additionalArgs = array() ){

		$defaultArgs = array(
			'page' => $this->name
		);

		$args = array_merge( $defaultArgs, $additionalArgs );

		return add_query_arg( $args, admin_url( 'admin.php' ) );
	}

}
