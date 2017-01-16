<?php

/**
 * TM WooCommerce Banners Grid Widget
 *
 * @author   TemplateMonster
 * @category Widgets
 * @version  1.0.0
 * @extends  WC_Widget
 */

if ( class_exists( 'WC_Widget' ) ) {

	class __TM_Banners_Grid_Widget extends WC_Widget {

		/**
		 * Constructor.
		 *
		 * @since 1.0.0
		 */
		public function __construct() {

			$this->widget_cssclass    = 'woocommerce __tm_banners_grid_widget';
			$this->widget_description = __( 'TM widget to create banners grid', 'tm-woocommerce-package' );
			$this->widget_id          = '__tm_banners_grid_widget';
			$this->widget_name        = __( 'TM Banners Grid Widget', 'tm-woocommerce-package' );

			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_assets' ) );
			add_action( 'wp_enqueue_scripts', array( $this, '__tm_banners_grid_widget_enqueue_files' ), 9 );

			parent::__construct();
		}

		/**
		 * Enqueue admin assets.
		 *
		 * @since  1.0.0
		 * @return void
		 */
		public function enqueue_admin_assets() {

			wp_enqueue_media();

			wp_enqueue_style( 'tm-banners-grid-admin' );
			wp_enqueue_script( 'tm-banners-grid-admin' );

			$banners_grids = $this->banners_grids();
			$col           = $this->col();

			$translation_array = array(
				'mediaFrameTitle' => __( 'Choose banner image', 'tm-woocommerce-package' ),
				'maxBanners'      => count ( $banners_grids ),
				'setLinkText'     => __( 'Set link', 'tm-woocommerce-package' ),
				'col'             => $col
			);

			wp_localize_script( 'tm-banners-grid-admin', 'bannerGridWidgetAdmin', $translation_array );
		}

		/**
		 * Get banner grids.
		 *
		 * @since  1.0.0
		 * @return array
		 */
		protected function banners_grids() {

			$banners_grids = array(
				array(
					array(
						array( 'w' => 12, 'h' => 1 )
					)
				),
				array(
					array(
						array( 'w' => 6, 'h' => 1 ),
						array( 'w' => 6, 'h' => 1 )
					),
					array(
						array( 'w' => 4, 'h' => 1 ),
						array( 'w' => 8, 'h' => 1 )
					),
					array(
						array( 'w' => 8, 'h' => 1 ),
						array( 'w' => 4, 'h' => 1 )
					)
				),
				array(
					array(
						array( 'w' => 4, 'h' => 1 ),
						array( 'w' => 4, 'h' => 1 ),
						array( 'w' => 4, 'h' => 1 )
					),
					array(
						array( 'w' => 6, 'h' => 1 ),
						array( 'w' => 3, 'h' => 1 ),
						array( 'w' => 3, 'h' => 1 )
					),
					array(
						array( 'w' => 8, 'h' => 2 ),
						array(
							'w' => 4,
							'h' => array( 1, 1 )
						)
					)
				),
				array(
					array(
						array( 'w' => 5, 'h' => 2 ),
						array(
							'w' => 7,
							'h' => array(
								1,
								array(
									array( 'w' => 6, 'h' => 1 ),
									array( 'w' => 6, 'h' => 1 )
								)
							)
						)
					),
					array(
						array( 'w' => 4, 'h' => 2 ),
						array(
							'w' => 4,
							'h' => array( 1, 1 )
						),
						array( 'w' => 4, 'h' => 2 )
					)
				),
				array(
					array(
						array(
							'w' => 4,
							'h' => array( 1, 1 )
						),
						array( 'w' => 4, 'h' => 2 ),
						array(
							'w' => 4,
							'h' => array( 1, 1 )
						)
					)
				),
				array(
					array(
						array(
							'w' => 4,
							'h' => array( 1, 1 )
						),
						array(
							'w' => 4,
							'h' => array( 1, 1 )
						),
						array(
							'w' => 4,
							'h' => array( 1, 1 )
						)
					)
				)
			);
			return apply_filters ( 'tm_banners_grid_widget_grids', $banners_grids );
		}

		/**
		 * Get banner columns html.
		 *
		 * @since  1.0.0
		 * @return string
		 */
		protected function col() {

			$col = '<div class="tm_banners_grid_widget_img_col">'
				 . '<div style="background-image: url(%s);">'
				 . '<span class="banner_remove">'
				 . '<span class="dashicons dashicons-dismiss"></span>'
				 . '</span>'
				 . '<span class="banner_link" title="' . __( 'Set text and link', 'tm-woocommerce-package' ) . '">'
				 . '<span class="dashicons dashicons-admin-generic"></span>'
				 . '</span>'
				 . '</div>'
				 . '</div>';

			return apply_filters ( 'tm_banners_grid_widget_col', $col );
		}

		/**
		 * Enqueue widget assets.
		 *
		 * @since  1.0.0
		 * @return void
		 */
		public function __tm_banners_grid_widget_enqueue_files() {

			if ( is_active_widget( false, false, $this->id_base, true ) ) {

				$include_bootstrap_grid = apply_filters( 'tm_woocommerce_include_bootstrap_grid', true );

				if ( $include_bootstrap_grid ) {

					wp_enqueue_style( 'bootstrap-grid' );
				}
				wp_enqueue_style( 'tm-banners-grid' );
			}
		}

		/**
		 * Outputs the settings update form.
		 *
		 * @since 1.0.0
		 * @see   WP_Widget->form
		 * @param array $instance
		 */
		public function form( $instance ) {

			$title         = !empty( $instance['title'] )         ? $instance['title']         : '';
			$banners       = !empty( $instance['banners'] )       ? $instance['banners']       : '';
			$banners_links = !empty( $instance['banners_links'] ) ? $instance['banners_links'] : '';

			if( '' !== $banners_links ) {

				$banners_links = json_decode( $banners_links, true );

				if( is_array( $banners_links ) && ! empty( $banners_links ) ) {

					$links = array();

					foreach ( $banners_links as $link ) {

						$links[] = base64_encode( $link );
					}
					$banners_links = implode( ',', $links );
				}
			}
			$banners_grid_val = !empty( $instance['banners_grid'] )  ? $instance['banners_grid']  : '';
			$links_targets    = !empty( $instance['links_targets'] ) ? $instance['links_targets'] : '';
			$titles           = !empty( $instance['titles'] )        ? $instance['titles']        : '';
			$texts            = !empty( $instance['texts'] )         ? $instance['texts']         : '';
			$language         = !empty( $instance['icl_language'] )  ? $instance['icl_language']         : 'multilingual';
			$banners_ids      = array();

			if ( '' !== $banners ) {

				$banners_ids = explode( ',', esc_attr( $banners ) );
			}
			$col           = $this->col();
			$banners_grids = $this->banners_grids();
			?>
			<p>
				<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
			</p>
			<div class="tm_banners_grid_widget_banners_thumbs" id="<?php echo esc_attr( $this->get_field_id( 'banners_thumbs' ) ); ?>">
				<div class="tm_banners_grid_widget_banners_thumbs_inner">
				<?php if ( !empty( $banners_ids ) ) {

					$html[] = '';

					foreach ( $banners_ids as $banner_id ) {

						$banner_src = wp_get_attachment_image_src( $banner_id, 'thumbnail' );

						if ( is_array( $banner_src ) ) {

							$html[] = sprintf( $col, $banner_src[0] );
						}
					}
					echo implode ( "\n", $html );
				} ?>
				</div>
				<div class="tm_banners_grid_widget_add_media" style="display: none;">
					<span>
						<span><?php printf ( __( 'Add banners<br>max: %s', 'tm-woocommerce-package' ), count ( $banners_grids ) ); ?></span>
					</span>
				</div>
			</div>
			<p></p>
			<input type="hidden" autocomplete="off" class="tm_banners_grid_widget_banners" id="<?php echo esc_attr( $this->get_field_id( 'banners' ) ); ?>" name="<?php echo $this->get_field_name( 'banners' ); ?>" value="<?php echo esc_attr( $banners ); ?>">
			<input type="hidden" autocomplete="off" class="tm_banners_grid_widget_banners_links" id="<?php echo esc_attr( $this->get_field_id( 'banners_links' ) ); ?>" name="<?php echo $this->get_field_name( 'banners_links' ); ?>" value="<?php echo esc_attr( $banners_links ); ?>">
			<input type="hidden" autocomplete="off" class="tm_banners_grid_widget_banners_links_targets" id="<?php echo esc_attr( $this->get_field_id( 'links_targets' ) ); ?>" name="<?php echo $this->get_field_name( 'links_targets' ); ?>" value="<?php echo esc_attr( $links_targets ); ?>">
			<input type="hidden" autocomplete="off" class="tm_banners_grid_widget_banners_titles" id="<?php echo esc_attr( $this->get_field_id( 'titles' ) ); ?>" name="<?php echo $this->get_field_name( 'titles' ); ?>" value="<?php echo esc_attr( $titles ); ?>">
			<input type="hidden" autocomplete="off" class="tm_banners_grid_widget_banners_texts" id="<?php echo esc_attr( $this->get_field_id( 'texts' ) ); ?>" name="<?php echo $this->get_field_name( 'texts' ); ?>" value="<?php echo esc_attr( $texts ); ?>">
			<div class="banner_link_wrapper">
				<label><?php _e( '<strong>Link:</strong> (if set, tag "a" not allowed in Content)', 'tm-woocommerce-package' ) ?></label>
				<input type="url" autocomplete="off" class="widefat tm_banners_grid_widget_banner_link">
				<p>
				<label><strong><?php _e( 'Target:', 'tm-woocommerce-package' ) ?></strong></label>
				<select class="widefat tm_banners_grid_widget_banner_link_target">
					<option value="0">self</option>
					<option value="1">blank</option>
				</select>
				</p>
				<p><label><strong><?php _e( 'Title:', 'tm-woocommrece-package' ); ?></strong></label>
				<input class="widefat tm_banners_grid_widget_banner_title" type="text"></p>
				<p><label><strong><?php _e( 'Content:', 'tm-woocommrece-package' ); ?></strong></label>
				<textarea class="widefat tm_banners_grid_widget_banner_text" rows="16" cols="20"></textarea></p>
				<input type="hidden" class="tm_banners_grid_widget_banner_id">
			</div>
			<div class="tm_banners_grid_widget_banners_grids" id="<?php echo esc_attr( $this->get_field_id( 'banners_grids' ) ); ?>">
			<?php
				foreach ( $banners_grids as $key => $banners_grid ) { ?>
				<div class="tm_banners_grid_widget_banners_grid tm_banners_grid_widget_banners_grid_<?php echo $key; ?>">
					<?php foreach ( $banners_grid as $k => $banner ) { ?>
					<input type="radio" autocomplete="off" name="<?php echo esc_attr( $this->get_field_name( 'banners_grid' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'banners_grid_' . $key . '_' . $k ) ); ?>" value='<?php echo json_encode( $banner ); ?>' <?php if( json_encode( $banner ) == $banners_grid_val ) echo 'checked'; ?>>
					<label for="<?php echo esc_attr( $this->get_field_id( 'banners_grid_' . $key . '_' . $k ) ); ?>">
						<?php echo $this->build_row( $banner ); ?>
					</label>
					<?php } ?>
				</div>
				<?php }
			?>
			</div>
			<?php if( function_exists( 'icl_widget_text_language_selectbox' ) ) {

				icl_widget_text_language_selectbox( $language, $this->get_field_name('icl_language') );
			} ?>
			<p></p>
			<?php
		}

		/**
		 * Update settings.
		 *
		 * @since  1.0.0
		 * @see    WP_Widget->update
		 * @param  array $instance
		 * @return array $instance
		 */
		public function update( $new_instance, $old_instance ) {

			$titles   = ! empty( $new_instance['titles'] ) ? explode( ',',$new_instance['titles'] ) : false;
			$instance = $new_instance;

			if ( isset( $titles ) && is_array( $titles ) ) {

				foreach ( $titles as $key => $title ) {

					$titles[$key] = base64_encode( sanitize_text_field( base64_decode( $title ) ) );
				}
				$instance['titles'] = implode( ',', $titles );
			}

			if ( isset( $instance['banners_links'] ) ) {

				$banners_links = explode(",", $instance ['banners_links'] );
				$links         = array();

				foreach ( $banners_links as $link ) {

					$links[] =  sanitize_text_field( base64_decode( $link ) );
				}
				$instance['banners_links'] = json_encode( $links );
			}
			$this->flush_widget_cache();

			return $instance;
		}

		/**
		 * Get banner html.
		 *
		 * @since  1.0.0
		 * @param  int $height banner height
		 * @param  bool|array $banners array of attachments ids
		 * @param  bool|array $links array of banners links
		 * @param  bool|array $targets array of banners targets
		 * @param  bool|array $titles array of banners titles
		 * @param  bool|array $texts array of banners texts
		 * @param  int $i counter
		 * @return string
		 */
		protected function build_banner( $height, $banners = false, $links = false, $targets = false, $titles = false, $texts = false, &$i = 0 ) {

			$banner[] = '<div class="tm_banners_grid_widget_banner tm_banners_grid_widget_banner_height_' . $height . '">';

			if ( !$banners ) {

				$banner[] = '<span>' . ( $i + 1 ) .'</span>' . __( 'Banner', 'tm-woocommerce-package' );
			} else {

				$banner_text[] = '';

				if ( ! empty( $links ) && array_key_exists( $i, $links ) && isset( $links[$i] ) && '' !== $links[$i] ) {

					$link = $links[$i];
				}
				if ( ! empty( $titles ) && isset( $titles[$i] ) && '' !== $titles[$i] ) {

					$title = apply_filters( 'tm_banners_grid_widget_banner_title', sprintf( '<h4 class="tm_banners_grid_widget_banner_title">%s</h4>', base64_decode( $titles[$i] ) ), base64_decode( $titles[$i] ) );
				}
				if ( ! empty( $texts ) && isset( $texts[$i] ) && '' !== $texts[$i] ) {

					$text = base64_decode( $texts[$i] );
					if ( isset( $link ) ) {
						$text = preg_replace( "/<\\/?a(\\s+.*?>|>)/", "", $text );
					}
				}
				if ( isset( $title ) || isset( $text ) ) {

					$banner_text[] = '<div class="tm_banners_grid_widget_banner_text">';
					$banner_text[] = '<div class="tm_banners_grid_widget_banner_text_inner">';

					if ( isset( $title ) ) {

						$banner_text[] = $title;
					}
					if ( isset( $text ) ) {

						$banner_text[] = '<div class="tm_banners_grid_widget_banner_content">';
						$banner_text[] = $text;
						$banner_text[] = '</div>';
					}
					$banner_text[] = '</div>';
					$banner_text[] = '</div>';
				}
				if ( isset( $link ) ) {

					$target   = ( !empty( $targets ) && array_key_exists( $i, $targets ) && isset( $targets[$i] ) && '' !== $targets[$i] && 0 !== (int) $targets[$i] ) ? ' target="_blank"' : '';
					$banner[] = '<a class="tm_banners_grid_widget_banner_link" href="' . $link . '"' . $target . '>';
					$banner[] = wp_get_attachment_image( $banners[$i], 'original' );
					$banner[] = implode( "\n", $banner_text );
					$banner[] = '</a>';

				} else {

					$banner[] = '<div class="tm_banners_grid_widget_banner_wrapper">';
					$banner[] = wp_get_attachment_image ( $banners[$i], 'original' );
					$banner[] = implode( "\n", $banner_text );
					$banner[] = '</div>';
				}
			}
			$banner[] = '</div>';

			$i++;

			return implode( "\n", $banner );
		}

		/**
		 * Get banners row.
		 *
		 * @since  1.0.0
		 * @param  array $arr banners array
		 * @param  bool|array $banners array of attachments ids
		 * @param  bool|array $links array of banners links
		 * @param  bool|array $targets array of banners targets
		 * @param  bool|array $titles array of banners titles
		 * @param  bool|array $texts array of banners texts
		 * @param  int $i counter
		 * @return string
		 */
		protected function build_row( $arr, $banners = false, $links = false, $targets = false, $titles = false, $texts = false, &$i = 0 ) {

			$block[] = '<div class="row">';

			foreach ( $arr as $col ) {

				$block[] = '<div class="col-xs-12 col-sm-' . $col['w'] . ' col-md-' . $col['w'] . ' col-lg-' . $col['w'] . ' col-xl-' . $col['w'] . '">';

				if( is_array ( $col['h'] ) ) {

					foreach ( $col['h'] as $row ) {

						if( is_array ( $row ) ) {

							$block[] = $this->build_row ( $row, $banners, $links, $targets, $titles, $texts, $i );
						} else {

							$block[] = $this->build_banner ( $row, $banners, $links, $targets, $titles, $texts, $i );
						}
					}
				} else {

					$block[] = $this->build_banner ( $col['h'], $banners, $links, $targets, $titles, $texts, $i );
				}
				$block[] = '</div>';
			}
			$block[] = '</div>';

			return implode ( "\n", $block );
		}

		/**
		 * Output widget.
		 *
		 * @since 1.0.0
		 * @see   WP_Widget
		 * @param array $args
		 * @param array $instance
		 */
		public function widget( $args, $instance ) {

			if ( isset( $instance['icl_language'] ) && defined( 'ICL_LANGUAGE_CODE' ) && $instance['icl_language'] != 'multilingual' && $instance['icl_language'] != ICL_LANGUAGE_CODE) {
				return;
			}

			$banners       = ! empty( $instance['banners'] )       ? explode( ',', $instance['banners'] )           : false;
			$banners_grid  = ! empty( $instance['banners_grid'] )  ? json_decode( $instance['banners_grid'], true ) : '';
			$banners_links = ! empty( $instance['banners_links'] ) ? $instance['banners_links']                     : false;

			$links = array();

			if( '' !== $banners_links ) {

				$links = json_decode( $banners_links, true );
			}
			$targets = ! empty( $instance['links_targets'] ) ? explode( ',', $instance['links_targets'] ) : false;
			$titles  = ! empty( $instance['titles'] )        ? explode( ',', $instance['titles'] )        : false;
			$texts   = ! empty( $instance['texts'] )         ? explode( ',', $instance['texts'] )         : false;

			if ( is_array( $banners ) ) {

				ob_start();

				$this->widget_start( $args, $instance );

				echo $this->build_row( $banners_grid, $banners, $links, $targets, $titles, $texts );

				$this->widget_end( $args );

				echo $this->cache_widget( $args, ob_get_clean() );
			}
		}
	}
} ?>
