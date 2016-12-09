
<h3>Sidebar</h3>
<p>Here you can configure the position of template sidebars.</p>

<!--
<figure class="img-polaroid">
    <img src="img/tm/customizer/.png" alt="" >
</figure>
-->

<h5>Sidebar position</h5>

<ul class="marked-list">
    <li>
        <dl class="inline-term">
            <dt>No sidebars</dt>
            <dd>
                No sidebar will be displayed
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Sidebar on left side</dt>
            <dd>
                Sidebar will be displayed on the left side
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Sidebar on right side</dt>
            <dd>
                Sidebar will be displayed on the right side
            </dd>
        </dl>
    </li>
<?php if ($project == 'mechanna' or $project == 'advisto' or $project == 'fenimore' or $project == 'nolan' or $project == 'teddy' or $project == 'builderry' or $project == 'neuton' or $project == 'proedge' or $project == 'chromix' or  $project == 'lawpress' or $project == 'timberline' or $project == 'pettown' or $project == 'limittax' or $project == 'greenville' or $project == 'tradex' or $project == 'italica' ) { ?>
    <li>
        <dl class="inline-term">
            <dt>2 Sidebars</dt>
            <dd>
                Two sidebars will be displayed
            </dd>
        </dl>
    </li>
<?php } ?>

   
</ul>
<?php if ($project == 'bitnews') { ?>
    <ul class="marked-list">
        <li>
            <dl class="inline-term">
                <dt>Show primary or secondary sidebars at homepage/frontpage </dt>
                <dd>
                    Hide/Show sidebars on the homepage
                </dd>
            </dl>
        </li>
    </ul>
<?php } ?>