<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Monstroid2
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'posts-list__item card' ); ?>>

	<div class="post-list__item-content">
		<?php get_template_part( 'skins/skin6/template-parts/content-meta-category-loop' ); ?>

		<div class="post-featured-content post-quote">
			<?php do_action( 'cherry_post_format_quote' ); ?>
		</div>

		<footer class="entry-footer">
			<?php get_template_part( 'skins/skin6/template-parts/content-entry-meta-loop' ); ?>

			<?php monstroid2_share_buttons( 'loop' ); ?>

			<?php get_template_part( 'skins/skin6/template-parts/content-btn' ); ?>

		</footer><!-- .entry-footer -->
	</div><!-- .post-list__item-content -->

</article><!-- #post-## -->
