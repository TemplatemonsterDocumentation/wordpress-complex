<?php

/**
 * TM WooCommerce Products Smart Box Widget
 *
 * @author   TemplateMonster
 * @category Widgets
 * @version  1.0.0
 * @extends  WC_Widget_Products
 */

if ( class_exists( 'WC_Widget_Products' ) ) {

	class __TM_Products_Smart_Box_Widget extends WC_Widget_Products {

		/**
		 * Sets up a new TM Products Smart Box Widget instance.
		 *
		 * @since 1.1.5
		 */
		public function __construct() {

			parent::__construct();

			$tm_wc = tm_wc();

			$this->widget_cssclass    = '__tm_products_smart_box_widget';
			$this->widget_description = __( 'TM widget to create products Smart Box', 'tm-woocommerce-package' );
			$this->widget_id          = '__tm_products_smart_box_widget';
			$this->widget_name        = __( 'TM Products Smart Box Widget', 'tm-woocommerce-package' );

			unset( $this->settings['show'] );

			$this->settings['tm_filter_by_cat'] = array(
				'type'       => 'multiselect',
				'std'        => 'all',
				'options_cb' => array( $tm_wc, 'tm_get_products_terms' ),
				'options'    => false,
				'label'      => __( 'Filter by category', 'tm-woocommerce-package' )
			);

			add_action( 'wp_enqueue_scripts', array( $this, '__tm_products_smart_box_widget_enqueue_files' ), 9 );

			WC_Widget::__construct();
		}

		/**
		 * Enqueue widget assets.
		 *
		 * @since 1.0.0
		 * @return void
		 */
		public function __tm_products_smart_box_widget_enqueue_files() {

			if ( is_active_widget( false, false, $this->id_base, true ) ) {

				wp_enqueue_style( 'jquery-rd-material-tabs' );
				wp_enqueue_script( 'jquery-rd-material-tabs' );
			}
		}

		/**
		 * Outputs the settings form for TM Products Smart Box Widget.
		 *
		 * @since 1.0.0
		 * @param array $instance
		 */
		public function form( $instance ) {

			$tm_wc = tm_wc();

			$instance = $tm_wc->update_options( $instance );

			parent::form( $instance );

			$tm_wc->tm_widgets_form_multiselect( $instance, $this );

		}

		/**
		 * Handles updating settings for the current TM Products Smart Box Widget instance.
		 *
		 * @since 1.0.0
		 *
		 * @param array $new_instance
		 * @param array $old_instance
		 * @return array
		 */
		public function update( $new_instance, $old_instance ) {

			add_action( 'woocommerce_widget_settings_sanitize_option', 'tm_products_smart_box_widget_settings_sanitize_option', 10, 4 );

			return parent::update( $new_instance, $old_instance );
		}

		/**
		 * Outputs the content for the current TM Products Smart Box Widget instance.
		 *
		 * @since 1.1.5
		 * @param array $args
		 * @param array $instance
		 */
		public function widget( $args, $instance ) {

			if ( $this->get_cached_widget( $args ) ) {

				return;
			}
			$include_bootstrap_grid = apply_filters( 'tm_woocommerce_include_bootstrap_grid', true );

			if ( $include_bootstrap_grid ) {

				wp_enqueue_style( 'bootstrap-grid' );
			}
			$instance = tm_wc()->update_options( $instance );

			add_filter( 'post_class', array( $this, 'loop_columns' ), 20, 3 );
			ob_start();

			$tm_filter_by_cat = ! empty( $instance['tm_filter_by_cat'] ) ? $instance['tm_filter_by_cat'] : false;
			$terms_args       = array();

			if ( is_array( $tm_filter_by_cat ) && ! in_array( 'all', $tm_filter_by_cat ) ) {

				$terms_args = array( 'include' => implode ( ', ', $tm_filter_by_cat ) );
			}
			$categories   = get_terms( 'product_cat', $terms_args );
			$start_html[] = '<section class="woocommerce rd-material-tabs tm-products-smart-box-widget__rd-material-tabs" data-margin="0">';
			$start_html[] = '<div class="row">';
			$start_html[] = apply_filters( 'tm_products_smart_box_widget__tabs_start', '<div class="col-xl-3 col-lg-3 col-md-4 col-sm-12 col-xs-12">' );

			if ( $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base ) ) {

				$start_html[] = $args['before_title'] . $title . $args['after_title'];
			}
			$start_html[] = '<div class="rd-material-tabs__list tm-products-smart-box-widget__rd-material-tabs__list">';
			$start_html[] = '<ul>';
			$is_html      = false;

			foreach ( $categories as $key => $category ) {

				$thumbnail_id = get_woocommerce_term_meta( $category->term_id, 'thumbnail_id' );
				$image_meta   = get_post_meta( $thumbnail_id, '_wp_attachment_metadata', true );
				$cat_img_size = apply_filters( 'tm_products_smart_box_widget__cat_img_size', 'original' );
				$image        = wp_get_attachment_image ( $thumbnail_id, $cat_img_size );

				if( ! $image ) {

					$image = wc_placeholder_img( $cat_img_size );
				}

				$categories[$key]->thumb = $image;
				$args['category']        = $category->term_taxonomy_id;
				$products[$key]          = $this->get_products_category( $args, $instance );

				if ( ( $products[$key] ) && $products[$key]->have_posts() ) {

					$is_html    = true;
					$nav_html[] = '<li>';
					$nav_html[] = '<a href="#">' . $category->name . '</a>';
					$nav_html[] = '</li>';
				}
			}
			$nav_html[] = '</ul>';
			$nav_html[] = '</div>';
			$nav_html[] = apply_filters( 'tm_products_smart_box_widget__tabs_end', '</div>' );
			$nav_html[] = apply_filters( 'tm_products_smart_box_widget__categories_start', '<div class="col-xl-9 col-lg-9 col-md-8 col-sm-12 col-xs-12">' );
			$nav_html[] = '<div class="rd-material-tabs__container tm-products-smart-box-widget__rd-material-tabs__container">';

			if( $is_html ) {

				echo $args['before_widget'];

				echo implode ( "\n", $start_html );

				echo implode ( "\n", $nav_html );

				foreach ( $categories as $key => $category ) {

					if ( ( $products[$key] ) && $products[$key]->have_posts() ) { ?>

					<div>
					<?php
						echo apply_filters( 'tm_products_smart_box_widget__categoties_row_start', '<div class="row">' ) .
							 apply_filters( 'tm_products_smart_box_widget__products_start', '<div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-xs-12">' ) .
							 apply_filters( 'tm_products_smart_box_widget__products_row_start', '<div class="row">' );

						while ( $products[$key]->have_posts() ) {

							$products[$key]->the_post();

							wc_get_template( 'tm-smart-box-widget-product.php', array(), '', tm_wc()->plugin_dir() . '/templates/' );

							} ?>
							</div>
							<?php
								echo apply_filters( 'tm_products_smart_box_widget__products_end', '</div>' ) .
									 apply_filters( 'tm_products_smart_box_widget__cat_thumb_start', '<div class="col-xl-4 col-lg-4 col-md-12 col-sm-4 col-xs-12">' ) .
									 $category->thumb .
									 apply_filters( 'tm_products_smart_box_widget__cat_thumb_end', '</div>' );
							?>
						</div>
					</div>
					<?php }
				}
				$end_html[] = '</div>';
				$end_html[] = apply_filters( 'tm_products_smart_box_widget__categories_end', '</div>' );
				$end_html[] = '</div>';
				$end_html[] = '</section>';
				$end_html[] = '<!-- END RD Material Tabs-->';

				echo implode ( "\n", $end_html );

				$this->widget_end( $args );
			}
			wp_reset_postdata();
			remove_filter( 'post_class', array( $this, 'loop_columns' ), 20, 3 );

			echo $this->cache_widget( $args, ob_get_clean() );
		}

		public function loop_columns( $classes ) {

			foreach ( $classes as $key => $class ) {
				if ( false !== strpos( $class, 'col-xs-12') ) {
					unset( $classes[ $key ] );
				}
			}

			return $classes;

		}

		/**
		 * Get products category
		 *
		 * @since 1.1.1
		 * @param array $args
		 * @param array $instance
		 * @return object
		 */
		public function get_products_category( $args, $instance ) {

			$number  = ! empty( $instance['number'] )  ? absint( $instance['number'] )          : $this->settings['number']['std'];
			$orderby = ! empty( $instance['orderby'] ) ? sanitize_title( $instance['orderby'] ) : $this->settings['orderby']['std'];
			$order   = ! empty( $instance['order'] )   ? sanitize_title( $instance['order'] )   : $this->settings['order']['std'];

			$query_args = array(
				'posts_per_page' => $number,
				'post_status'    => 'publish',
				'post_type'      => 'product',
				'no_found_rows'  => 1,
				'order'          => $order,
				'meta_query'     => array()
			);
			if ( empty( $instance['show_hidden'] ) ) {
				$query_args['meta_query'][] = WC()->query->visibility_meta_query();
				$query_args['post_parent']  = 0;
			}
			if ( ! empty( $instance['hide_free'] ) ) {
				$query_args['meta_query'][] = array(
					'key'     => '_price',
					'value'   => 0,
					'compare' => '>',
					'type'    => 'DECIMAL',
				);
			}
			$query_args['meta_query'][] = WC()->query->stock_status_meta_query();
			$query_args['meta_query']   = array_filter( $query_args['meta_query'] );

			$tax_query   = array();
			$tax_query[] = array(
				'taxonomy' => 'product_cat',
				'field'    => 'term_taxonomy_id',
				'terms'    => $args['category']
			);
			$query_args['tax_query']    = $tax_query;
			$query_args['meta_query'][] = array(
				'key'   => '_featured',
				'value' => 'yes'
			);
			switch ( $orderby ) {
				case 'price' :
					$query_args['meta_key'] = '_price';
					$query_args['orderby']  = 'meta_value_num';
					break;
				case 'rand' :
					$query_args['orderby']  = 'rand';
					break;
				case 'sales' :
					$query_args['meta_key'] = 'total_sales';
					$query_args['orderby']  = 'meta_value_num';
					break;
				default :
					$query_args['orderby']  = 'date';
			}
			return new WP_Query( apply_filters( 'tm_products_smart_box_widget_query_args', $query_args ) );
		}
	}
}
?>