<?php
	
if(!class_exists('Booked_Admin_AJAX')) {
	class Booked_Admin_AJAX {
		
		public function __construct() {
			
			// ------------ Actions ------------ //
			
			add_action('wp_ajax_booked_admin_add_appt', array(&$this,'booked_admin_add_appt'));
			add_action('wp_ajax_booked_admin_delete_custom_timeslot', array(&$this,'booked_admin_delete_custom_timeslot'));
			add_action('wp_ajax_booked_admin_adjust_custom_timeslot_count', array(&$this,'booked_admin_adjust_custom_timeslot_count'));
			add_action('wp_ajax_booked_admin_add_custom_timeslot', array(&$this,'booked_admin_add_custom_timeslot'));
			add_action('wp_ajax_booked_admin_add_custom_timeslots', array(&$this,'booked_admin_add_custom_timeslots'));
			add_action('wp_ajax_booked_admin_save_custom_time_slots', array(&$this,'booked_admin_save_custom_time_slots'));
			add_action('wp_ajax_booked_admin_save_custom_fields', array(&$this,'booked_admin_save_custom_fields'));
			add_action('wp_ajax_booked_admin_add_timeslots', array(&$this,'booked_admin_add_timeslots'));
			add_action('wp_ajax_booked_admin_add_timeslot', array(&$this,'booked_admin_add_timeslot'));
			add_action('wp_ajax_booked_admin_adjust_default_timeslot_count', array(&$this,'booked_admin_adjust_default_timeslot_count'));
			add_action('wp_ajax_booked_admin_delete_timeslot', array(&$this,'booked_admin_delete_timeslot'));
			add_action('wp_ajax_booked_admin_delete_appt', array(&$this,'booked_admin_delete_appt'));
			add_action('wp_ajax_booked_admin_approve_appt', array(&$this,'booked_admin_approve_appt'));
			add_action('wp_ajax_booked_admin_approve_all', array(&$this,'booked_admin_approve_all'));
			add_action('wp_ajax_booked_admin_delete_all', array(&$this,'booked_admin_delete_all'));
			add_action('wp_ajax_booked_admin_delete_past', array(&$this,'booked_admin_delete_past'));
			add_action('wp_ajax_booked_date_formatting', array(&$this,'booked_date_formatting'));
			
			
			// ------------ Loaders ------------ //
			
			add_action('wp_ajax_booked_admin_load_timeslots', array(&$this,'booked_admin_load_timeslots'));
			add_action('wp_ajax_booked_admin_load_full_timeslots', array(&$this,'booked_admin_load_full_timeslots'));
			add_action('wp_ajax_booked_admin_load_full_customfields', array(&$this,'booked_admin_load_full_customfields'));
			add_action('wp_ajax_booked_admin_calendar_picker', array(&$this,'booked_admin_calendar_picker'));
			add_action('wp_ajax_booked_admin_calendar_month', array(&$this,'booked_admin_calendar_month'));
			add_action('wp_ajax_booked_admin_calendar_date', array(&$this,'booked_admin_calendar_date'));
			add_action('wp_ajax_booked_admin_refresh_date_square', array(&$this,'booked_admin_refresh_date_square'));
			add_action('wp_ajax_booked_admin_user_info_modal', array(&$this,'booked_admin_user_info_modal'));
			add_action('wp_ajax_booked_admin_new_appointment_form', array(&$this,'booked_admin_new_appointment_form'));
			add_action('wp_ajax_booked_admin_custom_timeslots_list', array(&$this,'booked_admin_custom_timeslots_list'));
		
		}
		
		
		// ------------ ACTIONS ------------ //
		
		// Date Formatting
		public function booked_date_formatting(){
			
			if (isset($_POST['date']) && $_POST['date']):
				$date_format = get_option('date_format');
				echo ucwords( date_i18n( $date_format,strtotime($_POST['date']) ) );
			else:
				echo '';
			endif;
			
			wp_die();
			
		}
		
		// Add Appointment
		public function booked_admin_add_appt(){
			
			if (isset($_POST['date']) && isset($_POST['timestamp']) && isset($_POST['timeslot']) && isset($_POST['customer_type'])):
			
				include(BOOKED_AJAX_INCLUDES_DIR . 'admin/add-appointment.php');
			
			endif;
			wp_die();
			
		}
		
		// Delete Custom Timeslot
		public function booked_admin_delete_custom_timeslot(){
			
			if (isset($_POST['timeslot']) && isset($_POST['currentArray'])):

				$timeslot_to_delete = $_POST['timeslot'];
				$current_times = json_decode(stripslashes($_POST['currentArray']),true);
				$current_times_details = json_decode(stripslashes($_POST['currentArrayDetails']),true);
				
				do_action('booked_deleting_custom_timeslot',$_POST['start_date'],$_POST['end_date'],$_POST['timeslot'],$_POST['calendar_id']);
		
				if (isset($current_times[$timeslot_to_delete])):
					unset($current_times[$timeslot_to_delete]);
					unset($current_times_details[$timeslot_to_delete]);
				endif;
		
				echo json_encode(array(
					'timeslot' => $current_times,
					'timeslot_details' => $current_times_details
				));
			
			endif;
			wp_die();
			
		}
		
		// Adjust Custom Timeslot Count
		public function booked_admin_adjust_custom_timeslot_count(){
			
			if (isset($_POST['currentArray']) && isset($_POST['timeslot']) && isset($_POST['newCount'])):

				$current_times = json_decode(stripslashes($_POST['currentArray']),true);
				$timeslot = $_POST['timeslot'];
				$newCount = $_POST['newCount'];
		
				if (!empty($current_times[$timeslot])):
		
					$current_count = $current_times[$timeslot];
					if ($newCount > 0):
						$current_times[$timeslot] = $newCount;
					else :
						$current_times[$timeslot] = 1;
					endif;

					$current_times_details[$timeslot]['title'] = $title;
		
				endif;
		
				echo json_encode($current_times);
			
			endif;
			wp_die();
			
		}
		
		// Add Custom Timeslot
		public function booked_admin_add_custom_timeslot(){
			
			if (isset($_POST['startTime']) && isset($_POST['endTime']) && isset($_POST['count']) && isset($_POST['currentTimes'])):

				$title = isset($_POST['title']) ? $_POST['title'] : '';
				$startTime = $_POST['startTime'];
				$endTime = $_POST['endTime'];
				$count = $_POST['count'];
				$current_times = json_decode(stripslashes($_POST['currentTimes']),true);
				$current_times_details = !empty($_POST['currentTimesDetails']) ? json_decode(stripslashes($_POST['currentTimesDetails']),true) : array();
				
				if ($startTime == 'allday'):
					$startTime = '0000';
					$endTime = '2400';
				endif;
				
				do_action('booked_creating_custom_timeslot',$_POST['start_date'],$_POST['end_date'],$startTime,$endTime,$_POST['calendar_id'],$title);
		
				if (isset($current_times[$startTime.'-'.$endTime])):
					$current_times[$startTime.'-'.$endTime] = $current_times[$startTime.'-'.$endTime] + $count;
				else :
					$current_times[$startTime.'-'.$endTime] = $count;
				endif;

				$current_times_details[$startTime.'-'.$endTime]['title'] = $title;
				
				echo json_encode(array(
					'timeslot' => $current_times,
					'timeslot_details' => $current_times_details,
				));
			
			endif;
			wp_die();
			
		}
		
		// Add Custom Timeslots
		public function booked_admin_add_custom_timeslots(){
			
			if (isset($_POST['startTime']) && isset($_POST['endTime']) && isset($_POST['interval']) && isset($_POST['count']) && isset($_POST['time_between'])):
				$title = isset($_POST['title']) ? $_POST['title'] : '';

				$startTime = $_POST['startTime'];
				$endTime = $_POST['endTime'];
				if ($_POST['endTime'] == '2400'):
					$endTime = '2400';
				endif;
		
				$interval = $_POST['interval'];
				$count = $_POST['count'];
				$time_between = $_POST['time_between'];
				$current_times = json_decode(stripslashes($_POST['currentTimes']),true);
				$current_times_details = !empty($_POST['currentTimesDetails']) ? json_decode(stripslashes($_POST['currentTimesDetails']),true) : array();
		
				do {
		
					$newStartTime = date_i18n("Hi", strtotime('+'.$interval.' minutes', strtotime($startTime)));
		
					if (isset($current_times[$startTime.'-'.$newStartTime])):
						$current_times[$startTime.'-'.$newStartTime] = $current_times[$startTime.'-'.$newStartTime] + $count;
					else :
						$current_times[$startTime.'-'.$newStartTime] = $count;
					endif;

					$current_times_details[$startTime.'-'.$newStartTime]['title'] = $title;
					
					do_action('booked_creating_custom_timeslot',$_POST['start_date'],$_POST['end_date'],$startTime,$newStartTime,$_POST['calendar_id'],$title);
		
					if ($time_between):
						$time_to_add = $time_between + $interval;
					else :
						$time_to_add = $interval;
					endif;
					$startTime = date_i18n("Hi", strtotime('+'.$time_to_add.' minutes', strtotime($startTime)));
					if ($startTime == '0000'):
						$startTime = '2400';
					endif;
		
				} while ($startTime < $endTime);
		
				echo json_encode(array(
					'timeslot' => $current_times,
					'timeslot_details' => $current_times_details,
				));
			
			endif;
			wp_die();
			
		}
		
		// Save Custom Timeslots
		public function booked_admin_save_custom_time_slots(){
			
			if (isset($_POST['custom_timeslots_encoded'])):

				$custom_timeslots_encoded = htmlentities( stripslashes($_POST['custom_timeslots_encoded']), ENT_NOQUOTES );
				update_option('booked_custom_timeslots_encoded',$custom_timeslots_encoded);
			
			endif;

			wp_die();
			
		}
		
		// Save Custom Fields
		public function booked_admin_save_custom_fields(){
			
			if (isset($_POST['booked_custom_fields'])):

				$custom_fields = $_POST['booked_custom_fields'];
				$calendar_id = $_POST['booked_cf_calendar_id'];
				if ($custom_fields != '[]'):
					if ($calendar_id):
						update_option('booked_custom_fields_'.$calendar_id,$custom_fields);
					else:
						update_option('booked_custom_fields',$custom_fields);
					endif;
				else:
					if ($calendar_id):
						delete_option('booked_custom_fields_'.$calendar_id);
					else:
						delete_option('booked_custom_fields');
					endif;
				endif;
			
			endif;
			wp_die();
			
		}
		
		// Add Timeslots
		public function booked_admin_add_timeslots(){
			
			if (isset($_POST['day']) && isset($_POST['startTime']) && isset($_POST['endTime'])):

				$calendar_id = (isset($_POST['calendar_id']) ? $_POST['calendar_id'] : false);
				$title = isset($_POST['title']) ? $_POST['title'] : '';
		
				$day = $_POST['day'];
				$startTime = $_POST['startTime'];
				$endTime = $_POST['endTime'];
				if ($_POST['endTime'] == '2400'):
					$endTime = '2400';
				endif;
		
				$interval = $_POST['interval'];
				$count = $_POST['count'];
				$time_between = $_POST['time_between'];
		
				if ($calendar_id):
					$booked_defaults = get_option('booked_defaults_'.$calendar_id);
				else :
					$booked_defaults = get_option('booked_defaults');
				endif;
		
				if (empty($booked_defaults)): $booked_defaults = array(); endif;
		
				do {
		
					$newStartTime = date_i18n("Hi", strtotime('+'.$interval.' minutes', strtotime($startTime)));
					if (!empty($booked_defaults[$day][$startTime.'-'.$newStartTime])): $currentCount = $booked_defaults[$day][$startTime.'-'.$newStartTime]; else : $currentCount = 0; endif;
					$booked_defaults[$day][$startTime.'-'.$newStartTime] = $count + $currentCount;
					$booked_defaults[$day.'-details'][$startTime.'-'.$newStartTime]['title'] = $title;
					
					do_action('booked_creating_timeslot',$day,$startTime,$newStartTime,$calendar_id);
					
					if ($time_between):
						$time_to_add = $time_between + $interval;
					else :
						$time_to_add = $interval;
					endif;
					$startTime = date_i18n("Hi", strtotime('+'.$time_to_add.' minutes', strtotime($startTime)));
					if ($startTime == '0000'):
						$startTime = '2400';
					endif;
		
				} while ($startTime < $endTime);
		
				if ($calendar_id):
					update_option('booked_defaults_'.$calendar_id,apply_filters('booked_update_timeslots',$booked_defaults));
				else :
					update_option('booked_defaults',apply_filters('booked_update_timeslots',$booked_defaults));
				endif;
			
			endif;
			wp_die();
			
		}
		
		// Add Timeslot
		public function booked_admin_add_timeslot(){
			
			if (isset($_POST['day']) && isset($_POST['startTime']) && isset($_POST['count'])):

				$calendar_id = (isset($_POST['calendar_id']) ? $_POST['calendar_id'] : false);
				$title = isset($_POST['title']) ? $_POST['title'] : '';

				$day = $_POST['day'];
				$startTime = $_POST['startTime'];
				$endTime = isset($_POST['endTime']) ? $_POST['endTime'] : false;
				$count = $_POST['count'];
				
				if ($startTime == 'allday'):
					$startTime = '0000';
					$endTime = '2400';
				endif;
		
				if ($calendar_id):
					$booked_defaults = get_option('booked_defaults_'.$calendar_id);
				else :
					$booked_defaults = get_option('booked_defaults');
				endif;
		
				if (empty($booked_defaults)): $booked_defaults = array(); endif;
		
				if (!empty($booked_defaults[$day][$startTime.'-'.$endTime])): $currentCount = $booked_defaults[$day][$startTime.'-'.$endTime]; else : $currentCount = 0; endif;
				$booked_defaults[$day][$startTime.'-'.$endTime] = $count + $currentCount;
				$booked_defaults[$day.'-details'][$startTime.'-'.$endTime]['title'] = $title;
				
				do_action('booked_creating_timeslot',$day,$startTime,$endTime,$calendar_id);
		
				if ($calendar_id):
					update_option('booked_defaults_'.$calendar_id,apply_filters('booked_update_timeslots',$booked_defaults));
				else :
					update_option('booked_defaults',apply_filters('booked_update_timeslots',$booked_defaults));
				endif;
			
			endif;
			wp_die();
			
		}
		
		// Adjust Default Timeslot Count
		public function booked_admin_adjust_default_timeslot_count(){
			
			if (isset($_POST['newCount']) && isset($_POST['day']) && isset($_POST['timeslot'])):

				$calendar_id = (isset($_POST['calendar_id']) ? $_POST['calendar_id'] : false);
				$title = isset($_POST['title']) ? $_POST['title'] : '';
	
				$day = $_POST['day'];
				$timeslot = $_POST['timeslot'];
				$newCount = $_POST['newCount'];
		
				if ($calendar_id):
					$booked_defaults = get_option('booked_defaults_'.$calendar_id);
				else :
					$booked_defaults = get_option('booked_defaults');
				endif;
		
				if (!empty($booked_defaults[$day][$timeslot])):
		
					$booked_defaults[$day][$timeslot] = $newCount;
					$booked_defaults[$day.'-details'][$timeslot]['title'] = $title;
					
					if ($calendar_id):
						update_option('booked_defaults_'.$calendar_id,$booked_defaults);
					else :
						update_option('booked_defaults',$booked_defaults);
					endif;
		
				endif;
			
			endif;
			wp_die();
			
		}
		
		// Delete Timeslot
		public function booked_admin_delete_timeslot(){
			
			if (isset($_POST['day']) && isset($_POST['timeslot'])):

				$calendar_id = (isset($_POST['calendar_id']) ? $_POST['calendar_id'] : false);

				$day = $_POST['day'];
				$timeslot = $_POST['timeslot'];
		
				if ($calendar_id):
					$booked_defaults = get_option('booked_defaults_'.$calendar_id);
				else :
					$booked_defaults = get_option('booked_defaults');
				endif;
				
				do_action('booked_deleting_timeslot',$day,$timeslot,$calendar_id);
		
				if (!empty($booked_defaults[$day][$timeslot])):
		
					unset($booked_defaults[$day][$timeslot]);
					unset($booked_defaults[$day.'-details'][$timeslot]);
		
					$timeslot_total = 0;
					foreach($booked_defaults as $default):
						if (!empty($default)):
							$timeslot_total++;
						endif;
					endforeach;
		
					if ($calendar_id):
						if ($timeslot_total):
							update_option('booked_defaults_'.$calendar_id,$booked_defaults);
						else :
							delete_option('booked_defaults_'.$calendar_id);
						endif;
					else :
						if ($timeslot_total):
							update_option('booked_defaults',$booked_defaults);
						else :
							delete_option('booked_defaults');
						endif;
					endif;
		
				endif;
			
			endif;
			wp_die();
			
		}
		
		// Delete Appointment
		public function booked_admin_delete_appt(){
			
			if (isset($_POST['appt_id'])):
			
				$appt_id = $_POST['appt_id'];
				include(BOOKED_AJAX_INCLUDES_DIR . 'admin/delete-appointment.php');
			
			endif;
			wp_die();
			
		}
		
		// Approve Appointment
		public function booked_admin_approve_appt(){
			
			if (isset($_POST['appt_id'])):

				$appt_id = $_POST['appt_id'];
				booked_send_user_approved_email($appt_id);
				wp_publish_post($appt_id);
				do_action('booked_appointment_approved',$appt_id);
			
			endif;
			wp_die();
			
		}
		
		// Approve All Appointments
		public function booked_admin_approve_all(){
			
			$calendars = get_terms('booked_custom_calendars','orderby=slug&hide_empty=0');
			$booked_none_assigned = true;
			$default_calendar_id = false;
										
			if (!empty($calendars)):
			
				if (!current_user_can('manage_booked_options')):
				
					$booked_current_user = wp_get_current_user();
					$calendars = booked_filter_agent_calendars($booked_current_user,$calendars);
					
				endif;
				
			endif;
			
			if (empty($calendars) && !current_user_can('manage_booked_options')):
			
				wp_die();
				
			elseif(current_user_can('manage_booked_options')):
			
				$args = array(
					'post_type' => 'booked_appointments',
					'posts_per_page' => -1,
					'post_status' => apply_filters('booked_admin_pending_post_status',array('draft')),
					'meta_key' => '_appointment_timestamp',
					'orderby' => 'meta_value_num',
					'order' => 'ASC'
				);
			
			else:
			
				$calendar_ids = array();
			
				if (!empty($calendars)):
					foreach($calendars as $cal):
						$calendar_ids[] = $cal->term_id;
					endforeach;
				endif;
			
				$args = array(
					'post_type' => 'booked_appointments',
					'posts_per_page' => -1,
					'post_status' => apply_filters('booked_admin_pending_post_status',array('draft')),
					'meta_key' => '_appointment_timestamp',
					'orderby' => 'meta_value_num',
					'order' => 'ASC'
				);
				
				if (!empty($calendar_ids)):
					$args['tax_query'] = array(
						array(
							'taxonomy' => 'booked_custom_calendars',
							'field'    => 'term_id',
							'terms'    => $calendar_ids,
						)
					);
				endif;
				
			endif;
	
			$appointments_array = array();
	
			if ($args):
				$bookedAppointments = new WP_Query($args);
				if($bookedAppointments->have_posts()):
					while ($bookedAppointments->have_posts()):
					
						$bookedAppointments->the_post();
						$appt_id = $bookedAppointments->post->ID;
						
						booked_send_user_approved_email($appt_id);
						wp_publish_post($appt_id);
						do_action('booked_appointment_approved',$appt_id);
						
					endwhile;
				endif;
			endif;
			
			wp_die();
			
		}
		
		// Delete All Appointments
		public function booked_admin_delete_all(){
			
			$calendars = get_terms('booked_custom_calendars','orderby=slug&hide_empty=0');
			$booked_none_assigned = true;
			$default_calendar_id = false;
										
			if (!empty($calendars)):
			
				if (!current_user_can('manage_booked_options')):
				
					$booked_current_user = wp_get_current_user();
					$calendars = booked_filter_agent_calendars($booked_current_user,$calendars);
					
				endif;
				
			endif;
			
			if (empty($calendars) && !current_user_can('manage_booked_options')):
			
				wp_die();
				
			elseif(current_user_can('manage_booked_options')):
			
				$args = array(
					'post_type' => 'booked_appointments',
					'posts_per_page' => -1,
					'post_status' => apply_filters('booked_admin_pending_post_status',array('draft')),
					'meta_key' => '_appointment_timestamp',
					'orderby' => 'meta_value_num',
					'order' => 'ASC'
				);
			
			else:
			
				$calendar_ids = array();
			
				if (!empty($calendars)):
					foreach($calendars as $cal):
						$calendar_ids[] = $cal->term_id;
					endforeach;
				endif;
			
				$args = array(
					'post_type' => 'booked_appointments',
					'posts_per_page' => -1,
					'post_status' => apply_filters('booked_admin_pending_post_status',array('draft')),
					'meta_key' => '_appointment_timestamp',
					'orderby' => 'meta_value_num',
					'order' => 'ASC'
				);
				
				if (!empty($calendar_ids)):
					$args['tax_query'] = array(
						array(
							'taxonomy' => 'booked_custom_calendars',
							'field'    => 'term_id',
							'terms'    => $calendar_ids,
						)
					);
				endif;
				
			endif;
	
			$appointments_array = array();
	
			if ($args):
				$bookedAppointments = new WP_Query($args);
				if($bookedAppointments->have_posts()):
					while ($bookedAppointments->have_posts()):
					
						$bookedAppointments->the_post();
						global $post;
						$appt_id = $post->ID;
						
						include(BOOKED_AJAX_INCLUDES_DIR . 'admin/delete-appointment.php');
						
					endwhile;
				endif;
			endif;
			
			wp_die();
			
		}
		
		// Delete Past Appointments
		public function booked_admin_delete_past(){
			
			$calendars = get_terms('booked_custom_calendars','orderby=slug&hide_empty=0');
			$booked_none_assigned = true;
			$default_calendar_id = false;
										
			if (!empty($calendars)):
			
				if (!current_user_can('manage_booked_options')):
				
					$booked_current_user = wp_get_current_user();
					$calendars = booked_filter_agent_calendars($booked_current_user,$calendars);
					
				endif;
				
			endif;
			
			if (empty($calendars) && !current_user_can('manage_booked_options')):
			
				wp_die();
				
			elseif(current_user_can('manage_booked_options')):
			
				$args = array(
					'post_type' => 'booked_appointments',
					'posts_per_page' => -1,
					'post_status' => apply_filters('booked_admin_pending_post_status',array('draft')),
					'meta_key' => '_appointment_timestamp',
					'orderby' => 'meta_value_num',
					'order' => 'ASC'
				);
			
			else:
			
				$calendar_ids = array();
			
				if (!empty($calendars)):
					foreach($calendars as $cal):
						$calendar_ids[] = $cal->term_id;
					endforeach;
				endif;
			
				$args = array(
					'post_type' => 'booked_appointments',
					'posts_per_page' => -1,
					'post_status' => apply_filters('booked_admin_pending_post_status',array('draft')),
					'meta_key' => '_appointment_timestamp',
					'orderby' => 'meta_value_num',
					'order' => 'ASC'
				);
				
				if (!empty($calendar_ids)):
					$args['tax_query'] = array(
						array(
							'taxonomy' => 'booked_custom_calendars',
							'field'    => 'term_id',
							'terms'    => $calendar_ids,
						)
					);
				endif;
				
			endif;
	
			$late_date = current_time('timestamp');
			$appointments_array = array();
	
			if ($args):
				$bookedAppointments = new WP_Query($args);
				if($bookedAppointments->have_posts()):
					while ($bookedAppointments->have_posts()):
					
						$bookedAppointments->the_post();
						global $post;
						$appt_id = $post->ID;
						
						$timestamp = get_post_meta($post->ID, '_appointment_timestamp',true);
						$timeslot = get_post_meta($appt_id, '_appointment_timeslot',true);
						$timeslots = explode('-',$timeslot);
		
						$date_to_compare = strtotime(date_i18n('Y-m-d',$timestamp).' '.date_i18n('H:i:s',strtotime($timeslots[0])));
						
						if ($late_date > $date_to_compare): 
							include(BOOKED_AJAX_INCLUDES_DIR . 'admin/delete-appointment.php');
						endif;
						
					endwhile;
				endif;
			endif;
			
			wp_die();
			
		}

		
		
		// ------------ LOADERS ------------ //
			
		// Timeslots
		public function booked_admin_load_timeslots(){
			
			if (isset($_POST['day'])):
			
				$calendar_id = (isset($_POST['calendar_id']) ? $_POST['calendar_id'] : false);

				if ($calendar_id):
					$booked_defaults = get_option('booked_defaults_'.$calendar_id);
				else :
					$booked_defaults = get_option('booked_defaults');
				endif;
		
				$day = $_POST['day'];
				$time_format = get_option('time_format');
		
				if (!empty($booked_defaults[$day])):
					ksort($booked_defaults[$day]);
					foreach($booked_defaults[$day] as $time => $count):
						echo booked_render_timeslot_info($time_format,$day,$time,$count,$calendar_id, $booked_defaults);
					endforeach;
				else :
					echo '<p><small>'.esc_html__('No time slots.','booked').'</small></p>';
				endif;
				
			endif;
			wp_die();
			
		}
		
		// Custom Timeslots
		public function booked_admin_custom_timeslots_list(){
			
			if (isset($_POST['json_array'])):
				
				$this_timeslot = array();
				$this_timeslot['booked_custom_start_date'] = $_POST['start_date'];
				if ($_POST['end_date']): $this_timeslot['booked_custom_end_date'] = $_POST['end_date']; else: $this_timeslot['booked_custom_end_date'] = $_POST['start_date']; endif;
				$calendar_id = $_POST['calendar_id'];
				
				$timeslots = json_decode(stripslashes($_POST['json_array']),true);
				$timeslots_detailed = !empty($_POST['json_array_detailed']) ? json_decode(stripslashes($_POST['json_array_detailed']),true) : array();

				if (!empty($timeslots)):
		
					echo '<div class="cts-header"><span class="slotsTitle">'.esc_html__('Spaces Available','booked').'</span>'.esc_html__('Time Slot','booked').'</div>';
		
					foreach ($timeslots as $timeslot => $count):
		
						$time = explode('-',$timeslot);
						$time_format = get_option('time_format');
		
						echo '<span class="timeslot" data-timeslot="'.$timeslot.'">';
						echo '<span class="slotsBlock"><span class="changeCount minus" data-count="-1"><i class="fa fa-minus-circle"></i></span><span class="count"><em>'.$count.'</em> ' . _n('Space Available','Spaces Available',$count,'booked') . '</span><span class="changeCount add" data-count="1"><i class="fa fa-plus-circle"></i></span></span>';
						
						do_action( 'booked_single_custom_timeslot_start', $this_timeslot, $timeslot, $calendar_id );

						if (  !empty( $timeslots_detailed[$timeslot] ) ) {

							if ( !empty($timeslots_detailed[$timeslot]['title']) ) {
								echo '<span class="title">' . esc_html($timeslots_detailed[$timeslot]['title']) . '</span>';
							}
						}

						if ($time[0] == '0000' && $time[1] == '2400'):
							echo '<span class="start"><i class="fa fa-clock-o"></i>&nbsp;&nbsp;' . strtoupper(esc_html__('All day','booked')) . '</span>';
						else :
							echo '<span class="start"><i class="fa fa-clock-o"></i>&nbsp;&nbsp;' . date_i18n($time_format,strtotime('2014-01-01 '.$time[0])) . '</span> &ndash; <span class="end">' . date_i18n($time_format,strtotime('2014-01-01 '.$time[1])) . '</span>';
						endif;
						
						do_action( 'booked_single_custom_timeslot_end', $this_timeslot, $timeslot, $calendar_id );
		
						echo '<span class="delete"><i class="fa fa-remove"></i></span>';
						echo '</span>';
		
					endforeach;
		
					echo '</div>';
		
				endif;
			
			endif;
			wp_die();
			
		}
		
		// Full Timeslots
		public function booked_admin_load_full_timeslots(){
			
			$calendar_id = (isset($_POST['calendar_id']) ? $_POST['calendar_id'] : false);
			booked_render_timeslots($calendar_id);
			wp_die();
			
		}
		
		// Full Custom Fields
		public function booked_admin_load_full_customfields(){
			
			$calendar_id = (isset($_POST['calendar_id']) ? $_POST['calendar_id'] : false);
			booked_render_custom_fields($calendar_id);
			wp_die();
			
		}
		
		// Calendar Picker
		public function booked_admin_calendar_picker(){
			
			if (isset($_POST['gotoMonth'])):
			
				$timestamp = ($_POST['gotoMonth'] != 'false' ? strtotime($_POST['gotoMonth']) : current_time('timestamp'));
				$year = date_i18n('Y',$timestamp);
				$month = date_i18n('m',$timestamp);
				booked_admin_calendar($year,$month,false,'small');
			
			endif;
			wp_die();
			
		}
		
		// Calendar Month
		public function booked_admin_calendar_month(){
			
			if (isset($_POST['gotoMonth'])):
			
				$calendar_id = (isset($_POST['calendar_id']) ? $_POST['calendar_id'] : false);
				$timestamp = ($_POST['gotoMonth'] != 'false' ? strtotime($_POST['gotoMonth']) : current_time('timestamp'));
		
				$year = date_i18n('Y',$timestamp);
				$month = date_i18n('m',$timestamp);
		
				booked_admin_calendar($year,$month,$calendar_id);
			
			endif;
			wp_die();
			
		}
		
		// Calendar Day
		public function booked_admin_calendar_date(){
			
			if (isset($_POST['date'])):
			
				$calendar_id = (isset($_POST['calendar_id']) ? $_POST['calendar_id'] : false);
				booked_admin_calendar_date_content($_POST['date'],$calendar_id);
			
			endif;
			wp_die();
			
		}
		
		// Calendar Date Square
		public function booked_admin_refresh_date_square(){
			
			if (isset($_POST['date'])):
			
				$calendar_id = (isset($_POST['calendar_id']) ? $_POST['calendar_id'] : false);
				booked_admin_calendar_date_square($_POST['date'],$calendar_id);
			
			endif;
			wp_die();
			
		}
		
		// User Info Modal
		public function booked_admin_user_info_modal(){
			
			if (isset($_POST['user_id'])):
			
				include(BOOKED_AJAX_INCLUDES_DIR . 'admin/user-info.php');
			
			endif;
			wp_die();
			
		}
		
		// New Appointment Form
		public function booked_admin_new_appointment_form(){
			
			if (isset($_POST['date']) && isset($_POST['timeslot'])):
			
				include(BOOKED_AJAX_INCLUDES_DIR . 'admin/appointment-form.php');
			
			endif;
			wp_die();
			
		}
		
		
	}
}