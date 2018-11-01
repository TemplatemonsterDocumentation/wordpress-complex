<h3>Jet Data Importer</h3>


<p>This plugin will help you export posts, comments, widgets, settings etc., from one site to another. With a single click of a button the plugin generates an XML file that can be imported to another website.</p>

	<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/bitunet/imp1.png">
  	</figure>


<p>You'll see the notice offering you either append or replace demo content.</p>

<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/bitunet/imp2.png">
  	</figure>

 <p>Enter your dashboard password to continue. Click <b>Import Content</b></p>

<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/bitunet/imp3.png">
  	</figure>


  <p>Once the import begins you will see a box with progress bars.</p>

  <figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/bitunet/imp4.png">
  	</figure>

  	 <figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/bitunet/imp5.png">
  	</figure>

<p>Import is finished.</p>

<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/bitunet/imp5-1.png">
  	</figure>

 <div class="alert alert-info">
        Note: The images are not exported separately, they are downloaded from the server during the import.</div>

<h5>File Import</h5>

<p>To import the content, you need to upload the XML file and press <b>Start Import</b>.</p>


<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/bitunet/imp6.png">
  	</figure>

<p>After the import is complete you can view the site or customize it.</p>

<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/bitunet/imp7.png">
  	</figure>


   

<h5>File Export</h5>

<p>To export the data, you only need to press an Export button and an XML file will be created automatically.</p>

<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/bitunet/imp8.png">
  	</figure>

<h5>Array Structure</h5>
<p>XML importer settings. Features:</p>

<ul>
    <li>
        <dl class="inline-term">
            <dt>enabled</dt>
            <dd>
                enable/disable XML importer;
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>use_upload</dt>
            <dd>
                show/hide the files upload form;
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>path</dt>
            <dd>
                path to the pre-installed sample-data;
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>import</dt>
            <dd>
               import settings;
            </dd>
        </dl>
    </li>
       <li>
        <dl class="inline-term">
            <dt>chunk_size</dt>
            <dd>
               number of processed items at 1 importing step. The less this number is, the more steps will be during the importing process, and less time will be spent for 1 step. For this reason, it is strongly recommended to reduce this number for the themes with large sample data to avoid problems with importing files on weak servers;
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>remap</dt>
            <dd>
              data post-processing settings. Here you need to add keys with posts IDs that can be changed during the import;
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>post_meta</dt>
            <dd>
              post metadata settings;
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>term_meta</dt>
            <dd>
              terms metadata settings;
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>options</dt>
            <dd>
              options.
            </dd>
        </dl>
    </li></ul>

    <p>Export Settings:</p>

<ul>
    <li>
        <dl class="inline-term">
            <dt>message</dt>
            <dd>
                message displayed in the export block;
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>logo</dt>
            <dd>
                url of the logo displayed in the export block;
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>options</dt>
            <dd>
                options array for the additional export;
            </dd>
        </dl>
    </li>
     <li>
        <dl class="inline-term">
            <dt>success links</dt>
            <dd>
                associative array of links displayed on successful installation page. Link ID is used as a key. The plugin contains IDs for the homepage and for customizer;
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>label</dt>
            <dd>
                link text;
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>type</dt>
            <dd>
                type of displayed button (default, primary, success, danger, warning);
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>target</dt>
            <dd>
                _balnk, _self;
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>url</dt>
            <dd>
                link url.
            </dd>
        </dl>
    </li></ul>