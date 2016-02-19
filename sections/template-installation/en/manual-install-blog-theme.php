<h3>Installation</h3>

    <p>Now you can proceed to installing the theme: <strong>theme_name.zip</strong>.Here are the steps:</p>

    <p>Extract template package</p>

    <figure class="img-polaroid">
        <img src="img/blog-theme/installation/add-theme-dashboard.png" alt="" >
    </figure>

    <p>Navigate to the <strong>Appearance > Themes</strong> section at site admin panel and open <strong>'theme'</strong> folder</p>
    <p>Locate the archive named as theme-name.zip and install the theme by pressing 'Install Now'.</p>

    <figure class="img-polaroid">
        <img src="img/blog-theme/installation/add-theme-select.png" alt="" >
    </figure>

    <p>Next please press on <strong>'Activate'</strong> link.</p>

    <figure class="img-polaroid">
        <img src="img/blog-theme/installation/add-theme-success.png" alt="" >
    </figure>

    <h4>Plugin Installation</h4>

    <p>After you install and activate the theme, you may need to install the additional plugins:</p>

    <p>
        Then press on 'Begin installing plugins' at the top of the website to start the recommended plugins installation.
    </p>

    <figure class="img-polaroid">
        <img src="img/blog-theme/installation/themes-panel.png" alt="" >
    </figure>

    <p>
        Select all the plugins, choose 'install' mode and confirm the action by pressing 'Apply'
    </p>

    <figure class="img-polaroid">
        <img src="img/blog-theme/installation/required-plugins.png" alt="" >
    </figure>

    <p>
        Then you'll be redirected to the plugins activation page. Select 'Return to the Dashboard' when it is completed.
    </p>

    <h4>In order to install theme sample data</h4>

    <p>Navigate to <strong>Tools > Import</strong></p>

    <figure class="img-polaroid">
        <img src="img/blog-theme/installation/wordpress-importer-tools.png" alt="" >
    </figure>

    <p>Choose <strong>'WordPress'</strong> and click on Install importer, then you'll see the confirmation pop-up to run the install. Press on 'Install Now' there.</p>

    <figure class="img-polaroid">
        <img src="img/blog-theme/installation/blog-content-import.png" alt="" >
    </figure>

    <figure class="img-polaroid">
        <img src="img/blog-theme/installation/wordpress-importer.png" alt="" >
    </figure>

    <p>Then click on the <strong>'Activate Plugin & Run Importer'</strong> after the successful installation.</p>

    <figure class="img-polaroid">
        <img src="img/blog-theme/installation/wordpress-importer-success.png" alt="" >
    </figure>

    <p>Press on Browse button and select <strong>XML content</strong> file in the theme sample_data folder.</p>

    <figure class="img-polaroid">
        <img src="img/blog-theme/installation/wordpress-importer-select.png" alt="" >
    </figure>

    <p>Next press on Upload File and import</p>

    <p>
        After doing this choose an author for manual import (or create a new user with login name) or select the one from the list of available authors (recommended option) (or assign post to an existing user:)
    </p>
    <p>
        Check the checkbox 'Download and import file attachments'</br> Navigate to the Dashboard when it is completed.
    </p>

    <figure class="img-polaroid">
        <img src="img/blog-theme/installation/wordpress-importer-setting.png" alt="" >
    </figure>


    <h4>In order to import widget settings</h4>

    <p>
        Navigate to <strong>Plugins > Add new > Search Plugin</strong> and type <strong>'Widget Importer & Exporter'</strong>
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


    <p>After the successful installation all of widgets settings will be applied.</p>

    <div class="alert alert-info">
    If there are problems with installing theme via the admin panel, here's the alternative way to do it.
    </div>

    <h4>Upload via FTP</h4>

<p>To use this method, you need to have access to your WordPress site files on FTP through the File  Manager of your hosting control panel or an FTP client like Filezilla,  CuteFTP, Total Commander, etc.</p>


<ol class="index-list">
    <li>Unzip the <strong>theme-name.zip</strong> files to any folder on your hard drive (first, right-click each of the .zip files, select Unzip  to… <strong>theme-name</strong> accordingly, so you get the one folder called theme-name).
    </li>
    <li>Upload the <strong>theme-name</strong> folder to the <strong>/wp-content/themes/</strong> directory on your FTP server.</li>
    <li>Log in to your WordPress admin panel (add /wp-admin after your domain name in the browser address bar).</li>
    <li>Go to the menu <strong>Appearance</strong> > <strong>Themes</strong>.</li>
    <li>Under the <strong>Available Themes</strong> section find <strong>theme-name</strong> and activate it by clicking the <strong>Activate</strong> button.</li>
</ol>


<h4>Installing the sample data manualy</h4>


<h5>For installing the sample data manualy please follow the instructions below.</h5>

<p>1. Open the <strong>theme\manual_install</strong> folder of your downloaded template package.</p>
<p>2. Upload the “uploads” folder to the wp-content directory of your WordPress installation, accept folder(s) replacement. Please note that your images may be replaced with sample images.</p>
<p>3. Open the <strong>theme-name.sql</strong> file that is located in the <strong>theme/manual_install/</strong> folder in any text editor (preferably Sublime Text or Notepad) and replace all instances of "<strong>your_website_url_here</strong>" with your website URL in the entire document using the <strong>Find and Replace</strong> tool (hit Ctrl+H hot keys to open this window). E.g.: http://www.mywebsite.com. Please, make sure that you do not have the forward slash "/" sign at the end of the address and the url starts with http://www. Save your changes and close the file.
</p>

<figure class="img-polaroid">
    <img src="img/blog-theme/installation/rename-dump-data-base.png" alt="">
</figure>

<p>4. Now  you can import the dump file with the <strong>phpMyAdmin</strong> tool or some other database management tool.</p>

<div class="alert alert-warning">
    ATTENTION: Importing the SQL file to your database will overwrite your existing content and website settings. DO NOT import the SQL file if you want to keep the existing content.
</div>

<div class="alert alert-info">
    NOTE: Always back up your database before performing any modifications.
</div>

<p>5.Open your WordPress database using a database management tool. Usually the database tool is called PhpMyadmin.</p>

<p>6. Go to the Import tab and import the .sql file.</p>


<figure class="img-polaroid">
    <img src="img/blog-theme/installation/importing-data-base-panel.png" alt="">
</figure>

<p>7. Go to Settings->Permalinks.</p>

<p>8. Click the Save Changes button.</p>

<p>9. Refresh your home page. The template has been installed with demo sample content.</p>





