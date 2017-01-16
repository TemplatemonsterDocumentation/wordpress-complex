<?php
/**
 * Default manifest file
 *
 * @var array
 */
$settings = array(
	'xml' => array(
		'use_upload' => false,
		'path'       => array(
			'default'      => get_template_directory() . '/assets/xml/sample-data-monstroid2-default.xml',
			'construction' => get_template_directory() . '/assets/xml/sample-data-monstroid2-construction.xml',
			'fashion'      => get_template_directory() . '/assets/xml/sample-data-monstroid2-fashion.xml',
			'furniture'    => get_template_directory() . '/assets/xml/sample-data-monstroid2-furniture.xml',
		),
	),
	'advanced_import' => array(
		'default' => array(
			'label'    => esc_html__( 'Default', 'monstroid2' ),
			'full'     => get_template_directory() . '/assets/demo-content/default/default-full.xml',
			'lite'     => get_template_directory() . '/assets/demo-content/default/default-min.xml',
			'thumb'    => get_template_directory_uri() . '/assets/demo-content/default/default-thumb.png',
			'demo_url' => 'http://ld-wp.template-help.com/monstroid2-default',
			'plugins'  => array(
				'booked'               => 'Booked Appointments',
				'buddypress'           => 'BuddyPress',
				'cherry-projects'      => 'Cherry Projects',
				'cherry-services-list' => 'Cherry Services List',
			),
		),
		'skin-1' => array(
			'label'    => esc_html__( 'Construction', 'monstroid2' ),
			'full'     => get_template_directory() . '/assets/demo-content/skin-1/skin-1-full.xml',
			'lite'      => get_template_directory() . '/assets/demo-content/skin-1/skin-1-min.xml',
			'thumb'    => get_template_directory_uri() . '/assets/demo-content/skin-1/skin-1-thumb.png',
			'demo_url' => 'http://ld-wp.template-help.com/monstroid2-construction',
			'plugins'  => array(
				'booked'               => 'Booked Appointments',
				'buddypress'           => 'BuddyPress',
				'cherry-projects'      => 'Cherry Projects',
				'cherry-services-list' => 'Cherry Services List',
			),
		),
		'skin-2' => array(
			'label'    => esc_html__( 'Furniture', 'monstroid2' ),
			'full'     => get_template_directory() . '/assets/demo-content/skin-2/skin-2-full.xml',
			'lite'      => get_template_directory() . '/assets/demo-content/skin-2/skin-2-min.xml',
			'thumb'    => get_template_directory_uri() . '/assets/demo-content/skin-2/skin-2-thumb.png',
			'demo_url' => 'http://ld-wp.template-help.com/monstroid2-fashion',
			'plugins'  => array(
				'booked'               => 'Booked Appointments',
				'buddypress'           => 'BuddyPress',
				'cherry-projects'      => 'Cherry Projects',
				'cherry-services-list' => 'Cherry Services List',
			),
		),
	),
	'import' => array(
		'chunk_size' => 3,
	),
	'export' => array(
		'options' => array(
			'mprm_settings',
			'bp-pages',
			'bp-active-components',
			'mp_timetable_general',
			'woocommerce_default_country',
			'woocommerce_shop_page_id',
			'woocommerce_default_catalog_orderby',
			'shop_catalog_image_size',
			'shop_single_image_size',
			'shop_thumbnail_image_size',
			'woocommerce_cart_page_id',
			'woocommerce_checkout_page_id',
			'woocommerce_terms_page_id',
			'tm_woowishlist_page',
			'tm_woocompare_page',
			'tm_woocompare_enable',
			'tm_woocompare_show_in_catalog',
			'tm_woocompare_show_in_single',
			'tm_woocompare_compare_text',
			'tm_woocompare_remove_text',
			'tm_woocompare_page_btn_text',
			'tm_woocompare_show_in_catalog',
		),
	),
);
