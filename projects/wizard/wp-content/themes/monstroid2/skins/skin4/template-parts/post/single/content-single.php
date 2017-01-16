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

	<?php
		$utility = monstroid2_utility()->utility;
		$size = monstroid2_post_thumbnail_size();
		$cats_visible = monstroid2_is_meta_visible( 'blog_post_categories', 'single' );
	?>

	<header class="entry-header">
		<?php $utility->meta_data->get_terms( array(
			'visible'   => $cats_visible,
			'type'      => 'category',
			'before'    => '<div class="post__cats">',
			'after'     => '</div>',
			'echo'      => true,
		) );
		?>

		<?php $utility->attributes->get_title( array(
				'class' => 'entry-title',
				'html'  => '<h2 %1$s>%4$s</h2>',
				'echo'  => true,
			) );
		?>

	</header><!-- .entry-header -->

	<figure class="post-thumbnail">
		<?php $utility->media->get_image( array(
			'size'        => $size['size'],
			'class'       => 'post-thumbnail__link ' . $size['class'],
			'html'        => '<a href="%1$s" %2$s><img class="post-thumbnail__img wp-post-image" src="%3$s" alt="%4$s" %5$s></a>',
			'placeholder' => false,
			'echo'        => true,
		) );
		?>
	</figure><!-- .post-thumbnail -->

	<?php get_template_part( 'skins/skin4/template-parts/content-entry-meta-single' ); ?>

	<?php monstroid2_ads_post_before_content() ?>

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
