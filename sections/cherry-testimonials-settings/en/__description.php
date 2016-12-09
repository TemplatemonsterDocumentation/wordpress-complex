<h2>Plugin Settings</h2>
<p>
    At the moment 2 plugin settings are available in version 1.0.0:
</p>

<figure class="img-polaroid">
    <img src="projects/<?php echo $project;?>/img/images/settings.png">
</figure>

<ul class="marked-list">
    <li>
        <dl class="inline-term">
            <dt>Testimonials archive page</dt>
            <dd>
                Set page for testimonials archive
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Posts number per archive page</dt>
            <dd>
                Тumber of testimonials on the archive page
            </dd>
        </dl>
    </li>
</ul>
  
<h3>Shortcode</h3>
<ul class="marked-list">
    <li>
        <dl class="inline-term">
            <dt>type </dt>
            <dd>
                Layout type (list, slider)
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>sup_title</dt>
            <dd>
                Specify the super title 
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>title </dt>
            <dd>
                Specify the title  
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>sub_title</dt>
            <dd>
                 Specify the subtitle 
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>divider </dt>
            <dd>
                Show/hide divider between titles and testimonials
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>limit </dt>
            <dd>
                Number of testimonials (limit="-1" – show all)
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>orderby</dt>
            <dd>
                Order testimonials by a specific attribute
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>order</dt>
            <dd>
                order testimonials
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>category</dt>
            <dd>
                Define the category from which testimonials will be displayed
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>ids</dt>
            <dd>
                Display testimonials with certain IDs (e.g  ids="1721,1723")
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>show_avatar</dt>
            <dd>
                Show/hide author avatar
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>size</dt>
            <dd>
                Photo/avatar width (in px)
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>content_length</dt>
            <dd>
                Content length (in words)
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>show_email </dt>
            <dd>
                Show/hide author email
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>show_position</dt>
            <dd>
                Show/hide testimonial author position
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>show_company</dt>
            <dd>
                Show/hide company name
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>template</dt>
            <dd>
                Template with macros which sets testimonial display structure 
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>custom_class</dt>
            <dd>
                Custom CSS-class
            </dd>
        </dl>
    </li>
</ul>

<h4>The following attributes are applied for slider ( type="slider") only:</h4>
<ul class="marked-list">
    <li>
        <dl class="inline-term">
            <dt>autoplay</dt>
            <dd>
                Time between scrolled slides (ms)
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>effect</dt>
            <dd>
                "slide" or "coverflow"
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>loop </dt>
            <dd>
                Enable/disable slider "loop"
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>pagination </dt>
            <dd>
                Show/hide pagination
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>navigation  </dt>
            <dd>
                Show/hide prev/next buttons
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>slides_per_view</dt>
            <dd>
                Number of slides per view
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>space_between</dt>
            <dd>
                Ppadding between slides ( px)
            </dd>
        </dl>
    </li>
</ul>

<div class="alert alert-info">
    <p>
        To use testimonials slider use Swiper script - <a href="http://idangero.us/swiper/">http://idangero.us/swiper/</a>  
    </p>
    <p>
        Default script values can be changed with the help of <strong>tm_testimonials_slider_data_atts</strong> filter
    </p>
</div>

<h3>Templates</h3>
<ul class="marked-list">
    <li>
        <dl class="inline-term">
            <dt>/templates/</dt>
            <dd>
                Subdirectory with templates for pages (single, archive)
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>/templates/shortcodes/testimonials/</dt>
            <dd>
                subdirectory with *.tmpl files
            </dd>
        </dl>
    </li>
</ul>

<p>
    If you need to change the template content, you need to rewrite it in the theme keeping the folder structure. For instance:
</p>

<ul class="marked-list">
    <li>
        <dl class="inline-term">
            <dt>wp-content/themes/twentysixteen/templates/</dt>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>wp-content/themes/twentysixteen/templates/shortcodes/testimonials/</dt>
        </dl>
    </li>
</ul>