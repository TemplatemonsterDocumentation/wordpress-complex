<?php
/**
 * Template part to display full-view news-smart-box widget.
 *
 * @package Monstroid2
 * @subpackage widgets
 */
?>
<div class="news-smart-box__item-inner">
	<div class="news-smart-box__item-header">
		<?php echo $image; ?>
	</div>
	<div class="news-smart-box__item-content">
		<div class="entry-meta">
			<?php echo $date; ?>
			<?php echo $author; ?>
			<?php echo $comments; ?>
		</div>
		<?php echo $title; ?>
		<?php echo $excerpt; ?>
		<?php echo $more_btn; ?>
	</div>
</div>
