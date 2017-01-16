<?php
/**
 * The template for displaying search form.
 *
 * @package Monstroid2
 */
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div class="search-form__input-wrap">
		<span class="screen-reader-text"><?php echo esc_html_x( 'Search for:', 'label', 'monstroid2' ) ?></span>
		<?php echo apply_filters( 'monstroid2_search_form_input_icon', '<i class="linearicon linearicon-magnifier"></i>' ); ?>
		<input type="search" class="search-form__field"
			placeholder="<?php echo esc_attr_x( 'Enter keyword', 'placeholder', 'monstroid2' ) ?>"
			value="<?php echo get_search_query() ?>" name="s"
			title="<?php echo esc_attr_x( 'Search for:', 'label', 'monstroid2' ) ?>" />
	</div>
	<button type="submit" class="search-form__submit btn btn-primary"><?php esc_html_e( 'Go!', 'monstroid2' ); ?></button>
</form>
