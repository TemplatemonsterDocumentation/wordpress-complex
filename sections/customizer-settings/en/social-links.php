<h3>Social links</h3>
<p>Here you can set up site social links.</p>

<!--
<figure class="img-polaroid">
    <img src="img/tm/customizer/.png" alt="" >
</figure>
-->





<ul class="marked-list">

    <li class="hide">
        <dl class="inline-term">
            <dt>Show social links in header</dt>
            <dd>
                Displays the list of links to social networks pages in site header
            </dd>
        </dl>
    </li>

    <li>
        <dl class="inline-term">
            <dt>Show social links in footer </dt>
            <dd>
                Displays the list of links to social networks pages in site footer
            </dd>
        </dl>
    </li>


<?php if ($project !='stylefactory' && $project !='hardwire' && $project !='thedailypost'){ ?>
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

<?php if ($project =='stylefactory') { ?>

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
