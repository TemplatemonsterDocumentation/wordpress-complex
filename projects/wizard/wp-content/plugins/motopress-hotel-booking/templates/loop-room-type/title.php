<?php
/**
 * Loop Room title
 *
 * This template can be overridden by copying it to %theme%/hotel-booking/loop-room-type/title.php.
 *
 */
if ( !defined( 'ABSPATH' ) ) {
	exit;
}
?>

<?php
/**
 * @hooked \MPHB\Views\LoopRoomTypeView::_renderTitleHeadingOpen - 10
 */
do_action( 'mphb_render_loop_room_type_before_title' );
?>

<?php $linkClass = apply_filters( 'mphb_loop_room_type_title_link_class', 'mphb-room-type-title' ); ?>

<a class="<?php echo esc_attr( $linkClass ); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>

<?php
/**
 * @hooked \MPHB\Views\LoopRoomTypeView::_renderTitleHeadingClose - 10
 */
do_action( 'mphb_render_loop_room_type_after_title' );
?>
