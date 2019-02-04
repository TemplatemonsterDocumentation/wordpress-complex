<h3>Contact Form 7</h3>

<p><b>Contact form 7</b> plugin can manage multiple contact forms. It also lets you customize the form and the mail contents flexibly with simple markup.</p>

<h4>Displaying a Form</h4>
<p>Let’s start with displaying a form on your page. First, open the <strong>Contact > Contact Forms</strong> menu in your WordPress administration panel.</p>

<p>You can manage multiple contact forms there.</p>

<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/contact-form-0.png">
    </figure>

<p>Just after installing the Contact Form 7 plugin, you’ll see a default form - <b>Contact form 1</b> and a code like this:</p>
<pre class="prettyprint"> [contact-form-7 id="2526" title="Contact form 1"] </pre>

<p>Copy this code. Then open (<strong>Pages > Edit</strong>) of the page where you wish to place the contact form. A popular practice is creating a page named <strong>Contact</strong> for the contact form page. Paste the code you've copied into the contents of the page.</p>

<p>Now your contact form setup is complete. Your site visitors can now find the form and start submitting messages to you.</p>

<p>Next, let’s see how you can customize your form and mail content.</p>

<h4>Customizing a Form</h4>

<p>Title for this contact form is just a label for a contact form and is used for administrative purposes only. You can use any title you like, e.g. <strong>Job Application Form</strong> and so on.</p>

<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/contact-form-1.png">
    </figure>

<p>In the form you can enter different tag generators. They can be generated automatically.</p>
<ul class="marked-list">
<p><li><strong>text</strong> - form-tag generator for text;</li></p>
<p><li><strong>email</strong> - form-tag generator for email;</li></p>
<p><li><strong>text</strong> - form-tag generator for text;</li></p>
<p><li><strong>tel</strong> - form-tag generator for phone numbers;</li></p>
<p><li><strong>date</strong> - form-tag generator for date input;</li></p>
<p><li><strong>text area</strong> - form-tag generator for text areas;</li></p>
<p><li><strong>drop-down menu</strong> - form-tag generator for drop-down menus;</li></p>
<p><li><strong>checkboxes</strong> - form-tag generator for adding chackboxes;</li></p>
<p><li><strong>acceptance</strong> - form-tag generator for creating acceptance checkbox;</li></p>
<p><li><strong>quiz</strong> - form-tag generator for creating a quiz;</li></p>
<p><li><strong>reCapthca</strong> - form-tag generator for adding a captcha;</li></p>
<p><li><strong>file</strong> - form-tag generator for adding files;</li></p>
<p><li><strong>submit</strong> - form-tag generator for creating submit form.</li></p>
</ul>

<p>You can also customize the form content using HTML and form tags. Line breaks and blank lines in this field are automatically formatted with <br/> and <p> HTML tags.</p>

<p>Tag generators (3). By using these tag generators, you can generate form-tags without knowledge of them.</p>

<p>For more information about form-tags, see How Tags Work.</p>

<h4>Mail Tab</h4>

<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/contact-form-2.png">
    </figure>

<p>You can edit the mail template for the mail which is sent in response to a form submission. You can use mail-tags in these fields.</p>

<p>An additional mail template is also available. It is called Mail(2) and its content can differ from the primary Mail template.</p>

<p>For more information, see Setting Up Mail page.</p>

<h4>Messages Tab</h4>

<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/contact-form-3.png">
    </figure>

<p>You can edit various kinds of messages, including <strong>Validation errors occurred,</strong> <strong>Please fill in the required field,</strong> etc.</p>

<p>Make sure that you enter only plain text here.</p>

<div class="alert alert-info">
        HTML tags and entities are not allowed in the message fields.</a></div>
  

<h4>Additional Settings Tab</h4>

<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/contact-form-4.png">
    </figure>


<p>You can add customization code snippets here. For more details, see Contact Form 7.</p>

