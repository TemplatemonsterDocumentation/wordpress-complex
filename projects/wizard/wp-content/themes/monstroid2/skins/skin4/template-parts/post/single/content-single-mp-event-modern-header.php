<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Monstroid2
 */
?>

<div class="entry-header<?php if ( has_post_thumbnail() ) echo ' has-post-thumbnail'; ?><?php echo has_post_thumbnail() ? ' invert' : ''; ?>">

	<?php
		$utility = monstroid2_utility()->utility;
		$sub_title = get_post_meta( $post->ID, 'sub_title', true );
	?>

	<div class="post-thumbnail">
		<?php $utility->media->get_image( array(
			'size'        => 'monstroid2-thumb-xl',
			'mobile_size' => 'monstroid2-thumb-xl',
			'html'        => '<img class="wp-post-image" src="%3$s" alt="%4$s">',
			'placeholder' => false,
			'echo'        => true,
		) );
		?>
	</div><!-- .post-thumbnail -->

	<div class="container">
		<?php $utility->attributes->get_title( array(
				'class' => 'entry-title',
				'html'  => '<h1 %1$s>%4$s</h1>',
				'echo'  => true,
			) );
		?>

		<?php if( $sub_title ) echo '<p class="entry-sub-title">' . $sub_title . '</p>' ?>
	</div>

</div>
