<h2>Smart Post Tiles</h2>


<h6>
Smart Post Tiles module will assist you in adding your posts to the website’s page in the form of an eye-catching tiles block with immaculate layout and impeccable style. This module has versatile style settings, allowing to add gap between boxes, create box overlays, change content appearance and meta information. It also has 6 pre-built layouts that will help you showcase your posts in a totally advantageous way.
</h6>

<h4>Smart Post Tiles Module Sample</h4>

<h6>On the picture below you can view Smart Post Tiles module sample.</h6>

 	<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/modules/tiles3.png">
  	</figure>

<h4>Content</h4>

 	<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/modules/tiles1.png">
  	</figure>


<h6>General</h6>


<ul class="marked-list">
<p><li><b>Layout</b> - here you can select one of the 6 layouts to display your posts content in the most suitable way.</li></p>
<p><li><b>Min Height</b> - use the controls or type in the height value in the corresponding field in order to define the minimal Smart Post Tiles module height. </li></p>
<p><li><b>Main Box Width</b> - use the controls or type in the height value in the corresponding field in order to define the main box (the largest box) width. </li></p>
<p><li><b>Show Post Terms</b> - enable this option in order to display the post terms (categories or tags). </li></p>
<p><li><b>Show Terms From</b> - here you can select, if you want to display tags or categories. </li></p>
<p><li><b>Max Terms to Show</b> - here you can set, how many tags or categories you want to show per one post (1-4, or all of them).</li></p>
<p><li><b>Title Max Length (Words)</b> - here you can set the maximum length or the post title in words.</li></p>
<p><li><b>Excerpt Length</b> - here you can specify the post excerpt length to display with this module.</li></p>
<p><li><b>Show Excerpt on Small Boxes Only on Hover</b> - enable this option in order to show the post excerpt texts only when on hover.</li></p>
<p><li><b>Post Meta</b> - enable this option to display the post meta information in this module.</li></p>
<p><li><b>Show Post Author</b> - enable this option in order to display the post author for the post.</li></p>
<p><li><b>Author Icon</b> - if the previous option is active, you can select the icon to display on the left of the post author’s username.</li></p>
<p><li><b>Show Post Date</b> - enable this option in order to display the date when the post is published.</li></p>
<p><li><b>Date Icon</b> - when the previous option is active, you can select the icon to display it on the left of the post publishing date.</li></p>
<p><li><b>Show Post Comments</b> - enable this option in order to display the number of comments to the post.</li></p>
<p><li><b>Comments Icon</b> - when the previous option is active, you can select the icon to display it on the left of the number of comments to the post.</li></p></ul>


<h6>Query and Controls</h6>


<ul class="marked-list">
<p><li><b>Query Posts By</b> - here you can select the query type you want to use for this module’s content (<b>Categories, Tags</b> or <b>All</b>).</li></p>
<p><li><b>Get posts from categories/tags/IDs</b> - here you can select which post categories/tags/IDs you want to display using the Smart Post Tiles module.</li></p>
<p><li><b>Exclude Posts by IDs</b> - here you can specify the post IDs you want to exclude from showing up.</li></p></ul>

  <figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/modules/list-new.png">
    </figure>


<ul class="marked-list">
<p><li><b>Filter by Custom Field</b> - enable this option to be able to filter the posts by custom field or even custom field value.</li></p>
<p><li><b>Custom Field Key</b> - input the custom field key for the posts to show only those which have this custom field.</li></p>
<p><li><b>Custom Field Value</b> - here you can specify the value by which the posts will be sorted and shown (e.g., key: color, value: red).</li></p>
</ul>


<p><li><b>Enable Carousel</b> - enable this option if you want to display the post tiles in the form of the posts carousel.</li></p>
<p><li><b>Number of Slides</b> - here you can define the number of slides you want to display with this module.</li></p>
<p><li><b>Show Controls Arrows</b> - enable this option if you want to enable carousel arrow controls.</li></p>
<p><li><b>Select Control Arrows Type</b> - here you can change the arrow controls icons.</li></p></ul>

<h6>Custom Fields</h6>

<ul class="marked-list">
<p><li><b>Show Meta Before/After Title</b> - enable this option in order to show the custom meta information before or after the title. </li></p>
<p><li><b>Meta Fields Position</b> - here you can select the position of the custom meta information displayed in fields.</li></p>
<p><li><b>Add Item</b> - click <b>Add Item</b> button to add a new custom meta field.</li></p></ul>

<ul class="marked-list">
<p><li><b>Show Meta Before/After Content</b> - enable this option in order to show the custom meta information before or after the content. </li></p>
<p><li><b>Meta Fields Position</b> - here you can select the position of the custom meta information displayed in fields.</li></p>
<p><li><b>Add Item</b> - click <b>Add Item</b> button to add a new custom meta field.</li></p></ul>

<h6>Adding Custom Meta Field</h6>

<ol class="index-list">
<p><li>First, let's access WordPress Dashboard and here navigate to <b>Posts > All Posts</b>. Select one of the posts and click <b>Edit</b> in order to add a custom meta field to it.</li></p>

<p><li>After that open the <b>Screen Options</b> located in the top right corner and check <b>Custom Fields</b> option. </li></p>

 	<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/modules/blog22.png">
  	</figure>


<p><li>Scroll the page down to see the <b>Custom Fields</b> block. Navigate to <b>Add New Custom Field</b> area and here fill in the Name of the custom field you want to use and the value to show it for this post.</li></p>

 	<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/modules/blog33.png">
  	</figure>

<p><li>In order to retrieve the <b>key</b> for this custom field you need to open the <b>phpMyAdmin</b> tool (you can find it in your <b>cPanel</b>) and open the database you're using. Here select <b>wp_postmeta</b> table and look for the <b>meta_key</b> of the custom field you've created. Copy it to the clipboard.</li></p>

 	<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/modules/blog44.png">
  	</figure>

<p><li>Now let's return to the <b>Custom Fields</b> block in <b>Smart Posts List</b>. Here click <b>Add Item</b> button and paste the meta key you've previously copied in the <b>Key</b> field. E.g., to show the price for the item displayed in the post you need to create price custom field and set the price in the post when editing it. Then you need to copy the meta key for your new custom field from the database and paste it in the <b>Key</b> field.</li></p>

 	<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/modules/blog11.png">
  	</figure>


<p><li>Input the text you want to show before the meta information in the <b>Label</b> field. E.g., you can input 'Buy at $' in the <b>Label</b> field to show the text before the price.</li></p>

<p><li>Input the value format in the corresponding field (if you don't know how to work with it, please, don't change it.)</li></p>

<p><li>In the <b>Prepare meta value with callback</b> dropdown list you can select if you want to use a callback function to prepare the meta information before displaying it (Clean - for the clean value added in the custom field). </li></p>

<h4>Style</h4>

 	<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/modules/tiles2.png">
  	</figure>

<h6>Box</h6>

<ul class="marked-list">
<p><li><b>Gap Between Boxes</b> - use controls or input the gap value in pixels to use it as a gap between the tile boxes.</li></p>
<p><li><b>Padding</b> - here you can input your custom padding values to apply padding for the whole post tiles layout block.</li></p>
<p><li><b>Border Type</b> - here you can select the type of the border from the dropdown menu.</li></p>
<p><li><b>Border Radius</b> - here you can select the radius for the applied border (in pixels) to make the border andles more smooth and round.</li></p>
<p><li><b>Box Shadow</b> - enable this option if you want to access the shadow advanced settings for this module, and need to apply shadow for it.</li></p></ul>

<b>Box Overlay</b>

<p>You can customize the appearance of  the box overlay using the <b>Normal</b> or <b>Hover</b> mode. Just switch between the modes using the corresponding buttons.</p>

<ul class="marked-list">
<p><li><b>Background Type</b> - in this block you can choose, whether you want to use classic or gradient type for the box overlay. The customization options vary for each type.</li></p></ul>


<h6>Content</h6>

<b>Title</b>

<ul class="marked-list">
<p><li><b>Color</b> - here you can set the color for the module content using color picker tool.</li></p>
<p><li><b>Typography</b> - turn the option on to view the typography settings. They are similar to the typography settings of other JetBlog modules.</li></p>
<p><li><b>Margin</b> -  in this block you can input the values (in pixels) to define the margins for the module content you're customizing.</li></p></ul>

<b>Post Text</b>

<ul class="marked-list">
<p><li><b>Color</b> - here you can set the color for the post text using color picker tool.</li></p>
<p><li><b>Typography</b> - turn the option on to view the typography settings. They are similar to the typography settings of other JetBlog modules.</li></p>
<p><li><b>Margin</b> -  in this block you can input the values (in pixels) to define the margins for the post text.</li></p></ul>

<b>Meta</b>

<ul class="marked-list">
<p><li><b>Meta Icon Size</b> - use the controls to change the icon size or type in the size value in px in the corresponding field.</li></p>
<p><li><b>Meta Icon Gap</b> - here you can set the gap distance between the icon and the meta information text.</li></p>
<p><li><b>Background Color</b> - here you can set the background color for the post meta using color picker tool.</li></p>
<p><li><b>Text Color</b> - here you can set the color for the post text using color picker tool.</li></p>
<p><li><b>Typography</b> - turn the option on to view the typography settings. They are similar to the typography settings of other JetBlog modules.</li></p>
<p><li><b>Padding</b> - here you can set the preferable custom padding for the post meta. Fill in the values for the top, bottom, right and left padding in pixels to apply your custom padding.</li></p>
<p><li><b>Margin</b> - here you can apply your custom margins for the post meta.</li></p>
<p><li><b>Alignment</b> - here you can define the preferable post meta information alignment. It can be placed to the left, to the right, or remain centered.</li></p>
<p><li><b>Meta Divider</b> - here you can input the custom divider text or symbol.</li></p>
<p><li><b>Divider Gap</b> - here you can set the gap distance between the divider and the meta information text.</li></p></ul>

<b>Terms Links</b>

<p>You can customize the appearance of  the terms links (tags or categories) using the <b>Normal</b> or <b>Hover</b> mode. Just switch between the modes using the corresponding buttons.</p>

<ul class="marked-list">
<p><li><b>Background Type</b> - in this block you can choose, whether you want to use classic or gradient type for the terms links. The customization options vary for each type.</li></p>
<p><li><b>Color</b> - here you can set the background box color for the terms links using color picker tool.</li></p>
<p><li><b>Text Color</b> - here you can set the text color for the terms links using color picker tool.</li></p>
<p><li><b>Typography</b> - turn the option on to view the typography settings. They are similar to the typography settings of other JetBlog modules.</li></p>
<p><li><b>Text Decoration</b> - here you can apply the underline for the terms text.</li></p>
<p><li><b>Padding</b> - here you can set the preferable custom padding for the post terms links. Fill in the values for the top, bottom, right and left padding in pixels to apply your custom padding.</li></p>
<p><li><b>Border Radius</b> - here you can select the radius for the applied border (in pixels) to make the border angles more smooth and round.</li></p>
<p><li><b>Border Type</b> - here you can define the type of the border you need to use for the element.</li></p>
<p><li><b>Width</b> - here you can set the preferable border width in px.</li></p>
<p><li><b>Box Shadow</b> - enable this option if you want to access the shadow advanced settings for this module, and need to apply shadow for it.</li></p>
<p><li><b>Horizontal Alignment</b> - here you can set the preferable horizontal alignment (Left, Center, Right).</li></p>
<p><li><b>Vertical Alignment</b> - here you can set the needed vertical alignment (Top, Bottom).</li></p></ul>


<b>Paging Arrows</b>

<p>You can customize the appearance of  the paging arrows  using the <b>Normal</b> or <b>Hover</b> mode. Just switch between the modes using the corresponding buttons.</p>

<ul class="marked-list">
<p><li><b>Font Color</b> - here you can set the color to use it for the arrows using color picker tool.</li></p>
<p><li><b>Background Type </b>- in this block you can choose, whether you want to use classic or gradient type for the paging arrows. The customization options vary for each type.</li></p>
<p><li><b>Icon Size</b> - here you can set the preferable arrows icon size.</li></p>
<p><li><b>Box Size</b> - here you can set the preferable arrow box sizes using controls or by filling in the needed value in pixels.</li></p>
<p><li><b>Border Type</b> - here you can define the type of the border you need to use for the element.</li></p>
<p><li><b>Border Radius</b> - define the border radius value in pixels in the corresponding fields in order to make the border angles more smooth.</li></p>
<p><li><b>Box Shadow </b>- enable this option if you want to access the shadow advanced settings for the paging arrows, and need to apply shadow for them.</li></p></ul>

<b>Prev Arrow Position</b>

<ul class="marked-list">
<p><li><b>Vertical Position by</b> - define the vertical position for the prev arrow. It can be positioned at the top or at the bottom.</li></p>
<p><li><b>Top Indent</b> - define the vertical position indent in pixels, or use controls to define the suitable position automatically.</li></p>
<p><li><b>Horizontal Position by</b> - define the horizontal position for the prev arrow. It can be positioned on the left or on the right.</li></p>
<p><li><b>Left Indent</b> - define the horizontal position indent in pixels, or use controls to define the suitable position automatically.</li></p></ul>

<b>Next Arrow Position</b>

<ul class="marked-list">
<p><li><b>Vertical Position by</b> - define the vertical position for the next arrow. It can be positioned at the top or at the bottom.</li></p>
<p><li><b>Top Indent</b> - define the vertical position indent in pixels, or use controls to define the suitable position automatically.</li></p>
<p><li><b>Horizontal Position by</b> - define the horizontal position for the next arrow. It can be positioned on the left or on the right.</li></p>
<p><li><b>Right Indent</b> - define the horizontal position indent in pixels, or use controls to define the suitable position automatically.</li></p></ul>

<h4>Advanced</h4>

<p>In this block you can access advanced appearance settings for the modules, define module margins and padding, entrance animation, change the background for the whole module, etc.
</p>

<p>The Advanced settings of the Smart Post Tiles module are similar to the ones of the other JetBlog modules.</p>
