<?php
/**
 * Template part for displaying posts listing item
 *
 * @package Monstroid2
 */
?>
<div class="<?php echo tm_builder_tools()->get_col_classes( $this ); ?>">
	<div class="tm-posts_item">
		<div class="tm-posts_item_content_wrap">
		<?php
			tm_builder_core()->utility()->attributes->get_title( apply_filters( 'monstroid2_module_post_title_settings_layout_2', array(
				'visible'      => true,
				'trimmed_type' => 'word',
				'ending'       => '&hellip;',
				'html'         => '<h5 %1$s><a href="%2$s" %3$s rel="bookmark">%4$s</a></h5>',
				'class'        => 'tm-posts_item_title',
				'echo'         => true,
			) ) );

			tm_builder_core()->utility()->attributes->get_content( array(
				'visible'      => ( $this->_var( 'excerpt' ) && 0 < $this->_var( 'excerpt' ) ) ? true : false,
				'content_type' => 'post_content',
				'length'       => $this->_var( 'excerpt' ),
				'trimmed_type' => 'word',
				'ending'       => '&hellip;',
				'html'         => '<div %1$s>%2$s</div>',
				'class'        => 'tm-posts_item_excerpt',
				'echo'         => true,
			) );
		?>
		</div>
		<div class="posts_item_content_footer">
		<?php
			echo $this->get_template_part( 'post/item-meta.php' );

			tm_builder_core()->utility()->attributes->get_button( apply_filters( 'monstroid2_module_post_btn_settings_layout_2', array(
				'visible'   => false,
				'text'      => esc_html__( 'Read More', 'monstroid2' ),
				'icon'      => '<i class="linearicon linearicon-arrow-right"></i>',
				'class'     => 'tm-posts_more-btn link',
				'html'      => '<a href="%1$s" %3$s><span class="link__text">%4$s</span>%5$s</a>',
				'echo'      => true,
			) ) );
		?>
		</div>
	</div>
</div>
