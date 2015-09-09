<h2>Introduction</h2>
<h5>Thank you for downloading Cherry Framework 4. This documentation consists of several parts and covers the entire process of installing and setting up Cherry Framework starting from scratch.</h5>
<article id="whatiswordpress">
    <h3>What is Cherry Framework</h3>

    <p>Cherry Framework 4 is an open source theme framework for WordPress. It has a rich variety of features and functional enhancements that allows to create WordPress websites and themes of any complexity. </p>
</article>

<article id="structure">
    <h3>Cherry Framework Structure</h3>
    <p>Cherry Framework is built as a WordPress theme. Let's check what's inside:</p>

    <ul class="files_structure">
                <li class="folder">
                    <dl class="inline-term">
                        <dt>
                            <i class="fa fa-folder"></i><strong>assets</strong>
                        </dt>
                        <dd>
                            CSS, SCSS and JS files.
                        </dd>
                    </dl>
                </li>
                <li class="folder">
                    <dl class="inline-term">
                        <dt>
                            <i class="fa fa-folder"></i><strong>content</strong>
                        </dt>
                        <dd>
                            page and post template files (.tmpl)
                        </dd>
                    </dl>
                </li>
                <li class="folder">
                    <dl class="inline-term">
                        <dt>
                            <i class="fa fa-folder"></i><strong>languages</strong>
                        </dt>
                        <dd>
                            localizations files.
                        </dd>
                    </dl>
                </li>
                <li class="folder">
                    <dl class="inline-term">
                        <dt>
                            <i class="fa fa-folder"></i><strong>lib</strong>
                        </dt>
                        <dd>
                            framework core.
                        </dd>
                    </dl>
                </li>
                <li class="folder">
                    <dl class="inline-term">
                        <dt>
                            <i class="fa fa-folder"></i><strong>menu</strong>
                        </dt>
                        <dd>
                            menu template files (primay, secondary).
                        </dd>
                    </dl>
                </li>
                <li class="folder">
                    <dl class="inline-term">
                        <dt>
                            <i class="fa fa-folder"></i><strong>templates</strong>
                        </dt>
                        <dd>
                            template files for static areas, system pages, header and footer wrappers etc.
                        </dd>
                    </dl>
                </li>
                <li class="folder">
                    <dl class="inline-term">
                        <dt>
                            <i class="fa fa-folder"></i><strong>woocommerce</strong>
                        </dt>
                        <dd>
                           Cherry Framework compatible WooCommerce file updates.
                        </dd>
                    </dl>
                </li>
                <li class="folder">
                    <dl class="inline-term">
                        <dt>
                            <i class="fa fa-file"></i><strong>404.php</strong>
                        </dt>
                        <dd>
                           404 error page template. Displayed if WordPress can not find the requested page.
                        </dd>
                    </dl>
                </li>
                <li class="folder">
                    <dl class="inline-term">
                        <dt>
                            <i class="fa fa-file"></i><strong>base.php</strong>
                        </dt>
                        <dd>
                           file specifies the basic structure of pages.
                        </dd>
                    </dl>
                </li>
                <li class="folder">
                    <dl class="inline-term">
                        <dt>
                            <i class="fa fa-file"></i><strong>cherry-options.php</strong>
                        </dt>
                        <dd>
                           default values for Cherry Framework options.
                        </dd>
                    </dl>
                </li>
                <li class="folder">
                    <dl class="inline-term">
                        <dt>
                            <i class="fa fa-file"></i><strong>footer.php</strong>
                        </dt>
                        <dd>
                           footer template file.
                        </dd>
                    </dl>
                </li>
                <li class="folder">
                    <dl class="inline-term">
                        <dt>
                            <i class="fa fa-file"></i><strong>functions.php</strong>
                        </dt>
                        <dd>
                           file contains additional functions that are required for Cherry Framework theme functioning. Also file contains somу WordPress core features enhancements, for example: thumbnails diemsions, path to loxalization files, widgets dimensions etc.
                        </dd>
                    </dl>
                </li>
                <li class="folder">
                    <dl class="inline-term">
                        <dt>
                            <i class="fa fa-file"></i><strong>index.php</strong>
                        </dt>
                        <dd>
                           main templates file. If your theme use custom template files this file is required.
                        </dd>
                    </dl>
                </li>
                <li class="folder">
                    <dl class="inline-term">
                        <dt>
                            <i class="fa fa-file"></i><strong>page.php</strong>
                        </dt>
                        <dd>
                           WordPress page template file.
                        </dd>
                    </dl>
                </li>
                <li class="folder">
                    <dl class="inline-term">
                        <dt>
                            <i class="fa fa-file"></i><strong>rtl.css</strong>
                        </dt>
                        <dd>
                           right-to-left styling.
                        </dd>
                    </dl>
                </li>
                <li class="folder">
                    <dl class="inline-term">
                        <dt>
                            <i class="fa fa-file"></i><strong>screenshot.png</strong>
                        </dt>
                        <dd>
                           theme screenshot.
                        </dd>
                    </dl>
                </li>
                <li class="folder">
                    <dl class="inline-term">
                        <dt>
                            <i class="fa fa-file"></i><strong>single.php</strong>
                        </dt>
                        <dd>
                           single post page template. Used to displayed requested post.
                        </dd>
                    </dl>
                </li>
                <li class="folder">
                    <dl class="inline-term">
                        <dt>
                            <i class="fa fa-file"></i><strong>style.css</strong>
                        </dt>
                        <dd>
                           main stylesheet file. It is required to be present in the theme. Should contain theme info in comment block.
                        </dd>
                    </dl>
                </li>
            </ul>
</article>
<article id="preparation">
    <h3>Preparation</h3>
    <h6>Before installing a Cherry Framework, you need to get fully prepared. We recommend that you get the following aspects covered:</h6>

    <h4>Software</h4>
    <p>Before you even start working with Cherry Framework, you should download the required software. You can check the required software on the template preview page.<br> 
    Requirements can alter from template to template, so we will list the most important ones:</p>
    <ol class="index-list">
    	<li>First of all, you will need the right software to extract files from the password protected sources_#########.zip archive. You can use WinZip 9 or a later version (if you have Windows OS) or Stuffit Expander 10 or a later version (if you have Mac OS).</li>
    	<li>You might also need Adobe Photoshop. It is used to edit the source .PSD files in case you need to change the graphic design and images of the template.</li>
    	<li>To edit the template source code, you can use code editors like Adobe Dreamweaver, Notepad++, Sublime Text, etc.</li>
    	<li>To upload files to a hosting server, you will need an FTP manager like Total Commander, FileZilla, CuteFTP, etc.</li>
    </ol>

    	<h4>Hosting</h4>
    	<p>As WordPress CMS is a PHP/MySQL platform, you need to have the hosting server prepared for it.</p>
    	<p>In case you already have a hosting server, you need to check whether it is compatibile with <a href="http://wordpress.org/about/requirements/" target="_blank"> WordPress hosting requirements </a>, in other words, whether you can host a WordPress website with it.</p>
    	
    	<p>Cherry Framework itself requires Apache or Nginx hosting servers with the following configuration settings:</p>
    	
    	<h5>Recommended Configuration</h5>

    	<ol class="index-list">
    		<li>In <strong>php.ini</strong> define the following:<br>
    			<ul class="marked-list">
    				<li>'max_execution_time' => 60;</li>
    				<li>'memory_limit' => 128;</li>
    				<li>'post_max_size' => 8;</li>
    				<li>'upload_max_filesize' => 8;</li>
    				<li>'max_input_time' => 45;</li>
    				<li>'file_uploads' => 'on';</li>
    				<li>'safe_mode' => 'off';</li>
    			</ul>
    		</li>
    		<li>in <strong>.htaccess</strong> file: 'php_value max_execution_time' => 60;</li>
    		<li>in <strong>wp-config.php</strong>: 'set_time_limit' => 60;</li>
    		<li>1 GB of disk space</li>
    		<li>memory limit per process: 64mb (128mb or more recommended)</li>
    	</ol>
    	

    	<h5>PHP and MySQL</h5>
    	
    	<p>Minimal required version of PHP is 5.2.4 and MySQL 5. PHP 5.2 is already not safe as contains critical vulnerabilities that can be used to harm your website. Some Cherry Framework extensions will not work with PHP 5.2 and require version 5.4 or later.</p>

    	<p>Recommended settings are: </p>

    	<ol class="index-list">
    		<li>PHP 5.4</li>
    		<li>MySQL 5.5 or later</li>
    		<li>mod_rewrite</li>
    		<li>php fopen</li>
    		<li>suPHP</li>
    	</ol>

    	<p>You can also install WordPress on your PC or laptop through a local server. You can use the next software to create a local server: <strong>WAMP</strong>, <strong>AppServ</strong>, <strong>MAMP</strong>, etc. All of these support WordPress and can be installed as regular software.</p>
    	<p>These tutorials will help you set up the local server:</p>
    	<ul class="marked-list">
    		<li><a href="/help/how-to-install-appserv-web-development-environment.html" target="_blank">How to install AppServ web development environment</a></li>
    	<li><a href="/help/how-to-install-wamp-web-development-environment.html" target="_blank">How to install WAMP web development environment</a></li>
    	<li><a href="/help/how-to-install-xamp-web-development-environment.html" target="_blank">How to install XAMP web development environment</a></li>
    </ul>
</article>