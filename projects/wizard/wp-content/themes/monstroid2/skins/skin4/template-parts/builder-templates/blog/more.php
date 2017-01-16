<?php
/**
 * Template for displaying read more button
 *
 * @package Monstroid2
 */
?>
<?php
	tm_builder_core()->utility()->attributes->get_button( array(
		'text'  => esc_html__( 'Read More', 'monstroid2' ),
		'class' => 'post-btn btn',
		'html'  => '<a href="%1$s" %3$s>%4$s%5$s</a>',
		'echo'  => true,
	) );
