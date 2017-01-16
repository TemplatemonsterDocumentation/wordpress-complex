<?php
/**
 * Template part for displaying meta category.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Monstroid2
 */

$utility     = monstroid2_utility()->utility;
$btn_text    = get_theme_mod( 'blog_read_more_text', monstroid2_theme()->customizer->get_default( 'blog_read_more_text' ) );
$btn_visible = $btn_text ? true : false;

$utility->attributes->get_button( array(
	'visible' => $btn_visible,
	'class'   => 'btn btn-primary',
	'text'    => $btn_text,
	'html'    => '<a href="%1$s" %3$s><span class="btn__text">%4$s</span>%5$s</a>',
	'echo'    => true,
) );
