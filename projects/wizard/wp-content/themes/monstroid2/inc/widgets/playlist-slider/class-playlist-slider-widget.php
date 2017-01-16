<?php
/*
Widget Name: Playlist Slider Widget
Description:
Settings:
*/

/**
 * @package Monstroid2
 */

if ( ! class_exists( 'Monstroid2_Playlist_Slider_Widget' ) ) {

	/**
	 * Class Monstroid2_Playlist_Slider_Widget.
	 */
	class Monstroid2_Playlist_Slider_Widget extends Cherry_Abstract_Widget {

		private $posts           = null;
		public $instance         = null;
		private $layout_settings = array();

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
		 * @since	1.0.0
		 */
		public function __construct() {
			$this->widget_name        = esc_html__( 'Playlist Slider', 'monstroid2' );
			$this->widget_description = esc_html__( 'Display playlist slider on your site.', 'monstroid2' );
			$this->widget_id          = apply_filters( 'monstroid2_playlist_slider_widget_ID', 'monstroid2_widget_playlist_slider' );
			$this->widget_cssclass    = apply_filters( 'monstroid2_playlist_slider_widget_cssclass', 'widget-playlist-slider' );
			$this->utility            = monstroid2_utility()->utility;
			$this->settings = array(
				'title' => array(
					'type'  => 'text',
					'value' => esc_html__( 'Playlist Slider', 'monstroid2' ),
					'label' => esc_html__( 'Title', 'monstroid2' ),
				),
				'terms_type' => array(
					'type'    => 'radio',
					'value'   => 'category_name',
					'options' => array(
						'category_name' => array(
							'label' => esc_html__( 'Category', 'monstroid2' ),
							'slave' => 'terms_type_post_category',
						),
						'tag' => array(
							'label' => esc_html__( 'Tag', 'monstroid2' ),
							'slave' => 'terms_type_post_tag',
						),
					),
					'label' => esc_html__( 'Choose taxonomy type', 'monstroid2' ),
				),
				'category_name' => array(
					'type'             => 'select',
					'size'             => 1,
					'value'            => '',
					'options_callback' => array( $this->utility->satellite, 'get_terms_array', array( 'category', 'slug' ) ),
					'options'          => false,
					'label'            => esc_html__( 'Select category', 'monstroid2' ),
					'multiple'         => true,
					'placeholder'      => esc_html__( 'Select category', 'monstroid2' ),
					'master'           => 'terms_type_post_category',
				),
				'tag' => array(
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
					'max_value' => 50,
					'min_value' => 0,
					'label'     => esc_html__( 'Posts count ( Set 0 to show all. )', 'monstroid2' ),
				),
				'width' => array(
					'type'  => 'text',
					'value' => '100%',
					'label' => esc_html__( 'Slider width ( px, %, rem )', 'monstroid2' ),
				),
				'height' => array(
					'type' => 'text',
					'value' => '500',
					'label' => esc_html__( 'Slider height ( px, rem )', 'monstroid2' ),
				),
				'thumbnail_controls' => array(
					'type'    => 'select',
					'size'    => 1,
					'value'   => true,
					'options' => array(
						false => esc_html__( 'Hide', 'monstroid2' ),
						true  => esc_html__( 'Buttons', 'monstroid2' ),
					),
					'label'       => esc_html__( 'Select Thumbnail Controls', 'monstroid2' ),
					'placeholder' => esc_html__( 'Select Thumbnail Controls', 'monstroid2' ),
				),
				'slider_controls' => array(
					'type'    => 'select',
					'size'    => 1,
					'value'   => true,
					'options' => array(
						false => esc_html__( 'Hide', 'monstroid2' ),
						true  => esc_html__( 'Buttons', 'monstroid2' ),
					),
					'label'       => esc_html__( 'Select Slider Controls', 'monstroid2' ),
					'placeholder' => esc_html__( 'Select Thumbnail Controls', 'monstroid2' ),
				),
				'title_length' => array(
					'type'       => 'stepper',
					'value'      => '10',
					'max_value'  => '500',
					'min_value'  => '0',
					'step_value' => '1',
					'label'      => esc_html__( 'Title words length ( Set 0 to hide title. )', 'monstroid2' ),
				),
				'thumb_title_length' => array(
					'type'       => 'stepper',
					'value'      => '5',
					'max_value'  => '500',
					'min_value'  => '0',
					'step_value' => '1',
					'label'      => esc_html__( 'Thumbnail title words length ( Set 0 to hide title. )', 'monstroid2' ),
				),
				'mate_data' => array(
					'type'  => 'checkbox',
					'value' => array(
						'date'     => 'true',
						'author'   => 'false',
						'comments' => 'false',
						'category' => 'false',
						'tag'      => 'false',
					),
					'options' => array(
						'date'     => esc_html__( 'Date', 'monstroid2' ),
						'author'   => esc_html__( 'Author', 'monstroid2' ),
						'comments' => esc_html__( 'Comment count', 'monstroid2' ),
						'category' => esc_html__( 'Category', 'monstroid2' ),
						'post_tag' => esc_html__( 'Tag', 'monstroid2' ),
					),
					'label' => esc_html__( 'Display post meta data', 'monstroid2' ),
				),
				'thumb_mate_data' => array(
					'type'  => 'checkbox',
					'value' => array(
						'date'     => 'true',
						'author'   => 'false',
						'comments' => 'false',
					),
					'options' => array(
						'date'     => esc_html__( 'Date', 'monstroid2' ),
						'author'   => esc_html__( 'Author', 'monstroid2' ),
						'comments' => esc_html__( 'Comment count', 'monstroid2' ),
					),
					'label' => esc_html__( 'Display thumbnail post meta data', 'monstroid2' ),
				),
			);

			parent::__construct();

			// default
			$widget_area_settings_0 = array(
				'thumbnailWidth'     => 460,
				'thumbnailHeight'    => 'auto',
				'thumbnailsPosition' => 'right',
				'breakpoints'        => array(
					'1199' => array(
						'thumbnailWidth'     => 139,
						'thumbnailHeight'    => 165,
						'thumbnailsPosition' => 'bottom',
					),
					'991' => array(
						'thumbnailWidth'     => 165,
						'thumbnailHeight'    => 165,
						'thumbnailsPosition' => 'bottom',
					),
					'767' => array(
						'thumbnailWidth'     => 172,
						'thumbnailHeight'    => 172,
						'thumbnailsPosition' => 'bottom',
					),
					'543' => array(
						'thumbnailWidth'     => 156,
						'thumbnailHeight'    => 156,
						'thumbnailsPosition' => 'bottom',
					),
				),
			);

			// sidebar
			$widget_area_settings_1 = array(
				'thumbnailWidth'     => 105,
				'thumbnailHeight'    => 105,
				'thumbnailsPosition' => 'bottom',
				'breakpoints'        => array(
					'1199' => array(
						'thumbnailWidth'     => 149,
						'thumbnailHeight'    => 149,
						'thumbnailsPosition' => 'bottom',
					),
					'991' => array(
						'thumbnailWidth'     => 130,
						'thumbnailHeight'    => 130,
						'thumbnailsPosition' => 'bottom',
					),
					'767' => array(
						'thumbnailWidth'     => 172,
						'thumbnailHeight'    => 172,
						'thumbnailsPosition' => 'bottom',
					),
					'543' => array(
						'thumbnailWidth'     => 156,
						'thumbnailHeight'    => 156,
						'thumbnailsPosition' => 'bottom',
					),
				),
			);

			// before-loop-area, after-loop-area
			$widget_area_settings_2 = array(
				'thumbnailWidth'     => 176,
				'thumbnailHeight'    => 176,
				'thumbnailsPosition' => 'bottom',
				'breakpoints'        => array(
					'1199' => array(
						'thumbnailWidth'     => 125,
						'thumbnailHeight'    => 125,
						'thumbnailsPosition' => 'bottom',
					),
					'991' => array(
						'thumbnailWidth'     => 153,
						'thumbnailHeight'    => 153,
						'thumbnailsPosition' => 'bottom',
					),
					'767' => array(
						'thumbnailWidth'     => 172,
						'thumbnailHeight'    => 172,
						'thumbnailsPosition' => 'bottom',
					),
					'543' => array(
						'thumbnailWidth'     => 156,
						'thumbnailHeight'    => 156,
						'thumbnailsPosition' => 'bottom',
					),
				),
			);

			// footer-area
			$widget_area_settings_3 = array(
				'thumbnailWidth'     => 121,
				'thumbnailHeight'    => 121,
				'thumbnailsPosition' => 'bottom',
				'breakpoints'        => array(
					'1199' => array(
						'thumbnailWidth'     => 140,
						'thumbnailHeight'    => 140,
						'thumbnailsPosition' => 'bottom',
					),
					'991' => array(
						'thumbnailWidth'     => 103,
						'thumbnailHeight'    => 103,
						'thumbnailsPosition' => 'bottom',
					),
					'767' => array(
						'thumbnailWidth'     => 80,
						'thumbnailHeight'    => 80,
						'thumbnailsPosition' => 'bottom',
					),
					'543' => array(
						'thumbnailWidth'     => 163,
						'thumbnailHeight'    => 163,
						'thumbnailsPosition' => 'bottom',
					),
				),
			);

			$this->layout_settings = apply_filters( 'monstroid2_playlist_slider_size', array(
					'default'           => $widget_area_settings_0,
					'sidebar'           => $widget_area_settings_1,
					'before-loop-area'  => $widget_area_settings_2,
					'after-loop-area'   => $widget_area_settings_2,
					'footer-area'       => $widget_area_settings_3,
				)
			);

			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_assets' ), 9 );
		}

		/**
		 * Echo thumbnail view.
		 *
		 * @since 1.0.0
		 * @return string
		 */
		public function the_thumbnail_view() {
			$thumbnails_view_dir = locate_template( 'inc/widgets/playlist-slider/views/playlist-thumbnails-view.php', false, false );

			if ( ! $thumbnails_view_dir ) {
				return;
			}

			foreach ( $this->posts as $post ) {

				$title = $this->utility->attributes->get_title( array(
					'visible'      => $this->instance['thumb_title_length'] > 0 ? true : false,
					'class'        => 'sp-thumbnail-title',
					'length'       => (int) $this->instance['thumb_title_length'],
					'trimmed_type' => 'word',
					'ending'       => '&hellip;',
					'html'         => '<h6 %1$s>%4$s</h6>',
				), 'post', $post );

				$image = $this->utility->media->get_image( array(
					'size'        => 'monstroid2-thumb-s',
					'mobile_size' => 'monstroid2-thumb-s',
					'html'        => '<div class="playlist-img playlist--thumbnail" style="background-image: url(\'%3$s\');"></div>',
				), 'post', $post );

				$date = $this->utility->meta_data->get_date ( array(
					'visible' => $this->instance['thumb_mate_data']['date'],
					'html'    => '<span class="post__date">%1$s<time datetime="%5$s">%6$s%7$s</time></span>',
				));

				$author = $this->utility->meta_data->get_author( array(
					'visible' => $this->instance['thumb_mate_data']['author'],
					'prefix'  => esc_html__( 'by ', 'monstroid2' ),
					'html'    => '<span class="posted-by">%1$s%5$s%6$s</span>',
				) );

				$comments = $this->utility->meta_data->get_comment_count( array(
					'visible' => $this->instance['thumb_mate_data']['comments'],
					'html'    => '<span class="post__comments">%1$s%5$s%6$s</span>',
					'sufix'   => get_comments_number_text( esc_html__( 'No comment(s)', 'monstroid2' ), esc_html__( '1 comment', 'monstroid2' ), esc_html__( '% comments', 'monstroid2' ) ),
				) );

				include $thumbnails_view_dir;
			}
		}

		/**
		 * Echo slider view.
		 *
		 * @since 1.0.0
		 * @return string
		 */
		public function the_slides_view() {
			$slides_view_dir = locate_template( 'inc/widgets/playlist-slider/views/playlist-slides-view.php', false, false );

			if ( ! $slides_view_dir ) {
				return;
			}

			global $post;

			foreach ( $this->posts as $post) {
				setup_postdata( $post );

				$title = '';

				if ( $this->instance['title_length'] > 0 ) {
					$title = $this->utility->attributes->get_title( array(
						'length' => (int) $this->instance['title_length'],
						'class'  => 'title',
						'html'   => '<h5 %1$s><a href="%2$s" %3$s>%4$s</a></h5>',
					) );
				}

				$date = $this->utility->meta_data->get_date( array(
					'visible' => $this->instance['mate_data']['date'],
					'html'    => '<span class="post__date">%1$s<a href="%2$s" %3$s %4$s ><time datetime="%5$s">%6$s%7$s</time></a></span>',
					'class'   => 'post__date-link',
				) );

				$author = $this->utility->meta_data->get_author( array(
					'visible' => $this->instance['mate_data']['author'],
					'class'   => 'posted-by__author',
					'prefix'  => esc_html__( 'by ', 'monstroid2' ),
					'html'    => '<span class="posted-by">%1$s<a href="%2$s" %3$s %4$s rel="author">%5$s%6$s</a></span>',
				) );

				$category = $this->utility->meta_data->get_terms( array(
					'type'      => 'category',
					'class'     => 'post_term',
					'delimiter' => ', ',
					'visible'   => $this->instance['mate_data']['category'],
					'before'    => '<span class="post__cats">',
					'after'     => '</span>',
				) );

				$tag = $this->utility->meta_data->get_terms( array(
					'type'      => 'post_tag',
					'class'     => 'post_term',
					'delimiter' => ', ',
					'visible'   => $this->instance['mate_data']['post_tag'],
					'before'    => '<span class="post__tags">',
					'after'     => '</span>',
				) );

				$comments = $this->utility->meta_data->get_comment_count( array(
					'visible' => $this->instance['mate_data']['comments'],
					'html'    => '<span class="post__comments">%1$s<a href="%2$s" %3$s %4$s>%5$s%6$s</a></span>',
					'sufix'   => get_comments_number_text( esc_html__( 'No comment(s)', 'monstroid2' ), esc_html__( '1 comment', 'monstroid2' ), esc_html__( '% comments', 'monstroid2' ) ),
				) );

				$permalink   = $this->utility->attributes->get_post_permalink();
				$post_format = get_post_format( $post->ID ) ?: 'standard';
				$is_invert   = has_post_thumbnail( $post->ID ) ? 'has-thumbnail invert' : 'no-thumbnail invert';
				$visible_content  = ( $this->instance['title_length'] > 0
				                 || 'true' === $this->instance['mate_data']['date']
				                 || 'true' === $this->instance['mate_data']['comments']
				                 || 'true' === $this->instance['mate_data']['post_tag']
				                 || 'true' === $this->instance['mate_data']['category']
				                 || 'true' === $this->instance['mate_data']['author'] ) ? 'content-visible' : 'content-disable';

				switch ( $post_format ) {

					case 'video':
						$slide = $this->utility->media->get_video( array(
							'size'        => 'monstroid2-thumb-xl',
							'mobile_size' => 'monstroid2-thumb-l',
						) );
					break;

					default:
						$slide = $this->utility->media->get_image( array(
							'size'        => 'monstroid2-thumb-xl',
							'mobile_size' => 'monstroid2-thumb-l',
							'html'        => '<div class="playlist-img playlist--slide" style="background-image: url(\'%3$s\');"></div>',
						) );
					break;

				}

				include $slides_view_dir;
			}

			wp_reset_postdata();
		}

		/**
		 * Widget function.
		 *
		 * @see WP_Widget
		 *
		 * @since 1.0.0
		 * @param array $args
		 * @param array $instance
		 */
		public function widget( $args, $instance ) {

			if ( empty( $instance['terms_type'] ) ) {
				return;
			}

			$terms_type = $instance['terms_type'];

			if ( ! isset( $instance[ $terms_type ] ) || empty( $instance[ $terms_type ] ) ) {
				return;
			}

			if ( $this->get_cached_widget( $args ) ) {
				return;
			}

			ob_start();

			$this->instance = $instance;

			$this->setup_widget_data( $args, $instance );
			$this->widget_start( $args, $instance );

			$height             = $instance['height'];
			$width              = $instance['width'];
			$posts_per_page     = $instance['posts_per_page'];
			$slider_controls    = $instance['slider_controls'];
			$thumbnail_controls = $instance['thumbnail_controls'];

			if ( ! isset( $instance[ $terms_type ] ) || ! $instance[ $terms_type ] ) {
				return;
			}

			$layout_settings = isset( $this->layout_settings[ $args['id'] ] ) ? $this->layout_settings[ $args['id'] ] : $this->layout_settings[ 'default' ] ;
			$layout_settings['breakpoints']['991']['height'] = ( int ) $height * 0.75;
			$layout_settings['breakpoints']['767']['height'] = ( int ) $height * 0.5;
			$layout_settings['breakpoints']['543']['height'] = ( int ) $height * 0.5;

			$posts_per_page = ( '0' === $posts_per_page ) ? -1 : ( int ) $posts_per_page;
			$post_args      = array(
				'post_type'   => 'post',
				'numberposts' => $posts_per_page,
			);
			$post_args[ $terms_type ] = implode( ',', $instance[ $terms_type ] );

			$this->posts = get_posts( $post_args );

			if ( $this->posts ) {
				$slider_settings = array(
					'width'              => $width,
					'height'             => $height,
					'arrows'             => ( boolean ) $slider_controls,
					'buttons'            => apply_filters( 'monstroid2_playlist_buttons', false ),
					'thumbnailArrows'    => ( boolean ) $thumbnail_controls,
					'thumbnailsPosition' => $layout_settings['thumbnailsPosition'],
					'thumbnailWidth'     => $layout_settings['thumbnailWidth'],
					'thumbnailHeight'    => $layout_settings['thumbnailHeight'],
					'breakpoints'        => json_encode( $layout_settings['breakpoints'] ),
				);
				$slider_settings = json_encode( $slider_settings );

				$holder_view_dir = locate_template( 'inc/widgets/playlist-slider/views/playlist-holder-view.php', false, false );

				if ( $holder_view_dir ) {

					echo '<div class="playlist-slider slider-pro" data-settings=\'' . $slider_settings . '\'>';
						include $holder_view_dir;
					echo '</div>';
				}
			}

			$this->widget_end( $args );
			$this->reset_widget_data();

			echo $this->cache_widget( $args, ob_get_clean() );
		}

		/**
		 * Enqueue javascript and stylesheet.
		 *
		 * @since 1.0.0
		 */
		public function enqueue_assets() {
			if ( is_active_widget( false, false, $this->id_base, true ) ) {
				wp_enqueue_script( 'jquery-slider-pro' );
				wp_enqueue_style( 'jquery-slider-pro' );
			}
		}
	}
}

add_action( 'widgets_init', 'monstroid2_register_playlist_slider_widget' );
/**
 * Register playlist-slider widget.
 */
function monstroid2_register_playlist_slider_widget() {
	register_widget( 'Monstroid2_Playlist_Slider_Widget' );
}
