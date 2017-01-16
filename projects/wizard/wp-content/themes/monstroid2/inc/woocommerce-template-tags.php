<?php

/**
 * Cart Link
 * Displayed a link to the cart including the number of items present and the cart total
 * @param  array $settings Settings
 * @return array           Settings
 * @since  1.0.0
 */
function monstroid2_cart_link() {
	?>
		<div class="cart-contents" title="<?php esc_html_e( 'View your shopping cart', 'monstroid2' ); ?>">
			<i class="linearicon linearicon-cart"></i>
			<span class="count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
		</div>
	<?php
}


/**
 * Display Header Cart
 * @since  1.0.0
 * @uses  monstroid2_is_woocommerce_activated() check if WooCommerce is activated
 * @return void
 */
function monstroid2_header_cart() { ?>
	<div class="site-header-cart menu navbar-header-cart menu">
	<?php if ( monstroid2_is_woocommerce_activated() ) { ?>
		<div class="site-header-cart__wrapper">
			<?php monstroid2_cart_link(); ?>
			<div class="shopping_cart-dropdown-wrap products_in_cart_<?php echo WC()->cart->get_cart_contents_count(); ?>">
				<div class="shopping_cart-header">
					<h4><?php esc_html_e( 'My Cart', 'monstroid2' ) ?></h4>
				</div>
				<?php the_widget( 'WC_Widget_Cart', 'title=' ); ?>
			</div>
		</div>
	<?php } ?>
	</div>
<?php }

function monstroid2_cart_link_fragment( $fragments ) {
	global $woocommerce;
	ob_start();
	monstroid2_cart_link();
	$fragments['div.cart-contents'] = ob_get_clean();
	return $fragments;
}


/**
 * Show top currency switcher.
 *
 * @since  1.0.0
 * @param  string $format Output formatting.
 * @return void
 */
function monstroid2_currency_switcher() {
	if ( shortcode_exists( 'woocs' ) ) {
		echo do_shortcode( '[woocs show_flags=0 width="70px" txt_type="code"]' );
	}
}
