<h3>Sorting Products by Custom Meta Fields</h3>
<p>
	In many shortcodes like:
</p>
<ul class="marked-list_bold">
		<li>
			[recent_products]
		</li>
		<li>
			[featured_products]
		</li>
		<li>
			[products]
		</li>
		<li>
			[product_category]
		</li>
		<li>
			[sale_products]
		</li>
		<li>
			[top_rated_products]
		</li>
		<li>
			[product_attribute]
		</li>
		<li>
			[related_products]
		</li>
	</ul>
<p>
	you can choose to order products by the following values
</p>
<ul class="marked-list_bold">
		<li>
			menu_order
		</li>
		<li>
			title
		</li>
		<li>
			date
		</li>
		<li>
			rand
		</li>
		<li>
			id
		</li>
	</ul>
<p>
	using the “orderby” attribute, for example:
</p>

<p>[products skus=”foo, bar, baz” <strong>orderby=”date”</strong> order=”desc”].</p>

<p>But you can also sort the products by custom meta fields using the code below (in this example we order product by price):</p>


<div class="codebox">
<pre>add_filter( 'woocommerce_shortcode_products_query', 'woocommerce_shortcode_products_orderby' );

function woocommerce_shortcode_products_orderby( $args ) {

	$standard_array = array('menu_order','title','date','rand','id');

	if( isset( $args['orderby'] ) && !in_array( $args['orderby'], $standard_array ) ) {
		$args['meta_key'] = $args['orderby'];
		$args['orderby']  = 'meta_value_num'; 
	}

	return $args;
}</pre>
 </div>

<p>
	You need to place this snippet in functions.php in your theme folder and then customize by editing the meta_key.
</p>

<h4>For more information navigate to the oficial <a href="https://docs.woothemes.com/document/woocommerce-shortcodes/">WooCommerce website</a>.</h4>