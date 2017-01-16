<?php
class Tm_Builder_Tm_Timeline extends Tm_Builder_Module {

	function init() {
		$this->name = esc_html__( 'Timeline', 'tm-builder-integrator' );
		$this->icon = 'f017';
		$this->slug = 'tm_pb_tm_timeline';
		$this->main_css_element = '%%order_class%%.' . $this->slug;

		$this->whitelisted_fields = array(
			'timeline_layout',
			'visible_items',
			'date_format',
			'tag',
			'order',
			'anchors',
		);
		$this->fields_defaults = array(
			'timeline_layout' => array( 0 ),
			'visible_items' => array( 1 ),
			'date_format' => array( 'Y/m/d' ),
			'tag' => array( '' ),
			'order' => array( 'ASC' ),
			'anchors' => array( 'on' ),
		);
	}

	function render_tag_selector( $args = array() ) {
		$defaults = array(
			'term_name'    => 'timeline_post_tag',
			'input_name'   => 'tm_pb_tag',
		);

		$args = wp_parse_args( $args, $defaults );
		$name = $args['input_name'];
		$terms = get_terms( $args['term_name'] );

		if ( empty( $terms ) ) {
			$output = '<p>' . esc_html__( "You currently don't have any Timeline tags.", 'tm_builder' ) . '</p>';
		} else {
			$terms_array = array();
			foreach( $terms as $term ) {
				$terms_array[ $term->name ] = $term->name;
			}
			$output = $this->render_field( array(
				'name' => $name,
				'type' => 'select',
				'options' => $terms_array
			) );
		}

		return '<div id="' . $name . '_wrap">' .
			$output .
		'</div>';
	}

	function get_fields() {
		$fields = array(
			'timeline_layout' => array(
				'label'           => esc_html__( 'Timeline Layout', 'tm-builder-integrator' ),
				'type'            => 'select',
				'option_category' => 'basic_option',
				'options'         => array(
					"horizontal" => "Horizontal",
					"vertical" => "Vertical",
					"vertical-chessorder" => "Vertical (chess order)",
				),
				'description'     => esc_html__( 'Timeline look and feel.', 'tm-builder-integrator' ),
			),
			'visible_items' => array(
				'label'           => esc_html__( 'Horizontal layout visible items limit', 'tm-builder-integrator' ),
				'type'            => 'range',
				'option_category' => 'basic_option',
				'default'         => 1,
				'range_settings' => array(
					'min'  => 1,
					'max'  => 6,
					'step' => 1,
				),
				'mobile_options'      => false,
				'mobile_global'       => false,
				'description'     => esc_html__( 'Visible items limit is used for "Horizontal" layout.', 'tm-builder-integrator' ),
			),
			'date_format' => array(
				'label'           => esc_html__( 'Date format', 'tm-builder-integrator' ),
				'type'            => 'select',
				'option_category' => 'configuration',
				'options'         => array (
					'Y-m-d' => 'YYYY - MM - DD',
					'YYYY / MM / DD' => 'Y/m/d',
					'YYYY . MM . DD' => 'Y.m.d',
					'DD - MM - YYYY' => 'd-m-Y',
					'DD / MM / YYYY' => 'd/m/Y',
					'DD . MM . YYYY' => 'd.m.Y',
					'MM' => 'm',
					'YYYY' => 'Y',
				),
				'description'     => esc_html__( 'Date format used for displaying posts in the timeline.', 'tm-builder-integrator' ),
			),
			'tag' => array(
				'label'            => esc_html__( 'Tag', 'tm-builder-integrator' ),
				'type'             => 'select',
				'option_category'  => 'configuration',
				'renderer'         => array( $this, 'render_tag_selector' ),
				'renderer_options' => array(
					'use_terms'    => true,
					'term_name'    => 'timeline_post_tag',
					'input_name'   => 'tag',
				),
				'description'      => esc_html__( 'Show only posts which contain following tag. If none selected, will show all timeline posts.', 'tm-builder-integrator' ),
			),
			'order' => array(
				'label'           => esc_html__( 'Sort Order', 'tm-builder-integrator' ),
				'type'            => 'select',
				'option_category' => 'configuration',
				'options'         => array(
					'ASC' => esc_html__( 'Ascending', 'tm-builder-integrator' ),
					'DESC' => esc_html__( 'Descending', 'tm-builder-integrator' ),
				),
			),
			'anchors' => array(
				'label'             => esc_html__( 'Display anchors', 'tm-builder-integrator' ),
				'type'              => 'yes_no_button',
				'option_category'   => 'configuration',
				'options'           => array(
					'on'  => esc_html__( 'Yes', 'tm-builder-integrator' ),
					'off' => esc_html__( 'No', 'tm-builder-integrator' ),
				),
				'description'       => esc_html__( 'Timeline post title will be clickable and will lead user to the post', 'tm-builder-integrator' ),
			)
		);
		return $fields;
	}

	function shortcode_callback( $atts, $content = null, $function_name ) {

		$this->set_vars( array(
			'timeline_layout',
			'visible_items',
			'date_format',
			'tag',
			'order',
			'anchors',
		) );

		$callback = power_builder_integrator()->get_shortcode_cb( 'tm-timeline', 'tm-timeline' );

		if ( ! is_callable( $callback ) ) {
			return;
		}

		$layouts = array(
			0 => 'horizontal',
			1 => 'vertical',
			2 => 'vertical-chessorder',
		);
		$layout = 0;
		foreach( $layouts as $key => $value ) {
			if ( $value === $this->_var( 'timeline_layout' ) ) {
				$layout = $key;
				break;
			}
		}

		$dateFormat = 0;
		$dateFormats = Tm_Timeline::get_supported_date_formats();
		foreach( $dateFormats as $key => $value ) {
			if ( $value['title'] === $this->_var( 'date_format' ) ) {
				$dateFormat = $key;
				break;
			}
		}

		$content = call_user_func(
			$callback,
			array(
				'layout' => $layout,
				'visible-items' => $this->_var( 'visible_items' ),
				'date-format' => $dateFormat,
				'tag' => $this->_var( 'tag' ),
				'order' => $this->_var( 'order' ),
				'anchors' => 'on' === $this->_var( 'anchors' ) ? 'true' : 'false',
			)
		);

		$output = $this->wrap_clean( $content, array(), $function_name );

		return $output;
	}
}

new Tm_Builder_Tm_Timeline;
