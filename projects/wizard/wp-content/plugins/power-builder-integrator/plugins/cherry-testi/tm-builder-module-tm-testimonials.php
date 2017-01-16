<?php
class Tm_Builder_Cherry_Testi extends Tm_Builder_Module {

	function init() {
		$this->name = esc_html__( 'Cherry Testimonials', 'tm-builder-integrator' );
		$this->icon = 'f10d';
		$this->slug = 'tm_pb_cherry_testi';
		$this->main_css_element = '%%order_class%%.' . $this->slug;

		$this->whitelisted_fields = array(
			'type',
			'sup_title',
			'title',
			'sub_title',
			'limit',
			'orderby',
			'order',
			'category',
			'ids',
			'size',
			'content_length',
			'divider',
			'show_avatar',
			'show_email',
			'show_position',
			'show_company',
			'autoplay',
			'effect',
			'loop',
			'pagination',
			'navigation',
			'slides_per_view',
			'slides_per_view_laptop',
			'slides_per_view_tablet',
			'slides_per_view_phone',
			'space_between',
			'space_between_laptop',
			'space_between_tablet',
			'space_between_phone',
			'template',
			'custom_class',
			'module_id',
			'module_class',
		);

		$this->fields_defaults = array(
			'limit'                  => array( '3' ),
			'order'                  => array( 'desc' ),
			'orderby'                => array( 'date' ),
			'size'                   => array( '100' ),
			'divider'                => array( 'off' ),
			'show_avatar'            => array( 'on' ),
			'show_email'             => array( 'on' ),
			'show_position'          => array( 'on' ),
			'show_company'           => array( 'on' ),
			'content_length'         => array( '55' ),
			'type'                   => array( 'list' ),
			'autoplay'               => array( '7000' ),
			'effect'                 => array( 'slide' ),
			'loop'                   => array( 'on' ),
			'pagination'             => array( 'on' ),
			'navigation'             => array( 'on' ),
			'slides_per_view'        => array( '1' ),
			'slides_per_view_laptop' => array( '1' ),
			'slides_per_view_tablet' => array( '1' ),
			'slides_per_view_phone'  => array( '1' ),
			'space_between'          => array( '15' ),
			'space_between_laptop'   => array( '15' ),
			'space_between_tablet'   => array( '15' ),
			'space_between_phone'    => array( '15' ),
			'template'               => array( 'default.tmpl' ),
		);
	}

	function get_fields() {
		$fields = array(
			'source' => array(
				'label'           => esc_html__( 'Choose Source', 'tm-builder-integrator' ),
				'type'            => 'select',
				'option_category' => 'configuration',
				'options'         => array(
					'category' => esc_html__( 'Categories', 'tm-builder-integrator' ),
					'ids'      => esc_html__( 'Testimonial ids', 'tm-builder-integrator' ),
				),
				'affects' => array(
					'#tm_pb_category',
					'#tm_pb_ids',
				),
			),
			'category' => array(
				'label'            => esc_html__( 'Include categories', 'tm-builder-integrator' ),
				'description'      => esc_html__( 'Choose which categories you would like to include.', 'tm-builder-integrator' ),
				'option_category'  => 'basic_option',
				'renderer'         => 'tm_builder_include_categories_option',
				'renderer_options' => array(
					'use_terms'  => true,
					'term_name'  => 'tm-testimonials_category',
					'input_name' => 'tm_pb_category',
				),
				'depends_show_if' => 'category',
			),
			'ids' => array(
				'label'           => esc_html__( 'Include post id', 'tm-builder-integrator' ),
				'description'     => esc_html__( 'Enter post id you would like to include. The separator gap. Example: 256 472 23 6', 'tm-builder-integrator' ),
				'option_category' => 'basic_option',
				'type'            => 'text',
				'depends_show_if' => 'ids',
			),
			'limit' => array(
				'label'           => esc_html__( 'Posts count ( Set -1 to show all )', 'tm-builder-integrator' ),
				'option_category' => 'basic_option',
				'type'            => 'range',
				'range_settings'  => array(
					'min'  => -1,
					'max'  => 30,
					'step' => 1,
				),
				'default' => '3',
			),
			'order' => array(
				'label'           => esc_html__( 'Order', 'tm-builder-integrator' ),
				'description'     => esc_html__( 'Testimonials order.', 'tm-builder-integrator' ),
				'type'            => 'select',
				'option_category' => 'configuration',
				'options'         => array(
					'desc' => esc_html__( 'Descending', 'tm-builder-integrator' ),
					'asc'  => esc_html__( 'Ascending', 'tm-builder-integrator' ),
				),
			),
			'orderby' => array(
				'label'           => esc_html__( 'Order by', 'tm-builder-integrator' ),
				'description'     => esc_html__( 'Order testimonials by.', 'tm-builder-integrator' ),
				'type'            => 'select',
				'option_category' => 'configuration',
				'options'         => array(
					'date'     => esc_html__( 'Date', 'tm-builder-integrator' ),
					'none'     => esc_html__( 'None', 'tm-builder-integrator' ),
					'id'       => esc_html__( 'ID', 'tm-builder-integrator' ),
					'title'    => esc_html__( 'Author', 'tm-builder-integrator' ),
					'name'     => esc_html__( 'Slug', 'tm-builder-integrator' ),
					'modified' => esc_html__( 'Last modified date', 'tm-builder-integrator' ),
					'rand'     => esc_html__( 'Random', 'tm-builder-integrator' ),
				),
			),
			'sup_title' => array(
				'label'           => esc_html__( 'Super Title', 'tm-builder-integrator' ),
				'type'            => 'text',
				'option_category' => 'configuration',
			),
			'title' => array(
				'label'           => esc_html__( 'Title', 'tm-builder-integrator' ),
				'type'            => 'text',
				'option_category' => 'configuration',
			),
			'sub_title' => array(
				'label'           => esc_html__( 'Sub Title', 'tm-builder-integrator' ),
				'type'            => 'text',
				'option_category' => 'configuration',
			),
			'divider' => array(
				'label'           => esc_html__( 'Show Divider', 'tm-builder-integrator' ),
				'description'     => esc_html__( 'Toggle a separator between title & testimonials.', 'tm-builder-integrator' ),
				'type'            => 'yes_no_button',
				'option_category' => 'basic_option',
				'options'         => array(
					'off' => esc_html__( 'No', 'tm-builder-integrator' ),
					'on'  => esc_html__( 'Yes', 'tm-builder-integrator' ),
				),
			),
			'show_avatar' => array(
				'label'           => esc_html__( 'Show Avatar', 'tm-builder-integrator' ),
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
			'size' => array(
				'label'          => esc_html__( 'Avatar Size', 'tm-builder-integrator' ),
				'description'    => esc_html__( 'Select avatar size.', 'tm-builder-integrator' ),
				'type'           => 'range',
				'range_settings' => array(
					'min'  => 1,
					'max'  => 512,
					'step' => 1,
				),
				'default'         => '100',
				'depends_show_if' => 'on',
			),
			'show_email' => array(
				'label'           => esc_html__( 'Show E-mail', 'tm-builder-integrator' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'tm-builder-integrator' ),
					'off' => esc_html__( 'No', 'tm-builder-integrator' ),
				),
			),
			'show_position' => array(
				'label'   => esc_html__( 'Show Position', 'tm-builder-integrator' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'tm-builder-integrator' ),
					'off' => esc_html__( 'No', 'tm-builder-integrator' ),
				),
			),
			'show_company' => array(
				'label'   => esc_html__( 'Show Company Name', 'tm-builder-integrator' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'tm-builder-integrator' ),
					'off' => esc_html__( 'No', 'tm-builder-integrator' ),
				),
			),
			'content_length' => array(
				'label'           => esc_html__( 'Content Length', 'tm-builder-integrator' ),
				'description'     => esc_html__( 'Insert the number of words you want to show in the post content.', 'tm-builder-integrator' ),
				'option_category' => 'configuration',
				'type'            => 'range',
				'range_settings'  => array(
					'min'  => -1,
					'max'  => 100,
					'step' => 1,
				),
				'default' => '55',
			),
			'type' => array(
				'label'           => esc_html__( 'Type', 'tm-builder-integrator' ),
				'type'            => 'select',
				'option_category' => 'basic_option',
				'options'         => array(
					'list'   => esc_html__( 'List', 'tm-builder-integrator' ),
					'slider' => esc_html__( 'Slider', 'tm-builder-integrator' ),
				),
				'affects' => array(
					'#tm_pb_autoplay',
					'#tm_pb_effect',
					'#tm_pb_loop',
					'#tm_pb_pagination',
					'#tm_pb_navigation',
					'#tm_pb_slides_per_view',
					'#tm_pb_space_between',
				),
			),
			'autoplay' => array(
				'label'           => esc_html__( 'Autoplay, ms ( Set 0 to stop autoplay )', 'tm-builder-integrator' ),
				'type'            => 'range',
				'option_category' => 'basic_option',
				'depends_show_if' => 'slider',
				'range_settings'  => array(
					'min'  => 0,
					'max'  => 10000,
					'step' => 500,
				),
				'default' => '7000',
			),
			'effect' => array(
				'label'           => esc_html__( 'Effect', 'tm-builder-integrator' ),
				'type'            => 'select',
				'option_category' => 'configuration',
				'depends_show_if' => 'slider',
				'options'         => array(
					'slide'     => esc_html__( 'Slide', 'tm-builder-integrator' ),
					'coverflow' => esc_html__( 'Coverflow', 'tm-builder-integrator' ),
				),
			),
			'loop' => array(
				'label'           => esc_html__( 'Enable loop mode', 'tm-builder-integrator' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'depends_show_if' => 'slider',
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'tm-builder-integrator' ),
					'off' => esc_html__( 'No', 'tm-builder-integrator' ),
				),
			),
			'pagination' => array(
				'label'           => esc_html__( 'Display pagination', 'tm-builder-integrator' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'depends_show_if' => 'slider',
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'tm-builder-integrator' ),
					'off' => esc_html__( 'No', 'tm-builder-integrator' ),
				),
			),
			'navigation' => array(
				'label'           => esc_html__( 'Display navigation', 'tm-builder-integrator' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'depends_show_if' => 'slider',
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'tm-builder-integrator' ),
					'off' => esc_html__( 'No', 'tm-builder-integrator' ),
				),
			),
			'slides_per_view' => array(
				'label'           => esc_html__( 'Number of slides per view', 'tm-builder-integrator' ),
				'description'     => esc_html__( "Slides visible at the same time on slider's container", 'tm-builder-integrator' ),
				'option_category' => 'basic_option',
				'depends_show_if' => 'slider',
				'type'            => 'range',
				'range_settings'  => array(
					'min'  => 1,
					'max'  => 4,
					'step' => 1,
				),
				'default'        => '1',
				'mobile_options' => true,
				'mobile_global'  => true,
			),
			'space_between' => array(
				'label'           => esc_html__( 'Distance between slides (px)', 'tm-builder-integrator' ),
				'option_category' => 'basic_option',
				'depends_show_if' => 'slider',
				'type'            => 'range',
				'range_settings'  => array(
					'min'  => 0,
					'max'  => 100,
					'step' => 1,
				),
				'default'        => '15',
				'mobile_options' => true,
				'mobile_global'  => true,
			),
			'template' => array(
				'label'           => esc_html__( 'Layout', 'tm-builder-integrator' ),
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
				'type',
				'sup_title',
				'title',
				'sub_title',
				'limit',
				'orderby',
				'order',
				'category',
				'ids',
				'size',
				'content_length',
				'divider',
				'show_avatar',
				'show_email',
				'show_position',
				'show_company',
				'autoplay',
				'effect',
				'loop',
				'pagination',
				'navigation',
				'slides_per_view',
				'slides_per_view_laptop',
				'slides_per_view_tablet',
				'slides_per_view_phone',
				'space_between',
				'space_between_laptop',
				'space_between_tablet',
				'space_between_phone',
				'template',
				'custom_class',
			)
		);

		$callback = power_builder_integrator()->get_shortcode_cb( 'cherry-testi', 'tm_testimonials' );

		if ( ! is_callable( $callback ) ) {
			return;
		}

		$content = call_user_func( $callback, array(
			'category'               => $this->_var( 'category' ),
			'ids'                    => $this->_var( 'ids' ),
			'limit'                  => $this->_var( 'limit' ),
			'order'                  => $this->_var( 'order' ),
			'orderby'                => $this->_var( 'orderby' ),
			'sup_title'              => $this->_var( 'sup_title' ),
			'title'                  => $this->_var( 'title' ),
			'sub_title'              => $this->_var( 'sub_title' ),
			'size'                   => $this->_var( 'size' ),
			'content_length'         => $this->_var( 'content_length' ),
			'divider'                => $this->_var( 'divider' ),
			'show_avatar'            => $this->_var( 'show_avatar' ),
			'show_email'             => $this->_var( 'show_email' ),
			'show_position'          => $this->_var( 'show_position' ),
			'show_company'           => $this->_var( 'show_company' ),
			'type'                   => $this->_var( 'type' ),
			'autoplay'               => $this->_var( 'autoplay' ),
			'effect'                 => $this->_var( 'effect' ),
			'loop'                   => $this->_var( 'loop' ),
			'pagination'             => $this->_var( 'pagination' ),
			'navigation'             => $this->_var( 'navigation' ),
			'slides_per_view'        => $this->_var( 'slides_per_view' ),
			'slides_per_view_laptop' => $this->_var( 'slides_per_view_laptop' ),
			'slides_per_view_tablet' => $this->_var( 'slides_per_view_tablet' ),
			'slides_per_view_phone'  => $this->_var( 'slides_per_view_phone' ),
			'space_between'          => $this->_var( 'space_between' ),
			'space_between_laptop'   => $this->_var( 'space_between_laptop' ),
			'space_between_tablet'   => $this->_var( 'space_between_tablet' ),
			'space_between_phone'    => $this->_var( 'space_between_phone' ),
			'template'               => $this->_var( 'template' ),
		) );

		$output = $this->wrap_clean( $content, array(), $function_name );

		return $output;
	}

	function _prepare_template_select() {

		if ( ! class_exists( 'TM_Testimonials_Page_Template' ) ) {
			return array();
		}

		$page_templater = TM_Testimonials_Page_Template::get_instance();

		return $page_templater->get_templates_list();
	}
}

new Tm_Builder_Cherry_Testi;
