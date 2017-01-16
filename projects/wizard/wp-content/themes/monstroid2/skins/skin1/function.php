<?php
// Change terms permalink text
add_filter( 'cherry-projects-terms-permalink-text', 'monstroid2_skin1_projects_terms_permalink_text' );

// Change layout of single project
add_filter( 'monstroid2_content_classes', 'monstroid2_skin1_set_specific_content_classes' );

// Change breadcrumbs separator
add_filter( 'cherry_breadcrumb_args', 'monstroid2_skin1_breadcrumbs_settings' );

// Add new services list template
add_filter( 'cherry_services_listing_templates_list', 'monstroid2_skin1_cherry_services_listing_templates_list' );

// Add new single service template
add_filter( 'cherry_services_single_templates_list', 'monstroid2_skin1_cherry_services_single_templates_list' );

// Add title to blog page
add_filter( 'monstroid2_single_post_title_html', 'monstroid2_skin1_single_post_title_html' );


// Invisible button read more in module post
add_filter( 'monstroid2_module_post_btn_settings_layout_1', 'monstroid2_skin1_module_post_btn_settings_layout_1' );


/**
 * Change terms permalink text
 */
function monstroid2_skin1_projects_terms_permalink_text() {
	return esc_html__( 'view projects', 'monstroid2' );
}


/**
 * Change layout of single project
 */
function monstroid2_skin1_set_specific_content_classes( $layout_classes ) {
	$sidebar_position = get_theme_mod( 'sidebar_position' );

	if ( ('fullwidth' === $sidebar_position && is_single() && !is_singular( 'post' )) ) {
		$layout_classes = array( 'col-xs-12' );
	}

	return $layout_classes;
}

/**
 * Change breadcrumbs separator
 */
function monstroid2_skin1_breadcrumbs_settings( $args ) {
	$args['separator'] = ' | ';

	return $args;
}

/**
 * Add new services list template
 */

function monstroid2_skin1_cherry_services_listing_templates_list( $tmpl ) {

	$tmpl['media-icon-skin1'] = 'media-icon-skin1.tmpl';
	$tmpl['default-skin1'] = 'default-skin1.tmpl';
	return $tmpl;
}

/**
 * Add new single service template
 */

function monstroid2_skin1_cherry_services_single_templates_list( $tmpl ) {

	$tmpl['single-skin1'] = 'single-skin1.tmpl';
	return $tmpl;
}

add_action( 'cherry_projects_before_main_content', 'monstroid2_skin1_cherry_projects_before_main_content' );
function monstroid2_skin1_cherry_projects_before_main_content() {
	if ( ! is_tax( array( 'projects_category', 'projects_tag' ) ) ) {
		return;
	}

	$title = '<h2 class="project-terms-title">' . single_term_title( '', false ) . '</h2>';
	$desc  = get_the_archive_description();
	$image = monstroid2_utility()->utility->media->get_image(
		array(
			'html'        => '<img src="%3$s" %2$s alt="%4$s" %5$s >',
			'class'       => 'term-img',
			'size'        => 'monstroid2-thumb-xl',
			'placeholder' => false,
			'echo'        => false,
		),
		'term',
		get_queried_object_id()
	); ?>

	<div class="project-terms-caption grid-default-skin1">
		<div class="project-terms-caption-header">
			<div class="project-terms-thumbnail">
				<?php echo $image; ?>
			</div>
			<?php
			if ( single_term_title( '', false ) ) {
				echo $title;
			} ?>
		</div>
		<div class="project-terms-caption-content">
			<div class="container">
				<?php if ( $desc ) {
					echo $desc;
				} ?>
			</div>
		</div>
	</div>
	<?php
}


/**
 * Add title to blog page
 */

function monstroid2_skin1_single_post_title_html(){
	return '<h4 class="page-title">%s</h4>';
}


/**
 * Invisible button read more in module post
 */
function monstroid2_skin1_module_post_btn_settings_layout_1( $args ) {

	$args = array(
		'visible' => false,
		'text'    => esc_html__( 'Read More', 'monstroid2' ),
		'icon'    => '<i class="linearicon linearicon-arrow-right"></i>',
		'class'   => 'tm-posts_more-btn link',
		'html'    => '<a href="%1$s" %3$s><span class="link__text">%4$s</span>%5$s</a>',
		'echo'    => true,
	);
	return $args;
}
