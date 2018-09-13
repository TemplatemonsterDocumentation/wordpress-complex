

<h4>Adding New Custom Post Type</h4>

<ol class="index-list">
 <li><p>Open WordPress Dashboard and locate <b>JetEngine</b> tab on the left. Navigate to <b>JetEngine > Post Types</b> in order to access the list of custom post types already existing on your site. In the case there are none, the list will be empty.


 	 	<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/cpt/1.png">
  	</figure>
  	</p></li>

<li><p>Click <b>Add New</b> button in order to create a new custom post type. You’ll be redirected to <b>Add New Post Type</b> page where you’ll have to specify the general information about the new custom post type you’ll be adding. </p></li></ol>

<h4>General Information </h4>

  	 	<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/cpt/2.png">
  	</figure>

<ul class="marked-list">
 <li><p><b>Slug</b> - here you need to type in the slug that will be shown in the browser’s address bar when one opens the archive of the custom posts. Please, pay attention, that the slug shouldn’t contain any spaces, you have to use only lowercase letters, numbers or hyphens.
</p></li>

 <li><p><b>Name</b> - fill in the name to apply for the post type. It will be shown in the Dashboard as the title of the <b>Custom Post Type</b>.</p></li></ul>

<h4>Labels </h4>

<p>In this block you’ll be able to customize the label names for the options available for the new custom post type. You’ll be able to set your own labels instead of the default ones. Click <b>Edit</b> button to start editing the labels.


 	 	<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/cpt/3.png">
  	</figure></p>

<ul class="marked-list">
 <li><p><b>Post type singular name</b> - here you can customize the singular post type name for the newly created post type (e.g., <b>Service, Team member, Portfolio Item,</b> etc.)</p></li>

 <li><p><b>Admin menu text</b> - here you can change the way the custom post type title would be displayed on the Dashboard (e.g., <b>Services, Projects, Portfolio</b>).</p></li>

 <li><p><b>Add New on Toolbar</b> - this label defines how the <b>Add New</b> option will be displayed on Toolbar.</p></li>

 <li><p><b>Add New</b> - this label will be displayed as the title for the option that indicates adding new custom post.</p></li>

 <li><p><b>New Item</b> - here you can define the label that is shown on the page where you can add and edit the new post’s content.</p></li>

 <li><p><b>Edit Item</b> - here you can define the label that is shown on the page where you can edit the new post’s content.</p></li>

 <li><p><b>View Item</b> - here you can change the label that will be shown instead of the default <b>View Item</b>.</p></li>

 <li><p><b>All Items</b> - here you can change the label that will be shown instead of the default <b>All Items</b>.</p></li>

 <li><p><b>Search for Items</b> - here you can change the label that will be shown instead of the default <b>Search for Items</b> located on the page where all the items are listed.</p></li>

 <li><p><b>Parent Item</b> - here you can apply the custom label indicating that the item is one of the main ones.</p></li>

 <li><p><b>Not Found in Trash</b> - this text will be shown if the item won’t be found in Trash.</p></li>

 <li><p><b>Override the "Featured Image" label</b> - here you can set the text to be shown instead of the <b>Featured Image</b> label text. Please, note, that you’ll also be able to override all the item labels related to the featured image.</p></li>
 <li><p><b>The post type archive label used in nav menus</b> - here you can set the custom label to apply for the custom post type archive.</p></li>
 <li><p><b>Override the "Insert into post" page label</b> - here you can set your own label to use instead of the default <b>Insert into post</b>.</p></li>
 <li><p><b>Overrides the "Uploaded to this post"</b> - here you can set your own label to use instead of the default <b>Uploaded to this post</b>.</p></li></ul>

<h4>Settings</h4>

<p>Here you can change the key settings for the new custom post that you’re creating. Use the controls to change the settings according to your needs.



  	 	<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/cpt/4.png">
  	</figure></p>

<ul class="marked-list">
 <li><p><b>Is Public</b> - here you can make the custom posts for this post type visible to all website visitors.</p></li>

 <li><p><b>Publicly Queryable</b> - enable this option to make the post seen on frontend and allow it for being queried (if the option is inactive you won’t be able to view the post).</p></li>

 <li><p><b>Show Admin UI</b> -  enable this option to be able to access this post type from Dashboard top panel on frontend.</p></li>

 <li><p><b>Show in Nav Menu</b> - enable this option to abto to access this post type from Dashboard on backend.</p></li>

 <li><p><b>Register Query Var</b> - enable this option to be able to query the custom posts using different criterias and using one link.</p></li>

 <li><p><b>Rewrite</b> - enable this option in the case you want to be able to rewrite the custom post.</p></li>

 <li><p><b>Rewrite Slug</b> - here you can apply your custom slug for this post type.</p></li>

 <li><p><b>Capability Type</b> - here you can set the type of capability assigned to this custom post type (post, page, etc.)</p></li>

 <li><p><b>Has Archive</b> - enable this option in order to be able to showcase the posts of this type in an archive.</p></li>

 <li><p><b>Hierarchical</b> - in the case you want to be able to create subitems, just enable this option.</p></li>

 <li><p><b>Menu Position</b> - specify the position of the menu from 10 to 100 to change the location of the custom post type block on the Dashboard.</p></li>

 <li><p><b>Menu Icon</b> - click the Icon Picker to select one of the dashicons and apply it to the custom post type (it will mark it on the Dashboard).</p></li>

 <li><p><b>Supports</b> - in this block you can specify what blocks will be supported by the custom post type and will be shown on default editing page. These are the default blocks that are available for ordinary WordPress posts.</p></li></ul>


  	 	<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/cpt/5.png">
  	</figure>

<p>You can enable the following blocks:</p>

<ul class="marked-list">
 <li><b>Title</b> - allows to input the custom post title;</li>
 <li><b>Editor</b> - adds the default post text editor;</li>
 <li><b>Comments</b> - adds <b>Comments</b> block, where you can allow comments, trackbacks and pingtracks for the post;</li>
 <li><b>Revisions</b> - adds the <b>Revisions</b> block for the custom post;</li>
 <li><b>Trackbacks</b> - adds the field where you can specify the trackback link.</li>
 <li><b>Author</b> - add this block to be able to select an author of the custom post.</li>
 <li><b>Excerpt</b> - adds the field where you can type in the custom excerpt to be shown for this post.</li>
 <li><b>Page Attributes</b> - here you can assign the page/post as the parent one or as a child one to the existing post or page.</li>
 <li><b>Thumbnail</b> - add this block to be able to add the thumbnail image for the post.</li>
 <li><b>Custom Fields</b> - add this block in order to be able to add the custom field for this post or page. As a result you’ll be able to add your own custom fields and specify values for them.</li>
 <li><b>Post Formats</b> - adds <b>Post Format</b> blok where you’ll be able to select the necessary post format (<b>standard, gallery, image,</b> etc).</li></ul>

<h4>Meta Fields</h4>

<p>In this block you’ll be able to create additional meta fields to show and fill in for the custom post type.</p>


  	 	<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/cpt/6.png">
  	</figure>

<ol class="index-list">
 <li><p>To create a new meta field click <b>+ New Meta Field</b> option.</p></li>

<li><p>In the newly opened block input these kinds of information:

<ul class="marked-list">
 <li><b>Title</b> - here you should type in the title that will be shown for the meta field;</li>

 <li><b>Name / ID</b> - here you have to provide an ID for the meta field that will be recognized with Elementor widgets when you select the needed meta field to display;</li>

 <li><b>Type</b> - here you have to specify the type of content that will be available for adding with this meta field.</li></ul></p>

<p>There are such kinds of possible content available for the meta field:

<ul class="marked-list">
 <li><b>Text</b> - will perfectly fit if you want to add an extra field with custom text to the post types.</li>
 <li><b>Date</b> - will help display the date set for the post as a meta field. You can also save the date as a timestamp to allow to query posts by it.</li>
 <li><b>Time</b> - allows to add the time marker for the post.</li>
 <li><b>Datetime</b> - provides the convenient way to add time and date to the post. You can also save it as a timestamp.</li>
 <li><b>Textarea</b> - use this content type to add the text area to the custom posts.</li>
  <li><b>WYSIWYG</b> - use this content type to add the basic editor in the custom field.</li>
 <li><b>Switcher</b> - allows displaying switcher for the custom posts.</li>
 <li><b>Checkbox</b> - adds the checkboxes for the custom posts.</li>
 <li><b>Iconpicker</b> - the tool provides ability to select the icons for displaying them in the posts.</li>
 <li><b>Media</b> - will help add and display the images for the posts.</li>
  <li><b>Gallery</b> - will help add and display the gallery of multiple images for the posts.</li>
 <li><b>Radio</b> - allows to add the radio options for choosing when creating the post.</li>
 <li><b>Select </b>- use this content type to add dropdown selector for the post. In case you enable <b>Allow t oselect multiple values</b> option the user you'll be able to select several options at once. This value can be also shown using the proper callback for the Dynamic Field.</li>
 <li><b>Colorpicker</b> - will add a colorpicker tool for the post.</li>
 <li><b>Repeater</b> - will help add the repeating content types for every post of the given type.</li></p></ul></li>

<li><p>After everything is set click <b>Add Post Type</b> button to save the changes.</p></li></p></li></ol>

