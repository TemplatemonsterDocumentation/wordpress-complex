	<h3>Subscribe and Follow</h3>

	<p>This widget is used to display blocks for Subscribe and Follow sections. List of social networks for the Follow block is same as in Social Menu.</p>

    <figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/widgets/subscribe-and-follow-widget.png">
    </figure>


    <ul class="marked-list">
<?php if ($project == 'stylepark') { ?>
     <li>
        <dl class="inline-term">
            <dt>Title</dt>
            <dd>
                Specify the widget title
            </dd>
        </dl>
    </li>

<?php } ?>
    <li>
        <dl class="inline-term">
            <dt>Enable Subscribe Box</dt>
            <dd>
                Enable/disable the subscribe box
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Subscribe Title</dt>
            <dd>
                This property specifies the subscribe box title
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Subscribe text message</dt>
            <dd>
                Here you can add text description for the subscribe form
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Subscribe input placeholder</dt>
            <dd>
                This property specifies a placeholder text “Enter Your Email Here” in the input area of the Subscribe Box
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Subscribe submit label</dt>
            <dd>
                This property specifies a placeholder text “Submit” in the subscribe button of the Subscribe Box
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Subscribe success</dt>
            <dd>
                This property specifies a success message text “You are successfully subscribed” in the subscribe area of the Subscribe Box
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Enable Follow Box</dt>
            <dd>
                Hide/Show Follow Box
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Follow Title</dt>
            <dd>
                This property specifies the follow box title
            </dd>
        </dl>
    </li>
        <li>
        <dl class="inline-term">
            <dt>Follow text message</dt>
            <dd>
                Here you can add text description for the Follow block
            </dd>
        </dl>
    </li>
<?php if ($project == 'bitnews') { ?>
        <li>
            <dl class="inline-term">
                <dt>Custom background image</dt>
                <dd>
                    Select the background image for the widget
                </dd>
            </dl>
        </li>
<?php } ?>
<?php if ($project == 'waylard') { ?>
        <li>
            <dl class="inline-term">
                <dt>Enable Custom Background</dt>
                <dd>
                    Enable/disable custom background
                </dd>
            </dl>
        </li>
<?php } ?>
</ul>
