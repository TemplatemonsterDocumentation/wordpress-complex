	<h3>Featured Post Block</h3>

	<p>This widget is used to display featured post block information</p>

    <figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/widgets/featured-post-block.png">
    </figure>

<?php if ($project == 'monstroid_2') { ?>
	<h5>Title</h5>

	<p>Here you can set the title to be displayed in the sidebar</p>
    
<?php } ?>


<?php if ($project == 'gadnews' OR $project == 'kingnews' OR $project == 'weeklyjournal' OR $project == 'globera' OR $project == 'monstroid_2') { ?>

	<h5>Layout</h5>

	<p>Here you can select the appropriate layout type</p>

	<h5>Posts IDs (Optional)</h5>

	<p>Here you can select the appropriate post IDs for display</p>

<?php } ?>

<?php if ($project != 'monstroid_2') { ?>
	<h5>Post meta</h5>

	<ul class="marked-list">
	    <li>
			Show post title
	    </li>
	    <li>
			Show post excerpt
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

    <h5>Excerpt length</h5>

	<p>This property sets the number of symbols limit for excerpt.</p>
<?php } ?>

<?php if ($project == 'monstroid_2') { ?>
	<h5>Post meta</h5>

	<ul class="marked-list">
	    <li>
			Show title
	    </li>
	    <li>
			Show excerpt
	    </li>
	    <li>
			Show categories
	    </li>
	    <li>
			Show tags
	    </li>
	    <li>
			Show author
	    </li>
	    <li>
			Show date
	    </li>
	</ul>

	<h5>Title length</h5>
    <h5>Excerpt length</h5>

	<p>This property sets the number of symbols limit for excerpt.</p>
<?php } ?>