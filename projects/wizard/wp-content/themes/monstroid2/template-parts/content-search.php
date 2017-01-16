<?php
/**
 * The template part for displaying results in search pages.
 *
 * @package Monstroid2
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'posts-list__item card' ); ?>>

	<?php $utility = monstroid2_utility()->utility; ?>

	<div class="post-list__item-content">

		<header class="entry-header">
			<?php $title_html = ( is_single() ) ? '<h3 %1$s>%4$s</h3>' : '<h5 %1$s><a href="%2$s" rel="bookmark">%4$s</a></h5>';

			$utility->attributes->get_title( array(
				'class' => 'entry-title',
				'html'  => $title_html,
				'echo'  => true,
			) );
			?>
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php the_excerpt(); ?>
		</div><!-- .entry-content -->

	</div><!-- .post-list__item-content -->

	<footer class="entry-footer">
		<?php $btn_text = get_theme_mod( 'blog_read_more_text', monstroid2_theme()->customizer->get_default( 'blog_read_more_text' ) );
		$btn_text       = $btn_text ? $btn_text : esc_html__( 'Read more', 'monstroid2' );

		$utility->attributes->get_button( array(
				'class' => 'btn btn-primary',
				'text'  => $btn_text,
				'html'  => '<a href="%1$s" %3$s><span class="btn__text">%4$s</span>%5$s</a>',
				'echo'  => true,
			) );
		?>
	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
