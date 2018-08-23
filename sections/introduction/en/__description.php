
<?php if ($project != 'jetelements' && $project != 'jetmenu' && $project != 'woo-quickstart-kit' && $project != 'jetblog' && $project != 'jetreviews' && $project != 'jettabs' && $project != 'jetparallax' && $project != 'jetwoobuilder' && $project != 'jettricks' && $project != 'crocoblock' && $project != 'jetblocks' && $project != 'kava-child'&& $project != 'elementortemplate' && $project != 'jeta' && $project != 'mezo' && $project != 'jetengine' && $project != 'jetguten' && $project != 'jetpopup' && $project != 'monstroid2') { ?>

<h2>Introduction</h2>



<h5>Thank you for purchasing a WordPress template. This documentation consists of several parts and covers the entire process of installing and setting up a WordPress website from scratch.</h5>
<article id="whatiswordpress">
    <h3>What is WordPress CMS?</h3>

    <p>WordPress is a free open-source blogging tool and content management system (CMS) based on PHP and MySQL. With
    its help you can create and administrate websites or powerful on-line applications without possessing any special
    technical skills. Due to the ease of use and flexibility, WordPress has become the most popular
    platform for website development.
    <a href="http://wordpress.org/about/" target="_blank">Learn More</a>
    </p>
</article>
<article id="whatistemplate">
    <h3>What is a WordPress Template?</h3>
    <p>WordPress template is a theme for the WordPress CMS platform. You can easily change your website appearance by installing a new WordPress template in a few easy steps. Despite its simplicity, a WordPress template contains all the necessary source files that can be altered the way you need.</p>
</article>

<?php if ($project != 'monstroid_2' && $project != 'woostroid' && $project != 'contractor') { ?>
<article id="structure">
    <h3>Template Structure</h3>
    <p>The template package includes several folders. Let's check what's inside:</p>

    <ul class="files_structure">
        <li>
        	<dl class="inline-term">
        		<dt><i class="fa fa-folder"></i> <strong>screenshots</strong></dt>
        		<dd> contains screen-shots of the template. However, they are not required to edit the template.</dd>
        	</dl>
        </li>
        <li>
            <dl class="inline-term">
                <dt><i class="fa fa-folder"></i> <strong>theme</strong></dt>
                <dd> contains WordPress theme files.</dd>
            </dl>
            <ul>
                <li>
                    <dl class="inline-term">
                        <dt>
                            <i class="fa fa-folder"></i> <strong>theme-name.zip</strong>
                        </dt>
                        <dd>
                            archive with the theme (child theme). Contains all theme files.
                            It must be installed through the WordPress extension manager.
                        </dd>
                    </dl>
                </li>


                    <ul>
                         <?php if ($project != 'contractor' && $project != 'stexchange') { ?>


                        <?php } ?>
                        <?php if ($project == 'interra' or $project == 'valentia' or $project == 'shopable' or $project == 'wheelmasters') { ?>
                        <li>
                            <dl class="inline-term">
                                <dt>
                                    <i class="fa fa-file"></i> <strong>widgets.wie</strong>
                                </dt>
                                <dd>
                                    contains widgets settings.
                                </dd>
                            </dl>
                        </li>
                    <?php } ?>
                    </ul>
                </li>
                <li class="folder">
                    <dl class="inline-term">
                        <dt>
                            <i class="fa fa-folder"></i> <strong>manual_install</strong>
                        </dt>
                        <dd>
                            contains files that make the WordPress website look like on our live demo.
                        </dd>
                    </dl>

                    <ul>
                        <li>
                            <dl class="inline-term">
                                <dt>
                                    <i class="fa fa-folder"></i> <strong>uploads</strong>
                                </dt>
                                <dd>
                                    contains theme images.
                                </dd>
                            </dl>
                        </li>
                        <?php if ($project == 'fairystyle') { ?>
                            <li>
                                <dl class="inline-term">
                                    <dt>
                                        <i class="fa fa-folder"></i> <strong>plugins</strong>
                                    </dt>
                                    <dd>
                                        contains custom plugins from TemplateMonster.
                                    </dd>
                                </dl>
                            </li>

                        <?php } ?>
                        <li>
                            <dl class="inline-term">
                                <dt>
                                    <i class="fa fa-file"></i> <strong>theme-name.sql</strong>
                                </dt>
                                <dd>
                                    database file (contains theme content).
                                </dd>
                            </dl>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>
        <li>
            <dl class="inline-term">
                <dt><i class="fa fa-file"></i> <strong>documentation.txt</strong></dt>
                <dd> contains documentation link information.</dd>
            </dl>
        </li>
        <li>
            <dl class="inline-term">
                <dt><i class="fa fa-file"></i> <strong>info.txt</strong></dt>
                <dd> instructions on how to extract source files.</dd>
            </dl>
        </li>
    </ul>
</article>
<article id="preparation">
<?php } ?>



<?php if ($project == 'monstroid_2') { ?>
<article id="structure">
    <h3>Template Structure</h3>
    <p>The template package includes several folders. Let's check what's inside:</p>

    <ul class="files_structure">
        <li>
            <dl class="inline-term">
                <dt><i class="fa fa-folder"></i> <strong>screenshots</strong></dt>
                <dd> contains screen-shots of the template. However, they are not required to edit the template.</dd>
            </dl>
        </li>
        <li>
            <dl class="inline-term">
                <dt><i class="fa fa-folder"></i> <strong>sources</strong></dt>
                <dd> contains sources of the template.</dd>
            </dl>
            <ul>
                <li>
                    <dl class="inline-term">
                        <dt>
                            <i class="fa fa-folder"></i> <strong>psd</strong>
                        </dt>
                        <dd>
                            contains psd
                        </dd>
                    </dl>
                </li>
            </ul>
        </li>
        <li>
            <dl class="inline-term">
                <dt><i class="fa fa-folder"></i> <strong>theme</strong></dt>
                <dd> contains WordPress theme files..</dd>
            </dl>
            <ul>
                <li>
                    <dl class="inline-term">
                        <dt>
                            <i class="fa fa-folder"></i> <strong>manual-install</strong>
                        </dt>
                        <dd>
                            contains files that make the WordPress website look like on our live demo.
                        </dd>
                    </dl>

                    <ul>
                        <li>
                            <dl class="inline-term">
                                <dt>
                                    <i class="fa fa-file"></i> <strong>default</strong>
                                </dt>
                                <dd>
                                    contains all template sample data (posts, pages, categories, etc).
                                </dd>
                            </dl>
                            <ul>
                                <li>
                                    <dl class="inline-term">
                                        <dt>
                                            <i class="fa fa-file"></i> <strong>uploads</strong>
                                        </dt>
                                        <dd>
                                            contains theme images.
                                        </dd>
                                    </dl>
                                </li>

                                <li>
                                    <dl class="inline-term">
                                        <dt>
                                            <i class="fa fa-file"></i> <strong>monstroid2.sql</strong>
                                        </dt>
                                        <dd>
                                            database file (contains theme content)
                                        </dd>
                                    </dl>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <dl class="inline-term">
                                <dt>
                                    <i class="fa fa-folder"></i> <strong>plugins</strong>
                                </dt>
                                <dd>
                                    contains custom plugins from TemplateMonster.
                                </dd>
                            </dl>
                        </li>
                        <li>
                            <dl class="inline-term">
                                <dt>
                                    <i class="fa fa-folder"></i> <strong>skins</strong>
                                </dt>
                                <dd>
                                    contains custom skins from TemplateMonster.
                                </dd>
                            </dl>
                            <ul>
                                <li>
                                    <dl class="inline-term">
                                        <dt>
                                            <i class="fa fa-folder"></i> <strong>construction</strong>
                                        </dt>
                                        <dd>
                                            files for Construction skin.
                                        </dd>
                                    </dl>
                                </li>
                                <li>
                                    <dl class="inline-term">
                                        <dt>
                                            <i class="fa fa-folder"></i> <strong>corporate</strong>
                                        </dt>
                                        <dd>
                                            files for Corporate skin.
                                        </dd>
                                    </dl>
                                </li>
                                <li>
                                    <dl class="inline-term">
                                        <dt>
                                            <i class="fa fa-folder"></i> <strong>fashion</strong>
                                        </dt>
                                        <dd>
                                            files for Fashion skin.
                                        </dd>
                                    </dl>
                                </li>
                                <li>
                                    <dl class="inline-term">
                                        <dt>
                                            <i class="fa fa-folder"></i> <strong>furni</strong>
                                        </dt>
                                        <dd>
                                            files for Furni skin.
                                        </dd>
                                    </dl>
                                </li>
                                <li>
                                    <dl class="inline-term">
                                        <dt>
                                            <i class="fa fa-folder"></i> <strong>ironmass</strong>
                                        </dt>
                                        <dd>
                                            files for Ironmass skin.
                                        </dd>
                                    </dl>
                                </li>
                                <li>
                                    <dl class="inline-term">
                                        <dt>
                                            <i class="fa fa-folder"></i> <strong>lawyer</strong>
                                        </dt>
                                        <dd>
                                            files for Lawyer skin.
                                        </dd>
                                    </dl>
                                </li>
                                <li>
                                    <dl class="inline-term">
                                        <dt>
                                            <i class="fa fa-folder"></i> <strong>loanoffer</strong>
                                        </dt>
                                        <dd>
                                            files for Loanoffer skin.
                                        </dd>
                                    </dl>
                                </li>
                                <li>
                                    <dl class="inline-term">
                                        <dt>
                                            <i class="fa fa-folder"></i> <strong>modern</strong>
                                        </dt>
                                        <dd>
                                            files for Modern skin.
                                        </dd>
                                    </dl>
                                </li>
                                <li>
                                    <dl class="inline-term">
                                        <dt>
                                            <i class="fa fa-folder"></i> <strong>resto</strong>
                                        </dt>
                                        <dd>
                                            files for Resto skin.
                                        </dd>
                                    </dl>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <dl class="inline-term">
                                <dt>
                                    <i class="fa fa-file"></i> <strong>monstroid2.zip</strong>
                                </dt>
                                <dd>
                                    archive with the theme. Contains all theme files. It must be installed through the WordPress extension manager.
                                </dd>
                            </dl>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>
        <li>
            <dl class="inline-term">
                <dt><i class="fa fa-file"></i> <strong>documentation.txt</strong></dt>
                <dd> contains documentation link information.</dd>
            </dl>
        </li>
        <li>
            <dl class="inline-term">
                <dt><i class="fa fa-file"></i> <strong>info.txt</strong></dt>
                <dd> contains file with information.</dd>
            </dl>
        </li>
        <li>
            <dl class="inline-term">
                <dt><i class="fa fa-file"></i> <strong>license.txt</strong></dt>
                <dd> contains file with license.</dd>
            </dl>
        </li>
        <li>
            <dl class="inline-term">
                <dt><i class="fa fa-file"></i> <strong>screenshots.zip</strong></dt>
                <dd> contains archive with screenshots.</dd>
            </dl>
        </li>
    </ul>
</article>
<article id="preparation">
<?php } ?>

<?php if ($project == 'woostroid') { ?>
<article id="structure">
    <h3>Template Structure</h3>
    <p>The template package includes several folders. Let's check what's inside:</p>

    <ul class="files_structure">
        <li>
            <dl class="inline-term">
                <dt><i class="fa fa-folder"></i> <strong>screenshots</strong></dt>
                <dd> contains screen-shots of the template. However, they are not required to edit the template.</dd>
            </dl>
        </li>
        <li>
            <dl class="inline-term">
                <dt><i class="fa fa-folder"></i> <strong>sources</strong></dt>
                <dd> contains sources of the template.</dd>
            </dl>
            <ul>
                <li>
                    <dl class="inline-term">
                        <dt>
                            <i class="fa fa-folder"></i> <strong>psd</strong>
                        </dt>
                        <dd>
                            contains psd
                        </dd>
                    </dl>
                </li>
            </ul>
        </li>
        <li>
            <dl class="inline-term">
                <dt><i class="fa fa-folder"></i> <strong>theme</strong></dt>
                <dd> contains WordPress theme files..</dd>
            </dl>
            <ul>
                <li>
                    <dl class="inline-term">
                        <dt>
                            <i class="fa fa-folder"></i> <strong>manual-install</strong>
                        </dt>
                        <dd>
                            contains files that make the WordPress website look like on our live demo.
                        </dd>
                    </dl>

                    <ul>
                        <li>
                            <dl class="inline-term">
                                <dt>
                                    <i class="fa fa-file"></i> <strong>default</strong>
                                </dt>
                                <dd>
                                    contains all template sample data (posts, pages, categories, etc).
                                </dd>
                            </dl>
                            <ul>
                                <li>
                                    <dl class="inline-term">
                                        <dt>
                                            <i class="fa fa-file"></i> <strong>uploads</strong>
                                        </dt>
                                        <dd>
                                            contains theme images.
                                        </dd>
                                    </dl>
                                </li>

                                <li>
                                    <dl class="inline-term">
                                        <dt>
                                            <i class="fa fa-file"></i> <strong>woostroid.sql</strong>
                                        </dt>
                                        <dd>
                                            database file (contains theme content)
                                        </dd>
                                    </dl>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <dl class="inline-term">
                                <dt>
                                    <i class="fa fa-folder"></i> <strong>plugins</strong>
                                </dt>
                                <dd>
                                    contains custom plugins from TemplateMonster.
                                </dd>
                            </dl>
                        </li>
                        <li>
                            <dl class="inline-term">
                                <dt>
                                    <i class="fa fa-file"></i> <strong>woostroid.zip</strong>
                                </dt>
                                <dd>
                                    archive with the theme. Contains all theme files. It must be installed through the WordPress extension manager.
                                </dd>
                            </dl>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>
        <li>
            <dl class="inline-term">
                <dt><i class="fa fa-file"></i> <strong>documentation.txt</strong></dt>
                <dd> contains documentation link information.</dd>
            </dl>
        </li>
        <li>
            <dl class="inline-term">
                <dt><i class="fa fa-file"></i> <strong>info.txt</strong></dt>
                <dd> contains file with information.</dd>
            </dl>
        </li>
        <li>
            <dl class="inline-term">
                <dt><i class="fa fa-file"></i> <strong>license.txt</strong></dt>
                <dd> contains file with license.</dd>
            </dl>
        </li>
        <li>
            <dl class="inline-term">
                <dt><i class="fa fa-file"></i> <strong>screenshots.zip</strong></dt>
                <dd> contains archive with screenshots.</dd>
            </dl>
        </li>
    </ul>
</article>
<article id="preparation">
<?php } ?>


    <h3>Preparation</h3>
    <h6>Before installing a WordPress website, you need to get fully prepared. We recommend you to get the following aspects covered:</h6>

    <h4>Software</h4>
    <p>Before you start working with the WordPress template, you should download the required software. You can check the required software on the template preview page.<br>
    The requirements can alter from template to template, so we will list the most important ones:</p>
 <?php if ($project != 'bettaso' && $project != 'bedentist' && $project != 'pristine' && $project != 'samson' && $project != 'advisto' && $project != 'ironmass' && $project != 'mechanna' && $project != 'fiona' && $project != 'cleaningpro' && $project != 'confucius'  && $project != 'plumberpro' && $project != 'madeleine' && $project != 'fenimore' && $project != 'focussity'  && $project != 'durand' && $project != 'chateau' && $project != 'shanti' && $project != 'nolan' && $project != 'jorden' && $project != 'fuel' && $project != 'neuton' && $project != 'proedge' && $project != 'chromix' && $project != 'artwork' && $project != 'safedrive' && $project != 'sensei' && $project != 'legacy' &&  $project != 'lawpress' && $project != 'limittax' && $project != 'cookery' && $project != 'duval' && $project != 'keypress' && $project != 'crystalica' && $project != 'penn'  && $project != 'porto' && $project != 'odyssey' && $project != 'masterchef' && $project != 'chopchop' && $project != 'whitewhale' && $project != 'tanaka' && $project != 'addison' && $project != 'ecolife' && $project != 'hidalgo' && $project != 'happylearning' && $project != 'mizrahi' && $project != 'redhotgrill' && $project != 'inmotion' && $project != 'machinist' && $project != 'cascade' && $project != 'paintelle' ) { ?>

        <ol class="index-list">
        	<li>First of all, you will need the right software to extract files from the password protected sources_#########.zip archive. You can use WinZip 9 or a later version (if you have Windows OS) or Stuffit Expander 10 or a later version (if you have Mac OS).</li>
        	<li>You might also need Adobe Photoshop. It is used to edit the source .PSD files in case you need to change the graphic design and images of the template.</li>
        	<li>To edit the source code of the template, you can use code editors like Adobe Dreamweaver, Notepad++, Sublime Text, etc.</li>
        	<li>To upload the files to a hosting server, you will need an FTP manager like Total Commander, FileZilla, CuteFTP, etc.</li>
        </ol>
<?php } ?>
    	<h4>Hosting</h4>


    	<p>Since WordPress CMS is a PHP/MySQL platform, you need to have the hosting server prepared for it.</p>
    	<p>In case you already have a hosting server, you need to check whether it is compatibile with <a href="http://wordpress.org/about/requirements/" target="_blank"> WordPress hosting requirements </a> or not. In other words, whether you can host a WordPress website with it.</p>

    	<p>Our theme itself requires Apache or Nginx hosting servers with the following configuration settings:</p>

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
    		<li>50 MB of disk space;</li>
    		<li>memory limit per process: 64mb (128mb or more recommended).</li>
    	</ol>


    	<h5>PHP and MySQL</h5>

    	<p>Minimal required version of PHP is 5.2.4 and MySQL 5. PHP 5.2 is already not safe as contains critical vulnerabilities that can be used to harm your website. Some Theme extensions will not work with PHP 5.2 and require version 5.4 or later.</p>

    	<p>Recommended settings are: </p>

    	<ol class="index-list">
    		<li>PHP 5.4;</li>
    		<li>MySQL 5.5 or later;</li>
    		<li>mod_rewrite;</li>
    		<li>php fopen;</li>
    		<li>suPHP.</li>
    	</ol>

    	<p>You can also install WordPress on your PC or laptop through a local server. You can use the following software to create a local server: <strong>WAMP</strong>, <strong>AppServ</strong>, <strong>MAMP</strong>, etc. All of these support WordPress and can be installed as a regular software.</p>
    	<p>These tutorials will help you set up the local server:</p>
    	<ul class="marked-list">
    		<li><a href="https://zemez.io/wordpress/support/knowledge-base/app-serv-web-development-environment-installation/" target="_blank">App Serv Web Development Environment Installation</a></li>
    	<li><a href="https://zemez.io/wordpress/support/knowledge-base/wamp-web-development-environment-installation/" target="_blank">WAMP Web Development Environment Installation</a></li>
    	<li><a href="https://zemez.io/wordpress/support/knowledge-base/xamp-web-development-environment-installation/" target="_blank">XAMP Web Development Environment Installation</a></li>
    </ul>

</article>
<?php } ?>

<?php if ($project == 'jetelements') { ?>

<article><h2>Introduction</h2>

<h5>Thank you for purchasing JetElements for <a href="https://wordpress.org/plugins/elementor/" target="_blank">Elementor</a>. This documentation consists of several parts and covers the entire process of installing and setting up JetElements plugin from scratch.
You will also find information on how to enable and customize JetElements addons. </h5>

    <h3>What Is JetElements Plugin?</h3>


<p>JetElements is a plugin that adds extensive modules for Elementor live page builder, allowing to build different kinds of content with easiness and efficiency. </p>

<p>With JetElements You can add various custom blocks to your website’s page layout, containing additional modules, which are not included in the standard Elementor page builder elements bundle. </p>

<p>Use JetElements to extend Your content with 19 diverse modules, devised especially to add timers, pricing tables and advanced sliders to Your website’s pages. </p>

    <h3>JetElements Overview</h3>

<ul class="marked-list">
<p><li><b>Advanced Carousel</b>  module displays slides in an attractive way. You can display from 1 to 10 slides at one time using Advanced Carousel module, set versatile animation options, create vivid backgrounds, enrich slides content with clear typography. With Advanced Carousel you can create as many slides as you need to.</li></p>
<p><li><b>Advanced Map</b>  module is the perfect solution if you need to display a map on your website, and add pins to it to locate the places. You can add multiple pins, change map style, enable switching from satellite to map view. The module is easily customizable and has friendly user interface.</li></p>
<p><li><b>Animated Box</b>  module creates an attractive info block on the website’s page, which consists of two sides, that switch from one to other. You can add icons, buttons, titles and content to the animated box. Every element is easily customizable.</li></p>
<p><li><b>Animated Text</b> module was specially devised to deliver your ideas in the form of attractively animated text. With the help of ths module you can add animated words and phrases to your website’s pages, customize them, and add plain text to complement animated text.</li></p>
<p><li><b>Banner</b> module allows you to add custom banners to your website’s content. The module has multiple style settings, that include animation settings. It provides you with the means to customize banner background, title and content.</li></p>
<p><li><b>Brands</b> module helps you to showcase brands and companies on your website’s page. You can add brands, visualize them using brand logos, apply links to them, and customize them in the matter of several clicks.</li></p>
<p><li><b>Button</b> module will assist you in creating buttons with your custom text and links, eye-catching icons and versatile hover effects! With this module you can easily add a button whenever you need it and style it up according to your vision!</li></p>
<p><li><b>Circle Progress</b> module allows you to display progress in the attractive form of circle progress bar. The module has versatile style settings, such as content style, value type, etc.</li></p>
<p><li><b>Countdown Timer</b> module is a helpful tool if you need to embed a timer with a countdown to your website’s page. The module has multiple settings, such as digits color, font settings, and custom background for the timer.</li></p>
<p><li><b>Download Button</b> module will assist You in creating versatile buttons that will allow the visitors downloading files in one click! You won't need to install additional plugins to add this kind of functionality to the website! All You need is to use Download Button module and have the file stored in the Media Library!</li></p>
<p><li><b>Headline</b> module is the perfect tool for creating stunningly beautiful headlines in order to decorate the website’s pages with attractive textual titles. Its content is fully flexible, as well as its multiple style settings, devised to assist you in creating really beautiful headings within minutes! </li></p>
<p><li><b>Image Comparison</b> module is the perfect tool that will assist you in creating slides with image comparisons in an attractive and stylish way. From now on you wield the power to showcase the results of your work in an engaging Before and After form! </li></p>
<p><li><b>Instagram</b> module mpowers you to showcase Instagram publications on yuor website's pages in an attractive way, with text captions, meta information (the number of likes and comments). You'll be able to style up this module according to your vision in order to make it the truly outstanding part of your website! </li></p>
<p><li><b>Images Layout</b> module displays images using different eye-catching layout types, such as Masonry, Justify or List. Add images and customize layouts in several clicks to get the stunning results and adorn Your website pages with beautiful imagery!</li></p>
<p><li><b>Posts</b> module is a multipurpose tool, that can create attractive post grid layouts, sort posts by categories, IDs or the date of publishing. This module is also helpful when creating post sliders and post carousels.</li></p>
<p><li><b>Pricing Table</b> module is helpful beyond measures when you need to showcase the prices and services your company provides in an attractive and clear way. The module has multiple options, versatile customization settings, and is easy to use.</li></p>
<p><li><b>Scroll Navigation</b> module has multiple style and content settings, allowing to set icons, use labels, define the elements position, background type, and there is so much more for you to customize to make the module look its best! </li></p>
<p><li><b>Services</b> module is devised to add attractive services blocks to your website pages in a smooth and easy way! Use it to showcase the services provided by your company. With Services module you can manage the service title, description, and there are still lots of style settings you can manage. </li></p>
<p><li><b>Slider</b> module is invaluable if You need to liven up Your website page with a bright and attractive slider! This module is easily customizable, has multiple navigation options. It provides profound content and style settings, which make working on slider as simple as it can be!</li></p>
<p><li><b>Team Member</b> module is the perfect solution when it comes to displaying your team members, and if you need to introduce your team to your website visitors. There are multiple content and style settings, that can be changed at will! </li></p>
<p><li><b>Testimonials</b> module is useful beyond compare when it comes to adding your clients’ positive feedbacks to your site. Feel free to style up the testimonials and add the beautiful testimonials carousel right to your web page in several clicks! </li></p>

<!-------------------------------------
<p><li><b>Cherry Team</b> module is extremely useful when you need to add team members to the website’s page. The module helps to define the type of information about team members, that you want to display, sort the team members by teams. It also ensures responsiveness for different types of screens.</li></p>
<p><li><b>Cherry Services</b> module helps to display the services you provide in an attractive way. The module showcases services using categories or ID. It provides full responsiveness and allows you to set featured images and description length for the services you offer.</li></p>
---------------------------------------->
<p><li><b>WooCommerce Recent Products</b> module helps you to showcase the products on your website’s page and sort them using custom order.</li></p>
<p><li><b>WooCommerce Featured Products</b> module helps you to display featured products in an attractive way on your website’s page, and sort them using custom order.</li></p>
<p><li><b>WooCommerce Sale Products</b> helps you to display sale products on your website’s page, and sort them using custom order.</li></p>
<p><li><b>WooCommerce Best Sellers</b> module is extremely helpful if you need to show the most sold products on your website’s page, and arrange them in columns.</li></p>
<p><li><b>WooCommerce Top Rated Products</b> module can be used if you want to showcase the products that have the highest rating according to the customers reviews. With this module you can set the number of products to show per page and the number of columns in which the products will be organized.</li></p>
<p><li><b>WooCommerce Product</b> module can help you to display custom products on your website page in a classy way.</li></p>
<p><li><b>Contact Form 7</b> module helps you to display your existing contact forms. You have to create a contact form using Contact Form 7 plugin before placing it to your website’s page.</li></p>
</ul>


    <div class="alert alert-info">
        You have to install and activate <a href="https://wordpress.org/plugins/elementor/" target="_blank">Elementor</a> page builder plugin before using JetElements! If You haven’t installed Elementor, please, navigate to <a href="https://docs.elementor.com/" target="_blank">Elementor Installation tutorial.</a></div>
    </article>

<?php } ?>

<?php if ($project == 'jetmenu') { ?>

<article><h2>Introduction</h2>

<p>Thank you for purchasing JetMenu addon for <a href="https://wordpress.org/plugins/elementor/" target="_blank">Elementor</a>. This documentation consists of several parts and covers the entire process of installing and setting up JetMenu plugin from scratch. You will also find information on how to create a menu and customize it using JetMenu addon.</p>

<article><h2>What Is JetMenu Plugin?</h2>

<p>JetMenu is a plugin that assists you in creating and styling up mega menu. You’ll be able to create content for the menu items and customize items appearance, add menu badges and icons, change menu item background - all this with JetMenu plugin, which is easy-to-use and has intuitive and clear interface. </p>

<p>With JetMenu you can style menu items using different fonts and all colors of the world. There are multiple settings to set the menu item shadows, customization options for Active and Hover mode, etc. </p>

<p>The plugin works in tandem with Elementor live page builder, allowing to add content to menu items in a drag-and-drop way. The content and style settings share the same treats with Elementor and JetElements. You’ll also get Custom Menu module for Elementor, which allows you to add your menu to any page layout section you want. </p>

    </article>

<?php } ?>


<?php if ($project == 'woo-quickstart-kit') { ?>


<article><h2>Introduction</h2>

<p>Thank you for purchasing WooCommerce QuickStart Kit for Cherry Framework 5 - based WooCommerce themes. This documentation consists of several parts and covers the entire process of installing and setting up WooCommerce online store from scratch with the help of WooCommerce QuickStart Kit plugin. </p>

<p>You'll also find information on how to tune up WooCommerce online store, add products dummy data and create the basic WooCommerce pages necessary for launchind a full-fledged online store.</p>

<article><h2>What Is WooCommerce QuickStart Kit Plugin?</h2>

<p>WooCommerce QuickStart Kit is a plugin that assists you in styling up WooCommerce pages, helps you install and use WooCommerce package, which includes multiple WooCommerce widgets, and stuffs your website with products dummy data. </p>

<p>Get a head start when creating an online store and set everything within an hour using WooCommerce Quick Start Kit, which will effectively introduce products and style up your web store pages in a classy way!
</p>

</article>

<?php } ?>

<?php if ($project == 'jetblog') { ?>

<article><h2>Introduction</h2>

<h5>Thank you for purchasing JetBlog addon for <a href="https://wordpress.org/plugins/elementor/" target="_blank">Elementor</a>. This documentation consists of several parts and covers the entire process of installing and setting up JetBlog  plugin from scratch. You will also find information on how to add JetBlog modules to the pages built with Elementor, and how to change JetBlog settings. </h5>

<h3>What Is JetBlog Plugin? </h3>

<p><b>JetBlog</b> is a plugin that enriches the website’s content with multiple modules, that will suit not only for creating blog pages, but will also liven up your website with different dynamic modules, such as <b>Smart Tiles, Text Tickers, Video Playlists, Smart Posts List</b>. </p>

<p>With <b>JetBlog</b> one can add content modules on the page built with <b>Elementor</b>, and style up the content appearance to match the general webpage style. Using <b>JetBlog</b> you can customize the modules backgrounds, layouts, responsiveness, add borders and apply shadows, change typography, and there are still so many more options to discover for each of the content modules. </p>
</article>

<?php } ?>


<?php if ($project == 'jetreviews') { ?>

<article><h2>Introduction</h2>

<p>Thank you for purchasing <b>JetReviews</b> for <a href="https://wordpress.org/plugins/elementor/" target="_blank">Elementor</a>. This documentation consists of several parts and covers the entire process of installing and setting up <b>JetReviews</b> plugin from scratch. You will also find information on how to add and customize <b>Review</b> widget.</p>

<h3>What Is JetReviews Plugin? </h3>

<p><b>JetReviews</b> is a plugin that assists in creating reviews and adding them to the pages, built with Elementor live page builder. It can display both manually input reviews and the ones added via WordPress Dashboard. </p>

<p>The plugin has multiple content and style settings, allowing to make the <b>Review</b> blocks look spectacular. </p>


<div class="alert alert-info">
        You have to install and activate <a href="https://wordpress.org/plugins/elementor/" target="_blank">Elementor</a> page builder plugin before using JetReviews! If You haven’t installed Elementor, please, navigate to <a href="https://docs.elementor.com/" target="_blank">Elementor Installation tutorial.</a></div>


<p>The plugin possesses everything needed for creating and displaying reviews, which happen to be the essential part of the blogging websites and online stores.</p>

<p>The reviews are proven to influence the person’s opinion in lots of ways, so if You’re bound on sharing Your opinion with the visitors, You’ll find JetReview plugin extremely efficient!</p>

<p>Represent the rating values in the form of stars, rating bars and numbers in order to make the review more evident and eye-catching! </p>

<p>Review widget is just what one needs when thinking of adding eye-catching rating bars and review blocks, which display the percents, stars etc. This widget possesses every means to deliver your ideas and share your opinion on different matters just in few clicks.</p>

<p>It is astonishing how many options are out there for creating a review with a rating bar!</p>

<p>You can master the widget’s blocks responsiveness by changing the elements’ height and width for different devices. The plugin has a fully responsive appearance, making it perfectly fitted for almost all kinds of screens, from mobile devices to tablets and desktops.</p>

<p>As a result Your content will look magnificent on both large and smaller screens!</p>

<p>It is easy to use JetReviews to add reviews in practically several clicks! The interface is clear and simple.</p>

<p>If you’re looking for a really powerful plugin to showcase the reviews and create attractively-looking ratings, here it is. Its design is carefully thought-through, built to suit your needs.</p>

<p>And, what is the most important about JetReviews, is that one doesn’t need any coding skills in order to use it. </p>

<p>You can add reviews by dragging and dropping the Review widget to the needed column in the page’s structure!</p>


<p>JetReviews is a really easy-to-use plugin for everyone needing to showcase reviews created via Dashboard or directly in Elementor live page builder.</p>


</article>

<?php } ?>

<?php if ($project == 'jettabs') { ?>

<article><h2>Introduction</h2>

<p>Thank you for purchasing <b>JetTabs</b> for <a href="https://wordpress.org/plugins/elementor/" target="_blank">Elementor</a>. This documentation consists of several parts and covers the entire process of installing and setting up <b>JetTabs</b> plugin from scratch. You will also find information on how to add and customize <b>Accordion</b>, <b>Image Accordion</b> and <b>Tabs</b> widgets.</p>


<h3>What Is JetTabs Plugin?</h3>


<p><b>JetTabs</b> is a plugin that allows adding stylish tabs and accordion widgets with vertical and horizontal layouts and building content inside them using Elementor live page builder widgets. </p>

<p>The plugin makes it simple to create a template with Elementor and add it to the <b>Accordion</b> or <b>Tabs</b> widget. It helps organize content and style it up according to one’s needs and preferences. </p>

<div class="alert alert-info">
        You have to install and activate <a href="https://wordpress.org/plugins/elementor/" target="_blank">Elementor</a> page builder plugin before using JetTabs! If You haven’t installed Elementor, please, navigate to <a href="https://docs.elementor.com/" target="_blank">Elementor Installation tutorial.</a></div>



<p>While using JetTabs you’ll be astonished how easy You can create content and place it into well-structured tabs and accordion blocks, making Your web page look neat and classy at the same time.</p>

<p>You’ll be able to customize the content and looks of the <b>JetTabs</b> accordion and tabs blocks to make them totally fit for the page’s appearance! The vast number of style settings will become a huge asset for everyone fond of pixel-perfect design and clean typography, and there are still so many more options to discover!</p>

<p>Discover the ultimate potential of the Tabs widget, which makes the process of adding content into the tab blocks as easy as it can be. All You’ll have to do is create the templates in Elementor live page builder with the needed layout, background and content, and them select it from the list of existing templates and pages to assign it to one of the tabs! </p>

<p>And there are also loads of style settings, allowing to change the tabs appearance at will, and even create the tabs within the existing tabs! </p>

<p>If You're fond of organizing content on the pages into neat and classy-looking Accordion blocks? In this case You’ll definitely enjoy the Classic Accordion widget, which allows placing the previously made templates into the Accordion blocks, which can be unfolded and folded whenever there is a need. </p>

<p>The widget really adds lots of extra points to the page’s general neat appearance and compactness of the content, allowing to add more content even when there’s not so many place left for it!</p>

<p>Image Accordion is one of the most spectacular widgets for Elementor live page builder! It becomes a real asset for You when it comes to displaying imagery in a totally eye-catching way of vertical and horizontal accordions! </p>

<p>Enjoy playing around with the overlays, border radius values, inner content, like buttons and text passages, all placed into the Image Accordion blocks, switching smoothly on hover!</p>

<p><b>JetTabs</b> plugin  is an easy-to-use addon allowing to add stylish tabs and accordion blocks to the webpages and enrich them with content, which can be built using Elementor widgets and sections structure. </p>

<p>The plugin is simple in customization, and can become a true asset for those who value style and efficiency!
</p>



</article>

<?php } ?>

<?php if ($project == 'jetparallax') { ?>

<article><h2>Introduction</h2>
<p>Thank you for purchasing <b>JetParallax</b> for <a href="https://wordpress.org/plugins/elementor/" target="_blank">Elementor</a>. This documentation consists of several parts and covers the entire process of installing and using <b>JetParallax</b> plugin for creating magnificent parallax section backgrounds! </p>
</article>


<div class="alert alert-info">
        You have to install and activate <a href="https://wordpress.org/plugins/elementor/" target="_blank">Elementor</a> page builder plugin before using JetParallax! If You haven’t installed Elementor, please, navigate to <a href="https://docs.elementor.com/" target="_blank">Elementor Installation tutorial.</a></div>
<?php } ?>

<?php if ($project == 'jetwoobuilder') { ?>

<article><h2>Introduction</h2>

<p>Thank You for purchasing <b>JetWooBuilder</b> for <a href="https://wordpress.org/plugins/elementor/" target="_blank">Elementor</a>. This documentation consists of several parts and uncovers the entire process of installing and setting up <b>JetWooBuilder</b> plugin from scratch.</p>

<p>You will also find here information how to create the template for the <b>Single product</b> page, apply to the certain product.</p>

<p>You'll also learn more about creating <b>WooCommerce Product Archive</b> templates and setting them for Shop page, using them for cross-sells and related products.</p>

<h3>What Is JetWooBuilder plugin?</h3>

<p><b>JetWooBuilder</b> is a plugin that allows creating <b>WooCommerce Single Product</b> page templates and <b>WooCommerce Product Archive</b>  templates with Elementor live page builder functionality using multiple dynamic content widgets.</p>

<p>With <b>JetWooBuilder</b> it is easy to create the exact page structure one needs for the <b>WooCommerce product</b> or <b>Archive</b> page without ever touching a single line of code. The sections and columns can be built in seconds and filled up with content in a drag-n-drop way.</p>

<p>Use <b>JetWooBuilder</b> to create unique WooCommerce <b>Single Product</b> page templates or <b>Product Archive</b> templates and use them for the products represented on Your site.</p>

<div class="alert alert-info">
        You have to install and activate <a href="https://wordpress.org/plugins/elementor/" target="_blank">Elementor</a> page builder plugin before using JetWooBuilder! If You haven’t installed Elementor, please, navigate to <a href="https://docs.elementor.com/" target="_blank">Elementor Installation tutorial.</a></div>

<h3>JetWooBuilder Widgets Overview</h3>

<ul class="marked-list">
<p><li>
    <b>Single Add to Cart</b> widget adds the <b>Add to Cart</b> button along with the number of pieces of product for purchasing. The button is needed when one has to add the product to cart.
</li></p>

<p><li>
    <b>Single Attributes</b> widget is used to display the attributes which are added in the <b>Product > Product Data</b> in the <b>Attributes</b> block.
</li></p>
<p><li>
    <b>Single Content</b> widget is used to display the content which is added in the <b>Product content</b> block. It has several style settings and allows displaying the already created content.
</li></p>
<p><li>
    <b>Single Excerpt</b> widget is perfect for displaying the excerpt which is added in the <b>Product Short Description</b> field on the <b>Product</b> page.
</li></p>
<p><li>
    <b>Single Images</b> widget makes it simple to add the product featured image to the product page and has stylization options available for setting up.
</li></p>
<p><li>
    <b>Single Meta</b> widget embeds the SKU number, category and tag used for the product to the page, and allows changing the color, typography and alignment for this information.
</li></p>
<p><li>
    <b>Single Price</b> widget makes it easy to embed the product price and sale price to the <b>Single Product</b> page. One can also customize the prices along with the currency signs.
</li></p>
<p><li>
    <b>Single Rating</b>widget is invaluable when adding the product rating to the <b>Single Product</b> page and styling it up according to one’s vision.
</li></p>
<p><li>
    <b>Single Related Products</b> widget makes it possible to display the related products list and style the colors and the typography for them. Note, that in the related products the widget displays the recently added products that have similar tags or categories.
</li></p>
<p><li>
    <b>Single Reviews Form</b> widget allows displaying the reviews for the product along with the field for adding a new review. The <b>Single Reviews Form</b> widget is necessary when one wants the customers to be able to leave reviews.
</li></p>
<p><li>
    <b>Single Sale Badge</b> widget makes it simple to add the Sale badge to the product’s page. Note, that one should set the Sale price in <b>Products > Product Data Sale Price</b> field to enable this functionality.
</li></p>
<p><li>
    <b>Single Sharing</b> widget adds social icons for the product. Please, note that you need to install and activate the <b>JetPack</b> plugin for WordPress (it is completely free and available at <a href="https://wordpress.org/plugins/jetpack/" target="_blank">wordpress.org</a>) and set the icons for the <b>JetWooBuilder templates</b> and <b>Product</b> pages. The icons can’t be styled.
</li></p>
<p><li>
    <b>Single Tabs</b> widget provides the opportunity to place the reviews and product description into tabs, which can be opened on click. This widget allows to effectively use the space of the <b>Single Product</b> page.
</li></p>
<p><li>
    <b>Single Title</b> widget allows adding the product title to the <b>Single Product</b> page. It adds the title set on the <b>Product</b> page in the Title field and provides stylization settings for it.
</li></p>
<p><li>
    <b>Single Upsells</b> widget adds the products which may also be needed by the customer when he purchases the product shown on the <b>Single Product</b> page. The upsell products can be set in <b>Linked Products Upsells</b> field available in <b>Products > Product Data</b> block.
</li></p>
</ul>

<?php } ?>

<?php if ($project == 'jettricks') { ?>

<article><h2>Introduction</h2>

<p>Thank You for purchasing <b>JetTricks</b> for <a href="https://wordpress.org/plugins/elementor/" target="_blank">Elementor</a>. This documentation consists of several parts and covers the entire process of installing and using <b>JetTricks</b> plugin from scratch.</p>

<p>You will also find here information how to use JetTricks effects along with this plugin's widgets.</p>

<h3>What Is JetTricks plugin?</h3>

<p><b>JetTricks</b> is a plugin that allows adding different visual effects without ever needing to add a single line of code.</p>

<p>The plugin is made for those people who enjoy exquisite animation effects and are willing to add them to the website pages to liven up the website.</p>

<p>Use <b>JetTricks</b> to add Parallax to different widgets, create unfolding sections, sticky columns and View More buttons.</p>

<div class="alert alert-info">
        You have to install and activate <a href="https://wordpress.org/plugins/elementor/" target="_blank">Elementor</a> page builder plugin before using JetTricks! If You haven’t installed Elementor, please, navigate to <a href="https://docs.elementor.com/" target="_blank">Elementor Installation tutorial.</a></div>



<?php } ?>

<?php if ($project == 'crocoblock') { ?>

<article><h2>Introduction</h2>

<p>Meet the top-notch <a href="https://crocoblock.com/" target="_blank">CrocoBlock</a> subscription service!</p>

<p>It allows to use a wide range of products including <a href="https://crocoblock.com/kava-pro/" target="_blank">Kava theme</a> and <a href="https://crocoblock.com/demos/" target="_blank">demos</a> on different topics, as well as a full bundle of <a href="https://crocoblock.com/plugins/" target="_blank">Jet plugins</a>, in one or multiple projects (depending on the licensing one uses).</p>


<p>While using <b>CrocoBlock subscription</b> You can get professional help via <a href="https://kava.ticksy.com/" target="_blank">CrocoBlock support</a> desk.</p>

<h3>What Is Included in CrocoBlock Subscription?</h3>

<p>The subscription includes everything as provided in the one's <a href="https://crocoblock.com/pricing/" target="_blank">pricing plan</a>.

<p>Feel free to download the products included into the subscription from Your Account page. </p>

<p>Here you can find the following products: </p>

<ul class="marked-list">
<p><li><a href="https://crocoblock.com/kava-pro/" target="_blank"><b>Kava theme</b></a> - the free clean WordPress theme;</li>
<li><b>Kava Child theme</b> - the child Kava theme version;</li>
<li><b>Jet Plugins Wizard</b> - automatic plugins and demos installer plugin;</li>
<li><b>Jet Plugins Bundle:</b>
<ul class="marked-list">
<li><a href="http://jetelements.zemez.io/" target="_blank">JetElements;</a></li>
<li><a href="http://jetmenu.zemez.io/" target="_blank">JetMenu;</a></li>
<li><a href="https://jetblocks.zemez.io/" target="_blank">JetBlocks;</a></li>
<li><a href="https://jetblog.zemez.io/" target="_blank">JetBlog;</a></li>
<li><a href="http://documentation.zemez.io/wordpress/index.php?project=crocoblock&lang=en&section=crocoblock-jetthemecore" target="_blank">JetThemeCore;</li>
<li><a href="https://jetwoobuilder.zemez.io/" target="_blank">JetWooBuilder;</a></li>
<li><a href="https://jettricks.zemez.io/" target="_blank">JetTricks;</a></li>
<li><a href="https://jetreviews.zemez.io/" target="_blank">JetReviews;</a></li>
<li><a href="https://jettabs.zemez.io/" target="_blank">JetTabs.</a></li></ul>
</li>
<li><a href="https://crocoblock.com/demos/" target="_blank"><b>Multiple Demos</a> on Different Topics</b> - the list will be updated with time with even more demos;</li>
<li><b>High Quality Image Packs</b> - the image packs on different topics.</li></p></ul>


<p>All the products should be used on the terms on one's pricing plan.</p>


<h3>Recommended Technical Requirements</h3>

<p>The needed requirements are:</p>
<p>
<ul class="marked-list">
<li>PHP 7 or higher;</li>
<li>MySQL 5.6 of higher;</li>
<li>WP memory limit of 128 Mb or larger;</li>
<li>Desktop device;</li>
<li>SSL certificate on server.</li></ul></p>

<p>You can get more information <a href="https://docs.elementor.com/article/38-requirements
" target="_blank">here.</a></p>

<h3>CrocoBlock Videos Playlist</h3>

<p>Feel free to view the video playlist with the presentation of different CrocoBlock services.</p>

<iframe width="750" height="400" src="https://www.youtube.com/embed/videoseries?list=PLdaVCVrkty72g_9pu4-tRJ0j_cc01PqUX" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>



<p>Welcome to <a href="https://crocoblock.com/" target="_blank">CrocoBlock</a>!</p>


<?php } ?>



<?php if ($project == 'jetblocks') { ?>

<article><h2>Introduction</h2>

<p>Thank You for purchasing <b>JetBlocks</b> for <a href="https://wordpress.org/plugins/elementor/" target="_blank">Elementor</a>. This documentation consists of several parts and covers the entire process of installing and using <b>JetBlocks</b> plugin from scratch.</p>

<p>You will also find here information how to use JetBlocks widgets to get the best results when building headers and footers.</p>

<h3>What Is JetBlocks plugin?</h3>

<p><b>JetBlocks</b> is a perfect tool providing an opportunity to create specific content perfectly fit for website's headers and footers.</p>

<p>The plugin makes it extra easy to add <b>authorization links</b>, <b>hamburger panels</b>, <b>login forms</b>, add and customize <b>site logo</b>, <b>nav menu</b>, <b>registration forms</b>, <b>search forms</b> and <b>WooCommerce cart</b> using the convenient widgets made specifically for Elementor. </p>

<p>The plugin allows to enjoy the stunning results in minutes, possesses multiple customization content and style settings. </p>

<div class="alert alert-info">
        You have to install and activate <a href="https://wordpress.org/plugins/elementor/" target="_blank">Elementor</a> page builder plugin before using JetBlocks! If You haven’t installed Elementor, please, navigate to <a href="https://docs.elementor.com/" target="_blank">Elementor Installation tutorial.</a></div>


<?php } ?>

<?php if ($project == 'kava-child') { ?>

<article><h2>Introduction</h2>

<p>Thank you for purchasing a WordPress template. This documentation consists of several parts and covers the entire process of installing and setting up a WordPress website from scratch.</p>

<h3>What is WordPress CMS?</h3>

<p>WordPress is a free open-source blogging tool and content management system (CMS) based on PHP and MySQL. With its help you can create and administrate websites or powerful on-line applications without possessing any special technical skills. Due to the ease of use and flexibility, WordPress has become the most popular platform for website development. <a href="http://wordpress.org/about/" target="_blank">Learn More.</a></p>



<h3>What is a WordPress Template?</h3>

<p>WordPress template is a theme for the WordPress CMS platform. You can easily change your website appearance by installing a new WordPress template in a few easy steps. Despite its simplicity, a WordPress template contains all the necessary source files that can be altered the way you need.</p>

<h3>Template Structure</h3>

<p>The template package includes several folders. Let’s check what’s inside: </p>

<ul class="marked-list">
<p>
<li><b>theme</b> - contains WordPress theme files:
<ul class="marked-list">
<li><strong>child theme_name.zip</strong> - archive with the child theme. Contains child theme's files.
<li><strong>kava.zip</strong> - archive with Kava theme. Contains Kava theme's files.
            <li><strong>manual_install</strong> - contains files that make the WordPress website look like on our live demo.

<ul class="marked-list">

                    <li><strong>uploads</strong> - contains theme images.</li>
                    <li><strong>theme_name.sql</strong> - database file (contains theme content).</li>
                </ul></li></li></ul>
<li><b>documentation.html</b> -  contains documentation link information.</li></p>
<li><b>info.txt</b> -  instructions on how to extract source files.</li></p>
<li><b>license.txt</b> -  contains information about GPL license.</li></p>
</ul>



<h3>Recommended Technical Requirements</h3>

<p>The needed requirements are:</p>
<p>
<ul class="marked-list">
<li>PHP 7 or higher;</li>
<li>MySQL 5.6 of higher;</li>
<li>WP memory limit of 128 Mb or larger;</li>
<li>Desktop device;</li>
<li>SSL certificate on server.</li></ul></p>

<p>You can get more information <a href="https://docs.elementor.com/article/38-requirements
" target="_blank">here.</a></p>




<?php } ?>


<?php if ($project == 'elementortemplate') { ?>

<article><h2>Introduction</h2>

<p>Thank you for purchasing an Elementor Template! This documentation consists of several parts and covers the process of using and installation of Elementor Template.</p>

<h3>What is an Elementor Template?</h3>

<p>Elementor templates are the building blocks which allow you to build outstanding layouts without actually changing the theme, or modifying its files. These templates possess fully responsive design and have an appearance that corresponds design trends and follows their aesthetics. Elementor Templates can be imported and exported via Elementor Library.
</p>
<p>You can always customize a template according to your needs and vision, change its appearance with Elementor builder according to your taste using Elementor widgets, and create your own page structure. This process doesn’t require any web development experience, everything is pretty easy even for beginners.
    </p>


<h3>A Few Words About Elementor Page Builder</h3>

<p><a href="https://elementor.com/?ref=2412&campaign=templatemonster_marketplace" target="_blank"> Elementor page builder</a> is one of the most popular WordPress page builders. It makes it extra easy to create pages, save/use templates, and add your own unique content while having minor development skills.</p>

<p>
Basically, Elementor is a free WordPress plugin, which allows creating pages with fine columns and sections structure and adding the content widgets to the columns to display and showcase different types of content.
</p>
<p>Elementor PRO version possesses more functionality, making it easy to create header & footer templates, archive page templates, etc.</p>

<h3>A Few Words About Jet Family Plugins</h3>
<p><a href="https://www.templatemonster.com/wordpress-elementor-plugins/" target="_blank"> Jet Family plugins</a>, specially developed for Elementor, are meant to make one’s work with the page builder fast and smooth. There are only necessary addons that will extend builder’s capabilities while helping you create all kinds of content. It’s amazing how you can create the tab blocks with the help of a single plugin, without ever learning how to code, or how easy it is to showcase blog posts in eye-catching tiled layouts or handy lists.</p>
<p>
All Jet Family plugins have passed comprehensive QA tests and have a clean UI which is really easy to comprehend and use.</p>

<h3>Template Structure</h3>

<p>Elementor Template package includes several folders. Let’s check what’s inside: </p>

<ul class="marked-list">
<p>
<li><b>templates</b> - a folder, which contains one or several (depending on a particular template) Elementor Template files;
<li><b>template.json</b> - contains Elementor Template;
<li><b>documentation.html</b> - contains documentation link information;
<li><b>license.txt</b> - contains information about GPL license.

</ul>


<?php } ?>


<?php if ($project == 'jeta') { ?>

<article><h2>Introduction</h2>

<p>Thank you for purchasing Jeta Theme! This documentation consists of several parts and covers the entire process of installing and working with Jeta.</p>

<p>Here you can find the following plugins: </p>

<ul class="marked-list">

<li><b>Elementor Plugin</b> - frontend drag & drop page builder;</li>
<li><b>Jet Plugins Wizard</b> - automatic plugins and demos installer plugin;</li>
<li><b>Jet Data Importer</b> - automatic demo content installer plugin;</li>
<li><b>WooCommerce Plugin</b> - online store functionality plugin;</li>
<li><b>Jet Plugins Bundle:</b>
<ul class="marked-list">
<li><a href="http://jetelements.zemez.io/" target="_blank">JetElements;</a></li>
<li><a href="http://jetmenu.zemez.io/" target="_blank">JetMenu;</a></li>
<li><a href="https://jetblocks.zemez.io/" target="_blank">JetBlocks;</a></li>
<li><a href="https://jetblog.zemez.io/" target="_blank">JetBlog;</a></li>
<li><a href="http://documentation.zemez.io/wordpress/index.php?project=crocoblock&lang=en&section=crocoblock-jetthemecore" target="_blank">JetThemeCore;</li>
<li><a href="https://jetwoobuilder.zemez.io/" target="_blank">JetWooBuilder;</a></li>
<li><a href="https://jettricks.zemez.io/" target="_blank">JetTricks;</a></li>
<li><a href="https://jettabs.zemez.io/" target="_blank">JetTabs.</a></li></ul>
</li>
</p></ul>

<h3>Recommended Technical Requirements</h3>

<p>The needed requirements are:</p>
<p>
<ul class="marked-list">
<li>PHP 7 or higher;</li>
<li>MySQL 5.6 of higher;</li>
<li>WP memory limit of 128 Mb or larger;</li>
<li>Desktop device;</li>
<li>SSL certificate on server.</li></ul></p>

<p>You can get more information <a href="https://docs.elementor.com/article/38-requirements
" target="_blank">here.</a></p>

<h3>Software</h3>

<p>Before you start working with Jeta WordPress theme, you should download the required software. You can check the required software on the template preview page:</p>
<p>
<ul class="marked-list">
<li>To edit the source code of the template, you can use code editors like Adobe Dreamweaver, Notepad++, Sublime Text, etc.;</li>
<li>To upload the files to a hosting server, you will need an FTP manager like Total Commander, FileZilla, CuteFTP, etc.</li>
</ul></p>


<p>We also recommend to use the following <b>configuration settings</b>:</p>
<p>
<ul class="marked-list">
<li>50 MB of disk space.</li>
<li>Memory limit per process: 64mb (128mb or more recommended).</li>
</ul></p>



<?php } ?>
<?php if ($project == 'mezo') { ?>

<article><h2>Introduction</h2>

<p>Thank you for purchasing Mezo Theme! This documentation consists of several parts and covers the entire process of installing and working with Mezo.</p>

<p>Here you can find the following plugins: </p>

<ul class="marked-list">

<li><b>Elementor Plugin</b> - frontend drag & drop page builder;</li>
<li><b>Jet Plugins Wizard</b> - automatic plugins and demos installer plugin;</li>
<li><b>Jet Data Importer</b> - automatic demo content installer plugin;</li>
<li><b>WooCommerce Plugin</b> - online store functionality plugin;</li>
<li><b>Jet Plugins Bundle:</b>
<ul class="marked-list">
<li><a href="http://jetelements.zemez.io/" target="_blank">JetElements;</a></li>
<li><a href="http://jetmenu.zemez.io/" target="_blank">JetMenu;</a></li>
<li><a href="https://jetblocks.zemez.io/" target="_blank">JetBlocks;</a></li>
<li><a href="https://jetblog.zemez.io/" target="_blank">JetBlog;</a></li>
<li><a href="http://documentation.zemez.io/wordpress/index.php?project=crocoblock&lang=en&section=crocoblock-jetthemecore" target="_blank">JetThemeCore;</li>
<li><a href="https://jetwoobuilder.zemez.io/" target="_blank">JetWooBuilder;</a></li>
<li><a href="https://jettricks.zemez.io/" target="_blank">JetTricks;</a></li>
<li><a href="https://jettabs.zemez.io/" target="_blank">JetTabs.</a></li></ul>
</li>
</p></ul>

<h3>Recommended Technical Requirements</h3>

<p>The needed requirements are:</p>
<p>
<ul class="marked-list">
<li>PHP 7 or higher;</li>
<li>MySQL 5.6 of higher;</li>
<li>WP memory limit of 128 Mb or larger;</li>
<li>Desktop device;</li>
<li>SSL certificate on server.</li></ul></p>

<p>You can get more information <a href="https://docs.elementor.com/article/38-requirements
" target="_blank">here.</a></p>

<h3>Software</h3>

<p>Before you start working with Mezo WordPress theme, you should download the required software. You can check the required software on the template preview page:</p>
<p>
<ul class="marked-list">
<li>To edit the source code of the template, you can use code editors like Adobe Dreamweaver, Notepad++, Sublime Text, etc.;</li>
<li>To upload the files to a hosting server, you will need an FTP manager like Total Commander, FileZilla, CuteFTP, etc.</li>
</ul></p>


<p>We also recommend to use the following <b>configuration settings</b>:</p>
<p>
<ul class="marked-list">
<li>50 MB of disk space.</li>
<li>Memory limit per process: 64mb (128mb or more recommended).</li>
</ul></p>



<?php } ?>

<?php if ($project == 'jetengine') { ?>

<article><h2>Introduction</h2>

<p>Thank you for purchasing <b>JetEngine</b> for <a href="https://wordpress.org/plugins/elementor/" target="_blank">Elementor</a>. This documentation consists of several parts and covers the entire process of installing and using JetEngine plugin. It describes the process of creating custom post types, custom taxonomies, making templates for them using Elementor page builder and additional widgets for displaying dynamic content, in details.</p>

<p>It also explains the full process of creating custom post and taxonomy layouts.</p>

<h3>What Is JetEngine Plugin?</h3>

<p>JetEngine is a plugin for Elementor, that provides functionality for creating templates for custom post types, taxonomies, and showcasing them in the form of layouts on Elementor-built pages. It also allows creating custom post types, custom taxonomies, as well as custom meta boxes for any kind of content.</p>

<p>With JetEngine it is possible to showcase services, team members, create portfolio layouts without any skills in PHP and CSS.</p>

<p>The plugin also adds 6 special widgets for pulling dynamic content from the posts and displaying it on the pages built with Elementor.</p>

<div class="alert alert-info">
        You have to install and activate <a href="https://wordpress.org/plugins/elementor/" target="_blank">Elementor</a> page builder plugin before using JetEngine! If You haven’t installed Elementor, please, navigate to <a href="https://docs.elementor.com/" target="_blank">Elementor Installation tutorial.</a></div>


<h3>JetEngine Listing Widgets</h3>

<h5>Dynamic Field</h5>

<p><a href="http://documentation.zemez.io/wordpress/index.php?project=jetengine&amp;lang=en&amp;section=jetengine-dynamic-widgets#dynamic-field" target="_blank">Dynamic Field</a> widget is made for displaying the content from both meta fields and the post or term data, for posts and taxonomies listing templates. The widget pulls the data and displays it using the set style and content settings.</p>



<h5>Dynamic Image</h5>

<p><a href="http://documentation.zemez.io/wordpress/index.php?project=jetengine&amp;lang=en&amp;section=jetengine-dynamic-widgets#dynamic-image" target="_blank">Dynamic Image</a> widget privides opportunity to pull the thumbnail image or any other image added as the media in the meta field to showcase it on the pages built with Elementor. This is the dynamic widget that can be easily used for creating templates for custpom post types and taxonomies.</p>


<h5>Dynamic Link</h5>

<p><a href="http://documentation.zemez.io/wordpress/index.php?project=jetengine&amp;lang=en&amp;section=jetengine-dynamic-widgets#dynamic-link" target="_blank">Dynamic Link</a> widget helps in adding the links to the listings, that display the content from the predefined source.</p>

<h5>Dynamic Meta</h5>

<p><a href="http://documentation.zemez.io/wordpress/index.php?project=jetengine&amp;lang=en&amp;section=jetengine-dynamic-widgets#dynamic-meta" target="_blank">Dynamic Meta</a> widget allows displaying the default meta information (usually needed for the posts), such as the publishing date, author and information about comments.</p>

<h5>Dynamic Repeater</h5>

<p><a href="http://documentation.zemez.io/wordpress/index.php?project=jetengine&amp;lang=en&amp;section=jetengine-dynamic-widgets#dynamic-repeater" target="_blank">Dynamic Repeater</a> widget is made for displaying repeating blocks set for the custom post types or taxonomies (this can be done in meta boxes or when you create a meta field and select the Repeater content type).</p>

<h5>Dynamic Terms</h5>

<p><a href="http://documentation.zemez.io/wordpress/index.php?project=jetengine&amp;lang=en&amp;section=jetengine-dynamic-widgets#dynamic-terms" target="_blank">Dynamic Terms</a> widget provides opportunity to add the taxonomies to the custom post types. Use this widget to display the terms that are applied to the needed custom post listing.</p>




</article>



<?php } ?>

<?php if ($project == 'jetguten') { ?>

<article><h2>Introduction</h2>

<p>Thank you for purchasing <b>JetGuten</b> for Gutenberg WordPress editor. </p>

<p>This documentation consists of several parts and covers the entire process of installing and using JetGuten plugin. </p>

<p>Here you can find the description of the installation process, the step-by-step guide to using JetGuten in the Gutenberg editor environment, along with the detailed explanations on how to use the JetGuten widgets and customize widget settings. </p>

<h3>What Is JetGuten</h3>

<p>JetGuten is an addon for Gutenberg WordPress editor. It allows creating and adding more specific content using the set of specific blocks,  to the pages built with Gutenberg. </p>

<h3>JetGuten Widgets</h3>

<h4>Pricing Table</h4>

<p>Pricing Table block will help you display the pricing blocks with all the necessary content added to them using one of the preset styles. You’ll also be able to customize the appearance settings for the pricing blocks, making them suit your general page’s style. </p>

<h4>Banner</h4>

<p>Banner block will assist you in creating banners from your custom images with the most stylish animation effects, to attract attention of the visitors to your links. The widget has 11 effect settings along with the title, description and overlay styles that can be easily changed according to one’s needs. </p>

<h4>Circle Progress</h4>

<p>Circle Progress block is useful for showcasing the current progress of the project, or displaying the rate in percents or to show the proportion from the maximum value. The block provides you with the easy-to-use content settings as well as stylization settings for the circle, value and label blocks. </p>

<h4>Countdown Timer</h4>

<p>Countdown Timer block allows to display the countdown to the set date in the future using the simple countdown that displays the days, hours, minutes and seconds. The block has easily manageable settings, allowing to change the size of the timer, display the separator, change value, label and panel settings.</p>

<h4>Animated Box</h4>

<p>Animated Box block makes it possible to add animated boxes to the pages built with Gutenberg. The block possesses easily changeable animation effects, and the whole set of appearance settings for the back and front sides of the box.</p>

<h4>Map</h4>

<p>Map block is a perfect solution if you’re looking for an easy way to add a Google map to the page built with Gutenberg. The block provides access to the general settings, such as Address, Map or Satellite view, zoom level, etc.</p>

<h4>Progress Bar</h4>

<p>Progress bar block allows adding attractive progress bars to showcase the progress of the process you’re displaying. With this block you’ll be able to change the progress value, change the layout style by selecting one of the 6 styles, and customize the style of the bar.</p>

<h4>Inline SVG</h4>

<p>Inline SVG block provides you with an opportunity to add SVG images without the need to add any extra plugins to WordPress. The block makes it easy to download and display the image that has scalable vector graphics format.</p>

<h4>Image Comparison</h4>

Image Comparison block provides you with an ability to add the two-image block to showcase Before and After state of the object you’re displaying. It has the basic content settings as well as the style settings for the labels, border, etc.

<div class="alert alert-info">
        You have to install and activate <a href="https://wordpress.org/plugins/gutenberg/" target="_blank">Gutenberg</a> WordPress editor before using JetGuten! To learn more about Gutenberg editor, please, feel free to read <a href="https://wordpress.org/gutenberg/handbook/" target="_blank">Gutenberg Handbook</a>.</div>


<?php } ?>

<?php if ($project == 'jetpopup') { ?>

<h2>Introduction</h2>

<p>Thank you for purchasing <b>JetPopup</b> for Elementor page builder. </p>


<p>This documentation consists of several parts and covers the entire process of installing and using JetPopup plugin. </p>

<p>Here you can find the description of the installation process, the step-by-step guide to using JetPopup, along with the detailed explanations on how to create popups using Elementor widgets and customize the trigger events, popup appearance and location. </p>

<h3>What Is JetPopup</h3>

<p>JetPopup is an addon for Elementor live page builder. It allows creating and adding popups to the pages built with Elementor. </p>


<p>With JetPopup you'll be able to create new popups using all widgets avaiable for work when you ordinarily create content with Elementor live page builder. </p>

<p>You'll also have multiple options for adding popups to different widgets, buttons, or displaying them in different parts of the page and customizing popups appearance and location. </p>

<p>With JetPopup you can be sure that you can add any content you need to the popup, and place it where it will be immediately noticed. You'll also be able to make it appear just in time and set the preferable timing for the popup to appear. </p>

<div class="alert alert-info">
        You have to install and activate <a href="https://wordpress.org/plugins/elementor/" target="_blank">Elementor</a> page builder plugin before using JetPopup! If You haven’t installed Elementor, please, navigate to <a href="https://docs.elementor.com/" target="_blank">Elementor Installation tutorial.</a></div>

<h3>JetPopup Functionality</h3>

<p>With JetPopup plugin you'll be able to:

    <ul class="marked-list">
        <p><li>create popup templates with Elementor;</li></p>
        <p><li>attach the popup templates to different widgets and widget's content;</li></p>
        <p><li>set the specific popup triggers;</li></p>
        <p><li>choose the time when the popup appears on the page;</li></p>
        <p><li>change the popup block's appearance and location.</li></p></ul>

<p>Keep reading this documentation to get more precise information on how to create and use popups with JetPopup plugin for Elementor.</p>

<?php } ?>

<?php if ($project == 'monstroid2') { ?>

<article><h2>Introduction</h2>

<p>Thank you for purchasing Monstroid2 theme! This documentation consists of several parts and covers the entire process of installing and setting up a WordPress website from scratch.</p>



<p>Here you can find the following products: </p>

<ul class="marked-list">
<p><li><a href="https://crocoblock.com/kava-pro/" target="_blank"><b>Kava theme</b></a> - the free clean WordPress theme;</li>
<li><b>Kava Child theme</b> - the child Kava theme version;</li>
<li><b>Jet Plugins Wizard</b> - automatic plugins and demos installer plugin;</li>
<li><b>Jet Plugins Bundle:</b>
<ul class="marked-list">
<li><a href="http://jetelements.zemez.io/" target="_blank">JetElements;</a></li>
<li><a href="http://jetmenu.zemez.io/" target="_blank">JetMenu;</a></li>
<li><a href="https://jetblocks.zemez.io/" target="_blank">JetBlocks;</a></li>
<li><a href="https://jetblog.zemez.io/" target="_blank">JetBlog;</a></li>
<li><a href="http://documentation.zemez.io/wordpress/index.php?project=monstroid2&lang=en&section=monstroid2-jetthemecore" target="_blank">JetThemeCore;</li>
<li><a href="https://jetwoobuilder.zemez.io/" target="_blank">JetWooBuilder;</a></li>
<li><a href="https://jettricks.zemez.io/" target="_blank">JetTricks;</a></li>
<li><a href="https://jetreviews.zemez.io/" target="_blank">JetReviews;</a></li>
<li><a href="https://jettabs.zemez.io/" target="_blank">JetTabs.</a></li></ul>
</li>
<li><b>High Quality Image Packs</b> - the image packs on different topics.</li></p></ul>


<p>All the products should be used on the terms on one's pricing plan.</p>


<h3>Recommended Technical Requirements</h3>

<p>The needed requirements are:</p>
<p>
<ul class="marked-list">
<li>PHP 7 or higher;</li>
<li>MySQL 5.6 of higher;</li>
<li>WP memory limit of 128 Mb or larger;</li>
<li>Desktop device;</li>
<li>SSL certificate on server.</li></ul></p>

<p>You can get more information <a href="https://docs.elementor.com/article/38-requirements
" target="_blank">here.</a></p>

<h3>Compatibility with previous version of Monstroid2</h3>
<p>Monstroid2 comes with absolutely upgraded functionality. Now the theme uses Elementor page builder instead of Power Builder. Also, new version of Monstroid2 comes with Jet Family plugins.</p>
<p>If you're using old version of Monstroid2, please check the following tutorial how to transfer your content effortlessly! </p>


<h3>Monstroid2 Videos Playlist</h3>

<p>Feel free to view the video playlist with the presentation of different Monstroid2 services.</p>

<iframe width="750" height="400" src="https://www.youtube.com/embed/videoseries?list=PLdaVCVrkty72g_9pu4-tRJ0j_cc01PqUX" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>



<p>Welcome to Monstroid2!</p>



<?php } ?>
