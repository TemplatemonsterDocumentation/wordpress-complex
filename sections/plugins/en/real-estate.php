	<h3>Cherry Real Estate</h3>

	<p>The plugin is designed for adding real estate functionality to the site. It helps users to create various kinds of  real estate listings as easily as regular posts. Right after the plugin is installed, you will see the Properties menu tab in the admin panel of the website. Let’s take a look at the available options and features.
</p>

	<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/plugins/real-estate.png">
    </figure>

<ul class="marked-list">
    <li>
        <dl class="inline-term">
            <dt>Properties</dt>
            <dd>
				Here you can see all the available posts.
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Types</dt>
            <dd>
                In this section you can create various real estate types
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Tags </dt>
            <dd>
                 Add proper tags
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Features  </dt>
            <dd>
                Add all necessary features to the post
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt> Settings </dt>
            <dd>
                Here you can find all the settings  for the plugin
            </dd>
        </dl>
    </li>
   </ul>

  <h4>Adding new post</h4>
   <p>
   	To create a new post you need to click an Add New button in the Properties tab. On a new page enter title and text of the new property.</p> 

<p>Now proceed to the box below. Here you need to specify:</p>
<ul class="marked-list">
    <li>
        <dl class="inline-term">
            <dt>State of progress </dt>
            <dd>
                State of progress of the property
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Price </dt>
            <dd>
                Enter the price
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Property status </dt>
            <dd>
                Specify the property status (sale or rent)
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt> Location</dt>
            <dd>
                Specify the location of the apartment or office
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Bedrooms  </dt>
            <dd>
                Choose the number of bedrooms
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Bathrooms  </dt>
            <dd>
                 Choose the number of bathrooms
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Area   </dt>
            <dd>
                Specify the  area of the object
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Area    </dt>
            <dd>
            	Specify the  area of the object
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt> Parking places  </dt>
            <dd>
            	 Specify the number of parking places
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt> Gallery  </dt>
            <dd>
            	Add photos of the apartment or office
            </dd>
        </dl>
    </li>
</ul>

<h4>Shortcodes</h4>
<p>
	There are 3 types of shortcodes. To add it to the page content you need to click the button in the post admin panel.
</p>
<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/plugins/re-shortcodes.png">
</figure>
<ul>
	<li>Agent List </li>
	<li>Property List</li>
	<li>Submission Form</li>
</ul>
<p>
	Agent list and Property list have their own popular arguments. Let’s take a look at each of them:
</p>

<h4>Agent list</h4>
<p>
	Displays the list of agents on the homepage.
</p>
<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/plugins/re-al.png">
</figure>
<p>
	And on the Agents page
</p>
<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/plugins/re-al-2.png">
</figure>

<p>
	Here you will find all the features that will help you  adjust the Agent List in accordance with the specifications of your business. 
</p>

<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/plugins/re-al-settings.png">
</figure>

<h4>Property list</h4>
<p>
	This shortcode displays the Property list on the page. 
</p>

<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/plugins/re-property-list.png">
</figure>

<p>
	It also offers the list of options that will help you specify all the details about the properties.
</p>

<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/plugins/re-property-list-settings.png">
</figure>

<p>
	After you made all the adjustments you will see the following piece of code in the content section:
</p>

<p>
<strong>
	[tm_re_property_list number="5" orderby="date" order="asc" show_title="yes" show_image="yes" image_size="thumbnail" show_status="yes" show_area="yes" show_bedrooms="yes" show_bathrooms="yes" show_price="yes" show_location="yes" show_excerpt="yes" excerpt_length="15" show_more_button="yes" more_button_text="read more" show_pagination="no" template="default.tmpl" color_scheme="regular"]
</strong>
</p>

<p>
	You can change the settings right there without opening the popup menu again. 
</p>

<h4>Submission Form</h4>
<p>
	<strong>[tm_re_submission_form]</strong> shortcode adds submission form to the page. 

</p>

<p>
	<strong>NOTE:</strong> To change the main page for displaying the properties, you need to navigate to the plugin Settings section.
</p>
<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/plugins/re-property-list-settings-1.png">
</figure>

<p>
	There are 2 ways to display the properties:
</p>

<ul>
	<strong><li>Create a new page</strong> </li>
	<li><strong>Add Property list shortcode</strong></li>
</ul>

<p>
	OR
</p>
<ul>
	<li><strong>Create a new page</strong> </li>
	<li><strong>Set it as a basic page for Properties page</strong> (if there is any kind of content added before/previously to the page - it will not be displayed)</li>
</ul>
<p>
	This shortcode is more flexible and allows to display particular elements hiding the other ones. All the properties are displayed on the main page, plus there is a filter for changing the layout type (list or grid list).
</p>
<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/plugins/re-property-sortby.png">
</figure>
<p>
	The posts can be filtered by several criteria
</p>
<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/plugins/re-property-sortby-2.png">
</figure>

<h4>Options</h4>
<p>
	In the Main section you can see the following settings:
</p>

<h5>Main</h5>
<ul class="marked-list">
    <li>
        <dl class="inline-term">
            <dt>Area unit</dt>
            <dd>
   				Choose the metric system
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Currency</dt>
            <dd>
   				Choose the currency
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Currency Position</dt>
            <dd>
   				Specify the price tag position
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Thousand Separator </dt>
            <dd>
   				Change the thousand separator
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Decimal Separator</dt>
            <dd>
   				Change the decimal separator
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Number of Decimals</dt>
            <dd>
   				Specify the number of decimals
            </dd>
        </dl>
    </li>
</ul>

<h5>Listing</h5>
<p>
	Here you need to specify the listing type. 
</p>
<ul class="marked-list">
    <li>
        <dl class="inline-term">
            <dt>Page</dt>
            <dd>
   				 Choose the main page for displaying properties.
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Layout</dt>
            <dd>
   				Change the layout type.
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Listings Per Page</dt>
            <dd>
            Choose the number of listings per page.
            </dd>
        </dl>
    </li>
</ul>

<h5>Map</h5>
<p>
	Map Section allows you to set and adjust a map in accordance with the style of your website. 
</p>

<ul class="marked-list">
    <li>
        <dl class="inline-term">
            <dt>Api Key</dt>
            <dd>
   				 Insert the API key generated in Google console.
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Style</dt>
            <dd>
   				Change the style of the map.
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Marker </dt>
            <dd>
            Change the Google Map Marker.
            </dd>
        </dl>
    </li>
</ul>

<h5>Emails </h5>
<p>Titles and notifications that will be delivered to the users who sent their properties to the site. </p>


<h4>Widgets</h4>
<p>
	At the moment there two widgets are available:
</p>

<p>
	<strong>Cherry RE Properties</strong> - built as an analogue to the abovementioned shortcode. It offers the same options and can add the properties to the various widget zones. 

</p>

<p>
	<strong>Cherry RE Search </strong>- adds search form to the widget zone. 

</p>

<h5>Search page</h5>
<p>
Search page looks like a regular property page with filters and layout types, but has a map with property markers in the top panel. 
</p>

<h5>Agents</h5>
<p>
To make a registered user an agent, you should give him a certain role - RE Agent. It can be done in the standard Users section. 
</p>

<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/plugins/re-agents.png">
</figure>

<p>
	Photo options - the photo that will be displayed in the agent list, single properties or agent pages shortcodes.
</p>

<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/plugins/re-photo.png">
</figure>

<p>
	To each agent you can assign as many contacts as needed. 
</p>

<h4>Role specification</h4>

<p>
<strong>RE Agent</strong> - A person who can add various properties to the site, but only if approved by admin. There is also a Trusted User option that allows an agent to add properties without the admin’s approve. 
</p>

<p>
<strong>RE Contributor </strong> - a person who added a property through a form to the site right after the registration procedure. For example, the user needs to sell a house, for that he takes registration on the site and add a property.  Contributor can’t be a trusted User by default.
</p>

<h4>Properties</h4>
<p>Here you can see all the available posts.
</p>

<p>Types -  In this section you can create various property types</p>
<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/plugins/re-property-types.png">
</figure>

<p>Features - Features of a property. Each of the elements is displayed as a separate link.  </p>
<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/plugins/re-property-features.png">
</figure>