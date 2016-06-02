<h3>Product Categories</h3>
<p>
	Display product categories loop
</p>
<p>Go to: <strong>WooCommerce</strong> > <strong>Products</strong> > <strong>Categories</strong> to find the slug column.</p>

<h4>[product_categories number="12" parent="0"]</h4>

<h5>Args:</h5>
<div class="codebox">
	array (
	    <span>'number' => 'null',</span>
	    <span>'orderby' => 'title',</span>
	    <span>'order' => 'ASC',</span>
	    <span>'columns' => '4',</span>
	    <span>'hide_empty' => '1',</span>
	    <span>'parent' => '',</span>
	    <span>'ids' => ''</span>
	 )
 </div>
 <h5 class="italic"> The `number` field is used to display the number of products and the `ids` field is to tell the shortcode which categories to display.</h5>

 <p>Set the parent paramater to 0 to only display top level categories. Set IDs to a comma separated list of category IDs to only show those.</p>