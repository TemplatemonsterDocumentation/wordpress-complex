<?php
/**
 * Template part to display a single post while in a layout posts loop
 *
 * @package Monstroid2
 * @subpackage widgets
 */

?>
<div class="widget-fpblock__item invert widget-fpblock__item-<?php echo esc_attr( $key ); ?> widget-fpblock__item-<?php echo esc_attr( $special_class ); ?> post-<?php the_ID(); ?>" style="background-image: url('<?php echo esc_url( $image ); ?>');">

	<div class="widget-fpblock__item-inner">
		<?php echo $title; ?>
		<?php echo $content; ?>
		<?php $meta_template = locate_template( 'skins/skin4/template-parts/content-entry-meta-widgets.php', false, false );

			if ( ! empty( $meta_template ) ) {
				$meta_author_visible = $this->instance['checkboxes']['author'];
				$meta_author_avatar_visible = 'true' === $this->instance['checkboxes']['author'] ? true : false;
				$meta_date_visible = $this->instance['checkboxes']['date'];
				$meta_tags_visible = $this->instance['checkboxes']['tags'];
				$meta_comment_visible = 'false';

				include $meta_template;
			}
		?>
	</div>
</div>
