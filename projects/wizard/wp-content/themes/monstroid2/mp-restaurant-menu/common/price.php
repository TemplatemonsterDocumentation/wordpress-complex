<?php

if ( empty( $price ) ) {
	$price = mprm_get_price();
}

$price = mprm_currency_filter( mprm_format_amount( $price ) );
if ( mprm_get_template_mode() == 'theme' ) { ?>
	<div class="mprm-content-container mprm-price-container">
		<span class="mprm-price"><?php echo $price ?></span>
	</div>
<?php } else { ?>
	<span class="mprm-price"><?php echo $price ?></span>
<?php }
