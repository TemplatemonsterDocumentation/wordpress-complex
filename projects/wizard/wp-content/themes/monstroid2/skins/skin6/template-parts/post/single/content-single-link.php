<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Monstroid2
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php $utility = monstroid2_utility()->utility; ?>

	<header class="entry-header">

		<?php get_template_part( 'skins/skin6/template-parts/content-meta-category-single' ); ?>

		<?php $utility->attributes->get_title( array(
			'class' => 'entry-title',
			'html'  => '<h4 %1$s>%4$s</h4>',
			'echo'  => true,
		) );
		?>

	</header><!-- .entry-header -->

	<?php get_template_part( 'skins/skin6/template-parts/content-entry-meta-single' ); ?>

	<?php monstroid2_ads_post_before_content() ?>

	<figure class="post-thumbnail">
		<?php $size = monstroid2_post_thumbnail_size(); ?>

		<?php $utility->media->get_image( array(
			'size'        => $size['size'],
			'html'        => '<img class="post-thumbnail__img wp-post-image" src="%3$s" alt="%4$s">',
			'placeholder' => false,
			'echo'        => true,
		) );
		?>
	</figure><!-- .post-thumbnail -->

	<div class="post-featured-content invert invert_primary">
		<?php $utility->attributes->get_title( array(
			'class' => 'entry-title',
			'html'  => '<h4 %1$s>%4$s</h4>',
			'echo'  => true,
		) );
		?>

		<?php do_action( 'cherry_post_format_link', array( 'render' => true ) ); ?>
	</div><!-- .post-featured-content -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php wp_link_pages( array(
			'before'      => '<div class="page-links"><span class="page-links__title">' . esc_html__( 'Pages:', 'monstroid2' ) . '</span>',
			'after'       => '</div>',
			'link_before' => '<span class="page-links__item">',
			'link_after'  => '</span>',
			'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'monstroid2' ) . ' </span>%',
			'separator'   => '<span class="screen-reader-text">, </span>',
		) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php monstroid2_share_buttons( 'single' ); ?>
	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
