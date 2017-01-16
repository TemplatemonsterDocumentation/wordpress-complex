<?php
/**
 * The template for displaying the style-2 footer layout.
 *
 * @package Monstroid2
 */

?>
<div class="footer-container <?php echo monstroid2_get_invert_class_customize_option( 'footer_bg' ); ?>">
	<div class="site-info container">
		<?php
			monstroid2_footer_logo();
			monstroid2_footer_menu();
			monstroid2_contact_block( 'footer' );
			monstroid2_social_list( 'footer' );
			monstroid2_footer_copyright();
		?>
	</div><!-- .site-info -->
</div><!-- .container -->
