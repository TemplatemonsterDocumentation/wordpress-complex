	<h3>News Smart Box</h3>

	<p>This widget is used to setup and display the news box.</p>

    <figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/widgets/news-smart-box.png">
    </figure>

	<ul class="marked-list">
    <li>
        <dl class="inline-term">
            <dt> Title</dt>
            <dd>
				This property specifies the widget title
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Choose layout type</dt>
            <dd>
                Specify the layout type to display the items
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Choose taxonomy type</dt>
            <dd>
                Here you can define the items selection source: by Category or Tag
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Select category</dt>
            <dd>
                Select category to use for news items display
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Select secondary categories</dt>
            <dd>
                Select secondary categories to display items from
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Posts count</dt>
            <dd>
                Here you can define the number of posts to display
            </dd>
        </dl>
    </li>

<?php if ($project != 'monstroid_2') { ?>
    <li>
        <dl class="inline-term">
            <dt>Title words trimmed count</dt>
            <dd>
                This property defines the words limit in the title area
            </dd>
        </dl>
    </li>
<?php } ?>

<?php if ($project == 'monstroid_2') { ?>
    <li>
        <dl class="inline-term">
            <dt>Title chars trimmed count</dt>
            <dd>
                This property defines the chars limit in the title area
            </dd>
        </dl>
    </li>
<?php } ?>

    <li>
        <dl class="inline-term">
            <dt>Content words trimmed count</dt>
            <dd>
                This property defines the content words limit
            </dd>
        </dl>
    </li>

<?php if ($project == 'monstroid_2') { ?>
    <li>
        <dl class="inline-term">
            <dt>Display current navigation title</dt>
            <dd>
                Here you can define whether to display the current navigation title or not
            </dd>
        </dl>
    </li>
<?php } ?>

    <li>
        <dl class="inline-term">
            <dt>Display date</dt>
            <dd>
                Here you can define whether to display the post date or not
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Display author</dt>
            <dd>
               Show/hide author name  
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Display comments</dt>
            <dd>
                Here you can define whether to display comments or not
            </dd>
        </dl>
    </li>

<?php if ($project == 'monstroid_2') { ?>
    <li>
        <dl class="inline-term">
            <dt>Display more button</dt>
            <dd>
                Here you can define whether to display more button or not
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>More button text</dt>
            <dd>
                Here you can set more button text
            </dd>
        </dl>
    </li>
<?php } ?>
</ul>