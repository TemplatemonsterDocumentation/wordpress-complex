<?php
/**
 * Menu Template Functions.
 *
 * @package Monstroid2
 */

/**
 * Get main menu.
 *
 * @since  1.0.0
 * @return string
 */
function monstroid2_get_main_menu() {
	$args = apply_filters( 'monstroid2_main_menu_args', array(
		'theme_location'   => 'main',
		'container'        => '',
		'menu_id'          => 'main-menu',
		'echo'             => false,
		'fallback_cb'      => 'monstroid2_set_nav_menu',
		'fallback_message' => esc_html__( 'Set main menu', 'monstroid2' ),
	) );

	return wp_nav_menu( $args );
}

/**
 * Show main menu.
 * 
 * @since  1.0.0
 * @return void
 */
function monstroid2_main_menu() {

	$main_menu = monstroid2_get_main_menu();

	printf( '<nav id="site-navigation" class="main-navigation" role="navigation">%s</nav>', $main_menu );
}

/**
 * Show vertical main menu.
 *
 * @param string $slide Slide type: left or right.
 * @param array  $args  Arguments.
 *
 * @since  1.0.0
 * @return void
 */
function monstroid2_vertical_main_menu( $slide = 'left', $args = array() ) {

	$default_args = apply_filters( 'monstroid2_vertical_menu_args', array(
		'container-class'         => 'vertical-menu',
		'navigation-buttons-html' => '<div class="main-navigation-buttons"><span class="navigation-button back hide">%1$s</span><span class="navigation-button close">%2$s</span></div>',
		'button-back-inner-html'  => '<i class="linearicon linearicon-chevron-left"></i><span class="navigation-button__text">' . esc_html__( 'Back', 'monstroid2' ) . '</span>',
		'button-close-inner-html' => '<i class="linearicon linearicon-cross"></i>',
	) );

	$args        = wp_parse_args( $args, $default_args );
	$menu        = monstroid2_get_main_menu();
	$slide_class = sprintf( 'slide--%s', sanitize_html_class( $slide ) );
	$nav_btns = sprintf( $args['navigation-buttons-html'], $args['button-back-inner-html'], $args['button-close-inner-html'] );

	printf( '<nav id="site-navigation" class="main-navigation %1$s %2$s" role="navigation">%3$s%4$s</nav>', $args['container-class'], $slide_class, $nav_btns, $menu  );
}

/**
 * Show footer menu.
 *
 * @since  1.0.0
 * @return void
 */
function monstroid2_footer_menu() {
	if ( ! get_theme_mod( 'footer_menu_visibility', monstroid2_theme()->customizer->get_default( 'footer_menu_visibility' ) ) ) {
		return;
	}

	$args = apply_filters( 'monstroid2_footer_menu_args', array(
		'theme_location'   => 'footer',
		'container'        => '',
		'menu_id'          => 'footer-menu-items',
		'menu_class'       => 'footer-menu__items',
		'depth'            => 1,
		'echo'             => false,
		'fallback_cb'      => 'monstroid2_set_nav_menu',
		'fallback_message' => esc_html__( 'Set footer menu', 'monstroid2' ),
	) );

	printf('<nav id="footer-navigation" class="footer-menu" role="navigation">%s</nav><!-- #footer-navigation -->', wp_nav_menu( $args ) );
}

/**
 * Show top page menu if active.
 *
 * @since  1.0.0
 * @return void
 */
function monstroid2_top_menu() {
	
	if ( ! get_theme_mod( 'top_menu_visibility', monstroid2_theme()->customizer->get_default( 'top_menu_visibility' ) ) ) {
		return;
	}

	if ( ! has_nav_menu( 'top' ) ) {
		return;
	}

	wp_nav_menu( apply_filters( 'monstroid2_top_menu_args', array(
		'theme_location'  => 'top',
		'container'       => 'div',
		'container_class' => 'top-panel__menu',
		'menu_class'      => 'top-panel__menu-list inline-list',
		'depth'           => 1,
	) ) );
}

/**
 * Get social nav menu.
 *
 * @since  1.0.0
 * @since  1.0.0  Added new param - $item.
 * @since  1.0.1  Added arguments to the filter.
 * @param  string $context Current post context - 'single' or 'loop'.
 * @param  string $type    Content type - icon, text or both.
 * @return string
 */
function monstroid2_get_social_list( $context, $type = 'icon' ) {
	static $instance = 0;
	$instance++;

	$container_class = array( 'social-list' );

	if ( ! empty( $context ) ) {
		$container_class[] = sprintf( 'social-list--%s', sanitize_html_class( $context ) );
	}

	$container_class[] = sprintf( 'social-list--%s', sanitize_html_class( $type ) );

	$args = apply_filters( 'monstroid2_social_list_args', array(
		'theme_location'   => 'social',
		'container'        => 'div',
		'container_class'  => join( ' ', $container_class ),
		'menu_id'          => "social-list-{$instance}",
		'menu_class'       => 'social-list__items inline-list',
		'depth'            => 1,
		'link_before'      => ( 'icon' == $type ) ? '<span class="screen-reader-text">' : '',
		'link_after'       => ( 'icon' == $type ) ? '</span>' : '',
		'echo'             => false,
		'fallback_cb'      => 'monstroid2_set_nav_menu',
		'fallback_message' => esc_html__( 'Set social menu', 'monstroid2' ),
	), $context, $type );

	return wp_nav_menu( $args );
}

/**
 * Set fallback callback for nav menu.
 *
 * @param  array $args Nav menu arguments.
 * @return null|string
 */
function monstroid2_set_nav_menu( $args ) {

	if ( ! current_user_can( 'edit_theme_options' ) ) {
		return null;
	}

	$format = '<div class="set-menu %3$s"><a href="%2$s" target="_blank" class="set-menu_link">%1$s</a></div>';
	$label  = $args['fallback_message'];
	$url    = esc_url( admin_url( 'nav-menus.php' ) );

	return sprintf( $format, $label, $url, $args['container_class'] );
}

/**
 * Show menu button.
 *
 * @since  1.1.0
 * @param  string $menu_id Menu ID.
 * @return void
 */
function monstroid2_menu_toggle( $menu_id ) {
	$format = apply_filters(
		'monstroid2_menu_toggle_html',
		'<button class="main-menu-toggle menu-toggle" aria-controls="%s" aria-expanded="false"><span class="menu-toggle-box"><span class="menu-toggle-inner"></span></span></button>'
	);

	printf( $format, $menu_id );
}

/**
 * Show vertical menu button.
 *
 * @since  1.1.0
 * @param  string $menu_id Menu ID.
 * @return void
 */
function monstroid2_vertical_menu_toggle( $menu_id ) {
	$format = apply_filters(
		'monstroid2_vertical_menu_toggle_html',
		'<button class="vertical-menu-toggle menu-toggle" aria-controls="%s" aria-expanded="false"><span class="menu-toggle-box"><span class="menu-toggle-inner"></span></span></button>'
	);

	printf( $format, $menu_id );
}
