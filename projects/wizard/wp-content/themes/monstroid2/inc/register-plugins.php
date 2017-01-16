<?php
/**
 * Register required plugins for TGM Plugin Activator
 *
 * @package Monstroid2
 */
add_action( 'tgmpa_register', 'monstroid2_register_required_plugins' );
/**
 * Register the required plugins for this theme.
 *
 * In this example, we register five plugins:
 * - one included with the TGMPA library
 * - two from an external source, one from an arbitrary source, one from a GitHub repository
 * - two from the .org repo, where one demonstrates the use of the `is_callable` argument
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function monstroid2_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		array(
			'name'   => esc_html__( 'Cherry Live Demo Mods Switcher', 'monstroid2' ),
			'slug'   => 'cherry-ld-mods-switcher',
			'source' => MONSTROID2_THEME_DIR . '/assets/includes/plugins/cherry-ld-mods-switcher.zip',
		),
		array(
			'name' => esc_html__( 'Cherry Project', 'monstroid2' ),
			'slug' => 'cherry-projects',
		),
		array(
			'name' => esc_html__( 'Cherry Team Members', 'monstroid2' ),
			'slug' => 'cherry-team-members',
		),
		array(
			'name' => esc_html__( 'Cherry Testimonials', 'monstroid2' ),
			'slug' => 'cherry-testi',
		),
		array(
			'name' => esc_html__( 'Cherry Services List', 'monstroid2' ),
			'slug' => 'cherry-services-list',
		),
		array(
			'name' => esc_html__( 'Cherry Sidebars', 'monstroid2' ),
			'slug' => 'cherry-sidebars',
		),
		array(
			'name'   => esc_html__( 'Power Builder', 'monstroid2' ),
			'slug'   => 'power-builder',
			'source' => MONSTROID2_THEME_DIR . '/assets/includes/plugins/power-builder.zip',
		),
		array(
			'name'         => esc_html__( 'Power Builder Integrator', 'monstroid2' ),
			'slug'         => 'power-builder-integrator',
			'source'       => 'https://github.com/templatemonster/power-builder-integrator/archive/master.zip',
			'external_url' => 'https://github.com/templatemonster/power-builder-integrator',
		),
		array(
			'name'   => esc_html__( 'TM Mega Menu', 'monstroid2' ),
			'slug'   => 'tm-mega-menu',
			'source' => MONSTROID2_THEME_DIR . '/assets/includes/plugins/tm-mega-menu.zip',
		),
		array(
			'name'   => esc_html__( 'TM Style Switcher', 'monstroid2' ),
			'slug'   => 'tm-style-switcher',
			'source' => MONSTROID2_THEME_DIR . '/assets/includes/plugins/tm-style-switcher.zip',
		),
		array(
			'name' => esc_html__( 'TM Timeline', 'monstroid2' ),
			'slug' => 'tm-timeline',
		),
		array(
			'name' => esc_html__( 'bbPress', 'monstroid2' ),
			'slug' => 'bbpress',
		),
		array(
			'name' => esc_html__( 'BuddyPress', 'monstroid2' ),
			'slug' => 'buddypress',
		),
		array(
			'name'   => esc_html__( 'Booked Appointments', 'monstroid2' ),
			'slug'   => 'booked',
			'source' => MONSTROID2_THEME_DIR . '/assets/includes/plugins/booked.zip',
		),
		array(
			'name' => esc_html__( 'Contact Form 7', 'monstroid2' ),
			'slug' => 'contact-form-7',
		),
		array(
			'name'   => esc_html__( 'Hotel Booking by MotoPress', 'monstroid2' ),
			'slug'   => 'motopress-hotel-booking',
			'source' => MONSTROID2_THEME_DIR . '/assets/includes/plugins/motopress-hotel-booking-1.0.0.zip',
			'version'=> '1.0.0',
		),
		array(
			'name'         => esc_html__( 'Moto Tools Integration', 'monstroid2' ),
			'slug'         => 'moto-tools-integration',
			'source'       => 'https://github.com/templatemonster/moto-tools-integration/archive/master.zip',
			'external_url' => 'https://github.com/templatemonster/moto-tools-integration',
		),
		array(
			'name' => esc_html__( 'Restaurant Menu by MotoPress', 'monstroid2' ),
			'slug' => 'mp-restaurant-menu',
		),
		array(
			'name' => esc_html__( 'The Events Calendar', 'monstroid2' ),
			'slug' => 'the-events-calendar',
		),
		array(
			'name' => esc_html__( 'Timetable and Event Schedule', 'monstroid2' ),
			'slug' => 'mp-timetable',
		),
		array(
			'name' => esc_html__( 'Woocommerce', 'monstroid2' ),
			'slug' => 'woocommerce',
		),
		array(
			'name'   => esc_html__( 'TM Woocommerce Ajax Filters', 'monstroid2' ),
			'slug'   => 'tm-woocommerce-ajax-filters',
			'source' => MONSTROID2_THEME_DIR . '/assets/includes/plugins/tm-woocommerce-ajax-filters.zip',
		),
		array(
			'name' => esc_html__( 'TM Woocommerce Compare Wishlist', 'monstroid2' ),
			'slug' => 'tm-woocommerce-compare-wishlist',
		),
		array(
			'name' => esc_html__( 'TM Woocommerce Package', 'monstroid2' ),
			'slug' => 'tm-woocommerce-package',
		),
		array(
			'name' => esc_html__( 'WooCommerce Currency Switcher', 'monstroid2' ),
			'slug' => 'woocommerce-currency-switcher',
		),
		array(
			'name' => esc_html__( 'Woocommerce Social Media Share Buttons', 'monstroid2' ),
			'slug' => 'woocommerce-social-media-share-buttons',
		),
	);

	/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
	$config = array(
		'id'           => 'monstroid2',            // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => true,                    // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );
}
