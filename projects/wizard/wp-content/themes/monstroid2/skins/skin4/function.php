<?php
/**
 * Monstroid2 skin4 functions.
 */

/**
 * Change post template part slug
 */
add_filter( 'monstroid2_post_template_part_slug', 'monstroid2_skin4_post_template_part_slug', 10, 2 );

/**
 * Change single modern header posts
 */
add_filter( 'monstroid2_single_modern_header_posts', 'monstroid2_skin4_single_modern_header_posts' );

/**
 * Change single template part slug
 */
add_filter( 'monstroid2_single_post_template_part_slug', 'monstroid2_skin4_single_post_template_part_slug', 10, 2 );

/**
 * Change single template modern header
 */
add_filter( 'monstroid2_single_modern_header_template_part_slug', 'monstroid2_skin4_single_modern_header_template_part_slug' );

/**
 * Change author bio template
 */
add_filter( 'monstroid2_post_author_bio_template_part_slug', 'monstroid2_skin4_post_author_bio_template_part_slug' );

/**
 * Change related posts template
 */
add_filter( 'monstroid2_related_posts_template_part_slug', 'monstroid2_skin4_related_posts_template_part_slug' );

/**
 * Change comment template
 */
add_filter( 'monstroid2_comment_template_part_slug', 'monstroid2_skin4_comment_template_part_slug' );

/**
 * Add placeholder attributes for comment form fields.
 */
add_filter( 'comment_form_defaults', 'monstroid2_skin4_modify_comment_form' );

/**
 * Change content posts pagination arrows
 */
add_filter( 'monstroid2_content_posts_pagination', 'monstroid2_skin4_content_posts_pagination' );

/**
 * Change searchform template
 */
add_filter( 'get_search_form', 'monstroid2_skin4_search_form' );

/**
 * Change widget about author view
 */
add_filter( 'monstroid2_widget_about_author_view', 'monstroid2_skin4_widget_about_author_view' );

/**
 * Change widget carousel view
 */
add_filter( 'monstroid2_carousel_widget_view_dir', 'monstroid2_skin4_carousel_widget_view_dir' );

/**
 * Change widget custom posts view
 */
add_filter( 'monstroid2_custom_posts_widget_view_dir', 'monstroid2_skin4_custom_posts_widget_view_dir' );

/**
 * Change widget featured posts block view
 */
add_filter( 'monstroid2_featured_posts_block_widget_view_dir', 'monstroid2_skin4_featured_posts_block_widget_view_dir' );

/**
 * Change breadcrumbs settings
 */
add_filter( 'monstroid2_breadcrumbs_settings', 'monstroid2_skin4_breadcrumbs_settings' );

/**
 * Change instagram image size
 */
add_filter( 'monstroid2_instagram_image_size', 'monstroid2_skin4_instagram_image_size' );

/**
 * Change builder module teplate.
 */
add_filter( 'monstroid2_builder_templates', 'monstroid2_skin4_builder_templates' );

/**
 * Add template to cherry-team-members templates list.
 */
add_filter( 'cherry_team_templates_list', 'monstroid2_skin4_add_template_to_cherry_team_templates_list' );

/**
 * Set specific content classes for blog listing
 */
add_filter( 'monstroid2_content_classes', 'monstroid2_skin4_set_specific_single_team_classes' );

/**
 * Change mp event widget upcoming view
 */
add_filter( 'mptt_render_html', 'monstroid2_skin4_mptt_render_html', 10, 2 );

/**
 * Add excerpt meta box to cherry-team
 */
add_filter( 'cherry_team_post_type_args', 'monstroid2_skin4_cherry_team_post_type_args' );


/**
 * Change post template part slug
 *
 * @return string
 */
function monstroid2_skin4_post_template_part_slug( $blog_post_template, $blog_layout_type ) {
	if ( 'default' !== $blog_layout_type ) {
		$blog_post_template = 'skins/skin4/template-parts/post/grid/content';
	} else {
		$blog_post_template = 'skins/skin4/template-parts/post/default/content';
	}

	return $blog_post_template;
}

/**
 * Change singl modern header posts
 *
 * @return array
 */

function monstroid2_skin4_single_modern_header_posts( $modern_header_posts ) {

	return is_singular( array( 'post', 'mp-event' ) );
}

/**
 * Change singl template part slug
 *
 * @return string
 */
function monstroid2_skin4_single_post_template_part_slug( $single_post_template, $single_post_type ) {
	if ( 'modern' === $single_post_type && is_singular( 'post' ) ) {
		$single_post_template = 'skins/skin4/template-parts/post/single/content-single-modern';
	} elseif ( 'modern' === $single_post_type && is_singular( 'mp-event' ) ) {
		$single_post_template = 'skins/skin4/template-parts/post/single/content-single-mp-event-modern';
	}else {
		$single_post_template = 'skins/skin4/template-parts/post/single/content-single';
	}

	return $single_post_template;
}

/**
 * Change singl template modern header
 *
 * @return string
 */
function monstroid2_skin4_single_modern_header_template_part_slug() {
	$single_modern_header_template = 'skins/skin4/template-parts/post/single/content-single-modern-header';

	if ( is_singular( 'mp-event' ) ) {
		$single_modern_header_template = 'skins/skin4/template-parts/post/single/content-single-mp-event-modern-header';
	}

	return $single_modern_header_template;
}

/**
 * Change author bio template
 *
 * @return string
 */
function monstroid2_skin4_post_author_bio_template_part_slug() {
	$content_author_bio = 'skins/skin4/template-parts/content-author-bio';

	if ( is_singular( 'mp-event' ) ) {
		$content_author_bio = '';
	}

	return $content_author_bio;
}

/**
 * Change related posts template
 *
 * @return string
 */
function monstroid2_skin4_related_posts_template_part_slug() {

	return 'skins/skin4/template-parts/content-related-posts.php';
}

/**
 * Change comment template
 *
 * @return string
 */
function monstroid2_skin4_comment_template_part_slug() {

	return 'skins/skin4/template-parts/comment';
}

/**
 * Add placeholder attributes for comment form fields.
 *
 * @param  array $args Argumnts for comment form.
 *
 * @return array
 */
function monstroid2_skin4_modify_comment_form( $args ) {
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

	$args['fields']['author'] = '<p class="comment-form-author"><label for="author">' . esc_html__( 'Name:', 'monstroid2' ) .  ( $req ? ' <span>*</span>' : '' ) . '</label><input id="author" class="comment-form__field" name="author" type="text" placeholder="' . esc_html__( 'Enter please your name', 'monstroid2' ) . '" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . $html_req . ' /></p>';

	$args['fields']['email'] = '<p class="comment-form-email"><label for="email">' . esc_html__( 'E-mail:', 'monstroid2' ) . ( $req ? ' <span>*</span>' : '' ) . '</label><input id="email" class="comment-form__field" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' placeholder="' . esc_html__( 'Enter please your e-mail', 'monstroid2' ) . '" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30" aria-describedby="email-notes"' . $aria_req . $html_req . ' /></p>';

	$args['fields']['url'] = '';

	$args['comment_field'] = '<p class="comment-form-comment"><label for="comment">' . esc_html__( 'Comment:', 'monstroid2' ) . ' <span>*</span>' . '</label><textarea id="comment" class="comment-form__field" name="comment" placeholder="' . esc_html__( 'Enter please your comment', 'monstroid2' ) . '" cols="45" rows="8" aria-required="true" required="required"></textarea></p>';

	$args['title_reply_before'] = '<h5 id="reply-title" class="comment-reply-title">';

	$args['title_reply_after'] = '</h5>';

	$args['title_reply'] = esc_html__( 'Leave a reply', 'monstroid2' );

	return $args;
}

/**
 * Change content posts pagination arrows
 *
 * @return array
 */
function monstroid2_skin4_content_posts_pagination( $posts_pagination ) {
	$posts_pagination['prev_text'] = '<i class="material-icons">keyboard_arrow_left</i>';
	$posts_pagination['next_text'] = '<i class="material-icons">keyboard_arrow_right</i>';

	return $posts_pagination;
}

/**
 * Change searchform template
 *
 * @return string
 */
function monstroid2_skin4_search_form( $form ) {
	$form = '<form role="search" method="get" class="search-form" action="' . esc_url( home_url( '/' ) ) . '">
			<div class="search-form__input-wrap">
				<span class="screen-reader-text">' . _x( 'Search for:', 'monstroid2' ) . '</span>
				<label>' . esc_html__( 'Search:', 'monstroid2' ) . '</label>
				<input type="search" class="search-form__field"
					placeholder="' . esc_attr_x( 'Enter keyword', 'placeholder', 'monstroid2' ) . '"
					value="' . get_search_query() . '" name="s"
					title="' . esc_attr_x( 'Search for:', 'label', 'monstroid2' ) . '" />
			</div>
			<button type="submit" class="search-form__submit btn btn-primary"><i class="material-icons">search</i></button>
		</form>';

	return $form;
}

/**
 * Change widget about author view
 *
 * @return string
 */
function monstroid2_skin4_widget_about_author_view() {

	return 'skins/skin4/template-parts/widgets/about-author/about-author.php';
}

/**
 * Change widget carousel view
 *
 * @return string
 */
function monstroid2_skin4_carousel_widget_view_dir() {

	return 'skins/skin4/template-parts/widgets/carousel/carousel-view.php';
}

/**
 * Change widget custom posts view
 *
 * @return string
 */
function monstroid2_skin4_custom_posts_widget_view_dir() {

	return 'skins/skin4/template-parts/widgets/custom-posts/custom-post-view.php';
}

/**
 * Change widget featured posts block view
 *
 * @return string
 */
function monstroid2_skin4_featured_posts_block_widget_view_dir() {

	return 'skins/skin4/template-parts/widgets/featured-posts-block/featured-posts-block-item.php';
}

/**
 * Change breadcrumbs settings
 *
 * @return array
 */
function monstroid2_skin4_breadcrumbs_settings( $breadcrumbs_settings ) {
	$breadcrumbs_settings['wrapper_format'] = '<div class="container"><div class="row">%1$s<div class="breadcrumbs__items">%2$s</div></div></div>';
	$breadcrumbs_settings['page_title_format'] = '<h6 class="page-title">%s</h6>';
	$breadcrumbs_settings['separator'] = '&#124;';

	return $breadcrumbs_settings;
}

/**
 * Change instagram image size
 *
 * @return int
 */
function monstroid2_skin4_instagram_image_size( $size ) {

	return 350;
}

/**
 * Change builder module teplate.
 *
 * @return string
 */
function monstroid2_skin4_builder_templates( $path ) {

	return 'skins/skin4/template-parts/builder-templates/';
}

/**
 * Add template to cherry-team-members templates list.
 *
 * @param array $tmpl_list Templates list.
 *
 * @return array
 */
function monstroid2_skin4_add_template_to_cherry_team_templates_list( $tmpl_list ) {
	$tmpl_list['fitness-single'] = 'fitness-single.tmpl';

	return $tmpl_list;
}

/**
 * Set specific content classes for blog listing
 */
function monstroid2_skin4_set_specific_single_team_classes( $layout_classes ) {
	$sidebar_position = get_theme_mod( 'sidebar_position' );

	if ( ( 'fullwidth' === $sidebar_position && is_single() && is_singular( 'team' ) ) ) {
		$layout_classes = array( 'col-xs-12', 'col-md-12', 'col-xl-12' );
	}

	return $layout_classes;
}

/**
 * Change mp event widget upcoming view
 */
function monstroid2_skin4_mptt_render_html( $include_file, $template ) {
	if ( 'theme/widget-upcoming-view' !== $template )
		return $include_file;

	$include_file = get_template_directory() . '/skins/skin4/template-parts/plugins/mp-timeteble/widget-upcoming-view.php';

	return $include_file;
}

/**
 * Add excerpt meta box to cherry-team.
 *
 * @param array $args supports.
 *
 * @return array
 */
function monstroid2_skin4_cherry_team_post_type_args( $args ) {
	array_push( $args['supports'], 'excerpt' );

	return $args;
}
