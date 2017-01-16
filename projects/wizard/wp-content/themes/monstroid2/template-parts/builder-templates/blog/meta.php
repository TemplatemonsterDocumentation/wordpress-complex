<?php
/**
 * Template part for displaying post meta in Blog module
 *
 * @package Monstroid2
 */
if ( ! $module->is_meta_visible() ) {
	return;
}
?>
<div class="tm_pb_post_meta entry-meta"><?php

	if ( 'on' === $module->_var( 'show_date' ) ) {
		echo tm_get_safe_localization(
			sprintf(
				esc_html__( '%s', 'monstroid2' ),
				'<span class="published">' . esc_html( get_the_date( $module->_var( 'meta_date' ) ) ) . '</span>'
			)
		);
	}

	if ( 'on' === $module->_var( 'show_author' ) ) {
		echo tm_get_safe_localization(
			sprintf(
				'<span class="author vcard posted-by">%s' . tm_pb_get_the_author_posts_link() . '</span>',
				esc_html__( 'by ', 'monstroid2' )
			)
		);
	}

	if ( 'on' === $module->_var( 'show_comments' ) ) {
		printf(
			esc_html(
				_nx( '1 Comment', '%s Comments', get_comments_number(), 'number of comments', 'monstroid2' )
			),
			number_format_i18n( get_comments_number() )
		);
	}

	if ( 'on' === $module->_var( 'show_categories' ) ) {
		echo get_the_category_list( ', ' );
	}

?></div>
