<h3>Displaying Related Posts in the Terms Listing</h3>

<p>From this block you'll learn how to displayed related posts in the terms listing using JetEngine plugin and Elementor.
</p>

<ol class="index-list">
	<li><p>First, you need to create a new <b>Posts</b> listing.</p></li>

	<li><p>Then create a <b>Term</b> listing. Here you need to add a term title (e.g., with Dynamic Field) and insert a Listing Grid widget. Also, set the posts listing you've previously created for displaying.</p></li>
	<li><p>After that, to pull only the posts from this specific term you should set the <b>Tax query</b>, select the taxonomy, and in <b>Terms</b> block add the following macros <b>%queried_term%</b>.

	  	 	<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/grid/13.png">
  	</figure></li></p>

  </p></li></ol>