<?php

class Events_Team_Integrator_Admin {

	/**
	 * A reference to an instance of this class.
	 *
	 * @since 1.0.0
	 * @var   object
	 */
	private static $instance = null;

	function __construct() {
		add_action('add_meta_boxes', array( $this, 'mti_add_custom_box' ) );
		add_action( 'save_post_mp-event', array( $this, 'mti_save_postdata' ) );
	}

	public function mti_add_custom_box() {
		add_meta_box( 'event_participants', esc_html__( 'Event participants', 'moto-tools-integration' ), array( $this, 'mti_meta_box_callback' ), 'mp-event', 'normal' );
	}

	public function mti_meta_box_callback() {
		wp_nonce_field( plugin_basename( __FILE__ ), 'mti_noncename' );
		load_template( plugin_dir_path( __FILE__ ) . 'view/timetable-events-meta-box.php' );
	}

	public function mti_save_postdata( $post_id ) {
		if ( empty( $_POST ) )
			return;

		if ( ! wp_verify_nonce( $_POST['mti_noncename'], plugin_basename( __FILE__ ) ) )
			return;

		if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE )
			return;

		if ( 'mp-event' == $_POST['post_type'] && ! current_user_can( 'edit_page', $post_id ) ) {
			return;
		} elseif( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}

		if ( ! isset( $_POST['mti-mebmers-select'] ) ) {
			delete_post_meta( $post_id, 'event_participants' );

			return;
		}

		$participants = serialize( $_POST['mti-mebmers-select'] );
		update_post_meta( $post_id, 'event_participants', $participants );
	}

	public function get_members_query() {
		$args = array(
			'post_type' => 'team',
		);

		$members_query = new WP_Query($args);
		wp_reset_query();

		return $members_query;
	}

	public function get_members_list() {
		$event_participants = unserialize( get_post_meta( get_the_ID(), 'event_participants', true ) );
		$members_list = array();
		$members_query = $this->get_members_query();

		foreach ( $members_query->posts as $post) {
			$members_list[] = array(
				'id'       => $post->ID,
				'title'    => $post->post_title,
				'selected' => in_array( $post->ID, $event_participants )
			);
		}

		return $members_list;
	}

	public static function get_instance() {
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}
}

function events_team_integrator_admin() {
	return Events_Team_Integrator_Admin::get_instance();
}

events_team_integrator_admin();
