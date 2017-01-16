<?php
/**
 * BuddyPress Activity templates
 *
 * @since 2.3.0
 *
 * @package BuddyPress
 * @subpackage bp-legacy
 */

/**
 * Fires before the activity directory listing.
 *
 * @since 1.5.0
 */
do_action( 'bp_before_directory_activity' ); ?>
<div id="buddypress">

	<?php

	/**
	 * Fires before the activity directory display content.
	 *
	 * @since 1.2.0
	 */
	do_action( 'bp_before_directory_activity_content' ); ?>

	<?php if ( is_user_logged_in() ) : ?>

		<?php bp_get_template_part( 'activity/post-form' ); ?>

	<?php endif; ?>

	<div class="item-list-tabs no-ajax" id="subnav" role="navigation">
		<ul>
			<li class="selected" id="activity-all">
				<a href="<?php bp_activity_directory_permalink(); ?>" title="<?php esc_attr__( 'The public activity for everyone on this site.', 'monstroid2' ); ?>">
					<?php printf( esc_html__( 'All Members ', 'monstroid2' ) . '%s', '<span>' . bp_get_total_member_count() . '</span>' ); ?>
				</a>
			</li>

			<li class="feed">
				<a href="<?php bp_sitewide_activity_feed_link(); ?>" title="<?php esc_attr__( 'RSS Feed', 'monstroid2' ); ?>">
					<?php esc_html_e( 'RSS', 'monstroid2' ); ?>
				</a>
			</li>

			<?php

			/**
			 * Fires before the display of the activity syndication options.
			 *
			 * @since 1.2.0
			 */
			do_action( 'bp_activity_syndication_options' ); ?>

			<li id="activity-filter-select" class="last">
				<label for="activity-filter-by"><?php esc_html_e( 'Show:', 'monstroid2' ); ?></label>
				<select id="activity-filter-by">
					<option value="-1"><?php esc_html_e( '&mdash; Everything &mdash;', 'monstroid2' ); ?></option>

					<?php bp_activity_show_filters(); ?>

					<?php

					/**
					 * Fires inside the select input for activity filter by options.
					 *
					 * @since 1.2.0
					 */
					do_action( 'bp_activity_filter_options' ); ?>

				</select>
			</li>
		</ul>
	</div><!-- .item-list-tabs -->

	<?php

	/**
	 * Fires towards the top of template pages for notice display.
	 *
	 * @since 1.0.0
	 */
	do_action( 'template_notices' ); ?>

	<div class="item-list-tabs activity-type-tabs" role="navigation">
		<ul>
			<?php

			/**
			 * Fires before the listing of activity type tabs.
			 *
			 * @since 1.2.0
			 */
			do_action( 'bp_before_activity_type_tab_all' ); ?>


			<?php if ( is_user_logged_in() ) : ?>

				<?php

				/**
				 * Fires before the listing of friends activity type tab.
				 *
				 * @since 1.2.0
				 */
				do_action( 'bp_before_activity_type_tab_friends' ); ?>

				<?php if ( bp_is_active( 'friends' ) ) : ?>

					<?php if ( bp_get_total_friend_count( bp_loggedin_user_id() ) ) : ?>

						<li id="activity-friends">
							<a href="<?php echo bp_loggedin_user_domain() . bp_get_activity_slug() . '/' . bp_get_friends_slug() . '/'; ?>" title="<?php esc_attr__( 'The activity of my friends only.', 'monstroid2' ); ?>">
								<?php printf( esc_html__( 'My Friends ', 'monstroid2' ). '%s', '<span>' . bp_get_total_friend_count( bp_loggedin_user_id() ) . '</span>' ); ?>
							</a>
						</li>

					<?php endif; ?>

				<?php endif; ?>

				<?php

				/**
				 * Fires before the listing of groups activity type tab.
				 *
				 * @since 1.2.0
				 */
				do_action( 'bp_before_activity_type_tab_groups' ); ?>

				<?php if ( bp_is_active( 'groups' ) ) : ?>

					<?php if ( bp_get_total_group_count_for_user( bp_loggedin_user_id() ) ) : ?>

						<li id="activity-groups">
							<a href="<?php echo bp_loggedin_user_domain() . bp_get_activity_slug() . '/' . bp_get_groups_slug() . '/'; ?>" title="<?php esc_attr__( 'The activity of groups I am a member of.', 'monstroid2' ); ?>">
								<?php printf( esc_html__( 'My Groups ', 'monstroid2' ). '%s', '<span>' . bp_get_total_group_count_for_user( bp_loggedin_user_id() ) . '</span>' ); ?>
							</a>
						</li>

					<?php endif; ?>

				<?php endif; ?>

				<?php

				/**
				 * Fires before the listing of favorites activity type tab.
				 *
				 * @since 1.2.0
				 */
				do_action( 'bp_before_activity_type_tab_favorites' ); ?>

				<?php if ( bp_get_total_favorite_count_for_user( bp_loggedin_user_id() ) ) : ?>

					<li id="activity-favorites">
						<a href="<?php echo bp_loggedin_user_domain() . bp_get_activity_slug() . '/favorites/'; ?>" title="<?php esc_attr__( "The activity I've marked as a favorite.", 'monstroid2' ); ?>">
							<?php printf( esc_html__( 'My Favorites ', 'monstroid2' ). '%s', '<span>' . bp_get_total_favorite_count_for_user( bp_loggedin_user_id() ) . '</span>' ); ?>
						</a>
					</li>

				<?php endif; ?>

				<?php if ( bp_activity_do_mentions() ) : ?>

					<?php

					/**
					 * Fires before the listing of mentions activity type tab.
					 *
					 * @since 1.2.0
					 */
					do_action( 'bp_before_activity_type_tab_mentions' ); ?>

					<li id="activity-mentions">
						<a href="<?php echo bp_loggedin_user_domain() . bp_get_activity_slug() . '/mentions/'; ?>" title="<?php esc_attr_e( 'Activity that I have been mentioned in.', 'monstroid2' ); ?>">
							<?php esc_html_e( 'Mentions', 'monstroid2' ); ?><?php if ( bp_get_total_mention_count_for_user( bp_loggedin_user_id() ) ) : ?>
							<strong>
								<span><?php printf( _nx( '%s new', '%s new', bp_get_total_mention_count_for_user( bp_loggedin_user_id() ), 'Number of new activity mentions', 'monstroid2' ), bp_get_total_mention_count_for_user( bp_loggedin_user_id() ) ); ?></span>
							</strong><?php endif; ?>
						</a>
					</li>

				<?php endif; ?>

			<?php endif; ?>

			<?php

			/**
			 * Fires after the listing of activity type tabs.
			 *
			 * @since 1.2.0
			 */
			do_action( 'bp_activity_type_tabs' ); ?>
		</ul>
	</div><!-- .item-list-tabs -->


	<?php

	/**
	 * Fires before the display of the activity list.
	 *
	 * @since 1.5.0
	 */
	do_action( 'bp_before_directory_activity_list' ); ?>

	<div class="activity">

		<?php bp_get_template_part( 'activity/activity-loop' ); ?>

	</div><!-- .activity -->

	<?php

	/**
	 * Fires after the display of the activity list.
	 *
	 * @since 1.5.0
	 */
	do_action( 'bp_after_directory_activity_list' ); ?>

	<?php

	/**
	 * Fires inside and displays the activity directory display content.
	 */
	do_action( 'bp_directory_activity_content' ); ?>

	<?php

	/**
	 * Fires after the activity directory display content.
	 *
	 * @since 1.2.0
	 */
	do_action( 'bp_after_directory_activity_content' ); ?>

	<?php

	/**
	 * Fires after the activity directory listing.
	 *
	 * @since 1.5.0
	 */
	do_action( 'bp_after_directory_activity' ); ?>

</div>
