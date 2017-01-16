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

	<?php $utility = monstroid2_utility()->utility; ?>

	<div class="post-list__item-content">
		<?php get_template_part( 'skins/skin6/template-parts/content-meta-category-loop' ); ?>

		<header class="entry-header">
			<?php monstroid2_sticky_label(); ?>

			<?php $title_html = ( is_single() ) ? '<h4 %1$s>%4$s</h4>' : '<h4 %1$s><a href="%2$s" rel="bookmark">%4$s</a></h4>';

			$utility->attributes->get_title( array(
				'class' => 'entry-title',
				'html'  => $title_html,
				'echo'  => true,
			) );
			?>
		</header><!-- .entry-header -->

		<figure class="post-thumbnail">
			<?php monstroid2_post_formats_gallery(); ?>
		</figure><!-- .post-thumbnail -->

		<div class="entry-content">
			<?php $blog_content = get_theme_mod( 'blog_posts_content', monstroid2_theme()->customizer->get_default( 'blog_posts_content' ) );
			$length             = ( 'full' === $blog_content ) ? -1 : 55;
			$content_visible    = ( 'none' !== $blog_content ) ? true : false;
			$content_type       = ( 'full' !== $blog_content ) ? 'post_excerpt' : 'post_content';

			$utility->attributes->get_content( array(
				'visible'      => $content_visible,
				'length'       => $length,
				'content_type' => $content_type,
				'echo'         => true,
			) );
			?>
		</div><!-- .entry-content -->

	</div><!-- .post-list__item-content -->

	<footer class="entry-footer">
		<?php get_template_part( 'skins/skin6/template-parts/content-entry-meta-loop' ); ?>

		<?php monstroid2_share_buttons( 'loop' ); ?>

		<?php get_template_part( 'skins/skin6/template-parts/content-btn' ); ?>
	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
