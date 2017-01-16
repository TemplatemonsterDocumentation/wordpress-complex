<?php
class Tm_Builder_Tm_Pg_Gallery extends Tm_Builder_Module {

	function init() {

		$this->name = esc_html__( 'TM Gallery', 'tm-builder-integrator' );
		$this->icon = 'f03e';
		$this->slug = 'tm_pb_tm_pg_gallery';
		$this->main_css_element = '%%order_class%%.' . $this->slug;

		$this->whitelisted_fields = array(
			'id',
			'module_id',
			'module_class',
		);
	}

	function get_fields() {

		$fields = array(
			'id' => array(
				'label'           => esc_html__( 'Include categories', 'tm-builder-integrator' ),
				'option_category' => 'basic_option',
				'renderer'        => array( $this, 'get_galleries' ),
				'description'     => esc_html__( 'Choose which categories you would like to include.', 'tm-builder-integrator' ),
			),
			'disabled_on' => array(
				'label'           => esc_html__( 'Disable on', 'tm-builder-integrator' ),
				'type'            => 'multiple_checkboxes',
				'options'         => array(
					'phone'   => esc_html__( 'Phone', 'tm-builder-integrator' ),
					'tablet'  => esc_html__( 'Tablet', 'tm-builder-integrator' ),
					'desktop' => esc_html__( 'Desktop', 'tm-builder-integrator' ),
				),
				'additional_att'  => 'disable_on',
				'option_category' => 'configuration',
				'description'     => esc_html__( 'This will disable the module on selected devices', 'tm-builder-integrator' ),
			),
			'admin_label' => array(
				'label'       => esc_html__( 'Admin Label', 'tm-builder-integrator' ),
				'type'        => 'text',
				'description' => esc_html__( 'This will change the label of the module in the builder for easy identification.', 'tm-builder-integrator' ),
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

	public function get_galleries() {

		$name = 'tm_pb_id';

		$galleries = get_posts( array(
			'posts_per_page' => -1,
			'post_type'      => 'tm_pg_gallery',
		) );

		if ( empty( $galleries ) ) {
			return '<p>' . esc_html__( "You currently don't have any projects assigned to a category.", 'tm_builder' ) . '</p>';
		}

		$output = "<select name=\"" . $name . "\" id=\"" . $name . "\" class=\"tm-pb-main-setting\">\n";

		foreach ( $galleries as $post ) {
			$selected = sprintf(
				'<%%- typeof( %2$s ) !== \'undefined\' && \'%1$s\' === %2$s ?  \' selected="selected"\' : \'\' %%>',
				esc_html( $post->ID ),
				$name
			);

			$output .= sprintf(
				'%4$s<option value="%1$s"%3$s>%2$s</option>',
				esc_attr( $post->ID ),
				esc_html( $post->post_title ),
				$selected,
				"\n\t\t\t\t\t"
			);
		}

		$output .= "\n\t\t\t\t\t</select>";

		$output = '<div id="' . $name . '-wrap">' . $output . '</div>';

		return apply_filters( 'tm_builder_galleries_option_html', $output, $args );
	}

	function shortcode_callback( $atts, $content = null, $function_name ) {

		$this->set_vars(
			array(
				'id',
			)
		);

		$callback = power_builder_integrator()->get_shortcode_cb( 'tm-gallery', 'tm-pg-gallery' );

		if ( ! is_callable( $callback ) ) {
			return;
		}

		$content = call_user_func(
			$callback,
			array(
				'id' => $this->_var( 'id' ),
			)
		);

		$output = $this->wrap_clean( $content, array(), $function_name );

		return $output;
	}
}

new Tm_Builder_Tm_Pg_Gallery;
