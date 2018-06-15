<h3>Getting Started</h3>



<h5>This block contains detailed information on how to prepare before creating the <b>Single Product</b> page with <b>JetWooBuilder</b>.</h5>

<ol class="index-list">

<li><p>First, let’s open the Dashboard and here navigate to <b>Products</b> tab. Click <b>Add New</b> button and here create a new product.</p>

<p>
You need to specify the following information on the <b>Add new product</b> page:
<ul class="marked-list">
<p>
  <li>Add the <b>Product name</b>;

  <figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/start/1.png">
    </figure>

  </li>
  <li>Add content in the required field;

    <figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/start/2.png">
    </figure>

</li>
  <li>Set the product categories;

    <figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/start/3.png">
    </figure>

</li>
  <li>Specify the product tags;

    <figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/start/4.png">
    </figure>

</li>
  <li>Enable <b>Show sharing buttons</b> option (in the case you’re using <b>JetPack</b> plugin for adding social sharing);

    <figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/start/5.png">
    </figure>

</li>
  <li>Add <b>Product image</b>;

    <figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/start/6.png">
    </figure>

</li>
  <li>Set the <b>Regular price</b> in the <b>Product data</b>;

    <figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/start/7.png">
    </figure>

</li>
  <li>Set the <b>Sale price</b> (if the product is on sale);</li>
  <li>Add the <b>SKU</b> value in the <b>Product data > Inventory</b> (needed to speed up the search for the product);

    <figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/start/8.png">
    </figure>

</li>
  <li>Change the <b>Stock</b> status to <b>In Stock</b> (otherwise the <b>Purchase</b> button will be inactive);

    <figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/start/9.png">
    </figure>

</li>
  <li>Set the <b>Upsells</b> in <b>Product data > Linked Products</b>;

    <figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/start/10.png">
    </figure>

</li>
  <li>Set the attributes for the product in <b>Product data > Attributes</b>;

    <figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/start/11.png">
    </figure>

</li>
  <li>Check <b>Enable Reviews</b> in <b>Product data > Advanced</b>;

    <figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/start/12.png">
    </figure>

</li>
  <li>Enter the Product short description.

    <figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/start/13.png">
    </figure></li>
</p></ul>

<p>Some of these actions can be skipped if you don’t need then (e.g., you can disable the reviews or don’t add upsells, social icons, etc.).</p>

<p>However, these steps are needed as necessary preparation before using <b>JetWooBuilder</b> in order to add content to the <b>Single Product</b> page.</p></li>

<li><p>Second, let’s navigate to <b>WooCommerce > JetWoo Templates</b> in the Dashboard.

  <figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/start/14.png">
    </figure>
    </p></li>

<li><p>Here click <b>Add New Template</b> button.

  <figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/start/15.png">
    </figure>

    </p></li>

<li><p>Enter the new template title in the corresponding field.</p></li>

<li><p>Select the product which properties you want to use when creating a template  in the <b>Template Settings</b>. By doing this you connect the template to the product.</p></li>

<li><p>Select the page template you want to use in the <b>Post Attributes</b> block.</p></li>

<li><p>Enable <b>Show sharing buttons</b> option in order to be able to add the sharing buttons provided by Jet Pack to the product when building a template.

  <figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/start/16.png">
    </figure>
    </p></li>

<li><p>Click <b>Save Draft</b> button in order to preserve the changes.</p></li>

<li><p>Click <b>Edit with Elementor</b> button.</p></li></ol>

<h4>Setting Single Product Template for All Products</h4>

  <figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/start/woo7.png">
    </figure>

<ol class="index-list">

<li><p>Navigate to <b>WooCommerce > Settings</b> in WordPress Dashboard. Open <b>Jet Woo Builder</b> tab and here locate <b>General options</b>.</p></li>

<li><p><b>Custom Single Product</b> - check this option in order to use the selected WooCommerce Single Product template for all the products. Leave the checkbox empty to use the separate templates or Sibgle Product pages for each product.</p></li>

<li><p>Select the <b>Single Product Template</b> to apply for all the products from the list of available templates.</p></li>

<li><p>Check <b>Use Native Templates</b> option to use the native WooCommerce templates instead of the rewritten ones created with Elementor and JetWooBuilder.</p></li>
