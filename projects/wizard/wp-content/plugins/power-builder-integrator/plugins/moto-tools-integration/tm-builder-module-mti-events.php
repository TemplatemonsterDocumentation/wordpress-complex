<?php
class Tm_Builder_Events_Team_Integrator extends Tm_Builder_Module {

	function init() {

		$this->name = esc_html__( 'MP Events', 'tm-builder-integrator' );
		$this->icon = 'f017';
		$this->slug = 'tm_pb_mti_events';
		$this->main_css_element = '%%order_class%%.' . $this->slug;

		$this->whitelisted_fields = array(
			'per_page',
			'columns_number',
			'order',
			'show_title',
			'show_participants',
			'show_schedule',
			'excerpt_length',
		);

		$this->fields_defaults = array(
			'per_page'          => array( '3' ),
			'columns_number'    => array( '3' ),
			'order'             => array( 'DESC' ),
			'show_title'        => array( 'on' ),
			'show_participants' => array( 'on' ),
			'show_schedule'     => array( 'on' ),
			'excerpt_length'    => array( '25' )
		);
	}

	function get_fields() {

		$fields = array(
			'per_page' => array(
				'label'           => esc_html__( 'Events count ( Set -1 to show all )', 'tm_builder' ),
				'option_category' => 'basic_option',
				'type'            => 'range',
				'range_settings'  => array(
					'min'  => -1,
					'max'  => 30,
					'step' => 1,
				),
				'default' => '3',
			),
			'columns_number' => array(
				'label'           => esc_html__( 'Columns number', 'tm_builder' ),
				'option_category' => 'basic_option',
				'type'            => 'range',
				'range_settings'  => array(
					'min'  => 1,
					'max'  => 4,
					'step' => 1,
				),
				'default' => '3',
			),
			'order' => array(
				'label'           => esc_html__( 'Order', 'tm_builder' ),
				'description'     => esc_html__( 'Events order.', 'tm_builder' ),
				'type'            => 'select',
				'option_category' => 'configuration',
				'options'         => array(
					'desc' => esc_html__( 'Descending', 'tm_builder' ),
					'asc'  => esc_html__( 'Ascending', 'tm_builder' ),
				),
			),
			'show_title' => array(
				'label'           => esc_html__( 'Show Title', 'tm-builder-integrator' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'tm-builder-integrator' ),
					'off' => esc_html__( 'No', 'tm-builder-integrator' ),
				),
				'affects' => array(
					'#tm_pb_size',
				),
			),
			'excerpt_length' => array(
				'label'           => esc_html__( 'Excerpt words length', 'tm_builder' ),
				'description'     => esc_html__( 'Set 0 to hide excerpt.', 'tm_builder' ),
				'option_category' => 'configuration',
				'type'            => 'range',
				'range_settings'  => array(
					'min'  => 0,
					'max'  => 100,
					'step' => 1,
				),
				'default' => '25',
			),
			'show_participants' => array(
				'label'           => esc_html__( 'Show Participants', 'tm-builder-integrator' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'tm-builder-integrator' ),
					'off' => esc_html__( 'No', 'tm-builder-integrator' ),
				),
				'affects' => array(
					'#tm_pb_size',
				),
			),
			'show_schedule' => array(
				'label'           => esc_html__( 'Show Schedule', 'tm-builder-integrator' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'tm-builder-integrator' ),
					'off' => esc_html__( 'No', 'tm-builder-integrator' ),
				),
				'affects' => array(
					'#tm_pb_size',
				),
			),
		);
		return $fields;
	}

	function shortcode_callback( $atts, $content = null, $function_name ) {

		$this->set_vars(
			array(
				'per_page',
				'columns_number',
				'order',
				'show_title',
				'show_participants',
				'show_schedule',
				'excerpt_length',
			)
		);

		$callback = power_builder_integrator()->get_shortcode_cb( 'moto-tools-integration', 'mti_events' );

		if ( ! is_callable( $callback ) ) {
			return;
		}

		$content = call_user_func(
			$callback,
			array(
				'per_page'          => $this->_var( 'per_page' ),
				'columns_number'    => $this->_var( 'columns_number' ),
				'order'             => $this->_var( 'order' ),
				'show_title'        => $this->_var( 'show_title' ),
				'show_participants' => $this->_var( 'show_participants' ),
				'show_schedule'     => $this->_var( 'show_schedule' ),
				'excerpt_length'    => $this->_var( 'excerpt_length' ),
			)
		);

		$output = $this->wrap_clean( $content, array(), $function_name );

		return $output;
	}
}

new Tm_Builder_Events_Team_Integrator;
