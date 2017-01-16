<?php
/**
 * The template for displaying related posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Monstroid2
 * @subpackage single-post
 */
?>

<div class="related-post page-content<?php echo esc_attr( $grid_class ); ?><?php if ( has_post_thumbnail() ) echo 'has-post-thumbnail'; ?>">
	<figure class="post-thumbnail">
		<?php $utility->media->get_image( array(
			'visible'     => $settings['image_visible'],
			'class'       => 'post-thumbnail__img',
			'html'        => '<a href="%1$s" class="post-thumbnail__link post-thumbnail--fullwidth" ><img src="%3$s" alt="%4$s" %2$s %5$s ></a>',
			'placeholder' => false,
			'size'        => 'post-thumbnail',
			'mobile_size' => 'post-thumbnail',
			'echo'        => true
		) );
		?>

		<?php $utility->meta_data->get_terms( array(
			'type'      => 'category',
			'visible'   => $settings['category_visible'],
			'before'    => '<div class="post__cats">',
			'after'     => '</div>',
			'echo'      => true
		) );
		?>
	</figure><!-- .post-thumbnail -->
	<header class="entry-header">
		<?php echo $title; ?>
	</header>

	<div class="entry-content">
		<?php echo $excerpt; ?>
	</div>

	<div class="entry-meta">

		<?php if ( $settings['author_visible'] ) : ?>
			<div class="entry-meta__author-avatar">
				<?php echo get_avatar( get_the_author_meta( 'user_email' ), 74, '', esc_attr( get_the_author_meta( 'nickname' ) ) );
				?>
			</div>
		<?php endif; ?>

		<div class="entry-meta__data">
			<?php $utility->meta_data->get_author( array(
				'visible' => $settings['author_visible'],
				'class'   => 'posted-by__author',
				'prefix'  => esc_html__( 'by ', 'monstroid2' ),
				'html'    => '<div class="posted-by">%1$s<a href="%2$s" %3$s %4$s rel="author">%5$s%6$s</a></div>',
				'echo'    => true,
			) );
			?>

			<?php $utility->meta_data->get_date( array(
				'visible' => $settings['date_visible'],
				'html'    => '<div class="post__date">%1$s<a href="%2$s" %3$s %4$s ><time datetime="%5$s">%6$s%7$s</time></a></div>',
				'class'   => 'post__date-link',
				'echo'    => true,
			) );
			?>

			<?php $utility->meta_data->get_terms( array(
				'visible'   => $settings['tag_visible'],
				'type'      => 'post_tag',
				'delimiter' => ', ',
				'before'    => '<div class="post__tags">',
				'after'     => '</div>',
				'prefix'    => esc_html__( 'Tags: ', 'monstroid2' ),
				'echo'      => true,
			) );
			?>

			<?php $utility->meta_data->get_comment_count( array(
				'visible' => $settings['comment_count'],
				'html'    => '<div class="post__comments">%1$s<a href="%2$s" %3$s %4$s>%5$s%6$s</a></div>',
				'sufix'   => get_comments_number_text( esc_html__( 'No comment(s)', 'monstroid2' ), esc_html__( 'Comment 1', 'monstroid2' ), esc_html__( 'Comments: %', 'monstroid2' ) ),
				'class'   => 'post__comments-link',
				'echo'    => true,
			) );
			?>
		</div>
	</div><!-- .entry-meta -->
</div>
