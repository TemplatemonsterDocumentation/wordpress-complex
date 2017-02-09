
<h3>Logo & Favicon</h3>
<p>You can configure logo and favicon here</p>

<!--
<figure class="img-polaroid">
    <img src="img/tm/customizer/.png" alt="" >
</figure>
-->

<h5>Logo Type</h5>

<ul class="marked-list">
    <li>
        <dl class="inline-term">
            <dt>Image</dt>
            <dd>
            	You can choose a logo image from the media library in the next option
            </dd>
        </dl>
    </li>

    <li>
        <dl class="inline-term">
            <dt>Text</dt>
            <dd>
            	Your WordPress Site Title will be shown instead
            </dd>
        </dl>
    </li>
</ul>

<h5>Logo Upload</h5>

<p>Click the "Choose Media" button to select the logo image from the media library or upload your image.</p>


<?php if ($project == 'monstroid_2') { ?>
<h5>Invert Logo Upload</h5>

<p> Upload invert logo. Displays only at style 1 header layout. </p>
<?php } ?>

<h5>Retina Logo Upload</h5>

<p>Here you can upload the logo for retina-ready devices</p>

<?php if ($project == 'monstroid_2') { ?>
<h5> Invert Retina Logo Upload</h5>

<p> Upload invert logo for retina-ready devices. Displays only at style 1 header layout. </p>
<?php } ?>

<?php if ($project != 'roadway' &&  $project != 'tradex' &&  $project != 'italica' &&  $project != 'mohican' &&  $project != 'gutenberg' &&  $project != 'knox' &&  $project != 'gaze' &&  $project != 'techlab' &&  $project != 'organica' &&  $project != 'infobyte' &&  $project != 'transit' &&  $project != 'jericho' &&  $project != 'walden' &&  $project != 'chefplaza' &&  $project != 'agrilloc' &&  $project != 'monstroid_2' &&  $project != 'stylefactory' &&  $project != 'hardwire' && $project != 'thedailypost' && $project != 'streamline') { ?>
<h5>Retina Invert Logo Upload</h5>

<p> Upload invert logo for retina-ready devices. Displays only at style 1 header layout. </p>
<?php } ?>

<?php if ($project == 'bellaina') { ?>
    <h5>Invert Logo Upload</h5>

<p>Upload invert logo image. Displays only at style 1 header layout.</p>

<?php } ?>


<h5>Site Icon</h5>

<p>Icon image that is displayed in the browser address bar and browser tab heading.  Icons must be square. Max icon (.ico) size is 32x32 px. You can also upload favicon for retina displays. Max retina icon size: 512x512 px. Also you can <strong>Enable Retina optimization</strong> and <strong>Show preloader when open a page</strong> via selecting the checkbox.</p>