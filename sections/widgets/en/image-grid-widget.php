	<h3>Image Grid Widget</h3>

	<p>This widget is used to display image grid. By default, you have to select appropriate category or tags in order to start display</p>

    <figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/widgets/image-grid-widget.png">
    </figure>

    <ul class="marked-list">
    <li>
        <dl class="inline-term">
            <dt>Widget Title</dt>
            <dd>
                This property specifies the widget title
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Choose taxonomy type</dt>
            <dd>
                Here you can define the items selection source: by Category or Tag
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Select categories to show</dt>
            <dd>
                Choose the category to display posts from
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Select tags to show </dt>
            <dd>
                Choose tags to display posts from
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Post sorted</dt>
            <dd>
                This property specifies how to sort out posts on display
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Posts number</dt>
            <dd>
                Defines the number of posts/images displayed
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Offset post</dt>
            <dd>
                This property specifies the number of post to displace or pass over
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Title words length</dt>
            <dd>
                This property sets the number of words limit for post's title. Set 0 to hide the title
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Columns number</dt>
            <dd>
                Here you can define the number of columns to display the images (up to 4)
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Items padding ( size in pixels )</dt>
            <dd>
                This property specifies the distance between the category or tag elements in px
            </dd>
        </dl>
    </li>
    <?php if ($project == 'weeklyjournal') { ?>
        <li>
            <dl class="inline-term">
                <dt>
                    Custom CSS Class
                </dt>
                <dd>
                   Give this widget a unique class for further CSS customization
                </dd>
            </dl>
        </li>
    <?php } ?>
</ul>