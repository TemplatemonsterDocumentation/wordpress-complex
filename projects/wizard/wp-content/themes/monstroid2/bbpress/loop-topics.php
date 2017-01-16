<?php
/**
 * Topics Loop
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

<?php do_action( 'bbp_template_before_topics_loop' ); ?>

<ul id="bbp-forum-<?php echo esc_attr( bbp_get_forum_id() ); ?>" class="bbp-topics">

	<li class="bbp-header">

		<ul class="forum-titles">
			<li class="bbp-topic-title"><?php esc_html_e( 'Topic', 'monstroid2' ); ?></li>
			<li class="bbp-topic-voice-count"><?php esc_html_e( 'Voices', 'monstroid2' ); ?></li>
			<li class="bbp-topic-reply-count"><?php bbp_show_lead_topic() ? esc_html_e( 'Replies', 'monstroid2' ) : esc_html_e( 'Posts', 'monstroid2' ); ?></li>
		</ul>

	</li>

	<li class="bbp-body">

		<?php while ( bbp_topics() ) : bbp_the_topic(); ?>

			<?php bbp_get_template_part( 'loop', 'single-topic' ); ?>

		<?php endwhile; ?>

	</li>

</ul><!-- #bbp-forum-<?php bbp_forum_id(); ?> -->

<?php do_action( 'bbp_template_after_topics_loop' ); ?>
