<h2>JetEngine Booking Forms Functionality</h2>

<h6>This block provides a detailed guide how to create booking forms using <b>JetEngine Booking Forms</b> functionality.</h6> 


<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/booking/1.png">
    </figure></li></p>



    <div class="alert alert-info">
        Before working with Booking Forms, please make sure to enable it in <b>JetEngine Modules Manager</b>.</div>

<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/booking/2.png">
    </figure></li></p>

<h4>Step 1. Creating a Booking Form</h4>

<h6>From this block you can learn how to create a booking form with custom fields.</h6> 

<ol class="index-list">
<p><li>First, navigate to <b>JetEngine > Booking Forms</b> block. Here click <b>Add New</b> option to add a new booking form.</li></p>

<p><li>Define the custom booking form name.</li></p>

<p><li>Manage the <b>Fields Settings</b>. Here you can add needed fields and submit buttons, which will be displayed in the booking form, and customize them. Also you can set the width of the fields. Click <b>Add Field</b> option to add a new field and <b>Add Submit Button</b> option to add a new submit button to the booking form. Click <b>Apply Changes</b> button every time, when you change the field settings.</li></p>

<p><b>Field</b> block provides such settings:</p>
<ul class="marked-list">
<li><b>Type</b> - here you can specify the type of the field:
<ul class="marked-list">
<li><b>Text</b> - you can choose this field type if you want to add a text field for Text, Email, URL, Tel to the booking form.</li>
<li><b>Textarea</b> - select this type for adding text area, where one can paste text line by line.</li>
<li><b>Hidden</b> - use this type if you want to hide the field on frontend, but you need its value for formulas calculation, for example.</li>
<li><b>Select</b>- this type allows adding a select field where the visitor will be able to select from the set values.</li>
<li><b>Checkboxes</b> - use this type in case you want to add field, where visitor need to tick the checkbox.</li> 
<li><b>Radio</b>- this type allows one to select from the represented options in radio form.</li>
<li><b>Number</b> - choose this type if you want to add the field with quantity selection.</li>
<li><b>Date</b> - this type allows adding the date field.</li>
<li><b>Time</b> - you can select this type if you want to add time field.</li>
<li><b>Calculated</b> - this type allows displaying total value of the fields.</li></ul>

<li><b>Name</b> - here you can define the name of the field.</li>
<li><b>Label</b> - here you can specify the label of the field.</li>
<li><b>Description</b> - here you can add the description to the field.</li>
<li><b>Required</b> - select this option if you want to make the field obligatory.</li>
<li><b>Placeholder</b> – here you can specify the placeholder of the field.</li>
<li><b>Default</b> - here you can define the default value of the field.</li></li></ul>

<p>In case you select <b>Text</b> field type, there is an additional setting:</p>
<ul class="marked-list">
<li><b>Field Type</b> – here you can select an appropriate text field type. It can be Text, Email, URl and Tel.</li></ul>

<p>In case you select <b>Hidden</b> field type, there is an additional setting:</p>
<ul class="marked-list">
<li><b>Field Value</b>> – here you can choose the source of the field value. It can be Current Post ID, Current Post Title or Current Post Meta.</li></ul>

<p>In case you choose <b>Select</b>, <b>Checkboxes</b> and <b>Radio</b> field types, there are additional settings:</p>
<ul class="marked-list">
<li><b>Fill Options From</b> – here specify either you want to fill the options via Manual Input or Meta Field.</li> 
<li><b>Options List</b> – paste value and label of the option. Click <b>Add option</b> button to add one more option.</li>
<li><b>Meta field to get value from</b> – here you can determine the certain meta field, from which to get the value.</li></ul>

<p>In case you choose <b>Number</b> field type, there are additional settings:</p>
<ul class="marked-list">
<li><b>Min Value</b> - here you can specify the minimum number value available for the field.</li>
<li><b>Max Value</b> - here you can specify the maximum number value available for the field.</li></ul>

<p>In case you choose <b>Calculated</b> field type, there are additional settings:</p>
<ul class="marked-list">
<li><b>Calculation Formula</b> - here you can input the certain formula to calculate field value.</li>
<li><b>Decimal Places Number</b> - here you can specify the number of decimals after the separator.</li>
<li><b>Calculated Value Prefix</b> - here you can specify the value pferix of the calculated field.</li>
<li><b>Calculated Value Suffix</b> - here you can specify the value suffix of the calculated field.</li></li>

<p><b>Submit button</b> block provides such settings:</p>
<ul class="marked-list">
<li><b>Label</b> - here you can define the label of the submit button.</li>
<li><b>Custom CSS class</b> - here you can apply custom CSS styles.</li></ul></ul>

<p><li><b>Notifications Settings</b> - here you can adjust different notification settings.
<ul class="marked-list">
<li><b>Type</b> - here you can specify the type of notifications. There are 3 available types:
<ul class="marked-list">
<li><p><b>Send Email</b> - this type allows notifying via email.</p></li>
<li><p><b>Insert Post</b> - this type allows sending posts data.</p></li>
<li><p><b>Call a Hook</b> - this type allows creating custom hook and attaching php function to it in order that this php function will be called in a certain moment. <b>Note:</b> this option for developers.</p></li>

<p>In case you select <b>Send Email</b> type, you need to set the following settings:</p>
<ul class="marked-list">
<li><b>Mail to</b> - here you can define the email adress, where the notifications will be sent to.There are 3 available options: admin email, email from the submited form field and custom email.</li>
<li><b>Subject</b> - here you can specify the subject of the email.</li>
<li><b>From Field</b> - here you need to specify the form field, where the email will be choosen from, if you chose <b>Email from the submited form field</b> option in <b>Mail to</b> setting.</li>
<li><b>Email Adress</b> - here you need to input the custom email address, if you chose <b>Custom email</b> option in <b>Mail to</b> setting.</li>
<li><b>From Name</b> - here you need to define the name, which appears in the name field of the email.</li>
<li><b>From Adress</b> - here you need to define the adress, which appears in the adress field of the email.</li>
<li><b>Content</b> - here you can paste needed macros for the email content.</li>

<p>In case you select <b>Insert Post</b> type, you need to set the following settings:</p>
<ul class="marked-list">
<li><b>Post Type</b> - here you need to select the post type, where the data will be taken from.</li>
<li><b>Fields Map</b> - 

<p>In case you select <b>Call a Hook</b> type, you need to set the following settings:</p>
<ul class="marked-list">
<li><b>Hook Name</b> - here you can specify the name of the hook.</li></ul>


<p><li><b>Messages Settings</b> - here you can define the text of messages, which can appear during one fills in the booking form.</li></p>

<p><li>After you created a booking form, click <b>Publish</b> button.</li></p>

<h4>Step 2. Working with Booking Form Widget</h4>


<ol class="index-list">
<p><li>Open the page or template where you want to add the booking form.</li></p>

<p><li>Drop the <b>Booking Form </b> widget to the section and column where you want to place it.</li></p> 

<p><li>In the <b>Content</b> block select the custom booking form you’ve created in the Step 1 using <b>JetEngine Booking Forms</b> functionality.</li></p> 

<p><li>Select either you want to display fields in column or row form in <b>Fields layout</b> dropdown.</li></p> 
<p><li>Also choose an appropriate submit type in <b>Submit type</b> option. There are 2 types available: to reload the page after submitting the booking form and using AJAX method without reloading a page.</li></p>
<p><li><b>Cache form output</b> option allows caching the output data of the booking form.</li></p>


<h5>Content</h5>

<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/booking/33.png">
    </figure></li></p>

<ul class="marked-list">
<p><li><b>Select form</b> - here you need to select a booking form from the dropdown list.</p></li>
<p><li><b>Fields layout</b> - select the way to display the fields.</p></li>
<p><li><b>Submit type</b> - here you can choose the submit type for the booking form.</p></li>
<p><li><b>Cache form output</b> - enable this option if you want to cache the output data of the booking form.</p></li>


<h4>Style</h4> 

<h6>In this block, you can learn more about the stylization settings for the <b>Booking Form</b> widget.</h6> 

<h5>Rows</h5>

<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/booking/4.png">
    </figure></li></p>

<ul class="marked-list">
<p><li><b>Divider between rows</b> - enable this option if you want to add a divider between rows.</li></p>
<p><li><b>Height</b> - here you can set the height of the divider.</li></p>
<p><li><b>Color</b> - here you can set the color to apply for the divider.</li></p>
<p><li><b>Rows Gap</b> - here you can fix the appropriate gap between rows for different screen resolutions.</li></p>
<p><li><b>Columns Gap</b> - here you can fix the appropriate gap between columns for different screen resolutions.</li></p>

<h6>Labels</h6>
<ul class="marked-list">
<p><li><b>Typography</b> - turn the option on to view the typography settings.</li></p>
<p><li><b>Color</b> - pick the color of the labels.</li></p>
<p><li><b>Gap</b> - here you can fix the gap larger or smaller around the labels.</li></p>
<p><li><b>Width</b> - here you can fix the appropriate width of the labels.</li></p></ul>

<h6>Descriptions</h6>
<ul class="marked-list">
<p><li><b>Typography</b> - turn the option on to view the typography settings.</li></p>
<p><li><b>Color</b> - pick the color of the descriptions.</li></p>
<p><li><b>Gap</b> - here you can fix the gap larger or smaller around the descriptions.</li></p></ul>

<p><li><b>Horizontal Alignment</b> - define the horizontal alignment for the rows.</li></p>
<p><li><b>Vertical Alignment</b> - define the vertical alignment for the rows. They can be arranged on the top, on the bottom and in the center.</li></p></ul>

<h5>Fields</h5>

<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/booking/6.png">
    </figure></li></p>

<ul class="marked-list">
<p><li><b>Typography</b> - enable this option to access the typography settings available for the fields:</p>
<ul class="marked-list">
<li><p>Font family;</p></li>
<li><p>Font size;</p></li>
<li><p>Weight;</p></li>
<li><p>Transform (uppercase, lowercase, capitalize, normal);</p></li>
<li><p>Style (normal, italic, oblique);</p></li>
<li><p>Decoration (underline, overline, line through, none);</p></li>
<li><p>Line height;</p></li>
<li><p>Letter spacing.</p></li></ul>
<p><li><b>Color</b> - here you can define the color of the fields.</li></p>
<p><li><b>Placeholder Color</b> - here you can select the placeholder color of the fields.</li></p>
<p><li><b>Background Color</b> - here you can choose the background color of the fields.</li></p>
<p><li><b>Padding</b> - here you can define the responsive padding values to apply for the fields.</li></p>
<p><li><b>Margin</b> - use the responsive margin values to create the margins around the fields.</li></p>
<p><li><b>Border Type</b> - here you can define the needed border type for the fields borders. It can be groove, dotted, dashed, double or solid.</li></p>
<p><li><b>Width</b> - type in the border width in order to set the width for the fields top, bottom, left and right borders.</li></p>
<p><li><b>Color</b> -  here you can specify the color of the fields borders using Color picker tool.</li></p>
<p><li><b>Border Radius</b> - here you can set the border radius for the chosen border to make the border angles more round.</li></p>
<p><li><b>Box Shadow</b> - enable this option if you want to access the shadow advanced settings for the fields, and need to apply shadow to them.</li></p>
<p><li><b>Textarea Height</b> - here you can define the height of the text area.</li></p></li></p></ul>



<h5>Checkbox & Radio Fields</h5>
<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/booking/7.png">
    </figure></li></p>

<ul class="marked-list">
<p><li><b>Layout</b> - here you can select the preferable layout of Checkbox & Radio fields (<b>Horizontal</b> or <b>Vertical.</b>)</li></p> 
<p><li><b>Typography</b> - enable this option to access the typography settings available for the Checkbox & Radio fields.</li></p>
<p><li><b>Color</b> - define the color you want to use for Checkbox & Radio fields.</li></p>
<p><li><b>Gap between control and label</b> - here you can fix the appropriate gap between control and label in Checkbox & Radio fields for different screen resolutions.</li></p>
<p><li><b>Background Color</b> - here you can set the color you want to apply for the Checkbox & Radio fields background.</li></p>
<p><li><b>Padding</b> - here you can define the responsive padding values to apply for the Checkbox & Radio fields.</li></p>
<p><li><b>Margin</b> - use the responsive margin values to create the margins around the Checkbox & Radio fields.</li></p>
<p><li><b>Border Type</b> - here you can define the needed border type for the Checkbox & Radio fields borders. It can be groove, dotted, dashed, double or solid.</li></p>
<p><li><b>Width</b> - type in the border width in pixels in order to set the width for the Checkbox & Radio fields top, bottom, left and right borders.</li></p>
<p><li><b>Color</b> -  here you can specify the color of the Checkbox & Radio fields borders using Color picker tool.</li></p>
<p><li><b>Border Radius</b> - here you can set the border radius for the chosen border to make the border angles more round.</li></p></ul>


<h5>Calculated Fields</h5>
<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/booking/9.png">
    </figure></li></p>

<ul class="marked-list">
<p><li><b>Typography</b> - enable this option to access the typography settings available for the Calculated fields.</li></p>
<p><li><b>Color</b> - here you can specify the color of the Calculated fields.</li></p>
<p><li><b>Prefix Color</b> - here you can define the color of the prefix.</li></p>
<p><li><b>Prefix size</b> - here you can set the size of the prefix for different screen resolutions.</li></p>
<p><li><b>Suffix Color</b> - here you can define the color of the suffix.</li></p>
<p><li><b>Suffix size</b> - here you can set the size of the suffix for different screen resolutions.</li></p>
<p><li><b>Background color</b> - here you can set the color to use for the backgorund of Calculated fields.</li></p>
<p><li><b>Padding</b> - use the responsive padding values to define the paddings around the Calculated fields.</li></p>
<p><li><b>Margin</b> - use the responsive margin values to create the margins around the Calculated fields.</li></p>
<p><li><b>Border Type</b> - here you can define the needed border type for the Calculated fields borders. It can be groove, dotted, dashed, double or solid.</li></p>
<p><li><b>Width</b> - type in the border width in pixels in order to set the width for the Calculated fields top, bottom, left and right borders.</li></p>
<p><li><b>Color</b> -  here you can specify the color of the Calculated fields borders using Color picker tool.</li></p>
<p><li><b>Border Radius</b> - here you can set the border radius for the chosen border to make the border angles more round.</li></p></ul>


<h5>Required mark</h5>

<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/booking/10.png">
    </figure></li></p>

<ul class="marked-list">
<p><li><b>Required mark</b> - paste the mark using for obligatory fields.</li></p>
<p><li><b>Color</b> - here you can select the preferrable color for the required mark.</li></p>
<p><li><b>Size</b> - here you can set the size of the required mark for different screen resolutions.</li></p></ul>


<h6>Submit</h6>

<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/booking/11.png">
    </figure></li></p>


<ul class="marked-list">
<p>Here you can switch from customizing <b>Normal</b> to <b>Hover</b> Submit button style settings. Just click on the button <b>Hover</b> to proceed to customizing hover elements.</p>
<p><li><b>Background Color</b> - here you can select the color to use for the button background using color picker tool.</li></p>
<p><li><b>Text Color</b> - here you can select the color of the button label text.</li></p>
<p><li><b>Border Color</b> - here you can specify the color of the button borders on hover.</li></p>
<p><li><b>Typography</b> - turn the option on to view the typography settings.</li></p>
<p><li><b>Padding</b> - input your custom padding values to apply them to the button.</li></p>
<p><li><b>Margin</b> - input your custom margin values to apply margins to the button.</li></p>
<p><li><b>Border Type</b> - here you can define the needed border type for the button borders. It can be dotted, dashed, double or solid.</li></p>
<p><li><b>Width</b> - type in the border width in order to set the width for the button top, bottom, left and right borders.</li></p>
<p><li><b>Color</b> -  here you can specify the color of the button borders using Color picker tool.</li></p>
<p><li><b>Border Radius</b> - here you can set the border radius for the chosen border to make the border angles more round.</li></p>
<p><li><b>Box Shadow</b> - enable this option if you want to access the shadow advanced settings for the button, and need to apply shadow to it.</li></p>
<p><li><b>Alignment</b> - here you can define the preferable button alignment. It can be placed to the left, to the right, remain centered or fullwidth.</li></p></ul>

<h5>Messages</h5>

<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/booking/12.png">
    </figure></li></p>

<ul class="marked-list">
<p><li><b>Typography</b> - turn the option on to view the typography settings.</li></p>
<p><li><b>Border Type</b> - here you can define the needed border type for the messages borders. It can be dotted, dashed, double or solid.</li></p>
<p><li><b>Width</b> - type in the border width in order to set the width for the messages top, bottom, left and right borders.</li></p>
<p><li><b>Color</b> -  here you can specify the color of the messages borders using Color picker tool.</li></p>
<p><li><b>Border Radius</b> - here you can set the border radius for the chosen border to make the border angles more round.</li></p>
<p>Here you can switch from customizing <b>Success</b> to <b>Error</b> Messages style settings. Just click on the button <b>Error</b> to proceed to customizing elements in error state.</p>
<p><li><b>Background Color</b> - here you can select the background color of the messages.</li></p>
<p><li><b>Text Color</b> - here you can specify the color of the text in the messages.</li></p>
<p><li><b>Border Color</b> - here you can specify the color of the borders.</li></p>
<p><li><b>Box Shadow</b> - enable this option if you want to access the shadow advanced settings for the messages, and need to apply shadow for it.</li></p>
<p><li><b>Padding</b> - input your custom padding values to apply them to the messages.</li></p>
<p><li><b>Margin</b> - input your custom margin values to apply margins to the messages.</li></p>
<p><li><b>Alignment</b> - here you can define the preferable messages alignment. They can be placed to the left, to the right or remain centered.</li></p></ul>

<h6>Field Messages</h6> 
<ul class="marked-list">
<p><li><b>Font Size</b> - here you can select the size of the field messages.</li></p>
<p><li><b>Color</b> - add the color for the field messages.</li></p>
<p><li><b>Margin</b> - input your custom margin values to apply margins to the field messages.</li></p> 
<p><li><b>Alignment</b> - ere you can define the preferable field messages alignment. It can be placed to the left, to the right or remain centered.</li></p></ul>

