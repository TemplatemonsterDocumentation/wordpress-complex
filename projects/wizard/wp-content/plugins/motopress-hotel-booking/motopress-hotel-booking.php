<?php

/*
  Plugin Name: Hotel Booking
  Plugin URI: http://www.getmotopress.com/
  Description: Manage your hotel booking services.
  Version: 1.0.0
  Author: MotoPress
  Author URI: http://www.getmotopress.com/
  License: GPLv2 or later
 */

/*
 * This pluign contains hooks that allow you to edit, add and move content without needing to edit template files. This method protects against upgrade issues.
 * Alternatively, you can copy template files from './templates/' folder to '/your-theme/hotel-booking/' to override them.
 */

HotelBookingPlugin::setPluginDirPathAndUrl( __FILE__, ( isset( $plugin ) ? $plugin : null ), ( isset( $network_plugin ) ? $network_plugin : null ) );

class HotelBookingPlugin {

	/**
	 *
	 * @var \MPHB\HotelBookingPlugin
	 */
	private static $instance = null;
	private static $_pluginFile;
	private static $_pluginDirPath;
	private static $_pluginDirUrl;

	/**
	 * @todo complete description
	 * Fix for symlinked plugin
	 *
	 * @global string $wp_version
	 * @param string $file
	 * @param string|null $plugin
	 * @param string|null $network_plugin
	 */
	public static function setPluginDirPathAndUrl( $file, $plugin, $network_plugin ){
		global $wp_version;
		if ( version_compare( $wp_version, '3.9', '<' ) && isset( $network_plugin ) ) {
			self::$_pluginFile = $network_plugin;
		} else {
			self::$_pluginFile = __FILE__;
		}

		$realDirName	 = basename( dirname( self::$_pluginFile ) );
		$symlinkDirName	 = isset( $plugin ) ? basename( dirname( $plugin ) ) : $realDirName;

		self::$_pluginDirPath = plugin_dir_path( self::$_pluginFile );

		if ( version_compare( $wp_version, '3.9', '<' ) ) {
			self::$_pluginDirUrl = plugin_dir_url( $symlinkDirName . '/' . basename( self::$_pluginFile ) );
		} else {
			self::$_pluginDirUrl = plugin_dir_url( self::$_pluginFile );
		}
	}

	private $name;
	private $author;
	private $version;
	private $slug;
	private $prefix;
	private $pluginDir;
	private $pluginDirUrl;
	private $mainMenuSlug;
	private $mainMenuPage;
	private $mainMenuCapability;

	/**
	 *
	 * @var \MPHB\Admin\MenuPages\SettingsMenuPage
	 */
	private $settingsMenuPage;

	/**
	 *
	 * @var \MPHB\Admin\MenuPages\ShortcodesMenuPage
	 */
	private $shortcodesMenuPage;

	/**
	 *
	 * @var \MPHB\Admin\MenuPages\RoomsGeneratorMenuPage
	 */
	private $roomsGeneratorMenuPage;

	/**
	 *
	 * @var \MPHB\Admin\MenuPages\CalendarMenuPage
	 */
	private $calendarMenuPage;

	/**
	 *
	 * @var \MPHB\CustomPostTypes
	 */
	private $postTypes;

	/**
	 *
	 * @var \MPHB\Session
	 */
	private $session;

	/**
	 *
	 * @var \MPHB\Ajax
	 */
	private $ajax;

	/**
	 *
	 * @var \MPHB\Wizard
	 */
	private $wizard;

	/**
	 *
	 * @var \MPHB\Importer
	 */
	private $importer;

	/**
	 *
	 * @var \MPHB\ScriptManagers\PublicScriptManager
	 */
	private $publicScriptManager;

	/**
	 *
	 * @var \MPHB\ScriptManagers\AdminScriptManager
	 */
	private $adminScriptManager;

	/**
	 *
	 * @var \MPHB\Emails\Emails
	 */
	private $emails;

	/**
	 *
	 * @var \MPHB\Shortcodes
	 */
	private $shortcodes;

	/**
	 *
	 * @var \MPHB\Crons\BookingAbandonCron
	 */
	private $bookingAbandonCron;

	/**
	 *
	 * @var \MPHB\UserActions\UserActions
	 */
	private $userActions;

	/**
	 *
	 * @var \MPHB\Entities\RoomType
	 */
	private $currentRoomType;

	/**
	 *
	 * @var \MPHB\BookingRules\RulesChecker
	 */
	private $rulesChecker;

	/**
	 *
	 * @var \MPHB\SearchParametersStorage
	 */
	private $searchParametersStorage;

	/**
	 *
	 * @var \MPHB\Settings\SettingsRegistry
	 */
	private $settings;
	private $ratePersistence;
	private $roomTypePersistence;
	private $roomPersistence;
	private $bookingPersistence;
	private $servicePersistence;
	private $seasonPersistence;
	private $bookingRepository;
	private $rateRepository;
	private $roomRepository;
	private $roomTypeRepository;
	private $seasonRepository;

	public static function getInstance(){
		if ( !isset( self::$instance ) ) {
			self::$instance = new self();
			self::$instance->afterConstruct();
		}
		return self::$instance;
	}

	private function __construct(){
		$this->pluginDir		 = self::$_pluginDirPath;
		$this->classesBasePath	 = trailingslashit( $this->getPluginPath( 'includes' ) );
		$this->pluginDirUrl		 = self::$_pluginDirUrl;
		$this->slug				 = basename( $this->pluginDir );
		$this->prefix			 = 'mphb';
		$this->mainMenuSlug		 = 'mphb_booking_menu';

		$pluginData		 = $this->getPluginData();
		$this->author	 = isset( $pluginData['Author'] ) ? $pluginData['Author'] : '';
		$this->name		 = isset( $pluginData['Name'] ) ? $pluginData['Name'] : '';
		$this->version	 = isset( $pluginData['Version'] ) ? $pluginData['Version'] : '';
	}

	public function afterConstruct(){
		$this->includeFiles();
		$this->addActions();

		$globalNamespace	 = 'MPHB\\';
		$this->autoloader	 = new \MPHB\Autoloader( $globalNamespace, $this->classesBasePath );

		// Settings
		$this->settings = new \MPHB\Settings\SettingsRegistry();

		// Session
		$this->session = new \MPHB\Session();

		$this->publicScriptManager	 = new \MPHB\ScriptManagers\PublicScriptManager;
		$this->adminScriptManager	 = new \MPHB\ScriptManagers\AdminScriptManager;

		$this->postTypes = new \MPHB\CustomPostTypes();

		$this->initRepositories();
		$this->createPages();
		$this->initBookingRules();

		$this->shortcodes = new \MPHB\Shortcodes();

		$this->wizard	 = new \MPHB\Wizard();
		$this->importer	 = new \MPHB\Importer();

		$this->emails		 = new \MPHB\Emails\Emails();
		$this->userActions	 = new \MPHB\UserActions\UserActions;

		$this->bookingAbandonCron = new \MPHB\Crons\BookingAbandonCron();
		new \MPHB\Fixes();
		new \MPHB\Views\ViewActions();

		// Widgets
		$this->initWidgets();

		$this->searchParametersStorage = new \MPHB\SearchParametersStorage();

		$this->ajax = new \MPHB\Ajax();
	}

	private function initRepositories(){

		$this->ratePersistence		 = new \MPHB\Persistences\RatePersistence( $this->postTypes->rate()->getPostType() );
		$this->roomTypePersistence	 = new \MPHB\Persistences\RoomTypePersistence( $this->postTypes->roomType()->getPostType() );
		$this->roomPersistence		 = new \MPHB\Persistences\RoomPersistence( $this->postTypes->room()->getPostType() );
		$this->bookingPersistence	 = new \MPHB\Persistences\BookingPersistence( $this->postTypes->booking()->getPostType() );
		$this->servicePersistence	 = new \MPHB\Persistences\CPTPersistence( $this->postTypes->service()->getPostType() );
		$this->seasonPersistence	 = new \MPHB\Persistences\CPTPersistence( $this->postTypes->season()->getPostType() );

		$this->roomTypeRepository	 = new \MPHB\Repositories\RoomTypeRepository( $this->roomTypePersistence );
		$this->roomRepository		 = new \MPHB\Repositories\RoomRepository( $this->roomPersistence );
		$this->rateRepository		 = new \MPHB\Repositories\RateRepository( $this->ratePersistence );
		$this->bookingRepository	 = new \MPHB\Repositories\BookingRepository( $this->bookingPersistence );
		$this->serviceRepository	 = new \MPHB\Repositories\ServiceRepository( $this->servicePersistence );
		$this->seasonRepository		 = new \MPHB\Repositories\SeasonRepository( $this->seasonPersistence );
	}

	private function initBookingRules(){
		$globalRulesAtts = array(
			'min_days'		 => $this->settings->bookingRules()->getGlobalMinDays(),
			'max_days'		 => $this->settings->bookingRules()->getGlobalMaxDays(),
			'check_in_days'	 => $this->settings->bookingRules()->getGlobalCheckInDays(),
			'check_out_days' => $this->settings->bookingRules()->getGlobalCheckOutDays()
		);
		$globalRules	 = new MPHB\BookingRules\GlobalRules( $globalRulesAtts );

		$customRules = new MPHB\BookingRules\CustomRulesHolder();
		foreach ( $this->settings->bookingRules()->getCustomRules() as $rule ) {
			$rule = \MPHB\BookingRules\CustomRule::create( $rule );
			if ( $rule ) {
				$customRules->addRule( $rule );
			}
		}
		$this->rulesChecker = new MPHB\BookingRules\RulesChecker( $globalRules, $customRules );
	}

	private function initWidgets(){
		\MPHB\Widgets\RoomsWidget::init();
		\MPHB\Widgets\SearchAvailabilityWidget::init();
	}

	/**
	 *
	 * @return MPHB\BookingRules\RulesChecker
	 */
	public function getRulesChecker(){
		return $this->rulesChecker;
	}

	private function createPages(){

		$roomGeneratorAtts = array(
			'page_title'	 => __( 'Generate Rooms', 'motopress-hotel-booking' ),
			'menu_title'	 => __( 'Generate Rooms', 'motopress-hotel-booking' ),
			'capability'	 => 'edit_posts',
			'parent_menu'	 => MPHB()->postTypes()->roomType()->getMenuSlug(),
			'order'			 => 20
		);

		$this->roomsGeneratorMenuPage = new \MPHB\Admin\MenuPages\RoomsGeneratorMenuPage( 'mphb_rooms_generator', $roomGeneratorAtts );

		$settingsAtts = array(
			'page_title'	 => __( 'MotoPress Hotel Booking Settings', 'motopress-hotel-booking' ),
			'menu_title'	 => __( 'Settings', 'motopress-hotel-booking' ),
			'parent_menu'	 => MPHB()->postTypes()->roomType()->getMenuSlug(),
			'order'			 => 30
		);

		$this->settingsMenuPage = new \MPHB\Admin\MenuPages\SettingsMenuPage( 'mphb_settings', $settingsAtts );

		$shortcodesAtts = array(
			'page_title'	 => __( 'MotoPress Hotel Booking Shortcodes Parameters', 'motopress-hotel-booking' ),
			'menu_title'	 => __( 'Shortcodes', 'motopress-hotel-booking' ),
			'capability'	 => 'edit_pages',
			'parent_menu'	 => MPHB()->postTypes()->roomType()->getMenuSlug(),
			'order'			 => 40,
		);

		$this->shortcodesMenuPage = new \MPHB\Admin\MenuPages\ShortcodesMenuPage( 'mphb_shortcodes', $shortcodesAtts );

		$calendarAtts = array(
			'page_title' => __( 'Booking Calendar', 'motopress-hotel-booking' ),
			'menu_title' => __( 'Calendar', 'motopress-hotel-booking' ),
			'order'		 => 50
		);

		$this->calendarMenuPage = new \MPHB\Admin\MenuPages\CalendarMenuPage( 'mphb_calendar', $calendarAtts );
	}

	public function requireOnce( $relativePath ){
		require_once $this->getPluginPath( $relativePath );
	}

	public function includeFiles(){

		// Functions
		$this->requireOnce( 'functions.php' );
		$this->requireOnce( 'template-functions.php' );
		$this->requireOnce( 'includes/autoloader.php' );
		$this->requireOnce( 'includes/library/wp-session-manager/wp-session.php' );
	}

	public function addActions(){
		add_action( 'plugins_loaded', array( $this, 'loadTextdomain' ) );
		add_action( 'admin_init', array( $this, 'initAutoUpdater' ), 9 );
		add_action( 'admin_menu', array( $this, 'createMenu' ), 10 );

		add_action( 'admin_enqueue_scripts', array( $this, 'registerAdminScripts' ), 9 );
		add_action( 'wp_enqueue_scripts', array( $this, 'registerPublicScripts' ), 9 );

		add_action( 'wp_enqueue_scripts', array( $this, 'enqueuePublicScripts' ), 11 );

		add_action( 'the_post', array( $this, 'setCurrentRoomType' ) );
	}

	public function registerPublicScripts(){
		// Scripts Third-Party
		wp_register_script( 'mphb-canjs', $this->getPluginUrl( 'vendors/canjs/can.custom.min.js' ), array( 'jquery' ), $this->getVersion(), true );
		wp_register_script( 'mphb-magnific-popup', $this->getPluginUrl( 'vendors/magnific-popup/dist/jquery.magnific-popup.min.js' ), array( 'jquery' ), $this->getVersion(), true );
		wp_register_script( 'mphb-kbwood-plugin', $this->getPluginUrl( 'vendors/kbwood/datepick/jquery.plugin.min.js' ), array( 'jquery' ), $this->getVersion(), true );
		wp_register_script( 'mphb-kbwood-datepick', $this->getPluginUrl( 'vendors/kbwood/datepick/jquery.datepick.min.js' ), array( 'jquery', 'mphb-kbwood-plugin' ), $this->getVersion(), true );
		wp_register_script( 'mphb-flexslider', $this->getPluginUrl( 'vendors/woothemes-FlexSlider/jquery.flexslider-min.js' ), array( 'jquery' ), $this->getVersion(), true );
		wp_register_script( 'mphb-jquery-serialize-json', $this->getPluginUrl( 'vendors/jquery.serializeJSON/jquery.serializejson.min.js' ), array( 'jquery' ), $this->getVersion() );

		// Sctipts
		wp_register_script( 'mphb', $this->getPluginUrl( 'assets/js/public/mphb.min.js' ), array( 'jquery', 'mphb-canjs', 'mphb-kbwood-datepick' ), $this->getVersion(), true );

		// Styles
		wp_register_style( 'mphb-kbwood-datepick-css', $this->getPluginUrl( 'vendors/kbwood/datepick/jquery.datepick.css' ), null, $this->getVersion() );
		wp_register_style( 'mphb-magnific-popup-css', $this->getPluginUrl( 'vendors/magnific-popup/dist/magnific-popup.css' ), null, $this->getVersion() );

		$useFixedFlexslider = apply_filters( 'mphb_use_fixed_flexslider_css', true );
		if ( $useFixedFlexslider ) {
			wp_register_style( 'mphb-flexslider-css', $this->getPluginUrl( 'assets/css/flexslider-fixed.css' ), null, $this->getVersion() );
		} else {
			wp_register_style( 'mphb-flexslider-css', $this->getPluginUrl( 'vendors/woothemes-FlexSlider/flexslider.css' ), null, $this->getVersion() );
		}

		wp_register_style( 'mphb', $this->getPluginUrl( 'assets/css/mphb.min.css', null, $this->getVersion() ) );
	}

	public function enqueuePublicScripts(){
		if ( is_singular( $this->postTypes()->roomType()->getPostType() ) ) {
			$this->getPublicScriptManager()->enqueue();
		}

		if ( get_the_ID() == $this->settings->pages()->getCheckoutPageId() ) {
			$this->getPublicScriptManager()->enqueue();
		}
	}

	public function registerAdminScripts(){
		// Scripts

		wp_register_script( 'mphb-canjs', $this->getPluginUrl( 'vendors/canjs/can.custom.min.js' ), array(
			'jquery' ), $this->getVersion(), true );
		// @todo if possible concat kbwood scripts
		wp_register_script( 'mphb-kbwood-plugin', $this->getPluginUrl( 'vendors/kbwood/datepick/jquery.plugin.min.js' ), array(
			'jquery' ), $this->getVersion(), true );
		wp_register_script( 'mphb-kbwood-datepick', $this->getPluginUrl( 'vendors/kbwood/datepick/jquery.datepick.min.js' ), array(
			'jquery', 'mphb-kbwood-plugin' ), $this->getVersion(), true );
		wp_register_script( 'mphb-jquery-serialize-json', $this->getPluginUrl( 'vendors/jquery.serializeJSON/jquery.serializejson.min.js' ), array(
			'jquery' ), $this->getVersion() );
		wp_register_script( 'mphb-bgrins-spectrum', $this->getPluginUrl( 'vendors/bgrins-spectrum/build/spectrum-min.js' ), array(
			'jquery' ), $this->getVersion(), true );


		wp_register_script( 'mphb-admin', $this->getPluginUrl() . 'assets/js/admin/admin.min.js', array(
			'jquery', 'mphb-kbwood-datepick', 'mphb-canjs', 'mphb-bgrins-spectrum' ), $this->getVersion(), true );

		// Styles
		wp_register_style( 'mphb-kbwood-datepick-css', $this->getPluginUrl( 'vendors/kbwood/datepick/jquery.datepick.css' ), null, $this->getVersion() );
		wp_register_style( 'mphb-bgrins-spectrum', $this->getPluginUrl( 'vendors/bgrins-spectrum/build/spectrum_theme.css' ), null, $this->getVersion() );
		wp_register_style( 'mphb-admin-css', $this->getPluginUrl( 'assets/css/admin.min.css' ), array(
			'mphb-kbwood-datepick-css', 'mphb-bgrins-spectrum' ), $this->getVersion() );
	}

	public function loadTextDomain(){
		load_plugin_textdomain( $this->slug, false, $this->slug . '/languages' );
	}

	public function getPrefix(){
		return $this->prefix;
	}

	public function addPrefix( $str, $separator = '-' ){
		return $this->getPrefix() . $separator . $str;
	}

	public function getSlug(){
		return $this->slug;
	}

	public function getPluginDir(){
		return $this->pluginDir;
	}

	/**
	 * Retrieve full path for the relative to plugin root path.
	 *
	 * @param string $relativePath
	 * @return string
	 */
	public function getPluginPath( $relativePath = '' ){
		return $this->getPluginDir() . $relativePath;
	}

	public function getPluginUrl( $relativePath = '' ){
		return $this->pluginDirUrl . $relativePath;
	}

	public function getAjaxUrl(){
		return admin_url( 'admin-ajax.php' );
	}

	public function getVersion(){
		return $this->version;
	}

	public function getMainMenuSlug(){
		return $this->mainMenuSlug;
	}

	/**
	 * @note available after 'admin_menu' 10 priority
	 * @return string
	 */
	public function getMainMenuCapability(){
		return $this->mainMenuCapability;
	}

	/**
	 * Retrieve Url of Motopress Hotel Booking Settings Page
	 *
	 * @return string Url
	 */
	public function getSettingsPageUrl(){
		return admin_url( 'admin.php?page=' . $this->settingsMenuPage->getName() );
	}

	public function createMenu(){
		$this->mainMenuCapability	 = apply_filters( 'mphb_main_menu_capability', 'read' );
		$mainMenuPosition			 = apply_filters( 'mphb_main_menu_position', '57.5' );

		$this->mainMenuPage = add_menu_page( __( 'Bookings', $this->slug )
			, __( 'Bookings', $this->slug )
			, $this->mainMenuCapability
			, $this->mainMenuSlug
			, array( $this, 'renderMainMenuPage' )
			, 'dashicons-calendar-alt'
			, $mainMenuPosition
		);
	}

	public function renderMainMenuPage(){
		// This will not shown because replaced by bookings cpt submenu
	}

	/**
	 *
	 * @return \MPHB\Settings\SettingsRegistry
	 */
	public function settings(){
		return $this->settings;
	}

	/**
	 *
	 * @return \MPHB\UserActions\UserActions
	 */
	public function userActions(){
		return $this->userActions;
	}

	/**
	 *
	 * @return \MPHB\Crons\BookingAbandonCron
	 */
	public function getBookingAbandonCron(){
		return $this->bookingAbandonCron;
	}

	/**
	 * @return \MPHB\Session
	 */
	public function getSession(){
		return $this->session;
	}

	/**
	 * Retrieve relative to theme root path to templates.
	 *
	 * @return string
	 */
	public function getTemplatePath(){
		return apply_filters( 'mphb_template_path', 'hotel-booking/' );
	}

	/**
	 *
	 * @param \WP_Post|int $post
	 */
	public function setCurrentRoomType( $post ){
		$this->currentRoomType = null;

		if ( is_int( $post ) ) {
			$post = get_post( $post );
		}

		if ( !empty( $post->post_type ) && $post->post_type === MPHB()->postTypes()->roomType()->getPostType() ) {
			$this->currentRoomType = new \MPHB\Entities\RoomType( $post );
		}
	}

	/**
	 *
	 * @return \MPHB\Entities\RoomType
	 */
	public function getCurrentRoomType(){
		return $this->currentRoomType;
	}

	/**
	 *
	 * @return \MPHB\CustomPostTypes
	 */
	public function postTypes(){
		return $this->postTypes;
	}

	/**
	 *
	 * @return \MPHB\Shortcodes
	 */
	public function getShortcodes(){
		return $this->shortcodes;
	}

	/**
	 *
	 * @return \MPHB\Ajax
	 */
	public function getAjax(){
		return $this->ajax;
	}

	/**
	 *
	 * @return \MPHB\Admin\MenuPages\SettingsMenuPage
	 */
	public function getSettingsMenuPage(){
		return $this->settingsMenuPage;
	}

	/**
	 *
	 * @return \MPHB\Admin\MenuPages\ShortcodesMenuPage
	 */
	public function getShortcodesMenuPage(){
		return $this->shortcodesMenuPage;
	}

	/**
	 *
	 * @return \MPHB\Admin\MenuPages\RoomsGeneratorMenuPage
	 */
	public function getRoomsGeneratorMenuPage(){
		return $this->roomsGeneratorMenuPage;
	}

	/**
	 *
	 * @return \MPHB\Admin\MenuPages\CalendarMenuPage
	 */
	public function getCalendarMenuPage(){
		return $this->calendarMenuPage;
	}

	/**
	 *
	 * @return \MPHB\Importer
	 */
	public function getImporter(){
		return $this->importer;
	}

	/**
	 *
	 * @return \MPHB\UserActions
	 */
	public function getUserActions(){
		return $this->userActions;
	}

	/**
	 *
	 * @return \MPHB\ScriptManagers\PublicScriptManager
	 */
	public function getPublicScriptManager(){
		return $this->publicScriptManager;
	}

	/**
	 *
	 * @return \MPHB\ScriptManagers\AdminScriptManager
	 */
	public function getAdminScriptManager(){
		return $this->adminScriptManager;
	}

	/**
	 *
	 * @return \MPHB\Emails\Emails
	 */
	public function emails(){
		return $this->emails;
	}

	/**
	 *
	 * @return \MPHB\SearchParametersStorage
	 */
	public function searchParametersStorage(){
		return $this->searchParametersStorage;
	}

	/**
	 *
	 * @param string $version version to compare with wp version
	 * @param string $operator Optional. Possible operators are: <, lt, <=, le, >, gt, >=, ge, ==, =, eq, !=, <>, ne respectively. Default =.
	  This parameter is case-sensitive, values should be lowercase.
	 * @return bool
	 */
	public function isWPVersion( $version, $operator = '=' ){
		global $wp_version;
		return version_compare( $wp_version, $version, $operator );
	}

	static public function activate(){
		MPHB()->postTypes()->roomType()->register();
		MPHB()->postTypes()->service()->register();
		MPHB()->postTypes()->booking()->register();
		flush_rewrite_rules();
	}

	static public function deactivate(){
		flush_rewrite_rules();
	}

	/**
	 *
	 * @return \MPHB\Persistences\RoomTypePersistence
	 */
	public function getRoomTypePersistence(){
		return $this->roomTypePersistence;
	}

	/**
	 *
	 * @return \MPHB\Persistences\RoomPersistence
	 */
	public function getRoomPersistence(){
		return $this->roomPersistence;
	}

	/**
	 *
	 * @return MPHB\Persistences\RatePersistence
	 */
	public function getRatePersistence(){
		return $this->ratePersistence;
	}

	/**
	 *
	 * @return MPHB\Persistences\BookingPersistence
	 */
	public function getBookingPersistence(){
		return $this->bookingPersistence;
	}

	/**
	 *
	 * @return \MPHB\Persistences\CPTPersistence
	 */
	public function getServicePersistence(){
		return $this->servicePersistence;
	}

	/**
	 *
	 * @return \MPHB\Persistences\CPTPersistence
	 */
	public function getSeasonPersistence(){
		return $this->seasonPersistence;
	}

	/**
	 *
	 * @return \MPHB\Repositories\RoomTypeRepository
	 */
	public function getRoomTypeRepository(){
		return $this->roomTypeRepository;
	}

	/**
	 *
	 * @return \MPHB\Repositories\RoomRepository
	 */
	public function getRoomRepository(){
		return $this->roomRepository;
	}

	/**
	 *
	 * @return \MPHB\Repositories\RateRepository
	 */
	public function getRateRepository(){
		return $this->rateRepository;
	}

	/**
	 *
	 * @return \MPHB\Repositories\BookingRepository
	 */
	public function getBookingRepository(){
		return $this->bookingRepository;
	}

	/**
	 *
	 * @return \MPHB\Repositories\ServiceRepository
	 */
	public function getServiceRepository(){
		return $this->serviceRepository;
	}

	/**
	 *
	 * @return \MPHB\Repositories\SeasonRepository
	 */
	public function getSeasonRepository(){
		return $this->seasonRepository;
	}

	/**
	 *
	 * @return array
	 */
	public function getPluginData(){
		require_once ABSPATH . 'wp-admin/includes/plugin.php';
		return get_plugin_data( self::$_pluginFile, false, false );
	}

	public function initAutoUpdater(){

		if ( $this->settings->license()->isEnabled() ) {

			$pluginData = $this->getPluginData();

			$apiData = array(
				'version'	 => $this->getVersion(),
				'license'	 => MPHB()->settings()->license()->getLicenseKey(),
				'item_name'	 => MPHB()->settings()->license()->getProductName(),
				'author'	 => isset( $pluginData['Author'] ) ? $pluginData['Author'] : ''
			);

			new MPHB\Library\EDD_Plugin_Updater\EDD_Plugin_Updater( MPHB()->settings()->license()->getStoreUrl(), self::$_pluginFile, $apiData );
			//new MPHB\LicenseNotice();
		}
	}

}

register_activation_hook( __FILE__, array( 'HotelBookingPlugin', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'HotelBookingPlugin', 'deactivate' ) );
HotelBookingPlugin::getInstance();

/**
 *
 * @return \HotelBookingPlugin
 */
function MPHB(){
	return HotelBookingPlugin::getInstance();
}
