<?php if ($project =='cherry_team')

 { ?>
<h2>Cherry Team Members</h2>
<p>
The plugin is specially designed to make it easier for the businesses to display info about their team and personnel. It contains a full set of options and tools that will help adjust the profile in accordance with the skills and the position of the members. Let’s take a closer look at the plugin on the front end.
</p>
<figure class="img-polaroid">
    <img src="projects/<?php echo $project;?>/img/images/frontend.png">
</figure>

    <ul class="marked-list">
        <li>    
            <dl class="inline-term">
                <dt>    
                    Properties
                </dt>
                    <dd>
                        Here you can see all the available posts
                    </dd>
            </dl>
        </li>
        <li>    
            <dl class="inline-term">
                <dt>
                    Types
                </dt>
                    <dd>
                        In this section you can create various real estate types
                    </dd>
            </dl>
        </li>
        <li>    
            <dl class="inline-term">
                <dt>
                    Tags
                </dt>
                    <dd>
                        Add proper tags
                    </dd>
            </dl>
        </li>
        <li>    
            <dl class="inline-term">
                <dt>
                    Features
                </dt>
                    <dd>
                        Add all necessary features to the post
                    </dd>
            </dl>
        </li>
        <li>    
            <dl class="inline-term">
                <dt>
                    Settings
                </dt>
                    <dd>
                        Here you can find all the settings  for the plugin
                    </dd>
            </dl>
        </li>   
    </ul>
<?php } ?>



<?php if ($project =='cherry_services')

 { ?>

<h2>Cherry Services</h2>
<p>
Cherry Search can be useful for any business website whether it is large or small. It will help you to list all services you provide in an attractive and structured way. Thanks to a number of options and settings the plugin can be customized in accordance with the style and specification of your business. 
</p>
<figure class="img-polaroid">
    <img src="projects/<?php echo $project;?>/img/images/frontend.png">
</figure>

<p>
    Before integrating the plugin into your theme you need to make several minor adjustments to avoid problems with layout. So, follow the instructions listed below:
</p>
<h3>Installation</h3>
    <ul class="marked-list">
        <li>    
            <dl class="inline-term">
                <dt>    
                    Create a cherry-services folder in the root folder of your theme
                </dt>
            </dl>
        </li>
        <li>    
            <dl class="inline-term">
                <dt>
                    Copy archive-services.php and single-services.php files from the templates folder of the plugin to the cherry-services folder 
                </dt>
            </dl>
        </li>
        <li>    
            <dl class="inline-term">
                <dt>
                    Open each of the copied files and delete function calls get_header( 'services' ); and get_footer( 'services' )
                </dt>
            </dl>
        </li>
    </ul>
<?php } ?>

<?php if ($project =='cherry_installer')

 { ?>
 <h3>Cherry Installer</h3>

<p>
    The plugin will help you export posts, comments, widgets, settings etc., from one site to another. With a single click of a button the plugin generates an XML file that can be imported to another website. 
</p>

<p>After the installation the plugin adds a new block - <strong>Demo Content</strong> where you can export or import the content.</p>


<figure class="img-polaroid">
    <img src="img/plugins/cherry-importer-1.png" alt="">
</figure>
<div class ="alert alert-info">
    Note: The images are not exported separately, they are downloaded from the server during the import. 
</div>

<h4>
File Import
</h4>
<p>
    To import the content, you need to upload the XML file and press “Start Import”. 
</p>
<figure class="img-polaroid">
    <img src="img/plugins/cherry-importer-2.png" alt="">
</figure>

<p>
    Once the import begins you will see a box with progress bars. 
</p>

<figure class="img-polaroid">
    <img src="img/plugins/cherry-importer-3.png" alt="">
</figure>

<p>
    After the import is complete you can view the site or customize it. 
</p>
<figure class="img-polaroid">
    <img src="img/plugins/cherry-importer-4.png" alt="">
</figure>

<h4>
File Export
</h4>
<p>
    To export the data, you only need to press an Export button and an XML file will be created automatically. 
</p>
<figure class="img-polaroid">
    <img src="img/plugins/cherry-importer-5.png" alt="">
</figure>

<h4>Array Structure </h4>

<p>
    <strong>xml - XML importer settings. Features:</strong>
</p>

<ul class="marked-list">
    <li>
        <dl class="inline-term">
            <dt>enabled </dt>
            <dd>
                Enable/disable XML importer
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>use_upload </dt>
            <dd>
                Show/hide the files upload form
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>path  </dt>
            <dd>
                 Path to the pre-installed sample-data 
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>import </dt>
            <dd>
               Import settings
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>chunk_size</dt>
            <dd>
               Number of  processed items at 1 importing step. The less this number is, the more steps will be during the importing process, and less time will be spent for 1 step.  For this reason, it is strongly recommended to reduce this number for the themes with large sample data to avoid problems with importing files on weak servers. 
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>remap </dt>
            <dd>
               Data post-processing settings. Here you need to add keys with posts IDs that can be changed during the import. 
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>post_meta</dt>
            <dd>
               Post metadata settings. 
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>term_meta </dt>
            <dd>
               Terms metadata settings.
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>options </dt>
            <dd>
               Options.
            </dd>
        </dl>
    </li>
</ul>

<p>
    <strong>export - Export Settings</strong>
</p>

<ul class="marked-list">
    <li>
        <dl class="inline-term">
            <dt>message </dt>
            <dd>
               Message displayed in the export block. 
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>logo </dt>
            <dd>
               URL of the logo displayed in the export block. 
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>options </dt>
            <dd>
               Options array for the additional export.
            </dd>
        </dl>
    </li>
</ul>


<p>
    <strong>success-links - associative array of links displayed on successful installation page. Link ID is used as a key. The plugin contains IDs for  the homepage and for customizer: 
</strong>
</p>

<ul class="marked-list">
    <li>
        <dl class="inline-term">
            <dt>label </dt>
            <dd>
                Link text.
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>type </dt>
            <dd>
               Type of displayed button (default, primary, success, danger, warning). 

            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>target </dt>
            <dd>
               _balnk, _self
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>url </dt>
            <dd>
               Link URL.
            </dd>
        </dl>
    </li>
</ul>
<?php } ?>



<?php if ($project =='cherry_trending_posts')

 { ?>

<h2>Cherry Trending Posts</h2>
 <p>
     This plugin will allow you to add trending posts to the website. Thanks to an assortment of options and settings you can customize the posts the way you like without digging into long lines of code. 
 </p>

<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/images/frontend.png">
    </figure>
 <h4>Plugin functionality:</h4>

 <ul class="marked-list">
    <li>
        <dl class="inline-term">
            <dt>Post views counter </dt>
            <dd>
                Allows to display a views counter on the page, so you and the users could see which of the posts if the most popular
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Post ratings </dt>
            <dd>
                Add counters  to the posts and allow users to rate them generating more trust to your blog
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Widget </dt>
            <dd>
                Add Trending posts anywhere to your page with a single click of a mouse
            </dd>
        </dl>
    </li>
</ul>

<h3>How to use</h3>
<p>
 It is not enough to install and activate the plugin to make it work properly. You also need to add 2 actions to the template.     
</p>
 <ul class="marked-list">
    <li>
        <dl class="inline-term">
            <dt>do_action( 'cherry_trend_posts_display_rating' ) / do_action( 'cherry_trend_posts_return_rating' ) - display / return HTML for ratings </dt>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>do_action( 'cherry_trend_posts_display_views' ) / do_action( 'cherry_trend_posts_return_views' ) display / return HTML for post views counter </dt>

        </dl>
    </li>
</ul>
<figure class="img-polaroid">
    <img src="projects/<?php echo $project;?>/img/images/code.png">
</figure>

<?php } ?>


<?php if ($project =='cherry_search')

 { ?>

<h2>Cherry Search</h2>
 <p>
    This plugin allows you to send search queries without reloading the page via AJAX technology. In this way, users can find any information they are interested in quickly and easily. Thanks to a full range of settings, you can customize the functionality of the plugin the way you need.
 </p>

<figure class="img-polaroid">
    <img src="projects/<?php echo $project;?>/img/images/frontend-1.png">
</figure>

 <p>
     The plugin is multilingual, so you can install it on any website, no matter on what language it is. WooCommerce themes work perfectly with this plugin as well. No need to change the code, simply install Cherry Search and enjoy a brand new functionality of your store.
 </p>
<figure class="img-polaroid">
    <img src="projects/<?php echo $project;?>/img/images/frontend-2.png">
</figure>
<h3>You can add Cherry Search in several ways</h3>

<ol class="index-list">
    <li>Enable a "Replace the standard search" option</li>
    <li>Add Cherry Search using this shortcode [cherry_search_form]</li>
    <li>Add PHP code to the necessary files of your theme:if ( function_exists( 'cherry_get_search_form' ) ) { cherry_get_search_form(); }</li>
</ol>
<?php } ?>
