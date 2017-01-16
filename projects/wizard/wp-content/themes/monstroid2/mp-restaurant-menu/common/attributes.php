<?php
if ( empty( $attributes ) ) {
	$attributes = mprm_get_attributes();
}
$template_mode       = mprm_get_template_mode();
$template_mode_class = ( $template_mode == 'theme' ) ? 'mprm-content-container' : '';

if ( $attributes ) { ?>
	<div class="mprm-proportions <?php echo esc_attr( $template_mode_class ); ?>">
		<?php if ( is_single() && apply_filters( 'mprm-show-title-attributes', ( empty( $mprm_title_attributes ) ? true : false ) ) ) : ?>
			<h5 class="mprm-title"><?php esc_html_e( 'Portion Size', 'monstroid2' ) ?></h5>
		<?php endif; ?>
		<?php if ( $template_mode == 'theme' ) {
			foreach ( $attributes as $info ): ?>
				<?php if ( ! empty( $info['val'] ) ): ?>
					<?php if ( is_single() ) { ?>
						<div class="mprm-proportion"><?php echo mprm_get_proportion_label( strtolower( $info['title'] ) ) . apply_filters( 'mprm-proportion-delimiter', ': ' ) . $info['val']; ?></div>
					<?php } else { ?>
						<div class="mprm-proportion"><?php echo $info['val']; ?></div>
					<?php } ?>
				<?php endif; ?>
			<?php endforeach;
		} else { ?>
			<ul class="mprm-list">
				<?php foreach ( $attributes as $info ): ?>
					<?php if ( ! empty( $info['val'] ) ): ?>
						<li class="mprm-proportion"><?php echo $info['val']; ?></li>
					<?php endif; ?>
				<?php endforeach; ?>
			</ul>
		<?php } ?>
	</div>
	<?php
}
