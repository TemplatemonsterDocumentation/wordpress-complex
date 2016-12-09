
<?php if ($project =='cherry_trending_posts')

 { ?>

<h2>Widget</h2>
<p>
You can add the posts to the pages with the help of widget which offers you the following settings. 
</p>

<ol class="index-list">
    <li>Title - Specify the widget title</li>
    <li>Title length in characters (0 -- hide, -1 -- full)  - Set title length </li>
    <li>Filter by 
         <ul class="marked-list">
            <li>
                <dl class="inline-term">
                    <dt>Views  </dt>
                    <dd>
                         Filter posts by Views
                    </dd>
                </dl>
            </li>
            <li>
                <dl class="inline-term">
                    <dt> Rating </dt>
                    <dd>
                        Filter posts by Rating
                    </dd>
                </dl>
            </li>
            <li>
                <dl class="inline-term">
                    <dt> Comments</dt>
                    <dd>
                        Filter posts by Comments

                    </dd>
                </dl>
            </li>
        </ul>    
    </li>
    <li>Select rating type 
        <ul class="marked-list">
            <li>
                <dl class="inline-term">
                    <dt>Most Rated</dt>
                    <dd>
                        Filter posts by Most Rated type
                    </dd>
                </dl>
            </li>
            <li>
                <dl class="inline-term">
                    <dt>Highest Rated </dt>
                    <dd>
                        Filter posts by the highest rate
                    </dd>
                </dl>
            </li>
        </ul>    
    </li>
    <li>
        Show from
        <ul class="marked-list">
            <li>
                <dl class="inline-term">
                    <dt>Category</dt>
                    <dd>
                        Show posts from category
                    </dd>
                </dl>
            </li>
            <li>
                <dl class="inline-term">
                    <dt>Tag </dt>
                    <dd>
                        Show posts by tags
                    </dd>
                </dl>
            </li>
        </ul>    
    </li>
    <li>
        Number of post to show (Use -1 to show all posts) - Here you can define the number of posts to display
    </li>
    <li>
        Offset (ignored when `posts_per_page`=>-1 (show all posts) is used) - This property specifies the number of post to displace or pass over
    </li>
    <li>
        Excerpt length in words (0 -- hide, -1 -- all) -This property sets the number of words limit for excerpt
    </li>
    <li>
        Display meta - This feature adds metadata to the post
        <ul class="marked-list">
            <li>
                <dl class="inline-term">
                    <dt>Date</dt>
                </dl>
            </li>
            <li>
                <dl class="inline-term">
                    <dt>Author</dt>
                </dl>
            </li>
            <li>
                <dl class="inline-term">
                    <dt>View</dt>
                </dl>
            </li>
            <li>
                <dl class="inline-term">
                    <dt>Rating</dt>
                </dl>
            </li>
            <li>
                <dl class="inline-term">
                    <dt>Comments</dt>
                </dl>
            </li>
            <li>
                <dl class="inline-term">
                    <dt>Category</dt>
                </dl>
            </li>
            <li>
                <dl class="inline-term">
                    <dt>Tag</dt>
                </dl>
            </li>
            <li>
                <dl class="inline-term">
                    <dt>Read More</dt>
                </dl>
            </li>
        </ul>    
    </li>
    <li>
        Button text -  Add text to the button
    </li>
</ol>

<figure class="img-polaroid">
        <img src="projects/<?php echo $project;?>/img/images/widget.jpg">
</figure>

<?php } ?>