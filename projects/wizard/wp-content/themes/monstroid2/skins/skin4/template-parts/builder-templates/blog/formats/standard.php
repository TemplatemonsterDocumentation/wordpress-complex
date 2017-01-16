<?php
/**
 * Template for displaying standard post format item content
 *
 * @package Monstroid2
 */
?>

<div class="tm_pb_image_container<?php if ( has_post_thumbnail() ) echo ' has-post-thumbnail'; ?>">
	<?php if ( 'on' === $module->_var( 'show_categories' ) ) {
		?><div class="post__cats"><?php
			echo get_the_category_list( ' ' );
		?></div><?php
	} ?>
	<?php if ( $module->_var( 'thumb' ) ) : ?>
		<a href="<?php esc_url( the_permalink() ); ?>" class="entry-featured-image-url">
			<?php echo $module->_var( 'thumb' ); ?>
			<?php if ( 'on' === $module->_var( 'use_overlay' ) ) {
				echo $module->_var( 'item_overlay' );
			} ?>
		</a>
	<?php endif; ?>
</div> <!-- .tm_pb_image_container -->

<div class="tm_pb_content_container">
	<?php
	$title_html = ( 'list' !== $module->_var( 'blog_layout' ) ) ? '<h5 %1$s><a href="%2$s" %3$s rel="bookmark">%4$s</a></h5>' : '<h4 %1$s><a href="%2$s" %3$s rel="bookmark">%4$s</a></h4>';

	tm_builder_core()->utility()->attributes->get_title( array(
		'html'  => $title_html,
		'class' => 'entry-title',
		'echo'  => true,
	) );
	?>

	<?php echo $module->get_post_content(); ?>

	<?php monstroid2_get_builder_module_template( 'blog/meta.php', $module ); ?>

	<?php if ( 'on' === $module->_var( 'show_more' ) ) {
		monstroid2_get_builder_module_template( 'blog/more.php' );
	} ?>
</div>
