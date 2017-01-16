<?php
/**
 * Skin9 functions, hooks and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Monstroid2
 */

// Add skin services listing template.
add_filter( 'cherry_services_listing_templates_list', 'monstroid2_skin9_cherry_services_listing_templates_list' );

// Add skin services single template.
add_filter( 'cherry_services_single_templates_list', 'monstroid2_skin9_cherry_services_single_templates_list' );

// Add skin cherry-team single template.
add_filter( 'cherry_team_templates_list', 'monstroid2_skin9_cherry_team_templates_list' );

/**
 * Add skin services listing template.
 *
 * @param array $tmpl_list Templates list.
 *
 * @return array
 */
function monstroid2_skin9_cherry_services_listing_templates_list( $tmpl_list ) {

	$tmpl_list['counter-lawyer'] = 'counter-skin9.tmpl';

	return $tmpl_list;
}

/**
 * Add skin services single template.
 *
 * @param array $tmpl_list Templates list.
 *
 * @return array
 */
function monstroid2_skin9_cherry_services_single_templates_list( $tmpl_list ) {

	$tmpl_list['single-lawyer'] = 'single-skin9.tmpl';

	return $tmpl_list;
}

/**
 * Add skin cherry-team single template.
 *
 * @param array $tmpl_list Templates list.
 *
 * @return array
 */
function monstroid2_skin9_cherry_team_templates_list( $tmpl_list ) {
	$tmpl_list['lawyer-single'] = 'lawyer-single.tmpl';

	return $tmpl_list;
}
