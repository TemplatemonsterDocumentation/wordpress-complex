<h3>Quick Start</h3>

<p><b>Dummy data</b> is a file that contains the necessary settings to help one add content similar to the one shown on live demo. If one has troubles with adding content and changing its appearance settings or responsiveness, he can use dummy data files to export the needed settings.  </p>

<h5>Adding Dummy Data</h5>

<h6>Step 1. Creating a Menu</h6>


<p>To create a menu similar to the one you see on JetMenu live demo, you’ll need to create a custom menu with the same menu items.</p>


<ol class="index-list">
<p><li>To do it navigate to <b>Appearance > Menus</b> tab on the left of the Dashboard and click <b>Create a new menu</b> option.</li></p>

 	<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/dummy/1.png">
  	</figure>

<p><li>Enter the <b>menu name</b> (e.g., New) and click <b>Create Menu</b> button.</li></p>

 	<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/dummy/2.png">
  	</figure>

   	<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/dummy/3.png">
  	</figure>



<p><li>Let’s create menu items for our new menu. To do it open <b>Custom links</b> tab and add the following menu items: <b>Home, Lists, Drop-down, Multimedia, Portfolio, Blog, Shop</b> and <b>Contacts</b>.</li></p>

   	<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/dummy/4.png">
  	</figure>


<p><li>Assign the new menu to the needed location (in our case it will be Main) and click Save Menu button to save the changes.</li></p>

   	<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/dummy/5.png">
  	</figure>


<p><li>After that you need to enable using JetMenu for this menu. Turn on <b>Enable JetMenu for current location</b> option and click <b>Save</b> button to save the changes.</li></p></ol>

   	<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/dummy/6.png">
  	</figure>



<h6>Step 2. Importing Menu Appearance Settings</h6>


<ol class="index-list">
<p><li>Now let’s import the general menu style settings. To do it navigate to <b>JetMenu</b> tab on the left of the Dashboard and click <b>Import</b> button.</li></p>

   	<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/dummy/7.png">
  	</figure>



<p><li>Browse <b>options.json</b> file and click <b>Go</b> button.

	   	<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/dummy/8.png">
  	</figure>

<p><li>After the import is finished click <b>Save</b> button to save the changes.</li></p></ol>



<h6>Step 3. Importing Dummy Data</h6>


<ol class="index-list">
<p><li>First, you need to upload the dummy data templates to Elementor templates library. To do it navigate to <b>Elementor > My Library</b> and click <b>Import Templates</b> button.
</li></p>

   	<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/dummy/9.png">
  	</figure>

<p><li>Browse the dummy data file (it is located in <b>jet-menu/dummy-data</b> directory).</li></p>

   	<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/dummy/10.png">
  	</figure>

 <p><li>After that click <b>Import Now</b> button.</li></p>
<p><li>Repeat the actions described above to import all dummy data files to Elementor templates.</li></p></ol>


<h6>Step 4. Applying Dummy Data to Menu Items</h6>


<ol class="index-list">
<p><li>Navigate to <b>Appearance > Menus</b> on the Dashboard.</li></p>

<p><li>Hover on Lists menu item and click <b>JetMenu</b> option.</li></p>

   	<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/dummy/11.png">
  	</figure>

<p><li>A popup window will open. You need to switch on <b>Mega Submenu Enabled</b> option and click <b>Edit Mega Menu Item Content</b> button.</li></p>

   	<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/dummy/12.png">
  	</figure>


<p><li>When menu content editor will open, click <b>Add Template</b> button to view the templates.</li></p>

   	<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/dummy/13.png">
  	</figure>


<p><li>Then switch to <b>My Templates</b> tab on the top of the newly opened popup window. Here select Lists template and click <b>Insert</b> button.</li></p>

   	<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/dummy/14.png">
  	</figure>

<p><li>Click <b>Save</b> button to save the changes.</li></p></ol>

<h6>Useful Tips</h6>


<p>Here you can find several useful tips on how to make dummy data look like on JetMenu live demo. In some of the cases additional Elementor addons and plugins are required.</p>

<h6>Lists (content-lists.json)</h6>

<p>To make Lists dummy data look like on live demo, please, create several additional custom menus in <b>Appearance > Menus</b> and select them in <b>Edit Custom Menu > Content</b> block to add them to the necessary areas.</p>

<h6>Multimedia (content-multimedia.json)</h6>

<p>To make Multimedia dummy data look like on live demo, please, select one of your additional custom menus to show up with <b>Custom Menu</b> module.</p>

<h6>Blog (content-blog.json)</h6>

<p>In order to make Blog sumbenu look like on live demo you’ll need to have <a href="http://jetelements.zemez.io/" target="_blank">JetElements plugin</a> installed and activated.</p>

<h6>Shop (content-shop.json)</h6>

<p>If you want Shop module to look like on live demo, please, make sure that you’ve installed:</p>

<ul class="marked-list">
<li><a href="https://wordpress.org/plugins/woocommerce/" target="_blank">WooCommerce plugin</a>;</li>
<li><a href="http://jetelements.zemez.io/" target="_blank">JetElements plugin</a>.</li>
<p>You’ll also need to create products.</p>

<div class="alert alert-info"> Keep in mind, that the style of the modules containing WooCommerce products is dependent on the theme’s style settings.</div>


<h6>Contact Form (content-contacts.json)</h6>

<p>In order to make Contact Form submenu look like on live demo you’ll need to install and activate the following plugins:</p>
<ul class="marked-list">
<li><a href="https://wordpress.org/plugins/contact-form-7/" target="_blank">Contact Form 7 plugin</a>;</li>
<li><a href="http://jetelements.zemez.io/" target="_blank">JetElements plugin</a>.</li>
<p>You will also need to create a contact form using Contact Form 7 plugin and select it in <b>Contact Form 7 > Content</b> module block.</p>
<p>In the case there is no map in the Advanced Map module block, please, navigate to <b>Elementor > JetElements Settings</b> tab on the left of the Dashboard and insert the <b>API key</b> in the corresponding field.</p>

<div class="alert alert-info">For more information read <a href="https://developers.google.com/maps/documentation/javascript/get-api-key" target="_blank">Get API Key</a> tutorial.</div>




