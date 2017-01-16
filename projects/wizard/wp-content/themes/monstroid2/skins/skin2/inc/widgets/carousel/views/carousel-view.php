<?php
/**
 * Template part to display Carousel widget.
 *
 * @package Monstroid2
 * @subpackage widgets
 */
?>

<div class="inner invert">
	<?php echo $image; ?>
	<div class="content-wrapper">
		<header class="entry-header">
			<?php echo $title; ?>
		</header>
		<div class="entry-meta">
			<?php echo $date; ?>
			<?php echo $author; ?>
		</div>
		<div class="entry-content">
			<?php echo $content; ?>
		</div>
		<footer class="entry-footer">
			<?php echo $more_button; ?>
		</footer>
	</div>
	
</div>
