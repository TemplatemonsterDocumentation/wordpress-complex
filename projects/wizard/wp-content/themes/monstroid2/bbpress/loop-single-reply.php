<?php
/**
 * Replies Loop - Single Reply
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

<div <?php bbp_reply_class(); ?>>

	<div class="bbp-reply-author">

		<?php bbp_reply_author_link( array( 'sep' => '<br />', 'show_role' => false, 'size' => 71 ) ); ?>

	</div><!-- .bbp-reply-author -->

	<div class="bbp-reply-content">

		<div id="post-<?php echo esc_attr( bbp_get_reply_id() ); ?>" class="bbp-reply-inner">

			<div class="bbp-meta">

				<span class="bbp-reply-post-date"><?php bbp_reply_post_date(); ?></span>

				<?php if ( bbp_is_single_user_replies() ) : ?>

				<span class="bbp-header">

					<?php esc_html_e( 'in reply to: ', 'monstroid2' ); ?>
					<a class="bbp-topic-permalink" href="<?php bbp_topic_permalink( bbp_get_reply_topic_id() ); ?>">
						<?php bbp_topic_title( bbp_get_reply_topic_id() ); ?>
					</a>
				</span>

				<?php endif; ?>

				<a href="<?php bbp_reply_url(); ?>" class="bbp-reply-permalink">#<?php bbp_reply_id(); ?></a>

				<?php do_action( 'bbp_theme_before_reply_admin_links' ); ?>

				<?php bbp_reply_admin_links( array( 'sep' => ' ' ) ); ?>

				<?php do_action( 'bbp_theme_after_reply_admin_links' ); ?>

			</div><!-- .bbp-meta -->

		</div><!-- #post-<?php bbp_reply_id(); ?> -->

		<?php do_action( 'bbp_theme_before_reply_content' ); ?>

		<?php bbp_reply_content(); ?>

		<?php do_action( 'bbp_theme_after_reply_content' ); ?>

	</div><!-- .bbp-reply-content -->

</div><!-- .reply -->
