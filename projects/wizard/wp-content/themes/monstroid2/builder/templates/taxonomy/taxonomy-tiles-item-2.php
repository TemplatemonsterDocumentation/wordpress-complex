<?php
/**
 * Template part for displaying taxonomy tiles item #2
 *
 * @package Monstroid2
 */
$term_id = $this->_var( 'term_id' );
$image = tm_builder_core()->utility()->media->get_image(
	apply_filters( 'tm_pb_module_taxonomy_img_settings_item_2',
		array(
			'size'  => 'post-thumbnail',
			'class' => 'term-img',
			'html'  => '<a href="%1$s" title="%4$s"><span %2$s title="%4$s" style="background-image:url(%3$s); padding:0 0 75.4%% 0;"></span></a>',
		)
	),
	'term',
	$term_id
);
?>
<!-- div.tm_pb_taxonomy__holder start -->
<div class="tm_pb_taxonomy__holder invert col-xs-12 col-sm-12 col-md-12 col-lg-3 col-xl-3" >
	<div class="tiles-item tiles-item-type-2 tm_pb_taxonomy__inner">
		<figure>
			<?php echo $image ?>
			<figcaption class="tm_pb_taxonomy__content">
				<div class="tm_pb_taxonomy__title-wrap">
					<?php echo $this->_var( 'term_title' ); ?>
					<?php echo $this->_var( 'count' ); ?>
				</div>
				<?php echo $this->_var( 'description' ); ?>
				<?php echo $this->_var( 'button' ); ?>
			</figcaption>
		</figure>
	</div>
