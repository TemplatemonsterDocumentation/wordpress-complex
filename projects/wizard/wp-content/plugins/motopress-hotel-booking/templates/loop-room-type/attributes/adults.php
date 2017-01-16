<?php

if ( !defined( 'ABSPATH' ) ) {
	exit;
}
?>

<?php $adults = mphb_tmpl_get_room_type_adults_capacity(); ?>

<?php if ( !empty( $adults ) ) : ?>

	<?php

	/**
	 * @hooked \MPHB\Views\LoopRoomTypeView::_renderAdultsListItemOpen	- 10
	 * @hooked \MPHB\Views\LoopRoomTypeView::_renderAdultsTitle			- 20
	 */
	do_action( 'mphb_render_loop_room_type_before_adults' );
	?>

	<?php echo $adults; ?>

	<?php

	/**
	 * @hooked \MPHB\Views\LoopRoomTypeView::_renderAdultsListItemClose - 10
	 */
	do_action( 'mphb_render_loop_room_type_after_adults' );
	?>

<?php endif; ?>