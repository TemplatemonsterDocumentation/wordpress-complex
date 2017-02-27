
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
</ul>
<?php if ($project == 'clubstome' or $project == 'ecolife' ) { ?>
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

<?php if ($project == 'uptime99' or $project == 'heavyhandlers' or $project == 'callista') { ?>
    <ul class="marked-list">
        <li>
            <dl class="inline-term">
                <dt>Two sidebars</dt>
                <dd>
                    Display two sidebars
                </dd>
            </dl>
        </li>
    </ul>
<?php } ?>
