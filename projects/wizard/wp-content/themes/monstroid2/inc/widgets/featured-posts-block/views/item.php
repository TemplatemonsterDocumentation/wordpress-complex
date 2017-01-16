<?php
/**
 * Template part to display a single post while in a layout posts loop
 *
 * @package Monstroid2
 * @subpackage widgets
 */

?>
<div class="widget-fpblock__item invert widget-fpblock__item-<?php echo $key; ?> widget-fpblock__item-<?php echo esc_attr( $special_class ); ?> post-<?php the_ID(); ?>" style="background-image: url('<?php echo esc_url( $image ); ?>');">
	<div class="widget-fpblock__item-inner">
		<?php echo $title; ?>
		<div class="entry-meta">
			<?php echo $date; ?>
			<?php echo $author; ?>
			<?php echo $cats; ?>
			<?php echo $tags; ?>
		</div>
		<?php echo $content; ?>
	</div>
</div>
