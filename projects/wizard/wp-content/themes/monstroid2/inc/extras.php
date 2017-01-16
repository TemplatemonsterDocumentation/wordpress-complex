<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Monstroid2
 */

/**
 * Sidebar position
 */
add_filter( 'theme_mod_sidebar_position', 'monstroid2_set_post_meta_value' );

/**
 * Header container type
 */
add_filter( 'theme_mod_header_container_type', 'monstroid2_set_post_meta_value' );

/**
 * Content container type
 */
add_filter( 'theme_mod_content_container_type', 'monstroid2_set_post_meta_value' );

/**
 * Footer container type
 */
add_filter( 'theme_mod_footer_container_type', 'monstroid2_set_post_meta_value' );

/**
 * Header layout type
 */
add_filter( 'theme_mod_header_layout_type', 'monstroid2_set_post_meta_value' );

/**
 * Single post type
 */
add_filter( 'theme_mod_single_post_type', 'monstroid2_set_post_meta_value' );

/**
 * Header transparent layout
 */
add_filter( 'theme_mod_header_transparent_layout', 'monstroid2_pre_set_post_meta_value' );

/**
 * Header invert color scheme
 */
add_filter( 'theme_mod_header_invert_color_scheme', 'monstroid2_pre_set_post_meta_value' );

/**
 * Enable/disable breadcrumbs
 */
add_filter( 'theme_mod_breadcrumbs_visibillity', 'monstroid2_pre_set_post_meta_value' );

/**
 * Enable/disable top panel
 */
add_filter( 'theme_mod_top_panel_visibility', 'monstroid2_pre_set_post_meta_value' );

/**
 * Enable/disable header contact block
 */
add_filter( 'theme_mod_header_contact_block_visibility', 'monstroid2_pre_set_post_meta_value' );

/**
 * Enable/disable header search
 */
add_filter( 'theme_mod_header_search', 'monstroid2_pre_set_post_meta_value' );

/**
 * Enable/disable header woo elements
 */
add_filter( 'theme_mod_header_woo_elements', 'monstroid2_pre_set_post_meta_value' );


/**
 * Set post meta.
 */
function monstroid2_pre_set_post_meta_value( $value ) {

	$value = monstroid2_set_post_meta_value( $value );

	if ( 'true' === $value || 'false' === $value  ) {
		return wp_validate_boolean( $value );
	}

	return $value;
}

/**
 * Set post specific meta value
 *
 * @param  string $value Default meta-value.
 * @return string
 */
function monstroid2_set_post_meta_value( $value ) {
	$queried_obj = apply_filters( 'monstroid2_queried_object_id', false );
	if ( ! $queried_obj ) {
		$is_blog = ( ! is_front_page() && is_home() );
		if ( ! is_singular() && ! $is_blog ) {
			return $value;
		}
		if ( $is_blog ) {
			$queried_obj = get_option( 'page_for_posts' );
		}
		if ( is_front_page() && 'page' !== get_option( 'show_on_front' ) ) {
			return $value;
		}
	}
	$queried_obj = ( ! $queried_obj ) ? get_the_id() : $queried_obj;
	if ( ! $queried_obj ) {
		return $value;
	}
	$curr_opions = 'monstroid2_' . str_replace( 'theme_mod_', '', current_filter() );
	$post_position = get_post_meta( $queried_obj, $curr_opions, true );
	if ( ! $post_position || 'inherit' === $post_position ) {
		return $value;
	}
	return $post_position;
}

//function monstroid2_set_post_meta_value( $value ) {
//
//	$queried_obj = apply_filters( 'monstroid2_queried_object_id', false );
//
//	if ( ! $queried_obj && ! monstroid2_maybe_need_rewrite_mod() ) {
//		return $value;
//	}
//
//	$queried_obj = is_home() ? get_option( 'page_for_posts' ) : false;
//	$queried_obj = ! $queried_obj ? get_the_id() : $queried_obj;
//
//	if ( ! $queried_obj ) {
//		return $value;
//	}
//
//	$meta_key   = 'monstroid2_' . str_replace( 'theme_mod_', '', current_filter() );
//	$meta_value = get_post_meta( $queried_obj, $meta_key, true );
//
//	if ( ! $meta_value || 'inherit' === $meta_value ) {
//		return $value;
//	}
//
//	return $meta_value;
//}

/**
 * Check if we need to try rewrite theme mod or not
 *
 * @return boolean
 */
function monstroid2_maybe_need_rewrite_mod() {

	if ( is_front_page() && 'page' !== get_option( 'show_on_front' ) ) {
		return false;
	}

	if ( is_home() && 'page' == get_option( 'show_on_front' ) ) {
		return true;
	}

	if ( ! is_singular() ) {
		return false;
	}

	return true;
}

/**
 * Render existing macros in passed string.
 *
 * @since  1.0.0
 * @param  string $string String to parse.
 * @return string
 */
function monstroid2_render_macros( $string ) {

	$macros = apply_filters( 'monstroid2_data_macros', array(
		'/%%year%%/'      => date( 'Y' ),
		'/%%date%%/'      => date( get_option( 'date_format' ) ),
		'/%%site-name%%/' => get_bloginfo( 'name' ),
		'/%%home_url%%/'  => esc_url( home_url( '/' ) ),
		'/%%theme_url%%/' => get_stylesheet_directory_uri(),
	) );

	return preg_replace( array_keys( $macros ), array_values( $macros ), $string );

}

/**
 * Render font icons in content
 *
 * @param  string $content Content to render.
 * @return string
 */
function monstroid2_render_icons( $content ) {
	$icons     = monstroid2_get_render_icons_set();
	$icons_set = implode( '|', array_keys( $icons ) );

	$regex = '/icon:(' . $icons_set . ')?:?([a-zA-Z0-9-_]+)/';

	return preg_replace_callback( $regex, 'monstroid2_render_icons_callback', $content );
}

/**
 * Callback for icons render.
 *
 * @param  array $matches Search matches array.
 * @return string
 */
function monstroid2_render_icons_callback( $matches ) {

	if ( empty( $matches[1] ) && empty( $matches[2] ) ) {
		return $matches[0];
	}

	if ( empty( $matches[1] ) ) {
		return sprintf( '<i class="fa fa-%s"></i>', $matches[2] );
	}

	$icons = monstroid2_get_render_icons_set();

	if ( ! isset( $icons[ $matches[1] ] ) ) {
		return $matches[0];
	}

	return sprintf( $icons[ $matches[1] ], $matches[2] );
}

/**
 * Get list of icons to render.
 *
 * @return array
 */
function monstroid2_get_render_icons_set() {
	return apply_filters( 'monstroid2_render_icons_set', array(
		'fa'       => '<i class="fa fa-%s"></i>',
		'material' => '<i class="material-icons">%s</i>',
		'linear'   => '<i class="linearicon linearicon-%s"></i>',
	) );
}

/**
 * Replace %s with theme URL.
 *
 * @param  string $url Formatted URL to parse.
 * @return string
 */
function monstroid2_render_theme_url( $url ) {

	return sprintf( $url, get_stylesheet_directory_uri() );
}

/**
 * Get image ID by URL.
 *
 * @param  string $image_src Image URL to search it in database.
 * @return int|bool false
 */
function monstroid2_get_image_id_by_url( $image_src ) {
	global $wpdb;

	$query = "SELECT ID FROM {$wpdb->posts} WHERE guid = %s";
	$id    = $wpdb->get_var( $wpdb->prepare( $query, esc_url( $image_src ) ) );

	return $id;
}

/**
 * Print different galleries for masonry and non-masonry layout.
 */
function monstroid2_post_formats_gallery() {
	$size = monstroid2_post_thumbnail_size();

	if ( ! in_array( get_theme_mod( 'blog_layout_type' ), array( 'masonry-2-cols', 'masonry-3-cols' ) ) ) {
		return do_action( 'cherry_post_format_gallery', array(
			'size' => $size['size'],
		) );
	}

	$images = monstroid2_theme()->get_core()->modules['cherry-post-formats-api']->get_gallery_images( false );

	if ( is_string( $images ) && ! empty( $images ) ) {
		return $images;
	}

	$items             = array();
	$first_item        = null;
	$size              = $size['size'];
	$format            = '<div class="mini-gallery post-thumbnail--fullwidth">%1$s<div class="post-gallery__slides">%2$s</div></div>';
	$first_item_format = '<a href="%1$s" class="post-thumbnail__link">%2$s</a>';
	$item_format       = '<a href="%1$s">%2$s</a>';

	monstroid2_theme()->dynamic_css->add_style(
		'.post-gallery__slides',
		array( 'display' => 'none' )
	);

	foreach ( $images as $img ) {
		$image = wp_get_attachment_image( $img, $size );
		$url   = wp_get_attachment_url( $img );

		if ( sizeof( $items ) === 0 ) {
			$first_item = sprintf( $first_item_format, $url, $image );
		}

		$items[] = sprintf( $item_format, $url, $image );
	}

	printf( $format, $first_item, join( "\r\n", $items ) );
}

/**
 * Check if passed meta data is visible in current context.
 *
 * @since  1.0.0
 * @param  string $meta    Meta setting to check.
 * @param  string $context Current post context - 'single' or 'loop'.
 * @return bool
 */
function monstroid2_is_meta_visible( $meta, $context = 'loop' ) {

	if ( ! $meta ) {
		return false;
	}

	$meta_enabled = get_theme_mod( $meta, monstroid2_theme()->customizer->get_default( $meta ) );

	switch ( $context ) {

		case 'loop':

			if ( ! is_single() && $meta_enabled ) {
				return true;
			} else {
				return false;
			}

		case 'single':

			if ( is_single() && $meta_enabled ) {
				return true;
			} else {
				return false;
			}
	}

	return false;
}

/**
 * Get post thumbnail size.
 *
 * @return array
 */
function monstroid2_post_thumbnail_size( $args = array() ) {
	$sidebar_position = get_theme_mod( 'sidebar_position', monstroid2_theme()->customizer->get_default( 'sidebar_position' ) );

	$args = wp_parse_args( $args, array(
		'small'        => 'post-thumbnail',
		'fullwidth'    => ( 'fullwidth' !== $sidebar_position ) ? 'monstroid2-thumb-l' : 'monstroid2-thumb-1355-1020',
		'justify'      => 'monstroid2-thumb-l-2',
		'masonry'      => 'monstroid2-thumb-masonry',
		'class_prefix' => '',
	) );

	$layout      = get_theme_mod( 'blog_layout_type', monstroid2_theme()->customizer->get_default( 'blog_layout_type' ) );
	$size_option = get_theme_mod( 'blog_featured_image', monstroid2_theme()->customizer->get_default( 'blog_featured_image' ) );
	$size        = $args[ $size_option ];
	$link_class  = sanitize_html_class( $args['class_prefix'] . $size_option );

	global $wp_query;

	$valid_justify_post_1 = monstroid2_nth_child_post_item( 7, 2 );
	$valid_justify_post_2 = monstroid2_nth_child_post_item( 7, 3 );

	if ( 'default' !== $layout ) {
		$size       = $args['small'];
		$link_class = $args['class_prefix'] . 'fullwidth';
	}

	if ( in_array( $layout, array( 'masonry-2-cols', 'masonry-3-cols' ) ) ) {
		$size       = $args['masonry'];
		$link_class = $args['class_prefix'] . 'fullwidth';
	}

	if ( 'vertical-justify' === $layout && ! wp_is_mobile() && ( in_array( ( $wp_query->current_post + 1 ), $valid_justify_post_1 ) || in_array( ( $wp_query->current_post + 1 ), $valid_justify_post_2 ) ) ) {
		$size       = $args['justify'];
		$link_class = $args['class_prefix'] . 'fullwidth';
	}

	if ( is_single() ) {
		$size       = $args['fullwidth'];
		$link_class = $args['class_prefix'] . 'fullwidth';
	}

	return array(
		'size'  => $size,
		'class' => $link_class,
	);
}

/**
 * PHP analog css selector :nth-child( $multiplier*n + $addition).
 *
 * @param int $multiplier Multiplier.
 * @param int $addition   Addition.
 *
 * @return array
 */
function monstroid2_nth_child_post_item( $multiplier, $addition ) {
	global $posts_per_page;

	$valid_item = array();

	for ( $n = 0; $n < $posts_per_page; $n ++ ) {

		$result = $multiplier * $n + $addition;

		if ( $result > $posts_per_page ) {
			break;
		}

		$valid_item[] = $result;
	}

	return $valid_item;
}

/**
 * Check color is light or dark.
 *
 * @param string $color Hex color.
 *
 * @return null|string
 */
function monstroid2_hex_color_is_light_or_dark( $color ) {

	if ( false === strpos( $color, '#' ) ) {
		// Not a hex-color
		return null;
	}

	$hex = str_replace( '#', '', $color );

	if ( 3 === strlen( $hex ) ) {
		$r = hexdec( substr( $hex, 0, 1 ) . substr( $hex, 0, 1 ) );
		$g = hexdec( substr( $hex, 1, 1 ) . substr( $hex, 1, 1 ) );
		$b = hexdec( substr( $hex, 2, 1 ) . substr( $hex, 2, 1 ) );
	} else if ( 6 === strlen( $hex ) ) {
		$r = hexdec( substr( $hex, 0, 2 ) );
		$g = hexdec( substr( $hex, 2, 2 ) );
		$b = hexdec( substr( $hex, 4, 2 ) );
	} else {
		return false;
	}

	$luminance = ( $r * 0.299 ) + ( $g * 0.587 ) + ( $b * 0.114 );

	return ( $luminance >= 128 ) ? 'light' : 'dark' ;
}

/**
 * Get invert class.
 *
 * @param string $color Hex color.
 *
 * @return string
 */
function monstroid2_get_invert_class( $color ) {
	$invert_class = ( 'dark' === monstroid2_hex_color_is_light_or_dark( $color ) ) ? 'invert' : '';

	return $invert_class;
}

/**
 * Get invert class from customize color options.
 *
 * @param string $option Customize color option.
 *
 * @return string
 */
function monstroid2_get_invert_class_customize_option( $option ) {

	$color = get_theme_mod( $option, monstroid2_theme()->customizer->get_default( $option ) );

	return monstroid2_get_invert_class( $color );
}

/**
 * Get post template part slug.
 *
 * @return string
 */
function monstroid2_get_post_template_part_slug() {
	$blog_layout_type = get_theme_mod( 'blog_layout_type', monstroid2_theme()->customizer->get_default( 'blog_layout_type' ) );

	$blog_post_template = 'template-parts/post/default/content';

	if ( 'default' !== $blog_layout_type ) {
		$blog_post_template = 'template-parts/post/grid/content';
	}

	return apply_filters( 'monstroid2_post_template_part_slug', $blog_post_template, $blog_layout_type );
}

/**
 * Get single post template part slug.
 *
 * @return string
 */
function monstroid2_get_single_post_template_part_slug() {
	$single_post_type = get_theme_mod( 'single_post_type', monstroid2_theme()->customizer->get_default( 'single_post_type' ) );

	$single_post_template = 'template-parts/post/single/content-single';

	if ( 'modern' === $single_post_type && is_singular( 'post' ) ) {
		$single_post_template = 'template-parts/post/single/content-single-modern';
	}

	return apply_filters( 'monstroid2_single_post_template_part_slug', $single_post_template, $single_post_type );
}

/**
 * Add custom css style.
 */
function monstroid2_inline_css() {
	$page_404_bg_url = get_theme_mod( 'page_404_bg_image', monstroid2_theme()->customizer->get_default( 'page_404_bg_image' ) );
	$page_404_bg_url = esc_url( monstroid2_render_theme_url( $page_404_bg_url ) );

	$css = 'body.error404 .site-content{ background-image: url( ' . $page_404_bg_url . ' ); }';

	return $css;
}

/**
 * Get skin css file url.
 */
function monstroid2_skin_css_url() {
	$skins_settings = monstroid2_get_skins_style_settings();
	$skin_style     = get_theme_mod( 'skin_style', monstroid2_theme()->customizer->get_default( 'skin_style' ) );
	$url            = $skins_settings[ $skin_style ]['url'];

	if( ! $url ) {
		return false;
	}

	return esc_url( $url );
}
