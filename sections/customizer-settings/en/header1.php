
<h3>Header</h3>
<p>You can set header items here</p>

<!--
<figure class="img-polaroid">
    <img src="img/tm/customizer/.png" alt="" >
</figure>
-->

<h5>Header Styles</h5>

<?php if ($project == 'latteccino') { ?>
<ul class="marked-list">
    <li>
        <dl class="inline-term">
            <dt>Show Header Logo in Front Page</dt>
                <dd>
                    Here you can show/hide Header Logo on Front Page
                </dd>
        </dl>
    </li>
</ul>
<?php } ?>

<ul class="marked-list">
    <li>
        <dl class="inline-term">
            <dt>Background color</dt>
                <dd>
                    Here you can set background color for the header
                </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Background Image</dt>
            <dd>
                Here you can define site header background image
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Background Repeat</dt>
            <dd>
                This property sets if a background image will be repeated, or not. By default, a background-image is repeated both vertically and horizontally
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Background Position</dt>
            <dd>
                This property sets the starting position of a background image. By default, a background-image is placed at the top-left corner
            </dd>
        </dl>
    </li>

    <li>
        <dl class="inline-term">
            <dt>Background Attachment</dt>
            <dd>
                This property sets whether a background image is fixed or scrolls with the rest of the page. By default, a background attachment is scroll
            </dd>
        </dl>
    </li>

<?php if ($project == 'firedup') { ?>
    <li>
        <dl class="inline-term">
            <dt>Enable search</dt>
                <dd>
                    Enable / Disable search form in header
                </dd>
        </dl>
    </li>
<?php } ?>

<?php if ($project == 'spatulas') { ?>
    <li>
        <dl class="inline-term">
            <dt>Enable search</dt>
                <dd>
                    Enable / Disable search form in header
                </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Header call to action button</dt>
                <dd>
                    Customize header call to action button
                </dd>
        </dl>
    </li>
<?php } ?>
</ul>

<ul class="marked-list">
   <li>
        <dl class="inline-term">
            <dt>Layout</dt>
            <dd>
                Here you can select site style layout
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Header Overlay</dt>
            <dd>
                Enable/disable header overlay
            </dd>
        </dl>
    </li>

    <li>
        <dl class="inline-term">
            <dt>Enable invert color scheme</dt>
            <dd>
                Enable/disable invert color scheme
            </dd>
        </dl>
    </li>
</ul>


<h5>Top Panel</h5>

<p> You can set header top panel here.</p>

<ul class="marked-list">
    <li>
        <dl class="inline-term">
            <dt>Enable top panel</dt>
            <dd>
                Enable/disable top panel
            </dd>
        </dl>
    </li>

    <?php if ($project == 'firedup') { ?>
    <li>
        <dl class="inline-term">
            <dt>Background color</dt>
                <dd>
                    Here you can define header top panel background color
                </dd>
        </dl>
    </li>
<?php } ?>

<?php if ($project == 'spatulas') { ?>
    <li>
        <dl class="inline-term">
            <dt>Disclaimer Text</dt>
                <dd>
                    Here you can define header top panel text content
                </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Background color</dt>
                <dd>
                    Here you can define header top panel background color
                </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt> Enable top menu </dt>
                <dd>
                    Enable/disable top menu
                </dd>
        </dl>
    </li>
<?php } ?>
</ul>

<?php if ($project != 'spatulas' && $project != 'firedup') { ?>
<h5>Header Elements</h5>
<p> You can set header elements here.</p>
<ul class="marked-list">
    <li>
        <dl class="inline-term">
            <dt>Show search</dt>
                <dd>
                    Show / Hide search form in header
                </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Show header call to action button</dt>
                <dd>
                    Enable/disable header call to action button
                </dd>
        </dl>
    </li>
</ul>
<?php } ?>

<h5>Header Contact Block</h5>
<ul class="marked-list">

    <li>
        <dl class="inline-term">
            <dt>Show header contact block</dt>
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


<h5>Main Menu</h5>

<p>You can configure main navigation menu here.</p>

<ul class="marked-list">
    <li>
        <dl class="inline-term">
            <dt>Enable sticky menu </dt>
            <dd>
                Enable/disable fixed stick-to-top main menu
            </dd>
        </dl>
    </li>
<?php if ($project != 'latteccino' && $project != 'spatulas' && $project != 'firedup') { ?>
    <li>
        <dl class="inline-term">
            <dt>Enable title attributes</dt>
            <dd>
                Show / Hide search form in header top panel
            </dd>
        </dl>
    </li>
<?php } ?>
<?php if ($project == 'latteccino' or $project == 'spatulas' or $project == 'firedup') { ?>
    <li>
        <dl class="inline-term">
            <dt>Enable item description</dt>
            <dd>
                Enable/disable item description
            </dd>
        </dl>
    </li>
<?php } ?>
    <li>
        <dl class="inline-term">
            <dt>More menu button type</dt>
            <dd>
                Here you can select button type
            </dd>
        </dl>
    </li>

     <li>
        <dl class="inline-term">
            <dt>More menu button text</dt>
            <dd>
                Here you can type menu button text
            </dd>
        </dl>
    </li>
    </ul>
