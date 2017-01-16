<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Monstroid2
 */
?>
<section class="error-404 not-found">
	<header class="page-header">
		<h1 class="page-title screen-reader-text"><?php esc_html_e( '404', 'monstroid2' ); ?></h1>
	</header><!-- .page-header -->

	<div class="page-content">
		<div class="invert">

			<h2><?php esc_html_e( 'Page Not Found.', 'monstroid2' ); ?></h2>
			<p><?php esc_html_e( 'Map where your photos were taken and discover local points of interest. There&#39;s also a flip-out.', 'monstroid2' ); ?></p>

		</div>
		<p><a class="btn btn-secondary" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Go home', 'monstroid2' ); ?></a></p>

	</div><!-- .page-content -->
</section><!-- .error-404 -->
