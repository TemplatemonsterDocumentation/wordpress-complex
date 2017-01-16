<?php get_header( monstroid2_template_base() ); ?>

	<?php monstroid2_site_breadcrumbs(); ?>

	<div <?php monstroid2_content_wrap_class(); ?>>

		<div class="row">

			<div id="primary" <?php monstroid2_primary_content_class(); ?>>

				<main id="main" class="site-main" role="main">

					<?php include monstroid2_template_path(); ?>

				</main><!-- #main -->

			</div><!-- #primary -->

		</div><!-- .row -->

	</div><!-- .container -->

<?php get_footer( monstroid2_template_base() ); ?>
