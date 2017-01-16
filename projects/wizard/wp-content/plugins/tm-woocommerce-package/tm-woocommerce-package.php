<?php
/*
	Plugin Name: TM WooCommerce Package
	Version: 1.1.12
	Author: TemplateMonster
	Author URI: http://www.templatemonster.com/
*/

/*  This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation; either version 2 of the License, or
	(at your option) any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

if ( ! defined( 'ABSPATH' ) ) {

	header( 'HTTP/1.0 404 Not Found', true, 404 );

	exit;
}

class TM_WooCommerce {

	/**
	 * The single instance of the class.
	 *
	 * @var TM_WooCommerce
	 * @since 1.0.0
	 */
	protected static $_instance = null;

	/**
	 * Trigger checks is WooCoomerce active or not
	 *
	 * @since 1.0.0
	 * @var   bool
	 */
	public $has_woocommerce = null;

	/**
	 * Holder for plugin folder path
	 *
	 * @since 1.0.0
	 * @var   string
	 */
	public $plugin_dir = null;

	/**
	 * Holder for plugin scripts suffix
	 *
	 * @since 1.0.0
	 * @var   string
	 */
	public $suffix;

	/**
	 * Main TM_WooCommerce Instance.
	 *
	 * Ensures only one instance of TM_WooCommerce is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 * @static
	 * @see tm_wc()
	 * @return TM_WooCommerce - Main instance.
	 */
	public static function instance() {

		if ( is_null( self::$_instance ) ) {

			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * Sets up needed actions/filters for the theme to initialize.
	 *
	 * @since 1.1.6
	*/
	public function __construct() {

		if ( ! $this->has_woocommerce() || defined( 'TM_WOOCOMMERCE_VERISON' ) ) {

			add_action( 'admin_notices', array( $this, 'admin_notice_disabled_woocommerce' ) );

			return false;
		}
		define( 'TM_WOOCOMMERCE_VERISON', '1.1.12' );
		// Load admin assets.
		add_action( 'admin_enqueue_scripts', array( $this, 'register_admin_assets' ), 9 );

		// Load public assets.
		add_action( 'wp_enqueue_scripts', array( $this, 'register_assets' ), 9 );

		add_action( 'widgets_init', array( $this, 'register_widgets' ) );

		// Internationalize the text strings used.
		add_action( 'plugins_loaded', array( $this, 'lang' ), 1 );

		add_action( 'plugins_loaded', array( $this, 'init' ) );

		add_action( 'after_setup_theme', array( $this, 'include_template_functions' ) );

		add_filter( 'plugin_row_meta', array( $this, 'plugin_row_meta' ), 10, 2 );

		$this->set_suffix();
	}

	/**
	 * Sets scripts suffix.
	 *
	 * @since 1.0.0
	*/
	public function set_suffix() {

		$this->suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
	}

	/**
	 * Add notice in admin panel if WooCommerce plugin not installed.
	 *
	 * @since 1.1.0
	*/
	public function admin_notice_disabled_woocommerce() {

		if ( ! function_exists( 'get_plugins' ) ) {
			require_once ABSPATH . 'wp-admin/includes/plugin.php';
		}

		$details_link = self_admin_url( 'plugin-install.php?tab=plugin-information&amp;plugin=woocommerce&amp;TB_iframe=true&amp;width=600&amp;height=550' );
		?>
		<div class="notice notice-warning is-dismissible">
			<p><?php printf( __( 'TM WooCommerce Package is enabled but not effective. It requires %s in order to work. Please install and activate it.', 'tm-wc-compare-wishlist' ), '<a href="' . esc_url( $details_link ) . '" class="thickbox open-plugin-details-modal">' . __( 'WooCommerce', 'tm-wc-compare-wishlist' ) . '</a>' ); ?></p>
		</div>
		<?php
	}

	/**
	 * Loads the translation files.
	 *
	 * @since 1.0.0
	 */
	function lang() {

		load_plugin_textdomain( 'tm-woocommerce-package', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
	}

	/**
	 * Include core files.
	 *
	 * @since 1.1.2
	 */
	public function init() {
		include_once 'includes/tm-woocommerce-hooks.php';
	}

	/**
	 * Include core files.
	 *
	 * @since 1.1.2
	 */
	public function include_template_functions() {
		include_once 'includes/tm-woocommerce-functions.php';
	}


	/**
	 * Include widgets files and register widgets.
	 *
	 * @since 1.0.0
	 */
	public function register_widgets() {

		include_once 'includes/widgets/class-tm-products-carousel-widget.php';
		include_once 'includes/widgets/class-tm-products-smart-box-widget.php';
		include_once 'includes/widgets/class-tm-banners-grid-widget.php';
		include_once 'includes/widgets/class-tm-custom-menu-widget.php';
		include_once 'includes/widgets/class-tm-product-categories-widget.php';
		include_once 'includes/widgets/class-tm-about-store-widget.php';

		register_widget( '__TM_Products_Carousel_Widget' );
		register_widget( '__TM_Products_Smart_Box_Widget' );
		register_widget( '__TM_Banners_Grid_Widget' );
		register_widget( '__TM_Custom_Menu_Widget' );
		register_widget( '__TM_Product_Categories_Widget' );
		register_widget( '__TM_About_Store_Widget' );
	}

	/**
	 * Check if WooCommerce is active
	 *
	 * @since  1.0.0
	 * @return bool
	 */
	public function has_woocommerce() {

		if ( null == $this->has_woocommerce ) {

			$this->has_woocommerce = in_array(
				'woocommerce/woocommerce.php',
				apply_filters( 'active_plugins', get_option( 'active_plugins' ) )
			);
		}
		return $this->has_woocommerce;
	}

	/**
	 * Enqueue admin assets.
	 *
	 * @since 1.1.4
	 * @return void
	*/
	public function register_admin_assets() {

		// jQuery Validation
		wp_register_script( 'tm-wc-package-jquery-validation', '//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.1/jquery.validate.min.js', array( 'jquery' ), '1.15.1', true );
		wp_register_script( 'tm-wc-package-jquery-validation-additional', '//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.1/additional-methods.min.js', array( 'tm-wc-package-jquery-validation' ), '1.15.1', true );

		//Font Awesome

		//About Store Admin
		wp_register_style( 'tm-about-store-widget-admin', tm_wc()->plugin_url() . '/assets/css/tm-about-store-widget-admin.css', array( 'dashicons' ), TM_WOOCOMMERCE_VERISON, 'all' );
		wp_register_script( 'tm-about-store-widget-admin', tm_wc()->plugin_url() . '/assets/js/tm-about-store-widget-admin' . $this->suffix . '.js', array( 'jquery' ), TM_WOOCOMMERCE_VERISON, true );

		$translation_about_store = array(
			'mediaFrameTitle' => __( 'Choose background image', 'tm-woocommerce-package' ),
		);
		wp_localize_script( 'tm-about-store-widget-admin', 'aboutStoreWidgetAdmin', $translation_about_store );

		wp_register_style( 'bootstrap-grid-admin', tm_wc()->plugin_url() . '/assets/css/grid-admin.css', array(), TM_WOOCOMMERCE_VERISON, 'all' );

		//Banners Grid admin
		wp_register_style( 'tm-banners-grid-admin', tm_wc()->plugin_url() . '/assets/css/tm-banners-grid-widget-admin.css', array( 'wp-jquery-ui-dialog', 'bootstrap-grid-admin', 'dashicons' ), TM_WOOCOMMERCE_VERISON, 'all' );
		wp_register_script( 'tm-banners-grid-admin', tm_wc()->plugin_url() . '/assets/js/tm-banners-grid-widget-admin' . $this->suffix . '.js', array( 'jquery', 'jquery-ui-dialog', 'tm-wc-package-jquery-validation-additional' ), TM_WOOCOMMERCE_VERISON, true );

		//Banners Grid
		wp_register_style( 'tm-banners-grid', tm_wc()->plugin_url() . '/assets/css/tm-banners-grid-widget.css', array() );

		//Custom Menu admin
		wp_register_style( 'tm-custom-menu-widget-admin', tm_wc()->plugin_url() . '/assets/css/tm-custom-menu-widget-admin.css', array( 'dashicons' ) );
		wp_register_script( 'tm-custom-menu-widget-admin', tm_wc()->plugin_url() . '/assets/js/tm-custom-menu-widget-admin' . $this->suffix . '.js', array( 'jquery' ), TM_WOOCOMMERCE_VERISON, true );
		$translation_custom_menu = array(
			'mediaFrameTitle' => __( 'Choose background image', 'tm-woocommerce-package' )
		);
		wp_localize_script( 'tm-custom-menu-widget-admin', 'customMenuWidgetAdmin', $translation_custom_menu );
	}

	/**
	 * Enqueue assets.
	 *
	 * @since 1.1.4
	 * @return void
	*/
	public function register_assets() {

		// Swiper assets register
		wp_register_style( 'jquery-swiper', '//cdnjs.cloudflare.com/ajax/libs/Swiper/3.3.1/css/swiper.min.css', array(), '3.3.1', 'all' );
		wp_register_script( 'jquery-swiper', '//cdnjs.cloudflare.com/ajax/libs/Swiper/3.3.1/js/swiper.jquery.min.js', array( 'jquery' ), '3.3.1', true );

		// Material Tabs assets register
		wp_register_style( 'jquery-rd-material-tabs', tm_wc()->plugin_url() . '/assets/css/rd-material-tabs.css', array(), '1.0.0', 'all' );
		wp_register_script( 'jquery-rd-material-tabs', tm_wc()->plugin_url() . '/assets/js/jquery.rd-material-tabs' . $this->suffix . '.js', array( 'jquery' ), '1.0.2', true );

		// jQuery Countdown
		wp_register_script( 'jquery-countdown', '//cdnjs.cloudflare.com/ajax/libs/jquery.countdown/2.2.0/jquery.countdown.min.js', array( 'jquery' ), '2.2.0', true );

		// TM Products
		wp_register_style( 'tm-products-carousel-widget-styles', tm_wc()->plugin_url() . '/assets/css/tm-products-carousel-widget.css', array( 'jquery-swiper' ), TM_WOOCOMMERCE_VERISON, 'all' );
		wp_register_script( 'tm-products-carousel-widget-init', tm_wc()->plugin_url() . '/assets/js/tm-products-carousel-widget' . $this->suffix . '.js', array( 'jquery-swiper', 'jquery-countdown' ), TM_WOOCOMMERCE_VERISON, true );

		// TM Categories
		wp_register_script( 'tm-categories-carousel-widget-init', tm_wc()->plugin_url() . '/assets/js/tm-categories-carousel-widget' . $this->suffix . '.js', array( 'jquery-swiper' ), TM_WOOCOMMERCE_VERISON, true );

		// TM Custom Menu
		wp_register_style( 'tm-custom-menu-widget-styles', tm_wc()->plugin_url() . '/assets/css/tm-custom-menu-widget.css', array(), TM_WOOCOMMERCE_VERISON, 'all' );

		// TM Bootstrap Grid
		wp_register_style( 'bootstrap-grid', tm_wc()->plugin_url() . '/assets/css/grid.css', array() );
	}

	/**
	 * Get product terms.
	 *
	 * @since 1.1.5
	 * @var string $terms type of product terms
	 * @return array product terms
	*/
	public function tm_get_products_terms( $terms = 'product_cat' ) {

		include_once( plugin_dir_path( dirname( __FILE__ ) ) . 'woocommerce/includes/class-wc-post-types.php' );

		WC_Post_types::register_taxonomies();

		$product_terms     = get_terms( $terms );
		$tm_filter_by_term = array(
			'all' => __( 'All', 'tm-woocommerce-package' )
		);

		foreach ( $product_terms as $term ) {

			$tm_filter_by_term[ $term->term_taxonomy_id ] = $term->name;
		}
		return $tm_filter_by_term;
	}

	/**
	 * Widget form Multiselect.
	 *
	 * @since 1.0.0
	 * @var array $instance widget instance
	 * @var object $widget widget
	 */
	public function tm_widgets_form_multiselect( $instance, $widget ) {

		if ( empty( $widget->settings ) ) {

			return;
		}
		foreach ( $widget->settings as $key => $setting ) {

			$class = isset( $setting['class'] ) ? $setting['class'] : '';
			$value = isset( $instance[ $key ] ) ? $instance[ $key ] : $setting['std'];

			if ( empty( $setting['options'] ) && isset( $setting['options_cb'] ) ) {

				if ( 2 < count( $setting['options_cb'] ) ) {
					$setting['options'] = call_user_func(
						array( $setting['options_cb'][0], $setting['options_cb'][1] ),
						$setting['options_cb'][2]
					);
				} else {
					$setting['options'] = call_user_func( $setting['options_cb'] );
				}

			}

			switch ( $setting['type'] ) {

				case 'multiselect' :
					?>
					<p>
						<label for="<?php echo $widget->get_field_id( $key ); ?>"><?php echo $setting['label']; ?></label>
						<select multiple="multiple" class="widefat <?php echo esc_attr( $class ); ?>" id="<?php echo esc_attr( $widget->get_field_id( $key ) ); ?>" name="<?php echo $widget->get_field_name( $key ); ?>[]">
							<?php foreach ( $setting['options'] as $option_key => $option_value ) {
								if( is_array ( $value ) ) {
									$selected = in_array( $option_key, $value ) ? 'selected' : '';
								} else {
									$selected = selected( $option_key, $value );
								}
							?>
							<option value="<?php echo esc_attr( $option_key ); ?>" <?php echo $selected; ?>><?php echo esc_html( $option_value ); ?></option>
							<?php } ?>
						</select>
					</p>
					<?php
				break;
			}
		}
	}

	public function update_options( $instance ) {

		if( isset( $instance['tm_filter_by_category'] ) && ! isset( $instance['tm_filter_by_cat'] ) ) { //deprecated

			$instance['tm_filter_by_cat'] = str_replace( 'all-categories', 'all', $instance['tm_filter_by_category'] );

			unset( $instance['tm_filter_by_category'] );
		}
		if( isset( $instance['tm_filter_by_tag'] ) && 'all-tags' === $instance['tm_filter_by_tag'] ) { //deprecated

			$instance['tm_filter_by_tag'] = 'all';
		}
		return $instance;
	}

	/**
	 * Widget form button.
	 *
	 * @since 1.0.0
	 * @var array $instance widget instance
	 * @var object $widget widget
	 */
	public function tm_widgets_form_button( $instance, $widget ) {

		if ( empty( $widget->settings ) ) {

			return;
		}
		foreach ( $widget->settings as $key => $setting ) {

			$class = isset( $setting['class'] ) ? $setting['class'] : '';
			$value = isset( $instance[ $key ] ) ? $instance[ $key ] : $setting['std'];

			switch ( $setting['type'] ) {

				case 'button' :
					?>
					<p>
						<label for="<?php echo $widget->get_field_id( $key ); ?>"><?php echo $setting['label']; ?></label>
						<select multiple="multiple" class="widefat <?php echo esc_attr( $class ); ?>" id="<?php echo esc_attr( $widget->get_field_id( $key ) ); ?>" name="<?php echo $widget->get_field_name( $key ); ?>[]">
							<?php foreach ( $setting['options'] as $option_key => $option_value ) :
							if( is_array ( $value ) ) {
								$selected = in_array( $option_key, $value ) ? 'selected' : '';
							} else {
								$selected = selected( $option_key, $value );
							}
							 ?>
								<option value="<?php echo esc_attr( $option_key ); ?>" <?php echo $selected; ?>><?php echo esc_html( $option_value ); ?></option>
							<?php endforeach; ?>
						</select>
					</p>
					<?php
				break;
			}
		}
	}

	/**
	 * Add link to the documentation in admin panel.
	 *
	 * @since 1.1.5
	 */
	public function plugin_row_meta( $links, $file ) {

		if( 'tm-woocommerce-package/tm-woocommerce-package.php' === $file ) {

			$row_meta = array(
				'docs' => '<a target="_blank" href="' . esc_url( 'http://documentation.templatemonster.com/index.php?project=tm-woocommerce' ) . '" title="' . esc_attr( __( 'View TM WoooCommerce Package Documentation', 'tm-woocommerce-package' ) ) . '">' . __( 'Docs', 'tm-woocommerce-package' ) . '</a>',
			);
			return array_merge( $links, $row_meta );
		}
		return (array) $links;
	}

	/**
	 * Get the plugin url.
	 * @since 1.0.0
	 * @return string plugin url
	 */
	public function plugin_url() {

		return untrailingslashit( plugins_url( '/', __FILE__ ) );
	}

	/**
	 * Get the plugin path.
	 * @since 1.0.0
	 * @var string $path path to subfolder
	 * @return string plugin path
	 */
	public function plugin_dir( $path = null ) {

		if ( ! $this->plugin_dir ) {

			$this->plugin_dir = trailingslashit( plugin_dir_path( __FILE__ ) );
		}
		return $this->plugin_dir . $path;
	}
}

function tm_wc() {

	return TM_WooCommerce::instance();
}

tm_wc();
