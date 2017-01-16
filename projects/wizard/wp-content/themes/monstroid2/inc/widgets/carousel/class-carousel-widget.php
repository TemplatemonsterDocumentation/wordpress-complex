<?php
/*
Widget Name: Carousel widget
Description: This widget is used to display a list of your posts in a carousel layout
Settings:
 Title - Widget's text title
 Choose taxonomy type - Choose posts source type
 Select category / Select tag - Choose tags or categories as your posts source
 Posts count - Limit the posts
 Display title - Choose whether to display post title
 Display content - Choose whether to display post content
 Display more button - Choose whether to display a more button
 Content words trimmed count - Limit the post content
 Number of slides per view - Choose a number of slides per view
 Number of slides per group - Choose a number of slides per group
 Multirow Slides Layout - Choose a number of rows
 Width of the space between slides (px) - Choose a distance between slides
 Duration of transition between slides (ms) - Choose the slides animation speed
 Slider navigation - Toggle the slider navigation
 Slider pagination - Toggle the slider pagination
*/

/**
 * @package Monstroid2
 */
if ( ! class_exists( 'Monstroid2_Carousel_Widget' ) ) {

	/**
	 * Class Monstroid2_Carousel_Widget.
	 */
	class Monstroid2_Carousel_Widget extends Cherry_Abstract_Widget {

		/**
		 * Contain utility module from Cherry framework
		 *
		 * @since 1.0.0
		 * @var   object
		 */
		private $utility = null;

		/**
		 * Constructor.
		 *
		 * @since  1.0.0
		 */
		public function __construct() {
			$this->widget_cssclass    = 'widget-carousel';
			$this->widget_description = esc_html__( 'Display a list of your posts on your site.', 'monstroid2' );
			$this->widget_id          = 'monstroid2_widget_carousel';
			$this->widget_name        = esc_html__( 'Carousel', 'monstroid2' );
			$this->utility            = monstroid2_utility()->utility;
			$this->settings           = array(
				'title' => array(
					'type'  => 'text',
					'value' => '',
					'label' => esc_html__( 'Title', 'monstroid2' ),
				),
				'terms_type' => array(
					'type'    => 'radio',
					'value'   => 'category',
					'options' => array(
						'category' => array(
							'label' => esc_html__( 'Category', 'monstroid2' ),
							'slave' => 'terms_type_category',
						),
						'post_tag' => array(
							'label' => esc_html__( 'Tag', 'monstroid2' ),
							'slave' => 'terms_type_post_tag',
						),
					),
					'label'   => esc_html__( 'Choose taxonomy type', 'monstroid2' ),
				),
				'categories' => array(
					'type'             => 'select',
					'size'             => 1,
					'value'            => '',
					'options_callback' => array( $this->utility->satellite, 'get_terms_array', array( 'category', 'slug' ) ),
					'options'          => false,
					'label'            => esc_html__( 'Select category', 'monstroid2' ),
					'multiple'         => true,
					'placeholder'      => esc_html__( 'Select category', 'monstroid2' ),
					'master'           => 'terms_type_category',
				),
				'tags' => array(
					'type'             => 'select',
					'size'             => 1,
					'value'            => '',
					'options_callback' => array( $this->utility->satellite, 'get_terms_array', array( 'post_tag', 'slug' ) ),
					'options'          => false,
					'label'            => esc_html__( 'Select tags', 'monstroid2' ),
					'multiple'         => true,
					'placeholder'      => esc_html__( 'Select tags', 'monstroid2' ),
					'master'           => 'terms_type_post_tag',
				),
				'posts_per_page' => array(
					'type'      => 'stepper',
					'value'     => 10,
					'max_value' => 20,
					'min_value' => 1,
					'label'     => esc_html__( 'Posts count', 'monstroid2' ),
				),
				'post_title' => array(
					'type'  => 'switcher',
					'value' => 'true',
					'style' => ( wp_is_mobile() ) ? 'normal' : 'small',
					'label' => esc_html__( 'Display title', 'monstroid2' ),
				),
				'content' => array(
					'type'  => 'switcher',
					'value' => 'false',
					'style' => ( wp_is_mobile() ) ? 'normal' : 'small',
					'label' => esc_html__( 'Display content', 'monstroid2' ),
				),
				'more_button' => array(
					'type'   => 'switcher',
					'value'  => 'false',
					'style'  => ( wp_is_mobile() ) ? 'normal' : 'small',
					'label'  => esc_html__( 'Display more button', 'monstroid2' ),
					'toggle' => array(
						'true_toggle'  => esc_html__( 'On', 'monstroid2' ),
						'false_toggle' => esc_html__( 'Off', 'monstroid2' ),
						'true_slave'   => 'more_button_attr',
						'false_slave'  => '',
					),
				),
				'more_button_text' => array(
					'type'   => 'text',
					'value'  => esc_html__( 'Read more', 'monstroid2' ),
					'label'  => esc_html__( 'More button text', 'monstroid2' ),
					'master' => 'more_button_attr',
				),
				'trim_title' => array(
					'type'       => 'slider',
					'value'      => 30,
					'max_value'  => 100,
					'min_value'  => 1,
					'step_value' => 1,
					'label'      => esc_html__( 'Title chars trimmed count', 'monstroid2' ),
				),
				'trim_words' => array(
					'type'       => 'slider',
					'value'      => 15,
					'max_value'  => 55,
					'min_value'  => 1,
					'step_value' => 1,
					'label'      => esc_html__( 'Content words trimmed count', 'monstroid2' ),
				),
				'slides_per_view' => array(
					'type'      => 'slider',
					'max_value' => 25,
					'min_value' => 1,
					'value'     => 5,
					'label'     => esc_html__( 'Number of slides per view', 'monstroid2' ),
				),
				'slides_per_group' => array(
					'type'      => 'slider',
					'max_value' => 25,
					'min_value' => 1,
					'value'     => 1,
					'label'     => esc_html__( 'Number slides per group', 'monstroid2' ),
				),
				'slides_per_column' => array(
					'type'      => 'slider',
					'max_value' => 5,
					'min_value' => 1,
					'value'     => 1,
					'label'     => esc_html__( 'Multi Row Slides Layout', 'monstroid2' ),
				),
				'space_between_slides' => array(
					'type'      => 'slider',
					'max_value' => 100,
					'min_value' => 0,
					'value'     => 30,
					'label'     => esc_html__( 'Width of the space between slides(px)', 'monstroid2' ),
				),
				'duration_speed' => array(
					'type'      => 'slider',
					'max_value' => 5000,
					'min_value' => 100,
					'value'     => 500,
					'label'     => esc_html__( 'Duration of transition between slides (ms)', 'monstroid2' ),
				),
				'navigation' => array(
					'type'  => 'switcher',
					'value' => 'true',
					'style' => ( wp_is_mobile() ) ? 'normal' : 'small',
					'label' => esc_html__( 'Slider navigation', 'monstroid2' ),
				),
				'pagination' => array(
					'type'  => 'switcher',
					'value' => 'true',
					'style' => ( wp_is_mobile() ) ? 'normal' : 'small',
					'label' => esc_html__( 'Slider pagination', 'monstroid2' ),
				),
			);

			parent::__construct();

			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_assets' ), 9 );
		}

		/**
		 * widget function.
		 *
		 * @see WP_Widget
		 *
		 * @since 1.0.0
		 * @param array $args
		 * @param array $instance
		 */
		public function widget( $args, $instance ) {
			if ( $this->get_cached_widget( $args ) ) {
				return;
			}

			$template = locate_template( apply_filters( 'monstroid2_carousel_widget_view_dir', 'inc/widgets/carousel/views/carousel-view.php' ), false, false );

			if ( empty( $template ) ) {
				return;
			}

			ob_start();

			$this->setup_widget_data( $args, $instance );
			$this->widget_start( $args, $instance );

			// Widgets area check.
			if ( 'sidebar' == $args['id'] ) {
				$this->instance['slides_per_view']   = 1;
				$this->instance['slides_per_group']  = 1;
				$this->instance['slides_per_column'] = 1;
			}

			$footer_widget_columns = get_theme_mod( 'footer_widget_columns', monstroid2_theme()->customizer->get_default( 'footer_widget_columns' ) );

			if ( 'footer-area' == $args['id'] && in_array( $footer_widget_columns, array( '2', '3', '4' ) ) ) {
				$this->instance['slides_per_view']   = 1;
				$this->instance['slides_per_group']  = 1;
				$this->instance['slides_per_column'] = 1;
			}

			$instance = uniqid();

			$data_attr_line = 'class="monstroid2-carousel swiper-container"';
			$data_attr_line .= ' data-uniq-id="swiper-carousel-' . $instance . '"';
			$data_attr_line .= ' data-slides-per-view="' . esc_attr( $this->instance['slides_per_view'] ) . '"';
			$data_attr_line .= ' data-slides-per-group="' . esc_attr( $this->instance['slides_per_group'] ) . '"';
			$data_attr_line .= ' data-slides-per-column="' . esc_attr( $this->instance['slides_per_column'] ) . '"';
			$data_attr_line .= ' data-space-between-slides="' . esc_attr( $this->instance['space_between_slides'] ) . '"';
			$data_attr_line .= ' data-duration-speed="' . esc_attr( $this->instance['duration_speed'] ) . '"';
			$data_attr_line .= ' data-swiper-loop="false"';
			$data_attr_line .= ' data-free-mode="false"';
			$data_attr_line .= ' data-grab-cursor="true"';
			$data_attr_line .= ' data-mouse-wheel="false"';

			$swiper_pagination_html = ( 'true' == $this->instance['pagination'] ) ? '<div id="swiper-carousel-'. $instance . '-pagination" class="swiper-pagination"></div>' : '';
			$swiper_navigation_html = ( 'true' == $this->instance['navigation'] ) ? '<div id="swiper-carousel-'. $instance . '-next" class="swiper-button-next button-next"><i class="linearicon linearicon-chevron-right"></i></div><div id="swiper-carousel-'. $instance . '-prev" class="swiper-button-prev button-prev"><i class="linearicon linearicon-chevron-left"></i></div>' : '';

			$categories_array = ( isset( $this->instance['categories'] ) ) ? $this->instance['categories'] : array();
			$tags_array       = ( isset( $this->instance['tags'] ) ) ? $this->instance['tags'] : array();

			$tax_query = array();

			if ( 'category' == $this->instance['terms_type'] ) {
				if ( ( is_array( $categories_array ) && ! empty( $categories_array ) ) ) {
					array_push( $tax_query, array(
						'taxonomy' => 'category',
						'field'    => 'slug',
						'terms'    => $categories_array,
					) );
				}
			} else {
				if ( ( is_array( $tags_array ) && ! empty( $tags_array ) ) ) {
					array_push( $tax_query, array(
						'taxonomy' => 'post_tag',
						'field'    => 'slug',
						'terms'    => $tags_array,
					) );
				}
			}

			// The Query.
			$posts_query = $this->get_query_items( array(
				'posts_per_page' => $this->instance['posts_per_page'],
				'tax_query'      => $tax_query,
			) );

			if ( $posts_query ) {
				echo '<div class="swiper-carousel-container">';
					echo '<div id="swiper-carousel-' . $instance . '" ' . $data_attr_line . '>';
						echo '<div class="swiper-wrapper">';
							echo $this->get_carousel_loop( $posts_query, $template );
						echo '</div>';
						echo $swiper_pagination_html;
					echo '</div>';
					echo $swiper_navigation_html;
				echo '</div>';
			} else {
				echo '<h5>' . esc_html__( 'Posts not found', 'monstroid2' ) . '</h5>';
			}

			$this->widget_end( $args );
			$this->reset_widget_data();
			wp_reset_postdata();

			echo $this->cache_widget( $args, ob_get_clean() );
		}

		/**
		 * Get carousel items.
		 *
		 * @since  1.0.0
		 * @param  array|string $args Arguments to be passed to the query.
		 * @return array|bool         Array if true, boolean if false.
		 */
		public function get_query_items( $query_args = array() ) {

			$defaults_query_args = apply_filters( 'monstroid2_carousel_default_query_args', array(
				'post_type'      => 'post',
				'orderby'        => 'date',
				'order'          => 'DESC',
				'posts_per_page' => - 1,
				'tax_query'      => array(),
			) );

			$query_args = wp_parse_args( $query_args, $defaults_query_args );
			$query_args = array_intersect_key( $query_args, $defaults_query_args );

			// The Query.
			$posts_query = new WP_Query( $query_args );

			if ( ! is_wp_error( $posts_query ) && $posts_query->have_posts() ) {
				return $posts_query;
			} else {
				return false;
			}
		}

		/**
		 * Get carousel items.
		 *
		 * @since  1.0.0
		 * @param  array  $posts_query List of WP_Post objects.
		 * @return string
		 */
		public function get_carousel_loop( $posts_query, $template ) {

			if ( ! $template  ) {
				return '<h5>' . esc_html__( 'View file not found', 'monstroid2' ) . '</h5>';
			}

			while ( $posts_query->have_posts() ) : $posts_query->the_post();

				$permalink = $this->utility->media->get_post_permalink();

				$date      = $this->utility->meta_data->get_date( array(
					'class' => 'post__date',
				) );

				$author = $this->utility->meta_data->get_author( array(
					'class'  => 'posted-by__author',
					'prefix' => esc_html__( 'by ', 'monstroid2' ),
					'html'   => '<span class="posted-by">%1$s<a href="%2$s" %3$s %4$s rel="author">%5$s%6$s</a></span>',
				) );

				$title = $this->utility->attributes->get_title( array(
					'visible'      => $this->instance['post_title'],
					'class'        => 'entry-title',
					'length'       => (int) $this->instance['trim_title'],
					'trimmed_type' => 'char',
					'html'         => '<h5 %1$s><a href="%2$s" %3$s>%4$s</a></h5>',
				) );

				$image = $this->utility->media->get_image( array(
					'size'              => 'post-thumbnail',
					'mobile_size'       => 'monstroid2-thumb-m',
					'class'             => 'post-thumbnail__link',
					'html'              => '<a href="%1$s" %2$s ><img class="post-thumbnail__img" src="%3$s" alt="%4$s" %5$s ></a>',
					'placeholder_title' => strip_tags( $title ),
				) );

				$content = $this->utility->attributes->get_content( array(
					'visible' => $this->instance['content'],
					'length'  => (int) $this->instance['trim_words'],
					'class'   => 'post__excerpt',
				) );

				$more_button = $this->utility->attributes->get_button( array(
					'visible' => $this->instance['more_button'],
					'text'    => $this->use_wpml_translate( 'more_button_text' ),
					'class'   => 'carousel__more-btn link',
					'icon'    => '<i class="linearicon linearicon-arrow-right"></i>',
					'html'    => '<a href="%1$s" %3$s><span class="link__text">%4$s</span>%5$s</a>',
				) );

				$comments = $this->utility->meta_data->get_comment_count( array(
					'html'  => '<span class="post__comments">%1$s<a href="%2$s" %3$s %4$s>%5$s%6$s</a></span>',
					'sufix' => get_comments_number_text( esc_html__( 'No comment(s)', 'monstroid2' ), esc_html__( '1 comment', 'monstroid2' ), esc_html__( '% comments', 'monstroid2' ) ),
					'class' => 'post__comments-link',
				) );

				$terms_line = $this->utility->meta_data->get_terms( array(
					'type'   => $this->instance['terms_type'],
					'before' => '<span class="post__cats">',
					'after'  => '</span>',
					'icon'   => '',
				) );

				echo '<article class="swiper-slide">';
					include $template;
				echo '</article>';

			endwhile;

		}

		/**
		 * Enqueue javascript and stylesheet.
		 *
		 * @since 1.0.0
		 */
		public function enqueue_assets() {
			wp_enqueue_style( 'jquery-swiper' );
			wp_enqueue_script( 'jquery-swiper' );
		}
	}

	add_action( 'widgets_init', 'monstroid2_register_carousel_widget' );
	/**
	 * Register carousel widget.
	 */
	function monstroid2_register_carousel_widget() {
		register_widget( 'Monstroid2_Carousel_Widget' );
	}
}
