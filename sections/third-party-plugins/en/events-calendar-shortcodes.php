	<h3>The Events Calendar Shortcode</h3>

	<p>This plugin adds a shortcode for use with The Events Calendar Plugin.
    With this plugin, just add the shortcode on a page to display a list of your events. For example to show next 8 events in the category festival:</p>

         <div class="alert alert-info">
        [ecs-list-events cat="festival" limit="8"]
    </div>


    <figure class="img-polaroid">
        <img src="img/third_party_plugins/events-calendar-shortcodes.png">
    </figure>


<h4>Shortcode Options</h4>


    <ul class="marked-list">
    <li>
        <dl class="inline-term">
            <dt> Basic shortcode</dt>
            <dd>
                [ecs-list-events]
            </dd>
        </dl>
    </li>

    <li>
        <dl class="inline-term">
            <dt> Cat – Represents single event category</dt>
            <dd>
                 [ecs-list-events cat='festival']
            </dd>
        </dl>
    </li>

    <li>
        <dl class="inline-term">
            <dt> Limit – Total number of events to show</dt>
            <dd>
                [ecs-list-events limit='3']
            </dd>
        </dl>
    </li>

    <li>
        <dl class="inline-term">
            <dt>Order – Order of the events to be shown</dt>
            <dd>
                Value can be ‘ASC’ or ‘DESC’. Default is ‘ASC’. Order is based on event date. [ecs-list-events order='DESC']
            </dd>
            </dd>
        </dl>
    </li>

    <li>
        <dl class="inline-term">
            <dt>Date – To show or hide date</dt>
            <dd>
                 Value can be ‘true’ or ‘false’. Default is true. [ecs-list-events eventdetails='false']
            </dd>
        </dl>
    </li>

    <li>
        <dl class="inline-term">
            <dt>Venue – To show or hide the venue</dt>
            <dd>
                Value can be ‘true’ or ‘false’. Default is false. [ecs-list-events venue='true']
            </dd>
        </dl>
    </li>

    <li>
        <dl class="inline-term">
            <dt>Excerpt – To show or hide the excerpt and set excerpt length</dt>
            <dd>
                [ecs-list-events excerpt='true'] displays excerpt with length 100
            </dd>
        </dl>
    </li>

    <li>
        <dl class="inline-term">
            <dt>Thumb – To show or hide thumbnail image</dt>
            <dd>
                [ecs-list-events thumb='true'] displays post thumbnail in default thumbnail dimension from media settings.

            </dd>
        </dl>
    </li>

    <li>
        <dl class="inline-term">
            <dt>Message – Message to show when there are no events</dt>
            <dd>
                 Defaults to ‘There are no upcoming events at this time.’

            </dd>
        </dl>
    </li>

    <li>
        <dl class="inline-term">
            <dt>Viewall – determines whether to show ‘View all events’ or not</dt>
            <dd>
                Values can be ‘true’ or ‘false’. Default to ‘true’ [ecs-list-events cat='festival' limit='3' order='DESC' viewall='false']
            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Contentorder – manage the order of content with commas</dt>
            <dd>
                Default to title, thumbnail, excerpt, date, venue. [ecs-list-events cat='festival' limit='3' order='DESC' viewall='false' contentorder='title, thumbnail, excerpt, date, venue']

            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Month – show only specific Month</dt>
            <dd>
                Type ‘current’ for displaying current month only [ecs-list-events cat=’festival’ month=’2015-06′]

            </dd>
        </dl>
    </li>
    <li>
        <dl class="inline-term">
            <dt>Past – show Outdated Events</dt>
            <dd>
                [ecs-list-events cat='festival' past='yes']
            </dd>
        </dl>
    </li>
    </li>
        <li>
        <dl class="inline-term">
            <dt>Key – order with Start Date</dt>
            <dd>
                 [ecs-list-events cat='festival' key='start date']

            </dd>
        </dl>
    </li>
</ul>

