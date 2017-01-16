<?php
class Tm_Builder_Cherry_RE_Property_List extends Tm_Builder_Module {

	function init() {
		$this->name             = esc_html__( 'Cherry RE Property List', 'tm-builder-integrator' );
		$this->icon             = 'f00b';
		$this->slug             = 'tm_pb_cherry_re_property_list';
		$this->main_css_element = '%%order_class%%.' . $this->slug;

		$this->whitelisted_fields = array(
			'number',
			'order',
			'orderby',
			'show_title',
			'show_image',
			'image_size',
			'show_status',
			'show_area',
			'show_bedrooms',
			'show_bathrooms',
			'show_price',
			'show_location',
			'show_excerpt',
			'excerpt_length',
			'show_more_button',
			'more_button_text',
			'template',
			'module_id',
			'module_class',
		);

		$this->fields_defaults = array(
			'number'           => array( '5' ),
			'order'            => array( 'desc' ),
			'orderby'          => array( 'date' ),
			'show_title'       => array( 'on' ),
			'show_image'       => array( 'on' ),
			'image_size'       => array( 'thumbnail' ),
			'show_excerpt'     => array( 'on' ),
			'excerpt_length'   => array( '15' ),
			'show_status'      => array( 'on' ),
			'show_area'        => array( 'on' ),
			'show_bedrooms'    => array( 'on' ),
			'show_bathrooms'   => array( 'on' ),
			'show_price'       => array( 'on' ),
			'show_location'    => array( 'on' ),
			'show_more_button' => array( 'on' ),
			'more_button_text' => array( esc_html__( 'read more', 'tm-builder-integrator' ) ),
			'template'         => array( 'default.tmpl' ),
		);
	}

	function get_fields() {
		$image_sizes = get_intermediate_image_sizes();

		$fields = array(
			'number' => array(
				'label'           => esc_html__( 'How Many?', 'tm-builder-integrator' ),
				'option_category' => 'basic_option',
				'type'            => 'range',
				'range_settings'  => array(
					'min'  => -1,
					'max'  => 100,
					'step' => 1,
				),
				'default' => '5',
			),
			'orderby' => array(
				'label'           => esc_html__( 'Order by', 'tm-builder-integrator' ),
				'type'            => 'select',
				'option_category' => 'configuration',
				'options'         => array(
					'date'       => esc_html__( 'Date', 'tm-builder-integrator' ),
					'id'         => esc_html__( 'Property ID', 'tm-builder-integrator' ),
					'author'     => esc_html__( 'Property author', 'tm-builder-integrator' ),
					'title'      => esc_html__( 'Property title', 'tm-builder-integrator' ),
					'name'       => esc_html__( 'Property slug', 'tm-builder-integrator' ),
					'modified'   => esc_html__( 'Last modified date', 'tm-builder-integrator' ),
					'parent'     => esc_html__( 'Property parent', 'tm-builder-integrator' ),
					'rand'       => esc_html__( 'Random', 'tm-builder-integrator' ),
					'menu_order' => esc_html__( 'Menu order', 'tm-builder-integrator' ),
				),
				'default' => 'date',
			),
			'order' => array(
				'label'           => esc_html__( 'Order', 'tm-builder-integrator' ),
				'type'            => 'select',
				'option_category' => 'basic_option',
				'options'         => array(
					'desc' => esc_html__( 'Descending', 'tm-builder-integrator' ),
					'asc'  => esc_html__( 'Ascending', 'tm-builder-integrator' ),
				),
				'default' => 'desc',
			),
			'show_title' => array(
				'label'           => esc_html__( 'Show Title', 'tm-builder-integrator' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'tm-builder-integrator' ),
					'off' => esc_html__( 'No', 'tm-builder-integrator' ),
				),
			),
			'show_image' => array(
				'label'           => esc_html__( 'Show Image', 'tm-builder-integrator' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'tm-builder-integrator' ),
					'off' => esc_html__( 'No', 'tm-builder-integrator' ),
				),
				'affects' => array(
					'#tm_pb_image_size',
				),
			),
			'image_size' => array(
				'label'           => esc_html__( 'Photo Size', 'tm-builder-integrator' ),
				'description'     => esc_html__( 'Select photo size.', 'tm-builder-integrator' ),
				'type'            => 'select',
				'options'         => array_combine( $image_sizes, $image_sizes ),
				'default'         => 'thumbnail',
				'depends_show_if' => 'on',
			),
			'show_status' => array(
				'label'           => esc_html__( 'Show Status', 'tm-builder-integrator' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'tm-builder-integrator' ),
					'off' => esc_html__( 'No', 'tm-builder-integrator' ),
				),
			),
			'show_area' => array(
				'label'           => esc_html__( 'Show Area', 'tm-builder-integrator' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'tm-builder-integrator' ),
					'off' => esc_html__( 'No', 'tm-builder-integrator' ),
				),
			),
			'show_bedrooms' => array(
				'label'           => esc_html__( 'Show Bedrooms', 'tm-builder-integrator' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'tm-builder-integrator' ),
					'off' => esc_html__( 'No', 'tm-builder-integrator' ),
				),
			),
			'show_bathrooms' => array(
				'label'           => esc_html__( 'Show Bathrooms', 'tm-builder-integrator' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'tm-builder-integrator' ),
					'off' => esc_html__( 'No', 'tm-builder-integrator' ),
				),
			),
			'show_price' => array(
				'label'           => esc_html__( 'Show Price', 'tm-builder-integrator' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'tm-builder-integrator' ),
					'off' => esc_html__( 'No', 'tm-builder-integrator' ),
				),
			),
			'show_location' => array(
				'label'           => esc_html__( 'Show Location', 'tm-builder-integrator' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'tm-builder-integrator' ),
					'off' => esc_html__( 'No', 'tm-builder-integrator' ),
				),
			),
			'show_excerpt' => array(
				'label'           => esc_html__( 'Show Excerpt', 'tm-builder-integrator' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'tm-builder-integrator' ),
					'off' => esc_html__( 'No', 'tm-builder-integrator' ),
				),
				'affects' => array(
					'#tm_pb_excerpt_length',
				),
			),
			'excerpt_length' => array(
				'label'           => esc_html__( 'Excerpt Length', 'tm-builder-integrator' ),
				'description'     => esc_html__( 'Auto-generated excerpt length (in words)', 'tm-builder-integrator' ),
				'type'            => 'range',
				'range_settings'  => array(
					'min'  => 0,
					'max'  => 100,
					'step' => 1,
				),
				'default'         => '15',
				'depends_show_if' => 'on',
			),
			'show_more_button' => array(
				'label'           => esc_html__( 'Show More Button', 'tm-builder-integrator' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'tm-builder-integrator' ),
					'off' => esc_html__( 'No', 'tm-builder-integrator' ),
				),
				'affects' => array(
					'#tm_pb_more_button_text',
				),
			),
			'more_button_text' => array(
				'label'           => esc_html__( 'More Button Text', 'tm-builder-integrator' ),
				'type'            => 'text',
				'default'         => esc_html__( 'read more', 'tm-builder-integrator' ),
				'depends_show_if' => 'on',
			),
			'template' => array(
				'label'           => esc_html__( 'Template', 'tm-builder-integrator' ),
				'description'     => esc_html__( 'Choose template file (*.tmpl)', 'tm-builder-integrator' ),
				'type'            => 'select',
				'option_category' => 'configuration',
				'options'         => $this->_prepare_template_select(),
			),
			'admin_label' => array(
				'label'       => esc_html__( 'Admin Label', 'tm-builder-integrator' ),
				'description' => esc_html__( 'This will change the label of the module in the builder for easy identification.', 'tm-builder-integrator' ),
				'type'        => 'text',
			),
			'module_id' => array(
				'label'           => esc_html__( 'CSS ID', 'tm-builder-integrator' ),
				'type'            => 'text',
				'option_category' => 'configuration',
				'tab_slug'        => 'custom_css',
				'option_class'    => 'tm_pb_custom_css_regular',
			),
			'module_class' => array(
				'label'           => esc_html__( 'CSS Class', 'tm-builder-integrator' ),
				'type'            => 'text',
				'option_category' => 'configuration',
				'tab_slug'        => 'custom_css',
				'option_class'    => 'tm_pb_custom_css_regular',
			),
		);

		return $fields;
	}

	function shortcode_callback( $atts, $content = null, $function_name ) {
		$this->set_vars(
			array(
				'number',
				'order',
				'orderby',
				'show_title',
				'show_image',
				'image_size',
				'show_excerpt',
				'excerpt_length',
				'show_status',
				'show_area',
				'show_bedrooms',
				'show_bathrooms',
				'show_bathrooms',
				'show_price',
				'show_location',
				'show_more_button',
				'more_button_text',
				'template',
			)
		);

		$callback = power_builder_integrator()->get_shortcode_cb( 'cherry-real-estate', 'tm_re_property_list' );

		if ( ! is_callable( $callback ) ) {
			return;
		}

		$content = call_user_func( $callback, array(
			'number'           => $this->_var( 'number' ),
			'order'            => $this->_var( 'order' ),
			'orderby'          => $this->_var( 'orderby' ),
			'show_title'       => $this->_var( 'show_title' ),
			'show_image'       => $this->_var( 'show_image' ),
			'image_size'       => $this->_var( 'image_size' ),
			'show_excerpt'     => $this->_var( 'show_excerpt' ),
			'excerpt_length'   => $this->_var( 'excerpt_length' ),
			'show_status'      => $this->_var( 'show_status' ),
			'show_area'        => $this->_var( 'show_area' ),
			'show_bedrooms'    => $this->_var( 'show_bedrooms' ),
			'show_bathrooms'   => $this->_var( 'show_bathrooms' ),
			'show_price'       => $this->_var( 'show_price' ),
			'show_location'    => $this->_var( 'show_location' ),
			'show_more_button' => $this->_var( 'show_more_button' ),
			'more_button_text' => $this->_var( 'more_button_text' ),
			'template'         => $this->_var( 'template' ),
		) );

		$output = $this->wrap_clean( $content, array(), $function_name );

		return $output;
	}

	function _prepare_template_select() {

		if ( ! function_exists( 'cherry_re_templater' ) ) {
			return array();
		}

		return cherry_re_templater()->get_property_templates_list();
	}
}

new Tm_Builder_Cherry_RE_Property_List;
