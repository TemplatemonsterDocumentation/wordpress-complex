<?php
/**
 * Template part for displaying post meta in Blog module
 *
 * @package Monstroid2
 */
if ( ! $module->is_meta_visible() ) {
	return;
}

$utility = monstroid2_utility()->utility;
?>
<div class="tm_pb_post_meta entry-meta"><?php

	if ( 'on' === $module->_var( 'show_author' ) ) : ?>
		<div class="entry-meta__author-avatar">
			<?php echo get_avatar( get_the_author_meta( 'user_email' ), 74, '', esc_attr( get_the_author_meta( 'nickname' ) ) );
			?>
		</div>
	<?php endif; ?>

	<div class="entry-meta__data">
		<?php if ( 'on' === $module->_var( 'show_author' ) ) {
			echo tm_get_safe_localization(
				sprintf(
					'<div class="author vcard posted-by">%s' . tm_pb_get_the_author_posts_link() . '</div>',
					esc_html__( 'by ', 'monstroid2' )
				)
			);
		}

		if ( 'on' === $module->_var( 'show_date' ) ) {
			$utility->meta_data->get_date( array(
				'html'    => '<div class="post__date">%1$s<a href="%2$s" %3$s %4$s ><time datetime="%5$s">%6$s%7$s</time></a></div>',
				'class'   => 'post__date-link',
				'echo'    => true,
			) );
		}

		if ( 'on' === $module->_var( 'show_comments' ) ) {
			$utility->meta_data->get_comment_count( array(
				'html'    => '<div class="post__comments">%1$s<a href="%2$s" %3$s %4$s>%5$s%6$s</a></div>',
				'sufix'   => get_comments_number_text( esc_html__( 'No comment(s)', 'monstroid2' ), esc_html__( 'Comment 1', 'monstroid2' ), esc_html__( 'Comments: %', 'monstroid2' ) ),
				'class'   => 'post__comments-link',
				'echo'    => true,
			) );
		}
	?></div>
</div>
