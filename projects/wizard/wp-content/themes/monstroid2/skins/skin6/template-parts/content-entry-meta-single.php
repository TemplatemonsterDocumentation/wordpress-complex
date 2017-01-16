<?php
/**
 * Template part for displaying entry-meta.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Monstroid2
 */
?>
<?php $utility = monstroid2_utility()->utility; ?>

<?php if ( 'post' === get_post_type() ) : ?>

	<div class="entry-meta">

		<?php $date_visible = monstroid2_is_meta_visible( 'single_post_publish_date', 'single' );

		$utility->meta_data->get_date( array(
			'visible' => $date_visible,
			'html'    => '<span class="post__date">%1$s<a href="%2$s" %3$s %4$s ><time datetime="%5$s">%6$s%7$s</time></a></span>',
			'class'   => 'post__date-link',
			'echo'    => true,
		) );
		?>

		<?php $author_visible = monstroid2_is_meta_visible( 'single_post_author', 'single' );

		$utility->meta_data->get_author( array(
			'visible' => $author_visible,
			'class'   => 'posted-by__author',
			'prefix'  => esc_html__( 'by ', 'monstroid2' ),
			'html'    => '<span class="posted-by">%1$s<a href="%2$s" %3$s %4$s rel="author">%5$s%6$s</a></span>',
			'echo'    => true,
		) );
		?>

		<?php $comment_visible = monstroid2_is_meta_visible( 'single_post_comments', 'single' );

		$utility->meta_data->get_comment_count( array(
			'visible' => $comment_visible,
			'html'    => '<span class="post__comments">%1$s<a href="%2$s" %3$s %4$s>%5$s%6$s</a></span>',
			'sufix'   => get_comments_number_text( esc_html__( 'No comment(s)', 'monstroid2' ), esc_html__( '1 comment', 'monstroid2' ), esc_html__( '% comments', 'monstroid2' ) ),
			'class'   => 'post__comments-link',
			'echo'    => true,
		) );
		?>

		<?php $tags_visible = monstroid2_is_meta_visible( 'single_post_tags', 'single' );

		$utility->meta_data->get_terms( array(
			'visible'   => $tags_visible,
			'type'      => 'post_tag',
			'delimiter' => ', ',
			'before'    => '<span class="post__tags">',
			'after'     => '</span>',
			'echo'      => true,
		) );
		?>
	</div><!-- .entry-meta -->

<?php endif; ?>
