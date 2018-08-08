<h2>Dynamic Repeater</h2>


<h6>
Dynamic Repeater widget is made for displaying repeating blocks set for the custom post types or taxonomies (this can be done in meta boxes or when you create a meta field and select the Repeater content type).
</h6>

<p>Please, note, that this widget can process only repeater meta fields created with <b>JetThemeCore</b> or <b>ACF</b> plugins.</p>

<h4>Content</h4>

  	 	<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/widgets/dr1.png">
  	</figure>

<ul class="marked-list">
<li><b>Source</b> - here you can select the repeater that you want to be displayed with this widget (here you can select repeaters only). </li>

<li><b>Item Format</b> - in this field you need to format the repeater content using macros blocks and HTML markup.

<ol class="index-list">
<li><p>First, make sure you know the IDs input in the <b>Meta Fields</b> that are included in the repeater, e.g., ID  <b>“text”</b> goes for <b>Text</b> block. To add this field as a macros type in <b>“text”</b> ID into <b>%...%</b> structure. This should look like:

<ul class="marked-list">
<li><b>%text%</b> - this is the macros that will help in displaying the content added in the <b>Text</b> meta field. </li></ul></p></li>

<li><p>After that add the macros into the HTML markup (e.g., use <b>< span >< /span></b> or <b>< div>< /div></b> markup). </p></li>

<li><p>To add more complicated content, use the proper HTML markup (e.g., <b>< i class="fa %icon%"></ i></b> markup will fit for displaying icons where <b>%icon%</b> is a macros for the meta field with the iconpicker). </p></li></ol></li></ul>

<ul class="marked-list">
<li><b>Items Delimiter</b> - to add spaces, special symbols or any other delimiters between the content type them in in this field.</li></ul>

<h4>Style</h4>

  	 	<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/widgets/dr2.png">
  	</figure>

<h5>General</h5>

<ul class="marked-list">
<li><b>Direction</b> - here you can set the horizontal or vertical direction to apply for the repeater items that showcase the repeating content.</li>

<li><b>Alignment</b> - here you can set the needed alignment to apply for the repeater content.</li>

<li><b>Typography</b> - here you can set the preferable typography settings to use for the content displayed with the repeater. The typography settings are usually the same as for any other JetEngine widget.</li></ul>

<h5>Items</h5>

<ul class="marked-list">
<li><b>Fixed Item Size</b> - enable this option in order to access the item width and height settings that need to be set in order to make the repeater content responsive.</li>

<li><b>Item Width</b> - use the control to specify the width of the items added with the repeater.</li>

<li><b>Item Height</b> - use the control to set the height for the item added with the repeater.</li></ul>

<p>Switch between <b>Normal</b> and <b>Hover</b> modes to customize the appearance of the content on hover and in its normal state.</p>

<ul class="marked-list">
<li><b>Color</b> - specify the color of the item using color picker tool.</li>

<li><b>Background Color</b> - here you can customize the color to apply for the background.</li>

<li><b>Border Type</b> - here you can set the type of the border to apply for the item (e.g., solid, dashed, dotted type).</li>

<li><b>Color</b> - here you can choose the color to apply for the border.</li>

<li><b>Width</b> - here you can select the width to use for the border and make it responsive.</li>

<li><b>Border Radius</b> - here you can set the border radius values to make the border angles more smooth and round.</li>

<li><b>Box Shadow</b> - enable this option to access the shadow settings for the item, such as color, blur and spread).</li>

<li><b>Margin</b> - here you can specify the margins to use for the margins of the items in px.</li></ul>

<h5>Delimiter</h5>

<ul class="marked-list">
<li><b>Color</b> - here you can select the color to use for the delimiter with the color picker tool.</li>

<li><b>Margin</b> - here you can set the margin values to apply for the delimiters.</li></ul>
