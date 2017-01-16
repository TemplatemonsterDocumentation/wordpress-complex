<?php
	
do_action('booked_before_creating_appointment');

$date = $_POST['date'];
$title = isset($_POST['title']) ? $_POST['title'] : '';	
$timestamp = $_POST['timestamp'];
$timeslot = $_POST['timeslot'];
$customer_type = $_POST['customer_type'];

$hide_end_times = get_option('booked_hide_end_times',false);

$calendar_id = (isset($_POST['calendar_id']) ? $_POST['calendar_id'] : false);
$calendar_id_for_cf = $calendar_id;
if ($calendar_id):
	$calendar_id = array($calendar_id);
	$calendar_id = array_map( 'intval', $calendar_id );
	$calendar_id = array_unique( $calendar_id );
endif;

$time_format = get_option('time_format');
$date_format = get_option('date_format');

// Get custom field data (new in v1.2)
$custom_fields = array();

if ( $calendar_id_for_cf ) {
	$custom_fields = json_decode(stripslashes(get_option('booked_custom_fields_'.$calendar_id_for_cf)),true);
}

if ( !$custom_fields ) {
	$custom_fields = json_decode(stripslashes(get_option('booked_custom_fields')),true);
}

$custom_field_data = array();
$cf_meta_value = '';

if (!empty($custom_fields)):

	$previous_field = false;

	foreach($custom_fields as $field):

		$field_name = $field['name'];
		$field_title = $field['value'];

		$field_title_parts = explode('---',$field_name);
		if ($field_title_parts[0] == 'radio-buttons-label' || $field_title_parts[0] == 'checkboxes-label'):
			$current_group_name = $field_title;
		elseif ($field_title_parts[0] == 'single-radio-button' || $field_title_parts[0] == 'single-checkbox'):
			// Don't change the group name yet
		else :
			$current_group_name = $field_title;
		endif;

		if ($field_name != $previous_field){

			if (isset($_POST[$field_name]) && $_POST[$field_name]):

				$field_value = $_POST[$field_name];
				if (is_array($field_value)){
					$field_value = implode(', ',$field_value);
				}
				$custom_field_data[$current_group_name] = $field_value;

			endif;

			$previous_field = $field_name;

		}

	endforeach;

	$custom_field_data = apply_filters('booked_custom_field_data', $custom_field_data);

	if (!empty($custom_field_data)):
		foreach($custom_field_data as $label => $value):
			$cf_meta_value .= '<p class="cf-meta-value"><strong>'.$label.'</strong><br>'.$value.'</p>';
		endforeach;
	endif;

endif;
// END Get custom field data

if ($customer_type == 'guest'):

	$name = esc_attr($_POST['guest_name']);
	$surname = isset($_POST['guest_surname']) ? esc_attr($_POST['guest_surname']) : false;
	$fullname = ( $surname ? $name . ' ' . $surname : $name );
	$email = isset($_POST['guest_email']) ? esc_attr($_POST['guest_email']) : false;
	
	if ($email && is_email($email) && $name || !$email && $name):

		// Create a new appointment post for a current customer
		$new_post = apply_filters('booked_new_appointment_args', array(
			'post_title' => date_i18n($date_format,$timestamp).' @ '.date_i18n($time_format,$timestamp).' (User: Guest)',
			'post_content' => '',
			'post_status' => 'publish',
			'post_date' => date_i18n('Y',strtotime($date)).'-'.date_i18n('m',strtotime($date)).'-01 00:00:00',
			'post_type' => 'booked_appointments'
		));
		$post_id = wp_insert_post($new_post);

		update_post_meta($post_id, '_appointment_title', $title);
		update_post_meta($post_id, '_appointment_guest_name', $name);
		update_post_meta($post_id, '_appointment_guest_surname', $surname);
		update_post_meta($post_id, '_appointment_guest_email', $email);
		update_post_meta($post_id, '_appointment_timestamp', $timestamp);
		update_post_meta($post_id, '_appointment_timeslot', $timeslot);

		if (apply_filters('booked_update_cf_meta_value', true)) {
			update_post_meta($post_id, '_cf_meta_value', $cf_meta_value);
		}

		if (apply_filters('booked_update_appointment_calendar', true)) {
			if (isset($calendar_id) && $calendar_id): wp_set_object_terms($post_id,$calendar_id,'booked_custom_calendars'); endif;
		}
	
		if (isset($calendar_id[0]) && $calendar_id[0] && !empty($calendar_id)): $calendar_term = get_term_by('id',$calendar_id[0],'booked_custom_calendars'); $calendar_name = $calendar_term->name; else: $calendar_name = false; endif;

		do_action('booked_new_appointment_created', $post_id);

		$timeslots = explode('-',$timeslot);

		$timestamp_start = strtotime('2015-01-01 '.$timeslots[0]);
		$timestamp_end = strtotime('2015-01-01 '.$timeslots[1]);

		if ($timeslots[0] == '0000' && $timeslots[1] == '2400'):
			$timeslotText = esc_html__('All day','booked');
		else :
			$timeslotText = date_i18n($time_format,$timestamp_start).(!$hide_end_times ? '&ndash;'.date_i18n($time_format,$timestamp_end) : '');
		endif;
		
		$day_name = date('D',$timestamp);
		$timeslotText = apply_filters('booked_emailed_timeslot_text',$timeslotText,$timestamp,$timeslot,$calendar_id);

		// Send an email to the User?
		$email_content = get_option('booked_approval_email_content');
		$email_subject = get_option('booked_approval_email_subject');
		if ($email_content && $email_subject):
			$tokens = array('%name%','%date%','%time%','%customfields%','%calendar%','%email%','%title%');
			$replacements = array($fullname,date_i18n($date_format,$timestamp),$timeslotText,$cf_meta_value,$calendar_name,$email,$title);
			$email_content = htmlentities(str_replace($tokens,$replacements,$email_content), ENT_QUOTES | ENT_IGNORE, "UTF-8");
			$email_content = html_entity_decode($email_content, ENT_QUOTES | ENT_IGNORE, "UTF-8");
			$email_subject = str_replace($tokens,$replacements,$email_subject);
			do_action( 'booked_approved_email', $email, $email_subject, $email_content );
		endif;

		echo $date;

	else:
	
		if ( !is_email($email) ):
			echo 'error###' . esc_html__( 'That email does not appear to be valid.','booked');
		endif;
	
	endif;
	
elseif ($customer_type == 'current'):

	$user_id = $_POST['user_id'];

	// Create a new appointment post for a current customer
	$new_post = apply_filters('booked_new_appointment_args', array(
		'post_title' => date_i18n($date_format,$timestamp).' @ '.date_i18n($time_format,$timestamp).' (User: '.$user_id.')',
		'post_content' => '',
		'post_status' => 'publish',
		'post_date' => date_i18n('Y',strtotime($date)).'-'.date_i18n('m',strtotime($date)).'-01 00:00:00',
		'post_author' => $user_id,
		'post_type' => 'booked_appointments'
	));
	$post_id = wp_insert_post($new_post);

	update_post_meta($post_id, '_appointment_title', $title);
	update_post_meta($post_id, '_appointment_timestamp', $timestamp);
	update_post_meta($post_id, '_appointment_timeslot', $timeslot);
	update_post_meta($post_id, '_appointment_user', $user_id);

	if (apply_filters('booked_update_cf_meta_value', true)) {
		update_post_meta($post_id, '_cf_meta_value', $cf_meta_value);
	}

	if (apply_filters('booked_update_appointment_calendar', true)) {
		if (isset($calendar_id) && $calendar_id): wp_set_object_terms($post_id,$calendar_id,'booked_custom_calendars'); endif;
	}

	if (isset($calendar_id[0]) && $calendar_id[0] && !empty($calendar_id)): $calendar_term = get_term_by('id',$calendar_id[0],'booked_custom_calendars'); $calendar_name = $calendar_term->name; else: $calendar_name = false; endif;

	do_action('booked_new_appointment_created', $post_id);

	$timeslots = explode('-',$timeslot);

	$timestamp_start = strtotime('2015-01-01 '.$timeslots[0]);
	$timestamp_end = strtotime('2015-01-01 '.$timeslots[1]);

	if ($timeslots[0] == '0000' && $timeslots[1] == '2400'):
		$timeslotText = esc_html__('All day','booked');
	else :
		$timeslotText = date_i18n($time_format,$timestamp_start).(!$hide_end_times ? '&ndash;'.date_i18n($time_format,$timestamp_end) : '');
	endif;
	
	$day_name = date('D',$timestamp);
	$timeslotText = apply_filters('booked_emailed_timeslot_text',$timeslotText,$timestamp,$timeslot,$calendar_id);

	// Send an email to the User?
	$email_content = get_option('booked_approval_email_content');
	$email_subject = get_option('booked_approval_email_subject');
	if ($email_content && $email_subject):
		$user_name = booked_get_name($user_id);
		$user_data = get_userdata( $user_id );
		$email = $user_data->user_email;
		$tokens = array('%name%','%date%','%time%','%customfields%','%calendar%','%email%','%title%');
		$replacements = array($user_name,date_i18n($date_format,$timestamp),$timeslotText,$cf_meta_value,$calendar_name,$email,$title);
		$email_content = htmlentities(str_replace($tokens,$replacements,$email_content), ENT_QUOTES | ENT_IGNORE, "UTF-8");
		$email_content = html_entity_decode($email_content, ENT_QUOTES | ENT_IGNORE, "UTF-8");
		$email_subject = str_replace($tokens,$replacements,$email_subject);
		do_action( 'booked_approved_email', $email, $email_subject, $email_content );
	endif;

	echo $date;

else:

	$name = esc_attr($_POST['name']);
	$surname = ( isset($_POST['surname']) && $_POST['surname'] ? esc_attr($_POST['surname']) : false );
	$fullname = ( $surname ? $name . ' ' . $surname : $name );
	$email = esc_attr( $_POST['email'] );
	$password = ($_POST['password'] ? esc_attr( $_POST['password'] ) : wp_generate_password());

	$username = ( $surname ? sanitize_user($name.'_'.$surname) : sanitize_user($name) );
	$errors = booked_registration_validation($username,$email,$password);

	if (!empty($errors)):
		$rand = rand(111,999);
		$username = $username.'_'.$rand;
		$errors = booked_registration_validation($username,$email,$password);
	endif;

	if (empty($errors)):
	
		$userdata = array(
        	'user_login'    =>  $username,
			'user_email'    =>  $email,
			'user_pass'     =>  $password,
			'first_name'	=>	$name,
			'last_name'		=>	$surname
        );
        $user_id = wp_insert_user( $userdata );
        
        update_user_meta( $user_id, 'nickname', $name );
		wp_update_user( array ('ID' => $user_id, 'display_name' => $name ) );

        // Send a registration welcome email to the new user?
        $email_content = get_option('booked_registration_email_content');
		$email_subject = get_option('booked_registration_email_subject');
		if ($email_content && $email_subject):
			$tokens = array('%name%','%username%','%password%');
			$replacements = array($fullname,$email,$password);
			$email_content = htmlentities(str_replace($tokens,$replacements,$email_content), ENT_QUOTES | ENT_IGNORE, "UTF-8");
			$email_content = html_entity_decode($email_content, ENT_QUOTES | ENT_IGNORE, "UTF-8");
			$email_subject = str_replace($tokens,$replacements,$email_subject);
			do_action( 'booked_registration_email',$email, $email_subject, $email_content );
		endif;

		$timeslots = explode('-',$timeslot);

		$timestamp_start = strtotime('2015-01-01 '.$timeslots[0]);
		$timestamp_end = strtotime('2015-01-01 '.$timeslots[1]);

		if ($timeslots[0] == '0000' && $timeslots[1] == '2400'):
			$timeslotText = esc_html__('All day','booked');
		else :
			$timeslotText = date_i18n($time_format,$timestamp_start).(!$hide_end_times ? '&ndash;'.date_i18n($time_format,$timestamp_end) : '');
		endif;
		
		$day_name = date('D',$timestamp);
		$timeslotText = apply_filters('booked_emailed_timeslot_text',$timeslotText,$timestamp,$timeslot,$calendar_id);
		
		if (isset($calendar_id) && $calendar_id): $calendar_term = get_term_by('id',$calendar_id,'booked_custom_calendars'); $calendar_name = $calendar_term->name; else: $calendar_name = false; endif;

		// Send an email to the user?
		$email_content = get_option('booked_approval_email_content');
		$email_subject = get_option('booked_approval_email_subject');
		if ($email_content && $email_subject):
			$tokens = array('%name%','%date%','%time%','%customfields%','%calendar%','%email%','%title%');
			$replacements = array($fullname,date_i18n($date_format,$timestamp),$timeslotText,$cf_meta_value,$calendar_name,$email,$title);
			$email_content = htmlentities(str_replace($tokens,$replacements,$email_content), ENT_QUOTES | ENT_IGNORE, "UTF-8");
			$email_content = html_entity_decode($email_content, ENT_QUOTES | ENT_IGNORE, "UTF-8");
			$email_subject = str_replace($tokens,$replacements,$email_subject);
			do_action( 'booked_approved_email',$email, $email_subject, $email_content );
		endif;

        if ($phone){
	        update_user_meta($user_id,'booked_phone',$phone);
        }

        // Create a new appointment post for this new customer
		$new_post = apply_filters('booked_new_appointment_args', array(
			'post_title' => date_i18n($date_format,$timestamp).' @ '.date_i18n($time_format,$timestamp).' (User: '.$user_id.')',
			'post_content' => '',
			'post_status' => 'publish',
			'post_date' => date_i18n('Y',strtotime($date)).'-'.date_i18n('m',strtotime($date)).'-01 00:00:00',
			'post_author' => $user_id,
			'post_type' => 'booked_appointments'
		));
		$post_id = wp_insert_post($new_post);

		update_post_meta($post_id, '_appointment_title', $title);
		update_post_meta($post_id, '_appointment_timestamp', $timestamp);
		update_post_meta($post_id, '_appointment_timeslot', $timeslot);
		update_post_meta($post_id, '_appointment_user', $user_id);

		if (apply_filters('booked_update_cf_meta_value', true)) {
			update_post_meta($post_id, '_cf_meta_value', $cf_meta_value);
		}

        if (apply_filters('booked_update_appointment_calendar', true)) {
			if (isset($calendar_id) && $calendar_id): wp_set_object_terms($post_id,$calendar_id,'booked_custom_calendars'); endif;
		}

        do_action('booked_new_appointment_created', $post_id);

		echo 'success###'.$date;
	else :
		echo 'error###'.implode('
',$errors);
	endif;

endif;