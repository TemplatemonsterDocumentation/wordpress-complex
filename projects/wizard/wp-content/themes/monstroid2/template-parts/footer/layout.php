<?php
/**
 * The template for displaying the default footer layout.
 *
 * @package Monstroid2
 */

$footer_contact_block_visibility = get_theme_mod( 'footer_contact_block_visibility', monstroid2_theme()->customizer->get_default( 'footer_contact_block_visibility' ) );
?>

<div class="footer-container <?php echo monstroid2_get_invert_class_customize_option( 'footer_bg' ); ?>">
	<div class="site-info container">
		<div class="site-info-wrap">
			<?php monstroid2_footer_logo(); ?>
			<?php monstroid2_footer_menu(); ?>

			<?php if ( $footer_contact_block_visibility ) : ?>
			<div class="site-info__bottom">
			<?php endif; ?>
				<?php monstroid2_footer_copyright(); ?>
				<?php monstroid2_contact_block( 'footer' ); ?>
			<?php if ( $footer_contact_block_visibility ) : ?>
			</div>
			<?php endif; ?>

			<?php monstroid2_social_list( 'footer' ); ?>
		</div>

	</div><!-- .site-info -->
</div><!-- .container -->
