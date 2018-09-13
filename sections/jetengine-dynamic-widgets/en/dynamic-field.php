<h2>Dynamic Field</h2>



<h6>
Dynamic Field widget is made for displaying the content from both meta fields and the post or term data, for posts and taxonomies listing templates. The widget pulls the data and displays it using the set style and content settings.
</h6>

<h4>Content</h4>

  	 	<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/widgets/df1.png">
  	</figure>

<ul class="marked-list">
<li><b>Source</b> - here you can set, if the content is to be pulled from post / term default data or the meta data. Use <b>Meta Data</b> to display content added in <b>Meta fields</b> and <b>Post/Term data</b> to display <b>title, content,</b> etc, added without the help of meta fields.</li>

<li><b>Object Field</b> - here you can select the field from which you need to pull information. In the case you’ve selected Meta Data source, you’ll see all the meta fields available for the post/taxonomy listed. You can also enter the ID of the meta field in Enter Meta Field Key block to display it.</li>

<li><b>Field Icon</b> - here you can apply an icon for the field.</li>

<li><b>HTML Tag</b> - select the needed HTML tag for the meta field (you can set the H1-H6  tags for the headings, DIV and SPAN tags for other content.</li>

<li><b>Hide if value is empty</b> - enable this option in the case you want to hide the field if it is not filled for the post/taxonomy. It will still be displayed in the case it is filled and contains any information.</li>

<li><b>Filter field output</b> - use the filter to display the data that is pulled directly from the database. Sometimes the content can’t be displayed without any filters (e.g., to display date you’ll need Format Data callback, to display an image you’ll need to use <b>Get Image by ID</b> callback, etc).

  <p>Callback Types</p>

        <figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/widgets/callbacks.png">
    </figure>

<ul class="marked-list">
<li>Format date - use this callback to show the date pulled from the database using <b>Date</b> ot <b>Time</b> meta fields.</li>
<li>Get post/page link - here you can pull the link that's leading to the post or the page in case you've added the post/pagfe id in the <b>Text</b> meta field and then selected this callback.</li>
  <li>Get Term Link - here you can set the displaying for the term link in case you've added the term ID in the <b>Text</b> meta field.</li>
    <li>Embed URL - with this callback you can embed the URL link (needed in case you want to embed a video from YouTube, etc., just add the link to the <b>Text</b> meta field and then display in using this callback.</li>
<li>Multiple Select Field Values - use this callback to showcase several selected options when you're using <b>Select</b> meta field. When you use this callback, you'll be able to specify the delimiter to add for it in Delimiter field.</li>
<li>Get Image by ID - here you can use this callback to display the image from the database instead of its number value when using <b>Media</b> meta field.</li>
<li>Images Gallery Grid - use this callback to display gallery added using <b>Gallery</b> meta field.</li>
<li>Images Gallery Slider - use this callback to display the images slider added using <b>Gallery</b> meta field.</li>
</li>

<p><li><b>Customize field input</b> - enable this option in order to add the text before and after the value that is pulled from the meta field (here <b>%s </b> stands for the value that is  pulled, just add some content before and after it to add some text before and after the value.</li></p></ul>

<h4>Style</h4>

  	 	<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/widgets/df2.png">
  	</figure>

<h5>Field</h5>

<ul class="marked-list">
<li><b>Color</b> - here you can specify the color to apply for the data displayed with this field.</li>
<li><b>Typography</b> — turn the option on to view the typography settings that can be applied for the data shown in this field.
	<ul class="marked-list">
<li><b>Size</b> — define the font size of the font characters.</li>
<li><b>Family</b> — here you can set the font family for the data.</li>
<li><b>Weight</b> — in this block you can select the suitable font weight.</li>
<li><b>Transform</b> — here you can choose from the dropdown menu, if you want the characters to be shown in uppercase, lowercase, capitalize or normal way.</li>
<li><b>Style</b> — in this block you can choose from the dropdown menu the style of the font. It can be normal, italic (the characters look similar to handwriting) and oblique (the characters are slightly inclined to the right).</li>
<li><b>Line Height</b> — in this field you can set the height of the text line.</li>
<li><b>Letter Spacing</b> — here you can set the space between letters.</li></ul></li>

<li><b>Widget Items Alignment</b> - here you can select the alignment for the icon and field (affects the single line field values).</li>

<li><b>Field Content Alignment</b> - here you can specify the field content alignment to apply for the single line field values.</li></ul>

<h5>Icon</h5>

<ul class="marked-list">
<li><b>Color</b> - choose the color to use for the field icon using Color picker tool.</li>

<li><b>Size</b> - use the control to customize the size of the icon shown for this field.</li>

<li><b>Gap</b> - here you can change the gap distance between the icon and the content of the field.</li></ul>

<h4>Creating Gallery with Dynamic Field Widget</h4>

<p>In case you've selected Gallery meta field content type and added several images to it, you'll be able to add a gallery to the listing using Dynamic Field widget.</p>

<ol class="index-list">
<li>First, in order to do it drop the Dynamic Field widget to the template's structure. Then select <b>Content</b> tab and in <b>Source</b> specify <b>Meta Data</b>.

  	 	<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/widgets-rep/6.png">
  	</figure></li>

<li>Select Gallery ID in the <b>Meta Field</b> dropdown or enter it in the field below.</li>

<li>Now you can view all the items that can be shown in the gallery, yet they are not rendered properly. In order to show them in the form of image you need to enable <b>Filter field output</b> option and specify the callback you want to use:

	<ul class="marked-list">
<li>Images Gallery Grid; </li>
<li>Images Gallery Slider.</li>
</ul>

  	 	<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/widgets-rep/7.png">
  	</figure></li>

<li>The next step is to change the style of the selected grid or slider. The appearance settings are different for each of these callback types. </li>

<li>Let's navigate to <b>Style</b> block. Here open <b>Misc</b> settings.

	<h5>Misc</h5>

	  	 	<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/widgets-rep/5.png">
  	</figure>

		<ul class="marked-list">
<li>Images Gap - here you can specify the gap distance to use between the images in the grid.</li>

<li>Image Overlay/Hover Overlay - here you can switch between the normal and hover overlay styles for the images.</li>

<li>Lightbox Icon Color - here you can set the specific color to use for the icon.</li></ul>

<p>In case you're using Slider callback, you can customize the Slider Arrows in <b>Misc</b> block.</p>


		<ul class="marked-list">
<li>Slider Arrows Box Size - here you can change the size of the boxes in which the navigation arrows are shown.</li>

<li>Slider Arrows Size - here you need to set the size to apply for the arrows.</li>

<li>Normal/Hover - here you can change the looks of the navigation arrow in normal state and on hover.</li>

<li>Color - here you can change the color to use for the arrows.</li>

<li>Background - here you can set the color to apply for the background of the arrows.</li></ul></li></ol>





