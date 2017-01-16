<?php
/*
 * Plugin Name: Moto Tools Integration
 * Plugin URI:
 * Description: Advanced tools for Moto
 * Author:      TemplateMonster
 * Author URL:  http://www.templatemonster.com/wordpress-themes.php
 * Version:     1.0.0
 * Text Domain: moto-tools-integration
 * License:     GPL-3.0+
 * License URI: http://www.gnu.org/licenses/gpl-3.0.txt
 * Domain Path: /languages
*/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// If class 'Moto_Tools_Integration' not exists.
if ( ! class_exists( 'Moto_Tools_Integration' ) ) {

	/**
	 * Sets up and initializes the MotoTools Integration.
	 *
	 * @since 1.0.0
	 */
	class Moto_Tools_Integration {

		/**
		 * A reference to an instance of this class.
		 *
		 * @since 1.0.0
		 * @var   object
		 */
		private static $instance = null;

		/**
		 * Plugin version
		 *
		 * @var string
		 */
		private $version = '1.0.0';

		/**
		 * Plugin dir URL
		 *
		 * @var string
		 */
		private $plugin_url = null;

		/**
		 * Plugin dir path
		 *
		 * @var string
		 */
		public $plugin_path = null;

		/**
		 * Plugin slug
		 *
		 * @var string
		 */
		public $plugin_slug = '';

		/**
		 * A reference to an instance of cherry framework core class.
		 *
		 * @since 1.0.0
		 * @var   object
		 */
		private $core = null;

		public function __construct() {
			$this->plugin_path = plugin_dir_path( __FILE__ );
			$this->plugin_url  = plugin_dir_url( __FILE__ );
			$this->plugin_slug = basename( dirname( __FILE__ ) );

			add_action( 'plugins_loaded', array( $this, 'lang' ) );

			// Set up a Cherry core.
			add_action( 'after_setup_theme', require( trailingslashit( dirname( __FILE__ ) ) . 'cherry-framework/setup.php' ), 0 );
			add_action( 'after_setup_theme', array( $this, 'get_core' ), 1 );
			add_action( 'after_setup_theme', array( 'Cherry_Core', 'load_all_modules' ), 2 );

			// Load the events team integrator includes.
			add_action( 'after_setup_theme', array( $this, 'events_team_integrator_init' ), 4 );
		}

		/**
		 * Loads the translation files.
		 *
		 * @since 1.0.0
		 */
		public function lang() {
			load_plugin_textdomain( 'moto-tools-integration', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
		}

		/**
		 * Load the events team integrator includes.
		 *
		 * @since 1.0.0
		 */
		public function events_team_integrator_init() {
			if ( class_exists( 'Mp_Time_Table' ) && class_exists( 'Cherry_Team_Members' ) ) {
				if ( is_admin() ) {
					$this->events_team_integrator_admin();
				} else {
					$this->events_team_integrator_public();
				}
			}
		}

		/**
		 * events team integrator admin-related hooks
		 *
		 * @since 1.0.0
		 */
		public function events_team_integrator_admin() {
			require_once( $this->plugin_path . 'tools/events-team-integrator/admin/includes/class-events-team-integrator-admin.php' );

			add_action( 'admin_enqueue_scripts', array( $this, 'events_team_integrator_admin_assets' ), 20 );
		}

		/**
		 * Register and enqueue admin style sheet.
		 *
		 * @since 1.0.0
		 */
		public function events_team_integrator_admin_assets() {
			if ( 'mp-event' !== get_post_type() )
				return;

			wp_enqueue_script( 'mti-script', $this->plugin_url . 'tools/events-team-integrator/admin/assets/js/script.js', array('jquery'), $this->version, true );
			wp_enqueue_style( 'mti-style', $this->plugin_url . 'tools/events-team-integrator/admin/assets/css/style.css', '', $this->version );
		}

		/**
		 * events team integrator public-related hooks
		 *
		 * @return void
		 */
		public function events_team_integrator_public() {
			require_once( $this->plugin_path . 'tools/events-team-integrator/public/includes/class-events-team-integrator.php' );
			require_once( $this->plugin_path . 'tools/events-team-integrator/public/includes/widgets/class-timetable-events-schedule-widget.php' );
			require_once( $this->plugin_path . 'tools/events-team-integrator/public/includes/shortcode/class-timetable-events-schedule-shortcode.php' );

			add_action( 'wp_enqueue_scripts', array( $this, 'events_team_integrator_public_assets' ), 20 );
		}

		/**
		 * Register and enqueue public-facing style sheet.
		 *
		 * @since 1.0.0
		 */
		public function events_team_integrator_public_assets() {
			wp_enqueue_style( 'mti-events-team-integrator', $this->plugin_url . 'tools/events-team-integrator/public/assets/css/events-team-integrator.css', '', $this->version );
		}

		/**
		 * Loads the core functions. These files are needed before loading anything else in the
		 * plugin because they have required functions for use.
		 *
		 * @since  1.0.0
		 */
		public function get_core() {
			/**
			 * Fires before loads the core theme functions.
			 *
			 * @since 1.0.0
			 */
			do_action( 'mti_core_before' );

			global $chery_core_version;

			if ( null !== $this->core ) {
				return $this->core;
			}

			if ( 0 < sizeof( $chery_core_version ) ) {
				$core_paths = array_values( $chery_core_version );
				require_once( $core_paths[0] );
			} else {
				die( 'Class Cherry_Core not found' );
			}

			$core = new Cherry_Core( array(
				'base_dir' => $this->plugin_path . 'cherry-framework',
				'base_url' => $this->plugin_url . 'cherry-framework',
				'modules'  => array(
					'cherry-js-core' => array(
						'autoload' => true,
					),
					'cherry-ui-elements' => array(
						'autoload' => false,
					),
					'cherry-utility' => array(
						'autoload' => false,
					),
					'cherry-widget-factory' => array(
						'autoload' => false,
					),
				),
			) );

			return $core;
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

	/**
	 * Returns instance of main class
	 *
	 * @return Moto_Tools_Integration
	 */
	function moto_tools_integration() {
		return Moto_Tools_Integration::get_instance();
	}

	moto_tools_integration();
}
