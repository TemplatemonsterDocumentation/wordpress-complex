<?php global $mprm_view_args, $mprm_term;
$icon               = mprm_get_category_icon();
$image_is_available = mprm_has_category_image() && ! empty( $mprm_view_args['feat_img'] );
$category_image_src = mprm_get_category_image( 'mprm-big' );

?>
<div class="mprm-menu-category <?php echo get_column_class( $mprm_view_args['col'] ) ?>">

	<?php if ( $image_is_available && $category_image_src ): ?>
		<div class="mprm-category-image-wrap mprm-columns mprm-five">
			<a href="<?php echo esc_url( get_term_link( $mprm_term ) ); ?>" class="mprm-link">
				<img class="mprm-category-list-image" src="<?php echo esc_url( $category_image_src ); ?>" alt="<?php if ( ! empty( $mprm_view_args['categ_name'] ) ) : echo $mprm_term->name; endif; ?>">
			</a>
		</div>
	<?php endif; ?>
	<div class="mprm-category-content <?php echo ( $image_is_available && $category_image_src ) ? 'mprm-columns mprm-seven' : '' ?>">
		<h2 class="mprm-title">
			<a href="<?php echo esc_url( get_term_link( $mprm_term ) ); ?>" class="mprm-link">
				<?php if ( ! empty( $icon ) && ! empty( $mprm_view_args['categ_icon'] ) ): ?>
				<i class="mprm-icon  <?php echo $icon ?>"></i><?php endif;
				if ( ! empty( $mprm_view_args['categ_name'] ) ) : echo $mprm_term->name; endif; ?>
			</a>
		</h2>

		<?php if ( ! empty( $mprm_view_args['categ_descr'] ) ) {
			$desc_length = isset( $mprm_view_args['desc_length'] ) ? $mprm_view_args['desc_length'] : - 1;
			$description = mprm_cut_str( $desc_length, $mprm_term->description );
			if ( ! empty( $description ) ) { ?>
				<p class="mprm-category-description">
					<?php echo $description; ?>
				</p>
			<?php }
		}
		?>
		<?php if ( apply_filters( 'monstroid2_mprm_category_btn_visibility', false ) ) { ?>
			<a href="<?php echo esc_url( get_term_link( $mprm_term ) ); ?>" class="mprm-btn btn btn-primary"><?php echo apply_filters( 'monstroid2_mprm_category_btn_text', esc_html__( 'See menu', 'monstroid2' ) ) ?></a>
		<?php } ?>

	</div>
</div>
