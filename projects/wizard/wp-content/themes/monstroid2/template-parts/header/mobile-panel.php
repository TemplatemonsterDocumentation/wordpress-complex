<?php
/**
 * Template part for mobile panel in header.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Monstroid2
 */
?>
<div class="mobile-panel">
	<?php monstroid2_menu_toggle( 'main-menu' ); ?>
	<div class="mobile-panel__right">
		<?php monstroid2_header_search( '<div class="header-search"><span class="search-form__toggle"></span>%s<span class="search-form__close"></span></div>' ); ?>
		<?php monstroid2_header_woo_elements(); ?>
	</div>
</div>
