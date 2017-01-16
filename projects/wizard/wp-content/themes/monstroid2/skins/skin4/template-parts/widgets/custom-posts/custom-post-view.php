<?php
/**
 * Template part to display Custom posts widget.
 *
 * @package Monstroid2
 * @subpackage widgets
 */
?>

<div class="custom-posts__item post <?php echo esc_attr( $grid_class ); ?><?php if ( has_post_thumbnail() ) echo ' has-post-thumbnail'; ?>">
	<div class="post-inner">
		<div class="post-thumbnail">
			<?php $category = $this->utility->meta_data->get_terms( array(
				'visible'   => $meta_data['category'],
				'type'      => 'category',
				'before'    => '<div class="post__cats">',
				'after'     => '</div>',
				'echo'      => true,
			) );
			?>
			<?php $image = $this->utility->media->get_image( array(
				'placeholder' => false,
				'size'        => 'post-thumbnail',
				'mobile_size' => 'post-thumbnail',
				'class'       => 'post-thumbnail__link',
				'html'        => '<a href="%1$s" %2$s><img class="post-thumbnail__img" src="%3$s" alt="%4$s" %5$s></a>',
				'echo'        => true,
			) );
			?>
		</div>
		<div class="post-content-wrap">
			<div class="entry-header">
				<?php echo $title; ?>
			</div>
			<div class="entry-content">
				<?php echo $excerpt; ?>
			</div>
			<?php $meta_template = locate_template( 'skins/skin4/template-parts/content-entry-meta-widgets.php', false, false );

				if ( ! empty( $meta_template ) ) {
					$meta_author_visible = $meta_data['author'];
					$meta_author_avatar_visible = 'true' === $meta_data['author'] ? true : false;
					$meta_date_visible = $meta_data['date'];
					$meta_tags_visible = $meta_data['post_tag'];
					$meta_comment_visible = $meta_data['comment_count'];

					include $meta_template;
				}
			?>
			<div class="entry-footer">
				<?php echo $button; ?>
			</div>
		</div>
	</div>
</div>
