<?php
/**
 * Template part for style-2 header layout.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Monstroid2
 */

$search       = get_theme_mod( 'header_search', monstroid2_theme()->customizer->get_default( 'header_search' ) );
$woo_elements = get_theme_mod( 'header_woo_elements', monstroid2_theme()->customizer->get_default( 'header_woo_elements' ) );
?>
<div class="header-container_wrap container">
	<div class="header-container__top">
		<div class="header-container__flex">
			<div class="site-branding">
				<?php monstroid2_header_logo() ?>
				<?php monstroid2_site_description(); ?>
			</div>
			<div class="header-elements-wrap">
				<?php monstroid2_contact_block( 'header' ); ?>
				<?php monstroid2_header_btn(); ?>
			</div>
		</div>
	</div>

	<div class="header-container__bottom">
		<div class="header-container__flex">
			<?php monstroid2_main_menu(); ?>

			<?php if ( $search || $woo_elements ) : ?>
			<div class="header-icons divider">
				<?php monstroid2_header_search( '<div class="header-search"><span class="search-form__toggle"></span>%s<span class="search-form__close"></span></div>' ); ?>
				<?php monstroid2_header_woo_elements(); ?>
			</div>
			<?php endif; ?>

		</div>
	</div>
</div>
