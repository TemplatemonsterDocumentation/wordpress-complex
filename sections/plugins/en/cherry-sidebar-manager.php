<h3>Cherry Sidebar Manager</h3>

<p>
	Cherry Sidebar Manager is designed to create custom sidebars with specific sets of widgets and define custom sidebars on pages.
</p>

<p>To add a new sidebar, go to the <strong>Appearance > Widgets</strong> section and click <strong>Create a new sidebar</strong>. </p>

<figure class="img-polaroid">
    <img src="img/plugins/sidebar_manager_start.png" alt="" style="opacity: 1;">
</figure>

<figure class="img-polaroid">
    <img src="img/plugins/sidebar_manager_new.png" alt="" style="opacity: 1;">
</figure>

<p>
	Input <strong>Sidebar name</strong> and <strong>Sidebar description</strong>. Then click <strong>Creating Sidebars</strong>
</p>

<figure class="img-polaroid">
    <img src="projects/<?php echo $project;?>/img/plugins/sidebar-manager-add.png">
</figure>
<figure class="img-polaroid">
    <img src="img/plugins/sidebar_manager_new_sidebar.png" alt="" style="opacity: 1;">
</figure>

<p>
	You can arrange your widgets set in your sidebar by adding new ones, changing the order of widgets and removing the unused ones.
</p>

<h5>Avaliable Post sidebar areas</h5>

<figure class="img-polaroid">
	<img src="projects/<?php echo $project;?>/img/plugins/sidebar-manager-page.png">
</figure>
<?php if ($project == 'wildride') { ?>
     <ul>
		<li>Sidebar Primary</li>
		<li>Sidebar Secondary</li>
		<li>Footer widget area</li>
		<li>Give Single Form Sidebar</li>
	</ul>

<?php } ?>

<?php if ($project == 'kingnews' or $project == 'gadnews' or $project == 'fitnesys' or $project == 'stylepark' or $project == 'kustrix' or $project == 'globera' or $project == 'editorso' or $project == 'vegetexia' or $project == 'triptastic' or $project == 'wilson' or $project == 'bitnews' or $project == 'jewello' or $project == 'sketchfield' or $project == 'clubstome' or $project == 'neurion') { ?>
     <ul>
		<li>Sidebar Primary</li>
		<li>Sidebar Secondary</li>
		<li>Footer widget area</li>
	</ul>
<?php } ?>


<?php if ($project == 'fairystyle' or $project == 'coffeera') { ?>
     <ul>
		<li>Sidebar Blog</li>
		<li>Sidebar Shop</li>
		<li>Sidebar About</li>
		<li>Footer widget area</li>
	</ul>
<?php } ?>

<?php if ($project == 'dailysports' or $project == 'finestgame') { ?>
     <ul>
		<li>Sidebar Primary</li>
		<li>Footer widget area</li>
	</ul>
<?php } ?>

<?php if ($project == 'weeklyjournal') { ?>
     <ul>
		<li>Sidebar Primary</li>
		<li>Sidebar Secondary</li>
		<li>Footer widget area</li>
		<li>Footer widget area centered</li>
	</ul>

<?php } ?>
<?php if ($project == 'travelop') { ?>
     <ul>
		<li>Sidebar Primary</li>
		<li>Sidebar Secondary</li>
	</ul>

<?php } ?>

<?php if ($project == 'cosmetro') { ?>
     <ul>
		<li>Sidebar Blog</li>
		<li>Sidebar Shop</li>
		<li>Footer widget area</li>
	</ul>
<?php } ?>


