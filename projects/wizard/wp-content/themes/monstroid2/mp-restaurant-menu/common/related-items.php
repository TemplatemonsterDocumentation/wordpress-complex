<?php
$related_items = mprm_get_related_items();
if ( ! empty( $related_items ) ) {
	?>
	<div class="mprm-related-items">
		<h5 class="mprm-title"><?php esc_html_e( 'You might also like', 'monstroid2' ); ?></h5>
		<ul class="mprm-related-items-list">
			<?php foreach ( $related_items as $related_item ): ?>
				<li class="mprm-related-item">
					<?php if ( has_post_thumbnail( $related_item ) ):
						echo get_the_post_thumbnail( $related_item, apply_filters( 'mprm-related-item-image-size', 'monstroid2-thumb-s' ) );
					endif; ?>
					<p class="mprm-related-title">
						<a href="<?php echo esc_url( get_permalink( $related_item ) ); ?>" title="<?php echo esc_attr( get_the_title( $related_item ) ); ?>"><?php echo get_the_title( $related_item ) ?></a>
					</p>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
	<?php
}
