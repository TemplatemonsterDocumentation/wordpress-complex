<?php
/**
 * Template part for style-4 header layout.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Monstroid2
 */

$search       = get_theme_mod( 'header_search', monstroid2_theme()->customizer->get_default( 'header_search' ) );
$woo_elements = get_theme_mod( 'header_woo_elements', monstroid2_theme()->customizer->get_default( 'header_woo_elements' ) );
?>
<div class="header-container_wrap container">
	<div class="header-container__flex">
		<div class="site-branding">
			<?php monstroid2_header_logo() ?>
			<?php monstroid2_site_description(); ?>
		</div>

		<?php monstroid2_main_menu(); ?>
		
		<?php if ( $search || $woo_elements ) : ?>
		<div class="header-icons divider">
			<?php monstroid2_header_search( '<div class="header-search"><span class="search-form__toggle"></span>%s<span class="search-form__close"></span></div>' ); ?>
			<?php monstroid2_header_woo_elements(); ?>
		</div>
		<?php endif; ?>

		<?php monstroid2_header_btn(); ?>
	</div>
</div>
