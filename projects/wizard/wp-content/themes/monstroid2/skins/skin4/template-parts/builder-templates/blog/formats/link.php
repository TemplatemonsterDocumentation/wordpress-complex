<?php
/**
 * Template for displaying audio post format item content
 *
 * @package Monstroid2
 */
?>

<?php if ( 'on' === $module->_var( 'show_categories' ) ) {
	?><div class="post__cats"><?php
		echo get_the_category_list( ' ' );
	?></div><?php
} ?>

<div class="tm_pb_content_container">
	<?php
	$title_html = ( 'list' !== $module->_var( 'blog_layout' ) ) ? '<h5 %1$s><a href="%2$s" %3$s rel="bookmark">%4$s</a></h5>' : '<h4 %1$s><a href="%2$s" %3$s rel="bookmark">%4$s</a></h4>';

	tm_builder_core()->utility()->attributes->get_title( array(
		'html'  => $title_html,
		'class' => 'entry-title',
		'echo'  => true,
	) );
	?>

	<div class="post-featured-content">
		<?php do_action( 'cherry_post_format_link', array( 'render' => true ) ); ?>
	</div><!-- .post-featured-content -->

	<?php monstroid2_get_builder_module_template( 'blog/meta.php', $module ); ?>
	<?php if ( 'on' === $module->_var( 'show_more' ) ) {
		monstroid2_get_builder_module_template( 'blog/more.php' );
	} ?>
</div>
