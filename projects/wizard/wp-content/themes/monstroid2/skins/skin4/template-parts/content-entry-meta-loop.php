<?php
/**
 * Template part for displaying entry-meta.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Monstroid2
 */
?>
<?php
	$utility = monstroid2_utility()->utility;
	$author_visible = monstroid2_is_meta_visible( 'blog_post_author', 'loop' );
?>

<?php if ( 'post' === get_post_type() ) : ?>

	<div class="entry-meta">

		<?php if ( $author_visible ) : ?>
			<div class="entry-meta__author-avatar">
				<?php echo get_avatar( get_the_author_meta( 'user_email' ), 74, '', esc_attr( get_the_author_meta( 'nickname' ) ) );
				?>
			</div>
		<?php endif; ?>

		<div class="entry-meta__data">
			<?php $utility->meta_data->get_author( array(
				'visible' => $author_visible,
				'class'   => 'posted-by__author',
				'prefix'  => esc_html__( 'by ', 'monstroid2' ),
				'html'    => '<div class="posted-by">%1$s<a href="%2$s" %3$s %4$s rel="author">%5$s%6$s</a></div>',
				'echo'    => true,
			) );
			?>

			<?php $date_visible = monstroid2_is_meta_visible( 'blog_post_publish_date', 'loop' );

			$utility->meta_data->get_date( array(
				'visible' => $date_visible,
				'html'    => '<div class="post__date">%1$s<a href="%2$s" %3$s %4$s ><time datetime="%5$s">%6$s%7$s</time></a></div>',
				'class'   => 'post__date-link',
				'echo'    => true,
			) );
			?>

			<?php $tags_visible = monstroid2_is_meta_visible( 'blog_post_tags', 'loop' );

			$utility->meta_data->get_terms( array(
				'visible'   => $tags_visible,
				'type'      => 'post_tag',
				'delimiter' => ', ',
				'before'    => '<div class="post__tags">',
				'after'     => '</div>',
				'prefix'    => esc_html__( 'Tags: ', 'monstroid2' ),
				'echo'      => true,
			) );
			?>

			<?php $comment_visible = monstroid2_is_meta_visible( 'blog_post_comments', 'loop' );

			$utility->meta_data->get_comment_count( array(
				'visible' => $comment_visible,
				'html'    => '<div class="post__comments">%1$s<a href="%2$s" %3$s %4$s>%5$s%6$s</a></div>',
				'sufix'   => get_comments_number_text( esc_html__( 'No comment(s)', 'monstroid2' ), esc_html__( 'Comment 1', 'monstroid2' ), esc_html__( 'Comments: %', 'monstroid2' ) ),
				'class'   => 'post__comments-link',
				'echo'    => true,
			) );
			?>

		</div>
	</div><!-- .entry-meta -->

<?php endif; ?>
