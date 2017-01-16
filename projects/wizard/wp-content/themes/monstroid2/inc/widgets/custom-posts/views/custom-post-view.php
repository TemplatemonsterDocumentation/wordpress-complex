<?php
/**
 * Template part to display Custom posts widget.
 *
 * @package Monstroid2
 * @subpackage widgets
 */
?>
<div class="custom-posts__item post <?php echo $grid_class; ?>">
	<div class="post-inner">
		<div class="post-thumbnail">
			<?php echo $image; ?>
		</div>
		<div class="post-content-wrap">
			<div class="entry-meta">
				<?php echo $date; ?>
				<?php echo $author; ?>
			</div>
			<div class="entry-header">
				<?php echo $title; ?>
			</div>
			<div class="entry-content">
				<?php echo $excerpt; ?>
			</div>
			<div class="entry-footer">
				<div class="entry-meta">
					<?php echo $count; ?>
					<?php echo $category; ?>
					<?php echo $tag; ?>
				</div>
				<?php echo $button; ?>
			</div>
		</div>
	</div>
</div>
