<?php
/**
 * Template part to display Carousel widget.
 *
 * @package Monstroid2
 * @subpackage widgets
 */
?>

<div class="inner">
	<div class="content-wrapper">
		<header class="entry-header">
			<?php echo $image; ?>
			<?php echo $title; ?>
		</header>
		<div class="entry-content">
			<?php echo $content; ?>
		</div>
		<?php if ( $content ) {
			$meta_template = locate_template( 'skins/skin4/template-parts/content-entry-meta-widgets.php', false, false );
			if ( ! empty( $meta_template ) ) {
				$meta_author_avatar_visible = true;
				$meta_author_visible = true;
				$meta_date_visible = true;
				$meta_tags_visible = false;
				$meta_comment_visible = false;

				include $meta_template;
			}
		} ?>
	</div>
	<footer class="entry-footer">
		<?php echo $more_button; ?>
	</footer>
</div>
