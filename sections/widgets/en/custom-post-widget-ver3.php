    <h3>Custom Posts</h3>

    <p>This widget is used to setup and display custom posts.</p>

    <figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/widgets/custom-posts.png">
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
            <dt>Choose taxonomy type</dt>
            <dd>
                Select a proper taxonomy type. You can choose from Category, Tag, Post Format
            </dd>
        </dl>
    </li>

    </li>
        <li>
        <dl class="inline-term">
            <dt>Category</dt>
            <dd>
                Select the category from which the posts will be displayed
            </dd>
        </dl>
    </li>

    </li>
        <li>
        <dl class="inline-term">
            <dt>Tag</dt>
            <dd>
                Specify the tag to display posts
            </dd>
        </dl>
    </li>

    </li>
        <li>
        <dl class="inline-term">
            <dt>Post Format</dt>
            <dd>
                Specify the post format
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
    <?php if ($project == 'vegetexia'OR $project == 'travelop') { ?>
     <li>
        <dl class="inline-term">
            <dt>Display thumbnails</dt>
            <dd>
                Specify whether to display thumbnails or not
            </dd>
        </dl>
    </li>

    <?php } ?>
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
                This property sets the number of excerpt words 
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
</ul>