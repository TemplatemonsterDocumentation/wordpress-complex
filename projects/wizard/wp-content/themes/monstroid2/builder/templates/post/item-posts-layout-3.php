<?php
/**
 * Template part for displaying posts listing item
 *
 * @package Monstroid2
 */
?>
<div class="<?php echo tm_builder_tools()->get_col_classes( $this ); ?>">
	<div class="tm-posts_item">
		<div class="tm-posts_item_image"><?php

			tm_builder_core()->utility()->media->get_image( array(
				'html'        => '<a href="%1$s" %2$s><img src="%3$s" alt="%4$s"></a>',
				'class'       => 'tm-posts_img',
				'size'        => esc_attr( $this->_var( 'image_size' ) ),
				'placeholder' => true,
				'echo'        => true,
			) );

		?></div>
		<div class="tm-posts_item_content invert"><?php

			tm_builder_core()->utility()->attributes->get_title( apply_filters( 'monstroid2_module_post_title_settings_layout_3', array(
				'visible'      => true,
				'trimmed_type' => 'word',
				'length'       => 5,
				'ending'       => '&hellip;',
				'html'         => '<h5 %1$s><a href="%2$s" %3$s rel="bookmark">%4$s</a></h5>',
				'class'        => 'tm-posts_item_title',
				'echo'         => true,
			) ) );

			echo $this->get_template_part( 'post/item-meta.php' );

			tm_builder_core()->utility()->attributes->get_button( apply_filters( 'monstroid2_module_post_btn_settings_layout_3', array(
				'visible' => false,
				'text'    => esc_html__( 'Read More', 'monstroid2' ),
				'icon'    => '<i class="linearicon linearicon-arrow-right"></i>',
				'class'   => 'tm-posts_more-btn link',
				'html'    => '<a href="%1$s" %3$s><span class="link__text">%4$s</span>%5$s</a>',
				'echo'    => true,
			) ) );

		?></div>
	</div>
</div>
