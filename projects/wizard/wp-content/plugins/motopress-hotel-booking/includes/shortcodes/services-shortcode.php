<?php

namespace MPHB\Shortcodes;

use \MPHB\Entities;

class ServicesShortcode extends AbstractShortcode {

	protected $name = 'mphb_services';

	/**
	 *
	 * @var bool
	 */
	private $showAll = true;

	/**
	 *
	 * @var array
	 */
	private $ids = array();

	public function __construct(){
		parent::__construct();
	}

	public function addActions(){
		parent::addActions();
		$this->addTemplateActions();
	}

	private function addTemplateActions(){
		add_action( 'mphb_sc_services_service_details', array( '\MPHB\Views\LoopServiceView', 'renderFeaturedImage' ), 10 );
		add_action( 'mphb_sc_services_service_details', array( '\MPHB\Views\LoopServiceView', 'renderTitle' ), 20 );
		add_action( 'mphb_sc_services_service_details', array( '\MPHB\Views\LoopServiceView', 'renderExcerpt' ), 30 );
		add_action( 'mphb_sc_services_service_details', array( '\MPHB\Views\LoopServiceView', 'renderPrice' ), 40 );

		add_action( 'mphb_sc_services_after_loop', array( '\MPHB\Views\GlobalView', 'renderPagination' ) );
	}

	/**
	 *
	 * @param array $atts
	 * @param string $content
	 * @param string $shortcodeName
	 * @return string
	 */
	public function render( $atts, $content = null, $shortcodeName ){
		$defaultAtts = array(
			'ids'	 => '',
			'class'	 => ''
		);

		$atts = shortcode_atts( $defaultAtts, $atts, $shortcodeName );

		$this->showAll	 = empty( $atts['ids'] );
		$this->ids		 = array_map( 'trim', explode( ',', $atts['ids'] ) );

		ob_start();
		$this->mainLoop();
		$content = ob_get_clean();

		$wrapperClass = apply_filters( 'mphb_sc_services_wrapper_class', 'mphb_sc_services-wrapper' );
		$wrapperClass .= empty( $wrapperClass ) ? $atts['class'] : ' ' . $atts['class'];
		return '<div class="' . esc_attr( $wrapperClass ) . '">' . $content . '</div>';
	}

	private function mainLoop(){
		$servicesQuery = $this->getServicesQuery();

		if ( $servicesQuery->have_posts() ) {

			do_action( 'mphb_sc_services_before_loop', $servicesQuery );

			while ( $servicesQuery->have_posts() ) : $servicesQuery->the_post();

				do_action( 'mphb_sc_services_before_item' );

				$this->renderService();

				do_action( 'mphb_sc_services_after_item' );

			endwhile;

			wp_reset_postdata();

			/**
			 * @hooked \MPHB\Views\GlobalView::renderPagination - 10
			 */
			do_action( 'mphb_sc_services_after_loop', $servicesQuery );
		} else {
			$this->showNotMatchedMessage();
		}
	}

	public function getServicesQuery(){
		$queryAtts = array(
			'post_type'				 => MPHB()->postTypes()->service()->getPostType(),
			'post_status'			 => 'publish',
			'paged'					 => mphb_get_paged_query_var(),
			'orderby'				 => 'menu_order',
			'ignore_sticky_posts'	 => true
		);
		if ( !$this->showAll ) {
			$queryAtts['post__in'] = $this->ids;
		}
		return new \WP_Query( $queryAtts );
	}

	private function renderService(){
		mphb_get_template_part( 'shortcodes/services/service-content' );
	}

	private function showNotMatchedMessage(){
		mphb_get_template_part( 'shortcodes/services/not-found' );
	}

}
