<?php
global $mprm_term;
if ( mprm_has_category_image() ) { ?>
	<div class="mprm-header with-image" style="background-image: url('<?php echo esc_url( mprm_get_category_image( 'monstroid2-thumb-xl' ) ); ?>')">
		<div class="mprm-header-content">
			<h2 class="mprm-title">
				<i class="<?php echo esc_attr( mprm_get_category_icon() ); ?> mprm-icon"></i><?php echo esc_html( $mprm_term->name ) ?>
			</h2>
		</div>
	</div>
<?php } else { ?>
	<div class="mprm-header only-text"><h3 class="mprm-title"><?php echo esc_html( $mprm_term->name ); ?></h3></div>
	<?php
}
