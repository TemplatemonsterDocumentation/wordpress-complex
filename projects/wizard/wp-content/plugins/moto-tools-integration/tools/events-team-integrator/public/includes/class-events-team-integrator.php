<?php

class Events_Team_Integrator {

	/**
	 * A reference to an instance of this class.
	 *
	 * @since 1.0.0
	 * @var   object
	 */
	private static $instance = null;

	/**
	 * Contain utility module from Cherry framework
	 *
	 * @since 1.0.0
	 * @var   object
	 */
	private $utility = null;

	/**
	 * Events defaults settings
	 *
	 * @var array
	 */
	private $events_settings = array(
		'per_page'          => 3,
		'columns_number'    => 3,
		'order'             => 'DESC',
		'show_title'        => true,
		'show_participants' => true,
		'show_schedule'     => true,
		'excerpt_length'    => 10
	);

	function __construct() {
		$this->utility = moto_tools_integration()->get_core()->init_module( 'cherry-utility' )->utility;
	}

	/**
	 * Timetable events schedule.
	 *
	 * @since 1.0.0
	 * @param array $args.
	 */
	public function get_timetable_events_schedule( $args = array() ) {
		$this->events_settings = array_merge( $this->events_settings, $args );
		$template = moto_tools_integration()->plugin_path . 'tools/events-team-integrator/templates/timetable-events.php';

		if ( ! file_exists( $template ) ) {
			return;
		}

		$events = get_posts(
			array(
				'posts_per_page' => $this->events_settings['per_page'],
				'post_type'      => 'mp-event',
				'post_status'    => 'publish',
				'order'          => $this->events_settings['order'],
			)
		);

		if ( $events ) {
			echo '<div class="row mti-timetable-events-schedule">';
				echo $this->get_events_loop( $events, $template );
			echo '</div>';
		} else {
			echo '<h5>' . esc_html__( 'Events not found', 'moto-tools-integration' ) . '</h5>';
		}
	}

	/**
	 * Get events items.
	 *
	 * @since  1.0.0
	 * @param  array   $event List of WP_Post objects.
	 * @param  string  $template.
	 * @return string
	 */
	function get_events_loop( $events, $template ) {
		$timetable_data = $this->get_mp_timetable_data( $events );

		$grid_class_array = apply_filters( 'mti_grid_class', array(
			'1' => 'col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12',
			'2' => 'col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6',
			'3' => 'col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-4',
			'4' => 'col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-3',
		) );

		$columns_class = $grid_class_array[ $this->events_settings['columns_number'] ];

		foreach ($events as $key => $event) {
			echo '<div class="mti-event__item ' . $columns_class . '">';

			$permalink = get_permalink( $event->ID );

			$image = $this->utility->media->get_image( array(
				'size'  => 'monstroid2-thumb-m-2',
				'class' => 'mti-event__ithumbnail-img',
				'html'  => '<img %2$s src="%3$s" alt="%4$s" %5$s >',
			), 'post', $event->ID );

			$title = $this->utility->attributes->get_title( array(
				'visible' => $this->events_settings['show_title'],
				'class'   => 'mti-event__title',
				'html'    => '<h5 %1$s>%4$s</h5>',
			), 'post', $event->ID );

			$excerpt_visible = ( '0' === $this->events_settings['excerpt_length'] ) ? false : true;
			$excerpt = $excerpt_visible ? '<div class="mti-event__content">' . wp_trim_words( $event->post_content, $this->events_settings['excerpt_length'], '...' ) . '</div>' : '';

			$participants = $this->events_settings['show_participants'] ? $this->get_events_participants( $event->ID ) : '';

			$event_schedule = $this->events_settings['show_schedule'] ? $this->get_events_schedule( $event->ID, $timetable_data ) : '';

			include $template;

			echo '</div>';
		}
	}

	/**
	 * Get events participants.
	 *
	 * @since  1.0.0
	 * @param  int     $event_id.
	 * @return string
	 */
	function get_events_participants( $event_id ) {
		$output = false;
		$event_participants = unserialize( get_post_meta( $event_id, 'event_participants', true ) );

		if ( $event_participants ) {
			$template = moto_tools_integration()->plugin_path . 'tools/events-team-integrator/templates/timetable-events-participant.php';

			if ( ! file_exists( $template ) ) {
				return;
			}

			ob_start();

			echo '<div class="mti-event__participants">';

			global $post;
			$temp_post = $post;

			foreach ( $event_participants as $participant ) {
				$post = get_post( $participant );
				$team_position_meta = get_post_meta( $participant, 'cherry-team-position', true );

				echo '<div class="mti-event__participant-item">';

					$image = $this->utility->media->get_image( array(
						'size'  => 'thumbnail',
						'class' => 'mti-event__participant-link',
						'html'  => '<a href="%1$s" %2$s ><img class="mti-event__participant-img" src="%3$s" alt="%4$s" %5$s ></a>',
					), 'post', $participant );

					$title = $this->utility->attributes->get_title( array(
						'class' => 'mti-event__participant-title',
						'html'  => '<div %1$s><a href="%2$s" %3$s>%4$s</a></div>',
					), 'post', $participant );

					if ( $team_position_meta )
						$participant_position = '<div class="mti-event__participant-position">' . $team_position_meta . '</div>';

					include $template;

				echo '</div>';
			}

			$post = $temp_post;

			echo '</div>';

			$output = ob_get_clean();
		}

		return $output;
	}

	/**
	 * Get events schedule.
	 *
	 * @since  1.0.0
	 * @param  int     $event_id.
	 * @param  array   $events_data.
	 * @return string
	 */
	function get_events_schedule( $event_id, $events_data ) {
		$template = moto_tools_integration()->plugin_path . 'tools/events-team-integrator/templates/timetable-events-schedule-item.php';
		$time_format = get_option('time_format');

		ob_start();

		foreach ( $events_data as $key => $data ) {
			if ( $event_id == $data->event_id ) {
				echo '<div class="mti-event__schedule-item">';

				$event_column = '<div class="mti-event__schedule-column">' . get_the_title( $data->column_id ) . '</div>';
				$event_start = date( $time_format, strtotime( $data->event_start ) );
				$event_end = date( $time_format, strtotime( $data->event_end ) );
				$event_timeslot = '<time class="mti-event__schedule-timeslot">' . $event_start . '-' . $event_end . '</time>';

				include $template;

				echo '</div>';
			}
		}

		$output = ob_get_clean();

		return $output;
	}

	/**
	 * Get mp_timetable_data db table.
	 *
	 * @since  1.0.0
	 *
	 * @param  array|object events.
	 * @return array|object timetable_data.
	 */
	function get_mp_timetable_data( $events ) {
		if ( ! $events )
			return false;

		global $wpdb;
		$table_name = $wpdb->prefix . 'mp_timetable_data';
		$column = 'event_id';
		$order = 'column_id';

		foreach ( $events as $event ) {
			$events_id[] = $event->ID;
		}
		$events_id = implode( ',', $events_id );

		$sql_reguest = 'SELECT * FROM ' . $table_name . ' WHERE ' . $column . " IN (" . $events_id . ")" . ' ORDER BY `' . $order . '`';

		return $wpdb->get_results($sql_reguest);
	}

	public static function get_instance() {
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}
}

function events_team_integrator() {
	return Events_Team_Integrator::get_instance();
}

events_team_integrator();
