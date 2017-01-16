<?php
/**
 * Template for displaying standard post format item content
 *
 * @package Monstroid2
 */

$first_video = tm_get_first_video();
?>
<?php if ( $first_video ) : ?>
<div class="tm_main_video_container">
	<?php echo $first_video; ?>
</div>
<?php endif; ?>
<div class="tm_pb_content_container">
	<?php if ( 'list' === $module->_var( 'blog_layout' ) ) {
		echo monstroid2_get_builder_module_template( 'blog/meta.php', $module );
	} ?>

	<?php
	$title_html = ( 'list' !== $module->_var( 'blog_layout' ) ) ? '<h5 %1$s><a href="%2$s" %3$s rel="bookmark">%4$s</a></h5>' : '<h4 %1$s><a href="%2$s" %3$s rel="bookmark">%4$s</a></h4>';

	tm_builder_core()->utility()->attributes->get_title( array(
		'html'  => $title_html,
		'class' => 'entry-title',
		'echo'  => true,
	) );
	?>

	<?php if ( 'list' !== $module->_var( 'blog_layout' ) ) {
		echo monstroid2_get_builder_module_template( 'blog/meta.php', $module );
	} ?>

	<?php echo $module->get_post_content(); ?>
	<?php echo $module->get_more_button(); ?>
</div>
