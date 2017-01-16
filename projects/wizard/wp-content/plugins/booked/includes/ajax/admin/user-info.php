<?php
	
echo '<div class="booked-scrollable">';
		
	echo '<p class="booked-title-bar"><small>'.esc_html__('Appointment Information','booked').'</small></p>';

	if (!$_POST['user_id'] && isset($_POST['appt_id'])):
	
		$guest_name = get_post_meta($_POST['appt_id'], '_appointment_guest_name',true);
		$guest_surname = get_post_meta($_POST['appt_id'], '_appointment_guest_surname',true);
		$guest_email = get_post_meta($_POST['appt_id'], '_appointment_guest_email',true);
	
		echo '<p class="booked-modal-title">'.esc_html__('Contact Information','booked').'</p>';
		echo '<p class="booked-modal-list-item"><strong class="booked-left-title">'.esc_html__('Name','booked').':</strong> '.$guest_name.' '.$guest_surname.'</p>';
		if ($guest_email) : echo '<p class="booked-modal-list-item"><strong class="booked-left-title">'.esc_html__('Email','booked').':</strong> <a href="mailto:'.$guest_email.'">'.$guest_email.'</a></p>'; endif;
		
	else :

		// Customer Information
		$user_info = get_userdata($_POST['user_id']);
		$display_name = booked_get_name($_POST['user_id']);
		$email = $user_info->user_email;
		$phone = get_user_meta($_POST['user_id'], 'booked_phone', true);

		echo '<p class="booked-modal-title">'.esc_html__('Contact Information','booked').'</p>';
		echo '<p class="booked-modal-list-item"><strong class="booked-left-title">'.esc_html__('Name','booked').':</strong> '.$display_name.'</p>';
		if ($email) : echo '<p class="booked-modal-list-item"><strong class="booked-left-title">'.esc_html__('Email','booked').':</strong> <a href="mailto:'.$email.'">'.$email.'</a></p>'; endif;
		if ($phone) : echo '<p class="booked-modal-list-item"><strong class="booked-left-title">'.esc_html__('Phone','booked').':</strong> <a href="tel:'.preg_replace('/[^0-9+]/', '', $phone).'">'.$phone.'</a></p>'; endif;

	endif;

	// Appointment Information
	if (isset($_POST['appt_id'])):

		$time_format = get_option('time_format');
		$date_format = get_option('date_format');
		$appt_id = $_POST['appt_id'];

		$timestamp = get_post_meta($appt_id, '_appointment_timestamp',true);
		$timeslot = get_post_meta($appt_id, '_appointment_timeslot',true);
		$cf_meta_value = get_post_meta($appt_id, '_cf_meta_value',true);

		$date_display = date_i18n($date_format,$timestamp);
		$day_name = date_i18n('l',$timestamp);

		$timeslots = explode('-',$timeslot);
		$time_start = date_i18n($time_format,strtotime($timeslots[0]));
		$time_end = date_i18n($time_format,strtotime($timeslots[1]));

		if ($timeslots[0] == '0000' && $timeslots[1] == '2400'):
			$timeslotText = esc_html__('All day','booked');
		else :
			$timeslotText = $time_start.' '.esc_html__('to','booked').' '.$time_end;
		endif;

		echo '<p class="booked-modal-title bm-title-bordered">'.esc_html__('Appointment Information','booked').'</p>';
		do_action('booked_before_appointment_information_admin');
		echo '<p class="booked-modal-list-item"><strong class="booked-left-title">'.esc_html__('Date','booked').':</strong> '.$day_name.', '.$date_display.'</p>';
		echo '<p><strong class="booked-left-title">'.esc_html__('Time','booked').':</strong> '.$timeslotText.'</p>';
		echo ($cf_meta_value ? '<div class="cf-meta-values">'.$cf_meta_value.'</div>' : '');
		do_action('booked_after_appointment_information_admin');

	endif;

echo '</div>';

// Close button
echo '<a href="#" class="close"><i class="fa fa-remove"></i></a>';