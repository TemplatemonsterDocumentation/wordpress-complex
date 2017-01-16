<?php
/**
 * Sidebars configuration.
 *
 * @package Monstroid2
 */

add_action( 'after_setup_theme', 'monstroid2_register_sidebars', 5 );
/**
 * Register sidebars.
 */
function monstroid2_register_sidebars() {

	monstroid2_widget_area()->widgets_settings = apply_filters( 'monstroid2_widget_area_default_settings', array(
		'sidebar' => array(
			'name'           => esc_html__( 'Sidebar', 'monstroid2' ),
			'description'    => '',
			'before_widget'  => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'   => '</aside>',
			'before_title'   => '<h5 class="widget-title">',
			'after_title'    => '</h5>',
			'before_wrapper' => '<div id="%1$s" %2$s role="complementary">',
			'after_wrapper'  => '</div>',
			'is_global'      => true,
		),
		'full-width-header-area' => array(
			'name'           => esc_html__( 'Header Fullwidth Area', 'monstroid2' ),
			'description'    => '',
			'before_widget'  => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'   => '</aside>',
			'before_title'   => '<h5 class="widget-title">',
			'after_title'    => '</h5>',
			'before_wrapper' => '<section id="%1$s" %2$s>',
			'after_wrapper'  => '</section>',
			'is_global'      => false,
			'conditional'    => array( 'is_home' ),
		),
		'before-content-area' => array(
			'name'           => esc_html__( 'Before Content Area', 'monstroid2' ),
			'description'    => '',
			'before_widget'  => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'   => '</aside>',
			'before_title'   => '<h5 class="widget-title">',
			'after_title'    => '</h5>',
			'before_wrapper' => '<section id="%1$s" %2$s>',
			'after_wrapper'  => '</section>',
			'is_global'      => false,
			'conditional'    => array( 'is_home' ),
		),
		'before-loop-area' => array(
			'name'           => esc_html__( 'Before Loop Area', 'monstroid2' ),
			'description'    => '',
			'before_widget'  => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'   => '</aside>',
			'before_title'   => '<h5 class="widget-title">',
			'after_title'    => '</h5>',
			'before_wrapper' => '<section id="%1$s" %2$s>',
			'after_wrapper'  => '</section>',
			'is_global'      => false,
			'conditional'    => array( 'is_home' ),
		),
		'after-loop-area' => array(
			'name'           => esc_html__( 'After Loop Area', 'monstroid2' ),
			'description'    => '',
			'before_widget'  => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'   => '</aside>',
			'before_title'   => '<h5 class="widget-title">',
			'after_title'    => '</h5>',
			'before_wrapper' => '<section id="%1$s" %2$s>',
			'after_wrapper'  => '</section>',
			'is_global'      => false,
			'conditional'    => array( 'is_home' ),
		),
		'after-content-area' => array(
			'name'           => esc_html__( 'After Content Area', 'monstroid2' ),
			'description'    => '',
			'before_widget'  => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'   => '</aside>',
			'before_title'   => '<h5 class="widget-title">',
			'after_title'    => '</h5>',
			'before_wrapper' => '<section id="%1$s" %2$s>',
			'after_wrapper'  => '</section>',
			'is_global'      => false,
			'conditional'    => array( 'is_home' ),
		),
		'after-content-full-width-area' => array(
			'name'           => esc_html__( 'After Content Fullwidth Area', 'monstroid2' ),
			'description'    => '',
			'before_widget'  => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'   => '</aside>',
			'before_title'   => '<h5 class="widget-title">',
			'after_title'    => '</h5>',
			'before_wrapper' => '<section id="%1$s" %2$s>',
			'after_wrapper'  => '</section>',
			'is_global'      => true,
		),
		'footer-area' => array(
			'name'           => esc_html__( 'Footer Area', 'monstroid2' ),
			'description'    => '',
			'before_widget'  => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'   => '</aside>',
			'before_title'   => '<h6 class="widget-title">',
			'after_title'    => '</h6>',
			'before_wrapper' => '<section id="%1$s" %2$s>',
			'after_wrapper'  => '</section>',
			'is_global'      => true,
		),
	) );
}
