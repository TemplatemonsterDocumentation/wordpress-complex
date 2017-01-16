<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<?php
	/**
	 * @hooked MPHBLoopRoomTypeView::_renderBookButtonParagraphOpen - 10
	 */
	do_action('mphb_render_loop_room_type_before_book_button');
?>

	<div class="mphb-to-book-btn-wrapper">
		<?php mphb_tmpl_the_loop_room_type_book_button_form( esc_html__( 'Book now!', 'monstroid2' ) ); ?>
	</div>

<?php
	/**
	 * @hooked MPHBLoopRoomTypeView::_renderBookButtonParagraphClose - 10
	 */
	do_action('mphb_render_loop_room_type_after_book_button');
?>
