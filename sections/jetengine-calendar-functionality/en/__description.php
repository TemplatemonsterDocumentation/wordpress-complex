<h2>JetEngine Calendar Functionality</h2>

<h6>This block will guide you through the steps of creating a dynamic calendar using the <b>JetEngine Calendar</b> functionality.</h6> 


<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/widgets/calendar.png">
    </figure></li></p>



    <div class="alert alert-info">
        Before working with Calendar, please make sure to enable it in <b>JetEngine Modules Manager</b>.</div>

<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/widgets/calendar-0.png">
    </figure></li></p>

<h4>Step 1. Creating Custom Post Type</h4>

<h6>From this block, you can learn how to prepare a custom post type to add events to the calendar.</h6> 

<div class="alert alert-info">
        Please, note, that in case you want to add the default posts to the calendar to showcase them using the publication date, you might skip this step and proceed to Creating a Listing Template with JetEngine to define the way how the event/post should be shown in the calendar.</div>

<ol class="index-list">
<p><li>First, navigate to <b>JetEngine > Post Types</b> block. Here click <b>Add New</b> option to add a new custom post type to showcase events.</li></p>

<p><li>Set the custom post type name (e.g., Event) and slug (e.g., “event”).</li></p>

<p><li>Manage the <b>Event post type</b> settings (set the icon for the post type, define the fields this post type should support).</li></p>


<p><li>Use Meta Fields to add the needed content you’d want to display when one would view it in the calendar:</li></p>
<ul class="marked-list">
<li><b>Icon;</b></li>
<li><b>Event name;</b></li>
<li><b>Date and time;</b></li>
<li><b>Event thumbnail;</b></li>
<li><b>Any other extra fields for your data type.</b></li></ul>

<p><li>Click <b>Add Post Type</b> button to add a new post type.</li></p>

<p><li>After that, you should be able to see the new custom post type in your <b>WordPress Dashboard</b>. Add several custom posts you want to display in the calendar. Take care to fill in all the required fields, featuring the event specifics, time, date, name, etc.</li></p>

<p><li>Save the changes.</li></p></ol>


<h4>Step 2. Creating a Listing Template</h4>

<ol class="index-list">

<p><li>It is necessary to create the custom post type listing template to be able to use it when adding events (or any other custom or default post types) to the calendar. 
In order to do it, please, navigate to <b>JetEngine > Listings</b> in <b>WordPress Dashboard</b>. Click <b>Add New</b> button to create a new listing you’d be using for the calendar to display posts or events.</li></p>

<p><li>Navigate to <b>Listing Item Settings > Listing Settings</b> block and define the source of the content from which the data should be pulled for this particular listing.
E.g., in case we have the “Events” custom post type, we should define Listing source: Posts and select Events in From post type dropdown.</li></p> 

<p><li>Use <b>JetEngine Dynamic Content</b> widgets to display the content that was previously added to the events using the custom fields and meta boxes. 
E.g., use <b>Dynamic Field</b> widget to pull the name of the event, its icon, date and time, the event description. You can also add the links for the events using <b>Dynamic Link</b> widget, or display any information (a link, a title, the location) in the form of QR code.</li></p>

<p><li>After the listing template is created and styled according to your needs, save the changes.</li></p></ol> 


<h4>Step 3. Working with Calendar Widget</h4>


<ol class="index-list">
<p><li>Open the page or template where you want to add the dynamic calendar showcasing the posts, events, projects, schedules, etc.</li></p>

<p><li>Drop the <b>Listing Calendar</b> widget to the section and column where you want to place it.</li></p> 

<p><li>In the <b>Content > General</b> block select the listing template you’ve created in the Step 2 using <b>JetEngine Listing</b> functionality.</li></p> 

<p><li>Select the way you want to group your posts in <b>Group posts by</b> dropdown. Currently there are 3 ways to group the posts:</li></p> 

<ul class="marked-list">

<p><li><b>Post publication date</b> - select this option in case you want to sort the posts and assign them to specific date cells using the post publication date as the marker to which date the post should be assigned;</li></p>

<p><li><b>Post modification date</b> - select this option in case you want to sort the posts and assign them to specific calendar date cells using the post modification date;</li></p>

<p><li><b>Date from custom field</b> - this option comes in handy when you want to display, e.g., the events, in the date cells when the events are to be held.
In this case, you have to set the custom fields with the date content type for each of the events and fill in these fields with the dates when the events are to take place.</li></p></ul>

<p><li>After that, when working with the <b>Calendar</b> widget, specify <b>Date</b> from custom field option and input the <b>Meta field</b> name in the corresponding field.</li></p></ol>  



<h5>General</h5>

<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/widgets/calendar-2.png">
    </figure></li></p>

<ul class="marked-list">
<p><li><b>Listing</b> - here you need to select listing from the dropdown list.</p></li>
<p><li><b>Group Posts by</b> - select either Post publication date, Post modification date, Date from custom field.</p></li>
<p><li><b>Week days format</b> - here you need to choose the format of displaying week days from the dropdown list.</p></li></ul>


<h5>Posts Query</h5>


<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/widgets/calendar-3.png">
    </figure></li></p>

<h6>This block allows querying the posts or custom post types (e.g., events) using the complex query methods. E.g., in case you want the calendar to display only the events that have the specific location, category, or the events held in the specific time (you can accomplish this using the custom fields with the set time and by setting the meta query relation).</h6> 



<h5>Widget Visibility</h5>

<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/widgets/calendar-4.png">
    </figure></li></p>

<h6>Here you can set if the <b>Calendar</b> widget is to be shown when there are no events, or if you need to hide it if there are no events to be shown.</h6> 

<h6>There are two options to define the widget’s visibility:</h6>
<ul class="marked-list">
<p><li><b>Always show;</b></li></p>
<p><li><b>Query is empty.</b></li></p></ul>


<h4>Style</h4> 

<h6>In this block, you can learn more about the stylization settings for the <b>Listing Calendar</b> widget.</h6> 

<h5>Caption</h5>

<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/widgets/calendar-5.png">
    </figure></li></p>

<ul class="marked-list">
<p><li><b>Layout</b> - here you can choose between the 4 existing layouts available for the calendar widget.</li></p>
<p><li><b>Background color</b> - here you can set the color to apply for the calendar widget caption block’s background.</li></p>
<p><li><b>Label Color</b> - here you can set the color to use for the label text (the text that specifies the month and year shown with the widget).</li></p>
<p><li><b>Typography</b> - enable this option to access the typography settings available for the label text:</p>
<ol class="marked-list">
<li><p>Font family;</p></li>
<li><p>Font size;</p></li>
<li><p>Weight;</p></li>
<li><p>Transform (uppercase, lowercase, capitalize, normal);</p></li>
<li><p>Style (normal, italic, oblique);</p></li>
<li><p>Decoration (underline, overline, line through, none);</p></li>
<li><p>Line height;</p></li>
<li><p>Letter spacing.</p></li></ol>
<p><li><b>Padding</b> - here you can define the responsive padding values to apply for the calendar caption.</li></p>
<p><li><b>Margin</b> - use the responsive margin values to create the margins around the caption of the calendar.</li></p>
<p><li><b>Border Type</b> - select the border type to use for the caption. After the border type is selected you can choose its width (top, right, bottom, left), and specify its color.</li></p> 
<p><li><b>Border Radius</b> - fill in the border radius values to make the caption block angles more smooth.</li></p></ul> 

<h5>Navigation Arrows</h5>
<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/widgets/calendar-6.png">
    </figure></li></p>

<ul class="marked-list">
<p><li><b>Height</b> - use the control to set the desired height you need to apply for the navigation arrows containers.</li></p> 
<p><li><b>Arrow Size</b> - use the control to set the desired size you need to apply for the navigation arrows.
Switch between the <b>Previous Arrow</b> and <b>Next Arrow</b> styles to use the different styles for the arrows that allow switching forth and back between the different months.</li></p>
<p><li><b>Border type</b> - here you can set the border type to use around the navigation arrows. In case you’ve set it, you’ll be able to choose its color and width.</li></p>
<p><li><b>Border radius</b> - in case you need the navigation arrows showcased in the circles instead of the square borders, set the border radius values to smoothen the angles. 
Switch between the <b>Normal</b> and <b>Hover</b> modes in order to apply the changes to the navigation arrows when you hover over them and in the normal state.</li></p> 
<p><li><b>Text color</b> - define the color you want to use for the arrows.</li></p>
<p><li><b>Background color</b> - here you can set the color you want to apply for the navigation arrow background.</li></p></ul> 

<h5>Week Days</h5>

<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/widgets/calendar-7.png">
    </figure></li></p>

<ul class="marked-list">
<p><li><b>Background color</b> - here you can set the color to apply for the weekdays label blocks.</li></p>
<p><li><b>Text color</b> - here you can set the color to use for the weekday label text.</li></p> 
<p><li><b>Typography</b> - enable this option to access the typography settings available for the weekday label text (the settings are similar to those for other text elements that allow managing typography).</li></p> 
<p><li><b>Padding</b> - set the custom responsive padding values to set the distance between the weekday labels and the containers.</li></p>
<p><li><b>Border width</b> - apply the borders for the weekday blocks by defining its width in px or percents.</li></p>
<p><li><b>Border color</b> - choose the color to apply for the border.</li></p>
<p><li><b>Border radius</b> - smoothen the border angles using this value.</li></p></ul>

<h5>Days</h5>
<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/widgets/calendar-8.png">
    </figure></li></p>

<ul class="marked-list">
<p><li><b>Background color</b> - here you can set the color to use for the days shown in the month.</li></p>
<p><li><b>Padding</b> - use the responsive padding values to define the paddings around the events (or other listings created for the post types you want to display in the calendar).</li></p>
<p><li><b>Min height</b> - use the controls to define the minimum height for the days shown in the calendar.</li></p>
<p><li><b>Gap between events</b> - in case there are several events or posts shown per one date, you can select the gap to separate the events.</li></p>
<p><li><b>Border width</b> - here you can set the width of the border to use the border around the days.</li></p>
<p><li><b>Border color</b> - here you can set the color to apply for the border you’ve set.</li></p>
<p><li><b>Border radius</b> - to smoothen the border angles use the responsive border radius values.</li></p></ul>

<h6>Date label</h6>


<ul class="marked-list">
<p><li><b>Text color</b> - here you can define the color to use for the day date.</li></p>
<p><li><b>Background color</b> - add the background color for the day date to make the date more distinct.</li></p>
<p><li><b>Typography</b> - enable this option to access the typography settings available for the date text (the settings are similar to those for other text elements that allow managing typography).</li></p> 
<p><li><b>Date box alignment</b> - align the date to the left, right, or center.</li></p>
<p><li><b>Date text alignment</b> - set the alignment you want to use for the date text.</li></p>
<p><li><b>Width</b> - here you can select the preferable width value.</li></p>
<p><li><b>Height</b> - here you can set the preferable height value.</li></p>
<p><li><b>Border type</b> - here you can set one of the several border types available for the element.</li></p>
<p><li><b>Border radius</b> - here you can make the angles more round.</li></p>
<p><li><b>Margin</b> - here you can define the preferable responsive margins for the element.</li></p>
<p><li><b>Padding</b> - here you can set the preferable responsive padding values.</li></p></ul> 

<h6>Disabled days (not in the current month)</h6>


<ul class="marked-list">
<p><li><b>Opacity</b> - here you can set the custom opacity value to make the element sheerer.</li></p> 
<p><li><b>Day background color</b> - here you can set the color to you for the day block background.</li></p>
<p><li><b>Day label text color</b> - here you can specify the color to use for the text label.</li></p>
<p><li><b>Date label background color</b> - here you can set the background color to use for the date label text.</li></p> 
<p><li><b>Day label border color</b> - here you need to specify the color of the border shown around the label.</li></p></ul> 

<h5>Mobile</h5>
<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/widgets/calendar-9.png">
    </figure></li></p>

<ul class="marked-list">
<p><li><b>Mobile Trigger Color</b> - here you can set the color to use for mobile trigger.</li></p>
<p><li><b>Active Mobile Trigger Color</b> - here you can set the color to use for active mobile trigger.</li></p>
<p><li><b>Mobile Trigger Width</b> - here you can set the width of mobile trigger.</li></p>
<p><li><b>Mobile Trigger Height</b> - here you can set the height of mobile trigger.</li></p>
<p><li><b>Mobile Trigger Alignment</b> - here you can set the alignment of mobile trigger.</li></p>
<p><li><b>Mobile Trigger Border Radius</b> - here you can set the border radius of mobile trigger. </li></p>
<p><li><b>Mobile Trigger Margin</b> - here you can change margins of mobile trigger.</li></p>
<p><li><b>Mobile Event Margin</b> - here you can change margins of mobile event trigger</li></p></ul>