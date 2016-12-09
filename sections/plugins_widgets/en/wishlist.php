<h3>WooCommerce Wishlist</h3>
<p>
	Woo Wishlist is designed as an addition to the TM WooCommerce Package and gives your store even more functionality. With its help visitors will be able to add various kinds of products to the wishlist pages. It also allows to go to the compare page, add new products or delete the current ones from the list. 
</p>
<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/widgets/wishlist-1.png">
</figure>
<p>
	The plugin offers the following options:
</p>
<ul class="marked-list">
		<li>	
			<dl class="inline-term">
				<dt>	
					Enable wishlist 
				</dt>
					<dd>
						Enable/disable the wishlist.
					</dd>
			</dl>
		</li>
		<li>	
			<dl class="inline-term">
				<dt>	
					Select wishlist page   
				</dt>
					<dd>
						Choose the page  to display the wishlist.
					</dd>
			</dl>
		</li>
		<li>	
			<dl class="inline-term">
				<dt>	
					Show in catalog
				</dt>
					<dd>
						 Display  the  "Add to wishlist" button in the products list.
					</dd>
			</dl>
		</li>
		<li>	
			<dl class="inline-term">
				<dt>	
					Show in products page
				</dt>
					<dd>
						Display  the  "Add to wishlist" button on the product page.
					</dd>
			</dl>
		</li>
		<li>	
			<dl class="inline-term">
				<dt>	
					Add to wishlist button text
				</dt>
					<dd>
						Specify the wishlist button text.
					</dd>
			</dl>
		</li>
		<li>	
			<dl class="inline-term">
				<dt>	
					Added to wishlist button text
				</dt>
					<dd>
						Specify wishlist button text for the  products that are already added to the list.
					</dd>
			</dl>
		</li>
		<li>	
			<dl class="inline-term">
				<dt>	
					Empty wishlist text
				</dt>
					<dd>
						Text displayed if the wishlist is empty.
					</dd>
			</dl>
		</li>
		<li>	
			<dl class="inline-term">
				<dt>	
					Wishlist columns
				</dt>
					<dd>
						Choose a number of columns.
					</dd>
			</dl>
		</li>
	</ul>

<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/widgets/wishlist-options.png">
</figure>

<p>
	Data will be dynamically  updated  in all sections and the products added in the listing will be automatically added to the widget and to the wishlist page.
</p>

<p>
	The wishlist table is displayed with the help of <strong>[tm_woo_wishlist_table]</strong> shortcode. The following options are available:
</p>

<ul class="marked-list">
		<li>	
			<dl class="inline-term">
				<dt>	
					сols  
				</dt>
					<dd>
						Number of columns.
					</dd>
			</dl>
		</li>
		<li>	
			<dl class="inline-term">
				<dt>	
					image_size
				</dt>
					<dd>
						Picture size.
					</dd>
			</dl>
		</li>
		<li>	
			<dl class="inline-term">
				<dt>	
					template
				</dt>
					<dd>
						Choose template shortcode.
					</dd>
			</dl>
		</li>
		<li>	
			<dl class="inline-term">
				<dt>	
					сlass
				</dt>
					<dd>
						Table custom class.
					</dd>
			</dl>
		</li>
</ul>

<h5>Wishlist page templates</h5>
<p>
	The default table template on the compare page - page.tmpl
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
					%%STOCKSTATUS%%
				</dt>
					<dd>
						Display product status in stock.
					</dd>
			</dl>
		</li>
</ul>