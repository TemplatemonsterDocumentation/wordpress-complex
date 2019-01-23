<article><h2>Search Filter</h2>


<h6>
Use this filter to allow the visitors to search for the matching results manually by inputting the needed words or phrases into the Search field.
</h6>

<p>Please, create the Search filter type in WordPress Dashboard > Smart Filters before proceeding to adding the Search filter widget to the page. </p>

<h4>Content</h4>

<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/widgets/w-13.png">
    </figure></li></p>

<ul class="marked-list">
<li><p><b>Select Filter</b> - here you need to select the filter that was previously created and has the Search filter type.</p>

<p><li><b>This filter for</b> - here you need to select the listing or archive for which you want to apply the current filter. There are such options:
	<ul class="marked-list">
<li><b>JetEngine</b> - choose it in case you’ve got the listing created by JetEngine listing Grid widget.</li>
<li><b>JetEngine Calendar</b> - select this option in case you’ve got the Calendar widget with the publications shown inside and want the visitors to apply this filter for Calendar content.</li>
<li><b>WooCommerce Shortocde</b> - in case you’re displaying the WooCommerce products or categories with WooCommerce shortocde added to a page built with Elementor, and want to apply the following filter for these products or categories, select this option.</li>
<li><b>WooCommerce Archive (by JetWooBuilder)</b> - in case you’re applying the filter to the products or archive (on Shop page) created with JetWooBuilder widgets, use this option.</li>
<li><b>WooCommerce Products Grid</b> - if you’re adding the products to page built with Elementor using JetWoobuilder Products Grid widget, select this option to apply the filter for this specific widget and the products displayed by it.</li>
<li><b>WooComerce Products List</b> -  if you’re adding the products to page built with Elementor using JetWoobuilder Products List widget, select this option to apply the filter for this specific widget and the products displayed by it.</li></p></ul>

<div class="alert alert-info">
     <p>Please, note, that in order to filter the products, you’ll have to use the proper meta keys.</p></div>

<p><li><b>Apply type</b> - here you can choose which filter type is preferable for this filter. An AJAX filter type allows filtering using AJAX method without reloading the page, which makes the filtering through the products much faster for the visitors. The Page Reload filter reloads the page each time the visitor applies the filter.</li>
<p><li><b>Show Apply button</b> - enable this option to display Apply button and allow the visitors select multiple checkboxes and only then apply the filter on button click.
Show filter label - enable this option to add the filter label set for this filter to the top of it.</li>

<p><li><b>Query ID</b> - in case you’re using more than one filter and display more than one listing grid, products grid, etc., on the page, you can use the Query ID option to define which filter is applied to which widget.</li>

<p>To set an ID for the products grid or listing grid widget, open its Advanced settings and fill in the CSS ID and CSS Classes values into the corresponding fields.</p>

<p>You have to input the same ID into the Query ID field to assign this particular filter to the specific widget on the page.</p>

<h4>Style</h4>

<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/widgets/w-14.png">
    </figure></li></p>

<h6>Content</h6>
<ul class="marked-list">
<p><li><b>Position</b> -here you can select the type of position applied for the Search filter: the inline or columns.</li>
<p><li><b>Input width</b> - here you can apply the custom responsive width for the widget.</li>

<h6>Input</h6>

<ul class="marked-list">
<p><li><b>Typography</b> - turn the option on to view the typography settings. They are similar to the ones for the Checkbox label.</li>
<p><li><b>Color</b> - here you can specify the color to use for the input.</li>
<p><li><b>Background color</b> - here you can select the proper background color to use for the input.</li>
<p><li><b>Border type</b> - here you can specify the type of the border to apply for the inputs block. After that, you’ll get access to border color and width.</li>
<p><li><b>Border radius</b> - specify the responsive border to apply around the element.</li>
<p><li><b>Box shadow</b> - apply the Shadow option for the element.</li>
<p><li><b>Padding</b>  - here you can set the responsive padding for the element.</li></p>


<h6>Button</h6>
<ul class="marked-list">
<p><li><b>Typography</b> -  turn the option on to view the typography settings. They are similar to the ones for the Checkbox label.</li>

<p>Switch between the <b>Normal</b> and <b>Hover</b> modes to change the appearance of the button on hover and when it’s in its normal state.</p>

<p><li><b>Text color</b> - here you can specify the color to use for the text.</li>
<p><li><b>Background color</b> - here you can set the color to apply for the button plane background.</li>
<p><li><b>Border type</b> - here you can specify the type of the border to apply for the button. After that, you’ll get access to border color and width.</li>
<p><li><b>Border radius</b> - specify the responsive border to apply around the button.</li>
<p><li><b>Box shadow</b> - apply the Shadow option for the button.</li>
<p><li><b>Padding</b> - here you can set the responsive padding for the button.</li>
<p><li><b>Margin</b> - here you can set the responsive margin for the button.</li>
<p><li><b>Alignment</b> - here you can change the widget’s filter button alignment to left, center or right.</li></p>
