<?php
/**
 * BuddyPress - Groups
 *
 * @package BuddyPress
 * @subpackage bp-legacy
 */

/**
 * Fires at the top of the groups directory template file.
 *
 * @since 1.5.0
 */
do_action( 'bp_before_directory_groups_page' ); ?>

<div id="buddypress">

	<?php

	/**
	 * Fires before the display of the groups.
	 *
	 * @since 1.1.0
	 */
	do_action( 'bp_before_directory_groups' ); ?>

	<?php

	/**
	 * Fires before the display of the groups content.
	 *
	 * @since 1.1.0
	 */
	do_action( 'bp_before_directory_groups_content' ); ?>
	<div id="group-dir-search" class="dir-search" role="search">
		<?php bp_directory_groups_search_form(); ?>
	</div><!-- #group-dir-search -->

	<form action="" method="post" id="groups-directory-form" class="dir-form">

		<?php

		/** This action is documented in bp-templates/bp-legacy/buddypress/activity/index.php */
		do_action( 'template_notices' ); ?>

		<div class="item-list-tabs" role="navigation">
			<ul>

				<?php

				/**
				 * Fires inside the groups directory group filter input.
				 *
				 * @since 1.5.0
				 */
				do_action( 'bp_groups_directory_group_filter' ); ?>

			</ul>
		</div><!-- .item-list-tabs -->

		<div class="item-list-tabs" id="subnav" role="navigation">
			<ul>
				<?php

				/**
				 * Fires inside the groups directory group types.
				 *
				 * @since 1.2.0
				 */
				do_action( 'bp_groups_directory_group_types' ); ?>

				<li class="selected" id="groups-all"><a href="<?php bp_groups_directory_permalink(); ?>"><?php printf( esc_html__( 'All Groups ', 'monstroid2' ) . '%s', '<span>' . bp_get_total_group_count() . '</span>' ); ?></a></li>

				<?php if ( is_user_logged_in() && bp_get_total_group_count_for_user( bp_loggedin_user_id() ) ) : ?>
					<li id="groups-personal"><a href="<?php echo bp_loggedin_user_domain() . bp_get_groups_slug() . '/my-groups/'; ?>"><?php printf( esc_html__( 'My Groups ', 'monstroid2' ) . '%s', '<span>' . bp_get_total_group_count_for_user( bp_loggedin_user_id() ) . '</span>' ); ?></a></li>
				<?php endif; ?>

				<li id="groups-order-select" class="last filter">

					<label for="groups-order-by"><?php esc_html_e( 'Order By:', 'monstroid2' ); ?></label>

					<select id="groups-order-by">
						<option value="active"><?php esc_html_e( 'Last Active', 'monstroid2' ); ?></option>
						<option value="popular"><?php esc_html_e( 'Most Members', 'monstroid2' ); ?></option>
						<option value="newest"><?php esc_html_e( 'Newly Created', 'monstroid2' ); ?></option>
						<option value="alphabetical"><?php esc_html_e( 'Alphabetical', 'monstroid2' ); ?></option>

						<?php

						/**
						 * Fires inside the groups directory group order options.
						 *
						 * @since 1.2.0
						 */
						do_action( 'bp_groups_directory_order_options' ); ?>
					</select>
				</li>
			</ul>
		</div>

		<div id="groups-dir-list" class="groups dir-list">
			<?php bp_get_template_part( 'groups/groups-loop' ); ?>
		</div><!-- #groups-dir-list -->

		<?php

		/**
		 * Fires and displays the group content.
		 *
		 * @since 1.1.0
		 */
		do_action( 'bp_directory_groups_content' ); ?>

		<?php wp_nonce_field( 'directory_groups', '_wpnonce-groups-filter' ); ?>

		<?php

		/**
		 * Fires after the display of the groups content.
		 *
		 * @since 1.1.0
		 */
		do_action( 'bp_after_directory_groups_content' ); ?>

	</form><!-- #groups-directory-form -->

	<?php

	/**
	 * Fires after the display of the groups.
	 *
	 * @since 1.1.0
	 */
	do_action( 'bp_after_directory_groups' ); ?>

</div><!-- #buddypress -->

<?php

/**
 * Fires at the bottom of the groups directory template file.
 *
 * @since 1.5.0
 */
do_action( 'bp_after_directory_groups_page' );
