<?php
if ( empty( $tags ) ) {
	$tags = mprm_get_tags();
}
$template_mode       = mprm_get_template_mode();
$template_mode_class = ( $template_mode == 'theme' ) ? 'mprm-content-container' : '';
$tags_array          = array();

if ( ! empty( $tags ) ): ?>
	<div class="mprm-tags-wrapper mprm-tags <?php echo esc_attr( $template_mode_class ); ?>">

		<?php foreach ( $tags as $key => $tag ) {
			if ( ! is_object( $tag ) ) {
				continue;
			}
			$tags_array[ $key ] = '<a href="' . esc_url( get_term_link( $tag ) ) . '" class="mprm-tag-' . $tag->slug . '"><span>' . $tag->name . '</span></a>';
		}

		echo implode( ' ', $tags_array ); ?>

	</div>
<?php endif; ?>
