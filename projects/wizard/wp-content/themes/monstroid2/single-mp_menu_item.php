<?php
do_action( 'mprm-before-main-wrapper' );
while ( have_posts() ) : the_post(); ?>
	<div <?php post_class( apply_filters( 'mprm-main-wrapper-class', 'mprm-main-wrapper' ) ) ?>>
		<?php
		do_action( 'mprm_before_menu_item_header' );
		do_action( 'mprm_menu_item_header' );
		do_action( 'mprm_after_menu_item_header' );
		?>
		<div class="<?php echo apply_filters( 'mprm-content-wrapper-class', 'mprm-container content-wrapper' ) ?>">
			<div class="row">
				<div class="<?php echo apply_filters( 'mprm-menu-content-class', 'mprm-content col-xs-12 col-lg-8' ) ?>">
					<?php
					do_action( 'mprm_menu_item_content_before' );

					do_action( 'mprm_menu_item_content' );
					do_action( 'mprm_before_menu_item_gallery' );
					do_action( 'mprm_menu_item_gallery' );
					do_action( 'mprm_after_menu_item_gallery' );

					do_action( 'mprm_menu_item_content_after' );
					?>
				</div>
				<div class="<?php echo apply_filters( 'mprm-menu-sidebar-class', 'mprm-sidebar col-xs-12 col-lg-4' ) ?>">
					<?php do_action( 'mprm_menu_item_slidebar' ); ?>
				</div>
			</div>
		</div>
	</div>
<?php endwhile; ?>
	<div class="mprm-clear"></div>
<?php do_action( 'mprm-after-main-wrapper' );
