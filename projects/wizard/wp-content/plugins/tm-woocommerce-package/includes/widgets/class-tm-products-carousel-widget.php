<?php

/**
 * TM WooCommerce Products Carousel Widget
 *
 * @author   TemplateMonster
 * @category Widgets
 * @version  1.0.0
 * @extends  WC_Widget_Products
 */

if ( class_exists( 'WC_Widget_Products' ) ) {

	class __TM_Products_Carousel_Widget extends WC_Widget_Products {

		public $instance = null;

		/**
		 * Constructor.
		 *
		 * @since 1.0.0
		 */
		public function __construct() {

			parent::__construct();

			$tm_wc                    = tm_wc();
			$this->widget_cssclass    = '__tm_products_carousel_widget';
			$this->widget_description = __( 'TM widget to create products carousel', 'tm-woocommerce-package' );
			$this->widget_id          = '__tm_products_carousel_widget';
			$this->widget_name        = __( 'TM Products Carousel Widget', 'tm-woocommerce-package' );

			$this->settings['tm_filter_by_cat'] = array(
				'type'    => 'select',
				'std'     => 'all',
				'options' => array( 'all' => 'All' ),
				'label'   => __( 'Filter by category', 'tm-woocommerce-package' )
			);
			$this->settings['tm_filter_by_tag'] = array(
				'type'    => 'select',
				'std'     => 'all',
				'options' => array( 'all' => 'All' ),
				'label'   => __( 'Filter by tag', 'tm-woocommerce-package' )
			);
			$this->settings['tm_products_carousel_widget_visible'] = array(
				'type'  => 'number',
				'step'  => 1,
				'min'   => 1,
				'max'   => apply_filters( 'tm_wc_products_carousel_widget_visible', 4 ),
				'std'   => 4,
				'label' => __( 'Number of visible products', 'tm-woocommerce-package' )
			);
			$this->settings['tm_products_carousel_widget_meta'] = array(
				'type'  => 'label',
				'std'   => '',
				'label' => __( 'Product Meta', 'tm-woocommerce-package' )
			);
			$this->settings['tm_products_carousel_widget_title'] = array(
				'type'  => 'checkbox',
				'std'   => 1,
				'label' => __( 'Title', 'tm-woocommerce-package' )
			);
			$this->settings['tm_products_carousel_widget_price'] = array(
				'type'  => 'checkbox',
				'std'   => 1,
				'label' => __( 'Price', 'tm-woocommerce-package' )
			);
			$this->settings['tm_products_carousel_widget_desc'] = array(
				'type'  => 'checkbox',
				'std'   => 1,
				'label' => __( 'Description', 'tm-woocommerce-package' )
			);
			$this->settings['tm_products_carousel_widget_desc_limit'] = array(
				'type'  => 'number',
				'step'  => 1,
				'min'   => 0,
				'max'   => '',
				'std'   => 10,
				'label' => __( 'Description Limit', 'tm-woocommerce-package' )
			);
			$this->settings['tm_products_carousel_widget_tag'] = array(
				'type'  => 'checkbox',
				'std'   => 1,
				'label' => __( 'Tag', 'tm-woocommerce-package' )
			);
			$this->settings['tm_products_carousel_widget_cat'] = array(
				'type'  => 'checkbox',
				'std'   => 1,
				'label' => __( 'Category', 'tm-woocommerce-package' )
			);
			$this->settings['tm_products_carousel_widget_navigation'] = array(
				'type'  => 'label',
				'std'   => '',
				'label' => __( 'Navigation', 'tm-woocommerce-package' )
			);
			$this->settings['tm_products_carousel_widget_arrows'] = array(
				'type'  => 'checkbox',
				'std'   => 1,
				'label' => __( 'Arrows', 'tm-woocommerce-package' )
			);
			$this->settings['tm_products_carousel_widget_pagination'] = array(
				'type'  => 'checkbox',
				'std'   => 0,
				'label' => __( 'Pagination', 'tm-woocommerce-package' )
			);

			WC_Widget::__construct();

			add_action( 'wp_enqueue_scripts', array( $this, '__tm_products_carousel_widget_enqueue_files' ), 9 );

			$this->hooks = apply_filters( 'tm_products_carousel_widget_hooks', array(
				'title' => array(
					'woocommerce_shop_loop_item_title',
					'woocommerce_template_loop_product_title',
					10,
					1
				),
				'cat'   => array(
					'woocommerce_after_shop_loop_item',
					'tm_products_carousel_widget_cat',
					6,
					1
				),
				'tag'   => array(
					'woocommerce_after_shop_loop_item',
					'tm_products_carousel_widget_tag',
					6,
					1
				),
				'price' => array(
					'woocommerce_after_shop_loop_item_title',
					'woocommerce_template_loop_price',
					10,
					1
				),
				'desc'  => array(
					'woocommerce_after_shop_loop_item_title',
					'tm_products_carousel_widget_desc',
					0,
					1
				)
			), $this );
		}

		/**
		 * Enqueue widget assets.
		 *
		 * @since  1.0.0
		 * @return void
		 */
		public function __tm_products_carousel_widget_enqueue_files() {

			if ( is_active_widget( false, false, $this->id_base, true ) ) {

				wp_enqueue_style( 'tm-products-carousel-widget-styles' );
				wp_enqueue_script( 'tm-products-carousel-widget-init' );
			}
		}

		/**
		 * Echo product description
		 *
		 * @hook  woocommerce_after_shop_loop_item_title
		 * @since 1.1.5
		 */
		public function tm_products_carousel_widget_desc( $content ) {

			global $tm_products_carousel_widget_settings;

			if( is_array( $tm_products_carousel_widget_settings ) ) {

				$limit = ! empty( $tm_products_carousel_widget_settings['tm_products_carousel_widget_desc_limit'] ) ? $tm_products_carousel_widget_settings['tm_products_carousel_widget_desc_limit'] : 0;

				if( 0 < $limit ) {

					$content = implode( ' ', array_slice( explode( ' ', trim ( strip_tags( $content ) ) ), 0, $limit ) );
				}
			}
			return $content;
		}

		/**
		 * Add or remove hooks.
		 *
		 * @since  1.1.5
		 */
		public function hooks( $hooks, $instance, $before = true ) {

			if( !isset( $this->wp_filter ) ) {

				global $wp_filter;

				$this->wp_filter = $wp_filter;
			}

			foreach ( $hooks as $key => $hook ){

				if( ! is_array( $hook ) || ! isset( $hook[0] ) || ! isset( $hook[1] ) ) {

					continue;
				}
				if( ! isset( $hook[2] ) ) {

					$hook[2] = 10;
				}
				if( ! isset( $hook[3] ) ) {

					$hook[2] = 1;
				}
				$action   = apply_filters( 'tm_products_carousel_widget_' . $key . '_action', $hook[0] ); //deprecated hook, use @tm_products_carousel_widget_hooks
				$callback = apply_filters( 'tm_products_carousel_widget_' . $key . '_action_callback', $hook[1] ); //deprecated hook, use @tm_products_carousel_widget_hooks
				$priority = apply_filters( 'tm_products_carousel_widget_' . $key . '_priority', $hook[2] ); //deprecated hook, use @tm_products_carousel_widget_hooks
				$args     = apply_filters( 'tm_products_carousel_widget_' . $key . '_args', $hook[3] ); //deprecated hook, use @tm_products_carousel_widget_hooks

				if( isset( $instance['tm_products_carousel_widget_' . $key ] ) ) {

					if( ( isset( $this->wp_filter[$action][$priority][$callback] ) &&
						0 === $instance['tm_products_carousel_widget_' . $key ] &&
						$before ) || (
						! isset( $this->wp_filter[$action][$priority][$callback] ) &&
						0 !== $instance['tm_products_carousel_widget_' . $key ] &&
						! $before )
					) {

						remove_action( $action, $callback, $priority, $args );
					}

					if( ( isset( $this->wp_filter[$action][$priority][$callback] ) &&
						0 === $instance['tm_products_carousel_widget_' . $key ] &&
						! $before ) || (
						! isset( $this->wp_filter[$action][$priority][$callback] ) &&
						0 !== $instance['tm_products_carousel_widget_' . $key ] &&
						$before )
					) {

						add_action( $action, $callback, $priority, $args );
					}
				}
			}
		}

		public function form( $instance ) {

			$instance = tm_wc()->update_options( $instance );

			$this->settings['tm_filter_by_cat']['options'] = tm_wc()->tm_get_products_terms();
			$this->settings['tm_filter_by_tag']['options'] = tm_wc()->tm_get_products_terms( 'product_tag' );

			parent::form( $instance );
		}

		/**
		 * Outputs the content for the current TM Products Carousel Widget instance.
		 *
		 * @since 1.1.5
		 * @param array $args
		 * @param array $instance
		 */
		public function widget( $args, $instance ) {

			if ( $this->get_cached_widget( $args ) ) {

				return;
			}
			$instance = tm_wc()->update_options( $instance );

			ob_start();

			if ( ( $products = $this->get_products( $args, $instance ) ) && $products->have_posts() ) {

				include_once( plugin_dir_path( dirname( dirname( dirname( __FILE__ ) ) ) ) . 'woocommerce/includes/class-wc-frontend-scripts.php' );

				WC_Frontend_Scripts::init();

				$this->widget_start( $args, $instance );

				$uniqid = uniqid();

				global $tm_products_carousel_widget_settings;

				$tm_products_carousel_widget_settings = $instance;

				$this->hooks( $this->hooks, $instance );

				$remove_hooks = apply_filters( 'tm_products_carousel_widget_remove_hooks', false );

				if( is_array( $remove_hooks ) ) {

					foreach( $remove_hooks as $hook ) {

						if( is_array( $hook ) && isset( $hook['type'] ) && isset( $hook['function'] ) ) {

							if( ! isset( $hook['priority'] ) ) {

								$hook['priority'] = 10;
							}
							if( ! isset( $hook['args'] ) ) {

								$hook['args'] = 1;
							}
							if( 'action' === $hook['type'] ) {

								remove_action( $hook['action'], $hook['function'], $hook['priority'], $hook['args'] );
							}
							else if( 'filter' === $hook['type'] ) {

								remove_filter( $hook['action'], $hook['function'], $hook['priority'], $hook['args'] );
							}
						}
					}
				}
				$between    = apply_filters( 'tm_products_carousel_widget_space_between_slides', 30, $this );
				$arrows_pos = apply_filters( 'tm_products_carousel_widget_arrows_pos', 'inside', $this );
				$arrows     = ! empty( $instance['tm_products_carousel_widget_arrows'] )     ? $instance['tm_products_carousel_widget_arrows']     : 0;
				$pagination = ! empty( $instance['tm_products_carousel_widget_pagination'] ) ? $instance['tm_products_carousel_widget_pagination'] : 0;
				$visible    = isset( $instance['tm_products_carousel_widget_visible'] )      ? $instance['tm_products_carousel_widget_visible']    : 4;

				if( count( $products->posts ) < $visible ) {

					$visible = count( $products->posts );
				}
				$visible      = apply_filters( 'tm_products_carousel_widget_visible', $visible, $args );
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
				$start_html[] = '<div class="woocommerce swiper-container tm-products-carousel-widget-container" id="swiper-carousel-' . $uniqid . '" ' . implode ( " ", $data_attrs ) . '>';
				$start_html[] = apply_filters( 'tm_products_carousel_widget_wrapper_open', '<ul class="swiper-wrapper tm-products-carousel-widget-wrapper products">', $this );

				echo implode ( "\n", $start_html );

				add_filter( 'post_class', 'tm_products_carousel_widget_post_class', 25, 3 );

				$template = apply_filters( 'tm_products_carousel_widget_template', 'content-product.php', $args, $instance, $this );

				$this->instance = $instance;
				add_filter( 'post_class', array( $this, 'loop_columns' ), 20, 3 );

				while ( $products->have_posts() ) {

					$products->the_post();

					wc_get_template( $template, array(
						'swiper' => true,
					) );
				}
				$this->hooks( $this->hooks, $instance, false );

				remove_filter( 'post_class', array( $this, 'loop_columns' ), 20, 3 );

				if( is_array( $remove_hooks ) ) {

					foreach( $remove_hooks as $hook ) {

						if( is_array( $hook ) && isset( $hook['type'] ) && isset( $hook['function'] ) ) {

							if( ! isset( $hook['priority'] ) ) {

								$hook['priority'] = 10;
							}
							if( ! isset( $hook['args'] ) ) {

								$hook['args'] = 1;
							}
							if( 'action' === $hook['type'] ) {

								add_action( $hook['action'], $hook['function'], $hook['priority'], $hook['args'] );
							}
							else if( 'filter' === $hook['type'] ) {

								add_filter( $hook['action'], $hook['function'], $hook['priority'], $hook['args'] );
							}
						}
					}
				}
				unset( $GLOBALS['tm_products_carousel_widget_settings'] );

				remove_filter( 'post_class', 'tm_products_carousel_widget_post_class', 25, 3 );

				$end_html[] = apply_filters( 'tm_products_carousel_widget_wrapper_close', '</ul>' );

				if( 'outside' === $arrows_pos ){

					$end_html[] = '</div>';
				}
				if( $pagination ) {

					$end_html[] = '<div id="swiper-carousel-'. $uniqid . '-pagination" class="swiper-pagination tm-products-carousel-widget-pagination"></div>';
				}
				if( $arrows ) {

					$end_html[] = '<div id="swiper-carousel-'. $uniqid . '-next" class="swiper-button-next tm-products-carousel-widget-button-next">' . do_action( 'tm_products_carousel_widget_next_arrow_icon' ) . '</div>';
					$end_html[] = '<div id="swiper-carousel-'. $uniqid . '-prev" class="swiper-button-prev tm-products-carousel-widget-button-prev">' . do_action( 'tm_products_carousel_widget_prev_arrow_icon' ) . '</div>';
				}
				if( 'inside' === $arrows_pos ){

					$end_html[] = '</div>';
				}
				echo implode ( "\n", $end_html );

				$this->widget_end( $args );
			}
			wp_reset_postdata();

			echo $this->cache_widget( $args, ob_get_clean() );
		}

		public function loop_columns( $classes, $class = '', $post_id = '' ) {

			foreach ( $classes as $key => $class ) {
				if ( false !== strpos( $class, 'col-xs-12') ) {
					unset( $classes[ $key ] );
				}
			}

			$cols = ! empty( $this->instance['tm_products_carousel_widget_visible'] )
						? (int) $this->instance['tm_products_carousel_widget_visible']
						: 4;

			if ( 5 === $cols ) {
				$cols = 4;
			}

			return $classes;
		}

		public function woocommerce_products_widget_query_args( $query_args ) {

			global $tm_wc_products_carousel_instance;

			$instance = $tm_wc_products_carousel_instance;

			foreach( array( 'cat', 'tag' ) as $term ) {

				if( isset( $instance['tm_filter_by_' . $term ] ) && 'all' !== $instance['tm_filter_by_' . $term ] ) {

					$query_args['tax_query'][] = array(
						'taxonomy' => 'product_' . $term,
						'field'    => 'term_taxonomy_id',
						'terms'    => $instance['tm_filter_by_' . $term ]
					);
				}
			}
			return $query_args;
		}

		/**
		 * Query the products and return them.
		 * @see
		 * @param  array $args
		 * @param  array $instance
		 * @return WP_Query
		 */
		public function get_products( $args, $instance ) {

			add_filter( 'woocommerce_products_widget_query_args', array( $this, 'woocommerce_products_widget_query_args' ) );

			$GLOBALS['tm_wc_products_carousel_instance'] = $instance;

			$products = parent::get_products( $args, $instance );

			unset( $GLOBALS['tm_wc_products_carousel_instance'] );

			remove_filter( 'woocommerce_products_widget_query_args', array( $this, 'woocommerce_products_widget_query_args' ) );

			return $products;
		}
	}
}
