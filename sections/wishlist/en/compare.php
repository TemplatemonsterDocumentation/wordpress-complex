<h3>WooCommerce Compare</h3>
<p>
	WooCompare is a new addition to the up to date TM WooCommerce Package. It allows users to compare products for all possible attributes. To compare the products users need to click the “Add to compare” button in the product listing or on the product page. They can also delete products from the compare list in exactly the same way. 
</p>
<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/widgets/woocompare-2.png">
</figure>
<p>
	The TM Compare settings page offers the following options:
</p>
<ul class="marked-list">
		<li>	
			<dl class="inline-term">
				<dt>	
					Enable compare
				</dt>
					<dd>
						Enable/disable compare functionality. 
					</dd>
			</dl>
		</li>
		<li>	
			<dl class="inline-term">
				<dt>	
					Select compare  page   
				</dt>
					<dd>
						Choose the page  to display the compare page.
					</dd>
			</dl>
		</li>
		<li>	
			<dl class="inline-term">
				<dt>	
					Show in catalog
				</dt>
					<dd>
						 Display  the  "Add to compare" button in the products list.
					</dd>
			</dl>
		</li>
		<li>	
			<dl class="inline-term">
				<dt>	
					Show in products page
				</dt>
					<dd>
						Display  the  "Add to compare" button on the product page.
					</dd>
			</dl>
		</li>
		<li>	
			<dl class="inline-term">
				<dt>	
					Compare  button text
				</dt>
					<dd>
						Specify the compare  button text.
					</dd>
			</dl>
		</li>
		<li>	
			<dl class="inline-term">
				<dt>	
					Remove button text 
				</dt>
					<dd>
						Specify the Remove button text.
					</dd>
			</dl>
		</li>
		<li>	
			<dl class="inline-term">
				<dt>	
					Empty compare list text
				</dt>
					<dd>
						Text displayed on the Compare page or in the widget of products added to the compare list if the compare list is empty. 
					</dd>
			</dl>
		</li>
		<li>	
			<dl class="inline-term">
				<dt>	
					Page Template
				</dt>
					<dd>
						Choose a proper page template.
					</dd>
			</dl>
		</li>
		<li>	
			<dl class="inline-term">
				<dt>	
					Widget template 
				</dt>
					<dd>
						Choose a proper widget template.
					</dd>
			</dl>
		</li>
	</ul>

<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/widgets/compare-options.png">
</figure>

<p>
	You can also use the widget that allows to display the products added to the compare list, remove them, clear the list and navigate to the compare page. 
</p>

<p>
	Data will be dynamically  updated  in all sections and the product added in the listing will be automatically added to the widget and to the compare page.
</p>

<h5>Customize functionality with hooks</h5>
<ul class="marked-list">
		<li>	
			<dl class="inline-term">
				<dt>	
					add_action( 'woocommerce_after_shop_loop_item', 'tm_woocompare_add_button', 12 )
				</dt>
					<dd>
						The hook which adds the Add to Compare  or Remove button in the product list.
					</dd>
			</dl>
		</li>
		<li>	
			<dl class="inline-term">
				<dt>	
					apply_filters( 'tm_woocompare_preloader', '' )

				</dt>
					<dd>
						The hook which allows to add a custom preloader to the Add Product or Remove button.

					</dd>
			</dl>
		</li>
		<li>	
			<dl class="inline-term">
				<dt>	
					apply_filters( 'tm_woocompare_list_loader', $loader )
				</dt>
					<dd>
						The hook that allows to change the compare tables and widgets preloader.
					</dd>
			</dl>
		</li>
</ul>

<h5>Shortcode Options</h5>
<p>
	The templates are are gathered in <strong>templates\shortcodes\tm-woocompare\</strong>   folder.
You can rewrite the templates by copying them to the <strong>uploads\templates\shortcodes\tm-woocompare\</strong> folder or to the <strong>woocommerce\shortcodes\tm-woocompare\</strong> folder inside the theme. You can also change the names of the templates.
</p>

<h5>Compare page templates</h5>
<p>
The default table template on the compare page - <strong>page.tmpl</strong>.
The template supports the following macros:

</p>
<ul class="marked-list">
		<li>	
			<dl class="inline-term">
				<dt>	
					%%TITLE%%  
				</dt>
					<dd>
						Display product title.
					</dd>
			</dl>
		</li>
		<li>	
			<dl class="inline-term">
				<dt>	
					%%IMAGE%% 
				</dt>
					<dd>
						Display the product picture. Supports the following attributes: 
					</dd>
					 	<ul class="marked-list">
					 		<li>	
								<dl class="inline-term">
									<dt>	
										size  
									</dt>
										<dd>
											Image size. Supports names of image size presets. For example <strong>%%IMAGE size="shop_thumbnail"%%</strong>. <strong>shop_thumbnail</strong> by default.
										</dd>
								</dl>
							</li>
							<li>	
								<dl class="inline-term">
									<dt>	
										placeholder  
									</dt>
										<dd>
											defines whether to display a cover picture if the product doesn’t have one. Takes <strong>true|false</strong>. true by default.
										</dd>
								</dl>
							</li>
					 	</ul>
			</dl>
		</li>
		<li>	
			<dl class="inline-term">
				<dt>	
					%%ADDTOCART%% 
				</dt>
					<dd>
						 Display “Add to Cart” button. 
					</dd>
			</dl>
		</li>
		<li>	
			<dl class="inline-term">
				<dt>	
					%%PRICE%%
				</dt>
					<dd>
						Display product price.
					</dd>
			</dl>
		</li>
		<li>	
			<dl class="inline-term">
				<dt>	
					%%ATTRIBUTES%%
				</dt>
					<dd>
						Display product attributes. Supports the following attributes:
					</dd>
					<ul class="marked-list">
					 		<li>	
								<dl class="inline-term">
									<dt>	
										atts   
									</dt>
										<dd>
											The list of comma separated attributes. For instance <strong>%%ATTRIBUTES  atts="color, size"%%</strong> All attributes are displayed by default.

										</dd>
								</dl>
							</li>
					 	</ul>
			</dl>
		</li>
</ul>
