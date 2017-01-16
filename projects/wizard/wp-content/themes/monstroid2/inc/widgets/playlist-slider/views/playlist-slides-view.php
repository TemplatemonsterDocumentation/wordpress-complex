<?php
/**
 * Template part to display slides Playlist-slider widget.
 *
 * @package Monstroid2
 * @subpackage widgets
 */
?>
<div class="sp-slide format-<?php echo esc_attr( $post_format ); ?> <?php echo esc_attr( $is_invert ); ?> sp-slide--<?php echo esc_attr( $visible_content ); ?>">
	<div class="sp-layer" data-position="bottomLeft" data-horizontal="0" data-show-transition="up" data-show-delay="500" data-hide-transition="down">
			<?php echo $title; ?>
			<div class="entry-meta">
				<?php echo $date; ?>
				<?php echo $author; ?>
				<?php echo $comments; ?>
				<?php echo $category; ?>
				<?php echo $tag; ?>
			</div>
	</div>
	<?php echo $slide; ?>
</div>
