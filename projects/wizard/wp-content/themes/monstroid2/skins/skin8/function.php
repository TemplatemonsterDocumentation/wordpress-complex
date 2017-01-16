<?php

// Add new services list template
add_filter( 'cherry_services_listing_templates_list', 'monstroid2_skin8_cherry_services_listing_templates_list' );

// Add new team list template
add_filter( 'cherry_team_templates_list', 'monstroid2_skin8_cherry_team_templates_list' );


// Change breadcrumbs separator
add_filter( 'cherry_breadcrumb_args', 'monstroid2_skin8_breadcrumbs_settings' );

//Add Read More button to module posts layout-3
add_filter( 'monstroid2_module_post_btn_settings_layout_3', 'monstroid2_skin8_module_post_btn_settings_layout_3' );

/**
 * Add new services list template
 */

function monstroid2_skin8_cherry_services_listing_templates_list( $tmpl ) {

	$tmpl['media-icon-skin8'] = 'media-icon-skin8.tmpl';

	return $tmpl;
}

/**
 * Add new team list template
 */

function monstroid2_skin8_cherry_team_templates_list( $tmpl ) {

	$tmpl['corporate'] = 'default_skin8.tmpl';

	return $tmpl;
}

/**
 * Change breadcrumbs separator
 */
function monstroid2_skin8_breadcrumbs_settings( $args ) {
	$args['separator'] = ' | ';

	return $args;
}

/**
 * Add Read More button to module posts layout-3
 */
function monstroid2_skin8_module_post_btn_settings_layout_3( $args ) {
	$args['visible'] = true;
	$args['icon'] = '<i class="linearicon linearicon-chevron-right"></i>';
	return $args;
}