<?php

$price = mprm_get_price();

if ( ! empty( $price ) ) {
	$price = mprm_currency_filter( mprm_format_amount( $price ) );
	?>
	<div class="mprm-price-box">
		<h5 class="mprm-price"><?php printf( esc_html__( 'Price: %s', 'monstroid2' ), $price ); ?></h5>
	</div>
	<?php
}
