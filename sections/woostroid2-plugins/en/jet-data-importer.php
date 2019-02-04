<h3>Jet Data Importer</h3>

<p>This plugin will help you export posts, comments, widgets, settings etc., from one site to another. With a single click of a button the plugin generates an XML file that can be imported to another website.</p>

<p>After the installation the plugin adds a new block - <b>Demo Content</b> where you can export or import the content.</p>

<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/cherry-importer-1.png">
    </figure>

 <div class="alert alert-info">
        Note: The images are not exported separately, they are downloaded from the server during the import.</a></div>

Note: The images are not exported separately, they are downloaded from the server during the import.

<h4>File Import</h4>

<p>To import the content, you need to upload the XML file and press <b>Start Import</b>.</p>

<p>Once the import begins you will see a box with progress bars.</p>

<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/cherry-importer-3.png">
    </figure>

<p>After the import is complete you can view the site or customize it.</p>


<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/cherry-importer-4.png">
    </figure>

<h4>File Export</h4>

<p>To export the data, you only need to press an Export button and an XML file will be created automatically.</p>

<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/cherry-importer-5.png">
    </figure>

<h4>Array Structure</h4>

<h6><b>XML importer settings. Features:</b></h6>
<ul class="marked-list">

<li><b>enabled</b> -  enable/disable XML importer;</li>
<li><b>use_upload</b> -  show/hide the files upload form;</li>
<li><b>path</b> -  path to the pre-installed sample-data;</li>
<li><b>import</b> -  import settings;</li>
<li><b>chunk_size</b> -  number of processed items at 1 importing step. The less this number is, the more steps will be during the importing process, and less time will be spent for 1 step. For this reason, it is strongly recommended to reduce this number for the themes with large sample data to avoid problems with importing files on weak servers;</li>
<li><b>remap</b> -  data post-processing settings. Here you need to add keys with posts IDs that can be changed during the import;</li>
<li><b>post_meta</b> -  post metadata settings;</li>
<li><b>term_meta</b> -  terms metadata settings;</li>
<li><b>options</b> -  options.</li></ul>

<h6><b>Export Settings</b></h6>
<ul class="marked-list">
<li><b>message</b> -  message displayed in the export block;</li>
<li><b>logo</b> -  url of the logo displayed in the export block;</li>
<li><b>options</b> -  options array for the additional export.</li>
<li><b>success links</b> -  associative array of links displayed on successful installation page. Link ID is used as a key. The plugin contains IDs for the homepage and for customizer;</li>
<li><b>label</b> -  link text;</li>
<li><b>type</b>. -  type of displayed button (default, primary, success, danger, warning);</li>
<li><b>target</b> -  _balnk, _self;</li>
<li><b>url</b> -  link url.</li></ul>

