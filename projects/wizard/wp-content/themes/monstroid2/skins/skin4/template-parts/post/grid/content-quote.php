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

	<?php $utility = monstroid2_utility()->utility;
	$permalink     = $utility->satellite->get_post_permalink();
	?>

	<div class="post-list__item-content">
		<?php $cats_visible = monstroid2_is_meta_visible( 'blog_post_categories', 'loop' );

		$utility->meta_data->get_terms( array(
			'visible'   => $cats_visible,
			'type'      => 'category',
			'before'    => '<div class="post__cats">',
			'after'     => '</div>',
			'echo'      => true,
		) );
		?>

		<a class="post-featured-content post-quote" href="<?php echo esc_url( $permalink ); ?>">
			<?php do_action( 'cherry_post_format_quote' ); ?>
		</a>

		<?php get_template_part( 'skins/skin4/template-parts/content-entry-meta-loop' ); ?>
	</div><!-- .post-list__item-content -->

	<footer class="entry-footer">
		<?php $btn_text = get_theme_mod( 'blog_read_more_text', monstroid2_theme()->customizer->get_default( 'blog_read_more_text' ) );
		$btn_visible    = $btn_text ? true : false;

		$utility->attributes->get_button( array(
			'visible' => $btn_visible,
			'class'   => 'post-btn btn',
			'text'    => $btn_text,
			'html'    => '<a href="%1$s" %3$s>%4$s</a>',
			'echo'    => true,
		) );
		?>

		<?php monstroid2_share_buttons( 'loop' ); ?>
	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
