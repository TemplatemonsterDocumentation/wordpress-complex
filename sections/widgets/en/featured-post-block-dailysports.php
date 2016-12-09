	<h3>Featured Posts Block</h3>

	<p>This widget is used to display featured post block information</p>

    <figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/widgets/featured-post-block.png">
    </figure>




<?php if ($project == 'dailysports' OR $project == '') { ?>

	<h5>Layout</h5>

	<p>Here you can select the appropriate layout type</p>

	<h5>Posts IDs (Optional)</h5>

	<p>Here you can select the appropriate post IDs for display</p>

<?php } ?>

	<h5>Post meta</h5>
	<ul class="marked-list">
	    <li>
			Show post title
	    </li>
	    <li>
			Show post categories
	    </li>
	    <li>
			Show post tags
	    </li>
	    <li>
			Show post author
	    </li>
	    <li>
			Show post date
	    </li>
	    <li>
			Show post comments count
	    </li>
	</ul>

  