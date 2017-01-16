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
<form method = "GET" class = "mphb_sc_search-form" action = "<?php echo $action; ?>">

	<?php
	/**
	 * @hooked \MPHB\Shortcodes\SearchShortcode::renderHiddenInputs - 10
	 */
	do_action( 'mphb_sc_search_render_form_top' );
	?>

	<p class="mphb_sc_search-check-in-date">
		<label for="<?php echo esc_attr( 'mphb_check_in_date-' . $uniqid ); ?>">
			<?php _e( 'Check-in', 'motopress-hotel-booking' ); ?>
			<abbr title="<?php printf( _x( 'Formated as %s', 'Date format tip', 'motopress-hotel-booking' ), 'mm/dd/yyyy' ); ?>">*</abbr>
		</label>
		<br />
		<input
			id="<?php echo esc_attr( 'mphb_check_in_date-' . $uniqid ); ?>"
			data-datepick-group="<?php echo esc_attr( $uniqid ); ?>"
			value="<?php echo esc_attr( $checkInDate ); ?>"
			placeholder="<?php _e( 'Check-in Date', 'motopress-hotel-booking' ); ?>"
			required="required"
			type="text"
			name="mphb_check_in_date"
			class="mphb-datepick"
			autocomplete="off"
			/>
	</p>

	<p class="mphb_sc_search-check-out-date">
		<label for="<?php echo 'mphb_check_out_date-' . $uniqid; ?>">
			<?php _e( 'Check-out', 'motopress-hotel-booking' ); ?>
			<abbr title="<?php printf( _x( 'Formated as %s', 'Date format tip', 'motopress-hotel-booking' ), 'mm/dd/yyyy' ); ?>">*</abbr>
		</label>
		<br />
		<input
			id="<?php echo esc_attr( 'mphb_check_out_date-' . $uniqid ); ?>"
			data-datepick-group="<?php echo esc_attr( $uniqid ); ?>"
			value="<?php echo esc_attr( $checkOutDate ); ?>"
			placeholder="<?php esc_attr_e( 'Check-out Date', 'motopress-hotel-booking' ); ?>"
			required="required"
			type="text"
			name="mphb_check_out_date"
			class="mphb-datepick"
			autocomplete="off"
			/>
	</p>

	<p class="mphb_sc_search-adults">
		<label for="<?php echo 'mphb_adults-' . $uniqid; ?>">
			<?php _e( 'Adults', 'motopress-hotel-booking' ); ?>
			<abbr title="<?php _e( 'Required', 'motopress-hotel-booking' ); ?>">*</abbr>
		</label>
		<br />
		<select id="<?php echo esc_attr( 'mphb_adults-' . $uniqid ); ?>" name="mphb_adults" required="required">
			<?php foreach ( $adultsList as $value ) { ?>
				<option value="<?php echo esc_attr( $value ); ?>" <?php selected( $adults, $value ); ?>><?php echo esc_html( $value ); ?></option>
			<?php } ?>
		</select>
	</p>

	<p class="mphb_sc_search-children">
		<label for="<?php echo esc_attr( 'mphb_children-' . $uniqid ); ?>">
			<?php _e( 'Children', 'motopress-hotel-booking' ); ?>
			<abbr title="<?php _e( 'Required', 'motopress-hotel-booking' ); ?>">*</abbr>
		</label>
		<br />
		<select id="<?php echo esc_attr( 'mphb_children-' . $uniqid ); ?>" name="mphb_children" required="required">
			<?php foreach ( $childrenList as $value ) { ?>
				<option value="<?php echo esc_attr( $value ); ?>" <?php echo selected( $children, $value ); ?>><?php echo esc_html( $value ); ?></option>
			<?php } ?>
		</select>
	</p>

	<?php do_action( 'mphb_sc_search_form_before_submit_btn' ); ?>

	<p class="mphb_sc_search-submit-button-wrapper">
		<input type="submit" class="button" value="<?php _e( 'Search Room', 'motopress-hotel-booking' ); ?>"/>
	</p>

	<?php do_action( 'mphb_sc_search_form_bottom' ); ?>

</form>