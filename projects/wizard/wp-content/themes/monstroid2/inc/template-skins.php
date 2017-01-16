<?php
/**
 * Skins Template Functions.
 *
 * @package Monstroid2
 */

/**
 * Load a template part into a template
 *
 * @since 1.0.0
 *
 * @param string $slug The slug name for the generic template.
 * @param string $name The name of the specialised template.
 */
function monstroid2_get_template_part( $slug, $name = null ) {
	$skin      = get_theme_mod( 'skin_style', monstroid2_theme()->customizer->get_default( 'skin_style' ) );
	$skin_path = "skins/{$skin}/";

	$templates = array();
	$name = (string) $name;

	if ( 'default' !== $skin ) {
		$skin_slug = $skin_path . $slug;

		if ( '' !== $name ) {
			$templates[] = "{$skin_slug}-{$name}.php";
		}

		$templates[] = "{$skin_slug}.php";
	}

	if ( '' !== $name ) {
		$templates[] = "{$slug}-{$name}.php";
	}

	$templates[] = "{$slug}.php";

	locate_template( $templates, true, false );
}
