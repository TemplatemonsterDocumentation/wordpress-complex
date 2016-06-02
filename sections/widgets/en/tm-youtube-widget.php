	<h3>TM YouTube Subscribe Widget</h3>

	<p>This widget is used to setup and display YouTube subscribe form on the website.</p>

<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/widgets/tm-youtube-widget.png">
</figure>

	<ul class="marked-list">
<?php if ($project == 'stylepark') { ?>
     <li>
        <dl class="inline-term">
            <dt>Choose widget background</dt>
            <dd>
                The option allows you to change the widget background
            </dd>
        </dl>
    </li>

<?php } ?>

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
            <dt>API key</dt>
            <dd>
                Enter your YouTube API key
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Channel Title</dt>
            <dd>
                Enter the title of your channel
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Channel URL</dt>
            <dd>
                Enter the URL address of your channel
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Text to display when there are no video </dt>
            <dd>
                Text that will come up if the video is unavailable
            </dd>
        </dl>
    </li>
     <li>
        <dl class="inline-term">
            <dt>Text to display when there is one video </dt>
            <dd>
                Text that will come up when only one video is uploaded
            </dd>
        </dl>
    </li>
     <li>
        <dl class="inline-term">
            <dt>Text to display when there is more than one video </dt>
            <dd>
                Text that will come up if more than one video is available on the channel
            </dd>
        </dl>
    </li>
</ul>