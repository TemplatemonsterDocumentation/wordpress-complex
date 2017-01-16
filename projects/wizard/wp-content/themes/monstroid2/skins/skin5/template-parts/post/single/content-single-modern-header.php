<?php
/**
 * Template part for displaying modern single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Monstroid2
 */
?>

<div class="single-modern-header <?php echo $invert_class = has_post_thumbnail() ? 'invert' : ''; ?>">

	<?php $utility = monstroid2_utility()->utility; ?>

	<div class="post-thumbnail">
		<?php $utility->media->get_image( array(
			'size'        => 'monstroid2-thumb-xl',
			'mobile_size' => 'monstroid2-thumb-xl',
			'html'        => '<img class="wp-post-image" src="%3$s" alt="%4$s">',
			'placeholder' => false,
			'echo'        => true,
		) );
		?>
	</div><!-- .post-thumbnail -->

	<div class="container">

		<header class="entry-header">

			<?php $author_visible = monstroid2_is_meta_visible( 'single_post_author', 'single' );
			$avatar               = get_avatar( get_the_author_meta( 'user_email' ), 109, '', esc_attr( get_the_author_meta( 'nickname' ) ) );

			$utility->meta_data->get_author( array(
				'visible' => $author_visible,
				'class'   => 'posted-by__author',
				'prefix'  => esc_html__( 'by ', 'monstroid2' ),
				'html'    => '<div class="posted-by"><div class="posted-by__avatar">' . $avatar . '</div>%1$s<a href="%2$s" %3$s %4$s rel="author">%5$s%6$s</a></div>',
				'echo'    => true,
			) );
			?>

			<?php $utility->attributes->get_title( array(
					'class' => 'entry-title',
					'html'  => '<h2 %1$s>%4$s</h2>',
					'echo'  => true,
				) );
			?>

		</header><!-- .entry-header -->

		<?php if ( 'post' === get_post_type() ) : ?>

			<div class="entry-meta">

				<?php $date_visible = monstroid2_is_meta_visible( 'single_post_publish_date', 'single' );

				$utility->meta_data->get_date( array(
					'visible' => $date_visible,
					'icon'    => '<i class="linearicon linearicon-clock3"></i>',
					'html'    => '<span class="post__date">%1$s<a href="%2$s" %3$s %4$s ><time datetime="%5$s">%6$s%7$s</time></a></span>',
					'class'   => 'post__date-link',
					'echo'    => true,
				) );
				?>

				<?php $comment_visible = monstroid2_is_meta_visible( 'single_post_comments', 'single' );

				$utility->meta_data->get_comment_count( array(
					'visible' => $comment_visible,
					'icon'    => '<i class="linearicon linearicon-bubble"></i>',
					'html'    => '<span class="post__comments">%1$s<a href="%2$s" %3$s %4$s>%5$s%6$s</a></span>',
					'sufix'   => get_comments_number_text( esc_html__( 'No comment(s)', 'monstroid2' ), esc_html__( '1 comment', 'monstroid2' ), esc_html__( '% comments', 'monstroid2' ) ),
					'class'   => 'post__comments-link',
					'echo'    => true,
				) );
				?>

				<?php $cats_visible = monstroid2_is_meta_visible( 'single_post_categories', 'single' );

				$utility->meta_data->get_terms( array(
					'visible'   => $cats_visible,
					'type'      => 'category',
					'icon'      => '<i class="linearicon linearicon-tag"></i>',
					'delimiter' => ', ',
					'before'    => '<span class="post__cats">',
					'after'     => '</span>',
					'echo'      => true,
				) );
				?>

				<?php $tags_visible = monstroid2_is_meta_visible( 'single_post_tags', 'single' );

				$utility->meta_data->get_terms( array(
					'visible'   => $tags_visible,
					'type'      => 'post_tag',
					'icon'      => '<i class="linearicon linearicon-tags"></i>',
					'delimiter' => ', ',
					'before'    => '<span class="post__tags">',
					'after'     => '</span>',
					'echo'      => true,
				) );
				?>
			</div><!-- .entry-meta -->

		<?php endif; ?>

		<footer class="entry-footer">
			<?php monstroid2_share_buttons( 'single' ); ?>
		</footer><!-- .entry-footer -->

	</div>

</div>
