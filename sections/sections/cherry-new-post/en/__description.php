<?php if ($project =='cherry_team')

 { ?>
<h2>Adding new Post</h2>
<p>
After opening a team member profile, you will see the following fields: 
</p>
<figure class="img-polaroid">
    <img src="projects/<?php echo $project;?>/img/images/new-post.png">
</figure>

    <ul class="marked-list">
        <li>    
            <dl class="inline-term">
                <dt>    
                    Title
                </dt>
                    <dd>
                        Enter the name of a person you want to add to the team
                    </dd>
            </dl>
        </li>
        <li>    
            <dl class="inline-term">
                <dt>
                    Content
                </dt>
                    <dd>
                        Insert general information about a person
                    </dd>
            </dl>
        </li>
        <li>    
            <dl class="inline-term">
                <dt>
                    Meta box Person Options:
                </dt>
                    <li>    
                        <dl class="inline-term">
                            <dt>
                                Position
                            </dt>
                                <dd>
                                    The position. Displayed on the listing and on single page by default
                                </dd>
                        </dl>
                    </li>
                    <li>    
                        <dl class="inline-term">
                            <dt>
                                Location
                            </dt>
                                <dd>
                                    Specify the location of a person. Displayed on a single page by default
                                </dd>
                        </dl>
                    </li>
                    <li>    
                        <dl class="inline-term">
                            <dt>
                                Phone Number
                            </dt>
                                <dd>
                                    Specify the phone number.  Displayed on a single page by default
                                </dd>
                        </dl>
                    </li>
                    <li>    
                        <dl class="inline-term">
                            <dt>
                                Social profiles
                            </dt>
                                <dd>
                                    Social profiles list. Displayed on the listing page and on a single page by default. To display a certain network on the frontend you need to specify the URL address
                                </dd>
                        </dl>
                    </li>
                    <li>    
                        <dl class="inline-term">
                            <dt>
                                Skills
                            </dt>
                                <dd>
                                    A list of progress bars with skills of a person.  Displayed on a single page by default. The Skill Value field is equals to a percent index inside the progress bar. For this reason it can’t be more than 100
                                </dd>
                        </dl>
                    </li>
            </dl>
        </li>
    </ul>
<?php } ?>



<?php if ($project =='cherry_services')

 { ?>

 <h2>Adding new posts</h2>
<p>
Once the plugin is  installed, a new menu tab will come up in the left navigation panel. To add a new service you need to click on an Add New button. 
</p>

<figure class="img-polaroid">
    <img src="projects/<?php echo $project;?>/img/images/plugins-doc.png">
</figure>

<p>
    In a new window you can see the following fields:
</p>

    <ul class="marked-list">
        <li>    
            <dl class="inline-term">
                <dt>    
                    Title
                </dt>
                    <dd>
                        Insert the name of a person
                    </dd>
            </dl>
        </li>
        <li>    
            <dl class="inline-term">
                <dt>
                    Content
                </dt>
                    <dd>
                       Insert the post content
                    </dd>
            </dl>
        </li>
    </ul>    
<?php } ?>
    
