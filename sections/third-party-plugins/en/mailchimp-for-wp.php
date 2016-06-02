<h3>MailChimp for WordPress</h3>

<p><a href="https://wordpress.org/plugins/mailchimp-for-wp/" target="_blank">MailChimp for WordPress</a> plugin helps you add subscribers to your MailChimp lists using various methods. You can create good looking opt-in forms or integrate with any other form on your site, like your comment form or WooCommerce checkout.</p>
	
<h4>Installing MailChimp for WordPress</h4>

<p>Like other free WordPress plugins, installing the MailChimp for WordPress is quite an easy procedure. All you need is a MailChimp account and a self-hosted website.</p>

<ol class="index-list">
	<li><p>In your WordPress admin panel, go to <strong>Plugins > New Plugin</strong>, search for MailChimp for WordPress and click "<strong>Install now</strong>"</p></li>
	<li><p>Alternatively, <a href="https://wordpress.org/plugins/mailchimp-for-wp/installation/" target="_blank">download the plugin</a> and upload the contents of mailchimp-for-wp.zip to your plugins directory, which usually is /wp-content/plugins/.</p></li>
	<li><p>Activate the plugin.</p></li>
	<li><p>Set your <a href="https://login.mailchimp.com/?referrer=%2Faccount%2Fapi%2F" target="_blank">MailChimp API key</a> in the plugin settings.</p></li>
</ol>
<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/third-party-plugins/mailchimp-wp-1.png">
</figure>


<h4>Forms</h4>

<h5>MailChimp specific settings</h5>
<ul class="marked-list">
		<li>
			<dl class="inline-term">
				<dt>Lists this form subscribes to</dt>
				<dd>
					Choose the list.
				</dd>
			</dl>
		</li>
		<li>
			<dl class="inline-term">
				<dt>Use double opt-in?</dt>
				<dd>
					Select "yes" if you want people to confirm their email address before being subscribed (recommended).
				</dd>
			</dl>
		</li>
		<li>
			<dl class="inline-term">
				<dt>Update existing subscribers?</dt>
				<dd>
					Select "yes" if you want to update existing subscribers (instead of showing the "already subscribed" message). This option is only available in MailChimp for WordPress Pro.
				</dd>
			</dl>
		</li>
		<li>
			<dl class="inline-term">
				<dt>Replace interest groups?</dt>
				<dd>
					Select "yes" if you want to replace the interest groups with the groups provided instead of adding the provided groups to the member's interest groups (only when updating a subscriber). This option is only available in MailChimp for WordPress Pro.
				</dd>
			</dl>
		</li>
	</ul>

<h5>Form behaviour</h5>
<ul class="marked-list">
		<li>
			<dl class="inline-term">
				<dt>Hide form after a successful sign-up?</dt>
				<dd>
					Select "yes" to hide the form fields after a successful sign-up.
				</dd>
			</dl>
		</li>
		<li>
			<dl class="inline-term">
				<dt>Redirect to URL after successful sign-ups</dt>
				<dd>
					Leave empty or enter 0 for no redirect. Otherwise, use complete (absolute) URLs, including http://.
				</dd>
			</dl>
		</li>
	</ul>	
<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/third-party-plugins/mailchimp-wp-2.png">
</figure>

<h5>Form Messages</h5>
<ul class="marked-list">
		<li>
			<dl class="inline-term">
				<dt>Successfully subscribed</dt>
				<dd>
					The text that shows when an email address is successfully subscribed to the selected list(s).
				</dd>
			</dl>
		</li>
		<li>
			<dl class="inline-term">
				<dt>Invalid email address</dt>
				<dd>
					The text that shows when an invalid email address is given.
				</dd>
			</dl>
		</li>
		<li>
			<dl class="inline-term">
				<dt>Required field missing</dt>
				<dd>
					The text that shows when a required field for the selected list(s) is missing.
				</dd>
			</dl>
		</li>
		<li>
			<dl class="inline-term">
				<dt>Already subscribed</dt>
				<dd>
					The text that shows when the given email is already subscribed to the selected list(s).
				</dd>
			</dl>
		</li>
		<li>
			<dl class="inline-term">
				<dt>General error</dt>
				<dd>
					The text that shows when a general error occured.
				</dd>
			</dl>
		</li>
		<li>
			<dl class="inline-term">
				<dt>Unsubscribed</dt>
				<dd>
					When using the unsubscribe method, this is the text that shows when the given email address is successfully unsubscribed from the selected list(s).
				</dd>
			</dl>
		</li>
		<li>
			<dl class="inline-term">
				<dt>Not subscribed</dt>
				<dd>
					When using the unsubscribe method, this is the text that shows when the given email address is not on the selected list(s).
				</dd>
			</dl>
		</li>
		<li>
			<dl class="inline-term">
				<dt>No list selected</dt>
				<dd>
					WWhen offering a list choice, this is the text that shows when no lists were selected.
				</dd>
			</dl>
		</li>
	</ul>

<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/third-party-plugins/mailchimp-wp-3.png">
</figure>