<?php if ($project == 'monstroid_2' or $project == 'woostroid') { ?>
<h3>Manual Update</h3>

<p>Manually replacing your current version of Woostroid with an updated version is as easy as 1-2-6! First off, you’ll need to download the updated version of the theme, which includes both the main theme and the child theme (which serves as a backup for all the custom changes you make to your styles etc).
</p>

<h5>Next on, installing it, the child theme and export-import steps are due.</h5>

<ul class="marked-list">
    <li>
        Afterwards you’ll need to backup some of the settings, just in case:

        <ul class="marked-list">
            <p>
                1.1 Backup the Customizer’s options. To do that go to your Woostroid admin dashboard → then on your left go to the “Customizing” section → Export/Import → Export ‘em.
            </p>
            <p>
                1.2 Save the "wp-content/themes/woostroid" folder (duplicate it), just so it stays somewhere on your web server, let’s say in a folder named “main woostroid backup”

            </p>
        <figure class="img-polaroid">
                <img src="img/man-update-1.png" alt=""/>
        </figure>
    </li>
</ul>


     <li>
        Afterwards proceed to the "Appearance → Themes", switch to any other default Wordpress theme as your current one, and be sure to delete the Woostroid theme from that list.
    </li>

    <li>
        Returning now to the ZIP file of the updated version of the theme that you’ve downloaded previously, be sure to follow the following steps:

        <ul class="marked-list">
            <p>
                3.1 Open the WordPress admin panel and go to the "Appearance → Themes" section.
            </p>
            <p>
                3.2 Click the "Add new" button and click "Upload theme."
            </p>
             <p>
                3.3 After that, repeat the same steps for the Child theme, which you’ve previously unpacked from that same file as the main theme.
            </p>
        </ul>
    </li>

    <li>
        After installing this updated Woostroid theme anew, proceed to update the Plugins, by going to the sidebar on your left → Updates.
    <p>
        Then  tick all the checkboxes for the listed plugins and click the “Update All” button at the top.
    </p>

        <figure class="img-polaroid">
                <img src="img/man-update-2.png" alt=""/>
        </figure>
    </li>

    <li>
        Now you’ll need to import back those settings which you’ve exported in a previous step.
        <ul class="marked-list">
            <p>
                 5.1 To do that go to your Woostroid admin dashboard ->> then on your left go to the “Customizing” section → Export/Import → and choose the “Import” option.

            </p>
            <p>
                5.2 Click the "Add new" button and click "Upload theme."
            </p>
        <figure class="img-polaroid">
                <img src="img/man-update-4.png" alt=""/>
        </figure>
        </ul>
    </li>
    <li>
         Following that, to save your custom styles, locate the “main woostroid backup” folder on your web server (1.2 in the list of steps) → Styles.CSS file → and copy those parts of the code that you’ve changed there into the Styles.CSS file that’s located in the new folder of an updated Monstroid version.
    </li>






<?php } ?>
</ol>



