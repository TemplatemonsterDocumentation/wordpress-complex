<?php
class Tm_Builder_Cherry_RE_Agents_List extends Tm_Builder_Module {

	function init() {
		$this->name             = esc_html__( 'Cherry RE Agents List', 'tm-builder-integrator' );
		$this->icon             = 'f21b';
		$this->slug             = 'tm_pb_cherry_re_agent_list';
		$this->main_css_element = '%%order_class%%.' . $this->slug;

		$this->whitelisted_fields = array(
			'number',
			'order',
			'orderby',
			'show_name',
			'show_photo',
			'photo_size',
			'show_desc',
			'desc_length',
			'show_contacts',
			'show_socials',
			'show_more_button',
			'more_button_text',
			'template',
			'module_id',
			'module_class',
		);

		$this->fields_defaults = array(
			'number'           => array( '10' ),
			'order'            => array( 'desc' ),
			'orderby'          => array( 'display_name' ),
			'show_name'        => array( 'on' ),
			'show_photo'       => array( 'on' ),
			'photo_size'       => array( 'thumbnail' ),
			'show_desc'        => array( 'on' ),
			'desc_length'      => array( '10' ),
			'show_contacts'    => array( 'on' ),
			'show_socials'     => array( 'on' ),
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
				'default' => '10',
			),
			'orderby' => array(
				'label'           => esc_html__( 'Order by', 'tm-builder-integrator' ),
				'type'            => 'select',
				'option_category' => 'configuration',
				'options'         => array(
					'display_name' => esc_html__( 'Display name', 'tm-builder-integrator' ),
					'id'           => esc_html__( 'ID', 'tm-builder-integrator' ),
					'name'         => esc_html__( 'Name', 'tm-builder-integrator' ),
					'login'        => esc_html__( 'Login', 'tm-builder-integrator' ),
					'registered'   => esc_html__( 'Registered date', 'tm-builder-integrator' ),
					'post_count'   => esc_html__( 'Post count', 'tm-builder-integrator' ),
				),
				'default' => 'display_name',
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
			'show_photo' => array(
				'label'           => esc_html__( 'Show Photo', 'tm-builder-integrator' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'tm-builder-integrator' ),
					'off' => esc_html__( 'No', 'tm-builder-integrator' ),
				),
				'affects' => array(
					'#tm_pb_photo_size',
				),
			),
			'photo_size' => array(
				'label'           => esc_html__( 'Photo Size', 'tm-builder-integrator' ),
				'description'     => esc_html__( 'Select photo size.', 'tm-builder-integrator' ),
				'type'            => 'select',
				'options'         => array_combine( $image_sizes, $image_sizes ),
				'default'         => 'thumbnail',
				'depends_show_if' => 'on',
			),
			'show_name' => array(
				'label'           => esc_html__( 'Show Name', 'tm-builder-integrator' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'tm-builder-integrator' ),
					'off' => esc_html__( 'No', 'tm-builder-integrator' ),
				),
			),
			'show_desc' => array(
				'label'           => esc_html__( 'Show Description', 'tm-builder-integrator' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'tm-builder-integrator' ),
					'off' => esc_html__( 'No', 'tm-builder-integrator' ),
				),
				'affects' => array(
					'#tm_pb_desc_length',
				),
			),
			'desc_length' => array(
				'label'           => esc_html__( 'Description Length', 'tm-builder-integrator' ),
				'description'     => esc_html__( 'Description Length (in words)', 'tm-builder-integrator' ),
				'type'            => 'range',
				'range_settings'  => array(
					'min'  => 0,
					'max'  => 100,
					'step' => 1,
				),
				'default'         => '10',
				'depends_show_if' => 'on',
			),
			'show_contacts' => array(
				'label'           => esc_html__( 'Show Contacts', 'tm-builder-integrator' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'tm-builder-integrator' ),
					'off' => esc_html__( 'No', 'tm-builder-integrator' ),
				),
			),
			'show_socials' => array(
				'label'           => esc_html__( 'Show Socials', 'tm-builder-integrator' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'tm-builder-integrator' ),
					'off' => esc_html__( 'No', 'tm-builder-integrator' ),
				),
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
				'show_name',
				'show_photo',
				'photo_size',
				'show_desc',
				'desc_length',
				'show_contacts',
				'show_socials',
				'show_more_button',
				'more_button_text',
				'template',
			)
		);

		$callback = power_builder_integrator()->get_shortcode_cb( 'cherry-real-estate', 'tm_re_agents_list' );

		if ( ! is_callable( $callback ) ) {
			return;
		}

		$content = call_user_func( $callback, array(
			'number'           => $this->_var( 'number' ),
			'order'            => $this->_var( 'order' ),
			'orderby'          => $this->_var( 'orderby' ),
			'show_name'        => $this->_var( 'show_name' ),
			'show_photo'       => $this->_var( 'show_photo' ),
			'photo_size'       => $this->_var( 'photo_size' ),
			'show_desc'        => $this->_var( 'show_desc' ),
			'desc_length'      => $this->_var( 'desc_length' ),
			'show_contacts'    => $this->_var( 'show_contacts' ),
			'show_socials'     => $this->_var( 'show_socials' ),
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

		return cherry_re_templater()->get_agent_templates_list();
	}
}

new Tm_Builder_Cherry_RE_Agents_List;
