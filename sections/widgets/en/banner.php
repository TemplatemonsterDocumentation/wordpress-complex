	<h3>Banner</h3>

	<p>This widget is designed to add banners to the website</p>

    <figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/widgets/banner.png">
    </figure>

    <ul class="marked-list">
<?php if ($project == 'vegetexia') { ?>
    <li>
        <dl class="inline-term">
            <dt>Widget Title</dt>
            <dd>
                Enter the title of the widget
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Banner title</dt>
            <dd>
                Enter the title of the banner
            </dd>
        </dl>
    </li>
     <li>
        <dl class="inline-term">
            <dt>Description</dt>
            <dd>
                Specify the description of the banner image
            </dd>
        </dl>
    </li>
<?php } ?>
<?php if ($project == 'travelop') { ?>
    <li>
        <dl class="inline-term">
            <dt> Title</dt>
            <dd>
                Enter the title of the widget
            </dd>
        </dl>
    </li>
<?php } ?>
    <li>
        <dl class="inline-term">
            <dt>Source</dt>
            <dd>
                Choose the source image for the banner

            </dd>
        </dl>
    </li>  
    <li>
        <dl class="inline-term">
            <dt>Link</dt>
            <dd>
                This option allows you to add a link to a particular banner. Hover on a thumbnail in the customizer and click the button in the middle of it to specify the address

            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Open in</dt>
            <dd>
                Specify whether to open the link in a current window or in a new one 
            </dd>
        </dl>
    </li>
</ul>