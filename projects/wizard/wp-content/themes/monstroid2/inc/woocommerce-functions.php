<?php
/**
 * Monstroid2 WooCommerce Theme hooks.
 *
 * @package Monstroid2
 */

/**
 * Enable Woocommerce theme support
 */

function monstroid2_woocommerce_support() {
	add_theme_support( 'woocommerce' );
}

/**
 * Display Product Search
 * @since  1.0.0
 * @uses  is_woocommerce_activated() check if WooCommerce is activated
 * @return void
 */
function monstroid2_product_search() {
	if ( monstroid2_is_woocommerce_activated() ) { ?>
		<div class="top-panel__search">
			<?php the_widget( 'WC_Widget_Product_Search', 'title=' ); ?>
		</div>
		<?php
	}
}

/**
 * Change WooCommerce loop category title layout
 *
 * @param object $category
 *
 * @return string
 */
function woocommerce_template_loop_category_title( $category ) {
	?>
	<div class="title_count_block">
		<?php if ( 0 < $category->count ) {
			echo '<a href="' . get_term_link( $category, 'product_cat' ) . '"  class="count">';
			echo apply_filters( 'woocommerce_subcategory_count_html', ' <span><span class="count__number">' . $category->count . '</span> ' . esc_html__( 'products', 'monstroid2' ) . '</span>', $category );
			echo '</a>';
		}
		?>
		<h3><?php
			echo '<a href="' . get_term_link( $category, 'product_cat' ) . '">';
			echo $category->name;
			echo '</a>';
			?>
		</h3>
	</div>
	<?php
}


function monstroid2_tm_categories_carousel_widget_arrows_pos() {
	return 'outside';
}

/**
 * Check is WPML Plugin exists and enabled
 *
 * @return bool
 */
function monstroid2_has_wpml() {
	if ( ! isset( $monstroid2_has_wpml ) || null == $monstroid2_has_wpml ) {
		$monstroid2_has_wpml = in_array( 'sitepress-multilingual-cms/sitepress.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) );
	}

	return $monstroid2_has_wpml;
}

/**
 * Show top Language Selector
 *
 * @param  string $format Output formatting.
 *
 * @return void
 */

function monstroid2_top_language_selector( $format = '%s' ) {
	$is_enabled = get_theme_mod( 'top_language_selector', monstroid2_theme()->customizer->get_default( 'top_language_selector' ) );
	if ( ! $is_enabled ) {
		return;
	}
	printf( $format, do_action( 'wpml_add_language_selector' ) );
}

/**
 * Print sale and date format
 *
 * @return string
 */
function monstroid2_products_sale_end_date() {
	global $product;
	$sale_end_date = get_post_meta( $product->id, '_sale_price_dates_to', true );
	if ( '' != $sale_end_date ) {
		$data_format   = apply_filters( 'tm_products_sale_end_date_format', esc_html__( '%D %H:%M:%S', 'monstroid2' ) );
		$sale_end_date = '<span class="tm-products-sale-end-date" data-countdown="' . date( 'Y/m/d', $sale_end_date ) . '" data-format="' . $data_format . '"></span>';
	}
	echo $sale_end_date;
}

function monstroid2_products_format_sale_end_date() {
	return sprintf( '<span>%%D <i>%1$s</i></span> <span>%%H <i>%2$s</i></span><span>%%M <i>%3$s</i></span>', esc_html( 'days', 'monstroid2' ), esc_html( 'Hrs', 'monstroid2' ), esc_html__( 'Min', 'monstroid2' ) );
}


/**
 * Add WooCommerce 'New' and 'Featured' Flashes
 *
 */
function monstroid2_woocommerce_show_flash() {
	global $product;

	if ( ! $product->is_on_sale() ) {

		if ( 604800 > ( date( 'U' ) - strtotime( $product->post->post_date ) ) ) {
			echo '<span class="new">' . esc_html__( 'New', 'monstroid2' ) . '</span>';
		} else if ( $product->is_featured() ) {
			echo '<span class="featured">' . esc_html__( 'Featured', 'monstroid2' ) . '</span>';
		}
	}
}

/**
 * Add extra customizer options
 *
 * @param  array $args Existing options.
 *
 * @return array
 */
function monstroid2_add_options( $args ) {
	if ( monstroid2_has_wpml() ) {
		$args[ 'options' ][ 'top_language_selector' ] = array(
			'title'   => esc_html__( 'On/Off Language Selector', 'monstroid2' ),
			'section' => 'header_top_panel',
			'default' => true,
			'field'   => 'checkbox',
			'type'    => 'control',
		);
	}

	return $args;
}

/**
 * Change WooCommerce Price Output when Product is on Sale
 *
 * @param  string     $price Price
 * @param  int|string $from Regular price
 * @param  int|string $to Sale price
 *
 * @return string
 */
function monstroid2_woocommerce_get_price_html_from_to( $price, $from, $to ) {
	$price = '<ins>' . ( ( is_numeric( $to ) ) ? wc_price( $to ) : $to ) . '</ins> <del>' . ( ( is_numeric( $from ) ) ? wc_price( $from ) : $from ) . '</del>';

	return $price;
}


/**
 * Open wrap comapre & wishlist button grid-listing
 *
 */
function monstroid2_compare_wishlist_wrap_open( $atts = '' ) {
	if ( 'list' !== $atts ) {
		echo '<div class="wishlist_compare_button_block">';
	}
}

/**
 * Close wrap comapre & wishlist button grid-listing
 *
 */
function monstroid2_compare_wishlist_wrap_close( $atts = '' ) {
	if ( 'list' !== $atts ) {
		echo '</div>';
	}
}

/**
 * Open wrap comapre & wishlist button list-listing
 *
 */
function monstroid2_compare_wishlist_wrap_list_open( $atts = '' ) {
	if ( 'list' === $atts ) {
		echo '<div class="wishlist_compare_button_block">';
	}
}

/**
 * Close wrap comapre & wishlist button list-listing
 *
 */
function monstroid2_compare_wishlist_wrap_list_close( $atts = '' ) {
	if ( 'list' === $atts ) {
		echo '</div>';
	}
}

/**
 * Rewrite functions compare & wishlist for grid or listing layouts
 *
 */
function monstroid2_woocompare_add_button_loop( $atts = '' ) {
	if ( 'list' !== $atts && function_exists( 'tm_woocompare_add_button_loop' ) ) {
		tm_woocompare_add_button_loop( $atts );
	}
}

function monstroid2_woocompare_add_button_loop_list( $atts = '' ) {
	if ( 'list' === $atts && function_exists( 'tm_woocompare_add_button_loop' ) ) {
		tm_woocompare_add_button_loop( $atts );
	}
}

function monstroid2_woowishlist_add_button_loop( $atts = '' ) {
	if ( 'list' !== $atts && function_exists( 'tm_woowishlist_add_button_loop' ) ) {
		tm_woowishlist_add_button_loop( $atts );
	}
}

function monstroid2_woowishlist_add_button_loop_list( $atts = '' ) {
	if ( 'list' === $atts && function_exists( 'tm_woowishlist_add_button_loop' ) ) {
		tm_woowishlist_add_button_loop( $atts );
	}
}

/**
 * Rewrite functions rating for grid or listing layouts
 *
 */

function monstroid2_woocommerce_template_loop_rating( $atts = '' ) {
	if ( 'list' !== $atts ) {
		woocommerce_template_loop_rating( $atts );
	}
}

function monstroid2_woocommerce_template_loop_rating_list( $atts = '' ) {
	if ( 'list' === $atts ) {
		woocommerce_template_loop_rating( $atts );
	}
}

/**
 * Added custom thumbnail size for listing-line category thumbnail
 *
 */

function woocommerce_subcategory_thumbnail( $category, $atts = '' ) {
	global $_wp_additional_image_sizes;
	if ( 'list' === $atts ) {
		$small_thumbnail_size = apply_filters( 'subcategory_archive_thumbnail_list_size', 'monstroid2-thumb-listing-line-product' );
		$image_sizes          = get_intermediate_image_sizes();

		if ( in_array( $small_thumbnail_size, $image_sizes ) ) {
			$dimensions[ 'width' ]  = $_wp_additional_image_sizes[ $small_thumbnail_size ][ 'width' ];
			$dimensions[ 'height' ] = $_wp_additional_image_sizes[ $small_thumbnail_size ][ 'height' ];
			$dimensions[ 'crop' ]   = $_wp_additional_image_sizes[ $small_thumbnail_size ][ 'crop' ];
		} else {
			$dimensions[ 'width' ]  = '300';
			$dimensions[ 'height' ] = '300';
			$dimensions[ 'crop' ]   = 1;
		}

	} else {
		$small_thumbnail_size = apply_filters( 'subcategory_archive_thumbnail_size', 'shop_catalog' );
		$dimensions           = wc_get_image_size( $small_thumbnail_size );
	}

	$thumbnail_id = get_woocommerce_term_meta( $category->term_id, 'thumbnail_id', true );

	if ( $thumbnail_id ) {
		$image = wp_get_attachment_image_src( $thumbnail_id, $small_thumbnail_size );
		$image = $image[ 0 ];
	} else {
		$image = wc_placeholder_img_src();
	}

	if ( $image ) {
		// Prevent esc_url from breaking spaces in urls for image embeds
		// Ref: https://core.trac.wordpress.org/ticket/23605
		$image = str_replace( ' ', '%20', $image );

		echo '<img src="' . esc_url( $image ) . '" alt="' . esc_attr( $category->name ) . '" width="' . esc_attr( $dimensions[ 'width' ] ) . '" height="' . esc_attr( $dimensions[ 'height' ] ) . '" />';
	}
}


/**
 * Add links into product title
 *
 */

function monstroid2_template_loop_product_title() {
	echo '<h3><a href="' . get_the_permalink() . '" class="woocommerce-LoopProduct-link">' . get_the_title() . '</a></h3>';
}

/**
 * Added custom thumbnail size for listing-line products
 *
 */

function monstroid2_get_product_thumbnail_size( $atts = '' ) {
	if ( 'list' === $atts ) {
		echo woocommerce_get_product_thumbnail( 'monstroid2-thumb-listing-line-product' );
	} else {
		echo woocommerce_get_product_thumbnail();
	}
}


/**
 * Wrap content single product
 *
 */
function monstroid2_single_product_open_wrapper() {
	echo '<div class="single_product_wrapper">';
}

function monstroid2_single_product_close_wrapper() {
	echo '</div>';
}

/**
 * Open wrap product loop elements
 *
 */
function monstroid2_product_image_wrap_open() {
	echo '<div class="block_product_thumbnail">';
}

/**
 * Close wrap product loop elements
 *
 */
function monstroid2_product_image_wrap_close() {
	echo '</div>';
}

/**
 * Open wrap content product loop elements
 *
 */
function monstroid2_product_content_wrap_open() {
	echo '<div class="block_product_content">';
}

/**
 * Open wrap content product loop elements
 *
 */
function monstroid2_product_content_wrap_close() {
	echo '</div>';
}


/**
 * Assets woocommerce script
 *
 */

function monstroid2_enqueue_assets() {

	wp_register_script( 'jquery-easyzoom', MONSTROID2_THEME_URI . '/assets/js/min/easyzoom.min.js', array( 'jquery' ), '2.3.1', true );
	wp_enqueue_script( 'single-init', MONSTROID2_THEME_URI . '/assets/js/single-product.js', array( 'jquery-easyzoom' ), '1.0.0', true );

	if ( monstroid2_is_woocommerce_activated() ) {
		wp_enqueue_script( 'countdown-script', MONSTROID2_THEME_URI . '/assets/js/min/jquery.countdown.min.js', array(), '2.1.0', true );
		wp_enqueue_script( 'woo-script', MONSTROID2_THEME_URI . '/assets/js/woo-theme-script.js', array(), '1.0.0', true );
	}
}


function monstroid2_thumb_cols() {
	return 5; // .last class applied to every 4th thumbnail
}

/*
 *
 * Function ProductImage easezoom
 */
function woocommerce_show_product_images() {
	global $post, $product;
	?>
	<div class="images">
		<?php if ( has_post_thumbnail() ) {
			$image_caption    = get_post( get_post_thumbnail_id() )->post_excerpt;
			$image_link       = wp_get_attachment_url( get_post_thumbnail_id() );
			$image            = get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array(
				'title' => get_the_title( get_post_thumbnail_id() )
			) );
			$attachment_count = count( $product->get_gallery_attachment_ids() );

			if ( 0 < $attachment_count ) {
				$gallery = '[product-gallery]';
			} else {
				$gallery = '';
			}
			echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<a href="%s" itemprop="image" class="woocommerce-main-image zoom" title="%s" data-rel="prettyPhoto' . $gallery . '">%s</a>', $image_link, $image_caption, $image ), $post->ID );
		} else {
			echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), esc_html__( 'Placeholder', 'monstroid2' ) ), $post->ID );
		}
		do_action( 'woocommerce_product_thumbnails' ); ?>
	</div>

<?php }


function monstroid2_woocommerce_product_gallery_attachment_ids( $attachment_ids ) {
	global $product;
	if ( has_post_thumbnail() ) {
		array_unshift( $attachment_ids, get_post_thumbnail_id() );
	}

	return $attachment_ids;
}

function monstroid2_woocommerce_single_product_image_thumbnail_html( $link, $attachment_id, $post_ID, $image_class ) {
	$image_link      = wp_get_attachment_url( $attachment_id );
	$image_title     = esc_attr( get_the_title( $attachment_id ) );
	$image_caption   = esc_attr( get_post_field( 'post_excerpt', $attachment_id ) );
	$image           = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ), 0, $attr = array(
		'title' => $image_title,
		'alt'   => $image_title
	) );
	$large_thumb_src = wp_get_attachment_image_src( $attachment_id, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ) );

	return sprintf( '<div class="thumbnail %s" data-href="%s" data-thumb="%s" title="%s">%s</div>', $image_class, $image_link, $large_thumb_src[ 0 ], $image_caption, $image );
}

function monstroid2_woocommerce_single_product_image_html( $html, $post_ID ) {
	global $post;
	if ( has_post_thumbnail() ) {
		$image_link = wp_get_attachment_url( get_post_thumbnail_id() );
		$image      = get_the_post_thumbnail( $post_ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array(
			'title' => get_the_title( get_post_thumbnail_id() )
		) );
		$enlarge    = '';
		if ( 'yes' === get_option( 'woocommerce_enable_lightbox', 'yes' ) ) {
			wp_enqueue_script( 'magnific-popup' );
			$enlarge = '<div class="enlarge"><i class="material-icons">zoom_in</i></div>';
		}

		return sprintf( '<div class="easyzoom"><a href="%s" class="woocommerce-main-image">%s</a></div>%s', $image_link, $image, $enlarge );
	}

	return $html;
}


/*
 *
 * Wrap products carousel - div
 */


function monstroid2_tm_products_carousel_widget_wrapper_open() {
	return '<div class="swiper-wrapper tm-products-carousel-widget-wrapper products">';
}

function monstroid2_tm_products_carousel_widget_wrapper_close() {
	return '</div>';
}

/*
 *
 * Related products carousel
 */
/**
 * Output the related products.
 *
 * @subpackage  Product
 */
function woocommerce_output_related_products() {

	$args = array(
		'posts_per_page' => 10,
		'columns'        => 4,
		'orderby'        => 'rand'
	);

	woocommerce_related_products( apply_filters( 'woocommerce_output_related_products_args', $args ) );
}

/**
 * Output the related products.
 *
 * @param array Provided arguments
 * @param bool Columns argument for backwards compat
 * @param bool Order by argument for backwards compat
 */
function woocommerce_related_products( $args = array(), $columns = false, $orderby = false ) {

	if ( ! is_array( $args ) ) {
		_deprecated_argument( __FUNCTION__, '2.1', esc_html__( 'Use', 'monstroid2' ) . $args . esc_html__( ' argument as an array instead. Deprecated argument will be removed in WC 2.2.', 'monstroid2' ) );

		$argsvalue = $args;

		$args = array(
			'posts_per_page' => $argsvalue,
			'columns'        => $columns,
			'orderby'        => $orderby,
		);
	}

	$defaults = array(
		'post_type'           => 'product',
		'ignore_sticky_posts' => 1,
		'no_found_rows'       => 1,
		'posts_per_page'      => 2,
		'columns'             => 2,
		'orderby'             => 'rand'
	);

	$args = wp_parse_args( $args, $defaults );


	global $product, $woocommerce_loop;

	if ( empty( $product ) || ! $product->exists() ) {
		return;
	}

	$related = $product->get_related( $args[ 'posts_per_page' ] );

	if ( 0 === sizeof( $related ) ) {
		return;
	}

	$args[ 'post__in' ]     = $related;
	$args[ 'post__not_in' ] = array( $product->id );

	$args = apply_filters( 'woocommerce_related_products_args', $args );

	$products = new WP_Query( $args );

	$woocommerce_loop[ 'columns' ] = $columns;

	if ( $products->have_posts() ) : ?>

		<div class="related products">

			<h4><?php esc_html_e( 'Related Products', 'monstroid2' ); ?></h4>

			<?php woocommerce_product_loop_start( true, true ); ?>

			<?php while ( $products->have_posts() ) : $products->the_post(); ?>

				<?php wc_get_template( 'content-product.php', array( 'swiper' => true ) ); ?>

			<?php endwhile; // end of the loop. ?>

			<?php woocommerce_product_loop_end( true, true ); ?>

		</div>

	<?php endif;

	wp_reset_postdata();
}


function woocommerce_product_loop_start( $echo = true, $swiper = false ) {
	ob_start();
	if ( is_product() || $swiper ) {
		$uniqid              = uniqid();
		$GLOBALS[ 'uniqid' ] = $uniqid;
		$sidebar_position    = get_theme_mod( 'sidebar_position' );
		$slides_per_view     = 'fullwidth' === $sidebar_position || is_product() ? '4' : '3';
		$data_attr_line      = 'class="monstroid2-carousel swiper-container"';
		$data_attr_line .= ' data-uniq-id="swiper-carousel-' . $uniqid . '"';
		$data_attr_line .= ' data-slides-per-view="' . $slides_per_view . '"';
		$data_attr_line .= ' data-slides-per-group="1"';
		$data_attr_line .= ' data-slides-per-column="1"';
		$data_attr_line .= ' data-space-between-slides="50"';
		$data_attr_line .= ' data-duration-speed="500"';
		$data_attr_line .= ' data-swiper-loop="false"';
		$data_attr_line .= ' data-free-mode="false"';
		$data_attr_line .= ' data-grab-cursor="true"';
		$data_attr_line .= ' data-mouse-wheel="false"';

		echo '<div class="swiper-carousel-container">';
		echo '<div id="swiper-carousel-' . $uniqid . '" ' . $data_attr_line . '>';
		echo '<div class="swiper-wrapper">';
	} elseif ( is_shop() || is_product_taxonomy() ) { ?>
		<div class="products row">
	<?php } else { ?>
		<div class="shop_wrapper category_wrapper">
		<div class="products row">
	<?php }
	if ( $echo ) {
		echo ob_get_clean();
	} else {
		return ob_get_clean();
	}
}

function woocommerce_product_loop_end( $echo = true, $swiper = false ) {
	ob_start();
	if ( is_product() || $swiper ) {
		global $uniqid;
		echo '</div>';
		echo '</div>';
		echo '<div id="swiper-carousel-' . $uniqid . '-next" class="swiper-button-next button-next"></div><div id="swiper-carousel-' . $uniqid . '-prev" class="swiper-button-prev button-prev"></div>';
		echo '</div>';
		unset( $GLOBALS[ 'uniqid' ] );
	} elseif ( is_shop() || is_product_taxonomy() ) { ?>
		</div>
	<?php } else { ?>
		</div>
		</div>
	<?php }
	if ( $echo ) {
		echo ob_get_clean();
	} else {
		return ob_get_clean();
	}
}


/*
 *
 * Page Cart Checkout
 */

function woocommerce_cross_sell_display( $posts_per_page = 2, $columns = 3, $orderby = 'rand' ) {

	if ( is_checkout() ) {
		return;
	}

	wc_get_template( 'cart/cross-sells.php', array(
		'posts_per_page' => $posts_per_page,
		'orderby'        => $orderby,
		'columns'        => $columns,
	) );

}


function monstroid2_woocommerce_cart_item_name( $title, $cart_item, $cart_item_key ) {
	// Split on spaces.
	$title = preg_split( '/\s+/', $title );

	// Slice array
	$title = array_slice( $title, 0, 4 );

	// Re-create the string.
	$title = join( ' ', $title );

	return '<span class="mini_cart_item_title">' . $title . '&hellip;</span>';
}

/*
 *
 * Function for Smartbox thumbnail
 */
function woocommerce_template_loop_product_thumbnail_custom_size() {
	echo woocommerce_get_product_thumbnail( 'monstroid2-smart-box-thumb' );
}

function monstroid2_products_smart_box_widget__cat_img_size() {
	return 'monstroid2-thumb-listing-line-product';
}

/*
 *
 * Remove woo-pagination and added theme pagination
 */
function monstroid2_woocommerce_pagination_args( $args = array() ) {

	unset( $args[ 'type' ] );
	unset( $args[ 'end_size' ] );
	unset( $args[ 'mid_size' ] );

	return $args;
}


/**
 * Add product categories in product list
 *
 * @return string
 */
function monstroid2_woocommerce_list_categories() {
	global $product;
	if ( ! empty( $product ) ) {
		echo $product->get_categories( '</li> <li>', '<ul class="product-categories"><li>', '</li></ul>' );
	}
}

/**
 * Display short description for listing-line template product
 *
 */
function monstroid2_woocommerce_display_short_excerpt( $atts = '' ) {
	if ( 'list' === $atts ) {
		echo '<div class="desc_products_listing_line">';
		woocommerce_template_single_excerpt( $atts );
		echo '</div>';
	}
}


/**
 * Add layout synchronization for product loop and product carousel widget
 *
 */

add_filter( 'tm_products_carousel_widget_hooks', 'monstroid2_products_carousel_widget_hooks' );
function monstroid2_products_carousel_widget_hooks( $hooks ) {

	$hooks[ 'cat' ] = array(
		'woocommerce_before_shop_loop_item_title',
		'monstroid2_woocommerce_list_categories',
		14,
		1
	);

	$hooks[ 'title' ] = array(
		'woocommerce_shop_loop_item_title',
		'monstroid2_template_loop_product_title',
		10,
		1
	);

	$hooks[ 'price' ] = array(
		'woocommerce_after_shop_loop_item',
		'woocommerce_template_loop_price',
		5,
		1
	);

	return $hooks;
}
