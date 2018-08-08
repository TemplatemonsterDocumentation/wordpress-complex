<h3>JetEngine Layouts</h3>

<h5>From this block you’ll learn how to showcase the custom post types or taxonomies into listing and grid layouts.
</h5>

<h4>Adding New Layout</h4>

<ol class="index-list">
<p><li>To add a new layout you need to navigate to <b>JetEngine > Listings</b> in WordPress Dashboard. Here click <b>Add New</b> button in the top left corner.

  	 	<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/grid/1.png">
  	</figure></li></p>

<p><li>A <b>Listing Setup Item</b> block will appear. Here you’ll have to select:</p>

	  	 	<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/grid/2.png">
  	</figure>

<p>
<ul class="marked-list">
<li><b>Listing source</b> - here you can choose, if you want to create a listing template for the custom post type or for the term (in other words, the custom taxonomy).</li>

<li><b>From taxonomy / post type</b> - here you need to specify the taxonomy or the post type for which you need to set the template. Just select the title of the taxonomy you’ve created.</li>

<li><b>Listing Item Name</b> - here you can input the title for the new listing template.</li></ul></li></p>

<p><li>Click <b>Create Listing Item</b> to proceed with creating a new template for the layout.</li></p>

<p><li>On Elementor editing page you’ll see <b>Listing Grid</b> widget in the <b>Listing Elements</b> block. Drag and drop it to the page where you want to place the layout.</li></p></li></p></ol>

<h4>Listing Grid Widget Settings</h4>

<h5>Content</h5>

<h6>General</h6>

  	 	<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/grid/3.png">
  	</figure>

<ul class="marked-list">
<li><b>Listing</b> - here you need to select the listing template type to use in the layout.</li>

<li><b>Columns Number</b> - here you have to specify the number of columns to be shown in the layout.</li>

<li><b>Use as Archive Template</b> - enable this option in case you want to pull the number of posts to be displayed on Archive page from the default Reading settings.</li>

<li><b>Posts Number</b> - here you need to set the number of posts to be displayed with the selected layout (in the case you’ve selected Use as Archive template option you won’t be able to set this value).</li></ul>

<h6>Posts Query</h6>

  	 	<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/grid/4.png">
  	</figure>

<p>In this block you’ll be able to set the advanced parameters for the posts query (this is needed when you need to query the posts using different parameters, offsets, several terms with more complicated relations).</p>

<p>Click <b>Add Item</b> button to add the new query parameter.</p>

<ul class="marked-list">
<p><li><b>Type</b> - here you can specify the type of the query by which you want to display the posts. Depending on which parameter you’ve selected the options available will be different.</p>

	  	 	<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/grid/5.png">
  	</figure>

<p>Posts Parameters Type</p>

  	 	<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/grid/6.png">
  	</figure>

<ul class="marked-list">
<li><b>Include Posts by IDs</b> - here you need to type in the IDs of the posts or pages you want to be displayed with the listing grid.</li>

<li><b>Exclude Posts by IDs</b> - here you can specify which posts or pages you want to shut from being displayed with the widget.</li>

<li><b>Get Child of</b> - type in the hierarchical post or page ID from which you want to get the Child posts or pages.
</li>
<li><b>Get posts with status</b> - here you can enable displaying for all the posts that have the selected status (publish, draft, etc).</li></ul>

<p>Order and Offset</p>

  	 	<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/grid/7.png">
  	</figure>

<ul class="marked-list">
<li><b>Posts Offset</b> - here you can select the offset to apply for the posts displayed in the grid.</li>

<li><b>Order</b> - select if you want to use ascending or descending order for the posts.</li>

<li><b>Order By</b> - here you can order the posts by date, type, name, etc. You can also specify the random order if you don’t want the posts to have any set order.</li></ul>

<p>Tax Query</p>

  	 	<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/grid/8.png">
  	</figure>

<ul class="marked-list">
<li><b>Taxonomy</b> - here you need to select the taxonomy using which you want to query the posts (tag, category or any custom taxonomy available for the posts displayed).</li>

<li><b>Taxonomy from meta field</b> - in the case you need to query the posts that have the taxonomy name type in the name that is set in the meta field.</li>

<li><b>Operator</b> - here you can select the operator to include or exclude the posts/pages from the taxonomy you want to query when checking the taxonomy on having the needed terms inside it.

<ul class="marked-list">
<li><b>IN</b> - this operator defines if you want to include the posts that have the defined term or taxonomy specified.</li>
<li><b>NOT IN</b> - this operator will prevent the posts that contain the set term or taxonomy from being displayed.</li>
<li><b>AND</b> - this operator enables for displaying all the posts or pages that contain both of the taxonomies and terms.</li></ul></li>

<li><b>Field</b> - here you can specify the field, which should be filled in in the case the posts are to be queried.

<li><b>Terms</b> - here you can specify the terms that need to be set in order for the post/page to be queried.

<li><b>Terms from meta field</b> - here you can specify the terms input in the meta field that define if the post would be queried.

<p>Please, note, that you can create several <b>Tax Query</b> items and set the <b>Meta Query</b> relation and <b>Tax Query</b> relation to display them using the more difficult relations:

	  	 	<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/grid/10.png">
  	</figure>

<ul class="marked-list">
<li><b>AND</b> - the posts that will be displayed need to meet all the Tax Query or Meta Query requirements, containing everything that is specified. In the case the post contains only one of the needed meta or taxonomy terms, it won’t be displayed in the listing grid.</li>
<li><b>OR</b> - the posts that will be displayed need to meet at least one of the the Tax Query or Meta Query requirements, containing at least one feature that is specified.</li>
</p></li></ul></p></li></li></li></ul>

<p>Meta Query</p>

  	 	<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/grid/9.png">
  	</figure>

<ul class="marked-list">
<li><b>Key</b> - here you need to fill in the name or ID of the meta field which you want to use to query posts or pages.</li>

<li><b>Operator</b> - here you can set one of the operators to query the posts that meet the needed requirements.

<ul class="marked-list">
<li><b>Equal</b> - the posts should have the meta field value that is equal to the set value in Value field.</li>
<li><b>Not equal</b> - the posts should have the meta field value that is not the same as the set value in Value field.</li>
<li><b>Greater than</b> - the posts should have the meta field value that is greater than the set value in Value field.</li>
<li><b>Greater or equal</b> -  the posts should have the meta field value that is equal or greater than the set value in Value field.</li>
<li><b>Less than</b> -  the posts should have the meta field value that is lesser than the set value in Value field.</li>
<li><b>Equal or less</b> -   the posts should have the meta field value that is equal  lesser than the set value in Value field.</li>
<li><b>Like</b> -   the posts should have the meta field values that are similar to the set value in Value field by some criteria.</li>
<li><b>Not like</b> -    the posts should have the meta field values that are not similar to the set value in Value field by some criteria.</li>
<li><b>In</b> -  the posts should have the meta field values that include the set value in Value field.</li>
<li><b>Not in</b> -   the posts should have the meta field values that don’t include the set value in Value field.</li>
<li><b>Between</b>-  the posts should have the meta field value that is between the range of the set value in Value field.</li>
<li><b>Not between</b> -   the posts should have the meta field value that is not between the range of the set value in Value field.</li></ul></li>

<li><b>Value</b> - here you need to specify the value to use for the meta query operator.</li>

<li><b>Type</b> - here you need to select one of the types to apply to the meta field value to work with it ( character, numeric, binary, date, decimal, signed, unsigned).</li></ul></li></p></ul>

<h5>Terms Query</h5>

  	 	<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/grid/11.png">
  	</figure>

<p>In this block you’ll be able to set the advanced parameters for the terms query (this is needed when you have to query the terms using different parameters, offsets, several terms with more complicated relations). Please, note that it works only for the Terms source.</p>

<ul class="marked-list">
<li><b>Get terms of posts</b> - here you need to add the IDs of the posts from which you want to query the terms.</li>

<li><b>Order By</b> - here you can set the needed order to display the terms (name, sug, count, term group, description, parent, count, term ID, etc.)</li>

<li><b>Order</b> - here you can set the ascending or descending order to apply for the post.</li>

<li><b>Hide Empty</b> - enable this option to hide the empty taxonomies from view.</li>


<li><b>Include terms</b> - here you need to specify the terms which should be in the taxonomy to include it.</li>

<li><b>Exclude terms</b> - here you have to specify the terms that will define the category as the one to be excluded.</li>

<li><b>Offset</b> - here you can set the offset for the terms to be displayed.</li>


<li><b>Child of</b> - here you can specify if you want to display the terms that are the child ones of the parent taxonomy.</li></ul>

<h5>Meta Query</h5>

  	 	<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/grid/12.png">
  	</figure>

<p>Click <b>Add Item</b> button to add a new circumstance for the terms query.</p>

<ul class="marked-list">
<li><b>Key</b> - here you need to type in the meta key of one of the meta fields added for the taxonomy type.</li>

<li><b>Operator</b> -  here you can set one of the operators to query the terms that meet the needed requirements.

<ul class="marked-list">
<li><b>Equal</b> - the terms should have the meta field value that is equal to the set value in Value field.</li>
<li><b>Not equal</b> - the terms should have the meta field value that is not the same as the set value in Value field.</li>
<li><b>Greater than</b> - the terms should have the meta field value that is greater than the set value in Value field.</li>
<li><b>Greater or equal</b> -  the terms should have the meta field value that is equal or greater than the set value in Value field.</li>
<li><b>Less than</b> -  the terms should have the meta field value that is lesser than the set value in Value field.</li>
<li><b>Equal or less</b> -   the terms should have the meta field value that is equal  lesser than the set value in Value field.</li>
<li><b>Like</b> -   the terms should have the meta field values that are similar to the set value in Value field by some criteria.</li>
<li><b>Not like</b> -    the terms should have the meta field values that are not similar to the set value in Value field by some criteria.</li>
<li><b>In</b> -  the terms should have the meta field values that include the set value in Value field.</li>
<li><b>Not in</b> -   the terms should have the meta field values that don’t include the set value in Value field.</li>
<li><b>Between</b> -  the terms should have the meta field value that is between the range of the set value in Value field.</li>
<li><b>Not between</b> -   the terms should have the meta field value that is not between the range of the set value in Value field.</li></ul></li>

<li><b>Value</b>- here you need to specify the value to use for the meta query operator.</li>

<li><b>Type</b> - here you need to select one of the types to apply to the meta field value to work with it ( character, numeric, binary, date, decimal, signed, unsigned).</li>

<li><b>Meta Query Relation</b> - in the case you’re using several meta query methods, just select the needed relation to specify how the query should be done.

<ul class="marked-list">
<li><b>AND</b> - the terms that will be displayed need to meet all the Meta Query requirements, containing everything that is specified. In the case the terms contains only one of the needed meta or terms, it won’t be displayed in the listing grid.</li>
<li><b>OR</b> - the terms that will be displayed need to meet at least one of the the Meta Query requirements, containing at least one feature that is specified.</li></ul>


