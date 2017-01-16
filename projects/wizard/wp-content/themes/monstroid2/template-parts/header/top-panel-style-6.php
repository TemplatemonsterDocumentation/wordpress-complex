<?php
/**
 * Template part for top panel in header (style-6 layout).
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Monstroid2
 */

// Don't show top panel if all elements are disabled.
if ( ! monstroid2_is_top_panel_visible() ) {
	return;
}
$message                  = get_theme_mod( 'top_panel_text', monstroid2_theme()->customizer->get_default( 'top_panel_text' ) );
$contact_block_visibility = get_theme_mod( 'header_contact_block_visibility', monstroid2_theme()->customizer->get_default( 'header_contact_block_visibility' ) );
$social_menu_visibility   = get_theme_mod( 'header_social_links', monstroid2_theme()->customizer->get_default( 'header_social_links' ) );
?>

<div class="top-panel <?php echo monstroid2_get_invert_class_customize_option( 'top_panel_bg' ); ?>">
	<div class="top-panel__container container">
		<div class="top-panel__top">
			<div class="top-panel__left">
				<?php monstroid2_top_message( '<div class="top-panel__message">%s</div>' ); ?>
				<?php if ( empty( $message ) ) {
					monstroid2_contact_block( 'header' );
				} ?>
			</div>
			<div class="top-panel__right">
				<?php monstroid2_top_menu(); ?>
				<?php if ( ! $contact_block_visibility || empty( $message ) ) {
					monstroid2_social_list( 'header' );
				} ?>
				<?php monstroid2_header_search( '<div class="header-search"><span class="search-form__toggle"></span>%s<span class="search-form__close"></span></div>' ); ?>
				<?php monstroid2_header_woo_elements(); ?>
			</div>
		</div>

		<?php if ( $contact_block_visibility && ! empty( $message ) ) : ?>
		<div class="top-panel__bottom">
			<?php monstroid2_social_list( 'header' ); ?>
			<?php monstroid2_contact_block( 'header' ); ?>
		</div>
		<?php endif; ?>
	</div>
</div><!-- .top-panel -->
