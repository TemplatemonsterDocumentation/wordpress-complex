<?php
/**
 * The template for displaying related posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Monstroid2
 * @subpackage single-post
 */
?>
<div class="related-post page-content<?php echo esc_attr( $grid_class ); ?>">
	<header class="entry-header">
		<?php echo $category; ?>
		<?php echo $title; ?>
	</header>
	<figure class="post-thumbnail">
		<?php echo $image; ?>
	</figure>
	<div class="entry-meta">
		<?php echo $date; ?>
		<?php echo $author; ?>
		<?php echo $comment_count; ?>
		<?php echo $tag; ?>
	</div>
	<div class="entry-content">
		<?php echo $excerpt; ?>
	</div>
</div>
