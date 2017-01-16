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
		<div class="post-featured-content invert invert_primary">
			<?php $title_html = ( is_single() ) ? '<h4 %1$s>%4$s</h4>' : '<h4 %1$s><a href="%2$s" rel="bookmark">%4$s</a></h4>';

			$utility->attributes->get_title( array(
				'class' => 'entry-title',
				'html'  => $title_html,
				'echo'  => true,
			) );
			?>

			<?php do_action( 'cherry_post_format_link', array( 'render' => true ) ); ?>
		</div><!-- .post-featured-content -->
	</div><!-- .post-list__item-content -->

</article><!-- #post-## -->
