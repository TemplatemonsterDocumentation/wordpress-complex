<?php
/**
 * Theme hooks.
 *
 * @package Monstroid2
 */

// Menu description.
add_filter( 'walker_nav_menu_start_el', 'monstroid2_nav_menu_description', 10, 4 );

// Sidebars classes.
add_filter( 'monstroid2_widget_area_classes', 'monstroid2_set_sidebar_classes', 10, 2 );

// Set footer columns.
add_filter( 'dynamic_sidebar_params', 'monstroid2_get_footer_widget_layout' );

// Adapt default image post format classes to current theme.
add_filter( 'cherry_post_formats_image_css_model', 'monstroid2_add_image_format_classes', 10, 2 );

// Enqueue sticky menu if required.
add_filter( 'monstroid2_theme_script_depends', 'monstroid2_enqueue_misc' );

// Add has/no thumbnail classes for posts.
add_filter( 'post_class', 'monstroid2_post_thumb_classes' );

// Modify a comment form.
add_filter( 'comment_form_defaults', 'monstroid2_modify_comment_form' );

// Reorder comment fields
add_filter( 'comment_form_fields', 'monstroid2_reorder_comment_fields' );

// Additional body classes.
add_filter( 'body_class', 'monstroid2_extra_body_classes' );

// Render macros in text widgets.
add_filter( 'widget_text', 'monstroid2_render_widget_macros' );

// Adds the meta viewport to the header.
add_action( 'wp_head', 'monstroid2_meta_viewport', 0 );

// Customization for `Tag Cloud` widget.
add_filter( 'widget_tag_cloud_args', 'monstroid2_customize_tag_cloud' );

// Changed excerpt more string.
add_filter( 'excerpt_more', 'monstroid2_excerpt_more' );

// Creating wrappers for audio shortcode.
add_filter( 'wp_audio_shortcode', 'monstroid2_audio_shortcode', 10, 5 );

// Set specific content classes.
add_filter( 'monstroid2_content_classes', 'monstroid2_set_specific_content_classes' );

// Change text for buddypress activity read more
add_filter( 'bp_activity_excerpt_append_text', 'monstroid2_bp_activity_read_more_text' );

// Add template to cherry-team-members templates list.
add_filter( 'cherry_team_templates_list', 'monstroid2_add_template_to_cherry_team_templates_list' );

// Include current skin dynamic css file.
add_action( 'cherry_dynamic_css_include_custom_files', 'monstroid2_add_skins_dynamic_css', 20, 2 );

// Set specific customizer settings.
add_filter( 'theme_mod_sidebar_width', 'monstroid2_woo_sidebar_width' );
add_filter( 'theme_mod_sidebar_position', 'monstroid2_specific_sidebar_position' );
add_filter( 'theme_mod_top_panel_visibility', 'monstroid2_woo_top_panel_visibility' );

// Landing main menu location.
add_filter( 'monstroid2_main_menu_args', 'monstroid2_landing_main_menu_location' );

/**
 * Append description into nav items
 *
 * @param  string $item_output The menu item output.
 * @param  WP_Post $item Menu item object.
 * @param  int $depth Depth of the menu.
 * @param  array $args wp_nav_menu() arguments.
 *
 * @return string
 */
function monstroid2_nav_menu_description( $item_output, $item, $depth, $args ) {

	if ( 'main' !== $args->theme_location || ! $item->description ) {
		return $item_output;
	}

	$descr_enabled = get_theme_mod(
		'header_menu_attributes',
		monstroid2_theme()->customizer->get_default( 'header_menu_attributes' )
	);

	if ( ! $descr_enabled ) {
		return $item_output;
	}

	$current     = $args->link_after . '</a>';
	$description = '<div class="menu-item__desc">' . $item->description . '</div>';
	$item_output = str_replace( $current, $description . $current, $item_output );

	return $item_output;
}

/**
 * Set layout classes for sidebars.
 *
 * @since  1.0.0
 * @uses   monstroid2_get_layout_classes.
 *
 * @param  array $classes Additional classes.
 * @param  string $area_id Sidebar ID.
 *
 * @return array
 */
function monstroid2_set_sidebar_classes( $classes, $area_id ) {

	if ( 'sidebar' == $area_id ) {
		return monstroid2_get_layout_classes( 'sidebar', $classes );
	}

	if ( 'footer-area' == $area_id ) {
		$columns = get_theme_mod( 'footer_widget_columns', monstroid2_theme()->customizer->get_default( 'footer_widget_columns' ) );

		if ( '1' !== $columns ) {
			$classes[] = sprintf( 'footer-area--%s-cols', $columns );
		} else {
			$classes[] = 'footer-area--fullwidth';
		}

		$classes[] = 'row';
	}

	return $classes;
}

/**
 * Get footer widgets layout class
 *
 * @since  1.0.0
 *
 * @param  string $params Existing widget classes.
 *
 * @return string
 */
function monstroid2_get_footer_widget_layout( $params ) {

	if ( is_admin() ) {
		return $params;
	}

	if ( empty( $params[0]['id'] ) || 'footer-area' !== $params[0]['id'] ) {
		return $params;
	}

	if ( empty( $params[0]['before_widget'] ) ) {
		return $params;
	}

	$columns = get_theme_mod(
		'footer_widget_columns',
		monstroid2_theme()->customizer->get_default( 'footer_widget_columns' )
	);

	$columns = intval( $columns );
	$classes = 'class="col-xs-12 col-sm-%3$s col-md-%2$s col-lg-%1$s %4$s ';

	switch ( $columns ) {
		case 4:
			$lg_col = 3;
			$md_col = 6;
			$sm_col = 12;
			$extra  = '';
			break;

		case 3:
			$lg_col = 4;
			$md_col = 4;
			$sm_col = 12;
			$extra  = '';
			break;

		case 2:
			$lg_col = 6;
			$md_col = 6;
			$sm_col = 12;
			$extra  = '';
			break;

		default:
			$lg_col = 12;
			$md_col = 12;
			$sm_col = 12;
			$extra  = '';
			break;
	}

	$params[0]['before_widget'] = str_replace(
		'class="',
		sprintf( $classes, $lg_col, $md_col, $sm_col, $extra ),
		$params[0]['before_widget']
	);

	return $params;
}

/**
 * Filter image CSS model
 *
 * @param  array $css_model Default CSS model.
 * @param  array $args Post formats module arguments.
 *
 * @return array
 */
function monstroid2_add_image_format_classes( $css_model, $args ) {
	$blog_featured_image = get_theme_mod( 'blog_featured_image', monstroid2_theme()->customizer->get_default( 'blog_featured_image' ) );
	$blog_layout         = get_theme_mod( 'blog_layout_type', monstroid2_theme()->customizer->get_default( 'blog_layout_type' ) );
	$suffix              = ( 'default' !== $blog_layout ) ? 'fullwidth' : $blog_featured_image;

	$css_model['link'] .= ' post-thumbnail--' . $suffix;

	return $css_model;
}

/**
 * Add jQuery Stickup to theme script dependencies if required.
 *
 * @param  array $depends Default dependencies.
 *
 * @return array
 */
function monstroid2_enqueue_misc( $depends ) {
	$header_menu_sticky = get_theme_mod( 'header_menu_sticky', monstroid2_theme()->customizer->get_default( 'header_menu_sticky' ) );

	if ( $header_menu_sticky && ! wp_is_mobile() ) {
		$depends[] = 'jquery-stickup';
	}

	$totop_visibility = get_theme_mod( 'totop_visibility', monstroid2_theme()->customizer->get_default( 'totop_visibility' ) );

	if ( $totop_visibility ) {
		$depends[] = 'jquery-totop';
	}

	return $depends;
}

/**
 * Add has/no thumbnail classes for posts
 *
 * @param  array $classes Existing classes.
 *
 * @return array
 */
function monstroid2_post_thumb_classes( $classes ) {
	$thumb = 'no-thumb';

	if ( has_post_thumbnail() ) {
		$thumb = 'has-thumb';
	}

	$classes[] = $thumb;

	return $classes;
}

/**
 * Add placeholder attributes for comment form fields.
 *
 * @param  array $args Arguments for comment form.
 *
 * @return array
 */
function monstroid2_modify_comment_form( $args ) {
	$args = wp_parse_args( $args );

	if ( ! isset( $args['format'] ) ) {
		$args['format'] = current_theme_supports( 'html5', 'comment-form' ) ? 'html5' : 'xhtml';
	}

	$req       = get_option( 'require_name_email' );
	$aria_req  = ( $req ? " aria-required='true'" : '' );
	$html_req  = ( $req ? " required='required'" : '' );
	$html5     = 'html5' === $args['format'];
	$commenter = wp_get_current_commenter();

	$args['label_submit'] = esc_html__( 'Submit Comment', 'monstroid2' );

	$args['fields']['author'] = '<p class="comment-form-author"><i class="linearicon linearicon-man"></i><input id="author" class="comment-form__field" name="author" type="text" placeholder="' . esc_html__( 'Your name', 'monstroid2' ) . ( $req ? ' *' : '' ) . '" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . $html_req . ' /></p>';

	$args['fields']['email'] = '<p class="comment-form-email"><i class="linearicon linearicon-envelope"></i><input id="email" class="comment-form__field" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' placeholder="' . esc_html__( 'Your e-mail', 'monstroid2' ) . ( $req ? ' *' : '' ) . '" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30" aria-describedby="email-notes"' . $aria_req . $html_req . ' /></p>';

	$args['fields']['url'] = '<p class="comment-form-url"><i class="linearicon linearicon-earth"></i><input id="url" class="comment-form__field" name="url" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' placeholder="' . esc_html__( 'Your website', 'monstroid2' ) . '" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>';

	$args['comment_field'] = '<p class="comment-form-comment"><i class="linearicon linearicon-feather"></i><textarea id="comment" class="comment-form__field" name="comment" placeholder="' . esc_html__( 'Your comments *', 'monstroid2' ) . '" cols="45" rows="8" aria-required="true" required="required"></textarea></p>';

	$args['title_reply_before'] = '<h5 id="reply-title" class="comment-reply-title">';

	$args['title_reply_after'] = '</h5>';

	$args['title_reply'] = esc_html__( 'Leave a reply', 'monstroid2' );

	return $args;
}

/**
 * Reorder comment fields
 *
 * @param  array $fields Comment fields.
 *
 * @return array
 */
function monstroid2_reorder_comment_fields( $fields ) {

	if ( is_singular( 'product' ) ) {
		return $fields;
	}

	$new_fields_order = array();
	$new_order        = array( 'author', 'email', 'url', 'comment' );

	foreach ( $new_order as $key ) {
		$new_fields_order[ $key ] = $fields[ $key ];
		unset( $fields[ $key ] );
	}

	return $new_fields_order;
}

/**
 * Add extra body classes
 *
 * @param  array $classes Existing classes.
 *
 * @return array
 */
function monstroid2_extra_body_classes( $classes ) {

	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a options-based classes.
	$header_layout  = get_theme_mod( 'header_container_type', monstroid2_theme()->customizer->get_default( 'header_container_type' ) );
	$content_layout = get_theme_mod( 'content_container_type', monstroid2_theme()->customizer->get_default( 'content_container_type' ) );
	$footer_layout  = get_theme_mod( 'footer_container_type', monstroid2_theme()->customizer->get_default( 'footer_container_type' ) );
	$blog_layout    = get_theme_mod( 'blog_layout_type', monstroid2_theme()->customizer->get_default( 'blog_layout_type' ) );
	$sb_position    = get_theme_mod( 'sidebar_position', monstroid2_theme()->customizer->get_default( 'sidebar_position' ) );
	$sidebar        = get_theme_mod( 'sidebar_width', monstroid2_theme()->customizer->get_default( 'sidebar_width' ) );
	$single_type    = get_theme_mod( 'single_post_type', monstroid2_theme()->customizer->get_default( 'single_post_type' ) );
	$header_type    = get_theme_mod( 'header_layout_type', monstroid2_theme()->customizer->get_default( 'header_layout_type' ) );
	$footer_type    = get_theme_mod( 'footer_layout_type', monstroid2_theme()->customizer->get_default( 'footer_layout_type' ) );

	if ( is_singular( 'post' ) ) {
		$classes[] = 'single-post-' . sanitize_html_class( $single_type );;
	}

	if ( function_exists( 'tm_pb_is_pagebuilder_used' ) ) {
		if ( tm_pb_is_pagebuilder_used( get_the_ID() ) && ! is_search() ) {
			$classes[] = 'use-tm-pb-builder';
		}
	}

	return array_merge( $classes, array(
		'header-layout-' . $header_layout,
		'content-layout-' . $content_layout,
		'footer-layout-' . $footer_layout,
		'blog-' . $blog_layout,
		'position-' . $sb_position,
		'sidebar-' . str_replace( '/', '-', $sidebar ),
		'header-' . $header_type,
		'footer-' . $footer_type,
	) );
}

/**
 * Replace macroses in text widget.
 *
 * @param  string $text Default text.
 *
 * @return string
 */
function monstroid2_render_widget_macros( $text ) {
	$uploads = wp_upload_dir();

	$data = array(
		'/%%uploads_url%%/' => $uploads['baseurl'],
		'/%%home_url%%/'    => esc_url( home_url( '/' ) ),
		'/%%theme_url%%/'   => get_stylesheet_directory_uri(),
	);

	return preg_replace( array_keys( $data ), array_values( $data ), $text );
}

/**
 * Adds the meta viewport to the header.
 *
 * @since  1.0.1
 */
function monstroid2_meta_viewport() {
	echo '<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />' . "\n";
}

/**
 * Customization for `Tag Cloud` widget.
 *
 * @since  1.0.1
 *
 * @param  array $args Widget arguments.
 *
 * @return array
 */
function monstroid2_customize_tag_cloud( $args ) {
	$args['smallest'] = 12;
	$args['largest']  = 12;
	$args['unit']     = 'px';

	return $args;
}

/**
 * Replaces `[...]` (appended to automatically generated excerpts) with `...`.
 *
 * @since  1.0.1
 *
 * @param  string $more The string shown within the more link.
 *
 * @return string
 */
function monstroid2_excerpt_more( $more ) {

	if ( is_admin() ) {
		return $more;
	}

	return ' &hellip;';
}

/**
 * Creating wrappers for audio shortcode.
 */
function monstroid2_audio_shortcode( $html, $atts, $audio, $post_id, $library ) {

	$html = '<div class="mejs-container-wrapper">' . $html . '</div>';

	return $html;
}

/**
 * Set specific content classes for blog listing
 */
function monstroid2_set_specific_content_classes( $layout_classes ) {
	$sidebar_position = get_theme_mod( 'sidebar_position' );

	if ( ( 'fullwidth' === $sidebar_position && is_single() && ! is_singular( array( 'product', 'mp_menu_item' ) ) ) ) {
		$layout_classes = array( 'col-xs-12', 'col-md-12', 'col-xl-8', 'col-xl-push-2' );
	}

	return $layout_classes;
}

/**
 * Change text for buddypress activity read more
 *
 * @return string
 */
function monstroid2_bp_activity_read_more_text( $read_more_text ) {
	return esc_html__( 'Read more', 'monstroid2' );
}

/**
 * Add template to cherry-team-members templates list.
 *
 * @param array $tmpl_list Templates list.
 *
 * @return array
 */
function monstroid2_add_template_to_cherry_team_templates_list( $tmpl_list ) {
	$tmpl_list['grid-boxes-2'] = 'grid-boxes-2.tmpl';

	return $tmpl_list;
}

/**
 * Include current skin dynamic css file.
 */
function monstroid2_add_skins_dynamic_css( $args, $core ) {
	$skins_settings   = monstroid2_get_skins_style_settings();
	$skin_style       = get_theme_mod( 'skin_style', monstroid2_theme()->customizer->get_default( 'skin_style' ) );
	$skin_dynamic_dir = $skins_settings[ $skin_style ]['dynamic_dir'];

	if ( file_exists( $skin_dynamic_dir ) ) {
		include $skin_dynamic_dir;
	}
}

/**
 * Customization sidebar width to woo page.
 */
function monstroid2_woo_sidebar_width( $value ) {

	if ( monstroid2_is_woocommerce_activated() && is_woocommerce() ) {
		return '1/4';
	}

	return $value;
}

/**
 * Disable sidebar to single woo product page and 404 page.
 */
function monstroid2_specific_sidebar_position( $value ) {

	if ( ( monstroid2_is_woocommerce_activated() && is_product() ) || is_404() ) {
		return 'fullwidth';
	}

	return $value;
}

/**
 * Enable top panel to woo page.
 */
function monstroid2_woo_top_panel_visibility( $value ) {

	if ( monstroid2_is_woocommerce_activated() && is_woocommerce() ) {
		return true;
	}

	return $value;
}

/**
 * Landing main menu location.
 */
function monstroid2_landing_main_menu_location( $args ) {

	if ( 'page-templates/landing.php' === get_page_template_slug() ) {
		$args['theme_location'] = 'main_landing';
	}
	return $args;
}
