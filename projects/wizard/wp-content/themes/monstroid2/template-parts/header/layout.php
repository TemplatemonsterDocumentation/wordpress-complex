<?php
/**
 * Template part for default header layout.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Monstroid2
 */
?>
<div class="header-container_wrap container">
	<div class="header-container__flex">
		<div class="site-branding">
			<?php monstroid2_header_logo() ?>
			<?php monstroid2_site_description(); ?>
		</div>

		<?php monstroid2_main_menu(); ?>
		<?php monstroid2_header_btn(); ?>

	</div>
</div>
