<h4>WishList</h4>
<h5>WooWishlist allows your visitors to add products to their wishlist with a single click of a mouse. Showcase the wishlist in a widget area or on a separate page. If a product was added into the wishlist unintentionally, customers can remove it. As the plugin is powered by Ajax, the wishlist and its widget are updated dynamically, without page reloading.
</h5>
<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/widgets/wishlist-1.png">
</figure>
<article>
    The plugin offers the following options:

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
                        Choose the page to display the wishlist.
                    </dd>
            </dl>
        </li>
        <li>    
            <dl class="inline-term">
                <dt>
                    Show in catalog
                </dt>
                    <dd>
                        Display the "Add to wishlist" button on the products page.
                    </dd>
            </dl>
        </li>
        <li>    
            <dl class="inline-term">
                <dt>
                    Show in products page
                </dt>
                    <dd>
                        Display the "Add to wishlist" button on the product page.
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
                        Specify wishlist button text for the products that are already added to the list.
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
</article>
<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/widgets/wishlist-options.png">
</figure>

<p>
    Data will be dynamically updated in all sections and the products added in the listing will be automatically added to the widget and to the wishlist page.
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

<h5>Shortcode-templates options</h5>
<p>
    Table and wishlist widget are built on tmpl.
</p>
<p>
    Templates are located in <strong>templates\shortcodes\tm-woowishlist\</strong> folder
</p>
<p>
You can rewrite the templates by copying them to the <strong>uploads\templates\shortcodes\tm-woowishlist\</strong> folder or to the <strong>woocommerce\shortcodes\tm-woowishlist\</strong> folder inside the theme. You can also change the names of the templates.
</p>

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
<h5>Customize functionality with hooks</h5>
<ul class="marked-list">
        <li>    
            <dl class="inline-term">
                <dt>    
                    add_action( 'woocommerce_after_shop_loop_item', 'tm_woowishlist_add_button_loop', 12 )
                </dt>
                    <dd>
                      The hook adds  the "Ad to wishlist" button on the products page
                    </dd>
            </dl>
        </li>
        <li>    
            <dl class="inline-term">
                <dt>    
                    add_action( 'woocommerce_single_product_summary', 'tm_woowishlist_add_button_single', 35 )
                </dt>
                    <dd>
                      The hook adds the "Ad to wishlist" button on a product page
                    </dd>
            </dl>
        </li>
        <li>    
            <dl class="inline-term">
                <dt>    
                    apply_filters( 'tm_wc_compare_wishlist_button_preloader', '' )
                </dt>
                    <dd>
                      The hook allows to add a custom preloader to the "Add to wishlist" button 
                    </dd>
            </dl>
        </li>
        <li>    
            <dl class="inline-term">
                <dt>    
                    apply_filters( 'tm_wc_compare_wishlist_loader', $loader )
                </dt>
                    <dd>
                      The hook allows to change the preloader of the wishlist and widget
                    </dd>
            </dl>
        </li>
        <li>    
            <dl class="inline-term">
                <dt>    
                    apply_filters( 'tm_woowishlist_button', $html, $classes, $id, $nonce, $text, $preloader )
                </dt>
                    <dd>
                       "Add to wishlist" button display filter
                    </dd>
            </dl>
        </li>
        <li>    
            <dl class="inline-term">
                <dt>    
                    apply_filters( 'tm_woowishlist_page_button', $html, $classes, $link, $text )
                </dt>
                    <dd>
                      "Go to my wishlist" button display filter
                    </dd>
            </dl>
        </li>
        <li>    
            <dl class="inline-term">
                <dt>    
                    apply_filters( 'tm_woocommerce_include_bootstrap_grid', true )
                </dt>
                    <dd>
                      Filter that allows to disable the Bootstrap grid for the wishlist page
                    </dd>
            </dl>
        </li>
        <li>    
            <dl class="inline-term">
                <dt>    
                    apply_filters( 'tm_woowishlist_empty_message', $html, $empty_text )
                </dt>
                    <dd>
                      Filter that displays a message if the wishlist is empty
                    </dd>
            </dl>
        </li>
        <li>    
            <dl class="inline-term">
                <dt>    
                    apply_filters( 'tm_woowishlist_dismiss_icon', '&lt;<span class="dashicons dashicons-dismiss"></span>&gt;' )
                </dt>
                    <dd>
                      "Product delete" button display filter
                    </dd>
            </dl>
        </li>
</ul>        

<p>
    <strong>[tm_woo_wishlist_table]</strong> shortcode is added to the "Compare" page (if the page is absent in database it will be created automatically). This page is added to the Select wishlist page plugin option. 
</p>
<p>
    If the page exists, <strong>[tm_woo_wishlist_table] </strong> shortcode will be added to the page content. If the shortcode is already inserted, no changes will be made. 
</p>