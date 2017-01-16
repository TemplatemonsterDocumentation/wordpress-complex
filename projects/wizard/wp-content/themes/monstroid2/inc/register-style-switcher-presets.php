<?php
/**
 * Register presets for TM Style Switcher
 *
 * @package Monstroid2
 */
if ( function_exists( 'tmss_register_preset' ) ) {

	tmss_register_preset(
		'skin1',
		esc_html__( 'Construction', 'monstroid2' ),
		get_stylesheet_directory_uri() . '/tm-style-switcher-pressets/skin1.png',
		get_stylesheet_directory() . '/tm-style-switcher-pressets/skin1.json'
	);

	tmss_register_preset(
		'skin2',
		esc_html__( 'Fashion', 'monstroid2' ),
		get_stylesheet_directory_uri() . '/tm-style-switcher-pressets/skin2.png',
		get_stylesheet_directory() . '/tm-style-switcher-pressets/skin2.json'
	);

	tmss_register_preset(
		'skin3',
		esc_html__( 'Furniture', 'monstroid2' ),
		get_stylesheet_directory_uri() . '/tm-style-switcher-pressets/skin3.png',
		get_stylesheet_directory() . '/tm-style-switcher-pressets/skin3.json'
	);

	tmss_register_preset(
		'skin4',
		esc_html__( 'Ironmass', 'monstroid2' ),
		get_stylesheet_directory_uri() . '/tm-style-switcher-pressets/skin4.png',
		get_stylesheet_directory() . '/tm-style-switcher-pressets/skin4.json'
	);

	tmss_register_preset(
		'skin5',
		esc_html__( 'Modern', 'monstroid2' ),
		get_stylesheet_directory_uri() . '/tm-style-switcher-pressets/skin5.png',
		get_stylesheet_directory() . '/tm-style-switcher-pressets/skin5.json'
	);

	tmss_register_preset(
		'skin6',
		esc_html__( 'Resto', 'monstroid2' ),
		get_stylesheet_directory_uri() . '/tm-style-switcher-pressets/skin6.png',
		get_stylesheet_directory() . '/tm-style-switcher-pressets/skin6.json'
	);

	tmss_register_preset(
		'skin7',
		esc_html__( 'LoanOffer', 'monstroid2' ),
		get_stylesheet_directory_uri() . '/tm-style-switcher-pressets/skin7.png',
		get_stylesheet_directory() . '/tm-style-switcher-pressets/skin7.json'
	);

	tmss_register_preset(
		'skin8',
		esc_html__( 'Corporate', 'monstroid2' ),
		get_stylesheet_directory_uri() . '/tm-style-switcher-pressets/skin8.png',
		get_stylesheet_directory() . '/tm-style-switcher-pressets/skin8.json'
	);

	tmss_register_preset(
		'skin9',
		esc_html__( 'Lawyer', 'monstroid2' ),
		get_stylesheet_directory_uri() . '/tm-style-switcher-pressets/skin9.png',
		get_stylesheet_directory() . '/tm-style-switcher-pressets/skin9.json'
	);
}
