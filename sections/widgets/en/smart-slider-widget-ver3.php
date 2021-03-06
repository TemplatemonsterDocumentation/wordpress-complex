	<h3>Smart Slider</h3>

	<p>This widget is used to setup and display the Smart Slider on the website.</p>

    <figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/widgets/smart-slider-widget.png">
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
  <?php if ($project != 'bellaina') { ?>
    <li>
        <dl class="inline-term">
            <dt>Choose taxonomy type</dt>
            <dd>
                Select taxonomy type of the slides
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Select category</dt>
            <dd>
                Here you can select category to pull the slides from
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Select tags</dt>
            <dd>
                Here you can select tags to pull the slides from
            </dd>
        </dl>
    </li>
<?php } ?>
<?php if ($project == 'bellaina') { ?>
    <li>
        <dl class="inline-term">
            <dt>Choose post type to display</dt>
            <dd>
                Select a proper post type for display
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Select property tags</dt>
            <dd>
                Here you can select tags to pull the slides from
            </dd>
        </dl>
    </li>
<?php } ?>
    <li>
        <dl class="inline-term">
            <dt>Posts count</dt>
            <dd>
                This property defines the number of posts / slides to display
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Display title </dt>
            <dd>
                Here you can define whether to Hide/Show the post title in a slide
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Display content</dt>
            <dd>
                Here you can define whether to Hide/Show the post content in a slide body
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Display more button</dt>
            <dd>
                Here you can define whether to Hide/Show the Read More button
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>More button text</dt>
            <dd>
                Read More button label
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Content words trimmed count</dt>
            <dd>
                This property defines the excerpt limit by choosing a number of words from the post content
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Slider width</dt>
            <dd>
                This property defines the slider width
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Slider height</dt>
            <dd>
                This property defines the slider height
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Slider orientation</dt>
            <dd>
                This property specifies the slider orientation. Smart slider slides are automatically set up in Horizontal / Landscape slide orientation, but you can change the slide orientation to Portrait / Vertical Portrait slide orientation
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Slide distance(px)</dt>
            <dd>
                This property specifies the distance between the slides in px
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Slide duration(ms)</dt>
            <dd>
                This property specifies slides duration (in ms) to trigger swipe to next/previous slide during long swipes
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Use fade effect?</dt>
            <dd>
                This property defines whether to enable/disable fade effect on sliding
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Use navigation?</dt>
            <dd>
                Here you can define whether to hide/show the navigation arrows
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Use pagination?</dt>
            <dd>
                Here you can define whether to hide/show bullet navigation on slides
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Use autoplay?</dt>
            <dd>
                Enable/disable autoplay
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Display fullScreen button?</dt>
            <dd>
                Here you can define whether to Hide/Show full screen button to display slider in full screen mode. It is not available in WordPress customizer preview
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Indicates if the slides will be shuffled</dt>
            <dd>
                This property specifies whether to shuffle the slides randomly, is disabled by default
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Use infinite scrolling?</dt>
            <dd>
                This property specifies whether to enable/disable the infinite scrolling on sliding
            </dd>
        </dl>
    </li>
    <?php if ($project == 'bellaina') { ?>
    <li>
        <dl class="inline-term">
            <dt>Pagination type</dt>
            <dd>
                Select a proper pagination type
            </dd>
        </dl>
    </li>
<?php } ?>
    <li>
        <dl class="inline-term">
            <dt>Display thumbnails?</dt>
            <dd>
                Here you can define whether to Hide/Show slide thumbnails below the slider
            </dd>
        </dl>
    </li>
</ul>