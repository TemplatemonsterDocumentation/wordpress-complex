<?php
/**
 * Class Tm_Builder_Module_Icon.
 */
class Monstroid2_Builder_Module_Icon extends Tm_Builder_Module {

	public $function_name;

	public function init() {
		$this->name = esc_html__( 'Icon', 'monstroid2' );
		$this->icon = 'f1d8';
		$this->slug = 'tm_pb_icon';
		$this->main_css_element = '%%order_class%%.' . $this->slug;

		$this->whitelisted_fields = array(
			'font_icon',
			'icon_color',
			'use_circle',
			'circle_color',
			'circle_size',
			'use_circle_border',
			'circle_border_color',
			'circle_border_width',
			'animation',
			'icon_orientation',
			'admin_label',
			'module_id',
			'module_class',
			'use_icon_font_size',
			'icon_font_size',
			'circle_size_laptop',
			'circle_size_tablet',
			'circle_size_phone',
			'icon_font_size_laptop',
			'icon_font_size_tablet',
			'icon_font_size_phone',
		);

		$tm_accent_color    = tm_builder_accent_color();
		$tm_secondary_color = tm_builder_secondary_color();

		$this->fields_defaults = array(
			'icon_color'          => array( $tm_accent_color, 'add_default_setting' ),
			'use_circle'          => array( 'off' ),
			'circle_color'        => array( $tm_secondary_color, 'only_default_setting' ),
			'use_circle_border'   => array( 'off' ),
			'circle_border_color' => array( $tm_accent_color, 'only_default_setting' ),
			'animation'           => array( 'top' ),
			'icon_orientation'    => array( 'center' ),
			'use_icon_font_size'  => array( 'off' ),
			'icon_font_size'      => array( '50px' ),
		);

		$this->advanced_options = array(
			'custom_margin_padding' => array(
				'css' => array(
					'important' => 'all',
				),
			),
		);
	}

	public function get_fields() {

		$fields = array(
			'font_icon' => array(
				'label'               => esc_html__( 'Icon', 'monstroid2' ),
				'type'                => 'text',
				'option_category'     => 'basic_option',
				'class'               => array( 'tm-pb-font-icon' ),
				'renderer'            => 'tm_pb_get_font_icon_list',
				'renderer_with_field' => true,
				'description'         => esc_html__( 'Choose an icon to display.', 'monstroid2' ),
			),
			'icon_color' => array(
				'label'       => esc_html__( 'Icon Color', 'monstroid2' ),
				'type'        => 'color-alpha',
				'description' => esc_html__( 'Here you can define a custom color for your icon.', 'monstroid2' ),
			),
			'use_circle' => array(
				'label'           => esc_html__( 'Circle Icon', 'monstroid2' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'off' => esc_html__( 'No', 'monstroid2' ),
					'on'  => esc_html__( 'Yes', 'monstroid2' ),
				),
				'affects'         => array(
					'#tm_pb_use_circle_border',
					'#tm_pb_circle_color',
					'#tm_pb_circle_size',
				),
				'description'     => esc_html__( 'Here you can choose whether icon set above should display within a circle.', 'monstroid2' ),
			),
			'circle_color' => array(
				'label'       => esc_html__( 'Circle Color', 'monstroid2' ),
				'type'        => 'color-alpha',
				'description' => esc_html__( 'Here you can define a custom color for the icon circle.', 'monstroid2' ),
			),
			'use_circle_border' => array(
				'label'           => esc_html__( 'Show Circle Border', 'monstroid2' ),
				'type'            => 'yes_no_button',
				'option_category' => 'layout',
				'options'         => array(
					'off' => esc_html__( 'No', 'monstroid2' ),
					'on'  => esc_html__( 'Yes', 'monstroid2' ),
				),
				'affects'         => array(
					'#tm_pb_circle_border_color',
					'#tm_pb_circle_border_width',
				),
				'description'     => esc_html__( 'Here you can choose whether if the icon circle border should display.', 'monstroid2' ),
			),
			'circle_border_color' => array(
				'label'       => esc_html__( 'Circle Border Color', 'monstroid2' ),
				'type'        => 'color-alpha',
				'description' => esc_html__( 'Here you can define a custom color for the icon circle border.', 'monstroid2' ),
			),
			'animation' => array(
				'label'           => esc_html__( 'Icon Animation', 'monstroid2' ),
				'type'            => 'select',
				'option_category' => 'configuration',
				'options'         => array(
					'top'    => esc_html__( 'Top To Bottom', 'monstroid2' ),
					'left'   => esc_html__( 'Left To Right', 'monstroid2' ),
					'right'  => esc_html__( 'Right To Left', 'monstroid2' ),
					'bottom' => esc_html__( 'Bottom To Top', 'monstroid2' ),
					'off'    => esc_html__( 'No Animation', 'monstroid2' ),
				),
				'description'     => esc_html__( 'This controls the direction of the lazy-loading animation.', 'monstroid2' ),
			),
			'icon_orientation' => array(
				'label'           => esc_html__( 'Icon Orientation', 'monstroid2' ),
				'type'            => 'select',
				'option_category' => 'layout',
				'options'         => array(
					'left'   => esc_html__( 'Left', 'monstroid2' ),
					'right'  => esc_html__( 'Right', 'monstroid2' ),
					'center' => esc_html__( 'Center', 'monstroid2' ),
				),
				'description'     => esc_html__( 'This will control how your icon is aligned.', 'monstroid2' ),
			),
			'use_icon_font_size' => array(
				'label'           => esc_html__( 'Use Icon Font Size', 'monstroid2' ),
				'type'            => 'yes_no_button',
				'option_category' => 'font_option',
				'options'         => array(
					'off' => esc_html__( 'No', 'monstroid2' ),
					'on'  => esc_html__( 'Yes', 'monstroid2' ),
				),
				'affects'         => array(
					'#tm_pb_icon_font_size',
				),
				'tab_slug'        => 'advanced',
			),
			'icon_font_size' => array(
				'label'           => esc_html__( 'Icon Font Size', 'monstroid2' ),
				'type'            => 'range',
				'option_category' => 'font_option',
				'tab_slug'        => 'advanced',
				'default'         => '50px',
				'range_settings'  => array(
					'min'  => '1',
					'max'  => '120',
					'step' => '1',
				),
				'mobile_options'  => true,
				'depends_default' => true,
			),
			'circle_size' => array(
				'label'           => esc_html__( 'Circle Size', 'monstroid2' ),
				'type'            => 'range',
				'option_category' => 'layout',
				'tab_slug'        => 'advanced',
				'default'         => '100',
				'range_settings'  => array(
					'min'  => '40',
					'max'  => '260',
					'step' => '1',
				),
				'description'     => esc_html__( 'Here you can define a custom diameter for the icon circle.', 'monstroid2' ),
				'mobile_options'  => true,
				'depends_default' => true,
			),
			'circle_border_width' => array(
				'label'           => esc_html__( 'Circle Border Width', 'monstroid2' ),
				'type'            => 'range',
				'option_category' => 'layout',
				'tab_slug'        => 'advanced',
				'default'         => '2',
				'range_settings'  => array(
					'min'  => '1',
					'max'  => '20',
					'step' => '1',
				),
				'description'     => esc_html__( 'Here you can define a custom width for the icon circle border.', 'monstroid2' ),
				'depends_default' => true,
			),
			'circle_size_laptop' => array(
				'type' => 'skip',
			),
			'circle_size_tablet' => array(
				'type' => 'skip',
			),
			'circle_size_phone' => array(
				'type' => 'skip',
			),
			'icon_font_size_laptop' => array(
				'type' => 'skip',
			),
			'icon_font_size_tablet' => array(
				'type' => 'skip',
			),
			'icon_font_size_phone' => array(
				'type' => 'skip',
			),
			'disabled_on' => array(
				'label'           => esc_html__( 'Disable on', 'monstroid2' ),
				'type'            => 'multiple_checkboxes',
				'options'         => tm_pb_media_breakpoints(),
				'additional_att'  => 'disable_on',
				'option_category' => 'configuration',
				'description'     => esc_html__( 'This will disable the module on selected devices', 'monstroid2' ),
			),
			'admin_label' => array(
				'label'       => esc_html__( 'Admin Label', 'monstroid2' ),
				'type'        => 'text',
				'description' => esc_html__( 'This will change the label of the module in the builder for easy identification.', 'monstroid2' ),
			),
			'module_id' => array(
				'label'           => esc_html__( 'CSS ID', 'monstroid2' ),
				'type'            => 'text',
				'option_category' => 'configuration',
				'tab_slug'        => 'custom_css',
				'option_class'    => 'tm_pb_custom_css_regular',
			),
			'module_class' => array(
				'label'           => esc_html__( 'CSS Class', 'monstroid2' ),
				'type'            => 'text',
				'option_category' => 'configuration',
				'tab_slug'        => 'custom_css',
				'option_class'    => 'tm_pb_custom_css_regular',
			),
		);
		return $fields;
	}

	public function shortcode_callback( $atts, $content = null, $function_name ) {

		$this->set_vars(
			array(
				'icon_orientation',
				'animation',
				'font_icon',
				'use_circle',
				'use_circle_border',
				'icon_color',
				'circle_color',
				'circle_size',
				'circle_size_laptop',
				'circle_size_tablet',
				'circle_size_phone',
				'circle_border_color',
				'circle_border_width',
				'use_icon_font_size',
				'icon_font_size',
				'icon_font_size_laptop',
				'icon_font_size_tablet',
				'icon_font_size_phone',
			)
		);

		$this->function_name = $function_name;

		if ( 'off' !== $this->_var( 'use_icon_font_size' ) ) {
			$font_size_values = array(
				'desktop' => $this->_var( 'icon_font_size' ),
				'laptop'  => $this->_var( 'icon_font_size_laptop' ),
				'tablet'  => $this->_var( 'icon_font_size_tablet' ),
				'phone'   => $this->_var( 'icon_font_size_phone' ),
			);

			tm_pb_generate_responsive_css(
				$font_size_values,
				'%%order_class%% .tm-pb-icon',
				'font-size',
				$function_name
			);
		}

		if ( is_rtl() && 'left' === $this->_var( 'icon_orientation' ) ) {
			$this->_var( 'icon_orientation', 'right' );
		}

		$animation = $this->_var( 'animation' );

		if ( '' !== $this->_var( 'font_icon' ) ) {
			$icon_style = sprintf( 'color: %1$s;', esc_attr( $this->_var( 'icon_color' ) ) );

			if ( 'on' === $this->_var( 'use_circle' ) ) {
				$icon_style .= sprintf( ' background-color: %1$s;', esc_attr( $this->_var( 'circle_color' ) ) );

				if ( 'on' === $this->_var( 'use_circle_border' ) ) {
					$icon_style .= sprintf(
						' border-color: %1$s;',
						esc_attr( $this->_var( 'circle_border_color' ) )
					);
				}

				if ( '' !== $this->_var( 'circle_border_width' ) ) {
					$icon_style .= sprintf(
						' border-width: %1$spx;',
						esc_attr( $this->_var( 'circle_border_width' ) )
					);
				}

				$this->set_circle_size();
			}

			$icon        = esc_attr( tm_pb_process_font_icon( $this->_var( 'font_icon' ) ) );
			$icon_family = tm_builder_get_icon_family();

			if ( $icon_family ) {
				TM_Builder_Element::set_style( $function_name, array(
					'selector'    => '%%order_class%% .tm-pb-icon:before',
					'declaration' => sprintf(
						'font-family: "%1$s" !important;',
						esc_attr( $icon_family )
					),
				) );
			}

			$content = sprintf(
				'<span class="tm-pb-icon tm-waypoint%2$s%3$s%4$s" style="%5$s" data-icon="%1$s"></span>',
				$icon,
				esc_attr( ' tm_pb_animation_' . $animation ),
				( 'on' === $this->_var( 'use_circle' ) ? ' tm-pb-icon-circle' : '' ),
				( 'on' === $this->_var( 'use_circle' ) && 'on' === $this->_var( 'use_circle_border' ) ? ' tm-pb-icon-circle-border' : '' ),
				$icon_style
			);
		}

		$classes = array(
			'tm_pb_bg_layout_light',
			'tm_pb_icon_align_' . $this->_var( 'icon_orientation' )
		);

		$output = $this->wrap_module( $content, $classes, $function_name );

		return $output;
	}

	/**
	 * Set circle size values
	 */
	public function set_circle_size() {

		$circle_size_d  = intval( $this->_var( 'circle_size' ) );
		$circle_size_l  = intval( $this->_var( 'circle_size_laptop' ) );
		$circle_size_t  = intval( $this->_var( 'circle_size_tablet' ) );
		$circle_size_ph = intval( $this->_var( 'circle_size_phone' ) );

		if ( ! $circle_size_l ) {
			$circle_size_l = $circle_size_d;
		}

		if ( ! $circle_size_t ) {
			$circle_size_t = $circle_size_d;
		}

		if ( ! $circle_size_ph ) {
			$circle_size_ph = $circle_size_t;
		}

		if ( ! empty( $circle_size_d ) || ! empty( $circle_size_l ) || ! empty( $circle_size_t ) || ! empty( $circle_size_ph ) ) {

			$radius_d  = round( $circle_size_d / 2 );
			$radius_l  = round( $circle_size_l / 2 );
			$radius_t  = round( $circle_size_t / 2 );
			$radius_ph = round( $circle_size_ph / 2 );

			$sizes = array(
				'desktop' => $circle_size_d,
				'laptop'  => $circle_size_l,
				'tablet'  => $circle_size_t,
				'phone'   => $circle_size_ph,
			);

			$radius = array(
				'desktop' => $radius_d,
				'laptop'  => $radius_l,
				'tablet'  => $radius_t,
				'phone'   => $radius_ph,
			);

			tm_pb_generate_responsive_css( $sizes, '%%order_class%% .tm-pb-icon', 'width', $this->function_name );
			tm_pb_generate_responsive_css( $sizes, '%%order_class%% .tm-pb-icon', 'height', $this->function_name );
			tm_pb_generate_responsive_css( $sizes, '%%order_class%% .tm-pb-icon', 'line-height', $this->function_name );
			tm_pb_generate_responsive_css( $radius, '%%order_class%% .tm-pb-icon', 'border-radius', $this->function_name );
		}
	}
}

new Monstroid2_Builder_Module_Icon;
