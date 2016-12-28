<?php if ($project != 'monstroid_2') { ?>
<h3>Blog Settings</h3>
<p>You can set your blog settings here</p>

<!--
<figure class="img-polaroid">
    <img src="img/tm/customizer/.png" alt="" >
</figure>
-->

<ul class="marked-list">
<?php if ($project == 'bitnews') { ?>
    <li>
        <dl class="inline-term">
            <dt>Title</dt>
            <dd>
                Specify the title of the widget
            </dd>
        </dl>
           
    </li>
<?php } ?>
    <li>
        <dl class="inline-term">
            <dt>Layout</dt>
            <dd>
                Select the grid layout pattern for pages with custom blog layout
            </dd>
        </dl>
           
    </li>
<?php if ($project == 'weeklyjournal') { ?>
    <div class="alert alert-info">
        NOTE: If 2 sidebars are enabled, only one column layout will be available
    </div>
    
<?php } ?>
    <li>
        <dl class="inline-term">
            <dt>Featured Post Label</dt>
            <dd>
            	This setting specifies the featured Post Label
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Post content</dt>
            <dd>
                Select how you want to display the post content in blog listing
                    <?php if ($project == 'bitnews') { ?>
                        . You can also hide the content with the help of  "Don't Show" option
                    <?php } ?>
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Featured Image</dt>
            <dd>
                Set dimensions for post featured images
            </dd>
        </dl>
    </li>
<?php if ($project == 'bitnews') { ?>
    <li>
        <dl class="inline-term">
            <dt> Show Read More button </dt>
            <dd>
                Show/hide Read More button
            </dd>
        </dl>
           
    </li>
<?php } ?>    
    <li>
        <dl class="inline-term">
            <dt>Read More button text</dt>
            <dd>
                This setting specifies the "Read More" button label text
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Show post author</dt>
            <dd>
                Show / Hide post author
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Show publish date</dt>
            <dd>
                Show / Hide publish date
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Show categories</dt>
            <dd>
                Show / Hide categories
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Show tags</dt>
            <dd>
                Show / Hide tags
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Show comments</dt>
            <dd>
                Show / Hide tags
            </dd>
        </dl>
    </li>
    <?php if ($project == 'editorso') { ?>

    <li>
        <dl class="inline-term">
            <dt>Show blog title   </dt>
            <dd>
                Show/hide blog title
             </dd>
        </dl>
    </li>

    <li>
        <dl class="inline-term">
            <dt>Blog title text   </dt>
            <dd>
                Specify the title of your blog
             </dd>
        </dl>
    </li>
<?php } ?>
</ul>

<?php } ?>