<h3>Upload via FTP</h3>

<p>To use this method, you need to have access to your WordPress site files on FTP through the File  Manager of your hosting control panel or an FTP client like Filezilla,  CuteFTP, Total Commander, etc.</p>


<ol class="index-list">
    <li>Unzip the <strong>theme-name.zip</strong> files to any folder on your hard drive (first, right-click each of the .zip files, select Unzip  to… <strong>theme-name</strong> respectively, so you get the one folder called theme-name).
    </li>
    <li>Upload the <strong>theme-name</strong> folder to the <strong>/wp-content/themes/</strong> directory on your FTP server.</li>
    <li>Log in to your WordPress admin panel (add /wp-admin after your domain name in the browser address bar).</li>
    <li>Go to the menu <strong>Appearance</strong> > <strong>Themes</strong>.</li>
    <li>Under the <strong>Available Themes</strong> section find <strong>theme-name</strong> and activate it by clicking the <strong>Activate</strong> button.</li>
</ol>


<h4>Manual Sample Data Installation</h4>


<h5>For installing the sample data manualy please follow the instructions listed below.</h5>

<p>1. Open the <strong>theme\manual_install</strong> folder of your downloaded template package.</p>
<p>2. Upload the “uploads” folder to the wp-content directory of your WordPress installation, accept folder(s) replacement. Please note that your images may be replaced with sample images.</p>
<p>3. Open the <strong>theme-name.sql</strong> file that is located in the <strong>theme/manual_install/</strong> folder in any text editor (preferably Sublime Text or Notepad) and replace all instances of <strong>your_website_url_here</strong> with your website URL in the entire document using the <strong>Find and Replace</strong> tool (hit Ctrl+H hot keys to open this window). E.g.: http://www.mywebsite.com. Please, make sure that you do not have the forward slash "/" sign at the end of the address and the url starts with http://www. Save your changes and close the file.
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

<p>5.Open your WordPress database using a database management tool. Usually, the database tool is called PhpMyadmin.</p>

<p>6. Go to the Import tab and import the .sql file.</p>


<figure class="img-polaroid">
    <img src="img/blog-theme/installation/importing-data-base-panel.png" alt="">
</figure>

<p>7. Go to Settings->Permalinks.</p>

<p>8. Click the Save Changes button.</p>

<p>9. Refresh your home page. That's it, the template has been installed with demo sample content.</p>
