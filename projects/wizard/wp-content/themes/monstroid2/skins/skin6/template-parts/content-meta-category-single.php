<?php
/**
 * Template part for displaying meta category.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Monstroid2
 */
?>
<?php $utility = monstroid2_utility()->utility;
$cats_visible  = monstroid2_is_meta_visible( 'blog_post_categories', 'single' ); ?>

<?php if ( 'post' === get_post_type() ) : ?>

	<?php $utility->meta_data->get_terms( array(
		'visible'   => $cats_visible,
		'type'      => 'category',
		'delimiter' => ', ',
		'before'    => '<div class="post__category">',
		'after'     => '</div>',
		'echo'      => true,
	) ); ?>

<?php endif; ?>
