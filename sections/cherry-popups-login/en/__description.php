<h2>Popup Login Form</h2>

<p>Cherry Popups plugin gives an excellent opportunity to create login forms and add them to your website.</p>


<h3>Login Form</h3>

<figure class="img-polaroid">
    <img src="projects/<?php echo $project;?>/img/images/13.png">
</figure>

<p>To create a new login form, please, create a new popup and select the "Login Form" type in the "Popup Content Type" field.</p>

<p>Now select the custom event type (Click, Hover) and set the selector in the "Custom Opening Event" block. The popup with the login form will open on this selector.</p>

<figure class="img-polaroid">
    <img src="projects/<?php echo $project;?>/img/images/14.png">
</figure>

<p>Next, let's create the login link. It is usually placed in the header area. You also need to check if the user is logged in. To do it add the following action code:</p>

<pre class="unstyled" style="background-color:#f9f9f9; line-height: 30px; width=500px;">do_action('cherry_popups_login_logout_link');</pre>

<p>You can view the example of the log in form on the image below.</p>

<figure class="img-polaroid">
    <img src="projects/<?php echo $project;?>/img/images/15.png">
</figure>
