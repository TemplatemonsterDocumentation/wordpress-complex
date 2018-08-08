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

<li><b>Filter field output</b> - use the filter to display the data that is pulled directly from the database. Sometimes the content can’t be displayed without any filters (e.g., to display date you’ll need Format Data callback, to display an image you’ll need to use <b>Get Image by ID</b> callback, etc).</li>

<li><b>Customize field input</b> - enable this option in order to add the text before and after the value that is pulled from the meta field (here <b>%s </b> stands for the value that is  pulled, just add come content before and after it to add some text before and after the value.</li></ul>

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
