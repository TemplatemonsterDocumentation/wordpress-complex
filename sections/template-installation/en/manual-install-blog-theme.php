<h3>Manual Installation</h3>

    <p>Now you can proceed to theme installation: <strong>theme_name.zip</strong>.Follow the steps listed below:</p>

    <p>Extract the template package</p>

    <figure class="img-polaroid">
        <img src="img/blog-theme/installation/add-theme-dashboard.png" alt="" >
    </figure>
<?php if ($project == 'bellaina' or $project == 'contractor') { ?>
    <h4>Note: You should install the theme on a clean WordPress, and there should be no users except for Admin. </h4>
<?php } ?>
    <p>Navigate to the <strong>Appearance > Themes</strong> section at the admin panel of the site and open  the  <strong>"theme"</strong> folder</p>
    <p>Locate the archive named as theme-name.zip and install the theme by pressing "Install Now".</p>

    <figure class="img-polaroid">
        <img src="img/blog-theme/installation/add-theme-select.png" alt="" >
    </figure>

    <p>Next please press on <strong>'Activate'</strong> link.</p>

    <figure class="img-polaroid">
        <img src="img/blog-theme/installation/add-theme-success.png" alt="" >
    </figure>

<?php if ($project != 'woostroid') { ?>
    <h4>Plugin Installation</h4>

    <p>After you install and activate the theme, you may need to install some additional plugins:</p>

    <p>
        Then press on "Begin installing plugins" at the top of the website to start  installation of the recommended plugins.
    </p>

<?php if ($project != 'cosmetro_tf' && $project != 'neurion_tf' && $project != 'sketchfield_tf') { ?>
    <figure class="img-polaroid">
        <img src="img/blog-theme/installation/themes-panel.png" alt="" >
    </figure>
<?php } ?>

<?php if ($project == 'cosmetro_tf' or $project == 'neurion_tf' or $project == 'sketchfield_tf') { ?>
<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/tmpl-installation/themes-panel.png">
</figure>
<?php } ?>
    <p>
        Select all the plugins, choose 'install' mode and confirm the action by pressing "Apply"
    </p>

    <figure class="img-polaroid">
        <img src="img/blog-theme/installation/required-plugins.png" alt="" >
    </figure>

    <p>
        Then you'll be redirected to the plugins activation page. Select "Return to the Dashboard" when it is completed.
    </p>
<?php if ($project == 'bellaina' or $project == 'homepro' or $project == 'gutenberg' or $project == 'addison' or  $project == 'ecolife' or  $project == 'duval' or  $project == 'builderry' or  $project == 'legacy' or $project == 'neuton' or  $project == 'focussity' or $project == 'focussity' or $project == 'contractor') { ?>
<h4>Automatic Installation Using Cherry Installer </h4>
<p>
    The theme comes with a pre installed Cherry Data Importer plugin that will help you upload the information quickly and easily.
    <a href="https://documentation.templatemonster.com/index.php?project=bellaina&lang=en&section=plugins#cherry-data-importer">Check a step by step guide here </a>
</p>
<?php } ?>


<?php if ($project != 'bellaina' && $project != 'homepro' && $project != 'gutenberg' && $project != 'addison' &&  $project != 'ecolife' &&  $project != 'duval' &&  $project != 'builderry' &&  $project != 'legacy' &&  $project != 'neuton' &&  $project != 'focussity' &&  $project != 'focussity' &&  $project != 'contractor') { ?>
    <h4>In order to install theme sample data</h4>

    <p>Navigate to <strong>Tools > Import</strong></p>

    <figure class="img-polaroid">
        <img src="img/blog-theme/installation/wordpress-importer-tools.png" alt="" >
    </figure>

    <p>Choose <strong>"WordPress"</strong> and click on Install importer, then you'll see the confirmation pop-up to run the install. Press on 'Install Now' there.</p>

    <figure class="img-polaroid">
        <img src="img/blog-theme/installation/blog-content-import.png" alt="" >
    </figure>

    <figure class="img-polaroid">
        <img src="img/blog-theme/installation/wordpress-importer.png" alt="" >
    </figure>

    <p>Then click on the <strong> "Activate Plugin & Run Importer"</strong> after the successful installation.</p>

    <figure class="img-polaroid">
        <img src="img/blog-theme/installation/wordpress-importer-success.png" alt="" >
    </figure>

    <p>Press on the "Browse" button and select the <strong>XML content</strong> file in the theme sample_data folder.</p>

    <figure class="img-polaroid">
        <img src="img/blog-theme/installation/wordpress-importer-select.png" alt="" >
    </figure>

    <p>Next press Upload File and import</p>

    <p>
        After that, choose an author for manual import (or create a new user with login name) or select the one from the list of available authors (recommended option) (or assign post to an existing user:)
    </p>
    <p>
        Check the  "Download and import file attachments" checkbox. </br> Navigate to the Dashboard when it is completed.
    </p>

    <figure class="img-polaroid">
        <img src="img/blog-theme/installation/wordpress-importer-setting.png" alt="" >
    </figure>

    <div class="alert alert-info">
        "WordPress Importer" plugin can also be downloaded <a href="https://wordpress.org/plugins/wordpress-importer/" target="_blank">here</a>
    </div>



    <h4>In order to import widget settings</h4>

    <p>
        Navigate to <strong>Plugins > Add new > Search Plugin</strong> and type <strong> "Widget Importer & Exporter"</strong>
        Press on Install Now, and activate plugin by clicking on "Activate Plugin" after its successful installation.
    </p>
    <figure class="img-polaroid">
        <img src="img/blog-theme/installation/widgets-importer-exporter.png" alt="" >
    </figure>

    <p>
        Next please navigate to the <strong>Tools > Widgets Importer & Exporter </strong> section, press on 'Browse' and select <strong>WIE widgets</strong> file in the sample_data folder, then click on 'Import Widgets'.
    </p>

    <figure class="img-polaroid">
        <img src="img/blog-theme/installation/widgets-importer-exporter-dashboard.png" alt="" >
    </figure>

    <figure class="img-polaroid">
        <img src="img/blog-theme/installation/widgets-importer-exporter-select.png" alt="" >
    </figure>


    <p>After the successful installation, all widgets settings will be applied.</p>
<?php } ?>

    <div class="alert alert-info">
    If there are problems with installing the theme via the admin panel, here's an alternative way to do it.
    </div>

<?php } ?>







