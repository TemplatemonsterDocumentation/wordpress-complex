
    <h3>WordPress Installation</h3>

    <p>Download the required WordPress version. You can check which release is required on the template preview page in
       the requirements list. Make sure you download the correct version.</p>

    <p>
        You can download the WordPress platform on the official WordPress.org website:
        <a href="http://WordPress.org/download/" target="_blank">
            <strong>Download WordPress</strong>
        </a>
        . If you need another release, follow this link:
        <a href="http://WordPress.org/download/release-archive/" target="_blank">
            <strong>WordPress versions archive</strong></a>
        . Once the platform is downloaded, you'll need to unpack the files. You can use any file archiver that supports ZIP
        format to unpack the <strong>ZIP</strong> file.
    </p>

     <p>
        These tutorials will show you how to unpack the archived files, if you have
        <a target="_blank" href="https://zemez.io/wordpress/support/knowledge-base/archived-files-extraction-for-windows/">
            <strong>Windows OS (using WinZip)</strong>
        </a>

        and if you have

        <a target="_blank" href="https://zemez.io/wordpress/support/knowledge-base/template-extraction-on-mac-os/">
            <strong>MAC OS (using StuffitExpander)</strong>
        </a>
        .
    </p>

    <ul class="marked-list">
        <li><i class="icon-info-sign"></i>
            <a target="_blank" href="https://zemez.io/wordpress/support/knowledge-base/archived-files-extraction/">
                Archived Files Extraction
            </a>
        </li>
        <li><i class="icon-info-sign"></i>
            <a target="_blank" href="https://zemez.io/wordpress/support/knowledge-base/winzip-downloading-and-installation/">
                WinZip Downloading and Installation
            </a>
        </li>
        <li><i class="icon-info-sign"></i>
            <a target="_blank" href="https://zemez.io/wordpress/support/knowledge-base/archived-files-extraction-for-windows/">
                Archived Files Extraction for Windows
            </a>
        </li>
        <li><i class="icon-info-sign"></i>
            <a target="_blank" href="https://zemez.io/wordpress/support/knowledge-base/template-extraction-on-mac-os/">
                Template Extraction on MAC OS
            </a>
        </li>
    </ul>

    <p>
        Once the WordPress platform files and folders are unpacked, you need to upload them to the hosting server.
    </p>

    <p>
        Upload the files and folders to the server into the <strong>PUBLIC_HTML</strong> or <strong>WWW</strong> directory.
    </p>

    <div class="alert alert-info">
        If you can't find the PUBLIC_HTML or WWW directory on your hosting server, contact your hosting provider and
        find out where you should upload the website files to.
    </div>

    <p>
        You can also take a look at these tutorials that give detailed information on how to upload the files to a
        hosting server:
    </p>

    <ul class="marked-list">
        <li>
            <a target="_blank" href="https://zemez.io/wordpress/support/knowledge-base/uploading-files-to-a-server-using-ftp/">
                Uploading Files to a Server Using FTP.
            </a>
        <li>
            <a target="_blank" href="https://zemez.io/wordpress/support/knowledge-base/uploading-files-to-a-server-with-cpanel/">
                Uploading Files to a Server with cPanel.
            </a>
        </li>
    </ul>

    <p>
        Next, you need to create a database for the WordPress platform.
    </p>

    <p>
        You can create it using the database management tool in the hosting cpanel (<em>usually it is PhpMyAdmin</em>).
        With the help of phpMyAdmin you can create a new database in 3 simple steps (check the slides below):
    </p>

    <ol class="index-list">
        <li>
            <p>Click the Database button at the top navigation menu to see the list of databases.</p>
            <figure class="img-polaroid">
                <img src="img/database-create-1.jpg" alt=""/>
            </figure>
        </li>
        <li>
            <p>Enter database name in the <strong>Create new database</strong> field.</p>
            <figure class="img-polaroid">
                <img src="img/database-create-2.jpg" alt=""/>
            </figure>
        </li>
        <li>
            <p>Click the <strong>Create</strong> button.</p>
            <figure class="img-polaroid">
                <img src="img/database-create-3.jpg" alt=""/>
            </figure>
        </li>
    </ol>

    <p>You will see the new database in the list now. Click on its name to access it.</p>

    <p class="alert alert-info">If you face any difficulties while creating the database, contact your hosting provider
                                for tech support.</p>

    <p>You can also check the following tutorials:</p>

    <ul class="marked-list">
        <li class="first"><i class="icon-info-sign"></i>
            <a target="_blank" href="https://zemez.io/wordpress/support/knowledge-base/creating-a-database/">Creating
                                                                                                  database
          .  </a>
        </li>
        <li class="last"><i class="icon-info-sign"></i>
            <a target="_blank" href="https://zemez.io/wordpress/support/knowledge-base/creating-mysql-database-with-godaddy/">
                Creating MySQL Database with GoDaddy.
            </a>
        </li>
    </ul>

    <p>
        Enter the WordPress directory path into the browser address bar and click Enter. WordPress installation will
        begin.
    </p>

    <h4>
        Creating the Configuration File
    </h4>

    <p>
        WordPress installation screen will inform you that
        the configuration file is missing. Click <strong>Create
        Configuration File</strong> to create it.
    </p>

    <figure class="img-polaroid"><img src="img/wordpress/wp-install-1-b.jpg" alt="Creating configuration file."></figure>


    <h4>
        Database Details
    </h4>

    <div class="alert alert-info">
	    Please note that the prefix of WordPress database tables should be <strong>wp_</strong>.
	</div>

    <p>
        You need to enter the WordPress database connection details here.
    </p>

    <figure class="img-polaroid"><img src="img/wordpress/wp-install-3-b.jpg" alt="Inserting database details."></figure>


    <h4>
        Website Details
    </h4>

    <p>
        You need to enter the next details:
    </p>

    <ol class="index-list">
        <li>website name</li>
        <li>administrator login and password</li>
        <li>website e-mail</li>
    </ol>

    <p>
        Click <strong>Install WordPress</strong>
    </p>

    <figure class="img-polaroid"><img src="img/wordpress/wp-install-6-b.jpg" alt="Inserting website details."></figure>

    <p>If you have entered the correct details, you will see a successful installation message and the
       WordPress dashboard access button.</p>

    <figure class="img-polaroid"><img src="img/wordpress/wp-install-7-b.jpg" alt="Install WordPress button."></figure>

    <p>You can also take a look at these video tutorials:</p>

    <ul class="marked-list">
        <li><i class="icon-info-sign"></i>
            <a href="https://zemez.io/wordpress/support/knowledge-base/manual-wordpress-installation-to-hostgator-server/"
               target="_blank">Manual WordPress Installation to HostGator Server
            </a>
        </li>
        <li><i class="icon-info-sign"></i>
            <a href="https://zemez.io/wordpress/support/knowledge-base/manual-wordpress-installation-bluehost/"
               target="_blank">Manual WordPress Installation to BlueHost Server
            </a>
        </li>
        <li><i class="icon-info-sign"></i>
            <a href="https://zemez.io/wordpress/support/knowledge-base/manual-wordpress-installation-to-siteground-server/"
               target="_blank">Manual WordPress Installation to SiteGround Server
            </a>
        </li>
        <li><i class="icon-info-sign"></i>
            <a href="https://zemez.io/wordpress/support/knowledge-base/manual-wordpress-installation-to-godaddy-server/"
               target="_blank"> Manual WordPress Installation to GoDaddy Server
            </a>
        </li>
        <li><i class="icon-info-sign"></i>
            <a href="https://zemez.io/wordpress/support/knowledge-base/manual-wordpress-installation-to-justhost-server/"
               target="_blank">Manual WordPress Installation to JustHost Server
            </a>
        </li>
    </ul>
