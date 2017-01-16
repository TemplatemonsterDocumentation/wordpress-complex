<?php global $mprm_view_args, $mprm_term;
$title         = ! empty( $mprm_term ) ? $mprm_term->name : '';
$icon          = mprm_get_category_icon();
$template_mode = mprm_get_template_mode();

if ( ! empty( $mprm_view_args['categ_name'] ) && 'none' !== $mprm_view_args['categ_name'] ) {
	if ( mprm_has_category_image() && ( 'with_img' == $mprm_view_args['categ_name'] ) ) { ?>
		<div class="mprm-header with-image" style="background-image: url('<?php echo ( mprm_has_category_image() ) ? esc_url( mprm_get_category_image( 'large' ) ) : 'none'; ?>')">
			<div class="mprm-header-content">
				<h2 class="mprm-title"><?php if ( ! empty( $icon ) ): ?>
					<i class="mprm-icon <?php echo esc_attr( $icon ); ?>"></i><?php endif; ?><?php echo $title ?>
				</h2>
			</div>
		</div>
	<?php } else {
		if ( $template_mode == 'theme' ) { ?>
			<div class="mprm-taxonomy-title"><h3><?php echo $title ?></h3></div>
		<?php } else { ?>
			<div class="mprm-header only-text">
				<h2 class="mprm-title"><?php echo $title ?></h2>
			</div>
		<?php }
	}
}
