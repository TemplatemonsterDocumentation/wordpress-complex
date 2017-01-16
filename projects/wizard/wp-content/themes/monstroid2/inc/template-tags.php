<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Monstroid2
 */

/**
 * Show top panel message.
 *
 * @since  1.0.0
 * @param  string $format Output formatting.
 * @return void
 */
function monstroid2_top_message( $format = '%s' ) {
	$message = get_theme_mod( 'top_panel_text', monstroid2_theme()->customizer->get_default( 'top_panel_text' ) );

	if ( ! $message ) {
		return;
	}

	printf( $format, wp_kses( wp_unslash( $message ), wp_kses_allowed_html( 'post' ) ) );
}

/**
 * Show top panel search.
 *
 * @since  1.0.0
 * @param  string $format Output formatting.
 * @return void
 */
function monstroid2_header_search( $format = '%s' ) {
	$is_enabled = get_theme_mod( 'header_search', monstroid2_theme()->customizer->get_default( 'header_search' ) );

	if ( ! $is_enabled ) {
		return;
	}

	printf( $format, get_search_form( false ) );
}

/**
 * Header custom button.
 */
function monstroid2_header_btn() {
	$btn_visibility = get_theme_mod( 'header_btn_visibility', monstroid2_theme()->customizer->get_default( 'header_btn_visibility' ) );
	$btn_text       = get_theme_mod( 'header_btn_text', monstroid2_theme()->customizer->get_default( 'header_btn_text' ) );
	$btn_url        = get_theme_mod( 'header_btn_url', monstroid2_theme()->customizer->get_default( 'header_btn_url' ) );

	if ( ! $btn_visibility ) {
		return;
	}

	if ( ! $btn_text || ! $btn_url) {
		return;
	}

	$format = apply_filters( 'monstroid2_header_btn_html_format', '<a class="header-btn btn btn-default" href="%2$s">%1$s</a>' );

	printf( $format, wp_kses( wp_unslash( $btn_text ), wp_kses_allowed_html( 'post' ) ), esc_url( monstroid2_render_macros( $btn_url ) ) );
}

/**
 * Show footer logo, uploaded from customizer.
 *
 * @since  1.0.0
 * @return void
 */
function monstroid2_footer_logo() {
	if ( ! get_theme_mod( 'footer_logo_visibility', monstroid2_theme()->customizer->get_default( 'footer_logo_visibility' ) ) ) {
		return;
	}

	$logo_url = get_theme_mod( 'footer_logo_url' );

	if ( ! $logo_url ) {
		return;
	}

	$url      = esc_url( home_url( '/' ) );
	$alt      = esc_attr( get_bloginfo( 'name' ) );
	$logo_url = esc_url( monstroid2_render_theme_url( $logo_url ) );
	$logo_id  = monstroid2_get_image_id_by_url( monstroid2_render_theme_url( $logo_url ) );
	$logo_src = wp_get_attachment_image_src( $logo_id, 'full' );

	if ( $logo_id && $logo_src ) {
		$atts = ' width="' . esc_attr( $logo_src[1] ) . '" height="' . esc_attr( $logo_src[2] ) . '"';
	} else {
		$atts = '';
	}

	$logo_format = apply_filters(
		'monstroid2_footer_logo_format',
		'<div class="footer-logo"><a href="%2$s" class="footer-logo_link"><img src="%1$s" alt="%3$s" class="footer-logo_img" %4$s></a></div>'
	);

	printf( $logo_format, $logo_url, $url, $alt, $atts );
}

/**
 * Show footer copyright text.
 *
 * @since  1.0.0
 * @return void
 */
function monstroid2_footer_copyright() {
	$copyright = get_theme_mod( 'footer_copyright', monstroid2_theme()->customizer->get_default( 'footer_copyright' ) );
	$format    = '<div class="footer-copyright">%s</div>';

	if ( empty( $copyright ) ) {
		return;
	}

	printf( $format, wp_kses( monstroid2_render_macros( wp_unslash( $copyright ) ), wp_kses_allowed_html( 'post' ) ) );
}

/**
 * Show contact block.
 *
 * @since  1.0.0
 * @param string $target Current block position: header, footer.
 */
function monstroid2_contact_block( $target = 'header' ) {
	$contact_block_visibility = get_theme_mod( $target . '_contact_block_visibility', monstroid2_theme()->customizer->get_default( $target . '_contact_block_visibility' ) );

	if ( ! $contact_block_visibility ) {
		return;
	}

	$contact_item_count = apply_filters( 'monstroid2_contact_item_count', array(
		'header' => 3,
		'footer' => 3,
	) );

	$contact_info = array();

	for ( $i = 1; $i <= $contact_item_count[ $target ]; $i ++ ) {
		$icon  = get_theme_mod( $target . '_contact_icon_' . $i, monstroid2_theme()->customizer->get_default( $target . '_contact_icon_' . $i ) );
		$label = get_theme_mod( $target . '_contact_label_' . $i, monstroid2_theme()->customizer->get_default( $target . '_contact_label_' . $i ) );
		$value = get_theme_mod( $target . '_contact_text_' . $i, monstroid2_theme()->customizer->get_default( $target . '_contact_text_' . $i ) );
		if ( ! $icon && ! $value && ! $label ) {
			continue;
		}
		$contact_info [ 'item_' . $i ] = array(
			'icon'  => $icon,
			'label' => $label,
			'value' => $value,
		);
	}

	if ( ! $contact_info ) {
		return;
	}

	$icon_format = apply_filters( 'monstroid2_contact_block_icon_format', '<i class="contact-block__icon linearicon %1$s"></i>' );

	$html = '<div class="contact-block contact-block--' . $target . '"><div class="contact-block__inner">';

	foreach ( $contact_info as $key => $value ) {
		$icon           = ( $value['icon'] ) ? sprintf( $icon_format, $value['icon'] ) : '';
		$label          = ( $value['label'] ) ? sprintf( '<span class="contact-block__label">%1$s</span>', wp_unslash( $value['label'] ) ) : '';
		$text           = ( $value['value'] ) ? sprintf( '<span class="contact-block__text">%1$s</span>', wp_kses( wp_unslash( $value['value'] ), wp_kses_allowed_html( 'post' ) ) ) : '';
		$item_mod_class = ( $value['icon'] ) ? 'contact-block__item--icon' : '';

		$html .= sprintf( '<div class="contact-block__item %1$s">%2$s<div class="contact-block__value-wrap">%3$s%4$s</div></div>', $item_mod_class, $icon, $label, $text );
	}

	$html .= '</div></div>';

	echo $html;
}

/**
 * Show Social list.
 *
 * @since  1.0.0
 * @since  1.0.1 Added new param - $type.
 * @return void
 */
function monstroid2_social_list( $context = '', $type = 'icon' ) {
	$visibility_in_header = get_theme_mod( 'header_social_links', monstroid2_theme()->customizer->get_default( 'header_social_links' ) );
	$visibility_in_footer = get_theme_mod( 'footer_social_links', monstroid2_theme()->customizer->get_default( 'footer_social_links' ) );

	if ( ! $visibility_in_header && ( 'header' === $context ) ) {
		return;
	}

	if ( ! $visibility_in_footer && ( 'footer' === $context ) ) {
		return;
	}

	echo monstroid2_get_social_list( $context, $type );
}

/**
 * Show sticky menu label grabbed from options.
 *
 * @since  1.0.0
 * @return void
 */
function monstroid2_sticky_label() {

	if ( ! is_sticky() || ! is_home() || is_paged() ) {
		return;
	}

	$sticky_type = get_theme_mod(
		'blog_sticky_type',
		monstroid2_theme()->customizer->get_default( 'blog_sticky_type' )
	);

	$content     = '';
	$icon_format = apply_filters( 'monstroid2_sticky_icon_format', '<i class="linearicon %1$s"></i>' );

	switch ( $sticky_type ) {

		case 'icon':
			$icon = get_theme_mod(
				'blog_sticky_icon',
				monstroid2_theme()->customizer->get_default( 'blog_sticky_icon' )
			);
			$content = sprintf( $icon_format, $icon );
			break;

		case 'label':
			$label = get_theme_mod(
				'blog_sticky_label',
				monstroid2_theme()->customizer->get_default( 'blog_sticky_label' )
			);
			$content = monstroid2_render_icons( $label );
			break;

		case 'both':
			$icon = get_theme_mod(
				'blog_sticky_icon',
				monstroid2_theme()->customizer->get_default( 'blog_sticky_icon' )
			);
			$label = get_theme_mod(
				'blog_sticky_label',
				monstroid2_theme()->customizer->get_default( 'blog_sticky_label' )
			);
			$content = sprintf( $icon_format, $icon ) . monstroid2_render_icons( $label );
			break;
	}

	if ( empty( $content ) ) {
		return;
	}

	printf( '<span class="sticky__label type-%2$s">%1$s</span>', $content, $sticky_type );
}

/**
 * Display the header logo.
 *
 * @since  1.0.0
 * @return void
 */
function monstroid2_header_logo() {
	$logo = monstroid2_get_site_title_by_type( get_theme_mod( 'header_logo_type', monstroid2_theme()->customizer->get_default( 'header_logo_type' ) ) );

	if ( is_front_page() && is_home() ) {
		$tag = 'h1';
	} else {
		$tag = 'div';
	}

	$format = apply_filters(
		'monstroid2_header_logo_format',
		'<%1$s class="site-logo"><a class="site-logo__link" href="%2$s" rel="home">%3$s</a></%1$s>'
	);

	printf( $format, $tag, esc_url( home_url( '/' ) ), $logo );
}

/**
 * Retrieve the site title (image or text).
 *
 * @since  1.0.0
 * @return string
 */
function monstroid2_get_site_title_by_type( $type ) {

	if ( ! in_array( $type, array( 'text', 'image' ) ) ) {
		$type = 'text';
	}

	$logo = get_bloginfo( 'name' );

	if ( 'text' === $type ) {
		return $logo;
	}

	$logo_url        = get_theme_mod( 'header_logo_url', monstroid2_theme()->customizer->get_default( 'header_logo_url' ) );
	$invert_logo_url = get_theme_mod( 'invert_header_logo_url', monstroid2_theme()->customizer->get_default( 'invert_header_logo_url' ) );
	$header_invert   = get_theme_mod( 'header_invert_color_scheme', monstroid2_theme()->customizer->get_default( 'header_invert_color_scheme' ) );

	if ( $header_invert && $invert_logo_url ) {
		$logo_url = $invert_logo_url;
	}

	if ( ! $logo_url ) {
		return $logo;
	}

	$logo_url               = monstroid2_render_theme_url( $logo_url );
	$retina_logo            = '';
	$retina_logo_url        = get_theme_mod( 'retina_header_logo_url', monstroid2_theme()->customizer->get_default( 'retina_header_logo_url' ) );
	$invert_retina_logo_url = get_theme_mod( 'invert_retina_header_logo_url', monstroid2_theme()->customizer->get_default( 'invert_retina_header_logo_url' ) );

	if ( $header_invert && $invert_retina_logo_url ) {
		$retina_logo_url = $invert_retina_logo_url;
	}

	$retina_logo_url = monstroid2_render_theme_url( $retina_logo_url );
	$logo_id         = monstroid2_get_image_id_by_url( $logo_url );

	if ( $retina_logo_url ) {
		$retina_logo = sprintf( 'srcset="%s 2x"', esc_url( $retina_logo_url ) );
	}

	$logo_src = wp_get_attachment_image_src( $logo_id, 'full' );

	if ( $logo_id && $logo_src ) {
		$atts = ' width="' . $logo_src[1] . '" height="' . $logo_src[2] . '"';
	} else {
		$atts = '';
	}

	$format_image = apply_filters( 'monstroid2_header_logo_image_format',
		'<img src="%1$s" alt="%2$s" class="site-link__img" %3$s%4$s>'
	);

	return sprintf( $format_image, esc_url( $logo_url ), esc_attr( $logo ), $retina_logo, $atts );
}

/**
 * Display the site description.
 *
 * @since  1.0.0
 * @return void
 */
function monstroid2_site_description() {
	$show_desc = get_theme_mod( 'show_tagline', monstroid2_theme()->customizer->get_default( 'show_tagline' ) );

	if ( ! $show_desc ) {
		return;
	}

	$description = get_bloginfo( 'description', 'display' );

	if ( ! ( $description || is_customize_preview() ) ) {
		return;
	}

	$format = apply_filters( 'monstroid2_site_description_format', '<div class="site-description">%s</div>' );

	printf( $format, $description );
}

/**
 * Display box with information about author.
 *
 * @since  1.0.0
 * @return void
 */
function monstroid2_post_author_bio() {
	$is_enabled = get_theme_mod( 'single_author_block', monstroid2_theme()->customizer->get_default( 'single_author_block' ) );

	if ( ! $is_enabled ) {
		return;
	}

	get_template_part( apply_filters( 'monstroid2_post_author_bio_template_part_slug', 'template-parts/content' ), 'author-bio' );
}

/**
 * Display header-box for modern single post.
 */
function monstroid2_single_modern_header() {
	$single_post_type = get_theme_mod( 'single_post_type', monstroid2_theme()->customizer->get_default( 'single_post_type' ) );

	if ( ! apply_filters( 'monstroid2_single_modern_header_posts', is_singular( 'post' ) ) ) {
		return;
	}

	if ( 'modern' !== $single_post_type ) {
		return;
	}
	while ( have_posts() ) : the_post();
		get_template_part( apply_filters( 'monstroid2_single_modern_header_template_part_slug', 'template-parts/post/single/content-single-modern-header' ) );
	endwhile;
}

/**
 * Display a link to all posts by an author.
 *
 * @since  1.0.0
 * @return string An HTML link to the author page.
 */
function monstroid2_get_the_author_posts_link() {
	ob_start();
	the_author_posts_link();
	$author = ob_get_clean();

	return $author;
}

/**
 * Display the breadcrumbs.
 *
 * @since  1.0.0
 * @return void
 */
function monstroid2_site_breadcrumbs() {
	$breadcrumbs_visibillity       = get_theme_mod( 'breadcrumbs_visibillity', monstroid2_theme()->customizer->get_default( 'breadcrumbs_visibillity' ) );
	$breadcrumbs_page_title        = get_theme_mod( 'breadcrumbs_page_title', monstroid2_theme()->customizer->get_default( 'breadcrumbs_page_title' ) );
	$breadcrumbs_path_type         = get_theme_mod( 'breadcrumbs_path_type', monstroid2_theme()->customizer->get_default( 'breadcrumbs_path_type' ) );
	$breadcrumbs_front_visibillity = get_theme_mod( 'breadcrumbs_front_visibillity', monstroid2_theme()->customizer->get_default( 'breadcrumbs_front_visibillity' ) );

	$breadcrumbs_settings = apply_filters( 'monstroid2_breadcrumbs_settings', array(
		'wrapper_format'    => '<div class="container"><div class="row">%1$s<div class="breadcrumbs__items">%2$s</div></div></div>',
		'page_title_format' => '<div class="breadcrumbs__title"><h5 class="page-title">%s</h5></div>',
		'show_title'        => $breadcrumbs_page_title,
		'path_type'         => $breadcrumbs_path_type,
		'show_on_front'     => $breadcrumbs_front_visibillity,
		'labels'            => array(
			'browse'         => '',
			'error_404'      => esc_html__( '404 Not Found', 'monstroid2' ),
			'archives'       => esc_html__( 'Archives', 'monstroid2' ),
			/* Translators: %s is the search query. The HTML entities are opening and closing curly quotes. */
			'search'         => esc_html__( 'Search results for &#8220;%s&#8221;', 'monstroid2' ),
			/* Translators: %s is the page number. */
			'paged'          => esc_html__( 'Page %s', 'monstroid2' ),
			/* Translators: Minute archive title. %s is the minute time format. */
			'archive_minute' => esc_html__( 'Minute %s', 'monstroid2' ),
			/* Translators: Weekly archive title. %s is the week date format. */
			'archive_week'   => esc_html__( 'Week %s', 'monstroid2' ),
		),
		'date_labels' => array(
			'archive_minute_hour' => esc_html_x( 'g:i a', 'minute and hour archives time format', 'monstroid2' ),
			'archive_minute'      => esc_html_x( 'i', 'minute archives time format', 'monstroid2' ),
			'archive_hour'        => esc_html_x( 'g a', 'hour archives time format', 'monstroid2' ),
			'archive_year'        => esc_html_x( 'Y', 'yearly archives date format', 'monstroid2' ),
			'archive_month'       => esc_html_x( 'F', 'monthly archives date format', 'monstroid2' ),
			'archive_day'         => esc_html_x( 'j', 'daily archives date format', 'monstroid2' ),
			'archive_week'        => esc_html_x( 'W', 'weekly archives date format', 'monstroid2' ),
		),
		'css_namespace' => array(
			'module'    => 'breadcrumbs',
			'content'   => 'breadcrumbs__content',
			'wrap'      => 'breadcrumbs__wrap',
			'browse'    => 'breadcrumbs__browse',
			'item'      => 'breadcrumbs__item',
			'separator' => 'breadcrumbs__item-sep',
			'link'      => 'breadcrumbs__item-link',
			'target'    => 'breadcrumbs__item-target',
		),
	) );

	$GLOBALS['monstroid2_breadcrumbs_settings'] = $breadcrumbs_settings;

	if ( $breadcrumbs_visibillity ) {
		monstroid2_theme()->get_core()->init_module( 'cherry-breadcrumbs', $breadcrumbs_settings );

		if ( monstroid2_is_woocommerce_activated() && is_woocommerce() ) {

			add_filter( 'woocommerce_breadcrumb_defaults', 'monstroid2_woo_breadcrumbs_params' );

			add_filter( 'woocommerce_get_breadcrumb', 'monstroid2_woo_breadcrumbs', 10, 2 );

			$title = '';

			if ( $breadcrumbs_page_title ) {

				ob_start();

				woocommerce_page_title();

				$title = ob_get_clean();
				$title = sprintf( $breadcrumbs_settings['page_title_format'], $title );
			}
			ob_start();

			woocommerce_breadcrumb();

			$content = ob_get_clean();

			$wrapper_classes = array(
				$breadcrumbs_settings['css_namespace']['module']
			);

			if ( isset( $breadcrumbs_settings['show_mobile'] ) && false === $breadcrumbs_settings['show_mobile'] ) {
				$wrapper_classes[] = 'hidden-xs';
			}

			if ( isset( $breadcrumbs_settings['show_tablet'] ) && false === $breadcrumbs_settings['show_tablet'] ) {
				$wrapper_classes[] = 'hidden-sm';
			}

			$wrapper_classes = apply_filters( 'cherry_breadcrumbs_wrapper_classes', $wrapper_classes );
			$wrapper_classes = array_unique( $wrapper_classes );
			$wrapper_classes = array_map( 'sanitize_html_class', $wrapper_classes );
			$wrapper_css     = implode( ' ', $wrapper_classes );

			echo '<div class="' . $wrapper_css . '">' . sprintf( $breadcrumbs_settings['wrapper_format'], $title, $content ) . '</div>';

		} else {
			do_action( 'cherry_breadcrumbs_render' );
		}
	}
}

/**
 * Woo breadcrumbs.
 *
 * @return mixed
 */
function monstroid2_woo_breadcrumbs( $crumbs, $object ) {

	if ( get_query_var( 'paged' ) ) {

		array_pop ( $crumbs );
	}
	return $crumbs;
}

/**
 * Change default breadcrumbs.
 *
 * @param array $defaults Default breadcrumbs.
 *
 * @return array
 */
function monstroid2_woo_breadcrumbs_params( $defaults ) {

	global $monstroid2_breadcrumbs_settings;

	$args = array(
		'delimiter'   => '<div class="' . esc_attr( $monstroid2_breadcrumbs_settings['css_namespace']['item'] ) . '"><div class="' . esc_attr( $monstroid2_breadcrumbs_settings['css_namespace']['separator'] ) . '">&#47;</div></div>',
		'wrap_before' => '<div class="' . esc_attr( $monstroid2_breadcrumbs_settings['css_namespace']['content'] ) . '"><div class="' . esc_attr( $monstroid2_breadcrumbs_settings['css_namespace']['wrap'] ) . '">',
		'wrap_after'  => '</div></div>',
		'before'      => '<div class="' . esc_attr( $monstroid2_breadcrumbs_settings['css_namespace']['item'] ) . '">',
		'after'       => '</div>',
		'link_class'  => $monstroid2_breadcrumbs_settings['css_namespace']['link'],
	);

	return wp_parse_args( $args, $defaults );
}

/**
 * Display the page preloader.
 *
 * @since  1.0.0
 * @return void
 */
function monstroid2_get_page_preloader() {
	$page_preloader = get_theme_mod( 'page_preloader', monstroid2_theme()->customizer->get_default( 'page_preloader' ) );

	if ( $page_preloader ) {
		echo '<div class="page-preloader-cover">
			<div class="page-preloader"></div>
		</div>';
	}
}

/**
 * Check if top panel visible or not
 *
 * @return bool
 */
function monstroid2_is_top_panel_visible() {
	$header_layout_type       = get_theme_mod( 'header_layout_type', monstroid2_theme()->customizer->get_default( 'header_layout_type' ) );
	$message                  = get_theme_mod( 'top_panel_text', monstroid2_theme()->customizer->get_default( 'top_panel_text' ) );
	$search                   = get_theme_mod( 'header_search', monstroid2_theme()->customizer->get_default( 'header_search' ) );
	$menu                     = has_nav_menu( 'top' ) && get_theme_mod( 'top_menu_visibility', monstroid2_theme()->customizer->get_default( 'top_menu_visibility' ) );
	$woo_elements             = get_theme_mod( 'header_woo_elements', monstroid2_theme()->customizer->get_default( 'header_woo_elements' ) );
	$contact_block_visibility = get_theme_mod( 'header_contact_block_visibility', monstroid2_theme()->customizer->get_default( 'header_contact_block_visibility' ) );
	$social_menu_visibility   = get_theme_mod( 'header_social_links', monstroid2_theme()->customizer->get_default( 'header_social_links' ) );
	$top_panel_visibility     = get_theme_mod( 'top_panel_visibility', monstroid2_theme()->customizer->get_default( 'top_panel_visibility' ) );

	$conditions = apply_filters( 'monstroid2_top_panel_visibility_conditions', array(
		'default' => array( $message, $search, $menu, $social_menu_visibility, $contact_block_visibility, $woo_elements ),
		'style-2' => array( $message, $menu, $social_menu_visibility ),
		'style-3' => array( $message, $menu, $social_menu_visibility, $contact_block_visibility ),
		'style-4' => array( $message, $menu, $social_menu_visibility, $contact_block_visibility ),
		'style-5' => array( $message, $search, $menu, $social_menu_visibility, $contact_block_visibility, $woo_elements ),
		'style-6' => array( $message, $search, $menu, $social_menu_visibility, $contact_block_visibility, $woo_elements ),
		'style-7' => array( $message, $search, $menu, $social_menu_visibility, $contact_block_visibility, $woo_elements ),
	) );

	$is_visible = false;

	if ( ! $top_panel_visibility ) {
		return $is_visible;
	}

	foreach ( $conditions[ $header_layout_type ] as $condition ) {

		if ( ! empty( $condition ) ) {
			$is_visible = true;
		}
	}

	return $is_visible;
}

/**
 * Display woo elements to header.
 */
function monstroid2_header_woo_elements() {
	$is_visibility = get_theme_mod( 'header_woo_elements', monstroid2_theme()->customizer->get_default( 'header_woo_elements' ) );

	if ( ! $is_visibility || ! monstroid2_is_woocommerce_activated() ) {
		return;
	}

	if ( is_woocommerce() ) {
		monstroid2_currency_switcher();
	}
	monstroid2_header_cart();
}

/**
 * Display the ads.
 *
 * @since  1.0.0
 * @param  string $location location of ads in theme.
 * @return void
 */
function monstroid2_ads( $location ) {
	$ads    = trim( get_theme_mod( 'ads_' . $location, monstroid2_theme()->customizer->get_default( 'ads_' . $location ) ) );
	$format = '<div class="' . $location . '-ads">%s</div>';

	if ( empty( $ads ) ) {
		return;
	}

	printf( $format, wp_specialchars_decode( $ads, ENT_QUOTES ) );
}

/**
 * Display the header ads.
 */
function monstroid2_ads_header() {
	monstroid2_ads( 'header' );
}

/**
 * Display ads for before loop location.
 */
function monstroid2_ads_home_before_loop() {
	monstroid2_ads( 'home_before_loop' );
}

/**
 * Display ads for before loop content.
 */
function monstroid2_ads_post_before_content() {
	monstroid2_ads( 'post_before_content' );
}

/**
 * Display ads for before comments.
 */
function monstroid2_ads_post_before_comments() {
	monstroid2_ads( 'post_before_comments' );
}

/**
 * Get builder module template.
 */
function monstroid2_get_builder_module_template( $name = null, $module = null, $default = null ) {
	$builder_templates = apply_filters( 'monstroid2_builder_templates', 'template-parts/builder-templates/' );
	$template = locate_template( $builder_templates . $name );

	if ( $template ) {
		include $template;
		return;
	}

	$template = locate_template( $builder_templates . $default );

	if ( $template ) {
		include $template;
		return;
	}
}
