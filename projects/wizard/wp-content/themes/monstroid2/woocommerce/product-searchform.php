<?php
/**
 * The template for displaying product search form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/product-searchform.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.5.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>

<form role="search" method="get" class="search-form woocommerce-product-search" action="<?php echo esc_url( home_url( '/'  ) ); ?>">
<label>
	<label class="screen-reader-text" for="woocommerce-product-search-field"><?php _e( 'Search for:', 'monstroid2' ); ?></label>
    <i class="linearicon linearicon-magnifier"></i>
	<input type="search" id="woocommerce-product-search-field" class="search-field" placeholder="<?php echo esc_attr_x( 'Search Products&hellip;', 'placeholder', 'monstroid2' ); ?>" value="<?php echo get_search_query(); ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label', 'monstroid2' ); ?>" />
</label>
    <button type="submit" class="search-form__submit btn-primary"><i class="material-icons">search</i></button>
	<input type="hidden" name="post_type" value="product" />
</form>
