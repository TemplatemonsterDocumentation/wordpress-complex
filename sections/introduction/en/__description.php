<?php if ($project != 'jetelements' && $project != 'jetmenu') { ?>
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
                <li>
                    <dl class="inline-term">
                        <dt>
                            <i class="fa fa-folder"></i> <strong>sample_data</strong>
                        </dt>
                        <dd>
                            contains the files that make the WordPress website look like on our live
                            demo.
                        </dd>
                    </dl>

                    <ul>
                         <?php if ($project != 'contractor' && $project != 'stexchange') { ?>
                        <li>
                            <dl class="inline-term">
                                <dt>
                                    <i class="fa fa-file"></i> <strong>sample_data.xml</strong>
                                </dt>
                                <dd>
                                    contains all template sample data (posts, pages, categories, etc).
                                </dd>
                            </dl>
                        </li>
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
<p><li><b>Image Comparison</b> module is the perfect tool that will assist you in creating slides with image comparisons in an attractive and stylish way. From now on you wield the power to showcase the results of your work in an engaging Before and After form! </li></p>
<p><li><b>Images Layout</b> module displays images using different eye-catching layout types, such as Masonry, Justify or List. Add images and customize layouts in several clicks to get the stunning results and adorn Your website pages with beautiful imagery!</li></p>
<p><li><b>Posts</b> module is a multipurpose tool, that can create attractive post grid layouts, sort posts by categories, IDs or the date of publishing. This module is also helpful when creating post sliders and post carousels.</li></p>
<p><li><b>Pricing Table</b> module is helpful beyond measures when you need to showcase the prices and services your company provides in an attractive and clear way. The module has multiple options, versatile customization settings, and is easy to use.</li></p>
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
