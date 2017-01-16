<?php
/**
 * Available varialbes
 * - bool $isShowTitle
 * - bool $isShowImage
 * - bool $isShowExcerpt
 * - bool $isShowDetails
 * - bool $isShowPrice
 * - bool $isShowBookButton
 * - string $price
 * - WP_Term[] $categories
 * - WP_Term[] $facilities
 * - string $view
 * - string $size
 * - string $bedType
 * - string $adults
 * - string $children
 */
if ( !defined( 'ABSPATH' ) ) {
	exit;
}
$wrapperClass = apply_filters( 'mphb_widget_rooms_item_class', join( ' ', mphb_tmpl_get_filtered_post_class( 'mphb-room-type' ) ) );

?>
<div class="<?php echo esc_attr( $wrapperClass ); ?>">

	<?php do_action( 'mphb_widget_rooms_item_top' ); ?>

	<?php if ( $isShowImage && has_post_thumbnail() ) : ?>
		<div class="mphb-widget-room-type-featured-image">
			<a href="<?php the_permalink(); ?>">
				<?php
					the_post_thumbnail(
						apply_filters( 'mphb_widget_rooms_thumbnail_size', 'post-thumbnail' )
					);
				?>
			</a>
		</div>
	<?php endif; ?>

	<?php if ( $isShowTitle ) : ?>
		<div class="mphb-widget-room-type-title">
			<a href="<?php the_permalink(); ?>">
				<?php the_title(); ?>
			</a>
		</div>
	<?php endif; ?>

	<?php if ( $isShowPrice ) : ?>
		<div class="mphb-widget-room-type-price">
			<div class="mphb-price-wrapper">
				<?php mphb_tmpl_the_room_type_default_price(); ?>
				<span class="mphb-price-suffix h5-style"><?php echo esc_html__( '/per night', 'monstroid2' ); ?></span>
			</div>
		</div>
	<?php endif; ?>

	<?php if ( $isShowExcerpt && has_excerpt() ) : ?>
		<div class="mphb-widget-room-type-description">
			<?php the_excerpt(); ?>
		</div>
	<?php endif; ?>

	<?php if ( $isShowDetails ) : ?>
		<ul class="mphb-widget-room-type-attributes">
			<li class="mphb-room-type-adults">
				<span><?php echo esc_html__( 'Adults:', 'monstroid2' ); ?></span>
				<?php echo $adults; ?>
			</li>
			<?php if ( $children != 0 ) : ?>
				<li class="mphb-room-type-children">
					<span><?php echo esc_html__( 'Children:', 'monstroid2' ); ?></span>
					<?php echo $children; ?>
				</li>
			<?php endif; ?>
			<?php if ( !empty( $categories ) ) : ?>
				<li class="mphb-room-type-categories">
					<span><?php echo esc_html__( 'Categories:', 'monstroid2' ); ?></span>
					<?php
						$categories = array_map( 'monstroid2_skin5_mphb_get_list_taxonomies', $categories );

						echo ' ' . join( ', ', $categories );
					?>
				</li>
			<?php endif; ?>
			<?php if ( !empty( $facilities ) ) : ?>
				<li class="mphb-room-type-facilities">
					<span><?php echo esc_html__( 'Facilities:', 'monstroid2' ); ?></span>
					<?php
						$facilities = array_map( 'monstroid2_skin5_mphb_get_list_taxonomies' , $facilities );

						echo ' ' . join( ', ', $facilities );
					?>
				</li>
			<?php endif; ?>
			<?php if ( !empty( $view ) ) : ?>
				<li class="mphb-room-type-view">
					<span><?php echo esc_html__( 'View:', 'monstroid2' ); ?></span>
					<?php echo $view; ?>
				</li>
			<?php endif; ?>
			<?php if ( !empty( $size ) ) : ?>
				<li class="mphb-room-type-size">
					<span><?php echo esc_html__( 'Size:', 'monstroid2' ); ?></span>
					<?php echo $size; ?>
				</li>
			<?php endif; ?>
			<?php if ( !empty( $bedType ) ) : ?>
				<li class="mphb-room-type-bed-type">
					<span><?php echo esc_html__( 'Bed Type:', 'monstroid2' ); ?></span>
					<?php echo $bedType; ?>
				</li>
			<?php endif; ?>
		</ul>
	<?php endif; ?>

	<?php if ( $isShowBookButton ) : ?>
		<div class="mphb-widget-room-type-book-button">
			<?php mphb_tmpl_the_loop_room_type_book_button_form( esc_html__( 'Book Now!', 'monstroid2' ) ); ?>
		</div>
	<?php endif; ?>

	<?php do_action( 'mphb_widget_rooms_item_bottom' ); ?>

</div>
