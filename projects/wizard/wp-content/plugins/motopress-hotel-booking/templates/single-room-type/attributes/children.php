<?php

if ( !defined( 'ABSPATH' ) ) {
	exit;
}
?>

<?php $children = mphb_tmpl_get_room_type_children_capacity(); ?>

<?php if ( !empty( $children ) ) : ?>

	<?php

	/**
	 * @hooked \MPHB\Views\SingleRoomTypeView::_renderChildrenListItemOpen	- 10
	 * @hooked \MPHB\Views\SingleRoomTypeView::_renderChildrenTitle			- 20
	 */
	do_action( 'mphb_render_single_room_type_before_children' );
	?>

	<?php echo $children; ?>

	<?php

	/**
	 * @hooked \MPHB\Views\SingleRoomTypeView::_renderChildrenListItemClose - 10
	 */
	do_action( 'mphb_render_single_room_type_after_children' );
	?>

<?php endif; ?>