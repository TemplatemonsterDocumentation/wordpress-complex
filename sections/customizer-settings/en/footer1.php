
<h3>Footer</h3>
<p>Settings for the website footer section</p>

<!--
<figure class="img-polaroid">
    <img src="img/tm/customizer/.png" alt="" >
</figure>
-->

<h5>Footer Styles</h5>
<ul class="marked-list">

    <li>
        <dl class="inline-term">
            <dt>Show footer logo</dt>
            <dd>
                Show/hide footer logo
            </dd>
        </dl>
    </li>

<?php if ($project == 'latteccino' or $project == 'spatulas' or $project == 'inigo' or $project == 'firedup') { ?>
    <li>
        <dl class="inline-term">
            <dt>Logo upload</dt>
            <dd>
                Select your main footer logo to be an image. You must choose a logo image from the media library in the next option
            </dd>
        </dl>
    </li>
<?php } ?>
    <li>
        <dl class="inline-term">
            <dt>Copyright text</dt>
            <dd>
                Set custom copyright text for your Footer area
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Show footer widgets area</dt>
            <dd>
                Show/hide footer widgets area
            </dd>
        </dl>
    </li>
<?php if ($project != 'firedup') { ?>
    <li>
        <dl class="inline-term">
            <dt>Widget Area Columns</dt>
            <dd>
                Here you can set a number of columns for site widgets, 1 to 4
            </dd>
        </dl>
    </li>
<?php } ?>
    <li>
        <dl class="inline-term">
            <dt>Layout</dt>
            <dd>
                Here you can define the footer layout type
            </dd>
        </dl>
    </li>
<?php if ($project != 'latteccino' && $project != 'spatulas' && $project != 'inigo' && $project != 'firedup') { ?>
    <li>
        <dl class="inline-term">
            <dt>Footer Widgets Area color</dt>
            <dd>
                Here you can define the Widget Area background color
            </dd>
        </dl>
    </li>
<?php } ?>

    <li>
        <dl class="inline-term">
            <dt>Footer Background color</dt>
            <dd>
                Here you can define the Footer Area background color
            </dd>
        </dl>
    </li>
<?php if ($project == 'latteccino' or $project == 'spatulas') { ?>
    <li>
        <dl class="inline-term">
            <dt>Footer Widgets Area Background color</dt>
            <dd>
                Here you can define the Widget Area background color
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Show footer menu</dt>
            <dd>
                Show/hide footer menu
            </dd>
        </dl>
    </li>
<?php } ?>
</ul>

<ul class="marked-list">
<?php if ($project == 'inigo') { ?>
    <li>
        <dl class="inline-term">
            <dt>Background Repeat</dt>
            <dd>
                Set background repeat for footer image
            </dd>
        </dl>
    </li>
     <li>
        <dl class="inline-term">
            <dt>Background Position</dt>
            <dd>
                Set background position for footer image
            </dd>
        </dl>
    </li>
     <li>
        <dl class="inline-term">
            <dt>Background Attachment</dt>
            <dd>
                Set background attachment for footer image
            </dd>
        </dl>
    </li>
<?php } ?>

<?php if ($project == 'firedup') { ?>
    <li>
        <dl class="inline-term">
            <dt>Top Widget Area Columns</dt>
            <dd>
                Here you can set a number of columns for site widgets, 1 to 4
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Bottom Widget Area Columns</dt>
            <dd>
                Here you can set a number of columns for site widgets, 1 to 4
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Footer Widgets Top Area Background</dt>
            <dd>
                Here you can define the Widget Area background color
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Footer Widgets Bottom Area Background Color</dt>
            <dd>
                Here you can define the Widget Area background color
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Footer Widgets Top Area Background Image</dt>
            <dd>
                Here you can define the Widget Area background image
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Footer Widgets Bottom Area Background Image</dt>
            <dd>
                Here you can define the Widget Area background image
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Show Second Footer Widgets Area</dt>
            <dd>
                Here you can show/hide the second footer widgets area
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Show Footer Menu</dt>
            <dd>
                Here you can show/hide footer menu
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Show Pay Systems in Footer</dt>
            <dd>
                Here you can show/hide pay systems in footer area
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Image pay system link</dt>
            <dd>
                Here you can define the link of the pay system
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Image pay system upload</dt>
            <dd>
                Here you can define the image for your pay system
            </dd>
        </dl>
    </li>
<?php } ?>



<?php if ($project != 'inigo') { ?>
<h5>Footer Contact Block</h5>
<ul class="marked-list">
    <li>
        <dl class="inline-term">
            <dt>Show footer contact block</dt>
            <dd>
                Show/hide footer contact block
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Contact item 1</dt>
            <dd>
                Here you can set a contact icon and contact information
            </dd>
        </dl>
        <ul class="marked-list">
            <li>
                <strong>Label</strong> – Contact name
            </li>
            <li>
                <strong>Value</strong> – Contact content
            </li>
        </ul>
    </li>

    <li>
        <dl class="inline-term">
            <dt>Contact item 2</dt>
            <dd>
                Here you can set a contact icon and contact information
            </dd>
        </dl>
        <ul class="marked-list">
            <li>
                <strong>Label</strong> – Contact name
            </li>
            <li>
                <strong>Value</strong> – Contact content
            </li>
        </ul>
    </li>

   <li>
        <dl class="inline-term">
            <dt>Contact item 3</dt>
            <dd>
                Here you can set a contact icon and contact information
            </dd>
        </dl>
        <ul class="marked-list">
            <li>
                <strong>Label</strong> – Contact name
            </li>
            <li>
                <strong>Value</strong> – Contact content
            </li>
        </ul>
    </li>
</ul>
<?php } ?>
