<h3>Cherry Data Importer</h3>

<p>
	This plugin will help you export posts, comments, widgets, settings etc., from one site to another. With a single click of a button the plugin generates an XML file that can be imported to another website. 
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

<h4>
Customizing plugin for a specific template
</h4>
<pre class="unstyled" style= "background-color:#cecece; padding:20px 20px 20px 100px";>
	?php
/**
 * Default manifest file
 *
 * @var array
 */
$settings = array(
    'xml' => array(
        'enabled'    => true,
        'use_upload' => true,
        'path'       => false,
    ),
    'import' => array(
        'chunk_size' => $this->chunk_size,
    ),
    'remap' => array(
        'post_meta' => array(),
        'term_meta' => array(),
        'options'   => array(),
    ),
    'export' => array(
        'message' => __( 'or export all content with TemplateMonster Data Export tool', 'cherry-data-importer' ),
        'logo'    => $this->url( 'assets/img/monster-logo.png' ),
        'options' => array(),
    ),
    'success-links' => array(
        'home' => array(
            'label'  => __( 'View your site', 'cherry-data-importer' ),
            'type'   => 'primary',
            'target' => '_self',
            'url'    => home_url( '/' ),
        ),
        'customize' => array(
            'label'  => __( 'Customize your theme', 'cherry-data-importer' ),
            'type'   => 'default',
            'target' => '_self',
            'url'    => admin_url( 'customize.php' ),
        ),
    ),
);

</pre>

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