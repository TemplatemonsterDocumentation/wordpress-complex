<h3>Installation</h3>

<p>Now you can proceed to installing  the theme: <strong>theme####.zip</strong>.Here are the steps:</p>

<ol class="index-list">
    <li>
        Go to the menu <strong>Appearance</strong> &gt; <strong>Themes</strong> and click the <strong>Add New Theme </strong>button
    </li>
    <li>
        Click the <strong>Upload</strong> link.
    </li>
    <li>
        Click the <strong>Browse</strong> button and navigate to the unzipped template package on your computer.
    </li>
    <li>
        Look for a file called <strong>theme####.zip </strong>(where <strong>XXXX</strong> is the unique number of your theme). Click on it to select, then click <strong>OK</strong>.
    </li>
    <li>
        Click the <strong>Install Now</strong> button and wait until the installation is complete.
    </li>
    <li>
        Click the <strong>Activate</strong> link to change the current layout of the site to the theme your purchased.
    </li>
</ol>

<p>Congratulations, the theme have been successfully installed!</p>

<p>For installing the sample data, please follow the instructions below.</p>

<div class="alert alert-warning">
    ATTENTION: Importing the SQL file to your database will overwrite your existing content and website settings. DO NOT import the SQL file if you want to keep the existing content.
</div>

<div class="alert alert-info">
    NOTE: Always back up your database before performing any modifications.
</div>

<div class="alert alert-info">
    Please note that the prefix of WordPress database tables should be <strong>wp_</strong>.
</div>

<figure class="img-polaroid">
    <img src="img/wordpress/wp_prefix.jpg" alt="">
</figure>

<p>To make your WordPress look like our live demo, please follow the instructions below.</p>

<ol class="index-list">
    <li>Copy the"<strong>uploads</strong>" folder (that is located under the<strong> theme/manual_install/</strong> folder of your template package) to the<strong> /wp-content/ </strong> folder on your FTP.</li>
    <li>Open the <strong>theme####.sql</strong> file that is located in the <strong>theme/manual_install/</strong> folder in any text editor (preferably Sublime Text or Notepad) and replace all instances of "<strong>your_website_url_here</strong>" with your website URL in the entire document using the <strong>Find and Replace</strong> tool (hit Ctrl+H hot keys to open this window). E.g.: http://www.mywebsite.com</li>
    <li>Please, make sure that you do not have the forward slash "/" sign at the end of the address and the url starts with http://www.</li>
    <li>Save your changes and close the file.</li>
    <li>Now  you can import the dump file with the <strong>phpMyAdmin</strong> tool or some other database management tool.</li>
</ol>


<div class="alert alert-info">
    If there are problems with installing them via the admin panel, here's the alternative way to do it.
</div>

<h4>Upload via FTP</h4>

<p>To use this method, you need to have access to your WordPress site files on FTP through the File  Manager of your hosting control panel or an FTP client like Filezilla,  CuteFTP, Total Commander, etc.</p>


<ol class="index-list">
    <li>Unzip the <strong>theme####.zip</strong> files to any folder on your hard drive (first, right-click each of the .zip files, select Unzip  to… <strong>theme####</strong> accordingly, so you get the one folder called theme####).
    </li>
    <li>Upload the <strong>theme####</strong> folder to the <strong>/wp-content/themes/</strong> directory on your FTP server.</li>
    <li>Log in to your WordPress admin panel (add /wp-admin after your domain name in the browser address bar).</li>
    <li>Go to the menu <strong>Appearance</strong> > <strong>Themes</strong>.</li>
    <li>Under the <strong>Available Themes</strong> section find <strong>theme####</strong> and activate it by clicking the <strong>Activate</strong> button.</li>
</ol>


<h4>Plugin Installation</h4>

<p>After you install and activate the theme, you may need to install the additional plugins:</p>

<ol class="index-list">
    <li>When the theme is activated, on the top left corner you will find the notice to install additional plugins. Follow the <strong> Begin installing plugin </strong> link.
    <br>You can also install the plugins from the Dashboard, navigate to <strong>Appearance- &gt;  Install Plugins</strong>.</li>
    <li>Check the required plugins.</li>
    <li>In the Bulk Actions drop-down menu select <strong>Install</strong> and click <strong>Apply</strong>.</li>
</ol>

