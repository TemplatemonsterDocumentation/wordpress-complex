
<h3>Header</h3>
<p>You can set header items here</p>

<!--
<figure class="img-polaroid">
    <img src="img/tm/customizer/.png" alt="" >
</figure>
-->

<h5>Header Styles</h5>

<ul class="marked-list">


<?php if ($project == 'monstroid_2' ) { ?>
    <li>
        <dl class="inline-term">
            <dt>Layout</dt>
            <dd>
                Here you can select site style layout
            </dd>
        </dl>
    </li>

    <li>
        <dl class="inline-term">
            <dt>Header Overlay</dt>
            <dd>
                Enable/disable header overlay
            </dd>
        </dl>
    </li>

    <li>
        <dl class="inline-term">
            <dt>Enable invert color scheme</dt>
            <dd>
                Enable/disable invert color scheme
            </dd>
        </dl>
    </li>

<?php } ?> 


    <li>
        <dl class="inline-term">
            <dt>Background Color</dt>
            <dd>
                Here you can define site header background color
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Background Image</dt>
            <dd>
            	Here you can define site header background image
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Background Repeat</dt>
            <dd>
                This property sets if a background image will be repeated, or not. By default, a background-image is repeated both vertically and horizontally
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Background Position</dt>
            <dd>
                This property sets the starting position of a background image. By default, a background-image is placed at the top-left corner
            </dd>
        </dl>
    </li>

    <li>
        <dl class="inline-term">
            <dt>Background Attachment</dt>
            <dd>
                This property sets whether a background image is fixed or scrolls with the rest of the page. By default, a background attachment is scroll
            </dd>
        </dl>
    </li>


<!-------------------------------------
On/Off Currency
---------------------------------------->

<?php if ($project == 'talisman' ) { ?>

    <li>
        <dl class="inline-term">
            <dt>On/Off Currency Switcher </dt>
                <dd>
                    Enable/disable Currency Switcher
                </dd>
        </dl>
    </li>
<?php } ?> 



<!-------------------------------------
 Disclaimer
---------------------------------------->
<?php if ($project == 'tradex') { ?>

    <li>
        <dl class="inline-term">
            <dt>Disclaimer Text</dt>
            <dd>
                Here you can define header top panel text content
            </dd>
        </dl>
    </li>
<?php } ?> 


<!-------------------------------------
search  Disclaimer
---------------------------------------->

<?php if ($project != 'mechanna' && $project != 'advisto' && $project != 'cleaningpro' && $project != 'posh' && $project != 'confucius' && $project != 'plumberpro' && $project != 'madeleine' && $project != 'grannali' && $project != 'chateau' && $project != 'bellatoi' && $project != 'shanti' && $project != 'jorden'  && $project != 'teddy' &&  $project != 'lawpress' && $project != 'talisman' && $project != 'timberline' && $project != 'pettown' && $project != 'greenville' && $project != 'duval' && $project != 'keypress' && $project != 'crystalica' && $project != 'penn' && $project != 'leonardo' && $project != 'porto' && $project != 'odyssey' && $project != 'ecolife' && $project != 'hidalgo' && $project != 'happylearning'  && $project != 'mohican' && $project != 'helios' && $project != 'sportlabs' && $project != 'fleek' && $project != 'roadway' && $project != 'tradex'  && $project != 'italica' && $project != 'gutenberg' && $project != 'knox' && $project != 'gaze' && $project != 'techlab' && $project != 'organica' && $project != 'infobyte' && $project != 'transit' && $project != 'jericho' && $project != 'walden' && $project != 'chefplaza' && $project != 'agrilloc' && $project != 'monstroid_2') { ?>
    <li>
        <dl class="inline-term">
            <dt>Enable search</dt>
            <dd>
                Enable/disable search
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Disclaimer Text</dt>
            <dd>
                Here you can define header top panel text content
            </dd>
        </dl>
    </li>
<?php } ?>

<?php if ($project == 'walden' or $project == 'monstroid_2') { ?>
    <li>
        <dl class="inline-term">
            <dt>Enable search</dt>
            <dd>
                Enable/disable search
            </dd>
        </dl>
    </li>
<?php } ?>


<?php if ($project == 'monstroid_2') { ?>
    <li>
        <dl class="inline-term">
            <dt>Show woocommerce elements</dt>
            <dd>
                Show/hide woocommerce elements
            </dd>
        </dl>
    </li>

    <li>
        <dl class="inline-term">
            <dt>Header call to action button</dt>
            <dd>
                Here you can set header call to action button text and url 
            </dd>
        </dl>
    </li>

    <li>
        <dl class="inline-term">
            <dt>Show header call to action button</dt>
            <dd>
                Show/hide header call to action button
            </dd>
        </dl>
    </li>
<?php } ?>  


<!-------------------------------------
Phone  Time
---------------------------------------->

<?php if ($project == 'plumberpro' ) { ?>
    <li>
        <dl class="inline-term">
            <dt>Phone Text </dt>
                <dd>
                    Specify the Phone section text
                </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Time Text </dt>
                <dd>
                    Specify the Time section text
                </dd>
        </dl>
    </li>
<?php } ?>      

<!-------------------------------------
TOP PANEL START
---------------------------------------->

<h5>Top Panel</h5>
<p> You can set header top panel here.</p>


<?php if ( $project == 'monstroid_2') { ?>
    <li>
        <dl class="inline-term">
            <dt>Enable top panel</dt>
            <dd>
                Enable/disable top panel
            </dd>
        </dl>
    </li>
<?php } ?>  


<?php if ($project =='walden') { ?>
<ul class="marked-list">
    <li>
        <dl class="inline-term">
            <dt>Primary Text</dt>
            <dd>
                Here you can write a primary text
            </dd>
        </dl>
    </li>

    <li>
        <dl class="inline-term">
            <dt>Secondary text</dt>
            <dd>
                Here you can write a secindary text
            </dd>
        </dl>
    </li>

    <li>
        <dl class="inline-term">
            <dt>Enable secondary text link</dt>
            <dd>
                Enable/disable secondary text link 
            </dd>
        </dl>
    </li>

    <li>
        <dl class="inline-term">
            <dt>Secondary text link</dt>
            <dd>
                Here you can select a link of the secondary text 
            </dd>
        </dl>
    </li>

    <li>
        <dl class="inline-term">
            <dt>Enable icon secondary text</dt>
            <dd>
                Enable/disable icon secondary text  
            </dd>
        </dl>
    </li>

    <li>
        <dl class="inline-term">
            <dt>Icon for secondary text</dt>
            <dd>
                Here you can select an icon for the secondary text 
            </dd>
        </dl>
    </li>

     <li>
        <dl class="inline-term">
            <dt>Enable currency switcher </dt>
                <dd>
                    Enable/disable currency switcher
                </dd>
        </dl>
    </li>
     <li>
        <dl class="inline-term">
            <dt>Background color</dt>
                <dd>
                    Here you can define header top panel background color
                </dd>
        </dl>
    </li>
</ul>
<?php } ?>


<ul class="marked-list">

<!-------------------------------------
Disclaimer
---------------------------------------->

<?php if ( $project != 'advisto' && $project != 'fenimore' && $project != 'nolan' &&  $project != 'lawpress' && $project != 'ecolife' && $project != 'tradex' && $project != 'walden') { ?>
    <li>
        <dl class="inline-term">
            <dt>Disclaimer Text</dt>
                <dd>
                    Here you can define header top panel text content
                </dd>
        </dl>
    </li>
<?php } ?>  


<!-------------------------------------
Enable search
---------------------------------------->

<?php if ($project == 'wildride' or $project == 'bettaso' or $project == 'mechanna' or $project == 'advisto' or $project == 'confucious' or $project == 'fenimore' or $project == 'durand' or $project == 'shanti' or $project == 'nolan' or $project == 'jorden' or $project == 'fuel' or $project == 'pokemania' or $project == 'legacy' or  $project == 'lawpress' or  $project == 'talisman' or $project == 'duval' or $project == 'keypress' or $project == 'crystalica' or $project == 'penn' or $project == 'leonardo' or $project == 'porto' or $project == 'odyssey' or $project == 'chopchop' or $project == 'tanaka' or $project == 'ecolife' or $project == 'hidalgo' or $project == 'happylearning' or $project == 'mizrahi' or $project == 'redhotgrill' or $project == 'roadway' or $project == 'tradex' or $project == 'italica' or $project == 'mohican' or $project == 'gutenberg' or $project == 'knox' or $project == 'gaze' or $project == 'techlab' or $project == 'organica' or $project == 'infobyte' or $project == 'transit' or $project == 'agrilloc') { ?>
    <li>
        <dl class="inline-term">
            <dt>Enable search</dt>
                <dd>
                    Show / Hide search form in top header part
                </dd>
        </dl>
    </li>
<?php } ?>    

  
<!-------------------------------------
Enable search   On/Off Currency
---------------------------------------->

<?php if ($project == 'posh' or  $project == 'grannali' or $project == 'bellatoi' or $project == 'teddy' or $project == 'chefplaza') { ?>
    <li>
        <dl class="inline-term">
            <dt>Enable search</dt>
                <dd>
                    Show / Hide search form in top header part
                </dd>
        </dl>
    </li>

    <li>
        <dl class="inline-term">
            <dt>On/Off Currency Switcher </dt>
                <dd>
                    Enable/disable Currency Switcher
                </dd>
        </dl>
    </li>
<?php } ?>   


<!-------------------------------------
Background color
---------------------------------------->

<?php if ( $project != 'hidalgo' && $project != 'walden' ) { ?>
    <li>
        <dl class="inline-term">
            <dt>Background color</dt>
                <dd>
                    Here you can define header top panel background color
                </dd>
        </dl>
    </li>
<?php } ?>   

<?php if ( $project == 'bellaina' or $project == 'homepro' ) { ?>
    <li>
        <dl class="inline-term">
            <dt> Enable login form </dt>
                <dd>
                    Enable/disable login form
                </dd>
        </dl>
    </li>
<?php } ?> 


<!-------------------------------------
Enable Top Menu
---------------------------------------->

<?php if ( $project == 'monstroid_2' ) { ?>
    <li>
        <dl class="inline-term">
            <dt> Enable top menu </dt>
                <dd>
                    Enable/disable top menu
                </dd>
        </dl>
    </li>
<?php } ?> 
<!-------------------------------------
On/Off Currency
---------------------------------------->

<?php if ($project == 'timberline' or $project == 'pettown' or $project == 'greenville' or $project == 'helios' or $project == 'sportlabs' or $project == 'techlab') { ?>

    <li>
        <dl class="inline-term">
            <dt>On/Off Currency Switcher </dt>
                <dd>
                    Enable/disable Currency Switcher
                </dd>
        </dl>
    </li>
    
<?php } ?> 
<!-------------------------------------
Display Top Panel
---------------------------------------->  


  
<?php if ($project == 'bitnews') { ?>
        <li>
            <dl class="inline-term">
                <dt>Display Top Panel</dt>
                    <dd>
                        Show/hide top panel
                    </dd>
            </dl>
        </li>
<?php } ?>


<!-------------------------------------
Show social links in top panel   Enable search<
---------------------------------------->  

<?php if ($project == 'fiona' or $project == 'plumberpro'  or $project == 'jericho' ) { ?>
    <li>
        <dl class="inline-term">
            <dt>Show social links in top panel </dt>
                <dd>
                    Show / Hide social links in top panel
                </dd>
        </dl>
    </li>
    
    <li>
        <dl class="inline-term">
            <dt>Enable search</dt>
                <dd>
                    Show / Hide search form in top header part
                </dd>
        </dl>
    </li>
<?php } ?> 

<!-------------------------------------
Show social links in top panel   Enable search<
---------------------------------------->  


<?php if ($project == 'madeleine' or $project == 'focussity' ) { ?>
    <li>
        <dl class="inline-term">
            <dt>Enable search</dt>
                <dd>
                    Show / Hide search form in top header part
                </dd>
        </dl>
    </li>
<?php } ?>    
<?php if ($project == 'cleaningpro' or $project == 'focussity' or $project == 'chateau' ) { ?>
    <li>
        <dl class="inline-term">
            <dt>Show social links in top panel </dt>
                <dd>
                    Show / Hide social links in top panel
                </dd>
        </dl>
    </li>
<?php } ?>  

</ul>


<!-------------------------------------
TOP PANEL END
---------------------------------------->



<?php if ($project == 'bettaso' or $project == 'confucius' or $project == 'jorden' or $project == 'duval' or $project == 'hidalgo' or $project == 'mizrahi' or $project == 'redhotgrill' or $project == 'italica' or $project == 'transit')  { ?>
    
<h5>Showcase Panel </h5>
<p>
    Configure the showcase panel settings.
</p>
    <ul class="marked-list">
        <li>
            <dl class="inline-term">
                <dt>Header showcase title</dt>
                    <dd>
                        Specify the title
                    </dd>
            </dl>
        </li>

<?php if ($project != 'transit') { ?>
        <li>
            <dl class="inline-term">
                <dt>Header showcase subtitle</dt>
                    <dd>
                        Specify the subtitle
                    </dd>
            </dl>
        </li>
<?php } ?> 
        
        <li>
            <dl class="inline-term">
                <dt>Header showcase description</dt>
                    <dd>
                        Enter the header showcase description
                    </dd>
            </dl>
        </li>

        <li>
            <dl class="inline-term">
                <dt>Header showcase button text</dt>
                    <dd>
                        Specify the showcase button text
                    </dd>
            </dl>
        </li>

        <li>
            <dl class="inline-term">
                <dt>Header showcase button url</dt>
                    <dd>
                        Specify the header showcase button url
                    </dd>
            </dl>
        </li>

        <li>
            <dl class="inline-term">
                <dt>Background Image</dt>
                    <dd>
                        Choose the background image
                    </dd>
            </dl>
        </li>

        <li>
            <dl class="inline-term">
                <dt>Background Color</dt>
                    <dd>
                        Choose the background color
                    </dd>
            </dl>
        </li>

        <li>
            <dl class="inline-term">
                <dt>Background Repeat</dt>
                    <dd>
                        Choose the background repeat type
                    </dd>
            </dl>
        </li>

        <li>
            <dl class="inline-term">
                <dt>Background Position</dt>
                    <dd>
                        Choose the background position
                    </dd>
            </dl>
        </li>

        <li>
            <dl class="inline-term">
                <dt>Background Attachment</dt>
                    <dd>
                        Choose the background attavhment type
                    </dd>
            </dl>
        </li>

        <li>
            <dl class="inline-term">
                <dt>Color Image Mask</dt>
                    <dd>
                        Choose the color image mask
                    </dd>
            </dl>
        </li>

        <li>
            <dl class="inline-term">
                <dt>Opacity Image Mask</dt>
                    <dd>
                        Specify the opacity image mask
                    </dd>
            </dl>
        </li>

        <li>
            <dl class="inline-term">
                <dt>Showcase title color</dt>
                    <dd>
                        Select the title color
                    </dd>
            </dl>
        </li>

<?php if ($project != 'transit') { ?>
        <li>
            <dl class="inline-term">
                <dt>Showcase subtitle color</dt>
                    <dd>
                        Select subtitle color
                    </dd>
            </dl>
        </li>
<?php } ?>
        
        <li>
            <dl class="inline-term">
                <dt>Showcase description color</dt>
                    <dd>
                        Select description color
                    </dd>
            </dl>
        </li>
<?php } ?>


<h5>Header Contact Block</h5>
<ul class="marked-list">

<?php if ($project == 'monstroid_2') { ?>
    <li>
        <dl class="inline-term">
            <dt>Show header conract block</dt>
            <dd>
                Show/hide footer contact block
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Contact item 1</dt>
            <dd>
                Here you can set a contact icon and contact information
            </dd>
        </dl>
        <ul class="marked-list">
            <li>
                <strong>Label</strong> – Contact name
            </li>
            <li>
                <strong>Value</strong> – Contact content
            </li>
        </ul>
    </li>
    
    <li>
        <dl class="inline-term">
            <dt>Contact item 1</dt>
            <dd>
                Here you can set a contact icon and contact information
            </dd>
        </dl>
        <ul class="marked-list">
            <li>
                <strong>Label</strong> – Contact name
            </li>
            <li>
                <strong>Value</strong> – Contact content
            </li>
        </ul>
    </li>

   <li>
        <dl class="inline-term">
            <dt>Contact item 1</dt>
            <dd>
                Here you can set a contact icon and contact information
            </dd>
        </dl>
        <ul class="marked-list">
            <li>
                <strong>Label</strong> – Contact name
            </li>
            <li>
                <strong>Value</strong> – Contact content
            </li>
        </ul>
    </li>
<?php } ?>  
</ul>


<h5>Main Menu</h5>

<p>You can configure main navigation menu here.</p>

<ul class="marked-list">

<?php if ($project == 'knox' or $project == 'gaze' or $project == 'techlab' or $project == 'organica' or $project == 'infobyte' or $project == 'transit' or $project == 'jericho' or $project == 'walden' or $project == 'chefplaza' or $project == 'agrilloc' or $project == 'monstroid_2') { ?>
    <li>
        <dl class="inline-term">
            <dt>Enable sticky menu </dt>
            <dd>
                Enable/disable fixed stick-to-top main menu
            </dd>
        </dl>
    </li>
<?php } ?> 


<?php if ($project == 'confucius' or $project == 'hidalgo' or $project == 'italica' or $project == 'gutenberg' or $project == 'monstroid_2') { ?>
    <li>
        <dl class="inline-term">
            <dt>Enable item description</dt>
            <dd>
                Enable/disable item description
            </dd>
        </dl>
    </li>
<?php } ?> 

<?php if ($project == 'cleaningpro' or $project == 'madeleine' or $project == 'chateau' or $project == 'builderry' or $project == 'bellaina' or $project == 'machinist' or $project == 'cascade' or $project == 'paintelle' or $project == 'homepro' ) { ?>

    <li>
        <dl class="inline-term">
            <dt>Enable search</dt>
                <dd>
                    Show / Hide search form in the main menu
                </dd>
        </dl>
    </li>
<?php } ?> 


<?php if ($project != 'confucius' && $project != 'hidalgo' && $project != 'italica' && $project != 'gutenberg' && $project != 'knox' && $project != 'monstroid_2') { ?>
    <li>
        <dl class="inline-term">
            <dt>Enable title attributes</dt>
            <dd>
                Show / Hide search form in header top panel
            </dd>
        </dl>
    </li>
<?php } ?> 


<?php if ($project == 'monstroid_2') { ?>
    <li>
        <dl class="inline-term">
            <dt>More menu button type</dt>
            <dd>
                Here you can select button type
            </dd>
        </dl>
    </li>

     <li>
        <dl class="inline-term">
            <dt>More menu button text</dt>
            <dd>
                Here you can type menu button text
            </dd>
        </dl>
    </li>
<?php } ?> 


<?php if ($project == 'neurion' or  $project == 'waylard' or  $project == 'bettaso' or  $project == 'mechanna' or  $project == 'advisto' or  $project == 'confucius' or  $project == 'fenimore' or $project == 'builderry' or  $project == 'lawpress' or $project == 'keypress' or $project == 'crystalica' or $project == 'penn' or $project == 'leonardo' or $project == 'porto' or $project == 'odyssey' or $project == 'addison' or $project == 'ecolife' or $project == 'happylearning' or $project == 'mizrahi' or $project == 'redhotgrill' or $project == 'arlo' or $project == 'machinist' or $project == 'cascade' or $project == 'paintelle' or $project == 'salvatoro'  or $project == 'callum' or $project == 'roadway' or $project == 'tradex' or $project == 'italica' or $project == 'gaze' or $project == 'techlab' or $project == 'transit' or $project == 'jericho' or $project == 'chefplaza' or $project == 'agrilloc') { ?>
    <li>
        <dl class="inline-term">
            <dt>Hidden menu items title</dt>
            <dd>
                Enter the title for hidden items
            </dd>
        </dl>
    </li>
<?php } ?>  


<?php if ($project == 'bellaina' or $project == 'homepro' or $project == 'gutenberg') { ?>
    <li>
        <dl class="inline-term">
            <dt>More Menu Button Type</dt>
            <dd>
                Specify the More button type
            </dd>
        </dl>
    </li>
     <li>
        <dl class="inline-term">
            <dt>More Menu Button Text</dt>
            <dd>
                Enter the More menu button text
            </dd>
        </dl>
    </li>
<?php } ?>  
</ul>