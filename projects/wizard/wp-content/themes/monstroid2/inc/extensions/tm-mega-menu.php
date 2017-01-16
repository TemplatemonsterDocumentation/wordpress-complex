<?php
/**
 * Extends basic functionality for better TM Mega Menu compatibility
 *
 * @package Monstroid2
 */

/**
 * Check if Mega Menu plugin is activated.
 *
 * @return bool
 */
function monstroid2_is_mega_menu_active() {
	return class_exists( 'tm_mega_menu' );
}

add_filter( 'monstroid2_theme_script_variables', 'monstroid2_pass_mega_menu_vars' );

/**
 * Pass Mega Menu variables.
 *
 * @param  array  $vars Variables array.
 * @return array
 */
function monstroid2_pass_mega_menu_vars( $vars = array() ) {

	if ( ! monstroid2_is_mega_menu_active() ) {
		return $vars;
	}

	$vars['megaMenu'] = array(
		'isActive' => true,
		'location' => get_option( 'tm-mega-menu-location' ),
	);

	return $vars;
}
