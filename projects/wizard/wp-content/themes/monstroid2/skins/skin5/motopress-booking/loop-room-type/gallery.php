<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<?php if ( mphb_tmpl_has_room_type_gallery() ) : ?>

	<?php do_action('mphb_render_loop_room_type_before_gallery'); ?>

	<?php monstroid2_skin5_mphb_tmpl_the_room_type_flexslider_gallery( 'post-thumbnail', false ); ?>

	<?php
		/**
		 * @hooked MPHBLoopRoomTypeView::_enqueueGalleryScripts - 10
		 */
		do_action('mphb_render_loop_room_type_after_gallery');
	?>

<?php endif; ?>
