<?php
/**
 * Skin6 functions, hooks and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Monstroid2
 */

// Change post template part slug.
add_filter( 'monstroid2_post_template_part_slug', 'monstroid2_skin6_post_template_part_slug', 10, 2 );

// Change posts pagination args.
add_filter( 'monstroid2_content_posts_pagination', 'monstroid2_skin6_content_posts_pagination' );

// Change single post template part slug.
add_filter( 'monstroid2_single_post_template_part_slug', 'monstroid2_skin6_single_post_template_part_slug', 10, 2 );

// Change related posts template slug.
add_filter( 'monstroid2_related_posts_template_part_slug', 'monstroid2_skin6_related_posts_template_part_slug' );

// Customization related posts category settings.
add_filter( 'monstroid2_rp_category_settings', 'monstroid2_skin6_rp_category_settings' );

// Change avatar size to author-bio template.
add_filter( 'monstroid2_author_bio_avatar_size', 'monstroid2_skin6_author_bio_avatar_size' );

// Modify a comment form.
add_filter( 'comment_form_defaults', 'monstroid2_skin6_modify_comment_form' );

// Remove icon in search form.
add_filter( 'monstroid2_search_form_input_icon', '__return_empty_string' );

// Remove icon in subscribe form.
add_filter( 'monstroid2_subscribe_view_icon', '__return_empty_string' );

// Customization for `Tag Cloud` widget.
add_filter( 'widget_tag_cloud_args', 'monstroid2_skin6_customize_tag_cloud' );

// Add skin cherry-team single template.
add_filter( 'cherry_team_templates_list', 'monstroid2_skin6_cherry_team_templates_list' );

// Add skin services listing template.
add_filter( 'cherry_services_listing_templates_list', 'monstroid2_skin6_cherry_services_listing_templates_list' );

// Add skin services single template.
add_filter( 'cherry_services_single_templates_list', 'monstroid2_skin6_cherry_services_single_templates_list' );

// Change cherry-services cta html format.
add_filter( 'cherry_services_cta_format', 'monstroid2_skin6_cherry_services_cta_format' );

// Change cherry-services features title html format.
add_filter( 'cherry_services_features_title_format', 'monstroid2_skin6_cherry_services_features_title_format' );

// Enable mprm category shortcode button.
add_filter( 'monstroid2_mprm_category_btn_visibility', '__return_true' );

// Customization cherry-project plugin.
add_filter( 'cherry-projects-title-settings', 'monstroid2_skin6_cherry_projects_title_settings' );
add_action( 'cherry_projects_before_main_content', 'monstroid2_skin6_cherry_projects_before_main_content' );
add_filter( 'cherry-projects-prev-button-text', 'monstroid2_skin6_cherry_projects_prev_button_text' );
add_filter( 'cherry-projects-next-button-text', 'monstroid2_skin6_cherry_projects_next_button_text' );

// Change breadcrumbs separator.
add_filter( 'monstroid2_breadcrumbs_settings', 'monstroid2_skin6_breadcrumbs_separator' );

// Change html title into single mprm menu item.
remove_action( 'mprm_menu_item_content_before', 'monstroid2_mprm_menu_item_single_title', 10 );
add_action( 'mprm_menu_item_content_before', 'monstroid2_skin6_mprm_menu_item_single_title', 10 );

/**
 * Change post template part slug.
 *
 * @return string
 */
function monstroid2_skin6_post_template_part_slug( $blog_post_template, $blog_layout_type ) {

	$blog_post_template = 'skins/skin6/template-parts/post/default/content';

	if ( 'default' !== $blog_layout_type ) {
		$blog_post_template = 'skins/skin6/template-parts/post/grid/content';
	}

	return $blog_post_template;
}

/**
 * Change posts pagination args.
 */
function monstroid2_skin6_content_posts_pagination( $args ) {

	$args = array(
		'prev_text' => esc_html__( 'Prev', 'monstroid2' ),
		'next_text' => esc_html__( 'Next', 'monstroid2' ),
	);

	return $args;
}

/**
 * Change single template part slug.
 *
 * @return string
 */
function monstroid2_skin6_single_post_template_part_slug( $single_post_template, $single_post_type ) {

	$single_post_template = 'skins/skin6/template-parts/post/single/content-single';

	if ( 'modern' === $single_post_type && is_singular( 'post' ) ) {
		$single_post_template = 'template-parts/post/single/content-single-modern';
	}

	return $single_post_template;
}

/**
 * Change related posts template slug.
 *
 * @return string
 */
function monstroid2_skin6_related_posts_template_part_slug( $slug ) {
	return 'skins/skin6/template-parts/content-related-posts.php';
}

/**
 * Customization related posts category settings.
 *
 * @param array $args Related post category settings.
 *
 * @return array
 */
function monstroid2_skin6_rp_category_settings( $args ) {

	$args['before'] = '<div class="post__category">';
	$args['after']  = '</div>';

	return $args;
}

/**
 * Change avatar size to author-bio template.
 *
 * @return int
 */
function monstroid2_skin6_author_bio_avatar_size( $size ) {
	return 210;
}

/**
 * Add placeholder attributes for comment form fields.
 *
 * @param  array $args Arguments for comment form.
 *
 * @return array
 */
function monstroid2_skin6_modify_comment_form( $args ) {
	$args = wp_parse_args( $args );

	if ( ! isset( $args['format'] ) ) {
		$args['format'] = current_theme_supports( 'html5', 'comment-form' ) ? 'html5' : 'xhtml';
	}

	$req       = get_option( 'require_name_email' );
	$aria_req  = ( $req ? " aria-required='true'" : '' );
	$html_req  = ( $req ? " required='required'" : '' );
	$html5     = 'html5' === $args['format'];
	$commenter = wp_get_current_commenter();

	$args['label_submit'] = esc_html__( 'Submit', 'monstroid2' );

	$args['fields']['author'] = '<p class="comment-form-author"><input id="author" class="comment-form__field" name="author" type="text" placeholder="' . esc_html__( 'Your name', 'monstroid2' ) . ( $req ? ' *' : '' ) . '" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . $html_req . ' /></p>';

	$args['fields']['email'] = '<p class="comment-form-email"><input id="email" class="comment-form__field" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' placeholder="' . esc_html__( 'Your e-mail', 'monstroid2' ) . ( $req ? ' *' : '' ) . '" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30" aria-describedby="email-notes"' . $aria_req . $html_req . ' /></p>';

	$args['fields']['url'] = '<p class="comment-form-url"><input id="url" class="comment-form__field" name="url" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' placeholder="' . esc_html__( 'Your website', 'monstroid2' ) . '" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>';

	$args['comment_field'] = '<p class="comment-form-comment"><textarea id="comment" class="comment-form__field" name="comment" placeholder="' . esc_html__( 'Your comments *', 'monstroid2' ) . '" cols="45" rows="8" aria-required="true" required="required"></textarea></p>';

	$args['title_reply_before'] = '<h5 id="reply-title" class="comment-reply-title">';

	$args['title_reply_after'] = '</h5>';

	$args['title_reply'] = esc_html__( 'Leave a reply', 'monstroid2' );

	return $args;
}

/**
 * Customization for `Tag Cloud` widget.
 *
 * @param  array $args Widget arguments.
 *
 * @return array
 */
function monstroid2_skin6_customize_tag_cloud( $args ) {
	$args['smallest'] = 20;
	$args['largest']  = 20;
	$args['unit']     = 'px';

	return $args;
}

/**
 * Add skin cherry-team single template.
 *
 * @param array $tmpl_list Templates list.
 *
 * @return array
 */
function monstroid2_skin6_cherry_team_templates_list( $tmpl_list ) {
	$tmpl_list['resto-single'] = 'resto-single.tmpl';

	return $tmpl_list;
}

/**
 * Add skin services listing template.
 *
 * @param array $tmpl_list Templates list.
 *
 * @return array
 */
function monstroid2_skin6_cherry_services_listing_templates_list( $tmpl_list ) {

	$tmpl_list['default-resto'] = 'default-skin6.tmpl';

	return $tmpl_list;
}

/**
 * Add skin services single template.
 *
 * @param array $tmpl_list Templates list.
 *
 * @return array
 */
function monstroid2_skin6_cherry_services_single_templates_list( $tmpl_list ) {

	$tmpl_list['single-resto'] = 'single-skin6.tmpl';

	return $tmpl_list;
}

/**
 * Change cherry-services cta html format.
 *
 * @return string
 */
function monstroid2_skin6_cherry_services_cta_format( $html_format ) {
	return '<h1 class="service-cta_title">%1$s</h1><hr><div class="service-cta_desc">%2$s</div>%3$s';
}

/**
 *  Change cherry-services features title html format.
 *
 * @return string
 */
function monstroid2_skin6_cherry_services_features_title_format( $title_format ) {
	return '<h6 class="service-features_title">%s</h6>';
}

/**
 * Customization title settings to cherry-project.
 *
 * @param array $settings Title settings.
 *
 * @return array
 */
function monstroid2_skin6_cherry_projects_title_settings( $settings ) {
	$title_html = ( is_single() ) ? '<h1 %1$s>%4$s</h1>' : '<h4 %1$s><a href="%2$s" %3$s rel="bookmark">%4$s</a></h4>';

	$settings['html'] = $title_html;

	return $settings;
}

/**
 * Add term image to cherry-project archive pages.
 */
function monstroid2_skin6_cherry_projects_before_main_content() {

	if ( ! is_tax( array( 'projects_category', 'projects_tag' ) ) ) {
		return;
	}

	$term_id = get_queried_object_id();

	$image = monstroid2_utility()->utility->media->get_image(
		array(
			'html'        => '<img src="%3$s" %2$s alt="%4$s" %5$s >',
			'class'       => 'term-img',
			'size'        => 'monstroid2-thumb-xl',
			'mobile_size' => 'monstroid2-thumb-l',
			'placeholder' => false,
			'echo'        => false,
		),
		'term',
		$term_id
	);

	$title = monstroid2_utility()->utility->attributes->get_title(
		array(
			'html'  => '<h1 %1$s>%4$s</h1>',
			'class' => 'project-terms-header__title',
			'echo'  => false,
		),
		'term',
		$term_id
	);

	$desc = monstroid2_utility()->utility->attributes->get_content(
		array(
			'class' => 'project-terms-header__desc',
			'echo'  => false,
		),
		'term',
		$term_id
	);

	$html_format = '<div class="project-terms-header"><figure class="project-terms-header__thumbnail">%1$s</figure><div class="project-terms-header__content container invert">%2$s%3$s</div></div>';
	$html_format = apply_filters( 'monstroid2_skin6_projects_before_main_content_html' ,$html_format );

	printf( $html_format, $image, $title, $desc );
}

/**
 * Change cherry projects next button text.
 *
 * @return string
 */
function monstroid2_skin6_cherry_projects_next_button_text( $next_text ) {
	return esc_html__( 'Next', 'monstroid2' );
}

/**
 * Change cherry projects prev button text.
 *
 * @return string
 */
function monstroid2_skin6_cherry_projects_prev_button_text( $prev_text ) {
	return esc_html__( 'Prev', 'monstroid2' );
}

/**
 * Change breadcrumbs separator.
 */
function monstroid2_skin6_breadcrumbs_separator( $settings ) {

	$settings['separator'] = '&#124;';

	return $settings;
}

/**
 * Mprm menu-item single title html.
 */
function monstroid2_skin6_mprm_menu_item_single_title() {
	monstroid2_utility()->utility->attributes->get_title( array(
		'class' => 'mprm-title',
		'html'  => '<h4 %1$s>%4$s</h4>',
		'echo'  => true,
	) );
}
