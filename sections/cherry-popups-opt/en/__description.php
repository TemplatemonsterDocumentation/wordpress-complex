<h2>Popup Options</h2>
<p>
Each popup has its own settings which are represented in Popup settings.
</p>

<h3>General Settings Section</h3>

<figure class="img-polaroid">
    <img src="projects/<?php echo $project;?>/img/images/general.png">
</figure>

<ul class="marked-list">
    <li>
        <dl class="inline-term">
            <dt>Popup layout type</dt>
            <dd>
               Choose popup layout type (center, fullwidth center, fullwidth bottom);
            </dd>
        </dl>
    </li>
        <li>
        <dl class="inline-term">
            <dt>Show/Hide animation </dt>
            <dd>
               Choose show/hide animation effects(fade, scale, move up);
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Base style preset</dt>
            <dd>
                Popup controls base color styles (default, light, dark, blue, red);
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Content type</dt>
            <dd>
                The type of content to be shown as popup;
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Show once</dt>
            <dd>
                Enable / disable displaying popup window only once.
            </dd>
        </dl>
    </li>
</ul>

<h3>Overlay</h3>

<p>Background overlay settings.</p>

<figure class="img-polaroid">
    <img src="projects/<?php echo $project;?>/img/images/overlay.png">
</figure>

<ul class="marked-list">
    <li>
        <dl class="inline-term">
            <dt> Type of overlay</dt>
                 <li>
                    <dl class="inline-term">
                        <dt>disabled </dt>
                        <dd>
                            disable the overlay;
                        </dd>
                    </dl>
                </li>
                <li>
                    <dl class="inline-term">
                        <dt>fill-color </dt>
                        <dd>
                            background fill-cover;
                        </dd>
                    </dl>
                </li>
                <li>
                    <dl class="inline-term">
                        <dt>image </dt>
                        <dd>
                            background image;
                        </dd>
                    </dl>
                </li>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Overlay background color</dt>
            <dd>
                choose overlay background color;
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Overlay background opacity</dt>
            <dd>
                 set overlay background opacity;
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Overlay background image</dt>
            <dd>
                set overlay background image;
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Use Overlay as close button</dt>
            <dd>
                clicking on the overlay closes the popup.
            </dd>
        </dl>
    </li>
</ul>

<h3>Style</h3>

<p>In this block one can change popup style settings.</p>

<figure class="img-polaroid">
    <img src="projects/<?php echo $project;?>/img/images/style.png">
</figure>

<ul class="marked-list">
    <li>
        <dl class="inline-term">
            <dt>Container background type</dt>
            <dd>
                container background type (fill-color, image);
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Container background color</dt>
            <dd>
                popup container background color;
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Container background image</dt>
            <dd>
               choose container background image;
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Container opacity</dt>
            <dd>
                here one can change container opacity (active for fill-color type);
            </ddc
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Popup width</dt>
            <dd>
                popup container width to display on the page;
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Popup height</dt>
            <dd>
                popup container height to display on the page;
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Popup padding</dt>
            <dd>
                the padding value for the popup container;
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Popup border radius</dt>
            <dd>
                define the border radius to apply the rounded angles for the popup container.
            </dd>
        </dl>
    </li>
</ul>




<h3>"Open" page settings</h3>


<p>Popup performance settings at the beginning of the custom session.</p>


<figure class="img-polaroid">
    <img src="projects/<?php echo $project;?>/img/images/open-page.png">
</figure>

<ul class=marked-list>

    <li>
        <dl class="inline-term">
            <dt>"Open page" popup appear event </dt>
            <dd>
                set an event to which a popup will be opened;
            </dd></dl>

            <ul class="marked-list">
                <li>
                    <dl class="inline-term">
                        <dt>on page load</dt>
                        <dd>
                            page complete load event;
                        </dd>
                    </dl>
                    </li>
                    <li>
                        <dl class="inline-term">
                            <dt>inactivity time after</dt>
                            <dd>
                                inactivity time event;
                            </dd>
                        </dl>
                    </li>
                    <li>
                        <dl class="inline-term">
                            <dt>on page scrolling</dt>
                            <dd>
                                page scrolling progress event.
                            </dd>
                        </dl>
                    </li>
        </ul>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Open delay</dt>
            <dd>
                set the time delay when the page loads;
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>User inactivity time</dt>
            <dd>
                the time of the user inactivity on the page (in seonds);
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Page scrolling value</dt>
            <dd>
                scrolling page progress (in percents).
            </dd>
        </dl>
    </li>
</ul>

<h3>"Close" page settings</h3>

<p>Popup performance settings at the end of the custom session.</p>

<figure class="img-polaroid">
    <img src="projects/<?php echo $project;?>/img/images/close-page.png">
</figure>

<ul class="marked-list">
    <li>
        <dl class="inline-term">
            <dt>"Close page" popup appear event </dt>
            <dd>
                set the event after wich the popup will appear on the page;
            </dd>
        </dl>

    <ul class="marked-list">
      <li>
          <dl class="inline-term">
                <dt>Outside viewport</dt>
                <dd>
                   monitoring the user's attempt to close the page (when the user navigates to the upper part of the page to the page closing area);
              </dd>
          </dl>
      </li>
      <li>
          <dl class="inline-term">
                <dt>Page unfocus</dt>
                <dd>
                   the user opens the other page or system application.
              </dd>
          </dl>
      </li>
</li>
</ul>

<h3>Custom opening event</h3>

<figure class="img-polaroid">
    <img src="projects/<?php echo $project;?>/img/images/custom-opening.png">
</figure>

<ul class="marked-list">
    <li>
        <dl class="inline-term">
            <dt>Custom event type </dt>
            <dd>
                set the event after wich the popup will appear on the page;
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Selector </dt>
            <dd>
                define the selector for the custom event.
            </dd>
        </dl>
    </li>
</ul>

<h3>Advanced settings</h3>


<p> The advanced options for the popup window.</p>


<figure class="img-polaroid">
    <img src="projects/<?php echo $project;?>/img/images/advanced-settings.png">
</figure>


<ul class="marked-list">
    <li>
        <dl class="inline-term">
            <dt>Custom class</dt>
            <dd>
                Here one can define the popup custom class.
            </dd>
        </dl>
    </li>
</ul>

<h3>Popup Identification on static page</h3>
<p>
    If standard settings are not enough for identifying a visible section, there is a metablock that allows you to add a particular popup to any static page. To find the metablock open any page of your website in the and scroll down to the  Cherry Popups section.
</p>

<figure class="img-polaroid">
    <img src="projects/<?php echo $project;?>/img/images/popup-identification.png">
</figure>
<p>
    You can assign 2 popups simultaneously. One at the beginning, and another one at the end of section.
</p>

<h3>Templates</h3>

<p>The plugin uses the simplified system of creating templates (.tmpl files). All the templates for displaying popups in different modes are available by default. </p>


<p>One can rewrite the standard templates in the theme. To do it you need to navigate to your root directory and create there "cherry-popup" folder. Here you should place the necessary templates.</p>

<p>You can also add your own templates. For this you need to create the file with the ".tmpl" extension in the same folder.</p>

<h4>Macros</h4>

<ul class=marked-list>

<li>%%TITLE%% - the popup title;</li>
<li>%%CONTENT%% - popup content;</li>
<li>%%SUBSCRIBEFORM%% - the subscribing form, MailChimp;</li>
<li>%%LOGINFORM%% - the login form;</li>
<li>%%REGISTERFORM%% - the sign in form.</li>

</ul>



