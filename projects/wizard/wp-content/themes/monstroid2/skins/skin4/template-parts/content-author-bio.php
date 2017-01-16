<?php
/**
 * The template for displaying author bio.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Monstroid2
 * @subpackage widgets
 */
?>
<div class="post-author-bio">
	<div class="post-author__avatar"><?php
		echo get_avatar( get_the_author_meta( 'user_email' ), 190, '', esc_attr( get_the_author_meta( 'nickname' ) ) );
	?></div>
	<div class="post-author__content-holder">
		<h5 class="post-author__title"><?php
			echo monstroid2_get_the_author_posts_link();
		?></h5>
		<h6 class="post-author__role"><?php
			$author_role = get_the_author_meta( 'roles' );
			echo $author_role[0];
		?></h6>
		<div class="post-author__content"><?php
			echo get_the_author_meta( 'description' );
		?></div>
	</div>
</div>
