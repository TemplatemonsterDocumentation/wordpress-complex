<?php
	
do_action('booked_before_creating_appointment');

$date = isset($_POST['date']) ? $_POST['date'] : '';
$title = isset($_POST['title']) ? $_POST['title'] : '';	
$timestamp = isset($_POST['timestamp']) ? $_POST['timestamp'] : '';
$timeslot = isset($_POST['timeslot']) ? $_POST['timeslot'] : '';
$customer_type = isset($_POST['customer_type']) ? $_POST['customer_type'] : '';

$calendar_id = (isset($_POST['calendar_id']) ? $_POST['calendar_id'] : false);
$calendar_id_for_cf = $calendar_id;
if ($calendar_id):
	$calendar_id = array($calendar_id);
	$calendar_id = array_map( 'intval', $calendar_id );
	$calendar_id = array_unique( $calendar_id );
endif;

$name_requirements = get_option('booked_registration_name_requirements',array('require_name'));
$name_requirements = ( isset($name_requirements[0]) ? $name_requirements[0] : false );
$is_new_registration = $customer_type == 'new' && ! isset($_POST['date']) && ! isset($_POST['timestamp']) && ! isset($_POST['timeslot']);

if ( !$is_new_registration && $date && $timeslot && isset($calendar_id_for_cf) ):

	$appt_is_available = booked_appt_is_available($date,$timeslot,$calendar_id_for_cf);
	
else:

	wp_die();

endif;

if ($appt_is_available):

	$time_format = get_option('time_format');
	$date_format = get_option('date_format');
	$appointment_default_status = get_option('booked_new_appointment_default','draft');
	$hide_end_times = get_option('booked_hide_end_times',false);
	
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
		$surname = isset($_POST['guest_surname']) && $_POST['guest_surname'] ? esc_attr($_POST['guest_surname']) : false;
		$fullname = ( $surname ? $name . ' ' . $surname : $name );
		$email = isset($_POST['guest_email']) ? esc_attr($_POST['guest_email']) : '';
		$email_required = get_option('booked_require_guest_email_address',false);
		
		if ( $name_requirements == 'require_surname' && !$surname ):
			
			echo 'error###'.esc_html__('Your full name is required to book an appointment.','booked');
		
		else:
		
			if ($email && is_email($email) && $name || !$email && !$email_required && $name):
		
				// Create a new appointment post for a guest customer
				$new_post = apply_filters('booked_new_appointment_args', array(
					'post_title' => date_i18n($date_format,$timestamp).' @ '.date_i18n($time_format,$timestamp).' (User: Guest)',
					'post_content' => '',
					'post_status' => $appointment_default_status,
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
				
				if ($appointment_default_status == 'publish'): wp_publish_post($post_id); endif;
		
				if (apply_filters('booked_update_cf_meta_value', true)) {
					update_post_meta($post_id, '_cf_meta_value', $cf_meta_value);
				}
		
				if (apply_filters('booked_update_appointment_calendar', true)) {
					if (!empty($calendar_id)): $calendar_term = get_term_by('id',$calendar_id[0],'booked_custom_calendars'); $calendar_name = $calendar_term->name; wp_set_object_terms($post_id,$calendar_id,'booked_custom_calendars'); else: $calendar_name = false; endif;
				}
		
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
				
				// Send a confirmation email to the User?
				$email_content = get_option('booked_appt_confirmation_email_content');
				$email_subject = get_option('booked_appt_confirmation_email_subject');
				if ($email_content && $email_subject):
					$tokens = array('%name%','%date%','%time%','%customfields%','%calendar%','%email%','%title%');
					$replacements = array($fullname,date_i18n($date_format,$timestamp),$timeslotText,$cf_meta_value,$calendar_name,$email,$title);
					$email_content = htmlentities(str_replace($tokens,$replacements,$email_content), ENT_QUOTES | ENT_IGNORE, "UTF-8");
					$email_content = html_entity_decode($email_content, ENT_QUOTES | ENT_IGNORE, "UTF-8");
					$email_subject = str_replace($tokens,$replacements,$email_subject);
					do_action('booked_confirmation_email', $email, $email_subject, $email_content );
				endif;
			
				// Send an email to the Admin?
				$email_content = get_option('booked_admin_appointment_email_content');
				$email_subject = get_option('booked_admin_appointment_email_subject');
				if ($email_content && $email_subject):
					$admin_email = booked_which_admin_to_send_email($_POST['calendar_id']);
					$tokens = array('%name%','%date%','%time%','%customfields%','%calendar%','%email%','%title%');
					$replacements = array($fullname,date_i18n($date_format,$timestamp),$timeslotText,$cf_meta_value,$calendar_name,$email,$title);
					$email_content = htmlentities(str_replace($tokens,$replacements,$email_content), ENT_QUOTES | ENT_IGNORE, "UTF-8");
					$email_content = html_entity_decode($email_content, ENT_QUOTES | ENT_IGNORE, "UTF-8");
					$email_subject = str_replace($tokens,$replacements,$email_subject);
					do_action('booked_admin_confirmation_email', $admin_email, $email_subject, $email_content );
				endif;
				
				do_action('booked_new_appointment_created', $post_id);
				
				echo 'success###'.$date;
				
			else :
			
				if ($email && !is_email($email)):
					$errors[] = esc_html__('The email address you have entered doesn\'t appear to be valid.','booked');
				elseif ($email_required && !$email):
					$errors[] = esc_html__('Your name and a valid email address are required to book an appointment.','booked');
				elseif (!$name):
					$errors[] = esc_html__('Your name is required to book an appointment.','booked');
				else:
					$errors[] = esc_html__('An unknown error occured.','booked');
				endif;
			
				echo 'error###'.implode('
',$errors);
			
			endif;

		endif;
		
	elseif ($customer_type == 'current'):
	
		$user_id = ! empty($_POST['user_id']) ? intval($_POST['user_id']) : false;
		if ( ! $user_id && is_user_logged_in() ) {
			$user = wp_get_current_user();
			$user_id = $user->ID;
		}
	
		// Create a new appointment post for a current customer
		$new_post = apply_filters('booked_new_appointment_args', array(
			'post_title' => date_i18n($date_format,$timestamp).' @ '.date_i18n($time_format,$timestamp).' (User: '.$user_id.')',
			'post_content' => '',
			'post_status' => $appointment_default_status,
			'post_date' => date_i18n('Y',strtotime($date)).'-'.date_i18n('m',strtotime($date)).'-01 00:00:00',
			'post_author' => $user_id,
			'post_type' => 'booked_appointments'
		));
		$post_id = wp_insert_post($new_post);
	
		update_post_meta($post_id, '_appointment_title', $title);
		update_post_meta($post_id, '_appointment_timestamp', $timestamp);
		update_post_meta($post_id, '_appointment_timeslot', $timeslot);
		update_post_meta($post_id, '_appointment_user', $user_id);
		
		if ($appointment_default_status == 'publish'): wp_publish_post($post_id); endif;
	
		if (apply_filters('booked_update_cf_meta_value', true)) {
			update_post_meta($post_id, '_cf_meta_value', $cf_meta_value);
		}
	
		if (apply_filters('booked_update_appointment_calendar', true)) {
			if (!empty($calendar_id)): $calendar_term = get_term_by('id',$calendar_id[0],'booked_custom_calendars'); $calendar_name = $calendar_term->name; wp_set_object_terms($post_id,$calendar_id,'booked_custom_calendars'); else: $calendar_name = false; endif;
		}
	
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
	
		// Send a confirmation email to the User?
		$email_content = get_option('booked_appt_confirmation_email_content');
		$email_subject = get_option('booked_appt_confirmation_email_subject');
		if ($email_content && $email_subject):
			$user_name = booked_get_name($user_id);
			$user_data = get_userdata( $user_id );
			$email = $user_data->user_email;
			$tokens = array('%name%','%date%','%time%','%customfields%','%calendar%','%email%','%title%');
			$replacements = array($user_name,date_i18n($date_format,$timestamp),$timeslotText,$cf_meta_value,$calendar_name,$email,$title);
			$email_content = htmlentities(str_replace($tokens,$replacements,$email_content), ENT_QUOTES | ENT_IGNORE, "UTF-8");
			$email_content = html_entity_decode($email_content, ENT_QUOTES | ENT_IGNORE, "UTF-8");
			$email_subject = str_replace($tokens,$replacements,$email_subject);
			do_action( 'booked_confirmation_email', $email, $email_subject, $email_content );
		endif;
	
		// Send an email to the Admin?
		$email_content = get_option('booked_admin_appointment_email_content');
		$email_subject = get_option('booked_admin_appointment_email_subject');
		if ($email_content && $email_subject):
			$admin_email = booked_which_admin_to_send_email($_POST['calendar_id']);
			$user_name = booked_get_name($user_id);
			$user_data = get_userdata( $user_id );
			$email = $user_data->user_email;
			$tokens = array('%name%','%date%','%time%','%customfields%','%calendar%','%email%','%title%');
			$replacements = array($user_name,date_i18n($date_format,$timestamp),$timeslotText,$cf_meta_value,$calendar_name,$email,$title);
			$email_content = htmlentities(str_replace($tokens,$replacements,$email_content), ENT_QUOTES | ENT_IGNORE, "UTF-8");
			$email_content = html_entity_decode($email_content, ENT_QUOTES | ENT_IGNORE, "UTF-8");
			$email_subject = str_replace($tokens,$replacements,$email_subject);
			do_action( 'booked_admin_confirmation_email', $admin_email, $email_subject, $email_content );
		endif;
		
		do_action('booked_new_appointment_created', $post_id);
		
		$_SESSION['appt_requested'] = 1;
	
		echo 'success###'.$date;
	
	elseif ($customer_type == 'new'):
	
		$name = esc_attr($_POST['booked_appt_name']);
		$surname = ( isset($_POST['booked_appt_surname']) && $_POST['booked_appt_surname'] ? esc_attr($_POST['booked_appt_surname']) : false );
		$fullname = ( $surname ? $name . ' ' . $surname : $name );
		$email = $_POST['booked_appt_email'];
		$password = $_POST['booked_appt_password'];
		
		if ( $name_requirements == 'require_surname' && !$surname ):
			
			echo 'error###'.esc_html__('Your full name is required to book an appointment.','booked');
		
		else:
	
			if (isset($_POST['captcha_word'])):
		    	$captcha_word = strtolower($_POST['captcha_word']);
				$captcha_code = strtolower($_POST['captcha_code']);
		    else :
		    	$captcha_word = false;
				$captcha_code = false;
		    endif;
		
			$username = ( $surname ? sanitize_user($name.'_'.$surname) : sanitize_user($name) );
			$errors = booked_registration_validation($username,$email,$password,$captcha_word,$captcha_code);
		
			if (!empty($errors)):
				$rand = rand(111,999);
				$username = $username.'_'.$rand;
				$errors = booked_registration_validation($username,$email,$password,$captcha_word,$captcha_code);
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
		
		        $creds = array();
				$creds['user_login'] = $username;
				$creds['user_password'] = $password;
				$creds['remember'] = true;
				$user_signon = wp_signon( $creds, false );
				if ( is_wp_error($user_signon) ){
					$signin_errors = $user_signon->get_error_message();
				}
		
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
				
				if (apply_filters('booked_update_appointment_calendar', true)) {
					if (!empty($calendar_id)): $calendar_term = get_term_by('id',$calendar_id[0],'booked_custom_calendars'); $calendar_name = $calendar_term->name; wp_set_object_terms($post_id,$calendar_id,'booked_custom_calendars'); else: $calendar_name = false; endif;
				}
		
		        // Send an email to the Admin?
		        $email_content = get_option('booked_admin_appointment_email_content');
				$email_subject = get_option('booked_admin_appointment_email_subject');
				if ($email_content && $email_subject):
					$admin_email = booked_which_admin_to_send_email($_POST['calendar_id']);
					$tokens = array('%name%','%date%','%time%','%customfields%','%calendar%','%email%','%title%');
					$replacements = array($fullname,date_i18n($date_format,$timestamp),$timeslotText,$cf_meta_value,$calendar_name,$email,$title);
					$email_content = htmlentities(str_replace($tokens,$replacements,$email_content), ENT_QUOTES | ENT_IGNORE, "UTF-8");
					$email_content = html_entity_decode($email_content, ENT_QUOTES | ENT_IGNORE, "UTF-8");
					$email_subject = str_replace($tokens,$replacements,$email_subject);
					do_action( 'booked_admin_confirmation_email', $admin_email, $email_subject, $email_content );
				endif;
		
				// Send a registration welcome email to the new user?
				$email_content = get_option('booked_registration_email_content');
				$email_subject = get_option('booked_registration_email_subject');
				if ($email_content && $email_subject):
					$tokens = array('%name%','%email%','%username%','%password%');
					$replacements = array($fullname,$email,$username,$password);
					$email_content = htmlentities(str_replace($tokens,$replacements,$email_content), ENT_QUOTES | ENT_IGNORE, "UTF-8");
					$email_content = html_entity_decode($email_content, ENT_QUOTES | ENT_IGNORE, "UTF-8");
					$email_subject = str_replace($tokens,$replacements,$email_subject);
					do_action( 'booked_registration_email', $email, $email_subject, $email_content );
				endif;
		
				// Send an email to the User?
				$email_content = get_option('booked_appt_confirmation_email_content');
				$email_subject = get_option('booked_appt_confirmation_email_subject');
				if ($email_content && $email_subject):
					$tokens = array('%name%','%date%','%time%','%customfields%','%calendar%','%email%','%title%');
					$replacements = array($fullname,date_i18n($date_format,$timestamp),$timeslotText,$cf_meta_value,$calendar_name,$email,$title);
					$email_content = htmlentities(str_replace($tokens,$replacements,$email_content), ENT_QUOTES | ENT_IGNORE, "UTF-8");
					$email_content = html_entity_decode($email_content, ENT_QUOTES | ENT_IGNORE, "UTF-8");
					$email_subject = str_replace($tokens,$replacements,$email_subject);
					do_action( 'booked_confirmation_email', $email, $email_subject, $email_content );
				endif;
		
		        // Create a new appointment post for this new customer
				$new_post = apply_filters('booked_new_appointment_args', array(
					'post_title' => date_i18n($date_format,$timestamp).' @ '.date_i18n($time_format,$timestamp).' (User: '.$user_id.')',
					'post_content' => '',
					'post_status' => $appointment_default_status,
					'post_date' => date_i18n('Y',strtotime($date)).'-'.date_i18n('m',strtotime($date)).'-01 00:00:00',
					'post_author' => $user_id,
					'post_type' => 'booked_appointments'
				));
				$post_id = wp_insert_post($new_post);
		
				update_post_meta($post_id, '_appointment_title', $title);
				update_post_meta($post_id, '_appointment_timestamp', $timestamp);
				update_post_meta($post_id, '_appointment_timeslot', $timeslot);
				update_post_meta($post_id, '_appointment_user', $user_id);
				
				if ($appointment_default_status == 'publish'): wp_publish_post($post_id); endif;
		
				if (apply_filters('booked_update_cf_meta_value', true)) {
					update_post_meta($post_id, '_cf_meta_value', $cf_meta_value);
				}
		
				if (apply_filters('booked_update_appointment_calendar', true)) {
					if (!empty($calendar_id)): wp_set_object_terms($post_id,$calendar_id,'booked_custom_calendars'); endif;
				}
		
				do_action('booked_new_appointment_created', $post_id);
		
				$_SESSION['appt_requested'] = 1;
				$_SESSION['new_account'] = 1;
		
		        echo 'success###'.$date;
		
			else :
		
				echo 'error###'.implode('
',$errors);
			endif;

		endif;
	
	endif;

// register the user only
elseif ( $is_new_registration ):

	$name = esc_attr($_POST['booked_appt_name']);
	$surname = ( isset($_POST['booked_appt_surname']) && $_POST['booked_appt_surname'] ? esc_attr($_POST['booked_appt_surname']) : false );
	$fullname = ( $surname ? $name . ' ' . $surname : $name );
	$email = $_POST['booked_appt_email'];
	$password = $_POST['booked_appt_password'];
	
	if ( $name_requirements == 'require_surname' && !$surname ):
			
		echo 'error###'.esc_html__('Your full name is required to book an appointment.','booked');
	
	else:

		if (isset($_POST['captcha_word'])):
	    	$captcha_word = strtolower($_POST['captcha_word']);
			$captcha_code = strtolower($_POST['captcha_code']);
	    else :
	    	$captcha_word = false;
			$captcha_code = false;
	    endif;
	
		$username = ( $surname ? sanitize_user($name.'_'.$surname) : sanitize_user($name) );
		$errors = booked_registration_validation($username,$email,$password,$captcha_word,$captcha_code);
	
		if (!empty($errors)):
			$rand = rand(111,999);
			$username = $username.'_'.$rand;
			$errors = booked_registration_validation($username,$email,$password,$captcha_word,$captcha_code);
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
	        
	        if ($surname): $name = $name . ' ' . $surname; endif;
	        
	        update_user_meta( $user_id, 'nickname', $name );
			wp_update_user( array ('ID' => $user_id, 'display_name' => $name ) );
	
	        $creds = array();
			$creds['user_login'] = $username;
			$creds['user_password'] = $password;
			$creds['remember'] = true;
			$user_signon = wp_signon( $creds, false );
			if ( is_wp_error($user_signon) ){
				$signin_errors = $user_signon->get_error_message();
			}
	
			// Send a registration welcome email to the new user?
			$email_content = get_option('booked_registration_email_content');
			$email_subject = get_option('booked_registration_email_subject');
			if ($email_content && $email_subject):
				$tokens = array('%name%','%email%','%username%','%password%');
				$replacements = array($fullname,$email,$username,$password);
				$email_content = htmlentities(str_replace($tokens,$replacements,$email_content), ENT_QUOTES | ENT_IGNORE, "UTF-8");
				$email_content = html_entity_decode($email_content, ENT_QUOTES | ENT_IGNORE, "UTF-8");
				$email_subject = str_replace($tokens,$replacements,$email_subject);
				do_action( 'booked_registration_email', $email, $email_subject, $email_content );
			endif;
	
			do_action('booked_new_appointment_created', $post_id);
	
			$_SESSION['appt_requested'] = 1;
			$_SESSION['new_account'] = 1;
	
	        echo 'success###' . esc_html__('Registration has been successful.','booked');
	
		else :
	
			echo 'error###'.implode('
',$errors);
		endif;

	endif;
	
else:

	$error_message = apply_filters( 
		'booked_availability_error_message',
		esc_html__('Sorry, someone just booked this appointment before you could. Please choose a different booking time.','booked')
	);
	echo 'error###' . $error_message;

endif;