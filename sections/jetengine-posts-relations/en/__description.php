<h3>Posts relations</h3> 



<h6>This block explains in details the process of creating relations between the posts. Using posts relations you can easily set the ‘one-to-one’, ‘one-to-many’, and ‘many-to-many’ relations between the posts and custom post types to display the specific posts that are related in a set way to the post you’re displaying. 

Please, keep reading this block to learn how to create and use the relations between the posts (and custom post types).</h6> 

<h4>Step 1. Introduction to Posts Relations</h4>

<p>The posts relations allow creating the logical connections between the posts. There are 3 types of such relations, that can be used in different cases. Let’s overview each of them. </p>

<ul class="marked-list">
<p><li><b>One-to-one</b></li></p>

<p>This type of relations between the posts fits when you know that one custom post type can be connected only to one different post type, and vice versa.</p> 
<p>E.g., there is a <b>Constellation</b> post type with the posts featuring the titles and images of the constellations located in the Northern Hemisphere. Save the changes.</p> 
<p>There is also an <b>Alpha</b> post type. Here we have the posts with the names and photos of the brightest stars (alphas) of the constellations.</p> 

<p>To connect these posts we choose the “one-to-one” relation because each of the constellations has only one alpha star. And one alpha star can be found only in one constellation.</p> 

<p>When we link the Andromeda constellation to the star called  Alpheratz, the relation is created, and we won’t be able to add any more Alpha star post types to Andromeda post, as well as we won’t be able to link any more constellations to the already selected alpha star.</p> 

<p>But there can be more constellations and more alpha stars linked to one another.</p>

<p><li><b>One-to-many</b></li></p>

<p>This relations type is perfect in cases where one post type can be related to many other posts of a different type. But there is only one post type that can be related to them.</p> 

<p>E.g., there is a <b>Constellation post</b> type where we have added different constellations. There is also <b>Stars</b> post type where we have added different stars (not only the brightest ones but actually different ones).</p> 

<p>When we create the relations between such post types, we select “One-to-many” relations type, because one star can be related only to one of the constellations (we can’t select it for many constellations). However, we can assign many stars to a single constellation.</p> 

<p><li><b>Many-to-many</b></li></p>

<p>This relations type allows linking many custom post types to many different post types at once.</p> 

<p>E.g., let’s imagine that we have a comet that enters different solar systems on its orbit. However, there is more than one comet entering each of these solar systems. So we create Comet and Solar system post types and use “many-to-many” relations between them.</p> 

<p>This way, we can link all the solar systems the comet enters on its way, and we can link all the comets that enter one solar system.</p></ul> 

<h4>Step 2. Creating the relations</h4>

<ol class="index-list">
<p><li>After selecting the proper posts relations type, to create the relations between the posts you need to navigate to <b>JetEngine > Posts Relations</b> block and here click the <b>Add New</b> button.</li></p> 

<p><li>The <b>Add New Posts Relationship</b> page opens. Here you need to fill in the fields to create the relations between the post types you have.</li></p>

<ul class="marked-list">
<p><li><b>Name</b> - type in the name to use for the relations (e.g., “Events Map”).</li></p>
<p><li><b>Post type 1 (parent)</b> - use the dropdown to view the list of existing post types and select the post type that will become the parent one. E.g., when working with events and locations, the event held in different places will become the parent post to multiple locations.</li></p>
<p><li><b>Post type 2 (child)</b> - use the dropdown to select the post type that will be related to the one selected in Post type 1 block (e.g., Locations post type).</li></p>
<p><li><b>Relation type</b> - here select the relations type you want to apply between the post types (e.g., many events will be held in many locations, some events will be held in the same city, and some cities will have several events, so we select “Many-to-many” relation type).</li></p>
<p><li><b>Add meta box to parent page</b>  - enable this option to allow selecting the related posts of the child post type when one views the parent post’s editing page.</li></p> 
<p><li><b>Add meta box to Child page</b> - enable this option to allow selecting the related posts of the parent post type when one views the child post’s editing page.</li></p></ul> 


<div class="alert alert-info">
        Please, note, that once you select the post that’s related to the other post of a different type, the post you’ve selected is automatically linked back. </div>

<p><li>After that save the relation.</li></p></ol> 

<h4>Step 3. Setting the relations between the posts of different types</h4>

<ol class="index-list">
<p><li>Once you’ve created the relations, you can proceed to setting the relations between the specific posts.</li></p> 
<p><li>Open one of the posts that has the meta box active for editing and set the related posts. Then save the changes. </li></p></ol> 

<h4>Step 4. Displaying the related posts of different type with Listing Grid</h4>
<p>You can either display the related posts of different type either using <b>Dynamic Field</b> or <b>Listing Grid</b> widgets.</p> 

<h3><b>Dynamic Field</b></h3>
<ol class="index-list">
<p><li>Drop the <b>Dynamic Field</b> widget to the page template where you want to display the related child/parent posts.</li></p>
<p><li>Select the <b>Meta Data</b> option in the <b>Source</b> dropdown.</li></p> 
<p><li>Select the name of the meta field (e.g., “Child Locations”, “Parent Events”, etc).</li></p> 
<p><li>Enable <b>Filter</b> field output option. Select the <b>Related posts</b> list in the <b>Callback</b> dropdown.</li></p> 
<p>Also, there are additional options that become available when the callback is selected:</p>
<p><li><b>Single value</b> - enable this option to allow displaying only one related post (even if there are several of them linked).</li></p> 
<p><li><b>Add links to related posts</b> - enable this option to make the related posts shown in the list linked.</li></p> 
<p><li><b>Related list HTML tag</b> - here you can select the HTML tag to use for the related posts displayed (e.g., UL tag displays the posts in the form of the list with bullets, the OL tag arranges then in the numeric list, and the DIV tag allows displaying the posts in one row.</li></p>  
<p><li><b>Delimiter</b> - here you can set the separator to show between the related posts if there are several of them.</li></p></ol> 

<h3><b>Listing Grid</b></h3>

<ol class="index-list">
<p><li>First, to use the <b>Listing Grid</b> for displaying the related posts, you need to create the single listing for the related posts. You can read in more details about creating a new listing <a href="https://documentation.zemez.io/wordpress/index.php?project=jetengine&lang=en&section=jetengine-custom-post-type#creating-cpt-template
" target="_blank">here</a>.</li></p> 
<p><li>After the listing is created, open the single post page template and drop the listing grid widget to it.</li></p> 
<p><li>Select a listing to show in <b>Listing</b> dropdown.</li></p> 
<p><li>Now you can filter the <b>Listing Grid</b> widget’s content to display only the related posts using the specific macros codes.</li></p> 
<p><li>Open <b>Posts Query</b> block and here add a new item with <b>Posts Parameters</b> type.</li></p> 
<p><li>Paste the <b>%related_children_from|post-type-slug%</b> or <b>%related_parents_from|post-type-slug%</b> macros inside the <b>Include posts by IDs</b> field.</li></p> 
<p>Please, note, that you can display either parent or child related posts, and the “|post-type-slug” stands for the actual post type slug (e.g., “locations”).</p></ol> 





