<?php
/**
 * Available variables
 * - string $uniqid
 * - string $action Action for search form
 * - string $checkInDate
 * - string $checkOutDate
 * - int $adults
 * - int $children
 * - array $adultsList
 * - array $childrenList
 */
if ( !defined( 'ABSPATH' ) ) {
	exit;
}
?>
<form method="GET" class="mphb_sc_search-form loading" action="<?php echo $action; ?>">

	<?php
	/**
	 * @hooked \MPHB\Shortcodes\SearchShortcode::renderHiddenInputs - 10
	 */
		do_action( 'mphb_sc_search_render_form_top' );
	?>

	<div class="mphb_sc_search-check-in-date">
		<div class="showing-form">
			<div class="label h6-style"><?php esc_html_e( 'Check-in', 'monstroid2' ); ?></div>
			<div class="date h4-style">
				<span class="on-load-label"><?php esc_attr_e( 'Check-in Date', 'monstroid2' ); ?></span>
				<span class="day h1-style"></span><span class="month"></span> <span class="year"></span>
			</div>
		</div>
		<div class="hidden-form">
			<label for="<?php echo esc_attr( 'mphb_check_in_date-' . $uniqid ); ?>">
				<?php esc_html_e( 'Check-in', 'monstroid2' ); ?>
			</label>
			<strong>
				<abbr title="<?php printf( _x( 'Formated as %s', 'Date format tip', 'monstroid2' ), 'mm/dd/yyyy' ); ?>">*</abbr>
			</strong>
			<br />
			<input id="<?php echo esc_attr( 'mphb_check_in_date-' . $uniqid ); ?>" data-datepick-group="<?php echo esc_attr( $uniqid ); ?>" value="<?php echo esc_attr_e( $checkInDate ); ?>" placeholder="<?php esc_attr_e( 'Check-in Date', 'monstroid2' ); ?>" required="required" type="text" name="mphb_check_in_date" class="mphb-datepick mphb_check_in_date" autocomplete="off" />
		</div>
	</div>

	<div class="mphb_sc_search-check-out-date">
		<div class="showing-form">
			<div class="label h6-style"><?php esc_html_e( 'Check-out', 'monstroid2' ); ?></div>
			<div class="date h4-style">
				<span class="on-load-label"><?php esc_attr_e( 'Check-out Date', 'monstroid2' ); ?></span>
				<span class="day h1-style"></span><span class="month"></span> <span class="year"></span>
			</div>
		</div>
		<div class="hidden-form">
			<label for="<?php echo 'mphb_check_out_date-' . $uniqid; ?>">
				<?php esc_html_e( 'Check-out', 'monstroid2' ); ?>
			</label>
			<strong>
				<abbr title="<?php printf( _x( 'Formated as %s', 'Date format tip', 'monstroid2' ), 'mm/dd/yyyy' ); ?>">*</abbr>
			</strong>
			<br />
			<input id="<?php echo esc_attr( 'mphb_check_out_date-' . $uniqid ); ?>" data-datepick-group="<?php echo esc_attr_e( $uniqid ); ?>" value="<?php echo esc_attr_e( $checkOutDate ); ?>" placeholder="<?php esc_attr_e( 'Check-out Date', 'monstroid2' ); ?>" required="required" type="text" name="mphb_check_out_date" class="mphb-datepick mphb_check_out_date" autocomplete="off"/>
		</div>
	</div>

	<div class="mphb_sc_search-adults">
		<div class="showing-form">
			<div class="label h6-style"><?php esc_html_e( 'Adults', 'monstroid2' ); ?></div>
			<select id="<?php echo esc_attr_e( 'mphb_adults-' . $uniqid ); ?>" name="mphb_adults" required="required">
				<?php foreach ( $adultsList as $value ) { ?>
					<option value="<?php echo esc_attr_e( $value ); ?>" <?php selected( $adults, $value ); ?>><?php echo esc_html( $value ); ?></option>
				<?php } ?>
			</select>
		</div>
		<div class="hidden-form">
			<label for="<?php echo esc_attr( 'mphb_adults-' . $uniqid ); ?>">
				<?php esc_html_e( 'Adults', 'monstroid2' ); ?>
			</label>
			<strong>
				<abbr title="<?php esc_attr_e( 'Required', 'monstroid2' ); ?>">*</abbr>
			</strong>
		</div>
	</div>

	<div class="mphb_sc_search-children">
		<div class="showing-form">
			<div class="label h6-style"><?php esc_html_e( 'Child', 'monstroid2' ); ?></div>
			<select id="<?php echo esc_attr( 'mphb_children-' . $uniqid ); ?>" name="mphb_children" required="required">
				<?php foreach ( $childrenList as $value ) { ?>
					<option value="<?php echo esc_attr_e( $value ); ?>" <?php echo selected( $children, $value ); ?>><?php echo esc_html( $value ); ?></option>
				<?php } ?>
			</select>
		</div>
		<div class="hidden-form">
			<label for="<?php echo esc_attr( 'mphb_children-' . $uniqid ); ?>">
				<?php esc_html_e( 'Child', 'monstroid2' ); ?>
			</label>
			<strong><abbr title="<?php esc_attr_e( 'Required', 'monstroid2' ); ?>">*</abbr></strong>
		</div>
	</div>

	<?php do_action( 'mphb_sc_search_form_before_submit_btn' ); ?>

	<div class="mphb_sc_search-submit-button-wrapper">
		<input type="submit" class="button" value="<?php echo esc_attr_e( 'Check Availability', 'monstroid2' ); ?>"/>
	</div>

	<?php do_action( 'mphb_sc_search_form_bottom' ); ?>

</form>
