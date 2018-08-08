<h4>Adding New Taxonomy Type</h4>

<ol class="index-list">
<p><li>Open WordPress Dashboard and locate <b>JetEngine</b> tab on the left. Navigate to <b>JetEngine > Taxonomies</b> in order to access the list of custom taxonomies already existing on your site. In the case there are none, the list will be empty.


  	 	<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/ctt/1.png">
  	</figure></li></p>

<li><p>Click <b>Add New</b> button in order to create a new taxonomy for any post type of your choosing. You’ll be redirected to <b>Add New Taxonomy</b> page where you’ll have to specify the general information about the new custom taxonomy you’ll be adding. </p></li></ol>

<h4>General Information </h4>

  	 	<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/ctt/2.png">
  	</figure>

<ul class="marked-list">
<li><b>Slug</b> - here you need to type in the slug that will be shown in the browser’s address bar when one filters the posts using this taxonomy.
Please, pay attention, that the slug shouldn’t contain any spaces, you have to use only lowercase letters, numbers or hyphens. </li>

<li><b>Name</b> - fill in the name to apply for the taxonomy. It will be shown in the Dashboard as the title of the Taxonomy block (e.g., the default taxonomies are Categories and Tags, but you can add your own ones). </li>

<li><b>Post Type</b> - here you can set the post types for which you want to apply this taxonomy (e.g., Posts, Pages, Custom Posts of your choosing, etc.)</li></ul>

<h4>Labels </h4>

  	 	<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/ctt/3.png">
  	</figure>

<p>In this block you’ll be able to customize the label names for the options available for the new custom post type. You’ll be able to set your own labels instead of the default ones. Click <b>Edit</b> button to start editing the labels.</p>


<ul class="marked-list">
<li><b>Singular name</b> - here you can customize the singular taxonomy name label for the newly created taxonomy (e.g., Service type, Team, Portfolio Topic, etc.)</li>

<li><b>Admin menu text</b> - here you can change the way the custom taxonomy type title would be displayed on the Dashboard.</li>

<li><b>All Items</b> - here you can change the label that will be shown instead of the default All Items/tags.</li>

<li><b>Edit Item</b> - here you can define the label that is shown on the page where you can edit the new taxonomy description, thumbnail, etc.</li>

<li><b>View Item</b> - here you can change the label that will be shown instead of the default View Item/tag.</li>

<li><b>New Item</b> - here you can define the label that is shown on the page where you can add and edit the taxonomies content.</li>

<li><b>Update Item</b> - here you can define the label that is shown on the page where you can edit the new taxonomies content.</li>

<li><b>New Item Name</b> - here you can change the title that will be shown on the page where you can add a new taxonomy ad the Add New Taxonomy title label.</li>

<li><b>Search for Items</b> - here you can customize the text to be shown on Search button (e.g., Search tags / Search topics, etc).</li>

<li><b>Parent Item Text</b> - here you can set the text label that will be displayed instead of Parent Item label text.</li>

<li><b>The popular Items text</b> - here you can set the text that will be displayed instead of the Popular Items text label.</li>

<li><b>Separate items with commas text</b> - here you can predefine the text to display it instead of the one that recommends to separate the tags with commas.</li>


<li><b>The add or remove items text</b> - here you can select the text to display instead of Add or remove tag label.</li>

<li><b>The choose from most used text</b> - here you can set your own text label to display instead of the text that recommends to choose from the most used tags.</li>

<li><b>Not found label</b>- here you can set the label to be displayed instead of Not Found text when the taxonomy is not found on the site.</li></ul>


<h4>Settings</h4>

  	 	<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/ctt/4.png">
  	</figure>

<p>Here you can change the key settings for the new taxonomy type that you’re creating. Use the controls to change the settings according to your needs.</p>

<ul class="marked-list">
<li><b>Is Public</b> - here you can make the taxonomy visible to all website visitors.</li>

<li><b>Publicly Queryable</b> - enable this option to make the taxonomy being seen on frontend and allow it for being queried (if the option is inactive you won’t be able to view the taxonomy).</li>

<li><b>Show Admin UI</b> -  enable this option to be able to access this taxonomy from Dashboard Admin panel.</li>

<li><b>Show in Nav Menu</b> - enable this option to abto to access this taxonomy from Dashboard on backend from Nav menu.</li>

<li><b>Register Query Var</b> - enable this option to be able to query the taxonomy using different criterias and one link.</li>

<li><b>Rewrite</b> - enable this option in the case you want to be able to rewrite the taxonomy.</li>

<li><b>Rewrite Slug</b> - here you can apply your custom slug for this taxonomy.</li>

<li><b>Hierarchical</b> - in the case you want to be able to create subitems, just enable this option.</li></ul>


<h4>Meta Fields</h4>

  	 	<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/ctt/5.png">
  	</figure>

<p>In this block you’ll be able to create additional meta fields to show and fill in for the custom taxonomy.</p>

<ol class="index-list">
<p><li>To create a new meta field click <b>+ New Meta Field</b> option.</li></p>

<p><li>In the newly opened block input these kinds of information:

<ul class="marked-list">
<li><b>Title</b> - here you should type in the title that will be shown for the meta field;</li>

<li><b>Name / ID</b> - here you have to provide an ID for the meta field that will be recognized with Elementor widgets when you select the needed meta field to display;</li>

<li><b>Type</b> - here you have to specify the type of content that will be available for adding with this meta field.</li></ul></li></p>

<p><li>There are such kinds of possible content available for the meta field:

<ul class="marked-list">
<li><b>Text</b> - will perfectly fit if you want to add an extra field with custom text to the taxonomies.</li>
<li><b>Date</b> - will help display the date set for the taxonomy as a meta field. You can also save the date as a timestamp to allow to query taxonomies by it.</li>
<li><b>Time</b> - allows to add the time marker for the taxonomy.</li>
<li><b>Datetime</b>- provides the convenient way to add time and date to the taxonomy. You can also save it as a timestamp.</li>
<li><b>Textarea</b> - use this content type to add the text area to the taxonomy.</li>
<li><b>Switcher</b> - allows displaying switcher for the taxonomy.</li>
<li><b>Checkbox</b> - adds the checkboxes for the taxonomies.</li>
<li><b>Iconpicker</b> - the tool provides ability to select the icons for displaying them for the taxonomy.</li>
<li><b>Media</b> - will help add the images for the taxonomy.</li>
<li><b>Radio</b> - allows to add the radio options for choosing when creating the taxonomy.</li>
<li><b>Select </b>- use this content type to add dropdown selector for the taxonomy.</li>
<li><b>Colorpicker</b> - will add a colorpicker tool for the taxonomy.</li>
<li><b>Repeater</b> - will help add the repeating content types for every taxonomy of the given type.</li></ul></li></p>

<p><li>After everything is set click <b>Add Taxonomy</b> button to save the changes.</li></p></ol>
