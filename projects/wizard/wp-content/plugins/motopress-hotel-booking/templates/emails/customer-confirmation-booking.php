<?php
/**
 * Customer pending user confirmation booking email
 *
 */
if ( !defined( 'ABSPATH' ) ) {
	exit;
}
?>
<?php _e( 'Dear %customer_first_name% %customer_last_name%, we received your request for reservation.', 'motopress-hotel-booking' ); ?>
<br/><br/>
<?php _e( 'Click the link below to confirm your booking.', 'motopress-hotel-booking' ); ?>
<br/>
<?php _e( '<a href="%user_confirm_link%">Confirm</a>', 'motopress-hotel-booking' ); ?>
<br/>
<small><?php _e( 'Note: link expires on', 'motopress-hotel-booking' ); ?> %user_confirm_link_expire% <?php _e( 'UTC', 'motopress-hotel-booking' ); ?></small>
<br/><br/>
<?php _e( 'If you did not place this booking, please ignore this email.', 'motopress-hotel-booking' ); ?>
<br/>
<h4><?php _e( 'Details of booking', 'motopress-hotel-booking' ) ?></h4>
<?php _e( 'ID: #%booking_id%', 'motopress-hotel-booking' ); ?>
<br/>
<?php _e( 'Check-in Date: %check_in_date%', 'motopress-hotel-booking' ); ?>
<br/>
<?php _e( 'Check-out Date: %check_out_date%', 'motopress-hotel-booking' ); ?>
<br/>
<?php _e( 'Adults: %adults%', 'motopress-hotel-booking' ); ?>
<br/>
<?php _e( 'Children: %children%', 'motopress-hotel-booking' ); ?>
<br/>
<?php _e( 'Room: <a href="%room_type_link%">%room_type_title%</a>', 'motopress-hotel-booking' ); ?>
<br/>
<?php _e( 'Room Rate:', 'motopress-hotel-booking' ); ?> %room_rate_title%
<br/>
%room_rate_description%
<br/>
<?php _e( 'Bed Type: %room_type_bed_type%', 'motopress-hotel-booking' ); ?>
<br/>

<h4><?php _e( 'Additional Services', 'motopress-hotel-booking' ); ?></h4>
%services%
<br/>

<h4><?php _e( 'Total Price:', 'motopress-hotel-booking' ) ?></h4> %booking_total_price%
<br/>

<h4><?php _e( 'Customer Information', 'motopress-hotel-booking' ); ?></h4>
<?php _e( 'Name: %customer_first_name% %customer_last_name%', 'motopress-hotel-booking' ) ?>
<br/>
<?php _e( 'Email: %customer_email%', 'motopress-hotel-booking' ) ?>
<br/>
<?php _e( 'Phone: %customer_phone%', 'motopress-hotel-booking' ) ?>
<br/>
<?php _e( 'Note: %customer_note%', 'motopress-hotel-booking' ) ?>
<br/><br/>
<?php _e( 'Thank you!', 'motopress-hotel-booking' ); ?>