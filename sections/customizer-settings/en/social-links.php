<h3>Social links</h3>
<p>Here you can set up site social links.</p>

<!--
<figure class="img-polaroid">
    <img src="img/tm/customizer/.png" alt="" >
</figure>
-->





<ul class="marked-list">

<?php if ($project !='room4pics' && $project !='rufusvr' && $project !='helpinghand' && $project !='wheelmasters' && $project !='greenfield' && $project !='stargaze' && $project !='vitahealth' && $project !='petcenter' && $project !='armyacademy' && $project !='universalcare'){ ?>
    <li class="hide">
        <dl class="inline-term">
            <dt>Show social links in header</dt>
            <dd>
                Displays the list of links to social networks pages in site header
            </dd>
        </dl>
    </li>
<?php } ?>

    
<?php if ($project =='room4pics' or $project =='rufusvr' or $project =='bayden' or $project =='petstore' or $project =='expenditorious' or $project =='trudeau' or $project =='niceinn' or $project =='uptime99' or $project =='helpinghand' or $project =='preservarium' or $project =='wheelmasters' or $project =='talkingbusiness' or $project =='greenfield' or $project =='stargaze' or $project =='vitahealth' or $project =='emanuella' or $project =='newborn' or $project =='heavyhandlers' or $project =='glossylook' or $project =='metadental' or $project =='petcenter' or $project =='takeandspend' or $project =='safescrap' or $project =='calio' or $project =='armyacademy' or $project =='universalcare' or $project =='callista' or $project =='quickwind' or $project =='sportware'){ ?>
    <li>
        <dl class="inline-term">
            <dt>Show social links in footer </dt>
            <dd>
                Displays the list of links to social networks pages in site footer
            </dd>
        </dl>
    </li>
<?php } ?>

<?php if ($project =='room4pics' or $project =='rufusvr' or $project =='vitahealth' or $project =='petcenter' or $project =='armyacademy' or $project =='universalcare'){ ?>
    <li class="hide">
        <dl class="inline-term">
            <dt>Show social links in top panel</dt>
            <dd>
                Displays the list of links to social networks pages in top panel
            </dd>
        </dl>
    </li>
<?php } ?>


<?php if ($project !='stylefactory' && $project !='hardwire' && $project !='thedailypost' && $project !='streamline' && $project !='cityherald' && $project !='viralnews' && $project !='petstore'  && $project !='trudeau' && $project !='preservarium' && $project !='talkingbusiness'){ ?>
    <li>
        <dl class="inline-term">
            <dt>Add social sharing to blog posts  </dt>
            <dd>
                Displays "share in social networks" buttons in blog posts
             </dd>
        </dl>
    </li>

    <li>
        <dl class="inline-term">
            <dt>Add social sharing to single blog post  </dt>
            <dd>
                Displays "share in social networks" buttons on a single blog post
             </dd>
        </dl>
    </li>

</ul>
<?php } ?>

<?php if ($project =='stylefactory' or $project =='petstore' or $project =='trudeau' or $project =='preservarium' or $project =='talkingbusiness') { ?>

     <li>
        <dl class="inline-term">
            <dt>Show social sharing to blog posts  </dt>
            <dd>
                Displays "share in social networks" buttons in blog posts
            </dd>
        </dl>
    </li>

    <li>
        <dl class="inline-term">
            <dt>Show social sharing to single blog post  </dt>
            <dd>
                Displays "share in social networks" buttons on a single blog post
             </dd>
        </dl>
    </li> 

    <li>
        <dl class="inline-term">
            <dt>Social sharing label on single blog post </dt>
            <dd>
                Enter the text you want to be displayed on a single blog post
            </dd>
        </dl>
    </li>
<?php } ?>
