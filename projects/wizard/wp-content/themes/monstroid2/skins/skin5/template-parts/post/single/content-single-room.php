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

		<?php $utility->attributes->get_title( array(
				'class' => 'entry-title',
				'html'  => '<h3 %1$s>%4$s</h3>',
				'echo'  => true,
			) );
		?>

	</header><!-- .entry-header -->

	<?php monstroid2_ads_post_before_content() ?>

	<div class="entry-content">
		<?php the_content(); ?>
	</div><!-- .entry-content -->

</article><!-- #post-## -->
