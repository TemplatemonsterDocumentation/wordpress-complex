<?php if ($project =='cherry_team')

 { ?>
<h2>Settings</h2>
<p>
All plugin options are gathered in Team -> Settings
</p>

    <ul class="marked-list">
        <li>    
            <dl class="inline-term">
                <dt>    
                    Select team archive page
                </dt>
                    <dd>
                        Choose the archive page for Team posts
                    </dd>
            </dl>
        </li>
        <li>    
            <dl class="inline-term">
                <dt>
                    Set posts number per archive page
                </dt>
                    <dd>
                        Set the number of posts to display on the archive page and on the Team category pages. This option is not included into the shortcode
                    </dd>
            </dl>
        </li>
        <li>    
            <dl class="inline-term">
                <dt>
                    Select archive page columns number
                </dt>
                    <dd>
                        Number of columns for the posts on the archive page and Team  category pages.  This option is not included into the shortcode (4 max)
                    </dd>
            </dl>
        </li>
        <li>    
            <dl class="inline-term">
                <dt>
                    Select template for single team member page
                </dt>
                    <dd>
                        Choose a proper template for a single Team member page
                    </dd>
            </dl>
        </li>
        <li>    
            <dl class="inline-term">
                <dt>
                    Select image size for single team member page
                </dt>
                    <dd>
                        Choose a featured image size for a single team member page. In the dropdown menu you can choose from all available sizes. It is strongly recommended to use the Regenerate Thumbnails plugin before changing this option
                    </dd>
            </dl>
        </li> 
        <li>    
            <dl class="inline-term">
                <dt>
                    Select template for team listing page
                </dt>
                    <dd>
                        Choose a proper template for displaying Team posts items. (Works for archives page and category pages)
                    </dd>
            </dl>
        </li> 
        <li>    
            <dl class="inline-term">
                <dt>
                    Select image size for listing team member page
                </dt>
                    <dd>
                        Choose featured image size for items in Team posts listing type. (Works for archives page and category pages). In the dropdown menu you can choose from all available sizes. It is strongly recommended to use the Regenerate Thumbnails plugin before changing this option
                    </dd>
            </dl>
        </li>  
    </ul>

<figure class="img-polaroid">
    <img src="projects/<?php echo $project;?>/img/images/settings.png">
</figure>

<h2>Shortcode</h2>
<p>
Shortcode is used to display the posts list with set parameters. Shortcode attributes:
</p>

    <ul class="marked-list">
        <li>    
            <dl class="inline-term">
                <dt>    
                    super_title (default = '')
                </dt>
                    <dd>
                        Additional block title with the posts list. Displayed above the major title
                    </dd>
            </dl>
        </li>
        <li>    
            <dl class="inline-term">
                <dt>
                    title (default = '')
                </dt>
                    <dd>
                        Main block title with the posts list
                    </dd>
            </dl>
        </li>
        <li>    
            <dl class="inline-term">
                <dt>
                    subtitle (default = '')
                </dt>
                    <dd>
                        Additional block title with the posts list. Displayed under the major title
                    </dd>
            </dl>
        </li>
        <li>    
            <dl class="inline-term">
                <dt>
                    columns (default = 3)
                </dt>
                    <dd>
                        Number of columns for desktop (6 col - max)
                    </dd>
            </dl>
        </li>
        <li>    
            <dl class="inline-term">
                <dt>
                    columns_tablet (default = 2)
                </dt>
                    <dd>
                        Number of columns for tablet
                    </dd>
            </dl>
        </li> 
        <li>    
            <dl class="inline-term">
                <dt>
                    columns_phone (default = 1)
                </dt>
                    <dd>
                        Number of columns for phones
                    </dd>
            </dl>
        </li> 
        <li>    
            <dl class="inline-term">
                <dt>
                    posts_per_page (default = 6)
                </dt>
                    <dd>
                        Number of posts per page
                    </dd>
            </dl>
        </li>   
        <li>    
            <dl class="inline-term">
                <dt>
                    group (default = '')
                </dt>
                    <dd>
                        Choose posts from a certain group. If you need to render more than one group, the slugs are divided by commas
                    </dd>
            </dl>
        </li>   
        <li>    
            <dl class="inline-term">
                <dt>
                    id (default = '')
                </dt>
                    <dd>
                        Show posts at a certain ID
                    </dd>
            </dl>
        </li>    
        <li>    
            <dl class="inline-term">
                <dt>
                    more (default = true)
                </dt>
                    <dd>
                        Show or hide More button under the posts list in shortcode
                    </dd>
            </dl>
        </li>    
        <li>    
            <dl class="inline-term">
                <dt>
                    more_text (default = 'More')
                </dt>
                    <dd>
                        More button text
                    </dd>
            </dl>
        </li>    
        <li>    
            <dl class="inline-term">
                <dt>
                    more_url (default = '#')
                </dt>
                    <dd>
                        More button URL
                    </dd>
            </dl>
        </li>      
        <li>    
            <dl class="inline-term">
                <dt>
                    ajax_more (default = true)
                </dt>
                    <dd>
                        Use More button as AJAX load more button
                    </dd>
            </dl>
        </li>       
        <li>    
            <dl class="inline-term">
                <dt>
                    pagination (default = false)
                </dt>
                    <dd>
                        Show/hide pagination
                    </dd>
            </dl>
        </li>      
        <li>    
            <dl class="inline-term">
                <dt>
                    show_filters (default = false)
                </dt>
                    <dd>
                        Show/hide group AJAX filter before products list in shortcode
                    </dd>
            </dl>
        </li>      
        <li>    
            <dl class="inline-term">
                <dt>
                    show_name (default = true)
                </dt>
                    <dd>
                        Show/hide person's name in the list
                    </dd>
            </dl>
        </li>      
        <li>    
            <dl class="inline-term">
                <dt>
                    show_photo (default = true)
                </dt>
                    <dd>
                        Show/hide photo (featured image )
                    </dd>
            </dl>
        </li>      
        <li>    
            <dl class="inline-term">
                <dt>
                    show_desc (default = true)
                </dt>
                    <dd>
                        Show/hide short description
                    </dd>
            </dl>
        </li>      
        <li>    
            <dl class="inline-term">
                <dt>
                    excerpt_length (default = 20)
                </dt>
                    <dd>
                        Max word length in short description
                    </dd>
            </dl>
        </li>      
        <li>    
            <dl class="inline-term">
                <dt>
                    show_position (default = true)
                </dt>
                    <dd>
                        Show/hide position
                    </dd>
            </dl>
        </li>      
        <li>    
            <dl class="inline-term">
                <dt>
                    show_social (default = true)
                </dt>
                    <dd>
                        Show/hide list of social links
                    </dd>
            </dl>
        </li>      
        <li>    
            <dl class="inline-term">
                <dt>
                    image_size (default = 'thumbnail') 
                </dt>
                    <dd>
                        Choose the size of the image displayed in the posts list
                    </dd>
            </dl>
        </li>      
        <li>    
            <dl class="inline-term">
                <dt>
                    template (default = 'default')
                </dt>
                    <dd>
                        Choose posts list display template
                    </dd>
            </dl>
        </li>      
        <li>    
            <dl class="inline-term">
                <dt>
                    use_space (default = true)
                </dt>
                    <dd>
                        Add 30px horizontal spaces between the columns
                    </dd>
            </dl>
        </li>      
        <li>    
            <dl class="inline-term">
                <dt>
                    use_rows_space (default = true)
                </dt>
                    <dd>
                        Add vertical spaces between items in posts lists
                    </dd>
            </dl>
        </li>
    </ul>

<figure class="img-polaroid">
    <img src="projects/<?php echo $project;?>/img/images/shortcode.png">
</figure>

<?php } ?>


