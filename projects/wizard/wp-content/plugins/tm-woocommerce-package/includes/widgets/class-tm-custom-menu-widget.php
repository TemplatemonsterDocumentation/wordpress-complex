<?php

/**
 * TM Custom Menu with Background
 *
 * @author   TemplateMonster
 * @category Widgets
 * @version  1.0.0
 * @extends  WP_Nav_Menu_Widget
 */

if ( class_exists( 'WP_Nav_Menu_Widget' ) ) {

	class __TM_Custom_Menu_Widget extends WP_Nav_Menu_Widget {

		/**
		 * Sets up a new Custom Menu widget instance.
		 *
		 * @since 1.0.0
		 */
		public function __construct() {

			$widget_ops = array(
				'description' => __( 'Add a custom menu with background.', 'tm-woocommerce-package' )
			);

			add_action( 'admin_enqueue_scripts' , array( $this, 'enqueue_admin_assets' ) );

			WP_Widget::__construct( '__tm_custom_menu_widget', __( 'TM Custom Menu with Background', 'tm-woocommerce-package' ), $widget_ops );
		}

		/**
		 * Enqueue admin assets.
		 *
		 * @since 1.0.0
		 * @return void
		 */
		public function enqueue_admin_assets() {

			wp_enqueue_style( 'tm-custom-menu-widget-admin' );
			wp_enqueue_script( 'tm-custom-menu-widget-admin' );
		}

		/**
		 * Outputs the content for the current TM Custom Menu widget instance.
		 *
		 * @since 1.0.0
		 * @param array $args
		 * @param array $instance
		 */
		public function widget( $args, $instance ) {

			wp_enqueue_style( 'tm-custom-menu-widget-styles' );

			$id    = ! empty( $instance['id'] )  ? $instance['id']    : '';
			$class = isset( $instance['class'] ) ? $instance['class'] : '';
			$img = '';

			if ( '' !== $id ) {

				$img = wp_get_attachment_image_src ( $id, 'original' );
			}
			$style = '';

			if ( is_array ( $img ) ) {

				$style = ' style="background-image: url(' . $img[0] . ')"';
			}
			$args['before_widget'] .= '<div class="tm_custom_menu_widget ' . $class . '"' . $style . '>';
			$args['after_widget']   = '</div>' . $args['after_widget'];

			parent::widget( $args, $instance ); ?>

		<?php }

		/**
		 * Outputs the settings form for the Custom Menu widget.
		 *
		 * @since 1.0.0
		 * @param array $instance
		 */
		public function form( $instance ) {

			parent::form( $instance );

			$menus = wp_get_nav_menus();

			if ( ! empty( $menus ) ) {

				$id    = ! empty( $instance['id'] )  ? $instance['id']    : '';
				$class = isset( $instance['class'] ) ? $instance['class'] : '';
				$img   = '';

				if ( '' !== $id ) {

					$img = wp_get_attachment_image_src ( $id, 'thumbnail' );
				}
			 ?>
			<div class="tm-custom-menu-widget-form-controls">
				<div class="tm_custom_menu_widget_img"<?php if ( '' === $id ) { ?> style="display: none;"<?php } ?>>
					<div<?php if ( '' !== $id && is_array ( $img ) ) echo ' style="background-image: url(' . $img[0] . ');"'; ?>>
						<span class="banner_remove">
							<span class="dashicons dashicons-dismiss"></span>
						</span>
					</div>
				</div>
				<div class="tm_custom_menu_widget_add_media"<?php if ( '' !== $id ) { ?> style="display: none;"<?php } ?>>
					<span>
						<span><?php _e( 'Choose background image', 'tm-woocommerce-package' ); ?></span>
					</span>
				</div>
				<input class="tm_custom_menu_widget_id" type="hidden" id="<?php echo esc_attr( $this->get_field_id( 'id' ) ); ?>" name="<?php echo $this->get_field_name( 'id' ); ?>" value="<?php echo esc_attr( $id ); ?>">
			</div>
			<p>
				<label for="<?php echo $this->get_field_id( 'class' ); ?>"><?php _e( 'Custom class:' ) ?></label>
				<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'class' ); ?>" name="<?php echo $this->get_field_name( 'class' ); ?>" value="<?php echo esc_attr( $class ); ?>"/>
			</p>
		<?php }
		}

		/**
		 * Handles updating settings for the current TM Custom Menu widget instance.
		 *
		 * @since 1.0.0
		 *
		 * @param array $new_instance
		 * @param array $old_instance
		 * @return array
		 */
		public function update( $new_instance, $old_instance ) {

			$instance = parent::update( $new_instance, $old_instance );

			if ( ! empty( $new_instance['id'] ) ) {

				$instance['id'] = (int) $new_instance['id'];
			}
			if ( isset( $new_instance['class'] ) ) {

				$instance['class'] = sanitize_text_field( $new_instance['class'] );
			}
			return $instance;
		}
	}
}

?>