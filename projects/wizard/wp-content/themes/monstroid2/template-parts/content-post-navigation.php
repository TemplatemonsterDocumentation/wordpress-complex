<?php
/**
 * Template part for single post navigation.
 *
 * @package Monstroid2
 */

if ( ! get_theme_mod( 'single_post_navigation', monstroid2_theme()->customizer->get_default( 'single_post_navigation' ) ) ) {
	return;
}

the_post_navigation();
