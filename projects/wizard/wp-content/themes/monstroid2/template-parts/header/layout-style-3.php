<?php
/**
 * Template part for style-3 header layout.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Monstroid2
 */
?>
<div class="header-container_wrap container">
	<?php monstroid2_vertical_main_menu(); ?>
	<div class="header-container__flex">
		<div class="site-branding">
			<?php monstroid2_header_logo() ?>
			<?php monstroid2_site_description(); ?>
		</div>

		<div class="header-icons">
			<?php monstroid2_header_search( '<div class="header-search"><span class="search-form__toggle"></span>%s<span class="search-form__close"></span></div>' ); ?>
			<?php monstroid2_header_woo_elements(); ?>
			<?php monstroid2_vertical_menu_toggle( 'main-menu' ); ?>
			<?php monstroid2_header_btn(); ?>
		</div>

	</div>
</div>
