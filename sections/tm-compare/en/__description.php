<h4>WooCommerce Compare</h4>
<h5>
    WooCompare allows you to compare products based on product properties. Add the desired products to the product comparison page by clicking "Add to compare" button on the product or product catalog pages. WooCompare also includes a widget that lets you output the products added to the comparison list. Using this widget you can also delete the products, empty the comparison list, or go to the product comparison page.
</h5>

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
                        The hook  adds the Add to Compare  or Remove button in the product list.
                    </dd>
            </dl>
        </li>
        <li>    
            <dl class="inline-term">
                <dt>    
                    add_action( 'woocommerce_single_product_summary', 'tm_woocompare_add_button', 35 );
                </dt>
                    <dd>
                        The hook adds the Add to Compare  or Remove button on the product page.
                    </dd>
            </dl>
        </li>
        <li>    
            <dl class="inline-term">
                <dt>    
                    apply_filters( 'tm_woocompare_preloader', '' )

                </dt>
                    <dd>
                        The hook allows to add a custom preloader to the Add Product or Remove button.

                    </dd>
            </dl>
        </li>
        <li>    
            <dl class="inline-term">
                <dt>    
                    apply_filters( 'tm_woocompare_list_loader', $loader )
                </dt>
                    <dd>
                        The hook allows to change the compare tables and widgets preloader.
                    </dd>
            </dl>
        </li>
        <li>    
            <dl class="inline-term">
                <dt>    
                    apply_filters( 'tm_woocompare_button', $html, $classes, $id, $nonce, $text, $preloader )
                </dt>
                    <dd>
                        "Add to compare" button display filter
                    </dd>
            </dl>
        </li>
         <li>    
            <dl class="inline-term">
                <dt>    
                    apply_filters( 'tm_woocompare_page_button', $html, $classes, $link, $text )
                </dt>
                    <dd>
                        "View compare" button display filter
                    </dd>
            </dl>
        </li>
         <li>    
            <dl class="inline-term">
                <dt>    
                    apply_filters( 'tm_woocompare_dismiss_icon', '&lt;span class="dashicons dashicons-dismiss"&gt;' )
                </dt>
                    <dd>
                        Delete button display filter 
                    </dd>
            </dl>
        </li>
        <li>    
            <dl class="inline-term">
                <dt>    
                  apply_filters( 'tm_woocompare_empty_message', $html, $empty_text )
                </dt>
                    <dd>
                       Message display filter if compare list is empty
                    </dd>
            </dl>
        </li>
        <li>    
            <dl class="inline-term">
                <dt>    
                  apply_filters( 'tm_woocommerce_list_product_title', $html, $link, $title, $product )
                </dt>
                    <dd>
                       Product title display filter
                    </dd>
            </dl>
        </li>
        <li>    
            <dl class="inline-term">
                <dt>    
                apply_filters( 'tm_woocommerce_list_product_image', $html, $link, $image )
                </dt>
                    <dd>
                       Product image display filter 
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
                                            Defines whether to display a cover picture if the product doesn’t have one. Takes <strong>true|false</strong>. true by default.
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
<h5>Widget template</h5>
<p>
Default table template on a compare page - <strong>widget.tmpl</strong>
</p>
<p>
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
                                            Defines whether to display a cover picture if the product doesn’t have one. Takes <strong>true|false</strong>. true by default.
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
</ul>
</article>

<p>
    <strong>[tm_woo_compare_table]</strong> shortcode is added to the "Compare" page (if the page is absent in database it will be created automatically). This page is added to the Select compare page plugin option. 
</p>
<p>
    If the page exists, <strong>[tm_woo_compare_table] </strong> shortcode will be added to the page content. If the shortcode is already inserted, no changes will be made. 
</p>