<?php
/**
 * Plugins configuration example.
 *
 * @var array
 */
$plugins = array(
	'cherry-data-importer' => array(
		'name'   => esc_html__( 'Cherry Data Importer', 'tm-wizard' ),
		'source' => 'remote', // 'local', 'remote', 'wordpress' (default).
		'path'   => 'https://github.com/CherryFramework/cherry-data-importer/archive/master.zip',
		'access' => 'base',
	),
	'cherry-ld-mods-switcher' => array(
		'name'   => esc_html__( 'Cherry Live Demo Mods Switcher', 'monstroid2' ),
		'source' => 'local',
		'path'   => MONSTROID2_THEME_DIR . '/assets/includes/plugins/cherry-ld-mods-switcher.zip',
		'access' => 'base',
	),
	'cherry-projects' => array(
		'name'   => esc_html__( 'Cherry Projects', 'monstroid2' ),
		'access' => 'skins',
	),
	'cherry-team-members' => array(
		'name'   => esc_html__( 'Cherry Team Members', 'monstroid2' ),
		'access' => 'skins',
	),
	'cherry-testi' => array(
		'name'   => esc_html__( 'Cherry Testimonials', 'monstroid2' ),
		'access' => 'skins',
	),
	'cherry-services-list' => array(
		'name'   => esc_html__( 'Cherry Services List', 'monstroid2' ),
		'access' => 'skins',
	),
	'cherry-sidebars' => array(
		'name'   => esc_html__( 'Cherry Sidebars', 'monstroid2' ),
		'access' => 'skins',
	),
	'power-builder' => array(
		'name'   => esc_html__( 'Power Builder', 'monstroid2' ),
		'source' => 'local',
		'path'   => MONSTROID2_THEME_DIR . '/assets/includes/plugins/power-builder.zip',
		'access' => 'skins',
	),
	'power-builder-integrator' => array(
		'name'   => esc_html__( 'Power Builder Integrator', 'monstroid2' ),
		'source' => 'remote',
		'path'   => 'https://github.com/templatemonster/power-builder-integrator/archive/master.zip',
		'access' => 'skins',
	),
	'tm-mega-menu' => array(
		'name'   => esc_html__( 'TM Mega Menu', 'monstroid2' ),
		'source' => 'local',
		'path'   => MONSTROID2_THEME_DIR . '/assets/includes/plugins/tm-mega-menu.zip',
		'access' => 'skins',
	),
	'tm-style-switcher' => array(
		'name'   => esc_html__( 'TM Style Switcher', 'monstroid2' ),
		'source' => 'local',
		'path'   => MONSTROID2_THEME_DIR . '/assets/includes/plugins/tm-style-switcher.zip',
		'access' => 'skins',
	),
	'tm-timeline' => array(
		'name'   => esc_html__( 'TM Timeline', 'monstroid2' ),
		'access' => 'skins',
	),
	'bbpress' => array(
		'name'   => esc_html__( 'bbPress', 'monstroid2' ),
		'access' => 'skins',
	),
	'buddypress' => array(
		'name'   => esc_html__( 'BuddyPress', 'monstroid2' ),
		'access' => 'skins',
	),
	'booked' => array(
		'name'   => esc_html__( 'Booked Appointments', 'monstroid2' ),
		'source' => 'local',
		'path'   => MONSTROID2_THEME_DIR . '/assets/includes/plugins/booked.zip',
		'access' => 'skins',
	),
	'contact-form-7' => array(
		'name'   => esc_html__( 'Contact Form 7', 'monstroid2' ),
		'access' => 'skins',
	),
	'motopress-hotel-booking' => array(
		'name'   => esc_html__( 'Hotel Booking by MotoPress', 'monstroid2' ),
		'source' => 'local',
		'path'   => MONSTROID2_THEME_DIR . '/assets/includes/plugins/motopress-hotel-booking-1.0.0.zip',
		'access' => 'skins',
	),
	'moto-tools-integration' => array(
		'name'   => esc_html__( 'Moto Tools Integration', 'monstroid2' ),
		'source' => 'remote',
		'path'   => 'https://github.com/templatemonster/moto-tools-integration/archive/master.zip',
		'access' => 'skins',
	),
	'mp-restaurant-menu' => array(
		'name'   => esc_html__( 'Restaurant Menu by MotoPress', 'monstroid2' ),
		'access' => 'skins',
	),
	'the-events-calendar' => array(
		'name'   => esc_html__( 'The Events Calendar', 'monstroid2' ),
		'access' => 'skins',
	),
	'mp-timetable' => array(
		'name'   => esc_html__( 'Timetable and Event Schedule', 'monstroid2' ),
		'access' => 'skins',
	),
	'woocommerce' => array(
		'name'   => esc_html__( 'Woocommerce', 'monstroid2' ),
		'access' => 'skins',
	),
	'tm-woocommerce-ajax-filters' => array(
		'name'   => esc_html__( 'TM Woocommerce Ajax Filters', 'monstroid2' ),
		'source' => 'local',
		'path'   => MONSTROID2_THEME_DIR . '/assets/includes/plugins/tm-woocommerce-ajax-filters.zip',
		'access' => 'skins',
	),
	'tm-woocommerce-compare-wishlist' => array(
		'name'   => esc_html__( 'TM Woocommerce Compare Wishlist', 'monstroid2' ),
		'access' => 'skins',
	),
	'tm-woocommerce-package' => array(
		'name'   => esc_html__( 'TM Woocommerce Package', 'monstroid2' ),
		'access' => 'skins',
	),
	'woocommerce-currency-switcher' => array(
		'name'   => esc_html__( 'WooCommerce Currency Switcher', 'monstroid2' ),
		'access' => 'skins',
	),
	'woocommerce-social-media-share-buttons' => array(
		'name'   => esc_html__( 'Woocommerce Social Media Share Buttons', 'monstroid2' ),
		'access' => 'skins',
	),
);

/**
 * Skins configuration example
 *
 * @var array
 */
$skins = array(
	'base' => array(
		'cherry-data-importer',
		'cherry-ld-mods-switcher',
	),
	'advanced' => array(
		'default' => array(
			'full'  => array(
				'cherry-projects',
				'cherry-team-members',
				'cherry-testi',
				'cherry-services-list',
				'cherry-sidebars',
				'power-builder',
				'power-builder-integrator',
				'tm-mega-menu',
				'tm-style-switcher',
				'tm-timeline',
				'bbpress',
				'buddypress',
				'booked',
				'contact-form-7',
				'motopress-hotel-booking',
				'moto-tools-integration',
				'mp-restaurant-menu',
				'the-events-calendar',
				'mp-timetable',
				'woocommerce',
				'tm-woocommerce-ajax-filters',
				'tm-woocommerce-compare-wishlist',
				'tm-woocommerce-package',
				'woocommerce-currency-switcher',
				'woocommerce-social-media-share-buttons',
			),
			'lite'  => array(
				'cherry-projects',
				'cherry-team-members',
				'cherry-testi',
				'cherry-services-list',
				'cherry-sidebars',
				'power-builder',
				'power-builder-integrator',
				'tm-mega-menu',
			),
			'demo'  => 'https://templatemonster.com',
			'thumb' => get_template_directory_uri() . '/assets/demo-content/default/default-thumb.png',
			'name'  => esc_html__( 'Default', 'tm-wizard' ),
		),
		'skin-1' => array(
			'full'  => array(
				'cherry-projects',
				'cherry-team-members',
				'cherry-testi',
				'cherry-services-list',
				'cherry-sidebars',
				'power-builder',
				'power-builder-integrator',
				'tm-mega-menu',
				'booked',
				'contact-form-7',
			),
			'lite'  => array(
				'cherry-projects',
				'cherry-team-members',
				'cherry-testi',
				'cherry-services-list',
				'cherry-sidebars',
				'power-builder',
				'power-builder-integrator',
				'tm-mega-menu',
			),
			'demo'  => 'https://templatemonster.com',
			'thumb' => get_template_directory_uri() . '/assets/demo-content/skin-1/skin-1-thumb.png',
			'name'  => esc_html__( 'Construction', 'tm-wizard' ),
		),
	),
);
