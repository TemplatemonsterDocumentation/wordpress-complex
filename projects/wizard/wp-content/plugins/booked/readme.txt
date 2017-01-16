=== Booked ===
Donate link: https://boxystudio.com/#coffee
Tags: appointment, appointments
Requires at least: 4.0
Tested up to: 4.6.1
Stable tag: 4.6.1

Powerful appointment booking made simple.

== Changelog ==

= 1.9.7 =
* **NEW:** You can now create a "/booked/" folder in your theme or child theme and include your own custom "email-template.html" file that Booked will use in place of the default one (be sure to copy the original from /booked/includes/email-template.html first).
* *FIX:* Fixed Dashboard Widget to include Guest's last name.
* *FIX:* Fixed some responsive issues related to the calendar list style. i.e. `[booked-calendar style="list"]`

= 1.9.6 =
* *FIX:* Fixed an issue where the admin calendar "Other Appointments" list would have issues with names not showing up or appointment details not displaying when clicked.
* *FIX:* Fixed an issue with the registration form when "Last Name" is required.

= 1.9.5 =
* **NEW:** "Forgot Password" form now included with modal booking form (non-multisite only)
* *FIX:* Added an "ID" on each Custom Field for custom javascript functionality.
* *FIX:* Fixed an issue where "Last Name" was not showing up in a lot of email notifications.
* *FIX:* The "Date Picker" in Settings now shows the formatted date (in your set language) for better translation.

= 1.9.4 =
* *FIX:* Fixed a javascript issue affecting IE 10.
* *FIX:* Fixed an issue related to Custom Time Slots when using multiple Booking Agents.

= 1.9.3 =
* *FIX:* Fixed an issue where a booking wouldn't be available anymore (even when it still was).
* *FIX:* Fixed an issue with the booking javascript functionality.

= 1.9.2 =
* *FIX:* Fixed major issues related to Guest Mode.

= 1.9.1.1 =
* **NEW:** Added "Last Name" (if enabled) to registration form.
* *FIX:* Fixed issues with incorrect errors showing up in the booking form.

= 1.9.1 =
* *FIX:* Fixed an issue affecting IE 10.

= 1.9 =
* **NEW:** "Last Name" is now an option for the registration form, enabled from the Settings panel.
* **NEW:** Backend calendar now allows admins to add appointments to any date/time, even in the past.
* *FIX:* Fixed an issue where custom time slot titles did not show up on Admin calendar.
* *FIX:* Fixed an issue with special characters not working on custom time slot titles.
* *FIX:* Name/email now appears in reminders for guest bookings.

= 1.8.05 =
* *FIX:* Fixed the timeout bug when Booked is active. Sorry about this everyone!

= 1.8.04 =
* *FIX:* Another quick bug fix.

= 1.8.03 =
* *FIX:* Quick bug fix.

= 1.8.02 =
* *FIX:* More quick fixes related to "Custom Time Slot" creation and usage.

= 1.8.01 =
* *FIX:* Some quick bug fixes related to "Time Slot" and "Custom Time Slot" creation.

= 1.8.0 =
* **NEW:** Appointment Reminders: Booked will now send out appointment reminders on intervals that you set. You can send reminders to both the administrators/booking agents and customers.
* **NEW:** Time Slot Titles: Now you can set a title for newly created time slots. This allows you to display a title and time (or just the title) for your available slots.
* *FIX:* Language file update.
* *FIX:* WPML config update (to support email reminder translations).
* *FIX:* Various other bug fixes throughout.

= 1.7.16 =
* *FIX:* Fixed an issue with appointments not being bookable in some cases after clicking on an appointment slot.
* *FIX:* Fixed an issue with emails not sending out when using Booked with the WooCommerce add-on.

= 1.7.15 =
* *FIX:* Includes fixes for the WooCommerce Add-On update (v1.2.22).
* *FIX:* Added last-second checks to be sure appointment is still available before booking it (prevents double-bookings).

= 1.7.14 =
* **NEW:** Added a new capability called "manage_booked_options" that applies to administrators to allow a role to access the full Booked Settings panel like an administrator does. You can use a plugin like [User Roles and Capabilities](https://wordpress.org/plugins/user-roles-and-capabilities/) to accomplish this. 

= 1.7.13 =
* *FIX:* Small updates and fixes throughout.

= 1.7.12 =
* *FIX:* Fixes with appointments not showing up properly in some cases.

= 1.7.11 =
* *FIX:* Several fixes with certain tokens not working in notification emails.
* *FIX:* Several improvements and fixes to the booking form modal on mobile devices.
* *FIX:* Fixed an issue with AJAX not working with subfolder WordPress installs.

= 1.7.10 =
* **NEW:** More buffer options.
* *FIX:* Fixed a few issues with admin booking.

= 1.7.9 =
* **NEW:** Added the ability to "Delete Passed", "Delete All", and "Approve All" to the Pending Appointments list.
* *FIX:* Fixed an issue where the booking form would keep loading on submit.
* *FIX:* Fixed an issue when using the Booked WooCommerce Add-On.
* *FIX:* Minor stylistic fixes.

= 1.7.8 =
* **NEW:** WordPress 4.5 Ready!
* **NEW:** Proper AJAX loading (should fix a lot of issues where this was a problem).
* **NEW:** Email not required anymore for Guest Bookings (unless you make it required from the Settings panel).
* **NEW:** New users can now set their own password, and can log in using email address.
* *FIX:* Guest Bookings show up properly in public front-end appointment list (if enabled).
* *FIX:* Guest booking names/emails are properly included with Export now.
* *FIX:* Fixes with appointment list display.
* *FIX:* "Add to Calendar" button will now show up with [booked-appointments] shortcode.
* *FIX:* Calendar Name now shows up with the CSV Export.

= 1.7.7 =
* **NEW:** Replaced "Add to Google" with "Add to Calendar", which now includes many more options.
* *FIX:* Fixed a few stylistic issues with the calendar borders and modal window scrollbars (Firefox)
* *FIX:* Fixed an issue where the "end time" would show up in emails when "Hide end times" is active.
* *FIX:* Fixed a fairly major bug with the "Prevent Before/After" settings.

= 1.7.6 =
* *FIX:* Fixed a date formatting issue with the datepicker on the settings panel.
* *FIX:* Some other very minor bug fixes.

= 1.7.5 =
* **NEW:** Added a date picker to the appointment list view to jump to a specific day.
* **NEW:** Added an Admin Bar dropdown menu for quick access anywhere (with option to hide it).
* *FIX:* Lots of bug fixes with the calendar/list displays (showing the correct start date, etc.).
* *FIX:* Fixed an ordering issue with the Upcoming Appointments Dashboard widget.
* *FIX:* Taller modal window, especially on smaller screens.
* *FIX:* Fixed more than several bugs with custom time slots.
* *FIX:* Some minor language file updates.

= 1.7.4 =
* *FIX:* Fixed the "No Redirect" option for appointments in "List View".
* *FIX:* More language fixes/updates.
* *FIX:* More front-end stylistic adjustments.

= 1.7.3 =
* **NEW:** Changed "Time Slots Available" to "Spaces Available" in most places.
* **NEW:** Booked now hides the "# Spaces Available" text in the appointment list if you cannot book it anymore.
* *FIX:* Language file fixes/update.
* *FIX:* Admin stylistic adjustments.
* *FIX:* Front-end stylistic adjustments.

= 1.7.2 =
* *FIX:* Language file update.
* *FIX:* Bug fixes update.

= 1.7.1 =
* **NEW:** A "Public Appointments" option has been added. Now you can display (on the front-end) who has booked each time slot. Great for meeting rooms, etc.
* **NEW:** Added a link to the top of the Settings panel to get back to the "Welcome to Booked" screen.
* *FIX:* The issue with booking on the correct appointment "list view" calendar has been fixed.
* *FIX:* The calendar switcher on the appointment "list view" has been fixed. Sorry about that!
* *FIX:* Admin calendar arrows stylistic fix (for sites with no custom calendars).
* *FIX:* A few smaller bugs from 1.7.0 have been squashed!

= 1.7.0 =
* **NEW:** Complete styling update. Appointment calendars, modal windows, animations and more have all been majorly polished.
* **NEW:** The front-end Profile has been redesigned. The nearly pointless "Website" and "Short Bio" fields have been removed to clean it up.
* **NEW:** The new [booked-profile] shortcode is now used to display the Profile (instead of choosing a page in the Settings panel).
* **NEW:** The [booked-calendar] shortcode has a new "style" setting to display a single day "list" instead of the full calendar. (i.e. [booked-calendar **style="list"**])
* **NEW:** The [booked-calendar] shortcode has a new "day" setting to display a specific day (for use in conjunction with the "list" style above). (i.e. [booked-calendar month="4" **day="2"**])
* **NEW:** Added the ability to export appointments to a CSV file with multiple options for output. (All Appointments, Pending, Approved, Upcoming, Past, etc.)
* **NEW:** A new *"Text Content"* custom field is now available (to add text/html content to your booking form).
* **NEW:** You can now choose a specific month and/or year for the calendar widget.
* **NEW:** New option to not redirect anywhere upon booking (makes it easier to book multiple appointments).
* **NEW:** "Guest Mode" now works with the WooCommerce add-on.
* **NEW:** Email content textareas on the Settings page are now visual editors.
* **NEW:** Added options to globally prevent appointments from getting booked before and after specific dates.
* **NEW:** Added more hide/show options for the calendar elements.
* *FIX:* Better WPML support.
* *FIX:* If no appointments are available in the current month, the next available month will be displayed (only if you have not specified a month and/or year in the calendar shortcode).
* *FIX:* Fixed a bug where a start of week setting of "Monday" would still start with "Sunday".
* *FIX:* Cancellation emails are no longer sent out if the appointment has passed.
* *FIX:* Fixed a bug where the page would reload inside the calendar before redirecting (for new registrations).
* *FIX:* Bug fixes throughout.

= 1.6.20 =
* *FIX:* Added a fix for the Booked WooCommerce Add-On to support approval emails getting sent out when an order is complete.
* **NEW:** Added a few new "actions" for the upcoming Twilio SMS Add-On.

= 1.6.15 =
* *FIX:* Fixed an issue where the calendar would sometimes break when weekends are hidden.

= 1.6.14 =
* *FIX:* Fixed an issue where booked dates would sometimes still show as available.

= 1.6.13 =
* **NEW:** FontAwesome 4.5.0 update.

= 1.6.12 =
* *FIX:* Adjusted a few things to allow Booked to work well with the Sage theme framework.
* *FIX:* Added an end time to the %time% token for emails.
* **NEW:** New plugin update server has been implemented.

= 1.6.11 =
* *FIX:* Fixed an issue with the available appointment count for days with custom time slots.
* *FIX:* Fixed an issue with the available appointment count when there's an appointment buffer.

= 1.6.10 =
* *FIX:* The "approved" email is now sent out instead of the "confirmation" email when an admin/agent manually books the appointment from the backend.
* *FIX:* Fixed an issue where the count would be incorrect on the front-end calendar.
* *FIX:* Fixed issues with "All Day" appointments.
* *FIX:* Fixed an issue with the calendar layout when you hide the weekends.

= 1.6.02 =
* *FIX:* Quick bug fix on the front-end calendar.

= 1.6.01 =
* **NEW:** You can now add custom fields per calendar. Have at it!
* **NEW:** Booking Agents have access to their Default Time Slots, Custom Time Slots, and Custom Fields from the backend.
* **NEW:** Added the option: "Hide weekends on calendars".
* **NEW:** Added the option: "Hide unavailable time slots completely (from the front-end)".
* **NEW:** Added the option: "Do not allow users to cancel their own appointments."
* **NEW:** HTML is now allowed for Custom Field labels.
* **NEW:** Appointment counts have been added to the admin calendar tabs.
* *FIX:* On the front-end, a day will now show as unavailable (not clickable) if the last appointment time has passed.
* *FIX:* Other bug fixes throughout!

= 1.5.9 =
* *FIX:* Adjusted the popup to fix the scrolling issues on some browsers.
* *FIX:* Fixed widget-related issues with WordPress 4.3.
* *FIX:* Changed how the color theme is loaded to prevent server issues.
* *FIX:* Allow more than one calendar shortcode to display on a page.
* *FIX:* Added missing "All day" translations.
* *FIX:* Fixed an issue with invalid usernames (when special characters are used to register).
* *FIX:* Fixed an issue with the Calendar Name not showing with appointments linked to a new registration.
* *FIX:* Appointment confirmations will now get sent out no matter what for appointments linked to a new registration.
* *FIX:* Removed tooltips from days not available and/or on a different month on the front-end calendar.
* *FIX:* Adjusted max height of appointment list on mobile to show a little more.
* *FIX:* Other minor bug fixes throughout.

= 1.5.8 =
* *FIX:* Minor bug fixes throughout.

= 1.5.7 =
* **NEW:** Added an option to "Redirect users from /wp-admin/ back to their profile page (if set) or homepage (if no profile page is set)."
* **NEW:** Added options to disable the Avatar, Website, and/or Short Bio on the Profile screen.
* **NEW:** Added calendar selection option to Appointment Calendar widget.
* *FIX:* The upcoming appointments dashboard widget is now hidden from subscribers.
* *FIX:* Confirmation emails get sent out properly now.

= 1.5.6 =
* *FIX:* Fixed some display name issues.
* *FIX:* Added support for the "Booked Front-end Agents" add-on.

= 1.5.5 =
* **NEW:** Added an "Appointment History" tab to the profile so your customers can see their past appointments.
* *FIX:* Fixed an issue where the %calendar% token wouldn't show up in "New Appointment" emails.
* *FIX:* A few other bug fixes throughout.

= 1.5.4 =
* *FIX:* Fixed an issue where the Approve button wouldn't show up on already approved appointments.
* *FIX:* Adds support for the most recent version of "Booked Payments with WooCommerce"

= 1.5.3 =
* *FIX:* Fixed "confirmed" color issue (on Profile page) with translated plugins.
* *FIX:* Fixed some other translation issues.

= 1.5.2 =
* *FIX:* The Dashboard Widget now only shows the intentioned "Approved" upcoming appointments.
* *FIX:* If the available add-ons don't load, there is now a link to purchase them direct from our website.
* *FIX:* If you have the "Booked Payments with WooCommerce" plugin installed, an issue with certain settings being displayed has been fixed.
* *FIX:* Language file update to fix missing translations.

= 1.5.1 =
* *FIX:* Fixed an issue where some users could not view/edit the back-end calendars or pending list anymore.

= 1.5 =
* **NEW:** Guest Booking! You can now optionally switch the booking type to "Guest Booking". (Appointments > Settings > General tab)
* **NEW:** Added a new user role called **"Booking Agent"**. Booking Agents can be assigned to calendars and then log in to manage *ONLY* those calendars.
* **NEW:** Added **%email%** and **%calendar%** email tokens to display the customer's email address and the appointment's calendar name (if available).
* **NEW:** Added an option to hide the "Default" calendar from the front-end calendar switcher.
* **NEW:** Added a tooltip to the calendar dates on the front-end to show how many time slots are available for that particular day.
* *FIX:* Did some styling updates to the booking form to make the custom fields match the registration fields a bit better.
* *FIX:* Added a "Registration" title and some simple instructions to the booking form (can be changed via the language file).
* *FIX:* Fixed hover state and changed text for "Unavailable" appointments on the front-end calendar.
* *FIX:* Removed requirement for *cal_days_in_month()* function.

= 1.4.9 =
* **NEW:** Adds support for the new *Booked Payments with WooCommerce* add-on (coming 4/29/15). Check *Appointments > Add-Ons* for details!
* *FIX:* Some smaller adjustments throughout.

= 1.4.8 =
* **NEW:** This update supports the new **Booked Add-Ons** functionality. Take a look at *Appointments > Add-Ons* after updating!

= 1.4.7 =
* *FIX:* Character encoding issues fixed for emails.
* *FIX:* Fixed some timezone-related issues.
* *FIX:* Numerous other bug fixes throughout.

= 1.4.6 =
* *FIX:* Character encoding issues fixes.

= 1.4.5 =
* *FIX:* Fixed a few new translation issues
* *FIX:* Fixed a conflict with some translated day names
* *FIX:* Now shows first and last name in emails (when available)
* *FIX:* More character encoding issues fixed

= 1.4.4 =
* *FIX:* Fixed a header styling issue on the Profile template.
* *FIX:* Fixed some translation issues
* *FIX:* REALLY fixed the issue where accents would not show up properly. (UTF-8 encoding issue)

= 1.4.3 =
* *FIX:* Fixes an AJAX loading issue from v1.4.2 on some WordPress installs.

= 1.4.2 =
* *FIX:* Fixed a conflict with the Cooked plugin.
* *FIX:* Fix the front-end calendar styling issues on mobile (weird borders).
* *FIX:* Fixed an issue where accents would not show up properly in emails. (UTF-8 encoding issue)
* *FIX:* Some other quick bug fixes.

= 1.4.1 =
* *FIX:* Fixed the styling issues with sites using different languages.
* *FIX:* Some other quick bug fixes.

= 1.4 =
* **NEW:** Custom time slots! Refer to the [documentation](http://docs.boxystudio.com/plugins/booked/custom-time-slots/) for more information.
* **NEW:** Added the ability to assign calendars to a user (so they get the emails).
* **NEW:** Added an "Upcoming Appointments" WordPress admin dashboard widget.
* **NEW:** Added "All Day" time slots.
* **NEW:** Added an option to ONLY show start times, not end times.
* **NEW:** Visually show stale appointments in pending list.
* **NEW:** Added an option to the calendar shortcode to set the start month/year.
* **NEW:** Added an option to the calendar shortcode to display a switcher dropdown to switch between calendars.
* **NEW:** Profile is now tabbed and more user friendly.
* **NEW:** Added the "Calendar Name" to user's appointments list.
* **NEW:** Added an option to choose a page for booking redirection (instead of the Profile).
* **NEW:** Added an option to choose a page for login redirection (instead of a refresh).
* **NEW:** Added option to hide Google Calendar link.
* **NEW:** Added sign in option to the booking form if logged out.
* **NEW:** Added captcha (optional) to registration/booking form.
* *FIX:* Applied wp_reset_postdata() after shortcodes.
* *FIX:* Loaded Google fonts with // instead of http:// to support SSL sites.
* *FIX:* Show Username if no first/last name exists.
* *FIX:* Fixed some stylistic issues
* *FIX:* Fixed an issue where the "Cancel" button didn't show up.
* *FIX:* Fixed javascript conflict issues with some setups.

= 1.3.6 =
* *FIX:* Some mobile stylistic fixes.

= 1.3.5 =
* *FIX:* Fixed some stylistic issues with certain themes.
* *FIX:* Fixed an issue where the "Cancel" button might not show up with appointments.
* *FIX:* Fixed an issue where the calendar wasn't loading correctly on some sites.
* *FIX:* Fixed an issue where the uploaded email logo would disappear from Settings panel.

= 1.3 =
* **NEW:** Multiple Calendars!
* **NEW:** Default time slots for each custom calendar (optional)
* **NEW:** Shortcode tab for easy access to the Booked shortcode list.

= 1.2.2 =
* *FIX:* Fixed a bunch of timezone issues.

= 1.2.1 =
* *FIX:* Fixed a bug where in rare cases a booked appointment would show on the wrong day in the admin.

= 1.2 =
* **NEW:** Custom fields are here! Just go to "Appointments > Settings > Custom Fields" to set them up.
* **NEW:** A new email template that you can customize with your logo (or heading image).
* *FIX:* Fixed an "invalid username" issue.
* *FIX:* Time slots can now be entered up to 12:00am the next day.

= 1.1.2 =
* *FIX:* Fixed some translation issues
* *FIX:* Fixed a PHP notice error.
* Bigger updates coming soon!

= 1.1.1 =
* *FIX:* Fixed an issue when saving the default timeslot intervals.

= 1.1 =
* **NEW:** A "Cancellation Buffer" setting so that the customer cannot cancel when it gets too close to the appointment date/time.
* **NEW:** An "Appointment Limit" setting so the customer cannot book more than X upcoming appointments.
* **NEW:** A [booked-appointments] shortcode to list the currently logged-in user's appointments anywhere on your site.
* **NEW:** Added more interval options for default time slots (45 minutes, 1:30, etc.).
* **NEW:** Added a "time between" option (5 minutes, 10 minutes, etc.) for default appointment time slots.
* **NEW:** Added an option to automatically approve appointments as they come in.
* *FIX:* The pending appointments dialog is now hidden if you're not logged in as an admin.

= 1.0.1 =
* **NEW:** Added an appointment booking buffer to prevent people from booking appointments to close to current date and/or time.
* **NEW:** Added "Google Calendar" buttons to appointment list on profile page.
* **NEW:** Added some color pickers to the Settings panel to change the front-end calendar colors.
* *FIX:* Some quick and minor bug fixes.

= 1.0.0 =
* Initial Release!