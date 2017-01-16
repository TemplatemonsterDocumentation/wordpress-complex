<div id="booked-welcome-screen">
	<div class="wrap about-wrap">
		<h1><?php echo sprintf(esc_html__('Welcome to %s','booked'),'Booked '.BOOKED_VERSION); ?></h1>
		<div class="about-text">
			<?php echo sprintf(esc_html__('Thank you for choosing %s! If this is your first time using %s, you will find some helpful "Getting Started" links below. If you just updated the plugin, you can find out what\'s new in the "What\'s New" section below.','booked'),'Booked','Booked'); ?>
		</div>
		<div class="booked-badge">
			<img src="<?php echo BOOKED_PLUGIN_URL; ?>/templates/images/badge.png">
		</div>
		
		<div id="welcome-panel" class="welcome-panel">
			
			<img src="<?php echo BOOKED_PLUGIN_URL; ?>/templates/images/welcome-banner.jpg" class="booked-welcome-banner">
			
			<div class="welcome-panel-content">
				<div class="welcome-panel-column-container">
					<div class="welcome-panel-column">
					
						<iframe src="https://player.vimeo.com/video/155600760?color=56c477&title=0&byline=0&portrait=0" width="320" height="180" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen style="margin-top:5px;"></iframe>
						
						<h3 style="margin-top:30px;"><?php esc_html_e('Getting Started','booked'); ?></h3>
						<ul>
							<li><a href="https://boxystudio.ticksy.com/article/3239/" target="_blank" class="welcome-icon welcome-learn-more"><?php esc_html_e('Installation & Setup Guide','booked'); ?></a>&nbsp;&nbsp;<i class="fa fa-external-link"></i></li>
							<li><a href="https://boxystudio.ticksy.com/article/6268/" target="_blank" class="welcome-icon welcome-learn-more"><?php esc_html_e('Custom Calendars','booked'); ?></a>&nbsp;&nbsp;<i class="fa fa-external-link"></i></li>
							<li><a href="https://boxystudio.ticksy.com/article/3238/" target="_blank" class="welcome-icon welcome-learn-more"><?php esc_html_e('Default Time Slots','booked'); ?></a>&nbsp;&nbsp;<i class="fa fa-external-link"></i></li>
							<li><a href="https://boxystudio.ticksy.com/article/3233/" target="_blank" class="welcome-icon welcome-learn-more"><?php esc_html_e('Custom Time Slots','booked'); ?></a>&nbsp;&nbsp;<i class="fa fa-external-link"></i></li>
							<li><a href="https://boxystudio.ticksy.com/article/6267/" target="_blank" class="welcome-icon welcome-learn-more"><?php esc_html_e('Custom Fields','booked'); ?></a>&nbsp;&nbsp;<i class="fa fa-external-link"></i></li>
							<li><a href="https://boxystudio.ticksy.com/article/3240/" target="_blank" class="welcome-icon welcome-learn-more"><?php esc_html_e('Shortcodes','booked'); ?></a>&nbsp;&nbsp;<i class="fa fa-external-link"></i></li>
						</ul>
						<a class="button" style="margin-bottom:15px; margin-top:0;" href="https://boxystudio.ticksy.com/articles/7827/" target="_blank"><?php esc_html_e('View all Guides','booked'); ?>&nbsp;&nbsp;<i class="fa fa-external-link"></i></a>&nbsp;
						<a class="button button-primary" style="margin-bottom:15px; margin-top:0;" href="<?php echo get_admin_url().'admin.php?page=booked-settings'; ?>"><?php esc_html_e('Get Started','booked'); ?></a>
						
					</div>
					<div class="welcome-panel-column welcome-panel-last welcome-panel-updates-list">			
						<h3><?php echo sprintf( esc_html__("What's new in %s?","booked"), BOOKED_VERSION); ?> <a href="http://boxyupdates.com/changelog.php?p=booked" target="_blank"><?php esc_html_e('Full Changelog','booked'); ?>&nbsp;&nbsp;<i class="fa fa-external-link"></i></a></h3>
						<ul class="booked-whatsnew-list">
							<li><strong class="new">New</strong> You can now create a "/booked/" folder in your theme or child theme and include your own custom "email-template.html" file that Booked will use in place of the default one (be sure to copy the original from /booked/includes/email-template.html first).</li>
							<li><em class="fix">Fixed</em> Fixed Dashboard Widget to include Guest's last name.</li>
							<li><em class="fix">Fixed</em> Fixed some responsive issues related to the calendar list style.<br>ex. <code>[booked-calendar style="list"]</code></li>
						</ul>
						<br>
						
						<h3><?php echo sprintf(esc_html__('%s Updates','booked'),'1.9.1 &mdash; 1.9.6'); ?></h3>
						<ul class="booked-whatsnew-list">
							<li><em class="fix">Fixed</em> Fixed an issue where the admin calendar "Other Appointments" list would have issues with names not showing up or appointment details not displaying when clicked.</li>
							<li><em class="fix">Fixed</em> Fixed an issue with the registration form when "Last Name" is required.</li>
							<li><strong class="new">New</strong> "Forgot Password" form now included with modal booking form (non-multisite only).</li>
							<li><strong class="new">New</strong> Added "Last Name" (if enabled) to registration form.</li>
							<li><em class="fix">Fixed</em> Added an "ID" on each Custom Field for custom javascript functionality.</li>
							<li><em class="fix">Fixed</em> Fixed an issue where "Last Name" was not showing up in a lot of email notifications.</li>
							<li><em class="fix">Fixed</em> The "Date Picker" in Settings now shows the formatted date (in your set language) for better translation.</li>
							<li><em class="fix">Fixed</em> Fixed a javascript issue affecting IE 10.</li>
							<li><em class="fix">Fixed</em> Fixed an issue related to Custom Time Slots when using multiple Booking Agents.</li>
							<li><em class="fix">Fixed</em> Fixed an issue where a booking wouldn't be available anymore (even when it still was).</li>
							<li><em class="fix">Fixed</em> Fixed an issue with the booking javascript functionality.</li>
							<li><em class="fix">Fixed</em> Fixed major issues related to Guest Mode.</li>
							<li><em class="fix">Fixed</em> Fixed issues with incorrect errors showing up in the booking form.</li>
						</ul>
						<br>
						
						<h3><?php echo sprintf(esc_html__('%s Update','booked'),'1.9'); ?></h3>
						<ul class="booked-whatsnew-list">
							<li><strong class="new">New</strong> "Last Name" is now an option for the registration form, enabled from the Settings panel.</li>
							<li><em class="fix">Fixed</em> Fixed an issue with Custom Time Slot titles not showing up on admin calendar.</li>
							<li><em class="fix">Fixed</em> Fixed an issue with special characters in Custom Time Slot titles.</li>
							<li><em class="fix">Fixed</em> Fixed an issue where a "Guest" name would not appear in reminder emails.</li>
							<li><em class="fix">Fixed</em> Backend calendar now allows admins to add appointments to any date/time, even in the past.</li>
						</ul>
						<br>
						
						<h3><?php echo sprintf(esc_html__('%s Updates','booked'),'1.8.0 &mdash; 1.8.05'); ?></h3>
						<ul class="booked-whatsnew-list">
							<li><strong class="new">New</strong> <strong>Appointment Reminders:</strong> Booked will now send out appointment reminders on intervals that you set from the <strong><a href="<?php echo admin_url(); ?>admin.php?page=booked-settings#email-settings">Email Settings</a></strong> tab. You can send reminders to both the administrators/booking agents and customers.</li>
							<li><strong class="new">New</strong> <strong>Time Slot Titles:</strong> Now you can set a title for newly created <strong><a href="<?php echo admin_url(); ?>admin.php?page=booked-settings#defaults">time slots</a></strong> and <strong><a href="<?php echo admin_url(); ?>admin.php?page=booked-settings#custom-timeslots">custom time slots</a></strong>. This allows you to display a title and time (or just the title) for your available slots.</li>
							<li><em class="fix">Fixed</em> Fixed the timeout bug when Booked is active.</li>
							<li><em class="fix">Fixed</em> Fixes related to "Custom Time Slot" creation and usage.</li>
							<li><em class="fix">Fixed</em> Fixes related to "Time Slot" and "Custom Time Slot" creation.</li>
							<li><em class="fix">Fixed</em> Language file update.</li>
							<li><em class="fix">Fixed</em> WPML config update (to support email reminder translations).</li>
							<li><em class="fix">Fixed</em> Various other bug fixes throughout.</li>
						</ul>
						
					</div>
				</div>
			</div>
		</div>
	</div>
</div>