<h4>Creating Custom Taxonomy Type Template</h4>

<p>From this block you’ll learn how to create a template for custom taxonomy using Elementor and special widgets to display dynamic content.</p>

<ol class="index-list">
<p><li>First, let’s navigate to <b>JetEngine > Listings</b> in WordPress Dashboard. Here you’ll see <b>Listing Items</b> block with all the listings that were already created.

  	 	<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/ctt/6.png">
  	</figure></li></p>

<p><li>Click <b>Add New</b> button to create a new listing.</li></p>

<p><li>A <b>Listing Setup Item</b> block will appear. Here you’ll have to select:

	  	 	<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/ctt/7.png">
  	</figure>

<ul class="marked-list">
<li><b>Listing source</b> - here you can choose, if you want to create a listing template for the custom post type or for the term (in other words, the custom taxonomy).  In order to create a template for the taxonomy let’s select <b>Terms</b> listing source.</li>

<li><b>From taxonomy</b> - here you need to specify the taxonomy for which you need to set the template. Just select the title of the taxonomy you’ve created).</li>

<li><b>Listing Item Name</b> - here you can input the title for the new listing template.</li></ul></li></p>

<li><p>Click <b>Create Listing Item</b> to proceed with creating a new template for the taxonomy.</p></li>

<li><p>When Elementor editor opens locate <b>Listing Elements</b> block on the left in the sidebar where all the widgets are usually located. Here you’ll see the set of the specific widgets made for displaying dynamic content.

  	 	<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/ctt/8.png">
  	</figure></p></li>

<li><p>Just drag and drop them to add the <b>dynamic meta fields content</b> and <b>terms/data, repeaters, dynamic images, links, meta information, terms,</b> etc.</p>

<p>Please, note, that the fields will display dynamic content already added to the taxonomies, so you’ll have to add it before displaying it with the dynamic widgets.</p></li>

<li><p>Another important thing is that while working with dynamic content widgets you’ll see the content that was added to the latest post / taxonomy type displayed in Elementor. However, the same style settings, layouts and widgets will be applied to all the posts from the selected custom type, or taxonomies.</p></li>

<li><p>In the case the field remains empty (the information is missing for one of the fields in one of the posts), just disable it from being displayed using <b>Hide if value is empty</b> option.</p></li></ol>

<div class="alert alert-info">
        For more information about the widgets for displaying dynamic content, please, open <a href="http://documentation.zemez.io/wordpress/index.php?project=jetengine&amp;lang=en&amp;section=jetengine-dynamic-widgets#" target="_blank">JetEngine Widgets</a> block.</div>


<h4>Settings</h4>


<p>In the case you want to access <b>Listing Item Settings</b>, just click <b>Settings</b> in the bottom left corner. The settings block that allows applying changes in <b>Listing item settings</b> will open.</p>

  	 	<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/ctt/9.png">
  	</figure>

<h5>General Setting</h5>

<p>Here you can change the title and the status for the listing template you’re currently editing.</p>

<h5>Listing Settings</h5>

<ul class="marked-list">
<li><b>Listing Source</b> - here you can change the source of the listing from which the data will be pulled (posts or terms).</li>

<li><b>From post type / taxonomy</b> - here you can select for which post type of taxonomy you’ll apply this listing template.</li>

<li><b>Preview Width</b> - to make the width of the listing wider or narrower just use the control to set its width in px.</li></ul>

<div class="alert alert-info">
        Please, note: You need to reload page after applying a new source, changing post type or taxonomy. New meta fields and options for dynamic fields will be applied only after reloading of the page.</div>


