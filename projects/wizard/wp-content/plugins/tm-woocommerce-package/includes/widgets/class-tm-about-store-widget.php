<?php

/**
 * TM About Store Widget
 *
 * @author   TemplateMonster
 * @category Widgets
 * @version  1.0.0
 * @extends  WP_Widget_Text
 */

if ( class_exists( 'WP_Widget_Text' ) ) {

	class __TM_About_Store_Widget extends WP_Widget_Text {

		/**
		 * Sets up a new TM About Store widget instance.
		 *
		 * @since 1.0.0
		 */
		public function __construct() {

			$widget_ops = array(
				'classname'   => 'tm_about_store_widget',
				'description' => __( 'Add Store descriprion', 'tm-woocommerce-package' )
			);

			$control_ops = array(
				'width'  => 400,
				'height' => 350
			);

			add_action( 'admin_enqueue_scripts' , array( $this, 'enqueue_admin_assets' ) );

			WP_Widget::__construct( 'tm_about_store_widget', __( 'TM About Store' ), $widget_ops, $control_ops );
		}

		/**
		 * Enqueue admin assets.
		 *
		 * @since 1.0.0
		 * @return void
		 */
		public function enqueue_admin_assets() {

			wp_enqueue_style( 'tm-about-store-widget-admin' );
			wp_enqueue_script( 'tm-about-store-widget-admin' );
		}

		/**
		 * Outputs the content for the current TM About Store widget instance.
		 *
		 * @since 1.1.4
		 * @param array $args
		 * @param array $instance
		 */
		public function widget( $args, $instance ) {

			$enable_button = isset( $instance['enable_button'] ) ? $instance['enable_button'] : 0;
			$button_url    = isset( $instance['button_url'] )    ? $instance['button_url']    : '';
			$button_text   = isset( $instance['button_text'] )   ? apply_filters('wpml_translate_single_string', $instance['button_text'], 'Widgets', 'TM About Store - button text' )          : '';
			$id            = ! empty( $instance['id'] )          ? $instance['id']            : '';
			$img           = '';

			if ( '' !== $id ) {

				$img = wp_get_attachment_image_src ( $id, 'original' );
			}
			$before_widget   = array();
			$before_widget['before_widget'] = $args['before_widget'];
			if ( is_array( $img ) ) {

				$before_widget['img_container'] = '<div class="tm_about_store_widget_bg" style="background-image: url(' . $img[0] . ');">';
			}
			$args['before_widget'] = implode( "\n", $before_widget );
			$after_widget = array();

			if ( $enable_button && '' !== $button_url && '' !== $button_text ) {
				$button_url = tm_woo_render_macros( $button_url );
				$after_widget['button'] = '<a href="' . esc_url( $button_url ) . '" class="button btn">' . $button_text . '</a>';
			}
			if ( is_array( $img ) ) {

				$after_widget['img_container'] = '</div>';
			}
			$after_widget['after_widget']       = $args['after_widget'];
			$args['after_widget'] = implode( "\n", $after_widget );

			$args = apply_filters( 'tm_about_store_widget_args', $args, $instance, $this, $before_widget, $after_widget );

			parent::widget( $args, $instance );
		}

		/**
		 * Handles updating settings for the current TM About Store widget instance.
		 *
		 * @since 1.0.0
		 * @param array $new_instance
		 * @param array $old_instance
		 * @return array
		 */
		public function update( $new_instance, $old_instance ) {

			$instance                  = parent::update( $new_instance, $old_instance );
			$instance['enable_button'] = !empty( $new_instance['enable_button'] );
			$instance['button_url']    = !empty( $new_instance['button_url'] )  ? esc_attr( $new_instance['button_url'] )  : '';
			$instance['button_text']   = !empty( $new_instance['button_text'] ) ? esc_attr( $new_instance['button_text'] ) : '';
			$instance['id']            = !empty( $new_instance['id'] )          ? ( int ) $new_instance['id'] : 0;

			//WMPL
			/**
			 * register strings for translation
			 */
			do_action( 'wpml_register_single_string', 'Widgets', 'TM About Store - button text', $instance['button_text'] );
			//WMPL

			return $instance;
		}

		/**
		 * Outputs the TM About Store widget settings form.
		 *
		 * @since 1.0.0
		 * @param array $instance Current settings.
		 */
		public function form( $instance ) {

			parent::form( $instance );

			$id  = !empty( $instance['id'] ) ? $instance['id'] : '';
			$img = '';

			if ( '' !== $id ) {

				$img = wp_get_attachment_image_src ( $id, 'thumbnail' );
			}
			$enable_button = isset( $instance['enable_button'] ) ? $instance['enable_button']                      : 0;
			$button_url    = isset( $instance['button_url'] )    ? $instance['button_url']                         : '';
			$button_text   = isset( $instance['button_text'] )   ? sanitize_text_field( $instance['button_text'] ) : '';
			?>
			<div class="tm-about-store-widget-form-controls">
				<div class="tm_about_store_widget_img"<?php if ( '' === $id ) { ?> style="display: none;"<?php } ?>>
					<div<?php if ( '' !== $id && is_array( $img ) ) echo ' style="background-image: url(' . $img[0] . ');"'; ?>>
						<span class="banner_remove">
							<span class="dashicons dashicons-dismiss"></span>
						</span>
					</div>
				</div>
				<div class="tm_about_store_widget_add_media"<?php if ( '' !== $id ) { ?> style="display: none;"<?php } ?>>
					<span>
						<span><?php _e( 'Choose background image', 'tm-woocommerce-package' ); ?></span>
					</span>
				</div>
				<input autocomplete="off" class="tm_about_store_widget_id" type="hidden" id="<?php echo esc_attr( $this->get_field_id( 'id' ) ); ?>" name="<?php echo $this->get_field_name( 'id' ); ?>" value="<?php echo esc_attr( $id ); ?>">
			</div>
			<p>
				<input id="<?php echo $this->get_field_id( 'enable_button' ); ?>" name="<?php echo $this->get_field_name( 'enable_button' ); ?>" type="checkbox"<?php checked( $enable_button ); ?> />&nbsp;<label for="<?php echo $this->get_field_id( 'enable_button' ); ?>"><?php _e( 'Enable Button', 'tm-woocommerce-package' ); ?></label>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'button_url' ); ?>"><?php _e( 'Button Url:', 'tm-woocommerce-package' ); ?></label>
				<input class="widefat tm_about_store_widget_link" id="<?php echo $this->get_field_id( 'button_url' ); ?>" name="<?php echo $this->get_field_name( 'button_url' ); ?>" type="url" value="<?php echo esc_attr( $button_url ); ?>">
				<br>
				<small><?php
					esc_html_e( 'Use %home_url% macros to paste your websiite URL', 'tm-woocommerce-package' );
				?></small>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'button_text' ); ?>"><?php _e( 'Button Text:', 'tm-woocommerce-package' ); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id( 'button_text' ); ?>" name="<?php echo $this->get_field_name( 'button_text' ); ?>" type="text" value="<?php echo esc_attr( $button_text ); ?>">
			</p>
			<?php
		}
	}
}
