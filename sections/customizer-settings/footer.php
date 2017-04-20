
<h3>Footer</h3>
<p>Settings for the website footer section.</p>

<!--
<figure class="img-polaroid">
    <img src="img/tm/customizer/.png" alt="" >
</figure>
-->


<ul class="marked-list">
<?php if ($project != 'smarthouse') { ?>
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
            <dt>Widget Area Columns</dt>
            <dd>
                Here you can set a number of columns for site widgets, 1 to 4
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Layout</dt>
            <dd>
                Here you can define the footer layout type
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Footer Widgets Area color</dt>
            <dd>
                Here you can define the Widget Area background color
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Footer Background color</dt>
            <dd>
                Here you can define the Footer Area background color
            </dd>
        </dl>
    </li>
    <?php if ($project == 'builderry') { ?>
    <li>
        <dl class="inline-term">
            <dt>Show footer logo</dt>
            <dd>
                Show/hide footer logo
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Show menu</dt>
            <dd>
                Show/hide menu
            </dd>
        </dl>
    </li>
<?php } ?>  
</ul>
