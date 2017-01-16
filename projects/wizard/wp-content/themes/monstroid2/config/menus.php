<?php
/**
 * Menus configuration.
 *
 * @package Monstroid2
 */

add_action( 'after_setup_theme', 'monstroid2_register_menus', 5 );
/**
 * Register menus.
 */
function monstroid2_register_menus() {

	register_nav_menus( array(
		'top'          => esc_html__( 'Top', 'monstroid2' ),
		'main'         => esc_html__( 'Main', 'monstroid2' ),
		'main_landing' => esc_html__( 'Landing Main', 'monstroid2' ),
		'footer'       => esc_html__( 'Footer', 'monstroid2' ),
		'social'       => esc_html__( 'Social', 'monstroid2' ),
	) );
}
