	<h3>Recent Posts</h3>

	<p>This widget is used to display recent posts on the homepage.</p>

    <figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/widgets/recent-posts-widget.png">
    </figure>

	<ul class="marked-list">
    <li>
        <dl class="inline-term">
            <dt>Title</dt>
            <dd>
				This property specifies the widget title
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Number of posts to show</dt>
            <dd>
                This property allows you to change the number of the displayed posts
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Display post date?</dt>
            <dd>
                Show/hide post date
            </dd>
        </dl>
    </li>

<?php if ($project == 'fairystyle') { ?>
     <li>
        <dl class="inline-term">
            <dt>Display post author?</dt>
            <dd>
                Show/hide post author
            </dd>
        </dl>
    </li>

<?php } ?>
</ul>