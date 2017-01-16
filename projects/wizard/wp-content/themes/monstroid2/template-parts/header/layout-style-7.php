<?php
/**
 * Template part for style-7 header layout.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Monstroid2
 */
?>
<div class="header-container_wrap container">
	<?php monstroid2_vertical_main_menu( 'right' ); ?>
	<div class="row row-md-center">
		<div class="col-xs-12 col-md-4 col-lg-3">
			<?php monstroid2_vertical_menu_toggle( 'main-menu' ); ?>
		</div>
		<div class="col-xs-12 col-md-4 col-lg-6">
			<div class="site-branding">
				<?php monstroid2_header_logo() ?>
				<?php monstroid2_site_description(); ?>
			</div>
		</div>
		<div class="col-xs-12 col-md-4 col-lg-3">
			<div class="header-btn-wrap">
				<?php monstroid2_header_btn(); ?>
			</div>
		</div>
	</div>
</div>
