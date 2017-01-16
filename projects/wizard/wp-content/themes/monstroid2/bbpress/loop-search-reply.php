<?php
/**
 * Search Loop - Single Reply
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

<div class="bbp-reply-header">

	<div class="bbp-meta">

		<span class="bbp-reply-post-date"><?php bbp_reply_post_date(); ?></span>

		<a href="<?php bbp_reply_url(); ?>" class="bbp-reply-permalink">#<?php bbp_reply_id(); ?></a>

	</div><!-- .bbp-meta -->

	<div class="bbp-reply-title">

		<h3><?php esc_html_e( 'In reply to: ', 'monstroid2' ); ?>
			<a class="bbp-topic-permalink" href="<?php bbp_topic_permalink( bbp_get_reply_topic_id() ); ?>">
				<?php bbp_topic_title( bbp_get_reply_topic_id() ); ?>
			</a>
		</h3>

	</div><!-- .bbp-reply-title -->

</div><!-- .bbp-reply-header -->

<div id="post-<?php echo esc_attr( bbp_get_reply_id() ); ?>" <?php bbp_reply_class(); ?>>

	<div class="bbp-reply-author">

		<?php do_action( 'bbp_theme_before_reply_author_details' ); ?>

		<?php bbp_reply_author_link( array( 'sep' => '<br />', 'show_role' => false, 'size' => 71 ) ); ?>


		<?php do_action( 'bbp_theme_after_reply_author_details' ); ?>

	</div><!-- .bbp-reply-author -->

	<div class="bbp-reply-content">

		<?php do_action( 'bbp_theme_before_reply_content' ); ?>

		<?php bbp_reply_content(); ?>

		<?php do_action( 'bbp_theme_after_reply_content' ); ?>

	</div><!-- .bbp-reply-content -->

</div><!-- #post-<?php bbp_reply_id(); ?> -->
