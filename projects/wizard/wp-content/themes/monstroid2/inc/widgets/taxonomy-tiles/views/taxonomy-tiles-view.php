<?php
/**
 * Template part to display Taxonomy-tiles widget.
 *
 * @package Monstroid2
 * @subpackage widgets
 */
?>
<div class="widget-taxonomy-tiles__holder invert grid-item <?php echo $class; ?>">
	<figure class="widget-taxonomy-tiles__inner">
		<a href="<?php echo $permalink; ?>"><?php echo $image; ?></a>
		<figcaption class="widget-taxonomy-tiles__content">
			<div class="widget-taxonomy-tiles__title-wrap">
				<?php echo $title; ?>
				<?php echo $count; ?>
			</div>
			<?php echo $description; ?>
		</figcaption>
	</figure>
</div>
