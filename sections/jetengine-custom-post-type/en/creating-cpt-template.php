

<h4>Creating Custom Post Type Template</h4>


<h5>From this block you’ll learn how to create a template for custom post type using Elementor and special widgets to display dynamic content.</h5>

<ol class="index-list">
<p><li>First, let’s navigate to <b>JetEngine > Listings</b> in WordPress Dashboard. Here you’ll see <b>Listing Items</b> block with all the listings that were already created.


  	 	<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/cpt/7.png">
  	</figure></li></p>

<p><li>Click <b>Add New</b> button to create a new listing.</li></p>

<p><li>A <b>Listing Setup Item</b> block will appear. Here you’ll have to select:



  	 	<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/cpt/8.png">
  	</figure>

<ul class="marked-list">
<li><b>Listing source</b> - here you can choose, if you want to create a listing template for the custom post type or for the term (in other words, the custom taxonomy).  In order to create a template for the custom post type let’s select Posts listing source.</li>

<li><b>From post type</b> - here you need to specify the post type for which you need to set the template. In our case, it would be <b>Services</b> (just select the title of the custom post type you’ve created).</li>

<li><b>Listing Item Name</b> - here you can input the title for the new listing template.</li></ul></li></p>

<p><li>Click <b>Create Listing Item</b> to proceed with creating a new template for custom post type.</li></p>

<p><li>When Elementor editor opens locate <b>Listing Elements</b> block on the left in the sidebar where all the widgets are usually located. Here you’ll see the set of the specific widgets made for displaying dynamic content.



  	 	<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/cpt/9.png">
  	</figure></li></p>

<li><p>Just drag and drop them to add the <b>dynamic meta fields</b> content and <b>post terms/data, repeaters, dynamic images, links, meta information, terms,</b> etc.</p>

<p>Please, note, that the fields will display dynamic content already added to the posts or taxonomies, so you’ll have to add it before displaying it with the dynamic widgets.</p></li>

<p><li>Another important thing is that while working with dynamic content widgets you’ll see the content that was added to the latest post / taxonomy type displayed in Elementor. However, the same style settings, layouts and widgets will be applied to all the posts from the selected custom type, or taxonomies.</li></p>

<p><li>In the case the field remains empty (the information is missing for one of the fields in one of the posts), just disable it from being displayed using Hide if value is empty option.</li></p></ol>


<div class="alert alert-info">
        For more information about the widgets for displaying dynamic content, please, open <a href="http://documentation.zemez.io/wordpress/index.php?project=jetengine&lang=en&section=jetengine-dynamic-widgets#" target="_blank">JetEngine Widgets</a> block.</div>

<h4>Settings</h4>

<p>In the case you want to access <b>Listing Item Settings</b>, just click <b>Settings</b> in the bottom left corner. The settings block that allows applying changes in Listing item settings will open.</p>

<h5>General Settings</h5>


  	 	<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/cpt/11.png">
  	</figure>

<p>Here you can change the title and the status for the listing template you’re currently editing.</p>

<h5>Listing Settings</h5>


  	 	<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/cpt/10.png">
  	</figure>

<ul class="marked-list">
<li><b>Listing Source</b> - here you can change the source of the listing from which the data will be pulled (posts or terms).</li>

<li><b>From post type / taxonomy</b> - here you can select for which post type of taxonomy you’ll apply this listing template.</li>

<li><b>Preview Width</b> - to make the width of the listing wider or narrower just use the control to set its width in px.</li></ul>

<div class="alert alert-info">
        Please, note, that you have to reload page after applying a new source, changing post type or taxonomy. New meta fields and options for dynamic fields will be applied only after reloading of the page.</div>
