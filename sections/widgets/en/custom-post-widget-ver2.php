    <h3>Custom Posts</h3>

    <p>This widget is used to setup and display custom posts.</p>

    <figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/widgets/custom-posts.png">
    </figure>

    <ul class="marked-list">
    <li>
        <dl class="inline-term">
            <dt> Title</dt>
            <dd>
                This property specifies the widget title
            </dd>
        </dl>
    </li>
        <li>
        <dl class="inline-term">
            <dt>Choose taxonomy type</dt>
            <dd>
                Select a proper taxonomy type. You can choose from Category, Tag, Post Format
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Select category</dt>
            <dd>
                Select the category to pull the posts from
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Select tags</dt>
            <dd>
                Select tags to use for posts display
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Select post format</dt>
            <dd>
                Select a proper post format from the dropdown list
            </dd>
        </dl>
    </li>
     <li>
        <dl class="inline-term">
            <dt>Posts count </dt>
            <dd>
                Here you can define the number of posts to display
            </dd>
        </dl>
    </li>

    <li>
        <dl class="inline-term">
            <dt>Offset post </dt>
            <dd>
                This property specifies the number of posts to displace or pass over
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Title words length </dt>
            <dd>
                This property sets the number of words limit for post's title. Set 0 to hide title
            </dd>
        </dl>
    </li>
   
    <li>
        <dl class="inline-term">
            <dt>Excerpt words length</dt>
            <dd>
                This property sets the number of words limit for an excerpt
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Display post meta data</dt>
            <dd>
                This feature adds meta data to the post
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Post read more button label</dt>
            <dd>
                Add text to the "Read More" button
            </dd>
        </dl>
    </li>
<?php if ($project != 'bettaso') { ?>    
    <li>
        <dl class="inline-term">
            <dt>Custom CSS Class</dt>
            <dd>
                Give this widget a unique class for further CSS customization
            </dd>
        </dl>
    </li>
<?php } ?> 
</ul>