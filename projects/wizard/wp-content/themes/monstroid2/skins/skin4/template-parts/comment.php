<?php
/**
 * The template for displaying comments.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy
 *
 * @package Monstroid2
 */
?>
<div class="comment-author vcard">
	<?php echo monstroid2_comment_author_avatar( array( 'size' => 74 ) ); ?>
</div>
<div class="comment-content-wrap">
	<footer class="comment-meta">
		<div class="comment-metadata">
			<?php echo esc_html__( 'by ', 'monstroid2' ) . '<span class="fn">' . get_comment_author_link() . '</span>'; ?>
			<?php echo monstroid2_get_comment_date( array( 'format' => 'M d, Y' ) ); ?>
		</div>
		<div class="reply">
			<?php echo monstroid2_get_comment_reply_link( array( 'reply_text' => esc_html__( 'Reply', 'monstroid2' ) ) ); ?>
		</div>
	</footer>
	<div class="comment-content">
		<?php echo monstroid2_get_comment_text(); ?>
	</div>
</div>
