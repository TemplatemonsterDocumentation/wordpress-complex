<h4>AJAX Filter Main Options:</h4>
<h5>
    Here you can find the options to customize the look and performance of the filter in accordance with the specifications of your site.  
</h5>

<p>
    The TM Compare settings page offers the following options:
</p>
<ul class="marked-list">
        <li>    
            <dl class="inline-term">
                <dt>    
                    Title 
                </dt>
                    <dd>
                        Widget title
                    </dd>
            </dl>
        </li>
        <li>    
            <dl class="inline-term">
                <dt>    
                    Attribute   
                </dt>
                    <dd>
                        Filter By attribute
                    </dd>
            </dl>
        </li>
        <li>    
            <dl class="inline-term">
                <dt>    
                    Display type
                </dt>
                    <dd>
                        Filter display type
                    </dd>
            </dl>
        </li>
        <li>    
            <dl class="inline-term">
                <dt>    
                    Query type
                </dt>
                    <dd>
                        Allows to combine value of the same attribute in the filter. This option is available in filter by attributes variant
                    </dd>
            </dl>
        </li>
    </ul>


<h4>Price Filter Attributes </h4>

<p>
    If "Price" is set as an attribute you can switch the display type between:
</p>

<h5>Slider</h5>

<figure class="img-polaroid">
    <img src="projects/<?php echo $project;?>/img/widgets/price-slider.png">
</figure>

<h5>Inputs</h5>

<figure class="img-polaroid">
    <img src="projects/<?php echo $project;?>/img/widgets/price-inputs.png">
</figure>



<h4> Filter By Attributes </h4>
<p>
    This filter type takes any parameter as filter by attribute. Attributes list is formed automatically from all created product attributes. In this case, two display types are available:
</p>

<h5>Dropdown</h5>

<figure class="img-polaroid">
    <img src="projects/<?php echo $project;?>/img/widgets/dropdown.png">
</figure>

<h5>List</h5>

<figure class="img-polaroid">
    <img src="projects/<?php echo $project;?>/img/widgets/list.png">
</figure>

<p>
    The plugin also features a filter tab that displays all selected filters which can be reset.
</p>

<figure class="img-polaroid">
    <img src="projects/<?php echo $project;?>/img/widgets/filter-tab.png">
</figure>

<h4>Hooks that allow to customize the query menu</h4>

<ul class="marked-list">
        <li>    
            <dl class="inline-term">
                <dt>    
                    apply_filters( 'tw_wc_filters_dismiss_icon', ' < span class="dashicons dashicons-dismiss">< /span>' )
                </dt>
                    <dd>
                       Returns html filter reset button
                    </dd>
            </dl>
        </li>
        <li>    
            <dl class="inline-term">
                <dt>    
                apply_filters( 'tw_wc_price_filters__wrapper_open', '< div class="tm-wc-ajax-filters-wrapper">' )
                </dt>
                    <dd>
                        Returns opening html container of the entire menu
                    </dd>
            </dl>
        </li>
        <li>    
            <dl class="inline-term">
                <dt>    
                    apply_filters( 'tw_wc_price_filters_open', '< span class="tm-wc-ajax-filters-price">' )
                </dt>
                    <dd>
                      Returns opening html container of the price filter
                    </dd>
            </dl>
        </li>
        <li>    
            <dl class="inline-term">
                <dt>    
                    apply_filters( 'tw_wc_price_filters_to', $html, $to_text, $max_price )
                </dt>
                    <dd>
                        Returns html of the  end price filter
                    </dd>
            </dl>
        </li>
        <li>    
            <dl class="inline-term">
                <dt>    
                    apply_filters( 'tw_wc_price_filters_close', '</ span>' )
                </dt>
                    <dd>
                        Returns closing html container of the price filter
                    </dd>
            </dl>
        </li>
        <li>    
            <dl class="inline-term">
                <dt>    
                    apply_filters( 'tw_wc_attribute_filters_open', '< span class="tm-wc-ajax-filters-attribute">' )
                </dt>
                    <dd>
                        Returns opening html container of the attribute filter
                    </dd>
            </dl>
        </li>
        <li>    
            <dl class="inline-term">
                <dt>    
                    apply_filters( 'tw_wc_attribute_filters_close', '</ span>' )
                </dt>
                    <dd>
                        Returns closing html container of the attribute filter
                    </dd>
            </dl>
        </li>
        <li>    
            <dl class="inline-term">
                <dt>    
                    apply_filters( 'tw_wc_price_filters__reset_link', $html, $reset_link, $reset_text )
                </dt>
                    <dd>
                        Returns all filters reset button html
                    </dd>
            </dl>
        </li>
        <li>    
            <dl class="inline-term">
                <dt>    
                    apply_filters( 'tw_wc_price_filters__wrapper_close', '< /div>' )
                </dt>
                    <dd>
                        Returns closing html container of the entire query menu
                    </dd>
            </dl>
        </li>
</ul>
<p>
    In addition, all major standard WooCommerce hooks related to WooCommerce Layered Nav and WooCommerce Price Filter  are supported.
</p>

<h4>Hooks related to the plugin:</h4>

<ul class="marked-list">
        <li>    
            <dl class="inline-term">
                <dt>    
                    add_action( 'woocommerce_after_subcategory', 'tm_wc_ajax_filters_after_subcategory', 11, 2 )
                </dt>
                    <dd>
                       Action adds products layout switch buttons in products listing
                    </dd>
            </dl>
        </li>
        <li>    
            <dl class="inline-term">
                <dt>    
                    remove_action( 'woocommerce_shop_loop_subcategory_title', 'woocommerce_template_loop_category_title', 10 )
                </dt>
                    <dd>
                        Deletes the category title display default  action
                    </dd>
            </dl>
        </li>
        <li>    
            <dl class="inline-term">
                <dt>    
                    add_action( 'woocommerce_shop_loop_subcategory_title', 'tm_wc_ajax_filters_shop_loop_subcategory_title', 10, 2 )
                </dt>
                    <dd>
                      Category title display action
                    </dd>
            </dl>
        </li>
        <li>    
            <dl class="inline-term">
                <dt>    
                    apply_filters( 'tm_wc_ajax_filters_button_preloader', '' )
                </dt>
                    <dd>
                        Filter that allows to add a custom preloader to the plugin buttons
                    </dd>
            </dl>
        </li>
        <li>    
            <dl class="inline-term">
                <dt>    
                    apply_filters( 'tm_wc_ajax_filters_loadmore_button', $html, $link, $classes, $text, $preloader )
                </dt>
                    <dd>
                        "Load More" button HTML structure filter
                    </dd>
            </dl>
        </li>
</ul>        

<h6>Plugin Settings</h6>

<figure class="img-polaroid">
    <img src="projects/<?php echo $project;?>/img/widgets/plugin-settings.png">
</figure>

<ul class="marked-list">
        <li>    
            <dl class="inline-term">
                <dt>    
                    Enable grid-list
                </dt>
                    <dd>
                       Enables layout switcher in product listing
                    </dd>
            </dl>
        </li>
</ul>   
<p>
    After switching to the list layout the product listing reloads dynamically.  Content-product-list.php template and content-product_cat-list.php are added to the products and categories respectively. These templates are located in tm-woocommerce-ajax-filters\templates\ folder. You can rewrite the templates right in the theme in the same way as with any other <a href="https://docs.woocommerce.com/document/template-structure/">WooCommerce template</a>. The point is that a single parameter - ‘list’ is added to all hooks in all templates, for instance:
</p>
<strong>
    do_action( 'woocommerce_before_shop_loop_item', 'list' );
</strong>
<p>
    During creation of the filter you can check this parameter and execute the following code. For example:
</p>
<p>
    We need to display the description for the categories, for that we need to add the hook
</p>
<strong>
    add_action( 'woocommerce_after_subcategory', '__tm_wc_ajax_filters_after_subcategory', 11, 2 );
</strong>
<p>
    And define a callback function
</p>
<pre style="background-color:#cecece; font-style:italic; padding:20px">
    <em>function tm_wc_ajax_filters_after_subcategory( $category, $atts = '' ) {
       if ( 'list' === $atts ) {
           echo '< div class="product-category__description">' . $category->category_description . '</ div>';
       }
    }</em>
</pre>

<p>
    In the given example we check the $atts parameter and if it is equal to ‘list’, category description is displayed. 
</p>
<figure class="img-polaroid">
    <img src="projects/<?php echo $project;?>/img/widgets/grid-list.png">
</figure>

<ul class="marked-list">
        <li>    
            <dl class="inline-term">
                <dt>    
                    Enable AJAX ordering
                </dt>
                    <dd>
                        Enables AJAX - product ordering when changing filter type
                    </dd>
            </dl>
        </li>
</ul>   

<figure class="img-polaroid">
    <img src="projects/<?php echo $project;?>/img/widgets/ordering.png">
</figure>

<ul class="marked-list">
        <li>    
            <dl class="inline-term">
                <dt>    
                    Enable AJAX pagination
                </dt>
                    <dd>
                        Enables AJAX - product ordering when navigating to another page through pagination
                    </dd>
            </dl>
        </li>
</ul>  

<ul class="marked-list">
        <li>    
            <dl class="inline-term">
                <dt>    
                    Enable AJAX Load More button
                </dt>
                    <dd>
                        Enables “Load More” button before pagination. The button loads products from the next pagination page
                    </dd>
            </dl>
        </li>
</ul>  

<figure class="img-polaroid">
    <img src="projects/<?php echo $project;?>/img/widgets/load-more.png">
</figure>

<ul class="marked-list">
        <li>    
            <dl class="inline-term">
                <dt>    
                    Load More button label
                </dt>
                    <dd>
                        “Load More” button text
                    </dd>
            </dl>
        </li>
        <li>    
            <dl class="inline-term">
                <dt>    
                    Load More threshold on desktop
                </dt>
                    <dd>
                        Max number of products that can be loaded with the “Load More” button on desktop
                    </dd>
            </dl>
        </li>
        <li>    
            <dl class="inline-term">
                <dt>    
                    Load More threshold on desktop
                </dt>
                    <dd>
                        Max number of products that can be loaded with the “Load More” button on mobile devices
                    </dd>
            </dl>
        </li>
</ul> 

