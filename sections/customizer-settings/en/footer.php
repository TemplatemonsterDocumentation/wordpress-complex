
<h3>Footer</h3>
<p>Settings for the website footer section</p>

<!--
<figure class="img-polaroid">
    <img src="img/tm/customizer/.png" alt="" >
</figure>
-->

<h5>Footer Styles</h5>
<ul class="marked-list">
<?php if ($project != 'smarthouse' && $project != 'knox' && $project != 'emanuella' && $project != 'glossylook' && $project != 'calio' && $project != 'guillermo' && $project != 'delicia' && $project != 'itideas' && $project != 'hotelbliss' && $project != 'propello') { ?>
    <li>
        <dl class="inline-term">
            <dt>Logo upload</dt>
            <dd>
                Select your main footer logo to be an image. You must choose a logo image from the media library in the next option
            </dd>
        </dl>
    </li>
<?php } ?>    
    <li>
        <dl class="inline-term">
            <dt>Copyright text</dt>
            <dd>
            	Set custom copyright text for your Footer area
            </dd>
        </dl>
    </li>

<?php if ($project == 'mohican') { ?>
    <li>
        <dl class="inline-term">
            <dt>Text center</dt>
            <dd>
                Write text for footer area
            </dd> 
        </dl>
    </li>
<?php } ?>  

<?php if ($project == 'gaze' or $project == 'infobyte') { ?>
    <li>
        <dl class="inline-term">
            <dt>Footer text</dt>
            <dd>
                Write text for footer area
            </dd> 
        </dl>
    </li>
<?php } ?> 

<?php if ($project != 'infobyte' && $project != 'glossylook') { ?>
    <li>
        <dl class="inline-term">
            <dt>Widget Area Columns</dt>
            <dd>
                Here you can set a number of columns for site widgets, 1 to 4
            </dd>
        </dl>
    </li>
<?php } ?>   

    <li>
        <dl class="inline-term">
            <dt>Layout</dt>
            <dd>
                Here you can define the footer layout type
            </dd>
        </dl>
    </li>

<?php if ($project != 'monstroid_2' && $project != 'emanuella' && $project != 'calio' && $project != 'guillermo' && $project != 'itideas' && $project != 'hotelbliss' && $project != 'propello') { ?>
    <li>
        <dl class="inline-term">
            <dt>Footer Widgets Area color</dt>
            <dd>
                Here you can define the Widget Area background color
            </dd>
        </dl>
    </li>
<?php } ?> 
    
    <li>
        <dl class="inline-term">
            <dt>Footer Background color</dt>
            <dd>
                Here you can define the Footer Area background color
            </dd>
        </dl>
    </li>
 

 <?php if ($project == 'greenfield') { ?>
    <li>
        <dl class="inline-term">
            <dt>Footer Widgets Background color</dt>
            <dd>
                Here you can define the Footer Widget background color
            </dd>
        </dl>
    </li>
<?php } ?> 

 <?php if ($project == 'greenfield') { ?>
    <li>
        <dl class="inline-term">
            <dt>Footer Top Image</dt>
            <dd>
                Here you can choose the image for the footer top
            </dd>
        </dl>
    </li>
<?php } ?> 


<?php if ($project == 'newborn' or $project == 'heavyhandlers' or $project == 'petcenter' or $project == 'universalcare' or $project == 'stellarlook' or $project == 'presstige' or $project == 'sabbatico' or $project == 'yoozie' or $project == 'roox' or $project == 'justizia' or $project == 'presidential' or $project == 'healthrehub' or $project == 'itsagirl') { ?>
    <li>
        <dl class="inline-term">
            <dt>Show footer widgets area</dt>
            <dd>
                Show/hide footer widgets area
            </dd>
        </dl>
    </li>
<?php } ?> 

<?php if ($project == 'sabbatico' or $project == 'presidential') { ?>
    <li>
        <dl class="inline-term">
            <dt>Enable Footer gradient background</dt>
            <dd>
                Enable/disable Footer gradient background
            </dd>
        </dl>
    </li>
<?php } ?> 


<?php if ($project == 'monstroid_2' or $project == 'emanuella' or $project == 'calio' or $project == 'guillermo' or $project == 'delicia' or $project == 'itideas' or $project == 'hotelbliss' or $project == 'propello') { ?>
    <li>
        <dl class="inline-term">
            <dt>Footer Widgets Area Background color</dt>
            <dd>
                Here you can define the Widget Area background color
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Show footer widgets area</dt>
            <dd>
                Show/hide footer widgets area
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Show footer logo</dt>
            <dd>
                Show/hide footer logo
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Show footer menu</dt>
            <dd>
                Show/hide footer menu
            </dd>
        </dl>
    </li>
<?php } ?>  

<?php if ($project == 'glossylook' or $project == 'malcolmy') { ?>
    <li>
        <dl class="inline-term">
            <dt>Show footer widgets area</dt>
            <dd>
                Show/hide footer widgets area
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Show footer logo</dt>
            <dd>
                Show/hide footer logo
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Show footer menu</dt>
            <dd>
                Show/hide footer menu
            </dd>
        </dl>
    </li>
<?php } ?>     

<?php if ($project == 'builderry' or $project == 'bayden' or $project == 'niceinn' or $project == 'callista' or $project == 'quickwind' or $project == 'fabrique') { ?>
    <li>
        <dl class="inline-term">
            <dt>Show footer logo</dt>
            <dd>
                Show/hide footer logo
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Show menu</dt>
            <dd>
                Show/hide menu
            </dd>
        </dl>
    </li>
<?php } ?>  

<?php if ($project == 'greenfield') { ?>
    <li>
        <dl class="inline-term">
            <dt>Image Repeat</dt>
            <dd>
                Set image repeat for footer image
            </dd>
        </dl>
    </li>
     <li>
        <dl class="inline-term">
            <dt>Image Position</dt>
            <dd>
                Set image position for footer image
            </dd>
        </dl>
    </li>
     <li>
        <dl class="inline-term">
            <dt>Image Attachment</dt>
            <dd>
                Set image attachment for footer image
            </dd>
        </dl>
    </li>
<?php } ?>  

<?php if ($project == 'transit' or $project == 'takeandspend' or $project == 'quickwind' or $project == 'speedyfix' or $project == 'legalalien' or $project == 'magnifio' or $project == 'malcolmy') { ?>
    <li>
        <dl class="inline-term">
            <dt>Background Image</dt>
            <dd>
                Set the background image for footer
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Background Repeat</dt>
            <dd>
                Set background repeat for footer image
            </dd>
        </dl>
    </li>
     <li>
        <dl class="inline-term">
            <dt>Background Position</dt>
            <dd>
                Set background position for footer image
            </dd>
        </dl>
    </li>
     <li>
        <dl class="inline-term">
            <dt>Background Attachment</dt>
            <dd>
                Set background attachment for footer image
            </dd>
        </dl>
    </li>
<?php } ?>  
</ul>

<?php if ($project == 'glossylook' or $project == 'calio' or $project == 'guillermo' or $project == 'delicia' or $project == 'itideas' or $project == 'hotelbliss' or $project == 'propello') { ?>
<h5>Footer Contact Block</h5>
<ul class="marked-list">
    <li>
        <dl class="inline-term">
            <dt>Show footer contact block</dt>
            <dd>
                Show/hide footer contact block
            </dd>
        </dl>
    </li>
<?php } ?>  
</ul>


<?php if ($project == 'monstroid_2' or $project == 'emanuella') { ?>
<h5>Footer Contact Block</h5>
<ul class="marked-list">
    <li>
        <dl class="inline-term">
            <dt>Show footer contact block</dt>
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