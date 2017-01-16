<?php
/*
Shortcode Name: timetable events schedule
Description: This shortcode is used to display information about events.
Settings:
 Events count - Limit the events
 Columns number - Choose the number of columns
 Events order - Choose the events order
 Event title - Choose whether to display post title
 Event participants - Choose whether to display post participants
 Event schedule - Choose whether to display post schedule
*/


/**
 * Class Mti_Timetable_Events_Schedule_Shortcode.
 */
class Mti_Timetable_Events_Schedule_Shortcode {

	/**
	 * Shortcode name.
	 *
	 * @since 1.0.0
	 * @var   string
	 */
	public static $name = 'mti_events';

	/**
	 * A reference to an instance of this class.
	 *
	 * @since 1.0.0
	 * @var   object
	 */
	private static $instance = null;

	/**
	 * Constructor
	 */
	public function __construct() {
		// Register shortcode on 'init'.
		add_action( 'init', array( $this, 'register_shortcode' ) );
	}

	/**
	 * Registers the [$this->name] shortcode.
	 *
	 * @since 1.0.0
	 */
	public function register_shortcode() {

		/**
		 * Filters a shortcode name.
		 *
		 * @since 1.0.0
		 * @param string $this->name Shortcode name.
		 */
		$tag = apply_filters( self::$name . '_shortcode_name', self::$name );

		add_shortcode( $tag, array( $this, 'do_shortcode' ) );
	}

	/**
	 * The shortcode function.
	 *
	 * @since  1.0.0
	 * @param  array  $atts      The user-inputted arguments.
	 * @return string
	 */
	public function do_shortcode( $atts, $content = null, $shortcode = 'mti_events' ) {
		$output = '';

		// Set up the default arguments.
		$defaults = array(
			'per_page'          => 3,
			'columns_number'    => 3,
			'order'             => 'DESC',
			'show_title'        => true,
			'show_participants' => true,
			'show_schedule'     => true,
			'excerpt_length'    => 10
		);

		/**
		 * Parse the arguments.
		 *
		 * @link http://codex.wordpress.org/Function_Reference/shortcode_atts
		 */
		$atts = shortcode_atts( $defaults, $atts, $shortcode );

		$bool_to_fix = array(
			'show_title',
			'show_participants',
			'show_schedule',
		);

		// Fix booleans.
		foreach ( $bool_to_fix as $v ) {
			$atts[ $v ] = filter_var( $atts[ $v ], FILTER_VALIDATE_BOOLEAN );
		}

		ob_start();
		events_team_integrator()->get_timetable_events_schedule( $atts );
		$output = ob_get_clean();

		return $output;
	}

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @return object
	 */
	public static function get_instance() {
		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}
}

Mti_Timetable_Events_Schedule_Shortcode::get_instance();
