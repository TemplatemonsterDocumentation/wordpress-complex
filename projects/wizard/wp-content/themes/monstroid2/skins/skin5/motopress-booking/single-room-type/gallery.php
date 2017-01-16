<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<?php if ( mphb_tmpl_has_room_type_gallery() ) : ?>

	<?php
		/**
		 *
		 */
		do_action('mphb_render_single_room_type_before_gallery');
	?>

	<?php monstroid2_skin5_mphb_tmpl_the_room_type_flexslider_gallery( 'monstroid2-thumb-xl-2', true ); ?>

	<?php
		/**
		 * @hooked MPHBSingleRoomTypeView::_enqueueGalleryScripts - 10
		 */
		do_action('mphb_render_single_room_type_after_gallery');
	?>

<?php endif; ?>
