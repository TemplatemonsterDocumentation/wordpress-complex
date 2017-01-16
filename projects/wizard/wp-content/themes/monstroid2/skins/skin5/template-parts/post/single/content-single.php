<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Monstroid2
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php $utility = monstroid2_utility()->utility; ?>

	<header class="entry-header">

		<?php $utility->attributes->get_title( array(
				'class' => 'entry-title',
				'html'  => '<h3 %1$s>%4$s</h3>',
				'echo'  => true,
			) );
		?>

	</header><!-- .entry-header -->

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

			<?php $cats_visible = monstroid2_is_meta_visible( 'single_post_categories', 'single' );

			$utility->meta_data->get_terms( array(
				'visible' => $cats_visible,
				'type'    => 'category',
				'delimiter' => ', ',
				'before'  => '<span class="post__cats">',
				'after'   => '</span>',
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

	<?php monstroid2_ads_post_before_content() ?>

	<figure class="post-thumbnail">
		<?php $size = monstroid2_post_thumbnail_size(); ?>

		<?php $utility->media->get_image( array(
			'size'        => $size['size'],
			'html'        => '<img class="post-thumbnail__img wp-post-image" src="%3$s" alt="%4$s">',
			'placeholder' => false,
			'echo'        => true,
			) );
		?>
	</figure><!-- .post-thumbnail -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links__title">' . esc_html__( 'Pages:', 'monstroid2' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span class="page-links__item">',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'monstroid2' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php monstroid2_share_buttons( 'single' ); ?>
	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
