

<?php if ($project == 'globera') { ?>

   <h3>Globera New Smart Box</h3>

<?php } ?>
<?php if ($project == 'neurion') { ?>

   <h3>Neurion New Smart Box</h3>

<?php } ?>
<?php if ($project == 'weeklyjournal' or $project == 'finestgame' or $project == 'gadnews') { ?>

   <h3> New Smart Box</h3>

<?php } ?>
<?php if ($project == 'waylard') { ?>

   <h3>Waylard New Smart Box</h3>

<?php } ?>
<?php if ($project == 'finestgame') { ?>

   <h3>New Smart Box</h3>

<?php } ?>
<?php if ($project == 'pokemania') { ?>

   <h3>New Smart Box</h3>

<?php } ?>
	<p>This widget is used to setup and display smart box.</p>

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
                 Here you can select the layout pattern for the page with a custom smart box layout
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
                Exact category to use for new items display
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
    <li>
        <dl class="inline-term">
            <dt>Title words trimmed count</dt>
            <dd>
                This property defines the words limit in the title
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Content words trimmed count</dt>
            <dd>
                This property defines the content words limit by choosing the number of words from post's content
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Display date</dt>
            <dd>
                Here you can define whether to display the post's date 
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Display author</dt>
            <dd>
                Here you can define whether to display the author's name or not
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
<?php if ($project == 'neurion' or $project == 'waylard') { ?>

     <li>
        <dl class="inline-term">
            <dt>Display navigation</dt>
            <dd>
                Show/hide navigation
            </dd>
        </dl>
    </li>

<?php } ?>
</ul>