<?php

/* Set skin5 dir */
define( 'MONSTROID2_SKIN5_DIR', trailingslashit( MONSTROID2_THEME_DIR ) . 'skins/skin5' );
define( 'MONSTROID2_SKIN5_JS',  trailingslashit( MONSTROID2_THEME_URI ) . 'skins/skin5/assets/js' );
define( 'MONSTROID2_SKIN5_CSS', trailingslashit( MONSTROID2_THEME_URI ) . 'skins/skin5/assets/css' );

/* Include motobooking hooks */
if ( class_exists( 'HotelBookingPlugin' ) ) {
	require_once trailingslashit( MONSTROID2_SKIN5_DIR ) . 'inc/moto-booking-hooks.php';
}
if ( class_exists( 'MP_Restaurant_Menu_Setup_Plugin' ) ) {
	require_once trailingslashit( MONSTROID2_SKIN5_DIR ) . 'inc/moto-restaurant-hooks.php';
}

/* Register image sizes */
add_action( 'after_setup_theme', 'monstroid2_skin5_register_image_sizes', 11 );

function monstroid2_skin5_register_image_sizes() {
	add_image_size( 'monstroid2-thumb-xl-2', 1920, 820, true );
}

/* Register public assets */
add_action( 'wp_enqueue_scripts', 'monstroid2_skin5_register_assets' );
add_action( 'wp_enqueue_scripts', 'monstroid2_skin5_enqueue_assets' );

function monstroid2_skin5_register_assets() {
	wp_register_script( 'formstyler', MONSTROID2_SKIN5_JS . '/min/jquery.formstyler.min.js', array( 'jquery' ), '1.7.6', true );

	wp_register_style( 'formstyler', MONSTROID2_SKIN5_CSS . '/jquery.formstyler.css', array(), '1.7.6' );
}

function monstroid2_skin5_enqueue_assets() {
	if ( class_exists( 'HotelBookingPlugin' ) ) {
		$depends = apply_filters( 'monstroid2_skin5_mphb_script_depends', array( 'cherry-js-core', 'formstyler' ) );

		wp_enqueue_script( 'monstroid2-skin5-mphb-script', MONSTROID2_SKIN5_JS . '/skin5-mphb-scripts.js', $depends, MONSTROID2_THEME_VERSION, true );

		wp_enqueue_style( 'formstyler' );

		$months = apply_filters( 'monstroid2_skin5_months_labels', array(
			1  => esc_html__( 'Jan', 'monstroid2' ),
			2  => esc_html__( 'Feb', 'monstroid2' ),
			3  => esc_html__( 'Mar', 'monstroid2' ),
			4  => esc_html__( 'Apr', 'monstroid2' ),
			5  => esc_html__( 'May', 'monstroid2' ),
			6  => esc_html__( 'Jun', 'monstroid2' ),
			7  => esc_html__( 'Jul', 'monstroid2' ),
			8  => esc_html__( 'Aug', 'monstroid2' ),
			9  => esc_html__( 'Sep', 'monstroid2' ),
			10 => esc_html__( 'Oct', 'monstroid2' ),
			11 => esc_html__( 'Nov', 'monstroid2' ),
			12 => esc_html__( 'Dec', 'monstroid2' ),
		) );

		wp_localize_script( 'monstroid2-skin5-mphb-script', 'monstroid2_skin5_mphb', apply_filters(
			'monstroid2_skin5_mphb_script_variables',
			array(
				'months' => $months,
			) ) );
	}
}

/* Filters & hooks */

/**
 * Add superscript & subscript to tinymce
 *
 * @return array
 */
add_filter( 'mce_buttons_2', 'monstroid2_skin5_mce_buttons_2' );

function monstroid2_skin5_mce_buttons_2($buttons) {
	$buttons[] = 'superscript';
	$buttons[] = 'subscript';

	return $buttons;
}

/**
 * Add dynamic function for font-weight diffs
 *
 * @return array
 */
add_filter( 'cherry_css_func_list', 'monstroid2_skin5_cherry_css_func_list' );

function monstroid2_skin5_cherry_css_func_list( $func_list ) {
	$func_list['font_weight_diff'] = 'monstroid2_skin5_font_weight_difference_logic';

	return $func_list;
}

function monstroid2_skin5_font_weight_difference_logic( $font_weight ) {

	if ( ! $font_weight ) {
		return false;
	}

	if ( $font_weight >= '600' ) {
		return 'font-weight: normal;';
	} else {
		return 'font-weight: bold;';
	}

}

/**
 * Change post template part slug
 *
 * @return string
 */
add_filter( 'monstroid2_post_template_part_slug', 'monstroid2_skin5_post_template_part_slug', 10, 2 );

function monstroid2_skin5_post_template_part_slug( $blog_post_template, $blog_layout_type ) {

	if ( 'default' !== $blog_layout_type ) {
		$blog_post_template = 'skins/skin5/template-parts/post/grid/content';
	} else {
		$blog_post_template = 'skins/skin5/template-parts/post/default/content';
	}

	return $blog_post_template;

}

/**
 * Change single template part slug
 *
 * @return string
 */
add_filter( 'monstroid2_single_post_template_part_slug', 'monstroid2_skin5_single_post_template_part_slug', 10, 2 );

function monstroid2_skin5_single_post_template_part_slug( $single_post_template, $single_post_type ) {

	if ( 'modern' === $single_post_type && is_singular( 'post' ) ) {

		$single_post_template = 'skins/skin5/template-parts/post/single/content-single-modern';

	} else if ( class_exists( 'HotelBookingPlugin' ) && 'mphb_room_type' === get_post_type() ) {

		$single_post_template = 'skins/skin5/template-parts/post/single/content-single-room';

	} else {

		$single_post_template = 'skins/skin5/template-parts/post/single/content-single';

	}

	return $single_post_template;

}

/**
 * Change posts pagination
 *
 * @return array
 */
add_filter( 'monstroid2_content_posts_pagination', 'monstroid2_skin5_posts_pagination' );

function monstroid2_skin5_posts_pagination( $pagination ) {

	$pagination = array(
		'prev_text' => '<i class="material-icons">keyboard_arrow_left</i>' . esc_html__( 'PREV', 'monstroid2' ),
		'next_text' => esc_html__( 'NEXT', 'monstroid2' ) . '<i class="material-icons">keyboard_arrow_right</i>',
	);

	return $pagination;
}

/**
 * Change breadcrumbs defaults
 *
 * @return array
 */
add_filter( 'monstroid2_breadcrumbs_settings', 'monstroid2_skin5_breadcrumbs_defaults' );

function monstroid2_skin5_breadcrumbs_defaults( $settings ) {

	$settings['separator'] = '&#124';

	return $settings;
}

/**
 * Change about widget image size
 *
 * @return string
 */
add_filter( 'monstroid2_about_widget_image_size', 'monstroid2_skin5_about_widget_image_size' );

function monstroid2_skin5_about_widget_image_size() {
	return 'post-thumbnail';
}

/**
 * Change about widget template file
 *
 * @return string
 */
add_filter( 'monstroid2_widget_about_template_file', 'monstroid2_skin5_widget_about_template_file' );

function monstroid2_skin5_widget_about_template_file() {
	return 'skins/skin5/inc/widgets/about/views/about.php';
}

/**
 * Change contact information widget icon array
 *
 * @return string
 */
add_filter( 'monstroid2_contact_information_widget_icons', 'monstroid2_skin5_contact_information_widget_icons' );

function monstroid2_skin5_contact_information_widget_icons( $icons ) {
	$icons = array(
		'icon_set'    => 'monstroid2LinearIcons',
		'icon_css'    => MONSTROID2_THEME_URI . '/assets/css/linearicons.css',
		'icon_base'   => 'linearicon',
		'icon_prefix' => 'linearicon-',
		'icons'       => monstroid2_get_linear_icons_set(),
	);

	return $icons;
}

/**
 * Change about widget template file
 *
 * @return string
 */
add_filter( 'monstroid2_contact_information_widget_template_file', 'monstroid2_skin5_contact_information_widget_template_file' );

function monstroid2_skin5_contact_information_widget_template_file() {
	return 'skins/skin5/inc/widgets/contact-information/views/contact-information-view.php';
}

/**
 * Change invert color at subscribe widget
 *
 * @return string
 */
add_filter( 'monstroid2_subscribe_widget_text_color_scheme', 'monstroid2_skin5_subscribe_widget_text_color_scheme', 12, 2 );

function monstroid2_skin5_subscribe_widget_text_color_scheme( $scheme, $type ) {
	if ( 'invert' == $type ) {
		return '%s_accent_color_3';
	}

	return $scheme;
}

/**
 * Change subscribe widget follow template file
 *
 * @return string
 */
add_filter( 'monstroid2_subscribe_widget_follow_template_file', 'monstroid2_skin5_subscribe_widget_follow_template_file' );

function monstroid2_skin5_subscribe_widget_follow_template_file() {
	return 'skins/skin5/inc/widgets/subscribe-follow/view/follow-view.php';
}

/**
 * Change subscribe widget subscribe template file
 *
 * @return string
 */
add_filter( 'monstroid2_subscribe_widget_subscribe_template_file', 'monstroid2_skin5_subscribe_widget_subscribe_template_file' );

function monstroid2_skin5_subscribe_widget_subscribe_template_file() {
	return 'skins/skin5/inc/widgets/subscribe-follow/view/subcribe-view.php';
}
