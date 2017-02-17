<h3>Page layout</h3>
<?php if ($project != 'bettaso' && $project != 'advisto' && $project != 'mechanna' && $project != 'ironmass' && $project != 'fiona' && $project != 'cleaningpro' && $project != 'madeleine' && $project != 'artwork' && $project != 'sensei' && $project != 'italica' && $project != 'techlab') { ?>
<p>Here you can select the layout pattern for the main website container.</p>
<?php } ?>

<?php if ($project == 'bettaso' or $project == 'advisto' or $project == 'mechanna' or $project == 'ironmass'  or $project == 'fiona' or $project == 'cleaningpro' or $project == 'confucius' or $project == 'plumberpro' or $project == 'madeleine' or $project == 'artwork' or $project == 'sensei')  { ?>
<p>Here you can select the layout pattern for the header, content and footer containers.</p>
<?php } ?>
<!--
<figure class="img-polaroid">
    <img src="img/tm/customizer/.png" alt="" >
</figure>
-->
<?php if ($project != 'addison') { ?>

<?php if ($project != 'roadway' && $project != 'tradex' && $project != 'italica' && $project != 'gutenberg' && $project != 'transit' && $project != 'jericho' && $project != 'monstroid_2' && $project != 'stylefactory' && $project != 'expenditorious' && $project != 'uptime99' && $project != 'helpinghand') { ?>
<h5>Layout type</h5>
<?php } ?>

<?php if ($project == 'roadway' or $project == 'tradex' or $project == 'italica' or $project == 'gutenberg' or $project == 'transit' or $project == 'jericho' or $project == 'monstroid_2' or $project == 'stylefactory' or $project == 'prima' or $project == 'room4pics' or $project == 'rufusvr' or $project == 'bayden' or $project == 'petstore' or $project == 'expenditorious' or $project == 'trudeau' or $project == 'niceinn' or $project == 'uptime99' or $project == 'helpinghand') { ?>
<h5>Header type</h5>
<?php } ?>

<ul class="marked-list">
    <li>
        <dl class="inline-term">
            <dt>Boxed</dt>
            <dd>
            	Boxed layout will have fixed width and left/right indents
            </dd>
        </dl>
    </li>

    <li>
        <dl class="inline-term">
            <dt>Full Width</dt>
            <dd>
            	Wide layout will fit window width
            </dd>
        </dl>
    </li>

</ul>

    <?php if ($project != 'mohican' && $project != 'knox' && $project != 'gaze' && $project != 'techlab' && $project != 'organica' && $project != 'infobyte' && $project != 'walden' && $project != 'chefplaza' && $project != 'hardwire' && $project != 'thedailypost' && $project != 'streamline' && $project != 'cityherald' && $project != 'viralnews') { ?>
        <h5>Content type</h5>

        <ul class="marked-list">
            <li>
                <dl class="inline-term">
                    <dt>Boxed</dt>
                    <dd>
                        Boxed layout will have fixed width and left/right indents
                    </dd>
                </dl>
            </li>

            <li>
                <dl class="inline-term">
                    <dt>Full Width</dt>
                    <dd>
                        Wide layout will fit window width
                    </dd>
                </dl>
            </li>

        </ul>
      
        <h5>Footer type</h5>

        <ul class="marked-list">
            <li>
                <dl class="inline-term">
                    <dt>Boxed</dt>
                    <dd>
                        Boxed layout will have fixed width and left/right indents
                    </dd>
                </dl>
            </li>

            <li>
                <dl class="inline-term">
                    <dt>Full Width</dt>
                    <dd>
                        Wide layout will fit window width
                    </dd>
                </dl>
            </li>

        </ul>
    <?php } ?>
<?php } ?>


<?php if ($project != 'chefplaza' && $project != 'stylefactory' && $project != 'hardwire' && $project != 'thedailypost' && $project != 'streamline' && $project != 'cityherald' && $project != 'prima' && $project != 'viralnews' && $project != 'room4pics' && $project != 'rufusvr' && $project != 'bayden' && $project != 'petstore' && $project != 'expenditorious' && $project != 'trudeau' && $project != 'niceinn' && $project != 'uptime99' && $project != 'helpinghand') { ?>
<h5>Container Background Color (px)</h5>

<p>Here you can select the background color. </p>
<?php } ?>


<?php if ($project != 'monstroid_2') { ?>
<h5>Container width (px)</h5>

<p>The width of main website container in pixels. </p>
<?php } ?>

<h5>Sidebar width</h5>

<p>The width ratio of the sidebar and main template container, can take two values: 1/3 or 1/4 </p>
