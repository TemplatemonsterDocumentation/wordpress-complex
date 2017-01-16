<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * WooCommerce Image Product Categories
 *
 * @author   TemplateMonster
 * @category Widgets
 * @version  1.0.0
 * @extends  WC_Widget_Product_Categories
 */

if ( class_exists( 'WC_Widget_Product_Categories' ) ) {

	class __TM_Product_Categories_Widget extends WC_Widget_Product_Categories {

		/**
		 * Category ancestors.
		 *
		 * @var array
		 */
		public $cat_ancestors;

		/**
		 * Current Category.
		 *
		 * @var bool
		 */
		public $current_cat;

		/**
		 * Constructor.
		 */
		public function __construct() {

			parent::__construct();

			$this->widget_cssclass    = 'woocommerce widget_product_categories_image';
			$this->widget_description = __( 'A list of product image categories.', 'tm-woocommerce-package' );
			$this->widget_id          = 'woocommerce_image_product_categories';
			$this->widget_name        = __( 'TM Product categories with thumbnail', 'tm-woocommerce-package' );

			$this->settings['tm_categories_carousel_widget_only_parent'] = array(
				'type'  => 'checkbox',
				'std'   => 0,
				'label' => __( 'Only parent categories', 'tm-woocommerce-package' )
			);

			$this->settings['tm_categories_carousel_widget_visible'] = array(
				'type'  => 'number',
				'step'  => 1,
				'min'   => 1,
				'max'   => 6,
				'std'   => 4,
				'label' => __( 'Number of visible categories', 'tm-woocommerce-package' )
			);

			$this->settings['tm_categories_carousel_widget_navigation'] = array(
				'type'  => 'label',
				'std'   => '',
				'label' => __( 'Navigation', 'tm-woocommerce-package' )
			);

			$this->settings['tm_categories_carousel_widget_arrows'] = array(
				'type'  => 'checkbox',
				'std'   => 1,
				'label' => __( 'Arrows', 'tm-woocommerce-package' )
			);

			$this->settings['tm_categories_carousel_widget_pagination'] = array(
				'type'  => 'checkbox',
				'std'   => 0,
				'label' => __( 'Pagination', 'tm-woocommerce-package' )
			);

			unset( $this->settings['dropdown'] );
			unset( $this->settings['hierarchical'] );
			unset( $this->settings['show_children_only'] );

			WC_Widget::__construct();

			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_assets' ), 9 );
			add_filter( 'wc_get_template', array( $this, 'rewrite_widget_template_fallback' ), 10, 3 );
		}

		/**
		 * Adds fallback template for categories widget
		 *
		 * @param  string $located       Template path.
		 * @param  string $template_name Template name.
		 * @param  array  $args          Template variables.
		 * @return string
		 */
		public function rewrite_widget_template_fallback( $located = '', $template_name = '', $args = array() ) {

			$support = get_theme_support( 'tm-woocommerce-package' );

			if ( ! empty( $support ) ) {
				return $located;
			}

			if ( ! empty( $args['is_widget'] ) && 'content-product_cat.php' === $template_name ) {
				$located = tm_wc()->plugin_dir() . '/templates/content-product_cat.php';
			}

			return $located;
		}

		/**
		 * Enqueue widget assets.
		 *
		 * @since 1.0.0
		 * @return void
		 */
		public function enqueue_assets() {

			if ( is_active_widget( false, false, $this->id_base, true ) ) {

				wp_enqueue_style( 'jquery-swiper' );
				wp_enqueue_script( 'tm-categories-carousel-widget-init' );
			}
		}

		/**
		 * Output widget.
		 *
		 * @see WP_Widget
		 *
		 * @param array $args
		 * @param array $instance
		 */
		public function widget( $args, $instance ) {

			global $wp_query, $post;

			$count       = isset( $instance['count'] )      ? $instance['count']      : $this->settings['count']['std'];
			$orderby     = isset( $instance['orderby'] )    ? $instance['orderby']    : $this->settings['orderby']['std'];
			$hide_empty  = isset( $instance['hide_empty'] ) ? $instance['hide_empty'] : $this->settings['hide_empty']['std'];
			$only_parent = isset( $instance['tm_categories_carousel_widget_only_parent'] ) ? $instance['tm_categories_carousel_widget_only_parent'] : $this->settings['tm_categories_carousel_widget_only_parent']['std'];
			$list_args   = array(
				'show_count' => $count,
				'taxonomy'   => 'product_cat',
				'hide_empty' => $hide_empty
			);

			// Menu Order
			$list_args['menu_order'] = false;

			if ( $orderby == 'order' ) {

				$list_args['menu_order'] = 'asc';
			} else {

				$list_args['orderby'] = 'title';
			}
			if ( $only_parent ) {

				$list_args['parent'] = 0;
			}
			$cats = get_categories( $list_args );

			if( ! empty( $cats ) ) {

				$arrows     = ( isset( $instance['tm_categories_carousel_widget_arrows'] ) )       ? $instance['tm_categories_carousel_widget_arrows']     : 0;
				$pagination = ( ! empty( $instance['tm_categories_carousel_widget_pagination'] ) ) ? $instance['tm_categories_carousel_widget_pagination'] : 0;
				$visible    = isset( $instance['tm_categories_carousel_widget_visible'] )          ? $instance['tm_categories_carousel_widget_visible'] : 4;
				$visible    = apply_filters( 'tm_categories_carousel_widget_visible', $visible, $args );
				$uniqid     = uniqid();

				$this->widget_start( $args, $instance );

				if( count( $cats ) < $visible ) {

					$visible = count( $cats );
				}
				$between      = apply_filters( 'tm_categories_carousel_widget_space_between_slides', 30 );
				$arrows_pos   = apply_filters( 'tm_categories_carousel_widget_arrows_pos', 'inside' );
				$data_attrs[] = 'data-uniq-id="swiper-carousel-' . $uniqid . '"';
				$data_attrs[] = 'data-slides-per-view="' . $visible . '"';
				$data_attrs[] = 'data-slides-per-group="1"';
				$data_attrs[] = 'data-slides-per-column="1"';
				$data_attrs[] = 'data-space-between-slides="' . $between . '"';
				$data_attrs[] = 'data-duration-speed="500"';
				$data_attrs[] = 'data-swiper-loop="false"';
				$data_attrs[] = 'data-free-mode="false"';
				$data_attrs[] = 'data-grab-cursor="true"';
				$data_attrs[] = 'data-mouse-wheel="false"';
				$start_html[] = '<div class="woocommerce swiper-container tm-categories-carousel-widget-container" id="swiper-carousel-' . $uniqid . '" ' . implode( " ", $data_attrs ) . '>';
				$start_html[] = apply_filters( 'tm_wc_categories_carousel_widget_wrapper_open', '<ul class="swiper-wrapper tm-categories-carousel-widget-wrapper products-categories">', $this );

				echo implode( "\n", $start_html );

				add_filter( 'product_cat_class', 'tm_categories_carousel_widget_post_class' );

				foreach ( $cats as $category ) {

					wc_get_template(
						'content-product_cat.php',
						array(
							'category'  => $category,
							'no_grid'   => true, //deprecated sinse 1.1.5
							'swiper'    => true,
							'is_widget' => true, // From 1.1.9
						)
					);
				}

				remove_filter( 'product_cat_class', 'tm_categories_carousel_widget_post_class' );

				$end_html[] = apply_filters( 'tm_wc_categories_carousel_widget_wrapper_close', '</ul>', $this );

				if( 'outside' === $arrows_pos ) {

					$end_html[] = '</div>';
				}
				if( $pagination ) {

					$end_html[] = '<div id="swiper-carousel-'. $uniqid . '-pagination" class="swiper-pagination tm-categories-carousel-widget-pagination"></div>';
				}
				if( $arrows ) {

					$end_html[] = '<div id="swiper-carousel-'. $uniqid . '-next" class="swiper-button-next tm-categories-carousel-widget-button-next">' . do_action( 'tm_categories_carousel_widget_next_arrow_icon' ) . '</div>';
					$end_html[] = '<div id="swiper-carousel-'. $uniqid . '-prev" class="swiper-button-prev tm-categories-carousel-widget-button-prev">' . do_action( 'tm_categories_carousel_widget_prev_arrow_icon' ) . '</div>';
				}
				if( 'inside' === $arrows_pos ) {

					$end_html[] = '</div>';
				}
				echo implode( "\n", $end_html );

				$this->widget_end( $args );
			}
		}
	}
}