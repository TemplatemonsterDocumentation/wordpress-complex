<?php
	
/*
Color Theme Template
*/

$button_color = get_option('booked_button_color','#56c477');
$light_color = get_option('booked_light_color','#c4f2d4');
$dark_color = get_option('booked_dark_color','#039146');

?>

/* Light Color */
body #booked-profile-page input[type=submit].button-primary:hover,
body .booked-list-view button.button:hover, body .booked-list-view input[type=submit].button-primary:hover,
body table.booked-calendar input[type=submit].button-primary:hover,
body .booked-modal input[type=submit].button-primary:hover,
body table.booked-calendar thead,
body table.booked-calendar thead th,
body table.booked-calendar .booked-appt-list .timeslot .timeslot-people button:hover,
body #booked-profile-page .booked-profile-header,
body #booked-profile-page .booked-tabs li.active a,
body #booked-profile-page .booked-tabs li.active a:hover,
body #booked-profile-page .appt-block .google-cal-button > a:hover
{ background:<?php echo $light_color; ?> !important; }

body #booked-profile-page input[type=submit].button-primary:hover,
body table.booked-calendar input[type=submit].button-primary:hover,
body .booked-list-view button.button:hover, body .booked-list-view input[type=submit].button-primary:hover,
body .booked-modal input[type=submit].button-primary:hover,
body table.booked-calendar th,
body table.booked-calendar .booked-appt-list .timeslot .timeslot-people button:hover,
body #booked-profile-page .booked-profile-header,
body #booked-profile-page .appt-block .google-cal-button > a:hover
{ border-color:<?php echo $light_color; ?> !important; }


/* Dark Color */
body table.booked-calendar tr.days,
body table.booked-calendar tr.days th,
body .booked-calendarSwitcher.calendar,
body .booked-calendarSwitcher.calendar select,
body #booked-profile-page .booked-tabs
{ background:<?php echo $dark_color; ?> !important; }

body table.booked-calendar tr.days th,
body #booked-profile-page .booked-tabs
{ border-color:<?php echo $dark_color; ?> !important; }


/* Primary Button Color */
body #booked-profile-page input[type=submit].button-primary,
body table.booked-calendar input[type=submit].button-primary,
body .booked-list-view button.button, body .booked-list-view input[type=submit].button-primary,
body .booked-list-view button.button, body .booked-list-view input[type=submit].button-primary,
body .booked-modal input[type=submit].button-primary,
body table.booked-calendar .booked-appt-list .timeslot .timeslot-people button,
body #booked-profile-page .booked-profile-appt-list .appt-block.approved .status-block,
body #booked-profile-page .appt-block .google-cal-button > a,
body .booked-modal p.booked-title-bar,
body table.booked-calendar td:hover .date span,
body .booked-list-view a.booked_list_date_picker_trigger.booked-dp-active,
body .booked-list-view a.booked_list_date_picker_trigger.booked-dp-active:hover,
.booked-ms-modal .booked-book-appt /* Multi-Slot Booking */
{ background:<?php echo $button_color; ?>; }

body #booked-profile-page input[type=submit].button-primary,
body table.booked-calendar input[type=submit].button-primary,
body .booked-list-view button.button, body .booked-list-view input[type=submit].button-primary,
body .booked-list-view button.button, body .booked-list-view input[type=submit].button-primary,
body .booked-modal input[type=submit].button-primary,
body #booked-profile-page .appt-block .google-cal-button > a,
body table.booked-calendar .booked-appt-list .timeslot .timeslot-people button,
body .booked-list-view a.booked_list_date_picker_trigger.booked-dp-active,
body .booked-list-view a.booked_list_date_picker_trigger.booked-dp-active:hover
{ border-color:<?php echo $button_color; ?>; }

body .booked-modal .bm-window p i.fa,
body .booked-modal .bm-window a,
body .booked-appt-list .booked-public-appointment-title,
body .booked-modal .bm-window p.appointment-title,
.booked-ms-modal.visible:hover .booked-book-appt
{ color:<?php echo $button_color; ?>; }

.booked-appt-list .timeslot.has-title .booked-public-appointment-title { color:inherit; }